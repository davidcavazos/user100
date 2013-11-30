<?php

// Definicion de funciones
function generarHeader() {
  return str_replace('{TITULO}', 'Login',
                     file_get_contents('vst/BaseHeaderVst.html')) .
         '<div class="login">';
}

function generarBodyE()
{
  $error= "Usuario o Contraseña erroneo";
  $body =  file_get_contents('vst/LoginVst.html');
  $body = str_replace("none","block",$body);
  $body = str_replace("{AVISO}",$error,$body);
  return $body;
}

function generarBody() {
  return file_get_contents('vst/LoginVst.html');
}

function generarFooter() {
  return file_get_contents('vst/BaseFooterVst.html');
}

function limpiarVariablesPost()
{
  if(isset($_POST))
  {
    foreach ($_POST as $key => $input_arr)
    {
      unset($_POST[$key]);
    }
  }
}

// Ejecutar
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  setcookie(session_name(), '', time()-3600);
  header('Location:login.php');
  die();
}

if (isset($_SESSION['user'])) {
  header('Location:index.php?mis_cursos');
  die();
}

require_once('mdl/LoginMdl.php');
$mdl = new LoginMdl();
if(isset($_POST['login']))
{
  $codigo = $_POST['login'];
  $password = $_POST['password'];
  limpiarVariablesPost();
  if(!$mdl->verificar($codigo, $password))
  {
    echo generarHeader() .
         generarBodyE() .
         generarFooter();
  }
}
else
{
  echo generarHeader() .
       generarBody() .
       generarFooter();
}

?>
