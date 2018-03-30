<?php get_header(); ?>

<?php woo_content_before(); ?>

    <div id="content" class="col-full">

    	<div id="main-sidebar-container">
            <!-- #main Starts -->
            <?php woo_main_before(); ?>

            <div id="main" class="col-left">

				<?php $curauth = $wp_query->get_queried_object(); ?>

				<aside id="post-author">
					<div class="profile-image"><?php echo get_avatar( $curauth->ID , '80' ); ?></div>
					<div class="profile-content">
						<h4><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author_meta( 'display_name', $curauth->ID  ) ); ?></h4>

						<?php echo get_the_author_meta( 'description', $curauth->ID  ); ?>

						<?php if ( is_singular() ) : ?>
							<div class="profile-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $curauth->ID  ) ) ); ?>">
									<?php printf( esc_attr__( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author_meta( 'display_name', $curauth->ID ) ); ?>
								</a>
							</div><!--#profile-link-->
						<?php endif; ?>

					</div>
					<div class="fix"></div>
				</aside>

				<?php if( !empty( $desc ) ) : ?>
					<div class="content-full auth-page">
						<div class="left-auth">
							<div class="auth">
								<?php
								$twitter_author_link 	= esc_url( get_the_author_meta( 'twitter', 	$curauth->ID ) );
								$facebook_author_link 	= esc_url( get_the_author_meta( 'facebook', $curauth->ID ) );
								$google_author_link 	= esc_url( get_the_author_meta( 'google', 	$curauth->ID ) );
								$pin_author_link 		= esc_url( get_the_author_meta( 'pin', 		$curauth->ID ) );
								$linkdn_author_link 	= esc_url( get_the_author_meta( 'linkdn', 	$curauth->ID ) );
								$website 				= esc_url( get_the_author_meta( 'url', 		$curauth->ID ) ); ?>

								<?php if( !empty( $website ) ) : ?>
									<a class="fa fa-globe" href="<?php echo $website; ?>" target="_blank"></a>
							  	<?php endif; ?>

								<?php if( !empty( $twitter_author_link ) ) : ?>
									<a class="fa fa-twitter" href="<?php echo $twitter_author_link; ?>" target="_blank"></a>
								<?php endif; ?>

								<?php if( !empty( $facebook_author_link ) )	: ?>
									<a class="fa fa-facebook" href="<?php echo $facebook_author_link; ?>" target="_blank"></a>
								<?php endif; ?>

								<?php if( !empty( $linkdn_author_link ) ) : ?>
									<a class="fa fa-linkedin" rel="me" href="<?php echo $linkdn_author_link; ?>" target="_blank"></a>
								<?php endif; ?>

								<?php if( !empty( $pin_author_link ) ) : ?>
									<a class="fa fa-pinterest" rel="me" href="<?php echo $pin_author_link; ?>" target="_blank"></a>
								<?php endif; ?>

								<?php if( !empty( $google_author_link ) ) : ?>
									<a class="fa fa-google-plus" rel="me" href="<?php echo $google_author_link; ?>" target="_blank"></a>
								<?php endif; ?>
							</div>
						</div>

							<?php $desc = esc_attr( get_the_author_meta( 'desc', $curauth->ID ) ); ?>

							<?php if( !empty( $desc ) ) : ?>
								<div class="auth-des-page">

									<?php echo $desc; ?>

								</div>
							<?php endif; ?>

					</div> <!-- end full content -->
				<?php endif; ?>

				<h3><?php _e( 'All Recipes or Posts by ', 'woothemes' ) ?><span><?php echo esc_attr( $curauth->display_name ); ?></span></h3>

				<?php
					$recipe_args = array(
			            'post_type' 			=> 'recipe',
			            'post_status' 			=> 'publish',
			            'posts_per_page' 		=> $woo_options['woo_auth_post_recipe_num'],
			            'ignore_sticky_posts' 	=> 1,
			            'author'				=> $curauth->ID
			        );

			        query_posts( $recipe_args );

					if (have_posts()):
						$select = $woo_options['woo_author_display'];
					?>
						<div class="accordionButton">
							<h4><?php _e( 'Show Recipe', 'woothemes' );?></h4>
						</div>
						<div class="accordionContent">
							<?php
								while (have_posts()) : the_post();

									$post_type = get_post_type( $post->ID );

									if ( $select == 'List' ) :
										dahz_get_template( 'content', 'content-recipelist' );
									elseif ($select == 'Grid') :
										dahz_get_template( 'content', 'content-recipe' );
									endif;

								endwhile;

				            	wp_reset_postdata();

								if ( isset( $woo_options['woo_author_recipe_link'] ) && !empty($woo_options['woo_author_recipe_link'])) :
									$recipe_link = esc_url( $woo_options['woo_author_recipe_link'] ); ?>
									<div class="fix"></div>
									<form class="show-all-recipe-author" action="<?php echo $recipe_link;?>" method="get">
										<button type="submit" name="auth_name" value="<?php echo get_the_author_meta( 'display_name', $curauth->ID ); ?>"  title="auth_name"><?php _e( 'Show All Recipes', 'woothemes' ); ?></button>
									</form>
								<?php endif; ?>
						</div>
					<?php endif; ?>

						<?php $blog_args = array(
				            'post_type' 			=> 'post',
				            'post_status' 			=> 'publish',
				            'posts_per_page' 		=> $woo_options['woo_auth_post_recipe_num'],
				            'ignore_sticky_posts' 	=> 1,
				            'author'				=> $curauth->ID
				        );

						query_posts($blog_args);

						if ( have_posts() ):
						?>
					<div class="accordionButton">
						<h4><?php _e( 'Show Post', 'woothemes' );?></h4>
					</div>
					<div class="accordionContent">
						<?php while ( have_posts() ) : the_post();
								$post_type = get_post_type( $post->ID );

								if( $post_type == 'post' ) :
			  						// woo_get_template_part( 'includes/templates/content/content', 'elegant-post' );
									dahz_get_template( 'content', 'content-post' );

								endif;

							endwhile;

							wp_reset_postdata();

						if ( isset( $woo_options['woo_author_post_link'] ) && !empty($woo_options['woo_author_post_link']) ) :
							$post_link = esc_url( $woo_options['woo_author_post_link'] ); ?>
							<div class="fix"></div>
							<form class="show-all-recipe-author" action="<?php echo $post_link;?>" method="post">
								<button type="submit" name="auth_name" value="<?php echo get_the_author_meta( 'display_name', $curauth->ID );?>" title="auth_name"><?php _e( 'Show All Posts', 'woothemes' ); ?></button>
							</form>
					<?php endif; ?>
					</div>
					<?php endif; ?>



 			<?php woo_loop_after(); ?>

      		</div><!-- /#main -->

            <?php woo_main_after(); ?>

            <?php get_sidebar(); ?>

		</div><!-- /#main-sidebar-container -->

        <?php dahz_get_sidebar( 'secondary' ); ?>

    </div><!-- /#content -->

	<?php woo_content_after(); ?>

<?php get_footer(); ?>
