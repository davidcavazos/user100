<?php

require_once('ctl/BaseCtl.php');
class EvaluacionCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/EvaluacionMdl.php');
    $mdl = new EvaluacionMdl();
    if (isset($_POST['get_alumnos'])) {
      $q = $mdl->get_alumnos($_POST['ciclonrc']);
      if (count($q) == 0) {
        echo 'Error: no se encontro';
        return;
      }
      $info = array();
      foreach ($q as $a) {
        $info[] = $a['apellidos'].', '.$a['nombres'].' ('.$a['codigo'].')';
      }
      echo json_encode($info);
    } 
    elseif(isset($_POST['alta_cursos']))
    {
      $codigo=$_POST['codigo'];
      $ciclonrc=$_POST['ciclonrc'];
      $mdl->agregar($codigo, $ciclonrc); 
    }
    elseif(iset($_POST['alta_rubros']))
    {
      $rubros = $_POST['rubros'];
      $subrubros = $_POST['subrubros'];
      $rubrosp = $_POST['rubrosp'];
      $subrubrosp = $_POST['subrubrosp'];
      $mdl -> insertarRubros($rubros, $subrubros, $rubrosp, $subrubrosp);
    }
    elseif(isset($_FILES['archivo']['name']))
    {
      $mdl->insertarDesdeArchivo($this->procesarArchivo(), $_GET['ciclo'], $_GET['nrc']);
      $this->mostrar();
    }
    else {
      $this->mostrar();
    }
  }

  public function procesarArchivo()
  {
    $archivo = file_get_contents($_FILES['archivo']['tmp_name']);
    $renglones = explode(PHP_EOL , $archivo);
    $codigo = array();
    foreach($renglones as $r)
    {
      $codigo[]= substr($r,0,9);
    }
    return $codigo;
  }

  public function generarBody() {
    $body = file_get_contents($this->vstFile);

    // Ciclo
    require_once('mdl/CiclosMdl.php');
    $mdl = new CiclosMdl();

    $inicio_fila = strrpos($body, '<option value="{CICLO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->get_ciclos();
    $ciclo='';
    if (!empty($datos)) {
      $ciclo = $datos[0]['ciclo'];
    }
    if (isset($_GET['ciclo'])) {
      $ciclo = $_GET['ciclo'];
    }

    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CICLO}' => $row['ciclo'],
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['ciclo'] == $ciclo) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
      }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Curso
    require_once('mdl/CursosMdl.php');
    $mdl = new CursosMdl();

    $inicio_fila = strrpos($body, '<option value="{CURSO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

/*<<<<<<< HEAD
    if ($this->tipo == 1) {
      $filtro = "AND codigo_profesor='$this->codigo'";
    } elseif ($this->tipo == 2) {
      $filtro = "AND ciclonrc IN (SELECT ciclonrc FROM grupo WHERE codigo='$this->codigo')";
    }
    else
    {
      $filtro = "";
    }
    $datos = $mdl->datos("SELECT * FROM curso INNER JOIN materia WHERE clave_materia=clave AND ciclo='$ciclo' $filtro ORDER BY clave, seccion");
=======*/
    $datos = $mdl->get_cursos($ciclo);
//>>>>>>> b84ce3d4e0e8b3ed8c718a6aa9988991b974c791
    if (!empty($datos)) {
      $clave = $datos[0]['clave'];
      $nrc = $datos[0]['nrc'];
    }
    if (isset($_GET['clave'])) {
      $clave = $_GET['clave'];
    }
    if (isset($_GET['nrc'])) {
      $nrc = $_GET['nrc'];
    }

    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CURSO}' => $row['nrc'].' - '.$row['clave'].' - '.$row['materia'].' ('.$row['seccion'].')',
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['nrc'] == $nrc) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
      }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Alumnos
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->get_alumnos_en_curso($ciclo, $nrc);
    $filas = '';
    $num = 1;
    foreach ($datos as $row) {
      if ($row['activo'] == 0) {
        continue;
      }
      $new_fila = $fila;
      if ($this->tipo == 2) {
        $start = strrpos($fila, "<!--B{-->");
        $end = strrpos($fila, "<!--}B-->") + 9;
        $control = substr($fila, $start, $end - $start);
        $new_fila = str_replace($control, '', $fila);
      }

      $dict = array(
        '{X}' => $num,
        '{CODIGO}' => $row['codigo'],
        '{NOMBRE}' => $row['apellidos'] . ', ' . $row['nombres'],
        '{CARRERA}' => $row['carrera'],
        '{TOTAL}' => '0'
      );

      $num += 1;
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    if ($this->tipo == 2) {
      $start = strrpos($body, '<!--A{-->');
      $end = strrpos($body, '<!--}A-->') + 9;
      $control = substr($body, $start, $end - $start);
      $body = str_replace($control, '', $body);

      $start = strrpos($body, '<!--C{-->');
      $end = strrpos($body, '<!--}C-->') + 9;
      $control = substr($body, $start, $end - $start);
      $body = str_replace($control, '', $body);
    }

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
