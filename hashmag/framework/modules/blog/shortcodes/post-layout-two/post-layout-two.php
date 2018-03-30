<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostLayoutTwo;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostLayoutTwo
 */
class PostLayoutTwo extends ListShortcode
{

    /**
     * @var string
     */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_layout_two';
        $this->css_class = 'mkdf-pl-two';
        $this->shortcode_title = 'Mikado Post Layout 2';

        parent::__construct($this->base, $this->css_class, $this->shortcode_title);

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * add params for shortcode in next function
     * function gets $base for each shortcode
     *
     * @see hashmag_mikado_get_shortcode_params()
     */

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'title_tag' => 'h6',
            'title_length' => '',
            'display_date' => 'yes',/**/
            'display_comments' => 'no',/**/
            'display_count' => 'no',/**/
            'date_format' => 'F d',
            'display_excerpt' => 'no',
            'excerpt_length' => '20',
            'custom_thumb_image_width' => '80',
            'custom_thumb_image_height' => '80',
            'display_author' => 'no',
            'display_like' => 'no',
            'display_category' => 'no',
        );

        $params = shortcode_atts($args, $atts);
        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        if ($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-two', 'templates', '', $params);

            endwhile;
        else:
            $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

        return $html;
    }

    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: ' . hashmag_mikado_filter_px($params['custom_thumb_image_width']) . 'px';
        }

        return implode(';', $style);
    }
}