<?php
/**
 * Template: Shortcode single menu item
 *
 * @since  1.0.0
 * @version 1.0.0
 */

$thumb_width = wprm_get_option('thumbnail_width');
$thumb_height = wprm_get_option('thumbnail_height');
$menu_style = wprm_get_option('menu_style');
?>
<div class="wprm_shortcode wprm_single_menu_item <?php echo $menu_style;?>">

    <?php if($menu_style == 'simple') : ?>
        <?php do_action( 'wprm_single_menu_item_part_before' ); ?>
        <div class="simple-menu-item">
            <h5 class="menu_post">
                <span class="menu_title"><?php the_title();?></span>
                <span class="menu_dots"></span>
                <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
            </h5>
            <div class="menu-item-excerpt"><?php the_excerpt();?></div>
        </div>

        <?php if(!wprm_get_option('disable_vegetarian') && get_post_meta( get_the_id(), '_wprm_is_vegetarian', true ) == 'yes') : ?>
            <span class="wprm-veg"><?php _e('V','wprm', 'smartfood');?></span>
        <?php endif; ?>
        <?php if(!wprm_get_option('disable_spicy') && get_post_meta( get_the_id(), '_wprm_spicy_level', true ) >= '0') : ?>
            <span class="wprm-chilly-level wprm-chilly-level-<?php echo get_post_meta( get_the_id(), '_wprm_spicy_level', true ); ?>"><?php _e('Hot','wprm', 'smartfood');?></span>
        <?php endif; ?>

        <?php the_content();?>

        <?php do_action( 'wprm_single_menu_item_part_after' ); ?>

    <?php elseif($menu_style == 'simple_images') : ?>
        
        <?php do_action( 'wprm_single_menu_item_part_before' ); ?>
        
        <div class="tdp-one-sixth">
            <?php 
                    if(has_post_thumbnail()) :
                        $post_thumbnail_id = get_post_thumbnail_id();
                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                        $thumb = wprm_thumb($post_thumbnail_url, $thumb_width, $thumb_height); // Crops from bottom right
                        echo '<img class="wp-post-image" src="'.$thumb.'">';
                    endif;
            ?>
        </div>

        <div class="tdp-five-sixth tdp-column-last">
            <div class="simple-menu-item">
                <h5 class="menu_post">
                    <span class="menu_title"><?php the_title();?></span>
                    <span class="menu_dots"></span>
                    <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
                </h5>
                <div class="menu-item-excerpt"><?php the_excerpt();?></div>
            </div>
            <?php the_content();?>
        </div>

        <div class="clearfix"></div>

        <?php if(!wprm_get_option('disable_vegetarian') && get_post_meta( get_the_id(), '_wprm_is_vegetarian', true ) == 'yes') : ?>
            <span class="wprm-veg"><?php _e('V','wprm', 'smartfood');?></span>
        <?php endif; ?>
        <?php if(!wprm_get_option('disable_spicy') && get_post_meta( get_the_id(), '_wprm_spicy_level', true ) >= '0') : ?>
            <span class="wprm-chilly-level wprm-chilly-level-<?php echo get_post_meta( get_the_id(), '_wprm_spicy_level', true ); ?>"><?php _e('Hot','wprm', 'smartfood');?></span>
        <?php endif; ?>

        <div class="clearfix"></div>

        <?php do_action( 'wprm_single_menu_item_part_after' ); ?>
    <?php endif; ?>

</div>