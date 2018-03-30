<?php
/* 
	Template Name: Events Template
*/
	get_header();

	while(have_posts()): the_post();

	  #Getting meta values...
	  $page_layout = "";
	  if(is_tax('tribe_events_cat')) $page_layout = dt_theme_option('events', 'event-category-layout');
	  elseif(in_array('events-single', get_body_class())) $page_layout = dt_theme_option('events', 'event-detail-layout');
	  elseif(in_array('events-archive', get_body_class())) $page_layout = dt_theme_option('events', 'event-archive-layout');
	  else $page_layout = dt_theme_option('events', 'event-archive-layout');

	  #Breadcrump section...
      if(!is_front_page() and !is_home()): ?>
		<div class="breadcrumb-wrapper <?php if(dt_theme_option('general','header-top-bar') == "true") echo esc_attr('notop'); ?>">
			<div class="container">
				<h1><?php
					global $wp_query;
					if(in_array('events-archive', get_body_class()))
						echo __('Events', 'iamd_text_domain');
					elseif(in_array('events-single', get_body_class()))
						echo single_post_title(); ?></h1><?php

					#Check Breadcrump Enable...
					if(dt_theme_option('general', 'disable-breadcrumb') != "on")
					  new dt_theme_breadcrumb; ?>
			</div>
		</div><?php
	  endif; ?>

      <div id="main">
          <!-- main-content starts here -->
          <div id="main-content">
              <div class="container">
                  <div class="dt-sc-hr-invisible"></div>
                  <div class="dt-sc-hr-invisible"></div>
  
                  <?php if($page_layout == 'with-left-sidebar'): ?>
                      <section class="secondary-sidebar secondary-has-left-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
                  <?php elseif($page_layout == 'with-both-sidebar'): ?>
                      <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-left"><?php get_sidebar('left'); ?></section>
                  <?php endif; ?>
  
                  <?php if($page_layout != 'content-full-width'): ?>
                        <section id="primary" class="page-with-sidebar page-<?php echo esc_attr($page_layout); ?>">
                  <?php else: ?>
                        <section id="primary" class="content-full-width">
                  <?php endif; ?>
  
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                        the_content();
                        wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
                        edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' ); ?>
                    </article>
                  </section>
  
                  <?php if($page_layout == 'with-right-sidebar'): ?>
                    <section class="secondary-sidebar secondary-has-right-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
                  <?php elseif($page_layout == 'with-both-sidebar'): ?>
                    <section class="secondary-sidebar secondary-has-both-sidebar" id="secondary-right"><?php get_sidebar('right'); ?></section>
                  <?php endif; ?>

              </div>
              <div class="dt-sc-hr-invisible-large"></div>
          </div>
      </div><?php

    endwhile;

get_footer(); ?>