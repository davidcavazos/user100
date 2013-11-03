(function($){
	$('fecha_inicio').datepicker({ 
        clearText: 'Borrar',
        clearStatus: 'Borrar fecha actual',
        closeText: 'Cerrar',
        closeStatus: 'Cerrar sin guardar',
        dateFormat: 'yy-mm-dd',
        dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi', 'Sa'],
        firstDay: 0,
        inline: true,
        monthName: ['Enero','Febrero','Marzo','Abril',
                    'Mayo','Junio','Julio','Agosto',
                    'Septienbre','Octubre','Novienbre','Diciembre'],
        monthNameShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        prevStatus: 'Mostrar mes anterior', 
        prevBigStatus: 'Mostrar año anterior',
        showOtherMonths: true
     });
})(jQuery);