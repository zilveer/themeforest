<?php
global $theme_options;
?>
<div class="features-var-three clearfix">
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
            $variation_3_features = $theme_options['variation_3_features'];
            if (!empty($variation_3_features)) {
                $loop_counter = 0;
                foreach ($variation_3_features as $feature) {
                    ?>
                    <section class="single-feature clearfix <?php bc('4', '4', '6', ''); ?>">
                        <div class="row">
                            <div class="<?php bc('3', '3', '3', ''); ?> text-center feature-icon">
                                <img src="<?php echo $feature['image'] ?>" alt=""/>
                            </div>
                            <div class="<?php bc('9', '9', '9', ''); ?>">
                                <h5><a href="<?php echo $feature['url'] ?>"><?php echo $feature['title']; ?></a></h5>
                                <p><?php echo $feature['description']; ?></p>
                            </div>
                        </div>
                    </section>
                <?php
                    $loop_counter++;
                    if( ($loop_counter % 3) == 0 ){
                        ?>
                        <div class="visible-lg clearfix"></div>
                        <div class="visible-md clearfix"></div>
                    <?php
                    } else if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="visible-sm clearfix"></div>
                    <?php
                    }
                }
            }
            ?>
        </div>

    </div>
</div>

