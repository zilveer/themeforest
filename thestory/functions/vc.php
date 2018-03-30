<?php

add_action( 'init', 'pexeto_register_vc_shortcodes' , 11);
function pexeto_register_vc_shortcodes() {
	if(!function_exists('vc_map')){
		return;
	}

	$pfx = 'pex_attr_';
	$icons_url = PEXETO_FUNCTIONS_URL.'formatting-buttons/btnicons/';

	$shortcodes = array(
		array(
			'name' => 'Background Section',
			'base' => 'bgsection',
			'as_parent' => array('except' => 'bgsection'),
			'class' => '',
			'category' => PEXETO_THEMENAME.' Elements',
			'content_element' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'title'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Subtitle',
					'param_name' => 'subtitle'
				),
				array(
					'type' => 'dropdown',
					'value' => array(
						'Light Background' => 'section-light',
						'Light Background 2' => 'section-light2',
						'Light Background + Background Image' => 'section-light-bg',
						'Dark Background' => 'section-dark',
						'Dark Background + Background Image' => 'section-dark-bg',
						'Custom' => 'section-custom'),
					'heading' => 'Style',
					'param_name' => 'style'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Section Height',
					'param_name' => 'height',
					'description' => '(Optional) Minimum height of the section in pixels'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Background Color',
					'param_name' => 'bgcolor',
					'group' => 'Custom Color Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Title Color',
					'param_name' => 'titlecolor',
					'group' => 'Custom Color Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Text Color',
					'param_name' => 'textcolor',
					'group' => 'Custom Color Options'
				),
				array(
					'type' => 'attach_image',
					'heading' => 'Background Image',
					'param_name' => 'image',
					'group' => 'Background Image'
				),
				array(
					'type' => 'dropdown',
					'value' => array('1', '0.9', '0.8', '0.7', '0.6', '0.5', '0.4', '0.3', '0.2', '0.1'),
					'heading' => 'Background Image Opacity',
					'param_name' => 'imageopacity',
					'group' => 'Background Image'
				),
				array(
					'type' => 'dropdown',
					'value' => array('Static'=>'static', 'Parallax Fixed'=>'parallax-fixed', 'Parallax Scroll'=>'parallax-scroll'),
					'heading' => 'Background Image Style',
					'param_name' => 'bgimagestyle',
					'group' => 'Background Image'
				),

			)
		),

		array(
			'name' => 'Call To Action Section',
			'base' => 'pexcirclecta',
			'category' => PEXETO_THEMENAME.' Elements',
			'icon' => $icons_url.'ctacircle-section.png',
			'class'=>'pexeto-vc',
			'params' => array(
				array(
					'param_name' => 'small_title', 
					'heading' => 'Small Title',
					'type'=>'textfield'
				),
				array(
					'param_name' => 'title', 
					'heading' => 'Main title',
					'type'=>'textfield'
				),
				array(
					'param_name' => 'button_text', 
					'heading' => 'Button Text',
					'type'=>'textfield'
				),
				array(
					'param_name' => 'button_link', 
					'heading' => 'Button Link',
					'type'=>'textfield'
				),
				array(
					'param_name' => 'button_link_open', 
					'heading' => 'Open link in', 
					'type' => 'dropdown',
					'value' => array('Same tab / window'=>'same', 'New tab / window'=>'new')
				),
				array(
					'param_name' => 'button_color', 
					'heading' => 'Custom Button Color',
					'type' => 'colorpicker'
					)
				)
			),

			array(
				'name' => 'Testimonial Slider',
				'base' => 'pextestim',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'testimonials-section.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
					array(
						'param_name' => 'set', 
						'heading' => 'Select testimonials set',
						'type'=>'dropdown',
						'description'=>'You can create testimonials in '.PEXETO_THEMENAME.' &raquo; Testimonials section.',
						'value'=>pexeto_vc_get_custom_page_set(PEXETO_TESTIMONIALS_POSTTYPE),
						'std'=>key(pexeto_vc_get_custom_page_set(PEXETO_TESTIMONIALS_POSTTYPE))
					),
					array(
						'param_name' => 'autoplay', 
						'heading' => 'Autoplay', 
						'type' => 'dropdown',
						'value' => array('Disabled'=>'false', 'Enabled'=>'true')
					),
				)
			),

			array(
				'name' => 'Portfolio Carousel',
				'base' => 'pexcarousel',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'carousel-section.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
					array(
						'param_name' => 'cat', 
						'heading' => 'Show items from portfolio category',
						'type'=>'dropdown',
						'value'=>pexeto_vc_get_portfolio_cats()
					),
					array(
						'param_name' => 'title', 
						'heading' => 'Title',
						'type'=>'textfield',
						'group'=>'Title Settings'
					),
					array(
						'param_name'=>'link', 
						'heading'=>'More Projects Link (optional)',
						'type'=>'textfield',
						'group'=>'Title Settings'
					),
					array(
						'param_name'=>'link_title', 
						'heading'=>'More Projects Title (optional)',
						'type'=>'textfield',
						'group'=>'Title Settings'
					),
					array(
						'param_name'=>'maxnum', 
						'heading'=>'Maximum number of items',
						'type'=>'textfield'
					),
					array(
						'param_name'=>'spacing', 
						'heading'=>'Spacing between items', 
						'type'=>'dropdown',
						'value'=>array('Add spacing'=>'true', 'No spacing' =>'false')
					),
					array(
						'param_name'=>'orderby', 
						'heading'=>'Order items by', 
						'type'=>'dropdown',
						'value'=>array('Date'=>'date', 'Custom Order' =>'menu_order')
					),
					array(
						'param_name'=>'order', 
						'heading'=>'Order', 
						'type'=>'dropdown',
						'value'=>array('Descending'=>'DESC', 'Ascending' =>'ASC')
					),
					array(
						'param_name'=>'height', 
						'heading'=>'Thumbnail Height',
						'type'=>'textfield',
						'desc'=>'(Optional) Custom thumbnail height in pixels'
					)
				)
			),

			array(
				'name' => 'Services Boxes',
				'base' => 'pexservices',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'services-section.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
						array(
							'param_name' => 'set', 
							'heading' => 'Select services set',
							'type'=>'dropdown',
							'description'=>'You can create testimonials in '.PEXETO_THEMENAME.' &raquo; Services Boxes section.',
							'value'=>pexeto_vc_get_custom_page_set(PEXETO_SERVICES_POSTTYPE),
							'std'=>key(pexeto_vc_get_custom_page_set(PEXETO_SERVICES_POSTTYPE))
						),
						array(
							'param_name'=>'layout', 
							'heading'=>'Services Layout', 
							'type'=>'dropdown',
							'value'=>array('Default Style' => 'default' , 'Boxed Photo Style' => 'boxed-photo' , 'Icon Style' => 'icon' , 'Thumbnail Style' => 'thumbnail' , 'Full-width Grid' => 'fullbox' )
						),
						array(
							'param_name'=>'columns', 
							'heading'=>'Number of columns', 
							'type'=>'dropdown',
							'value'=>array('3', '2', '4'),
							'dependency'=>array(
								'element'=>'pex_attr_layout',
								'value'=>array('default', 'boxed-photo', 'icon', 'fullbox')
							)
						),
						array(
							'param_name'=>'parallax', 
							'heading'=>'Parallax animation on display', 
							'type'=>'dropdown',
							'value'=>array('disabled', 'enabled'),
							'dependency'=>array(
								'element'=>'pex_attr_layout',
								'value'=>array('default', 'boxed-photo', 'icon', 'thumbnail')
							)
						),
						array(
							'param_name'=>'bgcolor', 
							'heading' => 'Background Color', 
							'type' => 'colorpicker',
							'dependency'=>array(
								'element'=>'pex_attr_layout',
								'value'=>array('fullbox')
							)
						),
						array(
							'param_name'=>'textcolor', 
							'heading' => 'Text Color', 
							'type' => 'colorpicker',
							'dependency'=>array(
								'element'=>'pex_attr_layout',
								'value'=>array('fullbox')
							)
						),
						array(
							'param_name'=> 'title', 
							'heading' => 'Services Title',
							'type' => 'textfield',
							'group' => 'Title & Description'
						),
						array(
							'param_name'=> 'desc', 
							'heading' => 'Services Description',
							'type' => 'textarea',
							'group' => 'Title & Description'
						),
						array(
							'param_name'=> 'btntext', 
							'heading' => 'Description Link Text',
							'type' => 'textfield',
							'group' => 'Title & Description'
						),
						array(
							'param_name'=> 'btnlink', 
							'heading' => 'Description Link URL',
							'type' => 'textfield',
							'group' => 'Title & Description'
						)
					)
				),


			array(
				'name' => 'Fade Slider',
				'base' => 'pexnivoslider',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'slider-section.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
					array(
						'param_name' => 'sliderid', 
						'heading' => 'Name of slider',
						'type'=>'dropdown',
						'description'=>'You can create Fade sliders in the '.PEXETO_THEMENAME.' &raquo; Fade Slider section.',
						'value'=>pexeto_vc_get_custom_page_set(PEXETO_NIVOSLIDER_POSTTYPE, 'id'),
						'std'=>key(pexeto_vc_get_custom_page_set(PEXETO_NIVOSLIDER_POSTTYPE))
					)
				)
			),

			array(
				'name' => 'Content Slider',
				'base' => 'pexcontentslider',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'cs-slider-section.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
					array(
						'param_name' => 'sliderid', 
						'heading' => 'Name of slider',
						'type'=>'dropdown',
						'description'=>'You can create Content sliders in the '.PEXETO_THEMENAME.' &raquo; Content Slider section.',
						'value'=>pexeto_vc_get_custom_page_set(PEXETO_CONTENTSLIDER_POSTTYPE, 'id'),
						'std'=>key(pexeto_vc_get_custom_page_set(PEXETO_CONTENTSLIDER_POSTTYPE))
					)
				)
			),

			array(
				'name' => 'Pricing Table',
				'base' => 'pexpricetable',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'priceing-tables.png',
				'class'=>'pexeto-vc-icon',
				'params' => array(
					array(
						'param_name' => 'set', 
						'heading' => 'Select a pricing table',
						'type'=>'dropdown',
						'description'=>'You can create pricing tables in the '.PEXETO_THEMENAME.' &raquo; Pricing Tables section.',
						'value'=>pexeto_vc_get_custom_page_set(PEXETO_PRICING_POSTTYPE),
						'std'=>key(pexeto_vc_get_custom_page_set(PEXETO_PRICING_POSTTYPE))
					),
					array(
						'param_name'=>'columns', 
						'heading'=>'Number of columns', 
						'type'=>'dropdown',
						'value'=>array('3','2', '4')
					),
					array(
						'param_name'=>'color', 
						'heading' => 'Custom highlight color', 
						'type' => 'colorpicker'
					)
				)
			),

			array(
				'name' => 'Recent Blog Posts',
				'base' => 'pexblogposts',
				'category' => PEXETO_THEMENAME.' Elements',
				'icon' => $icons_url.'blog-section.png',
				'class'=>'pexeto-vc-icon',
				'params'=>array(
					array(
						'param_name' => 'cat', 
						'heading' => 'Show posts from category',
						'type'=>'dropdown',
						'value'=>pexeto_vc_get_cats()
					),
					array(
						'param_name'=>'layout', 
						'heading'=>'Layout', 
						'type'=>'dropdown',
						'value'=>array('Columns Layout' => 'columns' , 'List Layout' => 'list')
					),
					array(
						'param_name'=> 'number', 
						'heading' => 'Number of posts to display',
						'type' => 'textfield'
					),
					array(
						'param_name'=>'columns', 
						'heading'=>'Number of columns', 
						'type'=>'dropdown',
						'value'=>array('2','3','4'),
						'std' => '2',
						'dependency'=>array(
							'element'=>'pex_attr_layout',
							'value'=>array('columns')
						)
					)
				)
			)
	);

	foreach ($shortcodes as &$shortcode) {

		foreach ($shortcode['params'] as &$param) {
			if($param['param_name']!='content'){
				$param['param_name'] = $pfx.$param['param_name'];
			}
		}

		if($shortcode['base']!='bgsection'){
			//add a content element that adds empty content so that it can
			//generate a closing shortcode tag. The closing shortcode tag is needed
			//after switching to the classic editor mode, so that the shortcodes
			//can be recognised and displayed as visual shortcodes blocks
			$shortcode['params'][] = array(
				'param_name'=>'content', 
				'heading' => ' ', 
				'type' => 'pexeto_content',
				'value' => 'vc_content'
			);
			$shortcode['content_element'] = true;
		}

		vc_map($shortcode);
	}
}


if(!function_exists('pexeto_vc_get_custom_page_set')){
	function pexeto_vc_get_custom_page_set($post_type, $key_id = 'slug'){
		$sets = PexetoCustomPageHelper::get_created_sets($post_type, $key_id);
		$vc_sets = array();
		foreach ($sets as $set) {
			$vc_sets[$set['name']]=$set['id'];
		}
		return $vc_sets;
	}
}

if(!function_exists('pexeto_vc_get_portfolio_cats')){
	function pexeto_vc_get_portfolio_cats(){
		$portfolio_cats = pexeto_get_portfolio_categories();
		array_unshift( $portfolio_cats, array( 'id'=>'-1', 'name'=>'All categories' ) );
		$vc_cats = array();
		foreach ($portfolio_cats as $cat) {
			$vc_cats[$cat['name']]=$cat['id'];
		}
		return $vc_cats;
	}
}

if(!function_exists('pexeto_vc_get_cats')){
	function pexeto_vc_get_cats(){
		$cats = pexeto_get_categories();
		array_unshift( $cats, array( 'id'=>'-1', 'name'=>'All categories' ) );
		$vc_cats = array();
		foreach ($cats as $cat) {
			$vc_cats[$cat['name']]=$cat['id'];
		}
		return $vc_cats;
	}
}


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Bgsection extends WPBakeryShortCodesContainer {
    }
}

if(!function_exists('pexeto_content_settings_field')){
	function pexeto_content_settings_field($settings, $value) {
		return '<div class="pexeto_content_block">'
		.'<input name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '
		.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'.$value.'"/></div>';
	}
}

if(function_exists('add_shortcode_param')){
	add_shortcode_param('pexeto_content', 'pexeto_content_settings_field');
}

if(function_exists('vc_disable_frontend')){
	vc_disable_frontend();
}