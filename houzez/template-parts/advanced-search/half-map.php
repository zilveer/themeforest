<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/06/16
 * Time: 11:08 PM
 */
global $measurement_unit_adv_search, $houzez_local;

if( $measurement_unit_adv_search == 'sqft' ) {
    $measurement_unit_adv_search = houzez_option('measurement_unit_sqft_text');
} elseif( $measurement_unit_adv_search == 'sq_meter' ) {
    $measurement_unit_adv_search = houzez_option('measurement_unit_square_meter_text');
}

$adv_search_price_slider = houzez_option('adv_search_price_slider');
$status = $type = $location = $area = $searched_country = '';
$adv_show_hide = houzez_option('adv_show_hide');

if( isset( $_GET['status'] ) ) {
    $status = $_GET['status'];
}
if( isset( $_GET['type'] ) ) {
    $type = $_GET['type'];
}
if( isset( $_GET['location'] ) ) {
    $location = $_GET['location'];
}
if( isset( $_GET['area'] ) ) {
    $area = $_GET['area'];
}
if( isset( $_GET['state'] ) ) {
    $state = $_GET['state'];
}
if( isset( $_GET['country'] ) ) {
    $searched_country = $_GET['country'];
}

$keyword_field = houzez_option('keyword_field');

if( $keyword_field == 'prop_title' ) {
    $keyword_field_placeholder = $houzez_local['keyword_text'];

} else if( $keyword_field == 'prop_city_state_county' ) {
    $keyword_field_placeholder = $houzez_local['city_state_area'];

} else if( $keyword_field == 'prop_address' ) {
    $keyword_field_placeholder = $houzez_local['search_address'];

} else {
    $keyword_field_placeholder = $houzez_local['enter_location'];
}
$checked = true;
$radius_unit = houzez_option('radius_unit');
$enable_radius_search = houzez_option('enable_radius_search');

if ($adv_show_hide['keyword'] != 1) {
    $geo_location_field_classes = 'col-md-6 col-sm-6 col-xs-6';
} else {
    $geo_location_field_classes = 'col-md-12 col-sm-12 col-xs-12';
}
?>
<script>
    jQuery(function($){
        /*$("input.search_location").geocomplete({
            details: "form",
            blur: true,
            geocodeAfterResult: true
        }).bind("geocode:result", function(event, result){ alert('sdgsgsd');
            /!*var current_form = $(this).parents('form');
            var form_widget = $(this).parents('.widget_houzez_advanced_search');
            houzez_search_on_change(current_form, form_widget);*!/
        });*/
    });
</script>
<div class="advanced-search houzez-adv-price-range">

    <form method="get" action="#">

        <?php if( $enable_radius_search != 0 ) { ?>
            <input type="hidden" name="search_radius" id="radius-range-value">
            <input type="hidden" name="lat" value="<?php echo isset ( $_GET['lat'] ) ? $_GET['lat'] : ''; ?>" id="latitude">
            <input type="hidden" name="lng" value="<?php echo isset ( $_GET['lng'] ) ? $_GET['lng'] : ''; ?>" id="longitude">
        <div class="row">
            <?php if ($adv_show_hide['keyword'] != 1) { ?>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="form-group table-list search-long">
                    <div class="input-search input-icon">
                        <input type="text" class="form-control" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="<?php esc_attr_e($geo_location_field_classes);?>">
                <div class="form-group">
                    <div class="search-location">
                        <input type="text" class="form-control search_location" value="<?php echo isset ( $_GET['search_location'] ) ? $_GET['search_location'] : ''; ?>" name="search_location" placeholder="<?php echo esc_html__('Location', 'houzez'); ?>">
                        <i class="location-trigger fa fa-dot-circle-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 col-xs-3">
                <div class="form-group">
                    <div class="radius-text-wrap">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="use_radius" id="use_radius" <?php checked( true, $checked ); ?>"> <?php echo esc_html__('Radius:', 'houzez'); ?> <strong><span id="radius-range-text">0</span> <?php echo esc_attr($radius_unit); ?></strong>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-xs-9">
                <div class="radius-range-wrap">
                    <div id="radius-range-slider"></div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row">

            <?php if( $enable_radius_search != 1 ) {
                if ($adv_show_hide['keyword'] != 1) { ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group table-list search-long">
                            <div class="input-search input-icon">
                                <input type="text" class="form-control"
                                       value="<?php echo isset ($_GET['keyword']) ? $_GET['keyword'] : ''; ?>"
                                       name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                            </div>
                        </div>
                    </div>
                <?php }
            }?>

            <?php if( $adv_show_hide['countries'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select name="country" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                        <?php
                        // All Option
                        echo '<option value="">'.esc_html__('All Countries', 'houzez').'</option>';

                        countries_dropdown( $searched_country );
                        ?>
                    </select>
                </div>
            </div>
            <?php } ?>

            <?php if( $adv_show_hide['states'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select name="state" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                        <?php
                        // All Option
                        echo '<option value="">'.esc_html__('All States', 'houzez').'</option>';

                        $prop_state = get_terms (
                            array(
                                "property_state"
                            ),
                            array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true,
                                'parent' => 0
                            )
                        );
                        houzez_hirarchical_options('property_state', $prop_state, $state );
                        ?>
                    </select>
                </div>
            </div>
            <?php } ?>

            <?php if( $adv_show_hide['cities'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                <select name="location" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                    <?php
                    // All Option
                    echo '<option value="">'.$houzez_local['all_cities'].'</option>';

                    $prop_city = get_terms (
                        array(
                            "property_city"
                        ),
                        array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => true,
                            'parent' => 0
                        )
                    );
                    houzez_hirarchical_options('property_city', $prop_city, $location );
                    ?>
                </select>
                </div>
            </div>
            <?php } ?>


            <?php if( $adv_show_hide['areas'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select name="area" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                        <?php
                        // All Option
                        echo '<option value="">'.$houzez_local['all_areas'].'</option>';

                        $prop_area = get_terms (
                            array(
                                "property_area"
                            ),
                            array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true,
                                'parent' => 0
                            )
                        );
                        houzez_hirarchical_options('property_area', $prop_area, $area );
                        ?>
                    </select>
                </div>
            </div>
            <?php } ?>


            <?php if( $adv_show_hide['status'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select class="selectpicker" name="status" data-live-search="false" data-live-search-style="begins">
                        <?php
                        // All Option
                        echo '<option value="">'.$houzez_local['all_status'].'</option>';

                        $prop_status = get_terms (
                            array(
                                "property_status"
                            ),
                            array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'parent' => 0
                            )
                        );
                        houzez_hirarchical_options('property_status', $prop_status, $status );
                        ?>
                    </select>
                </div>
            </div>
            <?php } ?>


            <?php if( $adv_show_hide['type'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select class="selectpicker" name="type" data-live-search="false" data-live-search-style="begins">
                        <?php
                        // All Option
                        echo '<option value="">'.$houzez_local['all_types'].'</option>';

                        $prop_type = get_terms (
                            array(
                                "property_type"
                            ),
                            array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => false,
                                'parent' => 0
                            )
                        );
                        houzez_hirarchical_options('property_type', $prop_type, $type );
                        ?>
                    </select>
                </div>
            </div>
            <?php } ?>

            <?php if( $adv_show_hide['beds'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select name="bedrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                        <option value=""><?php echo $houzez_local['bedrooms']; ?></option>
                        <?php houzez_number_list('bedrooms'); ?>
                    </select>
                </div>
            </div>
            <?php } ?>

            <?php if( $adv_show_hide['baths'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <select name="bathrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                        <option value=""><?php echo $houzez_local['bathrooms']; ?></option>
                        <?php houzez_number_list('bathrooms'); ?>
                    </select>
                </div>
            </div>
            <?php } ?>


            <?php if( $adv_show_hide['min_area'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo isset ( $_GET['min-area'] ) ? $_GET['min-area'] : ''; ?>" name="min-area" placeholder="<?php echo $houzez_local['min_area']; ?>">
                </div>
            </div>
            <?php } ?>

            <?php if( $adv_show_hide['max_area'] != 1 ) { ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="form-group">
                    <input type="text" class="form-control" value="<?php echo isset ( $_GET['max-area'] ) ? $_GET['max-area'] : ''; ?>" name="max-area" placeholder="<?php echo $houzez_local['max_area']; ?>">
                </div>
            </div>
            <?php } ?>

            <div class="col-md-3 col-sm-6 col-xs-6 sech_avl_date">
                <div class="form-group">
                    <div class="input-calendar input-icon input-icon-right">
                        <input name="publish_date" class="form-control search-date" placeholder="<?php echo $houzez_local['available_from']; ?>" type="text">
                    </div>
                </div>
            </div>

            <?php if( $adv_search_price_slider != 0 ) { ?>
                <?php if( $adv_show_hide['price_slider'] != 1 ) { ?>
                    <div class="col-sm-12 col-xs-12">
                        <div class="range-advanced-main">
                            <div class="range-text">
                                <input type="hidden" name="min-price" class="min-price-range-hidden range-input" readonly >
                                <input type="hidden" name="max-price" class="max-price-range-hidden range-input" readonly >
                                <p><span class="range-title"><?php echo $houzez_local['price_range'];?></span> <?php echo $houzez_local['from']; ?> <span class="min-price-range"></span> <?php echo $houzez_local['to']; ?> <span class="max-price-range"></span></p>
                            </div>
                            <div class="range-wrap">
                                <div class="price-range-advanced"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            <?php } else { ?>

                <?php if( $adv_show_hide['min_price'] != 1 ) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group prices-for-all">
                            <select name="min-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                <option value=""><?php echo $houzez_local['min_price']; ?></option>
                                <?php houzez_min_price_list(); ?>
                            </select>
                        </div>
                        <div class="form-group hide prices-only-for-rent">
                            <select name="min-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                <option value=""><?php echo $houzez_local['min_price']; ?></option>
                                <?php houzez_min_price_list_for_rent(); ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>

                <?php if( $adv_show_hide['max_price'] != 1 ) { ?>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="form-group prices-for-all">
                            <select name="max-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                <option value=""><?php echo $houzez_local['max_price']; ?></option>
                                <?php houzez_max_price_list() ?>
                            </select>
                        </div>
                        <div class="form-group hide prices-only-for-rent">
                            <select name="max-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                <option value=""><?php echo $houzez_local['max_price']; ?></option>
                                <?php houzez_max_price_list_for_rent() ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>

            <?php if( $adv_show_hide['other_features'] != 1 ) { ?>
            <div class="col-sm-12 col-xs-12">
                <label class="advance-trigger"><i class="fa fa-plus-square"></i> <?php echo $houzez_local['other_feature']; ?> </label>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="features-list field-expand">
                        <div class="clearfix"></div>
                        <?php get_template_part('template-parts/advanced-search/search-features'); ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <button type="submit" id="half_map_update" class="btn btn-primary btn-block"><?php echo esc_html__('Update', 'houzez'); ?></button>
                </div>
            </div>

        </div>

    </form>
</div>