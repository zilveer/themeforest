<?php if(! defined('ABSPATH')){ return; }
global $zn_config, $colWidth,$zn_link_portfolio,$ports_num_columns,$extra_content;

		$title_link_start = '';
		$title_link_end = '';
		if ( $zn_link_portfolio != 'no_all' ) {
			$title_link_start = '<a href="'. get_permalink() .'">';
			$title_link_end = '</a>';
		}

		$ptf_show_title = isset($zn_config['ptf_show_title']) && !empty($zn_config['ptf_show_title']) ? $zn_config['ptf_show_title'] : 'yes';
		$ptf_show_desc = isset($zn_config['ptf_show_desc']) && !empty($zn_config['ptf_show_desc']) ? $zn_config['ptf_show_desc'] : 'yes';

		// $i += $colWidth;
		echo '<div class="col-xs-12 col-sm-4 col-lg-'.$colWidth.'">';

			echo '<div class="portfolio-item kl-has-overlay portfolio-item--overlay" '.WpkPageHelper::zn_schema_markup('creative_work').'>';

				if( $ports_num_columns == 1 ){
					echo '<div class="row">';
					echo '<div class="col-sm-6">';
				}

				echo '<div class="img-intro portfolio-item-overlay-imgintro">';
					$port_media = get_post_meta( $post->ID, 'zn_port_media', true );
					if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
						$size      = zn_get_size( 'eight' );
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

							if ( $has_image ) {
								$image = vt_resize( '', $saved_image, $size['width'], '', true );
							}
						}

						// Check to see if we have video
						$portfolio_media = $port_media[0]['port_media_video_comb'];

						// Display the media
						if ( ! empty( $saved_image ) && $portfolio_media ) {
							echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="portfolio-item-link hoverLink"></a>';
							echo '<img class="kl-ptf-catlist-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
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
								echo '<a href="' . get_permalink() . '" class="portfolio-item-link hoverLink"></a>';
								echo '<img class="kl-ptf-catlist-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
								echo $overlay;
							}
							else {
								echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image" class="portfolio-item-link hoverLink"></a>';
								echo '<img class="kl-ptf-catlist-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
								echo $overlay;
							}
						}
						elseif ( $portfolio_media ) {
							echo get_video_from_link( $portfolio_media, '', $size['width'], $size['height'] );
						}
					}
				echo '</div><!-- img intro -->';

				// If we have only 1 column
				if( $ports_num_columns == 1 ){
					echo '</div>';
					echo '<div class="col-sm-6">';
				}

				echo '<div class="portfolio-entry kl-ptf-catlist-details">';

					if($ptf_show_title == 'yes') {
						echo '<h3 class="title kl-ptf-catlist-title" '.WpkPageHelper::zn_schema_markup('title').'>';
							echo $title_link_start;
							echo get_the_title();
							echo $title_link_end;
						echo '</h3>';
					}

					if($ptf_show_desc == 'yes') {
					echo '<div class="pt-cat-desc kl-ptf-catlist-desc">';

						if (preg_match('/<!--more(.*?)?-->/', $post->post_content)) {
							the_content('');
						}
						else {
							$exc = get_the_excerpt();
							echo wpautop( wp_trim_words($exc, 10) );
						}

					echo '</div><!-- pt cat desc -->';
					}

				if( $ports_num_columns == 1 && $extra_content == 'yes' ){
					get_template_part( 'inc/details', 'portfolio' );
				}

				echo '</div><!-- End portfolio-entry -->';

				// If we have only 1 column
				if( $ports_num_columns == 1 ){
					echo '</div>'; // End col-sm-6
					echo '</div>'; // End row
				}

			echo '</div><!-- END portfolio-item -->';
		echo '</div>';