<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostLayoutSix;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostLayoutSix
 */
class PostLayoutSix extends ListShortcode
{

    /**
     * @var string
     */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_layout_six';
        $this->css_class = 'mkdf-pl-six';
        $this->shortcode_title = 'Mikado Post Layout 6';

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
            'title_tag' => 'h2',
            'title_length' => '',
            'display_date' => 'yes',
            'display_author' => 'no',
            'display_comments' => 'yes',
            'display_share' => 'no',
            'display_count' => 'no',
            'date_format' => 'F d',
            'display_excerpt' => 'yes',
            'excerpt_length' => '20',
            'custom_thumb_image_width' => '360',
            'custom_thumb_image_height' => '240',
            'display_like' => 'no',
            'display_category' => 'no',
            'display_featured_icon' => 'no',
        );

        $params = shortcode_atts($args, $atts);
        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        if ($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-six', 'templates', '', $params);

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