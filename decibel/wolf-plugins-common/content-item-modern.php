<?php
/**
 * The portfolio loop
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$term_list = '';
$post_id   = get_the_ID();
$post_type = get_post_type();
if ( get_the_terms( $post_id, $post_type . '_type' ) ) {
	foreach ( get_the_terms( $post_id, $post_type . '_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list  = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
$format     = get_post_format() ? get_post_format() : 'standard';
$views = wolf_format_number( intval( get_post_meta( $post_id, '_wolf_views', true ) ) );
$likes = wolf_format_number( intval( get_post_meta( $post_id, '_wolf_likes', true ) ) );
$image = wolf_get_post_thumbnail_url( 'extra-large' );
$bg = esc_url( wolf_get_url_from_attachment_id( get_post_thumbnail_id( $post_id ), 'extra-large' ) );
$comments = get_comments_number();
$print_term_list = get_the_term_list( $post_id, $post_type .'_type', __( 'in ', 'wolf' ), ', ', '' );
?>
<article  id="post-<?php the_ID(); ?>" <?php post_class( array( 'modern-item', $term_list ) ); ?> data-post-id="<?php the_ID(); ?>">
	<div class="modern-item-bg" style="background-image:url(<?php echo esc_url( $bg ); ?>);">
		<div class="modern-item-container">
			<div class="modern-item-inner">
				<a href="<?php the_permalink(); ?>" class="mask-link"><?php _e( 'View Work', 'wolf' ); ?></a>
				<h2 class="work-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="entry-meta">
					<?php echo sanitize_text_field( strip_tags( $print_term_list ) ); ?>
				</p>
			</div>
		</div>
	</div>
</article>
