<?php

   /**
    * The main template file
    *
    * Timeline Posts
    *
    * This is the most generic template file in a WordPress theme
    * and one of the two required files for a theme (the other being style.css).
    * It is used to display a page when nothing more specific matches a query.
    * e.g., it puts together the home page when no home.php file exists.
    *
    * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
    *
    * @package WordPress
    * @subpackage Monarch
    * @since Monarch 1.0
    */
   
get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content fullwidth clearfix">

<!-- Main -->
<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-12 col-bg-12 timeline-blog" role="main">

  <?php if ( have_posts() ) : ?>
  <div class="masonry-posts masonry" id="jp-scroll">
    <?php while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
    endwhile; ?>
  </div>
  
  <div class="post-wrap pagination">
    <div class="timeline"></div>
    <?php the_posts_pagination( array(
      'mid_size' => 4,
        'prev_text'          => esc_html__( '&larr; Previous page', 'monarch' ),
        'next_text'          => esc_html__( 'Next page &rarr;', 'monarch' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'monarch' ) . ' </span>',
      ) ); ?>
  </div>

  <?php else :
    get_template_part( 'content', 'none' );
    endif;
  ?>

</main>

</div>