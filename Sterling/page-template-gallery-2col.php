<?php
/**
 * Template Name: Gallery - 2 Column
 */

get_header();

get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <ul id="gallery-nav">
        <li class="active"><a href="#" data-filter="*"><?php _e( 'All', 'tt_theme_framework' ); ?></a></li>
        <?php
            wp_list_categories(
                array(
                    'title_li'          => '',
                    'show_option_none'  => '',
                    'taxonomy'          => 'gallery-category',
                    'depth' => 1, //added version 2.2, backward compatibiity. show only top level category
                    'walker'            => new truethemes_gallery_walker()
                )
            );
        ?>
    </ul>

    <div id="gallery-outer-wrap" class="clearfix">
        <div id="main-wrap" class="main-wrap-slider clearfix">
            <div id="iso-wrap" class="clearfix">
                <?php
                    // Reset post data.
                    wp_reset_postdata();
                    $photo_group    = 0; // For prettyPhoto grouping.
                    $count          = 1; // For unique id of gallery item

                    // Build query based on site option value.
                    $num_of_gallery_posts = get_option( 'st_gallery_posts_per_page' );
                    if ( '' == $num_of_gallery_posts || 'show all' == $num_of_gallery_posts ) :
                        $query = new WP_Query( 'post_type=gallery&posts_per_page=-1' );
                    else :
                        $num_per_page   = (int) $num_of_gallery_posts;
                        $query          = new WP_Query( 'post_type=gallery&posts_per_page=' . $num_per_page . '&paged=' . get_query_var( 'paged' ) );
                    endif;


                    //Start the WordPress Loop after querying the posts.
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                        $terms = get_the_terms( get_the_ID(), 'gallery-category' );

                        // Prepare all post meta values.
                        $gal_thumbnail          = get_post_meta( $post->ID, 'gal_thumbnail', true );
                        $gal_thumbnail_crop     = truethemes_crop_image( null, $gal_thumbnail, 445, 273 );
                        $gal_description        = get_post_meta( $post->ID, 'gal_description', true );
                        $gal_description_select = get_post_meta( $post->ID, 'gal_description_select', true );
                        $gal_lightbox           = get_post_meta( $post->ID, 'gal_lightbox', true );
                        $gal_lightbox2          = get_post_meta( $post->ID, 'gal_lightbox2', true );
                        $gal_lightbox2_crop     = truethemes_crop_image( null, $gal_lightbox2, 445, 273 );
                        $gal_lightbox3          = get_post_meta( $post->ID, 'gal_lightbox3', true );
                        $gal_lightbox3_crop     = truethemes_crop_image( null, $gal_lightbox3, 445, 273 );
                        $gal_lightbox4          = get_post_meta( $post->ID, 'gal_lightbox4', true );
                        $gal_lightbox4_crop     = truethemes_crop_image( null, $gal_lightbox4, 445, 273 );
                        $gal_lightbox5          = get_post_meta( $post->ID, 'gal_lightbox5', true );
                        $gal_lightbox5_crop     = truethemes_crop_image( null, $gal_lightbox5, 445, 273 );
                        $gal_title_select       = get_post_meta( $post->ID, 'gal_title_select', true );
                        $gal_lightbox_title     = get_post_meta( $post->ID, 'gal_lightbox_title', true );
                        $gal_lightbox_title_2     = get_post_meta( $post->ID, 'gal_lightbox_title_2', true );
                        $gal_lightbox_title_3     = get_post_meta( $post->ID, 'gal_lightbox_title_3', true );
                        $gal_lightbox_title_4     = get_post_meta( $post->ID, 'gal_lightbox_title_4', true );
                        $gal_lightbox_title_5     = get_post_meta( $post->ID, 'gal_lightbox_title_5', true );                          
                        $cat                    = get_the_category( $post->ID );
                        $gal_link_to_page       = get_post_meta( $post->ID, 'gal_link_to_page', true );
                        $gal_link_target        = get_post_meta( $post->ID, 'gal_link_target', true );

                        // Determine whether to print prettyPhoto in group or single.
                        if ( ! empty( $gal_lightbox2 ) )
                            $prettyPhoto_group = 'prettyPhoto[group' . $photo_group . ']';
                        else
                            $prettyPhoto_group = 'prettyPhoto';
                        ?>

                        <div data-id="id-<?php echo absint( $count ); ?>" class="one_half <?php if ( $terms ) : foreach ( $terms as $term ) : echo sanitize_html_class( 'term-' . absint( $term->term_id ) ) . ' '; endforeach; endif; ?>">
                            <div class="img-frame full-half">
                                <?php if ( ! empty( $gal_link_to_page ) ) : // Process a linked lightbox. ?>
                                    <div class="lightbox-linked">
                                        <a class="hover-item" href="<?php echo esc_url( $gal_link_to_page ); ?>" target="<?php echo esc_attr( $gal_link_target ); ?>" title="<?php echo esc_attr( $gal_lightbox_title ); ?>">
                                            <img src="<?php echo esc_url( $gal_thumbnail_crop ); ?>" alt="" width="445" height="273" />
                                        </a>
                                <?php else: // Process a normal lightbox. ?>
                                    <div class="lightbox-zoom">
                                        <a class="hover-item" data-gal="<?php echo esc_attr( $prettyPhoto_group ); ?>" href="<?php echo esc_url( $gal_lightbox ); ?>" title="<?php echo esc_attr( $gal_lightbox_title ); ?>">
                                            <img src="<?php echo esc_url( $gal_thumbnail_crop ); ?>" alt="" width="445" height="273" />
                                        </a>
                                <?php endif; ?>
                                </div><!-- end .lightbox-linked or .lightbox-zoom -->
                            </div><!-- end .img-frame -->

                            <?php // Start with lightbox2 since lightbox1 is already shown as the main item. ?>
                            <?php if ( ! empty( $gal_lightbox2 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox2 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_2 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox2_crop ); ?>" alt="" width="445" height="273" style="display:none" />
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox3 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox3 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_3 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox3_crop ); ?>" alt="" width="445" height="273" style="display:none" />
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox4 ) ) : ?>
                            <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox4 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_4 ); ?>">
                                <img src="<?php echo esc_url( $gal_lightbox4_crop ); ?>" alt="" width="445" height="273" style="display:none" />
                            </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $gal_lightbox5 ) ) : ?>
                                <a data-gal="prettyPhoto[group<?php echo esc_attr( $photo_group ); ?>]" href="<?php echo esc_url( $gal_lightbox5 ); ?>" title="<?php echo esc_attr( $gal_lightbox_title_5 ); ?>">
                                    <img src="<?php echo esc_url( $gal_lightbox5 ); ?>" alt="" width="445" height="273" style="display:none" />
                                </a>
                            <?php endif;

                            // Check if the user has selected to display the gallery title.
                            if ( 'yes' == $gal_title_select )
                                the_title( '<h4>', '</h4>' );

                            // Check if the user has selected to display the gallery description.
                            if( 'yes' == $gal_description_select )
                                echo '<p>' . esc_html( $gal_description ) . '</p>'; ?>

                        </div><!-- end .one-half -->
                        <?php $count++; $photo_group++; endwhile; endif; ?>
            </div><!-- end #iso-wrap -->

            <div class="gallery-wp-navi">
                <?php
                    if ( function_exists( 'wp_pagenavi' ) )
                        // Pass in custom query array - do not change the code below!
                        wp_pagenavi( $custom_query = $query );
                    else
                        paginate_links();
                ?>
            </div><!-- end .gallery-wp-navi -->
        </div><!-- end #main-wrap -->
    </div><!-- end #gallery-outer-wrap -->

<?php get_footer(); ?>