/*
 * Scripts File
 * Author: Vic Lobins
 *
*/
var doc = document.documentElement;
doc.setAttribute('data-useragent', navigator.userAgent);

/*
 * Get Viewport Dimensions
*/
function updateViewportDimensions() {
	"use strict";
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
*/
//var waitForFinalEvent = (function () {
//	"use strict";
//	var timers = {};
//	return function (callback, ms, uniqueId) {
//		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
//		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
//		timers[uniqueId] = setTimeout(callback, ms);
//	};
//})();
//var timeToWaitForLast = 100;


jQuery(document).ready(function($) {
	
	"use strict";
	
	viewport = updateViewportDimensions();
	
	$('.menu-button').on('click', function(){
		$(this).parents('.header').toggleClass('active');
	});
	
	$(window).on('load resize', function(){
		viewport = updateViewportDimensions();
	});


}); /* end of as page load scripts */
