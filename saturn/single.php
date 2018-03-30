<?php get_header();?>
	<section class="main-content">
		<?php 
		/**
		 * saturn_cover_media action.
		 * hooked saturn_cover_media, 10
		 */
		do_action( 'saturn_cover_media' );	
		?>
		<div class="container">
			<?php
			/**
			 * want to display the banner/ads, hook into this.
			 */ 
			do_action( 'saturn_before_content' );
			?>		
			<div class="content">
				<div class="row">
					<div class="col-md-<?php if( is_active_sidebar( apply_filters( 'saturn_custom_sidebar' , 'sidebar-primary') ) ):?>9<?php else:?>12<?php endif;?> col-main-content">
						<div class="primary-content" id="primary-content">
							<?php if( have_posts() ) : the_post();?>
							<?php 
							/**
							 * saturn_breadcrumbs action.
							 * hooked saturn_get_breadcrumbs, 10
							 */
							do_action( 'saturn_breadcrumbs' );
							?>
							<?php if( get_post_format() != 'quote' ):?>
							<article <?php post_class();?>>
								<?php function_exists( 'saturn_post_format_content' ) ? saturn_post_format_content() : '';?>
								<?php do_action( 'saturn_post_meta' );?>
								<div class="post-header">
									<?php if( is_single() ):?>
										<h1 class="post-title"><?php the_title();?></h1>
									<?php else:?>
										<h3 class="post-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<?php endif;?>
								</div><!-- end post header -->
								<div class="post-content">
									<?php the_content();?>
								</div>
							</article>
							<?php else:?>
								<?php get_template_part( 'content', 'quote' );?>
							<?php endif;?>
							<?php 
							if( shortcode_exists( 'jetpack-related-posts' ) ){
								echo do_shortcode( '[jetpack-related-posts]' );
							}
							?>
							<!-- Nav Link -->
							<?php if( apply_filters( 'saturn_nav-link' , true) === true ):?>
							<?php 
								if ( get_previous_post_link() || get_next_post_link() ):
								?>
									<div class="nav-links">
										<div class="row">
											<div class="col-md-6 col-xs-12 previous-post">
												<?php if( get_previous_post_link() ):?>
													<?php previous_post_link( '<h4>'.__('<i class="fa fa-angle-left"></i> Previous Post %link', 'saturn').'</h4>', '%title' );?>
												<?php endif;?>											
											</div>
											<div class="col-md-6 col-xs-12 next-post">
												<?php if( get_next_post_link() ):?>
													<?php next_post_link( '<h4>'.__('Next Post <i class="fa fa-angle-right"></i> %link', 'saturn').'</h4>', '%title' );?>
												<?php endif;?>										
											</div>
										</div>
									</div>
								<?php endif;?>
							<?php endif;?>
							<?php
							// hooked saturn_display_authorbox, 10
							if( apply_filters( 'saturn_authorbox_activate' , true) === true ):
							?>
								<?php 
								$author_page = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );
								?>
								<div class="author-box">
									<div class="author-avatar">
										<a href="<?php print esc_url( $author_page );?>"><?php print get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'saturn_authorbox_avatar_size' , '80') );?></a>									
									</div>
									<div class="author-description">
										<h3><a href="<?php print esc_url( $author_page );?>"><?php print get_the_author_meta( 'display_name' );?></a></h3>
										<?php
										// hooked saturn_author_social_links, 10;
										do_action( 'saturn_author_social_links' );
										?>								
							    	<?php if( get_the_author_meta( 'description' ) ):?>
							        	<p><?php print get_the_author_meta( 'description' );?></p>
							        <?php endif;?>
									</div>
								</div>
							<?php endif;?>
							<?php 
		                    	if( comments_open() ){
		                    		comments_template();
		                    	}
		                    ?>
							<?php endif;?>
						</div>
					</div>
					<?php get_sidebar();?>
				</div>				
			</div><!-- end content -->
			<?php
			do_action( 'saturn_after_content' );
			?>			
		</div><!-- end container -->
	</section>
<?php get_footer();?>