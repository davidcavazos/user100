function on_load() {
  mostrar_curso();
}

function toggle_modal_agregar() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
}

function toggle_modal_clonar() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';

  document.getElementById('new_nrc').value = document.getElementById('nrc').value;
  document.getElementById('new_materia').value = document.getElementById('materia').value;
  document.getElementById('new_seccion').value = document.getElementById('seccion').value;
}

function mostrar_curso() {
  ciclo = document.getElementById('ciclo_select').value;
  clave = document.getElementById('curso_select').value.split(" ")[0];

  $.ajax({
    type: 'POST',
    data: {llenar_curso:'', ciclo:ciclo, clave:clave},
    dataType: 'json',
    success: function(info) {
      document.getElementById('clave_materia').value = info['clave_materia'];
      document.getElementById('materia').value = info['materia'];
      document.getElementById('academia').value = info['academia'];
      document.getElementById('nrc').value = info['nrc'];
      document.getElementById('seccion').value = info['seccion'];
      var horarios = info['dia'].length;
      console.log('horarios: '+horarios);
      for (var i = 0; i < horarios; i++) {
        console.log(info['dia'][i]+': '+info['horas_por_dia'][i]+', '+info['horario'][i]);
      }
    },
    error: function() {
      document.getElementById('ciclo_select').disabled = true;
      document.getElementById('curso_select').disabled = true;
      document.getElementById('clave_materia').disabled = true;
      document.getElementById('nrc').disabled = true;
      document.getElementById('seccion').disabled = true;
      document.getElementById('b_diaclase').disabled = true;
      document.getElementById('ver_evaluacion').disabled = true;
      document.getElementById('ver_asistencias').disabled = true;
      document.getElementById('clonar').disabled = true;
    }
  });
}

function mostrar_materia(clave_materia, materia, academia) {
  clave = document.getElementById(clave_materia).value;

  $.ajax({
    type: 'POST',
    data: {llenar_materia:'', clave:clave},
    dataType: 'json',
    success: function(info) {
      document.getElementById(materia).value = info['materia'];
      document.getElementById(academia).value = info['academia'];
    },
    error: function() {
      caja = document.getElementById(clave_materia);
      colorearCaja(false);
      caja.title="La clave de la materia es incorrecta";
      document.getElementById(materia).value = '';
      document.getElementById(academia).value = '';
    }
  });
}

function agregar_curso()
{
  ciclo = document.getElementById('new_ciclo').value;
  clave = document.getElementById('new_clave').value;
  nrc = document.getElementById('new_nrc').value;
  seccion = document.getElementById('new_seccion').value;
  var dia="";
  var hora="";
  var duracion="";
  for(i=1;i<=id_horario;i++)
  {
    if(document.getElementById('cClase_'+i))
    {
      dia_actual=document.getElementById('SelectDia_m_'+i).value.trim();
      hora_actual=document.getElementById('Hora_inicio_clasem_'+i).value.trim();
      duracion_actual=document.getElementById('duracion_'+i).value.trim();
      if(dia_festivo_actual.length!=0 || descripcion_actual.length!=0)
      {
        dia+=dia_actual+",";
        hora+=hora_actual+",";
        duracion+=duracion_actual+",";
      }
    }
  }
  $.ajax({
    type: 'POST',
    data: {guardar:'',ciclo:ciclo,clave:clave,nrc:nrc,seccion:seccion,dia:dia,hora:hora, duracion:duracion},
    success: function() {
      location.reload();
    }
  });
}
