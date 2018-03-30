<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<?php if( ! empty( $attachments ) && count( $attachments ) > 1 && $has_thumbnail ): ?>
    <div class="col-sm-7 yit_portfolio_thumbnail">
        <div class="thumbnail">
            <div class="swiper-container swiper-<?php the_ID() ?>" data-postid="<?php the_ID() ?>" >
                <div class="swiper-wrapper">
                    <?php foreach ( $attachments as $key => $attachment ) : ?>
                        <div class="swiper-slide">
                            <?php yit_image( "id=$attachment->ID&size=portfolio_single_small&class=img-responsive" ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination pagination-post-<?php the_ID() ?>"></div>
                <div class="swiper-direction left"><i class="fa fa-chevron-left"></i></div>
                <div class="swiper-direction right"><i class="fa fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
<?php elseif( $has_thumbnail ): ?>
    <div class="col-sm-7 yit_portfolio_thumbnail">
        <div class="thumbnail">
            <?php yit_image( array( 'size' => 'portfolio_single_small', 'class' => 'img-responsive' ) )?>
        </div>
    </div>
<?php elseif( $show_extra_content ): ?>
    <div class="col-sm-3 yit_portfolio_extra_info">
        <?php if( $show_meta_section ): ?>
            <div class="portfolio_meta">
                <?php if( $extra_title != '' ): ?>
                    <h3 class="portfolio_extra_title">
                        <?php echo $extra_title ?>
                    </h3>
                <?php endif; ?>
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