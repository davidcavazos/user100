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
    <title>Mudle - Registrar</title>
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
	?>      <article>
        <form action="index.html" method="POST" id="registroAlumno">
          <h1>Registrar Nuevo Alumno</h1>
          <fieldset>
            <!--Codigo-->
            <div class="logon-field">
              <label for="input-content">Codigo</label>
              <div class="input-content">
                <input charset="UTF-8" id="codigo" name="codigo" placeholder="Codigo" type="text" onblur="analiza('codigo','^[0-9]{9}$')" />
              </div>
            </div>
              <!--Nombre-->
            <div class="logon-field">
              <label for="input-content">Nombre(s)</label>
              <div class="input-content">
                <input charset="UTF-8" id="nombre" name="nombre" placeholder="Nombre(s)" type="text" onblur="analiza('nombre','^[ a-zA-Z]{3,}$')"/>
              </div>
            </div>
            <!--Apellido-->
            <div class="logon-field">
              <label for="input-content">Apellidos</label>
              <div class="input-content">
                <input charset="UTF-8" id="apellido" name="apellido" placeholder="Apellidos" type="text" onblur="analiza('apellido','^[ a-zA-Z]{3,}$')"/>
              </div>
            </div>
            <!--E-mail-->
            <div class="logon-field">
              <label for="input-content">Email</label>
              <div class="input-content">
                <input charset="UTF-8" id="email" name="email" placeholder="E-mail" type="text" onblur="analiza('email','^[a-zA-Z0-9]{1,}@[a-zA-Z]{1,}.[a-zA-Z]{1,}$')"/>
              </div>
            </div>
            <!--Carrera-->
            <label for="input-content">Carrera</label></br>
            <select id="carreras" name="carreras" onblur="analizaCombo('carreras')" onchange="analizaCombo('carreras')">
              <option value="com"  id="0">---Seleccionar---</option>
              <option value="com"  id="1">Ing. en Computacion</option>
              <option value="inf"  id="2">Lic. en Informatica</option>
              <option value="qui"  id="3">Lic. en Quimica</option>
              <option value="come" id="4">Ing. en Comunicaciones y Electronica</option>
            </select>
            </br>
            </br>
            </br>

	    <input type="file" id="files" name="files[]" multiple />
		<output id="list"></output>

		<script>
		  function handleFileSelect(evt) {
		    var files = evt.target.files; // FileList object

		    // files is a FileList of File objects. List some properties.
		    var output = [];
		    for (var i = 0, f; f = files[i]; i++) {
		      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
				  f.size, ' bytes, last modified: ',
				  f.lastModifiedDate.toLocaleDateString(), '</li>');
		    }
		    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
		  }

		  document.getElementById('files').addEventListener('change', handleFileSelect, false);
		</script>	
		</br>
            <input class="button" id="registrar" name="registrar" value="Registrar" type="button" onclick="validarCampos('registroAlumno')" /> 
          </fieldset>
        </form>
      </article>
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
