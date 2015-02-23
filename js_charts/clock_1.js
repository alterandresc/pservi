function drawChart2() {
	
	filters = getFilterValues();
	filters['nombre_grafica']= 'obtener_general_acum_tiendas_relojes';
	filters['pregunta']= 'acumulado';
	
	
		$.post( "core/entry.php",filters, function(data1) {
        //alert(data1);
        var data = google.visualization.arrayToDataTable(data1);
		

        var options = {
          width: 400, height: 350,
          redFrom: 0, redTo:70,
          yellowFrom:70, yellowTo: 95,
          greenFrom:95, greenTo: 100,
          minorTicks: 5,
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div_20'));
        chart.draw(data, options);
        
              },'json');
              
             
       filters['solo_cantidad_datos']= 'si'; 
            $.post( "core/entry.php",filters, function(data1)
            {
				if ('acumulado' in data1)
				{
					$('#acumulado_reloj_1').empty();
					$('#acumulado_reloj_1').html(data1.acumulado);
				}
				if ('ultimo_mes' in data1)
				{
					$('#ultimo_mes').empty();
					$('#ultimo_mes').html(data1.ultimo_mes);
				}
				
			},'json');
        
        
        
      }