<?php
namespace Hashmag\Modules\SocialShare;

use Hashmag\Modules\Shortcodes\Lib\ShortcodeInterface;

class SocialShare implements ShortcodeInterface {

	private $base;
	private $socialNetworks;

	function __construct() {
		$this->base = 'mkdf_social_share';
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
			'name' => esc_html__('Mikado Social Share', 'hashmag'),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-social-share extended-custom-icon',
			'category' => 'by MIKADO',
			'allowed_container_element' => 'vc_row',
			'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => 'Type',
                    'param_name' => 'type',
                    'value' => array(
                        'Dropdown' => 'dropdown',
                        'List' => 'list'
                    ),
                    'save_always'	=> true,
                    'description' => ''
                ),
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
            'type' => 'dropdown'
		);

		//Shortcode Parameters
		$params = shortcode_atts($args, $atts);

		//Is social share enabled
		$params['enable_social_share'] = (hashmag_mikado_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

		//Is social share enabled for post type
		$post_type = get_post_type();
		$params['enabled'] = (hashmag_mikado_options()->getOptionValue('enable_social_share_on_'.$post_type)) ? true : false;

		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams($params);

		$html = '';

		if ($params['enable_social_share']) {
			if ($params['enabled']) {
				$html .= hashmag_mikado_get_shortcode_module_template_part('templates/' . $params['type'], 'socialshare', '', $params);
			}
		}

		return $html;
	}

	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams($params) {

		$networks = array();

		foreach ($this->socialNetworks as $net) {

			$html = '';
			if (hashmag_mikado_options()->getOptionValue('enable_'.$net.'_share') == 'yes') {

				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$params = array(
					'name' => $net
				);
				$params['link'] = $this->getSocialNetworkShareLink($net, $image);
				$params['icon'] = $this->getSocialNetworkIcon($net);
				$params['custom_icon'] = (hashmag_mikado_options()->getOptionValue($net.'_icon')) ? hashmag_mikado_options()->getOptionValue($net.'_icon') : '';
				$html = hashmag_mikado_get_shortcode_module_template_part('templates/parts/network', 'socialshare', '', $params);
			}

			$networks[$net] = $html;
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
					$link = 'window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(hashmag_mikado_addslashes(get_the_title())) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=' . $image[0] . '&amp;p[summary]=' . urlencode(hashmag_mikado_addslashes(get_the_excerpt())) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char = (isset($_SERVER['https'])) ? 23 : 22;
				$twitter_via = (hashmag_mikado_options()->getOptionValue('twitter_via') !== '') ? ' via ' . hashmag_mikado_options()->getOptionValue('twitter_via') . ' ' : '';

				if(wp_is_mobile()) {
					$link = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode(hashmag_mikado_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				} else {
					$link = 'window.open(\'http://twitter.com/home?status=' . urlencode(hashmag_mikado_the_excerpt_max_charlength($count_char) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
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
				$link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . hashmag_mikado_addslashes(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}

		return $link;
	}

	private function getSocialNetworkIcon($net) {

		switch ($net) {
			case 'facebook':
				$icon = 'social_facebook';
				break;
			case 'twitter':
				$icon = 'social_twitter';
				break;
			case 'google_plus':
				$icon = 'social_googleplus';
				break;
			case 'linkedin':
				$icon = 'social_linkedin';
				break;
			case 'tumblr':
				$icon = 'social_tumblr';
				break;
			case 'pinterest':
				$icon = 'social_pinterest';
				break;
			case 'vk':
				$icon = 'fa fa-vk';
				break;
			default:
				$icon = '';
		}

		return $icon;
	}
}