function actualizarFiltrosCiudad(ciudad)
{	
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'ciudad', 'valor_de_filtro': ciudad};
	$.post( "core/entry.php",params, function(data)
	{
		$('#select-PDV').children().remove();
		$('#select-PDV').append('<option value="todo">Todas</option>');
		
		if ('pdvs' in data)
		{
			data.pdvs.forEach(function(entry) {
				$('#select-PDV').append('<option value="'+ entry.c_costo_nombre +'">'+entry.nombre_legible+'</option>');
			});
		}
	},'json');
}

function actualizarFiltrosZona(region)
{	
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'zona', 'valor_de_filtro': region};
	$.post( "core/entry.php",params, function(data)
	{
		$('#select-ciudad').children().remove();
		$('#select-ciudad').append('<option value="todo">Todas</option>');
		
		if ('ciudades' in data)
		{
			data.ciudades.forEach(function(entry) {
				$('#select-ciudad').append('<option value="'+ entry +'">'+entry+'</option>');
			});
		}
	},'json');
}

function actualizarFiltrosRegion(region)
{
	
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'region', 'valor_de_filtro': region};
	$.post( "core/entry.php",params, function(data)
	{
		$('#select-zona').children().remove();
		$('#select-zona').append('<option value="todo">Todas</option>');
		
		$('#select-ciudad').children().remove();
		$('#select-ciudad').append('<option value="todo">Todas</option>');
		
		if ('zonas' in data)
		{
			data.zonas.forEach(function(entry) {
				$('#select-zona').append('<option value="'+ entry +'">'+entry+'</option>');
			});
		}
	},'json');
}

function actualizarFiltrosPais(pais)
{
	
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'pais', 'valor_de_filtro': pais};
	$.post( "core/entry.php",params, function(data)
	{
		$('#select-region').children().remove();
		$('#select-region').append('<option value="todo">Todas</option>');
		
		$('#select-zona').children().remove();
		$('#select-zona').append('<option value="todo">Todas</option>');
		
		$('#select-ciudad').children().remove();
		$('#select-ciudad').append('<option value="todo">Todas</option>');
		
		
		if ('regiones' in data)
		{
			data.regiones.forEach(function(entry) {
				$('#select-region').append('<option value="'+ entry +'">'+entry+'</option>');
			});
		}
	},'json');
}

function actualizarFiltros(filtro_padre)
{

	if(filtro_padre.attr('id') == "select-pais")
	{
		actualizarFiltrosPais(filtro_padre.val());
	}
	if(filtro_padre.attr('id') == "select-region")
	{
		actualizarFiltrosRegion(filtro_padre.val());
	}
	if(filtro_padre.attr('id') == "select-zona")
	{
		actualizarFiltrosZona(filtro_padre.val());
	}
	if(filtro_padre.attr('id') == "select-ciudad")
	{
		actualizarFiltrosCiudad(filtro_padre.val());
	}
}

function actualizarFiltrosMapa()
{
	filters = getFilterValues();
	filters['register'] = true;
	$.post( "core/entry_mapa.php",filters, function(data) {
		
		},'json');
}

$( ".priority-value" ).change(function() {
	actualizarFiltros($(this));
	actualizarFiltrosMapa();
	drawGraphs();
});

$( ".period" ).change(function() {
	$('#acumulado_reloj_1').empty();
	$('#ultimo_mes').empty();
	actualizarFiltrosMapa();
	drawGraphs();
});

function llenarPaises(paises)
{
	paises.paises.forEach(function(entry) {
	$('#select-pais').append('<option value="'+ entry +'">'+entry+'</option>');
	});
}

function inicializarFiltroPais()
{
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'inicializar_paises'};
	$.post( "core/entry.php",params, function(data)
	{
		llenarPaises(data);
	},'json');
}

function inicializarFiltroUnidadNegocio()
{
	var params = {'tipo_peticion': 'peticion_filtros', 'filtros_por': 'unidades_negocio'};
	$.post( "core/entry.php",params, function(data)
	{
		
		if ('unidades' in data)
		{
			data.unidades.forEach(function(entry) {
				$('#select-negocio').append('<option value="'+ entry +'">'+entry+'</option>');
			});
		}
		
	},'json');
}

$( document ).ready(function(){
	inicializarFiltroPais();
	inicializarFiltroUnidadNegocio();
});