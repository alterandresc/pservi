function drawChart150() {

	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_general_acum_b2';
	filters['pregunta']= 'b2';
	
$.post( "core/entry.php",filters, function(data1) {
   var formatter = new google.visualization.NumberFormat({pattern:'#,###%'});
   // Create the data table.
   var data = google.visualization.arrayToDataTable(data1);
  
  //necesary for display "80%" instead of  "0.8", must format every single line
  formatter.format(data,1);
  formatter.format(data,2);


  // Set chart options
  var options = {'title':'Expectativas Acumuladas',
                 'width':400,
                 'height':350,
                 'vAxis': {format:'#%'},
                 'colors': ['#109618',  '#DC3912'],
                 'pointSize' : 5,
                 'titleTextStyle' : {'fontSize': 12},
                  'isStacked': true,
                };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_150'));
  chart.draw(data, options);
  
    },'json');
     
}