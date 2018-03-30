<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostLayoutSeven;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostLayoutSeven
 */
class PostLayoutSeven extends ListShortcode
{

    /**
     * @var string
     */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_layout_seven';
        $this->css_class = 'mkdf-pl-seven';
        $this->shortcode_title = 'Mikado Post Layout 7';

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
            'display_excerpt' => 'no',
            'excerpt_length' => '',
            'display_date' => 'yes',
            'date_format' => 'F d',
            'display_category' => 'yes',
            'display_author' => 'no',
            'display_comments' => 'yes',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',
            'display_post_type_icon' => 'yes',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_share' => 'no',
            'classic_slider' => 'no'
        );

        $params = shortcode_atts($args, $atts);
        $html = '';

        if ($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params);

            endwhile;
        else:
            $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

        return $html;
    }
}