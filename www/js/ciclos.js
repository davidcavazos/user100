function mostrar_ciclo() {
  ciclo = document.getElementById('ciclo_select').value;

  $.ajax({
    type: 'POST',
    data: {llenar_ciclo:ciclo},
    dataType: 'json',
    success: function(info) {
      document.getElementById('ciclo').value = info['ciclo'];
      document.getElementById('fecha_inicio').value = info['fecha_inicio'];
      document.getElementById('fecha_fin').value = info['fecha_fin'];
    }
  });
}

function guardar_ciclo() {
  c = document.getElementById('ciclo_select').value;
  nc = document.getElementById('ciclo').value;
  fi = document.getElementById('fecha_inicio').value;
  ff = document.getElementById('fecha_fin').value;
  var dia_festivo="";
  var descripcion="";
  
  for(i=1;i<=numeroDeDiasFestivos;i++)
  {
	if(document.getElementById('div_festivos'+i))
	{
		dia_festivo_actual=document.getElementById('inicio_'+i).value.trim();
		descripcion_actual=document.getElementById('descripcion_'+i).value.trim();
		if(dia_festivo_actual.length!=0 || descripcion_actual.length!=0)
		{
			dia_festivo+=dia_festivo_actual+",";
			descripcion+=descripcion_actual+",";
		}
	}
  }
  $.ajax({
    type: 'POST',
    data: {guardar:'',ciclo:c,new_ciclo:nc,fecha_inicio:fi,fecha_fin:ff,diafestivo:dia_festivo,descripciondia:descripcion},
    success: function() {
      document.getElementById('guardar').disabled = true;
      location.reload();
    }
  });
}

function agregar_ciclo() {
  c = document.getElementById('new_ciclo').value;
  fi = document.getElementById('new_fecha_inicio').value;
  ff = document.getElementById('new_fecha_fin').value;
  var dia_festivo="";
  var descripcion="";
  for(i=1;i<=numeroDeDiasFestivosM;i++)
  {
	if(document.getElementById('div_festivos'+i))
	{
		dia_festivo_actual=document.getElementById('inicio_m_'+i).value.trim();
		descripcion_actual=document.getElementById('descripcion_m_'+i).value.trim();
		if(dia_festivo_actual.length!=0 || descripcion_actual.length!=0)
		{
			dia_festivo+=dia_festivo_actual+",";
			descripcion+=descripcion_actual+",";
		}
	}
  }
  $.ajax({
    type: 'POST',
    data: {agregar:'',ciclo:c,fecha_inicio:fi,fecha_fin:ff,diafestivo:dia_festivo,descripciondia:descripcion},
    success: function() {
      document.getElementById('agregar').disabled = true;
      location.reload();
    }
  });
}
