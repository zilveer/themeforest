<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 4:59 PM
 * Since v1.4.0
 */
global $prop_features;
$additional_features_enable = get_post_meta( get_the_ID(), 'fave_additional_features_enable', true );
$additional_features = get_post_meta( get_the_ID(), 'additional_features', true );
$hide_detail_prop_fields = houzez_option('hide_detail_prop_fields');
?>
<div class="detail-features detail-block">
    <div class="detail-features-left">
        <div class="detail-title">
            <h4 class="title-left">Additional details</h4>
        </div>
        <ul class="list-two-col">
            <?php if( $additional_features_enable != 'disable' && !empty( $additional_features ) && $hide_detail_prop_fields['additional_details'] != 1 ) {  ?>
                <?php
                foreach( $additional_features as $ad_del ):
                    echo '<li><strong>'.esc_attr( $ad_del['fave_additional_feature_title'] ).':</strong> '.esc_attr( $ad_del['fave_additional_feature_value'] ).'</li>';
                endforeach;
                ?>
            <?php } ?>
        </ul>
    </div>
    <div class="detail-features-right">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( 'Features', 'houzez' ); ?></h2>
        </div>
        <ul class="list-two-col list-features">
            <?php
            if (!empty($prop_features)):
                foreach ($prop_features as $term):
                    $term_link = get_term_link($term, 'property_feature');
                    if (is_wp_error($term_link))
                        continue;
                    echo '<li><a href="' . esc_url( $term_link ). '">' . esc_attr( $term->name ). '</a></li>';
                endforeach;
            endif;
            ?>
        </ul>
    </div>
</div>
