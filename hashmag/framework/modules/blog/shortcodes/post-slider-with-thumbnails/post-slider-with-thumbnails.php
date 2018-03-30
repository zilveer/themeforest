<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostSliderWithThumbnails;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;
/**
 * Class PostSliderWithThumbnails
 */
class PostSliderWithThumbnails extends ListShortcode {

	/**
	 * @var string
	 */
    private $base;
    private $css_class;
    private $shortcode_title;

	public function __construct() {
		$this->base = 'mkdf_post_slider_with_thumbnails';
        $this->css_class = 'mkdf-pswt';
        $this->shortcode_title = 'Mikado Post Slider With Thumbnails';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
	}

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     *
     * @see hashmag_mikado_get_shortcode_params()
     */

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
            'title_tag' => 'h2',
            'display_category' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'F d',
            'display_comments' => 'yes',
            'display_like' => 'no',
            'display_author' => 'no',
            'display_count' => 'no',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => ''
		);

		$params = shortcode_atts($args, $atts);
        $html = '';
        $thumb_html = '';

        if($atts['query_result']->have_posts()):
        	$html .= '<div class="mkdf-pswt-slider">';
            $html .= '<ul class="mkdf-pswt-slides">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('templates/post-slider-with-thumbnails-template', 'post-slider-with-thumbnails', '', $params);
                $thumb_html .= hashmag_mikado_get_list_shortcode_module_template_part('templates/post-slider-thumbnails-template', 'post-slider-with-thumbnails', '', $params);

            endwhile;

            $html .= '</ul>';
            $html .= '</div>';
            else:
                $html .= $this->errorMessage();

        endif;

		if ($thumb_html !== ''){
			$html .= '<ul class="mkdf-pswt-slides-thumb">';
			$html .= $thumb_html;
			$html .= '</ul>';
		}

        wp_reset_postdata();

        return $html;
	}

    protected function getAdditionalClasses($params) {

        $holderClasses = array();

        if ($params['number_of_posts'] !== '') {
            $holderClasses[] = 'mkdf-pswt-number-'.$params['number_of_posts'];
        }

        return $holderClasses;
    }

    /**
     * Enabling inner holder in shortcode if layout is used,
     * because block has its own inner holder
     *
     * @return boolean
     */
    protected function isBlockElement() {
        return true;
    }
}