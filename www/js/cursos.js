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
  curso = document.getElementById('curso_select').value;

  $.ajax({
    type: 'POST',
    data: {llenar_curso:'', ciclo:ciclo, curso:curso},
    dataType: 'json',
    success: function(info) {
      document.getElementById('nrc').value = info['nrc'];
      document.getElementById('materia').value = info['materia'];
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
      document.getElementById('b_diaclase_m').disabled = true;
      document.getElementById('ver_evaluacion').disabled = true;
      document.getElementById('ver_asistencias').disabled = true;
      document.getElementById('clonar').disabled = true;
    }
  });
}

function mostrar_materia() {
  clave = document.getElementById('clave_materia').value;

  $.ajax({
    type: 'POST',
    data: {llenar_materia:'', clave:clave},
    dataType: 'json',
    success: function(info) {
      document.getElementById('materia').value = info['materia'];
      document.getElementById('academia').value = info['academia'];
    },
    error: function() {
      caja = document.getElementById('clave_materia');
      colorearCaja(false);
      caja.title="La clave de la materia es incorrecta";
      document.getElementById('materia').value = '';
      document.getElementById('academia').value = '';
    }
  });
}
