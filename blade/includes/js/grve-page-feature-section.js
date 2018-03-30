jQuery(document).ready(function($) {

	"use strict";

	//Feature Map
	$('.grve-map-item-delete-button').click(function() {
		$(this).parent().remove();
	});

	$('#grve-upload-multi-map-point').click(function() {

		$('#grve-upload-multi-map-point').attr('disabled','disabled').addClass('disabled');
		$('#grve-upload-multi-map-button-spinner').show();


		$.post( grve_feature_section_texts.ajaxurl, { action:'blade_grve_get_map_point', map_mode:'new' } , function( mediaHtml ) {
			$('#grve-feature-map-container').append(mediaHtml);

			$('.grve-map-item-delete-button.grve-item-new').click(function() {
				$(this).parent().remove();
			}).removeClass('grve-item-new');

			$('.grve-open-map-modal.grve-item-new').bind("click",(function(e){
				e.preventDefault();
				$(this).bindOpenMapModal();
			})).removeClass('grve-item-new');

			$('.grve-remove-simple-media-button.grve-item-new').click(function() {
				$(this).bindRemoveSimpleMedia();
			}).removeClass('grve-item-new');
			$('.grve-upload-simple-media-button.grve-item-new').click(function() {
				$(this).bindUploadSimpleMedia();
			}).removeClass('grve-item-new');

			$('.grve-tabs.grve-item-new .grve-tab-links a').bind("click", (function(e) {
				var currentAttrValue = $(this).attr('href');
				$('.grve-tabs ' + currentAttrValue).show().siblings().hide();
				$(this).parent('li').addClass('active').siblings().removeClass('active');
				e.preventDefault();
			})).removeClass('grve-item-new');

			$('.grve-admin-label-update').off("change").on("change",(function(){
				$(this).bindFieldsAdminLabelUpdate();
			}));

			$('.postbox.grve-item-new .handlediv').on('click', function() {
				var p = $(this).parent('.postbox');

				p.removeClass('grve-item-new');
				p.toggleClass('closed');

			});

			$('#grve-upload-multi-map-point').removeAttr('disabled').removeClass('disabled');
			$('#grve-upload-multi-map-button-spinner').hide();
		});
	});



	$('#grve-page-feature-element').change(function() {

		$('.grve-feature-section-item').hide();
		$('.grve-feature-required').hide();
		$('.grve-feature-options-wrapper').show();

		switch($(this).val())
		{
			case "title":
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-tab-content-link').click();
				$('.grve-item-feature-content-settings').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-container').stop( true, true ).fadeIn(500);
			break;
			case "image":
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-tab-bg-link').click();
				$('.grve-item-feature-bg-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-content-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-image-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-overlay-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-button-settings').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-container').stop( true, true ).fadeIn(500);

			break;
			 case "video":
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-tab-video-link').click();
				$('.grve-item-feature-video-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-bg-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-content-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-overlay-settings').stop( true, true ).fadeIn(500);
				$('.grve-item-feature-button-settings').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-container').stop( true, true ).fadeIn(500);
			break;
			case "slider":
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-slider').stop( true, true ).fadeIn(500);
				$('#grve-feature-slider-container').stop( true, true ).fadeIn(500);
			break;
			case "map":
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-section-map').stop( true, true ).fadeIn(500);
				$('#grve-feature-map-container').stop( true, true ).fadeIn(500);
			break;
			case "revslider":
				$('.grve-feature-options-wrapper').hide();
				$('#grve-feature-section-options').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-tab-revslider-link').click();
				$('.grve-item-feature-revslider-settings').stop( true, true ).fadeIn(500);
				$('#grve-feature-single-container').stop( true, true ).fadeIn(500);
			break;
			default:
			break;
		}
	});

	$('#grve-page-feature-size').change(function() {

		if( 'custom' == $(this).val() ) {
			$('#grve-feature-section-height').stop( true, true ).fadeIn(500);
		} else {
			$('#grve-feature-section-height').hide();
		}

	});

	$('.grve-select-color-extra').change(function() {
		if( 'custom' == $(this).val() ) {
			$(this).parents('.grve-field-items-wrapper').find('.grve-wp-colorpicker').show();
		} else {
			$(this).parents('.grve-field-items-wrapper').find('.grve-wp-colorpicker').hide();
		}
	});

	$(window).load(function(){
		$('#grve-page-feature-element').change();
		$('#grve-page-feature-size').change();
		$('.grve-select-color-extra').change();
	});

	$('.wp-color-picker-field').wpColorPicker();


	// TABS METABOXES
	$('.grve-tabs .grve-tab-links a').on('click', function(e)  {
		$(this).bindTabsMetaboxes(e);
	});

	$.fn.bindTabsMetaboxes = function(e){
		var currentAttrValue = $(this).attr('href');

		$('.grve-tabs ' + currentAttrValue).show().siblings().hide();
		$(this).parent('li').addClass('active').siblings().removeClass('active');

		e.preventDefault();
	}

	$('.grve-dependency-field').on("change",(function(){
		$(this).bindFieldsDependency();
	}));

	// FIELDS DEPENDENCY
	$.fn.bindFieldsDependency = function(){

		var groupID = $(this).data( "group");

		$('#' + groupID + " [data-dependency] ").each(function() {
			var dataDependency = $(this).data( "dependency"),
				show = true;

			for (var i = 0; i < dataDependency.length; i++) {

				var depId = dataDependency[i].id,
					depValues = dataDependency[i].values,
					depVal = $('#' + depId ).val();

				if($.inArray( depVal, depValues ) == -1){
					show = false;
				}

			}

			if( show ) {
				$(this).fadeIn(500);
			} else {
				$(this).hide();
			}
		});
    }

	$.fn.initFieldsDependency = function(){

		$(this).each(function() {
			var dataDependency = $(this).data( "dependency"),
				show = true;

			for (var i = 0; i < dataDependency.length; i++) {

				var depId = dataDependency[i].id,
					depValues = dataDependency[i].values,
					depVal = $('#' + depId ).val();

				if($.inArray( depVal, depValues ) == -1){
					show = false;
				}

			}

			if( show ) {
				$(this).fadeIn(500);
			} else {
				$(this).hide();
			}

		});

	}
	$( "[data-dependency]" ).initFieldsDependency();

	$('.grve-admin-label-update').on("change",(function(){
		$(this).bindFieldsAdminLabelUpdate();
	}));

	$.fn.bindFieldsAdminLabelUpdate = function(){
		var itemID = $(this).attr('id') + '_admin_label';
		$('#' + itemID ).html($(this).val());
    }

});