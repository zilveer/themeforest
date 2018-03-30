<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

if( !function_exists('category_option') ) { 
    
    function category_option() {
        
        /* create option array */
        $category_taxonomy_option = array();      
        
        
        /* Taxonomy Option Config
         *
         * taxonomy           array  : Array of taxonomies which should display the option
         */
        $category_taxonomy_option['config'] = array(
            
            'taxonomy'    =>  array('portfolio-category'),
            
        );
        
        $category_taxonomy_option['settings'] = array(
            
            array(
                'id'          => 'category_icon_type',
                'title'       => esc_html__( 'Select Icon Type', 'unite' ),
                'desc'        => esc_html__( 'Only affect Filterable Portfolio with Packery!', 'unite-admin' ),
                'type'        => 'select',
                'choices'     => array(
                    'font'      => 'FontAwesome',
                    'custom'    => 'Custom Icon'
                ),
                'default'     => 'font',
            ), 
            
            array(
                'id'          => 'category_icon',
                'title'       => esc_html__( 'Fontawesome Icon', 'unite-admin' ),
                'label'       => 'Fontawesome Icon',
                'type'        => 'icons',
                'required'    => array(
                    'category_icon_type'   , '===' , 'font'
                ),  
            ),
            
            array(
                'id'          => 'category_custom_icon',
                'section'     => 'general_settings',
                'title'       => esc_html__( 'Category Custom icon', 'unite-admin' ),
                'type'        => 'upload',
                'mime'        => array('image'), /* array of allowed mime types for this field, this affects the media uploader as well */
                'desc'        => esc_html__( 'Upload your desired category custom icon.', 'unite-admin' ),
                'required'    => array(
                    'category_icon_type'   , '===' , 'custom'
                ), 
            ),
                
        );
        
        return $category_taxonomy_option;
        
    }
    
    // $category_taxonomy_option = new UT_Taxonomy_Option( category_option() );

}