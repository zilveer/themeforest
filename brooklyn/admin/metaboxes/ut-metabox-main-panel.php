<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UT_Meta_Panel {

    private $dir;
    private $file;
    private $assets_dir;
    private $assets_url;
    private $token;
    private $post_ID;
    
    public function __construct( $file ) {
        
        if( isset( $_GET['post'] ) && $_GET['post'] == get_option('page_on_front') || isset( $_GET['post'] ) && $_GET['post'] == get_option('page_for_posts') ) {
            return;
        } 
        
        $this->dir        = dirname( $file );
        $this->file       = $file;        
        $this->assets_dir = THEME_DOCUMENT_ROOT . '/admin/assets';
        $this->assets_url = THEME_WEB_ROOT . '/admin/assets';
        $this->token      = 'page';
        
        if ( is_admin() ) {
            
            /* meta box html */
            add_action( 'admin_menu', array( &$this, 'meta_box_setup' ), 20 );
            
            /* necessary scripts and styles */
            add_action( 'admin_print_styles-post.php', array( &$this, 'register_settings_styles' ) );
            add_action( 'admin_print_styles-post-new.php', array( &$this, 'register_settings_styles' ) );
                        
        }
    
    }    
    
    public function register_settings_styles() {
        
        global $post_ID;
        
        /* custom css files */
        wp_enqueue_style('ut-metapanel-styles', $this->assets_url . '/css/ut.metapanel.css');
        
        /* custom js files */
        wp_enqueue_script('ut-metapanel-scripts', $this->assets_url . '/js/ut.metapanel.js' );
        
        $popup_vars = array( 'pop_url' => THEME_WEB_ROOT . '/admin/' );
        
        if( get_post_type( $post_ID ) == 'portfolio' ) {
            $popup_vars['post_type'] = get_post_type( $post_ID );
        }
        
        wp_localize_script( 'ut-metapanel-scripts', 'ut_meta_panel_vars', $popup_vars );
    
    }
    
    public function meta_box_setup() {        
        
        add_meta_box( 
            'ut-metapanel' , 
            esc_html__( 'United Themes - Page and Section Settings' , 'unitedthemes' ), 
            array( &$this, 'meta_box_content' ), 
            $this->token, 'normal', 
            'default'
        );
        
        add_meta_box( 
            'ut-metapanel' , 
            esc_html__( 'United Themes - Portfolio Settings' , 'unitedthemes' ), 
            array( &$this, 'meta_box_content' ), 
            'portfolio', 
            'normal', 
            'default'
        );
        
        add_meta_box( 
            'ut-metapanel' , 
            esc_html__( 'United Themes - Product Settings' , 'unitedthemes' ), 
            array( &$this, 'meta_box_content' ), 
            'product', 
            'normal', 
            'default'
        );
        
    }
    
    public function meta_box_content() {
        
        global $post_ID; ?>
                
        <div id="ut-option-switch-wrap">
            
            <?php 
            
            if( !$this->get_page_menu_id( $post_ID ) && get_post_meta( $post_ID , 'ut_page_type', true ) == 'section' ) {
                
                //echo '<div class="error">' . esc_html__( 'Please do not forget to add this page to the primary menu!' , 'unitedthemes' ) . '</div>';
                
            }
            
            ?>
            
            <div id="ut-option-switch"></div>
            
        </div>
        
        <?php 
        /* check if video background is active and check if current page is a section */
        if( ot_get_option('ut_front_video_containment' ,'hero') == 'body' && get_post_meta( $post_ID , 'ut_page_type', true ) == 'section' && get_post_type($post_ID) == 'page' ) :
            
            /* now check if current page has a background image */
            $ut_parallax_image = get_post_meta( $post_ID , 'ut_parallax_image' , true );
            if( is_array($ut_parallax_image) && !empty( $ut_parallax_image['background-image'] ) ) {
                
                $bg_image = true;
            
            } elseif( !is_array( $ut_parallax_image ) && !empty( $ut_parallax_image ) ) {
                
                $bg_image = true;
            
            } else {
                
                $bg_image = false;
                
            }
            /* now check if current page has a background color */
            $bg_color = get_post_meta( $post_ID , 'ut_section_video_bgcolor', true );
            
            /* now check if current page has a background image */
            $ut_video_poster = get_post_meta( $post_ID , 'ut_section_video_poster' , true );
            if( is_array($ut_video_poster) && !empty( $ut_video_poster['background-image'] ) ) {
                
                $bg_poster = true;
            
            } elseif( !is_array($ut_video_poster) && !empty($ut_video_poster) ) {
                
                $bg_poster = true;
            
            } else {
                
                $bg_poster = false;
                
            }
            
            /* display a message when none of these fields are available */           
            if( !$bg_image && empty($bg_color) && !$bg_poster  ) {
                echo '<div class="ut-notify-user">' . __('Video Background is active. Since this section has been configured to be transparent and the background video will not display on mobile devices, there is no visual output on these devices. Please set a poster image, it will be used as a poster image on mobile devices. Please switch to "Section Video Settings" tab and set a poster image.' , 'unitedthemes') . '</div>';   
            }
            
        endif; 
        
        ?>
        
        <div id="ut-panel-tabs" class="ui-tabs">
            
            <ul class="ui-tabs-nav ui-widget-header">
                
                <?php if( get_post_type($post_ID) == 'portfolio' ) : ?>
                
                <li class="ut-portfolio-details"><a href="#ut-portfolio-details"><?php _e('Portfolio Details' , 'unitedthemes'); ?></a></li>
                
                <?php endif; ?>  
                
                <li class="ut-hero-type">
                    <a href="#ut-hero-type" data-portfolio="<?php _e('One Page Portfolio Type' , 'unitedthemes'); ?>" data-page="<?php _e('Hero Type' , 'unitedthemes'); ?>">
                        
                        <?php if(get_post_type($post_ID) == 'portfolio') : ?>
                        
                            <?php _e('One Page Portfolio Type' , 'unitedthemes'); ?>
                        
                        <?php else : ?>
                        
                            <?php _e('Hero Type' , 'unitedthemes'); ?> 
                            
                        <?php endif; ?>  
                        
                    </a>
                </li>
                <li class="ut-hero-settings"><a href="#ut-hero-settings"><?php _e('Hero Content' , 'unitedthemes'); ?></a></li>
                <li class="ut-hero-styling"><a href="#ut-hero-styling"><?php _e('Hero Styling' , 'unitedthemes'); ?></a></li>                
                <li class="ut-page-header-settings"><a href="#ut-page-header-settings"><?php _e('Header Settings' , 'unitedthemes'); ?></a></li>
                
                <?php if( get_post_meta( $post_ID , 'ut_page_type', true ) == 'page' || get_post_type($post_ID) == 'portfolio' ) : ?>
                
                    <li class="ut-page-settings"><a href="#ut-page-settings"><?php esc_html_e('Page Settings' , 'unitedthemes'); ?></a></li>
                
                <?php endif; ?>
                
                <li class="ut-color-settings"><a href="#ut-color-settings"><?php _e('Color Settings' , 'unitedthemes'); ?></a></li>
                
                <?php if( get_post_type($post_ID) == 'page' ) : ?>
                
                <li class="ut-section-settings"><a href="#ut-section-settings"><?php _e('Section Settings' , 'unitedthemes'); ?></a></li>
                <li class="ut-section-parallax-settings"><a href="#ut-section-parallax-settings"><?php _e('Section Parallax Settings' , 'unitedthemes'); ?></a></li>
                <li class="ut-section-video-settings"><a href="#ut-section-video-settings"><?php _e('Section Video Settings' , 'unitedthemes'); ?></a></li>
                <li class="ut-section-overlay-settings"><a href="#ut-section-overlay-settings"><?php _e('Section Overlay Settings' , 'unitedthemes'); ?></a></li>
                <li class="ut-manage-team"><a href="#ut-manage-team"><?php _e('Manage Team' , 'unitedthemes'); ?></a></li>
                
                <?php endif; ?>
                
                <li class="ut-contact-section"><a href="#ut-contact-section"><?php _e('Contact Section' , 'unitedthemes'); ?></a></li>
                <!-- <li class="ut-navigation-section"><a href="#ut-navigation-section"><?php _e('Navigation' , 'unitedthemes'); ?></a></li> -->
                
            </ul>
            
            <div id="ut-hero-type" class="ui-tabs-panel"></div>
            <div id="ut-hero-settings" class="ui-tabs-panel">
                
                <div id="ut-hero-sub-settings">
                    
                    <ul class="ui-tabs-nav ui-widget-header">
                       
                       <li class="ut-hero-settings"><a href="#ut-hero-content-color-settings"><?php _e('Hero Content Colors' , 'unitedthemes'); ?></a></li>
                       <li class="ut-hero-settings"><a href="#ut-hero-content-custom-html-settings"><?php _e('Hero Custom HTML' , 'unitedthemes'); ?></a></li>
                       <li class="ut-hero-settings"><a href="#ut-hero-content-caption-slogan-settings"><?php _e('Hero Caption Slogan' , 'unitedthemes'); ?></a></li>
                       <li class="ut-hero-settings"><a href="#ut-hero-content-caption-title-settings"><?php _e('Hero Caption Title' , 'unitedthemes'); ?></a></li>
                       <li class="ut-hero-settings"><a href="#ut-hero-content-caption-description-settings"><?php _e('Hero Caption Description' , 'unitedthemes'); ?></a></li>
                       <li class="ut-hero-settings"><a href="#ut-hero-content-button-settings"><?php _e('Hero Buttons' , 'unitedthemes'); ?></a></li>
                                    
                    </ul>
                    
                    <div id="ut-hero-content-color-settings"></div>
                    <div id="ut-hero-content-custom-html-settings"></div>
                    <div id="ut-hero-content-caption-slogan-settings"></div>
                    <div id="ut-hero-content-caption-title-settings"></div>
                    <div id="ut-hero-content-caption-description-settings"></div>
                    <div id="ut-hero-content-button-settings"></div>
                    
                                    
                
                </div>                                
                
            </div>
            <div id="ut-hero-styling" class="ui-tabs-panel"></div>            
            <div id="ut-page-header-settings" class="ui-tabs-panel"></div>            
            <div id="ut-color-settings" class="ui-tabs-panel"></div>
            
            <?php if( get_post_type($post_ID) == 'page' ) : ?>
            
            <div id="ut-section-settings" class="ui-tabs-panel"></div>
            <div id="ut-section-parallax-settings" class="ui-tabs-panel"></div>
            <div id="ut-section-video-settings" class="ui-tabs-panel"></div>
            <div id="ut-section-overlay-settings" class="ui-tabs-panel"></div>            
            <div id="ut-manage-team" class="ui-tabs-panel">                
                
                <div class="format-settings ut-settings-heading">
                    <div class="format-setting type-textblock wide-desc ">
                        <div class="description"><h2><span>Team /</span> Management</h2> 
                            <span class="ut-manage-team-info"><?php _e('In order to be able to manage your team members, please switch the template to "Team Template".' , 'unitedthemes'); ?></span>
                        </div>
                   </div>
                </div>

            </div>
            
            <?php endif; ?>
            
            <?php if( get_post_meta( $post_ID , 'ut_page_type', true ) == 'page' || get_post_type($post_ID) == 'portfolio' ) : ?>
                
                    <div id="ut-page-settings"></div>
                
                <?php endif; ?>
            
            <?php if(get_post_type($post_ID) == 'portfolio') : ?>
            
            <?php
            
                $ut_detail_source = '';    
                $ut_detail_style  = false;
                                    
                /* get current categories */
                $current_categories = wp_get_object_terms( $post_ID , 'portfolio-category' );
                
                $showcases = get_posts( array(
                    'posts_per_page'   => -1,
                    'post_type'        => 'portfolio-manager',
                ) );
                
                if( !empty( $showcases ) && !empty( $current_categories ) ) {
                    
                    foreach( $showcases as $showcase ) {
                        
                        $showcase_categories = '';
                        
                        /* get used categories */
                        $showcase_categories = get_post_meta( $showcase->ID  , 'ut_portfolio_categories', true );
                        
                        foreach( $current_categories as $category ) {
                            
                            /* we have a match */
                            if( array_key_exists( $category->term_id, $showcase_categories ) ) {
                                
                                $portfolio_settings = get_post_meta( $showcase->ID  , 'ut_portfolio_settings', true );
                                
                                $ut_detail_source = $showcase->post_title;
                                $ut_detail_style = !empty( $portfolio_settings['detail_style'] ) ? $portfolio_settings['detail_style'] : false;
                                
                            }
                        
                        }
                    
                    }
                    
                
                }
            
            ?>
            
            <div id="ut-portfolio-details">
                
                <div id="ut-portfolio-settings-info" data-detailstyle="<?php echo esc_attr( $ut_detail_style ); ?>">
                    
                        
                    
                </div>                
            
            </div>
            
            <?php endif; ?>
            
            <div id="ut-contact-section"></div>
            <!--<div id="ut-navigation-section"></div> -->
            
        </div>
        
        <?php if( function_exists('ut_recognized_icons') ) : ?>
            
            <div class="ut-modal-option-tree">
                <div class="ut-modal-box-option-tree ut-admin">
                    
                    <div class="ut-modal-option-tree-header">
                        <div class="inner">
                            <h2><?php _e( 'Choose Icon' , 'unitedthemes' ); ?></h2>
                        </div>
                    </div>
                    
                    <div class="ut-modal-option-tree-body">
                        <div class="inner">
                            <ul class="ut-glyphicons">
                            
                            <?php foreach( ut_recognized_icons() as $key => $icon) {
                                                    
                                $icondisplay = ($icon == 'icon-noicon') ? 'no icon' : '<i class="fa '.$icon.'"></i>';
                                
                                echo '<li><span data-icon="'.$icon.'" class="ut-icon-option-tree">'.$icondisplay.'</span></li>';
                            
                            } ?>
                            
                            </ul>
                        </div>
                    </div>
                    
                    <div class="ut-modal-option-tree-footer">
                        <div class="inner">
                            <a href="#" class="close-ut-modal-option-tree"><?php _e( 'Close' , 'unitedthemes' ); ?></a>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        <?php endif;
       
        
    }
    
    public function get_page_menu_id( $object_id = NULL ) {
    
        $theme_locations = get_nav_menu_locations();
        
        if( empty( $theme_locations['primary'] ) ) {
            return false;
        }
        
        $menu_objects    = get_term( $theme_locations['primary'] , 'nav_menu' );
        $menu_id         = $menu_objects->term_id;
        $menu_object     = wp_get_nav_menu_items( $menu_id );
            
        /* no menu, leave here  */
        if( ! $menu_object ) {
            return false;
        }
        
        foreach ( (array) $menu_object as $key => $menu_item ) {
                    
            if( $menu_item->object_id == $object_id ) {
                                   
                return $menu_item->ID;                
                break;
                
            }
                
        }
        
        return false;
    
    }

}

new UT_Meta_Panel( __FILE__ );

?>