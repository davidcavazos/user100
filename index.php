<?php
//mail("stefhan.rodriguez@hotmail.com", "D:", "enviado desde PHP ;)");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$tipo = $_SESSION['tipo'];

$pag = '';
if (isset($_GET['ctl'])) {
  switch (htmlspecialchars($_GET['ctl'])) {
    case 'mis_cursos':
      if ($tipo == -1 || $tipo == 1 || $tipo == 2) {
        $pag = 'mis_cursos';
      }
      break;
    case 'evaluacion':
      if ($tipo == -1 || $tipo == 1 || $tipo == 2) {
        $pag = 'evaluacion';
      }
      break;
    case 'asistencias':
      if ($tipo == -1 || $tipo == 1 || $tipo == 2) {
        $pag = 'asistencias';
      }
      break;
    case 'ciclos':
      if ($tipo == -1 || $tipo == 0) {
        $pag = 'ciclos';
      }
      break;
    case 'usuarios':
      if ($tipo == -1 || $tipo == 0 || $tipo == 1) {
        $pag = 'usuarios';
      }
      break;
    case 'recuperar_password':
      $pag = 'recuperar_password';
      break;
  }
}

// pagina default
if ($pag == '') {
  switch ($tipo) {
    case -1: // root
      $pag = 'mis_cursos';
      break;
    case 0:  // admin
      $pag = 'usuarios';
      break;
    case 1:  // maestro
      $pag = 'mis_cursos';
      break;
    case 2:  // alumno
      $pag = 'mis_cursos';
      break;
    default:
      $pag = 'mis_cursos';
  }
}

$ctl;
switch ($pag) {
  case 'mis_cursos':
    require_once('ctl/MisCursosCtl.php');
    $ctl = new MisCursosCtl('MisCursos', 'Mis Cursos');
    break;
  case 'evaluacion':
    require_once('ctl/EvaluacionCtl.php');
    $ctl = new EvaluacionCtl('Evaluacion', 'Evaluacion');
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
}
$ctl->ejecutar();

?>
