      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.load('visualization', '1', {packages:['gauge']}); 

      // Set a callback to run when the Google Visualization API is loaded.
      //la funcitón está creada en calls.js
      google.setOnLoadCallback(drawGraphs); 
	
	  function getPeriodArray()
	  {
		vals = new Array();
		i = 0;
		$.each($(".period"), function() {
			if($(this).is(':checked'))
			{
				vals[i] = $(this).val();
				i++;
			} 
		});
		return vals;
	  }

      function getFilterValues()
      {
		filterValues ={	'select-pais':$('#select-pais').val(),
						'select-region':$('#select-region').val(),
						'select-zona':$('#select-zona').val(),
						'select-ciudad':$('#select-ciudad').val(),
						'select-PDV':$('#select-PDV').val(),
						'select-negocio':$('#select-negocio').val(),
						'select-bandera':$('#select-bandera').val(),
						'periods':getPeriodArray(),
					};
		return filterValues;
	  }