var caja;

function asignaTitle()
{
	caja.title="Este campo no puede quedar vacio";
}

function colorearCaja(bandera)
{
  if(bandera)
  {
    caja.style.border="1 px solid rgba(34,149,34,.3)";
    caja.style.background="rgba(34,139,34,.1)";
    caja.title="";
  }
  else
  {
    caja.style.border="1 px solid rgba(255,0,0,.3)";
    caja.style.background="rgba(255,0,0,.1)";
    asignaTitle();
  }
}

function validarCampos()
{
  var correcto=true;
  if((caja=document.getElementById("login")).value=="")
  {
    
    colorearCaja(false);
    correcto=false;
  }
  else
  {
    colorearCaja(true);
  }
  if((caja=document.getElementById("password")).value=="")
  {
    colorearCaja(false);
    correcto=false;
  }
  else
  {
    colorearCaja(true);
  }
  if(correcto)
  {
    //document.getElementById(formulario).submit();
    return true;
  }
  return false;
}
