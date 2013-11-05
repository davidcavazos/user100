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
        if(campoExtraTipo!=0 || campoExtra!=0)
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
		   campoextra:CampoExtra,
		   tipo:campoExtraTipo},
    success: function(info) {
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
