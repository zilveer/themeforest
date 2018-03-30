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
				'std' => '#ffffff',
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
				'title' => __('Size','om_theme'),
				'desc' => __('(size in pixels or in percent: 36 or 36px or 180% or 240%)','om_theme'),
				'type' => 'text',
				'std' => '220%'
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
				'id' => 'om_biginfopane_color',
				'title' => __('Infopane color','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Theme Color','om_theme'),
					'custom'=>__('Custom Color','om_theme'),
				)
			),
			array(
				'id' => 'om_biginfopane_customcolor',
				'title' => __('Infopane custom color','om_theme'),
				'type' => 'color',
				'std' => ''
			),
			array(
				'id' => 'om_biginfopane_textcolor',
				'title' => __('Text color','om_theme'),
				'type' => 'color',
				'std' => '#ffffff'
			),
			array(
				'id' => 'om_biginfopane_title',
				'title' => __('Infopane Title','om_theme'),
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
				'id' => 'om_biginfopane_fullwidth',
				'title' => __('Full-width pane','om_theme'),
				'desc' => __('Cover page paddings','om_theme'),
				'type' => 'checkbox',
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
	
	'gallery'=>array(
		'options'=>array(
			array(
				'desc' => __('Manage galleries with main WP-admin menu &gt; "<a href="edit.php?post_type=galleries">Galleries</a>"','om_theme'),
				'type' => 'info',
				'std' => ''
			),

			array(
				'id' => 'om_gallery_id',
				'title' => __('Choose the gallery','om_theme'),
				'type' => 'choose_gallery',
				'std' => ''
			),
			array(
				'id' => 'om_gallery_layout',
				'title' => __('Gallery layout','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Default','om_theme'),
					'masonry'=>__('Masonry layout','om_theme'),
				)
			),
		)
	),
	
	'table'=>array(
		'options'=>array(
			array(
				'desc' => __('Markup for table will be inserted into the editor','om_theme'),
				'type' => 'info',
			),
			array(
				'id' => 'om_table_columns',
				'title' => __('Enter number of columns','om_theme'),
				'type' => 'text',
				'std' => '3'
			),
			array(
				'id' => 'om_table_rows',
				'title' => __('Enter number of rows','om_theme'),
				'type' => 'text',
				'std' => '3'
			),
			array(
				'id' => 'om_table_first_heading',
				'title' => __('First row is a heading','om_theme'),
				'type' => 'checkbox',
				'std' => 'true'
			),
			
			array(
				'id' => 'om_table_style',
				'title' => __('Style','om_theme'),
				'type' => 'select',
				'std' => '1',
				'options' => array(
					'1'=>__('Style-1','om_theme'),
					'2'=>__('Style-2','om_theme'),
				)
			),
			
			array(
				'desc' => __('Note for inserted code: <b>[tr]</b> tag is a row tag, <b>[th]</b> tag - is a heading cell in a row, <b>[td]</b> tag - is a cell in a row','om_theme'),
				'type' => 'info',
			),
		)
	),
	
	'video'=>array(
		'options'=>array(
			array(
				'desc' => __('Grab the embed video code from YouTube, Vimeo or any other service and paste it below','om_theme'),
				'type' => 'info',
			),
			array(
				'id' => 'om_video_code',
				'title' => __('Video Embed Code','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_video_max_width',
				'title' => __('Maximum video width (in pixels)','om_theme'),
				'desc' => __('Video will be resized and fitted to site width, but you can specify maximum width','om_theme'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	
	'pullquote'=>array(
		'options'=>array(
			array(
				'id' => 'om_pullquote_text',
				'title' => __('Text','om_theme'),
				'type' => 'textarea',
				'std' => ''
			),
			array(
				'id' => 'om_pullquote_style',
				'title' => __('Style','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Default','om_theme'),
					'border-left'=>__('Border-left','om_theme'),
				)
			),
		)
	),
	
	'contactform'=>array(
		'options'=>array(
			array(
				'id' => 'om_contactform',
				'title' => '',
				'desc' => __('Contact form fields and other settings can be specified under Theme Options','om_theme'),
				'type' => 'info',
				'std' => ''
			),

		)
	),
	
	'testimonials'=>array(
		'options'=>array(
			array(
				'id' => 'om_testimonials',
				'title' => '',
				'desc' => __('Testimoials can be added under "Testimonials > Add New"','om_theme'),
				'type' => 'info',
				'std' => ''
			),
			array(
				'id' => 'om_testimonials_category',
				'title' => __('Testimonials category','om_theme'),
				'desc' => __('Can be shown all testimonials or only from chosen category','om_theme'),
				'type' => 'testimonials_category',
				'std' => '0'
			),
			array(
				'id' => 'om_testimonials_mode',
				'title' => __('Layout mode','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('In one box with sliding','om_theme'),
					'list'=>__('Full list','om_theme'),
				)
			),
			array(
				'id' => 'om_testimonials_timeout',
				'title' => __('Autorotate for box mode','om_theme'),
				'desc' => __('interval in milliseconds or 0 - to disable autorotate','om_theme'),
				'type' => 'text',
				'std' => '0',
			),
			array(
				'id' => 'om_testimonials_pause',
				'title' => __('Pause on hover','om_theme'),
				'type' => 'checkbox',
				'std' => '',
			),
		)
	),
	
	'pricing'=>array(
		'options'=>array(
			array(
				'desc' => __('Markup for pricing table will be inserted into the editor','om_theme'),
				'type' => 'info',
			),
			array(
				'id' => 'om_pricing_columns',
				'title' => __('Enter number of columns','om_theme'),
				'desc' => __('Number of tariffs','om_theme'),
				'type' => 'text',
				'std' => '3'
			),
			array(
				'id' => 'om_pricing_rows',
				'title' => __('Enter number of rows (parameters to compare)','om_theme'),
				'desc'=> __('Number of parameters to compare','om_theme'),
				'type' => 'text',
				'std' => '5'
			),
			
			array(
				'desc' => __('Note for inserted code:<br /><b>[pricing_column]...[/pricing_column]</b> - tariff description inside,<br /><b>[pricing_column_name]...[/pricing_column_name]</b> - name of the tariff<br /><b>[price]...[/price]</b> - the price,<br /><b>[line]...[/line]</b> - line in the column. Number of lines should be equal for each column<br /><b>[button href="URL"]...[/button]</b> - button for tariff','om_theme'),
				'type' => 'info',
			),
		)
	),
	
	'recent_posts'=>array(
		'options'=>array(
			array(
				'id' => 'om_recent_posts_count',
				'title' => __('Enter number of posts to display','om_theme'),
				'desc' => '',
				'type' => 'text',
				'std' => '3'
			),
			array(
				'id' => 'om_recent_posts_offset',
				'title' => __('Offset','om_theme'),
				'desc' => __('Number of posts to skip','om_theme'),
				'type' => 'text',
				'std' => '0'
			),
			array(
				'id' => 'om_recent_posts_thumbnails',
				'title' => __('Show thumbnails','om_theme'),
				'desc'=> '',
				'type' => 'checkbox',
				'std' => 'true'
			),
			array(
				'id' => 'om_recent_posts_thumbnails_align',
				'title' => __('Thumbnails position','om_theme'),
				'type' => 'select',
				'std' => '',
				'options' => array(
					''=>__('Left side','om_theme'),
					'right'=>__('Right side','om_theme'),
				)
			),
			array(
				'id' => 'om_recent_posts_thumbnails_first_big',
				'title' => __('Show first post with big thumbnail','om_theme'),
				'type' => 'checkbox',
				'std' => ''
			),
			array(
				'id' => 'om_recent_posts_category',
				'title' => __('Posts category','om_theme'),
				'desc'=> '',
				'type' => 'posts_category',
				'std' => '0'
			),
			array(
				'id' => 'om_recent_posts_category_title',
				'title' => __('Show category title if chosen','om_theme'),
				'type' => 'checkbox',
				'std' => ''
			),
		)
	),
	
	'portfolio'=>array(
		'options'=>array(
			array(
				'id' => 'om_portfolio_count',
				'title' => __('Enter number of portfolio items to display','om_theme'),
				'desc' => '',
				'type' => 'text',
				'std' => '3'
			),
			array(
				'id' => 'om_portfolio_category',
				'title' => __('Portfolio category','om_theme'),
				'desc'=> '',
				'type' => 'portfolio_category',
				'std' => '0'
			),
			array(
				'id' => 'om_portfolio_randomize',
				'title' => __('Randomize items','om_theme'),
				'desc'=> '',
				'type' => 'checkbox',
				'std' => '0'
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

			if($opt['type'] == 'info') {
				
				$out.='<div class="om-sc-popup-option-title">'.( isset($opt['title']) ? $opt['title'] : '' );
				if(isset($opt['desc']) && $opt['desc'])
					$out.='<div class="om-sc-popup-option-title-note">'.$opt['desc'].'</div>';
				$out.= '</div>';
				
			} else {

				$out.= '<div class="om-sc-popup-option-title">'.( isset($opt['title']) ? $opt['title'] : '' );
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
						$out.= '
							<input type="checkbox" name="'.$opt['id'].'" id="'.$opt['id'].'" value="true" '.('true'==$opt['std']?' checked="checked"':'').' />
							';
					break;
					
					case 'text':
						$out.= '
							<input type="text" class="widefat" name="'.$opt['id'].'" id="'.$opt['id'].'" value="'.$opt['std'].'" />
							';
					break;
					
					case 'textarea':
						$out.= '
							<textarea class="widefat" rows="8" name="'.$opt['id'].'" id="'.$opt['id'].'" >'.htmlspecialchars($opt['std']).'</textarea>
							';
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
	
						$out.='
									<script>jQuery(".opt-icon-item label").click(function(){jQuery(".opt-icon-item.active").removeClass("active");jQuery(this).parents(".opt-icon-item").addClass("active"); });</script><div class="clear"></div>
						';
					break;
	
					case 'choose_gallery':
						$out.= '
							<select name="'.$opt['id'].'" id="'.$opt['id'].'">';
								
						$galleries = get_posts( array(
								'numberposts' => -1,
						    'sort_order' => 'ASC',
						    'sort_column' => 'post_title',
						    'hierarchical' => false,
						    'post_type' => 'galleries'
						));
	
						if(!empty($galleries)) {
							foreach($galleries as $gallery) {
								$out .= '<option value="'.$gallery->ID.'">'.$gallery->post_title.'&nbsp;&nbsp;&nbsp;&nbsp;</option>';
							}
						} else {
							$out .= '<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;</option>';
						}
						$out.= '</select>';
						if(empty($galleries))
							$out.= ' <b><i>'.__('No galleries found','om_theme').'</i></b>';

					break;
					
					case 'posts_category':

						$args = array(
							'show_option_all'    => __('All Categories', 'om_theme'),
							'show_option_none'   => __('No Categories', 'om_theme'),
							'hide_empty'         => 0, 
							'echo'               => 0,
							'selected'           => @$opt['std'],
							'hierarchical'       => 0, 
							'name'               => $opt['id'],
							'id'         		     => $opt['id'],
							'class'              => '',
							'depth'              => 0,
							'tab_index'          => 0,
							'taxonomy'           => 'category',
							'hide_if_empty'      => false 	
						);
				
						$out .= wp_dropdown_categories( $args );

					break;
					
					case 'portfolio_category':

						$args = array(
							'show_option_all'    => __('All Categories', 'om_theme'),
							'show_option_none'   => __('No Categories', 'om_theme'),
							'hide_empty'         => 0, 
							'echo'               => 0,
							'selected'           => @$opt['std'],
							'hierarchical'       => 0, 
							'name'               => $opt['id'],
							'id'         		     => $opt['id'],
							'class'              => '',
							'depth'              => 0,
							'tab_index'          => 0,
							'taxonomy'           => 'portfolio-type',
							'hide_if_empty'      => false 	
						);
				
						$out .= wp_dropdown_categories( $args );
	
					break;
					
					case 'testimonials_category':

						$args = array(
							'show_option_all'    => __('All Categories', 'om_theme'),
							'show_option_none'   => __('No Categories', 'om_theme'),
							'hide_empty'         => 0, 
							'echo'               => 0,
							'selected'           => @$opt['std'],
							'hierarchical'       => 0, 
							'name'               => $opt['id'],
							'id'         		     => $opt['id'],
							'class'              => '',
							'depth'              => 0,
							'tab_index'          => 0,
							'taxonomy'           => 'testimonials-type',
							'hide_if_empty'      => false 	
						);
				
						$out .= wp_dropdown_categories( $args );
	
					break;
									
				}
				
				$out.='</div>';
				
			}
			
			$out.='</div>';
			
		}
	}
	
	return $out;
}