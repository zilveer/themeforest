    <!-- Contact -->
<?php
    global $customize,$is_customize_mode;
    if($customize['address']['show'] || $is_customize_mode): 
?>
    <section id="contact" class="awe-section contact" <?php display_background_css('address') ?>>
        <div class="container">
            <div class="row">
                <?php displayHeader('address'); ?>


                <div class="awe-content js-awe-get-items">
                    <div class="awe-contact clearfix">
                        <div class="col-sm-4 wow <?php animationContent('address') ?>" data-wow-delay="0.3s" data-animate="<?php animationContent('address'); ?>">
                            <div class="contact-info">
                                <h2 class="js-studio"><?php echo $customize['address']['content']['studio']; ?></h2>
                                <div>
                                    <i class="awe-icon fa fa-map-marker"></i>
                                    <p class="js-address">
                                        <?php echo $customize['address']['content']['address']; ?>
                                    </p>
                                </div>
                                <div>
                                    <i class="awe-icon fa fa-envelope"></i>
                                    <p>
                                        <b class="js-email"><a href="mailto:<?php echo $customize['address']['content']['email'] ?>"> <?php echo $customize['address']['content']['email'] ?></a></b>
                                    </p>
                                </div>
                                <div>
                                    <i class="awe-icon fa fa-phone"></i>
                                    <p>
                                        <b class="js-phone"><?php echo $customize['address']['content']['phone'] ?></b>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8 contact-item">
                            <div class="row">
                                <div class="contact-form wow fadeInUp" data-wow-delay="0.5s">
                                    <!-- <form id="contact-form" action="processForm.php" method="post"> -->
                                    <?php
                                    if(function_exists('wpcf7')){ 
                                        if(!empty($customize['contact']['form'])){
                                            $contact_form = get_post($customize['contact']['form']);
                                        echo do_shortcode('[contact-form-7 id="'.$contact_form->ID.'" title="'.$contact_form->post_title.'"]');
                                        }else{ ?>
                                            <div class="no-item">
                                                <h3>[<?php _e("Please choose contact form",LANGUAGE);?>]</h3>
                                            </div>
                                    <?php    }
                                    ?>
                                    <!-- </form> -->
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="no-item">
                                <h3>[<?php _e("Please Active Contact Form 7",LANGUAGE);?>]</h3>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>