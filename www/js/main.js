function toggle_modal() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
}

function toggle_select_all(prefix, boton) {
  e = document.getElementById('select_all');
  num = 0;
  ex;
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
  num = 0;
  ex;
  activado = false;
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

function toggle_button(boton) {
  document.getElementById(boton).disabled ^= true;
}

function enable_button(boton) {
  document.getElementById(boton).disabled = false;
}

function disable_button(boton) {
  document.getElementById(boton).disabled = true;
}
