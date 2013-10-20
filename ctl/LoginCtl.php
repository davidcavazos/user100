<?php

require_once('ctl/BaseCtl.php');
class LoginCtl extends BaseCtl {
  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
           '<div class="login">';
  }

  public function generarBody() {
    return file_get_contents($this->vstFile);
  }
}

?>
