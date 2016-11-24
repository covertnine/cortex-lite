//////////////////////////* skrollr for parallax and fade effects*////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
window.onload=function(){
	// initialize skrollr if the window width is large enough
	if ( ! (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera) ) {
		skrollr.init({
			smoothScroll: false,
			forceHeight: false,
			constants: {
		        foobar: function() {
		            return jQuery(window).height() - 100;
		        }
			},
		});
		
		//reloads skrollr because it always gets the height wrong with longer pages
		setTimeout(function () {
			skrollr.get().refresh();
		}, 1000);

	} //end if mobile

	// disable skrollr if the window is resized below 768px wide
	if (jQuery(window).width() <= 767) {
	  skrollr.init().destroy(); // skrollr.init() returns the singleton created above
	}
	

};
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////