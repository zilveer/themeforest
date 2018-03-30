<?php

/*
|--------------------------------------------------------------------------
| helper function : returns needed options of the current page
|--------------------------------------------------------------------------
*/

if( !function_exists('ut_return_hero_config') ) {

	function ut_return_hero_config( $option = '' , $fallback = '' , $single = true ) {
        
        /* no option has been set - leave here */
        if( empty($option) ) {
            return;
        }
        
        $option = trim($option);
        
        $global_hero_styling = array();
        
        /* store post ID for later use */
        $hero_post_id = !ut_is_shop() ? get_the_ID() : get_option('woocommerce_shop_page_id');
        
        /* config array for front page */
        if( is_front_page() ) {
            
            $config = array(
                'ut_hero_type'                          => 'ut_front_page_header_type',
                'ut_custom_slogan'                      => 'ut_front_custom_slogan',
                'ut_expertise_slogan'                   => 'ut_front_expertise_slogan',
                'ut_company_slogan'                     => 'ut_front_company_slogan',
                'ut_company_slogan_letterspacing'       => 'ut_front_company_slogan_letterspacing',                
                'ut_company_slogan_color'               => 'ut_front_company_slogan_color',
                'ut_company_slogan_glow'                => 'ut_front_company_slogan_glow',
                'ut_catchphrase'                        => 'ut_front_catchphrase',
                'ut_catchphrase_color'                  => 'ut_front_catchphrase_color',
                'ut_main_hero_button'                   => 'ut_front_scroll_to_main',
                'ut_main_hero_button_url_type'          => 'ut_front_scroll_to_main_url_type',
                'ut_main_hero_button_target'            => 'ut_front_scroll_to_main_target',
                'ut_main_hero_button_link_target'       => 'ut_front_scroll_to_main_link_target',
                'ut_main_hero_button_style'             => 'ut_front_scroll_to_main_style',
                'ut_main_hero_button_settings'          => 'ut_front_hrbtn',
                'ut_second_hero_button'                 => 'ut_front_second_button',
                'ut_second_hero_button_text'            => 'ut_front_second_button_text',
                'ut_second_hero_button_url_type'        => 'ut_front_second_button_url_type',
                'ut_second_hero_button_url'             => 'ut_front_second_button_url',
                'ut_second_hero_button_target'          => 'ut_front_second_button_target',
                'ut_second_hero_button_style'           => 'ut_front_second_button_style',
                'ut_second_hero_button_settings'        => 'ut_front_second_hrbtn',
                'ut_hero_buttons_margin'                => 'ut_front_hero_buttons_margin',
                'ut_hero_down_arrow'                    => 'ut_front_hero_down_arrow',
                'ut_hero_down_arrow_target'             => 'ut_front_hero_down_arrow_scroll_target',                
                'ut_hero_fancy_border'                  => 'ut_front_hero_fancy_border',
                'ut_hero_fancy_border_color'            => 'ut_front_fancy_border_color',
                'ut_hero_fancy_border_background_color' => 'ut_front_fancy_border_background_color',
                'ut_hero_fancy_border_size'             => 'ut_front_fancy_border_size',                
                'ut_hero_overlay'                       => 'ut_front_page_overlay',
                'ut_hero_overlay_color'                 => 'ut_front_page_overlay_color',
                'ut_hero_overlay_color_opacity'         => 'ut_front_page_overlay_color_opacity',
                'ut_hero_overlay_pattern'               => 'ut_front_page_overlay_pattern',
                'ut_hero_overlay_pattern_style'         => 'ut_front_page_overlay_pattern_style',
                'ut_hero_overlay_effect'                => 'ut_front_page_overlay_effect',
                'ut_hero_overlay_effect_style'          => 'ut_front_page_overlay_effect_style',
                'ut_hero_overlay_effect_color'          => 'ut_front_page_overlay_effect_color',
                'ut_hero_style'                         => 'ut_front_page_hero_style',
                'ut_hero_font_size'                     => 'ut_front_page_hero_font_size',
                'ut_hero_align'                         => 'ut_front_page_hero_align',
                'ut_hero_font_style'                    => 'ut_front_page_hero_font_style',
                'ut_hero_dynamic_content'               => 'front_hero_dynamic_content',
                'ut_hero_image'                         => 'ut_front_header_image',
                'ut_hero_image_parallax'                => 'ut_front_header_parallax',
                'ut_hero_rain_effect'                   => 'ut_front_header_rain',
                'ut_hero_rain_sound'                    => 'ut_front_header_rain_sound',
                'ut_hero_animated_image'                => 'ut_front_header_animatedimage',
                'ut_hero_border_bottom'                 => 'ut_front_hero_border_bottom',
                'ut_hero_border_bottom_color'           => 'ut_front_hero_border_bottom_color',
                'ut_hero_border_bottom_width'           => 'ut_front_hero_border_bottom_width',
                'ut_hero_border_bottom_style'           => 'ut_front_hero_border_bottom_style',
                'ut_video_url'                          => 'ut_front_video',
                'ut_video_containment'                  => 'ut_front_video_containment',
                'ut_video_url_vimeo'                    => 'ut_front_video_vimeo',
                'ut_video_url_custom'                   => 'ut_front_video_custom',
                'ut_video_source'                       => 'ut_front_video_source',
                'ut_video_volume'                       => 'ut_front_video_volume',
                'ut_video_mute_button'                  => 'ut_video_mute_button',
                'ut_video_loop'                         => 'ut_front_video_loop',
                'ut_video_preload'                      => 'ut_front_video_preload',
                'ut_video_mute_state'                   => 'ut_front_video_sound',
                'ut_video_poster'                       => 'ut_front_video_poster',
                'ut_video_mp4'                          => 'ut_front_video_mp4',
                'ut_video_ogg'                          => 'ut_front_video_ogg',
                'ut_video_webm'                         => 'ut_front_video_webm',
                'ut_hero_shortcode'                     => 'front_hero_custom_shortcode',
                'ut_tabs_headline'                      => 'ut_front_page_tabs_headline',
                'ut_tabs_headline_style'                => 'ut_front_page_tabs_headline_style',
                'ut_tabs'                               => 'ut_front_page_tabs',
                'ut_tabs_tablet_color'                  => 'ut_front_page_tabs_tablet_color',
                'ut_tabs_tablet_shadow'                 => 'ut_front_page_tabs_tablet_shadow',
                'ut_background_slider_slides'           => 'ut_front_page_slider',
                'ut_background_slider_animation'        => 'front_animation',
                'ut_background_slider_slideshow_speed'  => 'front_slideshow_speed',
                'ut_background_slider_animation_speed'  => 'front_animation_speed',
                'ut_background_slider_arrow_background_color'        => 'front_slideshow_arrow_background_color',
                'ut_background_slider_arrow_background_color_hover'  => 'front_slideshow_arrow_background_color_hover',
                'ut_background_slider_arrow_color'                   => 'front_slideshow_arrow_color',        
                'ut_background_slider_arrow_color_hover'             => 'front_slideshow_arrow_color_hover',                 
                'ut_fancy_slider_slides'                => 'ut_front_page_fancy_slider',
                'ut_fancy_slider_effect'                => 'front_fancy_slider_effect',
                'ut_fancy_slider_height'                => 'front_fancy_slider_height',
                'ut_hero_split_content_type'            => 'ut_front_split_content_type',
                'ut_hero_split_video'                   => 'ut_front_split_video',
                'ut_hero_split_video_box'               => 'ut_front_split_video_box',
                'ut_hero_split_video_box_style'         => 'ut_front_split_video_box_style', 
                'ut_hero_split_video_box_padding'       => 'ut_front_split_video_box_padding',               
                'ut_hero_split_image_effect'            => 'ut_front_split_image_effect',
                'ut_hero_split_image_width'             => 'ut_front_split_image_max_width',
                'ut_hero_split_image'                   => 'ut_front_split_image',
                'patternstyle'                          => 'ut_front_page_overlay_pattern_style',
                
                /* colors */
                'ut_hero_expertise_slogan_color'             => 'ut_front_expertise_slogan_color',
                'ut_hero_expertise_slogan_background_color'  => 'ut_front_expertise_slogan_background_color',
                'ut_hero_company_slogan_color'               => 'ut_front_company_slogan_color',
                'ut_hero_catchphrase_color'                  => 'ut_front_catchphrase_color',
                'ut_hero_catchphrase_websafe_font_style'     => 'ut_front_catchphrase_websafe_font_style',
                
            );
            
            /* overwrite if globals are used */
            if( ot_get_option( 'ut_front_hero_global_styling', 'off' ) == 'on' ) {
                
                $config['ut_hero_style']                         = 'ut_global_hero_style';
                $config['ut_hero_align']                         = 'ut_global_hero_align';
                $config['ut_hero_overlay']                       = 'ut_global_hero_overlay';
                $config['ut_hero_overlay_color']                 = 'ut_global_hero_overlay_color';
                $config['ut_hero_overlay_color_opacity']         = 'ut_global_hero_overlay_color_opacity';
                $config['ut_hero_overlay_pattern']               = 'ut_global_hero_overlay_pattern';
                $config['ut_hero_overlay_pattern_style']         = 'ut_global_hero_overlay_pattern_style';
                $config['ut_hero_overlay_effect']                = 'ut_global_hero_overlay_effect';
                $config['ut_hero_overlay_effect_style']          = 'ut_global_hero_overlay_effect_style';
                $config['ut_hero_overlay_effect_color']          = 'ut_global_hero_overlay_effect_color';
                $config['ut_hero_border_bottom']                 = 'ut_global_hero_border_bottom';
                $config['ut_hero_border_bottom_color']           = 'ut_global_hero_border_bottom_color';
                $config['ut_hero_border_bottom_width']           = 'ut_global_hero_border_bottom_width';
                $config['ut_hero_border_bottom_style']           = 'ut_global_hero_border_bottom_style';
                $config['ut_hero_fancy_border']                  = 'ut_global_hero_fancy_border';
                $config['ut_hero_fancy_border_color']            = 'ut_global_hero_fancy_border_color';
                $config['ut_hero_fancy_border_background_color'] = 'ut_global_hero_fancy_border_background_color';
                $config['ut_hero_fancy_border_size']             = 'ut_global_hero_fancy_border_size';
                
            }
            
            if( ot_get_option( 'ut_front_hero_global_content_styling', 'off' ) == 'on' ) {
                
                $config['ut_hero_expertise_slogan_color']            = 'ut_global_hero_expertise_slogan_color';
                $config['ut_hero_expertise_slogan_background_color'] = 'ut_global_hero_expertise_slogan_background_color';
                $config['ut_hero_company_slogan_color']              = 'ut_global_hero_company_slogan_color';
                $config['ut_hero_catchphrase_color']                 = 'ut_global_hero_catchphrase_color';
            
            }           
            
        }
        
        /* config array for blog page */
        if( is_home() ) {
            
             $config = array(
                'ut_hero_type'                          => 'ut_blog_header_type',
                'ut_custom_slogan'                      => 'ut_blog_custom_slogan',
                'ut_expertise_slogan'                   => 'ut_blog_expertise_slogan',
                'ut_company_slogan'                     => 'ut_blog_company_slogan',
                'ut_company_slogan_letterspacing'       => 'ut_blog_company_slogan_letterspacing',                
                'ut_company_slogan_color'               => 'ut_blog_company_slogan_color',
                'ut_company_slogan_glow'                => 'ut_blog_company_slogan_glow',
                'ut_catchphrase'                        => 'ut_blog_catchphrase',
                'ut_main_hero_button'                   => 'ut_blog_scroll_to_main',           
                'ut_main_hero_button_style'             => 'ut_blog_scroll_to_main_style',
                'ut_main_hero_button_settings'          => 'ut_blog_hrbtn',                
                'ut_second_hero_button'                 => 'ut_blog_second_button',
                'ut_second_hero_button_text'            => 'ut_blog_second_button_text',
                'ut_second_hero_button_url'             => 'ut_blog_second_button_url',
                'ut_second_hero_button_target'          => 'ut_blog_second_button_target',
                'ut_second_hero_button_style'           => 'ut_blog_second_button_style',
                'ut_second_hero_button_settings'        => 'ut_blog_second_hrbtn',
                'ut_hero_buttons_margin'                => 'ut_blog_hero_buttons_margin',
                'ut_hero_down_arrow'                    => 'ut_blog_hero_down_arrow', 
                'ut_hero_fancy_border'                  => 'ut_blog_hero_fancy_border',
                'ut_hero_fancy_border_color'            => 'ut_blog_fancy_border_color',
                'ut_hero_fancy_border_background_color' => 'ut_blog_fancy_border_background_color',
                'ut_hero_fancy_border_size'             => 'ut_blog_fancy_border_size', 
                'ut_hero_overlay'                       => 'ut_blog_overlay',
                'ut_hero_overlay_color'                 => 'ut_blog_overlay_color',
                'ut_hero_overlay_color_opacity'         => 'ut_blog_overlay_color_opacity',
                'ut_hero_overlay_pattern'               => 'ut_blog_overlay_pattern',
                'ut_hero_overlay_pattern_style'         => 'ut_blog_overlay_pattern_style',
                'ut_hero_overlay_effect'                => 'ut_blog_overlay_effect',
                'ut_hero_overlay_effect_style'          => 'ut_blog_overlay_effect_style',
                'ut_hero_overlay_effect_color'          => 'ut_blog_overlay_effect_color',                
                'ut_hero_style'                         => 'ut_blog_hero_style',
                'ut_hero_font_size'                     => 'ut_blog_hero_font_size',
                'ut_hero_align'                         => 'ut_blog_hero_align',
                'ut_hero_font_style'                    => 'ut_blog_hero_font_style',
                'ut_hero_dynamic_content'               => 'blog_hero_dynamic_content',
                'ut_hero_dynamic_content_height'        => 'blog_hero_dynamic_height',
                'ut_hero_dynamic_content_v_align'       => 'blog_hero_dynamic_content_v_align',
                'ut_hero_dynamic_content_margin_bottom' => 'blog_hero_dynamic_content_margin_bottom',
                'ut_hero_image'                         => 'ut_blog_header_image',
                'ut_hero_image_parallax'                => 'ut_blog_header_parallax',
                'ut_hero_rain_effect'                   => 'ut_blog_header_rain',
                'ut_hero_rain_sound'                    => 'ut_blog_header_rain_sound',
                'ut_hero_animated_image'                => 'ut_blog_header_animatedimage',
                'ut_hero_border_bottom'                 => 'ut_blog_hero_border_bottom',
                'ut_hero_border_bottom_color'           => 'ut_blog_hero_border_bottom_color',
                'ut_hero_border_bottom_width'           => 'ut_blog_hero_border_bottom_width',
                'ut_hero_border_bottom_style'           => 'ut_blog_hero_border_bottom_style',                     
                'ut_video_url'                          => 'ut_blog_video',
                'ut_video_containment'                  => 'ut_blog_video_containment',
                'ut_video_url_vimeo'                    => 'ut_blog_video_vimeo',
                'ut_video_url_custom'                   => 'ut_blog_video_custom',
                'ut_video_source'                       => 'ut_blog_video_source',
                'ut_video_volume'                       => 'ut_blog_video_volume',
                'ut_video_mute_button'                  => 'ut_video_mute_button_blog',
                'ut_video_loop'                         => 'ut_blog_video_loop',
                'ut_video_preload'                      => 'ut_blog_video_preload',
                'ut_video_mute_state'                   => 'ut_blog_video_sound',
                'ut_video_poster'                       => 'ut_blog_video_poster',
                'ut_video_mp4'                          => 'ut_blog_video_mp4',
                'ut_video_ogg'                          => 'ut_blog_video_ogg',
                'ut_video_webm'                         => 'ut_blog_video_webm',
                'ut_hero_shortcode'                     => 'blog_hero_custom_shortcode',
                'ut_tabs_headline'                      => 'ut_blog_tabs_headline',
                'ut_tabs_headline_style'                => 'ut_blog_tabs_headline_style',
                'ut_tabs'                               => 'ut_blog_tabs',
                'ut_tabs_tablet_color'                  => 'ut_blog_tabs_tablet_color',
                'ut_tabs_tablet_shadow'                 => 'ut_blog_tabs_tablet_shadow',
                'ut_background_slider_slides'           => 'ut_blog_slider',
                'ut_background_slider_animation'        => 'blog_animation',
                'ut_background_slider_slideshow_speed'  => 'blog_slideshow_speed',
                'ut_background_slider_animation_speed'  => 'blog_animation_speed',
                'ut_background_slider_arrow_background_color'        => 'ut_blog_slider_arrow_background_color',
                'ut_background_slider_arrow_background_color_hover'  => 'ut_blog_slider_arrow_background_color_hover',
                'ut_background_slider_arrow_color'                   => 'ut_blog_slider_arrow_color',        
                'ut_background_slider_arrow_color_hover'             => 'ut_blog_slider_arrow_color_hover',                
                'ut_fancy_slider_slides'                => 'ut_blog_fancy_slider',
                'ut_fancy_slider_effect'                => 'blog_fancy_slider_effect',
                'ut_fancy_slider_height'                => 'blog_fancy_slider_height',
                'ut_hero_split_content_type'            => 'ut_blog_split_content_type',
                'ut_hero_split_video'                   => 'ut_blog_split_video',
                'ut_hero_split_video_box'               => 'ut_blog_split_video_box',
                'ut_hero_split_video_box_style'         => 'ut_blog_split_video_box_style',
                'ut_hero_split_video_box_padding'       => 'ut_blog_split_video_box_padding',                
                'ut_hero_split_image_effect'            => 'ut_blog_split_image_effect',
                'ut_hero_split_image_width'             => 'ut_blog_split_image_max_width',
                'ut_hero_split_image'                   => 'ut_blog_split_image',
                'patternstyle'                          => 'ut_blog_overlay_pattern_style',
                
                /* colors */
                'ut_hero_expertise_slogan_color'             => 'ut_blog_expertise_slogan_color',
                'ut_hero_expertise_slogan_background_color'  => 'ut_blog_expertise_slogan_background_color',
                'ut_hero_company_slogan_color'               => 'ut_blog_company_slogan_color',
                'ut_hero_catchphrase_color'                  => 'ut_blog_catchphrase_color',
                'ut_hero_catchphrase_websafe_font_style'     => 'ut_blog_catchphrase_websafe_font_style',
                
            );
            
            /* overwrite if globals are used */
            if( ot_get_option( 'ut_blog_hero_global_styling', 'off' ) == 'on' ) {
                
                $config['ut_hero_style']                         = 'ut_global_hero_style';
                $config['ut_hero_align']                         = 'ut_global_hero_align';
                $config['ut_hero_overlay']                       = 'ut_global_hero_overlay';
                $config['ut_hero_overlay_color']                 = 'ut_global_hero_overlay_color';
                $config['ut_hero_overlay_color_opacity']         = 'ut_global_hero_overlay_color_opacity';
                $config['ut_hero_overlay_pattern']               = 'ut_global_hero_overlay_pattern';
                $config['ut_hero_overlay_pattern_style']         = 'ut_global_hero_overlay_pattern_style';
                $config['ut_hero_overlay_effect']                = 'ut_global_hero_overlay_effect';
                $config['ut_hero_overlay_effect_style']          = 'ut_global_hero_overlay_effect_style';
                $config['ut_hero_overlay_effect_color']          = 'ut_global_hero_overlay_effect_color';
                $config['ut_hero_border_bottom']                 = 'ut_global_hero_border_bottom';
                $config['ut_hero_border_bottom_color']           = 'ut_global_hero_border_bottom_color';
                $config['ut_hero_border_bottom_width']           = 'ut_global_hero_border_bottom_width';
                $config['ut_hero_border_bottom_style']           = 'ut_global_hero_border_bottom_style';
                $config['ut_hero_fancy_border']                  = 'ut_global_hero_fancy_border';
                $config['ut_hero_fancy_border_color']            = 'ut_global_hero_fancy_border_color';
                $config['ut_hero_fancy_border_background_color'] = 'ut_global_hero_fancy_border_background_color';
                $config['ut_hero_fancy_border_size']             = 'ut_global_hero_fancy_border_size';
                
            }
            
            if( ot_get_option( 'ut_blog_hero_global_content_styling', 'off' ) == 'on' ) {
                
                $config['ut_hero_expertise_slogan_color']            = 'ut_global_hero_expertise_slogan_color';
                $config['ut_hero_expertise_slogan_background_color'] = 'ut_global_hero_expertise_slogan_background_color';
                $config['ut_hero_company_slogan_color']              = 'ut_global_hero_company_slogan_color';
                $config['ut_hero_catchphrase_color']                 = 'ut_global_hero_catchphrase_color';
            
            }
            
        }
        
        /* config array for regular pages */
        if( is_page() && !is_front_page() && !is_singular('portfolio') || ut_is_shop() || is_singular('product') ) {
            
            $config = array(
                'ut_hero_type'                          => 'ut_page_hero_type',
                'ut_custom_slogan'                      => 'ut_page_custom_hero_html',
                'ut_expertise_slogan'                   => 'ut_page_caption_slogan',
                'ut_company_slogan'                     => 'ut_page_caption_title',
                'ut_company_slogan_letterspacing'       => 'ut_page_caption_title_letterspacing',
                'ut_company_slogan_color'               => 'ut_page_caption_slogan_color',
                'ut_company_slogan_glow'                => 'ut_page_caption_slogan_glow',                
                'ut_catchphrase'                        => 'ut_page_caption_description',                
                'ut_main_hero_button'                   => 'ut_page_main_hero_button',
                'ut_main_hero_button_text'              => 'ut_page_main_hero_button_text',
                'ut_main_hero_button_url_type'          => 'ut_page_main_hero_button_url_type',
                'ut_main_hero_button_url'               => 'ut_page_main_hero_button_url',
                'ut_main_hero_button_link_target'       => 'ut_page_main_hero_button_target',
                'ut_main_hero_button_style'             => 'ut_page_main_hero_button_style',
                'ut_main_hero_button_settings'          => 'ut_page_main_hrbtn',
                'ut_second_hero_button'                 => 'ut_page_second_button',
                'ut_second_hero_button_text'            => 'ut_page_second_button_text',
                'ut_second_hero_button_url_type'        => 'ut_page_second_button_url_type',
                'ut_second_hero_button_url'             => 'ut_page_second_button_url',
                'ut_second_hero_button_target'          => 'ut_page_second_button_target',
                'ut_second_hero_button_style'           => 'ut_page_second_button_style',
                'ut_second_hero_button_settings'        => 'ut_page_second_hrbtn',
                'ut_hero_down_arrow'                    => 'ut_page_hero_down_arrow',
                'ut_hero_fancy_border'                  => 'ut_page_hero_fancy_border',
                'ut_hero_fancy_border_color'            => 'ut_page_fancy_border_color',
                'ut_hero_fancy_border_background_color' => 'ut_page_fancy_border_background_color',
                'ut_hero_fancy_border_size'             => 'ut_page_fancy_border_size',                 
                'ut_hero_overlay'                       => 'ut_page_hero_overlay',
                'ut_hero_overlay_color'                 => 'ut_page_hero_overlay_color',
                'ut_hero_overlay_color_opacity'         => 'ut_page_hero_overlay_color_opacity',
                'ut_hero_overlay_pattern'               => 'ut_page_hero_overlay_pattern',
                'ut_hero_overlay_pattern_style'         => 'ut_page_hero_overlay_pattern_style',
                'ut_hero_overlay_effect'                => 'ut_page_hero_overlay_effect',
                'ut_hero_overlay_effect_style'          => 'ut_page_hero_overlay_effect_style',
                'ut_hero_overlay_effect_color'          => 'ut_page_hero_overlay_effect_color',                
                'ut_hero_style'                         => 'ut_page_hero_style',
                'ut_hero_font_size'                     => 'ut_page_hero_font_size',
                'ut_hero_align'                         => 'ut_page_hero_align',
                'ut_hero_font_style'                    => 'ut_page_hero_font_style',
                'ut_hero_dynamic_content'               => 'ut_page_hero_dynamic_content',
                'ut_hero_dynamic_content_height'        => 'ut_page_hero_dynamic_height',
                'ut_hero_dynamic_content_v_align'       => 'ut_page_hero_dynamic_content_v_align',
                'ut_hero_dynamic_content_margin_bottom' => 'ut_page_hero_dynamic_content_margin_bottom',
                'ut_hero_image'                         => 'ut_page_hero_image',
                'ut_hero_image_parallax'                => 'ut_page_hero_parallax',
                'ut_hero_rain_effect'                   => 'ut_page_hero_rain_effect',
                'ut_hero_rain_sound'                    => 'ut_page_hero_rain_sound',
                'ut_hero_animated_image'                => 'ut_page_hero_animated_image',
                'ut_hero_border_bottom'                 => 'ut_page_hero_border_bottom',
                'ut_hero_border_bottom_color'           => 'ut_page_hero_border_bottom_color',
                'ut_hero_border_bottom_width'           => 'ut_page_hero_border_bottom_width',
                'ut_hero_border_bottom_style'           => 'ut_page_hero_border_bottom_style',                
                'ut_video_source'                       => 'ut_page_video_source',
                'ut_video_volume'                       => 'ut_page_video_volume',
                'ut_video_mute_button'                  => 'ut_page_video_mute_button',
                'ut_video_loop'                         => 'ut_page_video_loop',
                'ut_video_preload'                      => 'ut_page_video_preload',
                'ut_video_url'                          => 'ut_page_video',
                'ut_video_url_custom'                   => 'ut_page_video_custom',
                'ut_video_url_vimeo'                    => 'ut_page_video_vimeo',
                'ut_video_mute_state'                   => 'ut_page_video_sound',
                'ut_video_poster'                       => 'ut_page_video_poster',
                'ut_video_mp4'                          => 'ut_page_video_mp4',
                'ut_video_ogg'                          => 'ut_page_video_ogg',
                'ut_video_webm'                         => 'ut_page_video_webm',
                'ut_hero_shortcode'                     => 'ut_page_hero_custom_shortcode',
                'ut_tabs_headline'                      => 'ut_page_hero_tabs_headline',
                'ut_tabs_headline_style'                => 'ut_page_hero_tabs_headline_style',
                'ut_tabs'                               => 'ut_page_hero_tabs',
                'ut_tabs_tablet_color'                  => 'ut_page_hero_tabs_tablet_color',
                'ut_tabs_tablet_shadow'                 => 'ut_page_hero_tabs_tablet_shadow',
                'ut_background_slider_slides'           => 'ut_page_hero_slider',
                'ut_background_slider_animation'        => 'ut_page_hero_slider_animation',
                'ut_background_slider_slideshow_speed'  => 'ut_page_hero_slider_slideshow_speed',
                'ut_background_slider_animation_speed'  => 'ut_page_hero_slider_animation_speed',
                'ut_background_slider_arrow_background_color'        => 'ut_page_hero_slider_arrow_background_color',
                'ut_background_slider_arrow_background_color_hover'  => 'ut_page_hero_slider_arrow_background_color_hover',
                'ut_background_slider_arrow_color'                   => 'ut_page_hero_slider_arrow_color',        
                'ut_background_slider_arrow_color_hover'             => 'ut_page_hero_slider_arrow_color_hover', 
                'ut_fancy_slider_slides'                => 'ut_page_hero_fancy_slider',
                'ut_fancy_slider_effect'                => 'ut_page_hero_fancy_slider_effect',
                'ut_fancy_slider_height'                => 'ut_page_hero_fancy_slider_height',
                'ut_hero_split_content_type'            => 'ut_page_hero_split_content_type',
                'ut_hero_split_video'                   => 'ut_page_hero_split_video',
                'ut_hero_split_video_box'               => 'ut_page_hero_split_video_box',
                'ut_hero_split_video_box_style'         => 'ut_page_hero_split_video_box_style',
                'ut_hero_split_video_box_padding'       => 'ut_page_hero_split_video_box_padding', 
                'ut_hero_split_image_effect'            => 'ut_page_hero_split_image_effect',
                'ut_hero_split_image_width'             => 'ut_page_hero_split_image_max_width',
                'ut_hero_split_image'                   => 'ut_page_hero_split_image',
                'patternstyle'                          => 'ut_page_overlay_pattern_style'           
            );
            
            
            /* overwrite if globals are used */
            if( get_post_meta( $hero_post_id, 'ut_page_hero_global_style', true ) == 'on' ) {
                
                $global_hero_styling['ut_hero_style']                         = 'ut_global_hero_style';
                $global_hero_styling['ut_hero_align']                         = 'ut_global_hero_align';
                $global_hero_styling['ut_hero_overlay']                       = 'ut_global_hero_overlay';
                $global_hero_styling['ut_hero_overlay_color']                 = 'ut_global_hero_overlay_color';
                $global_hero_styling['ut_hero_overlay_color_opacity']         = 'ut_global_hero_overlay_color_opacity';
                $global_hero_styling['ut_hero_overlay_pattern']               = 'ut_global_hero_overlay_pattern';
                $global_hero_styling['ut_hero_overlay_pattern_style']         = 'ut_global_hero_overlay_pattern_style';
                $global_hero_styling['ut_hero_overlay_effect']                = 'ut_global_hero_overlay_effect';
                $global_hero_styling['ut_hero_overlay_effect_style']          = 'ut_global_hero_overlay_effect_style';
                $global_hero_styling['ut_hero_overlay_effect_color']          = 'ut_global_hero_overlay_effect_color';
                $global_hero_styling['ut_hero_border_bottom']                 = 'ut_global_hero_border_bottom';
                $global_hero_styling['ut_hero_border_bottom_color']           = 'ut_global_hero_border_bottom_color';
                $global_hero_styling['ut_hero_border_bottom_width']           = 'ut_global_hero_border_bottom_width';
                $global_hero_styling['ut_hero_border_bottom_style']           = 'ut_global_hero_border_bottom_style';
                $global_hero_styling['ut_hero_fancy_border']                  = 'ut_global_hero_fancy_border';
                $global_hero_styling['ut_hero_fancy_border_color']            = 'ut_global_hero_fancy_border_color';
                $global_hero_styling['ut_hero_fancy_border_background_color'] = 'ut_global_hero_fancy_border_background_color';
                $global_hero_styling['ut_hero_fancy_border_size']             = 'ut_global_hero_fancy_border_size';
                
            }
                 
        }
        
        /* config array for single portfolio pages  */
        if( is_singular('portfolio') ) {
            
            $config = array(
                'ut_hero_type'                          => 'ut_page_hero_type',
                'ut_custom_slogan'                      => 'ut_page_custom_hero_html',
                'ut_expertise_slogan'                   => 'ut_page_caption_slogan',
                'ut_company_slogan'                     => 'ut_page_caption_title',
                'ut_company_slogan_letterspacing'       => 'ut_page_caption_title_letterspacing',
                'ut_company_slogan_color'               => 'ut_page_company_slogan_color',
                'ut_company_slogan_glow'                => 'ut_page_company_slogan_glow',                 
                'ut_catchphrase'                        => 'ut_page_caption_description',                
                'ut_main_hero_button'                   => 'ut_page_main_hero_button',
                'ut_main_hero_button_text'              => 'ut_page_main_hero_button_text',
                'ut_main_hero_button_url_type'          => 'ut_page_main_hero_button_url_type',
                'ut_main_hero_button_url'               => 'ut_page_main_hero_button_url',
                'ut_main_hero_button_link_target'       => 'ut_page_main_hero_button_target',
                'ut_main_hero_button_style'             => 'ut_page_main_hero_button_style',
                'ut_main_hero_button_settings'          => 'ut_page_main_hrbtn',                
                'ut_second_hero_button'                 => 'ut_page_second_button',
                'ut_second_hero_button_text'            => 'ut_page_second_button_text',
                'ut_second_hero_button_url_type'        => 'ut_page_second_button_url_type',
                'ut_second_hero_button_url'             => 'ut_page_second_button_url',
                'ut_second_hero_button_target'          => 'ut_page_second_button_target',
                'ut_second_hero_button_style'           => 'ut_page_second_button_style',
                'ut_second_hero_button_settings'        => 'ut_page_second_hrbtn',                
                'ut_hero_down_arrow'                    => 'ut_page_hero_down_arrow',
                'ut_hero_fancy_border'                  => 'ut_page_hero_fancy_border',
                'ut_hero_fancy_border_color'            => 'ut_page_fancy_border_color',
                'ut_hero_fancy_border_background_color' => 'ut_page_fancy_border_background_color',
                'ut_hero_fancy_border_size'             => 'ut_page_fancy_border_size',  
                'ut_hero_overlay'                       => 'ut_page_hero_overlay',
                'ut_hero_overlay_color'                 => 'ut_page_hero_overlay_color',
                'ut_hero_overlay_color_opacity'         => 'ut_page_hero_overlay_color_opacity',
                'ut_hero_overlay_pattern'               => 'ut_page_hero_overlay_pattern',
                'ut_hero_overlay_pattern_style'         => 'ut_page_hero_overlay_pattern_style',
                'ut_hero_overlay_effect'                => 'ut_page_hero_overlay_effect',
                'ut_hero_overlay_effect_style'          => 'ut_page_hero_overlay_effect_style',
                'ut_hero_overlay_effect_color'          => 'ut_page_hero_overlay_effect_color',                
                'ut_hero_style'                         => 'ut_portfolio_hero_style',
                'ut_hero_font_size'                     => 'ut_page_hero_font_size',
                'ut_hero_align'                         => 'ut_portfolio_caption_align',
                'ut_hero_font_style'                    => 'ut_page_hero_font_style',
                'ut_hero_dynamic_content'               => 'ut_page_hero_dynamic_content',
                'ut_hero_dynamic_content_height'        => 'ut_page_hero_dynamic_height',
                'ut_hero_dynamic_content_v_align'       => 'ut_page_hero_dynamic_content_v_align',
                'ut_hero_dynamic_content_margin_bottom' => 'ut_page_hero_dynamic_content_margin_bottom',                
                'ut_hero_image'                         => 'ut_page_hero_image',
                'ut_hero_image_parallax'                => 'ut_page_hero_parallax',
                'ut_hero_rain_effect'                   => 'ut_page_hero_rain_effect',
                'ut_hero_rain_sound'                    => 'ut_page_hero_rain_sound',
                'ut_hero_animated_image'                => 'ut_page_hero_animated_image',
                'ut_hero_border_bottom'                 => 'ut_page_hero_border_bottom',
                'ut_hero_border_bottom_color'           => 'ut_page_hero_border_bottom_color',
                'ut_hero_border_bottom_width'           => 'ut_page_hero_border_bottom_width',
                'ut_hero_border_bottom_style'           => 'ut_page_hero_border_bottom_style',                
                'ut_video_source'                       => 'ut_page_video_source',
                'ut_video_volume'                       => 'ut_page_video_volume',
                'ut_video_mute_button'                  => 'ut_page_video_mute_button',
                'ut_video_loop'                         => 'ut_page_video_loop',
                'ut_video_preload'                      => 'ut_page_video_preload',
                'ut_video_url'                          => 'ut_page_video',
                'ut_video_url_custom'                   => 'ut_page_video_custom',
                'ut_video_url_vimeo'                    => 'ut_page_video_vimeo',
                'ut_video_mute_state'                   => 'ut_page_video_sound',
                'ut_video_poster'                       => 'ut_page_video_poster',
                'ut_video_mp4'                          => 'ut_page_video_mp4',
                'ut_video_ogg'                          => 'ut_page_video_ogg',
                'ut_video_webm'                         => 'ut_page_video_webm',
                'ut_hero_shortcode'                     => 'ut_page_hero_custom_shortcode',
                'ut_tabs_headline'                      => 'ut_page_hero_tabs_headline',
                'ut_tabs_headline_style'                => 'ut_page_hero_tabs_headline_style',
                'ut_tabs'                               => 'ut_page_hero_tabs',
                'ut_tabs_tablet_color'                  => 'ut_page_hero_tabs_tablet_color',
                'ut_tabs_tablet_shadow'                 => 'ut_page_hero_tabs_tablet_shadow',
                'ut_background_slider_slides'           => 'ut_page_hero_slider',
                'ut_background_slider_animation'        => 'ut_page_hero_slider_animation',
                'ut_background_slider_slideshow_speed'  => 'ut_page_hero_slider_slideshow_speed',
                'ut_background_slider_animation_speed'  => 'ut_page_hero_slider_animation_speed',
                'ut_background_slider_arrow_background_color'        => 'ut_page_hero_slider_arrow_background_color',
                'ut_background_slider_arrow_background_color_hover'  => 'ut_page_hero_slider_arrow_background_color_hover',
                'ut_background_slider_arrow_color'                   => 'ut_page_hero_slider_arrow_color',        
                'ut_background_slider_arrow_color_hover'             => 'ut_page_hero_slider_arrow_color_hover',                  
                'ut_fancy_slider_slides'                => 'ut_page_hero_fancy_slider',
                'ut_fancy_slider_effect'                => 'ut_page_hero_fancy_slider_effect',
                'ut_fancy_slider_height'                => 'ut_page_hero_fancy_slider_height',
                'ut_hero_split_content_type'            => 'ut_page_hero_split_content_type',
                'ut_hero_split_video'                   => 'ut_page_hero_split_video',
                'ut_hero_split_video_box'               => 'ut_page_hero_split_video_box',
                'ut_hero_split_video_box_style'         => 'ut_page_hero_split_video_box_style', 
                'ut_hero_split_video_box_padding'       => 'ut_page_hero_split_video_box_padding',                
                'ut_hero_split_image_effect'            => 'ut_page_hero_split_image_effect',
                'ut_hero_split_image_width'             => 'ut_page_hero_split_image_max_width',
                'ut_hero_split_image'                   => 'ut_page_hero_split_image',
                'patternstyle'                          => 'ut_page_overlay_pattern_style'           
            );
            
            /* overwrite if globals are used */
            if( get_post_meta( $hero_post_id, 'ut_page_hero_global_style', true ) == 'on' ) {
                
                $global_hero_styling['ut_hero_style']                         = 'ut_global_hero_style';
                $global_hero_styling['ut_hero_align']                         = 'ut_global_hero_align';
                $global_hero_styling['ut_hero_overlay']                       = 'ut_global_hero_overlay';
                $global_hero_styling['ut_hero_overlay_color']                 = 'ut_global_hero_overlay_color';
                $global_hero_styling['ut_hero_overlay_color_opacity']         = 'ut_global_hero_overlay_color_opacity';
                $global_hero_styling['ut_hero_overlay_pattern']               = 'ut_global_hero_overlay_pattern';
                $global_hero_styling['ut_hero_overlay_pattern_style']         = 'ut_global_hero_overlay_pattern_style';
                $global_hero_styling['ut_hero_overlay_effect']                = 'ut_global_hero_overlay_effect';
                $global_hero_styling['ut_hero_overlay_effect_style']          = 'ut_global_hero_overlay_effect_style';
                $global_hero_styling['ut_hero_overlay_effect_color']          = 'ut_global_hero_overlay_effect_color';
                $global_hero_styling['ut_hero_border_bottom']                 = 'ut_global_hero_border_bottom';
                $global_hero_styling['ut_hero_border_bottom_color']           = 'ut_global_hero_border_bottom_color';
                $global_hero_styling['ut_hero_border_bottom_width']           = 'ut_global_hero_border_bottom_width';
                $global_hero_styling['ut_hero_border_bottom_style']           = 'ut_global_hero_border_bottom_style';
                $global_hero_styling['ut_hero_fancy_border']                  = 'ut_global_hero_fancy_border';
                $global_hero_styling['ut_hero_fancy_border_color']            = 'ut_global_hero_fancy_border_color';
                $global_hero_styling['ut_hero_fancy_border_background_color'] = 'ut_global_hero_fancy_border_background_color';
                $global_hero_styling['ut_hero_fancy_border_size']             = 'ut_global_hero_fancy_border_size';
                
            }
                    
        }
        
        /* option exceptions for frontpage */
        if( is_front_page() && !is_home() ) {
        
            /* main hero button target behavior */
            if( $option == 'ut_main_hero_button_target') {
                
                $ut_main_hero_button_url_type   = ot_get_option( $config['ut_main_hero_button_url_type'] );
                $ut_main_hero_button_target     = ot_get_option( $config['ut_main_hero_button_target'] );                
                                                
                return ( !empty( $ut_main_hero_button_target ) && $ut_main_hero_button_url_type == 'section' ) ? '#section-' . ut_get_the_slug($ut_main_hero_button_target) : ot_get_option('ut_front_scroll_to_main_url', $fallback) ;
                
                
            }
                        
            if( $option == 'ut_main_hero_button_link_target' ) {
                
                $ut_main_hero_button_url_type = ot_get_option($config['ut_main_hero_button_url_type']);
                return $ut_main_hero_button_url_type == 'section' ? '_self' : ot_get_option('ut_front_scroll_to_main_link_target' , '_self');
            
            }
            
            /* second button target behavior */
            if( $option == 'ut_second_hero_button_url') {
                
                $ut_second_hero_button_url_type = ot_get_option('ut_front_second_button_url_type');
                $ut_second_hero_button_target   = ot_get_option('ut_front_second_button_scroll_target');
                
                return ( !empty( $ut_second_hero_button_target ) && $ut_second_hero_button_url_type == 'section' ) ? '#section-' . ut_get_the_slug($ut_second_hero_button_target) : ot_get_option('ut_front_second_button_url') ;            
            
            }
            
            if( $option == 'ut_second_hero_button_target' ) {
            
                $ut_second_hero_button_url_type = ot_get_option('ut_front_second_button_url_type');
                return $ut_second_hero_button_url_type == 'section' ? '_self' : ot_get_option('ut_front_second_button_target' , '_self');
            
            }
            
        }        
        
        /* option exceptions for blog */
        if( is_home() ) {
        
            /* main hero button target behavior */
            if( $option == 'ut_main_hero_button_target') {
            
                return '#ut-to-first-section';
           
            }
            
            if( $option == 'ut_main_hero_button_link_target' ) {
                
                return '_self';
            
            }
            
        
        }
        
        /* front and blog settings are stored inside the theme options */
        if( is_front_page() || is_home() ) {
        
            if( empty( $fallback ) && isset( $config[$option] ) ) {        
                return ot_get_option( $config[$option] );
            }
            
            elseif( !empty( $fallback ) && isset( $config[$option] ) ) {        
                return ot_get_option( $config[$option] , $fallback );
            }
            
            elseif( !empty( $fallback ) && !isset( $config[$option] ) ) {
                return $fallback;
            }
            
            else {
                return false;
            }
        
        /* page and portfolio hero settings are provided by meta boxes*/        
        } else {
            
            /* portfolio exceptions */
            if( is_singular('portfolio') ) {
                
                /* hero type fallback */
                if( $option == 'ut_hero_type' ) {
                    
                    if( get_post_format() == '' && get_post_meta( $hero_post_id , 'ut_page_hero_type' , true ) == '' ) {
                        return 'image';                    
                    }
                    
                    if( get_post_format() == 'video' && get_post_meta( $hero_post_id , 'ut_page_hero_type' , true ) == '' ) {
                        return 'video';                    
                    }
                    
                    if( get_post_format() == 'gallery' && get_post_meta( $hero_post_id , 'ut_page_hero_type' , true ) == '' ) {
                        return 'slider';                    
                    }
                
                }                
                
                /* hero image will be delivered by featured or detailed image */
                if( $option == 'ut_hero_image' || $option == 'ut_hero_animated_image' || $option == 'ut_video_poster' ) {
                    
                    /* switch option key */
                    switch ( $option ) {
                    
                        case 'ut_hero_image':
                            $optionkey = 'ut_page_hero_image';
                            break;
                        case 'ut_hero_animated_image':
                            $optionkey = 'ut_page_hero_animated_image';
                            break;
                        case 'ut_video_poster':
                            $optionkey = 'ut_page_video_poster';
                            break;
                    
                    }                    
                    
                    /* check if detail image has been set */
                    $hero_image = get_post_meta( $hero_post_id , $optionkey , true );
                    
                    if( is_array($hero_image) && array_filter($hero_image) && !empty($hero_image['background-image']) ) {
                        
                        $fullsizeID = ut_get_attachment_id_from_url($hero_image['background-image']);
                        
                    } elseif( !is_array($hero_image) && !empty($hero_image) ) {
                        
                        $fullsizeID = ut_get_attachment_id_from_url($hero_image);
                        
                    } else {
                        
                        $hero_image = wp_get_attachment_url( get_post_thumbnail_id( $hero_post_id ) ); 
                        $fullsizeID = ut_get_attachment_id_from_url( $hero_image );
                        
                    }
                                        
                    if( ( $option == 'ut_expertise_slogan' || $option == 'ut_company_slogan' ) && ( get_post_format() == '' && get_post_meta($hero_post_id , 'ut_page_hero_type' , true ) == '') ) {
                        
                        $thumbnaildetails = get_posts(array('p' => $fullsizeID, 'post_type' => 'attachment'));
                                                
                        if( $option == 'ut_expertise_slogan' && !empty($thumbnaildetails[0]->post_excerpt) ) {
                            return $thumbnaildetails[0]->post_excerpt;
                        } 
                        
                        if( $option == 'ut_company_slogan' && !empty($thumbnaildetails[0]->post_title) ) {
                            return $thumbnaildetails[0]->post_title;
                        }
                    
                    }
                    
                    if( $option == 'ut_hero_image' || $option == 'ut_hero_animated_image' || $option == 'ut_video_poster' ) {                    
                        return $hero_image;                    
                    }                    
                    
                }
                
                if( $option == 'ut_background_slider_slides' || $option == 'ut_fancy_slider_slides' ) {
                    
                    /* fallback to old hero */
                    if( get_post_format() == 'gallery' && get_post_meta( $hero_post_id , 'ut_page_hero_type' , true ) == '' && function_exists('ut_portfolio_extract_gallery_images_ids') ) {
                        
                        $galleryimages = array();
                        $key = NULL;
                        
                        /* rebuild old array */
                        foreach ( ut_portfolio_extract_gallery_images_ids($hero_post_id) as $ID => $imagedata ) : 
                            
                            $thumbnaildetails = get_posts(array('p' => $imagedata, 'post_type' => 'attachment'));
                              
                            if( !empty($thumbnaildetails[0]->post_excerpt) ) {
                                $galleryimages[$key]['expertise'] = $thumbnaildetails[0]->post_excerpt;                              
                            }
                            
                            if( !empty($thumbnaildetails[0]->post_title) ) {
                                $galleryimages[$key]['description' ] = $thumbnaildetails[0]->post_title;                              
                            }                             
                                    
                            if( isset( $imagedata->guid ) && !empty($imagedata->guid) ) {
                              
                                $image = $imagedata->guid; // fallback to older wp versions
                                  
                            } else {
                                  
                                $image = wp_get_attachment_image_src($imagedata , 'single-post-thumbnail');					
                                  
                            }
                        
                            if( !empty($image[0]) ) :
                                  
                                $galleryimages[$key]['image'] = $image[0];
                                  
                            endif; 
                        
                        $key++;
                        
                        endforeach;
                                                
                        return $galleryimages;                        
                                                 
                    } else {
                     
                        /* let's try to load background sliders , if no sliders found, let's try to load a gallery from the content */
                        $slider_type = ( $option == 'ut_background_slider_slides' ) ? 'ut_page_hero_slider' : 'ut_page_hero_fancy_slider';                                                
                        $galleryslides = get_post_meta( $hero_post_id , $slider_type , $single );
                        
                        if( empty( $galleryslides ) && function_exists('ut_portfolio_extract_gallery_images_ids') ) {
                            
                            $galleryimages = array();
                            $key = NULL;
                            
                            /* rebuild old array */
                            foreach ( ut_portfolio_extract_gallery_images_ids($hero_post_id) as $ID => $imagedata ) : 
                                
                                $thumbnaildetails = get_posts(array('p' => $imagedata, 'post_type' => 'attachment'));
                                  
                                if( !empty($thumbnaildetails[0]->post_excerpt) ) {
                                    $galleryimages[$key]['expertise'] = $thumbnaildetails[0]->post_excerpt;                              
                                }
                                
                                if( !empty($thumbnaildetails[0]->post_title) ) {
                                    $galleryimages[$key]['description' ] = $thumbnaildetails[0]->post_title;                              
                                }                             
                                        
                                if( isset( $imagedata->guid ) && !empty($imagedata->guid) ) {
                                  
                                    $image = $imagedata->guid; // fallback to older wp versions
                                      
                                } else {
                                      
                                    $image = wp_get_attachment_image_src($imagedata , 'single-post-thumbnail');					
                                      
                                }
                            
                                if( !empty($image[0]) ) :
                                      
                                    $galleryimages[$key]['image'] = $image[0];
                                      
                                endif; 
                            
                            $key++;
                            
                            endforeach;
                                                    
                            return $galleryimages; 
                        
                        
                        } else {
                        
                            return $galleryslides;
                        
                        }
                    
                    
                    }
                
                }                
            
            }
            
            /* $option exceptions for single pages - featured image in hero */
            if( $option == 'ut_hero_image') {
                
                $hero_image = get_post_meta( $hero_post_id , 'ut_page_hero_image' , true );
                
                if( is_array($hero_image) && array_filter($hero_image) && !empty($hero_image['background-image']) ) {
                    
                    
                } elseif( !is_array($hero_image) && !empty($hero_image) ) {                    
                    
                    
                } else {
                    
                    $hero_image   = wp_get_attachment_url(get_post_thumbnail_id($hero_post_id));                    
                    
                }
                
                return $hero_image;
                
            }
            
            
            /* option exceptions for single pages - check main button status */
            if( $option == 'ut_main_hero_button') {
            
                $button_status = get_post_meta( $hero_post_id , 'ut_page_main_hero_button' , $single );
                $button_text   = get_post_meta( $hero_post_id , 'ut_page_main_hero_button_text' , $single );
                
                if( $button_status == 'on' && !empty($button_text) ) {
                    
                    return $button_text;
                    
                } else {
                    
                    return '';
                    
                }
            
            }
            
            /* return correct button url */
            if( $option == 'ut_main_hero_button_target') {
            
                $ut_main_hero_button_url_type = get_post_meta( $hero_post_id , 'ut_page_main_hero_button_url_type' , $single );                
                return ( $ut_main_hero_button_url_type == 'content' ) ? '#ut-to-first-section' : get_post_meta( $hero_post_id , 'ut_page_main_hero_button_url' , $single);
                
            }
            
            if( $option == ' ut_main_hero_button_link_target') {
                
                $ut_main_hero_button_url_type = get_post_meta( $hero_post_id , 'ut_page_main_hero_button_url_type' , $single );                
                return $ut_main_hero_button_url_type == 'content' ? '_self' : get_post_meta( $hero_post_id , 'ut_page_main_hero_button_target' , $single);
            
            }
                        
            /* second button target behavior */
            if( $option == 'ut_second_hero_button_url') {
            
                $ut_second_hero_button_url_type = get_post_meta( $hero_post_id , 'ut_page_second_button_url_type' , $single );
                return ( $ut_second_hero_button_url_type == 'content' ) ? '#ut-to-first-section' : get_post_meta( $hero_post_id , 'ut_page_second_button_url' , $single);
            
            }
            
            if( empty( $fallback ) && isset( $config[$option] ) ) {
                                
                //echo $config[$option] . '=>' . get_post_meta( get_the_ID() , $config[$option] , $single ) . '<br />';
                
                if( array_key_exists( $option, $global_hero_styling ) ) {
                    
                    return ot_get_option( $global_hero_styling[$option] );
                    
                }                
                
                return get_post_meta( $hero_post_id , $config[$option] , $single );
                
            } 
            
            elseif( !empty( $fallback ) && isset( $config[$option] ) ) { 
                
                if( array_key_exists( $option, $global_hero_styling ) ) {
                    
                    $value = ot_get_option( $global_hero_styling[$option] );
                    
                } else { 
                                
                    $value = get_post_meta($hero_post_id , $config[$option] , $single );
                
                }
                                
                return !empty( $value ) ? $value : $fallback;
                
            }
            
            elseif( !empty( $fallback ) && !isset( $config[$option] ) ) {

                return $fallback;
                            
            }
            
            else {
                
                return false;
                
            }
        
        }        
        
    }

}

?>