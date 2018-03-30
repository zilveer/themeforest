<?php get_header(); ?>

  
  <!--BEGIN #content-wrap-->
  <div id="content-wrap" class="sidebar-Right"> 
    <!--BEGIN #content-->
    <section id="content">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
       <h1 class="entry-title"><?php the_title(); ?></h1>
       <div class="clear"></div>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </div>
      <?php endwhile; ?>
      <!--END #content--> 
    </section>

<?php get_sidebar(); ?>
    
    <!--END #content-wrap--> 
    <div class="clear"></div>
  </div>
<?php get_footer(); ?>
