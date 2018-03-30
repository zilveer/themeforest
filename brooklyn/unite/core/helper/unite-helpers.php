<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Theme Options Key
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
     
function ut_options_key() {

    return apply_filters( 'unite_theme_options_id', 'unite_theme_options' );

}

/**
 * Theme Options Key Slug
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
     
function ut_options_key_slug() {

    return apply_filters( 'unite-theme-options-slug', 'unite-theme-options' );

}

/**
 * Theme Options Layout
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
     
function ut_options_layout_key() {

    return apply_filters( 'unite_options_layout_key', 'unite_theme_options_layout' );

}

/**
 * Current Theme Layout
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
     
function ut_current_options_layout( $unite_theme_options_id ) {
    
    $available_layouts  = get_option( ut_options_layout_key() ); 
    $current_layout     = get_option( 'unite_current_options_layout' );
    
    if( $current_layout && is_array( $available_layouts ) && array_key_exists( $current_layout, $available_layouts ) ) {
        
        return $current_layout;   
    
    }
    
    return $unite_theme_options_id;

}

add_filter( 'unite_theme_options_id', 'ut_current_options_layout', 11 );

/**
 * Preview Theme Layout
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
     
function ut_preview_options_layout( $unite_theme_options_id ) {
    
    $available_layouts = get_option( ut_options_layout_key() ); 
    
    /* manually added layouts */   
    if( isset( $_GET['unite_preview_layout'] ) && is_array( $available_layouts ) && array_key_exists( $_GET['unite_preview_layout'], $available_layouts ) ) {
                
        return $_GET['unite_preview_layout'];
    
    }    
    
    /* the core layout id */
    if( isset( $_GET['unite_preview_layout'] ) && $_GET['unite_preview_layout'] == 'default' ) {
    
        return 'unite_theme_options';
                
    }
    
    return $unite_theme_options_id;

}

add_filter( 'unite_theme_options_id', 'ut_preview_options_layout', 12 );


/**
 * Theme Customizer Key
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
     
function ut_customizer_key() {

    return apply_filters( 'unite_customizer_options_id', 'unite_customizer_options' );

}

/**
 * Helper function to print arrays
 *
 * @param     array     Array to print 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists( 'ut_print' ) ) :
     
    function ut_print( $array ) {
                
        echo '<pre class="ut-print">';
            print_r( $array );
        echo '</pre>';
       
    }

endif;


/**
 * Helper function to clean string from special characters
 *
 * @param     string 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */

if ( ! function_exists( 'ut_remove_trash' ) ) :
	
    function ut_remove_trash( $string ){
        
        return preg_replace( '@[\.,\+\\\\/*-;:<>\?!\[\] ()&%$]@', '', $string );
        
    }

endif;


/**
 *
 * Create Transient String
 * 
 * @param     string - the transient name
 * @param     string - type like css / html etc
 *
 * @since 1.1.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'ut_transient_name' ) ) :

    function ut_transient_name( $name, $type = NULL ) {
        
        $ssl_suffix       = is_ssl() ? '_ssl' : '_no_ssl'; 
        $languages_suffix = defined('ICL_LANGUAGE_CODE') ? '_' . ICL_LANGUAGE_CODE : '';
        $type_suffix      = $type ? '_' . $type : '';
        
        return $name . $ssl_suffix . $languages_suffix . $type_suffix;

    }

endif;

/**
 *
 * Check if WPML is activated
 *
 * @since 1.1.0
 * @version 1.0.0
 *
 */
 
if ( ! function_exists( 'ut_wpml_activated' ) ) :
    
    function ut_wpml_activated() {
        
        if ( function_exists( 'icl_object_id' ) ) { 
        
            return true; 
        
        } else { 
        
            return false; 
            
        }        
        
    }
    
endif;

/**
 *
 * Get language defaults
 *
 * @since 1.1.0
 * @version 1.0.0
 *
 */
 
if ( ! function_exists( 'ut_language_defaults' ) ) :
  
    function ut_language_defaults() {
        
        $multilang = array();
        
        if( ut_wpml_activated() ) {

            global $sitepress;
            
            $multilang['default']   = $sitepress->get_default_language();
            $multilang['current']   = $sitepress->get_current_language();
            $multilang['languages'] = $sitepress->get_active_languages();
    
        }
        
        return ( ! empty( $multilang ) ) ? $multilang : false;                
            
    }

endif;

/**
 * Get WPML Unite Theme Options
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @param     string    The option ID
 * @return    mixed 
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if ( ! function_exists( 'ut_wpml_filter' ) ) :

    function ut_wpml_filter( $unite_options, $option_id ) {
        
        if( ut_wpml_activated() ) {
            
            if( !is_array( $unite_options[$option_id] ) ) {
                
                $wpml_string = icl_translate( 'Theme Options', $option_id, $unite_options[$option_id] );
                
                if( !empty( $wpml_string ) ) {
                    
                    return $wpml_string;
                    
                }
                
            }
            
            if( is_array( $unite_options[$option_id] ) ) {
                
                foreach( $unite_options[$option_id] as $key => $field ) {
                                        
                    $wpml_string = icl_translate( 'Theme Options', $option_id . '_' .  $key, $field );
                    
                    if( !empty( $wpml_string ) ) {
                        
                        $unite_options[$option_id][$key] = $wpml_string;
                        
                    }                        
                    
                }
            
            }            
            
        }
        
        return $unite_options[$option_id];
        
    }

endif;

/**
 * Get Unite Theme Option
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @param     string    The option ID
 * @return    mixed 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( ! function_exists( 'ut_get_option' ) ) :

    function ut_get_option( $option_id, $default = false ) {
    
        /* get the saved options */ 
        $unite_options = get_option( ut_options_key() );
        
        /* look for the saved value */
        if ( isset( $unite_options[$option_id] ) ) {
            
            return apply_filters( 'ut_get_option', ut_wpml_filter( $unite_options, $option_id ) );
                
        }
            
        return apply_filters( 'ut_get_option', $default );
    
    }
  
endif;

/**
 * Get Unite Customizer Option
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @param     string    The option ID
 * @return    mixed 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_get_customize_option' ) ) :
    
    function ut_get_customize_option( $option_name = '', $default = '' ) {

        $options = apply_filters( 'ut_get_customize_option', get_option( ut_customizer_key() ), $option_name, $default );

        if( ! empty( $option_name ) && ! empty( $options[$option_name] ) ) {
            
            return $options[$option_name];
        
        } else {
            
            return ( ! empty( $default ) ) ? $default : null;

        }

    }
  
endif;

/**
 * Echo Unite Theme Option
 *
 * Helper function to echo the option value.
 * If value is not available, it echos $default
 *
 * @param     string    The option ID
 * @return    mixed 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */

if ( ! function_exists( 'ut_echo_option' ) ) :
  
    function ut_echo_option( $option_id, $default = false ) {
    
        echo ut_get_option( $option_id, $default );
    
    }

endif;

/**
 * Returns true if the current page is a main blog related page
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @return    bolean
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
if ( !function_exists( 'ut_is_blog_related' ) ) :
    
    function ut_is_blog_related() {
    
        return ( is_tag() || is_search() || is_archive() || is_category() || is_home() || is_404() ) ? true : false;
        
    }
    
endif;


/**
 * Get Unite Meta Value
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @param     string    The option ID
 * @param     int       The Post ID ( optional )
 * @return    mixed 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
if( !function_exists( 'ut_get_meta' ) ) :

    function ut_get_meta( $key = '', $post_id = NULL ) {
        
        if( empty( $key ) ) {
            return;
        }          
        
        if( empty( $post_id ) && ut_is_blog_related() ) {
            
            $post_id = get_option('page_for_posts');
            
        }
        
        if( empty( $post_id )  && ut_is_blog_related() ) {
            
            return false;
        
        } elseif( !empty( $post_id ) ) {
            
            return get_post_meta( $post_id, $key, true );
            
        } else {
        
            global $post;
            
            return isset( $post->ID ) ? get_post_meta( $post->ID, $key, true ) : false;

        }               
        
    }
        
endif;

/**
 * Get Theme Option Or Meta Key Option
 *
 * Helper function to return the option value.
 * If value is not available, it returns $default
 *
 * @param     string    The option ID
 * @return    mixed 
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( ! function_exists( 'ut_fetch_option' ) ) :

    function ut_fetch_option( $option_id, $default = false ) {
        
        global $post;
        
        if( isset( $post->ID ) && ut_get_meta( 'ut_' . $option_id, $post->ID ) ) {
            
            return ut_get_meta( 'ut_' . $option_id, $post->ID );
            
        }        
        
        /* get the saved options */ 
        $unite_options = get_option( ut_options_key() );
        
        /* look for the saved value */
        if ( isset( $unite_options[$option_id] ) ) {
            
            return apply_filters( 'ut_fetch_option', ut_wpml_filter( $unite_options, $option_id ) );
                
        }
            
        return apply_filters( 'ut_fetch_option', $default );
    
    }
  
endif;

/**
 * Returns an array with the current sidebar settings
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if( !function_exists( 'ut_get_sidebar_settings' ) && apply_filters( 'ut_activate_sidebars', true ) ) {

	function ut_get_sidebar_settings() {
        
        global $post;
        
        /* define settings array */
        $sidebar_settings = array();
                
        /* try to fetch sidebar alignment */
        $ut_sidebar_align = !ut_is_blog_related() ? ut_get_meta( 'ut_sidebar_align' ) : NULL;
                                               
        /* default setting from sidebar admin */
        if( $ut_sidebar_align == 'default' || empty( $ut_sidebar_align ) ) {            
            
            /* blog default align */
            if( ut_is_blog_related() || is_404() ) {
            
                /* default align from admin */
                $sidebar_settings['align'] = get_option( 'unite_blog_sidebar_align' );
            
            }
            
            if( is_single() ) {
                
                /* default align from admin */
                $sidebar_settings['align'] = get_option( 'unite_blog_single_sidebar_align' );
                
            }
                        
            /* page default align */
            if( is_page() ) {
                
                /* default align from admin */
                $sidebar_settings['align'] = get_option( 'unite_page_sidebar_align' );
                
            }
                        
            /* woocommerce default sidebar align */
            if( function_exists('is_shop') ) {
			
			    if( is_shop() ) {
                    
                    /* default align from admin */
                    $sidebar_settings['align'] = get_option('unite_woo_sidebar_align');
                    
                }
            
            }
        
        } else {
            
            /* set align */
            $sidebar_settings['align'] = $ut_sidebar_align;
        
        }
        
        /* primary sidebar */
        $primary_sidebar = !ut_is_blog_related() ? ut_get_meta( 'ut_primary_sidebar' ) : NULL;
                
        if( empty( $primary_sidebar ) && $ut_sidebar_align != 'none' ) {
            
            /* blog default sidebar */
            if( ut_is_blog_related() || is_404() ) {
            
                /* default sidebar from admin */
                $primary_sidebar = get_option( 'unite_blog_primary_sidebar' );
            
            }
            
            if( is_single() ) {
                
                /* default sidebar from admin */
                $primary_sidebar = get_option( 'unite_blog_single_primary_sidebar' );
                
            }
                        
            /* page default sidebar */
            if( is_page() ) {
                
                /* default sidebar from admin */
                $primary_sidebar = get_option( 'unite_page_primary_sidebar' );
                
            }
                        
            /* woocommerce default sidebar */
            if( function_exists('is_shop') ) {
			
			    if( is_shop() ) {
                    
                    /* default sidebar from admin */
                    $primary_sidebar = get_option('unite_woo_primary_sidebar');
                    
                }
            
            }
            
        }       
        
        if( apply_filters( 'ut_activate_secondary_sidebar', false ) ) {
        
            /* secondary sidebar */
            $secondary_sidebar = !ut_is_blog_related() ? ut_get_meta( 'ut_secondary_sidebar' ) : NULL;
            
            if( empty( $secondary_sidebar ) && $ut_sidebar_align != 'none' ) {
                
                /* blog default secondary sidebar */
                if( ut_is_blog_related() || is_404() ) {
                
                    /* default sidebar from admin */
                    $secondary_sidebar = get_option( 'unite_blog_secondary_sidebar' );
                
                }
                
                if( is_single() ) {
                    
                    /* default sidebar from admin */
                    $secondary_sidebar = get_option( 'unite_blog_single_secondary_sidebar' );
                    
                }
                            
                /* page default align */
                if( is_page() ) {
                    
                    /* default sidebar from admin */
                    $secondary_sidebar = get_option( 'unite_page_secondary_sidebar' );
                    
                }
                            
                /* woocommerce default sidebar */
                if( function_exists('is_shop') ) {
                
                    if( is_shop() ) {
                        
                        /* default sidebar from admin */
                        $secondary_sidebar = get_option('unite_woo_secondary_sidebar');
                        
                    }
                
                }
                
            } 
        
        } else {
            
            $secondary_sidebar = $primary_sidebar;
            
        }
        
        /* set a flag if sidebars have widgets or not */
        $sidebar_settings['primary_active']   = is_active_sidebar( apply_filters( 'unite_primary_sidebar', $primary_sidebar ) );
        $sidebar_settings['secondary_active'] = is_active_sidebar( apply_filters( 'unite_secondary_sidebar', $secondary_sidebar ) );
        
        /* push the selected sidebars into array */
        $sidebar_settings['primary_sidebar']   = apply_filters( 'unite_primary_sidebar', $primary_sidebar );
        $sidebar_settings['secondary_sidebar'] = apply_filters( 'unite_secondary_sidebar', $secondary_sidebar ); 
        
        /* push the sidebar align into array */
        $sidebar_settings['align'] = apply_filters( 'unite_sidebar_align', isset( $sidebar_settings['align'] ) ? $sidebar_settings['align'] : '' ); 
        
        /* now return the complete sidebar settings */
        return $sidebar_settings;        
            
    }

}

/**
 * Return an array with available icons
 *
 * @return    array    array with icons
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( !function_exists( 'ut_recognized_icons' ) ) {

    function ut_recognized_icons() {
                
        /* font awesome 4.5.0 */
        $icons = array (
              0 => 'fa-glass',
              1 => 'fa-music',
              2 => 'fa-search',
              3 => 'fa-envelope-o',
              4 => 'fa-heart',
              5 => 'fa-star',
              6 => 'fa-star-o',
              7 => 'fa-user',
              8 => 'fa-film',
              9 => 'fa-th-large',
              10 => 'fa-th',
              11 => 'fa-th-list',
              12 => 'fa-check',
              13 => 'fa-times',
              14 => 'fa-search-plus',
              15 => 'fa-search-minus',
              16 => 'fa-power-off',
              17 => 'fa-signal',
              18 => 'fa-cog',
              19 => 'fa-trash-o',
              20 => 'fa-home',
              21 => 'fa-file-o',
              22 => 'fa-clock-o',
              23 => 'fa-road',
              24 => 'fa-download',
              25 => 'fa-arrow-circle-o-down',
              26 => 'fa-arrow-circle-o-up',
              27 => 'fa-inbox',
              28 => 'fa-play-circle-o',
              29 => 'fa-repeat',
              30 => 'fa-refresh',
              31 => 'fa-list-alt',
              32 => 'fa-lock',
              33 => 'fa-flag',
              34 => 'fa-headphones',
              35 => 'fa-volume-off',
              36 => 'fa-volume-down',
              37 => 'fa-volume-up',
              38 => 'fa-qrcode',
              39 => 'fa-barcode',
              40 => 'fa-tag',
              41 => 'fa-tags',
              42 => 'fa-book',
              43 => 'fa-bookmark',
              44 => 'fa-print',
              45 => 'fa-camera',
              46 => 'fa-font',
              47 => 'fa-bold',
              48 => 'fa-italic',
              49 => 'fa-text-height',
              50 => 'fa-text-width',
              51 => 'fa-align-left',
              52 => 'fa-align-center',
              53 => 'fa-align-right',
              54 => 'fa-align-justify',
              55 => 'fa-list',
              56 => 'fa-outdent',
              57 => 'fa-indent',
              58 => 'fa-video-camera',
              59 => 'fa-picture-o',
              60 => 'fa-pencil',
              61 => 'fa-map-marker',
              62 => 'fa-adjust',
              63 => 'fa-tint',
              64 => 'fa-pencil-square-o',
              65 => 'fa-share-square-o',
              66 => 'fa-check-square-o',
              67 => 'fa-arrows',
              68 => 'fa-step-backward',
              69 => 'fa-fast-backward',
              70 => 'fa-backward',
              71 => 'fa-play',
              72 => 'fa-pause',
              73 => 'fa-stop',
              74 => 'fa-forward',
              75 => 'fa-fast-forward',
              76 => 'fa-step-forward',
              77 => 'fa-eject',
              78 => 'fa-chevron-left',
              79 => 'fa-chevron-right',
              80 => 'fa-plus-circle',
              81 => 'fa-minus-circle',
              82 => 'fa-times-circle',
              83 => 'fa-check-circle',
              84 => 'fa-question-circle',
              85 => 'fa-info-circle',
              86 => 'fa-crosshairs',
              87 => 'fa-times-circle-o',
              88 => 'fa-check-circle-o',
              89 => 'fa-ban',
              90 => 'fa-arrow-left',
              91 => 'fa-arrow-right',
              92 => 'fa-arrow-up',
              93 => 'fa-arrow-down',
              94 => 'fa-share',
              95 => 'fa-expand',
              96 => 'fa-compress',
              97 => 'fa-plus',
              98 => 'fa-minus',
              99 => 'fa-asterisk',
              100 => 'fa-exclamation-circle',
              101 => 'fa-gift',
              102 => 'fa-leaf',
              103 => 'fa-fire',
              104 => 'fa-eye',
              105 => 'fa-eye-slash',
              106 => 'fa-exclamation-triangle',
              107 => 'fa-plane',
              108 => 'fa-calendar',
              109 => 'fa-random',
              110 => 'fa-comment',
              111 => 'fa-magnet',
              112 => 'fa-chevron-up',
              113 => 'fa-chevron-down',
              114 => 'fa-retweet',
              115 => 'fa-shopping-cart',
              116 => 'fa-folder',
              117 => 'fa-folder-open',
              118 => 'fa-arrows-v',
              119 => 'fa-arrows-h',
              120 => 'fa-bar-chart',
              121 => 'fa-twitter-square',
              122 => 'fa-facebook-square',
              123 => 'fa-camera-retro',
              124 => 'fa-key',
              125 => 'fa-cogs',
              126 => 'fa-comments',
              127 => 'fa-thumbs-o-up',
              128 => 'fa-thumbs-o-down',
              129 => 'fa-star-half',
              130 => 'fa-heart-o',
              131 => 'fa-sign-out',
              132 => 'fa-linkedin-square',
              133 => 'fa-thumb-tack',
              134 => 'fa-external-link',
              135 => 'fa-sign-in',
              136 => 'fa-trophy',
              137 => 'fa-github-square',
              138 => 'fa-upload',
              139 => 'fa-lemon-o',
              140 => 'fa-phone',
              141 => 'fa-square-o',
              142 => 'fa-bookmark-o',
              143 => 'fa-phone-square',
              144 => 'fa-twitter',
              145 => 'fa-facebook',
              146 => 'fa-github',
              147 => 'fa-unlock',
              148 => 'fa-credit-card',
              149 => 'fa-rss',
              150 => 'fa-hdd-o',
              151 => 'fa-bullhorn',
              152 => 'fa-bell',
              153 => 'fa-certificate',
              154 => 'fa-hand-o-right',
              155 => 'fa-hand-o-left',
              156 => 'fa-hand-o-up',
              157 => 'fa-hand-o-down',
              158 => 'fa-arrow-circle-left',
              159 => 'fa-arrow-circle-right',
              160 => 'fa-arrow-circle-up',
              161 => 'fa-arrow-circle-down',
              162 => 'fa-globe',
              163 => 'fa-wrench',
              164 => 'fa-tasks',
              165 => 'fa-filter',
              166 => 'fa-briefcase',
              167 => 'fa-arrows-alt',
              168 => 'fa-users',
              169 => 'fa-link',
              170 => 'fa-cloud',
              171 => 'fa-flask',
              172 => 'fa-scissors',
              173 => 'fa-files-o',
              174 => 'fa-paperclip',
              175 => 'fa-floppy-o',
              176 => 'fa-square',
              177 => 'fa-bars',
              178 => 'fa-list-ul',
              179 => 'fa-list-ol',
              180 => 'fa-strikethrough',
              181 => 'fa-underline',
              182 => 'fa-table',
              183 => 'fa-magic',
              184 => 'fa-truck',
              185 => 'fa-pinterest',
              186 => 'fa-pinterest-square',
              187 => 'fa-google-plus-square',
              188 => 'fa-google-plus',
              189 => 'fa-money',
              190 => 'fa-caret-down',
              191 => 'fa-caret-up',
              192 => 'fa-caret-left',
              193 => 'fa-caret-right',
              194 => 'fa-columns',
              195 => 'fa-sort',
              196 => 'fa-sort-desc',
              197 => 'fa-sort-asc',
              198 => 'fa-envelope',
              199 => 'fa-linkedin',
              200 => 'fa-undo',
              201 => 'fa-gavel',
              202 => 'fa-tachometer',
              203 => 'fa-comment-o',
              204 => 'fa-comments-o',
              205 => 'fa-bolt',
              206 => 'fa-sitemap',
              207 => 'fa-umbrella',
              208 => 'fa-clipboard',
              209 => 'fa-lightbulb-o',
              210 => 'fa-exchange',
              211 => 'fa-cloud-download',
              212 => 'fa-cloud-upload',
              213 => 'fa-user-md',
              214 => 'fa-stethoscope',
              215 => 'fa-suitcase',
              216 => 'fa-bell-o',
              217 => 'fa-coffee',
              218 => 'fa-cutlery',
              219 => 'fa-file-text-o',
              220 => 'fa-building-o',
              221 => 'fa-hospital-o',
              222 => 'fa-ambulance',
              223 => 'fa-medkit',
              224 => 'fa-fighter-jet',
              225 => 'fa-beer',
              226 => 'fa-h-square',
              227 => 'fa-plus-square',
              228 => 'fa-angle-double-left',
              229 => 'fa-angle-double-right',
              230 => 'fa-angle-double-up',
              231 => 'fa-angle-double-down',
              232 => 'fa-angle-left',
              233 => 'fa-angle-right',
              234 => 'fa-angle-up',
              235 => 'fa-angle-down',
              236 => 'fa-desktop',
              237 => 'fa-laptop',
              238 => 'fa-tablet',
              239 => 'fa-mobile',
              240 => 'fa-circle-o',
              241 => 'fa-quote-left',
              242 => 'fa-quote-right',
              243 => 'fa-spinner',
              244 => 'fa-circle',
              245 => 'fa-reply',
              246 => 'fa-github-alt',
              247 => 'fa-folder-o',
              248 => 'fa-folder-open-o',
              249 => 'fa-smile-o',
              250 => 'fa-frown-o',
              251 => 'fa-meh-o',
              252 => 'fa-gamepad',
              253 => 'fa-keyboard-o',
              254 => 'fa-flag-o',
              255 => 'fa-flag-checkered',
              256 => 'fa-terminal',
              257 => 'fa-code',
              258 => 'fa-reply-all',
              259 => 'fa-star-half-o',
              260 => 'fa-location-arrow',
              261 => 'fa-crop',
              262 => 'fa-code-fork',
              263 => 'fa-chain-broken',
              264 => 'fa-question',
              265 => 'fa-info',
              266 => 'fa-exclamation',
              267 => 'fa-superscript',
              268 => 'fa-subscript',
              269 => 'fa-eraser',
              270 => 'fa-puzzle-piece',
              271 => 'fa-microphone',
              272 => 'fa-microphone-slash',
              273 => 'fa-shield',
              274 => 'fa-calendar-o',
              275 => 'fa-fire-extinguisher',
              276 => 'fa-rocket',
              277 => 'fa-maxcdn',
              278 => 'fa-chevron-circle-left',
              279 => 'fa-chevron-circle-right',
              280 => 'fa-chevron-circle-up',
              281 => 'fa-chevron-circle-down',
              282 => 'fa-html5',
              283 => 'fa-css3',
              284 => 'fa-anchor',
              285 => 'fa-unlock-alt',
              286 => 'fa-bullseye',
              287 => 'fa-ellipsis-h',
              288 => 'fa-ellipsis-v',
              289 => 'fa-rss-square',
              290 => 'fa-play-circle',
              291 => 'fa-ticket',
              292 => 'fa-minus-square',
              293 => 'fa-minus-square-o',
              294 => 'fa-level-up',
              295 => 'fa-level-down',
              296 => 'fa-check-square',
              297 => 'fa-pencil-square',
              298 => 'fa-external-link-square',
              299 => 'fa-share-square',
              300 => 'fa-compass',
              301 => 'fa-caret-square-o-down',
              302 => 'fa-caret-square-o-up',
              303 => 'fa-caret-square-o-right',
              304 => 'fa-eur',
              305 => 'fa-gbp',
              306 => 'fa-usd',
              307 => 'fa-inr',
              308 => 'fa-jpy',
              309 => 'fa-rub',
              310 => 'fa-krw',
              311 => 'fa-btc',
              312 => 'fa-file',
              313 => 'fa-file-text',
              314 => 'fa-sort-alpha-asc',
              315 => 'fa-sort-alpha-desc',
              316 => 'fa-sort-amount-asc',
              317 => 'fa-sort-amount-desc',
              318 => 'fa-sort-numeric-asc',
              319 => 'fa-sort-numeric-desc',
              320 => 'fa-thumbs-up',
              321 => 'fa-thumbs-down',
              322 => 'fa-youtube-square',
              323 => 'fa-youtube',
              324 => 'fa-xing',
              325 => 'fa-xing-square',
              326 => 'fa-youtube-play',
              327 => 'fa-dropbox',
              328 => 'fa-stack-overflow',
              329 => 'fa-instagram',
              330 => 'fa-flickr',
              331 => 'fa-adn',
              332 => 'fa-bitbucket',
              333 => 'fa-bitbucket-square',
              334 => 'fa-tumblr',
              335 => 'fa-tumblr-square',
              336 => 'fa-long-arrow-down',
              337 => 'fa-long-arrow-up',
              338 => 'fa-long-arrow-left',
              339 => 'fa-long-arrow-right',
              340 => 'fa-apple',
              341 => 'fa-windows',
              342 => 'fa-android',
              343 => 'fa-linux',
              344 => 'fa-dribbble',
              345 => 'fa-skype',
              346 => 'fa-foursquare',
              347 => 'fa-trello',
              348 => 'fa-female',
              349 => 'fa-male',
              350 => 'fa-gratipay',
              351 => 'fa-sun-o',
              352 => 'fa-moon-o',
              353 => 'fa-archive',
              354 => 'fa-bug',
              355 => 'fa-vk',
              356 => 'fa-weibo',
              357 => 'fa-renren',
              358 => 'fa-pagelines',
              359 => 'fa-stack-exchange',
              360 => 'fa-arrow-circle-o-right',
              361 => 'fa-arrow-circle-o-left',
              362 => 'fa-caret-square-o-left',
              363 => 'fa-dot-circle-o',
              364 => 'fa-wheelchair',
              365 => 'fa-vimeo-square',
              366 => 'fa-try',
              367 => 'fa-plus-square-o',
              368 => 'fa-space-shuttle',
              369 => 'fa-slack',
              370 => 'fa-envelope-square',
              371 => 'fa-wordpress',
              372 => 'fa-openid',
              373 => 'fa-university',
              374 => 'fa-graduation-cap',
              375 => 'fa-yahoo',
              376 => 'fa-google',
              377 => 'fa-reddit',
              378 => 'fa-reddit-square',
              379 => 'fa-stumbleupon-circle',
              380 => 'fa-stumbleupon',
              381 => 'fa-delicious',
              382 => 'fa-digg',
              383 => 'fa-pied-piper-pp',
              384 => 'fa-pied-piper-alt',
              385 => 'fa-drupal',
              386 => 'fa-joomla',
              387 => 'fa-language',
              388 => 'fa-fax',
              389 => 'fa-building',
              390 => 'fa-child',
              391 => 'fa-paw',
              392 => 'fa-spoon',
              393 => 'fa-cube',
              394 => 'fa-cubes',
              395 => 'fa-behance',
              396 => 'fa-behance-square',
              397 => 'fa-steam',
              398 => 'fa-steam-square',
              399 => 'fa-recycle',
              400 => 'fa-car',
              401 => 'fa-taxi',
              402 => 'fa-tree',
              403 => 'fa-spotify',
              404 => 'fa-deviantart',
              405 => 'fa-soundcloud',
              406 => 'fa-database',
              407 => 'fa-file-pdf-o',
              408 => 'fa-file-word-o',
              409 => 'fa-file-excel-o',
              410 => 'fa-file-powerpoint-o',
              411 => 'fa-file-image-o',
              412 => 'fa-file-archive-o',
              413 => 'fa-file-audio-o',
              414 => 'fa-file-video-o',
              415 => 'fa-file-code-o',
              416 => 'fa-vine',
              417 => 'fa-codepen',
              418 => 'fa-jsfiddle',
              419 => 'fa-life-ring',
              420 => 'fa-circle-o-notch',
              421 => 'fa-rebel',
              422 => 'fa-empire',
              423 => 'fa-git-square',
              424 => 'fa-git',
              425 => 'fa-hacker-news',
              426 => 'fa-tencent-weibo',
              427 => 'fa-qq',
              428 => 'fa-weixin',
              429 => 'fa-paper-plane',
              430 => 'fa-paper-plane-o',
              431 => 'fa-history',
              432 => 'fa-circle-thin',
              433 => 'fa-header',
              434 => 'fa-paragraph',
              435 => 'fa-sliders',
              436 => 'fa-share-alt',
              437 => 'fa-share-alt-square',
              438 => 'fa-bomb',
              439 => 'fa-futbol-o',
              440 => 'fa-tty',
              441 => 'fa-binoculars',
              442 => 'fa-plug',
              443 => 'fa-slideshare',
              444 => 'fa-twitch',
              445 => 'fa-yelp',
              446 => 'fa-newspaper-o',
              447 => 'fa-wifi',
              448 => 'fa-calculator',
              449 => 'fa-paypal',
              450 => 'fa-google-wallet',
              451 => 'fa-cc-visa',
              452 => 'fa-cc-mastercard',
              453 => 'fa-cc-discover',
              454 => 'fa-cc-amex',
              455 => 'fa-cc-paypal',
              456 => 'fa-cc-stripe',
              457 => 'fa-bell-slash',
              458 => 'fa-bell-slash-o',
              459 => 'fa-trash',
              460 => 'fa-copyright',
              461 => 'fa-at',
              462 => 'fa-eyedropper',
              463 => 'fa-paint-brush',
              464 => 'fa-birthday-cake',
              465 => 'fa-area-chart',
              466 => 'fa-pie-chart',
              467 => 'fa-line-chart',
              468 => 'fa-lastfm',
              469 => 'fa-lastfm-square',
              470 => 'fa-toggle-off',
              471 => 'fa-toggle-on',
              472 => 'fa-bicycle',
              473 => 'fa-bus',
              474 => 'fa-ioxhost',
              475 => 'fa-angellist',
              476 => 'fa-cc',
              477 => 'fa-ils',
              478 => 'fa-meanpath',
              479 => 'fa-buysellads',
              480 => 'fa-connectdevelop',
              481 => 'fa-dashcube',
              482 => 'fa-forumbee',
              483 => 'fa-leanpub',
              484 => 'fa-sellsy',
              485 => 'fa-shirtsinbulk',
              486 => 'fa-simplybuilt',
              487 => 'fa-skyatlas',
              488 => 'fa-cart-plus',
              489 => 'fa-cart-arrow-down',
              490 => 'fa-diamond',
              491 => 'fa-ship',
              492 => 'fa-user-secret',
              493 => 'fa-motorcycle',
              494 => 'fa-street-view',
              495 => 'fa-heartbeat',
              496 => 'fa-venus',
              497 => 'fa-mars',
              498 => 'fa-mercury',
              499 => 'fa-transgender',
              500 => 'fa-transgender-alt',
              501 => 'fa-venus-double',
              502 => 'fa-mars-double',
              503 => 'fa-venus-mars',
              504 => 'fa-mars-stroke',
              505 => 'fa-mars-stroke-v',
              506 => 'fa-mars-stroke-h',
              507 => 'fa-neuter',
              508 => 'fa-genderless',
              509 => 'fa-facebook-official',
              510 => 'fa-pinterest-p',
              511 => 'fa-whatsapp',
              512 => 'fa-server',
              513 => 'fa-user-plus',
              514 => 'fa-user-times',
              515 => 'fa-bed',
              516 => 'fa-viacoin',
              517 => 'fa-train',
              518 => 'fa-subway',
              519 => 'fa-medium',
              520 => 'fa-y-combinator',
              521 => 'fa-optin-monster',
              522 => 'fa-opencart',
              523 => 'fa-expeditedssl',
              524 => 'fa-battery-full',
              525 => 'fa-battery-three-quarters',
              526 => 'fa-battery-half',
              527 => 'fa-battery-quarter',
              528 => 'fa-battery-empty',
              529 => 'fa-mouse-pointer',
              530 => 'fa-i-cursor',
              531 => 'fa-object-group',
              532 => 'fa-object-ungroup',
              533 => 'fa-sticky-note',
              534 => 'fa-sticky-note-o',
              535 => 'fa-cc-jcb',
              536 => 'fa-cc-diners-club',
              537 => 'fa-clone',
              538 => 'fa-balance-scale',
              539 => 'fa-hourglass-o',
              540 => 'fa-hourglass-start',
              541 => 'fa-hourglass-half',
              542 => 'fa-hourglass-end',
              543 => 'fa-hourglass',
              544 => 'fa-hand-rock-o',
              545 => 'fa-hand-paper-o',
              546 => 'fa-hand-scissors-o',
              547 => 'fa-hand-lizard-o',
              548 => 'fa-hand-spock-o',
              549 => 'fa-hand-pointer-o',
              550 => 'fa-hand-peace-o',
              551 => 'fa-trademark',
              552 => 'fa-registered',
              553 => 'fa-creative-commons',
              554 => 'fa-gg',
              555 => 'fa-gg-circle',
              556 => 'fa-tripadvisor',
              557 => 'fa-odnoklassniki',
              558 => 'fa-odnoklassniki-square',
              559 => 'fa-get-pocket',
              560 => 'fa-wikipedia-w',
              561 => 'fa-safari',
              562 => 'fa-chrome',
              563 => 'fa-firefox',
              564 => 'fa-opera',
              565 => 'fa-internet-explorer',
              566 => 'fa-television',
              567 => 'fa-contao',
              568 => 'fa-500px',
              569 => 'fa-amazon',
              570 => 'fa-calendar-plus-o',
              571 => 'fa-calendar-minus-o',
              572 => 'fa-calendar-times-o',
              573 => 'fa-calendar-check-o',
              574 => 'fa-industry',
              575 => 'fa-map-pin',
              576 => 'fa-map-signs',
              577 => 'fa-map-o',
              578 => 'fa-map',
              579 => 'fa-commenting',
              580 => 'fa-commenting-o',
              581 => 'fa-houzz',
              582 => 'fa-vimeo',
              583 => 'fa-black-tie',
              584 => 'fa-fonticons',
              585 => 'fa-reddit-alien',
              586 => 'fa-edge',
              587 => 'fa-credit-card-alt',
              588 => 'fa-codiepie',
              589 => 'fa-modx',
              590 => 'fa-fort-awesome',
              591 => 'fa-usb',
              592 => 'fa-product-hunt',
              593 => 'fa-mixcloud',
              594 => 'fa-scribd',
              595 => 'fa-pause-circle',
              596 => 'fa-pause-circle-o',
              597 => 'fa-stop-circle',
              598 => 'fa-stop-circle-o',
              599 => 'fa-shopping-bag',
              600 => 'fa-shopping-basket',
              601 => 'fa-hashtag',
              602 => 'fa-bluetooth',
              603 => 'fa-bluetooth-b',
              604 => 'fa-percent',
              605 => 'fa-gitlab',
              606 => 'fa-wpbeginner',
              607 => 'fa-wpforms',
              608 => 'fa-envira',
              609 => 'fa-universal-access',
              610 => 'fa-wheelchair-alt',
              611 => 'fa-question-circle-o',
              612 => 'fa-blind',
              613 => 'fa-audio-description',
              614 => 'fa-volume-control-phone',
              615 => 'fa-braille',
              616 => 'fa-assistive-listening-systems',
              617 => 'fa-american-sign-language-interpreting',
              618 => 'fa-deaf',
              619 => 'fa-glide',
              620 => 'fa-glide-g',
              621 => 'fa-sign-language',
              622 => 'fa-low-vision',
              623 => 'fa-viadeo',
              624 => 'fa-viadeo-square',
              625 => 'fa-snapchat',
              626 => 'fa-snapchat-ghost',
              627 => 'fa-snapchat-square',
              628 => 'fa-pied-piper',
              629 => 'fa-first-order',
              630 => 'fa-yoast',
              631 => 'fa-themeisle',
              632 => 'fa-google-plus-official',
              633 => 'fa-font-awesome',
         );
        
        return apply_filters( 'ut_recognized_icons', $icons );
        
    } 

}


/**
 * Initializes Meta Boxes
 *
 * @return    void
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( 'ut_initialize_metabox' ) ) {

    function ut_initialize_metabox( $metabox_settings ) {
        
        if( empty( $metabox_settings ) || !is_admin() ) {
            return;
        }
        
        $unite_meta_box = new UT_Metabox( $metabox_settings );        
        
    }

}