<?php
	include_once("../archivosphp/constantes.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Mudle - Resumen</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="../img/pluma16.png">
    <link rel="apple-touch-icon-precomposed" href="../img/pluma128.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../img/pluma57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/pluma72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/pluma114.png" />

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <div class="main">
      <header>
        <div class="logo">
          <img src="../img/pluma64.png" /> Mudle
        </div>
        <div class="datos">
          <p>Nombre Usuario</p>
          <a href="#">Perfil</a> |
          <a href="#">Logout</a>
        </div>
        <div class="clear"></div>
      </header>

      <?php
		include_once(MENUMAESTRO)
	?>        
	<section>
          <article>
            <select>
               <option selected="selected">Cursados</option>
               <option>No Cursados</option>
            </select>
	    <h3>Materia:&lt;nombre&gt; - Alumnos</h3>
            <table class="modificarAlumnos">
              <thead>
                <tr>
                  <th>Select Item</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Curso</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input id="seleccionarAlumno" name="seleccionarAlumno" type="checkbox" checked="checked" />
                  </td>
                  <td>210224667</td>
                  <td>Gustavo Rodrigo Guillen Villarreal</td>
                  <td>
                    <select>
                      <option selected="selected">Programacion WEB D03</option>
                      <option>Programacion WEB D04</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input id="seleccionarAlumno" name="seleccionarAlumno" type="checkbox" checked="checked" />
                  </td>
                  <td>210224669</td>
                  <td>David Cavazos Woo</td>
                  <td>
                    <select>
                      <option>Programacion WEB D03</option>
                      <option selected="selected">Programacion WEB D04</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input id="seleccionarAlumno" name="seleccionarAlumno" type="checkbox" />
                  </td>
                  <td>210224669</td>
                  <td>Stefan Rodriguez</td>
                  <td>
                    <select>
                      <option>Programacion WEB D03</option>
                      <option selected="selected">Programacion WEB D04</option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
            <br />
            <div id="contenedorButton">
              
	      <input class="button" id="agregarCambios" name="agregarCambios" type="button" value="Agregar" />
              <input class="button" id="eliminarAlumno" name="eliminarAlumno" type="button" value="Eliminar" />
              <input class="button" id="cancelarModificacion" name="cancelarModificacion" type="button" value="Cancelar" />
            </div>
          </article>
        </section>
    </div>

    <footer>Copyright - About us</footer>

    <!-- asdf
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    -->
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <!--
    <script>
      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
    -->
  </body>
</html>
