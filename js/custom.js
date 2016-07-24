(function ($) {
	"use strict";

    jQuery(document).ready(function($){
		
		$(window).scroll(function() {
			
			if ($(window).scrollTop() > 200) {
				$("body").addClass("sticky-menu");
			} 
			else {
				$("body").removeClass("sticky-menu");
			}
		}); 
		
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
		
		
		var searchWrapper = document.querySelector('.search-wrapper'), searchInput = document.querySelector('.search-input');
		document.addEventListener('click', function (e) {
			if (~e.target.className.indexOf('search')) {
				searchWrapper.classList.add('focused');
				searchInput.focus();
			} else {
				searchWrapper.classList.remove('focused');
			}
		});
		
		$('#slider .thumbnail').owlCarousel({
			loop:true,
			autoplay: true,
			nav:true,
			navText:['<span class="ion-ios-arrow-left"></span>','<span class="ion-ios-arrow-right"></span>'],
			dots: true,
			responsiveClass:true,
			responsive:{
				0:{
					items:1,
					dots: false
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			}
		});
		
		$('.related-post').owlCarousel({
			loop:true,
			autoplay: true,
			nav:true,
			navText:['<span class="ion-ios-arrow-left"></span>','<span class="ion-ios-arrow-right"></span>'],
			dots: true,
			responsiveClass:true,
			responsive:{
				0:{
					items:1,
					dots: false
				},
				600:{
					items:2
				},
				1000:{
					items:3
				}
			}
		});

    });

	
    jQuery(window).load(function(){

        
    });


}(jQuery));	