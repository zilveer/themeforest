<?php
/* ========================================================================= *\
   Testimonials
\* ========================================================================= */

add_shortcode( 'vcm_mental_testimonials', 'vcm_mental_testimonials_shortcode' );
function vcm_mental_testimonials_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts( array(
		'limit' => 5,
	), $atts, 'vcm_mental_testimonials' );

	$rnd = rand( 1, 999 );

	$testimonials = new WP_Query( array(
		'tax_query'      => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array(
					'post-format-quote',
				),
				'operator' => 'IN'
			)
		),
		'posts_per_page' => $atts['limit']
	) );

	ob_start();
	?>

	<div id="carousel-testimonials-<?php echo (int) $rnd; ?>" class="carousel-testimonials carousel slide"
	     data-ride="carousel">

		<!-- Wrapper for slides -->
		<div class="carousel-inner text-center testimonials">

			<?php if ( $testimonials->have_posts() ) : $i = 0;
				while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>

					<?php $qoute_format_meta = get_post_meta( get_the_ID(), 'quote_format', true ); ?>

					<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?> testimonial">
						<p class="citation"><?php echo get_the_content() ?></p>
						<?php if ( ! empty( $qoute_format_meta['author'] ) ): ?>
							<p class="author"><?php echo esc_html( $qoute_format_meta['author'] ); ?></p>
						<?php endif ?>
					</div>

					<?php $i ++; endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>

		</div>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php for ( $j = 0; $j < $i; $j ++ ): ?>
				<li data-target="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide-to="<?php echo (int) $j; ?>" class="<?php echo ( $j == 0 ) ? 'active' : '' ?>"></li>
			<?php endfor; ?>
		</ol>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide="prev">
			<span></span>
		</a>
		<a class="right carousel-control" href="#carousel-testimonials-<?php echo (int) $rnd; ?>" data-slide="next">
			<span></span>
		</a>

	</div> <!-- carousel -->

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-testimonials',
	'name'            => __( 'Mentas Testimonials', 'mental' ),
	"base"            => "vcm_mental_testimonials", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'limit',
			'heading'    => __( 'Limit testimonials count (default 5)', 'mental' ),
			'value'      => '5'
		)
	)
) );