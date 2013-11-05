function agregar_usuario()
{
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
           activo:'1'},
    success: function(info) {
      document.getElementById('agregar').disabled = true;
      console.log('success: '+info);
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
