function on_load() {
  var ciclo = document.getElementById('ciclo_select').value;
  var nrc = document.getElementById('curso_select').value.split(" ")[0];

  curso_valido = true;
  if (ciclo == '') {
    document.getElementById('ciclo_select').disabled = true;
    curso_valido = false;
  }
  if (nrc == '') {
    document.getElementById('curso_select').disabled = true;
    curso_valido = false;
  }
  if (!curso_valido) {
    document.getElementById('ver_curso').disabled = true;
    document.getElementById('ver_evaluacion').disabled = true;
    document.getElementById('select_all').disabled = true;
  }
}

function toggle_botones() {
}

function mostrar_mes() {
  var ciclo = document.getElementById('ciclo_select').value;
  var nrc = document.getElementById('curso_select').value.split(" ")[0];
  var mes = document.getElementById('mes_select').value;
  location = 'index.php?ctl=asistencias&ciclo='+ciclo+'&nrc='+nrc+'&mes='+mes;
}

function guardar_asistencias() {
  var ciclo = document.getElementById('ciclo_select').value;
  var nrc = document.getElementById('curso_select').value.split(" ")[0];
  var mes = document.getElementById('mes_select').value;

  var codigos = [];
  var asistencias = [];

  var table = document.getElementById('table');
  for (var i = 1, row; row = table.rows[i]; i++) {
    codigos[i-1] = row.cells[1].firstChild.data;
    asistencias[i-1] = [];
    for (var j = 3; j < row.cells.length; j++) {
      x = document.getElementById(i+'_'+(j-2));
      if (x != null) {
        asistencias[i-1][table.rows[0].cells[j].firstChild.data] = x.checked;
      }
    }
  }

  $.ajax({
    type: 'POST',
    data: {guardar:'',ciclo:ciclo,nrc:nrc,month:mes,codigos:codigos,asistencias:asistencias},
    success: function(info) {
      location.reload();
    },
    error: function() {
      location.reload();
    }
  });
}
