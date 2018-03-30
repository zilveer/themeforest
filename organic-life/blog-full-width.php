<?php 
/**
* Template Name: Blog fullwidth 
*/
get_header();?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-12" role="main">
        	<?php
        		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	            $args = array('post_type' => 'post','paged' => $paged);
	            $posts = new WP_Query($args);
        	?>
	        <?php if ( $posts->have_posts() ) : ?>
	                <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
	                    <?php get_template_part( 'post-format/content', get_post_format() ); ?>
	                <?php endwhile; ?>
	                <?php wp_reset_query(); ?>
	        <?php else: ?>

	        <?php get_template_part( 'post-format/content', 'none' ); ?>

	        <?php endif; ?>
		  	<div class="btn btn-style pull-left"><?php next_posts_link( '&laquo; Older Posts',$posts->max_num_pages ); ?></div>
            <div class="btn btn-style pull-right"><?php previous_posts_link( 'Newer Posts &raquo;' ); ?></div>
        </div> <!-- #content -->
    </div> <!-- .row -->
</section> <!-- .container -->

<?php get_footer();