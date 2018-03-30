<?php
global $theme_options;

if ($theme_options['testimonials_variation'] == '2') {
    $testimonial_var = 'testimonial-var-two';
    ?><div class="testimonial-push-down"></div><?php
} else {
    $testimonial_var = "";
}

?>
<div class="home-testimonial <?php echo $testimonial_var; ?> clearfix">
    <div class="container">
        <div class="row">
            <?php
            if (($theme_options['testimonials_variation'] == '1') && ((!empty($theme_options['home_testimonials_title'])) || (!empty($theme_options['home_testimonials_description'])))) {
                ?>
                <div class="<?php bc_all('12'); ?> text-center">
                    <div class="slogan-section animated fadeInUp clearfix">
                        <?php
                        if (!empty($theme_options['home_testimonials_title'])) {
                            echo '<h2>' . $theme_options['home_testimonials_title'] . '</h2>';
                        }
                        if (!empty($theme_options['home_testimonials_description'])) {
                            echo '<p>' . $theme_options['home_testimonials_description'] . '</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="<?php bc_all('10'); ?> col-lg-offset-1 col-md-offset-1 col-sm-offset-1 text-center">
                <div class="flexslider-three animated fadeInUp">
                    <ul class="slides">
                        <?php
                        global $post;
                        $testimonial_args = array(
                            'post_type' => 'testimonial',
                            'posts_per_page' => -1,
                        );

                        // The Query
                        $testimonial_query = new WP_Query($testimonial_args);

                        // The Loop
                        if ($testimonial_query->have_posts()) {
                            while ($testimonial_query->have_posts()) {
                                $testimonial_query->the_post();
                                ?>
                                <li>
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'testimonial-thumb', array( 'class' => "img-circle" ) );
                                    } else {
                                        echo '<img class="img-circle wp-post-image" src="'.get_template_directory_uri().'/images/testimonial-avatar.png" alt=""/>';
                                    }
                                    ?>
                                    <blockquote>
                                        <p><?php echo get_post_meta($post->ID,'the_testimonial',true); ?></p>
                                    </blockquote>

                                    <div class="testimonial-footer clearfix">
                                        <h3><?php echo get_post_meta($post->ID,'testimonial_author',true); ?></h3>
                                        <div class="for-border"></div>
                                        <?php
                                        $testimonial_author_link = get_post_meta( $post->ID, 'testimonial_author_link', true );
                                        $testimonial_author_organization = get_post_meta( $post->ID, 'testimonial_author_organization', true );
                                        if ( !empty($testimonial_author_link) && !empty($testimonial_author_organization) ) {
                                            ?>
                                            <p><a target="_blank" href="<?php echo $testimonial_author_link; ?>"><?php echo $testimonial_author_organization; ?></a></p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                            <?php
                            }
                        } else {
                            echo '<li>';
                            _e('No testimonial found !', 'framework');
                            echo '</li>';
                        }

                        /* Restore original Post Data */
                        wp_reset_query();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>