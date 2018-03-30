<?php
/**
 * Share links
 */
$text = wolf_get_theme_option( 'share_text' );
$link = get_permalink();
$title = urlencode( get_the_title() );
$pin_img = wolf_get_post_thumbnail_url( 'full' );
?>
<div class="share-box clearfix">
	<div class="share-box-inner clearfix">
		<div class="share-box-title">
			<h5 class="share-title"><?php echo sanitize_text_field( $text ); ?></h5>
		</div><!-- .share-box-title -->
		<div class="share-box-links-container">
			<?php if ( wolf_get_theme_option( 'share_facebook' ) ) : ?>
				<a data-popup="true" data-width="580" data-height="320" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $link ); ?>&amp;t=<?php echo esc_attr( $title ); ?>" class="share-link share-link-facebook" title="<?php printf( __( 'Share on %s', 'wolf' ), 'facebook' ); ?>">
					<i class="fa fa-facebook"></i> facebook
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_twitter' ) ) : ?>
				<a data-popup="true" href="http://twitter.com/home?status=<?php echo esc_attr( $title ) . ' - ' . esc_url( $link ); ?>" class="share-link share-link-twitter" title="<?php printf( __( 'Share on %s', 'wolf' ), 'twitter' ); ?>">
					<i class="fa fa-twitter"></i> twitter
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_pinterest' ) ) : ?>
				<a data-popup="true" data-width="580" data-height="300" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( $link ); ?>&amp;media=<?php echo esc_attr( $pin_img ); ?>&amp;description=<?php echo esc_attr( $title ); ?>" class="share-link share-link-pinterest" title="<?php printf( __( 'Share on %s', 'wolf' ), 'pinterest' ); ?>">
					<i class="fa fa-pinterest"></i> pinterest
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_google' ) ) : ?>
				<a data-popup="true" data-height="500" href="https://plus.google.com/share?url=<?php echo esc_url( $link ); ?>" class="share-link share-link-google" title="<?php printf( __( 'Share on %s', 'wolf' ), 'google plus' ); ?>">
					<i class="fa fa-google"></i> google+
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_tumblr' ) ) : ?>
				<a data-popup="true" href="http://tumblr.com/share/link?url=<?php echo esc_url( $link ); ?>&amp;name=<?php echo esc_attr( $title ); ?>" class="share-link share-link-tumblr" title="<?php printf( __( 'Share on %s', 'wolf' ), 'tumblr' ); ?>">
					<i class="fa fa-tumblr"></i> tumblr
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_stumbleupon' ) ) : ?>
				<a data-popup="true" data-width="800" data-height="600" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url( $link ); ?>&amp;title=<?php echo esc_attr( $title ); ?>" class="share-link share-link-stumbleupon" title="<?php printf( __( 'Share on %s', 'wolf' ), 'stumbleupon' ); ?>">
					<i class="fa fa-stumbleupon"></i> stumbleupon
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_linkedin' ) ) : ?>
				<a data-popup="true" data-height="380" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( $link ); ?>&amp;title=<?php echo esc_attr( $title ); ?>" class="share-link share-link-linkedin" title="<?php printf( __( 'Share on %s', 'wolf' ), 'linkedin' ); ?>">
					<i class="fa fa-linkedin"></i> linkedin
				</a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_mail' ) ) : ?>
				<a data-popup="true" href="mailto:?subject=<?php echo esc_attr( $title ); ?>&amp;body=<?php echo esc_url( $link ); ?>" class="share-link share-link-email" title="<?php printf( __( 'Share by %s', 'wolf' ),  'email' ); ?>">
					<i class="fa fa-envelope"></i> email
				</a>
			<?php endif; ?>
		</div><!-- .share-box-icons -->
	</div><!-- .share-box-inner -->
</div><!-- .share-box -->
