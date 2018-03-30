<?php
/**
 *  The content part of the full single blog post
 * 
 * @package toranj
 * @author owwwlab
 */

?>

					<!-- Post Content -->
					<div id="post-content">
						
						<?php the_content(); ?>
					</div>
					<!-- /Post Content -->


					<?php if ( ot_get_option('show_author_bio') == 'on' ): ?>
					<!-- author bio -->
	                <div class="author-bio">
	                            
	                        <!-- avatar -->
	                        <div class="avatar">
	                            <?php echo get_avatar(get_the_author_meta('ID') , '80'); ?>
	                        </div>
	                        <!-- end avatar --> 

	                        <div class="author-bio-content">
	                                        
	                            <h4>
	                            	<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
	                            		<?php echo get_the_author_meta('display_name'); ?>
	                            	</a>
	                            </h4>
	                            <p>
	                                <?php echo get_the_author_meta('description'); ?>
	                            </p>

	                        </div>                          

	                </div>
	                <!-- end author bio -->
	                <?php endif; ?>


	                <?php if( ot_get_option('show_related_posts') == 'on' ) : ?>
	                <!-- related posts -->
	                <div class="related-posts">
	                            
							<h4 class="lined"><?php _e('Related Posts' , 'toranj'); ?></h4>
	                            
							<?php $related_posts = owlab_get_related_posts(); ?>
	                    

	                </div><!-- end related posts -->
	                <?php endif; // end related posts check ?>

	            </div>
            	<hr />

				<!-- Post Navigation -->
				<?php if (ot_get_option('show_prev_next') == 'on'):?>
				<?php owlab_blog_single_paging_nav(); ?>
				<?php endif; ?>


				<!-- Post Comments -->
				<?php comments_template(); ?>
				<!-- /Post Comments -->

				<!-- BACK TO TOP SECTION -->
				<hr/>
				<a class="back-to-top" href="#"></a>
				<div class="clearfix"></div>

			</div>
			<!-- /Post main area -->

		</div>
	</div>
	<!-- /Post body -->


</div>