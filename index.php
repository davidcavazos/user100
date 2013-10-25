<?php
//mail("stefhan.rodriguez@hotmail.com", "D:", "enviado desde PHP ;)");

switch (htmlspecialchars($_GET['ctl'])) {
  case 'mis_cursos':
    require_once('ctl/MisCursosCtl.php');
    $ctl = new MisCursosCtl('MisCursos', 'Mis Cursos');
    break;
  case 'asistencias':
    require_once('ctl/AsistenciasCtl.php');
    $ctl = new AsistenciasCtl('Asistencias', 'Asistencias');
    break;
  case 'ciclos':
    require_once('ctl/CiclosCtl.php');
    $ctl = new CiclosCtl('Ciclos', 'Ciclos');
    break;
  case 'usuarios':
    require_once('ctl/UsuariosCtl.php');
    $ctl = new UsuariosCtl('Usuarios', 'Usuarios');
    break;
  case 'recuperar_password':
    require_once('ctl/RecuperarPasswordCtl.php');
    $ctl = new RecuperarPasswordCtl('RecuperarPassword', 'Recuperar Contrase&ntilde;a');
    break;
  case 'login':
  default:
    require_once('ctl/LoginCtl.php');
    $ctl = new LoginCtl('Login', 'Login');
    break;
}

$ctl->ejecutar();

?>
