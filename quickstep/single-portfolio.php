<?php get_header(); ?>

<div id="container-<?php the_ID(); ?>" class="container first">
			
			<div id="content" class="clearfix">
            
            	<div class="row">
                
				<?php if(qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
                <hgroup class="twelve columns entry-title">
                    <h1 class="">  
                        <?php 
                            $page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
                            echo $page_title; 
                        ?>
                    </h1>
                    <h2 class="subtitle"><?php echo qs_get_meta('qs_project_description', get_the_ID()); ?></h2>
                </hgroup>
                <?php } ?>
			
				<div class="twelve columns" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
					<div class="four columns">
						<section class="project-info" >
                        	<span class="info-label"><?php _e('Date', 'qs_framework'); ?>: &nbsp;&nbsp;</span><span class="post-time"><?php the_time('F j, Y'); ?></span><br />
                             <?php 
                            $client = qs_get_meta('qs_client_name', get_the_ID());
							if($client): 
							?>
                            	<span class="info-label"><?php _e('Client', 'qs_framework'); ?>: &nbsp;&nbsp;</span><span class="project-client"><?php echo $client; ?></span><br />
                            <?php endif; ?>
                            <?php
                            $website = qs_get_meta('qs_project_website', get_the_ID());
							if($website): 
							?>
                            	<span class="project-website"><a href="<?php echo $website; ?>" target="_blank"><?php _e('Launch Website', 'qs_framework'); ?></a></span><br />
                            <?php endif; ?>
                            
                        	<?php $terms = get_the_terms( get_the_ID(), 'filter' ); ?>
                            <?php if($terms): ?>
                            	<ul class="terms">
                            <?php foreach ($terms as $term) { echo '<li><a class="button small" href="'.get_term_link($term).'">'.$term->name.'</a><li>'; } ?>
								</ul>
                             <?php endif; ?>
                        </section>
                    
                    
                    
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							
					
						</section> <!-- end article section -->
						
						<footer>
			
							
							
						</footer> <!-- end article footer -->
                        
                   </div>
                   
                                            <div class="eight columns last">
                                                        <?php if(qs_get_meta('qs_project_code')): ?> 
                                                            <?php echo apply_filters( 'the_content', do_shortcode(qs_get_meta('qs_project_code',  $post->ID ))); ?>   
                                                
                                                        <?php elseif (has_post_thumbnail($post->ID)): ?>
                                                            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                                            <img src="<?php echo $image[0]; ?>" />
                                                        <?php endif; ?>
                                                    </div>
					
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
    

    	
    			</div><!-- end row -->
    
			</div> <!-- end #content -->
         
</div> <!-- end .container -->

<?php get_footer(); ?>