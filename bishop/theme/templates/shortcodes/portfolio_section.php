<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $post;
$enable_hover = ( $enable_hover == 'yes' ) ? true : false;
$enable_title = ( $enable_title == 'yes' ) ? true : false;
$enable_categories = ( $enable_categories == 'yes' ) ? true : false;
$excluded_ids = ( isset( $excluded_ids ) ) ? explode( ', ', $excluded_ids ) : array();

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';
if( ! empty( $portfolios ) ):
    $portfolio = YIT_Portfolio()->get_portfolio( $portfolios );

    $portfolio->init_query( array( 'posts_per_page' => $nitems ) );

    wp_enqueue_script( 'owl-carousel' );

    if( $portfolio->have_posts() ):
?>
    <div class="portfolio-slider-outer <?php echo esc_attr( $animate . $vc_css ); ?>" <?php echo $animate_data ?>>
        <div class="portfolio-slider" data-postid="<?php echo $portfolio->config->ID ?>">
            <div class="prev-portfolio"></div>
            <div class="next-portfolio"></div>
            <ul class="portfolios" data-postid="<?php echo $portfolio->config->ID ?>">
                <?php
                while( $portfolio->have_posts() ):
                    $portfolio->the_post();
                    if( ! in_array( get_the_ID(), $excluded_ids ) ):
                ?>
                <li <?php $portfolio->item_class('items' )?> >
                    <div class="portfolio-thumb">
                        <?php
                        $image = $portfolio->get_image( 'portfolio_section', array( 'class' => 'img-responsive' ) );
                        if ( strcmp( $image, '' ) != 0 ) {
                            echo $image;
                        }
                        else {
                            ?>
                            <img src="<?php echo $portfolio->get( 'baseurl' ) ?>images/no-image.jpg" class="img-responsive" />
                        <?php
                        }
                        ?>
                        <?php if ( $enable_hover ):?>
                            <div class="portfolio-overlay">
                                <div class="portfolio-overlay-info">
                                    <?php if ( $enable_title ):?>
                                        <div class="portfolio-overlay-title">
                                            <a href="<?php echo $portfolio->get( 'permalink' ); ?>"><?php echo $portfolio->get( 'title' ); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $enable_categories ):?>
                                        <div class="portfolio-overlay-categories">
                                            <?php echo $portfolio->terms_list( ', ' ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
                <?php
                    endif;
                endwhile;
                ?>
            </ul>
        </div>
    </div>

<?php

    endif;
endif;
?>