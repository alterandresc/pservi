function drawChart110() {
   
   
    filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_promedio_acumulado_multi';
	filters['pregunta']= 'multi';
	filters['preguntas']= ['p3a','p3b','p3c','p3d','p3e','p3f','p3g','p3h'];
   // Create the data table.
   
   	$.post("core/entry.php",filters, function(data1) {
   var data = google.visualization.arrayToDataTable(data1);
  


  // Set chart options
  var options = {'title':'Promedio Nivel De Acuerdo Frases - Por Periodos',
                 'width':900,
                 'height':350,
                 'colors': ['#5b9bd5', '#ed7d31', '#a5a5a5', '#ffc000', '#4472c4', '#70ad47', '#1c5183', '#b8794e'],
                 'ticks':[0,5,15,20],
                 'pointSize' : 5,
                 'titleTextStyle' : {'fontSize': 12},
                 'vAxis': { 'ticks': [0,1,2,3,4,5] },
                };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.LineChart(document.getElementById('chart_div_110'));
  chart.draw(data, options);
  
  
        },'json');
     
}