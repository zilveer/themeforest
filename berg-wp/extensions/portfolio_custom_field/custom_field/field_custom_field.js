/* global confirm, redux, redux_change */
jQuery(document).ready(function($) {

	$('#add-text').on('click', function(){
		var last_id = $('.portfolio-field-list li:last-child').data('id'),
			field_count = last_id + 1,
			el_number = $('.portfolio-field-list li').length;

		addCustomField(field_count);
		initTinyMce(field_count);
		if ( el_number === 1 ) {
			addButton();
		}
		removeCustomField();
	});

	removeCustomField();

	/* remove field */
	function removeCustomField(){
		$('.remove-custom-field').on('click', function(){
			$(this).parent().remove();
			var field_id = $(this).attr('id'),
				buttons_items = $('.remove-custom-field').length;

			removeTinyMce(field_id);
			
			if ( buttons_items === 1 ) {
				removeButton();
			}
		});
	}

	/* add custom field */
	function addCustomField(id){
		var new_field = '<li class="portfolio-custom-field-wrapper" data-id="'+ id +'">'+
		'<div class="input-wrapper custom-field-input-wrapper">'+
		'<label class="redux-text-label" for="arkona_portfolio_custom_field_header_'+ id +'">'+ data_strings.label_input +'</label>'+
		'<input type="text" id="arkona_portfolio_custom_field_header_'+ id +'" name="redux[arkona_portfolio_custom_field]['+ id +'][header]" class="regular-text" value="" />'+
		'</div>'+
		'<div class="input-wrapper custom-field-input-wrapper">'+
		'<label class="redux-text-label" for="arkona_portfolio_custom_field_content_'+ id +'">'+ data_strings.label_textarea +'</label>'+
		'<textarea name="redux[arkona_portfolio_custom_field]['+ id +'][content]" id="arkona_portfolio_custom_field_content_'+ id +'"></textarea>'+
		'</div>'+
        '<a href="javascript:void(0);" id="'+ id +'" class="button-secondary remove-custom-field">'+ data_strings.button_remove +'</a>'+
		'</li>';
		$('.portfolio-field-list').append(new_field);
	}

	/* TinyMCE init */
	function initTinyMce(id){
		var textarea = 'arkona_portfolio_custom_field_content_'+id;
		tinymce.EditorManager.execCommand('mceAddEditor', false, textarea);
	}

	/* remove button */
	function removeButton(){
		$('.remove-custom-field').remove();
	}

	/* add button */
	function addButton(){
		$('.portfolio-field-list li:first-child').append('<a href="javascript:void(0);" id="0" class="button-secondary remove-custom-field">'+ data_strings.button_remove +'</a>');
	}

	/* TinyMCE remove */
	function removeTinyMce(id){
		tinymce.EditorManager.execCommand('mceRemoveEditor', false, 'arkona_portfolio_custom_field_content_'+id);
	}

});
