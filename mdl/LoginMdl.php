<?php

require_once('mdl/BaseMdl.php');
class LoginMdl extends BaseMdl
{
  public function verificar($codigo, $password)
  {
    $q = $this->datos("SELECT * FROM usuario WHERE codigo='".$codigo."'");
    if(count($q) > 0 && $q[0]['password']==$password)
    {
      //header('Location:index.php?ctl=mis_cursos');
      header('Location:index.php');
      die();
    }
    else
    {
      return false;
    }
  }
}

?>
