
/* global redux_change, wp */

jQuery(function($){
	"use strict";
	
	$.reduxMetaBoxes = $.reduxMetaBoxes || {};
	
	$(document).ready(function () {

		 $.reduxMetaBoxes.init();
	});

	/**
	* Redux Metaboxes
	* Dependencies      : jquery
	* Feature added by  : Dovy Paukstys
	* Date              : 19 Feb. 2014
	*/
	$.reduxMetaBoxes.init = function(){

		$('.redux-container').each(function() {
			if ($(this).hasClass('redux-has-sections')) {
				$(this).parents('.postbox:first').find('h3.hndle').attr('class', 'redux-hndle');
			}
		});
	};

	$('.redux-field').each(function(){
		$(this).bind('click', function(){
			console.log($(this).data('id'));
			var fieldId = $(this).data('id');
			$.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "reset_metaboxes_value", postId: $('#post_ID').val(), field: fieldId},
				success: function(response) {
					if(response.type == "success") {
						console.log('success');
					}
					else {
						alert("Your vote could not be added");
					}
				}
			});
		});
	});
});
