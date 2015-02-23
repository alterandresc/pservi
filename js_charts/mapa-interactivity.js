$( document ).ready(function(){
	filters = {};
	//alert("poniendo filtros");
	//$.post( "../core/entry_mapa.php",filters, function(data) {
		
		//$("#pais-enq").val(data.select-pais);
		//$("#region-enq").val(data.region);
		//$("#zona-enq").val(data.zona);
		//$("#ciudad-enq").val(data.ciudad);
		//$("#pdv-enq").val(data.pdv);
		//$("#negocio-enq").val(data.negocio);
		
		//if ('periods' in data)
		//{
		//	$('#periods_container').empty();
		//	data.periods.forEach(function(entry) {
		//		$('#periods_container').append('<input type="text" class="period" value="'+ entry +'">');
		//	});
		//}
		//},'json');
		
		google.maps.event.addDomListener(window, 'load', initialize);
}); 


	function getPeriodArray()
	  {
		vals = new Array();
		i = 0;
		$.each($(".period"), function() {
				vals[i] = $(this).val();
				i++;
		});
		return vals;
	  }

      function getFilterValues()
      {
		filterValues ={	'select-pais':$('#pais-enq').val(),
						'select-region':$('#region-enq').val(),
						'select-zona':$('#zona-enq').val(),
						'select-ciudad':$('#ciudad-enq').val(),
						'select-PDV':$('#pdv-enq').val(),
						'select-negocio':$('#negocio-enq').val(),
						'periods':getPeriodArray(),
					};
		return filterValues;
	  }