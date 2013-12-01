<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require_once('mdl/BaseMdl.php');
class LoginMdl extends BaseMdl
{
  public function verificar($codigo, $password)
  {
    $q = $this->datos("SELECT * FROM usuario WHERE codigo='".$codigo."'");
    if(count($q) > 0 && $q[0]['password']==$password)
    {
      $_SESSION['user'] = $q[0]['nombres'];
      $_SESSION['tipo'] = $q[0]['tipo_usuario'];
      header('Location:index.php?ctl=mis_cursos');
      die();
    }
    else
    {
      return false;
    }
  }
}

?>
