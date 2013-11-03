;/*! Por recomendacion. Evita errores por el mal cierre de scripts */
/*!
 * función anónima que nos asegura que el símbolo $ 
 * sea del objeto jQuery, en caso que este sea usado como objeto por otras bibliotecas.
 * Uso como parámetro la variable windows para ahorrar tiempo de búsqueda de objetos globales.
 * Uso del parámetro undefined para asegurar que la variable es no definida.
 */
(function( $, window, undefined ) {
  $.fn.agregaDiaFestivo = function(contenedor) {
    var contenedorDiasFestivos = contenedor,
        numeroDeDiasFestivos = 1,
        DIAS_MAXIMOS = 7,
        contenedorDiasFestivos;

    // Uso de encadenamiento
    return this.each(function() { 
      $boton = $(this); 
      $boton.on('click', function () { 
        if ( $('.content').size() < DIAS_MAXIMOS ) { 
          $( contenedorDiasFestivos ).append( 
            '<div id="iwcf'+numeroDeDiasFestivos+'" class="content">'+ 
              '<input class="ifecha" id="inicio_'+numeroDeDiasFestivos+'" type="text" placeholder="aaaa-mm-dd" />'+ 
              '<input class="ifecha" id="fin_'+numeroDeDiasFestivos+'" type="text" placeholder="aaaa-mm-dd" />'+ 
              '<textarea class="idescripcion" id="descripcion_'+numeroDeDiasFestivos+'"></textarea>'+ 
              '<button class="quitarFestivo">-</button>'+ 
            '</div>'); 
          numeroDeDiasFestivos++; 
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
})( jQuery, window ); 
