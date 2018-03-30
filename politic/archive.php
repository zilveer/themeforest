<?php get_header(); ?>

		<div class="page-title">

			<?php

			/* Fetching the Current Author Data */ 

				if(get_query_var('author_name')) :
					$curauth = get_userdatabylogin(get_query_var('author_name'));
				else :
					$curauth = get_userdata(get_query_var('author'));
				endif;

			?>

			<h1><span class="the-page-title"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
						<h1><span><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></span></h1>
			 	  	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<h1><span><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></span></h1>
			 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<h1><span><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></span></h1>
			 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<h1><span><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></span></h1>
			 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<h1><span><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></span></h1>
				  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<h1><span><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></span></h1>
			 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<h1><span><?php _e('Blog Archives', 'framework') ?></span></h1>
			 	  	<?php } ?></span>			
				<span class="page-subtitle">
					<?php 
					global $post;
					if(get_post_meta($post->ID, 'heading_value', true) != '') 
						echo get_post_meta($post->ID, 'heading_value', true); 
					?>
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

			<!--BEGIN #main-content -->
			<section class="main-content twelve columns alpha">


        	<ul class="posts-list">	    	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<!--BEGIN post -->
				<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">


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

	                        		<div style="margin-top: 20px">
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
				
				<!--END post-->  
				</li>

					
				<?php endwhile; ?>

			</ul>

			<!--BEGIN .navigation-->
			<div class="navigation-posts">
            
				<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                
			<!--END .navigation-->
			</div>

			<?php else : ?>
	
			<?php if ( is_category() ) { 
			// If this is a category archive
				printf(__('<h2>Sorry, but there aren\'t any posts in the %s category yet.</h2>', 'framework'), single_cat_title('',false));
			} elseif ( is_tag() ) { 
			// If this is a tag archive
			    printf(__('<h2>Sorry, but there aren\'t any posts tagged %s yet.</h2>', 'framework'), single_tag_title('',false));
			} elseif ( is_date() ) { 
			// If this is a date archive
				echo(__('<h2>Sorry, but there aren\'t any posts with this date.</h2>', 'framework'));
			} elseif ( is_author() ) { 
			// If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf(__('<h2>Sorry, but there aren\'t any posts by %s yet.</h2>', 'framework'), $userdata->display_name);
			} else {
				echo(__('<h2>No posts found.</h2>', 'framework'));
			}
			endif; ?>	

			<!--END main-content -->
			</section>


<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>