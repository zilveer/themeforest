<?php

// [partners]
function partners_func() {

    ob_start();

    ?>

    <div class="row" style="margin-bottom: 50px;">

        <div class="col-sm-12">

            <div class="post">

                <div class="row">

                    <?php

                        /* add javascript */
                        wp_enqueue_script( 'td-owl-carousel' );
                                                                                    
                    ?>
            
                    <div id="carousel" class="owl-carousel">

                        <?php 

                            global $wpdb;

                            $partners = $wpdb->get_results( "SELECT DISTINCT p.ID
                                                        FROM  `{$wpdb->prefix}posts` p
                                                        WHERE p.post_type =  'partner'
                                                        AND p.post_status =  'publish'
                                                        ORDER BY  `p`.`ID` DESC");

                            foreach($partners as $partner) {
                                $partner_id = $partner->ID;

                            ?>

                        <div class="item"><img src="<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($partner_id), 'large'); echo esc_url($large_image_url[0]); ?>" alt="<?php echo get_the_title( $partner ); ?>"></div>

                        <?php } ?>

                    </div>
                    <div class="owl-carousel-navigation">
                        <a class="owl-btn prev fa fa-angle-left"></a>
                        <a class="owl-btn next fa fa-angle-right"></a>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php

    return ob_get_clean();

}
add_shortcode( 'partners', 'partners_func' );

add_action( 'vc_before_init', 'partners_integrateWithVC' );
function partners_integrateWithVC() {
   vc_map( array(
      "name" => __("Partners", "themesdojo"),
      "base" => "partners",
      "class" => "",
      "category" => __('Content', 'themesdojo'),
      "params" => ""
   ) );
}

?>