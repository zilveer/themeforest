<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bucket
 * @since Bucket 1.0
 */

get_header(); ?>

<div id="main" class="container container--main">
    <div class="grid">
        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php _e('Latest Articles', 'bucket') ?></h2>
                </div>

	            <?php if(wpgrade::option('blog_layout') == 'masonry') {
		            $grid_class= 'class="grid  masonry" data-columns';
	            } else {
		            $grid_class = 'class="classic"';
	            } ?>

	            <div <?php echo $grid_class;?>>
                    <?php while (have_posts()): the_post(); ?><!--
                        --><div class="masonry__item"><?php get_template_part('theme-partials/post-templates/content-'. wpgrade::option('blog_layout', 'masonry') ); ?></div><!--
                 --><?php endwhile; ?>
                </div>
				<?php echo wpgrade::pagination();
	        else: get_template_part( 'no-results', 'index' ); endif; ?>
        </div><!--
        
     --><div class="grid__item  one-third  palm-one-whole  sidebar">
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>
    
<?php get_footer(); ?>