<?php
/**
 * Module J (3 Columns Grid)
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

	echo '<div class="posts-box posts-box-8"'. $barcelona_attr_str .'>';

}

if ( isset( $barcelona_mod_header ) ) {
	echo $barcelona_mod_header;
}

if ( ! $barcelona_async ) {
	echo '<div class="posts-wrapper row">';
}

while ( $barcelona_q->have_posts() ): $barcelona_q->the_post();

	?>
	<div class="col col-sm-4 mas-item">

		<article class="post-summary post-format-<?php echo sanitize_html_class( barcelona_get_post_format() ); ?> clearfix">

			<div class="post-image">

				<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php barcelona_psum_overlay(); barcelona_thumbnail( 'barcelona-sm' ); ?>
				</a>

			</div><!-- .post-image -->

			<div class="post-details">

				<h2 class="post-title">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</h2>

				<?php if ( is_array( $barcelona_mod_post_meta ) && ! empty( $barcelona_mod_post_meta ) && in_array( 'excerpt', $barcelona_mod_post_meta ) ) : ?>
					<p class="post-excerpt">
						<?php echo esc_html( barcelona_get_excerpt( 20 ) ); ?>
					</p>

					<?php
				endif;
				if ( isset( $barcelona_mod_post_meta ) ) {
					barcelona_post_meta( $barcelona_mod_post_meta );
				}
				?>

			</div><!-- .post-details -->

		</article>

	</div>
	<?php

endwhile;
wp_reset_postdata();

if ( ! $barcelona_async ) {
	echo '</div></div>';
}