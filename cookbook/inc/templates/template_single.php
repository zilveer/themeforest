<?php 

	// GET OPTIONS
	$canon_options_post = get_option('canon_options_post'); 

	//GET CMB DATA
	$cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);
	$cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
	$cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
	$cmb_hide_feat_img = get_post_meta( $post->ID, 'cmb_hide_feat_img', true);
	
    $cmb_post_show_info = get_post_meta($post->ID, 'cmb_post_show_info', true);
	$cmb_post_show_ratings = get_post_meta( $post->ID, 'cmb_post_show_ratings', true);
	$cmb_post_show_author = get_post_meta( $post->ID, 'cmb_post_show_author', true);
	$cmb_post_show_related = get_post_meta( $post->ID, 'cmb_post_show_related', true);
	$cmb_post_show_tags = get_post_meta( $post->ID, 'cmb_post_show_tags', true);
	$cmb_post_show_post_slider = get_post_meta( $post->ID, 'cmb_post_show_post_slider', true);

    $has_feature = mb_has_feature($post->ID);

	// DEFAULTS
	if (empty($cmb_single_style)) { $cmb_single_style = "standard_sidebar"; };
	if (empty($cmb_post_show_tags)) { $cmb_post_show_tags = "checked"; }

	// HANDLE POST SLIDER
	$consolidated_slider_array = array();
	if ($cmb_post_show_post_slider == "checked") {
		$cmb_post_slider_source = get_post_meta( $post->ID, 'cmb_post_slider_source', true);
		$post_slider_array = mb_strip_wp_galleries_to_array($cmb_post_slider_source);
		$consolidated_slider_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);

	}

?>

	<!-- BEGIN LOOP -->
	<?php while ( have_posts() ) : the_post(); ?>

    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">
    			
    			<!-- Main Column -->
    			<div class="<?php if ($cmb_single_style == 'standard') { echo "col-1-1"; } else { echo "col-3-4"; } ?>">


					<!-- FEATURED IMAGE -->
					<?php
						
						if ($cmb_post_show_post_slider == "checked" || $cmb_hide_feat_img != "checked") {

							if ($cmb_post_show_post_slider != "checked") {
								
								if ($has_feature) {

                                    // FEATURED IMAGE
									if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
										echo "<div class='featured_media'>";
										output_cmb_media_link($cmb_media_link);
										echo "</div>";
									} else {
										$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
										$post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
										$img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
										$img_post = get_post(get_post_thumbnail_id(get_the_ID()));

										if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {

											echo "<div class='featured_media'>";
											echo '<div class="mosaic-block circle">';
											printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
											printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
											echo "</div>";
											echo '</div>';
										
										} elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

											echo "<div class='featured-media'>";
											echo '<div class="mosaic-block circle">';
											printf('<a href="%s" class="mosaic-overlay" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
											printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
											echo "</div>";
											echo '</div>';
										}
									}

								}
									
							} else {
									
								echo '<div class="flexslider flexslider-default featured-media"><ul class="slides">';
								for ($i = 0; $i < count($consolidated_slider_array); $i++) {  

									$post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
									$img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
									$img_post = get_post($consolidated_slider_array[$i]['id']);

									printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
								}
								echo '</ul></div>';
								
							}

						}

					?>


					<!-- POST -->
					<div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

						
						<!-- META -->
						<?php 

							if ($canon_options_post['show_post_meta'] == 'checked') {

								// CATEGORIES
								$cat_string = mb_get_cat_string(get_the_ID(), " | ");

								// DATE
								$archive_year  = get_the_time('Y'); 
								$archive_month = get_the_time('m'); 
								$archive_day   = get_the_time('d'); 							

								?>
								<div class="clearfix single-meta">

			    					<h6 class="meta right"><a class="date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></a></h6>
									<h6 class="feat-1 meta left"><?php echo wp_kses_post($cat_string); ?></h6>
								</div>	

								<?php	
							}

						?>


						<!-- TITLE -->
						<h1 class="title"><?php the_title(); ?></h1>
						
						 <!-- THE CONTENT -->
						<div class="single-content"><?php the_content(); ?></div>
                        <?php wp_link_pages( 'before=<p class="link-pages">'. __('Pages','loc_canon') .': ' ); ?>
						
						
    				</div>

 					<!-- INFO BOX -->
					<?php if ($cmb_post_show_info == "checked") { get_template_part('/inc/templates/components/template_post_component_info'); } ?>
    				
 					<!-- RATINGS -->
					<?php if ($cmb_post_show_ratings == "checked") { get_template_part('/inc/templates/components/template_post_component_ratings'); } ?>
    				
					<!-- TAGS -->
					<?php if ($cmb_post_show_tags == "checked") { get_template_part('/inc/templates/components/template_post_component_tags'); } ?>
   				
                    <!-- POST PAGINATION -->    
                    <?php if ($canon_options_post['show_post_nav'] == "checked") get_template_part('inc/templates/components/template_post_pagination'); ?>

					<!-- ABOUT THE AUTHOR -->
					<?php if ($cmb_post_show_author == "checked") { get_template_part('/inc/templates/components/template_post_component_author'); } ?>

                    <!-- RELATED POSTS -->
					<?php if ($cmb_post_show_related == "checked") { get_template_part('/inc/templates/components/template_post_component_related'); } ?>
    				
    				
					<!-- COMMENTS -->
                    <div class="comments-container"> 
                    	<?php if ($canon_options_post['show_comments'] == "checked") { comments_template( '', true ); } ?>
					</div>
    				
    				
    			
    			<!-- End Main Column -->	
    			</div>
    			
    			
				<!-- SIDEBAR -->
				<?php if ($cmb_single_style == 'standard_sidebar') { get_sidebar(); } ?>

    			
    		</div>
    		<!-- end wrapper -->
    	</div>
    	<!-- end outter-wrapper -->


		
	<?php endwhile; ?>
	<!-- END LOOP -->
