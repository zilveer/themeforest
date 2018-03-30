<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );


$id = uniqid();

$cat = !empty($categories) ? $categories : $cat;
$query = mk_wp_query(array(
            'post_type' => 'portfolio',
            'count' => $count,
            'offset' => $offset,
            'categories' => $cat,
            'author' => $author,
            'posts' => $posts,
            'orderby' => $orderby,
            'order' => $order,
        ));

$loop = $query['wp_query'];


?>

<div id="portfolio-carousel-wrapper-<?php echo $id; ?>" class="portfolio-carousel style-<?php echo $style; ?> <?php echo $el_class; ?>">

    <?php if(!empty($view_all) && $view_all != '*') { ?>
        
        <h3 class="mk-fancy-title pattern-style"><span><?php echo $title; ?></span>
        <a href="<?php echo esc_url( get_permalink( $view_all ) ); ?>" class="view-all page-bg-color"><?php _e( $view_all_text, 'mk_framework' ); ?></a></h3>
        <div class="clearfix"></div>
        <?php 
        $direction_vav = 'true';
    }
    ?>

    <div id="portfolio-carousel-<?php echo $id; ?>" class="mk-flexslider">
        <ul class="mk-flex-slides">

        <?php

        while ( $loop->have_posts() ) :
                $loop->the_post();

                $post_type = get_post_meta(get_the_ID(), '_single_post_type', true );
                $post_type = !empty( $post_type ) ? $post_type : 'image';

                $atts = array(
                    'image_size' => $image_size,
                    'id' => $id,
                    'hover_scenarios' => $hover_scenarios,
                    'meta_type' => $meta_type,
                    'post_type' => $post_type

                    );

                echo mk_get_shortcode_view('mk_portfolio_carousel', 'loop-styles/' . $style, true, $atts);

        endwhile; 
            wp_reset_query();
        ?>

        </ul>
    </div>
<div class="clearboth"></div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function() {
        
    	var style = "<?php echo $style; ?>",
    	item_width;

    	if(style == "classic") {
            item_width = 275;
    		items_to_show = 4;
    	} else {
            var screen_width = jQuery("#portfolio-carousel-<?php echo $id; ?>").width(),
            items_to_show = <?php echo $show_items; ?>;

            if(screen_width >= 1100) {
                item_width = screen_width/items_to_show;
            } else if(screen_width <= 1200 && screen_width >= 800) {
                item_width = screen_width/3;
            } else if(screen_width <= 800 && screen_width >= 540){
                item_width = screen_width/2;
            } else {
                item_width = screen_width;
            }

    	}


        jQuery(window).on("load",function () {
            MK.core.loadDependencies([ MK.core.path.plugins + 'jquery.flexslider.js' ], function() {
                jQuery("#portfolio-carousel-<?php echo $id; ?>").flexslider({
                    selector: ".mk-flex-slides > li",
                    slideshow: !isTest,
                    animation: "slide",
                    slideshowSpeed: 6000,
                    animationSpeed: 400,
                    pauseOnHover: true,
                    controlNav: false,
                    smoothHeight: false,
                    useCSS: false,
                    directionNav: <?php echo $direction_vav; ?>,
                    prevText: "",
                    nextText: "",
                    itemWidth: item_width,
                    itemMargin: 0,
                    maxItems: <?php echo ($style === 'modern') ? $show_items : 4; ?>,
                    minItems: 1,
                    move: 1
                });
            });
        });
    });
</script>

<?php
if(empty($title)) {
    Mk_Static_Files::addCSS('
        @media handheld, only screen and (max-width: 767px) {
            #portfolio-carousel-wrapper-'.$id.' .mk-fancy-title.pattern-style span {
                padding: 0!important;
            }
        }
    ', $id);
}
?>