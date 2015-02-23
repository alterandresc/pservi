// JavaScript Document

// The web service URL from Drive 'Deploy as web app' dialog.
var DATA_SERVICE_URL = "https://script.google.com/macros/s/AKfycbwj52hkFlslYBwkQ9YbY17SDrkQscX_ILvG-xf18iW9jc_G0dQC/exec?jsonp=callback";
var $icono0 = "http://www.synapsis-rs.com/gris.png";
var $icono1 = "http://www.synapsis-rs.com/rojo.png";
var $icono2 = "http://www.synapsis-rs.com/naranja.png";
var $icono3 = "http://www.synapsis-rs.com/verde.png";
// icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|000000|FFF',
// http://maps.google.com/mapfiles/ms/icons/blue-dot.png
var map;
var map_options;
var map_canvas;
var marker;

function poner_marcadores()
{	
	var scriptElement = document.createElement('script');
	scriptElement.src = DATA_SERVICE_URL;
	document.getElementsByTagName('head')[0].appendChild(scriptElement);
}

function poner_marcadores_aplicando_filtros(filters)
{
	
	//alert("y los filtors");
	//alert(JSON.stringify(filters));
	
	filters['nombre_grafica'] ='obtener_pdvs_segun_filtros';
	$.post( "../core/entry.php",filters, function(data1)
	{
		//alert(JSON.stringify(data1));
		var i =0 ;
		data1.forEach(function(entry)
		{
			i++;
		if (entry.icono == 0) {$icono = $icono0};
		if (entry.icono == 1) {$icono = $icono1};
		if (entry.icono == 2) {$icono = $icono2};
		if (entry.icono == 3) {$icono = $icono3};
		
		//hack
		if(Array.isArray(entry.valor))
		{
			$icono = $icono0;
			entry.valor = 0;
			entry.datos = 0;
		}
			marker = new google.maps.Marker({position: new google.maps.LatLng(entry.latitud, entry.longitud), map: map,icon: $icono, content: entry.nombre,title: entry.nombre + " puntaje: "+entry.valor + " datos: " + entry.datos, id: i});
				
				
		// Procedmiento deCLick 
		google.maps.event.addListener(marker, 'click',(function(marker_inner)
			{
				return function()
					{
						map.setZoom(15);
						map.setCenter(marker_inner.getPosition());
					}
			})(marker)			
		); 
		
		// Procedmiento deCLick 
		google.maps.event.addListener(marker, 'rightclick',(function(marker_inner)
			{
				return function()
					{
						    
						    //window.location.href = "prueba.html";						
							alert(marker_inner.content);
					}
			})(marker)			
		); 	
			

			
			
		});
	},'json');
}
	
function callback(data)
{
	for (var i = 0; i < data.length; i++)
	{
		var $icono = $icono0;
		if (data[i][1] == 0) {$icono = $icono0};
		if (data[i][1] == 1) {$icono = $icono1};
		if (data[i][1] == 2) {$icono = $icono2};
		if (data[i][1] == 3) {$icono = $icono3};
		marker = new google.maps.Marker({position: new google.maps.LatLng(data[i][2], data[i][3]), map: map,icon: $icono, content: data[i][4],title:data[i][0], id: i});	
		
		 
		// Procedmiento deCLick 
		google.maps.event.addListener(marker, 'click',(function(marker_inner)
			{
				return function()
					{
						map.setZoom(15);
						map.setCenter(marker_inner.getPosition());
					}
			})(marker)			
		); 
		
		// Procedmiento deCLick 
		google.maps.event.addListener(marker, 'rightclick',(function(marker_inner)
			{
				return function()
					{
						    
						    //window.location.href = "prueba.html";						
							alert(marker_inner.content);
					}
			})(marker)			
		); 		
		
	}
	
}



function Modelo($ciudad) {
	
	var xx=0;
	var yy=0;
	if ($ciudad==1)	{xx =4.598072987977448;yy =-74.0760678930664;}
	if ($ciudad==2) {xx =4.141068107105964;yy =-73.62934112548828;}
	if ($ciudad==3)	{xx =5.534490696057883;yy =-73.3572149276734;}
	if ($ciudad==4) {xx =5.333011501430981;yy =-72.39380836486816;}	
	if ($ciudad==5) {xx =-12.04795868844539;yy =-77.06200816494142;}
	if ($ciudad==6) {xx =9.923779849111742;yy =-84.08150191457513;}
	
	
	map.setZoom(12);
	var latLng = new google.maps.LatLng(xx, yy);
	map.setCenter(latLng);	

}

function initialize()
{
	map_canvas = document.getElementById('map_canvas');
	map_options ={center: new google.maps.LatLng(0, -74), zoom: 5, mapTypeId: google.maps.MapTypeId.ROADMAP};
	map = new google.maps.Map(map_canvas, map_options);
	
	var options = {};
	$.post( "../core/entry_mapa.php",options, function(data1)
	{
		//alert(JSON.stringify(data1));
		poner_marcadores_aplicando_filtros(data1);
	},'json');
}
               
	

 
function getCircle(magnitude)
{
	var circle = {path: google.maps.SymbolPath.CIRCLE, fillColor: 'red', fillOpacity: .2, strokeColor: 'white', strokeWeight: .5, scale: magnitude};
	return circle;
}

function addInfoWindow(marker, message)
{
	var info = message;
	
	var infoWindow = new google.maps.InfoWindow({
		content: message
	});
	
	google.maps.event.addListener(marker, 'click', function () {
		infoWindow.open(map, marker);
	});
}