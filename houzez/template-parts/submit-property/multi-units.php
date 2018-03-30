<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 10/08/16
 * Time: 12:19 AM
 */
?>
<div class="account-block">
    <div class="add-title-tab">
        <h3><?php esc_html_e('Multi Units / Sub Properties', 'houzez'); ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row">
            <table class="add-sort-table">
                <thead>
                <tr>
                    <td class="row-sort"></td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label for="multiUnits"><?php esc_html_e('Multi Units / Sub Properties', 'houzez'); ?></label>
                                <select class="selectpicker" name="multiUnits" id="multiUnits" data-live-search="false" data-live-search-style="begins">
                                    <option><?php esc_html_e('Disable', 'houzez'); ?></option>
                                    <option><?php esc_html_e('Enable', 'houzez'); ?></option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove"></td>
                </tr>
                </thead>
                <tbody id="multi_units_main">
                <tr>
                    <td class="row-sort">
                        <span class="sort-subproperty-row sort"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="sort-middle">
                        <div class="sort-inner-block">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_title]"><?php esc_html_e('Title', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_title]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_beds]"><?php esc_html_e('Bedrooms', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_beds]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_baths]"><?php esc_html_e('Bathrooms', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_baths]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_size]"><?php esc_html_e('Property Size', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_size]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_size_postfix]"><?php esc_html_e('Size Postfix', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_size_postfix]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_price]"><?php esc_html_e('Price', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_price]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_price_postfix]"><?php esc_html_e('Price Postfix ', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_price_postfix]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="fave_multi_units[0][fave_mu_type]"><?php esc_html_e('Property Type', 'houzez'); ?></label>
                                        <input name="fave_multi_units[0][fave_mu_type]" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label for="fave_multi_units[0][fave_mu_availability_date]"><?php esc_html_e('Availability Date', 'houzez'); ?></label>
                                    <input name="fave_multi_units[0][fave_mu_availability_date]" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove">
                        <span data-remove="0" class="remove-subproperty-row remove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td class="row-sort"></td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <button id="add-subproperty-row" data-increment="0" class="btn btn-primary"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add More', 'houzez' ); ?></button>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
