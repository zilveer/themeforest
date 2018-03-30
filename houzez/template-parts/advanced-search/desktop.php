<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 20/01/16
 * Time: 6:31 PM
 */
global $status,
       $search_template,
       $type, $location,
       $searched_country,
       $state,
       $area,
       $measurement_unit_adv_search,
       $adv_search_price_slider,
       $hide_advanced,
       $keyword_field_placeholder,
       $adv_show_hide,
       $houzez_local;

$search_width = houzez_option('search_width');
$search_sticky = houzez_option('main-search-sticky');
$search_style = houzez_option('search_style');
$main_menu_sticky = houzez_option('main-menu-sticky');
$features_limit = houzez_option('features_limit');

if( isset($_GET['search_style']) && $_GET['search_style'] == 'v1' ) {
    $search_style = 'style_1';
} else if( isset($_GET['search_style']) && $_GET['search_style'] == 'v2' ) {
    $search_style = 'style_2';

} else if( isset($_GET['search_style']) && $_GET['search_style'] == 'min1' ) {
    $search_style = 'style_1';
    $hide_advanced = true;

} else if( isset($_GET['search_style']) && $_GET['search_style'] == 'min2' ) {
    $search_style = 'style_2';
    $hide_advanced = true;
}

if( !is_404() && !is_search() ) {
    $adv_search_enable = get_post_meta($post->ID, 'fave_adv_search_enable', true);
    $adv_search = get_post_meta($post->ID, 'fave_adv_search', true);
}

$class = $sticky = '';

if( $main_menu_sticky != 1 ) {
    if ((!empty($adv_search_enable) && $adv_search_enable != 'global')) {
        if ($adv_search == 'hide_show') {
            $sticky = '1';
            $class = 'search-hidden';
        } else {
            $sticky = '0';
            $class = '';
        }
    } else {
        $sticky = $search_sticky;
    }
} else {
    $sticky = '0';
}

$radius_unit = houzez_option('radius_unit');
$enable_radius_search = houzez_option('enable_radius_search');

if( $adv_show_hide['cities'] != 1 && $adv_show_hide['areas'] != 1 && $hide_advanced == false ) {
    $col_1_classes = "col-md-6 col-sm-6";
    $col_2_classes = "col-md-6 col-sm-6";
    $adv_col_class = 'col-sm-3';
    $location_select_class = 'location-select';

} elseif( $adv_show_hide['cities'] != 1 && $adv_show_hide['areas'] != 1 && $hide_advanced == true ) {
    $col_1_classes = "col-md-6 col-sm-6";
    $col_2_classes = "col-md-6 col-sm-6";
    $adv_col_class = 'col-sm-4';
    $location_select_class = '';

} elseif( $adv_show_hide['cities'] != 0 && $adv_show_hide['areas'] != 0  && $hide_advanced == false ) {
    $col_1_classes = "col-md-8 col-sm-8";
    $col_2_classes = "col-md-4 col-sm-4";
    $adv_col_class = 'col-sm-6';

} elseif( $adv_show_hide['cities'] != 0 && $adv_show_hide['areas'] != 0  && $hide_advanced == true ) {
    $col_1_classes = "col-md-10 col-sm-10";
    $col_2_classes = "col-md-2 col-sm-2";
    $adv_col_class = 'col-sm-12';

} elseif( ( $adv_show_hide['cities'] != 0 || $adv_show_hide['areas'] != 0 ) && $hide_advanced != false ) {
    $col_1_classes = "col-md-8 col-sm-8";
    $col_2_classes = "col-md-4 col-sm-4";
    $adv_col_class = 'col-sm-6';

} elseif( ( $adv_show_hide['cities'] != 0 || $adv_show_hide['areas'] != 0 ) && $hide_advanced != true ) {
    $col_1_classes = "col-md-7 col-sm-7";
    $col_2_classes = "col-md-5 col-sm-5";
    $adv_col_class = 'col-sm-4';
}
$keyword_field = houzez_option('keyword_field');
if ($adv_show_hide['keyword'] != 1) {
    $geo_location_field_classes = 'col-md-4 col-sm-5';
} else {
    $geo_location_field_classes = 'col-md-8 col-sm-5';
}
$selected_radius = 0;
if( isset( $_GET['radius'] ) ) {
    $selected_radius = $_GET['radius'];
}
$checked = true;
?>

<!--start advanced search section-->
<div class="advanced-search advance-search-header houzez-adv-price-range <?php echo esc_attr( $class ); ?>" data-sticky='<?php echo esc_attr( $sticky ); ?>'>
    <div class="<?php echo esc_attr( $search_width ); ?>">
        <div class="row">
            <div class="col-sm-12">
                <form method="get" action="<?php echo esc_url( $search_template ); ?>">


                    <?php if( $search_style == 'style_1' ) { ?>

                    <?php if( $enable_radius_search == 1 ) { ?>
                            <input type="hidden" name="lat" value="<?php echo isset ( $_GET['lat'] ) ? $_GET['lat'] : ''; ?>" id="latitude">
                            <input type="hidden" name="lng" value="<?php echo isset ( $_GET['lng'] ) ? $_GET['lng'] : ''; ?>" id="longitude">
                            <input type="checkbox" name="use_radius" id="use_radius" <?php checked( true, $checked ); ?>">
                            <div class="row">
                                <?php if ($adv_show_hide['keyword'] != 1) { ?>
                                <div class="col-md-4 col-sm-5">
                                    <div class="form-group no-margin">
                                        <div class="input-search input-icon">
                                            <input type="text" id="keyword" class="form-control" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="<?php esc_attr_e($geo_location_field_classes); ?>">
                                    <div class="form-group no-margin">
                                        <div class="search-location">
                                            <input type="text" class="form-control search_location" value="<?php echo isset ( $_GET['search_location'] ) ? $_GET['search_location'] : ''; ?>" name="search_location" placeholder="<?php echo esc_html__('Location', 'houzez'); ?>">
                                            <i class="location-trigger fa fa-dot-circle-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-7">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <select name="radius" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                                <option value="0"><?php esc_html_e('Radius','houzez');?></option>
                                                <?php
                                                $i = 0;
                                                for( $i = 1; $i <= 100; $i++ ) {
                                                    echo '<option '.selected( $selected_radius, $i, false).' value="'.$i.'">'.$i.' '.$radius_unit.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-xs-6 text-center">
                                            <button class="advance-btn blue btn" type="button"><i class="fa fa-gear"></i><?php echo $houzez_local['advanced']; ?></button>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <button type="submit" class="btn btn-orange btn-block houzez-theme-button"><?php echo $houzez_local['search']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php } else { ?>
                    <div class="row">
                        <div class="<?php echo esc_attr( $col_1_classes );?>">
                            <div class="form-group no-margin">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                    <input type="text" id="keyword" class="form-control" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="<?php echo esc_attr( $col_2_classes );?>">
                            <div class="row">

                                    <?php if( $adv_show_hide['cities'] != 1 ) { ?>
                                    <div class="<?php echo esc_attr($adv_col_class); ?> col-xs-12">
                                        <div class="form-group no-margin <?php echo esc_attr( $location_select_class ); ?>">
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
                                    <div class="<?php echo esc_attr($adv_col_class); ?> col-xs-6">
                                        <div class="form-group no-margin areas-select">
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


                                    <?php if( $hide_advanced != true ) { ?>
                                    <div class="<?php echo esc_attr($adv_col_class); ?> col-xs-6 text-center">
                                        <button class="advance-btn blue btn" type="button"><i class="fa fa-gear"></i><?php echo $houzez_local['advanced']; ?></button>
                                    </div>
                                    <?php } ?>

                                    <div class="<?php echo esc_attr($adv_col_class); ?> col-xs-6">
                                        <button type="submit" class="btn btn-orange btn-block houzez-theme-button"><?php echo $houzez_local['search']; ?></button>
                                    </div>
                            </div>
                        </div>
                    </div>
                     <?php } ?>

                    <?php } elseif( $search_style == 'style_2' ) { ?>

                    <?php if( $enable_radius_search == 1 ) { ?>
                            <input type="hidden" name="lat" value="<?php echo isset ( $_GET['lat'] ) ? $_GET['lat'] : ''; ?>" id="latitude">
                            <input type="hidden" name="lng" value="<?php echo isset ( $_GET['lng'] ) ? $_GET['lng'] : ''; ?>" id="longitude">
                            <input type="checkbox" name="use_radius" id="use_radius" <?php checked( true, $checked ); ?>">
                            <div class="form-group search-long">
                                <div class="search">
                                    <div class="input-search input-icon">
                                        <input class="form-control" type="text" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                                    </div>
                                    <div class="search-location">
                                        <input type="text" class="form-control search_location" value="<?php echo isset ( $_GET['search_location'] ) ? $_GET['search_location'] : ''; ?>" name="search_location" placeholder="<?php echo esc_html__('Location', 'houzez'); ?>">
                                        <i class="location-trigger fa fa-dot-circle-o"></i>
                                    </div>
                                    <select name="radius" class="selectpicker" data-live-search="true" data-live-search-style="begins">
                                        <option value="0"><?php esc_html_e('Radius','houzez');?></option>
                                        <?php
                                        $i = 0;
                                        for( $i = 1; $i <= 100; $i++ ) {
                                            echo '<option value="'.$i.'">'.$i.' '.$radius_unit.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <?php if( $hide_advanced != true ) { ?>
                                        <div class="advance-btn-holder">
                                            <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> <?php echo $houzez_local['advanced']; ?></button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="search-btn">
                                    <button class="btn btn-orange"><?php echo $houzez_local['go']; ?></button>
                                </div>
                            </div>

                    <?php } else { ?>
                        <div class="form-group search-long">
                        
                        <div class="search">
                            <div class="input-search input-icon">
                                <input class="form-control" type="text" value="<?php echo isset ( $_GET['keyword'] ) ? $_GET['keyword'] : ''; ?>" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                            </div>
                            <?php if( $adv_show_hide['countries'] != 1 ) { ?>
                                <select name="country" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_countries'].'</option>';

                                    countries_dropdown( $searched_country );
                                    ?>
                                </select>
                            <?php } ?>

                            <?php if( $adv_show_hide['states'] != 1 ) { ?>
                                <select name="state" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                                    <?php
                                    // All Option
                                    echo '<option value="">'.$houzez_local['all_states'].'</option>';

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
                            <?php } ?>

                                <?php if( $adv_show_hide['cities'] != 1 ) { ?>
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
                                <?php } ?>

                                <?php if( $adv_show_hide['areas'] != 1 ) { ?>
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
                                <?php } ?>


                            <?php if( $hide_advanced != true ) { ?>
                            <div class="advance-btn-holder">
                                <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> <?php echo $houzez_local['advanced']; ?></button>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="search-btn">
                            <button class="btn btn-orange"><?php echo $houzez_local['go']; ?></button>
                        </div>
                    </div>
                    <?php } ?>

                    <?php } ?>

                    <div class="advance-fields">
                        <div class="row">

                            <?php if( $adv_show_hide['status'] != 1 ) { ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="selectpicker" id="selected_status" name="status" data-live-search="false" data-live-search-style="begins">
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
                            <div class="col-sm-3 col-xs-6">
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

                            <?php //if( $adv_show_hide['property_id'] != 1 ) { ?>
                                <!--<div class="col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php /*echo isset ( $_GET['propid'] ) ? $_GET['propid'] : ''; */?>" name="propid" placeholder="<?php /*esc_html_e( 'Property ID', 'houzez' ); */?>">
                                    </div>
                                </div>-->
                            <?php //} ?>

                            <?php if( $adv_show_hide['beds'] != 1 ) { ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select name="bedrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                        <option value=""><?php echo $houzez_local['beds']; ?></option>
                                        <?php houzez_number_list('bedrooms'); ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if( $adv_show_hide['baths'] != 1 ) { ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select name="bathrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="">
                                        <option value=""><?php echo $houzez_local['baths']; ?></option>
                                        <?php houzez_number_list('bathrooms'); ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if( $adv_show_hide['min_area'] != 1 ) { ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo isset ( $_GET['min-area'] ) ? $_GET['min-area'] : ''; ?>" name="min-area" placeholder="<?php echo $houzez_local['min_area']; echo " ($measurement_unit_adv_search)";?>">
                                </div>
                            </div>
                            <?php } ?>

                            <?php if( $adv_show_hide['max_area'] != 1 ) { ?>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo isset ( $_GET['max-area'] ) ? $_GET['max-area'] : ''; ?>" name="max-area" placeholder="<?php echo $houzez_local['max_area']; echo " ($measurement_unit_adv_search)"; ?>">
                                </div>
                            </div>
                            <?php } ?>

                            <?php if( $adv_search_price_slider != 0 ) { ?>
                                <?php if( $adv_show_hide['price_slider'] != 1 ) { ?>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="range-advanced-main">
                                            <div class="range-text">
                                                <input type="hidden" name="min-price" class="min-price-range-hidden range-input" readonly >
                                                <input type="hidden" name="max-price" class="max-price-range-hidden range-input" readonly >
                                                <p><span class="range-title"><?php echo $houzez_local['price_range']; ?></span> <?php echo $houzez_local['from']; ?> <span class="min-price-range"></span> <?php echo $houzez_local['to'];?> <span class="max-price-range"></span></p>
                                            </div>
                                            <div class="range-wrap">
                                                <div class="price-range-advanced"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>

                                <?php if( $adv_show_hide['min_price'] != 1 ) { ?>
                                <div class="col-sm-3 col-xs-6">
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
                                <div class="col-sm-3 col-xs-6">
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
                            <div class="col-sm-12 col-xs-12 features-list">

                                <label class="advance-trigger text-uppercase title"><i class="fa fa-plus-square"></i> <?php echo $houzez_local['other_feature']; ?> </label>
                                <div class="clearfix"></div>
                                <div class="field-expand">
                                    <?php get_template_part('template-parts/advanced-search/search-features'); ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>