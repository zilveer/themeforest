<?php
namespace Libero\Modules\SocialShare;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

class SocialShare implements ShortcodeInterface {

	private $base;
	private $socialNetworks;

	function __construct() {
		$this->base = 'mkd_social_share';
		$this->socialNetworks = array(
			'facebook',
			'twitter',
			'google_plus',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function getSocialNetworks() {
		return $this->socialNetworks;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map(array(
			'name' => 'Mikado Social Share',
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-social-share extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Type',
					'param_name' => 'type',
					'admin_label' => true,
					'description' => 'Choose type of Social Share',
					'value' => array(
						'List' => 'list',
						'Dropdown' => 'dropdown'
					),
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Icons Type',
					'param_name' => 'icon_type',
					'admin_label' => true,
					'description' => 'Choose type of Icons',
					'value' => array(
						'Normal' => 'normal',
						'Circle' => 'circle'
					),
					'save_always' => true
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Icons Color',
					'param_name' => 'icons_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Icons Hover Color',
					'param_name' => 'icons_hover_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Text Color',
					'param_name' => 'text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Border Color',
					'param_name' => 'border_color',
					'dependency' => array('element' => 'type', 'value' => array('list'))
				),
				array(
					'type' => 'textfield',
					'heading' => 'Number of Icons Shown',
					'param_name' => 'no_shown',
					'description' => 'Enter number of social icons to show (icons shown are the ones enabled globaly)',
					'dependency' => array('element' => 'type', 'value' => array('list'))
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type'				=> 'list',
			'icon_type'			=> 'normal',
			'icons_color'		=> '',
			'icons_hover_color'	=> '',
			'text_color'		=> '',
			'border_color'		=> '',
			'links_showing'		=> '',
			'no_shown'			=> ''
		);

		//Shortcode Parameters
		$params = shortcode_atts($args, $atts);

		//Is social share enabled
		$params['enable_social_share'] = (libero_mikado_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

		//Is social share enabled for post type
		$post_type = get_post_type();
		$params['enabled'] = (libero_mikado_options()->getOptionValue('enable_social_share_on_'.$post_type)) ? true : false;

		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams($params);

		$html = '';

		if ($params['enable_social_share']) {
			if ($params['enabled']) {
				$html .= libero_mikado_get_shortcode_module_template_part('templates/' . $params['type'], 'socialshare', '', $params);
			}
		}

		return $html;

	}


	/**
	 * Get Social Icons style
	 * return string
	 *
	 */

	private function getSocialIconStyle($params){
		$icons_style = '';
		if ($params['icons_color'] !== ''){
			$icons_style .= libero_mikado_get_inline_style('color: '.$params['icons_color']).' ';
		}

		if ($params['icons_hover_color'] !== ''){
			$icons_style .= libero_mikado_get_inline_attr($params['icons_hover_color'],'data-hover-color');
		}

		return $icons_style;
	}

	/**
	 * Get Social Icons Text style
	 * return string
	 *
	 */

	private function getSocialTextStyle($params){
		$text_style = '';
		if ($params['text_color'] !== ''){
			$text_style = 'color: '.$params['text_color'];
		}

		return $text_style;
	}

	/**
	 * Get Social style
	 * return string
	 *
	 */

	private function getSocialStyle($params){
		$style = '';
		if ($params['border_color'] !== ''){
			$style = 'border-color: '.$params['border_color'];
		}

		return $style;
	}

	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams($params) {

		$networks = array();
		$icons_type = $params['icon_type'];
		$params_for_style = $params;

		foreach ($this->socialNetworks as $net) {

			$html = '';
			if (libero_mikado_options()->getOptionValue('enable_'.$net.'_share') == 'yes') {

				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$params = array(
					'name' => $net
				);
				$params['link'] = $this->getSocialNetworkShareLink($net, $image);
				$params['text'] = $this->getSocialNetworkShareText($net);
				$params['icon'] = $this->getSocialNetworkIcon($net, $icons_type);
				$params['icons_style'] = $this->getSocialIconStyle($params_for_style);
				$params['text_style'] = $this->getSocialTextStyle($params_for_style);
				$params['social_style'] = $this->getSocialStyle($params_for_style);
				$params['custom_icon'] = (libero_mikado_options()->getOptionValue($net.'_icon')) ? libero_mikado_options()->getOptionValue($net.'_icon') : '';
				$html = libero_mikado_get_shortcode_module_template_part('templates/parts/network', 'socialshare', '', $params);

			}
			if ($html !== '') {
				$networks[$net] = $html;
			}

		}

		return $networks;

	}

	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 * @return string
	 */
	private function getSocialNetworkShareLink($net, $image) {

		switch ($net) {
			case 'facebook':
				if(wp_is_mobile()) {
					$link = 'window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) .'\');';
				} else {
					$link = 'window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(libero_mikado_addslashes(get_the_title())) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=' . $image[0] . '&amp;p[summary]=' . urlencode(libero_mikado_addslashes(get_the_excerpt())) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char = (isset($_SERVER['https'])) ? 23 : 22;
				$twitter_via = (libero_mikado_options()->getOptionValue('twitter_via') !== '') ? ' via ' . libero_mikado_options()->getOptionValue('twitter_via') . ' ' : '';

				if(wp_is_mobile()) {
					$link = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode(libero_mikado_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				} else {
					$link = 'window.open(\'http://twitter.com/home?status=' . urlencode(libero_mikado_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				}
				break;
			case 'google_plus':
				$link = 'popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . libero_mikado_addslashes(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}

		return $link;

	}

	private function getSocialNetworkIcon($net, $type) {

		switch ($net) {
			case 'facebook':
				$icon = ( $type == 'circle' ) ? 'social_facebook_circle' : 'social_facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'circle' ) ? 'social_twitter_circle' : 'social_twitter';
				break;
			case 'google_plus':
				$icon = ( $type == 'circle' ) ? 'social_googleplus_circle' : 'social_googleplus';
				break;
			case 'linkedin':
				$icon = ( $type == 'circle' ) ? 'social_linkedin_circle' : 'social_linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'circle' ) ? 'social_tumblr_circle' : 'social_tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'circle' ) ? 'social_pinterest_circle' : 'social_pinterest';
				break;
			case 'vk':
				$icon = 'fa fa-vk';
				break;
			default:
				$icon = '';
		}

		return $icon;

	}


	/**
	 * Get titles for networks
	 *
	 * @param $net
	 * @return string
	 */
	private function getSocialNetworkShareText($net) {

		switch ($net) {
			case 'facebook':
				$text = esc_html__('Facebook','libero');
				break;
			case 'twitter':
				$text = esc_html__('Twitter','libero');
				break;
			case 'google_plus':
				$text = esc_html__('Google+','libero');
				break;
			case 'linkedin':
				$text = esc_html__('LinkedIn','libero');
				break;
			case 'tumblr':
				$text = esc_html__('Tumblr','libero');
				break;
			case 'pinterest':
				$text = esc_html__('Pinterest','libero');
				break;
			case 'vk':
				$text = esc_html__('VK','libero');
				break;
			default:
				$text = '';
		}

		return $text;

	}

}