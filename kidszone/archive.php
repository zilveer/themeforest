<?php get_header();

	  //GETTING META VALUES...
	  $page_layout = dt_theme_option('specialty', 'archives-layout');
	  
	  //BREADCRUMP...
	  if(dt_theme_option('general', 'disable-breadcrumb') != "on"): ?>
          <!-- breadcrumb starts here -->
          <section class="breadcrumb-wrapper">
              <div class="container">
                  <h1><?php if(is_category()): _e('Category Archives of : ', 'iamd_text_domain'); echo single_cat_title();
                            elseif(is_day()):  _e('Daily Archives of : ', 'iamd_text_domain'); echo get_the_date('l');
                            elseif(is_month()):  _e('Monthly Archives of : ', 'iamd_text_domain'); echo get_the_date('F, Y');
                            elseif(is_year()):  _e('Yearly Archives of : ', 'iamd_text_domain'); echo get_the_date('Y');
                            elseif(is_author()):  _e('Archive by Author : ', 'iamd_text_domain'); $author = get_user_by('login', get_query_var('author_name')); echo $author->nickname;
                            elseif(is_tag()):  _e('Tag Archives of : ', 'iamd_text_domain'); echo single_tag_title('', true);
                            elseif(taxonomy_exists('category')):  _e('Archive of : ', 'iamd_text_domain'); echo single_cat_title();
                            endif; ?></h1>
                  <?php new dt_theme_breadcrumb; ?>
              </div>                      
          </section>
          <!-- breadcrumb ends here --><?php
	  endif; ?>    

	  <!-- content starts here -->
	  <div class="content">
          <div class="container">
              <section class="<?php echo esc_attr($page_layout); ?>" id="primary">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
                      //PERFORMING ARCHIVE LAYOUT...
                      get_template_part('includes/archive-post-layout'); ?>
                  </article>
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