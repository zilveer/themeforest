<?php
/* ------------------------------------------------------------------------*
 * Columns
 * ------------------------------------------------------------------------*/

// columns wrapper
function show_columns($atts, $content = null) {
    return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode('columns', 'show_columns');

// single column
function show_single_column($atts, $content = null) {
    return '<div class="col-lg-12 col-md-12 col-sm-12">'.do_shortcode($content).'</div>';
}
add_shortcode('single_column', 'show_single_column');

// two columns
function show_two_column($atts, $content = null) {
    return '<div class="col-lg-6 col-md-6 col-sm-6">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'show_two_column');

// three columns OR one third
function show_one_third($atts, $content = null) {
    return '<div class="col-lg-4 col-md-4 col-sm-4">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'show_one_third');
// Two Third
function show_two_third($atts, $content = null) {
    return '<div class="col-lg-8 col-md-8 col-sm-8">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'show_two_third');

// four columns
function show_one_fourth($atts, $content = null) {
    return '<div class="col-lg-3 col-md-3 col-sm-3">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'show_one_fourth');

// six columns
function show_one_sixth($atts, $content = null) {
    return '<div class="col-lg-2 col-md-2 col-sm-2">'.do_shortcode($content).'</div>';
}
add_shortcode('one_sixth', 'show_one_sixth');

// three columns
function show_three_fourth($atts, $content = null) {
    return '<div class="col-lg-9 col-md-9 col-sm-9">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'show_three_fourth');


/* ------------------------------------------------------------------------*
 * Messages Shortcode
 * ------------------------------------------------------------------------*/

// Information
function show_info($atts, $content = null) {
    return '<p class="message bg-info text-info">'.do_shortcode($content).'<button type="button" class="close" aria-hidden="true">&times;</button></p>';
}
add_shortcode('info', 'show_info');

// Tip
function show_tip($atts, $content = null) {
    return '<p class="message bg-warning text-warning">'.do_shortcode($content).'<button type="button" class="close" aria-hidden="true">&times;</button></p>';
}
add_shortcode('tip', 'show_tip');

// Error
function show_error($atts, $content = null) {
    return '<p class="message bg-danger text-danger">'.do_shortcode($content).'<button type="button" class="close" aria-hidden="true">&times;</button></p>';
}
add_shortcode('error', 'show_error');

// Success
function show_success($atts, $content = null) {
    return '<p class="message bg-success text-success">'.do_shortcode($content).'<button type="button" class="close" aria-hidden="true">&times;</button></p>';
}
add_shortcode('success', 'show_success');


/* ------------------------------------------------------------------------*
 * Lists
 * ------------------------------------------------------------------------*/
// Arrow list one
if (!function_exists('arrow_list_one')) {
    function arrow_list_one($atts, $content = null)
    {
        return '<div class="arrow-list-one">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('arrow_list_one', 'arrow_list_one');

// Arrow list two
if (!function_exists('arrow_list_two')) {
    function arrow_list_two($atts, $content = null)
    {
        return '<div class="arrow-list-two">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('arrow_list_two', 'arrow_list_two');

// Arrow list Three
if (!function_exists('arrow_list_three')) {
    function arrow_list_three($atts, $content = null)
    {
        return '<div class="arrow-list-three">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('arrow_list_three', 'arrow_list_three');


/* ------------------------------------------------------------------------*
 * Buttons
 * ------------------------------------------------------------------------*/

// Default Button
if (!function_exists('default_button')) {
    function default_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));
        return '<a class="read-more" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('default_button', 'default_button');

// black Button
if (!function_exists('black_button')) {
    function black_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="read-more black" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('black_button', 'black_button');


// Red button
if (!function_exists('red_button')) {
    function red_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="read-more red" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('red_button', 'red_button');

// Orange button
if (!function_exists('orange_button')) {
    function orange_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="read-more orange" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('orange_button', 'orange_button');

// Yellow button
if (!function_exists('yellow_button')) {
    function yellow_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="read-more yellow" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('yellow_button', 'yellow_button');

// Green button
if (!function_exists('green_button')) {
    function green_button($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'link' => '#',
            'target' => ''
        ), $atts));

        return '<a class="read-more green" href="' . $link . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
    }
}
add_shortcode('green_button', 'green_button');


/* ------------------------------------------------------------------------*
 * Tabs
 * ------------------------------------------------------------------------*/
if (!function_exists('show_tabs')) {
    function show_tabs($atts, $content = null)
    {
        extract(shortcode_atts(array(
            "titles" => '',
        ), $atts));
        $all_title = explode(',', $titles);
        $html = '<ul class="tabs-nav clearfix">';
        foreach ($all_title as $title) {
            $html .= '<li>' . $title . '</li>';
        }
        $html .= '</ul><div class="tabs-container">' . do_shortcode($content) . '</div>';
        return $html;
    }
}
add_shortcode('tabs', 'show_tabs');

if (!function_exists('show_tab_pane')) {
    function show_tab_pane($atts, $content = null)
    {

        return '<div class="tab-content">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('tab_pane', 'show_tab_pane');


/* ------------------------------------------------------------------------*
 * Accordion Shortcode
 * ------------------------------------------------------------------------*/
if (!function_exists('show_accor_wrap')) {
    function show_accor_wrap($atts, $content = null)
    {
        return '  <div class="accordion-main var-two">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('accordion', 'show_accor_wrap');

if (!function_exists('show_accor_block')) {
    function show_accor_block($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));

        return '<div class="accordion"><div class="accordion-title"><h3>' . $title . '<i class="fa fa-plus"></i></h3></div><div class="accordion-content" ><p>' . do_shortcode($content) . '</p></div></div>';
    }
}
add_shortcode('accor_block', 'show_accor_block');


/* ------------------------------------------------------------------------*
 * Toggles Shortcode
 * ------------------------------------------------------------------------*/
if (!function_exists('show_toggle_wrap')) {
    function show_toggle_wrap($atts, $content = null){
        return '<div class="toggle-main">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('toggles', 'show_toggle_wrap');

if (!function_exists('show_toggle_block')) {
    function show_toggle_block($atts, $content = null){
        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));

        return '<div class="toggle"><div class="toggle-title"><h3>' . $title . '<i class="fa fa-plus"></i></h3></div><div class="toggle-content" ><p>' . do_shortcode($content) . '</p></div></div>';
    }
}
add_shortcode('toggle_block', 'show_toggle_block');

if (!function_exists('show_appointment_form')) {
    function show_appointment_form($atts, $content = null){
        global $theme_options;

        /* check if appointment form related theme options are properly configured, as there is no point in displaying an incomplete form */
        if (!empty($theme_options['appointment_form_email'])) {
            ob_start();
            ?>
            <div class="appoint-var-three clearfix">
                <div class="<?php bc('12','12','12',''); ?>">
                    <div class="appointment-form clearfix appointment-shortcode">
                        <form class="row" id="appointment_form_three" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
                            <div class="<?php bc_all('6'); ?>">
                                <input type="text" name="name" id="app-name" class="required" placeholder="<?php _e('Name', 'framework'); ?>" title="<?php _e('* Please provide your name', 'framework'); ?>"/>
                            </div>
                            <div class=" <?php bc_all('6'); ?>">
                                <input type="text" name="number" id="app-number" placeholder="<?php _e('Phone Number', 'framework'); ?>" title="<?php _e('* Please provide a valid phone number.', 'framework'); ?>"/>
                            </div>

                            <div class=" <?php bc_all('6'); ?>">
                                <input type="email" name="email" id="app-email" class="required email" placeholder="<?php _e('Email Address', 'framework'); ?>" title="<?php _e('* Please provide a valid email address', 'framework'); ?>"/>
                            </div>
                            <div class=" <?php bc_all('6'); ?>">
                                <input type="text" name="date" id="datepicker" placeholder="<?php _e('Appointment Date', 'framework'); ?>" title="<?php _e('* Please provide appointment date', 'framework'); ?>">
                            </div>

                            <div class=" <?php bc_all('12'); ?>">
                                <textarea name="message" id="app-message" class="required" cols="50" rows="1" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>
                            </div>

                            <?php
                            if( $theme_options['display_appointment_recaptcha'] ){
                                output_recaptcha_js();
                                ?>
                                <div class="col-sm-6">
                                    <input type="hidden" name="recaptcha" value="true" />
                                    <?php
                                    /* Display recaptcha if enabled and configured from theme options */
                                    get_template_part('recaptcha/custom-recaptcha');
                                    ?>
                                </div>
                                <?php
                            }
                            ?>

                            <div class=" <?php bc_all('12'); ?>">
                                <input type="submit" name="Submit" class="btn" value="<?php _e('SEND', 'framework'); ?>"/>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" id="appointment-loader" alt="<?php _e('Loading...', 'framework'); ?>">
                                <input type="hidden" name="action" value="make_appointment" />
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('request_appointment_nonce'); ?>" />
                                <div id="message-sent"></div>
                                <div id="error-container"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        return ob_get_clean();
    }

    add_shortcode('appointment_form', 'show_appointment_form');
}

if (!function_exists('show_doctors')) {
    function show_doctors($atts, $content = null){
        extract(shortcode_atts(array(
            'number_of_columns' => 4,
            'number_of_doctors' => 4
        ), $atts));

        global $theme_options;

        ob_start();
        ?>
            <div class="row doctors-shortcode">
                <?php

                global $post;
                $args = array(
                    'post_type' => 'doctor',
                    'posts_per_page' => $number_of_doctors,
                );

                // The Query
                $team_query = new WP_Query($args);

                // The Loop
                if ($team_query->have_posts()) {

                    $loop_counter = 0;
                    $hidden_sm = false;

                    while ($team_query->have_posts()) {
                        $team_query->the_post();

                        if( $hidden_sm ) {
                            ?><div class="hidden-sm clearfix"></div><?php
                            $hidden_sm = false;
                        }

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
                        ?> text-center doctor-wrapper">
                            <div class="common-doctor clearfix">
                                <?php inspiry_standard_thumbnail('gallery-post-single'); ?>
                                <div class="text-content">
                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <div class="for-border"></div>
                                    <p>
                                        <?php
                                        $intro_text = get_post_meta($post->ID, 'doctor_intro_text', true);
                                        if ( !empty($intro_text) ) {
                                            echo esc_attr($intro_text);
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
                            $hidden_sm = true;
                        }
                    }
                } else {
                    nothing_found(__('No Doctors found !', 'framework'));
                }

                /* Restore original Post Data */
                wp_reset_query();

                ?>
            </div>
    <?php
        return ob_get_clean();
    }

    add_shortcode('home_doctors', 'show_doctors');
}

if (!function_exists('show_news')) {
    function show_news($atts, $content = null){
        extract(shortcode_atts(array(
            'number_of_posts' => 4
        ), $atts));

        global $theme_options;

        ob_start();

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $number_of_posts,
            'ignore_sticky_posts' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio'),
                    'operator' => 'NOT IN'
                )
            ),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => 'MEDICAL_META_embed_code',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => 'MEDICAL_META_gallery',
                    'compare' => 'EXISTS'
                )
            )
        );

        // The Query
        $blog_query = new WP_Query($args);

        // The Loop
        if ($blog_query->have_posts()) {
            $number_of_news = 3;
            if( !empty( $theme_options['home_news_count'] ) ) {
                $number_of_news = intval( $theme_options['home_news_count'] );
            }
            ?>
            <div class="row news-shortcode">
                <?php
                $loop_counter = 0;
                $hidden_sm = false;
                while ($blog_query->have_posts()) {
                    $blog_query->the_post();
                    global $post;
                    $format = get_post_format($post->ID);
                    if (false === $format) {
                        $format = 'standard';
                    }

                    if( $hidden_sm ) {
                        ?><div class="hidden-sm clearfix"></div><?php
                        $hidden_sm = false;
                    }

                    ?>
                    <div class="<?php
                    if( $number_of_news ==  4 ) {
                        bc( '3', '3', '6', '' );
                    } elseif ( $number_of_news == 3 ) {
                        bc( '4', '4', '6', '' );
                    } elseif ( $number_of_news == 2 ) {
                        bc( '', '', '6', '' );
                    } elseif ( $number_of_news == 1 ) {
                        bc( '', '', '12', '' );
                    }
                    // bc('4', '4', '12', '');
                    ?>">
                        <article class="common-blog-post hentry clearfix">
                            <?php get_template_part("post-formats/grid/$format"); ?>
                            <div class="text-content clearfix">
                                <h5 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
                                <div class="entry-meta">
                                    <time class="published updated" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'j F, Y' ); ?></time>,
                                        <span class="entry-author vcard">
                                            <?php _e('by','framework'); ?>
                                            <?php
                                            printf( '<a class="url fn" href="%1$s" title="%2$s" rel="author">%3$s</a>',
                                                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                esc_attr( sprintf( __( 'View all posts by %s', 'framework' ), get_the_author() ) ),
                                                get_the_author()
                                            );
                                            ?>
                                        </span>
                                </div>
                                <div class="for-border"></div>
                                <p><?php inspiry_excerpt(20); ?> </p>
                            </div>
                        </article>
                        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                    </div>
                    <?php
                    $loop_counter++;
                    if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="visible-sm clearfix"></div>
                        <?php
                    }

                    if ( ( $loop_counter % $number_of_news ) == 0 ) {
                        $hidden_sm = true;
                    }
                }
                ?>
            </div>
            <?php
        } else {
            nothing_found( _e('No post found !','framework') );
        }
        /* Restore original Post Data */
        wp_reset_query();

        return ob_get_clean();
    }

    add_shortcode('home_news', 'show_news');
}
?>