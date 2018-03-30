jQuery(document).ready(function($) {

	"use strict";

	// ---------------------------------------------------------
	// Enable toggle for Main menu on tablets and mobile
	// ---------------------------------------------------------

	$('.mobile_nav_style_1 .btn-navbar').toggleMenu({'viewport':767});

	// ---------------------------------------------------------
	// Main Menu Search
	// ---------------------------------------------------------

	$("#search-trigger").click(function(){ return false; });

	$('#search-popup-wrapper').each(function(){

	    var distance = 10;
	    var time = 250;
	    var hideDelay = 500;

	    var hideDelayTimer = null;

	    var beingShown = false;
	    var shown = false;
	    var trigger = $('#search-trigger', this);
	    var info = $('.search-popup-outer', this).css('opacity', 0);


	    $([trigger.get(0), info.get(0)]).mouseover(function () {
	        if (hideDelayTimer) clearTimeout(hideDelayTimer);
	        if (beingShown || shown) {
	            // don't trigger the animation again
	            return;
	        } else {
	            // reset position of info box
	            beingShown = true;

	            info.css({
	                bottom: 5,
	                right: -12,
	                display: 'block'
	            }).animate({
	                bottom: '+=' + distance + 'px',
	                opacity: 1
	            }, time, 'swing', function() {
	                beingShown = false;
	                shown = true;
	            });
	        }

	        return false;

	    }).mouseout(function () {

	        if (hideDelayTimer) clearTimeout(hideDelayTimer);
	        hideDelayTimer = setTimeout(function () {
	            hideDelayTimer = null;
	            info.animate({
	                bottom: '+=' + distance + 'px',
	                opacity: 0
	            }, time, 'swing', function () {
	                shown = false;
	                info.css('display', 'none');
	            });

	        }, hideDelay);

	        return false;
	    });
	});

	// ---------------------------------------------------------
	// Header Shades
	// ---------------------------------------------------------

	$('h1, h2, h3').each(function(){
	    var el = $(this);
	    el.has('a').addClass('has-shade').find('a').prepend('<span class="header-shade"></span>');
	   	el.not('.has-shade').prepend('<span class="header-shade"></span>');
	});

});