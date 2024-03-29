<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hanbud - panel administracyjny</title>

        <link rel="stylesheet" href="/public/admin/css/screen.css" type="text/css" media="screen" title="default" />

        <link href="/public/admin/css/charisma-app.css" rel="stylesheet" />
	<link href="/public/admin/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<link href='/public/admin/css/fullcalendar.css' rel='stylesheet' />
	<link href='/public/admin/css/fullcalendar.print.css' rel='stylesheet'  media='print' />
	<link href='/public/admin/css/chosen.css' rel='stylesheet' />
	<link href='/public/admin/css/uniform.default.css' rel='stylesheet' />
	<link href='/public/admin/css/colorbox.css' rel='stylesheet' />
	<link href='/public/admin/css/jquery.cleditor.css' rel='stylesheet' />
	<link href='/public/admin/css/jquery.noty.css' rel='stylesheet' />
	<link href='/public/admin/css/noty_theme_default.css' rel='stylesheet' />
	<link href='/public/admin/css/elfinder.min.css' rel='stylesheet' />
	<link href='/public/admin/css/elfinder.theme.css' rel='stylesheet' />
	<link href='/public/admin/css/jquery.iphone.toggle.css' rel='stylesheet' />
	<link href='/public/admin/css/opa-icons.css' rel='stylesheet' />
	<link href='/public/admin/css/uploadify.css' rel='stylesheet' />
        <link href="/public/admin/css/bootstrap-classic.css" rel="stylesheet" />
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="/public/admin/js/jquery-1.7.2.min.js"></script>

<script src="/public/admin/js/jquery.scripts.js"></script>

<script src="/public/admin/js/charisma.js"></script>

<!--  checkbox styling script -->
<script src="/public/admin/js/ui.core.js" type="text/javascript"></script>
<script src="/public/admin/js/ui.checkbox.js" type="text/javascript"></script>
<script src="/public/admin/js/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="/public/admin/js/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<script src="/public/admin/js/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="/public/admin/js/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="/public/admin/js/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "/public/admin/img/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="/public/admin/js/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="/public/admin/js/jquery.tooltip.js" type="text/javascript"></script>
<script src="/public/admin/js/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 





<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="/public/admin/js/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

$(document).pngFix( );
});
</script>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="/public/admin/img/shared/logo.png" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	

 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><img src="/public/admin/img/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></div>
			<div class="nav-divider">&nbsp;</div>
			<a href="" id="logout"><img src="/public/admin/img/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		
		<ul class="select"><li><a href="/admin/site/all"><b>Strony</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
                                <li><a href="/admin/site/all">Wyświetl wszystkie</a></li>	
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		                    
		<ul class="select"><li><a href=""><b>Kategorie</b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="/admin/catalog/category/all">Wyświetl wszystkie</a></li>
                                <li><a href="/admin/catalog/category/add">Dodaj nową</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
                
                <div class="nav-divider">&nbsp;</div>
		                    
		<ul class="select"><li><a href=""><b>Producenci</b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="/admin/catalog/producer/all">Wyświetl wszystkich</a></li>
                                <li><a href="/admin/catalog/producer/add">Dodaj nowego</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
                <div class="nav-divider">&nbsp;</div>
		                    
		<ul class="select"><li><a href=""><b>Produkty</b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="/admin/catalog/product/all">Wyświetl wszystkie</a></li>
                                <li><a href="/admin/catalog/product/add">Dodaj nowy</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
                
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="/admin/offer/all"><b>Oferta</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="/admin/offer/all">Wyświetl listę</a></li>
                                <li><a href="/admin/offer/add">Dodaj pozycję</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>

		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
 {% block content %} {% endblock %}

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	
	Be nice &copy; Copyright <span id="spanYear"></span> <a href="http://petre.pl">www.petre.pl</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="/public/admin/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="/public/admin/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="/public/admin/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="/public/admin/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="/public/admin/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="/public/admin/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="/public/admin/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="/public/admin/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="/public/admin/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="/public/admin/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="/public/admin/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="/public/admin/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="/public/admin/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="/public/admin/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="/public/admin/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="/public/admin/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='/public/admin/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='/public/admin/js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="/public/admin/js/excanvas.js"></script>
	<script src="/public/admin/js/jquery.flot.min.js"></script>
	<script src="/public/admin/js/jquery.flot.pie.min.js"></script>
	<script src="/public/admin/js/jquery.flot.stack.js"></script>
	<script src="/public/admin/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="/public/admin/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="/public/admin/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="/public/admin/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="/public/admin/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="/public/admin/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="/public/admin/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="/public/admin/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="/public/admin/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="/public/admin/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="/public/admin/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="/public/admin/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="/public/admin/js/charisma.js"></script>
        
</body>
</html>