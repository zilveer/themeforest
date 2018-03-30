<?php

$om_tmce_shortcode_options=array(
	'columns'=>array(
		'options'=>array(
			array(
				'id' => 'om_column_size',
				'title' => __('Columns Size','om_theme'),
				'desc' => __('Markup for column will be inserted into the editor','om_theme'),
				'type' => 'select',
				'std' => 'one-half',
				'options' => array(
					'one_half'=>__('One Half','om_theme'),
					'one_third'=>__('One Third','om_theme'),
					'two_third'=>__('Two Third','om_theme'),
					'one_fourth'=>__('One Fourth','om_theme'),
					'three_fourth'=>__('Three Fourth','om_theme'),
					'one_fifth'=>__('One Fifth','om_theme'),
					'two_fifth'=>__('Two Fifth','om_theme'),
					'three_fifth'=>__('Three Fifth','om_theme'),
					'four_fifth'=>__('Four Fifth','om_theme'),
					'one_sixth'=>__('One Sixth','om_theme'),
					'five_sixth'=>__('Five Sixth','om_theme'),
				)
			),
			array(
				'id' => 'om_column_last',
				'title' => __('Last Column','om_theme'),
				'desc' => __('Check if it\'s the last column in the row','om_theme'),
				'type' => 'checkbox',
				'std' => ''
			)
		)
	),
	
	'buttons'=>array(
		'options'=>array(
			array(
				'id' => 'om_button_title',
				'title' => __('Button Title','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_button_href',
				'title' => __('Button URL','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_button_target',
				'title' => __('Button target','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('default','om_theme'),
					'_blank'=>__('_blank','om_theme'),
					'_parent'=>__('_parent','om_theme'),
					'_top'=>__('_top','om_theme'),
				)
			),
			array(
				'id' => 'om_button_color',
				'title' => __('Button Color','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Theme Color','om_theme'),
					'custom'=>__('Custom Color','om_theme'),
				)
			),
			array(
				'id' => 'om_button_customcolor',
				'title' => __('Button Custom Color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
			array(
				'id' => 'om_button_hovercolor',
				'title' => __('Button Hover Color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
			array(
				'id' => 'om_button_textcolor',
				'title' => __('Text Color','om_theme'),
				'type' => 'color',
				'std' => '#000000',
			),
			array(
				'id' => 'om_button_size',
				'title' => __('Button Size','om_theme'),
				'type' => 'select',
				'std' => 'medium',
				'options' => array(
					'mini'=>__('Mini','om_theme'),
					'small'=>__('Small','om_theme'),
					'medium'=>__('Medium','om_theme'),
					'large'=>__('Large','om_theme'),
					'xlarge'=>__('XLarge With extra block','om_theme'),
				)
			),
			array(
				'id' => 'om_button_text',
				'title' => __('Extra text for XLarge button','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_button_tooltip',
				'title' => __('Tooltip for button','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	
	'dropcaps'=>array(
		'options'=>array(
			array(
				'id' => 'om_dropcap_title',
				'title' => __('Letter','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_dropcap_size',
				'title' => __('Size (pixels)','om_theme'),
				'type' => 'text',
				'std' => '36'
			),
			array(
				'id' => 'om_dropcap_bgcolor',
				'title' => __('Background Color','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('No background','om_theme'),
					'theme'=>__('Theme Color','om_theme'),
					'custom'=>__('Custom','om_theme'),
				)
			),
			array(
				'id' => 'om_dropcap_custombgcolor',
				'title' => __('Custom Background color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
			array(
				'id' => 'om_dropcap_textcolor',
				'title' => __('Text color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
		)
	),

	'toggle'=>array(
		'options'=>array(
			array(
				'id' => 'om_toggle_title',
				'title' => __('Toggle Title','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_toggle_content',
				'title' => __('Toggle text','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_toggle_state',
				'title' => __('Toggle initial state','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Closed','om_theme'),
					'opened'=>__('Opened','om_theme'),
				)
			),
		)
	),
	
	'accordion'=>array(
		'options'=>array(
			array(
				'id' => 'om_accordion_count',
				'title' => __('Number of items','om_theme'),
				'desc' => __('Markup for accordion will be inserted into the editor','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	
	'tabs'=>array(
		'options'=>array(
			array(
				'id' => 'om_tabs_count',
				'title' => __('Number of tabs','om_theme'),
				'desc' => __('Markup for tabs will be inserted into the editor','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	
	'aligned'=>array(
		'options'=>array(
			array(
				'id' => 'om_aligned_desc',
				'title' => __('Content Description','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_aligned_content',
				'title' => __('Content','om_theme'),
				'desc' => __('image: &lt;img src=".." /&gt; or any HTML code','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_aligned_align',
				'title' => __('Align','om_theme'),
				'type' => 'select',
				'std' => 'left',
				'options' => array(
					'left'=>__('Left','om_theme'),
					'center'=>__('Center','om_theme'),
					'right'=>__('Right','om_theme'),
					'full-width'=>__('Full-Width','om_theme'),
				)
			),
		)
	),
	
	'infopane'=>array(
		'options'=>array(
			array(
				'id' => 'om_infopane_style',
				'title' => __('Infopane style','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					'1'=>__('Check-in Green','om_theme'),
					'2'=>__('Green Pencil','om_theme'),
					'3'=>__('Pink Love is','om_theme'),
					'4'=>__('Yellow Alert','om_theme'),
					'5'=>__('No in Red','om_theme'),
					'6'=>__('Grey Key','om_theme'),
					'7'=>__('Blue Flag','om_theme'),
					'8'=>__('Light Blue ID','om_theme'),
					'9'=>__('Turquoise Time','om_theme'),
				)
			),
			array(
				'id' => 'om_infopane_text',
				'title' => __('Text','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
		)
	),
	
	'biginfopane'=>array(
		'options'=>array(
			array(
				'id' => 'om_biginfopane_title',
				'title' => __('Title','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_biginfopane_text',
				'title' => __('Text','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_biginfopane_button_title',
				'desc' => __('Can be empty, that way pane will be withour button','om_theme'),
				'title' => __('Button Title','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_biginfopane_button_href',
				'title' => __('Button URL','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_biginfopane_button_target',
				'title' => __('Button target','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('default','om_theme'),
					'_blank'=>__('_blank','om_theme'),
					'_parent'=>__('_parent','om_theme'),
					'_top'=>__('_top','om_theme'),
				)
			),
		)
	),
	
	'icons'=>array(
		'options'=>array(
			array(
				'id' => 'om_icon_title',
				'title' => __('Text','om_theme'),
				'type' => 'text',
				'std' => ''
			),

			array(
				'id' => 'om_icon_url',
				'title' => __('URL','om_theme'),
				'desc' => __('if that should be a link','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_icon_target',
				'title' => __('Target for URL','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('default','om_theme'),
					'_blank'=>__('_blank','om_theme'),
					'_parent'=>__('_parent','om_theme'),
					'_top'=>__('_top','om_theme'),
				)
			),
			array(
				'id' => 'om_icon_icon',
				'title' => __('Icon','om_theme'),
				'type' => 'icon',
				'std' => ''
			),
			
			array(
				'id' => 'om_icon_tooltip',
				'title' => __('Tooltip','om_theme'),
				'type' => 'text',
				'std' => ''
			),

		)
	),
	
	'marker'=>array(
		'options'=>array(
			array(
				'id' => 'om_marker_title',
				'title' => __('Text','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_marker_custombgcolor',
				'title' => __('Custom Background Color','om_theme'),
				'desc' => __('Default - Theme color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
			array(
				'id' => 'om_marker_textcolor',
				'title' => __('Text color','om_theme'),
				'type' => 'color',
				'std' => '',
			),
			array(
				'id' => 'om_marker_tooltip',
				'title' => __('Tooltip','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),

	'bullets'=>array(
		'options'=>array(
			array(
				'id' => 'om_bullets_count',
				'title' => __('Number of items','om_theme'),
				'desc' => __('Markup for list will be inserted into the editor','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			
			array(
				'id' => 'om_bullets_icon',
				'title' => __('Icon','om_theme'),
				'type' => 'icon',
				'std' => ''
			),

		)
	),
	
	'bullets_individual'=>array(
		'options'=>array(
			array(
				'id' => 'om_bullets_individual_count',
				'title' => __('Number of items','om_theme'),
				'desc' => __('Markup for list will be inserted into the editor','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			
			array(
				'id' => 'om_bullets_individual_icon',
				'title' => __('Icon','om_theme'),
				'desc' => __('Default icon, you will be able to change icon for every item in the result code','om_theme'),
				'type' => 'icon',
				'std' => ''
			),

		)
	),
	
	'space'=>array(
		'options'=>array(
			array(
				'id' => 'om_space_size',
				'title' => __('Vertical Space Size in Pixels','om_theme'),
				'type' => 'text',
				'std' => ''
			),

		)
	),

	'testimonial'=>array(
		'options'=>array(
			array(
				'id' => 'om_testimonial_text',
				'title' => __('Text','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_testimonial_author',
				'title' => __('Author','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_testimonial_author_comment',
				'title' => __('Comment for Author','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_testimonial_photo',
				'title' => __('Author Photo','om_theme'),
				'type' => 'image',
				'std' => ''
			),
		)
	),	
	
	'agenda'=>array(
		'options'=>array(
			array(
				'id' => 'om_agenda',
				'title' => __('Agenda shortcode','om_theme'),
				'desc' => __('After pressing the button the sample markup will be inserted.<br />You can copy parts of the code and modify it.<br/>Agenda consists of rows. Every row can be one of three types:<ul><li>[day] &mdash; day header</li><li>[event] &mdash; event description</li><li>[lunch] &mdash; lunch description</li></ul>','om_theme'),
				'type' => 'intro',
				'std' => ''
			),

		)
	),
	
	'speaker'=>array(
		'options'=>array(
			array(
				'id' => 'om_speaker',
				'title' => '',
				'desc' => __('Here is a form for one speaker below. To add more speakers just add them one by one.','om_theme'),
				'type' => 'intro',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_photo',
				'desc' => __('Best fit 75x75 px','om_theme'),
				'title' => __('Speaker Photo','om_theme'),
				'type' => 'image',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_name',
				'title' => __('Name','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_post',
				'title' => __('Speaker Post','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_company',
				'title' => __('Speaker Company','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_about',
				'title' => __('About speaker','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_link',
				'title' => __('Link to the page ','om_theme'),
				'desc' => __('if necessary ','om_theme'),
				'type' => 'text',
				'std' => ''
			),
			array(
				'id' => 'om_speaker_target',
				'title' => __('Link target','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('default','om_theme'),
					'_blank'=>__('_blank','om_theme'),
					'_parent'=>__('_parent','om_theme'),
					'_top'=>__('_top','om_theme'),
				)
			),

		)
	),	
	
	'registration'=>array(
		'options'=>array(
			array(
				'id' => 'om_registration',
				'title' => '',
				'desc' => __('Registration form fields and other settings can be specified via Theme Options','om_theme'),
				'type' => 'intro',
				'std' => ''
			),

		)
	),
	
	'video'=>array(
		'options'=>array(
			array(
				'id' => 'om_video_link',
				'title' => __('Link to the video (YouTube, Vimeo, etc.)','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	
	'map'=>array(
		'options'=>array(
			array(
				'id' => 'om_map_code',
				'title' => __('Map embed iframe','om_theme'),
				'desc' => __('Visit <a href="https://maps.google.com/" target="_blank">Google maps</a> to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Copy iframe code and paste it here.','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			
			array(
				'id' => 'om_map_height',
				'title' => __('Map height','om_theme'),
				'desc' => __('Enter map height in pixels. Example: 200 or leave it empty for auto size.','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
);


function om_tmce_shortcode_options_machine($id) {
	global $om_tmce_shortcode_options;
	
	$out='';
	
	if(@$om_tmce_shortcode_options[$id]) {
		foreach($om_tmce_shortcode_options[$id]['options'] as $opt) {
			
			$out .= '<div class="om-sc-popup-option-line omsc-'.$opt['type'].' om-sc-clearfix">';
			
			if($opt['type'] == 'intro') {
				
				$out.='<div class="om-sc-popup-option-title">'.$opt['title'];
				if(isset($opt['desc']) && $opt['desc'])
					$out.='<div class="om-sc-popup-option-title-note">'.$opt['desc'].'</div>';
				$out.= '</div>';
				
			} else {
				
				$out.= '<div class="om-sc-popup-option-title">'.@$opt['title'];
				if(isset($opt['desc']) && $opt['desc'])
					$out.='<div class="om-sc-popup-option-title-note">'.$opt['desc'].'</div>';
				$out.= '</div>';
				
				$out.='<div class="om-sc-popup-option-content">';
			
				switch ($opt['type']) {
					
					case 'select':
						$out.= '
							<select name="'.$opt['id'].'" id="'.$opt['id'].'">';
						foreach($opt['options'] as $k=>$v) {
							$out .= '<option value="'.$k.'"'.($k==$opt['std']?' selected="selected"':'').'>'.$v.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
						}
						$out.= '</select>';
					break;
					
					case 'checkbox':
						$out.= '<input type="checkbox" name="'.$opt['id'].'" id="'.$opt['id'].'" value="true" '.('true'==$opt['std']?' checked="checked"':'').' />';
					break;
					
					case 'text':
						$out.= '<input type="text" class="widefat" name="'.$opt['id'].'" id="'.$opt['id'].'" value="'.$opt['std'].'" />';
					break;
					
					case 'textarea':
						$out.= '<textarea class="widefat" rows="8" name="'.$opt['id'].'" id="'.$opt['id'].'" >'.htmlspecialchars($opt['std']).'</textarea>';
					break;
					
					case 'color':
						$out.= '
							<input class="wp-color-picker-field" name="'. $opt['id'] .'" id="'. $opt['id'] .'" type="text" value="'. $opt['std'] .'"  data-default-color="'. $opt['std'] .'" />
						';
					break;
					
					case 'icon':
						$out.= '
							<style>.opt-icon-item{float:left;margin:0 10px 10px 0;padding:2px;border:2px solid transparent} .opt-icon-item img {display:block} .opt-icon-item.active {border-color:red}</style>
									';
						for($i=1;$i<=381;$i++)
						{
							$out.='<div class="opt-icon-item'.($i==1?' active':'').'"><input type="radio" name="'. $opt['id'] .'" style="display:none" '.($i==1?'checked="checked"':'').' value="'.sprintf('%04d',$i).'.png" id="'. $opt['id'] .'_'.$i.'"><label for="'. $opt['id'] .'_'.$i.'"><img src="'.TEMPLATE_DIR_URI.'/img/icons/'.sprintf('%04d',$i).'.png" alt=""/></a></label></div>';
						}
						for($i=800;$i<=1046;$i++)
						{
							$out.='<div class="opt-icon-item'.($i==1?' active':'').'"><input type="radio" name="'. $opt['id'] .'" style="display:none" '.($i==1?'checked="checked"':'').' value="'.sprintf('%04d',$i).'.png" id="'. $opt['id'] .'_'.$i.'"><label for="'. $opt['id'] .'_'.$i.'"><img src="'.TEMPLATE_DIR_URI.'/img/icons/'.sprintf('%04d',$i).'.png" alt=""/></a></label></div>';
						}
	
						$out.='<script>jQuery(".opt-icon-item label").click(function(){jQuery(".opt-icon-item.active").removeClass("active");jQuery(this).parents(".opt-icon-item").addClass("active"); });</script><div class="clear"></div>';
					break;
					
					case 'image':
						$out.= '
						
							<input name="'. $opt['id'] .'" id="'. $opt['id'] .'_upload" type="text" class="widefat" value="" />
							<div style="padding-top:5px">
								<span class="button input-browse-button" id="'.$opt['id'].'" rel="'. $opt['id'] .'_upload" data-base-id="'.$opt['id'].'" data-library="image" data-choose="'.__('Choose a file','om_theme').'" data-select="'.__('Select','om_theme').'">Browse Image</span>
							</div>
							<script>
							jQuery(function(){
								om_init_browse_button(jQuery("#'.$opt['id'].'").parent());
							});
							</script>
						';
					break;
					
				}
				
				$out.='</div>';
				
			}
			
			$out.='</div>';
			
		}
	}
	
	return $out;
}


