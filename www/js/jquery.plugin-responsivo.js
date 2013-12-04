$(document).ready(function() {
  var bandera = false,
      tablaCopia;

  var updateTables = function() {
    if (($(window).width() < 900) && !bandera ){
      bandera = true;
      $("table.responsive").each(function(i, elem) {
        separarTabla($(elem));
      });
      return true;
    }
    else if (bandera && ($(window).width() > 900)) {
      bandera = false;
      $("table.responsive").each(function(i, elem) {
        unirTabla($(elem));
      });
    }
  };
   
  $(window).load(updateTables);
  $(window).on("redraw",function(){bandera=false;updateTables();});
  $(window).on("resize", updateTables);
   
  
  function separarTabla(table) {
    tablaOriginal = table;
    tablaOriginal.wrap('<div class="table-wrapper"></div>');
    
    tablaCopia = tablaOriginal.clone();
    tablaOriginal.find($('th').children('#select_all')).remove();
    for (i=1; i <= $('tbody tr').length; i++) {
      tablaOriginal.find($('td').children('#'+i)).remove();
    }

    /**
     * arregla el "bug" cuando el primer th en la tabla original esta vacia
     * evitando que colapsé ese mismo th en la copia al estar vacio.
     */
    tablaCopia.find('thead tr')
        .height( tablaOriginal.find('thead').height()+'px');

    /**
     * evita posible "bug" cuando el primer td en la tabla original esta vacio
     * dando un tamaño fijo a ese td en la tabla copia.
     */
    for (i=1; i <=$('tbody tr').length; i++) {
      tablaCopia.find('tbody tr:nth-child('+i+')')
          .height(tablaOriginal
                .find('tbody tr:nth-child('+i+')').height()+'px');
    }

    tableCopy.find('td:not(:first-child), th:not(:first-child)').remove();
    tableCopy.removeClass('responsive');
    
    tablaOriginal.closest(".table-wrapper").prepend(tablaCopia);
    tablaCopia.wrap('<div class="pinned"></div>');
    tablaOriginal.wrap('<div class="scrollable"></div>');
  }
  
  function unirTabla(tablaOriginal) {
    var nodos, i;
    tablaOriginal.closest('.table-wrapper').find('.pinned').remove();
    tablaOriginal.unwrap();
    tablaOriginal.unwrap();

    nodos = tablaCopia.clone();
    tablaOriginal.find('thead tr th:first-child')
        .append(nodos.find('thead tr th input'));
    
    for (i=1; i<=$('tbody tr').length; i++) {
      tablaOriginal.find('tbody tr:nth-child('+i+') td:first-child')
          .replaceWith(nodos.find('tr:nth-child('+i+') td:first-child'));
    }
  }
});
