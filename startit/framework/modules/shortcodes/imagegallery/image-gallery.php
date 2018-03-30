<?php
namespace QodeStartit\Modules\Shortcodes\ImageGallery;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageGallery implements ShortcodeInterface{

	private $base;

	/**
	 * Image Gallery constructor.
	 */
	public function __construct() {
		$this->base = 'qodef_image_gallery';

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
	public function vcMap() {

		vc_map(array(
			'name'                      => 'Select Image Gallery',
			'base'                      => $this->getBase(),
			'category'                  => 'by SELECT',
			'icon' 						=> 'icon-wpb-image-gallery extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'			=> 'attach_images',
					'heading'		=> 'Images',
					'param_name'	=> 'images',
					'description'	=> 'Select images from media library'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Image Size',
					'param_name'	=> 'image_size',
					'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Gallery Type',
					'admin_label' => true,
					'param_name'  => 'type',
					'value'       => array(
						'Slider'		=> 'slider',
						'Image Grid'	=> 'image_grid'
					),
					'description' => 'Select gallery type',
					'save_always' => true
				),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Image Frame',
                    'admin_label' => true,
                    'param_name'  => 'image_frame',
                    'value'       => array(
                        'No'	=> 'no',
                        'Yes'	=> 'yes'
                    ),
                    'description' => 'Adds frame around image slider',
                    'save_always' => true,
                    'dependency'	=> array(
                        'element'	=> 'type',
                        'value'		=> array(
                            'slider'
                        )
                    )
                ),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Image Space',
					'admin_label' => true,
					'param_name'  => 'image_space',
					'value'       => array(
						'Yes'		=> 'yes',
						'No'	=> 'no'
					),
					'description' => 'Images space',
					'save_always' => true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'image_grid'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slide duration',
					'admin_label'	=> true,
					'param_name'	=> 'autoplay',
					'value'			=> array(
						'3'			=> '3',
						'5'			=> '5',
						'10'		=> '10',
						'Disable'	=> 'disable'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'slider'
						)
					),
					'description' => 'Auto rotate slides each X seconds',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Slide Animation',
					'admin_label'	=> true,
					'param_name'	=> 'slide_animation',
					'value'			=> array(
						'Slide'		=> 'slide',
						'Fade'		=> 'fade',
						'Fade Up'	=> 'fadeUp',
						'Back Slide'=> 'backSlide',
						'Go Down'	=> 'goDown'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'slider'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Column Number',
					'param_name'	=> 'column_number',
					'value'			=> array(2, 3, 4, 5),
					'save_always'	=> true,
					'dependency'	=> array(
						'element' 	=> 'type',
						'value'		=> array(
							'image_grid'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Open PrettyPhoto on click',
					'param_name'	=> 'pretty_photo',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes'
					),
					'save_always'	=> true,
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Grayscale Images',
					'param_name' => 'grayscale',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element'	=> 'type',
						'value'		=> array(
							'image_grid'
						)
					)
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Navigation Arrows',
					'param_name' 	=> 'navigation',
					'value' 		=> array(
						'Yes'		=> 'yes',
						'No'		=> 'no'
					),
					'dependency' 	=> array(
						'element' => 'type',
						'value' => array(
							'slider'
						)
					),
					'save_always'	=> true
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Pagination',
					'param_name' 	=> 'pagination',
					'value' 		=> array(
						'Yes' 		=> 'yes',
						'No'		=> 'no'
					),
					'save_always'	=> true,
					'dependency'	=> array(
						'element' => 'type',
						'value' => array(
							'slider'
						)
					)
				)
			)
		));

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'images'			=> '',
			'image_size'		=> 'thumbnail',
			'type'				=> 'slider',
			'autoplay'			=> '5000',
			'slide_animation'	=> 'slide',
			'pretty_photo'		=> '',
			'column_number'		=> '',
			'grayscale'			=> '',
			'navigation'		=> 'yes',
			'pagination'		=> 'yes',
			'image_space'		=> 'image_space',
			'image_frame'		=> 'no'
		);

		$params = shortcode_atts($args, $atts);
		$params['slider_data'] = $this->getSliderData($params);
		$params['image_size'] = $this->getImageSize($params['image_size']);
		$params['images'] = $this->getGalleryImages($params);
		$params['pretty_photo'] = ($params['pretty_photo'] == 'yes') ? true : false;
		$params['columns'] = 'qodef-gallery-columns-' . $params['column_number'];
		$params['gallery_classes'] = ($params['grayscale'] == 'yes') ? 'qodef-grayscale' : '';
		$params['gallery_classes'] = ($params['image_space'] == 'no') ? 'qodef-no-space' : '';
		$params['slider_gallery_classes'] = $this->getGalleryClasses($params);

		if ($params['type'] == 'image_grid') {
			$template = 'gallery-grid';
		} elseif ($params['type'] == 'slider') {
			$template = 'gallery-slider';
		}

		$html = qode_startit_get_shortcode_module_template_part('templates/' . $template, 'imagegallery', '', $params);

		return $html;

	}

	/**
	 * Return images for gallery
	 *
	 * @param $params
	 * @return array
	 */
	private function getGalleryImages($params) {

		$images = array();

		if ($params['images'] !== '') {

			$size = $params['image_size'];
			$image_ids = explode(',', $params['images']);

			foreach ($image_ids as $id) {

				$img = wp_get_attachment_image_src($id, $size);

				$image['url'] = $img[0];
				$image['width'] = $img[1];
				$image['height'] = $img[2];
				$image['title'] = get_the_title($id);

				$images[] = $image;

			}

		}

		return $images;

	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {

		//Remove whitespaces
		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( !empty($matches[0]) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} elseif ( in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') )) {
			return $image_size;
		} else {
			return 'thumbnail';
		}

	}

	/**
	 * Return all configuration data for slider
	 *
	 * @param $params
	 * @return array
	 */
	private function getSliderData($params) {

		$slider_data = array();

		$slider_data['data-autoplay'] = ($params['autoplay'] !== '') ? $params['autoplay'] : '';
		$slider_data['data-animation'] = ($params['slide_animation'] !== '') ? $params['slide_animation'] : '';
		$slider_data['data-navigation'] = ($params['navigation'] !== '') ? $params['navigation'] : '';
		$slider_data['data-pagination'] = ($params['pagination'] !== '') ? $params['pagination'] : '';

		return $slider_data;

	}

    /**
     * Return classes for gallery
     *
     * @param $params
     * @return string
     */
    private function getGalleryClasses($params) {

        $classes = '';



        if ($params['image_frame'] == 'yes') {

            $classes .= ' qodef-image-frame qodef-frame-5';
        }

        return $classes;

    }

}