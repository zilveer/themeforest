<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

	<section id="main" class="content-box container_12">

			<article class="inner-content">
			<?php
            
            //get 404 page
            $page_id = $stylico_theme_options['general']['page_404'];
            $page_404_query = null;
            $page_404_query = new WP_Query( array('page_id' => $page_id,
                                         'post_type' => 'page',
                                         'post_status' => 'publish',
                                         'posts_per_page' => 1,
                                         'caller_get_posts'=> 1) 
                                         );
            
            //start loop						   
            if ($page_404_query->have_posts()) : while ($page_404_query->have_posts()) : $page_404_query->the_post(); ?>
            
            <!-- Display bottom page -->
            <h2 class="post-title"><?php echo the_title(); ?></h2>
            <div class="entry-content"><?php the_content();  ?></div>
            
            <?php endwhile; ?>
            
            <?php get_search_form();?>
            
            <?php else : ?>
            
            <!-- Display error when no page has been found -->
            <h2 class="post-title"><?php _e('No Page found!', 'stylico'); ?></h2>
            <div class="entry-content"><?php printf(__('Sorry, there is no page with an ID of %s. Please go to the theme options and select another page you would like to use as 404 page.', 'stylico'), $page_id); ?></div>
            
            <?php endif; wp_reset_query();?>
            
            </article>

	</section>

<?php get_footer(); ?>