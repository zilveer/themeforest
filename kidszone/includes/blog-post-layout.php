<?php
	//PERFORMING BLOG POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	$post_layout = !empty($meta_set['blog-post-layout']) ? $meta_set['blog-post-layout'] : 'one-column';
	
	$article_class = "";
	$feature_image = "";
	$column = "";
	
	//POST LAYOUT CHECK...
	if($post_layout == "one-column") {
		$article_class = "column dt-sc-one-column blog-fullwidth";
		$feature_image = "blog-full";
	}
	elseif($post_layout == "one-half-column") {
		$article_class = "column dt-sc-one-half";
		$feature_image = "blog-twocolumn";
		$column = 2;
	}
	elseif($post_layout == "one-third-column") {
		$article_class = "column dt-sc-one-third";
		$feature_image = "blog-threecolumn";
		$column = 3;
	}
	
	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$article_class = $article_class." with-sidebar";
		$feature_image = $feature_image."-sidebar";
	}

	//POST VALUES....
	$limit = $meta_set['blog-post-per-page'];
	$cats  = $meta_set['blog-post-exclude-categories'];
	
	$cats = array_filter(array_unique($cats));
	
	if(count($cats) == 0) array_push($cats, '0');
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
		
	$args = array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => $limit, 'category__not_in' => $cats, 'ignore_sticky_posts' => 1);
	$wp_query = new WP_Query($args);
	
	if($wp_query->have_posts()): $i = 1;
	 echo '<div class="blog-isotope-wrapper">';
	 while($wp_query->have_posts()): $wp_query->the_post();
	 
	 	$temp_class = "";
		
		if($i == 1) $temp_class = $article_class." first"; else $temp_class = $article_class;
		if($i == $column) $i = 1; else $i = $i + 1; ?>
        
        <div class="<?php echo esc_attr($temp_class); ?>">
            <!-- POST BLOCK STARTS -->
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
                <div class="post-details"><?php
                	if(isset($meta_set['disable-date-info']) == ""): ?>
		                <div class="date"><span><?php echo get_the_date('d'); ?></span><?php echo get_the_date('M'); ?><br /><?php echo get_the_date('Y'); ?></div><?php
                    endif;
					if(isset($meta_set['disable-comment-info']) == ""): ?>
						<div class="post-comments">
							<?php comments_popup_link('0 <i class="fa fa-comment"></i>', '1 <i class="fa fa-comment"></i>', '% <i class="fa fa-comment"></i>', '', '0 <i class="fa fa-comment"></i>'); ?>
						</div><?php
					endif;
					//POST FORMAT...
					$format = get_post_format();
					$pholder = dt_theme_option('general', 'disable-placeholder-images'); ?>
                    <span class="post-icon-format"> </span>
                </div>
                <div class="post-content">
                
                    <div class="entry-thumb">
                        <?php if(is_sticky()): ?>
                            <div class="featured-post"><?php _e('Featured','iamd_text_domain'); ?></div>
                        <?php endif; ?>
                        
						<!-- POST FORMAT STARTS -->
						<?php if( $format === "image" || empty($format) ):
								if( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                      	$attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
                                    </a><?php
                                elseif($pholder != "true"): ?>
                                	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                                        <img src="http<?php dt_theme_ssl(true);?>://placehold.it/840x340&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                                    </a><?php
								endif;
                        	  elseif( $format === "gallery" ):
                                $post_meta = get_post_meta(get_the_id() ,'_dt_post_settings', true);
								$post_meta = is_array($post_meta) ? $post_meta : array();
                                if( array_key_exists("items", $post_meta) ):
                                    echo "<ul class='entry-gallery-post-slider'>";
                                    foreach ( $post_meta['items'] as $item ) { echo "<li><img src='{$item}' /></li>";	}
                                    echo "</ul>";
                                endif;
                              elseif( $format === "video" ):
                                    $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
									$post_meta = is_array($post_meta) ? $post_meta : array();
                                    if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
                                        if( array_key_exists('oembed-url', $post_meta) ):
                                            echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
                                        elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                            echo "<div class='dt-video-wrap'>".wp_video_shortcode( array('src' => $post_meta['self-hosted-url']) ).'</div>';
                                        endif;
                                    endif;
                              elseif( $format === "audio" ):
                                    $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
									$post_meta = is_array($post_meta) ? $post_meta : array();
                                    if( array_key_exists('oembed-url', $post_meta) || array_key_exists('self-hosted-url', $post_meta) ):
                                        if( array_key_exists('oembed-url', $post_meta) ):
                                            echo wp_oembed_get($post_meta['oembed-url']);
                                        elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                            echo wp_audio_shortcode( array('src' => $post_meta['self-hosted-url']) );
                                        endif;
                                    endif;
                              else:
								if( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                      	$attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr); ?>
                                    </a><?php
                                elseif($pholder != "true"): ?>
                                	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                                        <img src="http<?php dt_theme_ssl(true);?>://placehold.it/840x340&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                                    </a><?php
								endif;
							  endif; ?>
						<!-- POST FORMAT ENDS -->
                    </div>

                    <div class="entry-detail">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php
		                if(isset($meta_set['blog-post-excerpt']) != "")
                        	echo dt_theme_excerpt($meta_set['blog-post-excerpt-length']); ?>
                    </div>
                    <?php if(isset($meta_set['disable-author-info']) == "" || isset($meta_set['disable-category-info']) == "" || isset($meta_set['disable-tag-info']) == ""): ?>
                        <div class="post-meta">
                            <ul><?php
		                        if(isset($meta_set['disable-author-info']) == ""): ?>								
        	                        <li><span class="fa fa-user"></span><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author_meta('display_name'); ?></a></li><?php
								endif;
								if(isset($meta_set['disable-category-info']) == "" && count(get_the_category())): ?>
	                                <li><span class="fa fa-thumb-tack"></span><?php the_category(', '); ?></li><?php
								endif;
		                        if(isset($meta_set['disable-tag-info']) == ""): ?>
	                                <?php the_tags('<li><span class="fa fa-pencil"></span>', ', ', '</li>');
		                        endif; ?>
                            </ul>
                        </div>
					<?php endif; ?>
                </div>
            </article>
            <!-- POST BLOCK ENDS -->
		</div><?php
	 endwhile;
	 echo '</div>';
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination-wrapper">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query($wp_query);
	else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
	endif;
?>