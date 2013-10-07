<?php
	include_once("constantes.php");
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
    <link rel="shortcut icon" href="img/pluma16.png">
    <link rel="apple-touch-icon-precomposed" href="img/pluma128.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/pluma57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/pluma72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/pluma114.png" />

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
  </head>
  <body>
    <!--[if lt IE 7]>
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <div class="main">
      <header>
        <div class="logo">
          <img src="img/pluma64.png" /> Mudle
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
              <form id="cursoNuevo">
                <h1>Alta De Curso Escolar</h1>
                <fieldset>
                  <div>
                    <label for="nombreNuevoCurso">Nombre del curso</label>
                    <br />
                    <input charset="utf-8" id="nombreNuevoCurso" name="nombreNuevoCurso" type="text" />
                  </div>
                  <div>
                    <label for="seccionDeCurso">Sección</label>
                    <br />
                    <input charset="utf-8" id="seccionDeCurso" name="seccionDeCurso" type="text" />
                  </div>
                  <div>
                    <label for="nrcDelCurso">NRC Del Curso</label>
                    <br />
                    <input charset="utf-8" id="nrcDelCurso" name="nrcDelCurso" type="text" />
                  </div>
                  <div>
                    <label for="cicloDelCurso">Ciclo escolar</label>
                    <br />
                    <select id="cicloDelCurso" name="cicloDelCurso">
                      <option id="0" disabled="disabled" selected="selected">-Seleccionar-</option>
                      <option id="1">2014-A</option>
                      <option id="2">2014-B</option>
                      <option id="3">2015-A</option>
                      <option id="4">2015-B</option>
                    </select>
                  </div>
                  <h4>Días De Clase</h4>
                  <div id="contenedorButton">
                    <select id="dia-Semana" name="dia-semana">
                      <option id="0" disabled="disabled" selected="selected">Seleccione un dia</option>
                      <option id="3">Miercoles</option>
                      <option id="4">Jueves</option>
                      <option id="5">Viernes</option>
                      <option id="6">Sabado</option>
                    </select>
                    <select id="horasPorDia" name="horasPorDia">
                      <option id="0" disabled="disabled" selected="selected">Seleccionar Hrs/dia</option>
                      <option id="1">1 Hr</option>
                      <option id="2">2 Hrs</option>
                      <option id="3">3 Hrs</option>
                      <option id="4">4 Hrs</option>
                    </select>
                    <input class="button" id="agregarDiaDeClase" name="agregarDiaDeClase" type="button" value="+" />
                  </div>
                  <div id="contenedorButton">
                    <select id="dia-Semana" name="dia-semana">
                      <option id="0" disabled="disabled" selected="selected">Seleccione un dia</option>
                      <option id="2" selected="selected">Martes</option>
                      <option id="3">Miercoles</option>
                      <option id="4">Jueves</option>
                      <option id="5">Viernes</option>
                      <option id="6">Sabado</option>
                    </select>
                    <select id="horasPorDia" name="horasPorDia">
                      <option id="0" disabled="disabled" selected="selected">Seleccionar Hrs/dia</option>
                      <option id="1" selected="selected">1 Hr</option>
                      <option id="2">2 Hrs</option>
                      <option id="3">3 Hrs</option>
                      <option id="4">4 Hrs</option>
                    </select>
                    <input class="button" id="agregarDiaDeClase" name="agregarDiaDeClase" type="button" value="+" />
                    <input class="button" id="quitarDiaDeClase" name="quitarDiaDeClase" type="button" value="-" />
                  </div>
                  <div id="contenedorButton">
                    <select id="dia-Semana" name="dia-semana">
                      <option id="0" disabled="disabled" selected="selected">Seleccione un dia</option>
                      <option id="1" selected="selected">Lunes</option>
                      <option id="3">Miercoles</option>
                      <option id="4">Jueves</option>
                      <option id="5">Viernes</option>
                      <option id="6">Sabado</option>
                    </select>
                    <select id="horasPorDia" name="horasPorDia">
                      <option id="0" disabled="disabled" selected="selected">Seleccionar Hrs/dia</option>
                      <option id="1">1 Hr</option>
                      <option id="2" selected="selected">2 Hrs</option>
                      <option id="3">3 Hrs</option>
                      <option id="4">4 Hrs</option>
                    </select>
                    <input class="button" id="agregarDiaDeClase" name="agregarDiaDeClase" type="button" value="+" />
                    <input class="button" id="quitarDiaDeClase" name="quitarDiaDeClase" type="button" value="-" />
                  </div>
                  <input class="button" id="guardarCurso" name="guardarCurso" type="button" value="Guardar" />
                  <input class="button" id="cancelar" name="cancelar" type="button" value="Cancelar" />
                </fieldset>
              </form>
            </article>
          </section>
        </div>
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
