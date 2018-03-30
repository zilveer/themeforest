// JavaScript Document

(function($){ "use strict";


	$('.themo_confirmation').on('click', function () {
		return confirm('Are you sure? Do you have unsaved updates?');
	});

	//Service Block Style Switch
	$(".service-block-layout input:radio").click(function() {
		$('.service-block-style').toggle();
		$('.service-block-columns').toggle();
	});

	/*
	 * Check each checkbox that is a on/off switch and show hide respectively.
	 * */

  	/**/


	$(".checkbox-switch").each(function() {
		var checkbox_name = $(this).find("input[type='checkbox']:first").attr("name");
		if(checkbox_name > "") {
			if ($(this).find("input[type='checkbox']:first").is(':checked')) {
				$(".checkbox-condition." + checkbox_name).show();

				// If service-block-layout present then make sure show / hide service block style and columns
				if($(".checkbox-condition." + checkbox_name).hasClass( "service-block-layout" )){
					var layout = $(".checkbox-condition." + checkbox_name +".service-block-layout input:radio:checked").val();
					if(layout == 'vertical') {
						$('.service-block-style').toggle();
						$('.service-block-columns').toggle();
					}
				}
			} else {
				$(".checkbox-condition." + checkbox_name).hide();

			}
		}
	});


	/*
	* On click / switch hide show conditional elements.
	* */

	$(".checkbox-switch").on('change', function() {
		var checkboxid = $(this).find("input[type='checkbox']:first").attr("id");

		if($('#'+checkboxid+ ':checkbox:checked').length > 0){
			$(".checkbox-condition." + checkboxid).show();
		}else{
			$(".checkbox-condition." + checkboxid).hide();
		}
	});


	//-----------------------------------------------------
	// Show Warning about updating page when custom template selected
	// in admin
	//-----------------------------------------------------
	$('#themo_template_selection').change(function(){
		$( "#setting_themo_template_select_help" ).slideDown( "slow", function() {
		// Animation complete.
		});
	});

	// When unchecking a meta box from a page, make sure the meta box is not currenly set to display, if it us don't allow uncheck.
	$(".checkbox-inline [type=checkbox]").click( function(){
	   if ($(this).prop('checked')==false){
			// Check matching display status and see if we need to warn user.
			var meta_box_name = $(this).val();
			if(meta_box_name > ""){
				var meta_box_name_ucase = meta_box_name
				meta_box_name_ucase = meta_box_name_ucase.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				if($("input:checkbox[name='themo_"+meta_box_name+"_1_sortorder_show']:checked").val() == 1){
					alert('Display for '+meta_box_name_ucase+' is set to "ON", switch this to "OFF" before removing this Meta Box.');
					return false;
				};
			}
		}
	});

	if($("#themo_sortable").length){
		// Make list item sortable / drag and drop.
		$("#themo_sortable").sortable({
			update: function(event, ui) {
				//create the array that hold the positions...
				var order = [];
				var meta_box_sort_order = 0;
				//loop trought each li...
				$('#themo_sortable li').each( function(e) {
				//add each li position to the array...
				// the +1 is for make it start from 1 instead of 0
					order.push( $(this).context.childNodes[0].id  + '=' + ( $(this).index()) );
					var updateMe = '#'+$(this).context.childNodes[0].id;
					var data_meta_box_name = $(updateMe).data('meta-box-name');
					$(updateMe).val($(this).index());

					// Update sort order value of the actual meta box. themo_accordion_2_order
					var meta_box_order_input = '_order';
					if($('#'+data_meta_box_name+'_order').length){
						meta_box_sort_order=meta_box_sort_order+10;
						$('#'+data_meta_box_name+'_order').val(meta_box_sort_order)
					}
				});
				// join the array as single variable...
				var positions = order.join(';')
			}
		}).disableSelection();
	}

	// SORT Drag and Drop list on page load.
	/**/$('#themo_sortable li').each(function (index) {
		var updateMe = '#'+$(this).context.childNodes[0].id;
		var data_meta_box_name = $(updateMe).data('meta-box-name');
		var meta_box_order_input = data_meta_box_name + '_order';

		if($('#'+meta_box_order_input).length){
			var meta_box_order_value = $('#'+meta_box_order_input).val();
			$(updateMe).val(meta_box_order_value);
		}
	});


	// Sort Meta Box List when page loads.
	function themo_sortlist(a, b) {
		return (parseInt($(a).find("input[type=hidden]").val(), 10) - parseInt($(b).find("input[type=hidden]").val(), 10));
	}

	$("#themo_sortable li").sort(themo_sortlist).appendTo("#themo_sortable");


})(jQuery);


