<?php
$display_similar_properties = get_option('theme_display_similar_properties');
if( $display_similar_properties == 'true' ){
        global $post;
        $similar_properties_args = array(
            'post_type' => 'property',
            'posts_per_page' => 3,
            'post__not_in' => array( $post->ID ),
            'post_parent__not_in' => array( $post->ID ),    // to avoid child posts from appearing in similar properties
            'orderby' => 'rand'
        );

        $tax_query = array();

        /* Main Post Property Type */
        $type_terms = get_the_terms( $post->ID,"property-type" );
        if(!empty($type_terms) && is_array($type_terms)){
            $types_array = array();
            foreach($type_terms as $type_term){
                $types_array[] = $type_term->term_id;
            }
            $tax_query[] = array(
                'taxonomy' => 'property-type',
                'field' => 'id',
                'terms' => $types_array
            );
        }

        /* Main Post Property Status */
        $status_terms = get_the_terms( $post->ID,"property-status" );
        if(!empty($status_terms) && is_array($status_terms)){
            $statuses_array = array();
            foreach($status_terms as $status_term){
                $statuses_array[] = $status_term->term_id;
            }
            $tax_query[] = array(
                'taxonomy' => 'property-status',
                'field' => 'id',
                'terms' => $statuses_array
            );
        }

        $tax_count = count( $tax_query );   // count number of taxonomies
        if( $tax_count > 1 ){
            $tax_query['relation'] = 'OR';  // add OR relation if more than one
        }
        if( $tax_count > 0 ){
            $similar_properties_args['tax_query'] = $tax_query;   // add taxonomies query
        }

        $similar_properties_query = new WP_Query( $similar_properties_args );

        if ( $similar_properties_query->have_posts() ) :
            ?>
            <section class="listing-layout property-grid">
                <div class="list-container clearfix">
                    <?php
                    $similar_properties_title = get_option('theme_similar_properties_title');
                    if( !empty($similar_properties_title) ){
                        ?><h3><?php echo $similar_properties_title; ?></h3><?php
                    }
                    while ( $similar_properties_query->have_posts() ) :
                        $similar_properties_query->the_post();

                        /* Display Property for Grid */
                        get_template_part('template-parts/property-for-grid');

                    endwhile;
                    wp_reset_query();
                    ?>
                </div>
            </section>
            <?php
        endif;
}
?>