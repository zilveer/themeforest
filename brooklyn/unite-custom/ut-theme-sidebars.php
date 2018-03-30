<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

if ( ! function_exists( 'unite_sidebars_init' ) ) {
 
    function unite_sidebars_init() {
        
        register_sidebar( array(
            'name' => __( 'Blog Sidebar', 'unitedthemes' ),
            'id' => 'blog-widget-area',
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
        
        register_sidebar( array(
            'name' => __( 'First Footer Widget Area', 'unitedthemes' ),
            'id' => 'first-footer-widget-area',
            'description' => __( 'The first footer widget area', 'unitedthemes' ),
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
        
        register_sidebar( array(
            'name' => __( 'Second Footer Widget Area', 'unitedthemes' ),
            'id' => 'second-footer-widget-area',
            'description' => __( 'The second footer widget area', 'unitedthemes' ),
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
    
        register_sidebar( array(
            'name' => __( 'Third Footer Widget Area', 'unitedthemes' ),
            'id' => 'third-footer-widget-area',
            'description' => __( 'The third footer widget area', 'unitedthemes' ),
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
    
        register_sidebar( array(
            'name' => __( 'Fourth Footer Widget Area', 'unitedthemes' ),
            'id' => 'fourth-footer-widget-area',
            'description' => __( 'The fourth footer widget area', 'unitedthemes' ),
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
                
        
        register_sidebar( array(
            'name' => __( 'Page Default Sidebar', 'unitedthemes' ),
            'id' => 'page-widget-area',
            'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ) );
        
        /* woocommerce sidebar */
        if( ut_is_plugin_active('woocommerce/woocommerce.php') ) {
            
            register_sidebar( array(
                'name' => __( 'Shop Sidebar', 'unitedthemes' ),
                'id' => 'shop-widget-area',
                'before_widget' => '<li class="clearfix widget-container %1$s %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h3 class="widget-title"><span>',
                'after_title' => '</span></h3>',
            ) );
        
        
        }               

        
        /* Register Custom Sidebars Brooklyn */
        $sidebars = get_option( 'ut_theme_sidebars' );
                    
        if( !empty( $sidebars ) && is_array( $sidebars ) ){
            
            foreach( $sidebars as $num => $sidebar_options ){
                
                if( !empty($sidebar_options['sidebar_id']) ) {
                
                    register_sidebar(array(
                        'name'              => isset($sidebar_options['sidebarname']) ? $sidebar_options['sidebarname'] : __( 'Sidebar without Name', 'unitedthemes' ),
                        'id'                => $sidebar_options['sidebar_id'],
                        'description'       => isset($sidebar_options['sidebardesc']) ? $sidebar_options['sidebardesc'] : '' ,
                        'before_widget'     => '<li id="%1$s" class="clearfix widget-container %2$s">',
                        'after_widget'      => '</li>',
                        'before_title'      => '<h3 class="widget-title"><span>',
                        'after_title'       => '</span></h3>',
                    ));
                
                }
                
            }  
        }
                    
        /* Register Custom Sidebars Unite Framework */
        $sidebars = get_option('unite_theme_sidebars');

        if( !empty( $sidebars ) && is_array( $sidebars ) ){
            
            foreach( $sidebars as $sidebar ){
                
                /* Only register if valid ID is present */
                
                if( !empty( $sidebar['sidebar_id'] ) ) {
                
                    register_sidebar(array(
                        'name'          => isset($sidebar['sidebarname']) ? $sidebar['sidebarname'] : '',
                        'id'            => $sidebar['sidebar_id'],
                        'description'   => isset($sidebar['sidebardesc']) ? $sidebar['sidebardesc'] : '',
                        'before_widget' => '<aside class="widget-container %1$s %2$s clearfix">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title ' . ut_get_option( 'sidebar_widget_title_style', 'ut-title-style1' ) . '"><span>',
                        'after_title'   => '</span></h3>',
                    ));
                
                }
                
            }   
            
        }          
		
    }
    
    add_action( 'widgets_init', 'unite_sidebars_init' );

}


/** 
 * Hides Sidebars from Theme / Metabox Options
 * perfect for static sidebars in special theme locations
 *
 * @since     1.0.0
 * @version   1.1.0
 */
 
if ( ! function_exists( 'unite_sidebars_exceptions' ) ) {
 
    function unite_sidebars_exceptions() {
        
        return apply_filters( 'unite_sidebars_exceptions', array(
            'first-footer-widget-area',
            'second-footer-widget-area',
            'third-footer-widget-area',
            'fourth-footer-widget-area'   
        ) );
        
    }
    
    add_filter( 'ut_strip_sidebars_from_options' , 'unite_sidebars_exceptions' );

}