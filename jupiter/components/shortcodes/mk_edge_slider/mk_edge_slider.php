<?php

$has_posts = wp_count_posts('edge')->publish;
if( !$has_posts ) return;


$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = uniqid();

$button2_txt_color = $button1_txt_color = $outline1_hover_color = $outline2_hover_color = $button2_bg_color = $button1_bg_color = $outline2_active_color = $video_color_mask_css = $outline1_active_color = $pagination_class = $content_opacity = $overlay_opacity_ie = $header_skin = '';

global $post, $mk_options;

$count = !empty($slides) ? count(explode(',',$slides)) : 10;

$query = mk_wp_query(array(
    'post_type' => 'edge',
    'count' => $count,
    'posts' => $slides,
    'orderby' => $orderby,
    'order' => $order,
));

$r = $query['wp_query'];

if ( !empty($pagination) && $pagination != 'none') {
	$pagination_class = 'true';
}

// Convert to bool
$parallax = $parallax == 'true' ? true : false;
$full_height = $full_height == 'true' ? true : false;

?>

<div class="mk-edge-wrapper <?php echo $el_class; ?> js-el"
	style="min-height: <?php echo $height .'px' ?>;"
	<?php if( $full_height ) echo 'data-mk-component="FullHeight"' ?>
>
	<div class="clipper">
		<div id="mk-edge-slider-<?php echo $id ?>" class="mk-slider mk-edge-slider   js-el" 
			style="background-color: <?php echo $swiper_bg ?>;"
			data-animation="<?php echo $animation_effect ?>"
			data-mk-component="EdgeSlider"
			data-edgeSlider-config='{
				"effect" : "<?php echo $animation_effect ?>",
				"displayTime" : "<?php echo $slideshow_speed ?>",
				"transitionTime" : "<?php echo $animation_speed ?>",
				"nav" : ".mk-edge-nav-<?php echo $id ?>",
				"paginationEl" : ".swiper-pagination-<?php echo $id ?>",
				"firstEl" : <?php echo $first_el ?> }'

			layout-skipArrow="<?php echo $skip_arrow ?>"
			layout-pagination="<?php echo $pagination_class ?>"
		>

			<div class="mk-slider-holder   js-el"
				<?php if( $parallax ) { ?>
					data-mk-component="Parallax"
					data-parallax-config='{"speed" : 0.7 }'
				<?php } ?>
			>

				<div class="mk-slider-slides">
				<?php 
					while ( $r->have_posts() ):
						$r->the_post();
						include( $path . '/vars_loop.php' );
				?>

					<?php 
						$slide_class = array('');
						$slide_class[] = $caption_align;
						$slide_class[] = mk_get_bg_cover_class($cover_bg);
					?>
					<div class="mk-slider-slide <?php echo implode(' ', $slide_class); ?>" data-header-skin="<?php echo $header_skin; ?>">

						<?php echo mk_get_shortcode_view('mk_edge_slider', 'components/gradient-layer', true, $gradient_layer_atts); ?>

						<?php if( $video_pattern == 'true' ) { ?>
							<div class="mk-video-mask" style="background-image: url('<?php echo THEME_IMAGES; ?>/video-mask.png')"></div>
						<?php } ?>

						<?php if( !empty( $video_overlay ) ) { ?>
							<div class="mk-video-color-mask" style="
								background-color: <?php echo $video_overlay ?>;
								opacity: <?php echo $overlay_opacity ?>;
							"></div>
						<?php } ?>


						<?php if( $type == 'video' ) { ?>

							<?php if( !empty($video_preview) ) { ?>
								<div style="background-image:url(<?php echo $video_preview ?>);" class="mk-video-section-touch"></div>
							<?php } ?>

							<div class="mk-section-video mk-edge-slider__video mk-center-video">
								<video poster="<?php echo $video_preview ?>" muted="muted" preload="auto" loop="true" autoplay="true">

							

									<?php if( !empty( $mp4 ) ) { ?>
										<!-- MP4 must be first for iPad! -->
										<source type="video/mp4" src="<?php echo $mp4 ?>" />
									<?php } ?>

									<?php if( !empty( $webm ) ) { ?>
										<source type="video/webm" src="<?php echo $webm ?>" />
									<?php } ?>

									<?php if( !empty( $ogv ) ) { ?>
										<source type="video/ogg" src="<?php echo $ogv ?>" />
									<?php } ?>

								</video>
							</div>

						<?php } else { 
							$bg_image_css = 'style="'; 
							$bg_image_css .= !empty($slide_bg_color) ? 'background-color:'. $slide_bg_color .'; ' : '';
							$bg_image_css .= '"'; 
							$bg_image_set = (!empty($slide_image) || !empty($slide_image_portrait)) ? Mk_Image_Resize::get_bg_res_set($slide_image, $slide_image_portrait) : '';
						?>
							<div class="mk-section-image <?php echo $animation_effect ?>"  <?php echo $bg_image_css .' '. $bg_image_set ?>></div>
						<?php } ?>




						<div class="slider-content">
							<div class="mk-grid">

								<?php $content_class = 'edge-'.$animation.' caption-'.$caption_skin; ?>
								<div class="edge-slide-content <?php echo $content_class ?>" style="width: <?php echo $content_width ?>%">

									<?php if( !empty( $title ) || !empty( $description ) ) { ?>
										<div class="edge-title-area">

											<?php if( !empty( $title ) ) { 
												$title_style = $title_size . $title_weight . $caption_custom_color . $title_letter_spacing; ?>
											 	<div class="edge-title" style="<?php echo $title_style ?>">
											 		<?php echo $title ?>
											 	</div>
											 <?php } ?>

											<?php if( !empty( $description ) ) { ?>
												<div class="edge-desc" style="<?php echo $caption_custom_color ?>">
													<?php echo $description ?>
												</div>
											<?php } ?>
										</div>
									<?php } ?>

									<?php if( !empty( $btn_1_txt ) || !empty( $btn_2_txt ) ) { ?>
										<div class="edge-buttons">
											<?php
												if( !empty( $btn_1_txt ) ) { 
													echo do_shortcode( '[mk_button '.implode(' ', $btn1_atts).']'.$btn_1_txt.'[/mk_button]' );
												}
												if( !empty( $btn_2_txt ) ) {
													echo do_shortcode( '[mk_button '.implode(' ', $btn2_atts).']'.$btn_2_txt.'[/mk_button]' );
												}
											?>
										</div>
									<?php } ?>

									<?php 
										if(preg_match('/vc_row fullwidth="true"/', get_the_content()) || preg_match('/mk_page_section/', get_the_content())) {
										    $content = do_shortcode('[mk_message_box 
										    				type="warning-message"]
										    					Page Section or Fullwidth Rows are not allowed in Edge Slide. Remove Page Sections and disable fullwidth option of rows.
										    				[/mk_message_box]');
										} else {
										    $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
										} 
										if( !empty( $content ) ) { 
									?>
										<div class="mk-edge-custom-content">
											<?php echo $content ?>
										</div>
									<?php } ?>

								</div><!-- edge-slide-content-->
							</div><!-- mk-grid-->
						</div><!-- slider-content-->
					</div><!-- mk-slider-slide-->

				<?php
					endwhile;
					wp_reset_query();
				?>
				</div> <!-- mk-slider-slides -->


				<?php if( $skip_arrow == 'true') { ?>
					<div class="edge-skip-slider mk-skip-to-next" data-skin="<?php echo $header_skin ?>">
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-bottom', 16); ?>
					</div>
				<?php } ?>


				<?php $direction_nav = ($direction_nav == 'true') ? 'roundslide' : $direction_nav;
					if( !empty($direction_nav) && $direction_nav != 'none') { ?>

					<span class="mk-edge-nav mk-edge-nav-<?php echo $id ?> nav-<?php echo $direction_nav ?>">
						<a class="mk-edge-prev" data-direction="prev" data-skin="<?php echo $header_skin ?>">
							<span class="mk-edge-icon-wrap"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-left', 16); ?></span>
							<div class="mk-edge-nav">
				    			<span class="edge-nav-bg"></span>
				    			<span class="prev-item-caption nav-item-caption"></span>
				    		</div>
						</a>
					</span>

					<span class="mk-edge-nav mk-edge-nav-<?php echo $id ?> nav-<?php echo $direction_nav ?>">
						<a class="mk-edge-next" data-direction="next" data-skin="<?php echo $header_skin ?>">
							<span class="mk-edge-icon-wrap"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-right', 16); ?></span>
							<div class="mk-edge-nav">
				    			<span class="edge-nav-bg"></span>
				    			<span class="next-item-caption nav-item-caption"></span>
				    		</div>
						</a>
					</span>
				<?php } ?>


				<?php if( !empty($pagination) && $pagination != 'none' ) { 
					$pagination_class = 'pagination-'.$pagination; ?>
				    <div class="swiper-pagination swiper-pagination-<?php echo $id ?> <?php echo $pagination_class ?>" data-skin="<?php echo $header_skin ?>"></div>
				<?php } ?>


			</div> <!-- mk-slider-holder -->
		</div> <!-- mk-slider -->
	</div> <!-- clipper -->

	<div class="mk-section-preloader js-el" data-mk-component="Preloader">
		<div class="mk-section-preloader__icon"></div>
	</div>

</div> <!-- fixed-parent -->