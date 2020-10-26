const tops = document.querySelector('.header .nav-bar .nav-list .tops');
const mobile_menu = document.querySelector('.header .nav-bar .nav-list ul');
const menu_item = document.querySelectorAll('.header .nav-bar .nav-list ul li a');
const header = document.querySelector('.header.container');

tops.addEventListener('click', () => {
	tops.classList.toggle('active');
	mobile_menu.classList.toggle('active');
});

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY;
	if (scroll_position >= 0) {
		header.style.backgroundColor = '#63636F';
	} 
});



menu_item.forEach((item) => {
	item.addEventListener('click', () => {
		tops.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
});
