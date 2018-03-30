<!-- Our Client -->
<?php
    global $customize,$is_customize_mode;
    if($customize['client']['show'] || $is_customize_mode): 
?>
    <section id="client" class="awe-section client" <?php display_background_css('client'); ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('client'); ?>
                <div class="clear"></div>
                
                <!-- AweTheme Clients -->
                <div class="awe-content " >
                    <div class="awe-clients js-awe-get-items js-content-slider <?php contentSlider('client') ?>" <?php sliderCols('client'); ?>>
                        
                        <!-- Client 1 -->
                        <?php 
                        $query3 = new WP_Query('post_type=awe_client&posts_per_page=-1');
                        $no_client = true;
                        $count =0;
                        while ( $query3->have_posts() ) : $query3->the_post();?>
                        <?php
                            $no_client = false;
                            $count += 0.4;
                            $info=get_post_meta(get_the_ID(),'client',true);
                            //var_dump($info);
                        ?>
                        <div class="js-content-item <?php hasSlider('client') ?> <?php clientItem(); ?> <?php animationContent('client'); ?> wow" data-wow-duration="0.8s" data-animate="<?php animationContent('client'); ?>">
                            <a href="<?php echo $info['url']; ?>">
                                <img src="<?php echo $info['logo']; ?>" alt="<?php the_title(); ?>">
                            </a>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>
                    </div>
                </div>
            </div>
            <?php sectionFooter('client'); ?>
        </div>
        <?php sectionOverLay('client'); ?>
    </section>
<?php endif; ?>