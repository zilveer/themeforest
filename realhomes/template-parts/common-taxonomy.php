<?php
get_header();

    /* Determine the type header to be used for taxonomy */
    $theme_listing_module = get_option('theme_listing_module');

    switch($theme_listing_module){
        case 'properties-map':
            get_template_part('banners/map_based_banner');
            break;
        default:
            get_template_part('banners/taxonomy_page_banner');
            break;
    }

    /* Check View Type */
    if(isset($_GET['view'])){
        $view_type = $_GET['view'];
    }else{
        /* Theme Options Listing Layout */
        $view_type = get_option('theme_listing_layout');
    }
    ?>

    <div class="container contents listing-grid-layout">
        <div class="row">
            <div class="span9 main-wrap">

                <!-- Main Content -->
                <div class="main">

                    <section class="listing-layout <?php if( $view_type == 'grid' ){ echo 'property-grid'; } ?>">

                        <?php
                        // listing view type
                        get_template_part( 'template-parts/listing-view-type' );
                        ?>

                        <div class="list-container clearfix">
                            <?php
                            get_template_part('template-parts/sort-controls');

                            $sort_query_args = array();
                            $sort_query_args = sort_properties($sort_query_args);

                            global $wp_query;
                            $args = array_merge( $wp_query->query_vars, $sort_query_args );
                            query_posts( $args );

                            if ( have_posts() ) :
                                while ( have_posts() ) :
                                    the_post();

                                    if( $view_type == 'grid' ){
                                        /* Display Property for Grid */
                                        get_template_part('template-parts/property-for-grid');
                                    }else{
                                        /* Display Property for Listing */
                                        get_template_part('template-parts/property-for-listing');
                                    }

                                endwhile;
                            else:
                                ?>
                                <div class="alert-wrapper">
                                    <h4><?php _e('No Results Found', 'framework') ?></h4>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>

                        <?php theme_pagination( $wp_query->max_num_pages); ?>

                    </section>

                </div><!-- End Main Content -->

            </div> <!-- End span9 -->

            <?php get_sidebar('property-listing'); ?>

        </div><!-- End contents row -->
    </div>

<?php get_footer(); ?>