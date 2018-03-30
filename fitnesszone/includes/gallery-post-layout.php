<?php
	#Performing gallery post layout...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	$post_layout = !empty($meta_set['gallery-post-layout']) ? $meta_set['gallery-post-layout'] : 'one-half-column';
	$default_width = !empty($meta_set['gallery-fullwidth']) ? $meta_set['gallery-fullwidth'] : '';

	$li_class = "";
	$feature_image = "";
	$nospace = "";

	#Post layout check...
	switch($post_layout) {
		case "one-half-column":
			$li_class = "portfolio dt-sc-one-half column"; $feature_image = "gallery-twocol"; break;

		case "one-third-column":
			$li_class = "portfolio dt-sc-one-third column"; $feature_image = "gallery-threecol"; break;

		case "one-fourth-column":
			$li_class = "portfolio dt-sc-one-fourth column"; $feature_image = "gallery-fourcol"; break;
	}
	#Better image size...
	switch($page_layout) {
		case "with-left-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;
		
		case "with-right-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-sidebar";
			break;

		case "with-both-sidebar":
			$li_class = $li_class." with-sidebar";
			$feature_image = $feature_image."-bothsidebar";
			break;
	}

	if($default_width == "") { $feature_image = "full"; $nospace = "no-space"; }

	#Post values...
	$limit = $meta_set['gallery-post-per-page'];
	$cats  = $meta_set['gallery-categories'];
	
	$cats = array_filter(array_unique($cats));
	
	if(empty($cats)) {
		$cats = get_categories('taxonomy=gallery_entries&hide_empty=1');
		$cats = get_terms( array('gallery_entries'), array('fields' => 'ids'));		
	}

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }

	#Performing query...
	$args = array('post_type' => 'dt_galleries', 'paged' => $paged , 'posts_per_page' => $limit,
																				   'tax_query' => array( 
																						array( 
																								'taxonomy' => 'gallery_entries', 
																								'field' => 'id', 
																								'terms' => $cats
																						)));
	$the_query = new WP_Query($args);
	if($the_query->have_posts()):

	 if(isset($meta_set['filter']) != ""): ?>
         <div class="dt-sc-sorting-container">
            <a class="first active-sort" data-filter="*" href="#"><?php _e('All', 'iamd_text_domain'); ?></a>
            <?php
				foreach($cats as $term) {
					$myterm = get_term_by('id', $term, 'gallery_entries');
					?><a href="#" data-filter=".<?php echo strtolower($myterm->slug); ?>"><?php echo $myterm->name; ?></a><?php
				}?>
         </div><?php
	 endif; ?>

     <div class="dt-sc-portfolio-container"><?php
		while($the_query->have_posts()): $the_query->the_post(); 
			$terms = wp_get_post_terms($post->ID, 'gallery_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun"); ?>
            
            <div class="<?php echo esc_attr($li_class." ".strtolower(implode(" ", $terms))." ".$nospace); ?>">
                <div class="portfolio-thumb"><?php
					$fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
					$currenturl = $fullimg[0]; $currenticon = "fa-plus";
					$pmeta_set = get_post_meta($post->ID, '_gallery_settings', true);
					if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
						$currenturl = $pmeta_set ['items'] [0];
						$currenticon = "fa-video-camera";
					}
					#Gallery images...
					if(has_post_thumbnail()):
						$attr = array('title' => get_the_title(), 'alt' => get_the_title());
						the_post_thumbnail($feature_image, $attr);
					else: ?>
						<img src="http<?php dt_theme_ssl(true);?>://placehold.it/1170X800.jpg&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><?php
					endif; ?>
                    <div class="image-overlay">
                        <div class="fig-content-wrapper">
                            <div class="fig-overlay">
                              <p>
                                  <a class="zoom" title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo esc_url($currenturl); ?>"><span class="fa <?php echo esc_attr($currenticon); ?>"> </span></a>
                                  <a class="link" href="<?php the_permalink(); ?>"> <span class="fa fa-link"> </span> </a>
                              </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-detail">
                    <div class="portfolio-title">
                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo get_the_term_list($post->ID, 'gallery_entries', ' ', ', ', ' '); ?></p>
                    </div>
                    <?php if(dt_theme_is_plugin_active('roses-like-this/likethis.php')): ?>
                        <div class="views">
                            <span><i class="fa fa-heart-o"></i><br><?php printLikes($post->ID); ?></span>
                        </div>
					<?php endif; ?>
                </div>
            </div><?php
		endwhile; ?>
     </div><?php
	 if($the_query->max_num_pages > 1): ?>
		<div class="pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $the_query->max_num_pages, $the_query); ?>
		</div><?php
	 endif;
	 wp_reset_postdata();
	else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
	endif; ?>