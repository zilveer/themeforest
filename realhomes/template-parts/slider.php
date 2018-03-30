<?php

$number_of_slides = intval(get_option('theme_number_of_slides'));
if(!$number_of_slides){
    $number_of_slides = -1;
}

$slider_args = array(
    'post_type' => 'property',
    'posts_per_page' => $number_of_slides,
    'meta_query' => array(
        array(
            'key' => 'REAL_HOMES_add_in_slider',
            'value' => 'yes',
            'compare' => 'LIKE'
        )
    )
);

$slider_query = new WP_Query( $slider_args );

if($slider_query->have_posts()){
    ?>
    <!-- Slider -->
    <div id="home-flexslider" class="clearfix">
        <div class="flexslider loading">
            <ul class="slides">
                <?php
                while ( $slider_query->have_posts() ) :
                    $slider_query->the_post();
                    $slider_image_id = get_post_meta( $post->ID, 'REAL_HOMES_slider_image', true );
                    if($slider_image_id){
                        $slider_image_url = wp_get_attachment_url($slider_image_id);
                        ?>
                        <li>
                            <div class="desc-wrap">
                                <div class="slide-description">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php framework_excerpt(15); ?></p>
                                    <?php
                                    $price = get_property_price();
                                    if ( $price ){
                                        echo '<span>'.$price.'</span>';
                                    }
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="know-more"><?php _e('Know More','framework'); ?></a>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $slider_image_url; ?>" alt="<?php the_title(); ?>"></a>
                        </li>
                        <?php
                    }
                endwhile;
                wp_reset_query();
                ?>
            </ul>
        </div>
    </div><!-- End Slider -->
    <?php
}else{
    get_template_part('banners/default_page_banner');
}
?>