<!-- Services -->
<?php
    global $customize,$is_customize_mode;
    if($customize['service']['show'] || $is_customize_mode): 
?>
    <section id="services" class="awe-section services awe-parallax" <?php display_background_css('service'); ?> >
        <div class="container">
            <div class="row">

                <!-- The title -->
                <?php displayHeader('service'); ?>
                <div class="clear"></div>


                <!-- Features services slider -->
                <div class="awe-content clearfix wow fadeInUp" data-wow-duration="0.4s" data-wow-delay="0.4s" >
                    <div class="awe-services">
                        <div class="js-content-slider <?php contentSlider('service') ?>" <?php sliderCols('service'); ?>>
                    <?php 
                        $query2 = new WP_Query('post_type=awe_service&post_status=publish&posts_per_page=-1');
                        $no_service = true;
                        while($query2->have_posts()): $query2->the_post();
                        $logo=get_post_meta(get_the_ID(),'logo',true);
                        $summary=get_post_meta(get_the_ID(),'summary',true);
                    ?>
                            <!-- Service 1 -->
                            <div class="js-content-item <?php hasSlider('service') ?> item">
                            <?php if($logo): if($logo['type'] == 'icon' ) : ?>
                                <i class="awe-icon <?php echo $logo['icon']; ?>"></i>
                            <?php endif;
                                if($logo['type'] == 'image') :
                            ?>
                                <img src="<?php echo $logo['image']; ?>" alt="<?php the_title(); ?>" >
                            <?php endif;// end if logo['type'] == image 
                                endif; // end if logo;
                            ?>
                                <h2><?php the_title(); ?></h2>
                                <?php if($summary) echo "<p>".apply_filters('the_content', $summary)."</p>"; ?>
                            </div>
                    <?php endwhile; wp_reset_query(); ?>    
                        </div>
                    </div>
                </div>
                <?php sectionFooter('service'); ?>
            </div>
        </div>

        <!-- Overlap Black -->
        <?php sectionOverLay('service'); ?>
    </section>
<?php endif; ?>