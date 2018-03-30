<!-- Testimonial -->
<?php
    global $customize,$is_customize_mode;
    if($customize['testimonial']['show'] || $is_customize_mode): 
?>
    <section id="testimonial" class="awe-section testimonial awe-parallax js-awe-get-items" <?php display_background_css('testimonial') ?>>
        <div class="container js-content-item wow <?php animationContent('testimonial'); ?>" data-wow-delay="0.5s" data-animate="<?php animationContent('testimonial'); ?>">
            <div class="row">
                <?php displayHeader('testimonial'); ?>
                <div class="awe-content">

                    <!-- AweTheme Testimonial -->
                    <div class="awe-testimonial">
                        <i class="awe-icon fa fa-quote-right"></i>
                        <div id="owl-testimonial">
                        <?php  
                            $args = array('post_type'=>'awe_testimonial','posts_per_page'=>'-1');
                            $testimonial = new WP_Query($args);
                            while ($testimonial->have_posts()) : $testimonial->the_post();
                                // $post_meta = get_post_meta($post->ID);
                                // var_dump($post_meta);
                        ?>
                            <!-- Testimonial 1 -->
                            <div class="item">
                                <p><?php echo get_post_meta($post->ID,'quote',true); ?></p>
                                <h2><?php the_title(); ?></h2>
                                <span><?php echo get_post_meta($post->ID,'subtitle',true); ?></span>
                            </div>
                        <?php endwhile; wp_reset_query(); ?>                
                        </div>
                    </div>
                </div>
                <?php sectionFooter('testimonial'); ?>
            </div>
        </div>
        <?php sectionOverLay('testimonial'); ?>
    </section>
<?php endif; ?>