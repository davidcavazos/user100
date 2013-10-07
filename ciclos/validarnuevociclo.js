var caja;
var formulario= new Array(false,false,false,false);

function colorearCaja(bandera)
{
  if(bandera)
  {
    caja.style.border="1 px solid rgba(34,149,34,.3)";
    caja.style.background="rgba(34,139,34,.1)";
    formulario[regresarIndice()]=true;
    caja.title="";
    asignaTitle();
    
  }
  else
  {
    caja.style.border="1 px solid rgba(255,0,0,.3)";
    caja.style.background="rgba(255,0,0,.1)";
    formulario[regresarIndice()]=false;
    caja.title="";
    asignaTitle();
    
  }
}


function asignaTitle()
{
  if(caja.id=="seleccionDeCiclo")
  {
    caja.title="Selecciona un ciclo valido";
  }
  else if(caja.id=="inicioCiclo" || caja.id=="finCiclo" || caja.id=="diaFestivo")
  {
    caja.title="Introduce una fecha valida";
  }

}

function regresarIndice()
{
  if(caja.name=="seleccionDeCiclo")
  {
    return 0;
  }
  else if(caja.name=="inicioCiclo")
  {
    return 1;
  }
  else if(caja.name=="finCiclo")
  {
    return 2;
  }
  else if(caja.name=="diaFestivo")
  {
    return 3;
  }
}


function analizaCombo(idcaja)
{
  caja=document.getElementById(idcaja);
  if (caja.selectedIndex==0)
  {
    colorearCaja(false);
  }
  else
  {
    colorearCaja(true);
  }
}


function validarFecha(tiempo)
{
	caja=document.getElementById(tiempo);
	if(caja.value.match("^[0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9]$"))
	{
		colorearCaja(true);
	}
	else
	{
		colorearCaja(false);
	}
}

function validarCampos()
{
  var correcto=true;
  if(formulario[0]==false)
  {
    caja=document.getElementById("seleccionDeCiclo");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[1]==false)
  {
    caja=document.getElementById("inicioCiclo");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[2]==false)
  {
    caja=document.getElementById("finCiclo");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[3]==false)
  {
    caja=document.getElementById("diaFestivo");
    colorearCaja(false);
    correcto=false;
  }

  if(correcto)
  {
    //document.getElementById(formulario).submit();
    return true;
  }
  return false;
}
