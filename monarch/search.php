<?php
 /**
  * The template for displaying search results pages.
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
  <main class="main col-xs-12 col-sm-12 col-md-12 col-lg-7 col-bg-6" role="main">

    <?php if ( have_posts() ) : ?>
    <header class="page-header">
      <div class="timeline-badge"><i class="ion-pin"></i></div>
      <div class="page-header-content">
        <em><?php printf( esc_html__( 'Search Results for:', 'monarch' ) ); ?></em>
        <h1 class="page-title"><span><?php printf( get_search_query() ); ?></span></h1>
      </div>
    </header>
    <!-- .page-header -->

    <div id="jp-scroll">
    <?php
      // Start the loop.
      while ( have_posts() ) : the_post();
      
         /*
          * Include the Post-Format-specific template for the content.
          * If you want to override this in a child theme, then include a file
          * called content-___.php (where ___ is the Post Format name) and that will be used instead.
          */
          get_template_part( 'content', get_post_format() );
      
      // End the loop.
      endwhile;
     ?>
     </div>

     <div class="post-wrap pagination">
        <?php

       // Previous/next page navigation.
       the_posts_pagination( array(
          'mid_size' => 4,
          'prev_text'          => esc_html__( '&larr; Previous page', 'monarch' ),
          'next_text'          => esc_html__( 'Next page &rarr;', 'monarch' ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'monarch' ) . ' </span>',
       ) );
        ?>
    </div>
        
    <?php
      // If no content, include the "No posts found" template.
      else :
      get_template_part( 'content', 'none' );
      
      endif;
    ?>
  </main>

  <!-- Sidebar one and two -->
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>