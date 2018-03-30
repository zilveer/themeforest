<?php get_header(); ?>

<?php $st_page_sidebar_position = get_post_meta( get_the_ID(), '_st_page_sidebar', true ); ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php the_title(); ?></h1>
<?php if (get_post_meta( get_the_ID(), '_st_page_tagline', true )) { ?>
<p><?php echo get_post_meta( get_the_ID(), '_st_page_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php if (!get_post_meta( get_the_ID(), '_st_page_breadcrumbs', true )) { ?>
<!-- #breadcrumbs -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
<?php st_breadcrumb(); ?>
</div>
</div>
<!-- /#breadcrumbs -->
<?php } ?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_page_sidebar_position; ?> clearfix">
<div class="ht-container">

<!-- #content -->
  <section id="content" role="main">
  
    <?php while ( have_posts() ) : the_post(); ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>
      </div>

    </article>
    
    <?php endwhile; // end of the loop. ?>
    
  </section>
  <!-- #content -->
  
<?php if ($st_page_sidebar_position != 'off') {
get_sidebar();
} ?>
  
</div>
</div>
<!-- #primary -->
<?php get_footer(); ?>