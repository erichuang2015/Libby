(function ($, root, undefined) {
	
	$(function () { // DOM ready, take it away

		$('.nav-button').click(function() {
			if ($('.header').hasClass('open') === false) {
				$('.header').addClass('open');
				$('.header').removeClass('closed');
			} else {
				// $('.header').addClass('closed');
				$('.header').removeClass('open');
			}
		});
		
	}); // DOM ready
	
})(jQuery, this);

