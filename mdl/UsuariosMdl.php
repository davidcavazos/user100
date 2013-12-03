<?php

require_once('mdl/BaseMdl.php');
class UsuariosMdl extends BaseMdl {
  public function agregar($codigo, $nombres, $apellidos, $tipo,
                          $carrera, $email, $activo, $campoExtra, $tipoCampo)
  {
    $query =
      "INSERT INTO usuario (codigo, nombres, apellidos, password, tipo_usuario,
                            carrera, email, activo)
       VALUES (
         '$codigo',
         '$nombres',
         '$apellidos',
         '',
         '$tipo',
         '$carrera',
         '$email',
         '$activo'
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    asignar_password($codigo);
    if(strlen($campoExtra)!=0)
    {
      $campoExtra=trim($campoExtra,",");
      $tipoCampo=trim($tipoCampo,",");
      $campoExtra=explode(",",$campoExtra);
      $tipoCampo=explode(",", $tipoCampo);
      for($i=0;$i<sizeof($tipoCampo);$i++)
      {
        $query=
        "INSERT INTO detalle_usuario VALUES(
        '$codigo',
        '".$tipoCampo[$i]."',
        '".$campoExtra[$i]."')";
        $r = $this->driver->query($query);
        if ($r === FALSE)
        {
          echo 'Error: ' . $this->driver->error;
          return FALSE;
        }
      }
    }
    return $this->driver->insert_id;
  }

  public function modificar($codigo, $new_codigo, $nombres, $apellidos,
                            $carrera, $email, $campoExtra, $tipoCampo)
  {
    $query =
      "UPDATE usuario SET
         codigo='$new_codigo',
         nombres='$nombres',
         apellidos='$apellidos',
         carrera='$carrera',
         email='$email'
       WHERE codigo='$codigo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    if(strlen($campoExtra)!=0)
    {
      $campoExtra=trim($campoExtra,",");
      $tipoCampo=trim($tipoCampo,",");
      $campoExtra=explode(",",$campoExtra);
      $tipoCampo=explode(",", $tipoCampo);
      for($i=0;$i<sizeof($tipoCampo);$i++)
      {
        $query=
        "INSERT INTO detalle_usuario VALUES(
        '$codigo',
        '".$tipoCampo[$i]."',
        '".$campoExtra[$i]."')";
        $r = $this->driver->query($query);
        if ($r === FALSE)
        {
          echo 'Error: ' . $this->driver->error;
          return FALSE;
        }
      }
    }
    echo 'modificando';
    return $this->driver->insert_id;
  }

  public function desactivar($codigo) {
    $query =
      "UPDATE usuario SET
         activo='0'
       WHERE codigo='$codigo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }

  public function asignar_password($codigo) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pass = '';
    for ($i = 0; $i < 8; $i++) {
      $pass .= $chars[rand(0, strlen($chars) - 1)];
    }
    $query = "UPDATE usuario SET password='$pass' WHERE codigo='$codigo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    $users = $this->datos("SELECT * FROM usuario WHERE codigo='$codigo'");
    if (count($users) > 0) {
      $user = $users[0];
      $nombre = $user['nombres'];
      $email = $user['email'];
      $pass = $user['password'];
      $asunto = 'Cambio de password en Mudle';
      $contenido = "Estimado $nombre,\n\nSu nuevo password es: $pass";
      mail($email, $asunto, $contenido);
      echo json_encode($asunto);
    } else {
      echo "Error: usuario con codigo $codigo no encontrado";
    }
  }

  public function get_usuarios() {
    return $this->datos("SELECT * FROM usuario WHERE tipo_usuario>'$this->tipo' ORDER BY apellidos");
  }

  public function get_info_usuario($codigo) {
    return $this->datos("SELECT * FROM usuario WHERE codigo='$codigo' AND tipo_usuario>'$this->tipo'")[0];
  }

  public function get_info_detalle_usuario($codigo) {
    return $this->datos("SELECT * FROM detalle_usuario WHERE codigo='$codigo'");
  }
}

?>
