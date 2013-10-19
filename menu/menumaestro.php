<?php 
	$host="http://localhost/user100/";
        //$host="http://alanturing.cucei.udg.mx/cc409/user100/";
?>
<style type="text/css">
      ul {
        margin: 0px;
        padding-bottom: 10px;
      }
      ul li {
        font: bold 12px/18px sans-serif;
        display: inline-block;
        position: relative;
        padding-top: 5px;
        padding-bottom: 5px;
        margin: 0;
        cursor: pointer;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -ms-transition: all 0.2s;
        -o-transition: all 0.2s;
        transition: all 0.2s;
      }
      ul li:hover {
        background: #DFDFDF;
        padding-left: 0;
      }
      ul li ul {
        background: #9E9A9A;
        display: none;
        padding: 0;
        position: absolute;
        top: 25px;
        left: -4px;
        width: 150px;
        -webkit-box-shadow: 0 0 15px #ccc;
        -moz-box-shadow: 0 0 15px #ccc;
        box-shadow: 0 0 15px #ccc;
        visibility: hidden;
        -webkit-transiton: opacity 0.2s;
        -moz-transition: opacity 0.2s;
        -ms-transition: opacity 0.2s;
        -o-transition: opacity 0.2s;
        -transition: opacity 0.2s;
      }
      ul li ul li {  
        color: #fff;
        display: block;
        float: none;
        text-shadow: 0 -1px 0 #000;
      }
      ul li ul li:hover { background: #666; }
      ul li:hover ul {
        display: block;
        visibility: visible;
      }
    </style>

<nav>
	<ul>
          <li><a href="<?php echo $host?>index.php">Resumen</a></li>
          <li><a href="<?php echo $host?>calificaciones/calificaciones.php">Calificaciones</a></li>
          <li><a href="<?php echo $host?>asistencias/asistencias.php">Asistencias</a></li>
          <li>
		<a href="#">Ciclos</a>
		<ul>
			<li><a href="<?php echo $host?>ciclos/listadeciclos.php">Lista</a></li>
			<li><a href="<?php echo $host?>ciclos/nuevociclo.php">Nuevo</a></li>	
			<li><a href="<?php echo $host?>ciclos/modificarciclo.php">Modificar</a></li>
		</ul>
	  </li>
          <li>
		<a href="#">Cursos</a>
	  	<ul>
			<li><a href="<?php echo $host?>cursos/listadecursos.php">Lista</a></li>
			<li><a href="<?php echo $host?>cursos/nuevocurso.php">Nuevo</a></li>	
			<li><a href="<?php echo $host?>cursos/cursodeprofesor.php">Mis cursos</a></li>	
		</ul>
          </li>
	  <li>
		<a href="#">Alumnos</a>
		<ul>
			<li><a href="<?php echo $host?>alumnos/registrar.php">Registrar</a></li>
			<li><a href="<?php echo $host?>alumnos/cargararchivo.php">Cargar Archivo</a></li>	
			<li><a href="<?php echo $host?>alumnos/modificaralumno.php">Agregar a curso</a></li>	
		</ul>
	  </li>
          <div class="clear"></div>
        </ul>
        <hr />
</nav>

