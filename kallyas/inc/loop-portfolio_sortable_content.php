<?php if(! defined('ABSPATH')){ return; }
global $zn_config;

	// GET THE ASSIGNED CATEGORIES
	$css_classes     = '';
	$item_categories = get_the_terms( get_the_ID(), 'project_category' );

	if ( is_object( $item_categories ) || is_array( $item_categories ) ) {
		foreach ( $item_categories as $cat ) {
			$css_classes .= $cat->slug . '_sort ';
		}
	}

	$img_width =  isset( $zn_config['ptf_sort_img_width'] ) && !empty($zn_config['ptf_sort_img_width']) ? $zn_config['ptf_sort_img_width'] : zget_option( 'ptf_sort_img_width', 'portfolio_options', false, '' );

	// $zn_link_portfolio = zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' );
	$zn_link_portfolio = isset( $zn_config['zn_link_portfolio'] ) && !empty($zn_config['zn_link_portfolio']) ? $zn_config['zn_link_portfolio'] : zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' );

	$sp_link = get_post_meta(get_the_ID(), 'zn_sp_link', true);

	// Force External Link
	$zn_sp_linkto_external = get_post_meta( get_the_ID(), 'zn_sp_linkto_external', true );

	$title_link_start = '';
	$title_link_end = '';
	if ( $zn_link_portfolio != 'no_all' ) {
		$title_link_start = '<a href="'. get_permalink() .'" class="kl-ptfsortable-item-title-link" title="'.get_the_title().'">';
		$title_link_end = '</a>';
	}

	// Check if force to link to external link
	if($zn_sp_linkto_external == 'yes'){
		$sp_link_ext = zn_extract_link( $sp_link, 'portfolio-item-link hoverLink', ' title="'.get_the_title().'" ' );
		if (!empty ($sp_link_ext['start'])) {
			$title_link_start = $sp_link_ext['start'];
			$title_link_end = $sp_link_ext['end'];
		}
	}
?>

<li class="item kl-ptfsortable-item kl-has-overlay portfolio-item--overlay <?php echo $css_classes; ?> even" data-date="<?php the_time( 'U' ); ?>" <?php echo WpkPageHelper::zn_schema_markup('creative_work'); ?>>

	<div class="inner-item kl-ptfsortable-item-inner">
		<div class="img-intro kl-ptfsortable-imgintro portfolio-item-overlay-imgintro">
		<?php
			$port_media = get_post_meta( get_the_ID(), 'zn_port_media', true );
			if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

				$size      = zn_get_size( 'portfolio_sortable' );
				$has_image = false;
				// Modified portfolio display
				// Check to see if we have images
				if ( $portfolio_image = $port_media[0]['port_media_image_comb'] ) {

					if ( is_array( $portfolio_image ) ) {

						if ( $saved_image = $portfolio_image['image'] ) {
							if ( ! empty( $portfolio_image['alt'] ) ) {
								$saved_alt = $portfolio_image['alt'];
							}
							else {
								$saved_alt = '';
							}

							if ( ! empty( $portfolio_image['title'] ) ) {
								$saved_title = 'title="' . $portfolio_image['title'] . '"';
							}
							else {
								$saved_title = '';
							}
							$has_image = true;
						}
					}
					else {
						$saved_image = $portfolio_image;
						$has_image   = true;
						$saved_alt   = ZngetImageAltFromUrl( $saved_image );
						$saved_title = ZngetImageTitleFromUrl( $saved_image, true );
					}

					$image_attributes = '';
					if ( $has_image ) {
						$img_width = (int)$img_width;
						if(!empty( $img_width )){
							$image = vt_resize( '', $saved_image, $img_width, '', true );
							$image_attributes = 'src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '"';
						} else {
							$image_attributes = 'src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true);
						}
					}
				}

				// Check to see if we have video
				if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
					$portfolio_media = str_replace( '', '&amp;', $portfolio_media );
				}

				// Display the media
				if ( ! empty( $saved_image ) && $portfolio_media ) {
					echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="portfolio-item-link hoverLink"></a>';
					echo '<img class="kl-ptfsortable-img" '.$image_attributes.' alt="' . $saved_alt . '" ' . $saved_title . ' />';
					echo '<div class="portfolio-item-overlay">';
					echo '<div class="portfolio-item-overlay-inner">';
					echo '<span class="portfolio-item-overlay-icon glyphicon glyphicon-play"></span>';
					echo '</div>';
					echo '</div>';
				}
				elseif ( ! empty( $saved_image ) ) {

					$overlay = '
					<div class="portfolio-item-overlay">
						<div class="portfolio-item-overlay-inner">
							<span class="portfolio-item-overlay-icon glyphicon glyphicon-picture"></span>
						</div>
					</div>';

					if ( $zn_link_portfolio == 'yes' ) {
						$ptf_item_link = '<a href="' . get_permalink() . '" title="'.get_the_title().'" class="portfolio-item-link hoverLink"></a>';
					}
					else {
						$ptf_item_link = '<a href="' . $saved_image . '" title="'.get_the_title().'" data-type="image" data-lightbox="image" class="portfolio-item-link hoverLink"></a>';
					}

					// Check if force to link to external link
					if($zn_sp_linkto_external == 'yes'){
						$sp_link_ext = zn_extract_link( $sp_link, 'portfolio-item-link hoverLink', ' title="'.get_the_title().'" ' );
						if (!empty ($sp_link_ext['start'])) {
							$ptf_item_link = $sp_link_ext['start'] . $sp_link_ext['end'];
						}
					}

					echo $ptf_item_link;

					echo '<img class="kl-ptfsortable-img" '.$image_attributes.' alt="' . $saved_alt . '" ' . $saved_title . ' />';
					echo $overlay;
				}
				elseif ( $portfolio_media ) {
					echo get_video_from_link( $portfolio_media, '', $size['width'], $size['height'] );
				}
			}
		?>
		</div>

		<?php

			$ptf_show_title = isset($zn_config['ptf_show_title']) && !empty($zn_config['ptf_show_title']) ? $zn_config['ptf_show_title'] : 'yes';
			if( $ptf_show_title == 'yes' ){
		?>
		<h4 class="title kl-ptfsortable-item-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>>
			<?php echo $title_link_start; ?>
				<span class="name"><?php the_title(); ?></span>
			<?php echo $title_link_end; ?>
		</h4>
		<?php } ?>

		<?php
			$excerpt = get_the_excerpt();
			$excerpt = strip_shortcodes( $excerpt );
			$excerpt = strip_tags( $excerpt );
			$the_str = mb_substr( $excerpt, 0, 116 );

			$ptf_show_desc = isset($zn_config['ptf_show_desc']) && !empty($zn_config['ptf_show_desc']) ? $zn_config['ptf_show_desc'] : 'yes';

			if( $ptf_show_desc == 'yes' ){
				if(! empty($the_str) ){
					echo '<div class="moduleDesc kl-ptfsortable-item-desc">'.$the_str . '...' . '</div>';
				}
			} ?>
		<div class="clear"></div>
	</div>
	<!-- end ITEM (.inner-item) -->
</li>
