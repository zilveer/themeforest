<?php
/**
 * Region Bias
 *
 * @uses $wp_customize
 * @since 1.5.0
 */

// requires WooCommerce
if ( ! listify_has_integration( 'woocommerce' ) ) {
	return;
}

$wp_customize->add_setting( 'region-bias', array(
	'default' => '',
	'transport' => 'postMessage'
) );

$wp_customize->add_control( 'region-bias', array(
	'label' => __( 'Base Country', 'listify' ),
	'type' => 'select',
	'description' => __( 'This controls autocomplete priority, distance units, and more.', 'listify' ),
	'choices' => array_merge( array( '' => __( 'None', 'listify' ) ), WC()->countries->get_countries() ),
	'priority' => 30,
	'section' => 'labels'
) );
