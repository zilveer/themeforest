<?php
/* 
	Template Name: Full Width Home Template
*/
	get_header();

	while(have_posts()): the_post();
		
	  if(is_page()) dt_theme_slider_section($post->ID);
	  
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true); ?>
	  
	  <!-- content starts here -->
	  <div class="content">
          <section class="content-full-width" id="primary">
              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php          
                  //PAGE TOP CODE...
				  global $dt_allowed_html_tags;
                  if(dt_theme_option('integration', 'enable-single-page-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-top-code')), $dt_allowed_html_tags);
                  the_content();
                  wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
                  
			      <div class="container"><?php
            	      edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
	                  echo '<div class="social-bookmark">';
    	                  show_fblike('page'); show_googleplus('page'); show_twitter('page'); show_stumbleupon('page'); show_linkedin('page'); show_delicious('page'); show_pintrest('page'); show_digg('page');
	                  echo '</div>';
	                  dt_theme_social_bookmarks('sb-page');
	                  if(dt_theme_option('integration', 'enable-single-page-bottom-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-bottom-code')), $dt_allowed_html_tags);
	                  if(dt_theme_option('general', 'disable-page-comment') != true && (isset($meta_set['comment']) != "")) comments_template('', true); ?>
                  </div>                      
              </article>
          </section>
    <?php endwhile; ?>
      </div><!-- content ends here -->

<?php get_footer(); ?>