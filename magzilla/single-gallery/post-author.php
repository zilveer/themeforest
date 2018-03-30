<?php
//
// post author template
//
global $ft_option;
?>
<div class="post-author">
	<div class="media">

		<?php if( $ft_option['single_gallery_author_pic'] != 0 ) { ?>
		<div class="media-left media-top">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<img class="media-object img-circle post-author-avatar" src="<?php echo fave_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 50 )); ?>" alt="avatar"/>
			</a>
		</div>
		<?php } ?>

		<div class="media-body">
			<ul class="list-inline post-meta">
				
				<?php if( $ft_option['single_gallery_author_name'] != 0 ) { ?>
				<li class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_attr( the_author_meta( 'display_name' )); ?></a></li>
				<!-- <li>|</li> -->
				<?php } ?>

				<?php if( $ft_option['single_gallery_author_social_link'] != 0 ) { ?>
				<li class="post-author-social-links">
					<?php if( get_the_author_meta('fave_author_flickr') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_flickr') ); ?>"><i class="fa fa-flickr"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_pinterest') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_pinterest') ); ?>"><i class="fa fa-pinterest-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_youtube') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_youtube') ); ?>"><i class="fa fa-youtube-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_foursquare') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_foursquare') ); ?>"><i class="fa fa-foursquare"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_instagram') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_instagram') ); ?>"><i class="fa fa-instagram"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_twitter') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_twitter') ); ?>"><i class="fa fa-twitter-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_vimeo') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_vimeo') ); ?>"><i class="fa fa-vimeo-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_facebook') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_facebook') ); ?>"><i class="fa fa-facebook-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_google_plus') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_google_plus') ); ?>"><i class="fa fa-google-plus-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_linkedin') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_linkedin') ); ?>"><i class="fa fa-linkedin-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_tumblr') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_tumblr') ); ?>"><i class="fa fa-tumblr-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_dribbble') ) { ?>
					<a href="<?php echo esc_url( get_the_author_meta('fave_author_dribbble') ); ?>"><i class="fa fa-dribbble"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('user_email') ) { ?>
					<a href="mailto:<?php echo get_the_author_meta('user_email' ); ?>"><i class="fa fa-envelope"></i></a>
					<?php } ?>
				</li>
				<?php } ?>


				<?php if( $ft_option['single_gallery_category'] != 0 ) { ?>
				<?php $gallery_cats = wp_get_post_terms(get_the_ID(), 'gallery-categories', array("fields" => "all")); ?>

				<?php if( !empty( $gallery_cats ) ): ?>
				<li class="post-category">
						
						<?php

						//Returns Array of Term Names for "my_taxonomy"
						foreach($gallery_cats as $cat): 
					            $term_link = get_term_link( $cat, 'gallery-categories' );
					            if( is_wp_error( $term_link ) )
					                continue;
					           
					            echo '<a class="cat-color-'.intval( $cat->term_id ).'" href="'.esc_url( $term_link ).'">'.esc_attr( $cat->name ).'</a>' . ' ';
					              
					    endforeach;

						?>
				</li>
				<!-- <li>|</li> -->
				<?php endif; ?>
				<?php } ?>

				<?php if( $ft_option['single_gallery_date'] != 0 ) { ?>
				<li class="post-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><i class="fa fa-calendar-o"></i> <?php esc_attr( the_time( get_option( 'date_format ' ) )); ?> <?php esc_attr( the_time( get_option( 'time_format' ) )); ?></a></li>
				<!-- <li>|</li> -->
				<?php } ?>

				<?php if( $ft_option['single_gallery_views'] != 0 ) { ?>
				<li class="post-total-shares"><i class="fa fa-file-o"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?></li>
				<!-- <li>|</li> -->
				<?php } ?>

				<?php if( $ft_option['single_gallery_comment_count'] != 0 ) { ?>
				<?php if ( comments_open() ) { ?>
				<li class="post-total-comments">
					<?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
				</li>
				<?php } ?>
				<?php } ?>

			</ul><!-- post-meta -->
		</div><!-- media-body -->
	</div><!-- media -->
</div><!-- post-author -->