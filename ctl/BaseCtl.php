<?php

abstract class BaseCtl {
  protected $titulo;
  protected $mdlClass;
  protected $mdlFile;
  protected $vstFile;

  public function __construct($pagina, $titulo) {
    $this->titulo = $titulo;
    $this->mdlClass = $pagina . 'Mdl';
    $this->mdlFile = 'mdl/' . $pagina . 'Mdl.php';
    $this->vstFile = 'vst/' . $pagina . 'Vst.html';
  }

  public function ejecutar() {
    $this->mostrar();
  }

  public function generarHeader() {
    return str_replace('{TITULO}', $this->titulo,
                       file_get_contents('vst/BaseHeaderVst.html')) .
           file_get_contents('vst/BaseMenuVst.html');
  }

  public function generarBody() {
    return file_get_contents($this->vstFile);
  }

  public function generarFooter() {
    return file_get_contents('vst/BaseFooterVst.html');
  }

  public function mostrar() {
    $vst = $this->generarHeader() .
           $this->generarBody() .
           $this->generarFooter();
    echo $vst;
  }
}

?>
