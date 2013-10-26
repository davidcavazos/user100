function toggle_modal() {
  var e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
}

function toggle_select_all(prefix, boton) {
  var e = document.getElementById('select_all');
  var num = 0;
  var ex;
  do {
    num += 1;
    ex = document.getElementById(prefix + num);
    if (ex != null) {
      ex.checked = e.checked;
    }
  } while (ex != null);
  validar_selecciones(prefix, boton);
}

function validar_selecciones(prefix, boton) {
  var num = 0;
  var ex;
  var activado = false;
  do {
    num += 1;
    ex = document.getElementById(prefix + num);
    if (ex != null && ex.checked) {
      activado = true;
      break;
    }
  } while (ex != null);

  document.getElementById(boton).disabled = !activado;
}
