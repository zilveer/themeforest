jQuery(function($){
	var $imageFieldTbl = $('#image_field_tbl');
	var the_id = $('#id_field').val();
	if ( galleryFrame === undefined ) {
		var galleryFrame;
	}

	function reorder_icon_fields() {
		var $trs = $imageFieldTbl.find('tr');
		var count = 0;
		$trs.each(function(e){
			$(this).find('input[type=hidden]').prop('name', the_id + '['+count+'][id]');
			$(this).find('input[type=text]').prop('name', the_id + '['+count+'][label]');
			count++;
		});
	}

	$('#add_image_field').on('click', function(e){
		e.preventDefault();

		galleryFrame = wp.media.frames.downloadable_file = wp.media({
			title   : 'Add Images',
			button  : {
				text: 'Add image'
			},
			multiple: true
		});

		galleryFrame.on('select', function(){
			var selection = galleryFrame.state().get('selection');
			selection.map(function(attachment){
				attachment = attachment.toJSON();
				if ( attachment.id ) {
					var current_num = $imageFieldTbl.find('tr').length;
					var row = $('<tr></tr>');
					var image = $('<td><img src="'+ attachment.url +'" /></td>');
					var label =$('<td><input type="hidden" value="'+attachment.id+'" /><input type="text"  placeholder="Add label"/></td>');
					var removeBtn = $('<td><input type="button" class="removeRowBtn" value="remove" /></td>');
					row.append(image).append(label).append(removeBtn);
					$imageFieldTbl.append(row);
					reorder_icon_fields();
				}
			});
		});
		galleryFrame.open();
	});

	$(document).on('click', '.removeRowBtn', function(e){
		$(this).closest('tr').fadeOut('slow').delay('2000').remove();
		reorder_icon_fields();
	});
});