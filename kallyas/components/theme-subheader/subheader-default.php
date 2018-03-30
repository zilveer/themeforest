<?php if(! defined('ABSPATH')){ return; } ?>
<div id="page_header" class="page-subheader <?php echo implode(' ', $extra_classes); ?>">

    <div class="bgback"></div>

    <?php
    $bg_source = $args['bg_source'];
    if ( !empty( $bg_source ) && is_array( $bg_source ) ) {
        WpkPageHelper::zn_background_source( $bg_source );
    }
    ?>

    <div class="th-sparkles"></div>

    <!-- DEFAULT HEADER STYLE -->
    <div class="ph-content-wrap">
        <div class="ph-content-v-center">
            <div>
                <div class="container">
                    <div class="row">
                        <?php

                        $args_def_header_title = $args['def_header_title'] != '' ? $args['def_header_title'] : $show_title;
                        $args_def_header_subtitle = isset( $args['show_subtitle'] ) && $args['show_subtitle'] != '' ? $args['show_subtitle'] : $show_subtitle;

                        $tit_sub = $args_def_header_title || ($args_def_header_subtitle && !empty ( $args['subtitle'] ));

                        $def_cols = (!$br_date || !$tit_sub) ? 12 : 6;

                        if($br_date){
                        ?>
                        <div class="col-sm-<?php echo $def_cols; ?>">
                            <?php

                            if ( $args_def_header_bread ) {
                                // Use the bb breadcrumb if BBPress is installed and current page is inside the forums
                                if(function_exists('is_bbpress') && is_bbpress()) {
                                    echo bbp_get_breadcrumb();
                                }
                                else {
                                    zn_breadcrumbs();
                                }
                            }
                            else {
                                echo '&nbsp;';
                            }
                            if ( $args_def_header_date) {
                                echo '<span id="current-date" class="subheader-currentdate hidden-xs">' .
                                     date_i18n( get_option( 'date_format' ), strtotime( date( "l M d, Y" ) . get_option( 'gmt_offset' ) ), false ) . '</span>';
                            }
                            else {
                                echo '&nbsp;';
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                        <?php } ?>

                        <?php if( $tit_sub ){  ?>
                        <div class="col-sm-<?php echo $def_cols; ?>">
                            <div class="subheader-titles">
                                <?php
                                if ( $args_def_header_title ) {
                                    echo '<' . $title_heading . ' class="subheader-maintitle" '.WpkPageHelper::zn_schema_markup('title').'>' . $args['title'] . '</' . $title_heading . '>';
                                }

                                if ( $args_def_header_subtitle && !empty ( $args['subtitle'] ) ) {
                                    echo '<' . $subtitle_tag . ' class="subheader-subtitle" '.WpkPageHelper::zn_schema_markup('subtitle').'>' . do_shortcode( $args['subtitle'] ) . '</' . $subtitle_tag . '>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <?php

        $bottommask_bg = (isset($args['bottommask_bg']) && !empty($args['bottommask_bg'])) ? $args['bottommask_bg'] : '';

        zn_bottommask_markup( $bottom_mask, $bottommask_bg );
    ?>
</div>
