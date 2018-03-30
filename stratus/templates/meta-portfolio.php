<?php
//======================================================================
// Portfolio Template
//======================================================================

if(isset($post->ID)){
    $postID = $post->ID;
}else{
    $postID = get_the_ID();
}

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
$section_template_class = 'portfolio';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Testimonials Loop
//-----------------------------------------------------

if ($show == 1){

    // Set Image Size
    global $image_size;
    $image_size = 'themo_portfolio_standard';

    // Check for Options
    $filter_bar = get_post_meta($postID, $key.'_filter_bar', true );
    $portfolio_columns = get_post_meta($postID, $key.'_cols_per_page', true );

    // Columns
    switch ($portfolio_columns) {
        case 4:
            $col_item_class = "col-lg-3 col-md-3 col-sm-6";
            $col_row_class = "five-columns";
            break;
        case 5:
            $col_item_class = "col-lg-2 col-md-2 col-sm-6";
            $col_row_class = "five-columns";
            break;
        default:
            $col_item_class = "col-lg-4 col-md-4 col-sm-6";
            $col_row_class = "three-columns";
    }


    // return custom post type args for WP Query
    $args = themo_return_cpt_args($postID,$key,'themo_portfolio','themo_project_type');

    if(isset($args['orderby']) && $args['orderby'] == 'menu_order'){
        global $orderby_menu;
        $orderby_menu = true;
    }

    // WP Query
    $loop = new WP_Query($args);

    // Filtr Bar on / off?
    if(isset($filter_bar) && $filter_bar == 1) {

        //-----------------------------------------------------
        // Build Filter Navigation
        // Get all project types for the posts on this page.
        //-----------------------------------------------------
        $project_type_terms = array();

        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <?php
            $terms = get_the_terms($post->ID, 'themo_project_type');

            if ($terms && !is_wp_error($terms)) :

                foreach ($terms as $term) {
                    $project_type_terms[$term->slug] = $term->slug;
                    $project_type_terms[$term->slug] = $term->name;

                }
            endif;

        endwhile;

        // Sort ascending by key.
        ksort($project_type_terms); // SORT / or krsort() for reverse order

        // Loop though project types and build navigation for filtering.
        $project_type_links = false;
        foreach ($project_type_terms as $project_type_slug => $project_type_name) {
            $project_type_links .= "<a href='#' data-filter='#".$key." .p-" . $project_type_slug . "'>" . $project_type_name . "</a>";
        }

        echo '<div id="filters" class="portfolio-filters">';
        echo '<span>'. esc_html__('Sort:', 'stratus') . '</span><a href="#" data-filter="*" class="current">All</a>'. $project_type_links;
        echo '</div>';
    }

    //-----------------------------------------------------
    // Output Portfolio Index.
    //-----------------------------------------------------

    echo '<div id="portfolio-row" class="portfolio-row row '.$key .' '. $col_row_class.'">';
    if (!$loop->have_posts()) {
        echo '<div class="alert">';
        _e('Sorry, no results were found.', 'stratus');
        echo '</div>';
        get_search_form();
    }

    while ($loop->have_posts()){
        $loop->the_post();
        $postID_inner = get_the_ID();

        $format = get_post_format();
        if ( false === $format ) {
            $format = '';
        }

        // Get Project Type Terms for each post and include them as a class.
        $terms = get_the_terms( $postID_inner, 'themo_project_type' );
        $project_type_classes = "";

        if ( $terms && ! is_wp_error( $terms ) ) {
            $project_type_slugs = array();
            foreach ($terms as $term) {
                $project_type_slugs[] = "p-".$term->slug;
            }
            $project_type_classes = join(" ", $project_type_slugs);
        }
        echo '<div id='.$key.'-post-'."$postID_inner".' class="'. implode(' ',get_post_class('themo_portfolio type-themo_portfolio portfolio-item item '. $col_item_class . ' '. $project_type_classes)).'">';

        get_template_part('templates/portfolio', $format);

        echo '</div><!-- /.col-md -->';
    }
    echo '</div><!-- /.row -->';

    wp_reset_postdata();


} // end outer if / then

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

