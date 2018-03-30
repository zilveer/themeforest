<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
    'portf_view'  => array(
        'label'   => __( 'Portfolio View', 'fw' ),
        'desc'    => __( 'Select the portfolio view', 'fw' ),
        'type'  => 'select',
        'value' => '',
        'choices' => array(
            'view1' => __('Default','fw'),
            'view2' => __('Alternative', 'fw')
        ),
    ),

    'portf_columns'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Columns', 'fw'),
        'desc'  => __('Select portfolio number of columns', 'fw'),
        'choices' => array(
            '2' => __('2 Columns', 'fw'),
            '3' => __('3 Columns', 'fw'),
            '4' => __('4 Columns', 'fw')
        ),
    ),

    'filter' => array(
        'type'         => 'switch',
        'label'        => __( 'Top Filter', 'fw' ),
        'desc'         => __( 'Enable top filter?', 'fw' ),
        'value'        => 'yes',
        'right-choice' => array(
            'value' => 'yes',
            'label' => __( 'Yes', 'fw' ),
        ),
        'left-choice'  => array(
            'value' => 'no',
            'label' => __( 'No', 'fw' ),
        ),
    ),

    'posts_per_page' => array(
        'type'   => 'text',
        'value' => get_option('posts_per_page'),
        'label'  => __( 'Posts Per Page', 'fw' ),
        'desc'   => __( 'Posts per page to display', 'fw' )
    ),


);