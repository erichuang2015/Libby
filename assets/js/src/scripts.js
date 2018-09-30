
const toggleNavBtn = document.getElementById('toggle-nav');
const siteHeader = document.getElementById('header');

function toggleNav() {
	siteHeader.classList.toggle('closed');
	siteHeader.classList.toggle('open');
	toggleNavBtn.classList.add('animating');
	setTimeout ( () => {
		toggleNavBtn.classList.remove('animating');
		toggleNavBtn.classList.toggle('nav-open');
	}, 300);
}

if (toggleNavBtn) {
	toggleNavBtn.addEventListener('click', toggleNav, false);
}




