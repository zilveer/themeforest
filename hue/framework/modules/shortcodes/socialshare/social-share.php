<?php
namespace Hue\Modules\SocialShare;

use Hue\Modules\Shortcodes\Lib\ShortcodeInterface;

class SocialShare implements ShortcodeInterface {

    private $base;
    private $socialNetworks;

    function __construct() {
        $this->base           = 'mkd_social_share';
        $this->socialNetworks = array(
            'google_plus',
            'facebook',
            'twitter',
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
            'name'                      => esc_html__('Social Share', 'hue'),
            'base'                      => $this->getBase(),
            'icon'                      => 'icon-wpb-social-share extended-custom-icon',
            'category'                  => 'by MIKADO',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Type', 'hue'),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'description' => esc_html__('Choose type of Social Share', 'hue'),
                    'value'       => array(
                        esc_html__('List', 'hue')     => 'list',
                        esc_html__('Dropdown', 'hue') => 'dropdown'
                    ),
                    'save_always' => true
                )
            )
        ));
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {

        $args = array(
            'type'      => 'list',
            'icon_type' => 'normal'
        );

        //Shortcode Parameters
        $params = shortcode_atts($args, $atts);

        //Is social share enabled
        $params['enable_social_share'] = (hue_mikado_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

        //Is social share enabled for post type
        $post_type         = get_post_type();
        $params['enabled'] = (hue_mikado_options()->getOptionValue('enable_social_share_on_'.$post_type)) ? true : false;

        //Social Networks Data
        $params['networks'] = $this->getSocialNetworksParams($params);

        $html = '';

        if($params['enable_social_share']) {
            if($params['enabled']) {
                $html .= hue_mikado_get_shortcode_module_template_part('templates/'.$params['type'], 'socialshare', '', $params);
            }
        }

        return $html;

    }

    /**
     * Get Social Networks data to display
     * @return array
     */
    private function getSocialNetworksParams($params) {

        $networks   = array();
        $icons_type = $params['icon_type'];

        foreach($this->socialNetworks as $net) {

            $html = '';
            if(hue_mikado_options()->getOptionValue('enable_'.$net.'_share') == 'yes') {

                $image                 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $params                = array(
                    'name' => $net
                );
                $params['link']        = $this->getSocialNetworkShareLink($net, $image);
                $params['icon']        = $this->getSocialNetworkIcon($net, $icons_type);
                $params['custom_icon'] = (hue_mikado_options()->getOptionValue($net.'_icon')) ? hue_mikado_options()->getOptionValue($net.'_icon') : '';
                $html                  = hue_mikado_get_shortcode_module_template_part('templates/parts/network', 'socialshare', '', $params);

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
     *
     * @return string
     */
    private function getSocialNetworkShareLink($net, $image) {

        switch($net) {
            case 'facebook':
                if(wp_is_mobile()) {
                    $link = 'window.open(\'http://m.facebook.com/sharer.php?u='.urlencode(get_permalink()).'\');';
                } else {
                    $link = 'window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]='.urlencode(hue_mikado_addslashes(get_the_title())).'&amp;p[url]='.urlencode(get_permalink()).'&amp;p[images][0]='.$image[0].'&amp;p[summary]='.urlencode(hue_mikado_addslashes(get_the_excerpt())).'\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
                }
                break;
            case 'twitter':
                $count_char  = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (hue_mikado_options()->getOptionValue('twitter_via') !== '') ? ' via '.hue_mikado_options()->getOptionValue('twitter_via').' ' : '';

                if(wp_is_mobile()) {
                    $link = 'window.open(\'https://twitter.com/intent/tweet?text='.urlencode(hue_mikado_the_excerpt_max_charlength($count_char).$twitter_via).get_permalink().'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                } else {
                    $link = 'window.open(\'http://twitter.com/home?status='.urlencode(hue_mikado_the_excerpt_max_charlength($count_char).$twitter_via).get_permalink().'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                }
                break;
            case 'google_plus':
                $link = 'popUp=window.open(\'https://plus.google.com/share?url='.urlencode(get_permalink()).'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url='.urlencode(get_permalink()).'&amp;name='.urlencode(get_the_title()).'&amp;description='.urlencode(get_the_excerpt()).'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url='.urlencode(get_permalink()).'&amp;description='.hue_mikado_addslashes(get_the_title()).'&amp;media='.urlencode($image[0]).'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url='.urlencode(get_permalink()).'&amp;title='.urlencode(get_the_title()).'&amp;description='.urlencode(get_the_excerpt()).'&amp;image='.urlencode($image[0]).'\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;

    }

    private function getSocialNetworkIcon($net, $type) {

        switch($net) {
            case 'facebook':
                $icon = 'fa fa-facebook';
                break;
            case 'twitter':
                $icon = 'fa fa-twitter';
                break;
            case 'google_plus':
                $icon = 'fa fa-google-plus';
                break;
            case 'linkedin':
                $icon = 'fa fa-linkedin';
                break;
            case 'tumblr':
                $icon = 'fa fa-tumblr';
                break;
            case 'pinterest':
                $icon = 'fa fa-pinterest';
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