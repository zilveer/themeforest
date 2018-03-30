<?php
namespace Hashmag\Modules\Blog\Shortcodes\PostSliderClassic;

use Hashmag\Modules\Blog\Shortcodes\Lib\ListShortcode;

/**
 * Class PostSliderClassic
 */
class PostSliderClassic extends ListShortcode
{

    /**
     * @var string
     */
    private $base;
    private $css_class;
    private $shortcode_title;

    public function __construct() {
        $this->base = 'mkdf_post_slider_classic';
        $this->css_class = 'mkdf-psc';
        $this->shortcode_title = 'Mikado Post Slider Classic';

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
            'title_length' => '',
            'display_date' => 'yes',
            'date_format' => 'F d',
            'display_category' => 'yes',
            'display_author' => 'no',
            'display_comments' => 'yes',
            'thumb_image_size' => '',
            'thumb_image_width' => '',
            'thumb_image_height' => '',
            'display_excerpt' => 'no',
            'excerpt_length' => 'no',
            'display_post_type_icon' => 'yes',
            'display_count' => 'no',
            'display_like' => 'no',
            'display_share' => 'yes',
            'classic_slider' => 'yes'
        );

        $params = shortcode_atts($args, $atts);
        $params['slider_style'] = '';

        $html = '';

        if ($atts['query_result']->have_posts()):
            $html .= '<ul class="mkdf-psc-slides">';

            while ($atts['query_result']->have_posts()) : $atts['query_result']->the_post();
                $html .= '<li class="mkdf-psc-slide" ' . hashmag_mikado_inline_style($params['slider_style']) . '>';
                //Get HTML from template
                $html .= hashmag_mikado_get_list_shortcode_module_template_part('post-template-seven', 'templates', '', $params);
                $html .= '</li>';

            endwhile;

            $html .= '</ul>';
        else:
            $html .= $this->errorMessage();
        endif;

        wp_reset_postdata();

        return $html;
    }

    protected function getAdditionalClasses($params) {

        $holderClasses = array();

        if ($params['number_of_posts'] !== '') {
            $holderClasses[] = 'mkdf-psc-number-' . $params['number_of_posts'];
        }

        if ($params['display_navigation'] == 'yes') {
            $holderClasses[] = 'mkdf-psc-navigation';
        }

        if ($params['display_paging'] == 'yes') {
            $holderClasses[] = 'mkdf-psc-pagination';
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