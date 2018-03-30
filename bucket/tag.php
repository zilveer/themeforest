<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php printf( __( 'Tag Archives: %s', 'bucket' ), single_tag_title( '', false ) ); ?></h2>
					
                </div>
				<?php if ( tag_description() ) : // Show an optional tag description ?>
				    <div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif;

	            if(wpgrade::option('blog_layout') == 'masonry') {
		            $grid_class= 'class="grid  masonry" data-columns';
	            } else {
		            $grid_class = 'class="classic"';
	            } ?>

	            <div <?php echo $grid_class;?>>
                    <?php while (have_posts()): the_post(); ?><!--
                        --><div class="<?php echo wpgrade::option('blog_layout')?>__item"><?php get_template_part('theme-partials/post-templates/content-'. wpgrade::option('blog_layout', 'masonry') ); ?></div><!--
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