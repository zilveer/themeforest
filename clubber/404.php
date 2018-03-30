<?php get_header(); ?>


<div id="content">

  <div class="title-head"><h1><?php _e('404 ERROR - Not Found', 'clubber'); ?></h1></div>
  <div class="content-404">
    <h4><?php _e('The page you requested does not exist.', 'clubber'); ?></h4>
  </div><!-- end .content-404 -->

</div><!-- end #content -->

<div class="display-none">
		<?php posts_nav_link(); ?>
		<?php the_post_thumbnail(); ?>
	 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
</div>
	
<?php get_footer(); ?>