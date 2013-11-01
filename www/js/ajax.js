function create_ajax() {
  var xmlhttp = false;
  try {
    // no IE
    xmlhttp = new ActiveXObject('Msxml2.XMLHTTP');
  } catch (e) {
    try {
      // IE
      xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    } catch (E) {
      if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
      }
    }
  }
  return xmlhttp;
}
