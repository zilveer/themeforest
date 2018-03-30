<?php
wp_enqueue_script('owl-carousel');

global $yit_products_tabs_index;
if ( ! isset( $yit_products_tabs_index )  ) $yit_products_tabs_index = 0;

$sc = array();
?>

<div class="tabs-container products_tabs <?php echo esc_attr( $vc_css ); ?>">
    <ul class="clearfix tabs">
        <?php for( $i = 1; isset( $atts['title_'.$i] ); $i++ ) :

            $title = ( !empty( $atts['title_'.$i] ) ) ? $atts['title_'.$i] : '' ;
            $per_page = ( !empty( $atts['per_page_'.$i] ) ) ? $atts['per_page_'.$i] : '-1' ;
            $category = ( !empty( $atts['category_'.$i] ) ) ? $atts['category_'.$i] : '0' ;
            $product_type = ( !empty( $atts['show_'.$i] ) ) ? $atts['show_'.$i] : 'all'  ;
            $orderby = ( !empty( $atts['orderby_'.$i] ) ) ? $atts['orderby_'.$i] : 'rand' ;
            $order = ( !empty( $atts['order_'.$i] ) ) ? $atts['order_'.$i] : '0' ;

            echo '<li><h4><a href="#" data-tab="tab-' . $yit_products_tabs_index . '" title="' . $title . '">' . $title . '</a></h4></li>';
            $sc[$yit_products_tabs_index] = '[products_slider title="' . $title . '" per_page="' . $per_page . '" product_type="' . $product_type . '" category="' . $category . '" orderby="' . $orderby . '" order="' . $order . '" layout="default" ]';
            $yit_products_tabs_index++;
        endfor ?>
    </ul>
    <div class="border-box group">
        <?php foreach ( $sc as $sc_key => $sc_value ) { ?>
            <div id="tab-<?php echo $sc_key ?>" class="panel group"><?php echo do_shortcode( $sc_value ); ?></div>
        <?php } ?>
    </div>
</div>

