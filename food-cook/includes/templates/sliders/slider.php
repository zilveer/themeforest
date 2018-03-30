<?php
global $woo_options;
$num          = isset( $woo_options[ 'woo_slider_number' ] ) ? $woo_options[ 'woo_slider_number' ] : -1;
$slider_args  = array( 'post_type'=> 'recipe', 'posts_per_page' => $num );
$slider_query = new WP_Query( $slider_args ); ?>

<section class="slider">

    <div class="recipe-item">
        <?php if ( $slider_query->have_posts() ) : ?>
            <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                <div id="recipe-slide" class="recipe-thumbnail">
                    <?php get_the_image( array(
                            'order'         => array( 'featured', 'default' ),
                            'featured'      => true,
                            'default'       => esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
                            'size'          => 'thumbnail-blog',
                            'link_to_post'  => true
                          ) ); ?>
                    <?php if ( $woo_options[ 'woo_slider_caption' ] == 'true' ) : ?>
                        <div class="slide-info">
                            <h2><a href="<?php the_permalink(); ?>"><?php echo woo_fnc_word_trim( get_the_title(), 5, '...' ); ?></a></h2>
                            <p><?php echo woo_fnc_word_trim( get_the_excerpt(), 10, '...' ); ?></p>
                            <?php if ($woo_options['woo_rating_recipe'] == 'true') : ?>
                                <div class="rating">
                                    <?php woo_fnc_the_recipe_rating( $post->ID ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="recipe-pagination">
        <?php if ( $woo_options['woo_slider_thumbnail_recipe'] == 'true' ) : ?>
            <?php if ( $slider_query->have_posts() ) : ?>
                <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                    <?php get_the_image( array(
                            'order'         => array( 'featured', 'default' ),
                            'featured'      => true,
                            'default'       => esc_url( get_template_directory_uri() . '/includes/assets/images/image.jpg' ),
                            'size'          => 'full-size',
                            'link_to_post'  => false
                          ) ); ?>
                <?php endwhile; ?>
		    <?php endif; ?>
        <?php endif; ?>
    </div>

</section>

<div class="clear"></div>