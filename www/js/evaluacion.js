function on_load() {
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
