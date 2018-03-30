<?php
namespace QodeStartit\Modules\Message;

use QodeStartit\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Message
 */
class Message implements ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'qodef_message';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
	public function vcMap() {
						
		vc_map( array(
			'name' => 'Select Message',
			'base' => $this->base,
			'category' => 'by SELECT',
			'icon' => 'icon-wpb-message extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Type',
						'param_name' => 'type',
						'value' => array(
							'Normal' => 'normal',
							'With Icon' => 'with_icon'
						),
						'save_always' => true
					)
				),
				\QodeStartitIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => '',
						'dependency' => Array('element' => 'type', 'value' => array('with_icon'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Background Color',
						'param_name' => 'icon_background_color',
						'description' => '',
						'dependency' => Array('element' => 'type', 'value' => array('with_icon'))
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Close Icon Color',
						'param_name' => 'close_icon_color',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Background Color',
						'param_name' => 'background_color',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Border Color',
						'param_name' => 'border_color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Border Width (px)',
						'param_name' => 'border_width',
						'description' => 'Default value is 0'
					),
					array(
						'type' => 'textarea_html',
						'heading' => 'Content',
						'param_name' => 'content',
						'value' => '<p>'.'I am test text for Message shortcode.'.'</p>',
						'description' => ''
					)
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'type' => '',
            'background_color' => '',
            'close_icon_color' => '',
            'border_color' => '',
            'border_width' => '',
            'icon_size' => '',
            'icon_custom_size' => '',
            'icon_color' => '',
            'icon_background_color' => ''
        );
		
		$args = array_merge($args, qode_startit_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);
		$params['content']= $content;

		//Extract params for use in method
		extract($params);
		//Get HTML from template based on type of team
		$iconPackName = qode_startit_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$message_classes = '';
		
		if ($params['type'] == 'with_icon') {
			$message_classes .= ' qodef-with-icon';
		}
		$params['close_icon_styles'] = $this->getClosIconStyle($params);
		$params['message_classes'] = $message_classes;
		$params['message_styles'] = $this->getHolderStyle($params);
		$params['icon'] = $params[$iconPackName];
		$params['icon_styles'] = $this->getIconStyle($params);
		
		$html = qode_startit_get_shortcode_module_template_part('templates/message-holder-template', 'message', '', $params);
		
		return $html;
	}
	/**
     * Generates message icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		$iconStyles = array();

        if(!empty($params['icon_color'])) {
            $iconStyles[] = 'color: '.$params['icon_color'];
        }

        if(!empty($params['icon_background_color'])) {
            $iconStyles[] = 'background-color:'.$params['icon_background_color'].'';
        }

		$iconStyles['icon_attributes']['style'] = implode(';', $iconStyles);

        return $iconStyles;
	}
	 /**
     * Generates message holder styles
     *
     * @param $params
     *
     * @return array
     */
	private function getHolderStyle($params){
		$holderStyles = array();
		
		if(!empty($params['background_color'])) {
            $holderStyles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $holderStyles[] = 'border-color:'.$params['border_color'].'';
        }
		if(!empty($params['border_width'])) {
            $holderStyles[] = 'border-width:'.$params['border_width'].'px';
		}

        return implode(';', $holderStyles);
	}

	private function getClosIconStyle($params) {

		$closeIconStyles = array();

		if(!empty($params['close_icon_color'])) {
			$closeIconStyles[] = 'color: ' . $params['close_icon_color'];
		}

		return implode(';', $closeIconStyles);
	}
}