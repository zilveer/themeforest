<?php
namespace SupremaQodef\Modules\Shortcodes\InteractiveBanner;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class InteractiveBanner
 */
class InteractiveBanner implements ShortcodeInterface
{
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'qodef_interactive_banner';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see qode_core_get_carousel_slider_array_vc()
	 */
	public function vcMap()	{

		vc_map( array(
			'name' => 'Interactive Banner',
			'base' => $this->base,
			'category' => 'by SELECT',
			'icon' => 'icon-wpb-interactive-banners extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'attach_image',
						'heading' => 'Image',
						'param_name' => 'image'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'admin_label' => true,
						'param_name' => 'title',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Background Color',
						'param_name' => 'title_background_color',
						'description' => ''
					),
					array(
                		'type' => 'dropdown',
                		'heading' => 'Hover Type',
                		'param_name' => 'hover_type',
                		'value' => array(
                			'Fade' => 'fade',
                			'Diagonal' => 'diagonal',
                			'Image Zoom' => 'image_zoom',
                		),
                		'admin_label' => true,
						'save_always' => true,
                		'description' => ''
                	),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
						'description' => '',
						'admin_label' 	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Target',
						'param_name' => 'target',
						'value' => array(
								'' => '',
								'Self' => '_self',
								'Blank' => '_blank'
						),
						'description' => ''
					),
				)
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null){

		$args = array(
			'image' => '',
			'title' => '',
			'link' => '',
			'target' => '_self',
			'title_background_color' => '',
			'title_color' => '',
			'hover_type' => 'fade'
		);


		$args = array_merge($args);

		$params = shortcode_atts($args, $atts);

		$params['image_src'] = $this->getImage($params);
		$params['title_style'] = $this->getTitleStyle($params);
		$params['classes'] = $this->getInteractiveBannerClasses($params);


		//Get HTML from template based on type of interactive banner
		$html = suprema_qodef_get_shortcode_module_template_part('templates/info-over', 'interactive-banner', '', $params);

		return $html;

	}

	/**
    * Generates interactive banner classes
    *
    * @param $params
    *
    * @return string
    */
	public function getInteractiveBannerClasses($params){
		$classes = array();
		
		if($params['hover_type'] != '') {
			switch ($params['hover_type']):
				case 'fade':
					$classes[] = 'qodef-fade-hover';
				break;
				case 'diagonal':	
					$classes[] = 'qodef-diagonal-hover';
				break;
				case 'image_zoom':
					$classes[] = 'qodef-image-zoom-hover';
				break;
			endswitch;
		}

		return implode(' ',$classes);
        
	}	


	/**
	 * Return  image
	 *
	 * @param $params
	 * @return false|string
	 */
	private function getImage($params) {

		if (is_numeric($params['image'])) {
			$image_src = wp_get_attachment_url($params['image']);
		} else {
			$image_src = $params['image'];
		}
		return $image_src;

	}

	/**
	 * Generates title holder styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getTitleStyle($params){
		$titleStyle = array();

		if(!empty($params['title_background_color'])) {
			$titleStyle[] = 'background-color: '.$params['title_background_color'];
		}

		if(!empty($params['title_color'])) {
			$titleStyle[] = 'color: '.$params['title_color'];
		}

		return $titleStyle;
	}


}