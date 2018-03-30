<?php
namespace Flow\Modules\UnorderedList;

use Flow\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class unordered List
 */
class UnorderedList implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base='eltd_unordered_list';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**\
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' => 'List - Unordered',
			'base' => $this->base,
			'icon' => 'icon-wpb-unordered-list extended-custom-icon',
			'category' => 'by ELATED',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Circle' => 'circle',
						'Line'	 => 'line'
					),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Font Weight',
					'param_name' => 'font_weight',
					'value' => array(
						'Default' => '',
						'Light' => 'light',
						'Normal' => 'normal',
						'Bold' => 'bold'
					),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Padding left (px)',
					'param_name' => 'padding_left',
					'value' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>',
					'description' => ''
				)
			)
		) );

	}


	public function render($atts, $content = null) {
		$args = array(
            'style' => '',
            'font_weight' => '',
            'padding_left' => ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		
		$list_item_classes = "";

        if ($style != '') {
			if($style == 'circle'){
				$list_item_classes .= ' eltd-circle';
			}elseif ($style == 'line') {
				$list_item_classes .= ' eltd-line';
			}            
        }
		
		$list_style = '';
		if($padding_left != '') {
			$list_style .= 'padding-left: ' . $padding_left .'px;';
		}
		$html = '';
		
        $html .= '<div class="eltd-unordered-list '.$list_item_classes.'" '.  flow_elated_get_inline_style($list_style).'>';
		$html .= do_shortcode($content);
		$html .= '</div>';
        return $html;
	}

}