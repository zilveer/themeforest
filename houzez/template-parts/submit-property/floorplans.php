<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/08/16
 * Time: 11:52 PM
 */
?>
<div class="account-block">
    <div class="add-title-tab">
        <h3><?php esc_html_e('Floor Plans', 'houzez'); ?></h3>
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
                                <label for="floorPlans"><?php esc_html_e('Floor Plans', 'houzez'); ?></label>
                                <select class="selectpicker" name="floorPlans_enable" id="floorPlans_enable" data-live-search="false" data-live-search-style="begins">
                                    <option value="disable"><?php esc_html_e('Disable', 'houzez'); ?></option>
                                    <option value="enable"><?php esc_html_e('Enable', 'houzez'); ?></option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove"></td>
                </tr>
                </thead>
                <tbody id="houzez_floor_plans_main">

                <tr>
                    <td class="row-sort">
                        <span class="sort-floorplan-row sort"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="sort-middle">
                        <div class="sort-inner-block">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_title]"><?php esc_html_e('Plan Title', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_title]" type="text" id="fave_plan_title_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_rooms]"><?php esc_html_e('Plan Bedrooms', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_rooms]" type="text" id="fave_plan_rooms_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_bathrooms]"><?php esc_html_e('Plan Bathrooms', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_bathrooms]" type="text" id="fave_plan_bathrooms_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_price]"><?php esc_html_e('Plan Price', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_price]" type="text" id="fave_plan_price_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_price_postfix]"><?php esc_html_e('Price Postfix', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_price_postfix]" type="text" id="fave_plan_price_postfix_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_size]"><?php esc_html_e('Plan Size', 'houzez'); ?></label>
                                        <input name="floor_plans[0][fave_plan_size]" type="text" id="fave_plan_size_0" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[0][fave_plan_image]"><?php esc_html_e('Plan Image', 'houzez'); ?></label>
                                        <div class="file-upload-block">
                                            <input name="floor_plans[0][fave_plan_image]" type="text" id="fave_plan_image_0" class="fave_plan_image form-control">
                                            <button id="0" class="floorPlansImg btn btn-primary"><?php esc_html_e('Upload', 'houzez'); ?></button>
                                        </div>
                                        <div id="plupload-container"></div>
                                        <div id="errors-log"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <label for="floor_plans[0][fave_plan_description]"><?php esc_html_e('Plan Description', 'houzez'); ?></label>
                                    <textarea name="floor_plans[0][fave_plan_description]" rows="4" id="fave_plan_description_0" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove">
                        <span data-remove="0" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

                </tbody>
                <tfoot>
                <tr>
                    <td class="row-sort"></td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <button id="add-floorplan-row" data-increment="0" class="btn btn-primary"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add More', 'houzez' ); ?></button>
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