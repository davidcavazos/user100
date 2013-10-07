<?php 
	$host="http://localhost/user100/";
        //$host="http://alanturing.cucei.udg.mx/cc409/user100/";
?>
<nav>
	<ul>
          <li><a href="index.php">Resumen</a></li>
          <li><a href="<?php echo $host?>calificaciones/calificaciones.php">Calificaciones</a></li>
          <li><a href="<?php echo $host?>asistencias/asistencias.php">Asistencias</a></li>
          <li><a href="<?php echo $host?>cursos/cursodeprofesor.php">Cursos</a></li>
          <li><a href="<?php echo $host?>cursos/nuevocurso.php">Alta Curso</a></li>
          <div class="clear"></div>
        </ul>
        <hr />
</nav>

