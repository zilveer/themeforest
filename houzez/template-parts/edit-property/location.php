<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/01/16
 * Time: 5:45 PM
 */
global $prop_meta_data, $prop_data, $required_fields;
$prop_location = $prop_meta_data['fave_property_location'][0];
$prop_location = explode(",", $prop_location);
$location_dropdowns = houzez_option('location_dropdowns');
$geo_country_limit = houzez_option('geo_country_limit');

$geocomplete_country = '';
if( $geo_country_limit != 0 ) {
    $geocomplete_country = houzez_option('geocomplete_country');
}
?>
<div class="account-block">

    <script>
        jQuery(function($){
            $("#geocomplete").geocomplete({
                map: ".map_canvas",
                details: "form",
                types: ["geocode", "establishment"],
                country: '<?php echo esc_attr($geocomplete_country);?>',
                markerOptions: {
                    draggable: true
                }
            });

            $("#geocomplete").bind("geocode:dragged", function(event, latLng){
                $("input[name=lat]").val(latLng.lat());
                $("input[name=lng]").val(latLng.lng());
                $("#reset").show();
            });


            $("#reset").click(function(){
                $("#geocomplete").geocomplete("resetMarker");
                $("#reset").hide();
                return false;
            });

            $("#find").click(function(e){
                e.preventDefault();
                $("#geocomplete").trigger("geocode");
            });

            $(window).load(function() {
                $("#geocomplete").trigger("geocode");
            })
        });
    </script>

    <div class="add-title-tab">
        <h3><?php esc_html_e( 'Property location', 'houzez' ); ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row  push-padding-bottom">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="address"><?php echo esc_html__( 'Address', 'houzez' ).houzez_required_field( $required_fields['property_map_address'] ); ?></label>
                        <input class="form-control" name="property_map_address" value="<?php echo sanitize_text_field( $prop_meta_data['fave_property_map_address'][0] ); ?>" id="geocomplete" placeholder="<?php esc_html_e( 'Enter your property address', 'houzez' ); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="neighborhood"><?php esc_html_e( 'Neighborhood', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="neighborhood" id="neighborhood" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <?php houzez_taxonomy_edit_hirarchical_options_for_search( $prop_data->ID, 'property_area'); ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="neighborhood" value="<?php echo houzez_taxonomy_by_postID( $prop_data->ID, 'property_area' ); ?>" id="neighborhood" placeholder="<?php esc_html_e( 'Enter your property neighborhood', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city"><?php esc_html_e( 'City', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="locality" id="city" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <?php houzez_taxonomy_edit_hirarchical_options_for_search( $prop_data->ID, 'property_city'); ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" value="<?php echo houzez_taxonomy_by_postID( $prop_data->ID, 'property_city' ); ?>" name="locality" id="city" placeholder="<?php esc_html_e( 'Enter your property city', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="zip"><?php esc_html_e( 'Postal Code / Zip', 'houzez' ); ?></label>
                        <input class="form-control" name="postal_code" value="<?php if( isset($prop_meta_data['fave_property_zip'][0]) ) { echo sanitize_text_field( $prop_meta_data['fave_property_zip'][0] ); } ?>" id="zip" placeholder="<?php esc_html_e( 'Enter your property zip code', 'houzez' ); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="countyState"><?php esc_html_e( 'County / State', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="administrative_area_level_1" id="countyState" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <?php houzez_taxonomy_edit_hirarchical_options_for_search( $prop_data->ID, 'property_state'); ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" value="<?php echo houzez_taxonomy_by_postID( $prop_data->ID, 'property_state' ); ?>" name="administrative_area_level_1" id="countyState" placeholder="<?php esc_html_e( 'Enter your property county/state', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6 submit_country_field">
                    <div class="form-group">
                        <label for="country"><?php esc_html_e( 'Country', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="country_short" id="country_short" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <?php
                                $countries_list = houzez_countries_list();
                                foreach( $countries_list as $key => $country ):
                                    echo '<option '.selected( $prop_meta_data['fave_property_country'][0], $key, false ).' value="'.$key.'">'.$country.'</option>';
                                endforeach;
                                ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="country" value="<?php echo houzez_country_code_to_country($prop_meta_data['fave_property_country'][0]); ?>" id="country" placeholder="<?php esc_html_e( 'Enter your property country', 'houzez' ); ?>">
                            <input name="country_short" type="hidden" value="<?php echo sanitize_text_field( $prop_meta_data['fave_property_country'][0] ); ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-tab-row">
            <div class="row">
                <div class="col-sm-6">
                    <div class="map_canvas" id="map">
                    </div>
                    <button id="find" class="btn btn-primary btn-block"><?php esc_html_e( 'Place the pin the address above', 'houzez' ); ?></button>
                    <a id="reset" href="#" style="display:none;"><?php esc_html_e('Reset Marker', 'houzez');?></a>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="latitude"><?php esc_html_e( 'Google Maps latitude', 'houzez' ); ?></label>
                        <input class="form-control" value="<?php echo sanitize_text_field( $prop_location[0] ); ?>" name="lat" id="latitude" placeholder="<?php esc_html_e( 'Enter google maps latitude', 'houzez' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="longitude"><?php esc_html_e( 'Google Maps longitude', 'houzez' ); ?></label>
                        <input class="form-control" value="<?php echo sanitize_text_field( $prop_location[1] ); ?>" name="lng" id="longitude" placeholder="<?php esc_html_e( 'Enter google maps longitude', 'houzez' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="prop_google_street_view"><?php esc_html_e('Google Map Street View', 'houzez'); ?></label>
                        <select name="prop_google_street_view" id="prop_google_street_view" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <option <?php selected( $prop_meta_data['fave_property_map_street_view'][0], 'hide' ); ?> value="hide"><?php esc_html_e('Hide', 'houzez'); ?></option>
                            <option <?php selected( $prop_meta_data['fave_property_map_street_view'][0], 'show' ); ?> value="show"><?php esc_html_e('Show', 'houzez'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>