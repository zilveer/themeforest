<?php
namespace Hashmag\Modules\Blog\Shortcodes\BlockOne;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class BlockOne
 */
class BlockOne extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_block_one';
        $this->css_class = 'mkdf-pb-one';
        $this->shortcode_title = 'Mikado Block 1';

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
            'featured_display_author' => 'yes',
            'featured_display_comments' => 'yes',
            'featured_display_excerpt' => 'yes',
            'featured_excerpt_length' => '20',
            'featured_thumb_image_size' => '',
            'featured_thumb_image_width' => '',
            'featured_thumb_image_height' => '',
            'featured_display_post_type_icon' => 'no',
            'featured_display_share' => 'yes',
            'featured_display_count' => 'no',
            'featured_display_like' => 'no',
            'featured_display_featured_icon' => 'no',
        );

        $args = array(
            'title_tag' => 'h6',
            'title_length' => '',
            'display_date' => 'yes',
            'display_comments' => 'no',
            'display_count' => 'no',
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
        $params_featured = shortcode_atts($args_featured, $atts);

        $params_featured_filtered = hashmag_mikado_get_filtered_params($params_featured, 'featured');

        $html = '';

        $params['image_style'] = $this->getImageStyle($params);

        $loop_counter = 0;
        if ($atts['query_result']->have_posts()):

            $html .= '<div class="mkdf-bnl-inner">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $loop_counter++;

                if ($loop_counter == 1) {
                    $html .= '<div class="mkdf-post-block-part mkdf-pb-one-featured">';
                    //Get HTML from template
                    $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-one', 'templates', '', $params_featured_filtered);
                    $html .= '</div>';
                    $html .= '<div class="mkdf-post-block-part mkdf-pb-one-non-featured">';
                } else {
                    //Get HTML from template
                    $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-two', 'templates', '', $params);
                }

            endwhile;

            $html .= '</div>'; // close mkdf-pb-one-non-featured
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

        if (isset($params['block_proportion']) && $params['block_proportion'] !== '') {
            $holder_classes[] = $params['block_proportion'];
        }

        return $holder_classes;
    }

    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: ' . hashmag_mikado_filter_px($params['custom_thumb_image_width']) . 'px';
        }

        return implode(';', $style);
    }
}