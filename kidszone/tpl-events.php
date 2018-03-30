<?php
/* 
	Template Name: Events Template
*/
	get_header();

	while(have_posts()): the_post();
		
	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'archives-layout'); ?>
      
	  <!-- content starts here -->
	  <div class="content">
          <div class="container">
              <section class="<?php echo esc_attr($page_layout); ?>" id="primary">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                      //PAGE TOP CODE...
                      the_content();
                      wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
                      edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' ); ?>
                  </article>
              </section>
              <?php if($page_layout != 'content-full-width' && $page_layout == 'with-left-sidebar'): ?>
                  <section class="left-sidebar" id="secondary"><?php get_sidebar('left'); ?></section>
              <?php elseif($page_layout != 'content-full-width' && $page_layout == 'with-right-sidebar'): ?>    
                  <section id="secondary"><?php get_sidebar('right'); ?></section>
              <?php endif;
        endwhile; ?>        	
          </div>
      </div>
      <!-- content ends here -->

<?php get_footer(); ?>