<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/01/16
 * Time: 5:45 PM
 */
global $required_fields;
$location_dropdowns = houzez_option('location_dropdowns');
$default_country = houzez_option('default_country');
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
                        <label for="geocomplete"><?php echo esc_html__( 'Address', 'houzez' ).houzez_required_field( $required_fields['property_map_address'] ); ?></label>
                        <input class="form-control" name="property_map_address" id="geocomplete" placeholder="<?php esc_html_e( 'Enter your property address', 'houzez' ); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="neighborhood"><?php esc_html_e( 'Neighborhood', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="neighborhood" id="neighborhood" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                                <?php
                                /* Property Area */
                                $property_area_terms = get_terms (
                                    array(
                                        "property_area"
                                    ),
                                    array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => false,
                                        'parent' => 0
                                    )
                                );
                                houzez_taxonomy_hirarchical_options_for_search( 'property_area', $property_area_terms, -1);
                                ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="neighborhood" id="neighborhood" placeholder="<?php esc_html_e( 'Enter your property neighborhood', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city"><?php esc_html_e( 'City', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="locality" id="locality" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                                <?php
                                /* Property City */
                                $property_cities_terms = get_terms (
                                    array(
                                        "property_city"
                                    ),
                                    array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => false,
                                        'parent' => 0
                                    )
                                );
                                houzez_taxonomy_hirarchical_options_for_search( 'property_city', $property_cities_terms, -1);
                                ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="locality" id="city" placeholder="<?php esc_html_e( 'Enter your property city', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="zip"><?php esc_html_e( 'Postal Code / Zip', 'houzez' ); ?></label>
                        <input class="form-control" name="postal_code" id="zip" placeholder="<?php esc_html_e( 'Enter your property zip code', 'houzez' ); ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="countyState"><?php esc_html_e( 'County / State', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="administrative_area_level_1" id="administrative_area_level_1" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <option selected="selected" value=""><?php esc_html_e('None', 'houzez'); ?></option>
                                <?php
                                /* Property State */
                                $property_state_terms = get_terms (
                                    array(
                                        "property_state"
                                    ),
                                    array(
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => false,
                                        'parent' => 0
                                    )
                                );
                                houzez_taxonomy_hirarchical_options_for_search( 'property_state', $property_state_terms, -1);
                                ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="administrative_area_level_1" id="countyState" placeholder="<?php esc_html_e( 'Enter your property county/state', 'houzez' ); ?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-6 submit_country_field">
                    <div class="form-group">
                        <label for="country"><?php esc_html_e( 'Country', 'houzez' ); ?></label>
                        <?php if( $location_dropdowns == 'yes' ) { ?>
                            <select name="country" id="country" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                <?php
                                    $countries_list = houzez_countries_list();
                                    foreach( $countries_list as $key => $country ):
                                        echo '<option '.selected( $default_country, $key, false ).' value="'.$key.'">'.$country.'</option>';
                                    endforeach;
                                ?>
                            </select>
                        <?php } else { ?>
                            <input class="form-control" name="country" id="country" placeholder="<?php esc_html_e( 'Enter your property country', 'houzez' ); ?>">
                            <input name="country_short" type="hidden" value="">
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
                        <input class="form-control" name="lat" id="latitude" placeholder="<?php esc_html_e( 'Enter google maps latitude', 'houzez' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="longitude"><?php esc_html_e( 'Google Maps longitude', 'houzez' ); ?></label>
                        <input class="form-control" name="lng" id="longitude" placeholder="<?php esc_html_e( 'Enter google maps longitude', 'houzez' ); ?>">
                    </div>
                    <div class="form-group">
                        <label for="prop_google_street_view"><?php esc_html_e('Google Map Street View', 'houzez'); ?></label>
                        <select name="prop_google_street_view" id="prop_google_street_view" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <option value="hide"><?php esc_html_e('Hide', 'houzez'); ?></option>
                            <option value="show"><?php esc_html_e('Show', 'houzez'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
