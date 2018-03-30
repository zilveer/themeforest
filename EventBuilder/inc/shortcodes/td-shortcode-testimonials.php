<?php

// [recent_agents]
function testimonials_func() {

   ob_start();

   ?>

    <div class="row">

        <div id='owl-demo' class='owl-carousel owl-theme td-testimonials'>

            <?php 

                global $custom_posts2;
                $custom_posts2 = new WP_Query();
                $custom_posts2->query('post_type=testimonial&posts_per_page=-1&post_status=publish');

                if ( $custom_posts2->have_posts() ) {

                  while ($custom_posts2->have_posts()) : $custom_posts2->the_post();

                  $author_id = get_the_ID();

            ?>

            <div class='item'>

                <div class='resume-testimonials'>

                    <div class='resume-testimonials-note'><?php $content = esc_attr(get_post_field('post_content', $author_id)); echo esc_attr($content); ?></div>

                    <span class='resume-testimonials-image'>
                        <?php 

                                get_template_part( 'inc/BFI_Thumb' );

                                $params = array( 'width' => 140, 'height' => 140, 'crop' => true );

                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($author_id), 'large');

                                echo "<img src='" . bfi_thumb( "$large_image_url[0]", $params ) . "' alt='' />";

                            ?>

                    </span>

                    <span class='resume-testimonials-quote'><i class='fa fa-quote-right'></i></span>

                    <div class='resume-testimonials-author-box'><span class='resume-testimonial-author'><?php $quote_title = esc_attr(get_the_title($author_id)); echo esc_attr($quote_title); ?></span></div>

                </div>

            </div>

            <?php endwhile; ?>

            <?php } ?>

        </div>

    </div>

    <?php

    return ob_get_clean();

}
add_shortcode( 'testimonials', 'testimonials_func' );

add_action( 'vc_before_init', 'testimonials_integrateWithVC' );
function testimonials_integrateWithVC() {
   vc_map( array(
      "name" => __("Testimonials", "themesdojo"),
      "base" => "testimonials",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>