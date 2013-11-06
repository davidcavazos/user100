function on_load() {
}

function toggle_modal_agregar_usuario() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
  btn = document.getElementById('aceptar');
  btn.value = 'Agregar';
  btn.onclick = validaRegistrarUsuario;
}

function toggle_modal_modificar_usuario() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';

  codigo = 0;
  num = 0;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null) {
      codigo = ex.value;
      break;
    }
  } while (ex != null);

  $.ajax({
    type: 'POST',
    data: {mostrar:'', codigo:codigo,},
    dataType: 'json',
    success: function(usuario) {
      document.getElementById('codigo').value = usuario['codigo'];
      document.getElementById('apellidos').value = usuario['apellidos'];
      document.getElementById('nombres').value = usuario['nombres'];
      document.getElementById('email').value = usuario['email'];
      document.getElementById('carrera').value = usuario['carrera'];
      btn = document.getElementById('aceptar');
      btn.value = 'Modificar';
      btn.onclick = modificar_usuario;
    }
  });
}

function toggle_botones() {
  num = 0;
  activado = false;
  seleccionados = 0;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null && ex.checked) {
      activado = true;
      seleccionados += 1;
    }
  } while (ex != null);

  document.getElementById('elim').disabled = !activado;
  if (seleccionados == 1) {
    document.getElementById('modificar').disabled = false;
  } else {
    document.getElementById('modificar').disabled = true;
  }
}

function agregar_usuario()
{
  var campoExtraTipo="";
  var campoExtra="";
  for(i=1;i<=idnCExtra;i++)
  {
    if(document.getElementById('c_E'+i))
    {
      campoExtraTipoA=document.getElementById('campoExtraTipo_'+i).value;
      campoExtraA=document.getElementById('campoExtra_'+i).value;

      if(campoExtraTipoA!=0 || campoExtraA!=0)
      {
        campoExtraTipo+=campoExtraTipoA+",";
        campoExtra+=campoExtraA+",";
      }
    }
  }
  $.ajax({
    type: 'POST',
    data: {agregar:'',
           codigo:document.getElementById('codigo').value,
           nombres:document.getElementById('nombres').value,
           apellidos:document.getElementById('apellidos').value,
           password:'asdf',
           tipo:'0',
           carrera:document.getElementById('carrera').value,
           email:document.getElementById('email').value,
           activo:'1',
           campoextra:campoExtra,
           tipoCampo:campoExtraTipo},
    success: function() {
      location.reload();
    }
  });
}

function modificar_usuario()
{
  var campoExtraTipo="";
  var campoExtra="";
  for(i=1;i<=idnCExtra;i++)
  {
    if(document.getElementById('c_E'+i))
    {
      campoExtraTipoA=document.getElementById('campoExtraTipo_'+i).value;
      campoExtraA=document.getElementById('campoExtra_'+i).value;

      if(campoExtraTipoA!=0 || campoExtraA!=0)
      {
        campoExtraTipo+=campoExtraTipoA+",";
        campoExtra+=campoExtraA+",";
      }
    }
  }

  codigo = 0;
  num = 0;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null && ex.checked) {
      codigo = ex.value;
      break;
    }
  } while (ex != null);
  $.ajax({
    type: 'POST',
    data: {modificar:'',
           codigo:codigo,
           new_codigo:document.getElementById('codigo').value,
           nombres:document.getElementById('nombres').value,
           apellidos:document.getElementById('apellidos').value,
           carrera:document.getElementById('carrera').value,
           email:document.getElementById('email').value,
           campoextra:campoExtra,
           tipoCampo:campoExtraTipo},
    success: function() {
      location.reload();
    }
  });
}

function desactivar_usuarios() {
  usuarios = new Array();
  num = 0;
  do {
    num += 1;
    ex = document.getElementById('r'+num);
    if (ex != null && ex.checked) {
      usuarios.push(ex.value);
    }
  } while (ex != null);

  $.ajax( {
    type: 'POST',
    data: {desactivar:'',usuarios:usuarios},
    success: function() {
      location.reload();
    }
  });
}
