<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

if( !function_exists('sidebar_select_meta_box') ) { 
        
    function sidebar_select_meta_box() {
        
        global $wp_registered_sidebars;
        
        /* create metabox array */
        $unite_meta_box = array(); 
        
        /* Metabox Info
         *
         * add this code line to every custom meta box
         *
         * function     string : named of function which this configuration has been set in
         * file         string : filename the function has been stored in
         */
        
        $unite_meta_box['info'] = array(
            'function'  => __FUNCTION__,
            'file'      => __FILE__            
        );
        
        /* Metabox Config
         *
         * id           string  : HTML 'id' attribute of the edit screen section
         * title        string  : Title of the edit screen section, visible to user 
         * screen       array   : The type of writing screen on which to show the edit screen section like  ('post', 'page', 'dashboard', 'link', 'attachment' or 'custom_post_type' where custom_post_type is the custom post type slug).
         * context      string  : The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side'). 
         * priority     string  : The priority within the context where the boxes should show ('high', 'core', 'default' or 'low') 
         *
         */
         
        $unite_meta_box['config'] = array(
            
            'id'        =>  'ut_sidebar_settings',
            'title'     =>  'Sidebar Settings',
            'screen'    =>  array( 'page' , 'post', 'portfolio', 'product' ), 
            'context'   =>  'side',
            'priority'  =>  'low',
            
        );
        
        
        /* MetaBox Seections*/
        $unite_meta_box['sections'] = array(
        
            array(
                    
                'id'          => 'sidebar_setting',
                'title'       => esc_html__( 'Sidebar Setting', 'unite-admin' ),
                'icon'        => 'fa-globe'                
                
            ),
        
        );        
        
        /* MetaBox Settings*/
        $unite_meta_box['settings'] = array(
            
            array(
                'id'          => 'ut_primary_sidebar',
                'section'     => 'sidebar_setting',
                'title'       => esc_html__( 'Select Sidebar', 'unite-admin' ),
                'type'        => 'sidebar-select',
                'default'     => '',
                'class'       => 'ut-sidebar-box'
            ),
            
            array(
                'id'          => 'ut_sidebar_align',
                'section'     => 'sidebar_setting',
                'title'       => esc_html__( 'Select Sidebar Align', 'unite-admin' ),
                'type'        => 'select',
                //'desc'        => esc_html__( '', 'unite-admin' ),
                'choices'     => _ut_recognized_sidebar_align(),
                'default'     => 'default',
                'class'       => 'ut-sidebar-box'
            )
        
        );
        
        /* initialize metabox */
        $unite_meta_box = new UT_Metabox( $unite_meta_box );

    }  
    
    /* only run if theme config is true */
    if( apply_filters( 'ut_activate_sidebars', true ) ) {
    
        add_action( 'admin_init', 'sidebar_select_meta_box' );
    
    }
        
}