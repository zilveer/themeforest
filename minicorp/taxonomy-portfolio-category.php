<?php

get_header();

$current_term = get_queried_object();

//<!-- Lead part section -->
$lead = '<div class="category-lead portfolio-category-lead">';
$lead .= '<h1 class="color1">' . __( 'Category: ', 'ishyoboy' ) . $current_term->name . '</h1>';
$lead .= ('' != $current_term->description ) ? do_shortcode($current_term->description) : '';
$lead .= '</div>';
ishyoboy_custom_lead($lead);
//<!-- Lead part section -->

?>

<!-- Content part section -->
<section class="part-content">
    <div class="row">
        <div class="<?php echo ishyoboy_get_content_class(); ?>">
        <?php

        $current_term = get_queried_object();

        if ( !empty($current_term) ){

            // Breadcrumbs display
            ishyoboy_show_breadcrumbs();
            echo '<div class="space"></div>';
            echo apply_filters('the_content', '[portfolio category="' . esc_attr($current_term->slug) . '"]');
            echo '<div class="space"></div>';
        }

        ?>

        </div>

        <?php
        // SIDEBAR
        get_sidebar();
        ?>

    </div>
</section>
<!-- Content part section END -->

<!-- #content  END -->
<?php  get_footer(); ?>