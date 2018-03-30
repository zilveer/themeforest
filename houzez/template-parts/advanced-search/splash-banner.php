<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 15/08/16
 * Time: 4:37 AM
 */
global $keyword_field_placeholder;
$adv_search_price_slider = houzez_option('adv_search_price_slider');
$search_template = houzez_get_search_template_link();
$adv_show_hide = houzez_option('adv_show_hide');
$features_limit = houzez_option('features_limit');
?>
<div class="advanced-search">
    <form method="get" action="<?php echo esc_url( $search_template ); ?>">
        <div class="row">
            <div class="col-md-6 col-sm-5">
                <div class="form-group no-margin">
                    <div class="input-search input-icon">
                        <input type="text" class="form-control" name="keyword" placeholder="<?php echo $keyword_field_placeholder; ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-7">
                <div class="row">
                    <div class="col-sm-5 col-xs-6">
                        <div class="form-group">
                            <select class="selectpicker" name="type" data-live-search="false" data-live-search-style="begins">
                                <?php
                                // All Option
                                echo '<option value="">'.esc_html__( 'Property Type', 'houzez' ).'</option>';

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
                                houzez_hirarchical_options('property_type', $prop_type, '' );
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 text-center">
                        <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> Advance</button>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="advance-fields">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <div class="form-group no-margin">
                        <select name="location" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <?php
                            // All Option
                            echo '<option value="">'.esc_html__( 'All Cities', 'houzez' ).'</option>';

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
                            houzez_hirarchical_options('property_city', $prop_city, '' );
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <div class="form-group no-margin">
                        <select name="area" class="selectpicker" data-live-search="false" data-live-search-style="begins">
                            <?php
                            // All Option
                            echo '<option value="">'.esc_html__( 'All Areas', 'houzez' ).'</option>';

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
                <div class="col-sm-3 col-xs-6">
                    <div class="form-group">
                        <select class="selectpicker" id="selected_status" name="status" data-live-search="false" data-live-search-style="begins">
                            <?php
                            // All Option
                            echo '<option value="">'.esc_html__( 'All Status', 'houzez' ).'</option>';

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
                <?php //if( $adv_show_hide['beds'] != 1 ) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <select name="bedrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Beds', 'houzez' ); ?>">
                                <?php houzez_number_list('bedrooms'); ?>
                            </select>
                        </div>
                    </div>
                <?php //} ?>

                <?php //if( $adv_show_hide['baths'] != 1 ) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <select name="bathrooms" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Baths', 'houzez' ); ?>">
                                <?php houzez_number_list('bathrooms'); ?>
                            </select>
                        </div>
                    </div>
                <?php //} ?>

                <?php //if( $adv_show_hide['min_area'] != 1 ) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo isset ( $_GET['min-area'] ) ? $_GET['min-area'] : ''; ?>" name="min-area" placeholder="<?php esc_html_e( 'Min Area', 'houzez' ); ?>">
                        </div>
                    </div>
                <?php //} ?>

                <?php //if( $adv_show_hide['max_area'] != 1 ) { ?>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo isset ( $_GET['max-area'] ) ? $_GET['max-area'] : ''; ?>" name="max-area" placeholder="<?php esc_html_e( 'Max Area', 'houzez' ); ?>">
                        </div>
                    </div>
                <?php //} ?>

                <?php if( $adv_search_price_slider != 0 ) { ?>
                    <?php //if( $adv_show_hide['price_slider'] != 1 ) { ?>
                        <div class="col-sm-6 col-xs-6">
                            <div class="range-advanced-main">
                                <div class="range-text">
                                    <input type="hidden" name="min-price" class="min-price-range-hidden range-input" readonly >
                                    <input type="hidden" name="max-price" class="max-price-range-hidden range-input" readonly >
                                    <p><span class="range-title"><?php echo esc_html_e('Price Range:','houzez');?></span> <?php echo esc_html_e('from','houzez');?> <span class="min-price-range"></span> <?php echo esc_html_e('to','houzez');?> <span class="max-price-range"></span></p>
                                </div>
                                <div class="range-wrap">
                                    <div class="price-range-advanced"></div>
                                </div>
                            </div>
                        </div>
                    <?php //} ?>
                <?php } else { ?>

                    <?php //if( $adv_show_hide['min_price'] != 1 ) { ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group prices-for-all">
                                <select name="min-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Min Price', 'houzez' ); ?>">
                                    <?php houzez_min_price_list(); ?>
                                </select>
                            </div>
                            <div class="form-group hide prices-only-for-rent">
                                <select name="min-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Min Price', 'houzez' ); ?>">
                                    <?php houzez_min_price_list_for_rent(); ?>
                                </select>
                            </div>
                        </div>
                    <?php //} ?>

                    <?php //if( $adv_show_hide['max_price'] != 1 ) { ?>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group prices-for-all">
                                <select name="max-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Max Price', 'houzez' ); ?>">
                                    <?php houzez_max_price_list() ?>
                                </select>
                            </div>
                            <div class="form-group hide prices-only-for-rent">
                                <select name="max-price" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="<?php esc_html_e( 'Max Price', 'houzez' ); ?>">
                                    <?php houzez_max_price_list_for_rent() ?>
                                </select>
                            </div>
                        </div>
                    <?php //} ?>

                <?php } ?>

                <?php if( $adv_show_hide['other_features'] != 1 ) { ?>
                    <div class="col-sm-12 col-xs-12 features-list">

                        <label class="text-uppercase title"><?php esc_html_e( 'Other Features', 'houzez' ); ?></label>
                        <div class="clearfix"></div>
                        <?php

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
                            $count = 0;
                            if (!empty($prop_features)) {
                                foreach ($prop_features as $feature):
                                    if( $features_limit != -1 ) {
                                        if ( $count == $features_limit ) break;
                                    }
                                    echo '<label class="checkbox-inline">';
                                    echo '<input name="feature[]" id="feature-' . esc_attr( $feature->slug ) . '" type="checkbox" value="' . esc_attr( $feature->slug ) . '">';
                                    echo esc_attr( $feature->name );
                                    echo '</label>';
                                    $count++;
                                endforeach;
                            }
                        }
                        ?>
                    </div>
                <?php } ?>

            </div>
        </div>
    </form>
</div>
