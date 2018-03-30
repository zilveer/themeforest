<?php
//get global variables
global $wp_query;
global $qode_options;
global $wpdb;

//init variables
$id = $wp_query->get_queried_object_id();

if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	$content_style = get_post_meta($id, "qode_content-top-padding", true);
}else{
	$content_style = "";
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

$portfolio_images  = get_post_meta(get_the_ID(), "qode_portfolio_images", true);


//sort portfolio images by user defined input
if (is_array($portfolio_images)){
	usort($portfolio_images, "comparePortfolioImages");
}
?>


<div class="full_width" <?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
	<div class="full_width_inner" <?php if($content_style != "") { echo " style='padding-top:". $content_style ."px'";} ?>>
		<div class="portfolio_single portfolio_fullscreen_slider">
			<div class="fullscreen-slider">
				<div class="qodef-portfolio-slider-content">
					<span class="qodef-control qodef-close icon_minus-06"></span>
					<span class="qodef-control qodef-open icon_plus"></span>
					<div class="qodef-description">
						<div class="qodef-table">
							<div class="qodef-table-cell">
								<h3><?php the_title(); ?></h3>
								<div class="info portfolio_single_custom_date">
									<p class="info_date"><?php the_time(get_option('date_format')); ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="qodef-portfolio-slider-content-info">
						<div class="qodef-hidden-info">
							<div class="qodef-portfolio-title">
								<h3><?php the_title(); ?></h3>
							</div>
							<div class="qodef-portfolio-horizontal-holder">
								<div class="qodef-portfolio-info-holder">
									<?php

									//get portfolio custom fields section
									get_template_part('templates/portfolio/parts/portfolio-custom-fields');

									//get portfolio date section
									get_template_part('templates/portfolio/parts/portfolio-date');

									//get portfolio categories section
									get_template_part('templates/portfolio/parts/portfolio-categories');

									//get portfolio tags section
									get_template_part('templates/portfolio/parts/portfolio-tags');
									?>
								</div>
							</div>
							<div class="qodef-portfolio-content-holder">
								<?php
								get_template_part('templates/portfolio/parts/portfolio-content');
								//get portfolio share section
								get_template_part('templates/portfolio/parts/portfolio-social');
								?>
							</div>
						</div>
					</div>

				</div>
				<div class="qodef-full-screen-slider-holder">
					<div class="qodef-portfolio-full-screen-slider">
						<?php
						$portfolio_m_images = get_post_meta(get_the_ID(), "qode_portfolio-image-gallery", true);
						if ($portfolio_m_images){
							$portfolio_image_gallery_array=explode(',',$portfolio_m_images);
							foreach($portfolio_image_gallery_array as $gimg_id){
								$title = get_the_title($gimg_id);
								$alt = get_post_meta($gimg_id, '_wp_attachment_image_alt', true);
								$image_src = wp_get_attachment_image_src( $gimg_id, 'blog_image_in_grid' );
								if (is_array($image_src)) $image_src = $image_src[0];
								?>
									<span class="qodef-portfolio-slide-image" style="background-image:url('<?php echo esc_url($image_src); ?>');"></span>
								<?php
							}
						}

						//are portfolio images set?
						if (is_array($portfolio_images) && count($portfolio_images)){
							foreach($portfolio_images as $portfolio_image){
								 if($portfolio_image['portfolioimg'] != ""){
									 list($id, $title, $alt) = qode_get_portfolio_image_meta($portfolio_image['portfolioimg']); ?>
										<span class="qodef-portfolio-slide-image" style="background-image:url('<?php echo esc_url($portfolio_image['portfolioimg']); ?>');"></span>
									<?php
								 }
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="container" <?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
				<div class="container_inner">
					<?php
						get_template_part('templates/portfolio/parts/portfolio-navigation');
						get_template_part('templates/portfolio/parts/portfolio-comments');
					?>
				</div>
			</div>
		</div>
	</div>
</div>





