$(document).ready(function() {

	(function() {
		var $menu = $('#nested-menu');

		$menu.find('> li').removeClass('active');



	/*  Rozwija menu bez urachamiania linkow kategorii	
         * $menu.on('click', 'strong', function(e) {
			$(this).parents('li').toggleClass('active');

			e.preventDefault();
		});
                */
	})();

	$('#to-top').click(function(e) {
		$('html, body').animate({
			scrollTop: 0
		}, 250);
	});

});