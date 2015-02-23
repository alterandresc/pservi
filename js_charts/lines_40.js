function drawChart40() {


	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_satisfaccion_general_periodo';
	filters['pregunta']= 'p1';
	
	$.post( "core/entry.php",filters, function(data1) {

		//alert(data1);

		   var formatter = new google.visualization.NumberFormat({pattern:'#,###%'});
		   
		   // Create the data table.
		   var data = google.visualization.arrayToDataTable(data1);
		   
		//   [
		//	 ['x', 'Alto', 'Medio', 'Bajo'],
		//	 ['Dic-13',0.,0.50 ,0.20],
		//	 ['Ene-14',   0.80, 0.40,0.35],
		//	 ['Feb-14',  0.70, 0.43,0.18],
		//  ]
		  
		  //necesary for display "80%" instead of  "0.8", must format every single line
		  formatter.format(data,1);
		  formatter.format(data,2);
		  formatter.format(data,3);


		  // Set chart options
		  var options = {'title':'Satisfacción General Por Periodo',
						 'width':600,
						 'height':350,
						 'vAxis': {format:'#%'},
						 'colors': ['#109618', '#FF9900', '#DC3912'],
						 'pointSize' : 5,
						};

		  // Instantiate and draw our chart, passing in some options.
		  var chart = new google.visualization.LineChart(document.getElementById('chart_div_40'));
		  chart.draw(data, options);
  
  },'json');
     
}