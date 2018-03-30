<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'posts'=> array(
	    'type'  => 'multi-select',
	    'label' => esc_html__('Category', 'idylle'),
	    'desc'  => esc_html__('Choose Blog Category', 'idylle'),
	    'population' => 'taxonomy',
	    'source' => 'category',
	    'prepopulation' => 10,
        'limit' => 1,
    ),
	'post_count' => array(
		'type'  => 'select',
	    'value' => '5',
	    'label' => esc_html__('Number of Posts', 'idylle'),
	    'choices' => array(
	        '0' => esc_html__('Unlimited', 'idylle'),
	        '1' => esc_html__('1', 'idylle'),
	        '2' => esc_html__('2', 'idylle'),
	        '3' => esc_html__('3', 'idylle'),
	        '4' => esc_html__('4', 'idylle'),
	        '5' => esc_html__('5', 'idylle'),
	        '10' => esc_html__('10', 'idylle'),
	        '15' => esc_html__('15', 'idylle'),
	        '20' => esc_html__('20', 'idylle'),
	    )
	)
);