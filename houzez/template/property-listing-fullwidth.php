<?php
/**
 * Template Name: Property Listing Full Width Template
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 23/01/16
 * Time: 7:13 PM
 */
get_header();
global $post, $current_page_template;
$listing_view = get_post_meta( $post->ID, 'fave_default_view', true );
$listings_tabs = get_post_meta( $post->ID, 'fave_listings_tabs', true );
$listings_tab_1 = get_post_meta( $post->ID, 'fave_listings_tab_1', true );
$listings_tab_2 = get_post_meta( $post->ID, 'fave_listings_tab_2', true );
$fave_featured_listing = get_post_meta( $post->ID, 'fave_featured_listing', true );
$fave_featured_prop_no = get_post_meta( $post->ID, 'fave_featured_prop_no', true );
$fave_prop_no = get_post_meta( $post->ID, 'fave_prop_no', true );


$listing_page_link = houzez_properties_listing_full_link();

$active = $listing_view;

if( $listing_view == 'grid_view' ) {
    $listing_view = 'grid-view grid-view-2-col';
} elseif( $listing_view == 'grid_view_3_col' ) {
    $listing_view = 'grid-view grid-view-3-col';
} else {
    $listing_view = 'list-view';
}
$current_page_template = get_post_meta( $post->ID, '_wp_page_template', true );
?>

<?php get_template_part('template-parts/properties-head'); ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-grid-area">
        <div id="content-area">

            <!--start list tabs-->
            <?php get_template_part( 'template-parts/listing', 'tabs' ); ?>
            <!--end list tabs-->

            <!--start featured property items-->
            <?php
            global $wp_query, $paged;
            if ( is_front_page()  ) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            if( $fave_featured_listing != 'disable' ) {
                $number_of_featured_prop = $fave_featured_prop_no;
                if (!$number_of_featured_prop) {
                    $number_of_featured_prop = '4';
                }

                $prop_featured_args = array(
                    'post_type' => 'property',
                    'posts_per_page' => $number_of_featured_prop,
                    'paged' => $paged,
                    'post_status' => 'publish'
                );

                $prop_featured_args = apply_filters( 'houzez_featured_property_filter', $prop_featured_args );

                $prop_featured_args = houzez_prop_sort($prop_featured_args);
                $wp_query = new WP_Query($prop_featured_args);

                if ($wp_query->have_posts()) : ?>
                    <div class="property-listing <?php echo esc_attr($listing_view); ?>">
                        <div class="row">

                            <?php
                            while ($wp_query->have_posts()) : $wp_query->the_post();

                                get_template_part('template-parts/property-for-listing');

                            endwhile;
                            ?>

                        </div>
                    </div>
                    <hr>
                    <?php
                    wp_reset_query();
                endif;
            }
            ?>
            <!--end featured property items-->



            <!--start property items-->
            <div class="property-listing <?php echo esc_attr($listing_view); ?>">
                <div class="row">

                    <?php
                    if(!$fave_prop_no){
                        $posts_per_page  = 9;
                    } else {
                        $posts_per_page = $fave_prop_no;
                    }
                    $latest_listing_args = array(
                        'post_type' => 'property',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $paged,
                        'post_status' => 'publish'
                    );

                    $latest_listing_args = apply_filters( 'houzez_property_filter', $latest_listing_args );


                    $latest_listing_args = houzez_prop_sort ( $latest_listing_args );
                    $wp_query = new WP_Query( $latest_listing_args );

                    if ( $wp_query->have_posts() ) :
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();

                            get_template_part('template-parts/property-for-listing');

                        endwhile;
                        wp_reset_postdata();
                    else:
                        get_template_part('template-parts/property', 'none');
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

</div>


<?php get_footer(); ?>