<?php get_header(); ?>      


		<div class="page-title">

			<h1><span class="the-page-title"><?php the_title(); ?>
				</span>			
				
			</h1>
	        <!-- #searchbar -->
	        <form role="search" method="get" id="searchform-top" action="<?php echo home_url( '/' ); ?>" class="clearfix" >
	            <div>
	                <input type="text" value="Search..." name="s" id="s" onfocus="if(this.value=='Search...')this.value='';" onblur="if(this.value=='')this.value='Search...';" />
	            </div>
	        </form>
	        <!-- /#searchbar-->    
		</div>

		<div class="shadow-separator"></div>
		
		<div class="container background">

				<!--BEGIN main content-->
				<section class="main-content twelve columns bot-margin-triple">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN post -->
					<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
	

	                    <div>    
							<?php 
						        $format = get_post_format(); 
						        if( false === $format ) { $format = 'standard'; }
						    ?>
						    <?php //Check The /includes folder for each post format . Modify there ?>
							<?php get_template_part( 'includes/' . $format ); ?>
						</div>

						<!--BEGIN .entry-content -->
	                    <div class="entry-content twelve columns alpha omega">

	                        <?php if( is_singular() ) { ?>
	                            
	                            <h1 class="entry-title nine columns omega"><?php the_title(); ?></h1>
	                            
	                        <?php } else { ?>
	                            
	                            <h1 class="entry-title nine columns omega">
	                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
	                                    <?php the_title(); ?>
	                                </a>
	                            </h1>
	                            
	                        <?php } ?>
	                            
	                            <div class="nine columns omega no-bottom">
	                                <?php the_content(__('Read more &rarr;', 'framework')); ?>
	                            </div>

								<!--BEGIN .entry-meta -->
			                    <div class="entry-meta three columns alpha">
			                    	<div class="widget-separator"></div>		                    	
			                    	
			                    	<p class="date-of-post"><?php the_time( get_option('date_format') ); ?><span  class="meta-icon date"></span></p>
			                    	<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent link to %s', 'framework'), get_the_title()); ?>" class="post-format"><div class="post-format-icon"></div></a>
			                            <p><?php the_author_posts_link(); ?><span  class="meta-icon author"></span></p>
			                                
			                                <?php if( has_tag() ) { ?><p><?php the_tags('',', ',''); ?></p><span  class="meta-icon tag"></span><?php } ?>
			                                <p><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?><span  class="meta-icon comments"></span></p>
			                                <?php edit_post_link( __('edit', 'framework'), '<p><span class="edit-post">[', ']</span></p>' ); ?>
			                        <!--END .entry-meta -->
			                        <div class="widget" style="margin-top: 20px">
										<h4 class="share-this-title"><?php _e('SHARE', 'framework'); ?></h4>
										<ul class="share-this">
											<li>
											<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank">Facebook</a>
											</li>
											<li>
											<a href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink();?>" target="blank">Twitter</a>
											</li>
										</ul>
									</div>			                        
			                    </div>
		                            
		                            <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>


		                    <!--END .entry-content -->
		                    </div>


		                <!--END POST CONTENT -->
	                    </article>

                                


					<?php endwhile; ?>
	                
	                <?php comments_template('', true); ?>
	                

				<?php else : ?>

					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>

				<?php endif; ?>
	            
	            
				<!--END main content-->
				</section>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>