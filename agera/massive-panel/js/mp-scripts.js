/*-----------------------------------------------------------------------------------*/
/*	Cufon Replace
/*-----------------------------------------------------------------------------------*/

Cufon.replace('h2.main-header, h3, h4');

/*-----------------------------------------------------------------------------------*/
/*	jQuery
/*-----------------------------------------------------------------------------------*/
          
jQuery(document).ready(function($) {
	

	
	$('.hide-checkbox').each(function() {
		var id = $(this).attr('id');
		var idAr = id.split('_checkbox');
	
		if($(this).attr('checked') == 'checked'){
			$('.'+idAr[0]+'_wrap').show();
		} else {
			$('.'+idAr[0]+'_wrap').hide();
		}
	})
	
	$('.hide-checkbox').change(function () {
		var id = $(this).attr('id');
		var idAr = id.split('_checkbox');
		
		//alert('.'+idAr[0]+'_wrap');
		if($(this).attr('checked') == 'checked'){
			$('.'+idAr[0]+'_wrap').slideDown();
		} else {
			$('.'+idAr[0]+'_wrap').slideUp();
		}
		
		if($(this).parent().find('div').hasClass('mp-related-object')){
			var related = $(this).parent().find('div.mp-related-object').text();
			$('#' + related + '_checkbox').attr('checked', false);
			$('.' + related + '_wrap').slideUp();
		}
	});
	
	$('textarea.displayall').each(function () {
		$(this).val($(this).val());
	});
	
	$('textarea.displayall-upload').each(function () {
		var taText = $(this).val();
		var urlArray = taText.split('http');
		taText = '';
		$.each(urlArray, function (i, val) {
			if(i != 0)
				taText += "http" + val;
		});
		//alert(taText);
		$(this).val(taText);
	});
	
	$('.group').hide();
	$('.section-group').hide();
	$('.tab-group').hide();
	
	var activetab		 = '';
	var activesection	 = '';
	
	// fix after refresh
	function getSection() {
   		var vars = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
   		return vars;
	}
	
	/* Change Sidebar */
	$('.button-tab a').click(function(e) {
		e.preventDefault();
	});
	
	//var unique_footer = $('.layout_footer_radio').is(':checked');
	//alert(unique_footer);
	
	$('.mp-dropdown-sidebar-small').change(function(e) {
		$('.radio_set_small').each(function() {
			$(this).hide();
		});
		
		if($(this).val() != '')
			$('#radio_set_small_' + $(this).val()).fadeIn();
	});
	
	$('.mp-dropdown-sidebar').change(function(e) {
		//e.preventDefault();
		$('.radio_set').each(function() {
			$(this).hide();
		});
		
		$('.layout_sidebar_radio').each(function() {
			$(this).hide();
		});
		
		$('.layout_footer_radio').each(function() {
			$(this).hide();
		});
		
		$('.unique_footer_columns').each(function() {
				$(this).hide();
			});
		
		if($(this).val() != '')
			$('#radio_set_' + $(this).val()).fadeIn();
			
		if($(this).val() != '')
			$('#layout_sidebar_radio_' + $(this).val()).fadeIn();
		
		if($(this).val() != '')
			$('#layout_footer_radio_' + $(this).val()).fadeIn();
			
		if($('#layout_footer_radio_' + $(this).val() + ' input').attr('checked')){
			$('#unique_footer_columns_' + $(this).val()).fadeIn();
		}
	});
	$('.mp-dropdown-sidebar').trigger('change');
	$('.mp-dropdown-sidebar-small').trigger('change');
	
	
	$('.layout_footer_radio input').change(function(e){
		if($(this).attr('checked')){
			$('.unique_footer_columns').each(function() {
				$(this).hide();
			});
			$('#unique_footer_columns_' + $(this).parent().parent().find('.mp-dropdown-sidebar').val()).fadeIn();
		}
	});
	
	
	/* Setup Portfolio */
	$('.mp-dropdown-portfolio').change(function(e) {
		$('.portfolio_option_set').each(function() {
			$(this).hide  ();
		});
		if($(this).val() != '')
			$('#portfolio_set_' + $(this).val()).fadeIn();	
		// trigger change event for the visible select	
		$('.portfolio_option_set').each(function() {
			if($(this).css('display') != 'none'){
				$('.mp-dropdown-portfolio-columns', this).trigger('change');
			}
		});
	});
	
	$('.mp-dropdown-portfolio-columns').change(function(e) {
		$('.mp-dropdown-portfolio-posts').each(function() {
			$(this).hide();
		});
		
		if($(this).val() != '')
			$('.mp_portfolio_posts_' + $(this).val()).fadeIn();
	});
	$('.mp-dropdown-portfolio').trigger('change');

	// trigger change event for the visible select
	$('.portfolio_option_set').each(function() {
		if($(this).css('display') != 'none'){
			$('.mp-dropdown-portfolio-columns', this).trigger('change');
		}
	});
	
	/* Click Tab */
	$('.button-tab a').click(function(evt) {
		$('.button-tab a').removeClass('selected');
		$(this).addClass('selected').blur();
		$('.button-tab a').trigger('mouseleave');
		
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", $(this).attr('href'));
		}
		$('.group').hide();
		$.cookie("active-tab", '#'+$(this).attr('id'));
		$(clicked_group).show();
		evt.preventDefault();
	});
	
	/* Click Section */
	$('.button-sidebar a').click(function(e) {
		$('.button-sidebar a').removeClass('selected');
		$(this).addClass('selected').blur();
		$('.button-sidebar a').trigger('mouseleave');
		
		var clicked_section = $(this).attr('href') + '-tab';
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activesection", $(this).attr('href')  + '-tab');
		}
		
		$(clicked_section).hide();
		$('.tab-group').hide();
		
		$(clicked_section).show();

		var something = $(this).attr('href')  + '-tab' + ' .button-tab:first a';
		if($.cookie("active-tab") == null || '#'+$(this).attr('id') != $.cookie("active-section")){
			var something = $(this).attr('href')  + '-tab' + ' .button-tab:first a';
			$(something).trigger('mouseenter');
			$(something).trigger('click');
		} else {
			$($.cookie("active-tab")).trigger('mouseenter');
			$($.cookie("active-tab")).trigger('click');
		}	
		$.cookie("active-section", '#'+$(this).attr('id'));
		e.preventDefault();
	});
	
	/* hover navigation tab */
	$('.button-tab a').hover(
		function(evt) {
			$(this).find('span.tab-bg-left').removeClass('tab-bg-left').addClass('tab-bg-left-hover');
			$(this).find('span.tab-bg-center').removeClass('tab-bg-center').addClass('tab-bg-center-hover');
			$(this).find('span.tab-bg-right').removeClass('tab-bg-right').addClass('tab-bg-right-hover');
			$(this).find('span.tab-text').removeClass('tab-text').addClass('tab-text-hover');
		
	}, function(evt) {
		if(!$(this).hasClass('selected')){
			$(this).find('span.tab-bg-left-hover').removeClass('tab-bg-left-hover').addClass('tab-bg-left');
			$(this).find('span.tab-bg-center-hover').removeClass('tab-bg-center-hover').addClass('tab-bg-center');
			$(this).find('span.tab-bg-right-hover').removeClass('tab-bg-right-hover').addClass('tab-bg-right');
			$(this).find('span.tab-text-hover').removeClass('tab-text-hover').addClass('tab-text');
		}
	});
	
	/* hover social icon */
	$('li.social').hover(
		function(evt) {
			$(this).find('span').fadeIn();
		}, function(evt) {
			$(this).find('span').fadeOut();
		});
	
	/* hover navigation button */
	$('.button-sidebar a').hover(
		function(evt) {
			$(this).find('span.button-sidebar-bg').removeClass('button-sidebar-bg').addClass('button-sidebar-bg-hover');
			$(this).find('span.empty').removeClass('empty').addClass('button-arrow');
			$(this).find('label').addClass('button-label-hover');
		}, function(evt) {
			if(!$(this).hasClass('selected')) {
				$(this).find('span.button-sidebar-bg-hover').removeClass('button-sidebar-bg-hover').addClass('button-sidebar-bg');
				$(this).find('span.button-arrow').removeClass('button-arrow').addClass('empty');
				$(this).find('label').removeClass('button-label-hover');
			}
	});
	
	/*  Color Picker */
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		

		$(this).ColorPicker({
			color: initialColor,
			onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
			onChange: function (hsb, hex, rgb) {
			$(Othis).children('div').css('backgroundColor', '#' + hex);
			$(Othis).next('input').attr('value','#' + hex);
			}
		});
	}); 
	
	/* open tab */
	if($.cookie("active-section") != null){
		$($.cookie("active-section")).trigger('mouseenter');
		$($.cookie("active-section")).trigger('click');
	} else {
		$('.button-sidebar:first a').trigger('mouseenter');
		$('.button-sidebar:first a').trigger('click');
	}
	
	
	/* errors */
	var error_msg = $("#message p[class='setting-error-message']");
	// look for admin messages with the "setting-error-message" error class
	if (error_msg.length != 0) {
		// get the title
		var error_setting = error_msg.attr('title');	
		// look for the input with id=setting title and add a red border to it.
		$("input[id='" + error_setting + "']").attr('style', 'background-color:#f8b2b2!important;');
	} 
	
	
	
	$('.save-button').fadeIn();
		
});