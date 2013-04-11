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
<body id="top">
	<div class="main-container">
		<header class="main-header">
			<a href="/" id="logo"><img src="/public/img/logo.png" alt="Han-Bud"></a>
			
			<div class="titles">
				<p class="additional">Ogrody</p>
				<p>Projektowanie i pięlegnacja</p>
			</div>

			<nav>
				<ul class="main-menu">
					<li><a href="/hanbud/home">Strona główna</a></li>
					<li><a href="">Oferta</a></li>
					<li><a href="">O firmie</a></li>
					<li><a href="">Galeria</a></li>
					<li><a href="">Kontakt</a></li>
				</ul>
			</nav>

			<div class="slogan top-1"></div>
		</header>

		<div class="content-section">
			{% block content %} {% endblock %}
		</div>

		<div class="aside-section">
			<section class="content-box-1">
				<h2>Kontakt</h2>

				<ul class="quick-contact">
					<li><span class="phone"></span> 517 268 822</li>
					<li><span class="phone"></span> 518 868 222</li>
				</ul>
			</section>

			<nav class="content-box-1">
                            {% include 'menu.tpl.php' %}

			</nav>

			<ul class="quick-contact light">
				<li><span class="phone-light"></span> 517 268 822</li>
			</ul>
		</div>

		<footer class="main-footer">
			<p>&copy; 2013 Han-Bud. Wszelkie prawa zastrzeżone.</p>
			<a href="#top" id="to-top" title="Wróc do góry">Do góry</a>
		</footer>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/public/js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
	<script src="/public/js/plugins.js"></script>
	<script src="/public/js/main.js"></script>
        <script>
        $(document).ready(function() {
            $('#nested-menu li[rel="{{category.id}}"]').addClass('active');
        });
        </script>
</body>
</html>