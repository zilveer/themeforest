<?php
/**
 * Single Property Header Details
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 7:45 PM
 */
global $post, $prop_address;
$print_property_button = houzez_option('print_property_button');
$disable_favorite = houzez_option('disable_favorite');
?>
<div class="header-detail table-list">
    <div class="header-left">
        <?php get_template_part( 'inc/breadcrumb' ); ?>
        <h1><?php the_title(); ?>

            <span class="label-wrap">
                <?php if( houzez_taxonomy_simple('property_status') ) { ?>
                    <span class="label label-primary label-status-<?php echo intval(houzez_get_taxonomy_id('property_status')); ?>"><?php echo houzez_taxonomy_simple('property_status'); ?></span>
                <?php } ?>
                <?php if( houzez_taxonomy_simple('property_label') ) { ?>
                    <span class="label label-primary label-color-<?php echo intval(houzez_get_taxonomy_id('property_label')); ?>"><?php echo houzez_taxonomy_simple('property_label'); ?></span>
                <?php } ?>
            </span>

        </h1>
        <?php
        if( !empty( $prop_address )) {
        echo '<address class="property-address">'.esc_attr( $prop_address ).'</address>';
        } ?>
    </div>
    <div class="header-right">
        <ul class="actions">
            <li class="share-btn">
                <?php get_template_part( 'template-parts/share' ); ?>
            </li>
            <?php if( $disable_favorite != 0 ) { ?>
            <li class="fvrt-btn">
                <span><?php get_template_part( 'template-parts/favorite' ); ?></span>
            </li>
            <?php } ?>
            <?php if( $print_property_button != 0 ) { ?>
            <li class="print-btn">
                <span><i id="houzez-print" class="fa fa-print" data-toggle="tooltip" data-original-title="<?php esc_html_e('Print', 'houzez'); ?>" data-propid="<?php esc_attr_e( $post->ID );?>"></i></span>
            </li>
            <?php } ?>
        </ul>
        <?php echo houzez_listing_price_v1(); ?>
    </div>
</div>