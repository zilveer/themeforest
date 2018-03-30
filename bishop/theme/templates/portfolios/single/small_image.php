<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post;

$extra_info_variables= array('attachments'=>$attachments, 'has_thumbnail' => $has_thumbnail, 'show_extra_content'=> $show_extra_content, 'show_meta_section' => $show_meta_section,
                             'extra_title'=>$extra_title,'year' => $year, 'customer' => $customer, 'project' => $project,'website' =>$website, 'website_url' => $website_url,
                             'show_share_section' => $show_share_section, 'share_title' =>$share_title, 'share_socials' =>$share_socials);
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio_' . $layout ) ?> >
    <div class="meta clearfix row portfolio single" >


        <?php

        if(!is_rtl()){
            yit_get_template( 'portfolios/single/small_image_extra_info.php', $extra_info_variables );
        }

        ?>

        <div class="col-sm-<?php echo ( $has_thumbnail ) ? '5' : ( ( $show_extra_content ) ? '9' : '12' ) ?> yit_post_content clearfix">
            <?php if( $content_title != '' ): ?>
                <h3 class="portfolio_content_title">
                    <?php echo $content_title ?>
                </h3>
            <?php endif; ?>

            <div class="portfolio_content">
                <?php the_content() ?>
            </div>

            <?php if( $has_thumbnail && $show_extra_content ): ?>
                <div class="yit_portfolio_extra_info">
                    <?php if( $show_meta_section ): ?>
                        <div class="portfolio_meta">
                            <?php if( $year != '' ): ?>
                                <div class="portfolio_year">
                                    <span class="meta_title"><?php _e( 'Year:', 'yit' ) ?></span>
                                    <span class="meta_content"><?php echo $year ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if( $customer != '' ): ?>
                                <div class="portfolio_customer">
                                    <span class="meta_title"><?php _e( 'Customer:', 'yit' ) ?></span>
                                    <span class="meta_content"><?php echo $customer ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if( $project != '' ): ?>
                                <div class="portfolio_customer">
                                    <span class="meta_title"><?php _e( 'Project:', 'yit' ) ?></span>
                                    <span class="meta_content"><?php echo $project ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if( $website != '' && $website != '' ): ?>
                                <div class="portfolio_website">
                                    <span class="meta_title"><?php _e( 'Website:', 'yit' ) ?></span>
                                    <span class="meta_content"><a href="<?php echo $website_url ?>"><?php echo $website ?></a></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if( $show_share_section ): ?>
                        <div class="portfolio_share">
                            <?php print_socials( $share_title, $share_socials ) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php

        if(is_rtl()){
            yit_get_template( 'portfolios/single/small_image_extra_info.php', $extra_info_variables );
        }

        ?>

        <div class="clearfix"></div>

        <?php if( $show_other_project_section && ( ! defined('DOING_AJAX') || ! DOING_AJAX ) ): ?>
            <div class="portfolio_other_project">
                <?php if( $show_other_project_title ): ?>
                    <div class="title-bar">
                        <h5><?php echo $other_project_title ?></h5>
                    </div>
                <?php endif; ?>
                <?php echo do_shortcode( '[portfolio_section nitems="-1" enable_hover="yes" enable_title="yes" enable_categories="yes" portfolios="' . $portfolio->config->post_name . '" excluded_ids="' . $post->ID . '" ]' )?>
            </div>
        <?php endif; ?>
    </div>
</div>