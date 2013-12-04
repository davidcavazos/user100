var cciclonrc;
var rubros="";
var rubrosp="";
var subrubros="";
var subrubrosp="";
function on_load() {
  ciclo = document.getElementById('ciclo_select').value;
  nrc = document.getElementById('curso_select').value.split(" ")[0];
  cciclonrc=ciclo+nrc;
  curso_valido = true;
  if (ciclo == '') {
    document.getElementById('ciclo_select').disabled = true;
    curso_valido = false;
  }
  if (nrc == '') {
    document.getElementById('curso_select').disabled = true;
    curso_valido = false;
  }
  if (!curso_valido) {
    document.getElementById('ver_curso').disabled = true;
    document.getElementById('ver_asistencias').disabled = true;
    document.getElementById('alumno').disabled = true;
    document.getElementById('inscribir_alumno').disabled = true;
    document.getElementById('leer_csv_alumnos').disabled = true;
    document.getElementById('agregar_rubro').disabled = true;
    document.getElementById('agregar_subtabla').disabled = true;
    document.getElementById('elim_rubros').disabled = true;
    document.getElementById('select_all').disabled = true;
  }
}

function toggle_botones() {
  num = 0;
  activado = false;
  do {
    num += 1;
    ex = document.getElementById(num);
    if (ex != null && ex.checked) {
      activado = true;
    }
  } while (ex != null);

  document.getElementById('elim_alumno').disabled = !activado;
}

function autocomplete_alumno() {
  alumno = document.getElementById('alumno').value;
  button = document.getElementById('inscribir_alumno');
  button.disabled = true;
  $.ajax({
    type: 'POST',
    data: {get_alumnos:'',ciclonrc:cciclonrc},
    dataType: 'json',
    success: function(info) {
      var tags = [];
      for (i = 0; i < info.length; i++) {
        tags.push(info[i]);
        if (info[i] == alumno) {
          button.disabled = false;
        }
      }
      $("#alumno").autocomplete({source: tags});
    }
  });
}

function inscribir_alumno() {
  alumno = document.getElementById('alumno').value;
  alumno=alumno.substring(alumno.indexOf("(")+1,alumno.indexOf(")"));
  $.ajax({
    type: 'POST',
    data: {alta_cursos:'',codigo:alumno, ciclonrc:cciclonrc},
    success: function(info) 
    {
      location.reload(); 
    }
  });
}

function enviarArchivo()
{
  ciclo = document.getElementById('ciclo_select').value;
  nrc = document.getElementById('curso_select').value.split(" ")[0];
  document.getElementById('subirarchivo').action='index.php?ctl=evaluacion'+
  "&ciclo="+ciclo+"&nrc="+nrc+"";
  document.getElementById('subirarchivo').submit();
}

function anadirRubros()
{
  $.ajax({
    type: 'POST',
    data: {alta_rubros:'',rubros:rubros, rubrosp:rubrosp, subrubros:subrubros, subrubrosp:subrubrosp},
    success: function(info) 
    {
      location.reload(); 
    }
  });
}
