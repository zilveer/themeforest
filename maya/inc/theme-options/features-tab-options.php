<?php
$yiw_options['features-tab'] = array(
    /* =================== SIDEBARS =================== */
    'add-features-tab' => array(
        array(
            'name' => __( 'Features tab manager', 'yiw' ),
            'type' => 'title'        
        ),
        array(
            'name' => __( 'Create Features tab', 'yiw' ),
            'type' => 'section',
            'effect' => 0
        ),
        array( 'type' => 'open' ),

        array(
            'name' => __( 'Features tab name', 'yiw' ),
            'desc' => __( 'Add new features tab.', 'yiw' ),
            'id' => 'features_tab',
            'type' => 'text',
            'button' => __( 'Add features tab', 'yiw' ),
            'data' => 'array',
            'mode' => 'merge',
            'control' => isset( $wp_post_types ) ? $wp_post_types : array(),
            'show_value' => false,
            'std' => ''
        ),

        array(
            'name' => __('Delete features tabs', 'yiw'),
    	    'desc' => __('Delete the features tabs that you have already created.', 'yiw'),
    	    'values' => 'features_tab',
    	    'label' => array( 'Features tab', 'Features tabs' ),
    	    'type' => 'featurestab-table'
        ),
        
        array( 'type' => 'close' ),
        
    ),
    
    /* =================== END SIDEBARS =================== */ 
);         
?>