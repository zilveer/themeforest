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
					code_start='[full_width_content title="'+desc+'"]'+content+'[/full_width_content]';
				} else if (align == 'left') {
					code_start='[content_left title="'+desc+'"]'+content+'[/content_left]';
				} else if (align == 'center') {
					code_start='[content_center title="'+desc+'"]'+content+'[/content_center]';
				} else if (align == 'right') {
					code_start='[content_right title="'+desc+'"]'+content+'[/content_right]';
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
			
				var color=$('#om_biginfopane_color').val();
				var customcolor=$('#om_biginfopane_customcolor').val();
				var textcolor=$('#om_biginfopane_textcolor').val();
				var content=$('#om_biginfopane_text').val();
				var full_width=$('#om_biginfopane_fullwidth').attr('checked');
				var title=$('#om_biginfopane_title').val();
				var button_title=$('#om_biginfopane_button_title').val();
				var href=$('#om_biginfopane_button_href').val();
				var target=$('#om_biginfopane_button_target').val();

				code_start='[biginfopane '+(color=='custom'?'color="'+customcolor+'"':'')+(textcolor!=''?' textcolor="'+textcolor+'"':'')+(title!=''?' title="'+title+'"':'')+(href!=''?' href="'+href+'"':'')+(button_title!=''?' button_title="'+button_title+'"':'')+(target!=''?' target="'+target+'"':'')+(full_width?' full_width="true"':'')+']'+content+'[/biginfopane]';
				
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
			
			
			case 'gallery':

				var id=$('#om_gallery_id').val();
				var layout=$('#om_gallery_layout').val();
				
				code_start='';
				if(id > 0) {
					code_start='[custom_gallery id="'+id+'"'+(layout!=''?' layout="'+layout+'"':'')+']';
				}
				code_end='';
				
			break
			
			case 'table':
			
				var cols=parseInt($('#om_table_columns').val());
				var rows=parseInt($('#om_table_rows').val());
				var first_th=$('#om_table_first_heading').attr('checked');
				var style=$('#om_table_style').val();
								
				
				if(isNaN(cols))
					cols=0;
				if(isNaN(rows))
					rows=0;
					
				code_start='';
				
				if(cols && rows) {
					code_start+='[table'+(style!=''?' style="'+style+'"':'')+']';
					for(i=0;i<rows;i++) {
						code_start+='<p>[tr]';
						for(j=0;j<cols;j++) {
							if(i == 0 && first_th)
								code_start+=(j>0?' ':'')+'[th]CellHEADING[/th]';
							else
								code_start+=(j>0?' ':'')+'[td]CellCONTENT[/td]';
						}
						code_start+='[/tr]</p>';
					}
					code_start+='[/table]';
				}

				code_end='';
			
			break	
			
			case 'video':
			
				var code=$('#om_video_code').val();
				var maxwidth=parseInt($('#om_video_max_width').val());
				
				if(isNaN(maxwidth))
					maxwidth=0;
					
				code_start='[video_embed'+(maxwidth>0?' maxwidth="'+maxwidth+'"':'')+']'+code+'[/video_embed]';
				
				code_end='';
			
			break	
			
			case 'pullquote':
			
				var text=$('#om_pullquote_text').val();
				var style=$('#om_pullquote_style').val();
				
				code_start='[pullquote'+(style!=''?' style="'+style+'"':'')+']'+text+'[/pullquote]';
				
				code_end='';
			
			break	
			
			case 'contactform':

				code_start='[contact_form]';
				
				code_end='';
			
			break
			
			case 'testimonials':

				var lmode=$('#om_testimonials_mode').val();
				var timeout=$('#om_testimonials_timeout').val();
				var pause=$('#om_testimonials_pause').attr('checked');
				var category=$('#om_testimonials_category').val();
				
				code_start='[testimonials'+(lmode == 'list'?' mode="list"':'')+(timeout != 0?' timeout="'+timeout+'"':'')+(pause?' pause="true"':'')+(category!=0?' category="'+category+'"':'')+']';
				
				code_end='';
			
			break
			
			case 'pricing':
			
				var cols=parseInt($('#om_pricing_columns').val());
				var rows=parseInt($('#om_pricing_rows').val());
				
				if(isNaN(cols))
					cols=0;
				if(isNaN(rows))
					rows=0;
					
				code_start='';
				
				if(cols && rows) {
					code_start+='[pricing]';
					for(i=0;i<cols;i++) {
						code_start+='<p>[pricing_column]<br />[pricing_column_name]Column'+(i+1)+'Name[/pricing_column_name]<br />[price comment="per month"]$100[/price]';
						for(j=0;j<rows;j++) {
							code_start+='<br />[line]Parameter'+(j+1)+'[/line]';
						}
						code_start+='<br />[button href="#"]SignUp[/button]<br />[/pricing_column]</p>';
					}
					code_start+='[/pricing]';
				}

				code_end='';
			
			break	
			
			case 'recent_posts':
			
				var count=$('#om_recent_posts_count').val();
				var offset=$('#om_recent_posts_offset').val();
				var category=$('#om_recent_posts_category').val();
				var category_title=$('#om_recent_posts_category_title').attr('checked');
				var thumbnails=$('#om_recent_posts_thumbnails').attr('checked');
				var thumbnails_align=$('#om_recent_posts_thumbnails_align').val();
				var thumbnails_first_big=$('#om_recent_posts_thumbnails_first_big').attr('checked');
				code_start='[recent_posts count="'+count+'"'+(offset!=0?' offset="'+offset+'"':'')+(thumbnails?' thumbnails="true"':'')+(thumbnails_align?' thumbnails_align="'+thumbnails_align+'"':'')+(thumbnails_first_big?' thumbnails_first_big="true"':'')+(category!=0?' category="'+category+'"':'')+(category_title?' category_title="true"':'')+']';
				code_end='';
			
			break
			
			case 'portfolio':
			
				var count=$('#om_portfolio_count').val();
				var category=$('#om_portfolio_category').val();
				var randomize=$('#om_portfolio_randomize').attr('checked');
				
				code_start='[recent_portfolios count="'+count+'"'+(category!=0?' category="'+category+'"':'')+(randomize?' randomize="true"':'')+']';
				code_end='';
			
			break
		}

		if(window.tinyMCE) {
			window.tinyMCE.activeEditor.selection.setContent(code_start + window.tinyMCE.activeEditor.selection.getContent() + code_end);
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