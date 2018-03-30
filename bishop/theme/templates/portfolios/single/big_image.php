<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$extra_info_variables = array( 'show_meta_section'   => $show_meta_section,
							   'extra_title'         => $extra_title,
							   'year'                => $year,
							   'customer'            => $customer,
							   'project'             => $project,
							   'website_url'         => $website_url,
							   'website'             => $website,
							   'show_share_section'  => $show_share_section,
							   'share_title'         => $share_title,
							   'share_socials'       => $share_socials,
							   'show_custom_button'  => $show_custom_button,
							   'custom_button_url'   => $custom_button_url,
							   'custom_button_label' => $custom_button_label );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio_' . $layout ) ?> >
    <div class="meta clearfix row portfolio single" >
        <!-- Show thumbnail -->
        <?php

        if(( $show_sidebar ) && !is_rtl()){
            yit_get_template( 'portfolios/single/big_image_extra_info.php', $extra_info_variables );
        }

        ?>

        <div class="col-sm-<?php echo ( $show_sidebar ) ? '9' : '12' ?>">
            <div class="yit_post_content clearfix">
                <?php if( $content_title != '' ): ?>
                <h3 class="portfolio_content_title">
                    <?php echo $content_title ?>
                </h3>
                <?php endif; ?>
                <?php the_content() ?>
            </div>
        </div>

        <?php

        if(( $show_sidebar ) && is_rtl()){
            yit_get_template( 'portfolios/single/big_image_extra_info.php', $extra_info_variables );
        }

        ?>

    </div>
</div>