<?php
/*
*   Template Name: Map Based Property Listing Template
*/
get_header();
?>

<!-- Page Head -->
<?php get_template_part("banners/map_based_banner"); ?>

    <!-- Content -->
    <?php
    if(isset($_GET['view'])){
        $view_type = $_GET['view'];
    }else{
        /* Theme Options Listing Layout */
        $view_type = get_option('theme_listing_layout');
    }

    if( $view_type == 'grid' ){
        get_template_part("template-parts/grid-listing-container");
    }else{
        get_template_part("template-parts/listing-container");
    }
    ?>
    <!-- End Content -->

<?php get_footer(); ?>