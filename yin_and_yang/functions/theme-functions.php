<?php 
	
/*-----------------------------------------------------------------------------------*/
/* Get Ajax Portfolio Item
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_eq_get_ajax_project', 'onioneye_get_ajax_post');
add_action('wp_ajax_nopriv_eq_get_ajax_project', 'onioneye_get_ajax_post');

function onioneye_get_ajax_post() {   
		
	$desired_width = 813;
	$desired_height = 613;
	$current_post_id = $_REQUEST['post_id'];
	$terms = get_the_terms($_REQUEST['post_id'] , 'portfolio_category', 'string');
	$num_of_terms = count($terms);
	$content_post = get_post($_REQUEST['post_id']);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]>', $content);
	$post = get_post($current_post_id); 
	
	// Metabox values
	$image_list = get_post_meta($current_post_id, 'onioneye_image_list', true);
	$client = get_post_meta($current_post_id, 'onioneye_client', true); 
	$project_url = get_post_meta($current_post_id, 'onioneye_item_url', true);
	$is_pub_date_displayed = get_post_meta($current_post_id, 'onioneye_publication_date', true); 
	$video_embed_code = get_post_meta($current_post_id, 'onioneye_embed_code', true); 
	
    $no_of_columns = 0; 
    
    if($is_pub_date_displayed) {
		$no_of_columns++;  
    }
	if($terms) {
		$no_of_columns++; 	
	}
	if($client) {
		$no_of_columns++;
	}
	if($project_url) {
		$no_of_columns++;
	}		
	
	ob_start();
?>
	
	<div class="single-portfolio-item group">
		
		<div class="mobile-nav-container">
			<h1 class="item-title"><?php echo get_the_title($current_post_id); ?></h1>
			
			<div class="mobile-post-nav group">
			
				<?php if($_REQUEST['prev_post_id'] && $_REQUEST['next_post_id']) { ?>			
				
					<a class="next-portfolio-post mobile-nav-btn" rel="next" href="#" data-post_id="<?php echo esc_attr($_REQUEST['next_post_id']); ?>">
						<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
					</a>
					<a class="prev-portfolio-post mobile-nav-btn" rel="prev" href="#" data-post_id="<?php echo esc_attr($_REQUEST['prev_post_id']); ?>">
						<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
					</a>
					
				<?php } else if ($_REQUEST['prev_post_id']) { ?>
					
					<div class="next-nav-placeholder mobile-nav-btn">
						<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
					</div>
					<a class="prev-portfolio-post mobile-nav-btn" href="#" data-post_id="<?php echo esc_attr($_REQUEST['prev_post_id']); ?>">
						<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
					</a>
		
				<?php } else if ($_REQUEST['next_post_id']) { ?>
		
					<a class="next-portfolio-post mobile-nav-btn" href="#" data-post_id="<?php echo esc_attr($_REQUEST['next_post_id']); ?>">
						<span><?php esc_html_e( 'Next post', 'onioneye' ); ?></span>
					</a>
					<div class="prev-nav-placeholder mobile-nav-btn">
						<span><?php esc_html_e( 'Prev post', 'onioneye' ); ?></span>
					</div>
			
				<?php } ?>
				
			</div><!-- /.mobile-post-nav -->
		</div><!-- /.mobile-nav-container -->
		
		<section class="item-content">
					
			<?php if(!empty($image_list)) { ?>
			
				<div class="metabox-media-files">
					
					<?php 						
						if(!empty($image_list) && count($image_list) === 1) {
							
							$portfolio_img_url = reset($image_list);
							$portfolio_img_id = key($image_list);
						
							$img_meta = wp_get_attachment_image_src($portfolio_img_id, 'full-size');
							$image_full_width = $img_meta[1];
							$image_full_height = $img_meta[2];
							$alt_attr = get_post_meta($portfolio_img_id, '_wp_attachment_image_alt', true);
							$img_caption = get_post($portfolio_img_id)->post_excerpt; 
							
							/* find the "desired height" of the current thumbnail, relative to the desired width */
							if($image_full_width && $image_full_height) { 
								$desired_height = floor($image_full_height * ($desired_width / $image_full_width));
							}
							
							$thumb = onioneye_get_attachment_id_from_src($portfolio_img_url);
							$image = onioneye_vt_resize($thumb, '', $desired_width, $desired_height, true);
									    
							if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { 
					?>
								<div style="max-width: <?php echo esc_attr($desired_width) . 'px'; ?>">
									<div class="single-img-height" style="height: 0; padding-bottom: <?php echo onioneye_get_loader_height($desired_width, $desired_height); ?>">
									
										<div class="single-img-container">
											
											<img class="single-img single-img-ajax" src="<?php echo esc_url($image[url]); ?>" width="<?php echo esc_attr($desired_width); ?>" 
												height="<?php echo esc_attr($desired_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
												
											<?php if($img_caption) { ?>
									  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
									  		<?php } ?>
										</div>
										
										<div class="single-img-loader"></div>
									
									</div>
								</div>
										              
					<?php 
							} else { 
					?>		    
								<div style="max-width: <?php echo esc_attr($image_full_width) . 'px'; ?>">
									<div class="single-img-height" style="height: 0; padding-bottom: <?php echo onioneye_get_loader_height($image_full_width, $image_full_height); ?>">
									
										<div class="single-img-container">
											
											<img class="single-img single-img-ajax" src="<?php echo esc_url($portfolio_img_url); ?>" width="<?php echo esc_attr($image_full_width); ?>" 
												height="<?php echo esc_attr($image_full_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
												
											<?php if($img_caption) { ?>
									  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
									  		<?php } ?>
										</div>
										
										<div class="single-img-loader"></div>
									
									</div>
								</div>
					<?php 
							} 
						}
						else if(!empty($image_list) && count($image_list) >= 1) {	
					?>
							
							<div class="oy-flex-container">
							
								<div class="oy-flexslider">
									
									<ul class="oy-slides">
									   				
										<?php foreach ($image_list as $portfolio_img_id => $portfolio_img_url) { 
																					  
											$img_meta = wp_get_attachment_image_src($portfolio_img_id, 'full-size');
											$image_full_width = $img_meta[1];
											$image_full_height = $img_meta[2];
											$alt_attr = get_post_meta($portfolio_img_id, '_wp_attachment_image_alt', true);
											$img_caption = get_post($portfolio_img_id)->post_excerpt; 
											
											/* find the "desired height" of the current thumbnail, relative to the desired width */
											if($image_full_width && $image_full_height) { 
												$desired_height = floor($image_full_height * ($desired_width / $image_full_width));
											}
											
											$thumb = onioneye_get_attachment_id_from_src($portfolio_img_url);
											$image = onioneye_vt_resize( $thumb, '', $desired_width, $desired_height, true );
									    
										    // If the original width of the thumbnail doesn't match the width of the slider, resize it; otherwise, display it in original size
											if( $image_full_width > $desired_width || $image_full_height > $desired_height ) { 
										
										?>
												<li>
													<img class="oy-slider-img" src="<?php echo esc_url($image[url]); ?>" width="<?php echo esc_attr($desired_width); ?>" 
														height="<?php echo esc_attr($desired_height); ?>" alt="<?php echo esc_attr($alt_attr); ?>" />
													
													<?php if($img_caption) { ?>
											  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
											  		<?php } ?>					
												</li>
												              
										<?php 
											} else { 
										?>
											
												<li>
													<img class="oy-slider-img" src="<?php echo esc_url($portfolio_img_url); ?>" width="<?php echo esc_attr($image_full_width); ?>" 
														height="<?php echo esc_attr($image_full_height); ?>"  alt="<?php echo esc_attr($alt_attr); ?>" />
													
													<?php if($img_caption) { ?>
											  			<p class="oy-flex-caption"><?php echo $img_caption; ?></p>
											  		<?php } ?>		
												</li>
					   
										<?php 
											} // end else
										} // end foreach
										?>												   							        							    
									    
									</ul><!-- /.oy-slides -->
									
									<div class="oy-flex-img-loader"></div>
								    
								</div><!-- /.oy-flexslider -->
							
							</div><!-- /.oy-flex-container -->
				
					<?php } // end else if ?>
					
				</div><!-- END .metabox-media-files -->
			<?php } ?>
				
			<?php if($video_embed_code) { ?>
				
				<div class="video-embed">
					<?php echo stripslashes(htmlspecialchars_decode($video_embed_code)); ?>			
				</div>
						
			<?php }	?>
				
			<?php if($content) { ?>
			
				<div class="item-description">  			
					<?php echo $content; ?>
				</div>
			
			<?php } ?>
			
		</section><!-- /.item-content -->
		
		<aside class="item-sidebar group">
			
			<ul class="post-nav group">
				
				<li><span class="close-post">&nbsp;</span></li>
			
			<?php if($_REQUEST['prev_post_id'] && $_REQUEST['next_post_id']) { ?>			
			
				<li><a class="next-portfolio-post" rel="next" href="#" data-post_id="<?php echo esc_attr($_REQUEST['next_post_id']); ?>">&nbsp;</a></li>
				<li><a class="prev-portfolio-post" rel="prev" href="#" data-post_id="<?php echo esc_attr($_REQUEST['prev_post_id']); ?>">&nbsp;</a></li>
				
			<?php } else if ($_REQUEST['prev_post_id']) { ?>
			
				<li><a class="prev-portfolio-post" href="#" data-post_id="<?php echo esc_attr($_REQUEST['prev_post_id']); ?>">&nbsp;</a></li>
	
			<?php } else if ($_REQUEST['next_post_id']) { ?>
	
				<li><a class="next-portfolio-post" href="#" data-post_id="<?php echo esc_attr($_REQUEST['next_post_id']); ?>">&nbsp;</a></li>
		
			<?php } ?>
				
			</ul><!-- /.post-nav -->
			
			<h1 class="item-title"><?php echo get_the_title($current_post_id); ?></h1>
			
			<div class="project-meta group <?php echo esc_attr('oy-' . $no_of_columns . '-cols'); ?>">	
				<?php if($terms) { ?>					
					
					<ul class="item-categories item-metadata group">
				    	<li><?php esc_html_e( 'Categories', 'onioneye' ); ?><span> &rarr;</span></li>
						
						<?php 
							$i = 0;
	
							foreach($terms as $term) {
		
								if($i + 1 == $num_of_terms) {
		    						echo '<li class="item-term">' . esc_html($term -> name) . '</li>';
		 						}
								else {
									echo '<li class="item-term">' . esc_html($term -> name) . '<span class="cat-comma">, </span></li>';
								}
									
								$i++;
							}
						?>
					</ul>
						
				<?php } ?>
				
				<?php if($is_pub_date_displayed) { ?>
					
					<ul class="item-date item-metadata">
					    <li><?php esc_html_e('Date', 'onioneye'); ?><span> &rarr;</span></li>
					    <li><?php echo mysql2date( __( 'F Y', 'onioneye' ), $post->post_date ); ?></li>
					</ul>
				
				<?php } ?>
				
				<?php if( $client ) { ?>
					
					<ul class="item-client item-metadata">
					    <li><?php esc_html_e('Client', 'onioneye'); ?><span> &rarr;</span></li>
					    <li><?php echo esc_html($client); ?></li>
					</ul>
					
				<?php } ?>
				
				<?php if( $project_url ) { ?>
					
					<ul class="item-url item-metadata">
					    <li><?php esc_html_e( 'Project URL', 'onioneye' ); ?><span> &rarr;</span></li>
					    <li><a href="<?php echo esc_url($project_url); ?>"><?php esc_html_e( 'Visit site', 'onioneye' ); ?></a></li>
					</ul>
					
				<?php } ?>
			</div><!-- /.project-meta -->
						
		</aside><!-- /.item-sidebar -->	
		
		<div class="portfolio-border">&nbsp;</div>
		
	</div><!-- /.single-portfolio-item -->

<?php

 	$result['html'] = ob_get_clean();

   	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      	$result = json_encode($result);
      	echo $result;
   	}
   	else {
      	header("Location: ".$_SERVER["HTTP_REFERER"]);
   	}

   	die();

}


/*-----------------------------------------------------------------------------------*/
/* Get the greatest common divisor for two given numbers 
/*-----------------------------------------------------------------------------------*/

function onioneye_get_gcd($a, $b) {
	return ($a % $b) ? onioneye_get_gcd($b, $a % $b) : $b;
}

/*-----------------------------------------------------------------------------------*/
/* Return the value for padding-bottom, which is going to determine the height 
/* of the loader, based on the aspect ratio of the image associated with the 
/* loader itself.
/*-----------------------------------------------------------------------------------*/

function onioneye_get_loader_height($width, $height) {
	$width = absint($width);
	$height = absint($height);
    $gcd = onioneye_get_gcd($width, $height);
    
    return ($height / $gcd) / ($width / $gcd) * 100 . '%'; 
}
	

/*-----------------------------------------------------------------------------------*/
/* Output the logo data
/*-----------------------------------------------------------------------------------*/

function onioneye_get_retina_image_data($image_src) {
	$image_data = wp_get_attachment_image_src(onioneye_get_attachment_id_from_src($image_src), 'full');
													
	// If the dimensions of the image are returned correctly, halve them for the retina version. 
	if($image_data[1] && $image_data[2]) { 
		$image_data[1] = round($image_data[1] / 2);
		$image_data[2] = round($image_data[2] / 2);
	}
	
	return $image_data;
}


/*-----------------------------------------------------------------------------------*/
/* Find out if the user filled in any of the social networking links in 
/* the theme options.
/*-----------------------------------------------------------------------------------*/

function onioneye_is_social_existent() {
	$facebook_url = get_theme_mod('oy_facebook', ''); 		
	$twitter_url = get_theme_mod('oy_twitter', ''); 		
    $googleplus_url = get_theme_mod('oy_googleplus', ''); 		
	$pinterest_url = get_theme_mod('oy_pinterest', ''); 		
	$instagram_url = get_theme_mod('oy_instagram', ''); 		
	$youtube_url = get_theme_mod('oy_youtube', ''); 		
	$vimeo_url = get_theme_mod('oy_vimeo', ''); 	
	$tumblr_url = get_theme_mod('oy_tumblr', ''); 
	$linkedin_url = get_theme_mod('oy_linkedin', ''); 
	$soundcloud_url = get_theme_mod('oy_soundcloud', ''); 
	$behance_url = get_theme_mod('oy_behance', ''); 
	$dribbble_url = get_theme_mod('oy_dribbble', '');
	
	return ($facebook_url || $twitter_url || $googleplus_url || $pinterest_url || $instagram_url || $youtube_url || $vimeo_url || $tumblr_url ||
	$linkedin_url || $soundcloud_url || $behance_url || $dribbble_url) ? 1 : 0;		
}


/*-----------------------------------------------------------------------------------*/
/* Get adjacent post ids based on menu_order, when the
/* single-portfolio.php is active.
/*-----------------------------------------------------------------------------------*/

function onioneye_get_next_and_prev_ids($current_post_id) {
    $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order' ); 
    $post_list = get_posts($args);
    $ids = array();
        
    foreach($post_list as $the_post) {
		$ids[] = $the_post->ID;
	}
		
	$this_index = array_search($current_post_id, $ids);
	$prev_id = $ids[$this_index - 1];
	$next_id = $ids[$this_index + 1];
		
	$prev_id = !empty($prev_id) ? $prev_id : 0;  
	$next_id = !empty($next_id) ? $next_id : 0;

	$post_ids = array($prev_id, $next_id);
		
	return $post_ids;
}


/*-----------------------------------------------------------------------------------*/
/* Get the id of the attachment by providing the source of the image. Needed for
 * finding the image's meta info, such as its width and height.
/*-----------------------------------------------------------------------------------*/

function onioneye_get_attachment_id_from_src( $image_src ) {
	
	global $wpdb;
		
	$id = $wpdb->get_var( $wpdb->prepare(
	  	"SELECT ID FROM {$wpdb->posts} WHERE guid = %s",
	    $image_src
	) );
	
	return $id;
	
}


/*-----------------------------------------------------------------------------------*/
/* Escapes all characters except the following: alphabetic, 
/* decimal digits, - _ . ! ~ * ' ( )
/*-----------------------------------------------------------------------------------*/

function onioneye_encode_uri_component($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}


/*-----------------------------------------------------------------------------------
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 -----------------------------------------------------------------------------------*/
 
function onioneye_vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {

	// this is an attachment, so we have the ID
	if ( $attach_id ) {
	
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		$file_path = get_attached_file( $attach_id );
	
	// this is not an attachment, let's use the image url
	} else if ( $img_url ) {
		
		$file_path = parse_url( $img_url );
		$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
		
		//$file_path = ltrim( $file_path['path'], '/' );
		//$file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
		
		$orig_size = getimagesize( $file_path );
		
		$image_src[0] = $img_url;
		$image_src[1] = $orig_size[0];
		$image_src[2] = $orig_size[1];
	
	} else {
		return False; 
	}
	
	$file_info = pathinfo( $file_path );
	$extension = '.'. $file_info['extension'];

	// the image path without the extension
	$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {

			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		// $new_img_path = image_resize( $file_path, $width, $height, $crop );
		$editor = wp_get_image_editor( $file_path );
		if ( is_wp_error( $editor ) )
		    return $editor;
		$editor->set_quality( 90 );
		$resized = $editor->resize( $width, $height, $crop );
		$dest_file = $editor->generate_filename( NULL, NULL );
		$saved = $editor->save( $dest_file );
		if ( is_wp_error( $saved ) )
		    return $saved;
		$new_img_path=$dest_file;

		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
		$vt_image = array (
			'url' => $new_img,
			'width' => $new_img_size[0],
			'height' => $new_img_size[1]
		);
		
		return $vt_image;
	}

	// default output - without resizing
	$vt_image = array (
		'url' => $image_src[0],
		'width' => $image_src[1],
		'height' => $image_src[2]
	);
	
	return $vt_image;
}
 
?>