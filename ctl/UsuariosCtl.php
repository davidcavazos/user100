<?php

require_once('ctl/BaseCtl.php');
class UsuariosCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();
    if (isset($_POST['agregar'])) {
      $codigo = $_POST['codigo'];
      $nombres = $_POST['nombres'];
      $apellidos = $_POST['apellidos'];
      $tipo = $this->tipo + 1;
      $carrera = $_POST['carrera'];
      $email = $_POST['email'];
      $activo = 1;
      $campoExtra = $_POST['campoextra'];
      $tipoCampo = $_POST['tipoCampo'];
      $this->limpiarVariablesPost();
      $mdl->agregar($codigo, $nombres, $apellidos, $tipo, $carrera,
                    $email, $activo, $campoExtra, $tipoCampo);
    } elseif (isset($_POST['modificar'])) {
      $codigo = $_POST['codigo'];
      $new_codigo = $_POST['new_codigo'];
      $nombres = $_POST['nombres'];
      $apellidos = $_POST['apellidos'];
      $carrera = $_POST['carrera'];
      $email = $_POST['email'];
      $campoExtra = $_POST['campoextra'];
      $tipoCampo = $_POST['tipoCampo'];
      $this->limpiarVariablesPost();
      $mdl->modificar($codigo, $new_codigo, $nombres, $apellidos, $carrera,
                      $email, $campoExtra, $tipoCampo);
    } elseif (isset($_POST['desactivar'])) {
      $usuarios = $_POST['usuarios'];
      foreach ($usuarios as $codigo) {
        $mdl->desactivar($codigo);
      }
    } elseif (isset($_POST['mostrar'])) {
      $codigo = $_POST['codigo'];
      $q = $mdl->datos("SELECT * FROM usuario WHERE codigo='$codigo' AND tipo_usuario>'$this->tipo'")[0];
      if (count($q) == 0) {
        echo 'Error: no se encontro';
        return;
      }
      $info = array();
      $info['codigo'] = $q['codigo'];
      $info['nombres'] = $q['nombres'];
      $info['apellidos'] = $q['apellidos'];
      $info['password'] = $q['password'];
      $info['tipo_usuario'] = $q['tipo_usuario'];
      $info['carrera'] = $q['carrera'];
      $info['email'] = $q['email'];
      $info['activo'] = $q['activo'];

      $q = $mdl->datos("SELECT * FROM detalle_usuario WHERE codigo='$codigo'");
      
      $info['tipo'] = array();
      $info['cuenta'] = array();
      foreach ($q as $detalle) {
        $info['tipo'][] = $detalle['campo_extra'];
        $info['cuenta'][] = $detalle['valor'];
      }
      echo json_encode($info);
    } else {
      $this->mostrar();
    }
  }

  public function generarBody() {
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $body = file_get_contents($this->vstFile);
    $tipo_usuario = 'Usuario';
    switch ($this->tipo) {
      case -1: // root
        $tipo_usuario = 'Admin';
        break;
      case 0:  // admin
        $tipo_usuario = 'Maestro';
        break;
      case 1:  // maestro
        $tipo_usuario = 'Alumno';
        break;
    }
    $body = str_replace('{TIPO_USUARIO}', $tipo_usuario, $body);

    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos("SELECT * FROM usuario WHERE tipo_usuario>'$this->tipo' ORDER BY apellidos");
    $filas = '';
    $num = 1;
    foreach ($datos as $row) {
      if ($row['activo'] == 0) {
        continue;
      }
      $new_fila = $fila;
      $dict = array(
        '{X}' => $num,
        '{CODIGO}' => $row['codigo'],
        '{NOMBRE}' => $row['apellidos'] . ', ' . $row['nombres'],
        '{CARRERA}' => $row['carrera'],
        '{EMAIL}' => $row['email'],
        '{TOTAL}' => '0'
      );
      $num += 1;
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }

    $this->onload_fcn = 'on_load()';
    return str_replace($fila, $filas, $body);
  }
}

?>
