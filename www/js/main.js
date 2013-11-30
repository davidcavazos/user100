function toggle_modal() {
  e = document.getElementById('modal');
  e.style.visibility = e.style.visibility == 'visible' ? 'hidden' : 'visible';
}

function toggle_select_all(fcn) {
  e = document.getElementById('select_all');
  num = 0;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null) {
      ex.checked = e.checked;
    }
  } while (ex != null);
  fcn();
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

function validaClaveMateria(id)
{
  caja = document.getElementById(id);
  caja.value=caja.value.trim();
  if(caja.value.length<1 || !caja.value.match('^[a-zA-Z]\+[0-9]\+$'))
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
  if(caja.value.length==0)
  {
    return false;
  }
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
  if(caja.value.length==0)
  {
    return false;
  }
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
    cajaTemporal = caja;
    caja = cajaDos;
    colorearCaja(true);
    caja = cajaTemporal;
  }
  else
  {
    fechaHoy = cajaDos.value.split("-");
    mes = parseInt(fechaHoy[1]);
    dia = parseInt(fechaHoy[2]);
    anyo = parseInt(fechaHoy[0]);
    hoy = new Date(anyo,mes-1,dia);
  }
  fecha = caja.value.split("-");
  mes = parseInt(fecha[1]);
  dia = parseInt(fecha[2]);
  anyo = parseInt(fecha[0]);
  if(mes<0 || mes >12 || dia <0 || dia > 31)
  {
    colorearCaja(false);
    caja.title="Fecha invalida. El formato de la fecha es 'aaaa-mm-dd'";
    return false;
  }
  else
  {

    fechaCaja = new Date(anyo,mes-1,dia);
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
  return false;
  }
  else
  {
  colorearCaja(true);
  caja.title="";
  return true;
  }
}

function validaDuracionClase(id)
{
  caja=document.getElementById(id);
  caja.value=caja.value.trim();
  if(!caja.value.match("^[0-9]$"))
  {
    colorearCaja(false);
    caja.title="Este campo debe contener un solo digito";
    return false;
  }
  else
  {
    colorearCaja(true);
    caja.title="";
    return true;
  }
}

function validaCampoExtra(id)
{
  caja = document.getElementById(id);
  caja.value = caja.value.trim();
  if(caja.value.length<1)
  {
    colorearCaja(false);
    caja.title="Este campo no puede quedar vacio";
    return false;
  }
  else
  {
    colorearCaja(true);
    caja.title="";
    return true;
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


function validaHora(id)
{
    caja=document.getElementById(id);
    caja.value=caja.value.trim();
    caja.value= caja.value.replace(" ", "");
    var split = caja.value.split(":");
    if(caja.value.indexOf(":")<0)
    {
        colorearCaja(false);
        caja.title="La cadena no contiene ':'";
        return false;
    }
    if(caja.value.length != 5 )
    {
        colorearCaja(false);
        caja.title="La hora debe de tener la siguiente estructura: \"hh:mm\"";
        return false;

    }
    if(parseInt(split[0])<0 || parseInt(split[0])>23 || split[0].length!=2)
    {
        colorearCaja(false);
        caja.title="El rango valido de horas es de 00 a 23 y de dos digitos";
        return false;
    }
    if(parseInt(split[1])<0 || parseInt(split[1])>59 || split[1].length!=2)
    {
        colorearCaja(false);
        caja.title="El rango valido de minutos es de 00 a 59 y de dos digitos";
        return false;
    }
    else
    {
      colorearCaja(true);
      caja.title="";
      return true;
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

function validaAltaCursos()
{
  var validacion=true;
  if(!validaClaveMateria('new_clave'))
  {
    validacion=false;
  }
  if(!validaNRC('new_nrc'))
  {
    validacion=false;
  }
  if(!validaSeccion('new_seccion'))
  {
    validacion=false;
  }
  for(i=0;i<=id_horario_m;i++)
  {
    if(document.getElementById('cClase_m_'+i))
    {   
      if(!validaHora('Hora_inicio_clase_m_'+i))
      {   
        validacion=false;
      }   
      if(!validaDuracionClase('duracion__m_'+i))
      {   
        validacion=false;
      }   
    }   
  }
  if(validacion)
  {
    agregar_curso();
  }

}

function validaCambiosCursos()
{
  var validacion=true;
  if(!validaClaveMateria('clave_materia'))
  {
    validacion=false;
  }
  if(!validaNRC('nrc'))
  {
    validacion=false;
  }
  if(!validaSeccion('seccion'))
  {
    validacion=false;
  }
  for(i=0;i<=id_horario;i++)
  {
    if(document.getElementById('cClase_'+i))
    {   
      if(!validaHora('Hora_inicio_clase_'+i))
      {   
        validacion=false;
      }   
      if(!validaDuracionClase('duracion__'+i))
      {   
        validacion=false;
      }   
    }   
  }
  if(validacion)
  {
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
  if(idnCExtra>0)
  {
    for(i=1;i<=idnCExtra;i++)
    {
      if(document.getElementById('c_E'+i))
      {
        if(!validaCampoExtra('campoExtraTipo_'+i))
        {
          validacion=false;
        }
        if(!validaCampoExtra('campoExtra_'+i))
        {
          validacion=false;
        }

      }
    }
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
  if( !validaCodigo('login') )
  {
    validacion=false;
  }
  if( !validaPass('password') )
  {
    validacion=false;
  }
  if(validacion)
  {
    var pss = document.getElementById('password');
    pss.value = SHA256( pss.value );
    document.formlogin.submit();
  }
}

function ver_curso() {
  var ciclo = document.getElementById('ciclo_select').value;
  var clave = document.getElementById('curso_select').value.split(' ')[0];
  location = 'index.php?ctl=mis_cursos&ciclo='+ciclo+'&clave='+clave;
}

function ver_evaluacion() {
  var ciclo = document.getElementById('ciclo_select').value;
  var clave = document.getElementById('curso_select').value.split(' ')[0];
  location = 'index.php?ctl=evaluacion&ciclo='+ciclo+'&clave='+clave;
}

function ver_asistencias() {
  var ciclo = document.getElementById('ciclo_select').value;
  var clave = document.getElementById('curso_select').value.split(' ')[0];
  location = 'index.php?ctl=asistencias&ciclo='+ciclo+'&clave='+clave;
}

/********               *******
 *                            *
 *           Helper           *
 *                            *
 ******************************/

function utf8_encode (argString) {
  // http://kevin.vanzonneveld.net
  // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: sowberry
  // +    tweaked by: Jack
  // +   bugfixed by: Onno Marsman
  // +   improved by: Yves Sucaet
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Ulrich
  // +   bugfixed by: Rafal Kukawski
  // +   improved by: kirilloid
  // +   bugfixed by: kirilloid
  // *     example 1: utf8_encode('Kevin van Zonneveld');
  // *     returns 1: 'Kevin van Zonneveld'

  if (argString === null || typeof argString === "undefined") {
    return "";
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
         (c1 >> 6)        | 192,
        ( c1        & 63) | 128
      );
    } else if (c1 & 0xF800 != 0xD800) {
      enc = String.fromCharCode(
         (c1 >> 12)       | 224,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    } else { // surrogate pairs
      if (c1 & 0xFC00 != 0xD800) { throw new RangeError("Unmatched trail surrogate at " + n); }
      var c2 = string.charCodeAt(++n);
      if (c2 & 0xFC00 != 0xDC00) { throw new RangeError("Unmatched lead surrogate at " + (n-1)); }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
         (c1 >> 18)       | 240,
        ((c1 >> 12) & 63) | 128,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}

/**
*
*  Secure Hash Algorithm (SHA256)
*  http://www.webtoolkit.info/
*
*  Original code by Angel Marin, Paul Johnston.
*
**/

function SHA256(s){

  var chrsz   = 8;
  var hexcase = 0;

  function safe_add (x, y) {
    var lsw = (x & 0xFFFF) + (y & 0xFFFF);
    var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
    return (msw << 16) | (lsw & 0xFFFF);
  }

  function S (X, n) { return ( X >>> n ) | (X << (32 - n)); }
  function R (X, n) { return ( X >>> n ); }
  function Ch(x, y, z) { return ((x & y) ^ ((~x) & z)); }
  function Maj(x, y, z) { return ((x & y) ^ (x & z) ^ (y & z)); }
  function Sigma0256(x) { return (S(x, 2) ^ S(x, 13) ^ S(x, 22)); }
  function Sigma1256(x) { return (S(x, 6) ^ S(x, 11) ^ S(x, 25)); }
  function Gamma0256(x) { return (S(x, 7) ^ S(x, 18) ^ R(x, 3)); }
  function Gamma1256(x) { return (S(x, 17) ^ S(x, 19) ^ R(x, 10)); }

  function core_sha256 (m, l) {
    var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5, 0x3956C25B, 0x59F111F1, 0x923F82A4, 0xAB1C5ED5,
                      0xD807AA98, 0x12835B01, 0x243185BE, 0x550C7DC3, 0x72BE5D74, 0x80DEB1FE, 0x9BDC06A7, 0xC19BF174,
                      0xE49B69C1, 0xEFBE4786, 0xFC19DC6, 0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA,
                      0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3, 0xD5A79147, 0x6CA6351, 0x14292967,
                      0x27B70A85, 0x2E1B2138, 0x4D2C6DFC, 0x53380D13, 0x650A7354, 0x766A0ABB, 0x81C2C92E, 0x92722C85,
                      0xA2BFE8A1, 0xA81A664B, 0xC24B8B70, 0xC76C51A3, 0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070,
                      0x19A4C116, 0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A, 0x5B9CCA4F, 0x682E6FF3,
                      0x748F82EE, 0x78A5636F, 0x84C87814, 0x8CC70208, 0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);
    var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372, 0xA54FF53A, 0x510E527F, 0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);
    var W = new Array(64);
    var a, b, c, d, e, f, g, h, i, j;
    var T1, T2;

    m[l >> 5] |= 0x80 << (24 - l % 32);
    m[((l + 64 >> 9) << 4) + 15] = l;

    for ( var i = 0; i<m.length; i+=16 ) {
      a = HASH[0];
      b = HASH[1];
      c = HASH[2];
      d = HASH[3];
      e = HASH[4];
      f = HASH[5];
      g = HASH[6];
      h = HASH[7];

      for ( var j = 0; j<64; j++) {
        if (j < 16) W[j] = m[j + i];
        else W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]), W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);

        T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)), Ch(e, f, g)), K[j]), W[j]);
        T2 = safe_add(Sigma0256(a), Maj(a, b, c));

        h = g;
        g = f;
        f = e;
        e = safe_add(d, T1);
        d = c;
        c = b;
        b = a;
        a = safe_add(T1, T2);
      }

      HASH[0] = safe_add(a, HASH[0]);
      HASH[1] = safe_add(b, HASH[1]);
      HASH[2] = safe_add(c, HASH[2]);
      HASH[3] = safe_add(d, HASH[3]);
      HASH[4] = safe_add(e, HASH[4]);
      HASH[5] = safe_add(f, HASH[5]);
      HASH[6] = safe_add(g, HASH[6]);
      HASH[7] = safe_add(h, HASH[7]);
    }
    return HASH;
  }

  function str2binb (str) {
    var bin = Array();
    var mask = (1 << chrsz) - 1;
    for(var i = 0; i < str.length * chrsz; i += chrsz) {
      bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i%32);
    }
    return bin;
  }

  function binb2hex (binarray) {
    var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
    var str = "";
    for(var i = 0; i < binarray.length * 4; i++) {
      str += hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8+4)) & 0xF) +
      hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8  )) & 0xF);
    }
    return str;
  }

  s = utf8_encode(s);
  return binb2hex(core_sha256(str2binb(s), s.length * chrsz));

}
