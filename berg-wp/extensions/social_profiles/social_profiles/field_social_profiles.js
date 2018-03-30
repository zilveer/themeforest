/* global confirm, redux, redux_change */

jQuery(document).ready(function($) {

	/* icon manager select */
	$('#icon-manager-select').on('change', function(){
		var selectedVal = $(this).val();
		if ( selectedVal === 'iconpicker' ){
			$('.iconpicker').removeClass('social-hidden');
			$('.icon-image-manager').addClass('social-hidden');
		} else {
			$('.icon-image-manager').removeClass('social-hidden');
			$('.iconpicker').addClass('social-hidden');
		}
	});

	/* icon-picker */
	$('.iconpicker #pick-icon').on('click', function(){
		$('.icon-set-container').toggle();
	});
	$('.icon-set-container i').on('click', function(){
		var iconSelect = $(this);
		console.log(iconSelect);
		$('.icon-prev i').attr('class', iconSelect.attr('class'));
		$('#icon-content').val(iconSelect.attr('class'));
		$('.icon-set-container').toggle();
	});

	/* image upload */
	$('#add-image').on('click', function(){
		var frame;
		if ( frame !== undefined ) {
			frame.open();
			return;
		}

		frame = wp.media(
			{
				multiple: false,
			}
		);

		frame.on('select', function(){
			var attachment = frame.state().get( 'selection' ).first();

            frame.close();

            var imageUrl = attachment.attributes.url;

            $('.img-prev').append('<img src="'+ imageUrl +'" class="icon-image-option">');

            $('#remove-image').removeClass('social-hidden');

            $('#icon-img-url').val(imageUrl);

		});

		frame.open();
	});

	/* remove img */
	$('#remove-image').on('click', function(){
		$('.icon-image-option').remove();
		$('#icon-img-url').val('');
		$(this).addClass('social-hidden');
	});

	/* adding social */
	$('#add-new-social-profile').on('click', function(){
		var social_title = $('#social-title').val(),
			social_link = $('#social-link').val(),
			social_icon_picker = $('#icon-content').val(),
			social_icon_image = $('#icon-img-url').val(),
			last_val = $('#socials-string').val(),
			result = '',
			social_icon,
			social_data;

		if ( $('#icon-manager-select').val() === 'iconpicker' ) {
			social_icon = social_icon_picker;
		} else {
			social_icon = social_icon_image;
		}

		if (!Date.now) {
			Date.now = function now() {
				return new Date().getTime();
			};
		}

		social_data = { 'soc_title': social_title, 'soc_link': social_link, 'soc_icon_str': social_icon, 'id':  Date.now().toString() };

		if ( last_val !== '' ){
			last_val += '|'+returnJasonStr(social_data);
		} else {
			last_val += returnJasonStr(social_data);
		}
		
		$('#socials-string').val(last_val);
		
		clearFields();

		result += '<li class="social-item" id="'+ social_data.id +'">'+
		'<div class="social-item-wrapper">'+
		'<div class="soc-content">'+
		'<div class="icon-wrapper pull-left">'+ returnProperIcon(social_data.soc_icon_str) +'</div>'+
		'<span class="social-title">'+ social_data.soc_title +'</span>'+
		'</div>'+
		'<p class="link-url"><span>URL: </span>'+ social_data.soc_link +'</p>'+
		'<a href="javascript:void(0);" data-id="'+ social_data.id + '" class="button-secondary remove-social-item pull-right">'+ php_data.btn_name +'</a>'+
		'</div></li>';
		$('#social-items-sorting').append(result);
		removeItem();
		sortItemesInit();

	});

	removeItem();
	
	/* return JSON string */
	function returnJasonStr(obj){
		var str_id = obj.id,
			obj_str = '{ "'+ str_id +'": [{ "title": "'+ obj.soc_title +'", "link": "'+ obj.soc_link +'", "icon": "'+ obj.soc_icon_str +'"}]}';
		return obj_str;
	}

	/* clear fields */
	function clearFields() {
		$('#social-title, #social-link, #icon-content, #icon-img-url').val('');
		$('.icon-prev i').text('');
		$('.icon-image-option').remove();
	}
	
	/* checking icon type and return proper string */
	function returnProperIcon(icon_str){
		var result = '',
			url_pattern = /^(ftp|http|https):\/\//;
		if ( url_pattern.test(icon_str) ) {
			result += '<img class="soc-icon-img" src="'+ icon_str +'">';
		} else {
			result += '<i class="'+icon_str+'"></i>';
		}
		return result;
	}

	/* sorting items */
	$('#social-items-sorting').sortable({
		placeholder: "sortable-placeholder",
		update: function( event, ui) {
			sortItemesInit();
		}
	});
	
	/* sort init */
	function sortItemesInit() {
		var sort_string = $('#social-items-sorting').sortable('toArray').toString();
		$('#social_profiles').val(sort_string);
	}

	/* delete value item */
	function delateValue(id) {

		var str_val = $('#socials-string').val(),
			arr_str = str_val.split('|'),
			result_str = '',
			index;
		
		for ( index = 0; index < arr_str.length; index++ ) {
			if ( JSON.parse(arr_str[index]).hasOwnProperty(id) ) {
				arr_str.splice(index,1);
				break;
			}
		}
		result_str = arr_str.join('|');
		$('#socials-string').val(result_str);
	}

	/* remove item */
	function removeItem(){
		$('.remove-social-item').on('click', function(){
			var item_id = $(this).data('id');
			delateValue(item_id);
			$('#'+item_id).remove();
			sortItemesInit();
		});
	}
	
});
