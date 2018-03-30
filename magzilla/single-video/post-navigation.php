<?php
//
// post pagination
//
?>
<div class="post-navigation">
	<div class="row">
		

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			
			<?php 
			$prevPost = get_previous_post();
			if($prevPost) {
			    $args = array(
			    	'post_type' => 'video',
			        'posts_per_page' => 1,
			        'include' => $prevPost->ID
			    );
			    $prevPost = get_posts($args);
			    foreach ($prevPost as $post) {
			        setup_postdata($post);
			    ?>
					<div class="post-navigation-left">
						<div class="media">
							<div class="media-left media-top">
								<a href="<?php the_permalink(); ?>">
									<img class="media-object" src="<?php echo fave_featured_image( get_the_ID(), 70, 70, true, true, true ); ?>" alt="<?php the_title(); ?>">
								</a>
							</div>
							<div class="media-body">
								<h4><?php _e( 'Previous Video', 'magzilla' ); ?></h4>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
						</div>
					</div><!-- post-navigation-left -->
			<?php
            wp_reset_postdata();
		        } //end foreach
		    } // end if
		    ?>
		</div><!-- col-lg-6 col-md-6 col-sm-6 col-xs-12 -->
		

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			
			<?php
			$nextPost = get_next_post();
		    if($nextPost) {
		        $args = array(
		        	'post_type' => 'video',
		            'posts_per_page' => 1,
		            'include' => $nextPost->ID
		        );
		        $nextPost = get_posts($args);
		        foreach ($nextPost as $post) {
		            setup_postdata($post);
		    ?>

			<div class="post-navigation-right text-right">
				<div class="media">
					<div class="media-body">
						<h4><?php _e( 'Next Video', 'magzilla' ); ?></h4>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<div class="media-right media-top">
						<a href="<?php the_permalink(); ?>">
							<img class="media-object" src="<?php echo fave_featured_image( get_the_ID(), 70, 70, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</a>
					</div>
				</div>
			</div><!-- post-navigation-right -->

			<?php
            wp_reset_postdata();
		        } //end foreach
		    } // end if
		    ?>

		</div><!-- col-lg-6 col-md-6 col-sm-6 col-xs-12 -->


	</div><!-- row -->
</div><!-- post-navigation -->