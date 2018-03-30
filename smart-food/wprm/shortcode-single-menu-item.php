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

    <?php if($display_images == 'true') : ?>

        <?php do_action( 'wprm_single_menu_item_part_before' ); ?>
        
        <div class="tdp-one-sixth <?php if( has_post_thumbnail() ) : ?>lightbox<?php endif; ?>">
            <?php 
                    if(has_post_thumbnail()) :
                        $post_thumbnail_id = get_post_thumbnail_id();
                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                        $thumb = wprm_thumb($post_thumbnail_url, $thumb_width, $thumb_height); // Crops from bottom right
                        echo '<a href="'.esc_url( $post_thumbnail_url ).'"><img class="wp-post-image" src="'.$thumb.'"></a>';
                    endif;
            ?>
        </div>

        <div class="tdp-five-sixth tdp-column-last">
            <div class="simple-menu-item">
                <h5 class="menu_post">
                    <?php if($hyperlink == 'true') : ?>
                         <span class="menu_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></span>
                    <?php else : ?>
                         <span class="menu_title"><?php the_title();?></span>
                    <?php endif; ?>
                    <?php if($price == 'true'): ?>
                        <span class="menu_dots"></span>
                        <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
                    <?php endif; ?>
                </h5>
                <?php if($description == 'true') : ?>
                    <div class="menu-item-excerpt"><?php the_excerpt();?></div>
                <?php endif; ?>
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

    <?php else : ?>
        
        <?php do_action( 'wprm_single_menu_item_part_before' ); ?>

        <div class="simple-menu-item image-<?php echo $display_images; ?>">
            <h5 class="menu_post">
                <?php if($hyperlink == 'true') : ?>
                         <span class="menu_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></span>
                <?php else : ?>
                         <span class="menu_title"><?php the_title();?></span>
                <?php endif; ?>
                <?php if($price == 'true'): ?>
                        <span class="menu_dots"></span>
                        <span class="menu_price"><?php echo wprm_get_item_price(); ?></span>
                <?php endif; ?>
            </h5>
            <?php if($description == 'true') : ?>
                <div class="menu-item-excerpt"><?php the_excerpt();?></div>
            <?php endif; ?>
        </div>

        <?php if(!wprm_get_option('disable_vegetarian') && get_post_meta( get_the_id(), '_wprm_is_vegetarian', true ) == 'yes') : ?>
            <span class="wprm-veg"><?php _e('V','wprm', 'smartfood');?></span>
        <?php endif; ?>
        <?php if(!wprm_get_option('disable_spicy') && get_post_meta( get_the_id(), '_wprm_spicy_level', true ) >= '0') : ?>
            <span class="wprm-chilly-level wprm-chilly-level-<?php echo get_post_meta( get_the_id(), '_wprm_spicy_level', true ); ?>"><?php _e('Hot','wprm', 'smartfood');?></span>
        <?php endif; ?>
       
        <?php if($description == 'true') : ?>
            <?php the_content();?>
        <?php endif; ?>

        <?php do_action( 'wprm_single_menu_item_part_after' ); ?>

    <?php endif; ?>

</div>