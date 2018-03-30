<?php

/*
 * Get header.php
 */
get_header();

?>

<?php

if (is_category()){
    $current_term = get_queried_object();
    $lead = '<div class="category-lead post-category-lead">';
    $lead .= '<h1 class="color1">' . $current_term->name . '</h1>';
    $lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
    $lead .= '</div>';
    ishyoboy_custom_lead($lead);
}
elseif (is_tag()){
    $current_term = get_queried_object();
    $lead = '<div class="tag-lead post-tag-lead">';
    $lead .= '<h1 class="color1">' . $current_term->name . '</h1>';
    $lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
    $lead .= '</div>';
    ishyoboy_custom_lead($lead);
}
elseif (is_archive()){
    $lead = '<div class="archive-lead post-archive-lead"><h1 class="color1">';
    if ( is_day() ) :
        $lead .= sprintf( __( 'Daily Archives: %s', 'ishyoboy' ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() ) :
        $lead .= sprintf( __( 'Monthly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ishyoboy' ) ) . '</span>' );
    elseif ( is_year() ) :
        $lead .= sprintf( __( 'Yearly Archives: %s', 'ishyoboy' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ishyoboy' ) ) . '</span>' );
    else :
        $lead .= __( 'Archives', 'ishyoboy' );
    endif;
    $lead .= '</h1>';
    ishyoboy_custom_lead($lead);
}
else{
    ishyoboy_get_lead(get_the_ID());
}
?>

<!-- Content part section -->
<section class="part-content">
    <div class="row">

        <div class="<?php echo ishyoboy_get_content_class(); ?>">
            <?php
            // Breadcrumbs display
            ishyoboy_show_breadcrumbs();

            if (have_posts()) {

                while (have_posts()) {

                    the_post();

                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'content-post', $format );

                }

                echo '<div class="space"></div>';

                if(empty($paged) || 0 == $paged) $paged = 1;

                $pg = ishyoboy_get_pagination('', 3, $wp_query->max_num_pages, $paged);
                if ('' != $pg){
                    echo $pg, '<div class="space"></div>';
                }


            } else {  ?>

                <div id="post-0" <?php post_class(); ?>>

                    <h2 class="entry-title"><?php _e('Error 404 - Page Not Found', 'ishyoboy') ?></h2>

                    <div class="entry-content">
                        <p><?php _e("Sorry, the content you are looking for could not be found.", 'ishyoboy') ?></p>
                    </div>

                </div>

            <?php } ?>

        </div>

        <?php
        // SIDEBAR
        get_sidebar();
        ?>

    </div>
</section>
<!-- Content part section END -->

<?php

/*
 * Get footer.php
 */
get_footer();

?>