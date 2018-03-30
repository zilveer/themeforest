<?php
/**
 * Module F
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

	echo '<div class="posts-box posts-box-5'. ( is_single() ? ' posts-box-related-posts' : '' ) .'"'. $barcelona_attr_str .'>';

}

if ( isset( $barcelona_mod_header ) ) {
	echo $barcelona_mod_header;
}

// This module becomes related posts section in single post page
if ( is_single() ) {
	$barcelona_mod_post_meta = barcelona_get_option( 'related_posts_meta' );
}

// Module Number of Columns
if ( ! isset( $barcelona_col_number ) ) {
	$barcelona_col_number = 2;
}

switch ( $barcelona_col_number ) {
	case 2:
		$barcelona_col_cls = 'col-sm-6';
		break;
	case 4:
		$barcelona_col_cls = 'col-md-3 col-sm-6';
		break;
	case 5:
		$barcelona_col_cls = 'col-lg-5ths col-md-4 col-sm-6';
		break;
	case 6:
		$barcelona_col_cls = 'col-lg-2 col-md-4 col-sm-6';
		break;
	default:
		$barcelona_col_cls = 'col-md-4';
}

$barcelona_col_cls .= ' col-num-'. $barcelona_col_number;

$barcelona_counter = 0;
$barcelona_posts_payload = array();

while ( $barcelona_q->have_posts() ): $barcelona_q->the_post();

	$barcelona_col = $barcelona_counter % $barcelona_col_number;

	$barcelona_posts_payload[ $barcelona_col ][] = get_post();

	$barcelona_counter++;

endwhile;

if ( ! $barcelona_async ) {
	echo '<div class="posts-wrapper row">';
}

foreach ( $barcelona_posts_payload as $barcelona_posts ):

	echo '<div class="'. $barcelona_col_cls .' mas-item">';

	$barcelona_counter = 0;

	foreach ( $barcelona_posts as $post ): setup_postdata( $post );

		?>
		<article class="post-summary<?php echo ' post-format-'. sanitize_html_class( barcelona_get_post_format() ) .' psum-' . ( $barcelona_counter == 0 ? 'featured' : 'small' ); ?>">

			<?php if ( $barcelona_counter == 0 ): ?>
				<div class="post-image">

					<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php

						barcelona_psum_overlay();

						$barcelona_thumb_size = 'barcelona-sm';

						if ( $barcelona_col_number > 4 ) {
							$barcelona_thumb_size = 'barcelona-xs';
						} else if ( $barcelona_col_number == 2 ) {
							$barcelona_thumb_size = 'barcelona-md';
						}

						barcelona_thumbnail( $barcelona_thumb_size );

						?>
					</a>

				</div><!-- .post-image -->
			<?php endif; ?>

			<div class="post-details">

				<h2 class="post-title">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</h2>

				<?php
				if ( isset( $barcelona_mod_post_meta ) ) {
					barcelona_post_meta( $barcelona_mod_post_meta, false );
				}
				?>

			</div><!-- .post-details -->

		</article>

		<?php

		$barcelona_counter++;

	endforeach;
	wp_reset_postdata();

	echo '</div>';

endforeach;

if ( ! $barcelona_async ) {
	echo '</div></div>';
}