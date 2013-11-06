<?php

require_once('mdl/BaseMdl.php');
class LoginMdl extends BaseMdl
{
  public function verificar($codigo, $password)
  {
    $datos = $this->datos("SELECT * FROM usuario WHERE codigo='".$codigo."'")[0];
    if($datos['password']==$password)
    {
      header('Location: index.php?ctl=mis_cursos');
    }
    else
    {
      return false;
    }
  }
}

?>
