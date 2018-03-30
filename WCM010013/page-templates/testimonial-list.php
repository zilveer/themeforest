<?php
/* Template Name: Testimonial List */
?>
<?php get_header(); 
$tm_content_position = tm_content_position();
?>
<!-- Start testimonial-list -->

<div id="main-content" class="main-content testimonial-page testimonial-list <?php echo tm_sidebar_position(); ?>">
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
      <?php if($tm_content_position == 'above') : 
				// Page thumbnail
				templatemela_post_thumbnail();
				the_content(); 
			endif; ?>
      <div id="container" class="testimonial-list-container list-container">
        <?php	
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
			
			$last_class = "";
				$testimonial_args = array(
					'posts_per_page' 	=> tm_testimonial_box_posts_per_page(), 
					'paged' 			=> $paged,
					'post_type'			=> 'testimonial',
					'status'			=> 'publish',
				);
				$wp_query = new WP_Query();
    			$wp_query->query( $testimonial_args );
				if ( $wp_query->have_posts() ): ?>
        <div class="list">
          <?php 
				while( $wp_query->have_posts() ): $wp_query->the_post(); ?>
          <?php 
				get_post_meta($post->ID, 'testimonial_position', TRUE) ? $testimonial_position = get_post_meta($post->ID, 'testimonial_position', TRUE) : $testimonial_position = '';
				get_post_meta($post->ID, 'testimonial_link', TRUE) ? $testimonial_link = get_post_meta($post->ID, 'testimonial_link', TRUE) : $testimonial_link = ''; ?>
          <div class="list-item item">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <?php if ( has_post_thumbnail() && ! post_password_required() ) : 
					$post_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
				else:
					$post_image = templatemela_get_first_post_images(get_the_ID());
				endif;
				?>
              <div class="entry-content">
                <div class="content-full"> <?php echo the_content(); ?> </div>
                <div class="content-left">
                  <?php templatemela_print_images_thumb($post_image, get_the_title(get_the_ID()), 60, 60, 'left'); ?>
                </div>
                <div class="content-right">
                  <div class="testimonial-title"> <a href="<?php echo $testimonial_link; ?>" title="<?php echo get_the_title(); ?>">
                    <?php the_title(); ?>
                    </a> </div>
                  <span class="testimonial-position"><?php echo $testimonial_position; ?></span> <span class="testimonial-edit">
                  <?php edit_post_link( __( 'Edit', 'templatemela' ), '<span class="edit-link">', '</span>' ); ?>
                  </span> </div>
              </div>
            </article>
          </div>
          <!-- #post -->
          <?php endwhile; ?>
          <?php 
				else:  ?>
          <p>
            <?php  __( 'Sorry, no posts matched your criteria.', 'templatemela' ); ?>
          </p>
          <?php endif;
				 ?>
        </div>
        <?php // Post navigation.
			   templatemela_paging_nav();
			   wp_reset_query();  ?>
      </div>
      <?php if($tm_content_position == 'below') : 
				// Page thumbnail
				templatemela_post_thumbnail();
				the_content(); 
			endif; ?>
      <?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			} ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
  <?php get_sidebar(); ?>
</div>
<!-- End testimonial-list -->
<?php get_footer(); ?>
