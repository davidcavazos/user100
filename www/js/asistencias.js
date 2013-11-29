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
    document.getElementById('ver_evaluacion').disabled = true;
    document.getElementById('select_all').disabled = true;
  }
}

function toggle_botones() {
}
