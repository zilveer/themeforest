<?php
get_header(); ?>
 <section id="headline">
    <div class="container">
      <h2><?php printf( '<small>'.esc_html__( 'Search Results for', 'webnus_framework' ).':</small> %s', get_search_query() ); ?></h2>
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
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	echo '<div class="wp-pagenavi">';
	next_posts_link(esc_html__('&larr; Previous page', 'webnus_framework'));
	previous_posts_link(esc_html__('Next page &rarr;', 'webnus_framework'));
} ?> 
      <div class="white-space"></div>
    </section>
	<aside class="col-md-3 sidebar">
		<?php dynamic_sidebar( 'Right Sidebar' ); ?>
	</aside>
    <br class="clear">
  </section>
<?php get_footer(); ?>