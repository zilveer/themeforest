<?php
/**
 * The Template for displaying single portfolio project.
 *
 */

$blog_layout = etheme_get_option('blog_layout');
get_header(); ?>
        <section id="main" class="column1">
            <div class="content">
				
				
				<?php /* If there are no posts to display, such as an empty archive page */ ?>
				<?php if ( ! have_posts() ) : ?>
					<div id="post-0" class="post error404 not-found">
						<h1 class="entry-title"><?php _e( 'Not Found', ETHEME_DOMAIN); ?></h1>
						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', ETHEME_DOMAIN); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				<?php endif; ?>
				<?php while ( have_posts() ) : the_post(); ?>
				
				        <?php 
				            $blog_layout = etheme_get_option('blog_layout');
				            if(etheme_get_custom_field('post_layout') && etheme_get_custom_field('post_layout') != 'global'){
				                $blog_layout = etheme_get_custom_field('post_layout');
				            }
				        ?>
				            <div class="portfolio-single-item article">
				
					    
								<?php
								
								$imW = 460;
								$imH = 460;
								
					            $imgUrls = etheme_get_images($imW,$imH,false);
					            $imgBigUrls = etheme_get_images(1000,1000,false);
					            
								if($imgUrls || has_post_thumbnail()):
					            
					            
								?>
								<div class="attachments-slider nav-type-small span6">
									<ul class="slides">
										<?php foreach($imgUrls as $key => $imgUrl): ?>
											<li>
												<?php if(etheme_get_option('port_use_lightbox')): ?><a href="<?php echo $imgBigUrls[$key]; ?>" class="zoom" rel="lightbox[gal]"><?php endif; ?><img src="<?php echo $imgUrl; ?>" alt="<?php echo $attachment->post_title; ?>" /><?php if(etheme_get_option('port_use_lightbox')): ?></a><?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
														
								<script type="text/javascript">
									jQuery(window).load(function() {
										jQuery('.attachments-slider').flexslider({
											animation: "slide",
											slideshow: false,
											animationLoop: false,
											controlNav: false
										});
									});
								</script>
								
								<?php endif; ?>
								
				                    <div class="portfolio-content span6">
				                        <h3><?php the_title(); ?></h3>
							            <div class="entry-utility">
							    			<?php etheme_posted_on(); ?>
							                <?php if(etheme_get_option('portfolio_comments')): ?>
							                       <span class="blog_icon_title">| </span><?php comments_popup_link( __( 'Leave a comment', ETHEME_DOMAIN ), __( '1 Comment', ETHEME_DOMAIN ), __( '% Comments', ETHEME_DOMAIN ) ); ?>
							                <?php endif; ?>
											<?php edit_post_link( __( 'Edit', ETHEME_DOMAIN ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
										</div><!-- .entry-utility -->  
				                        	<?php if ( is_search() ) : // Only display excerpts for archives and search. ?>
				                        			<div class="entry-summary">
				                        				<?php the_excerpt(); ?>
				                        			</div><!-- .entry-summary -->
				                        	<?php else : ?>
				                        			<div class="entry-content">
				                        				<?php the_content(); ?>
				                        			</div><!-- .entry-content -->
				                        	<?php endif; ?> 
				                        	<div class="clear"></div>
				                        
					                        	
					                        <h2><?php _e('Project Details:', ETHEME_DOMAIN); ?></h2>
					                         <table class="table table-bordered item-information">
						                         
						                         
						                         <?php $categories = wp_get_post_terms($post->ID, 'categories'); if(count($categories) > 0): ?>
							                         <tr>
								                         <td><?php _e('Categories:', ETHEME_DOMAIN); ?></td>
								                         <td>
								                         	<?php	
																foreach($categories as $category) {
																	?>
																		<?php echo $category->name; ?><br>
																	<?php 
																}
								                         	?>
								                         	
								                         </td>
							                         </tr>
						                         <?php endif; ?>
						                         
						                         <?php if(etheme_get_custom_field('client') != ''): ?>
							                         <tr>
								                         <td><?php _e('Client:', ETHEME_DOMAIN); ?></td>
								                         <td>
								                         	<?php if(etheme_get_custom_field('client_url') != ''): ?><a href="<?php etheme_custom_field('client_url'); ?>" target="_blank"><?php endif;?>
								                         		<?php etheme_custom_field('client'); ?>
								                         	<?php if(etheme_get_custom_field('client_url') != ''): ?></a><?php endif;?>
								                         </td>
							                         </tr>
						                         <?php endif; ?>
						                         
						                         <?php if(etheme_get_custom_field('copyright') != ''): ?>
							                         <tr>
								                         <td><?php _e('Copyright:', ETHEME_DOMAIN); ?></td>
								                         <td>
								                         	<?php if(etheme_get_custom_field('copyright_url') != ''): ?><a href="<?php etheme_custom_field('copyright_url'); ?>" target="_blank"><?php endif;?>
								                         		<?php etheme_custom_field('copyright'); ?>
								                         	<?php if(etheme_get_custom_field('copyright_url') != ''): ?></a><?php endif;?>
								                         </td>
							                         </tr>	
						                         <?php endif; ?>	                         
					                         </table>
					                         
					                         <?php if(etheme_get_custom_field('project_url') != ''): ?>
						                         
						                         <a href="<?php etheme_custom_field('project_url'); ?>" target="_blank" class="button active big arrow-right"><span><?php _e('Visit Project Site', ETHEME_DOMAIN); ?></span></a>
						                         
					                         <?php endif; ?>
					                         
				                         <div class="clear"></div>
				                    </div>
				                </div>  
				
				<?php endwhile; // End the loop. Whew. ?>
								
			</div><!-- #content -->
            <div class="clear"></div>
		</section><!-- #container -->
    		
		<?php 
			if(etheme_get_option('recent_projects')) {
    			echo etheme_get_recent_portfolio(20, __('Recent Works', ETHEME_DOMAIN), $post->ID);
			}
			
			if(etheme_get_option('portfolio_comments')) {
    			comments_template( '', true );
			}
		?>
		
<?php get_footer(); ?>
