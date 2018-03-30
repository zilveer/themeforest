<?php 

function teo_add_simple_buttons(){ 
    wp_print_scripts( 'quicktags' );
	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	
	$buttons = array();
	
	$buttons[] = array('name' => 'header',
					'options' => array(
						'display_name' => 'header',
						'open_tag' => '\n[header]',
						'close_tag' => '[/header]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'subheader',
					'options' => array(
						'display_name' => 'subheader',
						'open_tag' => '\n[subheader]',
						'close_tag' => '[/subheader]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'one_half',
					'options' => array(
						'display_name' => 'one half',
						'open_tag' => '\n[one_half]',
						'close_tag' => '[/one_half]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'one_third',
					'options' => array(
						'display_name' => 'one third',
						'open_tag' => '\n[one_third]',
						'close_tag' => '[/one_third]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'one_fourth',
					'options' => array(
						'display_name' => 'one fourth',
						'open_tag' => '\n[one_fourth]',
						'close_tag' => '[/one_fourth]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'two_thirds',
					'options' => array(
						'display_name' => 'two thirds',
						'open_tag' => '\n[two_thirds]',
						'close_tag' => '[/two_thirds]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'full',
					'options' => array(
						'display_name' => 'full',
						'open_tag' => '\n[full]',
						'close_tag' => '[/full]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'clear',
					'options' => array(
						'display_name' => 'clear',
						'open_tag' => '[clear]',
						'close_tag' => '[/clear]',
						'key' => ''
					));
	$buttons[] = array('name' => 'center',
					'options' => array(
						'display_name' => 'center',
						'open_tag' => '\n[center]',
						'close_tag' => '[/center]\n',
						'key' => ''
					));	
	$buttons[] = array('name' => 'slider',
					'options' => array(
						'display_name' => 'slider',
						'open_tag' => '\n[slider]',
						'close_tag' => '[/slider]\n',
						'key' => ''
					));
	$buttons[] = array('name' => 'divider',
					'options' => array(
						'display_name' => 'divider',
						'open_tag' => '\n[divider]',
						'close_tag' => '[/divider]\n',
						'key' => ''
					));	

	$buttons[] = array('name' => 'services',
					'options' => array(
						'display_name' => 'services',
						'open_tag' => '\n[services]',
						'close_tag' => '[/services]\n',
						'key' => ''
					));				
					
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}

	
add_action('admin_init', 'teo_init_shortcodes');
function teo_init_shortcodes(){
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		if ( in_array(basename($_SERVER['PHP_SELF']), array('post-new.php', 'page-new.php', 'post.php', 'page.php') ) ) {
			add_filter('mce_buttons', 'teo_filter_mce_button');
			add_filter('mce_external_plugins', 'teo_filter_mce_plugin');
			add_action('admin_head','teo_add_simple_buttons');
			add_action('edit_form_advanced', 'teo_advanced_buttons');
			add_action('edit_page_form', 'teo_advanced_buttons');
		}
	}
}

function teo_filter_mce_button($buttons) {
	array_push( $buttons, '|', 'teo_addthis', 'teo_skills', 'teo_slider', 'teo_carousel', 'teo_box', 'teo_button', 'teo_social', 'teo_service' );

	return $buttons;
}

function teo_filter_mce_plugin($plugins) {
	$plugins['teo_quicktags'] = get_template_directory_uri() . "/teoPanel/shortcodes/js/editor_plugin.js";
	
	return $plugins;
}

function teo_advanced_buttons(){
	global $themename; echo '<style type="text/css">#TB_window { height: 100% !important; } #TB_ajaxContent { overflow: scroll !important; } </style>'; ?>
	<script type="text/javascript">
		var defaultSettings = {},
			outputOptions = '',
			selected ='',
			content = '';
		
		defaultSettings['addthis'] = {
			variation: {
				name: 'Variation',
				defaultvalue: 'Normal Bar',
				description: 'The variation of the addthis sharing block',
				type: 'select',
				options: 'Normal bar|Big bar|Small bar|Floating bar'
			}
		};

		defaultSettings['button'] = {
			image: {
				name: 'URL of the button, if applicable',
				defaultvalue: '',
				description: 'If used, the button will link to some URL',
				type: 'text'
			},
			newwindow: {
				name: 'Open in new window?',
				defaultvalue: '',
				description: 'Should the button link open in a new window?',
				type: 'select',
				options: 'no|yes'
			},
			color: {
				name: 'Color of the button',
				defaultvalue: '',
				description: 'Use the hex value of the color, without the #. Default value is FADBA1',
				type: 'text'
			}
		};

		defaultSettings['skills'] = {
			title: {
				name: 'The title of the skills block',
				defaultvalue: '',
				description: 'The header title of the skills block',
				type: 'text'
			},
			name: {
				name: 'Skill name',
				defaultvalue: '',
				description: 'The name of the skill.',
				type: 'text',
				clone: 'cloned'
			},
			value: {
				name: 'Skill value(percent - number)',
				defaultvalue: '',
				description: 'How well do you know the skill? Use numbers from 1 to 100.',
				type: 'text',
				clone: 'cloned'
			},
			bg: {
				name: 'The background color of the skill',
				defaultvalue: '',
				description: 'Use hex colors, without the preceding #',
				type: 'text',
				clone: 'cloned'
			}
		};

		defaultSettings['slider'] = {
			image: {
				name: 'Image URL',
				defaultvalue: '',
				description: 'The URL of the image in the slider',
				type: 'text',
				clone: 'cloned'
			},
			alt: {
				name: 'Image alt attribute',
				defaultvalue: '',
				description: 'The attribute that will show up on the image. Used for SEO purposes, optional.',
				type: 'text',
				clone: 'cloned'
			},
			url: {
				name: 'URL on the image',
				defaultvalue: '',
				description: 'Use this if you want the image to be linked to some URL.',
				type: 'text',
				clone: 'cloned'
			}
		};

		defaultSettings['carousel'] = {
			image: {
				name: 'Image URL',
				defaultvalue: '',
				description: 'The URL of the image in the slider',
				type: 'text',
				clone: 'cloned'
			},
			thumb: {
				name: 'Thumbnail URL',
				defaultvalue: '',
				description: 'The URL of the thumbnail image in the slider',
				type: 'text',
				clone: 'cloned'
			},
			alt: {
				name: 'Image alt attribute',
				defaultvalue: '',
				description: 'The attribute that will show up on the image. Used for SEO purposes, optional.',
				type: 'text',
				clone: 'cloned'
			}
		};

		defaultSettings['service'] = {
			title: {
				name: 'Title of the services',
				defaultvalue: '',
				description: 'The title of the service',
				type: 'text'
			},
			image: {
				name: 'Image URL',
				defaultvalue: '',
				description: 'The URL of the service image, preferably an icon',
				type: 'text'
			},
			columns: {
				name: 'The number of columns',
				defaultvalue: '3',
				description: 'The number of services per line, default is 3.',
				type: 'select',
				options: '1|2|3|4'
			}
		};

		defaultSettings['box'] = {
			content: {
				name: 'Content of the box',
				defaultvalue: '',
				description: 'The content included in the box',
				type: 'text'
			}
		};

		defaultSettings['social'] = {
			twitter: {
				name: 'Twitter URL',
				defaultvalue: '',
				description: 'The URL of the twitter profile, if used.',
				type: 'text'
			},
			zerply: {
				name: 'Zerply URL',
				defaultvalue: '',
				description: 'The URL of the zerply profile, if used.',
				type: 'text'
			},
			facebook: {
				name: 'Facebook URL',
				defaultvalue: '',
				description: 'The URL of the facebook profile, if used.',
				type: 'text'
			},
			linkedin: {
				name: 'LinkedIn URL',
				defaultvalue: '',
				description: 'The URL of the linkedin profile, if used.',
				type: 'text'
			},
			pinterest: {
				name: 'Pinterest URL',
				defaultvalue: '',
				description: 'The URL of the pinterest profile, if used.',
				type: 'text'
			},
			dribbble: {
				name: 'Dribbble URL',
				defaultvalue: '',
				description: 'The URL of the dribbble profile, if used.',
				type: 'text'
			},
			gplus: {
				name: 'Google+ URL',
				defaultvalue: '',
				description: 'The URL of the gplus profile, if used.',
				type: 'text'
			}
		};
		
		function CustomButtonClick(tag){
			
			var index = tag;
			
				for (var index2 in defaultSettings[index]) {
					if (defaultSettings[index][index2]['clone'] === 'cloned')
						outputOptions += '<tr class="cloned">\n';
					else if (index === 'button' && index2 === 'icon')
						outputOptions += '<tr class="hidden">\n';
					else
						outputOptions += '<tr>\n';
					outputOptions += '<th><label for="teo-' + index2 + '">'+ defaultSettings[index][index2]['name'] +'</label></th>\n';
					outputOptions += '<td>';
					
					if (defaultSettings[index][index2]['type'] === 'select') {
						var optionsArray = defaultSettings[index][index2]['options'].split('|');
						
						outputOptions += '\n<select name="teo-'+index2+'" id="teo-'+index2+'">\n';
						
						for (var index3 in optionsArray) {
							selected = (optionsArray[index3] === defaultSettings[index][index2]['defaultvalue']) ? ' selected="selected"' : '';
							outputOptions += '<option value="'+optionsArray[index3]+'"'+ selected +'>'+optionsArray[index3]+'</option>\n';
						}
						
						outputOptions += '</select>\n';
					}
					
					if (defaultSettings[index][index2]['type'] === 'text') {
						cloned = '';
						if (defaultSettings[index][index2]['clone'] === 'cloned') cloned = "[]";
						outputOptions += '\n<input type="text" name="teo-'+index2+cloned+'" id="teo-'+index2+'" value="'+defaultSettings[index][index2]['defaultvalue']+'" />\n';
					}
					
					if (defaultSettings[index][index2]['type'] === 'textarea') {
						cloned = '';
						if (defaultSettings[index][index2]['clone'] === 'cloned') cloned = "[]";
						outputOptions += '<textarea name="teo-'+index2+cloned+'" id="teo-'+index2+'" cols="40" rows="10">'+defaultSettings[index][index2]['defaultvalue']+'</textarea>';
					}
					
					outputOptions += '\n<br/><small>'+ defaultSettings[index][index2]['description'] +'</small>';
					outputOptions += '\n</td>';
					
				}
			
		
			var width = jQuery(window).width(),
				tbHeight = jQuery(window).height(),
				tbWidth = ( 720 < width ) ? 720 : width;
			
			tbWidth = tbWidth - 80;
			tbHeight = tbHeight - 84;

			var tbOptions = "<div id='teo_shortcodes_div'><form id='teo_shortcodes'><table id='shortcodes_table' class='form-table teo-"+ tag +"'>";
			tbOptions += outputOptions;
			tbOptions += '</table>\n<p class="submit">\n<input type="button" id="shortcodes-submit" class="button-primary" value="Ok" name="submit" /></p>\n</form></div>';
			
			var form = jQuery(tbOptions);
			
			var table = form.find('table');
			form.appendTo('body').hide();

			$morelink = '';
						
			if (tag === 'skills') {
				$morelink = jQuery('<p><a href="#" id="teo_add_more_link">Add One More skill</a></p>').appendTo('form#teo_shortcodes tbody');
			}

			if (tag === 'slider') {
				$morelink = jQuery('<p><a href="#" id="teo_add_more_link">Add One More slider image</a></p>').appendTo('form#teo_shortcodes tbody');
			}

			if (tag === 'carousel') {
				$morelink = jQuery('<p><a href="#" id="teo_add_more_link">Add One More carousel image</a></p>').appendTo('form#teo_shortcodes tbody');
			}

			if($morelink != '') {
				$moreSkillsLink = jQuery('a#teo_add_more_link');
				
				$moreSkillsLink.on('click',function() {
					var clonedElements = jQuery('form#teo_shortcodes .cloned');
										
					newElements = clonedElements.slice(0,3).clone();
								
					var cloneNumber = clonedElements.length,
						labelNum = cloneNumber / 3;
					
					newElements.each(function(index){
						if ( index === 0 ) jQuery(this).css({'border-top':'1px solid #eeeeee'});
						
						var label = jQuery(this).find('label').attr('for'),
							newLabel = label + labelNum;
					
						jQuery(this).find('label').attr('for',newLabel);
						jQuery(this).find('input, textarea').attr('id',newLabel);
					});
					
					newElements.appendTo('form#teo_shortcodes tbody');
					$moreSkills.appendTo('form#teo_shortcodes tbody');
					return false;
				});		
			}
			
			
			form.find('#shortcodes-submit').click(function(){
							
				var shortcode = '['+tag;
								
				for( var index in defaultSettings[tag]) {
					var value = table.find('#teo-' + index).val();
					if (index === 'content') { 
						content = value;
						continue;
					}
					
					if (defaultSettings[tag][index]['clone'] !== undefined) {
						content = 'cloned';
						continue;
					} 
					
					if ( value !== defaultSettings[tag][index]['defaultvalue'] )
						shortcode += ' ' + index + '="' + value + '"';
						
				}

				shortcode += '] ' + "\n";
				
				if (content != '') {
					
					if (tag === 'skills') {
					
						var $teo_form = jQuery('form#teo_shortcodes'),
							tabsOutput = '';
												
						var count = $teo_form.find("input[name='teo-name[]']").size();

						tabsOutput += '[skill ';
						var temp = $teo_form.find("input[id='teo-name']");
						if(temp.val() !== '')
							tabsOutput += 'name="' + temp.val() + '" ';
						
						temp = $teo_form.find("input[id='teo-value']");
						if(temp.val() !== '')
							tabsOutput += 'value="' + temp.val() + '" ';

						temp = $teo_form.find("input[id='teo-bg']");
						if(temp.val() !== '')
							tabsOutput += 'bg="' + temp.val() + '"';

						tabsOutput += '][/skill] ';

						for(i=1; i<count; i++) {
							tabsOutput += '[skill ';
							var temp = $teo_form.find("input[id='teo-name" + i + "']");
							if(temp.val() !== '')
								tabsOutput += 'name="' + temp.val() + '" ';
							
							temp = $teo_form.find("input[id='teo-value" + i + "']");
							if(temp.val() !== '')
								tabsOutput += 'value="' + temp.val() + '" ';

							temp = $teo_form.find("input[id='teo-bg" + i + "']");
							if(temp.val() !== '')
								tabsOutput += 'bg="' + temp.val() + '" ';

							tabsOutput += '][/skill] ';
						}
						
						
						content = tabsOutput;
					}

					if (tag === 'slider') {
					
						var $teo_form = jQuery('form#teo_shortcodes'),
							tabsOutput = '';
												
						var count = $teo_form.find("input[name='teo-image[]']").size();

						var temp = $teo_form.find("input[id='teo-image']");
						if(temp.val() !== '')
						{
							tabsOutput += '[slider_img ';

							tabsOutput += 'image="' + temp.val() + '" ';
						
							temp = $teo_form.find("input[id='teo-alt']");
							if(temp.val() !== '')
								tabsOutput += 'alt="' + temp.val() + '" ';

							temp = $teo_form.find("input[id='teo-url']");
							if(temp.val() !== '')
								tabsOutput += 'url="' + temp.val() + '"';

						
							tabsOutput += '][/slider_img] ';

							for(i=1; i<count; i++) {
								tabsOutput += '[slider_img ';
								var temp2 = $teo_form.find("input[id='teo-image" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'image="' + temp2.val() + '" ';
								
								temp2 = $teo_form.find("input[id='teo-alt" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'alt="' + temp2.val() + '" ';

								temp2 = $teo_form.find("input[id='teo-url" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'url="' + temp2.val() + '" ';

								tabsOutput += '][/slider_img] ';
							}
						}
						
						
						content = tabsOutput;
					}

					if (tag === 'carousel') {
					
						var $teo_form = jQuery('form#teo_shortcodes'),
							tabsOutput = '';
												
						var count = $teo_form.find("input[name='teo-image[]']").size();

						var temp = $teo_form.find("input[id='teo-image']");
						if(temp.val() !== '')
						{
							tabsOutput += '[carousel_item ';

							tabsOutput += 'image="' + temp.val() + '" ';
						
							temp = $teo_form.find("input[id='teo-alt']");
							if(temp.val() !== '')
								tabsOutput += 'alt="' + temp.val() + '" ';

							temp = $teo_form.find("input[id='teo-thumb']");
							if(temp.val() !== '')
								tabsOutput += 'thumb="' + temp.val() + '"';

						
							tabsOutput += '][/carousel_item] ';

							for(i=1; i<count; i++) {
								tabsOutput += '[carousel_item ';
								var temp2 = $teo_form.find("input[id='teo-image" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'image="' + temp2.val() + '" ';
								
								temp2 = $teo_form.find("input[id='teo-alt" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'alt="' + temp2.val() + '" ';

								temp2 = $teo_form.find("input[id='teo-thumb" + i + "']");
								if(temp2.val() !== '')
									tabsOutput += 'thumb="' + temp2.val() + '" ';

								tabsOutput += '][/carousel_item] ';
							}
						}
						
						
						content = tabsOutput;
					}
									
					shortcode += content;
					shortcode += '[/'+tag+'] ' + "\n";
				}

				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode + ' ');
				
				tb_remove();
			});
			
			tb_show( 'Teo ' +  tag + ' Shortcode', '#TB_inline?width=' + tbWidth + '&height=' + tbHeight + '&inlineId=teo_shortcodes_div' );
			jQuery('#teo_shortcodes_div').remove();
			outputOptions = '';
		}
	</script>
<?php } ?>