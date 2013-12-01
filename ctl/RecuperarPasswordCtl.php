<?php

require_once('ctl/BaseCtl.php');
class RecuperarPasswordCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();
    if (isset($_POST['recuperar'])) {
      $codigo = $_POST['codigo'];
      $mdl->asignar_password($codigo);
    } elseif (isset($_GET['error'])) {
      $header = $this->generarHeader();
      $error = 'Codigo no registrado';
      $body = file_get_contents('vst/RecuperarPasswordVst.html');
      $body = str_replace('none', 'block', $body);
      $body = str_replace("{AVISO}" ,$error, $body);
      $footer = $this->generarFooter();
      echo $header . $body . $footer;
    } elseif (isset($_GET['success'])) {
      $header = $this->generarHeader();
      $error = 'Correo enviado!';
      $body = file_get_contents('vst/RecuperarPasswordVst.html');
      $body = str_replace('class="error"', 'class="success"', $body);
      $body = str_replace('none', 'block', $body);
      $body = str_replace("{AVISO}" ,$error, $body);
      $footer = $this->generarFooter();
      echo $header . $body . $footer;
    } else {
      $this->mostrar();
    }
  }

  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
                       '<div class="login">';
  }

  public function mostrar() {
    $body = $this->generarBody();
    $header = $this->generarHeader();
    $footer = $this->generarFooter();
    echo $header . $body . $footer;
    //$this->amigableUrl();
  }
}

?>
