<?php

class LoginCtl {
  public function ejecutar() {
    require_once('mdl/LoginMdl.php');
    $mdl = new LoginMdl();
    $vst = file_get_contents('vst/LoginVst.html');
    echo $vst;
  }
}

?>
