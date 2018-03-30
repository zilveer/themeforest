<?php
namespace Libero\Modules\Shortcodes\InteractiveBanner;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class InteractiveBanner
 */
class InteractiveBanner implements ShortcodeInterface
{
	/**
	 * Interactive Banner constructor.
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_interactive_banner';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap()	{

		vc_map( array(
			'name' => 'Mikado Interactive Banner',
			'base' => $this->base,
			'category' => 'by MIKADO',
			'icon' => 'icon-wpb-interactive-banner extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>  array_merge(
                libero_mikado_icon_collections()->getVCParamsArray(),
                array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Type',
                        'param_name'  => 'icon_type',
                        'value'       => array(
                            'Default' => '',
                            'Normal' => 'normal',
                            'Circle' => 'circle',
                            'Square' => 'square'
                        ),
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => 'Icon Size',
                        'param_name'  => 'icon_size',
                        'value'       => array(
                        	'Default'    => '',
                            'Tiny'       => 'mkd-icon-tiny',
                            'Small'      => 'mkd-icon-small',
                            'Medium'     => 'mkd-icon-medium',
                            'Large'      => 'mkd-icon-large',
                            'Very Large' => 'mkd-icon-huge'
                        ),
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Icon Margin',
                        'param_name'  => 'icon_margin',
                        'value'       => '',
                        'description' => 'Margin should be set in a top right bottom left format',
                        'admin_label' => true,
                        'group'       => 'Icon Settings',
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => 'Shape Size (px)',
                        'param_name'  => 'shape_size',
                        'description' => '',
                        'admin_label' => true,
                        'group'       => 'Icon Settings'
                    ),
                    array(
                        'type'       => 'colorpicker',
                        'heading'    => 'Icon Color',
                        'param_name' => 'icon_color',
                        'group'      => 'Icon Settings'
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => 'Icon Background Color',
                        'param_name'  => 'icon_background_color',
                        'description' => 'Icon Background Color',
                        'dependency'  => array('element' => 'icon_type', 'value' => array('square', 'circle','')),
                        'group'       => 'Icon Settings'
                    ),
					array(
						'type' => 'attach_image',
						'heading' => 'Image',
						'param_name' => 'image'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'admin_label' => true,
						'param_name' => 'title'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Title Tag',
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'dependency' => array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Subtitle',
						'admin_label' => true,
						'param_name' => 'subtitle'
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Subtitle Color',
						'param_name' => 'subtitle_color',
						'dependency' => array('element' => 'subtitle', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Text Holder Background Color',
						'param_name' => 'holder_background_color'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
						'description' => 'Enter a URL to link to.'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link text',
						'param_name' => 'link_text',
						'value' => 'See Success Rates',
						'dependency' => array('element' => 'link', 'not_empty' => true)
					)
				)
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null)
	{

		$default_atts = array(
			'icon_type'                   => 'circle',
			'icon_size'                   => 'mkd-icon-small',
			'custom_icon_size'            => '',
			'icon_margin'                 => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_background_color'       => '',
			'image' => '',
			'title' => '',
			'title_tag' => 'h3',
			'title_color' => '',
			'subtitle' => '',
			'subtitle_color' => '',
			'holder_background_color' => '',
			'link' => '',
			'link_text' => 'See Success Rates',
		);

		$default_atts = array_merge($default_atts, libero_mikado_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);

		$params['icon_parameters'] = $this->getIconParameters($params);

		$params['title_tag'] = $this->getInteractiveBannerTitleTag($params, $atts);
		$params['title_style'] = $this->getInteractiveBannerTitleStyle($params);
		$params['subtitle_style'] = $this->getInteractiveBannerSubtitleStyle($params);
		$params['interactive_banner_classes'] = $this->getInteractiveBannerClasses($params);
		$params['text_holder_style'] = $this->getInteractiveBannerHolderStyle($params);

		//Get HTML from template 
		$html = libero_mikado_get_shortcode_module_template_part('templates/interactive-banner-template', 'interactive-banner', '', $params);

		return $html;

	}

	/**
	 * Returns parameters for icon shortcode as a string
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconParameters($params) {
	    $params_array = array();

	        $iconPackName = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

	        $params_array['icon_pack']   = $params['icon_pack'];
	        $params_array[$iconPackName] = $params[$iconPackName];

	        if(!empty($params['icon_size'])) {
	            $params_array['size'] = $params['icon_size'];
	        }

	        if(!empty($params['custom_icon_size'])) {
	            $params_array['custom_size'] = $params['custom_icon_size'];
	        }

	        if(!empty($params['icon_type'])) {
	            $params_array['type'] = $params['icon_type'];
	        }

	        $params_array['shape_size'] = $params['shape_size'];

	        if(!empty($params['icon_background_color'])) {
	            $params_array['background_color'] = $params['icon_background_color'];
	        }

	        $params_array['icon_color'] = $params['icon_color'];

	        $params_array['margin'] = $params['icon_margin'];

	    return $params_array;
	}


	/**
	 * Return correct heading value. If provided heading isn't valid get the default one
	 *
	 * @param $params
	 * @return mixed
	 */
	private function getInteractiveBannerTitleTag($params, $args) {

		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
		return (in_array($params['title_tag'], $headings_array)) ? $params['title_tag'] : $args['title_tag'];

	}

	/**
	 * Return Title style
	 *
	 * @param $params
	 * @return string
	 */
	private function getInteractiveBannerTitleStyle($params){
		$title_style = array();

		if($params['title_color'] !== ''){
			$title_style[] = 'color: '.$params['title_color'];
		}

		return implode('; ', $title_style);
	}


	/**
	 * Return Subitle style
	 *
	 * @param $params
	 * @return string
	 */
	private function getInteractiveBannerSubtitleStyle($params){
		$subtitle_style = array();

		if($params['subtitle_color'] !== ''){
			$subtitle_style[] = 'color: '.$params['subtitle_color'];
		}

		return implode('; ', $subtitle_style);
	}


	/**
	 * Return Text Holder style
	 *
	 * @param $params
	 * @return string
	 */
	private function getInteractiveBannerHolderStyle($params){
		$holder_style = array();

		if($params['holder_background_color'] !== ''){
			$holder_style[] = 'background-color: '.$params['holder_background_color'];
		}

		return implode('; ', $holder_style);
	}



	/**
	 * Return Interactive banner classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getInteractiveBannerClasses($params) {

		$interactive_banner_classes = array();

		if ($params['link'] !== '') {
			$interactive_banner_classes[] = 'linked';
		}

		return implode(' ', $interactive_banner_classes);

	}

}