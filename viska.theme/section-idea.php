<!-- Our Process -->
<?php
    global $customize,$is_customize_mode;
    if($customize['idea']['show'] || $is_customize_mode): 
?>
    <section id="process" class="awe-section process" <?php display_background_css('idea'); ?>>
        <div class="container">
            <div class="row">   
                <?php displayHeader('idea'); ?>
                <div class="awe-content js-awe-get-items">
                    <!-- Process List -->
                    <div class="js-content-slider awe-process <?php contentSlider('idea') ?> clearfix" <?php sliderCols('idea'); ?> >
                        <!-- Process Item -->
                    <?php 
                    global $customize;
                    $args = array(
                        'post_type'         =>  'awe_aboutus',
                        'posts_per_page'    =>  '-1',
                        'id' => $customize['aboutus'],
                    );
                    $idea = new WP_Query($args); 
                    while($idea->have_posts()) : $idea->the_post();
                    $post_meta = get_post_meta($post->ID,'features',true);
                    $i=0.4;$j=1;
                    if(is_array($post_meta)){
                        foreach ($post_meta as $value) { ?>
                            <div class="js-content-item <?php hasSlider('idea') ?> wow <?php animationContent('idea'); ?> <?php if($j%2==0) echo 'odd'; else echo 'even';  ?> <?php if($value['logo_type'] == 'image'): ?>logo-image<?php endif; ?>" data-wow-delay="<?php echo $i; ?>s">
                                <div class="item" >
                                    <?php
                                    switch($value['logo_type'])
                                    {
                                        case 'icon':
                                            echo "<i class=\"awe-icon {$value['logo_icon']}\"></i>";
                                            break;
                                        case 'image':
                                            echo "<div class=\"awe-image\"><img src=\"{$value['logo_img']}\"></div>";
                                            break;
                                        case 'none':
                                            break;
                                    }
                                    ?>

                                    <span class="hr"></span>
                                    <h2><?php echo $value['title']; ?></h2>
                                    <p><?php echo $value['desc']; ?></p>
                                </div>
                            </div>
                        <?php $i = $i + 0.2;$j++; }
                    }
                    endwhile; wp_reset_query();
                    ?>
                    </div>
                </div>

            </div>

            <?php sectionFooter('idea'); ?>
        </div>
         <!-- Overlap Black -->
        <?php sectionOverLay('idea'); ?>
    </section>
<?php endif; ?>