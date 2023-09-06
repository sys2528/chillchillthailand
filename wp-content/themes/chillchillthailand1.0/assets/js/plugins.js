/* Scroll */
jQuery(document).ready(function(){
	jQuery('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				jQuery('html, body').animate({
				scrollTop: target.offset().top - 90 }, 1000);
				return false;
			}
		}
	});
});

jQuery(window).load(function(){
	function goToByScroll(id){
		jQuery("html, body").animate({scrollTop: jQuery("#"+id).offset().top - 90 }, 1000);
	}
	if(window.location.hash != '') {
		goToByScroll(window.location.hash.substr(1));
	}
});
/* End Scroll */

/* Scroll to Fixed */
$(function(){	
	// scroll is still position
	var scroll = $(document).scrollTop();
	var headerHeight = $('.TopHeader').outerHeight();
	//console.log(headerHeight);
	$(window).scroll(function() {
		// scrolled is new position just obtained
		var scrolled = $(document).scrollTop();
		// optionally emulate non-fixed positioning behaviour
		if (scrolled > headerHeight){
			$('.TopHeader').addClass('off-canvas');
		} else {
			$('.TopHeader').removeClass('off-canvas');
		}
		if (scrolled > scroll){
			// scrolling down
			$('.TopHeader').removeClass('fixed');
		} else {
			//scrolling up
			$('.TopHeader').addClass('fixed');
		}
		scroll = $(document).scrollTop();	
	});
});
/* End Scroll to Fixed */

/* Category top page */
$(document).ready(function() {
	$(this).on("click", ".OpenCategory", function() {
	  $(this).parent().find(".CategoryList").toggle('fast');
	  $(this).find(".fa").toggleClass('active');
	});
});
/* End Category top page */

/* Toggle Menu */
$(".toggle-mnu").click(function() {
	$(this).toggleClass("on");
	$(".main-mnu").slideToggle();
	return false;
});
/* End Toggle Menu */

/* Mobile Menu */
function ClickMenu(id){
	$(this).toggleClass("on");
	$('.LeftMenuMobile').toggleClass('OpenMenuMobile');
};
/* End Mobile Menu */

/* Back to Top */
jQuery(document).ready(function($){
	var offset = 300,
		offset_opacity = 1200,
		scroll_top_duration = 700,
		$back_to_top = $('.cd-top');
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});
});
/* End Back to Top */

/* Menu Click */
$('.btn-nav').on('click', function() {
	$('.MenuList').addClass('showing');
});
$('.btn-close').on('click', function() {
	$('.MenuList').removeClass('showing');
});
/* End Menu Click */