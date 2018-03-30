<?php
$yiw_shortcodes = array(
    'one_fourth' => array(
        'name' => __( 'Column 1/4', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'one_fourth_last' => array(
        'name' => __( 'Column 1/4 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'one_third' => array(
        'name' => __( 'Column 1/3', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'one_third_last' => array(
        'name' => __( 'Column 1/3 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_third' => array(
        'name' => __( 'Column 2/3', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_third_last' => array(
        'name' => __( 'Column 2/3 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),    
    'two_fourth' => array(
        'name' => __( 'Column 2/4', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'two_fourth_last' => array(
        'name' => __( 'Column 2/4 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'third_fourth' => array(
        'name' => __( 'Column 3/4', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'third_fourth_last' => array(
        'name' => __( 'Column 3/4 last', 'yiw' ),
        'content' => true,    // se lo shortcode deve contenere contenuto
    ),
    'recentpost' => array(
        'name' => __( 'Recent Posts', 'yiw' ), 
        'content' => false,  
        'parameters' => array(      // la lista dei parametri da poter utilizzare nello shortcode
            array(
                'name' => __( 'Items', 'yiw' ),
                'id' => 'items',
                'type' => 'text',      
                'desc' => __( 'The number of items to display', 'yiw' ),  
                'std' => '3'
            ),
            array(
                'name' => __( 'More Text', 'yiw' ),  
                'id' => 'more_text',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __( 'Show Thumb?', 'yiw' ),  
                'id' => 'show_thumb',
                'type' => 'select',
                'options' => array(
                    'yes' => __( 'Yes', 'yiw' ),
                    'no' => __( 'No', 'yiw' )
                ),
                'std' => 'yes'
            ),
            array(
                'name' => __( 'Show Date?', 'yiw' ),  
                'id' => 'date',
                'type' => 'select',
                'options' => array(
                    'true' => __( 'Yes', 'yiw' ),
                    'false' => __( 'No', 'yiw' )
                ),
                'std' => 'true'
            ),
            array(
                'name' => __( 'Excerpt', 'yiw' ),  
                'id' => 'excerpt',
                'type' => 'text',
                'std' => 10
            ),
        )
    ),
);

$yiw_shortcodes = apply_filters( 'yiw_shortcodes', $yiw_shortcodes );
?>