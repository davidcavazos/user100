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
      $password = $_POST['password'];
      $tipo = $_POST['tipo'];
      $carrera = $_POST['carrera'];
      $email = $_POST['email'];
      $activo = $_POST['activo'];
	  $campoExtra = $_POST['campoextra'];
	  $tipo = $_POST['tipo'];
      $this->limpiarVariablesPost();
      $mdl->agregar($codigo, $nombres, $apellidos, $password, $tipo, $carrera,
                    $email, $activo, $campoExtra, $tipo);
    } elseif (isset($_POST['desactivar'])) {
      $usuarios = $_POST['usuarios'];
      foreach ($usuarios as $codigo) {
        $mdl->desactivar($codigo);
      }
    } else {
      $this->mostrar();
    }
  }

  public function generarBody() {
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $body = file_get_contents($this->vstFile);

    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM usuario ORDER BY apellidos');
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
    return str_replace($fila, $filas, $body);
  }
}

?>
