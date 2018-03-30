<?php

namespace Hue\Modules\Shortcodes\CardsGallery;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CardsGallery
 */
class CardsGallery implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * ZoomingSlider constructor.
	 */
	public function __construct() {
		$this->base = 'mkd_cards_gallery';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Cards Gallery', 'hue'),
			'base'                      => $this->base,
			'category'                  => 'by MIKADO',
			'icon'                      => 'icon-wpb-cards-gallery extended-custom-icon',
            'allowed_container_element' => 'vc_row',
			'params'                    => array(
                array(
                    'type'        => 'attach_images',
                    'heading'     => esc_html__('Images', 'hue'),
                    'param_name'  => 'images',
                    'description' => esc_html__('Select images from media library', 'hue')
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Cards Background Color', 'hue'),
                    'param_name'  => 'background_color'
                )
            )
		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
        $args = array(
            'images' => '',
            'background_color' => ''
        );

        $params = shortcode_atts($args, $atts);
        $params['images'] = $this->getGalleryImages($params);
        if($params['background_color'] !== ''){
            $params['background_color'] = 'background-color:'.$params['background_color'];
        }

		return hue_mikado_get_shortcode_module_template_part('templates/cards-gallery', 'cards-gallery', '', $params);
	}

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id'] = $id;
            $image_original    = wp_get_attachment_image_src($id, 'full');
            $image['url']      = $image_original[0];
            $image['title']    = get_the_title($id);
            $image['image_link'] = get_post_meta($id, 'attachment_image_link', true);
            $image['image_target'] = get_post_meta($id, 'attachment_image_target', true);

            $image_dimensions = hue_mikado_get_image_dimensions($image['url']);
            if(is_array($image_dimensions) && array_key_exists('height', $image_dimensions)) {

                if(!empty($image_dimensions['height']) && $image_dimensions['width']) {
                    $image['height'] = $image_dimensions['height'];
                    $image['width']  = $image_dimensions['width'];
                }
            }

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }
}