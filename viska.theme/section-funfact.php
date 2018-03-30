<!-- Funfacts -->
<?php
    global $customize,$is_customize_mode;
    if($customize['funfact']['show'] || $is_customize_mode): 
?>
    <section id="funfacts" class="awe-section funfacts" <?php display_background_css('funfact'); ?>>
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">

                <!-- List Funfact -->
                <div class="awe-content">
                    <div class="awe-funfacts clearfix">
                    
                    <?php 
                    global $customize;
                    $funfacts = get_post_meta($customize['aboutus'],'funfacts',true);
                    $i=1;
                    if(is_array($funfacts)):
                        foreach ($funfacts as $value) {
                            echo '<div class="col-ms-12 col-xs-6 col-md-3">';
                            if($i%2==0)
                            echo '<div class="item color-white">';
                            else 
                            echo '<div class="item">';
                            echo '<p>';
                            echo '<span class="countup">'.$value['total'].'</span>';
                            echo '<span class="plus">+</span>';
                            echo '</p>';
                            echo '<h3>'.$value['name'].'</h3>';
                            echo '</div>';
                            echo '</div>';
                            $i++;
                        }
                    endif;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>