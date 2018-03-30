<?php

/**
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

// Exit if accessed directly
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

// Don't duplicate me!
if (!class_exists('Mk_Options_Framework_Fields_Social_Share')) {
    
    class Mk_Options_Framework_Fields_Social_Share extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->field = $value['type'];
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
            $this->description = $value['desc'];
            $this->dependency = isset($value['dependency']) ? $value['dependency'] : '';
            $this->site_names = array(
                'px',
                'aim',
                'amazon',
                'apple',
                'bebo',
                'behance',
                'blogger',
                'delicious',
                'deviantart',
                'digg',
                'dribbble',
                'dropbox',
                'envato',
                'facebook',
                'flickr',
                'github',
                'google',
                'googleplus',
                'lastfm',
                'linkedin',
                'instagram',
                'myspace',
                'path',
                'pinterest',
                'reddit',
                'rss',
                'skype',
                'stumbleupon',
                'tumblr',
                'twitter',
                'vimeo',
                'wordpress',
                'yahoo',
                'yelp',
                'youtube',
                'xing',
                'imdb',
                'qzone',
                'renren',
                'vk',
                'wechat',
                'weibo',
                'whatsapp',
                'soundcloud',
            );
        if (!empty($this->default)) {
                $this->sites = explode(',', $this->default);
            } 
            else {
                $this->sites = array();
            }
        }
        
        public function render() {
            
            
            $output = '<div class="header-social-wrapper">';
            $output.= '<span class="header-social-option-row"><span class="header-social-option-label">' . __("Select a Site", "mk_framework") . '</span>';
            
            $output.= '<select class="mk-select" name="header_social_sites_select" id="header_social_sites_select">';
            $output.= '<option value="">' . __('Select Option...', 'mk_framework') . '</option>';
            foreach ($this->site_names as $key) {
                $output.= '<option value="' . $key . '" >' . str_replace('-', '', $key) . '</option>';
            }
            $output.= '</select></span>';
            
            $output.= '<span class="header-social-option-row"><span class="header-social-option-label">'. __("Enter Full URL", "mk_framework") . '</span><input type="text" id="header_social_url" name="header_social_url" size="35" /></span>';
            
            $output.= '<a href="#" class="secondary-button" id="add_header_social_item">' . __('Add New', 'mk_framework') . '</a></div>';
            
            $output.= '<span class="option-title-sub" style="margin-bottom:20px;">' . __('Current Social Networks', 'mk_framework') . '</span>';
            $output.= '<div id="mk-current-social" class="mk-current-social">';
            
            $output.= '<div class="default-social-item">
                            <div class="social-item-icon"></div>
                            <div class="social-item-url"></div>
                            <a href="#" class="delete-social-item"><i class="icon-close2"></i></a>
                            <input type="hidden" class="mk-social-item-site" value=""/>
                            <input type="hidden" class="mk-social-item-url" value=""/>
                     </div>';
            
            if (!empty($this->sites)) {
                foreach ($this->sites as $site) {
                    $output.= '<div class="mk-social-item added-item">
                            <div class="social-item-icon">' . $site . '</div>
                            <div class="social-item-url"></div>
                            <a href="#" class="delete-social-item"><i class="icon-close2"></i></a>
                            <input type="hidden" class="mk-social-item-site" value="' . $site . '"/>
                            <input type="hidden" class="mk-social-item-url" value=""/>
                     </div>';
                }
            }
            
            $output.= '</div>';
            $output.= '<input type="hidden" value="' . esc_attr($this->default) . '" name="header_social_networks_site" id="header_social_networks_site"/>';

            $output .= "<script type='text/javascript'>
                        jQuery(document).ready(function() {
                          var mk_social_site_url = jQuery('#header_social_networks_url').val().split(',');

                            jQuery('.mk-social-item.added-item').each(function(i) {

                                jQuery(this).find('.mk-social-item-url').attr('value', mk_social_site_url[i]);
                                jQuery(this).find('.social-item-url').text(mk_social_site_url[i]);
                            })
                        })
                    </script>";
            return parent::field_wrapper($this->id, $this->name, $this->description, $output, parent::dependency_builder($this->dependency));
        }
        
        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

        }
    }
}
