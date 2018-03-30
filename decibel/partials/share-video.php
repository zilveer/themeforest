<?php
/**
 * Share links video
 */
$text = wolf_get_theme_option( 'share_text' );
$link = get_permalink();
$title = urlencode( get_the_title() );
$pin_img = wolf_get_post_thumbnail_url( 'full' );
?>
<?php if ( wolf_get_theme_option( 'share_facebook' ) ) : ?>
	<a data-popup="true" data-width="580" data-height="320" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $link ); ?>&amp;t=<?php echo esc_attr( $title ); ?>" class="fa fa-1x fa-facebook share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'facebook' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_twitter' ) ) : ?>
	<a data-popup="true" href="http://twitter.com/home?status=<?php echo esc_attr( $title ) . ' - ' . $link; ?>" class="fa fa-1x fa-twitter share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'twitter' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_pinterest' ) ) : ?>
	<a data-popup="true" data-width="580" data-height="300" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( $link ); ?>&amp;media=<?php echo esc_attr( $pin_img ); ?>&amp;description=<?php echo esc_attr( $title ); ?>" class="fa fa-1x fa-pinterest share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'pinterest' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_google_plus' ) ) : ?>
	<a data-popup="true" data-height="500" href="https://plus.google.com/share?url=<?php echo esc_url( $link ); ?>" class="fa fa-1x fa-googleplus share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'google plus' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_tumblr' ) ) : ?>
	<a data-popup="true" href="http://tumblr.com/share/link?url=<?php echo esc_url( $link ); ?>&amp;name=<?php echo esc_attr( $title ); ?>" class="fa fa-1x fa-tumblr share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'tumblr' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_stumbleupon' ) ) : ?>
	<a data-popup="true" data-width="800" data-height="600" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $link ); ?>&amp;title=<?php echo esc_attr( $title ); ?>" class="fa fa-1x fa-stumbleupon share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'stumbleupon' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_linkedin' ) ) : ?>
	<a data-popup="true" data-height="380" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $link ); ?>&amp;title=<?php echo esc_attr( $title ); ?>" class="fa fa-1x fa-linkedin share-link-video" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'linkedin' ) ); ?>"></a>
<?php endif; ?>
<?php if ( wolf_get_theme_option( 'share_mail' ) ) : ?>
	<a data-popup="true" href="mailto:?subject=<?php echo esc_attr( $title ); ?>&amp;body=<?php echo esc_url( $link ); ?>" class="fa fa-1x fa-mail share-link-video" title="<?php printf( __( 'Share by %s', 'wolf' ), ucfirst( 'email' ) ); ?>"></a>
<?php endif; ?>
