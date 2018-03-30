<?php
/**
 * The template for displaying Author archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

<div id="main" class="container container--main">

    <div class="grid">

        <div class="grid__item  two-thirds  palm-one-whole">
            <?php if (have_posts()): ?>
				
				<?php
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>
                <div class="heading  heading--main">
                    <h2 class="hN"><?php printf( __( 'All posts by %s', 'bucket' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h2>
                </div>
			
				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>
			
				<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<?php get_template_part( 'author-bio' ); ?>
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