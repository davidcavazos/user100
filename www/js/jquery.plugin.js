/*! Por recomendacion. Evita errores por el mal cierre de scripts */
/*!
 * función anónima que nos asegura que el símbolo $ 
 * sea del objeto jQuery, en caso que este sea usado como objeto por otras bibliotecas.
 * Uso como parámetro la variable windows para ahorrar tiempo de búsqueda de objetos globales.
 * Uso del parámetro undefined para asegurar que la variable es no definida.
 */
var numeroDeDiasFestivos=10;
var numeroDeDiasFestivosM=0;
var id_horario=0;
var idnCExtra=0;
(function( $, window, undefined ) {
  var DIAS_MAXIMOS = 7,
      DIAS_MAXIMOS_CLASE = 7;
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
  $.fn.agregaDiaDeClase = function(contenedor) {
    var id, ndia;
    // Uso de encadenamiento
    return this.each(function() { 
      $boton = $(this); 
      $boton.on('click', function () { 
      $("#guardar").removeAttr("disabled");
        if ( $('.content').size() < DIAS_MAXIMOS_CLASE ) { 
          id_horario++;
          $( contenedor ).append( 
            '<div id="cClase_'+id_horario+'" class="content">'+ 
              '<select id="SelectDia_'+id_horario+'" name="dia_'+id_horario+'"></select><br />'+
              '<input id="Hora_inicio_clase'+id_horario+'" type="text" placeholder="Hora inicio clase" />'+
              '<input id="Hora_fin_clase'+id_horario+'" type="text" placeholder="Hora fin clase" />'+
              '<button class="quitarDia">-</button>'+ 
            '</div>');
          for (i=0; i<6; i++) {
            switch(i) {
              case 0: ndia='Lunes';break;
              case 1: ndia='Martes';break;
              case 2: ndia='Miercoles';break;
              case 3: ndia='Jueves';break;
              case 4: ndia='Viernes';break;
              case 5: ndia='Sabado';break;
            }
            $('#SelectDia_'+id_horario).append('<option id="dia_'+i+'">'+ndia+'</option>');
          }
        }; 
      }); 
      $('body').on('click', '.quitarDia', function () { 
        $(this).parent().remove(); 
      }); 
    }); 
  } 
  $.fn.agregaCampoE = function(contenedor) {
    return this.each(function(){
      $(this).on('click', function () {
        idnCExtra++;
        $(contenedor).append(
          '<div id="c_E'+idnCExtra+'" class="content">'+
            '<input id="campoExtraTipo_'+idnCExtra+'" name="campoExtraTipo_'+idnCExtra+'" type="text" placeholder="tipo de cuenta" style="width:55%" />'+
            '<button class="quitar">-</button>'+
            '<input id="campoExtra_"'+idnCExtra+' name="campoExtra_'+idnCExtra+'" type="text" placeholder="Nombre de cuenta" />'+
            '<button class="quitar">-</button>'+
          '</div>');
      });
      $('body').on('click', '.quitar', function () { 
        $(this).parent().remove(); 
      });
    });
  }
  $.fn.datePickerElem = function() {
    return this.each(function(){
      $(this).datepicker({
        clearText: 'Borrar',
        clearStatus: 'Borrar fecha actual',
        closeText: 'Cerrar',
        closeStatus: 'Cerrar sin guardar',
        dateFormat: 'yy-mm-dd',
        dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi', 'Sa'],
        firstDay: 0,
        inline: true,
        monthNames: ['Enero','Febrero','Marzo','Abril',
                    'Mayo','Junio','Julio','Agosto',
                    'Septienbre','Octubre','Novienbre','Diciembre'],
        monthNameShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        prevStatus: 'Mostrar mes anterior', 
        prevBigStatus: 'Mostrar año anterior',
        selectOtherMonths: true,
        showOtherMonths: true,
        showWeek: true
      });
    })
  }
})( jQuery, window ); 
