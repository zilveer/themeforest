<?php
	#Performing blog post layout...
	$page_layout = "";
	$post_layout = "";

	if(is_archive() || is_home()) {
		$page_layout = dt_theme_option('specialty', 'post-archives-layout');
		$page_layout = !empty($page_layout) ? $page_layout : 'with-left-sidebar';
		$post_layout = dt_theme_option('specialty', 'post-archives-post-layout');
		$post_layout = !empty($post_layout) ? $post_layout : 'one-column';
	}
	elseif(is_search()) {
		$page_layout = dt_theme_option('specialty', 'search-layout');
		$page_layout = !empty($page_layout) ? $page_layout : 'with-left-sidebar';
		$post_layout = dt_theme_option('specialty', 'search-post-layout');
		$post_layout = !empty($post_layout) ? $post_layout : 'one-column';
	}

	$article_class = "";
	$feature_image = "blog-onecol";
	$column = "";

	#Post layout check...
	switch($post_layout) {
		case "one-column":
			$article_class = "column dt-sc-one-column"; $feature_image = "blog-onecol"; break;

		case "one-half-column":
			$article_class = "column dt-sc-one-half"; $feature_image = "blog-twocol"; $column = 2; break;

		case "one-third-column":
			$article_class = "column dt-sc-one-third"; $feature_image = "blog-threecol"; $column = 3; break;

		case "one-fourth-column":
			$article_class = "column dt-sc-one-third"; $feature_image = "blog-threecol"; $column = 3; break;
	}
	#Better image size...
	switch($page_layout) {
		case "with-left-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-right-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-both-sidebar":
			$article_class = $article_class." with-sidebar";
			$feature_image = $feature_image."-bothsidebar";
			break;
	}

	#Performing query...
	global $wp_query;

	if(have_posts()): $i = 1;
	 echo '<div class="tpl-blog-holder apply-isotope">';
	 while(have_posts()): the_post();

	 	$temp_class = "";

		if($i == 1) $temp_class = $article_class." first"; else $temp_class = $article_class;
		if($i == $column) $i = 1; else $i = $i + 1;
	 	  $format = get_post_format();
		  $format = !empty($format) ? $format : 'standard';
		  $pholder = dt_theme_option('general', 'enable-placeholder-images'); ?>

          <div class="<?php echo esc_attr($temp_class); ?>">
              <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                  <div class="blog-entry-inner">
                      <div class="entry-title">
                          <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                          <div class="entry-metadata"><?php
                              if(count(get_the_category())):
						    	echo '<p class="tags">'; the_category(' / '); echo '</p>';
							  endif; ?>
                          </div>
                      </div>
                      <div class="entry-thumb"><?php
						  #Switching the format...
						  switch($format):
							  case "image":
								if( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
										$attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										<div class="blog-overlay"><span class="image-overlay-inside"></span></div>
									</a><?php
								elseif($pholder == "true"): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
										<img src="http<?php dt_theme_ssl(true);?>://placehold.it/1168x600&text=<?php the_title(); ?>" width="1168" height="600" alt="<?php the_title(); ?>" />
										<div class="blog-overlay"><span class="image-overlay-inside"></span></div>
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
									echo '<div class="blog-overlay"><span class="image-overlay-inside"></span></div>';
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
								if( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
										$attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
										<div class="blog-overlay"><span class="image-overlay-inside"></span></div>
									</a><?php
								elseif($pholder == "true"): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
										<img src="http<?php dt_theme_ssl(true);?>://placehold.it/1168x600&text=<?php the_title(); ?>" width="1168" height="600" alt="<?php the_title(); ?>" />
										<div class="blog-overlay"><span class="image-overlay-inside"></span></div>
									</a><?php
								endif;
							  break;
						  endswitch; ?>
                          <div class="entry-meta">
                              <div class="date">
                                  <span><?php echo get_the_date('d'); ?></span>
                                  <?php echo get_the_date('M'); ?><br /><?php echo get_the_date('Y'); ?>
                              </div>
                          </div>
                      </div>
                      <div class="entry-body">
						  <?php if(is_sticky()): ?>
                              <div class="featured-post"><span><?php _e('Featured','iamd_text_domain'); ?></span></div>
                              <div class="dt-sc-clear"></div>
                          <?php endif; ?>
                          <?php the_excerpt(); ?>
                          <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'iamd_text_domain'); ?> <i class="fa fa-angle-double-right"></i></a>
                      </div>
                  </div>
              </article>
          </div><?php
	 endwhile;
	 echo '</div>';
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
    endif; ?>