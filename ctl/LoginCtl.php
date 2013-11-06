<?php

require_once('ctl/BaseCtl.php');
class LoginCtl extends BaseCtl {

  public function ejecutar()
  {
    require_once("mdl/LoginMdl.php");
    $mdl = new LoginMdl();
    if(isset($_POST['login']))
    {
      $codigo = $_POST['login'];
      $password = $_POST['password'];
      $this->limpiarVariablesPost();
      if(!$mdl -> verificar($codigo, $password))
      {
        echo $this->generarHeader() .
             $this->generarBodyE() .
             $this->generarFooter();
      }
    }
    else
    {
      $this->mostrar();
    }
  }


  public function generarBodyE()
  {
    $error= "Usuario o Contraseña erroneo";
    $body =  file_get_contents($this->vstFile);
    $body = str_replace("none","block",$body);
    $body = str_replace("{AVISO}",$error,$body);
    return $body;
  }

  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
           '<div class="login">';
  }

}

?>
