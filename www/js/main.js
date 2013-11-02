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

/*-----------Validaciones Javascript Formularios-------------*/

var caja;
/*
function asignaTitle()
{
	if(caja.id=="codigo")
	{
		caja.title='El codigo debe de tener 9 caracteres numericos';
	}
	if(caja.id=="ciclo")
	{
		caja.title='El ciclo debe de estar compuesto por 4 numeros y una letra';
	}
	if(caja.id=="nombre" || caja.id=="apellido")
	{
		caja.title='El nombre/apellido debe de tener al menos 3 caracteres alfabeticos';
	}
	if(caja.id=="seccion")
	{
		caja.title='La seccion debe de tener una letra "d" seguido de dos numeros ';
	
	if(caja.id=="materia")
	{
		caja.title='El nombre de la materia debe contener solamente caracteres alfabeticos';
	}
	if(caja.id=="nrc")
	{
		caja.title="El NRC debe de tener 5 numeros";
	}
}
*/
function colorearCaja(bandera)
{
	if(bandera)
	{
		caja.style.border='1px solid rgba(34,139,34,0.3)';
		caja.style.background='rgba(34,139,34,0.1)';
		caja.title='';
	}
	else
	{
		caja.style.border='1px solid rgba(255,0,0,0.3)';
		caja.style.background='rgba(255,0,0,0.1)';
		//asignaTitle();
	}
}


function validaCiclo(id)
{
	caja = document.getElementById(prefix);
	caja.value=caja.value.trim();
	if(caja.value.length!=5 && !caja.value.match('^[0-9]{4}[abAB]$'))
	{
		colorearCaja(false);
		return false;
	}
	else
	{
		colorearCaja(true);
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
		return false;
	}
	else
	{
		colorearCaja(true);
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
		return false;
	}
	else
	{
		colorearCaja(true);
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
		return false;
	}
	else
	{
		colorearCaja(true);
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
		return false;
	}
	else
	{
		colorearCaja(true);
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
		return false;
	}
	else
	{
		colorearCaja(true);
		return true;
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
	if(validacion)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
