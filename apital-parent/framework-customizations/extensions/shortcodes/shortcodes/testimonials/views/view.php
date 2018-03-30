<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$testimonials = get_posts(array('posts_per_page' => (int)$atts['number'], 'post_type' => 'fw-testimonials'));

//fw_print($testimonials);
if(empty($testimonials)) return;

?>
<?php if($atts['type'] == 'type1'):?>
    <div class="w-slider carousel-project" data-animation="outin" data-duration="500" data-infinite="1" data-nav-spacing="5">
        <div class="w-slider-mask">
            <?php foreach($testimonials as $testimonial):?>
                <?php $job = fw_get_db_post_option($testimonial->ID,'job');?>
                <div class="w-slide">
                    <div class="big-testimonials-wrapper">

                        <?php $image = wp_get_attachment_url( get_post_thumbnail_id($testimonial->ID),'post-thumbnails');?>
                        <?php if(!empty($image)):?>
                            <div class="testi-photo"><img src="<?php echo esc_url($image);?>" alt="<?php echo get_the_title($testimonial->ID);?>" /></div>
                        <?php endif;?>

                        <div class="b-test-txt">
                            <p class="p-big-test"><?php echo esc_attr($testimonial->post_content); ?></p>
                        </div>
                        <div class="b-test-name">
                            <h5>
                                <span class="blue">
                                    - <?php echo get_the_title($testimonial->ID);?>
                                    <?php echo !empty($job) ? ' - ' . $job : '' ; ?>
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="w-slider-nav w-round carousel-dots"></div>
    </div>
<?php else:?>
    <div class="w-slider carousel-project" data-animation="outin" data-duration="500" data-infinite="1" data-nav-spacing="5">
        <div class="w-slider-mask">
        <?php foreach($testimonials as $testimonial):?>
            <?php $job = fw_get_db_post_option($testimonial->ID,'job');?>
            <div class="w-slide">
                <div class="w-clearfix testi-wrapper">
                    <div class="qoute-ico">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="test-text-wrapper">
                        <div class="testimonial-type2-text"><?php echo do_shortcode($testimonial->post_content); ?></div>
                        <div class="space">
                            <h5 class="portfolio-tittle"><?php echo get_the_title($testimonial->ID);?> <?php echo !empty($job) ? ' <span class="sub-tittle-test">– ' . $job . '</span> ' : '' ; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
        <div class="w-slider-nav w-slider-nav-invert w-round carousel-dots"></div>
    </div>
<?php endif;?>