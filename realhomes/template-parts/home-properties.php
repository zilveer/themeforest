<?php
/*
* Homepage Properties
*/
?>

<section id="home-properties-section" class="property-items <?php if( 'true' == get_option('theme_ajax_pagination_home') ) { echo 'ajax-pagination'; } ?>">

    <?php
    /* Homepage Slogan */
    get_template_part( 'template-parts/home-slogan' );
    ?>
	<div id="home-properties-section-wrapper">
	<div id="home-properties-section-inner">
    <div id="home-properties-wrapper">

    <div id="home-properties" class="property-items-container clearfix">
        <?php
        /* List of Properties on Homepage */
        $number_of_properties = intval( get_option('theme_properties_on_home') );
        if(!$number_of_properties){
            $number_of_properties = 4;
        }

        if ( is_front_page()  ) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $home_args = array(
            'post_type' => 'property',
            'posts_per_page' => $number_of_properties,
            'paged' => $paged
        );

        /* Modify home query arguments based on theme options - related filters resides in functions.php */
        $home_args = apply_filters( 'real_homes_homepage_properties', $home_args );

        /* Sort Properties Based on Theme Option Selection */
        $sorty_by = get_option('theme_sorty_by');
        if( !empty($sorty_by) ){
            if( $sorty_by == 'low-to-high' ){
                $home_args['orderby'] = 'meta_value_num';
                $home_args['meta_key'] = 'REAL_HOMES_property_price';
                $home_args['order'] = 'ASC';
            }elseif( $sorty_by == 'high-to-low' ){
                $home_args['orderby'] = 'meta_value_num';
                $home_args['meta_key'] = 'REAL_HOMES_property_price';
                $home_args['order'] = 'DESC';
            }
        }

        $home_properties_query = new WP_Query( $home_args );

        /* Homepage Properties Loop */
        if ( $home_properties_query->have_posts() ) :

            $post_count = 0;

            while ( $home_properties_query->have_posts() ) :

                $home_properties_query->the_post();

                /* Display Property for Home Page */
                get_template_part('template-parts/property-for-home');

                /* To output clearfix after every 2 properties */
                $post_count++;
                if( 0 == ( $post_count % 2 ) ){
                    echo '<div class="clearfix"></div>';
                }

            endwhile;

        else:
            ?>
            <div class="alert-wrapper">
                <h4><?php _e('No Properties Found!', 'framework') ?></h4>
            </div>
            <?php
        endif;
        ?>

		    </div><!-- end of #home-properties -->

    </div><!-- end of #home-properties-wrapper -->

    <div class="svg-loader">
        <img src="<?php echo get_template_directory_uri(); ?>/images/loading-bars.svg" width="32" height="32">
    </div>

    <?php
    if( 'true' == get_option('theme_ajax_pagination_home') ) {
        theme_ajax_pagination( $home_properties_query->max_num_pages);
    } else {
        theme_pagination( $home_properties_query->max_num_pages);
    }
?>
		    </div><!-- end of #home-properties-section-inner -->

    </div><!-- end of #home-properties-section-wrapper -->
		<?php

    wp_reset_query();

    ?>

</section>
