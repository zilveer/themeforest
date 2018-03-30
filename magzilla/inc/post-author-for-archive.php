<?php
//
// post author template
//
global $curauth;
?>
<div class="post-author-for-archive">
	<div class="media">
		<div class="media-left media-top">
			<a href="<?php the_author_meta( 'user_url', $curauth->ID ); ?>">
				<img class="media-object img-circle post-author-avatar" src="<?php echo fave_get_avatar_url(get_avatar( $curauth->ID, 72 )); ?>" alt="avatar">
			</a>
		</div>
		<div class="media-body">
			<h2 class="post-author"><?php echo esc_attr( $curauth->display_name ); ?> </h2>
			<ul class="list-inline post-meta">
				
				<li class="post-label">
					<a href="<?php the_author_meta( 'user_url', $curauth->ID ); ?>">
							<i class="fa fa-bookmark"></i> <?php echo count_user_posts( $curauth->ID ); ?> <?php _e( 'Posts', 'magzilla' ); ?>
					</a>
				</li>
				<!-- <li>|</li> -->
				<li class="post-total-comments">
						<a href="#"><i class="fa fa-comment-o"></i> <?php echo fave_user_comment_count( $curauth->ID ); ?> <?php _e( 'Comments', 'magzilla' ); ?></a>
				</li>
				<li class="post-author-social-links">
					<?php 
					
					if($curauth->user_email){ 
						echo '<a href="mailto:'.esc_attr( $curauth->user_email ).'" class="envelope-icon" target="_top" ><i class="fa fa-envelope"></i></a> ';
					}
					if($curauth->fave_author_flickr){ 
						echo '<a href="'.esc_url( $curauth->fave_author_flickr ).'" class="flickr-icon"><i class="fa fa-flickr"></i></a> ';
					}
					if($curauth->fave_author_pinterest){ 
						echo '<a href="'.esc_url( $curauth->fave_author_pinterest ).'" class="pinterest-icon" ><i class="fa fa-pinterest-square"></i></a> ';
					}
					if($curauth->fave_author_youtube){ 
						echo '<a href="'.esc_url( $curauth->fave_author_youtube ).'" class="youtube-icon" ><i class="fa fa-youtube-square"></i></a> ';
					}
					if($curauth->fave_author_foursquare){ 
						echo '<a href="'.esc_url( $curauth->fave_author_foursquare ).'" class="foursquare-icon" ><i class="fa fa-foursquare"></i></a> ';
					}
					if($curauth->fave_author_instagram){ 
						echo '<a href="'.esc_url( $curauth->fave_author_instagram ).'" class="instagram-icon" ><i class="fa fa-instagram"></i></a> ';
					}
					if($curauth->fave_author_twitter){ 
						echo '<a href="'.esc_url( $curauth->fave_author_twitter ).'" class="twitter-icon" ><i class="fa fa-twitter-square"></i></a> ';
					}
					if($curauth->fave_author_vimeo){ 
						echo '<a href="'.esc_url( $curauth->fave_author_vimeo ).'" class="vimeo-icon" ><i class="fa fa-vimeo-square"></i></a> ';
					}
					if($curauth->fave_author_facebook){ 
						echo '<a href="'.esc_url( $curauth->fave_author_facebook ).'" class="facebook-icon" ><i class="fa fa-facebook-square"></i></a> ';
					}
					if($curauth->fave_author_google_plus){ 
						echo '<a href="'.esc_url( $curauth->fave_author_google_plus ).'" class="google-plus-icon" ><i class="fa fa-google-plus-square"></i></a> ';
					}
					if($curauth->fave_author_linkedin){ 
						echo '<a href="'.esc_url( $curauth->fave_author_linkedin ).'" class="linkedin-icon" ><i class="fa fa-linkedin-square"></i></a> ';
					}
					if($curauth->fave_author_tumblr){ 
						echo '<a href="'.esc_url( $curauth->fave_author_tumblr ).'" class="tumblr-icon" ><i class="fa fa-tumblr-square"></i></a> ';
					}
					if($curauth->fave_author_dribbble){ 
						echo '<a href="'.esc_url( $curauth->fave_author_dribbble ).'" class="dribbble-icon" ><i class="fa fa-dribbble"></i></a> ';
					}
					?>
				</li>
				
			</ul><!-- post-meta -->
			<p><?php echo esc_attr( $curauth->description ); ?></p>
		</div><!-- media-body -->
	</div><!-- media -->
</div><!-- post-author -->