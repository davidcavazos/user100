var caja="";
var formulario= new Array(false,false,false,false,false);

function regresarIndice()
{
	if(caja.name=="codigo")
	{
		return 0;
	}
	else if(caja.name=="nombre")
	{
		return 1;
	}
	else if(caja.name=="apellido")
	{
		return 2;
	}
	else if(caja.name=="email")
	{
		return 3;
	}
}


function asignaTitle()
{
	
	if(caja.id=="codigo")
	{
		caja.title="El codigo debe de tener 9 caracteres numericos";
	}
	else if(caja.id=="nombre" || caja.id=="apellido")
	{
		caja.title="El/Los "+caja.id+"(s) deben de ser al menos 3 caracteres";
	}
}

function colorearCaja(bandera)
{
	if(bandera)
	{
		caja.style.border="1 px solid rgba(34,149,34,.3)";
		caja.style.background="rgba(34,139,34,.1)";
		formulario[regresarIndice()]=true;
		caja.title="";
		
	}
	else
	{
	
		caja.style.border="1 px solid rgba(255,0,0,.3)";
		caja.style.background="rgba(255,0,0,.1)";
		formulario[regresarIndice()]=false;
		asignaTitle();
	}
}


function analiza(idcaja,expresionRegular)
{
	caja=document.getElementById(idcaja);
	if(!caja.value.match(expresionRegular))
	{
		colorearCaja(false);
	}
	else
	{
		colorearCaja(true);
	}
}

function validarCampos(formulario)
{
	if(formulario[0]==false)
	{
		caja=document.getElementById("codigo");		
		colorearCaja(false);
	}
	else if(formulario[1]==false)
	{
		caja=document.getElementById("nombre");		
		colorearCaja(false);
	}
	else if(formulario[2]==false)
	{
		caja=document.getElementById("apellido");		
		colorearCaja(false);
	}
	else if(formulario[3]==false)
	{
		caja=document.getElementById("email");		
		colorearCaja(false);
	}
	else if(document.getElementById("carreras").selectedIndex==0)
	{
		alert("Debes seleccionar una carrera");
	}
	else
	{
		document.getElementById(formulario).submit();
	}	
}
