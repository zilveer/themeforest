<?php if(! defined('ABSPATH')){ return; }
/**
 * Displays the layout for the post type PORTFOLIO, inside page.php
 * @internal
 * @see page-content-template.inc.php
 */
global $zn_config;

$affix = '';
$zn_sp_show_affix = get_post_meta( get_the_ID(), 'zn_sp_show_affix', true );

if(isset($zn_sp_show_affix) && $zn_sp_show_affix == 'yes') {
	$affix = 'affixcontent';
}

// Check if PB Element has style selected, if not use Portfolio style option. If no blog style option, use Global site skin.
$portfolio_scheme_global = zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) != '' ? zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
$portfolio_scheme = isset($zn_config['portfolio_scheme']) && $zn_config['portfolio_scheme'] != '' ? $zn_config['portfolio_scheme'] : $portfolio_scheme_global;

/**
 * Get the item media
 */
$images_width = zget_option( 'portfolio_item_img_width', 'portfolio_options', false, 700);

$port_media = get_post_meta( get_the_ID(), 'zn_port_media', true );
if ( ! empty ( $port_media ) && is_array( $port_media ) ) {

	$all_media = count( $port_media );
	$has_image = false;
	$saved_image = '';

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

		if ( $has_image ) {
			$image = vt_resize( '', $saved_image, $images_width, '', true );
		}
	}

	// Check to see if we have video
	if ( $portfolio_media = $port_media[0]['port_media_video_comb'] ) {
	}

}


?>
<div class="row hg-portfolio-item portfolio-item--<?php echo $portfolio_scheme; ?>" <?php echo WpkPageHelper::zn_schema_markup('creative_work'); ?>>

	<div class="col-sm-12 col-md-5">
		<div class="portfolio-item-content <?php echo $affix; ?>" >
			<?php

			// TITLE CHECK
			$title_show = get_post_meta( get_the_ID(), 'zn_page_title_show', true );
			if ( $title_show == 'yes' ) {
				echo '<h1 class="page-title portfolio-item-title" '.WpkPageHelper::zn_schema_markup('title').'>' . get_the_title() . '</h1>';
			}
			?>

			<?php if ( $post->post_content !== '' ) { ?>
			<div class="portfolio-item-desc">

				<?php
					$style = zget_option( 'portfolio_single_style', 'portfolio_options', false, false ) === 'full_desc';
				?>

				<div class="portfolio-item-desc-inner <?php if( ! $style ) { echo 'portfolio-item-desc-inner-compacted'; } ?>" data-collapse-at="150">
					<?php
					// The content
					the_content( '' );
					?>
				</div>
				<?php if( ! $style ) : ?>
					<a href="#" class="portfolio-item-more-toggle js-toggle-class" data-target=".portfolio-item-desc" data-target-class="is-opened" data-more-text="<?php echo esc_attr( __( 'see more', 'zn_framework' ) ) ?>" data-less-text="<?php echo esc_attr( __( 'show less', 'zn_framework' ) ) ?>"><span class="glyphicon glyphicon-menu-down"></span> </a>
				<?php endif; ?>
			</div>
			<?php } ?>

			<?php
				if( $has_image && ! empty( $saved_image ) ){
					set_query_var( 'portfolio_image', $saved_image );
				}
				get_template_part( 'inc/details', 'portfolio' );
			?>

		</div><!-- /.portfolio-item-content -->
	</div>

	<div class="col-sm-12 col-md-7">
		<div class="img-full portfolio-item-right mfp-gallery mfp-gallery--misc">
			<?php

				// Display the media
				if ( ! empty( $saved_image ) && $portfolio_media ) {
					echo '<a href="' . $portfolio_media . '" data-lightbox="mfp" data-mfp="iframe" class="hoverBorder">';
					echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' class="img-responsive" />';
					echo '</a>';
				}
				elseif ( ! empty( $saved_image ) ) {
					echo '<a href="' . $saved_image . '" data-lightbox="mfp" data-mfp="image" class="hoverBorder">';
					echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' class="img-responsive" />';
					echo '</a>';
				}
				elseif ( $portfolio_media ) {
					echo '<div class="embed-responsive embed-responsive-16by9">';
						echo get_video_from_link( $portfolio_media, 'embed-responsive-item', '100%', '100%' );
					echo '</div>';
				}

				if ( is_array( $port_media ) && ! empty ( $port_media[0] ) ) {
					unset( $port_media[0] );
				}

			// Other
			if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
				echo '<div class="zn_other_images portfolio-item-extraimages">';

				foreach ( $port_media as $media ) {
					$has_image = false;
					$extra_saved_image = '';
					// Modified portfolio display
					// Check to see if we have images
					if ( $portfolio_image = $media['port_media_image_comb'] ) {

						if ( is_array( $portfolio_image ) ) {

							if ( $extra_saved_image = $portfolio_image['image'] ) {

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
							$extra_saved_image = $portfolio_image;
							$has_image   = true;
							$saved_alt   = ZngetImageAltFromUrl( $extra_saved_image );
							$saved_title = ZngetImageTitleFromUrl( $extra_saved_image, true );
						}

						if ( $has_image ) {
							$image = vt_resize( '', $extra_saved_image, $images_width, '', true );
						}
					} // END PORTFOLIO IMAGE

					// Check to see if we have video
					if ( $portfolio_media = $media['port_media_video_comb'] ) {
					}

					// Display the media
					if ( ! empty( $extra_saved_image ) && $portfolio_media ) {
						echo '<div class="portfolio-item-extraimg">';
						echo '<a href="' . $portfolio_media . '" data-lightbox="mfp" data-mfp="iframe" class="hoverBorder">';
						echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' class="img-responsive"/>';
						echo '</a>';
						echo '</div>';
					}
					elseif ( ! empty( $extra_saved_image ) ) {
						echo '<div class="portfolio-item-extraimg">';
						echo '<a href="' . $extra_saved_image . '" data-lightbox="mfp" data-mfp="image" class="hoverBorder">';
						echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' class="img-responsive"/>';
						echo '</a>';
						echo '</div>';
					}
					elseif ( $portfolio_media ) {
						echo '<div class="portfolio-item-extraimg">';
						echo '<div class="embed-responsive embed-responsive-16by9">';
							echo get_video_from_link( $portfolio_media, 'embed-responsive-item', '100%', '100%' );
						echo '</div>';
						echo '</div>';
					}
				}
				echo '<div class="clearfix"></div>';
				echo '</div>';
			}
			?>

		</div>
	</div>
	<!-- right side -->

	<div class="clearfix"></div>



</div><!-- end Portfolio page -->

<?php
	// Load Related Portfolio items
	get_template_part( 'inc/details', 'portfolio-related' );
?>