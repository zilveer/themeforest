<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostLayoutThree;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostLayoutThree
 */
class PostLayoutThree extends ListShortcode
{

    /**
     * @var string
     */

    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_layout_three';
        $this->css_class = 'mkdf-pl-three';
        $this->shortcode_title = 'Mikado Post Layout 3';

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
            'title_tag' => 'h4',
            'title_length' => '',
            'display_category' => 'no',
            'display_comments' => 'yes',
            'display_date' => 'yes',
            'date_format' => 'F d',
            'display_author' => 'no',
            'display_excerpt' => 'yes',
            'excerpt_length' => '4',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',
            'display_count' => 'no',
            'display_like' => 'no'
        );

        $params = shortcode_atts($args, $atts);
        $html = '';

        if ($atts['query_result']->have_posts()):
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-three', 'templates', '', $params);

            endwhile;
        else:
            $html .= $this->errorMessage();

        endif;
        wp_reset_postdata();

        return $html;
    }
}