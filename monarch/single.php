<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
   
get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb clearfix">

  <!-- Main -->
  <main class="main col-xs-12 col-sm-12 col-md-12 col-lg-7 col-bg-6 single-post" role="main">
    <?php
      // Start the loop.
      while ( have_posts() ) : the_post();
      
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );
      
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                  comments_template();
            endif;
      
            // Previous/next post navigation.
            the_post_navigation( array(
                  'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'monarch' ) . '</span> ' .
                        '<span class="sr-only">' . esc_html__( 'Next post:', 'monarch' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                  'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'monarch' ) . '</span> ' .
                        '<span class="sr-only">' . esc_html__( 'Previous post:', 'monarch' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
            ) );
      
      // End the loop.
      endwhile;
    ?>
  </main>

  <!-- Sidebar one and two -->
  <?php get_sidebar(); ?>
  
</div>

<?php get_footer(); ?>