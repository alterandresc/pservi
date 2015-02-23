//48.879859
function callback(data)
{
	for (var i = 0; i < data.length; i++)
	{
		var params = {'nombre': data[i][0], 'latitud': data[i][2], 'longitud': data[i][3]};
		$.post( "core/actualizar_datos.php",params, function(data1){},'json');
	}
}