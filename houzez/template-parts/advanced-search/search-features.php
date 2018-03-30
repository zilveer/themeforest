<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/10/16
 * Time: 11:23 PM
 */
$get_features = isset ( $_GET['feature'] ) ? $_GET['feature'] : '';

if( taxonomy_exists('property_feature') ) {
    $prop_features = get_terms(
        array(
            "property_feature"
        ),
        array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0
        )
    );
    $features_count = count($get_features);
    $checked_feature = '';
    $count = 0;
    if (!empty($prop_features)) {
        foreach ($prop_features as $feature):
            /*if( $features_count > $count ) {
                $checked_feature = $get_features[$count];
            }
            if( $features_limit != -1 ) {
                if ( $count == $features_limit ) break;
            }*/


            echo '<label class="checkbox-inline">';
            echo '<input name="feature[]" id="feature-' . esc_attr( $feature->slug ) . '" type="checkbox" '.checked( $checked_feature, $feature->slug, false ).' value="' . esc_attr( $feature->slug ) . '">';
            echo esc_attr( $feature->name );
            echo '</label>';
            $count++;
        endforeach;
    }
}