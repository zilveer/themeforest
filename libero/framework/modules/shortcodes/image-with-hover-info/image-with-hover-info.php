<?php
namespace Libero\Modules\ImageWithHoverInfo;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class ImageWithHoverInfo
 */
class ImageWithHoverInfo implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_image_with_hover_info';

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
	 */
	public function vcMap() {

		vc_map( array(
				'name' => 'Mikado Image With Hover Info',
				'base' => $this->getBase(),
				'category' => 'by MIKADO',
				'icon' => 'icon-wpb-image-with-text-hover extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type'       => 'attach_image',
						'heading'    => 'Image',
						'param_name' => 'image'
					),
					array(
						"type" => "textarea_html",
						"heading" => "Hover Info",
						"param_name" => "content",
						"description" => "Add content to be displayed on hover. You can use shortcodes."
					),
					array(
						"type" => "textfield",
						"heading" => "Link",
						"param_name" => "link",
						"save_always" => true,
						"description" => "Add a URL to link to."
					)
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'image' => '',
			'hover_info' => '',
			'link' => 'http://'
		);

		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/image-with-hover-info-template', 'image-with-hover-info', '', $params);

		return $html;

	}

}