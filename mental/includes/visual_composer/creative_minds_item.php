<?php
add_shortcode( 'vcm_mental_creative_minds_item', 'vcm_mental_creative_minds_item_shortcode' );
function vcm_mental_creative_minds_item_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title'       => '',
		'description' => '',
		'image'       => '',
		'active'      => 'no',
	), $atts, 'vcm_mental_creative_minds_item' );

	if ( is_numeric( $atts['image'] ) ) {
		if ( $img_data = wp_get_attachment_image_src( $atts['image'], 'medium' ) ) {
			$atts['image'] = $img_data[0];
		}
	}

	ob_start();
	?>

	<div class="col-cm <?php echo ( $atts['active'] == 'yes' ) ? 'active' : '' ?>">
		<figure class="cm-item">
			<img src="<?php echo esc_url( $atts['image'] ); ?>" alt="">
			<figcaption>
				<div class="middle">
					<div class="middle-inner">
						<h4 class="cm-title" data-animate="fadeInDown"><?php echo esc_html( $atts['title'] ); ?></h4>
						<p class="cm-descr"><?php echo esc_html( $atts['description'] ); ?></p>
					</div>
				</div>
			</figcaption>
		</figure>

	</div>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-creative-minds-item',
	'name'            => __( 'Mentas Creat. Minds Item', 'mental' ),
	"base"            => "vcm_mental_creative_minds_item", // bind with our shortcode
	"as_child"        => array( 'only' => 'vcm_mental_creative_minds' ),
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'title',
			'heading'    => __( 'Title', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'description',
			'heading'    => __( 'Description', 'mental' )
		),

		array(
			'type'       => 'attach_image',
			'param_name' => 'image',
			'heading'    => __( 'Image', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'active',
			'heading'    => __( 'Active', 'mental' ),
			'value'      => array(
				__( 'No', 'mental' )  => 'no',
				__( 'Yes', 'mental' ) => 'yes',
			)
		),
	)
) );