/* global confirm, redux, redux_change */

jQuery(document).ready(function($) {
	/* adding social */
	$('#add-new-team-member').on('click', function(){
		var team_name = $('#team_name').val(),
			team_pos = $('#team_pos').val(),
			team_desc = tinyMCE.get('team_desc').getContent({format: 'raw'}),
			// social_icon_picker = $('#icon-content').val(),
			// social_icon_image = $('#icon-img-url').val(),
			last_val = $('#team-string').val(),
			result = '',
			// social_icon,
			team_data;
		team_desc = team_desc.replace(/"/g, '&quot;');
		// team_desc = team_desc.replace("'", "\'");
		// if ( $('#icon-manager-select').val() === 'iconpicker' ) {
		// 	social_icon = social_icon_picker;
		// } else {
		// 	social_icon = social_icon_image;
		// }

		if (!Date.now) {
			Date.now = function now() {
				return new Date().getTime();
			};
		}

		team_data = { 'team_name': team_name, 'team_pos': team_pos, 'team_desc': team_desc, 'id':  Date.now().toString() };
		// console.log(team_data);
		if ( last_val !== '' ){
			last_val += '|x;|'+returnJasonStr(team_data);
		} else {
			last_val += returnJasonStr(team_data);
		}
		
		$('#team-string').val(last_val);
		
		clearFields();

		result += '<li class="team-item" id="'+ team_data.id +'">'+
		'<div class="team-item-wrapper">'+
		// '<div class="team-content">'+
		// '<div class="icon-wrapper pull-left">'+ returnProperIcon(social_data.soc_icon_str) +'</div>'+
		'<p class="team-name"><span>Name: </span>'+ team_data.team_name +'</p>'+
		// '</div>'+
		'<p class="team-pos"><span>Position: </span>'+ team_data.team_pos +'</p>'+
		'<div class="team-desc"><span>Info: </span>'+ team_data.team_desc +'</div></div>'+
		'<a href="javascript:void(0);" data-id="'+ team_data.id + '" class="button-secondary remove-team-item pull-right">'+ php_data.btn_name +'</a>'+
		'</li>';
		$('#team-items-sorting').append(result);
		removeItem();
		sortItemesInit();

	});

	removeItem();
	
	/* return JSON string */
	function returnJasonStr(obj){
		var str_id = obj.id,
			obj_str = '{ "'+ str_id +'": [{ "name": "'+ obj.team_name +'", "pos": "'+ obj.team_pos +'", "desc": "'+ obj.team_desc +'"}]}';
		return obj_str;
	}

	/* clear fields */
	function clearFields() {
		$('#team_name, #team_pos').val('');
		tinyMCE.get('team_desc').setContent('');

		// $('.icon-prev i').text('');
		// $('.icon-image-option').remove();
	}
	
	/* checking icon type and return proper string */
	// function returnProperIcon(icon_str){
	// 	var result = '',
	// 		url_pattern = /^(ftp|http|https):\/\//;
	// 	if ( url_pattern.test(icon_str) ) {
	// 		result += '<img class="soc-icon-img" src="'+ icon_str +'">';
	// 	} else {
	// 		result += '<i class="'+icon_str+'"></i>';
	// 	}
	// 	return result;
	// }

	/* sorting items */
	$('#team-items-sorting').sortable({
		placeholder: "sortable-placeholder",
		update: function( event, ui) {
			sortItemesInit();
		}
	});
	
	/* sort init */
	function sortItemesInit() {
		var sort_string = $('#team-items-sorting').sortable('toArray').toString();
		$('#team_member').val(sort_string);
	}

	/* delete value item */
	function deleteValue(id) {

		var str_val = $('#team-string').val(),
			arr_str = str_val.split('|x;|'),
			result_str = '',
			index;
		
		for ( index = 0; index < arr_str.length; index++ ) {
			if ( JSON.parse(arr_str[index]).hasOwnProperty(id) ) {
				arr_str.splice(index,1);
				break;
			}
		}
		result_str = arr_str.join('|x;|');
		$('#team-string').val(result_str);
	}

	/* remove item */
	function removeItem(){
		$('.remove-team-item').on('click', function(){
			var item_id = $(this).data('id');
			deleteValue(item_id);
			$('#'+item_id).remove();
			sortItemesInit();
		});
	}
	
});
