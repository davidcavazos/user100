<?php

require_once('ctl/BaseCtl.php');
class RecuperarPasswordCtl extends BaseCtl {
  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
           '<div class="login">';
  }
}

?>
