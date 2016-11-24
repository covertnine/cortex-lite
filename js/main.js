(function ($) {

	"use strict";

	$('#page').css("opacity", "0");
	$('body').css("opacity", "1");

	////////////////////////////////*   prevent scrolling up for links set to #  *////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('a[href*="#page"],a[href*="#page-top"]').click(function(e) {
		if ($(window).width() <= 767) {
			$('.navbar-collapse').collapse('toggle');
		}
		$('html,body').animate({ scrollTop: 0 }, 'slow');
		return false;
	});

	$('a[href="#"].dropdown-toggle').click(function(e) {
		e.preventDefault();
	});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	/////////////////*   re-orient flex slider slides and masonry when the device orientation changes  *//////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$( window ).on( "orientationchange", function() {


		/* tells isotope to wait for images to load on masonry layouts*/
		var $postcontainer = jQuery('.masonry_posts .grid-tiles.isotope').isotope();
		// layout Isotope again after all images have loaded
		$postcontainer.imagesLoaded(function () {
			$postcontainer.fadeIn(1000).isotope('layout');
		});

		/* tells isotope to wait for images to load on masonry layouts*/
		var $portfoliocontainer = jQuery('.masonry_portfolio .grid-tiles.isotope').isotope();
		// layout Isotope again after all images have loaded
		$portfoliocontainer.imagesLoaded(function () {
			$portfoliocontainer.fadeIn(1000).isotope('layout');
		});

		var $projectcontainer = jQuery('.projects_container .grid-tiles.isotope').isotope();
		// layout Isotope again after all images have loaded
		$projectcontainer.imagesLoaded(function () {
			$projectcontainer.fadeIn(1000).isotope('layout');
		});

		var $projectcontainer = jQuery('.masonry_projects .grid-tiles.isotope').isotope();
		// layout Isotope again after all images have loaded
		$projectcontainer.imagesLoaded(function () {
			$projectcontainer.fadeIn(1000).isotope('layout');
		});

		/* tells isotope to wait for images to load on masonry post format layout*/
		var $postgallerycontainer = jQuery('.entry-content-gallery-grid .grid-tiles.isotope');
		// layout Isotope again after all images have loaded
		$postgallerycontainer.imagesLoaded(function () {
			$postgallerycontainer.fadeIn(1000).isotope({
				masonry: {
					columnWidth: '.isotope-item',
					gutter: '.gutter-sizer'
				},
				itemSelector: '.isotope-item',
				percentPosition: true
			});
		});

		//////////////////////////* products carousel for woocommerce. Laid out after the full page has resized//
		/////////////////////////////////////////////////////////////////////////////////////////////////////////
		// store the slider in a local variable
		var $window = jQuery(window),
		flexslider = { vars:{} };

		// tiny helper function to add breakpoints
		function getGridSize() {
			return (window.innerWidth < 600) ? 2 :
			       (window.innerWidth < 900) ? 3 : 4;
		}
		try {
			jQuery('.flexsliderproducts').flexslider({
			  animation: "slide",
			  animationLoop: true,
			  pauseOnHover: true,
			  itemWidth: 250,
			  itemMargin: 30,
			  start: function(slider){
			  	jQuery('body').removeClass('loading');
			  	flexslider = slider;
          		},
			  minItems: getGridSize(), // use function to pull in initial value
			  maxItems: getGridSize() // use function to pull in initial value
			});
		} catch (error) {}

		var gridSize = getGridSize();
		flexslider.vars.minItems = gridSize;
		flexslider.vars.maxItems = gridSize;
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		//////////////////////////////// try flex sliders in case there are any on the page //////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		try {
				jQuery('.flexslider').flexslider({
				animation: "slide",
				pauseOnHover: true,
				smoothHeight: true
			});
		} catch (error) {}

		/* flex slider posts */
		try {
				jQuery('.flexsliderposts').flexslider({
				animation: "fade",
				pauseOnHover: true,
				smoothHeight: true
			});
		} catch (error) {}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////*   sets dropdown menus on main nav to animate and display with 2 tiers if necessary  *//////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.dropdown').on('show.bs.dropdown', function(e){
		var grandparent = $(this).parent().parent();
		grandparent.find(".dropdown-submenu.open .dropdown-menu").css('display', 'none');
		grandparent.find(".dropdown-submenu.open").removeClass('open');
		$(this).find('.dropdown-menu').first().stop(true, true).fadeToggle(200);

	});

	$('.dropdown').on('hide.bs.dropdown', function(e){
		var grandparent = $(this).parent().parent();
		$(this).find('.dropdown-menu').first().stop(true, true).fadeToggle(200, function()
			{
				$(this).css('display','none');
			});
		grandparent.find(".dropdown-submenu.open .dropdown-menu").css('display', 'none');
		grandparent.find(".dropdown-submenu.open").removeClass('open');
	});

	$(".dropdown-submenu > .dropdown-toggle").on("click", function (e) {
		var current = $(this).next();
		var grandparent = $(this).parent().parent();
		grandparent.find(".dropdown-submenu.open .dropdown-menu").css('display','none');
		grandparent.find(".dropdown-submenu.open").removeClass('open');
		current.hide().fadeIn(100).parent().addClass('open');
		e.stopPropagation();
	});

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////   adds class after scroll point to add class to nav for styling //////////////////
	////////////////////////////// only css changes with the nav1 option (transparent nav)   /////////////////////////
	$(window).scroll(function () {

	    var scroll = $(window).scrollTop();

	    if (scroll >= 32) {
		    $('.navbar').addClass('navbar-small');
	    }
	    if (scroll <= 31) {
		    $('.navbar').removeClass('navbar-small');
	    }
	    if (scroll >= 15) {
		    $('.navbar').addClass('navbar-small-to-top');
	    }

	    if (scroll <= 14) {
		    $('.navbar').removeClass('navbar-small-to-top');
	    }

	});

	if ($(window).width() <= 767) {

   		$('.navbar').addClass('navbar-small');
		$('.navbar-top').addClass('navbar-small-mobile');

	} //end small screens

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////   offsets content margin based on main menu height   /////////////////////////////
	////////////////////////////// prevents content from getting blocked by fixed navigation /////////////////////////

	if ($(window).width() <= 767) {
		var marginskrollr = $('#mainnav').height();
		$('#skrollr-body').css('margin-top', marginskrollr);
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////   for flex slider photo galleries with a lightbox   //////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.flexslider .slides .img_container a').click(function (e) {

		e.preventDefault();
		var items = [];
		items.push({src:this});

		$(this).parent().nextAll().find('a').each(function () {
			var imageLink = $(this).attr('href');
			items.push({
				src: imageLink
			});
		});

		$.magnificPopup.open({
			items: items,
			type: 'image',
			gallery: {
				enabled: true
			},
			mainClass: 'mfp-zoom-in',
			callbacks: {
				open: function () {
					//overwrite default prev + next function. Add timeout for css3 crossfade animation
					$.magnificPopup.instance.next = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.next.call(self);
						}, 120);
					}
					$.magnificPopup.instance.prev = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.prev.call(self);
						}, 120);
					}
				},
				imageLoadComplete: function () {
					var self = this;
					setTimeout(function () {
						self.wrap.addClass('mfp-image-loaded');
					}, 16);
				}
			}
		});
	});


	/////////////////////////////////////   for photo galleries with a lightbox   ////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.isotope-item .img_container a').click(function (e) {

		e.preventDefault();
		var items = [];
		var itemsTitle = $(this).attr('title');
		items.push({
			src:this,
			title:itemsTitle,
		});

		$(this).parent().parent().nextAll().children('.img_container').find('a').each(function () {
			var imageLink = $(this).attr('href');
			var imageCaption = $(this).attr('title');
			items.push({
				src: imageLink,
				title: imageCaption
			});
		});

		$.magnificPopup.open({
			items: items,
			type: 'image',
			gallery: {
				enabled: true
			},
			mainClass: 'mfp-zoom-in',
			image: {
				titleSrc: 'title'
			},
			callbacks: {
				open: function () {
					//overwrite default prev + next function. Add timeout for css3 crossfade animation
					$.magnificPopup.instance.next = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.next.call(self);
						}, 120);
					}
					$.magnificPopup.instance.prev = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.prev.call(self);
						}, 120);
					}
				},
				imageLoadComplete: function () {
					var self = this;
					setTimeout(function () {
						self.wrap.addClass('mfp-image-loaded');
					}, 16);
				}
			}
		});
	});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////// for photo galleries launched by buttons ////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.gallery-link').click(function (e) {

		e.preventDefault();
		var items = [];
		var itemsTitle = $(this).attr('title');

		$(this).nextAll('.cm-gallery').find('a').each(function () {
			var imageLink = $(this).attr('href');
			var imageCaption = $(this).attr('title');
			items.push({
				src: imageLink,
				title:itemsTitle,
			});
		});

		$.magnificPopup.open({
			items: items,
			type: 'image',
			gallery: {
				enabled: true
			},
			mainClass: 'mfp-zoom-in',
			image: {
				titleSrc: 'title'
			},
			callbacks: {
				open: function () {
					//overwrite default prev + next function. Add timeout for css3 crossfade animation
					$.magnificPopup.instance.next = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.next.call(self);
						}, 120);
					}
					$.magnificPopup.instance.prev = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.prev.call(self);
						}, 120);
					}
				},
				imageLoadComplete: function () {
					var self = this;
					setTimeout(function () {
						self.wrap.addClass('mfp-image-loaded');
					}, 16);
				}
			}
		});
	});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//removes background image from links that are images to prevent weird underline from gradient backgrounds.
	$('.entry-content a img').css("background-color", "transparent").parent().css("background-image", "none");


	///////////////////////// for putting wordpress galleries linked to images/videos in lightbox ////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.cortex-popup-video').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-zoom-in',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});


	$('.gallery a[href$=".jpg"], .gallery a[href$=".jpeg"], .gallery a[href$=".png"], .gallery a[href$=".gif, "], .cortex-popup').click(function (e) {

		e.preventDefault();

		var items = [];
		var firstItem = $(this).attr("href");

		items.push({
			src: firstItem
		});

		$(this).parent().parent().nextAll('.gallery-item').children('.gallery-icon').find('a').each(function () {

			var imageLink = $(this).attr('href');
			items.push({
				src: imageLink
			});
		});

		$.magnificPopup.open({
			items: items,
			type: 'image',
			gallery: {
				enabled: true
			},
			mainClass: 'mfp-zoom-in',
			callbacks: {
				open: function () {
					//overwrite default prev + next function. Add timeout for css3 crossfade animation
					$.magnificPopup.instance.next = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.next.call(self);
						}, 120);
					}
					$.magnificPopup.instance.prev = function () {
						var self = this;
						self.wrap.removeClass('mfp-image-loaded');
						setTimeout(function () {
							$.magnificPopup.proto.prev.call(self);
						}, 120);
					}
				},
				imageLoadComplete: function () {
					var self = this;
					setTimeout(function () {
						self.wrap.addClass('mfp-image-loaded');
					}, 16);
				}
			}
		});

	});

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//////////////////////////////////////       mailchimp widget        /////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('#secondary-top .widget-cortex-mailchimp .widget-title').on('touchstart click', function(e) {
		e.preventDefault();
		$('#secondary-top .widget-cortex-mailchimp form').animate({
			height: "toggle",
			opacity: "toggle"
		});
	});
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//////////////////////////////////////       full screen search        ///////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.btn-nav-search').on('click', function(e) {
        e.preventDefault();
        $('#search').addClass('open');
        $('#search > form > div > input[type="search"]').focus();
    });

    $('#search, #search .search-close, #search .search-close .fa-close').on('click keyup', function(e) {
        if (e.target == this || e.target.className == 'search-close' || e.keyCode == 27) {
            $(this).removeClass('open');
            $(this).parent().removeClass('open');
            $(this).parent().parent().removeClass('open');
        }
    });
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

})(jQuery);



jQuery(window).load(function($) {

	////////////////////////////// masonry posts layouts for portfolios and regular posts/////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/* tells isotope to wait for images to load on masonry layouts*/
	var $postcontainer = jQuery('.masonry_posts .grid-tiles.isotope').isotope();
	// layout Isotope again after all images have loaded
	$postcontainer.imagesLoaded(function () {
		$postcontainer.fadeIn(1000).isotope('layout');
	});

	/* tells isotope to wait for images to load on masonry layouts*/
	var $portfoliocontainer = jQuery('.masonry_portfolio .grid-tiles.isotope').isotope();
	// layout Isotope again after all images have loaded
	$portfoliocontainer.imagesLoaded(function () {
		$portfoliocontainer.fadeIn(1000).isotope('layout');
	});

	var $projectcontainer = jQuery('.projects_container .grid-tiles.isotope').isotope();
	// layout Isotope again after all images have loaded
	$projectcontainer.imagesLoaded(function () {
		$projectcontainer.fadeIn(1000).isotope('layout');
	});

	var $projectcontainer = jQuery('.masonry_projects .grid-tiles.isotope').isotope();
	// layout Isotope again after all images have loaded
	$projectcontainer.imagesLoaded(function () {
		$projectcontainer.fadeIn(1000).isotope('layout');
	});

	/* tells isotope to wait for images to load on masonry post format layout*/
	var $postgallerycontainer = jQuery('.entry-content-gallery-grid .grid-tiles.isotope');
	// layout Isotope again after all images have loaded
	$postgallerycontainer.imagesLoaded(function () {
		$postgallerycontainer.fadeIn(1000).isotope({
			masonry: {
				columnWidth: '.isotope-item',
				gutter: '.gutter-sizer'
			},
			itemSelector: '.isotope-item',
			percentPosition: true
		});
	});

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//////////////////////////////////       animation loading overlay and laying out sliders/grids   ////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if ( jQuery( ".c9-loader-overlay" ).length ) {
		jQuery('.c9-loader-overlay').fadeOut('slow', function() {

			jQuery(this).hide();

			//after hiding the overlay, trigger a window resize, then fade in the page
			jQuery.when( jQuery(window).trigger('resize') ).then(

				jQuery("#page").fadeIn('slow', function() {

					jQuery(this).css("opacity","1");

					//////////////////////////* products carousel for woocommerce. Laid out after the full page has resized//
					/////////////////////////////////////////////////////////////////////////////////////////////////////////
					// store the slider in a local variable
					var $window = jQuery(window),
					flexslider = { vars:{} };

					// tiny helper function to add breakpoints
					function getGridSize() {
						return (window.innerWidth < 600) ? 2 :
						       (window.innerWidth < 900) ? 3 : 4;
					}
					try {
						jQuery('.flexsliderproducts').flexslider({
						  animation: "slide",
						  animationLoop: true,
						  pauseOnHover: true,
						  itemWidth: 250,
						  itemMargin: 30,
						  start: function(slider){
						  	jQuery('body').removeClass('loading');
						  	flexslider = slider;
			          		},
						  minItems: getGridSize(), // use function to pull in initial value
						  maxItems: getGridSize() // use function to pull in initial value
						});
					} catch (error) {}

					var gridSize = getGridSize();
					flexslider.vars.minItems = gridSize;
					flexslider.vars.maxItems = gridSize;
					//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				}) //end fadein callback function

			);//end of then statement for after the window resizes


		}); //end fadeout overlay and laying out grids for carousels and masonry

	} else { //end check for preloader, it is not there, so fade in the page

		jQuery("#page").fadeIn('slow', function() {

			jQuery(this).css("opacity","1");

			//////////////////////////* products carousel for woocommerce. Laid out after the full page has resized//
			/////////////////////////////////////////////////////////////////////////////////////////////////////////
			// store the slider in a local variable
			var $window = jQuery(window),
			flexslider = { vars:{} };

			// tiny helper function to add breakpoints
			function getGridSize() {
				return (window.innerWidth < 600) ? 2 :
				       (window.innerWidth < 900) ? 3 : 4;
			}
			try {
				jQuery('.flexsliderproducts').flexslider({
				  animation: "slide",
				  animationLoop: true,
				  pauseOnHover: true,
				  itemWidth: 250,
				  itemMargin: 30,
				  start: function(slider){
				  	jQuery('body').removeClass('loading');
				  	flexslider = slider;
	          		},
				  minItems: getGridSize(), // use function to pull in initial value
				  maxItems: getGridSize() // use function to pull in initial value
				});
			} catch (error) {}

			var gridSize = getGridSize();
			flexslider.vars.minItems = gridSize;
			flexslider.vars.maxItems = gridSize;
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		}) //end fadein callback function

	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//////////////////////////////// try flex sliders in case there are any on the page //////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	try {
			jQuery('.flexslider').flexslider({
			animation: "slide",
			pauseOnHover: true,
			smoothHeight: true
		});
	} catch (error) {}

	/* flex slider posts */
	try {
			jQuery('.flexsliderposts').flexslider({
			animation: "fade",
			pauseOnHover: true,
			smoothHeight: true
		});
	} catch (error) {}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


});

//////////////////////////////// initiate wow for animate.css but not on mobile     //////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

try {

	if ( ! (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera) ) { //check for mobile browser first, if not enable

		new WOW().init({
				mobile: false
			});
	} //end if mobile

} catch (error) {}