<?php
/**
 * Module E (Slider)
 */

global $post, $wp_query;

if ( ! isset( $barcelona_q ) ) {
	$barcelona_q = $wp_query;
}

if ( ! isset( $barcelona_async ) ) {
	$barcelona_async = false;
}

if ( ! $barcelona_async ) {

	$barcelona_attr_str = '';
	if ( isset( $barcelona_mod_attr_data ) && is_array( $barcelona_mod_attr_data ) ) {
		foreach ( $barcelona_mod_attr_data as $j => $d ) {
			$barcelona_attr_str .= ' data-'. sanitize_key( $j ) .'="'. esc_attr( $d ) .'"';
		}
	}

	echo '<div class="posts-box posts-box-3"'. $barcelona_attr_str .'>';

}

if ( isset( $barcelona_mod_header ) ) {
	echo $barcelona_mod_header;
}

if ( ! $barcelona_async ) {
	echo '<div class="posts-wrapper row">';
}

$barcelona_owl_data = array(
	'controls' => '.slide-nav',
	'dots'     => 'false',
	'items'    => '2',
	'center'   => 'false',
	'nav'      => 'true',
	'rtl'      => is_rtl() ? 'true' : 'false'
);

?>
<div class="mas-item owl-carousel owl-theme"<?php echo implode( array_map( function( $v, $k ) { return ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"'; }, $barcelona_owl_data, array_keys( $barcelona_owl_data ) ) ); ?>>
<?php while ( $barcelona_q->have_posts() ): $barcelona_q->the_post(); ?>

	<div class="col-xs-12 item">

		<article class="post-summary post-format-<?php echo sanitize_html_class( barcelona_get_post_format() ); ?> clearfix">

			<div class="post-image">

				<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php barcelona_psum_overlay(); barcelona_thumbnail( 'barcelona-sm' ); ?>
				</a>

			</div><!-- .post-image -->

			<div class="post-details">

				<h2 class="post-title">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( the_title() ); ?></a>
				</h2>

				<?php
				if ( isset( $barcelona_mod_post_meta ) ) {
					barcelona_post_meta( $barcelona_mod_post_meta, false );
				}
				?>

			</div><!-- .post-details -->

		</article>

	</div>

<?php endwhile; wp_reset_postdata(); ?>
</div><!-- .owl-slider -->
<?php

if ( ! $barcelona_async ) {
	echo '</div></div>';
}