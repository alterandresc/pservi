function drawChart70() {
   
   // Create the data table.
   
   	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_promedio_acumulado_multi';
	filters['pregunta']= 'multi';
	filters['preguntas']= ['p2a','p2b','p2c','p2d','p2e','p2f'];
	
			$.post( "core/entry.php",filters, function(data1) {
	
	
   var data = google.visualization.arrayToDataTable(data1);
  


  // Set chart options
  var options = {'title':'Promedio Satisfacción Aspectos - Por Periodos',
                 'width':900,
                 'height':350,
                 'colors': ['#5b9bd5', '#ed7d31', '#b1b1b1', '#ffc000', '#4472c4', '#70ad47'],
                 'pointSize' : 5,
                 'titleTextStyle' : {'fontSize': 12},
                 'vAxis': { 'ticks': [0,1,2,3,4,5] },
                };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.LineChart(document.getElementById('chart_div_70'));
  chart.draw(data, options);
  
      },'json');
     
}