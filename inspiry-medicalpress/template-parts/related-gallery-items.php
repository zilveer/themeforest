<?php
global $post;
global $theme_options;

// Main gallery-item-types terms
$item_type_terms = get_the_terms( $post->ID, "gallery-item-type" );

if ( $item_type_terms && !is_wp_error( $item_type_terms ) ) {

    $gallery_item_types_array = array();
    foreach ( $item_type_terms as $single_term ) {
        $gallery_item_types_array[] = $single_term->term_id;
    }

    if ( 0 < count( $gallery_item_types_array ) ) {

        $related_items_args = array(
            'post_type' => 'gallery-item',
            'posts_per_page' => 4,
            'post__not_in' => array( $post->ID ),
            'orderby' => 'rand',
            'tax_query' => array(
                array (
                'taxonomy' => 'gallery-item-type',
                'field' => 'id',
                'terms' => $gallery_item_types_array,
                ),
            ),
        );

        // Related items query
        $related_items_query = new WP_Query( $related_items_args );

        if ( $related_items_query->have_posts() ) {

            /*
             * Related items title and description
             */
            ?>
            <div class="container">
                <div class="row">
                    <div class=" <?php bc_all('12') ?> ">
                        <div class="clearfix">
                            <div id="related-gallery-items-title" class="slogan-section text-left clearfix">
                                <?php
                                if ( !empty( $theme_options['related_gallery_items_title'] ) ) {
                                    echo '<h2>' . $theme_options['related_gallery_items_title'] . '</h2>';
                                }
                                if ( !empty( $theme_options['related_gallery_items_description'] ) ) {
                                    echo '<p>' . $theme_options['related_gallery_items_description'] . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            /*
             * Related items
             */
            ?>
            <div class="related-gallery-items container">
                <div class="row">
                <?php
                $loop_counter = 0;
                while ( $related_items_query->have_posts() ) {
                    $related_items_query->the_post();
                    $gallery_terms = get_the_terms( $post->ID, 'gallery-item-type' );
                    ?>
                    <div class="<?php bc('3', '4', '6', ''); ?>">

                        <article class="common clearfix hentry">
                            <?php
                            if ( has_post_thumbnail( $post->ID ) ) {
                                $image_id = get_post_thumbnail_id();
                                $full_image_url = wp_get_attachment_url( $image_id );
                                ?>
                                <figure class="overlay-effect">
                                    <a href="<?php echo esc_url( $full_image_url ); ?>" title="<?php the_title(); ?>">
                                        <?php the_post_thumbnail('gallery-post-single'); ?>
                                    </a>
                                    <a class="overlay" href="<?php echo esc_url( $full_image_url ); ?>"><i class="top"></i> <i class="bottom"></i></a>
                                </figure>
                                <?php
                            }
                            ?>
                            <div class="content clearfix">
                                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="gallery-item-types"><?php the_terms( $post->ID, 'gallery-item-type', ' ', ', ', ' ' ); ?></div>
                            </div>
                        </article>

                    </div>
                    <?php
                    $loop_counter++;
                    if ( ( $loop_counter % 3 ) == 0 ) {
                        ?><div class="visible-md clearfix"></div><?php
                    } else if( ( $loop_counter % 2 ) == 0 ) {
                        ?><div class="visible-sm clearfix"></div><?php
                    }
                }

                wp_reset_postdata();
                ?>
                </div>
            </div>
            <?php

        }

    }

}
?>