<?php
/**
 * Template Name: Page Left Sidebar
 * @package sellya Sport
 * @subpackage sellya_sport
 */
get_header(); ?>
<section id="midsection" class="container">
<div class="row">
 <?php get_sidebar('page-left'); ?>
	<section class="span9" id="content">
	    <div class="row-fluid">
        	<div class="breadcrumb">
				<?php 
                    if(function_exists('bcn_display'))
                        bcn_display();
                ?>                
            </div> 
        
		<?php while ( have_posts() ) : the_post(); ?>
		
		    <h1 class="entry-title"><?php the_title(); ?></h1>
		
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sellya' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sellya' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>	
		<?php endwhile; // end of the loop. ?>
		<?php if(comments_open()) comments_template(); ?>
	    </div>
	</section>
</div>
	
</section>

<?php get_footer(); ?>