var caja;
var formulario= new Array(false,false,false,false,false,false);


function regresarIndice()
{
  if(caja.name=="nombreNuevoCurso")
  {
    return 0;
  }
  else if(caja.name=="seccionDeCurso")
  {
    return 1;
  }
  else if(caja.name=="nrcDelCurso")
  {
    return 2;
  }
  else if(caja.name=="cicloDelCurso")
  {
    return 3;
  }
  else if(caja.name=="diaSemana")
  {
    return 4;
  }
  else if(caja.name=="horasPorDia")
  {
    return 5;
  }
}


function asignaTitle()
{
  if(caja.id=="nombreNuevoCurso")
  {
    caja.title="Introduce un nombre de curso valido, solo caracteres alfabeticos";
  }
  else if(caja.id=="seccionDeCurso")
  {
    caja.title="Introduce una seccion valida. Un caracter alfabetico seguido de dos numeros.";
  }
  else if(caja.id=="nrcDelCurso")
  {
    caja.title="Introduce un NRC valido. Un NRC esta formado por 5 numeros";
  }
  else if(caja.id=="cicloDelCurso" || caja.id=="diaSemana" || caja.id=="horasPorDia")
  {
    caja.title="Selecciona una opcion valida";
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


function colorearCombo(bandera)
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


function analizaCombo(idcaja)
{
  caja=document.getElementById(idcaja);
  if (caja.selectedIndex==0)
  {
    colorearCombo(false);
  }
  else
  {
    colorearCombo(true);
  }
}


function validarCampos()
{
  var correcto=true;
  if(formulario[0]==false)
  {
    caja=document.getElementById("nombreNuevoCurso");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[1]==false)
  {
    caja=document.getElementById("seccionDeCurso");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[2]==false)
  {
    caja=document.getElementById("nrcDelCurso");
    colorearCaja(false);
    correcto=false;
  }
  if(formulario[3]==false)
  {
    caja=document.getElementById("cicloDelCurso");
    colorearCombo(false);
    correcto=false;
  }
  if(formulario[4]==false)
  {
    caja=document.getElementById("diaSemana");
    colorearCombo(false);
    correcto=false;
  }
  if(formulario[5]==false)
  {
    caja=document.getElementById("horasPorDia");
    colorearCombo(false);
    correcto=false;
  }

  if(correcto)
  {
    document.getElementById(formulario).submit();
    return true;
  }
  return false;
}
