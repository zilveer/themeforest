<?php
/*
	Template Name: Home Template
*/
	get_header();

	while(have_posts()): the_post();

	  $page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
	  if(is_page()) dt_theme_slider_section($page_id);

	  #Getting meta values...
	  $meta_set = get_post_meta($page_id, '_tpl_default_settings', true);

	  #Breadcrump section...
      if(isset($meta_set['show_slider']) == "" && !is_front_page() and !is_home()): ?>
        <div class="breadcrumb-wrapper <?php if(dt_theme_option('general','header-top-bar') == "true") echo esc_attr('notop'); ?>">
            <div class="container">
                <h1><?php the_title(); ?></h1><?php
                #Check breadcrumb enable...
                if(dt_theme_option('general', 'disable-breadcrumb') != "on")
                  new dt_theme_breadcrumb; ?>
            </div>
        </div><?php
      endif;

	  if(isset($meta_set['full-width-section']) != ''): ?>
          <div class="fullwidth-section full-add top-banner">
              <div class="container"><?php echo do_shortcode($meta_set['full-width-section']); ?></div>
          </div><?php
	  endif; ?>

      <div id="main">
          <!-- main-content starts here -->
          <div id="main-content">
              <section id="primary" class="content-full-width">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                      #Page top code...
					  global $dt_allowed_html_tags;
                      if(dt_theme_option('integration', 'enable-single-page-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-top-code')), $dt_allowed_html_tags);
                      the_content();
                      wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
    
                      <div style="background-repeat:no-repeat;background-position:left top;" class="fullwidth-section">
                          <div class="container"><?php
                              edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
                              echo '<div class="social-bookmark">';
                                  show_fblike('page'); show_googleplus('page'); show_twitter('page'); show_stumbleupon('page');
                                  show_linkedin('page'); show_delicious('page'); show_pintrest('page'); show_digg('page');
                              echo '</div>';
                              dt_theme_social_bookmarks('sb-page');
                              if(dt_theme_option('integration', 'enable-single-page-bottom-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-bottom-code')), $dt_allowed_html_tags);
                              if(dt_theme_option('general', 'disable-page-comment') != true && (isset($meta_set['comment']) != "")) comments_template('', true); ?>
                          </div>
                      </div>
                  </article>
              </section>
          </div>
      </div><?php

    endwhile;

get_footer(); ?>