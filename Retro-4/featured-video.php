<?php
if ( ! $url = ( $i = get_post_meta( $post->ID, 'video', true ) ) ? $i['url'] : null )
	return;

$url = parse_url( esc_url( $url ) );

$sizes = array(
	'youtube' => is_retro_post_type() ? array( 700, 394 ) : array( 853, 480 ),
	'vimeo' => is_retro_post_type() ? array( 700, 394 ) : array( 960, 540 )
);
?>

<figure class="featured video">

	<?php if ( strpos( $url['host'], 'youtube.com' ) !== false || $url['host'] == 'youtu.be' ) : ?>
		
	<!-- youtube -->
	<iframe width="<?php esc_attr_e( $sizes['youtube'][ 0 ] ); ?>" height="<?php esc_attr_e( $sizes['youtube'][ 1 ] ); ?>" src="http://www.youtube.com/embed/<?php esc_attr_e( isset( $url['query'] ) ? str_replace( 'v=', null, str_replace( '&', null, $url['query'] ) ) : str_replace( '/', null, $url['path'] ) ); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
	
	<?php elseif ( strpos( $url['host'], 'vimeo.com' ) !== false ) : ?>
		
	<!-- vimeo -->
	<iframe width="<?php esc_attr_e( $sizes['vimeo'][ 0 ] ); ?>" height="<?php esc_attr_e( $sizes['vimeo'][ 1 ] ); ?>" src="http://player.vimeo.com/video/<?php esc_attr_e( str_replace( '/', null, $url['path'] ) ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	
	<?php endif; ?>
	
</figure>