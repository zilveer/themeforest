<?php
/*
Template Name: Portfolio - Standard
Template for the portfolio index page. So far we have 1 layout - standard.
*/
global $post;

include( locate_template( 'templates/page-layout.php' ) );

echo '<div class="inner-container">';

include( locate_template( 'templates/meta-slider-flex.php' ) );
include( locate_template( 'templates/page-header.php' ) ); // Page Header Template

//-----------------------------------------------------
// OPEN | OUTER Container + Row
//-----------------------------------------------------
echo wp_kses_post($outer_container_open) . wp_kses_post($outer_row_open); // Outer Tag Open

//-----------------------------------------------------
// OPEN | Wrapper Class - Support for sidebar
//-----------------------------------------------------
echo wp_kses_post($main_class_open);

//-----------------------------------------------------
// OPEN | Section + INNER Container
//-----------------------------------------------------

// Set Image Size
$image_size = 'themo_portfolio_standard';

$key = 'portfolio_content';

echo '<section id="'.$key.'" class="portfolio">';
echo wp_kses_post($inner_container_open);

//-----------------------------------------------------
// LOOP
//-----------------------------------------------------

// args
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'themo_portfolio',
    'post_status' => 'publish',
    'paged' => $paged,
);


    // Check for Options
    if ( function_exists( 'ot_get_option' ) ) {
        $filter_bar = get_post_meta($post->ID, 'themo_portfolio_filter_bar');
        $filter_by_project_type = get_post_meta($post->ID, 'themo_filter_by_type');
        $projects_per_page = get_post_meta($post->ID, 'themo_projects_per_page');
        $portfolio_columns = get_post_meta($post->ID, 'themo_cols_per_page');
        $projects_order = get_post_meta($post->ID, 'themo_orderby');

        if(isset($filter_by_project_type[0]) && $filter_by_project_type[0] == 1) {
            $filter_project_type_ids = get_post_meta($post->ID, 'themo_filter_project_type_ids');
        }
    }

    // Columns
    if(isset($portfolio_columns) && is_array($portfolio_columns)) {
        switch ($portfolio_columns[0]) {
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
    }

    // Custom Post Per Page
    if(isset($projects_per_page[0]) && $projects_per_page[0] > 0) {
        $args = array_merge($args, array( 'showposts' => $projects_per_page[0]));
    }


    // If Term ID's are specified
    if (isset($filter_project_type_ids) && is_array($filter_project_type_ids) && !empty($filter_project_type_ids)) {

        $termIDs = explode(',', $filter_project_type_ids[0]);

        $args = array_merge($args, array('tax_query' => array(

            array(
                'taxonomy' => 'themo_project_type',
                'field' => 'id',
                'terms' => $termIDs,
                'include_children' => true,
                'operator' => 'IN',
            ))));
    }



    //Order
    if(isset($projects_order) && is_array($projects_order)) {
        if($projects_order[0] == 'menu_order'){
            global $orderby_menu;
            $orderby_menu = true;
            $args = array_merge($args, array( 'orderby' => $projects_order[0]));
            $args = array_merge($args, array( 'order' => 'ASC'));
        }
    }

    // WP Query
    $loop = new WP_Query( $args );

    //-----------------------------------------------------
    // Build Filter Navigation
    // Get all project types for the posts on this page.
    //-----------------------------------------------------
    if(isset($filter_bar[0]) && $filter_bar[0] == 1) {

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
        $project_type_links  = false;
        foreach ($project_type_terms as $project_type_slug => $project_type_name) {
            $project_type_links .= "<a href='#' data-filter='#".$key." .p-" . $project_type_slug . "'>" . $project_type_name . "</a>";
        }

        echo '<div id="filters" class="portfolio-filters">';
        echo '<span>'. esc_html__('Sort:', 'stratus') . '</span><a href="#" data-filter="*" class="current">All</a>'. $project_type_links;
        echo '</div>';

    }
    ?>


    <?php
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
		    $format = get_post_format();
            if ( false === $format ) {
                $format = '';
            }

            // Get Project Type Terms for each post and include them as a class.
            $terms = get_the_terms( $post->ID, 'themo_project_type' );
            $project_type_classes = "";

            if ( $terms && ! is_wp_error( $terms ) ) {
                $project_type_slugs = array();
                foreach ($terms as $term) {
                    $project_type_slugs[] = "p-".$term->slug;
                }
                $project_type_classes = join(" ", $project_type_slugs);
            }
            echo '<div id=post-'."$post->ID".' class="'. implode(' ',get_post_class('themo_portfolio type-themo_portfolio portfolio-item item '. $col_item_class . ' '. $project_type_classes)).'">';

            get_template_part('templates/portfolio', $format);

			echo '</div><!-- /.col-md -->';
         }
    echo '</div><!-- /.row -->'
    ?>

    
    <div class="row">
		<?php if ($loop->max_num_pages > 1) : ?>
            <nav class="post-nav">
                <ul class="pager">
                    <li class="previous"><?php previous_posts_link(esc_html__('&larr; Previous', 'stratus'), $loop->max_num_pages); ?></li>
                    <li class="next"><?php next_posts_link(esc_html__('Next &rarr;', 'stratus'), $loop->max_num_pages); ?></li>
                </ul>
            </nav>
        <?php endif; ?>
	</div>
    
	<?php
	//-----------------------------------------------------
	// CLOSE | Section + INNER Container
	//----------------------------------------------------- ?>
	<?php echo wp_kses_post($inner_container_close);?>
	</section>

	<?php 
    //-----------------------------------------------------
	// CLOSE | Main Class
	//-----------------------------------------------------
    echo wp_kses_post($main_class_close); ?>
    
    <?php
    //-----------------------------------------------------
	// INCLUDE | Sidebar
	//-----------------------------------------------------
    include themo_sidebar_path(); ?>
    
    <?php
	//-----------------------------------------------------
	// CLOSE | OUTER Container + Row
	//----------------------------------------------------- 
    echo wp_kses_post($outer_container_close) . wp_kses_post($outer_row_close); // Outer Tag Close ?>
</div><!-- /.inner-container -->