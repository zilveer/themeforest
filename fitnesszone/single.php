<?php get_header();

	while(have_posts()): the_post();

	  #Getting meta values...
	  $meta_set = get_post_meta($post->ID, '_dt_post_settings', true);
	  if($GLOBALS['force_enable'] == true)
	  	$page_layout = $GLOBALS['page_layout'];
	  else
	  	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];

	  $feature_image = "blog-onecol";

	  #Better image size...
	  switch($page_layout) {
		  case "with-left-sidebar":
			  $feature_image = $feature_image."-sidebar";
			  break;
		  
		  case "with-right-sidebar":
			  $feature_image = $feature_image."-sidebar";
			  break;
  
		  case "with-both-sidebar":
			  $feature_image = $feature_image."-bothsidebar";
			  break;
	  }

	  #Breadcrump section...
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
                  <?php endif;
						#Getting posts format...
						$format = get_post_format();
						$format = !empty($format) ? $format : 'standard';
						$pholder = dt_theme_option('general', 'enable-placeholder-images'); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry blog-single-entry'); ?>>
                        <div class="blog-entry-inner">
                            <div class="entry-thumb"><?php
								#Switching the format...
								switch($format):
									case "image":
									  if( has_post_thumbnail() && isset($meta_set['disable-featured-image']) == "" ): ?>
										  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
											  $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										  </a><?php
									  elseif($pholder == "true" && isset($meta_set['disable-featured-image']) == ""): ?>
										  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
											  <img src="http<?php dt_theme_ssl(true);?>://placehold.it/1168x600&text=<?php the_title(); ?>" width="1168" height="600" alt="<?php the_title(); ?>" />
										  </a><?php
									  endif;
									break;
	  
									case "gallery":
									  $post_meta = get_post_meta(get_the_id() ,'_dt_post_settings', true);
									  $post_meta = is_array($post_meta) ? $post_meta : array();
									  if( array_key_exists("items", $post_meta) ):
										  echo "<ul class='entry-gallery-post-slider'>";
										  foreach ( $post_meta['items'] as $item ) { echo "<li><img src='{$item}' alt='gal-img' /></li>";	}
										  echo "</ul>";
									  endif;
									break;
	  
									case "video":
									  $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
									  $post_meta = is_array($post_meta) ? $post_meta : array();
									  if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
										  if( array_key_exists('oembed-url', $post_meta) ):
											  echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
										  elseif( array_key_exists('self-hosted-url', $post_meta) ):
											  echo "<div class='dt-video-wrap'>".wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) ).'</div>';
										  endif;
									  endif;
									break;
	  
									case "audio":
									  $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
									  $post_meta = is_array($post_meta) ? $post_meta : array();
									  if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
										  if( array_key_exists('oembed-url', $post_meta) ):
											  echo wp_oembed_get($post_meta['oembed-url']);
										  elseif( array_key_exists('self-hosted-url', $post_meta) ):
											  echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
										  endif;
									  endif;
									break;
	  
									default:
									  if( has_post_thumbnail() && isset($meta_set['disable-featured-image']) == "" ): ?>
										  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
											  $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										  </a><?php
									  elseif($pholder == "true" && isset($meta_set['disable-featured-image']) == ""): ?>
										  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
											  <img src="http<?php dt_theme_ssl(true);?>://placehold.it/1168x600&text=<?php the_title(); ?>" width="1168" height="600" alt="<?php the_title(); ?>" />
										  </a><?php
									  endif;
									break;
								endswitch;
								if(isset($meta_set['disable-date-info']) == ""): ?>
                                    <div class="entry-meta">
                                        <div class="date">
                                            <span><?php echo get_the_date('d'); ?></span>
                                            <?php echo get_the_date('M'); ?><br /><?php echo get_the_date('Y'); ?>
                                        </div>
                                    </div><?php
								endif; ?>	
                            </div>
                            <div class="entry-metadata"><?php
								#Sticky...
								if(is_sticky()): ?>
                                	<div class="featured-post"><span><?php _e('Featured','iamd_text_domain'); ?></span></div>
									<div class="dt-sc-clear"></div><?php
                          		endif; ?>

                                <div class="post-meta"><?php
								 if(isset($meta_set['disable-author-info']) == ""): ?>
                                    <p class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span class="fa fa-user"></span><?php the_author_meta('display_name'); ?></a></p><?php
                                 endif;
                                 if(isset($meta_set['disable-comment-info']) == ""): ?>
                                    <p><?php comments_popup_link('<span class="fa fa-comment"> </span>0', '<span class="fa fa-comment"> </span>1', '<span class="fa fa-comment"> </span>%', '', '<span class="fa fa-comment"> </span>0'); ?></p><?php
								 endif;
								 if(isset($meta_set['disable-category-info']) == "" && count(get_the_category())):
									echo '<p class="tags">'; the_category(' / '); echo '</p>';
								 endif; ?>
                                </div>

                                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4><?php
								#Post top code...
								global $dt_allowed_html_tags;
								if(dt_theme_option('integration', 'enable-single-post-top-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-post-top-code')), $dt_allowed_html_tags);
								the_content();
								wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'iamd_text_domain').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
								edit_post_link(__('Edit', 'iamd_text_domain'), '<span class="edit-link">', '</span>' );
								echo '<div class="social-bookmark">';
								show_fblike('post'); show_googleplus('post'); show_twitter('post'); show_stumbleupon('post'); show_linkedin('post'); show_delicious('post'); show_pintrest('post'); show_digg('post');																
								echo '</div>';
								dt_theme_social_bookmarks('sb-post');
								if(dt_theme_option('integration', 'enable-single-post-bottom-code') != '') echo wp_kses(stripslashes(dt_theme_option('integration', 'single-post-bottom-code')), $dt_allowed_html_tags); ?>
                            </div>
                        </div>
                    </article>

                    <div class="author-info">
                        <h2 class="section-title"><?php _e('About the Author', 'iamd_text_domain'); ?></h2>
                        <div class="thumb">
	                        <?php echo get_avatar(get_the_author_meta('user_email'), $size = '85'); ?>
                        </div>
                        <div class="author-desc">
                            <div class="author-title"><?php
								$user_info = get_userdata(get_the_author_meta('ID')); ?>
                                <p><?php _e('By', 'iamd_text_domain'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta('ID')); ?>"><?php echo $user_info->user_login; ?></a> / <?php echo ucfirst(implode(', ', $user_info->roles)); ?> <span><?php _e('on', 'iamd_text_domain'); echo get_the_date(' M d, Y'); ?></span></p>
                                <span><i class="fa fa-twitter"></i><a href="https://twitter.com/<?php echo $user_info->user_nicename; ?>"><?php _e('Follow ', 'iamd_text_domain'); echo $user_info->user_nicename; ?></a></span>
                            </div>
                            <p><?php the_author_meta('description'); ?></p>
                        </div>
                    </div>
                    <?php if(dt_theme_option('general', 'global-post-comment') != true && (isset($meta_set['disable-comment']) == "")) comments_template('', true); ?>
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