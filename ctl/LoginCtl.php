<?php

require_once('ctl/BaseCtl.php');
class LoginCtl extends BaseCtl {
  
  public function ejecutar()
  {
  	require_once("mdl/LoginMdl.php");
	$mdl = new LoginMdl();
	if(isset($_POST['password']))
	{
		$codigo = $_POST['codigo'];
		$password = $_POST['password'];
		$mdl -> verificar($codigo, $password);
	}
	else
	{
		$this->mostrar();
	}
  }

  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
           '<div class="login">';
  }
}

?>
