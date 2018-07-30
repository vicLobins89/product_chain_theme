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

jQuery(document).ready(function($) {
	
	"use strict";
	
	viewport = updateViewportDimensions();
	
	$('.grid').masonry({
		itemSelector: '.post',
		columnWidth: '.grid-sizer',
  		percentPosition: true
	});
	
	$('.menu-button').on('click', function(){
		$(this).parents('.header').toggleClass('active');
	});
	
	$('#menu-main-menu > .menu-item-has-children > a').on('click', function(e){
		e.preventDefault();
		$('.sub-menu').not( $(this).next('.sub-menu') ).removeClass('active');
		$('#menu-main-menu > .menu-item-has-children > a').not( $(this) ).removeClass('active');
		$(this).next('.sub-menu').toggleClass('active');
		$(this).toggleClass('active');
		if( $('.sub-menu').hasClass('active') ) {
			$('#content').addClass('sub-menu-active');
		} else {
			$('#content').removeClass('sub-menu-active');
		}
	});
	
	// Ajax Filter
	var postHtml = {},
		catLinkHref,
		$catLink = $('.cat-item a'),
		$contentArea = $('.posts-main');
	
	$catLink.each(function(i, el){	
		$(el).on('mouseover', function(){
			catLinkHref = $(el).attr('href');
			
			if( !postHtml[i] ) {
				$.ajax({
					url: catLinkHref,
					type: 'GET',
					success: function(data){
						postHtml[i] = $(data).find('.posts-main').contents();
					}
				});
			}
		});
		
		function checkLoad() {
			if( !postHtml[i] ) {
				$('.lds-ellipsis').addClass('loading');
				setTimeout(checkLoad, 200);
			} else {
				$('.lds-ellipsis').removeClass('loading');
				var $content = postHtml[i],
					$current = $contentArea.contents();
				
				$contentArea.prepend($content).masonry('prepended', $content).masonry('remove', $current).masonry('layout');
			}
		}
		
		$(el).on('click', function(e){
			e.preventDefault();
			
			if( !$(this).hasClass('active') ) {
				$('.cat-item a').not(this).removeClass('active');
				$(this).addClass('active');
				checkLoad();
			}
		});
	});
	
	// Check if in view
	var $window = $(window),
		$animationElements = $('.arrow, .ribbon');
	
	function checkIfInView() {
		var windowHeight = $window.height(),
		  windowTopPosition = $window.scrollTop(),
		  windowBottomPosition = (windowTopPosition + windowHeight);

		$.each($animationElements, function() {
			var $element = $(this),
				elementHeight = $element.outerHeight(),
				elementTopPosition = $element.offset().top,
				elementBottomPosition = (elementTopPosition + elementHeight);

			//check to see if this current container is within viewport
			if( $element.hasClass('arrow4') ) {
				if( (elementBottomPosition >= windowTopPosition) && (elementTopPosition <= (windowBottomPosition-elementHeight)) ) {
					$element.addClass('in-view');
				}
			} else {
				if( (elementBottomPosition >= windowTopPosition) && (elementBottomPosition+10 <= windowBottomPosition) ) {
					$element.addClass('in-view');
				}
			}
		});
	}
	
	function headerResize() {
		var windowTopPosition = $window.scrollTop();
		viewport = updateViewportDimensions();
		
		if( windowTopPosition >= 200 && viewport.width >= 768 ) {
			$('.header').addClass('sticky');
		} else {
			$('.header').removeClass('sticky');
		}
	}

	$window.on('scroll resize', checkIfInView);
	$window.on('scroll resize', headerResize);
	$window.trigger('scroll');
	

}); /* end of as page load scripts */
