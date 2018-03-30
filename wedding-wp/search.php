<?php
get_header(); ?>
 <section id="headline">
    <div class="container">
      <h3><?php printf( '<small>'.__( 'Search Results for', 'WEBNUS_TEXT_DOMAIN' ).':</small> %s', get_search_query() ); ?></h3>
    </div>
  </section>
    <section class="container search-results" >
    <hr class="vertical-space2">
	
	<!-- begin | main-content -->
    <section class="col-md-8">
     <?php
	 if(have_posts()):
		while( have_posts() ): the_post();
			get_template_part('parts/blogloop','search');
		endwhile;
	 else:
		get_template_part('parts/blogloop-none');
	 endif;
	 ?>
       
      <br class="clear">
      <?php 
		if(function_exists('wp_pagenavi'))
		{
			wp_pagenavi();
		}
	  ?>
      <div class="white-space"></div>
    </section>
	<?php get_sidebar('bright'); ?>
    <!-- end | main-content -->
	<?php //get_sidebar('right'); ?>
    <br class="clear">
  </section>
<?php get_footer(); ?>