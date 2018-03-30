<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$term_list = '';
$post_id   = get_the_ID();
if ( get_the_terms( $post_id, 'video_type' ) ) {
	foreach ( get_the_terms( $post_id, 'video_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
$views = wolf_format_number( intval( get_post_meta( $post_id, '_wolf_views', true ) ) );
$likes =wolf_format_number( intval( get_post_meta( $post_id, '_wolf_likes', true ) ) );
$comments = get_comments_number();
$category = strip_tags( get_the_term_list( $post_id, 'video_type', __( 'in ', 'wolf'), ', ', '' ) );
$thumb_size = wolf_get_image_size( 'classic-thumb' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'video-item-container', $term_list ) ); ?>>
	<figure class="effect-lily">
		<?php the_post_thumbnail( $thumb_size ); ?>
		<a href="<?php the_permalink(); ?>" class="mask-link entry-link"><?php _e( 'View video', 'wolf' ); ?></a>
		<h4 class="entry-title video-title"><?php the_title(); ?></h4>
	</figure>
</article>