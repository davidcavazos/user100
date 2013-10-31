<?php

abstract class BaseCtl {
  protected $titulo;
  protected $vstFile;

  public function __construct($pagina, $titulo) {
    $this->titulo = $titulo;
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
    //phpinfo(INFO_MODULE);
    $this->amigableUrl();
  }

  public function amigableUrl() {
    $server = $_SERVER['SERVER_NAME'];       /** localhost **/
    $script = $_SERVER['PHP_SELF'];          /** /user100-ex2/index.php **/
    $variables = $_SERVER['QUERY_STRING'];   /** ctl ... **/
    $delimitador = '/';

    /** $_SESSION, session_name() y session_start() evitan un bucle infinita de redireccionamiento **/
    $_SESSION['bucle'] = 0;
    session_name('url_a');
    session_start();
    
    if ( !empty($variables) && $_SERVER['REQUEST_METHOD']=='GET' && $_SESSION['bucle']!=1) { 
    //if ( !empty($variables) && $_SERVER['REQUEST_METHOD']=='GET' ) { 
      $variables = preg_replace('/\//', '', $variables); /** ctl=ciclos/  =  ctl=ciclos**/
      $variables = preg_replace('/(=|&)/', $delimitador, $variables); /** ctl=ciclos&altas  =  ctl/ciclos/altas**/
      $variables = preg_replace('/ctl(\/){0,1}/', '', $variables); /**ctl proboca conflicto de redireccionamiento (bucle)**/
      $aVariables = explode('/', $variables); /** array([0]->ctl [1]->ciclos [2]->altas) **/

      $variables = ''; 
      for ($i=0; $i < count($aVariables); $i++) { 
        $variables .= $delimitador . $aVariables[$i]; 
      } 

      $script = preg_replace('/\/index.php/', '', $script); 
      $url = 'http://' . $server . $script . $variables; 
      print_r($url); 
      $_SESSION['bucle'] = 1;
      //header('location: ' . $url);
      exit;
    }
  }

  protected function campo($field, $value, $body) {
    return str_replace('name="' . $field . '"', 'name="' . $field .
                       '" value="' . $value . '"', $body);
  }
}

?>
