<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/01/16
 * Time: 5:46 PM
 */
global $prop_data;
?>
<div class="account-block">
    <div class="add-title-tab">
        <h3><?php esc_html_e( 'Property Features', 'houzez' ); ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row push-padding-bottom">
            <div class="row">

            <?php
            $features_terms_id = array();
            $features_terms = get_the_terms( $prop_data->ID, 'property_feature' );
            if ( $features_terms && ! is_wp_error( $features_terms ) ) {
                foreach( $features_terms as $feature ) {
                    $features_terms_id[] = intval( $feature->term_id );
                }
            }

            $property_features = get_terms(
                array(
                    'property_feature'
                ),
                array(
                    'orderby'           => 'name',
                    'order'             => 'ASC',
                    'hide_empty'        => false,
                )
            );

            if( !empty( $property_features ) ) {
                $feature_array = array();
                $count = 1;
                foreach( $property_features as $feature ) {

                    echo '<div class="col-sm-3">';
                    echo '<div class="checkbox">';
                    echo '<label>';
                    if ( in_array( $feature->term_id, $features_terms_id ) ) {
                        echo '<input type="checkbox" name="prop_features[]" id="feature-' . esc_attr( $count ) . '" value="' . esc_attr( $feature->term_id ) . '" checked />';
                        echo esc_attr( $feature->name );
                    } else {
                        echo '<input type="checkbox" name="prop_features[]" id="feature-' . esc_attr( $count ) . '" value="' . esc_attr( $feature->term_id ) . '" />';
                        echo esc_attr( $feature->name );
                    }
                    echo '</label>';
                    echo '</div>';
                    echo '</div>';
                    $count++;

                }
            }
            ?>

            </div>
        </div>
    </div>
</div>
