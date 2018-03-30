<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'not-found-404-layout'); ?>

      <div class="breadcrumb-wrapper">
          <div class="container">
              <h1><?php _e('Lost', 'iamd_text_domain'); ?></h1><?php
              if(dt_theme_option('general', 'disable-breadcrumb') != "on")
                new dt_theme_breadcrumb; ?>
          </div>
      </div>

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

                    <article class="error-404 aligncenter">
                        <h2 class="fa fa-user-times"><span>404</span></h2><?php
						global $dt_allowed_html_tags;
                        echo wp_kses(stripcslashes(dt_theme_option('specialty','404-message')), $dt_allowed_html_tags);
                        get_search_form(); ?>                        
                        <div class="dt-sc-hr-invisible-small"></div>
                        <a href="<?php echo esc_url(home_url('/'));?>" class="dt-sc-button medium"><span data-hover="<?php _e('Back to Home', 'iamd_text_domain'); ?>"><?php _e('Back to Home', 'iamd_text_domain'); ?></span></a>
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
      </div>

<?php get_footer(); ?>