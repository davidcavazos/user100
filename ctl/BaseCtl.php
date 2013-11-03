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
    //$this->amigableUrl();
  }

  public function amigableUrl() {
    $server = $_SERVER['SERVER_NAME'];       /** localhost **/
    $script = $_SERVER['PHP_SELF'];          /** /user100-ex2/index.php **/
    $variables = $_SERVER['QUERY_STRING'];   /** ctl ... **/
    $delimitador = '/';

    $estaProcesado = preg_match('/^\/\w+(-\w+)?\/(\w+)?(\/\w+)*$/', $_SERVER['REQUEST_URI']);
      /** /user100/ o /user100-1/ o /user100-11/
          /user100-ex2/ o /user100-ex2/1
          /user100-ex2/ciclos o /user100-ex2/usuarios/act/display
      **/
    if ( !empty($variables) && $estaProcesado!=1 ) {
      $variables = preg_replace('/\//', '', $variables); /** ctl=ciclos/  =  ctl=ciclos **/
      $variables = preg_replace('/(=|&)/', $delimitador, $variables); /** ctl=ciclos&altas  =  ctl/ciclos/altas **/
      $variables = preg_replace('/ctl(\/){0,1}/', '', $variables); /** elimino ctl (es un directorio) **/
      $aVariables = explode('/', $variables); /** array([0]-> [1]->ciclos [2]->altas) **/
      print_r($aVariables);
      $variables = '';
      for ($i=0; $i < count($aVariables); $i++) {
        $variables .= $delimitador . $aVariables[$i];
      }

      $script = preg_replace('/\/index.php/', '', $script);
      $url = 'http://' . $server . $script . $variables;
      header('location: ' . $url);
      exit;
    }
  }

  protected function campo($field, $value, $body) {
    return str_replace('name="' . $field . '"', 'name="' . $field .
                       '" value="' . $value . '"', $body);
  }
}

?>
