<?php
/**
 * Module G (Slider)
 */

global $post, $wp_query;

if ( ! isset( $barcelona_q ) ) {
	$barcelona_q = $wp_query;
}

if ( ! isset( $barcelona_async ) ) {
	$barcelona_async = false;
}

if ( ! isset( $barcelona_is_autoplay ) ) {
	$barcelona_is_autoplay = false;
}

if ( ! isset( $barcelona_show_overlay ) ) {
	$barcelona_show_overlay = false;
}

if ( ! $barcelona_async ) {

	$barcelona_attr_str = '';
	if ( isset( $barcelona_mod_attr_data ) && is_array( $barcelona_mod_attr_data ) ) {
		foreach ( $barcelona_mod_attr_data as $j => $d ) {
			$barcelona_attr_str .= ' data-'. sanitize_key( $j ) .'="'. esc_attr( $d ) .'"';
		}
	}

	echo '<div class="posts-box posts-box-carousel"'. $barcelona_attr_str .'>';

}

if ( isset( $barcelona_mod_header ) ) {
	echo $barcelona_mod_header;
}

if ( ! $barcelona_async ) {
	echo '<div class="posts-wrapper">';
}

$barcelona_owl_data = array(
	'controls' => '.nav-dir',
	'items'    => '1',
	'autoplay' => $barcelona_is_autoplay ? 'true' : 'false',
	'rtl'      => is_rtl() ? 'true' : 'false'
);

?>
<div class="mas-item owl-carousel owl-theme"<?php echo implode( array_map( function( $v, $k ) { return ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"'; }, $barcelona_owl_data, array_keys( $barcelona_owl_data ) ) ); ?>>
<?php while ( $barcelona_q->have_posts() ): $barcelona_q->the_post(); $barcelona_post_cat = get_the_category(); ?>

	<article class="item">

		<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
			<?php barcelona_thumbnail( 'barcelona-md', NULL, array( 'class' => 'trs' ) ); ?>
		</a>

		<div class="item-overlay clearfix<?php echo $barcelona_show_overlay ? ' show-always' : ''; ?>">

			<div class="inner">

				<div class="post-summary post-format-<?php echo sanitize_html_class( barcelona_get_post_format() ); ?>">

					<?php if ( ! empty( $barcelona_post_cat[0] ) ): ?>
						<div class="post-cat">
							<a href="<?php echo esc_url( get_category_link( $barcelona_post_cat[0] ) ); ?>" class="label label-default">
								<?php echo esc_html( $barcelona_post_cat[0]->name ); ?>
							</a>
						</div>
					<?php endif; ?>

					<h2 class="post-title">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
					</h2>

					<?php
					if ( isset( $barcelona_mod_post_meta ) ) {
						barcelona_post_meta( $barcelona_mod_post_meta );
					}
					?>

				</div>

				<ul class="nav-dir">

					<li>
						<button type="button" class="btn">
							<span class="fa fa-caret-right"></span>
						</button>
					</li>

					<li>
						<button type="button" class="btn">
							<span class="fa fa-caret-left"></span>
						</button>
					</li>

				</ul><!-- .nav-dir -->

			</div><!-- .inner -->

		</div><!-- .item-overlay -->

	</article>

<?php endwhile; wp_reset_postdata(); ?>
</div><!-- owl-slider -->
<?php

if ( ! $barcelona_async ) {
	echo '</div></div>';
}