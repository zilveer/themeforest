 <!-- Skill -->
 <?php
    global $customize,$is_customize_mode;
    if($customize['skill']['show'] || $is_customize_mode): 
?>
    <section id="skill" class="awe-section skill awe-parallax" <?php display_background_css('skill'); ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('skill'); ?>
                <div class="awe-content">

                    <div class="awe-skills js-content-slider <?php contentSlider('skill') ?> clearfix" <?php sliderCols('skill'); ?>>
                        <?php
                        global $customize;
                        $args = array(
                            'id'=>$customize['aboutus'],
                            'post_type' => 'awe_aboutus',
                        );
                        $about = new WP_Query($args);
                        while ($about->have_posts()) : $about->the_post();
                        $post_meta = get_post_meta($post->ID,'skills',true);
                        if(is_array($post_meta)){
                            foreach ($post_meta as $value) :
                            ?>
                                <!-- Item -->
                                <div class="js-content-item <?php hasSlider('skill') ?> wow <?php animationContent('skill'); ?>" data-animate="<?php animationContent('skill'); ?>">
                                    <div class="item">
                                        <div class="chart" data-percent="<?php echo $value['pro'] ?>" data-color="<?php skillColor(); ?>">
                                            <span class="percent"></span>
                                        </div>
                                        <h2><?php echo $value['name']; ?></h2>
                                    </div>
                                </div>
                                <!-- End Item -->
                            <?php endforeach; } ?>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                    </div>

                </div>

            </div>
            <?php sectionFooter('skill'); ?>
        </div>
        <?php sectionOverLay('skill'); ?>
    </section>
<?php endif; ?>