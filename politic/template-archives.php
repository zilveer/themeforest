<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>           

        <div class="page-title">

            <h1><span class="the-page-title"><?php the_title(); ?></span>           
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
            <section class="main-content twelve columns">
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <!--BEGIN .post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">                       
        
                            <!--BEGIN .entry-content -->
                            <div class="entry-content">
                        
                            <?php the_content(); ?>
                            
                                <!--BEGIN .archive-list -->
                                <div class="archive-list">

                                    <div class="six columns alpha">
                                        <h3><?php _e('Latest 10 posts', 'framework') ?></h3>
                        
                                        <ul>
                                        <?php $archive_10 = get_posts('numberposts=10');
                                            foreach($archive_10 as $post) : ?>
                                            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    
                                    </div>
                                    
                                    <div class="five columns omega">
                                        <h3><?php _e('Archives by month:', 'framework') ?></h3>
                                    
                                        <ul>
                                            <?php wp_get_archives('type=monthly'); ?>
                                        </ul>
                                    </div>
                                    
                                    <div class="four columns omega">
                                        <h3><?php _e('Archives by subjects:', 'framework') ?></h3>
                                    
                                        <ul>
                                            <?php wp_list_categories( 'title_li=' ); ?>
                                        </ul>
                                    </div>
                                
                                        <?php wp_reset_query(); ?>
                                <!--END .archive-list -->
                                </div>
                            
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