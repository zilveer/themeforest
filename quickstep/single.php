<?php get_header(); ?>

		<div id="container-<?php the_ID(); ?>" class="container first">
			
			<div id="content" class="clearfix">
            
            	<div class="row">
                
				<?php if(qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
                <header class="twelve columns entry-title">
                    <h1 class="">  
                        <?php 
                            $page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
                            echo $page_title; 
                        ?>
                    </h1>
                    <h2 class="subtitle"><?php echo qs_get_meta('qs_page_subtitle', get_the_ID()); ?></h2>
                </header>
                <?php } ?>
			
				<div class="eight columns" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						

					
						<section class="post_content clearfix" itemprop="articleBody">
                                                    
                                                    <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) ) : ?>
                                                        <?php
                                                            if(qs_get_meta( 'qs_gallery_code', $post->ID ) ) {

                                                                    echo apply_filters('the_content', qs_get_meta( 'qs_gallery_code', $post->ID ) );

                                                            }
                                                        ?>
                                                    <?php elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) ) ) : ?>
                                                        <?php
                                                            if(qs_get_meta( 'qs_video_code', $post->ID ) ) {

                                                                    echo apply_filters('the_content', qs_get_meta( 'qs_video_code', $post->ID ) );

                                                            }
                                                        ?>
                                                    <?php elseif (has_post_thumbnail($post->ID)): ?>
                                                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                                        <img src="<?php echo $image[0]; ?>" />
                                                    <?php endif; ?>
                        
						<p class="meta2"><span class="post-author"><?php _e("By", "qs_framework"); ?> <?php the_author_posts_link(); ?></span> <time datetime="<?php echo the_time('Y-m-j'); ?>" ><?php the_time('F jS, Y'); ?></time></p>
                        
                        
							<?php the_content(); ?>				
					
						</section> <!-- end article section -->
						
						<footer>
			
						<?php the_tags('<p class="tags"><span class="tags-title">Tagged:</span> ', ', ', '</p>'); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>			
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>Not Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
    			<div class="four columns last">
				<?php get_sidebar(); // sidebar 1 ?>
    			</div>
    	
    			</div><!-- end row -->
    
			</div> <!-- end #content -->
            
       </div> <!-- end .container -->

<?php get_footer(); ?>