<?php
/**
 * Social Association
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// requires WooCommerce
if ( ! listify_has_integration( 'woocommerce' ) ) {
	return;
}

$wp_customize->add_setting( 'social-association', array(
	'default' => 'user',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'social-association', array(
	'label' => __( 'Social Profiles', 'listify' ),
	'type' => 'select',
	'description' => __( 'When associated with a listing the profiles will unique to each listing.', 'listify' ),
	'choices' => array(
		'listing' => __( 'Associate with listing', 'listify' ),
		'user' => __( 'Associate with user', 'listify' )
	),
	'priority' => 40,
	'section' => 'labels'
) );
