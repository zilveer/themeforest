<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 17/12/15
 * Time: 4:47 PM
 */

global $post, $prop_images, $houzez_local, $current_page_template, $taxonomy_name;
$disable_favorite = houzez_option('disable_favorite');
$disable_compare = houzez_option('disable_compare');
?>
<ul class="actions">

    <?php if( $disable_favorite != 0 ) { ?>
    <li>
        <span data-placement="top" data-toggle="tooltip" data-original-title="<?php echo $houzez_local['favorite']; ?>">
            <?php get_template_part( 'template-parts/favorite' ); ?>
        </span>
    </li>
    <?php } ?>
    <!-- <li class="share-btn">
        <?php get_template_part( 'template-parts/share' ); ?>
    </li> -->
    <li>
        <span data-toggle="tooltip" data-placement="top" title="(<?php echo count( $prop_images ); ?>) <?php echo $houzez_local['photos']; ?>">
            <i class="fa fa-camera"></i>
        </span>
    </li>
    <?php if( $disable_compare != 0 ) { ?>
    <li>
        <span id="compare-link-<?php esc_attr_e( $post->ID ); ?>" class="compare-property" data-propid="<?php esc_attr_e( $post->ID ); ?>" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Compare', 'houzez' ); ?>">
            <i class="fa fa-plus"></i>
        </span>
    </li>
    <?php } ?>
</ul>
