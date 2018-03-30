<?php
namespace Hashmag\Modules\SectionTitle;

use Hashmag\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class ExpandingVideoPost
 */
class SectionTitle implements ShortcodeInterface{
    /**
     * @var string
     */
	private $base;

	function __construct() {
		$this->base = 'mkdf_section_title';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /*
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     */

	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('Mikado Section Title', 'hashmag'),
            'base' => $this->getBase(),
			'icon' => 'icon-wpb-section-title extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params' => array(
                array(
                    'type'       => 'textfield',
                    'heading'    => 'Title',
                    'param_name' => 'title',
                    'description' => ''
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Title Tag',
                    'param_name' => 'title_tag',
                    'value' => array(
                        'Default'   => '',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6',
                    ),
                    'description' => '',
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => 'Title skin',
                    'param_name' => 'title_skin',
                    'value' => array(
                        'Default (Dark)'   => '',
                        'Light' => 'light',
                    ),
                    'description' => '',
                    'dependency' => array('element' => 'title', 'not_empty' => true),
                )
			)
		) );

	}

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'title' => '',
            'title_tag' => 'h5',
            'title_skin' => ''
        );

        $params = shortcode_atts($args, $atts);
        $params['holder_classes'] = $this->getHolderClasses($params);

        //Get HTML from template
        $html = hashmag_mikado_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);

        return $html;
    }

    /**
     * Generates posts class string
     *
     * @param $params
     *
     * @return string
     */
    private function getHolderClasses($params) {

        $holder_classes = array();

        if (isset($params['title_skin']) && $params['title_skin'] == 'light') {
            $holder_classes[] = 'mkdf-st-light';
        }

        return implode(' ', $holder_classes);
    }
}