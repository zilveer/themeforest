<?php get_header();

	  #Getting meta values...
	  $page_layout = dt_theme_option('events', 'tt-event-detail-layout');

      get_template_part('includes/breadcrumb_section'); ?>
      
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

                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <div class="tt_event_theme_page timetable_clearfix">
                          <div class="tt_event_page_left">
                              <?php the_post_thumbnail("blog-onecol", array("alt" => get_the_title(), "title" => "")); ?>
                              <div class="dt-sc-hr-invisible-small"></div><div class="dt-sc-clear"></div>
                              <h2 class="border-title"><span><?php the_title();?></span></h2>
                              <?php
                              $subtitle = get_post_meta(get_the_ID(), "timetable_subtitle", true);
                              if($subtitle!=""): ?>
                                  <h5 class="section-title"><?php echo esc_attr($subtitle); ?></h5>
								  <div class="dt-sc-hr-invisible-small"></div><?php
                              endif;
                              if(have_posts()) : while (have_posts()) : the_post();
                                  echo tt_remove_wpautop(get_the_content());
                              endwhile; endif; ?>
                          </div>
                      </div>
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

get_footer(); ?>