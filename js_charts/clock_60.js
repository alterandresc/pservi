function drawChart60() {
	
	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_promediop2_acum';
	filters['pregunta']= 'p2_acum';
	
	$.post( "core/entry.php",filters, function(data1) {

	
        var data = google.visualization.arrayToDataTable(data1);

        var options = {
          width: 230, height: 200,
          redFrom: 0, redTo:3,
          yellowFrom:3, yellowTo: 4,
          greenFrom:4, greenTo: 5,
          majorTicks: ['1','2','2.7','3','4','5'],
          max: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div_60'));
        chart.draw(data, options);
      
      
      },'json');
	
	}