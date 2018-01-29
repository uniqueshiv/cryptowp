(function($) {
	'use strict';
	var isTouchDevice = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone)/);

	//Calculating The Browser Scrollbar Width
	var parent, child, scrollWidth;

	if (scrollWidth === undefined) {
		parent      = $('<div style="width: 50px; height: 50px; overflow: auto"><div/></div>').appendTo('body');
		child       = parent.children();
		scrollWidth = child.innerWidth() - child.height(99).innerWidth();
		parent.remove();
	}

	//Carousels
	function carousels() {
		var carousel = $('.carousel');

		if (carousel.length) {
			carousel.each(function(){
				var $this      = $(this),
						rtl        = false,
						responsive = {0 : {items : 1}, 544 : {items : 2}, 768 : {items : 3}, 992 : {items : 4}},
						dots       = false,
						nav        = false,
						margin     = 30;

				if ($('body').hasClass('rtl')) rtl = true;
				if ($this.data('responsive')) responsive = $this.data('responsive');
				if ($this.data('dots')) dots = true;
				if ($this.data('nav')) nav = true;
				if ($this.data('margin')) margin =  $this.data('margin');

				$this.owlCarousel({
					rtl        : rtl,
					autoplay   : false,
					loop       : true,
					nav        : nav,
					dots       : dots,
					margin     : margin,
					autoHeight : false,
					responsive : responsive,
					lazyLoad   : true
				});
			});
		}
	}

	//Single product carousels
	function productCarousel() {
		$('.main-images .owl-carousel').owlCarousel({
			autoplay   : false,
			loop       : true,
			nav        : false,
			dots       : false,
			margin     : 11,
			autoHeight : false,
			items      : 1,
			lazyLoad   : true,
			thumbs     : true,
			thumbImage : true,
		});
	}

	//Preloader
	// function loaderOut(){
	// 	$('body').addClass('loaded').find('.preloader').fadeOut(400);
	// }

	//Header
	function headerOptions() {
		var body   = $('body'),
				header = $('.site-header');

		//Scrolling
		if(body.hasClass('dynamic-header') || body.hasClass('fixed-header')) {
			scrollingDetect();
			$(window).on('scroll', function() {
				scrollingDetect();
			});
		}

		function scrollingDetect(){
			if ($(window).scrollTop())
				body.addClass('scrolling');
			else
				body.removeClass('scrolling');
		}

		//Dynamic header
		function dynamicHeader(){
			if ($(window).scrollTop() >= 63)
				header.addClass('small-height1');
			else
				header.removeClass('small-height1');
		}
		if(body.hasClass('dynamic-header')) {
			dynamicHeader();
			$(window).on('scroll', function() {
				dynamicHeader();
			});
		}
	}

	// //Header actions
	// function headerActions() {
	// 	var header = $('.site-header'),
	// 			action = header.find('.action-box'),
	// 			close  = action.find('.close');
  //
	// 	$('.header-btn').on('click', function(e){
	// 		var $this = $(this);
	// 		e.preventDefault();
  //
	// 		if(!$this.closest('.action-box').hasClass('dropdown'))
	// 			header.addClass('open-action');
  //
	// 		setTimeout(function(){
	// 			$this.closest('.action-box').addClass('active').find('.search-input').focus();
	// 		}, 300);
	// 	});
  //
	// 	function closeBox(){
	// 		action.removeClass('active');
	// 		setTimeout(function(){
	// 			header.removeClass('open-action');
	// 		}, 300);
	// 	}
  //
  //   close.on('click', function(e){
  //     e.preventDefault();
	// 		closeBox();
	// 	});
  //
	// 	$('body').on('click', function(e){
	// 		if(!$(e.target).is('.site-header, .site-header *'))
	// 			closeBox();
	// 	});
	// }

	//Menu
	function menu() {
		var menu = $('.main-menu'),
				menuWrap = menu.find('.menu-list-wrap'),
				parentItem = menu.find('.menu-item-has-children');

		parentItem.find('.open-sub').remove();

		if (($('body').width() + scrollWidth) < 992 || menu.hasClass('minimized-menu'))
			menu.addClass('collapsed');
		else
			menu.removeClass('collapsed');

		if (menu.hasClass('collapsed')) {
			menuWrap
				.hide()
				.touchwipe({
					wipeLeft : function() {
						menuWrap.trigger('click');
					},
					min_move_x : 20,
					preventDefaultEvents : false
				});

			parentItem.each(function(){
				var li = $(this);

				li.children('a').append('<span class="open-sub"/>');
			});

		} else {
			menuWrap.fadeIn();
		}

		$('.menu-btn').on('click', function(e){
			var menu = $(this).closest('.main-menu');

			e.preventDefault();
			menuWrap.fadeIn(200);

			setTimeout(function(){
				menu.addClass('open-menu');
			}, 200);
		});



		menuWrap.on('click', function(e){
			if(!$(e.target).is('.menu-list-wrap *')) {
				var overlay = $(this);

				overlay.closest('.main-menu').removeClass('open-menu');

				setTimeout(function(){
					overlay.fadeOut().find('.menu-item-has-children').removeClass('open');
				}, 200);
			}
		});

		$('.open-sub').on('click', function(e){
			var menu = $(this).closest('.main-menu'),
					li   = $(this).closest('.menu-item-has-children');

			e.preventDefault();

			if(li.hasClass('open')) {
				li.removeClass('open').find('.menu-item-has-children').removeClass('open');
			} else {
				menu.find('.menu-item-has-children').removeClass('open');
				li.addClass('open').parents('.menu-item-has-children').addClass('open');
			}
		});
	}

	//Slider
	function slider() {
		var slider = $('.slider .slides');

		if (slider.length) {
			slider.each(function(){
				var currentSlider = $(this),
						rtl   = false,
						dots  = false,
						nav   = false;

				if ($('body').hasClass('rtl')) rtl = true;
				if (currentSlider.closest('.slider').data('dots')) dots = true;
				if (currentSlider.closest('.slider').data('nav')) nav = true;

				currentSlider.find('.slider-item img').each(function(){
					var img = $(this),
							src = img.attr('src');

					img.closest('.slider-item').css('background-image', 'url(' + src + ')');
				});

				currentSlider.on('changed.owl.carousel', function(e) {
					var $this   = $(this),
							current =  minTwoDigits(e.relatedTarget.relative(e.item.index) + 1 || 1),
							count   =  minTwoDigits(e.item.count || $this.find('.slider-item').length);

					$this.next('.counter').html('<span>' + current + '</span> / ' + count);
				});

				currentSlider.owlCarousel({
					center             : true,
					items              : 1,
					loop               : true,
					autoplay           : false,
					autoplayTimeout    : 10000,
					autoplayHoverPause : true,
					autoHeight         : true,
					nav                : nav,
					dots               : dots,
				}).on('resized.owl.carousel', function() {
					var currentSlider = $(this);
					currentSlider.find('.owl-height').css('height', currentSlider.find('.owl-item.active img').height());
				});
			});
		}

		function minTwoDigits(n) {
			return (n < 10 ? '0' : '') + n;
		}
	}

	//Main Post
	function mainPost(){
		$('.bg-banner').each(function(){
			var box = $(this),
					bgImage = box.find('.bg-image');

			box.css({
				backgroundImage : 'url(' + bgImage.attr('src') + ')',
				height : $(window).height()
			});

			bgImage.remove();
		});
	}

	//Animating blocks
	function animating() {
		appear({
			elements: function elements(){
				return $('.animating');
			},
			appear: function appear(el){
				var timeout = ($(el).data('animateTimeout')) ? $(el).data('animateTimeout') : 0;
				var animateType = ($(el).data('animateType')) ? $(el).data('animateType') : 'fadeInUp';
				setTimeout(function(){
					$(el).addClass('animated').addClass(animateType);
				}, timeout);
			},
			bounds: 100,
			reappear: true,
			deltaTimeout: 500
		});
	}

	jQuery(document).ready(function($) {
	    // Configure/customize these variables.
	    var showChar = 500;  // How many characters are shown by default
	    var ellipsestext = "";
	    var moretext = "Show less";
	    var lesstext = "Keep reading";


	    $('.article_content').each(function() {
	        var content = $(this).html();

	        if(content.length > showChar) {

	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar, content.length - showChar);

	            var html = c + '<span class="moreellipses">' + ellipsestext+ '</span><span class="morecontent"><span>' + h + '</span><div class="text-sm-center"><a href="" class="morelink btn  btn-readmore1">' + moretext + '</a></div></span>';

	            $(this).html(html);
	        }

	    });

	    $(".morelink").click(function(){
	        if($(this).hasClass("less")) {
	            $(this).removeClass("less");
	            $(this).html(moretext);
	        } else {
	            $(this).addClass("less");
	            $(this).html(lesstext);
	        }
	        $(this).parent().prev().toggle();
	        $(this).prev().toggle();
	        return false;
	    });
			$('.morelink').trigger('click');
	});



	jQuery(document).ready(function($){
		if (isTouchDevice) {
			$('.background-video').remove();
			$('body').addClass('touch-device');
		}

		//Social icons
		$('body').on('click', function(e) {
			if(!$(e.target).is('.post-sharing *'))
				$('.post-sharing').removeClass('hover');
		});
		$('.social-sharing-btn').on('click', function(e) {
			e.preventDefault();

			$(this).closest('.post-sharing').addClass('hover');
		});

		//Functions
		menu();
		headerOptions();
		//headerActions();


		$('.gallery-item').magnificPopup({
			type : 'image',
			mainClass : 'mfp-with-zoom',
			zoom : {
				enabled : true,
				duration : 300
			},
			gallery: {
				enabled : true,
				tCounter : '<span>%curr%</span> / %total%',
			},
			callbacks: {
				elementParse: function(item) {
					if($(item.el.context).hasClass('iframe-item'))
						item.type = 'iframe';
					else
						item.type = 'image';
				},
				open: function() {
					console.log()
					$('.mfp-wrap').touchwipe({
						wipeLeft : function() {
							$('.mfp-arrow-left').magnificPopup('next');
						},
						wipeRight : function() {
							$('.mfp-arrow-right').magnificPopup('prev');
						},
						min_move_x : 50,
						preventDefaultEvents : false
					});
				}
			}
		});
	});

	//Document Load
	// $(window).on('load', function(){
	// 	jQuery.ready.then(function(){
	// 		carousels();
	// 		productCarousel();
	// 		slider();
	// 		mainPost();
	// 		//Masonry initial
	// 		if ($.isFunction($.fn.masonry)) {
	// 			$('.masonry-layout, .social-layout').masonry({
	// 				itemSelector    : '.grid-item',
	// 				columnWidth     : '.grid-sizer',
	// 				percentPosition : true
	// 			});
	// 		}
	// 		loaderOut();
	// 		animating();
	// 	});
	// });

	//Window Resize
	(function() {
		var delay = (function(){
			var timer = 0;
			return function(callback, ms){
				clearTimeout (timer);
				timer = setTimeout(callback, ms);
			};
		})();

		//Functions
		function resizeFunctions() {
			menu();
			headerOptions();
		}

		if(isTouchDevice) {
			$(window).bind('orientationchange', function() {
				delay(function(){
					resizeFunctions();
				}, 50);
			});
		} else {
			$(window).on('resize', function() {
				delay(function(){
					resizeFunctions();
				}, 50);
			});
		}
	}());
})(jQuery);
