      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it
      
      
      
      function drawChart() {
		  
		  	filters = getFilterValues();
			filters['nombre_grafica']= 'obtener_general_acum_tiendas_v2';
			filters['pregunta']= 'indice';
			
		  
		//this posts takes a json string returned by the server and the draw the data
		$.post( "core/entry.php",filters, function(data1) {

			var data2 = google.visualization.arrayToDataTable(data1);
			
			
  
			// Set chart options
			var options = {'title':'Satisfacción General Por Periodo',
                 'width':500,
                 'height':450,
                 'colors': ['#109618', '#FF9900', '#DC3912'],
                 'pointSize' : 5,
                 'colors': [ '#0000FF'],
                 'titleTextStyle' : {'fontSize': 12},
                 'vAxis': { 'ticks': [0,25,50,75,100] },
                };

			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data2, options);			
		},'json');
		
		
			filters = getFilterValues();
			filters['nombre_grafica']= 'obtener_promedio_acumulado_pregunta';
			filters['pregunta']= 'p2e';
			$.post( "core/entry.php",filters, function(data1) {
        	
				
        	},'json');
      }