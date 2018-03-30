<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Recognized Social Profiles
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( !function_exists( '_ut_recognized_social_user_profiles' ) ) {

    function _ut_recognized_social_user_profiles() {
        
        return apply_filters( 'ut_recognized_user_contact_fields', array(            
            'twitter'      => esc_html__( 'Twitter', 'unite' ),
            'facebook'     => esc_html__( 'Facebook', 'unite' ),
            'google-plus'  => esc_html__( 'Google Plus', 'unite' ),
            'instagram'    => esc_html__( 'instagram', 'unite' ),
            'twitch'       => esc_html__( 'Twitch', 'unite' ),
            'linkedin'     => esc_html__( 'LinkedIn', 'unite' ),
            'tumblr'       => esc_html__( 'Tumblr', 'unite' ),
            'pinterest'    => esc_html__( 'Pinterest', 'unite' ),
            'github-alt'   => esc_html__( 'Github', 'unite' ),
            'dribbble'     => esc_html__( 'Dribbble', 'unite' ),
            'flickr'       => esc_html__( 'Flickr', 'unite' ),
            'skype'        => esc_html__( 'Skype', 'unite' ),
            'youtube'      => esc_html__( 'Youtube', 'unite' ),
            'vimeo-square' => esc_html__( 'Vimeo', 'unite' ),
            'rss'          => esc_html__('RSS', 'unite' )
        ));
        
    }

}

/**
 * Recognized Dynamic Sidebars
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_dynamic_sidebars' ) ) {

    function _ut_recognized_dynamic_sidebars() {
        
        $dynamic_sidebars = get_option('unite_theme_sidebars');
        $sidebar_array = array();
        
        if( !empty( $dynamic_sidebars ) && is_array( $dynamic_sidebars ) ) :
                          
            foreach( $dynamic_sidebars as $single_sidebar ) {
                                             
                 $sidebar_array[$single_sidebar['sidebar_id']] = $single_sidebar['sidebarname'];
                            
            }
        
        endif;
        
        return apply_filters( 'ut_recognized_dynamic_sidebars', $sidebar_array );
        
    }

}

/**
 * Recognized Sidebar Alignments
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_sidebar_align' ) ) {

    function _ut_recognized_sidebar_align() {
        
        return apply_filters( 'ut_recognized_sidebar_align', array(
            'default'   => esc_html__( 'Default Align', 'unite' ),
            'none'      => esc_html__( 'No Sidebar', 'unite' ),
            'left'      => esc_html__( 'Sidebar Left', 'unite' ),
            'right'     => esc_html__( 'Sidebar Right', 'unite' ),
            //'both'      => esc_html__( 'Sidebar Left and Right', 'unite' )
        ));
        
    }

}


/**
 * Recognized Background Repeat Values
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_background_repeats' ) ) {

    function _ut_recognized_background_repeats() {
        
        return apply_filters('ut_recognized_background_repeats' ,$background_repeat = array(
            'no-repeat' => esc_html__( 'No repeat', 'unite' ),
            'repeat'    => esc_html__( 'Repeat all', 'unite' ),
            'repeat-x'  => esc_html__( 'Repeat only horizontally', 'unite' ),
            'repeat-y'  => esc_html__( 'Repeat only vertically', 'unite' ),
            'inherit'   => esc_html__( 'Inherit', 'unite' )
        ));        
           
    }

}


/**
 * Recognized Background Attachment Values
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_background_attachments' ) ) {

    function _ut_recognized_background_attachments() {
        
        return apply_filters('ut_recognized_background_attachments', $background_attachment = array(
            'scroll'    => esc_html__( 'Scroll', 'unite' ),
            'fixed'     => esc_html__( 'Fixed', 'unite' ),
            'inherit'   => esc_html__( 'Inherit', 'unite' )            
        ));
           
    }

}


/**
 * Recognized Background Position Values
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_background_positions' ) ) {

    function _ut_recognized_background_positions() {
        
        return apply_filters('ut_recognized_background_positions', $background_position = array(
            'left top'      => esc_html__( 'left top', 'unite' ),
            'left center'   => esc_html__( 'left center', 'unite' ),
            'left bottom'   => esc_html__( 'left bottom', 'unite' ),
            'center top'    => esc_html__( 'center top', 'unite' ),
            'center center' => esc_html__( 'center center', 'unite' ),
            'center bottom' => esc_html__( 'center bottom', 'unite' ),
            'right top'     => esc_html__( 'right top', 'unite' ),
            'right center'  => esc_html__( 'right center', 'unite' ),
            'right bottom'  => esc_html__( 'right bottom', 'unite' )
        ));
           
    }

}


/**
 * Recognized Background Size Values
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_background_sizes' ) ) {

    function _ut_recognized_background_sizes() {
        
        return apply_filters('ut_recognized_background_sizes', $background_size = array(
            'cover'     => esc_html__( 'Cover', 'unite' ),
            'contain'   => esc_html__( 'Contain', 'unite' ),
            'inherit'   => esc_html__( 'Inherit', 'unite' ),
        ));
           
    }

}


/**
 * Recognized Font Faces
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_font_families' ) ) {

    function _ut_recognized_font_families() {
        
        return apply_filters('ut_recognized_font_families', $font_families = array(
            'arial'     => esc_html__( 'Arial', 'unite' ),
            'georgia'   => esc_html__( 'Georgia', 'unite' ),
            'helvetica' => esc_html__( 'Helvetica', 'unite' ),
            'palatino'  => esc_html__( 'Palatino', 'unite' ),
            'tahoma'    => esc_html__( 'Tahoma', 'unite' ),
            'times'     => esc_html__( 'Times New Roman', 'unite' ),
            'trebuchet' => esc_html__( 'Trebuchet', 'unite' ),
            'verdana'   => esc_html__( 'Verdana', 'unite' )
        ));
           
    }

}

/**
 * Recognized Border Styles
 *
 * @return    array
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_border_styles' ) ) {

    function _ut_recognized_border_styles() {
        
        return apply_filters('ut_recognized_border_styles', $border_styles = array(
            'none'     => esc_html__( 'none', 'unite' ),
            'dotted'   => esc_html__( 'dotted', 'unite' ),
            'dashed'   => esc_html__( 'dashed', 'unite' ),
            'solid'    => esc_html__( 'solid', 'unite' ),
            'double'   => esc_html__( 'double', 'unite' )            
        ) );
           
    }

}


/**
 * Recognized Google Font Faces
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_google_font_families' ) ) {

    function _ut_recognized_google_font_families( $font_families ) {
        
        if( apply_filters( 'ut_google_fonts', true ) ) {
            
            $google_fonts = get_option( 'unite_installed_google_fonts' );
            
            if( !empty( $google_fonts ) && is_array( $google_fonts ) ) {
                
                foreach( $google_fonts as $key => $google_font ) {
                    
                    $font_families[$key] = $google_font['family'];
                    
                }
                
            }            
        
        }
                
        return $font_families;   
           
    }
    
    if( apply_filters( 'ut_google_fonts', true ) ) {
        
        add_filter( 'ut_recognized_font_families', '_ut_recognized_google_font_families' );
    
    }
    
}


/**
 * Recognized Font Subsets
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( !function_exists( '_ut_recognized_font_subsets' ) ) {

    function _ut_recognized_font_subsets() {
        
        return apply_filters( 'ut_recognized_font_subsets', array(
            'latin'         => esc_html__( 'Latin', 'unite' ),
            'latin-ext'     => esc_html__( 'Latin Extended', 'unite' ),
            'greek'         => esc_html__( 'Greek', 'unite' ),
            'greek-ext'     => esc_html__( 'Greek Extended', 'unite' ),
            'cyrillic'      => esc_html__( 'Cyrillic', 'unite' ),
            'cyrillic-ext'  => esc_html__( 'Cyrillic Extended', 'unite' ),
            'khmer'         => esc_html__( 'Khmer', 'unite' ),
            'vietnamese'    => esc_html__( 'Vietnamese', 'unite' )
        ));
        
    }

}

/**
 * Recognized Font Size Units
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_font_size_units' ) ) {

    function _ut_recognized_font_size_units() {
        
        return apply_filters( 'ut_recognized_font_size_units', array(
            'px'    => esc_html__( 'px', 'unite' ),
            'em'    => esc_html__( 'em', 'unite' ),
            '%'     => esc_html__( '%', 'unite' ),
            'rem'   => esc_html__( 'rem', 'unite' ),
        ));
        
    }

}

/**
 * Recognized Font Text Align
 *
 * @return    array
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_text_align' ) ) {

    function _ut_recognized_text_align() {
        
        return apply_filters( 'ut_recognized_text_align', array(
            'left'      => esc_html__( 'left', 'unite' ),
            'right'     => esc_html__( 'right', 'unite' ),
            'center'    => esc_html__( 'center', 'unite' ),
            'justify'   => esc_html__( 'justify', 'unite' ),
            'inherit'   => esc_html__( 'inherit', 'unite' ),
        ));
        
    }

}

/**
 * Recognized Font Styles
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_font_styles' ) ) {

    function _ut_recognized_font_styles() {
        
        return apply_filters( 'ut_recognized_font_styles', array(
            'normal'  => esc_html__( 'Normal', 'unite' ),
            'italic'  => esc_html__( 'Italic', 'unite' ),
            'oblique' => esc_html__( 'Oblique', 'unite' ),
            'inherit' => esc_html__( 'Inherit', 'unite' )
        ));
        
    }

}


/**
 * Recognized Text Transforms
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_text_transforms' ) ) {

    function _ut_recognized_text_transforms() {
        
        return apply_filters( 'ut_recognized_text_transforms', array(
            'none'        => esc_html__( 'none', 'unite' ),
            'capitalize'  => esc_html__( 'Capitalize', 'unite' ),
            'uppercase'   => esc_html__( 'Uppercase', 'unite' ),
            'lowercase'   => esc_html__( 'Lowercase', 'unite' )
        ));
        
    }

}

/**
 * Recognized Text Decorations
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_text_decorations' ) ) {

    function _ut_recognized_text_decorations() {
        
        return apply_filters( 'ut_recognized_text_decorations', array(
            'none'        => esc_html__( 'none', 'unite' ),
            'blink'       => esc_html__( 'Blink', 'unite' ),
            'inherit'     => esc_html__( 'Inherit', 'unite' ),
            'line-trough' => esc_html__( 'Line Through', 'unite' ),
            'overline'    => esc_html__( 'Overline', 'unite' ),
            'underline'   => esc_html__( 'Underline', 'unite' ),
        ));
        
    }

}

/**
 * Recognized Font Weights
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_font_weights' ) ) {

    function _ut_recognized_font_weights() {
        
        return apply_filters( 'ut_recognized_font_weights', array(
            'normal'    => esc_html__( 'Normal', 'unite' ),
            'bold'      => esc_html__( 'Bold', 'unite' ),
            'bolder'    => esc_html__( 'Bolder', 'unite' ),
            'lighter'   => esc_html__( 'Lighter', 'unite' ),
            '100'       => '100',
            '200'       => '200',
            '300'       => '300',
            '400'       => '400',
            '500'       => '500',
            '600'       => '600',
            '700'       => '700',
            '800'       => '800',
            '900'       => '900',
            'inherit'   => esc_html__( 'Inherit', 'unite' ),
        ));
        
    }

}



/**
 * Recognized Oembed Providers
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_recognized_oembed_providers' ) ) {

    function _ut_recognized_oembed_providers() {
        
        return $providers = array(
                '#http://(www\.)?youtube\.com/watch.*#i'              => array( 'http://www.youtube.com/oembed',                      true  ),
                '#https://(www\.)?youtube\.com/watch.*#i'             => array( 'http://www.youtube.com/oembed?scheme=https',         true  ),
                '#http://(www\.)?youtube\.com/playlist.*#i'           => array( 'http://www.youtube.com/oembed',                      true  ),
                '#https://(www\.)?youtube\.com/playlist.*#i'          => array( 'http://www.youtube.com/oembed?scheme=https',         true  ),
                '#http://youtu\.be/.*#i'                              => array( 'http://www.youtube.com/oembed',                      true  ),
                '#https://youtu\.be/.*#i'                             => array( 'http://www.youtube.com/oembed?scheme=https',         true  ),
                '#https?://(.+\.)?vimeo\.com/.*#i'                    => array( 'http://vimeo.com/api/oembed.{format}',               true  ),
                '#https?://(www\.)?dailymotion\.com/.*#i'             => array( 'http://www.dailymotion.com/services/oembed',         true  ),
                '#https?://(www\.)?flickr\.com/.*#i'                  => array( 'https://www.flickr.com/services/oembed/',            true  ),
                '#https?://flic\.kr/.*#i'                             => array( 'https://www.flickr.com/services/oembed/',            true  ),
                '#https?://(.+\.)?smugmug\.com/.*#i'                  => array( 'http://api.smugmug.com/services/oembed/',            true  ),
                '#https?://(www\.)?hulu\.com/watch/.*#i'              => array( 'http://www.hulu.com/api/oembed.{format}',            true  ),
                '#https?://(www\.)?scribd\.com/doc/.*#i'              => array( 'http://www.scribd.com/services/oembed',              true  ),
                '#https?://wordpress.tv/.*#i'                         => array( 'http://wordpress.tv/oembed/',                        true  ),
                '#https?://(.+\.)?polldaddy\.com/.*#i'                => array( 'https://polldaddy.com/oembed/',                      true  ),
                '#https?://poll\.fm/.*#i'                             => array( 'https://polldaddy.com/oembed/',                      true  ),
                '#https?://(www\.)?funnyordie\.com/videos/.*#i'       => array( 'http://www.funnyordie.com/oembed',                   true  ),
                '#https?://(www\.)?twitter\.com/.+?/status(es)?/.*#i' => array( 'https://api.twitter.com/1/statuses/oembed.{format}', true  ),
                '#https?://vine.co/v/.*#i'                            => array( 'https://vine.co/oembed.{format}',                    true  ),
                '#https?://(www\.)?soundcloud\.com/.*#i'              => array( 'http://soundcloud.com/oembed',                       true  ),
                '#https?://(.+?\.)?slideshare\.net/.*#i'              => array( 'https://www.slideshare.net/api/oembed/2',            true  ),
                '#http://instagr(\.am|am\.com)/p/.*#i'                => array( 'http://api.instagram.com/oembed',                    true  ),
                '#https?://(www\.)?rdio\.com/.*#i'                    => array( 'http://www.rdio.com/api/oembed/',                    true  ),
                '#https?://rd\.io/x/.*#i'                             => array( 'http://www.rdio.com/api/oembed/',                    true  ),
                '#https?://(open|play)\.spotify\.com/.*#i'            => array( 'https://embed.spotify.com/oembed/',                  true  ),
                '#https?://(.+\.)?imgur\.com/.*#i'                    => array( 'http://api.imgur.com/oembed',                        true  ),
                '#https?://(www\.)?meetu(\.ps|p\.com)/.*#i'           => array( 'http://api.meetup.com/oembed',                       true  ),
                '#https?://(www\.)?issuu\.com/.+/docs/.+#i'           => array( 'http://issuu.com/oembed_wp',                         true  ),
                '#https?://(www\.)?collegehumor\.com/video/.*#i'      => array( 'http://www.collegehumor.com/oembed.{format}',        true  ),
                '#https?://(www\.)?mixcloud\.com/.*#i'                => array( 'http://www.mixcloud.com/oembed',                     true  ),
                '#https?://(www\.|embed\.)?ted\.com/talks/.*#i'       => array( 'http://www.ted.com/talks/oembed.{format}',           true  ),
                '#https?://(www\.)?(animoto|video214)\.com/play/.*#i' => array( 'http://animoto.com/oembeds/create',                  true  ),
        );

    }

}


/**
 * Recognized JavaScript Translation Strings
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( !function_exists( '_ut_recognized_js_translation_strings' ) ) {

    function _ut_recognized_js_translation_strings() {
        
        return apply_filters( 'ut_recognized_js_translation_strings', array(            
            'confirm'   => esc_html__( 'OK', 'unite' ),
            'info'      => esc_html__( 'Information', 'unite' ),            
        ) );
        
    }

}
