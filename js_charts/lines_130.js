function drawChart130() {
	
	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_general_acum_b';
	filters['pregunta']= 'b1';
	
	$.post( "core/entry.php",filters, function(data1) {

   var formatter = new google.visualization.NumberFormat({pattern:'#,###%'});
   
   // Create the data table.
   var data = google.visualization.arrayToDataTable(data1);
  
  //necesary for display "80%" instead of  "0.8", must format every single line
  formatter.format(data,1);
  formatter.format(data,2);
  formatter.format(data,3);


  // Set chart options
  var options = {'title':'Recomendación Acumulada',
                 'width':400,
                 'height':350,
                 'vAxis': {format:'#%',ticks: [.0,.20, .40, .60, .80,.100]},
                 'colors': ['#109618', '#FF9900', '#DC3912'],
                 'pointSize' : 5,
                 'titleTextStyle' : {'fontSize': 12},
                  'isStacked': true,
                };

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_130'));
  chart.draw(data, options);
  
  },'json');


     
}