<?php
add_shortcode( 'vcm_mental_load_more', 'vcm_mental_load_more_shortcode' );
function vcm_mental_load_more_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'target_id' => '',
	), $atts, 'vcm_mental_load_more' );

	ob_start();
	?>

	<div class="load-more-block">
		<a href="#" class="load-more-button blog-loadmore"
		   data-blog-id="<?php echo esc_attr( $atts['target_id'] ); ?>"><?php _e( 'Load more', 'mental' ) ?></a>
		<span class="loading-spinner"></span>
		<span class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
	</div>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-load-more',
	'name'            => __( 'Mentas Load More', 'mental' ),
	"base"            => "vcm_mental_load_more", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'target_id',
			'heading'    => __( 'Target ID', 'mental' ),
		)
	)
) );
