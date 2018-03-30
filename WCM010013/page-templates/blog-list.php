<?php
/* Template Name: Blog List */
?>
<?php get_header(); 
$tm_content_position = tm_content_position();
?>
<!-- Start blog-list -->

<div id="main-content" class="main-content blog-page blog-list <?php echo tm_sidebar_position(); ?>">
  <div id="primary" class="content-area">
  <?php $tm_content_show_page_title = get_post_meta(get_the_ID(), 'tm_content_show_page_title', true);
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

    <div id="content" class="site-content" role="main">
      <?php if($tm_content_position == 'above') : 
				// Page thumbnail
				templatemela_post_thumbnail();
				the_content(); 
			endif; ?>
      <div id="container" class="blog-list-container">
        <?php	
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }			
			wp_reset_query();  // re-sets query
  			$last_class = "";
				$blog_args = array(
					'posts_per_page' 	=> tm_blog_list_posts_per_page(), 
					'paged' 			=> $paged,
					'post_type'			=> 'post',
					'status'			=> 'publish',
				);
				$wp_query = new WP_Query();
    			$wp_query->query( $blog_args );
				if ( $wp_query->have_posts() ): ?>
        <?php 
				while( $wp_query->have_posts() ): $wp_query->the_post(); ?>
        <div class="item">
          <?php  $post_format = get_post_format();
					get_template_part( 'content', $post_format );
			  ?>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p>
          <?php  __( 'Sorry, no posts matched your criteria.', 'templatemela' ); ?>
        </p>
        <?php endif;
				 ?>
        <?php // Post navigation.
			   templatemela_paging_nav();
			   wp_reset_query();  ?>
      </div>
      <?php if($tm_content_position == 'below') : 
				// Page thumbnail
				templatemela_post_thumbnail();
				the_content(); 
			endif; ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- End blog-list -->
<?php get_footer(); ?>
