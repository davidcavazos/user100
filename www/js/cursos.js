function on_load() {
  mostrar_curso();
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
      /*
      var dias = info['dia_no_efectivo'].length;
      console.log('dias no efectivos: '+dias);
      for (var i = 0; i < dias; i++) {
        console.log(info['dia_no_efectivo'][i]+': '+info['descripcion']);
      }
      */
    },
    error: function() {
      document.getElementById('ciclo_select').disabled = true;
      document.getElementById('curso_select').disabled = true;
      document.getElementById('nrc').disabled = true;
      document.getElementById('materia').disabled = true;
      document.getElementById('seccion').disabled = true;
      document.getElementById('academia_select').disabled = true;
      document.getElementById('agregarDiaDeClase').disabled = true;
      document.getElementById('ver_evaluacion').disabled = true;
      document.getElementById('ver_asistencias').disabled = true;
      document.getElementById('clonar').disabled = true;
    }
  });
}
