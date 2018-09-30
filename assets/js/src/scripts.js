
const toggleNavBtn = document.getElementById('toggle-nav');
const siteHeader = document.getElementById('header');

function toggleNav(e) {
	siteHeader.classList.toggle('closed');
	siteHeader.classList.toggle('open');
	console.log(e.target);
};

if (toggleNavBtn) {
	toggleNavBtn.addEventListener('click', toggleNav, false);
}




