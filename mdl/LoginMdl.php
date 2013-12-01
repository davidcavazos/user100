<?php

require_once('mdl/BaseMdl.php');
class LoginMdl extends BaseMdl
{
  public function verificar($codigo, $password)
  {
    $q = $this->datos("SELECT * FROM usuario WHERE codigo='".$codigo."'");
    if(count($q) > 0 && $q[0]['password']==$password)
    {
      $_SESSION['user'] = $q[0]['nombres'];
      $_SESSION['tipo'] = $q[0]['tipo_usuario'];
      switch ($_SESSION['tipo']) {
        case -1: // root
          header('Location:index.php?ctl=mis_cursos');
          die();
          break;
        case 0:  // admin
          header('Location:index.php?ctl=usuarios');
          die();
          break;
        case 1:  // maestro
          header('Location:index.php?ctl=mis_cursos');
          die();
          break;
        case 2:  // alumno
          header('Location:index.php?ctl=evaluacion');
          die();
          break;
        default:
          echo 'Error: Tipo de usuario invalido';
          die();
      }
    }
    else
    {
      return false;
    }
  }
}

?>
