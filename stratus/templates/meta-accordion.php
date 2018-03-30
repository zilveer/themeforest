<?php
global $i_panel_count; // To support muultiple accordion meta boxes.
//======================================================================
// Accordion Template Part
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'accordion';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Accordion
//-----------------------------------------------------
if ($show == 1) {

    // return custom post type args for WP Query
    $args = themo_return_cpt_args($post->ID,$key,'themo_accordion','themo_cpt_group');

    // WP Query
    $loop = new WP_Query($args);

    // Open The Loop
    if ($loop->have_posts()) {
        $random_number = rand(1, 99); // Needs random number to support muultiple accordion meta boxes.
        echo '<div class="row">' .
            '<div class="col-md-12">' .
            '<div class="panel-group" id="accordion' . $random_number . '">';
        if (!isset($i_panel_count) && !$i_panel_count > 0) {
            $i_panel_count = 1;
        }

        while ($loop->have_posts()) {
            $loop->the_post();
            $metadata = get_post_meta($post->ID);

            $panel_count = themo_convertNumber($i_panel_count);
            $panel_count = ucwords(strtolower($panel_count));
            if ($i_panel_count == 1) {
                $first = "in";
            } else {
                $first = "";
            }

            // Return Icon Markup
            $glyphicon_markup = themo_do_glyphicons_markup($metadata,null,'_',true);

            // Return Button Markup
            $button_markup = "";
            $button = themo_do_shortocde_button($post->ID, '_', true);
            $button2 = themo_do_shortocde_button($post->ID, '_', true,false,2);

            if ($button > "" || $button2) {
                $button_markup = '<div class="accordion-btn">' . do_shortcode($button) . do_shortcode($button2) .'</div>';
            }


            echo '<div class="panel panel-default">' .
                '<div class="panel-heading">' .
                '<h4 class="panel-title">' .
                '<a data-toggle="collapse" data-parent="#accordion' . $random_number . '" href="#collapse' . $panel_count . '" class="accordion-toggle">' . $glyphicon_markup . get_the_title() . '</a>' .
                '</h4>' .
                '</div>' .
                '<div id="collapse' . $panel_count . '" class="panel-collapse collapse ' . $first . '">' .
                '<div class="panel-body">' .
                '<h2 class="accordion-title">' . get_the_title() . '</h2>' .
                themo_content(get_the_content(), true) .
                $button_markup .
                '</div>' .
                '</div>' .
                '</div>';
            $i_panel_count++;
        } // end inner loop
        echo '</div> <!-- /.panel-group -->' .
            '</div> <!-- /.col-md-6 -->' .
            '</div> <!-- /.row -->';
    } else {
        // no posts found
    }
    // Restore original Post Data
    wp_reset_postdata();
}
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );