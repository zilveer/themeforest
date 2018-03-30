<?php
/* Template Name: Testimonial Box */
?>
<?php get_header(); 
$tm_content_position = tm_content_position();
?>
<!-- Start testimonial-box -->

<div id="main-content" class="main-content testimonial-page testimonial-box <?php echo tm_sidebar_position(); ?>">
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
      <?php if($tm_content_position == 'above') : 
		// Page thumbnail
		templatemela_post_thumbnail();
		the_content(); 
	  endif; ?>
      <div id="container" class="testimonial-box-container box-container">
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
				$columns_number = tm_testimonial_box_columns_number();	
				if ( $wp_query->have_posts() ): ?>
        <div class="loading"> <img src="<?php echo get_template_directory_uri(); ?>/images/megnor/loading.gif" alt="" /> </div>
        <div class="masonry <?php echo tm_testimonial_box_columns_class(); ?>">
          <?php $i = 1;				while( $wp_query->have_posts() ): $wp_query->the_post();
				if($i % $columns_number == 1):
					$last_class = " first"; 	
				elseif($i % $columns_number == 0):
					$last_class = " last";
				else:
					$last_class = '';
				endif; ?>
          <div class="masonry-item item <?php echo $last_class; ?>">
            <?php 
				get_post_meta($post->ID, 'testimonial_position', TRUE) ? $testimonial_position = get_post_meta($post->ID, 'testimonial_position', TRUE) : $testimonial_position = '';
				get_post_meta($post->ID, 'testimonial_link', TRUE) ? $testimonial_link = get_post_meta($post->ID, 'testimonial_link', TRUE) : $testimonial_link = ''; ?>
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
            <!-- #post -->
          </div>
          <?php $i++; endwhile; ?>
          <?php 
				else:  ?>
          <p>
           <?php  __( 'Sorry, no posts matched your criteria.', 'templatemela' ); ?>
          </p>
          <?php endif; ?>
        </div>
        <?php // Post navigation.
				   templatemela_paging_nav(); 
				   wp_reset_query();  // Reset ?>
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
<!-- End testimonial-box -->
<?php get_footer(); ?>
