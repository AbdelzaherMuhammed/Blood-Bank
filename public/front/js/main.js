//loading page
$(window).ready(function () {

	$('.loading-page').fadeOut(400);
	$('body').css('overflow', 'auto');

	$('.heart-icon').click(function() {
		var icon = $(this).find('i');

		if ($(icon).hasClass('fas')) {
			$(icon).removeClass('fas').addClass('far');
		} else {
			$(icon).removeClass('far').addClass('fas');
		};
	});

	//event when scroll top
	$(window).scroll(function () {
		//adjust scroll-to-top
		var scrollToTp = $('.scrollUp');
		if ($(window).scrollTop() > 400) {
			scrollToTp.fadeIn(400);
		} else {
			scrollToTp.fadeOut(400);
		}
	})
	//when click on scrollUp
	$('.scrollUp').click(function (e) {
		var scrollTop = $(window).scrollTop();
		/* Act on the event */
		e.preventDefault();
		$('html , body').animate({ scrollTop: 0 }, 600);
	});
	//fire slick slider
	$('.main-header').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		rtl: true,
		dots: true,
		autoplay: true,
		dotsClass: 'slick-dots'
	});
	$(".slick2").slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		rtl: true,
		prevArrow: '.prev-arrow',
		nextArrow: '.next-arrow',
		centerPadding: '50px',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]

	});

	$('.slick-dots li button').hide();
	// $("#datepicker").datepicker({
	// 	buttonImage: "/images/datepicker.gif"
	// });

	
});
