<?php
/* 
	Template Name: Full Width Template
*/
	get_header();

	while(have_posts()): the_post();
		
	  if(is_page()) dt_theme_slider_section($post->ID);
	  
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	  
	  //BREADCRUMP...
	  if(!is_front_page() and !is_home()):
		  if(dt_theme_option('general', 'disable-breadcrumb') != "on"): ?>
			  <!-- breadcrumb starts here -->
			  <section class="breadcrumb-wrapper">
				  <div class="container">
					  <h1><?php the_title(); ?></h1>
					  <?php new dt_theme_breadcrumb; ?>
				  </div>                      
			  </section>
			  <!-- breadcrumb ends here --><?php
		  endif;
	  endif; ?>
      
	  <!-- content starts here -->
	  <div class="content">
          <section class="content-full-width" id="primary">
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php          
                  //PAGE TOP CODE...
                  if(dt_theme_option('integration', 'enable-single-page-top-code') != '') echo stripslashes(dt_theme_option('integration', 'single-page-top-code'));
                  the_content();
                  wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
                  
			      <div class="container"><?php
            	      edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
	                  echo '<div class="social-bookmark">';
    	                  show_fblike('page'); show_googleplus('page'); show_twitter('page'); show_stumbleupon('page'); show_linkedin('page'); show_delicious('page'); show_pintrest('page'); show_digg('page');
	                  echo '</div>';
	                  dt_theme_social_bookmarks('sb-page');
	                  if(dt_theme_option('integration', 'enable-single-page-bottom-code') != '') echo stripslashes(dt_theme_option('integration', 'single-page-bottom-code'));
	                  if(dt_theme_option('general', 'disable-page-comment') != true && (isset($meta_set['comment']) != "")) comments_template('', true); ?>
                  </div>                      
              </article>
          </section>
    <?php endwhile; ?>
      </div><!-- content ends here -->

<?php get_footer(); ?>