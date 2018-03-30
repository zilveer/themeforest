<?php
namespace Hashmag\Modules\Blog\Shortcodes\BlockThree;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class BlockThree
 */
class BlockThree extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_block_three';
        $this->css_class = 'mkdf-pb-three';
        $this->shortcode_title = 'Mikado Block 3';

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
     * @return string
     */
    public function render($atts, $content = null) {

        $args_featured = array(
            'featured_title_tag' => 'h2',
            'featured_title_length' => '',
            'featured_display_date' => 'yes',
            'featured_date_format' => 'F d',
            'featured_display_category' => 'yes',
            'featured_display_author' => 'no',
            'featured_display_comments' => 'yes',
            'featured_display_like' => 'no',
            'featured_display_excerpt' => 'no',
            'featured_excerpt_length' => '20',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '1300',
            'featured_thumb_image_height' => '500',
            'featured_display_share' => 'yes',
            'featured_display_count' => 'no'
        );

        $args = array(
            'title_tag' => 'h4',
            'title_length' => '',
            'display_date' => 'no',
            'display_comments' => 'no',
            'date_format' => 'F d',
            'display_author' => 'no',
            'display_category' => 'yes',
            'display_count' => 'no',
            'display_like' => 'no'
        );

        $params = shortcode_atts($args, $atts);
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = hashmag_mikado_get_filtered_params($params_featured, 'featured');

        $html = '';

        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkdf-bnl-inner">';
            $html .= '<div class="mkdf-post-block-part mkdf-pb-three-featured mkdf-pbr-featured">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= '<div class="mkdf-post-block-part-inner">';
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-block-three-template', 'templates', '', $params_featured_filtered);
                $html .= '</div>'; // close mkdf-post-block-part-inner


            endwhile;
            $html .= '</div>'; // close mkdf-pb-three-featured

            $html .= '<div class="mkdf-post-block-part mkdf-pb-three-non-featured mkdf-pbr-non-featured">';
            $html .= '<div class="mkdf-pbr-non-featured-inner">';
            $html .= '<div class="mkdf-post-item-outer">';
            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();

                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-four', 'templates', '', $params);

            endwhile;
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>'; // close mkdf-pb-three-non-featured

            $html .= '</div>'; // close mkdf-bnl-inner

        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
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

    protected function getAdditionalClasses($params) {
        $holder_classes = array();

        $holder_classes[] = 'mkdf-block-revealing';

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
        }

        return $holder_classes;
    }
}