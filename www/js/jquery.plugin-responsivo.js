$(document).ready(function() {
  var bandera = false,
      tableCopy;

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
    tableOriginal = table;
    tableOriginal.wrap('<div class="table-wrapper"></div>');
    
    tableCopy = tableOriginal.clone();
    tableOriginal.find($('th').children('#select_all')).remove();
    for (i=1; i <= $('tbody tr').length; i++) {
      tableOriginal.find($('td').children('#'+i)).remove();
    }
    tableCopy.find('td:not(:first-child), th:not(:first-child)').remove();
    tableCopy.removeClass('responsive');
    
    tableOriginal.closest(".table-wrapper").prepend(tableCopy);
    tableCopy.wrap('<div class="pinned"></div>');
    tableOriginal.wrap('<div class="scrollable"></div>');
  }
  
  function unirTabla(tableOriginal) {
    var nodos, i;
    tableOriginal.closest('.table-wrapper').find('.pinned').remove();
    tableOriginal.unwrap();
    tableOriginal.unwrap();

    nodos = tableCopy.clone();
    tableOriginal.find('thead tr th:first-child')
        .append(nodos.find('thead tr th input'));
    
    for (i=1; i<=$('tbody tr').length; i++) {
      tableOriginal.find('tbody tr:nth-child('+i+') td:first-child')
          .replaceWith(nodos.find('tr:nth-child('+i+') td:first-child'));
    }
  }
});
