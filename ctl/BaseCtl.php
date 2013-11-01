<?php

abstract class BaseCtl {
  protected $titulo;
  protected $vstFile;
  protected $onload_fcn;

  public function __construct($pagina, $titulo) {
    $this->titulo = $titulo;
    $this->vstFile = 'vst/' . $pagina . 'Vst.html';
    $onload_fcn = '';
  }

  public function ejecutar() {
    $this->mostrar();
  }

  public function generarHeader() {
    $head = file_get_contents('vst/BaseHeaderVst.html');
    $head = str_replace('{TITULO}', $this->titulo, $head);
    if ($this->onload_fcn == '') {
      $head = str_replace(' {ONLOAD}', '', $head);
    } else {
      $head = str_replace('{ONLOAD}', "onload='$this->onload_fcn'", $head);
    }
    $head .= file_get_contents('vst/BaseMenuVst.html');
    return $head;
  }

  public function generarBody() {
    return file_get_contents($this->vstFile);
  }

  public function generarFooter() {
    return file_get_contents('vst/BaseFooterVst.html');
  }

  public function mostrar() {
    $body = $this->generarBody();
    $header = $this->generarHeader();
    $footer = $this->generarFooter();
    echo $header . $body . $footer;
  }

  protected function campo($field, $value, $body) {
    return str_replace('name="' . $field . '"', 'name="' . $field .
                       '" value="' . $value . '"', $body);
  }
}

?>
