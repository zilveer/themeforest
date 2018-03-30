<?php
global $theme_options;
$slides = $theme_options['slides'];
$slider_button_text = $theme_options['slider_button_text'];
if( empty($slider_button_text) ){
    $slider_button_text = __('Read More', 'framework');
}

if (!empty($slides)) {
    ?>
    <div class="home-slider clearfix">
        <div class="flexslider loading">
            <ul class="slides">
                <?php
                foreach ($slides as $slide) {
                    ?>
                    <li>
                        <img src="<?php echo $slide['image']; ?>" class="gallery-post-single" alt="<?php echo $slide['title']; ?>"/>
                        <?php
                        if ( !empty( $slide['title'] ) || !empty( $slide['description'] ) || !empty( $slide['url'] ) ) {
                            ?>
                            <div class="content-wrapper clearfix">
                                <div class="container">
                                    <div class="slide-content clearfix <?php if ($theme_options['display_slider_text_bg'] == '1') { echo 'display-bg'; }?>">
                                        <?php
                                        if ( !empty( $slide['title'] ) ) {
                                            ?>
                                            <h1><?php echo $slide['title']; ?></h1>
                                            <?php
                                        }

                                        if ( !empty( $slide['description'] ) ) {
                                            ?>
                                            <p><?php echo $slide['description']; ?></p>
                                            <?php
                                        }

                                        if (!empty($slide['url'])) {
                                            ?>
                                            <a class="btn" href="<?php echo $slide['url']; ?>"><?php echo esc_html($slider_button_text); ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        if (($theme_options['display_appointment_form'] == '1') && (($theme_options['appointment_form_variation'] == '1') || ($theme_options['appointment_form_variation'] == '2'))) {
            get_template_part('template-parts/home-slider-form');
        }
        ?>
    </div>
<?php
} else {
    get_template_part('template-parts/banner');
}
?>