let searchGroups = $('.search-group')
if (searchGroups.length) {
	searchGroups.each(function (index, item) {
		let opener = item.querySelector('.search-opener'),
			input = item.querySelector('.search-input');
		if (opener && input) {
			opener.addEventListener('click', function () {
				if (!item.classList.contains('opened')) {
					event.preventDefault()
					item.classList.add('opened')
					input.focus()
				}
			})
			item.addEventListener("click", function () {
				event.stopPropagation()
			})
			window.addEventListener("click", function () {
				item.classList.remove('opened')
			})
		}
	})
}
var $topMenuSlider = $('.top-screen__menu');
	if ($topMenuSlider.length) {
		$topMenuSlider.slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			lazyload: 'ondemand',
			prevArrow: `<button type="button" class="slick-prev"></button>`,
			nextArrow: `<button type="button" class="slick-next"></button>`,
			autoplay: false,
			autoplaySpeed: 5000,
			mobileFirst: true,
			responsive: [{
				breakpoint: 767,
				settings: "unslick"
			}]
		});
	}