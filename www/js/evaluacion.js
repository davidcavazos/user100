function on_load() {
  ciclo = document.getElementById('ciclo_select').value;
  clave = document.getElementById('curso_select').value.split(" ")[0];

  curso_valido = true;
  if (ciclo == '') {
    document.getElementById('ciclo_select').disabled = true;
    curso_valido = false;
  }
  if (clave == '') {
    document.getElementById('curso_select').disabled = true;
    curso_valido = false;
  }
  if (!curso_valido) {
    document.getElementById('ver_curso').disabled = true;
    document.getElementById('ver_asistencias').disabled = true;
    document.getElementById('codigo').disabled = true;
    document.getElementById('alumno').disabled = true;
    document.getElementById('inscribir_alumno').disabled = true;
    document.getElementById('leer_csv_alumnos').disabled = true;
    document.getElementById('agregar_rubro').disabled = true;
    document.getElementById('agregar_subtabla').disabled = true;
    document.getElementById('elim_rubros').disabled = true;
    document.getElementById('select_all').disabled = true;
  }
}

function toggle_botones() {
  num = 0;
  activado = false;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null && ex.checked) {
      activado = true;
    }
  } while (ex != null);

  document.getElementById('elim_alumno').disabled = !activado;
}

function autocomplete_codigo() {
  codigo = document.getElementById('codigo').value;
  button = document.getElementById('inscribir_alumno');
  button.disabled = true;

  $.ajax({
    type: 'POST',
    data: {get_codigos:''},
    dataType: 'json',
    success: function(info) {
      for (i = 0; i < info.length; i++) {
        if (info[i] == codigo) {
          button.disabled = false;
        }
      }
      $("#codigo").autocomplete({source: info});
    }
  });
}

function autocomplete_alumno() {
  alumno = document.getElementById('alumno').value;
  button = document.getElementById('inscribir_alumno');
  button.disabled = true;

  $.ajax({
    type: 'POST',
    data: {get_alumnos:''},
    dataType: 'json',
    success: function(info) {
      for (i = 0; i < info.length; i++) {
        if (info[i] == alumno) {
          button.disabled = false;
        }
      }
      $("#alumno").autocomplete({source: info});
    }
  });
}
