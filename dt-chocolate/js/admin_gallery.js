jQuery(function() {

	var dt_boxes = new Object();
	function dt_find_boxes() {
		jQuery('.postbox').each(function(){
			var this_id = jQuery(this).attr('id');
			if(this_id.match(/dt_page_box-/i)){
				dt_boxes[this_id] = '#'+this_id;
			}
		});
	}

	function dt_toggle_box_options() {
		if( active_box.length ) {
			jQuery(".showhide", jQuery(active_box)).each(function () {
				var ee = this;
				jQuery("input[type=radio]", ee).change(function () {
					jQuery(".list", jQuery(active_box)).hide();
					if ( jQuery(this).attr("checked") ) {
						jQuery(".list", ee).show();
					}else {
						jQuery(".list", ee).hide();
					}
				});
				jQuery("input[type=radio]:checked", ee).change();
			});
		}
	}

	var active_box = '';
	function dt_toggle_boxes() {
		for(var key in dt_boxes) {
			jQuery(dt_boxes[key]).hide();
		}
		active_box = '';
		for(var i=0;i<arguments.length;i++) {
			jQuery(arguments[i]).show();
			active_box = arguments[i];
			dt_toggle_box_options();
		}
	}

	jQuery("#page_template").change(function() {
		dt_find_boxes();
		switch( jQuery(this).val() ) {

			case 'gallery-plus.php':
			case 'gallery-plus-one-level.php':
				dt_toggle_boxes('#dt_page_box-gallery');
			break;

			case 'home-video.php':
				dt_toggle_boxes('#dt_page_box-homevideo');
			break;

			case 'gallery-plus-home.php':
				dt_toggle_boxes('#dt_page_box-homeslider');
			break;
			
			case 'home-static.php':
				dt_toggle_boxes('#dt_page_box-homestatic');
			break;
			
			case 'home-slider.php':
				dt_toggle_boxes('#dt_page_box-homeslider_new');
			break;

			case 'portfolio.php':
				dt_toggle_boxes('#dt_page_box-portfolio');
			break;
			
			case 'home-3d.php':
				dt_toggle_boxes('#dt_page_box-homeslider_3d');
			break;

			default:
				dt_toggle_boxes();
			break;

		}
	});
	jQuery("#page_template").trigger('change');

});