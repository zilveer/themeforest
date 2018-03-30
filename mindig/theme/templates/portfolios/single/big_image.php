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
$terms                  = $portfolio->terms_list( ', ' );
$next                   = '<span class="glyphicon glyphicon-chevron-right"></span>';
$prev                   = '<span class="glyphicon glyphicon-chevron-left"></span>';
$previous_post          = get_adjacent_post( false, '', true );
$next_post              = get_adjacent_post( false, '', false );
$previous_post_terms    = is_object( $previous_post ) ? yit_get_terms_list_by_id( $previous_post->ID,$taxonomy ) : false;
$next_post_terms        = is_object( $next_post )     ? yit_get_terms_list_by_id( $next_post->ID, $taxonomy ) : false;
$featured_image_size    = apply_filters( '_yiy_portfolio_single_image_size', 'portfolio_single_big_featured' );
$post_attachment_id     = get_post_thumbnail_id();

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio_' . $layout ) ?> >
    <div class="meta clearfix portfolio single">
        <div id="portfolio_nav">
            <div class="row">
                <div class="col-sm-3 prev">
                <?php if( ! empty( $previous_post ) ) : ?>
                    <a href="<?php echo get_permalink( $previous_post->ID ); ?>" rel="prev">
                        <?php echo $prev ?>
                        <div class="info">
                            <h5 class="prev_title"><?php echo $previous_post->post_title ?></h5>
                            <span class="prev_terms"><?php echo $previous_post_terms ?></span>
                        </div>
                        <?php echo get_the_post_thumbnail( $previous_post->ID, 'portfolio_thumb', array( 'class' => 'img-responsive portfolio_thumb' ) );; ?>
                    </a>
                    <span class="prev-label"><?php _e( 'Prev', 'yit' ) ?></span>
                <?php endif; ?>
            </div>
                <div class="col-sm-6 title">
                <h1 class="portfolios-title"><?php the_title() ?></h1>
                <?php if ( $enable_categories ) : ?>
                    <div class="categories">
                        <?php echo $terms ?>
                    </div>
                <?php endif; ?>
            </div>
                <div class="col-sm-3 next">
                    <?php if( ! empty( $next_post ) ) : ?>
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" rel="next">
                            <?php echo $next ?>
                            <div class="info">
                                <h5 class="next_title"><?php echo $next_post->post_title ?></h5>
                                <span class="next_terms"><?php echo $next_post_terms ?></span>
                            </div>
                            <?php echo get_the_post_thumbnail( $next_post->ID, 'portfolio_thumb', array( 'class' => 'img-responsive portfolio_thumb' ) ); ?>
                        </a>
                        <span class="next-label"><?php _e( 'Next', 'yit' ) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div id="portfolio_content" class="row">
            <?php if ( has_post_thumbnail() || ! empty( $attachments ) ) : ?>
                <div class="col-sm-8 col-sm-push-4">
                    <div class="row">
                        <div class="portfolio-single-thumb col-sm-12">
                            <?php echo $portfolio->get_image( $featured_image_size, array( 'class' => 'img-responsive' ) ); ?>
                        </div>
                        <?php foreach ( $attachments as $key => $attachment ) : ?>
                            <div class="portfolio-single-thumb col-sm-12">
                                <?php yit_image( "id=$attachment->ID&size=$featured_image_size&class=img-responsive" ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-sm-<?php echo has_post_thumbnail() || ! empty( $attachments ) ? 4 : 12 ?> col-sm-pull-8">
                <?php if( $enable_extra_info ) : ?>
                    <?php yit_get_template( 'portfolios/common/extra_info.php', $extra_info_variables ); ?>
                <?php endif; ?>
                <div class="the_content <?php echo ( $show_testimonial || $show_share ) ? 'with-border': 'no-border' ?>">
                    <?php the_content() ?>
                </div>
                <?php if( $show_testimonial ) : ?>
                    <div class="testimonial-box <?php echo ( $show_share ) ? 'with-border': 'no-border' ?>">
                        <?php if( ! empty( $testimonial_title ) ) : ?>
                            <h3 class="testimonial-section-title">
                                <?php echo $testimonial_title ?>
                            </h3>
                        <?php endif; ?>
                        <div class="testimonial-wrapper">
                            <div class="testimonial-cit">
                                <span class="testimonial-text">
                                    <?php echo $testimonial->post_content ?>
                                </span>
                                <h4 class="title">
                                    <?php echo $testimonial->post_title ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if( $show_share ) : ?>
                    <?php if( !empty( $share_title ) ) : ?>
                        <h3 class="share-section-title" >
                            <?php echo $share_title ?>
                        </h3>
                    <?php endif; ?>
                    <?php yit_get_social_share( 'text', 'content-style-social', $share_socials )?>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>
