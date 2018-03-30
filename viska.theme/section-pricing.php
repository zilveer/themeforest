<!-- Our Plans -->
<?php
    global $customize,$is_customize_mode;
    if($customize['pricing']['show'] || $is_customize_mode): 
?>
    <section id="plans" class="awe-section plans" <?php display_background_css('pricing'); ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('pricing'); ?>
                <div class="clear"></div>

                <div class="awe-content">

                    <!--  AweTheme Pricing -->
                    <div class="awe-pricing js-content-slider js-awe-get-items <?php contentSlider('pricing') ?>" <?php sliderCols('pricing') ?>>
                        <!-- Item -->
                        <?php
                            
                            $id = $customize['pricing']['display'];
                            if($id!= '') {
                            $args = array('post_type'=>'awe_pricing_table','p'=>$id,'posts_per_page'=>'-1');
                            $pricing = new WP_Query($args);
                            $time = 0.3;
                            while($pricing->have_posts()) : $pricing->the_post();
                            $post_meta_data = get_post_meta($post->ID,'pricing',true);
                            $post_meta_data = json_decode($post_meta_data,true);
                            if(is_array($post_meta_data)) :

                            foreach ($post_meta_data as $value) {
                            
                        ?>
                            <div class="js-content-item <?php hasSlider('pricing') ?> wow <?php animationContent('pricing'); ?> " data-wow-delay="<?php echo $time; ?>s" data-animate="<?php animationContent('pricing'); ?>">
                                <div class="item">
                                <?php if(isset($value['title'])) : ?>
                                    <span class="package"><?php echo $value['title']; ?></span>
                                    <?php endif; ?>
                                <?php if(isset($value['price'])) : ?>
                                    <div class="price">
                                        <p>
                                            <?php echo $value['price']; ?>
                                            <span class="currency"><?php if(isset($value['currency'])) echo $value['currency'] ?></span>
                                            <span class="month"> / <?php if(isset($value['time'])) echo $value['time']; ?></span>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($value['offers'])) : ?>
                                    <ul>
                                    <?php 
                                        foreach ($value['offers'] as $val) {
                                            echo '<li>'.$val.'</li>';
                                        }
                                    ?>
                                    </ul>
                                <?php endif; ?>
                                    <div class="sign-up">
                                        <a href="<?php echo $value['url'] ?>" class="sign-up" title="<?php echo $customize['pricing']['button']['label'] ?>"><?php echo $customize['pricing']['button']['label'] ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php $time = $time + 0.5; } // end foreach post_meta
                            endif; 

                            endwhile;
                            wp_reset_query();
                            }else{
                                echo '<div class="no-item">
                                        <h3>[Please choose pricing post]</h3>
                                    </div>';
                            }
                        ?>
                            <!-- End Item -->
                    </div>
                </div>
            </div>
            <?php sectionFooter('pricing'); ?>
        </div>
        <?php sectionOverLay('pricing'); ?>
    </section>
<?php endif; ?>