(function ($, root, undefined) {
	
	$(function () { // DOM ready, take it away

		$('.nav-button').click(function() {
			if ($('.header').hasClass('open') === false) {
				$('.header').addClass('open');
				$('.header').removeClass('closed');
			} else {
				$('.header').addClass('closed');
				$('.header').removeClass('open');
			}
		});
		
	}); // DOM ready
	
})(jQuery, this);


// Throttle scroll events
var direction, lastKownDirection, lastKnownPosition = 0;

function peepHeader(pos) {

	lastKnownPosition = window.scrollY;
	
	var header = document.getElementById('header');

	if (pos > window.scrollY) {
		direction = 'up';
		if (lastKownDirection !== direction) {
			header.classList.add('stuck');
		}
	} else {
		direction = 'down';
		if (lastKownDirection !== direction) {
			header.classList.remove('stuck');
		}
	}

	lastKownDirection = direction;

}

function throttle(wait) {

	var time = Date.now();
	return function() {
		if (window.scrollY < 1 ) {
			header.classList.remove('stuck');
			header.classList.remove('sticky');
		}
		if ((time + wait - Date.now()) < 0) {
			if (window.scrollY > header.clientHeight) {
				header.classList.add('sticky');
			} else {
				header.classList.remove('sticky');
			}
			peepHeader(lastKnownPosition);
			time = Date.now();
		}
	}
}

window.addEventListener('scroll', throttle(100));

