<?php if(!defined('ABSPATH')) { return; }
    /*
     * Build and display the element
     */
    $options = (isset($GLOBALS['options']['circ_2']) ? $GLOBALS['options']['circ_2'] : null);
    if(empty($options)){
        return;
    }

    $style = $this->opt('ww_header_style', '');
    if ( ! empty ( $style ) ) {
        $style = 'uh_' . $style;
    }

    $countitm = 0;
    $singleItem = $this->opt('single_circ2');
    $hasItems = isset ( $singleItem ) && is_array( $singleItem );
    if($hasItems){
        $countitm = count($singleItem);
    }

    $bottom_mask = $this->opt('hm_header_bmasks','none');
    $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';
?>
<div class="kl-slideshow circularcarousel__slideshow <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo zn_get_element_classes($this->data['options']); ?>">

     <div class="bgback"></div>
    <?php
        WpkPageHelper::zn_background_source( array(
            'source_type' => $this->opt('source_type'),
            'source_background_image' => $this->opt('background_image'),
            'source_vd_yt' => $this->opt('source_vd_yt'),
            'source_vd_vm' => $this->opt('source_vd_vm'),
            'source_vd_self_mp4' => $this->opt('source_vd_self_mp4'),
            'source_vd_self_ogg' => $this->opt('source_vd_self_ogg'),
            'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
            'source_vd_vp' => $this->opt('source_vd_vp'),
            'source_vd_autoplay' => $this->opt('source_vd_autoplay'),
            'source_vd_loop' => $this->opt('source_vd_loop'),
            'source_vd_muted' => $this->opt('source_vd_muted'),
            'source_vd_controls' => $this->opt('source_vd_controls'),
            'source_vd_controls_pos' => $this->opt('source_vd_controls_pos'),
            'source_overlay' => $this->opt('source_overlay'),
            'source_overlay_color' => $this->opt('source_overlay_color'),
            'source_overlay_opacity' => $this->opt('source_overlay_opacity'),
            'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient'),
            'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac'),
            'mobile_play' => $this->opt('mobile_play', 'no'),
        ) );
    ?>
    <div class="th-sparkles"></div>

    <div class="kl-slideshow-inner <?php echo $this->opt('size','container');?> kl-slideshow-safepadding">
        <div class="row">
            <div class="ca-container" data-count="<?php echo $countitm; ?>">
                <div class="ca-nav">
                    <span class="ca-nav-prev"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></span>
                    <span class="ca-nav-next"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></span>
                </div>
                    <div class="ca-wrapper ca-alt" data-autoplay="<?php echo $this->opt('ww_slider_autoplay') == 1 ? 1:0 ; ?>" data-timout="<?php echo $this->opt('ww_slider_timeout', 9000) ?>" data-max="<?php echo $this->opt('ww_slider_max','3'); ?>" data-height="<?php echo $this->opt('ww_slider_height', '450'); ?>">
                    <?php
                        if ( $hasItems )
                        {
                            $i = 1;
                            foreach ( $singleItem as $slide )
                            {
                                echo '<div class="ca-item ca-item-' . $i . '">';

                                echo '<div class="ca-item-main">';

                                 if ( isset ( $slide['ww_slide_image'] ) && ! empty ( $slide['ww_slide_image'] ) ) {
                                    $sl_img = $slide['ww_slide_image'];
                                    $image = vt_resize( '', $sl_img, '376', '440', true );
                                    echo '<img src="' . $image['url'] . '"  width="' . $image['width'] . '" height="' . $image['height'] . '" class="ca-background cover-fit-img" '.ZngetImageAltFromUrl($sl_img, true).' '.ZngetImageTitleFromUrl($sl_img, true).' >';
                                 }

                                // TITLE
                                if ( isset ( $slide['ww_slide_title'] ) && ! empty ( $slide['ww_slide_title'] ) ) {
                                    $title_pos_l = $title_pos_t = '';
                                    if ( isset ( $slide['ww_slide_title_left'] ) && ! empty ( $slide['ww_slide_title_left'] ) ) {
                                        $title_pos_l = 'left:' . $slide['ww_slide_title_left'] . 'px;';
                                    }

                                    if ( isset ( $slide['ww_slide_title_top'] ) && ! empty ( $slide['ww_slide_title_top'] ) ) {
                                        $title_pos_t = 'top:' . $slide['ww_slide_title_top'] . 'px;';
                                    }

                                    $arrpos = isset($slide['ww_slide_title_arrpos']) && !empty($slide['ww_slide_title_arrpos']) ? $slide['ww_slide_title_arrpos'] : 'top-left';

                                    echo '<div class="title_circle" style="' . $title_pos_t . ' ' . $title_pos_l .
                                         '" data-size="' . $slide['ww_slide_title_size'] . '" data-position="'.$arrpos.'">';
                                    echo '<span>' . $slide['ww_slide_title'] . '</span>';
                                    echo '</div>';
                                }

                                // DESC
                                if ( isset ( $slide['ww_slide_desc'] ) && ! empty ( $slide['ww_slide_desc'] ) ) {
                                    echo '<div class="ca-text">' . $slide['ww_slide_desc'] . '</div>';
                                }

                                // DESC
                                if ( isset ( $slide['ww_slide_read_text'] ) && ! empty ( $slide['ww_slide_read_text'] ) ) {
                                    echo '<a href="#" class="btn btn-fullcolor ca-more js-ca-more">' . $slide['ww_slide_read_text'] .
                                         ' <span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></a>';
                                }

                                // Bottom Title
                                if ( isset ( $slide['ww_slide_bottom_title'] ) && ! empty ( $slide['ww_slide_bottom_title'] ) ) {
                                    echo '<span class="ca-starting">' . $slide['ww_slide_bottom_title'] . '</span>';
                                }

                                echo '</div>';

                                echo '<div class="ca-content-wrapper">';

                                echo '<a href="#" class="ca-close js-ca-close"><span class="glyphicon glyphicon-remove"></span></a>';

                                echo '<div class="ca-content">';

                                // Content Title
                                if ( isset ( $slide['ww_slide_content_title'] ) && ! empty ( $slide['ww_slide_content_title'] ) ) {
                                    echo '<h6 class="ca-panel-title">' . $slide['ww_slide_content_title'] . '</h6>';
                                }

                                // Content description
                                if ( isset ( $slide['ww_slide_desc_full'] ) && ! empty ( $slide['ww_slide_desc_full'] ) ) {

                                    $content = wpautop( $slide['ww_slide_desc_full'] );
                                    echo '<div class="ca-content-text">';
                                        if ( preg_match( '%(<[^>]*>.*?</)%i', $content, $regs ) ) {
                                            echo do_shortcode( $content );
                                        }
                                        else {
                                            echo '<p>' . do_shortcode( $content ) . '</p>';
                                        }
                                    echo '</div>';
                                }

                                // Link
                                if ( isset($slide['ww_slide_read_text_content']) && ! empty($slide['ww_slide_read_text_content']) )
                                {
                                    $ww_slide_link = zn_extract_link( $slide['ww_slide_link'] );
                                    echo $ww_slide_link['start'] . $slide['ww_slide_read_text_content'] . $ww_slide_link['end'];
                                }

                                echo '</div>';
                                echo '</div>';
                                echo '</div><!-- end ca-item -->';
                                $i ++;
                            }
                        }
                    ?>
                </div>
                <!-- end ca-wrapper -->
            </div>
            <!-- end circular content carousel -->
        </div>
    </div>
    <?php
        zn_bottommask_markup($bottom_mask, $this->opt('hm_header_bmasks_bg',''));
    ?>
    <!-- header bottom style -->
</div><!-- end kl-slideshow -->


