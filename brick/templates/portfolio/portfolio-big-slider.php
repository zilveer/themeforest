<?php
//get global variables
global $wp_query;
global $qode_options;
global $wpdb;

//init variables
$portfolio_images 			= get_post_meta(get_the_ID(), "qode_portfolio_images", true);
$lightbox_single_project 	= 'no';
$portfolio_title_tag            = 'h3';
$portfolio_title_style          = '';


//is lightbox turned on for single project?
if (isset($qode_options['lightbox_single_project'])) {
	$lightbox_single_project = $qode_options['lightbox_single_project'];
}

//set title tag
if (isset($qode_options['portfolio_title_tag'])) {
    $portfolio_title_tag = $qode_options['portfolio_title_tag'];
}

//set style for title
if ((isset($qode_options['portfolio_title_margin_bottom']) && $qode_options['portfolio_title_margin_bottom'] != '')
    || (isset($qode_options['portfolio_title_color']) && !empty($qode_options['portfolio_title_color']))){

    if (isset($qode_options['portfolio_title_margin_bottom']) && $qode_options['portfolio_title_margin_bottom'] != '') {
        $portfolio_title_style .= 'margin-bottom:'.esc_attr($qode_options['portfolio_title_margin_bottom']).'px;';
    }

    if (isset($qode_options['portfolio_title_color']) && !empty($qode_options['portfolio_title_color'])) {
        $portfolio_title_style .= 'color:'.esc_attr($qode_options['portfolio_title_color']).';';
    }

}

//sort portfolio images by user defined input
if (is_array($portfolio_images)){
	usort($portfolio_images, "qodeComparePortfolioImages");
}
?>

<div class="flexslider">
	<ul class="slides">
		<?php
        $portfolio_m_images = get_post_meta(get_the_ID(), "qode_portfolio-image-gallery", true);
        if ($portfolio_m_images){
            $portfolio_image_gallery_array=explode(',',$portfolio_m_images);
            foreach($portfolio_image_gallery_array as $gimg_id){
                $title = get_the_title($gimg_id);
                $alt = get_post_meta($gimg_id, '_wp_attachment_image_alt', true);
                $image_src = wp_get_attachment_image_src( $gimg_id, 'full' );
                if (is_array($image_src)) $image_src = $image_src[0];
                ?>
                <li class="slide">
                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($alt); ?>" />
                </li>
            <?php
            }
        }

        if (is_array($portfolio_images) && count($portfolio_images)){
			foreach($portfolio_images as $portfolio_image){
				?>

				<?php if($portfolio_image['portfolioimg'] != ""){ ?>
					<?php

					list($id, $title, $alt) = qode_get_portfolio_image_meta($portfolio_image['portfolioimg']);

					?>
					<li class="slide">
						<img src="<?php echo esc_url($portfolio_image['portfolioimg']); ?>" alt="<?php echo esc_attr($alt); ?>" />
					</li>
				<?php }else{ ?>

					<?php
					$portfolio_video_type = "";
					if (isset($portfolio_image['portfoliovideotype'])) $portfolio_video_type = $portfolio_image['portfoliovideotype'];
					switch ($portfolio_video_type){
						case "youtube": ?>
							<li class="slide">
								<iframe width="100%" src="http://www.youtube.com/embed/<?php echo esc_attr($portfolio_image['portfoliovideoid']);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
							</li>
							<?php	break;
						case "vimeo": ?>
							<li class="slide">
								<iframe src="http://player.vimeo.com/video/<?php echo esc_attr($portfolio_image['portfoliovideoid']);  ?>?title=0&amp;byline=0&amp;portrait=0" width="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
							</li>
							<?php break;
						case "self": ?>
							<div class="video">
								<div class="mobile-video-image" style="background-image: url(<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>);"></div>
								<div class="video-wrap"  >
									<video class="video" poster="<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>" preload="auto">
										<?php if(!empty($portfolio_image['portfoliovideowebm'])) { ?> <source type="video/webm" src="<?php echo esc_url($portfolio_image['portfoliovideowebm']); ?>"> <?php } ?>
										<?php if(!empty($portfolio_image['portfoliovideomp4'])) { ?> <source type="video/mp4" src="<?php echo esc_url($portfolio_image['portfoliovideomp4']); ?>"> <?php } ?>
										<?php if(!empty($portfolio_image['portfoliovideoogv'])) { ?> <source type="video/ogg" src="<?php echo esc_url($portfolio_image['portfoliovideoogv']); ?>"> <?php } ?>
										<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
											<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>" />
											<param name="flashvars" value="controls=true&file=<?php echo esc_url($portfolio_image['portfoliovideomp4']); ?>" />
											<img src="<?php echo esc_url($portfolio_image['portfoliovideoimage']); ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
										</object>
									</video>
								</div></div>
						<?php break;
					}
				}
			}
		}
		?>
	</ul>
</div>
<div class="two_columns_75_25 clearfix portfolio_container">
	<div class="column1">
		<div class="column_inner">
			<div class="portfolio_single_text_holder">
				<<?php echo esc_attr($portfolio_title_tag); ?> class="portfolio_single_text_title" <?php qode_inline_style($portfolio_title_style); ?>><span><?php the_title(); ?></span></<?php echo esc_attr($portfolio_title_tag); ?>>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="column2">
		<div class="column_inner">
			<div class="portfolio_detail">
				<?php
					//get portfolio custom fields section
					get_template_part('templates/portfolio/parts/portfolio-custom-fields');

					//get portfolio date section
					get_template_part('templates/portfolio/parts/portfolio-date');

					//get portfolio categories section
					get_template_part('templates/portfolio/parts/portfolio-categories');

					//get portfolio tags section
					get_template_part('templates/portfolio/parts/portfolio-tags');

					//get portfolio share section
					get_template_part('templates/portfolio/parts/portfolio-social');
				?>
			</div>
		</div>
	</div>
</div>