<?php if(! defined('ABSPATH')){ return; }
    global $zn_config;
    $frame_style = !empty( $zn_config['frame_style'] ) ? $zn_config['frame_style'] : zget_option( 'frame_style', 'portfolio_options', false, 'classic' );

    // Load scripts required
    wp_enqueue_script( 'caroufredsel');
    wp_enqueue_script( 'isotope');

    // Check if PB Element has style selected, if not use Portfolio style option. If no blog style option, use Global site skin.
    $portfolio_scheme_global = zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) != '' ? zget_option( 'portfolio_scheme', 'portfolio_options', false, '' ) : zget_option( 'zn_main_style', 'color_options', false, 'light' );
    $portfolio_scheme = isset($zn_config['portfolio_scheme']) && $zn_config['portfolio_scheme'] != '' ? $zn_config['portfolio_scheme'] : $portfolio_scheme_global;

    // $zn_link_portfolio = zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' );
    $zn_link_portfolio = isset( $zn_config['zn_link_portfolio'] ) && !empty($zn_config['zn_link_portfolio']) ? $zn_config['zn_link_portfolio'] : zget_option( 'zn_link_portfolio', 'portfolio_options', false, 'no' );

    $ports_num_columns = ! empty( $zn_config['ports_carousel_columns'] ) ? $zn_config['ports_carousel_columns'] : zget_option( 'ports_carousel_columns', 'portfolio_options', false, '1' );

    $is_cols = $ports_num_columns != 1 ? true : false;

    $row_start = '';
    $row_end = '';
    $col_start = '';
    $col_end = '';
    $cols_carousel = 'col-sm-6 col-sm-push-6';
    $cols_desc = 'col-sm-6 col-sm-pull-6';
    if($is_cols){
        $cols_carousel = 'col-sm-12';
        $cols_desc = 'col-sm-12';

        $col_nr = 12 / $ports_num_columns;
        $row_start = '<div class="row kl-ptfcarousel-cols--'.$ports_num_columns.'">';
        $row_end = '</div>';
        $col_start = '<div class="col-sm-12 col-md-'.$col_nr.'">';
        $col_end = '</div>';
    }
    $i = 1;

    $ptf_show_title = isset($zn_config['ptf_show_title']) && !empty($zn_config['ptf_show_title']) ? $zn_config['ptf_show_title'] : 'yes';
    $ptf_show_desc = isset($zn_config['ptf_show_desc']) && !empty($zn_config['ptf_show_desc']) ? $zn_config['ptf_show_desc'] : 'yes';
?>
	<div class="hg-portfolio-carousel kl-ptfcarousel portfolio-crsl--<?php echo $portfolio_scheme; ?> element-scheme--<?php echo $portfolio_scheme; ?>">
		<?php

            the_archive_description( '<div class="kl-ptfcarousel-description u-mb-50">', '</div>' );

            echo $row_start;

			if ( have_posts() ): while ( have_posts() ) : the_post();

                $title_link_start = '';
                $title_link_end = '';
                $seemore_btn = '';
                if ( $zn_link_portfolio != 'no_all' ) {
                    $title_link_start = '<a href="'. get_permalink() .'" class="kl-ptfcarousel-item-title-link">';
                    $title_link_end = '</a>';
                    $seemore_btn = '<a class="btn btn-fullcolor " href="' . get_permalink() . '">' . __('SEE MORE', 'zn_framework') . '</a>';
                }

                echo $col_start;

				?>
                <div class="portfolio-item kl-ptfcarousel-item" <?php echo WpkPageHelper::zn_schema_markup('creative_work'); ?>>
                    <div class="row">
                        <div class="<?php echo $cols_carousel; ?>">
                            <div class="ptcarousel kl-ptfcarousel-carousel ptcarousel--frames-<?php echo $frame_style ?> kl-ptfcarousel-frame--<?php echo $frame_style ?>">

                                <?php
                                $port_media = get_post_meta(get_the_ID(), 'zn_port_media', true);
                                if (count( $port_media ) > 1) {
                                    ?>
                                    <div class=" controls kl-ptfcarousel-carousel-controls">
                                        <a href="#" class="prev kl-ptfcarousel-carousel-arr cfs--prev u-trans-all-2s"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></a>
                                        <a href="#" class="next kl-ptfcarousel-carousel-arr cfs--next u-trans-all-2s"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></a>
                                    </div>
                                <?php
                                }
                                ?>

                                <ul class="zn_general_carousel kl-ptfcarousel-carousel-list cfs--default">
                                    <?php
                                    if ( ! empty ( $port_media ) && is_array( $port_media ) ) {
                                        foreach ( $port_media as $media ) {
                                            $size      = zn_get_size( 'eight' );
                                            $has_image = false;

                                            // Modified portfolio display
                                            // Check to see if we have images
                                            if ( $portfolio_image = $media['port_media_image_comb'] ) {

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
                                            if ( $portfolio_media = $media['port_media_video_comb'] ) {
                                                $portfolio_media = str_replace( '', '&amp;', $portfolio_media );
                                            }

                                            // Display the media
                                            echo '<li class="item kl-ptfcarousel-carousel-item kl-has-overlay portfolio-item--overlay cfs--item">';

                                                echo '<div class="img-intro portfolio-item-overlay-imgintro">';
                                                if ( ! empty( $saved_image ) && $portfolio_media ) {
                                                    echo '<a href="' . $portfolio_media . '" data-mfp="iframe" data-lightbox="iframe" class="portfolio-item-link"></a>';
                                                    echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .  $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
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

                                                    if (  $zn_link_portfolio == 'yes' ) {
                                                        echo '<a href="' . get_permalink() . '" class="portfolio-item-link"></a>';
                                                        echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                        echo $overlay;
                                                    }
                                                    else {
                                                        echo '<a href="' . $saved_image . '" data-type="image" data-lightbox="image" class="portfolio-item-link"></a>';
                                                        echo '<img class="kl-ptfcarousel-img" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $saved_alt . '" ' . $saved_title . ' />';
                                                        echo $overlay;
                                                    }
                                                }
                                                elseif ( $portfolio_media ) {
                                                    echo get_video_from_link( $portfolio_media, '', $size['width'], $size['height'] );
                                                }
                                                echo '</div>';
                                            echo '</li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <!-- end ptcarousel -->
                        </div>
                        <div class="<?php echo $cols_desc; ?>">
                            <div class="ptcontent">

                            <?php if( $ptf_show_title == 'yes' ){ ?>
                                <h3 class="title pt-content-title kl-ptfcarousel-item-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>>

                                    <?php echo $title_link_start; ?>
                                        <span class="name kl-ptfcarousel-item-title-name"><?php the_title(); ?></span>
                                    <?php echo $title_link_end; ?>

                                </h3>

                            <?php } ?>

                            <?php if( $ptf_show_desc == 'yes' ){ ?>
                                <div class="pt-cat-desc kl-ptfcarousel-item-desc">
                                    <?php
                                        if ( strpos( get_the_content(), 'more-link' ) !== false ) {
                                            the_content( '' );
                                        }
                                        else {
                                            the_excerpt();
                                        }
                                    ?>
                                </div>
                                <!-- end item desc -->

                                <?php
                                    // Get portfolio fields
                                    get_template_part( 'inc/details', 'portfolio-fields' );
                                ?>

                            <?php } ?>


                                <div class="pt-itemlinks itemLinks kl-ptfcarousel-item-links">

                                    <?php echo $seemore_btn; ?>

                                    <?php
                                    $sp_link = get_post_meta(get_the_ID(), 'zn_sp_link', true);
                                    $sp_link_ext = zn_extract_link($sp_link, 'btn btn-lined '.($portfolio_scheme == 'light' ? 'lined-dark':'') );

                                    if (!empty ($sp_link_ext['start'])) {
                                        echo $sp_link_ext['start'] . __("LIVE PREVIEW", 'zn_framework') . $sp_link_ext['end'];
                                    }
                                    ?>
                                </div>
                                <!-- end item links -->
                            </div>
                            <!-- end item content -->
                        </div>
                    </div>
                </div>
                <?php echo $col_end; ?>

                <?php

                    if($i % $ports_num_columns == 0){
                        echo '<div class="clearfix"></div>';
                    }
                ?>
			<?php $i++; endwhile; ?>
			<?php endif; ?>

            <?php echo $row_end; ?>

	</div>
	<!-- end portfolio layout -->
	<?php
		echo '<div class="clear"></div>';
		echo '<div class="col-sm-12 pagination--'.$portfolio_scheme.'">';
		    zn_pagination();
		echo '</div>';
	?>
