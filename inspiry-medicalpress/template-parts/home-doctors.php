<?php
global $theme_options;

$default_class = '';
if ($theme_options['doctors_variation'] == '2') {
    $default_class = 'doctors-var-two';
}

?>
<div class="home-doctors <?php echo $default_class; ?> clearfix">

    <div class="container">
        <?php
        if ((!empty($theme_options['home_doctors_title'])) || (!empty($theme_options['home_doctors_description']))) {
            ?>
            <div class="row">
                <div class="<?php bc_all('12'); ?> ">
                    <div class="slogan-section animated fadeInUp clearfix">
                        <?php
                        if (!empty($theme_options['home_doctors_title'])) {
                            echo '<h2>' . $theme_options['home_doctors_title'] . '</h2>';
                        }
                        if (!empty($theme_options['home_doctors_description'])) {
                            echo '<p>' . $theme_options['home_doctors_description'] . '</p>';
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
            $number_of_doctors = 4;
            if ( !empty( $theme_options['home_doctors_count'] ) ) {
                $number_of_doctors = intval( $theme_options['home_doctors_count'] );
            }

            global $post;
            $args = array(
                'post_type' => 'doctor',
                'posts_per_page' => $number_of_doctors,
            );

            // The Query
            $team_query = new WP_Query($args);

            // The Loop
            if ($team_query->have_posts()) {

                $number_of_columns = 4;
                if ( !empty( $theme_options['home_doctors_columns'] ) ) {
                    $number_of_columns = intval( $theme_options['home_doctors_columns'] );
                }

                $loop_counter = 0;
                while ($team_query->have_posts()) {
                    $team_query->the_post();
                    ?>
                    <div class="<?php
                            if( $number_of_columns ==  4 ) {
                                bc( '3', '3', '6', '' );
                            } elseif ( $number_of_columns == 3 ) {
                                bc( '4', '4', '6', '' );
                            } elseif ( $number_of_columns == 2 ) {
                                bc( '', '', '6', '' );
                            } elseif ( $number_of_columns == 1 ) {
                                bc( '', '', '12', '' );
                            }
                            ?>text-center doctor-wrapper">
                        <div class="common-doctor animated fadeInUp clearfix">
                            <?php inspiry_standard_thumbnail('gallery-post-single'); ?>
                            <div class="text-content">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="for-border"></div>
                                <p>
                                <?php
                                $intro_text = get_post_meta($post->ID, 'doctor_intro_text', true);
                                if ( !empty($intro_text) ) {
                                    echo $intro_text;
                                }
                                ?>
                                </p>
                            </div>
                        </div>
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                    </div>
                    <?php
                    $loop_counter++;
                    if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="visible-sm clearfix"></div>
                        <?php
                    }

                    if ( ( $loop_counter % $number_of_columns ) == 0 ) {
                        ?><div class="hidden-sm clearfix"></div><?php
                    }
                }
            } else {
                nothing_found(__('No Doctors found !', 'framework'));
            }

            /* Restore original Post Data */
            wp_reset_query();

            ?>
        </div>

    </div>

</div>