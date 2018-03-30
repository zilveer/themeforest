<?php get_header(); ?>

<div id="container-<?php the_ID(); ?>" class="container first">
    
		<div id="content" class="clearfix">		
   
             	<div class="row">				
                
                <?php $pageURL = $_SERVER["REQUEST_URI"]; ?>  
                
                <h1 class="archive-title"><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>
				



				<section class="eight columns clearfix" role="main">
                
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						

					
						
						
								<?php // check if the post has a Post Thumbnail assigned to it.
                                if ( has_post_thumbnail() ) {     
								                      
									$thumb_id = get_post_thumbnail_id( $post->ID );
									$image = wp_get_attachment_image_src( $thumb_id,'full' );
									     	$prettyphoto_enabled = of_get_option('qs_blog_prettyphoto');
											if( $prettyphoto_enabled == '1') :
                                        		echo '<a rel="prettyPhoto" href="'.$image[0].'" >';
											endif; 
											
									the_post_thumbnail('blog');
											if( $prettyphoto_enabled == '1') :
												echo '</a>';
											endif;

                                } ?>
                                
                            <div class="meta">
                                <time datetime="<?php echo the_time('Y-m-j'); ?>" ><span class="day"><?php the_time('j'); ?></span><span class="month"><?php the_time('M'); ?> '<?php the_time('y'); ?></span></time>
                                <span class="post-author"><?php _e("By", "qs_framework"); ?> <?php the_author_posts_link(); ?> </span>
                                <?php the_tags('<p class="tags">', '<br />', '</p>'); ?>
                            </div>	
                            
                    	<section class="post-content nine columns last">                                        
                             <header>
                             
                                
                                    <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                    
    
                            
                            </header> <!-- end article header -->
                        
						
                        
							<?php the_content('Read More'); ?>
					
						</section> <!-- end article section -->
						
						<footer>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>

					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "qs_framework")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "qs_framework")) ?></li>
							</ul>
						</nav>
					<?php } ?>
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>No Results Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</section> <!-- end #main -->

    			
                <div class="four columns last">
					<?php get_sidebar(); // sidebar 1 ?>
                </div>
    
    			</div><!-- end .row -->  
   
    
			</div> <!-- end #content -->
</div>

<?php get_footer(); ?>