<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/08/16
 * Time: 11:58 PM
 */
global $prop_data, $prop_meta_data, $hide_add_prop_fields, $required_fields;
$floor_plans = get_post_meta( $prop_data->ID, 'floor_plans', true );
$floor_plans_enable = get_post_meta( $prop_data->ID, 'fave_floor_plans_enable', true );
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
                                    <option value="disable" <?php selected( $floor_plans_enable, 'disable' ); ?>><?php esc_html_e('Disable', 'houzez'); ?></option>
                                    <option value="enable" <?php selected( $floor_plans_enable, 'enable' ); ?>><?php esc_html_e('Enable', 'houzez'); ?></option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove"></td>
                </tr>
                </thead>
                <tbody id="houzez_floor_plans_main">

                <?php
                $count = 0;
                if( !empty($floor_plans) ) {
                foreach ($floor_plans as $floorplan): ?>
                <tr>
                    <td class="row-sort">
                        <span class="sort sort-floorplan-row"><i class="fa fa-navicon"></i></span>
                    </td>
                    <td class="sort-middle">
                        <div class="sort-inner-block">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_title]"><?php esc_html_e('Plan Title', 'houzez'); ?></label>
                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_title'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_title]" type="text" id="fave_plan_title_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_rooms]"><?php esc_html_e('Plan Bedrooms', 'houzez'); ?></label>
                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_rooms'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_rooms]" type="text" id="fave_plan_rooms_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_bathrooms]"><?php esc_html_e('Plan Bathrooms', 'houzez'); ?></label>
                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_bathrooms'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_bathrooms]" type="text" id="fave_plan_bathrooms_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_price]"><?php esc_html_e('Plan Price', 'houzez'); ?></label>
                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_price'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_price]" type="text" id="fave_plan_price_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_price_postfix]"><?php esc_html_e('Price Postfix', 'houzez'); ?></label>
                                        <input  value="<?php echo sanitize_text_field( $floorplan['fave_plan_price_postfix'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_price_postfix]" type="text" id="fave_plan_price_postfix_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_size]"><?php esc_html_e('Plan Size', 'houzez'); ?></label>
                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_size'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_size]" type="text" id="fave_plan_size_<?php echo intval($count); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="table-list">
                                        <div class="form-group table-cell full-width" style="padding-right: 8px;">
                                            <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_image]"><?php esc_html_e('Plan Image', 'houzez'); ?></label>
                                            <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_image'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_image]" type="text" id="fave_plan_image_<?php echo intval($count); ?>" class="fave_plan_image form-control">
                                        </div>
                                        <div class="table-cell v-align-bottom">
                                            <button id="<?php echo esc_attr( $count ); ?>" class="floorPlansImg btn btn-primary"><?php esc_html_e('Upload', 'houzez'); ?></button>
                                        </div>
                                        <div id="plupload-container"></div>
                                        <div id="errors-log"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_description]"><?php esc_html_e('Plan Description', 'houzez'); ?></label>
                                        <textarea name="floor_plans[<?php echo intval($count); ?>][fave_plan_description]" rows="4" id="fave_plan_description_<?php echo intval($count); ?>" class="form-control"><?php echo sanitize_text_field( $floorplan['fave_plan_description'] ); ?></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </td>
                    <td class="row-remove">
                        <span data-remove="<?php echo esc_attr( $count-1 ); ?>" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
                    </td>
                </tr>

                <?php $count++; ?>
                <?php endforeach;

                }
                ?>

                </tbody>
                <tfoot>
                <tr>
                    <td class="row-sort"></td>
                    <td class="sort-middle">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <button id="add-floorplan-row" data-increment="<?php echo esc_attr( $count-1 ); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php esc_html_e( 'Add More', 'houzez' ); ?></button>
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
