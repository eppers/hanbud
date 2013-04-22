<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<title>Hanbud - {% block page_title %} {% endblock %}</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" media="screen, projection" href="/public/css/screen.css" />
	<script src="/public/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body id="top" onload="mapaStart()">
	<div class="main-container">
		<header class="main-header">
			<a href="/" id="logo"><img src="/public/img/logo.png" alt="Han-Bud"></a>
			
			<div class="titles">
				<p class="additional">Kompleksowe</p>
				<p>Zaopatrzenie Twojej budowy</p>
			</div>

			<nav>
				<ul class="main-menu">
					<li><a href="/home" rel="menu1">Strona główna</a></li>
					<li><a href="" rel="menu2">Oferta</a></li>
					<li><a href="" rel="menu3">O firmie</a></li>
					<li><a href="" rel="menu4">Allegro</a></li>
					<li><a href="/kontakt" rel="menu5">Kontakt</a></li>
				</ul>
			</nav>

			<div class="slogan top-1"></div>
		</header>

		<div class="content-section">
			{% block content %} {% endblock %}
		</div>

		<div class="aside-section">

			<nav class="content-box-1">
                            {% include 'menu.tpl.php' %}

			</nav>

			<ul class="quick-contact light">
				<li><span class="phone-light"></span> 789 451 307</li>
			</ul>
		</div>

		<footer class="main-footer">
			<p>&copy; 2013 Han-Bud. Wszelkie prawa zastrzeżone.</p>
			<a href="#top" id="to-top" title="Wróc do góry">Do góry</a>
		</footer>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/public/js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
        <script src="/public/js/jquery-ui-1.8.18.custom.min.js"></script>        
	<script src="/public/js/plugins.js"></script>
	<script src="/public/js/main.js"></script>
        <script>
        $(document).ready(function() {
            $('#nested-menu li[rel="{{category.id}}"]').addClass('active');
        });
        </script>
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>   
        <script type="text/javascript">   
        <!-- 

               var mapa;
		var dymek = new google.maps.InfoWindow(); // zmienna globalna
		
		function dodajMarker(lat,lng,txt)
		{
			// tworzymy marker
			var opcjeMarkera =   
			{  
				position: new google.maps.LatLng(lat,lng),  
				map: mapa
			}  
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;
			
			google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});
			return marker;
		}
		
		function mapaStart()   
		{   
			var wspolrzedne = new google.maps.LatLng(49.85403,18.996394);
			var opcjeMapy = {
			  zoom: 13,
			  center: wspolrzedne,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			mapa = new google.maps.Map(document.getElementById("google-map"), opcjeMapy); 
			var marker = dodajMarker(49.84403,18.996394,'<strong>F.H.U. HAN-BUD Adrian Pawlisz</strong><br>Mazańcowice 57<br>43-391 Mazańcowice<br><br>789-451-307<br>tel./fax 33-815-50-13<br>email: hanbudbielsko@gmail.com');
			google.maps.event.trigger(marker,'click');
		}   

        -->
        </script>  
        {% if rel is not empty %}
        <script>
         <!-- 
             $(document).ready(function() {
                 $('.main-menu a[rel="{{rel}}"]').addClass('active');
             });
 
         -->
        </script>
        {% endif %}
</body>
</html>