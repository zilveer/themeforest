<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>           
       
        <div class="container background row-fluid main-container">

            <!--BEGIN #main-content -->
            <section class="main-content span9">
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <!--BEGIN .post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       
        
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">
                        
                            <?php the_content(); ?>
                            
                                <!--BEGIN .archive-list -->
                                <div class="archive-list">

                                    <div class="span8">
                                        <h3><?php _e('Latest 10 posts', 'framework') ?></h3>
                        
                                        <ul>
                                        <?php $archive_10 = get_posts('numberposts=10');
                                            foreach($archive_10 as $post) : ?>
                                            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                                        <?php endforeach; ?>
                                        </ul>

                                        <h3><?php _e('Last 15 days', 'framework') ?></h3>
                                        <ul>
                                            <?php wp_get_archives('type=daily&limit=15'); ?>
                                        </ul>
                                    
                                    </div>
                                    
                                    <div class="span4">
                                        <h3><?php _e('Archives by month:', 'framework') ?></h3>
                                    
                                        <ul>
                                            <?php wp_get_archives('type=monthly'); ?>
                                        </ul>


                                        <h3><?php _e('Archives by week:', 'framework') ?></h3>
                                        <ul>
                                            <?php wp_get_archives('type=weekly&limit=15'); ?>
                                        </ul>

                                       <h3><?php _e('Archives by subjects:', 'framework') ?></h3>
                                    
                                        <ul>
                                            <?php wp_list_categories( 'title_li=' ); ?>
                                        </ul>
                                    </div>
                                
                                <?php wp_reset_query(); ?>
                                <!--END .archive-list -->
                                </div>

                                <!-- Output the default WP Comment Form -->
                                <?php comment_form(); ?>                            
                            
                            <!--END .entry-content -->
                            </div>

    				<!--END .post-->  
    				</div>

				<?php endwhile; ?>

			<?php else : ?>

				<!--BEGIN #post-0-->
				<div id="post-404" <?php post_class(); ?>>
				
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
				
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
					<!--END .entry-content-->
					</div>
				
				<!--END #post-0-->
				</div>

			<?php endif; ?>

        </section>


<?php get_sidebar(); ?>

    </div>

<?php get_footer(); ?>