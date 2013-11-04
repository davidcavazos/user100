function toggle_modal() {
	e = document.getElementById('modal');
	e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
}

function toggle_select_all(prefix, boton) {
	e = document.getElementById('select_all');
	num = 0;
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

/*-----------Validaciones Javascript Formularios-------------*/

var caja;
function colorearCaja(bandera)
{
	if(bandera)
	{
		caja.style.border='1px solid rgba(34,139,34,0.3)';
		caja.style.background='rgba(34,139,34,0.1)';
	}
	else
	{
		caja.style.border='1px solid rgba(255,0,0,0.3)';
		caja.style.background='rgba(255,0,0,0.1)';
	}
}


function validaCiclo(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length!=5 && !caja.value.match('^[0-9]{4}[abAB]$'))
	{
		colorearCaja(false);
		caja.title="El ciclo esta compuesto por 4 numeros seguido de una letra A o B";
		return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}	

}

function validaCodigo(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length!=9 || !caja.value.match('^[0-9]{9}$'))
	{
		colorearCaja(false);
		caja.title="El codigo esta compuesto por 9 numeros";
		return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}

function validaNombre(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length<1 || !caja.value.match('^[ a-zA-Z]{1,}$'))
	{
		colorearCaja(false);
		caja.title="El nombre/apellido esta compuesto por caracteres alfabeticos";
	return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}
function validaNRC(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length!=5 || !caja.value.match('^[0-9]{5}$'))
	{
		colorearCaja(false);
		caja.title="El NRC esta compuesto por 5 numeros";
		return false;
	}
	else
	{
	colorearCaja(true);
	caja.title=""
	return true;
	}
}

function validaMateria(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length<1 || !caja.value.match('^[ a-zA-Z]{1,}$'))
	{
	colorearCaja(false);
	caja.title="La materia esta compuesta por caracteres alfabeticos";
	return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}

function validaSeccion(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length!=3 || !caja.value.match('^[dD][0-9]{2}$'))
	{
	colorearCaja(false);  
	caja.title="La seccion esta compuesta por una letra 'd' seguido de 2 numeros";
	return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}

function validaEmail(id)
{
	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length<1 || !caja.value.match("[-a-z0-9A-Z._]{1,}@[-a-z0-9A-Z._]{1,}.[a-zA-Z]"))
	{
		colorearCaja(false);
		caja.title="Introduce un email valido";
		return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}

function validaFecha(id)
{
	caja=document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length!=10 || !caja.value.match("[0-9]{4}-[0-9]{2}-[0-9]{2}"))
	{
		colorearCaja(false);
		caja.title="Fecha invalida. El formato de la fecha es 'aaaa-mm-dd'";
		return false;
	}
	fecha = caja.value.split("-");
	mes = parseInt(fecha[1]);
	dia = parseInt(fecha[2]);
	if(mes<0 || mes >12 || mes <0 || mes > 31)
	{
		colorearCaja(false);
		caja.title="Fecha invalida. El formato de la fecha es 'aaaa-mm-dd'";
		return false;
	}
	else
	{
	colorearCaja(true);
	caja.title="";
	return true;
	}
}

function validaFechaFin(idUno, idDos)
{
	caja = document.getElementById(idDos);
	cajaDos = document.getElementById(idUno);
	if(caja.value.length!=10 || !caja.value.match("[0-9]{4}-[0-9]{2}-[0-9]{2}"))
	{
		colorearCaja(false);
		caja.title="Fecha invalida. El formato de la fecha es 'aaaa-mm-dd'";
		return false;
	}
	var hoy;
	if(cajaDos.value=="")
	{
	hoy = new Date();
	dia=hoy.getDate();
	if(dia<10)
	{
		dia="0"+dia;
	}
	mes=hoy.getMonth()+1;
	if(mes<10)
	{
		mes="0"+mes;
	}

	cajaDos.value=hoy.getFullYear()+"-"+mes+"-"+dia;

	}
	else
	{
		fechaHoy = cajaDos.value.split("-");
		mes = parseInt(fechaHoy[1]);
		dia = parseInt(fechaHoy[2]);
		año = parseInt(fechaHoy[0]);
		hoy = new Date(año,mes-1,dia);
	}
	fecha = caja.value.split("-");
	mes = parseInt(fecha[1]);
	dia = parseInt(fecha[2]);
	año = parseInt(fecha[0]);
	if(mes<0 || mes >12 || mes <0 || mes > 31)
	{
		colorearCaja(false);
		caja.title="Fecha invalida. El formato de la fecha es 'aaaa-mm-dd'";
		return false;
	}
	else
	{

		fechaCaja = new Date(año,mes-1,dia);
		if(fechaCaja<=hoy)
		{
			colorearCaja(false);
			caja.title="La fecha de inicio no puede ser mayor o igual a la fecha final";
			return false;
		}
		else
		{
			colorearCaja(true);
			caja.title="";
			caja = cajaDos;
			colorearCaja(true);
			return true;
		}
	}	

}

function validaDescripcion(id)
{

	caja = document.getElementById(id);
	caja.value=caja.value.trim();
	if(caja.value.length<1) 
	{
		colorearCaja(false);
		caja.title="Introduce una descripcion valida";
		return false;
	}
	else
	{
		colorearCaja(true);
		caja.title="";
		return true;
	}
}

function validaPass(id)
{
caja = document.getElementById(id);
caja.value = caja.value.trim();
if(caja.value.length<1)
{
colorearCaja(false);
caja.title="Introduce una contraseña";
}
else
{
colorearCaja(true);
caja.title="";
}
}

function validaRegistrarCiclo()
{
var validacion=true;
if(!validaCiclo('new_ciclo'))
{
validacion=false;
}
if(!validaFecha('new_fecha_inicio'))
{
validacion=false;
}
if(!validaFechaFin('new_fecha_inicio','new_fecha_fin'))
{
validacion=false;
}
if(numeroDeDiasFestivosM>0)
{
for(i=1;i<=numeroDeDiasFestivosM;i++)
{
	if(document.getElementById('div_festivos'+i))
	{
		if(!validaFecha('inicio_m_'+i))
		{
			validacion=false;
		}
		if(!validaDescripcion('descripcion_m_'+i))
		{
			validacion=false;
		}

	}	
}		
}
if(validacion)
{
agregar_ciclo();
}

}

function validaGuardarCambiosCiclo()
{
var validacion=true;
if(!validaCiclo('ciclo'))
{
validacion=false;
}
if(!validaFecha('fecha_inicio'))
{
validacion=false;
}
if(!validaFechaFin('fecha_inicio','fecha_fin'))
{
validacion=false;
}
for(i=1;i<=numeroDeDiasFestivos;i++)
{
if(document.getElementById('div_festivos'+i))
{
	if(!validaFecha('inicio_'+i))
	{
		validacion=false;
	}
	if(!validaDescripcion('descripcion_'+i))
	{
		validacion=false;
	}
	}	
}		

if(validacion)
{
guardar_ciclo();
}

}

function validaRegistrarUsuario()
{
var validacion=true;
if(!validaCodigo('codigo'))
{
validacion=false;
}
if(!validaNombre('nombres'))
{
validacion=false;
}
if(!validaNombre('apellidos'))
{
validacion=false;
}
if(!validaEmail('email'))
{
validacion=false;
}
if(validacion)
{
agregar_usuario();
return true;
}
else
{
return false;
}

}

function validaLogin()
{
	var validacion=true;
	if(!validaCodigo('login'))
	{
		validacion=false;
	}
    if(!validaPass('password'))
	{
		validacion=false;
	}
}
