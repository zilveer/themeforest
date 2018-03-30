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

        <div class="col-sm-<?php echo ( $has_thumbnail ) ? '5' : ( ( $show_extra_content ) ? '9' : '12' ) ?> yit_post_content">
            <?php if( $content_title != '' ): ?>
                <h3 class="portfolio_content_title">
                    <?php the_title() ?>
                </h3>
            <?php endif; ?>

            <div class="portfolio_content">
                <?php the_content() ?>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>