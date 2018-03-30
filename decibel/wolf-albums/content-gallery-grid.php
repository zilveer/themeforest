<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$term_list = '';
$post_id = get_the_ID();
if ( get_the_terms( $post_id, 'gallery_type' ) ) {
	foreach ( get_the_terms( $post_id, 'gallery_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'gallery-item-container', $term_list ) ); ?>>
	<figure class="effect-bubba">
		<?php echo wolf_albums_get_thumbnail(); ?>
		<a href="<?php the_permalink(); ?>" class="mask-link"><?php _e( 'View gallery', 'wolf' ); ?></a>
		<figcaption>
			<div class="figcaption-inner table">
				<div class="table-cell" >
					<h2 class="gallery-title"><?php the_title(); ?></h2>
					<p class="entry-meta">
						<?php echo sanitize_text_field( strip_tags( get_the_term_list( $post_id, 'gallery_type', __( 'in ', 'wolf' ), ', ', '' ) ) ); ?>
					</p>
				</div>
			</div>
		</figcaption>
	</figure>
</article>