<?php
namespace Hashmag\Modules\Blog\Shortcodes\BlockFour;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class BlockFour
 */
class BlockFour extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_block_four';
        $this->css_class = 'mkdf-pb-four';
        $this->shortcode_title = 'Mikado Block 4';

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
            'featured_display_excerpt' => '',
            'featured_excerpt_length' => '',
            'featured_display_date' => 'yes',
            'featured_date_format' => 'F d',
            'featured_display_category' => 'yes',
            'featured_display_author' => 'no',
            'featured_display_comments' => 'yes',
            'featured_thumb_image_size' => 'custom',
            'featured_thumb_image_width' => '854',
            'featured_thumb_image_height' => '458',
            'featured_display_post_type_icon' => 'no',
            'featured_display_share' => 'yes',
            'featured_display_count' => 'no',
            'featured_display_like' => 'no',
            'featured_classic_slider' => 'no',
        );

        $args = array(
            'title_tag' => 'h4',
            'title_length' => '',
            'custom_thumb_image_width' => '514',
            'custom_thumb_image_height' => '540',
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
                    $html .= '<div class="mkdf-pb-four-part mkdf-pb-four-center">';
                    $html .= '<div class="mkdf-post-item-holder">';
                    //Get HTML from template
                    $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params_featured_filtered);
                    $html .= '</div>'; // closing mkdf-post-item-holder
                    $html .= '</div>'; // closing mkdf-pb-four-part mkdf-pb-four-center
                    $html .= '<div class="mkdf-pb-four-part mkdf-pb-four-left">';
                } elseif ($loop_counter > 1 && $loop_counter <= 5) {
                    //Get HTML from template
                    $html .= hashmag_mikado_get_list_shortcode_module_template_part('templates/post-block-four-template', 'block-four', '', $params);

                    if ($loop_counter == 5) {
                        $html .= '</div>';
                        $html .= '<div class="mkdf-pb-four-part mkdf-pb-four-right">';
                    }
                } else {
                    //Get HTML from template
                    $html .= hashmag_mikado_get_list_shortcode_module_template_part('templates/post-block-four-template', 'block-four', '', $params);
                }

            endwhile;

            $html .= '</div>'; // close mkdf-post-block-part mkdf-pb-four-right

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

    protected function overwriteSettings(&$params) {
        $params['number_of_posts'] = '9';
    }

    private function getImageStyle($params) {
        $style = array();

        if ($params['custom_thumb_image_width'] !== '') {
            $style[] = 'width: ' . hashmag_mikado_filter_px($params['custom_thumb_image_width']) . 'px';
        }

        return implode(';', $style);
    }
}