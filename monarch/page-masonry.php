<?php
/*
* Template Name: Page Masonry
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content fullwidth clearfix">

<!-- Main -->
<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-12 col-bg-12 masonry-blog" role="main">

<?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

  <?php if ( have_posts() ) : ?>
    
  <div class="masonry-posts masonry" id="jp-scroll">
    <?php while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
    endwhile; ?>
  </div>

  <div class="post-wrap pagination">
    <?php the_posts_pagination( array(
      'mid_size' => 4,
        'prev_text'          => esc_html__( '&larr; Previous page', 'monarch' ),
        'next_text'          => esc_html__( 'Next page &rarr;', 'monarch' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'monarch' ) . ' </span>',
      ) ); ?>
  </div>

  <?php else :
    get_template_part( 'content', 'none' );
  endif; wp_reset_query(); ?>

</main>

</div>

<?php get_footer(); ?>

