<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = uniqid();

global $mk_options, $post;

$query = mk_wp_query(array(
    'post_type' => 'tab_slider',
    'count' => (!empty($tabs)) ? count(explode(',',$tabs)) : 10,
    'posts' => $tabs,
    'orderby' => $orderby,
    'order' => $order,
));


$r = $query['wp_query'];
$page_permalink = esc_url( get_permalink() );

?>


<div class="mk-tab-slider-nav" data-id="<?php echo $id; ?>">
	<?php while ( $r->have_posts() ) : $r->the_post();
		 $menu_icon = get_post_meta( $post->ID, '_menu_icon', true );
         $menu_text = get_post_meta( $post->ID, '_menu_text', true );
         $title = get_post_meta( $post->ID, '_title', true );
	 ?>
    <?php if ( empty( $menu_text ) ) { ?>
    	<a href="#" title="<?php echo $title; ?>"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, $menu_icon, $button_size, $button_color); ?></a>
    <?php }else{ ?>
    	<a href="#" title="<?php echo $title; ?>" style="font-size:<?php echo $button_size; ?>px; color:<?php echo $button_color; ?>;"><?php echo $menu_text; ?></a>
    <?php } ?>
    <?php endwhile; ?>
</div>



<div id="mk-tab-slider-<?php echo $id; ?>" data-id="<?php echo $id; ?>" data-autoplay="<?php echo $autoplay_time; ?>" class="mk-tab-slider <?php echo get_viewport_animation_class($animation).$el_class; ?>">
    <div class="mk-tab-slider-wrapper">
        <?php
        while ( $r->have_posts() ) : $r->the_post();
       
        $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $skin_color = (get_post_meta( $post->ID, '_skin_color', true ) != '') ? get_post_meta( $post->ID, '_skin_color', true ) : 'light' ;
        $content_background = get_post_meta( $post->ID, '_bg_color', true );
        $title = get_post_meta( $post->ID, '_title', true );
        $image_align = get_post_meta( $post->ID, '_image_align', true );
        $desc = get_post_meta( $post->ID, '_desc', true );
        $button_text = get_post_meta( $post->ID, '_button_text', true );
        $button_url = get_post_meta( $post->ID, '_button_url', true );
        $share_button = get_post_meta( $post->ID, '_share_button', true );
        ?>
        <div class="mk-tab-slider-item float-<?php echo $image_align; ?> skin-<?php echo $skin_color; ?>" style="background-color:<?php echo $content_background; ?>;">
            <div class="mk-slider-image">
                <img src="<?php echo $image_src_array[0]; ?>" alt="<?php echo $title; ?>" />
            </div>

            <div class="mk-slider-content" style="float:<?php if($image_align == 'left') { echo 'right';} else echo 'left'; ?>;">

                <div class="mk-slider-content-inside">
                    <h3 class="mk-slider-title"><span><?php echo $title; ?></span><hr /></h3>
                    <div class="mk-slider-description"><?php echo wpb_js_remove_wpautop($desc, true); ?></div>
                    <?php echo !empty( $button_url ) ? (do_shortcode( '[mk_button dimension="outline" corner_style="pointed" outline_skin="'.$skin_color.'" size="medium" align="left" url="'.$button_url.'" el_class="mk-slider-read-more"]'.$button_text.'[/mk_button]' )) : '' ; ?>

                    <?php if ($share_button == "true") { ?>
                    <ul class="mk-tab-slider-share">
                        <li><a class="facebook-share" data-title="<?php echo esc_attr($title); ?>" data-url="<?php echo $page_permalink; ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-facebook', 16); ?></a></li>
                        <li><a class="twitter-share" data-title="<?php echo esc_attr($title); ?>" data-url="<?php echo $page_permalink; ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-twitter', 16); ?></a></li>
                        <li><a class="googleplus-share" data-title="<?php echo esc_attr($title); ?>" data-url="<?php echo $page_permalink; ?>" href="#"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-google-plus', 16); ?></a></li>
                    </ul>
                    <?php } ?>

                </div>
            </div>

        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_postdata();