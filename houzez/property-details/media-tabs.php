<?php
/**
 * Single Property Media tabs
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 7:49 PM
 */
global $post, $property_streetView, $property_map;
?>
<div class="media-tabs">
    <ul class="media-tabs-list">
        <li class="popup-trigger" data-placement="bottom" data-toggle="tooltip" data-original-title="<?php esc_html_e( 'View Photos', 'houzez' ); ?>">
            <a href="#gallery" data-toggle="tab">
                <i class="fa fa-camera"></i>
            </a>
        </li>
        
        <?php if( $property_map != 0 ) { ?>
        <li data-placement="bottom" data-toggle="tooltip" data-original-title="<?php esc_html_e('Map View', 'houzez');?>">
            <a href="#singlePropertyMap" data-toggle="tab">
                <i class="fa fa-map"></i>
            </a>
        </li>
        <?php } ?>

        <?php if( ( $property_streetView != 'hide' && !empty( $property_streetView) ) && ( $property_map != 0 ) ) { ?>
        <li data-placement="bottom" data-toggle="tooltip" data-original-title="<?php esc_html_e('Street View', 'houzez');?> ">
            <a href="#street-map" data-toggle="tab">
                <i class="fa fa-street-view"></i>
            </a>
        </li>
        <?php } ?>

    </ul>
    <ul class="actions">
        <li class="share-btn">
            <?php get_template_part( 'template-parts/share' ); ?>
        </li>
        <li>
            <span><?php get_template_part( 'template-parts/favorite' ); ?></span>
        </li>
    </ul>
</div>
