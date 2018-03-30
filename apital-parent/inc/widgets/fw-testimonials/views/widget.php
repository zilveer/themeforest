<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

?>
<?php if ( ! empty( $instance ) ) :
    $testimonials = get_posts(array('posts_per_page' => (int)$instance['number'], 'post_type' => 'fw-testimonials'));

    if(empty($testimonials)) return;

    echo do_shortcode($before_widget);?>

    <div class="space x2">
        <?php if(!empty($instance['title'])):?>
            <div class="tittle-line tittle-sml-mg">
                <h5><?php echo fw_theme_translate(esc_html($instance['title']));?></h5>
                <div class="divider-1 small">
                    <div class="divider-small"></div>
                </div>
            </div>
        <?php endif; ?>
        <div class="w-slider carousel-project" data-animation="outin" data-duration="500" data-infinite="1" data-nav-spacing="6">
                <div class="w-slider-mask">
                    <?php foreach($testimonials as $testimonial):?>
                        <?php $job = fw_get_db_post_option($testimonial->ID,'job');?>
                        <div class="w-slide">
                            <div class="w-clearfix testi-wrapper">
                                <div class="qoute-ico display-none">
                                    <div class="w-embed"><i class="fa fa-quote-left"></i>
                                    </div>
                                </div>
                                <div class="test-text-wrapper">
                                    <div class="testimonial-type2-text"><?php echo do_shortcode($testimonial->post_content); ?></div>
                                    <div class="space">
                                        <h5 class="portfolio-tittle">
                                            <?php echo get_the_title($testimonial->ID);?>
                                            <span class="sub-tittle-test"><?php echo !empty($job) ? ' - ' . $job : '' ; ?></span>&nbsp;
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
            </div>
    </div>

    <?php echo do_shortcode($after_widget);
endif;