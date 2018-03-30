<?php
$term_list = '';
$post_id   = get_the_ID();
$post_type = get_post_type();
if ( get_the_terms( $post_id, $post_type . '_type' ) ) {
	foreach ( get_the_terms( $post_id, $post_type . '_type' ) as $term ) {
		$term_list .= $term->slug .' ';
	}
}
$term_list = ( $term_list ) ? substr( $term_list, 0, -1 ) : '';
$img = wolf_get_post_thumbnail_url( 'extra-large' );
$style = "background:url($img) no-repeat center center;";
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'vertical-slide-item slide full-height', $term_list ) ); ?> style="<?php echo esc_attr( $style ); ?>">
	<a class="mask-link" href="<?php the_permalink(); ?>"><?php printf( __( 'View %s', 'wolf' ), $post_type ); ?></a>
</div>