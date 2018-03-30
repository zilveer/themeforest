<?php
/*
 *  Template Name: Home Template
 */

global $theme_options;

/* Include Header */
get_header();

/* Slider */
if ($theme_options['display_slider_on_home'] == '1') {
    if($theme_options['slider_type'] == '2'){
        $revolution_slider_alias = $theme_options['revolution_slider_alias'];
        if( function_exists('putRevSlider') && (!empty($revolution_slider_alias)) ){
            putRevSlider( $revolution_slider_alias );
        } else {
            get_template_part('template-parts/banner');
        }
    }else{
        get_template_part('template-parts/home-slider');
    }
} else {
    get_template_part('template-parts/banner');
}

/* Appointment Form - As separate section below slider */
if (($theme_options['display_appointment_form'] == '1') && ($theme_options['appointment_form_variation'] == '3')) {
    get_template_part('template-parts/appoint-form');
}

/* Homepage Layout Manager */
$enabled_sections = $theme_options['home_sections']['enabled'];

if ( $enabled_sections ) {
    foreach ($enabled_sections as $key => $val  ) {

        switch( $key ) {

            /* Home page contents from page editor */
            case 'content':
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        $content = get_the_content();
                        if (!empty($content)) {
                            ?>
                            <div class="default-contents">
                                <div class="container">
                                    <div class="row">
                                        <div class="<?php bc_all('12'); ?>">
                                            <article <?php post_class(); ?>>
                                                <div class="entry-content">
                                                    <?php
                                                    /* output page contents */
                                                    the_content();
                                                    ?>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    endwhile;
                endif;
                break;

            /* Features Section */
            case 'features':
                if( $theme_options['features_variation'] == '1'){
                    get_template_part('template-parts/home-features-one');
                }elseif( $theme_options['features_variation'] == '2'){
                    get_template_part('template-parts/home-features-two');
                }elseif( $theme_options['features_variation'] == '3'){
                    get_template_part('template-parts/home-features-three');
                }
                break;

            /* Doctors Section */
            case 'doctors':
                get_template_part('template-parts/home-doctors');
                break;

            /* Services Section */
            case 'services':
                get_template_part('template-parts/home-services');
                break;

            /* News Section */
            case 'news':
                get_template_part('template-parts/home-blog');
                break;

            /* Testimonials Section */
            case 'testimonials':
                get_template_part('template-parts/home-testimonial');
                break;

        }

    }
}

/* Include Footer */
get_footer();
?>