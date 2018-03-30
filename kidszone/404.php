<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', '404-layout');

	  //BREADCRUMP...
	  if(dt_theme_option('general', 'disable-breadcrumb') != "on"): ?>
          <!-- breadcrumb starts here -->
          <section class="breadcrumb-wrapper">
              <div class="container">
                  <h1><?php _e('Lost', 'iamd_text_domain'); ?></h1>
                  <?php new dt_theme_breadcrumb; ?>
              </div>
          </section>
          <!-- breadcrumb ends here --><?php
	  endif; ?>

	  <!-- content starts here -->
	  <div class="content">
          <div class="container">
              <section class="<?php echo esc_attr($page_layout); ?>" id="primary">

                  <div class="error-404">
                      <div class="error">
                          <h2><?php _e('404!', 'iamd_text_domain'); ?></h2>
                          <h3><?php _e('Page not Found', 'iamd_text_domain'); ?></h3>
                      </div>
                      <?php
					    global $dt_allowed_html_tags;
                        echo wp_kses(stripcslashes(dt_theme_option('specialty','404-message')), $dt_allowed_html_tags);
                        get_search_form(); ?>
                  </div>

              </section>
              <?php if($page_layout != 'content-full-width' && $page_layout == 'with-left-sidebar'): ?>
                  <section class="left-sidebar" id="secondary"><?php get_sidebar('left'); ?></section>
              <?php elseif($page_layout != 'content-full-width' && $page_layout == 'with-right-sidebar'): ?>
                  <section id="secondary"><?php get_sidebar('right'); ?></section>
              <?php endif; ?>    
          </div>
      </div>
      <!-- content ends here -->

<?php get_footer(); ?>