<?php
global $post;

$property_children_args = array(
    'post_type' => 'property',
    'posts_per_page' => -1,
    'post_parent' => $post->ID
);

$child_properties_query = new WP_Query( $property_children_args );

if ( $child_properties_query->have_posts() ) :
    ?>
    <div class="child-properties clearfix">
    <?php
    $child_properties_title = get_option('theme_child_properties_title');
    if( !empty($child_properties_title) ){
        ?><h3><?php echo $child_properties_title; ?></h3><?php
    }

    while ( $child_properties_query->have_posts() ) :
        $child_properties_query->the_post();
        ?>
        <article class="property-item clearfix">

            <figure>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php
                    if(has_post_thumbnail($post->ID)) {
                        the_post_thumbnail('property-thumb-image');
                    } else {
                        inspiry_image_placeholder( 'property-thumb-image' );
                    }
                    ?>
                </a>
                <figcaption>
                    <?php
                    $status_terms = get_the_terms( $post->ID,"property-status" );
                    if(!empty( $status_terms )){
                        $status_count = 0;
                        foreach( $status_terms as $term ){
                            if( $status_count > 0 ){
                                echo ', ';
                            }
                            echo $term->name;
                            $status_count++;
                        }
                    }
                    ?>
                </figcaption>
            </figure>


            <div class="summary">
                <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                <h5 class="price">
                    <?php
                    // price
                    property_price();

                    // property types
                    echo inspiry_get_property_types( $post->ID );
                    ?>
                </h5>
                <p><?php framework_excerpt(20); ?></p>
                <a class="more-details" href="<?php the_permalink() ?>"><?php _e('More Details ','framework'); ?><i class="fa fa-caret-right"></i></a>
            </div>

            <div class="property-meta">
                <?php get_template_part('property-details/property-metas'); ?>
            </div>

        </article>
        <?php
    endwhile;
    wp_reset_query();
    ?></div><?php
endif;
?>