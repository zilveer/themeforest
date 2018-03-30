<?php
//
// post about the author
//
?>
<div class="post-about-the-author">
	<div class="module-top clearfix">
		<h4 class="module-title"><?php _e( 'About the author', 'magzilla' ); ?></h4>
	</div><!-- module-top -->
	<div class="module-body">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 200 ); ?>
				</a>
			</div>
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-9">
				<p class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_attr( the_author_meta( 'display_name' )); ?></a></p>
				
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
	                <p><?php the_author_meta( 'description' ); ?></p>
	            <?php endif; ?>

				<div class="post-author-social-links">
					
					<?php if( get_the_author_meta('fave_author_flickr') ) { ?>
					<a class="flickr-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_flickr') ); ?>"><i class="fa fa-flickr"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_pinterest') ) { ?>
					<a class="pinterest-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_pinterest') ); ?>"><i class="fa fa-pinterest-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_youtube') ) { ?>
					<a class="youtube-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_youtube') ); ?>"><i class="fa fa-youtube-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_foursquare') ) { ?>
					<a class="foursquare-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_foursquare') ); ?>"><i class="fa fa-foursquare"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_instagram') ) { ?>
					<a class="instagram-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_instagram') ); ?>"><i class="fa fa-instagram"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_twitter') ) { ?>
					<a class="twitter-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_twitter') ); ?>"><i class="fa fa-twitter-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_vimeo') ) { ?>
					<a class="vimeo-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_vimeo') ); ?>"><i class="fa fa-vimeo-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_facebook') ) { ?>
					<a class="facebook-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_facebook') ); ?>"><i class="fa fa-facebook-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_google_plus') ) { ?>
					<a class="google-plus-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_google_plus') ); ?>"><i class="fa fa-google-plus-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_linkedin') ) { ?>
					<a class="linkedin-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_linkedin') ); ?>"><i class="fa fa-linkedin-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_tumblr') ) { ?>
					<a class="tumblr-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_tumblr') ); ?>"><i class="fa fa-tumblr-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_dribbble') ) { ?>
					<a class="dribbble-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_dribbble') ); ?>"><i class="fa fa-dribbble"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('user_email') ) { ?>
					<a class="envelope-icon" href="mailto:<?php echo get_the_author_meta('user_email' ); ?>"><i class="fa fa-envelope"></i></a>
					<?php } ?>


				</div>

			</div>
		</div>
	</div><!-- module-body -->
</div><!-- post-about-the-author -->