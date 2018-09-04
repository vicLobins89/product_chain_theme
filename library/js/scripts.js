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
	
	
	// Masonry
	function masonryInit() {
		$('.grid').masonry({
			itemSelector: '.post',
			columnWidth: '.grid-sizer',
			percentPosition: true
		});
	}
	
	$(window).on('load resize', function(){
		masonryInit();
		
		if( viewport.width < 768 ) {
			$('.current_page_ancestor > .sub-menu').addClass('active');
		} else {
			$('.current_page_ancestor > .sub-menu').removeClass('active');
		}
	});
	
	
	// Menu
	$('.menu-button').on('click', function(){
		$(this).parents('.header').toggleClass('active');
	});
	
	var chooseEvent = 'mouseenter';
	if (/Mobi|Android/i.test(navigator.userAgent)) {
		chooseEvent = 'click';
	} else {
		$('#menu-main-menu > .menu-item-has-children > a').on('click', function(e){
			e.preventDefault();
		});
	}
	
	$('#menu-main-menu > .menu-item-has-children > a').on(chooseEvent, function(e){
		e.preventDefault();
		$('.sub-menu').not( $(this).next('.sub-menu') ).removeClass('active');
		$('#menu-main-menu > .menu-item-has-children > a').not( $(this) ).removeClass('active');
		$(this).next('.sub-menu').toggleClass('active');
		$(this).toggleClass('active');
		if( $('.sub-menu').hasClass('active') ) {
			$('#content, .header').addClass('sub-menu-active');
		} else {
			$('#content, .header').removeClass('sub-menu-active');
		}
		return false;
	});
	
	$('#content').on(chooseEvent, function(){
		$('.sub-menu, .primary-nav a').removeClass('active');
		$(this).removeClass('sub-menu-active');
		$('.header').removeClass('sub-menu-active');
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
		$animationElements = $('.arrow, .ribbon, .haggis-wrapper, .icon-list img, .animate-element, .bcd, .q-mark');
	
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
	
	$window.on('scroll resize', checkIfInView);
	
	
	// Header
	function headerResize() {
		var windowTopPosition = $window.scrollTop();
		viewport = updateViewportDimensions();
		
		if( windowTopPosition >= 200 && viewport.width >= 768 ) {
			$('.header').addClass('sticky');
		} else {
			$('.header').removeClass('sticky');
		}
	}
	
	$window.on('scroll resize', headerResize);
	
	
	// Quiz
	function indexOfMax(arr) {
		if(arr.length === 0) {
			return -1;
		}

		var max = arr[0];
		var maxIndex = 0;

		for(var i = 1; i < arr.length; i++) {
			if( arr[i] >= max ) {
				maxIndex = i;
				max = arr[i];
			}
		}
		
		return maxIndex;
	}
	
	function quiz() {
		var option = [0,0,0],
			clicks = 0,
			quizLength = $('.quiz').length,
			progressPercentage = 100/quizLength;
		
		for(var i = 1; i < quizLength; i++) {
			$('.progress-bar').append('<span class="marker" style="left: '+(100/quizLength)*i+'%;"></span>');
		}
		
		$('.quiz-option').on('click', function(){
			clicks ++;
			$('.marker').toggleClass('odd');
			$(this).addClass('selected');
			$(this).siblings().andSelf().prop('disabled', true);
			$('.progress-bar .fill').css('width', (progressPercentage*clicks)+'%');
			$(this).parent().next('.quiz-next').addClass('active');
			
			switch( $(this).data('option') ) {
				case 'a':
					option[0] ++;
					break;
				case 'b':
					option[1] ++;
					break;
				case 'c':
					option[2] ++;
					break;
			}
			
			if( clicks >= quizLength ) {
				switch( indexOfMax(option) ) {
					case 0:
						$('.outcome-a').addClass('selected');
						$('.quiz-end .btn').hide();
						break;
					case 1:
						$('.outcome-b').addClass('selected');
						$('.quiz-end .btn').show();
						break;
					case 2:
						$('.outcome-c').addClass('selected');
						$('.quiz-end .btn').show();
						break;
				}
			}
			
			if( clicks >= quizLength ) { $('.progress-bar').hide(); }
			$(this).parents('.entry-content').removeClass('active').css('left', '-100%');
			$(this).parents('.entry-content').next('.entry-content').addClass('active');
		});
		
		$('.quiz-start .quiz-next').on('click', function(){
			$('.progress-bar').show();
			$(this).parents('.entry-content').removeClass('active').css('left', '-100%');
			$(this).parents('.entry-content').next('.entry-content').addClass('active');
		});
	}
	
	function fullScreenQuiz() {
		var headerHeight = $('.header').outerHeight();
		viewport = updateViewportDimensions();
		
		$('.page-template-page-quiz .page').css('min-height', (viewport.height-headerHeight));
	}
	
	if( $('body').hasClass('page-template-page-quiz') ) {
		quiz();
		
		$window.on('scroll resize', fullScreenQuiz);
	}
	
	$window.trigger('scroll');

}); /* end of as page load scripts */
