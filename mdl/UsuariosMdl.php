<?php

require_once('mdl/BaseMdl.php');
class UsuariosMdl extends BaseMdl {
  public function agregar($codigo, $nombres, $apellidos, $password, $tipo,
                          $carrera, $email, $activo) {
    $query =
      "INSERT INTO usuario
       (codigo, nombres, apellidos, password, tipo, carrera, email, activo)
       VALUES (
         \"$codigo\",
         \"$nombres\",
         \"$apellidos\",
         \"$password\",
         \"$tipo\",
         \"$carrera\",
         \"$email\",
         \"$activo\"
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      return FALSE;
    }
    return $this->driver->insert_id;
  }
}

?>
