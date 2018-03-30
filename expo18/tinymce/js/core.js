function om_sc_plugin_popup(id, title) {
	var $modal=jQuery('<div class="media-modal om-sc-shortcodes-modal" id="om-sc-shortcodes-modal" />');
	var $close=jQuery('<a class="media-modal-close" href="#" title="" />')
		.attr('title','Close')
		.html('<span class="media-modal-icon"></span></a>')
		.appendTo($modal);
		
	var $content=jQuery('<div class="media-modal-content" />').appendTo($modal);
	var $backdrop=jQuery('<div class="media-modal-backdrop" />');
	
	var $spinner=jQuery('<div class="spinner om-sc-spinner" />').appendTo($content).show();
	
	$modal.appendTo('body');
	$backdrop.appendTo('body');
	
	function om_sc_plugin_popup_close() {
		$modal.remove();
		$backdrop.remove();
	}
	
	$close.click(function(){
		om_sc_plugin_popup_close();
		return false;
	});

	$modal.data('close-function',om_sc_plugin_popup_close);
	
	jQuery.post(
		ajaxurl,
		{
			action: 'om_sc_popup',
			id: id,
			title: title
		},
		function(data){
			$content.html(data);
			om_sc_init_popup($content);
		},
		'html'
	);
}

function om_sc_plugin_insert(title, code_start, code_end) {
	tinyMCE.activeEditor.selection.setContent(code_start + tinyMCE.activeEditor.selection.getContent() + code_end);
}

function om_sc_init_popup($container) {

	var $=jQuery;

	$('.om-sc-popup-submit-button', $container).click(function(){

		var code_start='';
		var code_end='';
		
		var type=$(this).data('shortcode-id');

		switch (type) {
			
			case 'columns':
			
				var size=$('#om_column_size').val();
				var last=$('#om_column_last').attr('checked');
				if(last) {
					code_start='['+size+'_last]';
					code_end='[/'+size+'_last]';
				} else {
					code_start='['+size+']';
					code_end='[/'+size+']';
				}
			
			break
			
			case 'buttons':
			
				var href=$('#om_button_href').val();
				var title=$('#om_button_title').val();
				var color=$('#om_button_color').val();
				var customcolor=$('#om_button_customcolor').val();
				var hovercolor=$('#om_button_hovercolor').val();
				var textcolor=$('#om_button_textcolor').val();
				var target=$('#om_button_target').val();
				var size=$('#om_button_size').val();
				var text=$('#om_button_text').val();
				var tooltip=$('#om_button_tooltip').val();
				
				tooltip=tooltip.replace(/"/g,'\\"');

				if(size == 'xlarge')
					code_start='[button href="'+href+'" size="'+size+'" title="'+title+'"'+(color=='custom'?' color="'+customcolor+'"':'')+(hovercolor!=''?' hovercolor="'+hovercolor+'"':'')+(textcolor!=''?' textcolor="'+textcolor+'"':'')+(target!=''?' target="'+target+'"':'')+(tooltip!=''?' tooltip="'+tooltip+'"':'')+']'+text+'[/button]';
				else
					code_start='[button href="'+href+'" size="'+size+'"'+(color=='custom'?' color="'+customcolor+'"':'')+(hovercolor!=''?' hovercolor="'+hovercolor+'"':'')+(textcolor!=''?' textcolor="'+textcolor+'"':'')+(target!=''?' target="'+target+'"':'')+(tooltip!=''?' tooltip="'+tooltip+'"':'')+']'+title+'[/button]';
				code_end='';
			
			break
			
			case 'toggle':
			
				var title=$('#om_toggle_title').val();
				var content=$('#om_toggle_content').val();
				var state=$('#om_toggle_state').val();

				code_start='[toggle title="'+title+'"'+(state!=''?' state="'+state+'"':'')+']'+content+'[/toggle]';
				code_end='';
			
			break

			case 'accordion':
			
				var count=parseInt($('#om_accordion_count').val());
				if(isNaN(count))
					count=1;
				if(count < 1)
					count = 1;

				code_start='[accordion]'+"<br/>";
				for(i=1;i<=count;i++)
					code_start+='[toggle title="Item '+i+' Title"'+((i==1)?' state="opened"':'')+']<p>Content for item '+i+'</p>[/toggle]'+"<br/>";
				code_start+='[/accordion]';
				code_end='';
			
			break			
			
			case 'tabs':
			
				var count=parseInt($('#om_tabs_count').val());
				if(isNaN(count))
					count=1;
				if(count < 1)
					count = 1;

				code_start='[tabs]'+"<br/>";
				for(i=1;i<=count;i++)
					code_start+='[tab title="Tab '+i+' Title"]<p>Content for tab'+i+'</p>[/tab]'+"<br/>";
				code_start+='[/tabs]';
				code_end='';
			
			break
			
			case 'aligned':
			
				var desc=$('#om_aligned_desc').val();
				var content=$('#om_aligned_content').val();
				var align=$('#om_aligned_align').val();

				if(align == 'full-width') {
					code_start='[full_width_image title="'+desc+'"]'+content+'[/full_width_image]';
				} else if (align == 'left') {
					code_start='[image_left title="'+desc+'"]'+content+'[/image_left]';
				} else if (align == 'center') {
					code_start='[image_center title="'+desc+'"]'+content+'[/image_center]';
				} else if (align == 'right') {
					code_start='[image_right title="'+desc+'"]'+content+'[/image_right]';
				} else {
					code_start='';
				}

				code_end='';
			
			break
			
			case 'infopane':
			
				var style=$('#om_infopane_style').val();
				var content=$('#om_infopane_text').val();

				if(style == 1) {
					code_start='[infopane color="'+style+'" icon="0101.png"]'+content+'[/infopane]';
				} else if(style == 2) {
					code_start='[infopane color="'+style+'" icon="0018.png"]'+content+'[/infopane]';
				} else if(style == 3) {
					code_start='[infopane color="'+style+'" icon="0032.png"]'+content+'[/infopane]';
				} else if(style == 4) {
					code_start='[infopane color="'+style+'" icon="0049.png"]'+content+'[/infopane]';
				} else if(style == 5) {
					code_start='[infopane color="'+style+'" icon="0100.png"]'+content+'[/infopane]';
				} else if(style == 6) {
					code_start='[infopane color="'+style+'" icon="0182.png"]'+content+'[/infopane]';
				} else if(style == 7) {
					code_start='[infopane color="'+style+'" icon="0072.png"]'+content+'[/infopane]';
				} else if(style == 8) {
					code_start='[infopane color="'+style+'" icon="0001.png"]'+content+'[/infopane]';
				} else if(style == 9) {
					code_start='[infopane color="'+style+'" icon="0086.png"]'+content+'[/infopane]';
				} else {
					code_start='[infopane color="'+style+'" icon="0101.png"]'+content+'[/infopane]';
				}
				
				code_end='';
			
			break
			
			case 'biginfopane':

				var ttitle=$('#om_biginfopane_title').val();			
				var content=$('#om_biginfopane_text').val();
				var title=$('#om_biginfopane_button_title').val();
				var href=$('#om_biginfopane_button_href').val();
				var target=$('#om_biginfopane_button_target').val();

				code_start='[biginfopane '+(ttitle!=''?' title="'+ttitle+'"':'')+(href!=''?' href="'+href+'"':'')+(title!=''?' buttontitle="'+title+'"':'')+(target!=''?' target="'+target+'"':'')+']'+content+'[/biginfopane]';
				
				code_end='';
			
			break
			
			case 'dropcaps':
			
				var title=$('#om_dropcap_title').val();
				var size=$('#om_dropcap_size').val();
				var bgcolor=$('#om_dropcap_bgcolor').val();
				var custombgcolor=$('#om_dropcap_custombgcolor').val();
				var textcolor=$('#om_dropcap_textcolor').val();
				
				if(bgcolor == 'custom')
					bgcolor=custombgcolor;

				code_start='[dropcap '+(size!=''?'size="'+size+'"':'')+(bgcolor!=''?' bgcolor="'+bgcolor+'"':'')+(textcolor!=''?' textcolor="'+textcolor+'"':'')+']'+title+'[/dropcap]';
				
				code_end='';
			
			break
			
			case 'marker':
			
				var title=$('#om_marker_title').val();
				var custombgcolor=$('#om_marker_custombgcolor').val();
				var textcolor=$('#om_marker_textcolor').val();
				var tooltip=$('#om_marker_tooltip').val();
				
				tooltip=tooltip.replace(/"/g,'\\"');
				
				code_start='[marker '+(custombgcolor!=''?' bgcolor="'+custombgcolor+'"':'')+(textcolor!=''?' textcolor="'+textcolor+'"':'')+(tooltip!=''?' tooltip="'+tooltip+'"':'')+']'+title+'[/marker]';
				
				code_end='';
			
			break
			
			case 'icons':
			
				var title=$('#om_icon_title').val();
				var url=$('#om_icon_url').val();
				var target=$('#om_icon_target').val();
				var icon=$('input[name=om_icon_icon]:checked').val();
				var tooltip=$('#om_icon_tooltip').val();
				
				tooltip=tooltip.replace(/"/g,'\\"');
				
				code_start='[icon '+(url!=''?' url="'+url+'"':'')+(target!=''?' target="'+target+'"':'')+(icon!=''?' icon="'+icon+'"':'')+(tooltip!=''?' tooltip="'+tooltip+'"':'')+']'+title+'[/icon]';
				
				code_end='';
			
			break
			
			case 'bullets':
			
				var count=parseInt($('#om_bullets_count').val());
				var icon=$('input[name=om_bullets_icon]:checked').val();
				
				if(isNaN(count))
					count=1;
				if(count < 1)
					count = 1;

				code_start='[bullets'+(icon!=''?' icon="'+icon+'"':'')+']'+"<ul>";
				for(i=1;i<=count;i++)
					code_start+='<li>Item '+i+'</li>';
				code_start+='</ul>[/bullets]';
				code_end='';
			
			break	
			
			case 'bullets_individual':
			
				var count=parseInt($('#om_bullets_individual_count').val());
				var icon=$('input[name=om_bullets_individual_icon]:checked').val();
				
				if(isNaN(count))
					count=1;
				if(count < 1)
					count = 1;

				code_start='[ul]<br />';
				for(i=1;i<=count;i++)
					code_start+='[li'+(icon!=''?' icon="'+icon+'"':'')+']Item '+i+'[/li]<br />';
				code_start+='[/ul]';
				code_end='';
			
			break	
			
			case 'space':
			
				var size=parseInt($('#om_space_size').val());
				
				if(isNaN(size))
					size=0;

				if(size > 0)
					code_start='[space size="'+size+'"]';
				else
					code_start='[space]';
				code_end='';
			
			break	
			
			case 'testimonial':

				var text=$('#om_testimonial_text').val();			
				var author=$('#om_testimonial_author').val();
				var author_comment=$('#om_testimonial_author_comment').val();
				var photo=$('#om_testimonial_photo_upload').val();

				code_start='[testimonial '+(author!=''?' author="'+author+'"':'')+(author_comment!=''?' author_comment="'+author_comment+'"':'')+(photo!=''?' photo="'+photo+'"':'')+']'+text+'[/testimonial]';
				
				code_end='';
			
			break
			
			case 'agenda':

				code_start=
					'[agenda]<br />'+
					'[day date="15 December 2018"]Day 1[/day]<br />'+
					'[event time="12:30 &mdash; 14:55" room="Room A-18"]Event Description[/event]<br />'+
					'[event time="15:00 &mdash; 16:25" room="Room A-18"]Event Description[/event]<br />'+
					'[lunch time="16:30 &mdash; 16:55"]<b>It\'s a lunch or dinner time. Get some rest!</b>[/lunch]<br />'+
					'[event time="17:00 &mdash; 18:25" room="Room A-18"]Event Description[/event]<br />'+
					'[day date="16 December 2018"]Day 2[/day]<br />'+
					'[event time="12:30 &mdash; 14:55" room="Room A-18"]Event Description[/event]<br />'+
					'[event time="15:00 &mdash; 16:25" room="Room A-18"]Event Description[/event]<br />'+
					'[/agenda]'
				;
				
				code_end='';
			
			break
			
			case 'speaker':

				var photo=$('#om_speaker_photo_upload').val();
				var name=$('#om_speaker_name').val();			
				var post=$('#om_speaker_post').val();			
				var company=$('#om_speaker_company').val();			
				var about=$('#om_speaker_about').val();			
				var link=$('#om_speaker_link').val();			
				var target=$('#om_speaker_target').val();			

				code_start='[speaker '+(photo!=''?' photo="'+photo+'"':'')+(name!=''?' name="'+name+'"':'')+(post!=''?' post="'+post+'"':'')+(company!=''?' company="'+company+'"':'')+(link!=''?' link="'+link+'"':'')+(target!=''?' target="'+target+'"':'')+']'+about+'[/speaker]';
				
				code_end='';
			
			break
			
			case 'registration':

				code_start='[registration_form]';
				
				code_end='';
			
			break
			
			case 'video':
			
				var video=$('#om_video_link').val();

				code_start=video;
				
				code_end='';
			
			break
			
			case 'map':
			
				var code=$('#om_map_code').val();
				var height=$('#om_map_height').val();

				code_start='[map'+(height!=''?' height="'+height+'"':'')+']'+code+'[/map]';
				
				code_end='';
			
			break
		}

		if(window.tinyMCE) {
			window.tinyMCE.activeEditor.selection.setContent(code_start + window.tinyMCE.activeEditor.selection.getContent() + code_end);
			tb_remove();
		}
		
		jQuery('#om-sc-shortcodes-modal').data('close-function')();
		
		return false;
	});
	
	
	// color pickers
	
	jQuery('.wp-color-picker-field', $container).wpColorPicker({
		clear: function(){
			jQuery(this).parents('.wp-picker-container').find('.wp-color-result').addClass('wp-picked-cleared');
		},
		change: function(){
			jQuery(this).parents('.wp-picker-container').find('.wp-color-result').removeClass('wp-picked-cleared');
		}
	}).each(function(){
		if(jQuery(this).wpColorPicker('color') == '')
			jQuery(this).parents('.wp-picker-container').find('.wp-color-result').addClass('wp-picked-cleared');
	});
}