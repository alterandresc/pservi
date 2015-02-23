	function drawChart30() {

	
	
	filters = getFilterValues();
	filters['nombre_grafica']= 'general_acum';
	filters['pregunta']= 'p1';
	
	$.post( "core/entry.php",filters, function(data1) {
		
		   var formatter = new google.visualization.NumberFormat({pattern:'#,###%'});
		   
		   var data = google.visualization.arrayToDataTable(data1);
		// Create the data table.
		//  var data = google.visualization.arrayToDataTable([
		//	 ['x', 'Alto', 'Medio', 'Bajo'],
		//	 ['P1 - XXX',0.2,0.9 ,0.80],
		//   ]);
		  
		  //necesary for display "80%" instead of  "0.8", must format every single line
		  formatter.format(data,1);
		  formatter.format(data,2);
		  formatter.format(data,3);

		  // Set chart options
		  var options = {'title':'Satisfacción General Acum',
						 'width':400,
						 'height':350,
						 'vAxis': {format:'#%'},
						 'colors': [ '#109618', '#FF9900','#DC3912'],
						 'pointSize' : 5,
						 'titleTextStyle' : {'fontSize': 12},
						 'isStacked': true,
						};

		  // Instantiate and draw our chart, passing in some options.
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_30'));
		  chart.draw(data, options);
		
		
		},'json');


     
}