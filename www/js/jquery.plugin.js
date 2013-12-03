/*! Por recomendacion. Evita errores por el mal cierre de scripts */
/*!
 * función anónima que nos asegura que el símbolo $ 
 * sea del objeto jQuery, en caso que este sea usado como objeto por otras bibliotecas.
 * Uso como parámetro la variable windows para ahorrar tiempo de búsqueda de objetos globales.
 * Uso del parámetro undefined para asegurar que la variable es no definida.
 */
var numeroDeDiasFestivos=0;
var numeroDeDiasFestivosM=0;
var id_horario=0;
var id_horario_m=0;
var idnCExtra=0;
var rubro = 0;
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
              '<input id="inicio_'+numeroDeDiasFestivos+
                  '" type="text" placeholder="aaaa-mm-dd" onblur="validaFecha(\'inicio_'
                  +numeroDeDiasFestivos+'\')"/>'+
              '<textarea id="descripcion_'+numeroDeDiasFestivos+
                  '" onblur="validaDescripcion(\'descripcion_'
                  +numeroDeDiasFestivos+'\')"></textarea>'+ 
              '<button class="quitarFestivo">-</button>'+ 
            '</div>');  
          $('body').eliminarElemento();
          $('#inicio_'+numeroDeDiasFestivos).datePickerElem();
        }; 
      }); 
    }); 
  } 
  $.fn.agregaDiaFestivom = function(contenedor) {
    return this.each(function () {
      $(this).on('click', function(){
        if($('.content').size() < DIAS_MAXIMOS) {
          numeroDeDiasFestivosM++;
          $( contenedor ).append( 
            '<div id="div_festivos' +numeroDeDiasFestivosM+'_m" class="content">'+ 
              '<input id="inicio_m_' +numeroDeDiasFestivosM+
                  '" type="text" placeholder="aaaa-mm-dd" onblur="validaFecha(\'inicio_m_'
                  +numeroDeDiasFestivosM+'\')"/>'+
              '<textarea id="descripcion_m_'+numeroDeDiasFestivosM+
                  '" onblur="validaDescripcion(\'descripcion_m_'
                  +numeroDeDiasFestivosM+'\')"></textarea>'+ 
              '<button class="quitarFestivo">-</button>'+ 
            '</div>'); 
          $('body').eliminarElemento();
          $('#inicio_m_'+numeroDeDiasFestivosM).datePickerElem();
        }
      });
    });
  }
  $.fn.eliminarElemento = function () {
    return this.each( function () {
      $('body').on('click', '.quitarFestivo', function () {
        var elem = ($(this).parent().attr('id'));
        $('#'+elem).remove();
        enable_button('guardar');
      });
    });
  }
  $.fn.agregaDiaDeClase = function(contenedor) { 
    var ndia=0, c, id_horario_f;
    return this.each(function() { 
      $(this).on('click', function () { 
        c = $(this).siblings( contenedor ).attr('id'); 
        if ( c.lastIndexOf('_m') == -1 ) { p = ''; } else { p = '_m' } 
        $("#guardar").removeAttr("disabled");
        if ( $('.content').size() < DIAS_MAXIMOS_CLASE ) { 
          if ( c == 'wrapper_m' ) {
            id_horario_m++;
            id_horario_f = id_horario_m;
          } else if (c == 'wrapper') {
            id_horario++;
            id_horario_f = id_horario;
          }
          $( '#' + c ).append( 
            '<div id="cClase'+p+'_'+id_horario_f+'" class="content">'+ 
              '<select id="SelectDia'+p+'_'+id_horario_f+'" name="dia'+p+'_'+id_horario_f+'"></select><br />'+
              '<input id="Hora_inicio_clase'+p+'_'+id_horario_f+'" type="text" placeholder="Hora inicio clase" onblur="validaHora(\'Hora_inicio_clase'+p+'_'+id_horario_f+'\')"/>'+
              '<input id="duracion_'+p+'_'+id_horario_f+'" type="text" placeholder="Duracion clase" onblur="validaDuracionClase(\'duracion_'+p+'_'+id_horario_f+'\')"/>'+
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
            $('#SelectDia'+p+'_'+id_horario_f).append('<option id="dia'+p+'_'+i+'">'+ndia+'</option>');
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
            '<input id="campoExtraTipo_'+idnCExtra+'" name="campoExtraTipo_'+idnCExtra+
                '" type="text" placeholder="tipo de cuenta" style="width:55%" onblur="validaCampoExtra(\'campoExtraTipo_'+idnCExtra+'\')" />'+
            '<button class="quitar">-</button>'+
            '<input id="campoExtra_'+idnCExtra+'" name="campoExtra_'+idnCExtra+
                '" type="text" placeholder="Nombre de cuenta" style="width:55%" onblur="validaCampoExtra(\'campoExtra_'+idnCExtra+'\')"/>'+
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
  $.fn.mostrarDiasFestivos = function (contenedor, diaF, descripcionD) {
    return this.each( function () {
      numeroDeDiasFestivos++;
      numero = numeroDeDiasFestivos;
      $( contenedor ).append( 
        '<div id="div_festivos'+numero+'" class="content">'+ 
            '<input id="inicio_'+numero+
                '" type="text" placeholder="aaaa-mm-dd" onblur="validaFecha(\'inicio_'+
                numero+'\')" value="'+diaF+'" onchange="enable_button(\'guardar\')" />'+
            '<textarea id="descripcion_'+numero+
                '" onblur="validaDescripcion(\'descripcion_'+
                numero+'\')" onchange="enable_button(\'guardar\')">'+descripcionD+'</textarea>'+ 
            '<button class="quitarFestivo">-</button>'+ 
          '</div>'); 
          $('#inicio_'+numeroDeDiasFestivos).datePickerElem();
          $('body').eliminarElemento();
    });
  }
  $.fn.mostrarDiaDeClase = function (contenedor, dia, hrs_por_dia, inicio) {
    var ndia=0, c;
    return this.each(function () {
      $('#guardar').removeAttr('disabled');
      if ( $('.content').size() < DIAS_MAXIMOS_CLASE ) {
        id_horario++;
        $( contenedor ).append(
          '<div id="cClase_'+id_horario+'" class="content">'+ 
              '<select id="SelectDia_'+id_horario+'" name="dia_'+id_horario+'"></select><br />'+
              '<input id="Hora_inicio_clase_'+id_horario+
                  '" type="text" placeholder="Hora inicio clase" onblur="validaHora(\'Hora_inicio_clase_'+
                  id_horario+'\')" value='+inicio+' />'+
              '<input id="duracion__'+id_horario+
                  '" type="text" placeholder="Duracion clase" onblur="validaDuracionClase(\'duracion__'+
                  id_horario+'\')" value='+hrs_por_dia+' />'+
              '<button class="quitarDia">-</button>'+ 
            '</div>');
        for (i=0; i<6; i++) {
          switch (i) {
            case 0: ndia='Lunes';break;
            case 1: ndia='Martes';break;
            case 2: ndia='Miercoles';break;
            case 3: ndia='Jueves';break;
            case 4: ndia='Viernes';break;
            case 5: ndia='Sabado';break;
          }
          if ( ndia == dia ){
            $('#SelectDia_'+id_horario).append('<option id="dia_'+i+'" selected>'+ndia+'</option>');
          } else {
            $('#SelectDia_'+id_horario).append('<option id="dia_'+i+'">'+ndia+'</option>');
          }
        }
        $('body').on('click', '.quitarDia', function () { 
          $(this).parent().remove(); 
        }); 
      }
    });
  }
  $.fn.mostrarCampoE = function (contenedor, tipoCuenta, cuenta) {
    return this.each(function () {
      idnCExtra++;
      $(contenedor).append(
        '<div id="c_E'+idnCExtra+'" class="content">'+
          '<input id="campoExtraTipo_'+idnCExtra+'" name="campoExtraTipo_'+idnCExtra+
              '" type="text" placeholder="tipo de cuenta" style="width:55%" onblur="validaCampoExtra(\'campoExtraTipo_'+idnCExtra+'\')" value='+tipoCuenta+' />'+
          '<button class="quitar">-</button>'+
          '<input id="campoExtra_'+idnCExtra+'" name="campoExtra_'+idnCExtra+
              '" type="text" placeholder="Nombre de cuenta" style="width:55%" onblur="validaCampoExtra(\'campoExtra_'+idnCExtra+'\')" value='+cuenta+' />'+
          '<button class="quitar">-</button>'+
        '</div>');
      $('body').on('click', '.quitar', function () { 
        $(this).parent().remove(); 
      });
    });
  }
  $.fn.limpiarListaDeHijos = function (contenedor) {
    return this.each( function () {
      $( contenedor ).empty();
    });
  }
  $.fn.agregarRubro = function () {
    return this.each( function () {
      $(this).on('click', function () {
        rubro++;
        if ($(this).parent().parent().find('#cR').length == 0) {
          ($(this).parent().parent())
              .append('<div id="cR">'+
                         '<div id="r'+rubro+'">'+
                            '<input id="ir'+rubro+'" type="text" onblur="validaRubro(\'ir'+rubro+'\')"/>'+
                            '<input id="irp'+rubro+'" type="text" onblur="validaPorcentaje(\'irp'+rubro+'\')" style="padding-left:2px;padding-right:2px;width:40px" />'+
                            '<button id="agregasub'+rubro+'">+</button>'+
                            '<button class="eliminar_rubro">-</button>'+
                         '</div>'+
                      '</div>');
        } else {
          $('#cR').append(
              '<div id="r'+rubro+'">'+
                 '<input id="ir'+rubro+'" type="text" onblur="validaRubro(\'ir'+rubro+'\')" />'+
                 '<input id="irp'+rubro+'" type="text" onblur="validaPorcentaje(\'irp'+rubro+'\')" style="padding-left:2px;padding-right:2px;width:40px" />'+
                 '<button id="agregasub'+rubro+'">+</button>'+
                 '<button class="eliminar_rubro">-</button>'+
              '</div>');
        }
        $('#agregasub'+rubro).agregar_sub_rubro();
        $('.eliminar_rubro').eliminarRubro();
      });
    });
  }
  $.fn.eliminarRubro = function () {
    return this.each(function() {
      $(this).on('click', function () {
        $(this).parent().remove();
      });
    });
  }
  $.fn.agregar_sub_rubro = function () {
    var numero = 0;
    return this.each(function () {
      $(this).on('click', function () {
        if ($(this).parent().find('#cS'+$(this).parent().attr('id')).length == 0) {
          numero = 1;
          ($(this).parent())
              .append('<div id="cS'+$(this).parent().attr('id')+
                          '" style="margin-left:20px">'+
                         '<div id="'+
                              $(this).parent().attr('id')+
                              's'+numero+'">'+
                            '<input id="i'+
                                $(this).parent().attr('id')+
                                's'+numero+'" style="width:44%" onblur="validaRubro(\'i'+$(this).parent().attr('id')+'s'+numero+'\')" />'+
                            '<input id="ip'+
                                $(this).parent().attr('id')+
                                's'+numero+
                                '" type="text" style="padding-left:2px;padding-right:2px;width:40px" onblur="validaPorcentaje(\'ip'+$(this).parent().attr('id')+'s'+numero+'\')" />'+
                            '<button id="agrega'+
                                $(this).parent().attr('id')+
                                's'+numero+'">+</button>'+
                            '<button id="elim'+
                                $(this).parent().attr('id')+
                                's'+numero+'">-</button>'+
                          '</div>'+
                      '</div>');
        } else {
          numero = siguiente('cS'+$(this).parent().attr('id'));
          $('#cS'+$(this).parent().attr('id')).append(
              '<div id="'+$(this).parent().attr('id')+
                  's'+numero+'">'+
                '<input id="i'+
                    $(this).parent().attr('id')+
                    's'+numero+'" style="width:44%" onblur="validaRubro(\'i'+$(this).parent().attr('id')+'s'+numero+'\')" />'+
                '<input id="ip'+
                    $(this).parent().attr('id')+
                    's'+numero+
                    '" type="text" style="padding-left:2px;padding-right:2px;width:40px" onblur="validaPorcentaje(\'ip'+$(this).parent().attr('id')+'s'+numero+'\'    )" />'+
                '<button id="agrega'+
                    $(this).parent().attr('id')+
                    's'+numero+'">+</button>'+
                '<button id="elim'+
                    $(this).parent().attr('id')+
                    's'+numero+'">-</button>'+
              '</div>');
        }
        $('#agrega'+$(this).parent().attr('id')+'s'+numero).agregar_sub_rubro();
        $('#elim'+$(this).parent().attr('id')+'s'+numero).eliminarRubro();
      });
    });
  }
  function siguiente(div) {
    var hijo, index, n;
    if (document.getElementById(div).childNodes.length > 0) {
      hijo = document.getElementById(div).lastChild.id;
      index = hijo.lastIndexOf('s');
      var numero = new Number(hijo.substring((index + 1), hijo.length));
      n = (numero + 1);
    } else {n = 1;}
    return n;
  }
})( jQuery, window ); 
