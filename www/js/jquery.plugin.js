/*! Por recomendacion. Evita errores por el mal cierre de scripts */
/*!
 * función anónima que nos asegura que el símbolo $ 
 * sea del objeto jQuery, en caso que este sea usado como objeto por otras bibliotecas.
 * Uso como parámetro la variable windows para ahorrar tiempo de búsqueda de objetos globales.
 * Uso del parámetro undefined para asegurar que la variable es no definida.
 */
/*! Por recomendacion. Evita errores por el mal cierre de scripts */
/*!
 * función anónima que nos asegura que el símbolo $ 
 * sea del objeto jQuery, en caso que este sea usado como objeto por otras bibliotecas.
 * Uso como parámetro la variable windows para ahorrar tiempo de búsqueda de objetos globales.
 * Uso del parámetro undefined para asegurar que la variable es no definida.
 */
var numeroDeDiasFestivos=10;
var numeroDeDiasFestivosM=0;
(function( $, window, undefined ) {
  var DIAS_MAXIMOS = 7;
  $.fn.agregaDiaFestivo = function(contenedor) {
	var contenedorDiasFestivos = contenedor,
        contenedorDiasFestivos;

    // Uso de encadenamiento
    return this.each(function() { 
      $boton = $(this); 
      $boton.on('click', function () { 
		$("#guardar").removeAttr("disabled");
        if ( $('.content').size() < DIAS_MAXIMOS ) { 
          numeroDeDiasFestivos++;
      $( contenedorDiasFestivos ).append( 
            '<div id="div_festivos'+numeroDeDiasFestivos+'" class="content">'+ 
              '<input id="inicio_'
			  +numeroDeDiasFestivos+
			  '" type="text" placeholder="aaaa-mm-dd" onblur="validaFecha(\'inicio_'
			  +numeroDeDiasFestivos+
			  '\')"/>'+

              '<textarea id="descripcion_'+numeroDeDiasFestivos+'" onblur="validaDescripcion(\'descripcion_'+numeroDeDiasFestivos+'\')"></textarea>'+ 
              '<button class="quitarFestivo">-</button>'+ 
            '</div>');  
        }; 
      }); 
      $('body').on('click', '.quitarFestivo', function () { 
        $(this).parent().remove(); 
      }); 
    }); 
  } 
  $.fn.limpiarFestivo = function () {
    return this.each(function() { 
      $boton = $(this);
      $boton.on('click', function () { 
        $('.content').remove(); 
      });
    });
  } 
  $.fn.agregaDiaFestivom = function(contenedor) {
    return this.each(function () {
      $(this).on('click', function(){
        if($('.content').size() < DIAS_MAXIMOS) {
          numeroDeDiasFestivosM++;
          $( contenedor ).append( 
            '<div id="div_festivos'+numeroDeDiasFestivosM+'" class="content">'+ 
              '<input id="inicio_m_'
			  +numeroDeDiasFestivosM+
			  '" type="text" placeholder="aaaa-mm-dd" onblur="validaFecha(\'inicio_m_'
			  +numeroDeDiasFestivosM+
			  '\')"/>'+

              '<textarea id="descripcion_m_'+numeroDeDiasFestivosM+'" onblur="validaDescripcion(\'descripcion_m_'+numeroDeDiasFestivosM+'\')"></textarea>'+ 
              '<button class="quitarFestivo">-</button>'+ 
            '</div>'); 
        }
        $('body').on('click', '.quitarFestivo', function () { 
          $(this).parent().remove(); 
        });
      });
    });
  }
})( jQuery, window ); 

