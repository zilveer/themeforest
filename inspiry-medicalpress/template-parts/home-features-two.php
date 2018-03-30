<?php
global $theme_options;
?>
<div class="features-var-two clearfix">
    <div class="container">
        <?php
        if ( !empty($theme_options['home_features_title']) || !empty($theme_options['home_features_description']) ) {
            ?>
            <div class="row">
                <div class="<?php bc_all('12'); ?> ">
                    <div class="slogan-section clearfix">
                        <?php
                        if( !empty($theme_options['home_features_title']) ){
                            echo '<h2>' . $theme_options['home_features_title'] . '</h2>';
                        }

                        if( !empty($theme_options['home_features_description']) ){
                            echo '<p>' . $theme_options['home_features_description'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="row">
            <?php
            $variation_2_features = $theme_options['variation_2_features'];
            if (!empty($variation_2_features)) {
                $loop_counter = 0;
                foreach ($variation_2_features as $feature) {
                    ?>
                    <section class="single-feature text-center clearfix <?php bc('4', '4', '4', ''); ?>">
                        <?php
                        if( !empty($feature['url']) ) {
                            echo '<a href="'.$feature['url'].'">';
                            echo '<img src="'. $feature['image'] .'" alt="'.$feature['title'].'"/>';
                            echo '</a>';
                        }else{
                            echo '<img src="'. $feature['image'] .'" alt="'.$feature['title'].'"/>';
                        }
                        ?>
                        <h3>
                            <?php
                            if( !empty($feature['url']) ) {
                                echo '<a href="'.$feature['url'].'">';
                                echo $feature['title'];
                                echo '</a>';
                            }else{
                                echo $feature['title'];
                            }
                            ?>
                        </h3>
                        <div class="feature-border"></div>
                        <p><?php echo $feature['description']; ?></p>
                    </section>
                <?php
                    $loop_counter++;
                    if( ($loop_counter % 3) == 0 ){
                        ?>
                        <div class="visible-lg clearfix"></div>
                        <div class="visible-md clearfix"></div>
                        <div class="visible-sm clearfix"></div>
                    <?php
                    }
                }
            }
            ?>
        </div>

    </div>
</div>

