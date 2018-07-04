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
				setTimeout(checkLoad, 200);
			} else {
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
	

}); /* end of as page load scripts */
