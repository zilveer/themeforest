function init() {	
	tinyMCEPopup.resizeToInnerSize();
}

// Init functions
tinyMCEPopup.onInit.add(function(ed) {
 	
 	// Form
	$sc_panel = jQuery('form[name=shortcodes]');

	// Groups
	jQuery('.r-meta-group', $sc_panel).each(function(){
		var group = jQuery(this).val(),
			group = 'r-group-'+group;
		jQuery('.' + group, $sc_panel).show();
    });
										 
    jQuery('.r-meta-group', $sc_panel).change(function(){						 
		var group = jQuery(this).val(),
			main_group = jQuery(this).data('main-group'),
		group = 'r-group-'+group;
		jQuery('.' + main_group, $sc_panel).hide();
		jQuery('.' + group, $sc_panel).fadeIn(600);
	
	});

	jQuery('.sc-upload', $sc_panel).bind('click', window.parent.sm_upload_item);

});

// Insert shortcode
function insert_shortcode() {
	
	/* Variables */
	var output;
	var shortcode_panel = document.getElementById('shortcodes_panel');
	var audio_panel = document.getElementById('audio_panel');
	var image_panel = document.getElementById('image_panel');
	var slider_panel = document.getElementById('slider_panel');
	var heading_panel = document.getElementById('heading_panel');
	var masonry_panel = document.getElementById('masonry_panel');
	
	/* Masonry Box */
	if (masonry_panel.className.indexOf('current') != -1) {
		var 
			box_type = document.getElementById('box_type').value,
			box_width = document.getElementById('box_width').value,
			box_height = document.getElementById('box_height').value;

		if (box_type == 'default') {
			output = '[masonry_box width="' + box_width + '" height="' + box_height + '"]<br><br>...CONTENT HERE...<br><br>[/masonry_box]';
      } 
      else if (box_type == 'slider') {
			output = '[masonry_box width="' + box_width + '" height="' + box_height + '" slider="true"]<br><br>...SLIDER HERE...<br><br>[/masonry_box]';
      }
      else if (box_type == 'text') {
			output = '[masonry_box text="true"]<br><br>...TEXT HERE...<br><br>[/masonry_box]';
      }
      else if (box_type == 'video') {
			output = '[masonry_box video="true"]<br><br>...VIDEO HERE...<br><br>[/masonry_box]';
      }
      else if (box_type == 'event') {
			output = '[masonry_box width="' + box_width + '" height="' + box_height + '" event="true"]<br><br>...EVENT HERE...<br><br>[/masonry_box]';
      }
		
	}

	/* Heading */
	if (heading_panel.className.indexOf('current') != -1) {
		var 
			heading_icon = document.getElementById('heading_icon').value,
			custom_icon = '';

		if (heading_icon == 'custom') {
      	custom_icon = document.getElementById('custom_icon').value;
      	custom_icon = ' icon_url="'+custom_icon+'"';
      } 
		output = '[icon_heading icon="'+heading_icon+'"'+custom_icon+' classes=""]...TITLE HERE...[/icon_heading]';
	}
	
	/* Audio player */
	if (audio_panel.className.indexOf('current') != -1) {

		var 
			tracks_id = document.getElementById('tracks_id').value,
			player_type = document.getElementById('player_type').value,
		   player_autostart = document.getElementById('autostart').value,
		   player_autostart = 'off';

		   if (document.shortcodes.autostart.checked == true) player_autostart = 'on';

		output = '[player id="'+tracks_id+'" type="'+player_type+'" autostart="'+player_autostart+'"]';
	}

	/* Custom Image */
	if (image_panel.className.indexOf('current') != -1) {

		var 
			image_effect = document.getElementById('image_effect').value,
			image_type = document.getElementById('image_type').value,
		   image_url = document.getElementById('image_url').value,
		   image_url_back = document.getElementById('image_url_back').value,
      	image_title = document.getElementById('image_title').value,
		   image_width = document.getElementById('image_width').value,
		   image_height = document.getElementById('image_height').value,
			image_link = document.getElementById('image_link').value,
			image_crop = document.getElementById('image_crop').value,
			image_iframe = document.getElementById('image_iframe').value,
			lightbox_group = document.getElementById('lightbox_group').value,
			image_badge = document.getElementById('image_badge').value,
			image_tooltip = document.getElementById('image_tooltip').value,
			adv_options = '';
		
		if (image_type == 'lightbox_image') {
			adv_options = 'effect="'+image_effect+'" link="'+image_link+'" group="'+lightbox_group+'"';
		}
		else if (image_type == 'lightbox_video' || image_type == 'lightbox_soundcloud') {
			// Get iframe attributes
			var 
				iframe_content = jQuery(image_iframe),
				iframe = jQuery(iframe_content).filter('iframe'),
				src = iframe.attr('src'),
				width = iframe.attr('width'),
				height = iframe.attr('height');
				iframe_code = src + '|' + width + "|" + height;
			adv_options = 'effect="'+image_effect+'" group="'+lightbox_group+'" iframe_code="'+iframe_code+'"';
		}
		else if (image_type == 'custom_link' || image_type == 'custom_link_blank') {
			adv_options = 'effect="'+image_effect+'" link="'+image_link+'"';
		}

		if (image_effect == 'thumb_slide') adv_options += ' src_back="'+image_url_back+'"';

		if (image_badge != '') adv_options += ' badge="'+image_badge+'"';

		if (image_tooltip != '') adv_options += ' tooltip="'+image_tooltip+'"';

		output = '[custom_image type="'+image_type+'" src="'+image_url+'" width="'+image_width+'" height="'+image_height+'" crop="'+image_crop+'" title="'+image_title+'" '+adv_options+']';
	}

	
	/* Slider */
	if (slider_panel.className.indexOf('current') != -1) {
		var 
			slider_id = document.getElementById('slider_id').value,
			slider_width = document.getElementById('slider_width').value,
			slider_height = document.getElementById('slider_height').value

		if (slider_id == null) {
			output = ''
		} else {
		    output = '[nivo_slider id="'+slider_id+'" image_width="'+slider_width+'" image_height="'+slider_height+'"]';
		} 
	}
	
	/* Shortcodes */
 	if (shortcode_panel.className.indexOf('current') != -1) {
		var shortcode = document.getElementById('shortcode').value;
		if (shortcode == 0 ){
			tinyMCEPopup.close();
		}
		/* Columns */
		/* Two columns */
		else if (shortcode == '2_columns'){
			output = '[1_2]<br><br>Insert your text here<br><br>[/1_2]<br><br>[1_2_last]<br><br>Insert your text here<br><br>[/1_2_last]';
		}
		/* Three columns */
		else if (shortcode == '3_columns'){
			output = '[1_3]<br><br>Insert your text here<br><br>[/1_3]<br><br>[1_3]<br><br>Insert your text here<br><br>[/1_3]<br><br>[1_3_last]<br><br>Insert your text here<br><br>[/1_3_last]';
		}
		/* Four columns */
		else if (shortcode == '4_columns'){
			output = '[1_4]<br><br>Insert your text here<br><br>[/1_4]<br><br>[1_4]<br><br>Insert your text here<br><br>[/1_4]<br><br>[1_4]<br><br>Insert your text here<br><br>[/1_4]<br><br>[1_4_last]<br><br>Insert your text here<br><br>[/1_4_last]';
		}
		/* 2/3 Column + 1/3 Column */
		else if (shortcode == '2_3_1_3_columns'){
			output = '[2_3]<br><br>Insert your text here<br><br>[/2_3]<br><br>[1_3_last]<br><br>Insert your text here<br><br>[/1_3_last]';
		}
		/* 1/3 Column + 2/3 Column */
		else if (shortcode == '1_3_2_3_columns'){
			output = '[1_3]<br><br>Insert your text here<br><br>[/1_3]<br><br>[2_3_last]<br><br>Insert your text here<br><br>[/2_3_last]';
		}
		/* 3/4 Column + 1/4 Column */
		else if (shortcode == '3_4_1_4_columns'){
			output = '[3_4]<br><br>Insert your text here<br><br>[/3_4]<br><br>[1_4_last]<br><br>Insert your text here<br><br>[/1_4_last]';
		}
		/* 1/4 Column + 3/4 Column */
		else if (shortcode == '1_4_3_4_columns'){
			output = '[1_4]<br><br>Insert your text here<br><br>[/1_4]<br><br>[3_4_last]<br><br>Insert your text here<br><br>[/3_4_last]';
		}

		/* Boxes */
		/* Two boxes */
		else if (shortcode == '2_boxes'){
			output = '[boxes]<br>[box_1_2]<br><br>Insert your text here<br><br>[/box_1_2]<br><br>[box_1_2_last]<br><br>Insert your text here<br><br>[/box_1_2_last]<br>[/boxes]';
		}
		/* Three boxes */
		else if (shortcode == '3_boxes'){
			output = '[boxes]<br>[box_1_3]<br><br>Insert your text here<br><br>[/box_1_3]<br><br>[box_1_3]<br><br>Insert your text here<br><br>[/box_1_3]<br><br>[box_1_3_last]<br><br>Insert your text here<br><br>[/box_1_3_last]<br>[/boxes]';
		}
		/* Four boxes */
		else if (shortcode == '4_boxes'){
			output = '[boxes]<br>[box_1_4]<br><br>Insert your text here<br><br>[/box_1_4]<br><br>[box_1_4]<br><br>Insert your text here<br><br>[/box_1_4]<br><br>[box_1_4]<br><br>Insert your text here<br><br>[/box_1_4]<br><br>[box_1_4_last]<br><br>Insert your text here<br><br>[/box_1_4_last]<br>[/boxes]';
		}
		/* 2/3 Column + 1/3 Column */
		else if (shortcode == '2_3_1_3_boxes'){
			output = '[boxes]<br>[box_2_3]<br><br>Insert your text here<br><br>[/box_2_3]<br><br>[box_1_3_last]<br><br>Insert your text here<br><br>[/box_1_3_last]<br>[/boxes]';
		}
		/* 1/3 Column + 2/3 Column */
		else if (shortcode == '1_3_2_3_boxes'){
			output = '[boxes]<br>[box_1_3]<br><br>Insert your text here<br><br>[/box_1_3]<br><br>[box_2_3_last]<br><br>Insert your text here<br><br>[/box_2_3_last]<br>[/boxes]';
		}
		/* 3/4 Column + 1/4 Column */
		else if (shortcode == '3_4_1_4_boxes'){
			output = '[boxes]<br>[box_3_4]<br><br>Insert your text here<br><br>[/box_3_4]<br><br>[box_1_4_last]<br><br>Insert your text here<br><br>[/box_1_4_last]<br>[/boxes]';
		}
		/* 1/4 Column + 3/4 Column */
		else if (shortcode == '1_4_3_4_boxes'){
			output = '[boxes]<br>[box_1_4]<br><br>Insert your text here<br><br>[/box_1_4]<br><br>[box_3_4_last]<br><br>Insert your text here<br><br>[/box_3_4_last]<br>[/boxes]';
		}
				
		/* Videos */
		/* YouTube */
		else if (shortcode == 'youtube'){
			output = '[iframe_video type="youtube" id="" width="auto" height="auto" autoplay="0"]';
		}
		/* Vimeo */
		else if (shortcode == 'vimeo'){
			output = '[iframe_video type="vimeo" id="" width="auto" height="auto" ui_color="fa4c29" autoplay="0" title="0" portrait="0" byline="0"]';
		}

		/* Masonry Boxes */
		/* Boxes */
		else if (shortcode == 'masonry_boxes'){
			output = '[masonry_boxes]<br><br>...BOXES HERE...<br><br>[/masonry_boxes]';
		}
		/* Recent Release */
		else if (shortcode == 'recent_release'){
			output = '[recent_releases masonry="true" offset="0" by_author=""]';
		}
		/* Recent Event */
		else if (shortcode == 'recent_event'){
			output = '[recent_event offset="0" width="468" height="468"]';
		}
		/* Recent Album */
		else if (shortcode == 'recent_album'){
			output = '[recent_albums masonry="true" offset="0"]';
		}

		/* Buttons */
		/* L */
		else if (shortcode == 'btn_large'){
			output = '[button size="large" link="http://" title="Button title" target="self" css_style=""]';
		}
		/* M */
		else if (shortcode == 'btn_medium'){
			output = '[button size="medium" link="http://" title="Button title" target="self" css_style=""]';
		}
		/* L */
		else if (shortcode == 'btn_small'){
			output = '[button size="small" link="http://" title="Button title" target="self" css_style=""]';
		}
		/* L */
		else if (shortcode == 'text_button'){
			output = '[text_button link="http://" title="Button title" target="self" css_style=""]';
		}
		
		/* Alert boxes */
		/* Error */
		else if (shortcode == 'error_box'){
			output = '[alert_box type="error"]...TEXT HERE...[/alert_box]';
		}
		/* Success */
		else if (shortcode == 'success_box'){
			output = '[alert_box type="success"]...TEXT HERE...[/alert_box]';
		}
		/* Warning */
		else if (shortcode == 'warning_box'){
			output = '[alert_box type="warning"]...TEXT HERE...[/alert_box]';
		}
		/* Info */
		else if (shortcode == 'info_box'){
			output = '[alert_box type="info"]...TEXT HERE...[/alert_box]';
		}

		/* Releases */
		/* Recent releases */
		else if (shortcode == 'recent_releases'){
			output = '[recent_releases limit="3" columns="4" by_author=""]<br><br>[icon_heading icon="deck" classes=""]Recent [color]releases.[/color][/icon_heading]<br>Mauris lorem metus, tincidunt quis commodo consectetur.<br>[text_button link="#" title="View All" target="self" css_style=""]<br><br>[/recent_releases]';
		}

		/* Events */
		/* Add to Google Calendar */
		else if (shortcode == 'add_to_calendar'){
			output = '[add_to_calendar size="small" title="Add to Google Calendar" timezone_offset="+02:00" css_style=""]';
		}

		/* Albums */
		/* Recent releases */
		else if (shortcode == 'recent_albums'){
			output = '[recent_albums limit="3" columns="4"]<br><br>[icon_heading icon="deck" classes=""]Recent [color]albums.[/color][/icon_heading]<br>Mauris lorem metus, tincidunt quis commodo consectetur.<br>[text_button link="#" title="View All" target="self" css_style=""]<br><br>[/recent_albums]';
		}

		/* Lists */
		/* Stats list */
		else if (shortcode == 'stats_list'){
			output = '[stats_list timer="10000"]<br>[stat name="Stat name 1" value="876"]<br>[stat name="Stat name 2" value="876"]<br>[stat name="Stat name 3" value="876"]<br>[stat name="Stat name 4" value="876"]<br>[stat name="Stat name 5" value="876"]<br>[stat name="Stat name 6" value="876"]<br>[/stats_list]';
		}
		/* Recent posts */
		else if (shortcode == 'recent_posts'){
			output = '[recent_posts cat="" limit="4" date_format="d/m/y"]';
		}
		/* Recent comments */
		else if (shortcode == 'recent_comments'){
			output = '[recent_comments limit="3" length="10"]';
		}
		/* Events */
		else if (shortcode == 'events'){
			output = '[events limit="-1" type="future" cat=""]Currently we have no events.[/events]';
		}
		/* Artists */
		else if (shortcode == 'artists'){
			output = '[artists limit="-1" columns="3" offset="0" by_cat=""]';
		}
		/* Tweets */
		else if (shortcode == 'tweets'){
			output = '[tweets username="twitter_username" limit="2" replies="false" api_key="" api_secret=""]';
		}
		/* Details list */
		else if (shortcode == 'details_list'){
			output = '[details_list]<br><br>[detail name="Detail"]Text or links here[/detail]<br>[detail name="Detail"]Text or links here[/detail]<br>[detail name="Detail"]Text or links here[/detail]<br>[detail name="Detail"]Text or links here[/detail]<br><br>[/details_list]';
		}


	   /* Misc Stuff */
		
		/* Line heading */
		else if (shortcode == 'line_heading'){
			output = '[line_heading]...Text here...[/line_heading] ';
		}

		/* Line heading 2 */
		else if (shortcode == 'line_heading_two'){
			output = '[line_heading_two]...Text here...[/line_heading_two] ';
		}

		/* Blockquote */
		else if (shortcode == 'blockquote'){
			output = '[blockquote author="" single="true"]...Text here...[/blockquote] ';
		}
		/* Contact form */
		else if (shortcode == 'contact_form'){
			output = '[contact_form]';
		}
		/* Dropcap */
		else if (shortcode == 'dropcap'){
			output = '[dropcap]...Text here...[/dropcap]';
		}
		else if (shortcode == 'inv_dropcap'){
			output = '[inv_dropcap]...Text here...[/inv_dropcap]';
		}
		/* Info box */
		else if (shortcode == 'info_box'){
			output = '[info_box]...TEXT_HERE...[/info_box]';
		}
		
		/* Helpers */
		
		/* Divider */
		else if (shortcode == 'divider'){
			output = '[divider]';
		}
		/* Spacer */
		else if (shortcode == 'spacer'){
			output = '[spacer]';
		}
		/* Clear */
		else if (shortcode == 'clear'){
			output = '[clear]';
		}
		/* Color */
		else if (shortcode == 'color'){
			output = '[color]...TEXT HERE...[/color]';
		}
		/* Hgroups */
		else if (shortcode == 'hgroup'){
			output = '[hgroup]...HEADINGS HERE...[/hgroup]';
		}
	
	}
  		
	if (window.tinyMCE) {
		var inst = tinyMCE.activeEditor.id;
		tinyMCE.execCommand( 'mceInsertContent', false, output );
		// window.tinyMCE.execInstanceCommand(inst, 'mceInsertContent', false, output);
	  	tinyMCEPopup.editor.execCommand('mceRepaint');
	  	tinyMCEPopup.close();
  	}
  	return;
}