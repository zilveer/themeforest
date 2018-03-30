<?php
/**
 * Template Name: Blog
 *
 * If you want to set up an alternate blog page, just use this template for your page.
 * This template shows your latest posts.
 *
 */

get_header(); // Loads the header.php template. ?>

	<section id="main" class="content-box page-blog grid_8 alpha">
        <div class="inner-content">
			<?php
			//get sticky posts
			$sticky = get_option( 'sticky_posts' );
			
			//check if we are one the first page and sticky posts exists
			if(!$paged && $sticky) {
				//show only one and the last sticky post at the top
				$temp = $wp_query;
			    $wp_query= null;
				$wp_query = new WP_Query('p=' . $sticky[sizeof($sticky)-1]);
				if (have_posts())  {
				  while ($wp_query->have_posts()) {
					  $wp_query->the_post();
					   get_template_part('loop', 'sticky');
				  }	
				}
				wp_reset_query();
			}
			
			//get regular posts
            $more = 0;
            $temp = $wp_query;
            $wp_query= null;
            $wp_query = new WP_Query();
            $wp_query->query('ignore_sticky_posts=1&posts_per_page='.get_option('posts_per_page').'&paged='.$paged);
            if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
			
				get_template_part('loop');
				endwhile;
				stylico_content_nav();
			
			?>
            
            <?php else: ?>
            <article class="post-entry">
                <h2><?php _e('Error:', 'stylico') ?></h2>
                <p><?php _e('No posts found!', 'stylico') ?></p>
            </article>
            <?php endif; ?>
        </div>
    </section>

    <?php get_sidebar(); // Loads the sidebar.php template. ?>

<?php get_footer(); // Loads the footer.php template. ?>