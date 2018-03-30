<?php
/**
 * Common Taxonomy - Used by property taxonomies
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 6:09 PM
 */
global $post, $taxonomy_title, $taxonomy_name;
$listing_view = houzez_option('taxonomies_default_view');

if( $listing_view == 'grid_view' ) {
$listing_view = 'grid-view';
} else {
$listing_view = 'list-view';
}

// Title
$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$taxonomy_title = $current_term->name;
$sticky_sidebar = houzez_option('sticky_sidebar');
$taxonomy_name = get_query_var( 'taxonomy' );
?>

<?php get_template_part('template-parts/properties-head'); ?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
        <div id="content-area">

            <!--start list tabs-->
            <?php get_template_part( 'template-parts/listing', 'tabs' ); ?>
            <!--end list tabs-->


            <!--start property items-->
            <div class="property-listing <?php echo esc_attr($listing_view); ?>">
                <div class="row">

                    <?php
                    $sort_args = array();
                    $sort_args = houzez_prop_sort($sort_args);

                    global $wp_query;
                    $args = array_merge( $wp_query->query_vars, $sort_args );

                    query_posts( $args );

                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();

                            get_template_part('template-parts/property-for-listing');

                        endwhile;
                        wp_reset_postdata();
                    else:
                        ?>
                        <h4><?php esc_html_e('Sorry No Result Found', 'houzez') ?></h4>
                        <?php
                    endif;
                    ?>

                </div>
            </div>
            <!--end property items-->

            <hr>

            <!--start Pagination-->
            <?php houzez_pagination( $wp_query->max_num_pages, $range = 2 ); ?>
            <!--start Pagination-->

        </div>
    </div><!-- end container-content -->

    <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar <?php if( $sticky_sidebar['property_listings'] != 0 ){ echo 'houzez_sticky'; }?>">
        <?php get_sidebar('property'); ?>
    </div> <!-- end container-sidebar -->
</div>
