<?php
get_header(); ?>

<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
    <div class="content padded-top padded-bottom">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="post-content"><?php the_content(); ?></div>
        </div>
      <?php endwhile; endif; ?>
    </div>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();
?>