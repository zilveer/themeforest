<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $day
 * @var $name
 * @var $price
 * @var $discount
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Deal
 */
$el_class = $day = $name = $price = $discount = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script("gatherdirections-js", get_template_directory_uri() . "/js/plugins/directions.js", array('gathergoogle-hotel-map-js'), false, true);
?>
<div class="row directions-form<?php echo esc_attr($el_class );?>">
    <div class="col-sm-6">
        <form action="/routebeschrijving" onSubmit="calcRoute();return false;" id="routeForm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="routeStart"><?php _e('Direction From:','gather');?></label>
                        <input type="text" id="routeStart" class="form-control" placeholder="<?php _e('Gothenburg','gather' );?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="routeVia"><?php _e('Via<small>(Optional)</small> ','gather');?></label>
                        <input type="text" class="form-control" id="routeVia" value="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="sr-only"><?php _e('Travel mode:','gather');?></label>
                <label class="radio-inline" for="travelMode1">
                    <input type="radio" name="travelMode" id="travelMode1" value="DRIVING" checked /><?php _e(' Driving','gather');?>
                </label>
                <label class="radio-inline" for="travelMode2">
                    <input type="radio" name="travelMode" id="travelMode2" value="BICYCLING" /><?php _e(' Bicylcing','gather');?>
                </label>
                <label class="radio-inline" for="travelMode3">
                    <input type="radio" name="travelMode" id="travelMode3" value="TRANSIT" /><?php _e(' Public transport','gather');?>
                </label>
                <label class="radio-inline" for="travelMode4">
                    <input type="radio" name="travelMode" id="travelMode4" value="WALKING" /><?php _e(' Walking','gather');?>
                </label>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-block"><?php _e('<i class="fa fa-location-arrow"></i> Get Directions ','gather');?></button>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <div class="directions-results">
            <div id="directionsPanel">
                <div class="direction-text"><?php _e('Enter Direction from and Travel Mode from the left form to see directions. ','gather');?></div>
            </div>
        </div>
    </div>
</div>