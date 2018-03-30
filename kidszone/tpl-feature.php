<?php
/* 
	Template Name: Features Template
*/
	get_header();

	while(have_posts()): the_post();
		
	  if(is_page()) dt_theme_slider_section($post->ID);
	  
	  //GETTING META VALUES...
	  $meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	  
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
          <div class="container">
              <section class="<?php echo esc_attr($page_layout); ?>" id="primary">
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <ul class="side-nav"><?php
                        //POST PARENT CHECK...
                        if( $post->post_parent ):
                            $args = array('child_of' => $post->post_parent, 'title_li' => '', 'sort_order'=> 'ASC', 'sort_column'	=> 'menu_order');
                        else:
                            $args = array('child_of' => $post->ID, 'title_li' => '', 'sort_order'=> 'ASC', 'sort_column'	=> 'menu_order');
                        endif;
                            
                        $pages = get_pages( $args );
                        $ids = array();
                        $page_id = $post->ID;
                        foreach($pages as $value){
                            $ids[] = $value->ID;
                        }
                            
                        foreach( $ids as $id ) {
                            $title = get_the_title($id);
                            $permalink = get_permalink( $id );
    
                                $current_meta = get_post_meta($id, '_tpl_default_settings', true);
                                
                                $class = !empty($current_meta['menu-icon-class']) ? wp_kses($current_meta['menu-icon-class'], $dt_allowed_html_tags) : "icon-bullseye";
                                $current = ( $id ===  $page_id) ? "current_page_item" : "";
                                
                                echo "<li class='{$current}'>";
                                echo "<a href='{$permalink}' title='{$title}'  >$title <span class='fa {$class}'></span></a>";
                                echo "</li>";
                        }
                        wp_reset_query(); ?>
                      </ul>
                      <div class="with-side-nav">
                        <h2 class="hr-title"><span><?php the_title(); ?></span></h2><?php
                          //PAGE TOP CODE...
						  global $dt_allowed_html_tags;
                          if(dt_theme_option('integration', 'enable-single-page-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-page-top-code')), $dt_allowed_html_tags);
                          the_content();
                          wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
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