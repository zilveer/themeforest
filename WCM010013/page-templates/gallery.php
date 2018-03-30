<?php
/* Template Name: Gallery */ 
?>
<?php get_header(); ?>
<!--Start gallery-page-->

<div id="main-content" class="main-content blog-page blog-filter <?php echo tm_sidebar_position(); ?>">
   	<?php 
$tm_content_show_page_title = get_post_meta(get_the_ID(), 'tm_content_show_page_title', true);
if($tm_content_show_page_title == 1): ?>
<div class="page-title">
  <div class="page-title-inner">
    <h1 class="entry-title-main">
      <?php the_title(); ?>
    </h1>
    <?php templatemela_breadcrumbs(); ?>
  </div>
</div>
<?php endif; ?>
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
      <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
      <?php //comments_template( '', true ); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- End blog-filter -->
<?php get_footer(); ?>
