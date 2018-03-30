<?php
	//PERFORMING GALLERY POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	if($GLOBALS['force_enable'] == true)
	  $page_layout = $GLOBALS['page_layout'];
	else
	  $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : $GLOBALS['page_layout'];
	$post_layout = !empty($meta_set['gallery-post-layout']) ? $meta_set['gallery-post-layout'] : 'one-column';
	$design_type = !empty($meta_set['gallery-post-design-type']) ? $meta_set['gallery-post-design-type'] : 'default';
	
	$li_class = "";
	$feature_image = "";
	
	//POST LAYOUT CHECK...
	if($post_layout == "one-half-column") {
		$li_class = "gallery dt-sc-one-half column";
		$feature_image = "gallery-twocol";
	}
	elseif($post_layout == "one-third-column") {
		$li_class = "gallery dt-sc-one-third column";
		$feature_image = "gallery-threecol";
	}
	elseif($post_layout == "one-fourth-column") {
		$li_class = "gallery dt-sc-one-fourth column";
		$feature_image = "gallery-fourcol";
	}
	
	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$li_class = $li_class." with-sidebar";
		$feature_image = $feature_image."-sidebar";
	}
	
	//POST DESIGN CHECK...
	if($design_type != "default") {
		$feature_image = "gallery-with-shape";
	}
	
	//POST VALUES....
	$limit = $meta_set['gallery-post-per-page'];
	$cats  = $meta_set['gallery-categories'];
	
	$cats = array_filter(array_unique($cats));
	
	if(empty($cats)) {
		$cats = get_categories('taxonomy=gallery_entries&hide_empty=1');
		$cats = get_terms( array('gallery_entries'), array('fields' => 'ids'));		
	}
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	//PERFORMING QUERY...	
	$args = array('post_type' => 'dt_galleries', 'paged' => $paged , 'posts_per_page' => $limit,
																				   'tax_query' => array( 
																						array( 
																								'taxonomy' => 'gallery_entries', 
																								'field' => 'id', 
																								'terms' => $cats
																						)));
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()): 
	
	 if(isset($meta_set['filter']) != ""): ?>
         <div class="sorting-container">
            <a data-filter="*" href="#" class="active-sort"><?php _e('All', 'iamd_text_domain'); ?></a>
            <?php
				foreach($cats as $term) {
					$myterm = get_term_by('id', $term, 'gallery_entries');
					?><a href="#" data-filter=".<?php echo strtolower($myterm->slug); ?>"><?php echo $myterm->name; ?></a><?php
				}?>
         </div><?php
	 endif; ?>
     
     <div class="gallery-container"><?php
	 	$template_uri = get_template_directory_uri();
		$template_skin = dt_theme_option('appearance','skin');

		while($wp_query->have_posts()): $wp_query->the_post(); 
			$terms = wp_get_post_terms($post->ID, 'gallery_entries', array("fields" => "slugs")); array_walk($terms, "arr_strfun"); ?>
			<div class="<?php echo $design_type." ".$li_class." ".strtolower(implode(" ", $terms)); ?>">
              <figure class="gallery-thumb <?php echo esc_attr($design_type); ?>"><?php
                if($design_type != 'default'): ?>
				    <img class="item-mask" alt="mask" src="<?php echo $template_uri.'/skins/'.$template_skin.'/images/'.$design_type; ?>.png" /><?php
				endif; 
				$fullimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
				$currenturl = $fullimg[0];
				$currenticon = "fa-search";
				$pmeta_set = get_post_meta($post->ID, '_gallery_settings', true);
				if( @array_key_exists('items_thumbnail', $pmeta_set) && ($pmeta_set ['items_name'] [0] == 'video' )) {
					$currenturl = $pmeta_set ['items'] [0];
					$currenticon = "fa-video-camera";
				}
				//GALLERY IMAGES...
				if(has_post_thumbnail()):
					$attr = array('title' => get_the_title(), 'alt' => get_the_title());
					the_post_thumbnail($feature_image, $attr);
				else: ?>
					<img src="http<?php dt_theme_ssl(true);?>://placehold.it/940.jpg&text=<?php the_title(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /><?php
				endif; ?>
				<div class="image-overlay">
					<a class="link" href="<?php the_permalink(); ?>"> <span class="fa fa-link"> </span> </a>                
					<a class="zoom" title="<?php the_title(); ?>" data-gal="prettyPhoto[gallery]" href="<?php echo esc_url($currenturl); ?>"><span class="fa <?php echo esc_attr($currenticon); ?>"> </span></a>
				</div>                        
              </figure>
              <div class="gallery-detail">
                <div class="gallery-title">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p><?php echo get_the_term_list($post->ID, 'gallery_entries', ' ', ', ', ' '); ?></p>
                </div>
                <?php if(dt_theme_is_plugin_active('roses-like-this/likethis.php') && $design_type == 'default'): ?>
                    <div class="views">
                        <span><i class="fa fa-heart"></i><br><?php printLikes($post->ID); ?></span>
                    </div>
                <?php endif; ?>    
              </div>
	        </div><?php
		endwhile; ?>
     </div>
     <div class="margin40"></div><?php
	 //Pagination...
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination-wrapper">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query($wp_query);
	 else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
	endif; ?>