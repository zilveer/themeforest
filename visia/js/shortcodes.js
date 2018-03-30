jQuery( function( $ ) {

	"use strict";

	/* ------------------------------------------------------------------------ */
	/* Accordion */
	/* ------------------------------------------------------------------------ */
	
	jQuery('.accordion').each(function(){
		var acc = jQuery(this).attr("rel") * 2;
		jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').show();
		jQuery(this).find('.accordion-inner:nth-child(' + acc + ')').prev().addClass("active");
	});

	jQuery('.accordion .accordion-title').click(function() {
		if(jQuery(this).next().is(':hidden')) {
			jQuery(this).parent().find('.accordion-title').removeClass('active').next().slideUp(200);
			jQuery(this).toggleClass('active').next().slideDown(200);
		}
	return false;
	});

	/* ------------------------------------------------------------------------ */
	/* Toggle */
	/* ------------------------------------------------------------------------ */
	
	if( jQuery(".toggle .toggle-title").hasClass('active') ){
		jQuery(".toggle .toggle-title.active").closest('.toggle').find('.toggle-inner').show();
	}
	
	jQuery(".toggle .toggle-title").click(function(){
		if( jQuery(this).hasClass('active') ){
			jQuery(this).removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(200);
		}
		else{
			jQuery(this).addClass("active").closest('.toggle').find('.toggle-inner').slideDown(200);
		}
	});

	/* ------------------------------------------------------------------------ */
	/* Tabs */
	/* ------------------------------------------------------------------------ */
	jQuery( '.tabs' ).not( '.tabs-init' ).each( function() {

		var $this = jQuery( this );

		$this.addClass( '.tabs-init' );

		$this
			.find( 'div' )
				.hide()
				.end()
			.find( 'div:first' )
				.show()
				.end()
			.find( 'ul li:first' )
				.addClass('active');

		$this
			.find( 'ul li a' )
				.click( function(){

					var $_this = jQuery( this );

					$this.find( 'ul li' ).removeClass('active');

					$_this.parent().addClass('active');

					var currentTab = $_this.attr('href');

					$this.find( 'div' ).hide();

					jQuery( currentTab ).show();

					return false;

				});


	});
	
});