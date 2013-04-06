$(document).ready(function() {

	(function() {
		var $menu = $('#nested-menu');

		$menu.find('> li').removeClass('active');

		$menu.on('click', 'strong', function(e) {
			$(this).parent().toggleClass('active');

			e.preventDefault();
		});
	})();

	$('#to-top').click(function(e) {
		$('html, body').animate({
			scrollTop: 0
		}, 250);
	});

});