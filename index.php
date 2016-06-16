<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<!-- Java Script
   ================================================== -->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.fittext.js"></script>
<script src="js/jquery.placeholder.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script src="js/honeytrack.js"></script>
<!-- Google ApI -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDk7tF0HN2c5abGBRv5d3tDuK-dRkRiJ8k"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!-- JQUERY UI PARA DIALOG -->
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!--- basic page needs
   ================================================== -->
<meta charset="utf-8">
<title>HoneyTrack</title>
<meta name="description" content="HoneyTrack Project">
<meta name="author" content="@MPAlonso_">

<!-- mobile specific metas
   ================================================== -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
   ================================================== -->
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/vendor.min.css">
<link rel="stylesheet" href="css/main.css">

<!-- script
   ================================================== -->
<script src="js/modernizr.js"></script>

<!-- favicons
	================================================== -->


</head>

<body>
	<?php include 'AjaxController.php'?>
	<!-- header
   ================================================== -->
   <?php include 'menu.php'; ?>
<form name="formulario" id="formulario" method="post" action="index.php">
	<div id="divResultMap">
		<div id="map_canvas" style="width: 100%; height: 100%;"></div>
	</div>

		<!-- homepage hero
   ================================================== -->
		<section id="inicio">

			<div class="row hero-content">

				<div class="twelve columns">

					<h2>
						Honey Track<span>.</span>
					</h2>

					<p>HoneyTrack is a system that together different honeypots (Kippo,
						Dionaea and Glastopf) for the study of attacks. It is a honeypot.
						We can analyze the attacks and show a series of statistics and
						track down the attackers.
					
					
					<p>It is a job for the superior degree of management systems, the
						importance of studying the attack has demonstrated in recent
						years, now more than ever organizations and public entities are
						committed to safety. This project is focused to the study of
						attacks by traps. Please if you use this project do not forget to
						indicate the source, being a free project against bringing more
						people there are much better for the project.</p>
				</div>
			</div>
			<!-- end twelve columns-->

			
			<!-- end row -->

		</section>
		<!-- end homepage hero -->


		<!-- Services Section
   ================================================== -->
		<section id="attacks">

			<div class="row section-head">

				<div class="twelve columns">

					<h1>
						Kippo<span>.</span>
					</h1>
					<label>Buscar todos los ataques: </label> <input type="button"
						name="botsearchattack" value="Mostrar"
						onClick="js:callAjax('option=searchallattack')"> <input
						type="button" onClick="js:downloadAttack()"
						name="botdownloadattack" value="Descargar"><br /> <label>Buscar IP
						de Ataque: </label><input type="text" width="20" maxlength="15"
						name="ipattack" id="ipattack"> <input type="button"
						name="botipattack" value="Buscar"
						onClick="js:callAjax('option=searchipattack&ip='+ document.getElementById('ipattack').value)"><br />
					<label>Buscar ID de Session: </label><input type="text"
						name="sessionattack" id="sessionattack"> <input type="button"
						name="botsessionattack" value="Buscar"
						onClick="js:callAjax('option=searchsessionattack&id='+ document.getElementById('sessionattack').value)"><br />
					<label>Buscar codigo pais (ISO-3166-1): </label><input type="text"
						name="codecountry" id="codecountry" maxlength="2"> <input
						type="button" name="botcodcountry" value="Buscar"
						onClick="js:callAjax('option=searchcountry&pais='+ document.getElementById('codecountry').value)">
				</div>
				<div class="twelve columns">

					<h1>
						Dionaea<span>.</span>
					</h1>
					<label>Buscar todos los ataques: </label> <input type="button"
						name="botsearchattackdio" value="Buscar"
						onClick="js:callAjax('option=attackdio')"><br /> <label>Buscar
						inicios de sesion: </label><input type="button"
						name="botsessionini" value="Buscar"
						onClick="js:callAjax('option=logindio')"><br /> <label>Buscar por
						número de conexion: </label><input type="text"
						name="conectiondio" id="conectiondio"> <input type="button"
						name="botnumsession" value="Buscar"
						onClick="js:callAjax('option=searchconect&conection='+ document.getElementById('conectiondio').value)"><br />
				</div>
				<div class="twelve columns">

					<h1>
						Glastopf<span>.</span>
					</h1>
					<label>Buscar todas las urls usadas: </label> <input type="button"
						name="botsearchevent" value="Buscar"
						onClick="js:callAjax('option=inurlattack')"><br /> <label>Tipos de
						ficheros usados: </label><input type="button" name="botevents"
						value="Buscar" onClick="js:callAjax('option=filetypeattack')"><br />
					<label>Eventos: </label><input type="button" name="botevents"
						value="Buscar" onClick="js:callAjax('option=events')"><br />
				</div>
			</div>
			<!-- end section-head -->


			</div>
			<!-- end row -->

		</section>
		<!-- end services -->


		<!-- Result Section
   ================================================== -->
		<section id="result">

			<div class="row section-head"></div>
			<!-- end section-head -->


			<div class="row">

				
					<div id="team-wrapper"
						class="bgrid-fourth s-bgrid-third tab-bgrid-half mob-bgrid-whole group">
						<div class="bgrid member">

							<div class="member-pic">
								<a href="#" onclick="js:callAjaxLocAttacks('option=locattack');"><img
									src="images/team/google.jpg" /> </a>

							</div>
							<div class="member-name">
								<h3>Loc Attack</h3>
							</div>

							<p>Geolocation Attack Kippo: Geolocation system attackers using
								Google API is shown IP, Country, City, Street approximate. Greet
								Comrade camera.</p>
						</div>
						<!-- end member -->
						<div class="bgrid member">

							<div class="member-pic">
								<a href="#" onclick="js:callAjaxStatistics('option=statsKippo');"><img
									src="images/team/Ks.png" /> </a>
							</div>
							<div class="member-name">
								<h3>Kippo Statistics</h3>
							</div>

							<p>Using Highcharts have generated a statistical attack to show
								among other things most commonly used user name and password, a
								country that has attacked ... etc. In the future they will
								develop more.</p>

						</div>
						<!-- end member -->

						<div class="bgrid member">

							<div class="member-pic">
								<a href="#" onclick="js:callAjaxStatisticsDio('option=statsDionaea');"><img
									src="images/team/Ds.png" /> </a>
							</div>
							<div class="member-name">
								<h3>Dionaea Statistics</h3>
							</div>

							<p>In statistics we see the most used Dionaea attacks (per port
								connection), users and passwords used ... etc.</p>
						</div>
						<!-- end member -->

					<div class="bgrid member">

						<div class="member-pic">
							<a href="#" onclick="js:callAjaxStatisticsGlas('option=statsGlastopf');">
								<img src="images/team/Gs.png" />
							</a>
							
						</div>
						<div class="member-name">
							<h3>Glastopf Statistics</h3>
						</div>

						<p>Statistics glastopf a web honeypot that emulates thousands of vulnerabilities. In this Gallery Statistics attacks ratio shown towards this honeypot</p>

					</div>
					<!-- end member -->

				</div>
				<!-- end team-wrapper -->

			</div>
			<!-- end row -->



		</section>
		<!-- end about -->


		<!-- Testimonials Section
   ================================================== -->
		<section id="contact">
			<h2>
				Issues & About Us<span>.</span>
			</h2>
			<div id="call-to-action">

				<div class="row section-ads">
					<div class="twelve columns">

						<h2>
							Issues<span>.</span>
						</h2>

						<p>
							If you encounter problems when installing, configuring and / or
							boot up, please file a bug in the following github. <a
								href="https://github.com/anubis7/HoneyTrack-beta-1/issues/new">GitHub</a>
						</p>
						<p></p>
					</div>
					<p>
					
					
					<p>
					
					
					<p></p>
					</p>
					</p>

					<div class="twelve columns">

						<h2>
							About us<span>.</span>
						</h2>

						<p>This work is free to use and free modification, the
							corresponding license has not yet been processed. This work is
							uploaded at the following address github for free use. The
							purpose of this project is purely academic. Any alternative use
							is authorized but will not be my problem. I promise to update it.
							Little kisses. To contact we can use social networks above, if
							you have any errors please report it on github, promise to be
							careful.</p>
						<p>
						
						
						<div class="image">
							<img src="images/team/pic.jpg" height="150" width="170" />
						</div>
						</p>
						<ul class="member-social">
							<a href="https://twitter.com/mpalonso_"><i class="fa fa-twitter"></i></a>
							</li>
						</ul>


					</div>
					<!-- end section-ads -->

				</div>
				<!-- end call-to-action -->
				<p></p>
		
		</section>
		<!-- end testimonials section -->

		<!-- Footer
   ================================================== -->
		<footer>



			<ul class="copyright">
				<li>&copy; Copyright 2015 KREO.</li>
				<li>Design by <a href="http://www.styleshout.com/">Styleshout.</a>.
				</li>
			</ul>



			</div>
			<!-- end row -->

		</footer>
		<!-- end footer -->

		<div id="preloader">
			<div id="loader"></div>
		</div>
		<div id="divResult">
			<div id="div_datos"></div>

		</div>
		<div id="divResultStatisticKippo" style="text-align: right;">
			<div id="resultKippo1" style="text-align: right;"></div>
			<div id="resultKippo2"></div>
		</div>
		<div id="divResultStatisticDio" style="text-align: right;">
			<div id="resultDio1"></div>
		</div>
		<div id="divResultStatisticGlas" style="text-align: right;">
			<div id="resultGlas1"></div>
		</div>
		
	</form>
<script language="javascript">
$( document ).ready(function() {
	$( "#divResultMap" ).dialog({
        autoOpen:false,
        width: 855,
        height: 500,
        resizeStop: function(event, ui) {google.maps.event.trigger(map, 'resize')  },
        open: function(event, ui) {google.maps.event.trigger(map, 'resize'); }      
    }); 
	initialize();
    init_dialog("divResult"); 
    init_dialog("divResultStatisticKippo");
    init_dialog("divResultStatisticDio");
    init_dialog("divResultStatisticGlas");
    $("#preloader").on("ajaxStart", function() {
  	  // this hace referencia a la div con la imagen. 
  	  $(this).show();
  	}).on("ajaxStop", function() {
  	  $(this).hide();
  	});
     $("#preloader").hide();
});

</script>
</body>

</html>