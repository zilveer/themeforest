<?php
/**
 * Template Name: User Dashboard Floor Plans
 *
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 29/07/16
 * Time: 5:10 PM
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );exit;
}

global $houzez_local, $current_user;
$current_user = wp_get_current_user();
$prop_id = '';

if( isset( $_GET['listing_id'] ) && is_numeric( $_GET['listing_id'] ) ){
    $prop_id = intval( $_GET['listing_id']);
    $property_title = get_the_title( $prop_id );
}


$the_post = get_post( $prop_id );
if( $current_user->ID != $the_post->post_author ) {
    exit('You don\'t have the rights to edit this');
}

$floor_plans = get_post_meta( $prop_id, 'floor_plans', true );
$floor_plans_enable = get_post_meta( $prop_id, 'fave_floor_plans_enable', true );

$floor_plans_link = houzez_get_template_link_2('template/user_dashboard_floor_plans.php');

$floor_plans_link = $floor_plans_link.'?listing_id='.$prop_id;

if( isset( $_POST['action'] ) ) {

    if (wp_verify_nonce($_POST['floorplan_nonce'], 'submit_floorplan')) {

        if( isset( $_POST['floorPlans_enable'] ) ) {
            $floorPlans_enable = $_POST['floorPlans_enable'];
            if( ! empty( $floorPlans_enable ) ) {
                update_post_meta( $prop_id, 'fave_floor_plans_enable', $floorPlans_enable );
            }
        }

        if( isset( $_POST['floor_plans'] ) ) {
            $floor_plans_post = $_POST['floor_plans'];
            if( ! empty( $floor_plans_post ) ) {
                update_post_meta( $prop_id, 'floor_plans', $floor_plans_post );
            }
        }

        if ( !empty( $floor_plans_link ) ) {
            $separator = ( parse_url( $floor_plans_link, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
            $parameter = ( $updated_successfully ) ? 'floorplan-updated=true' : 'floorplan-added=true';
            wp_redirect( $floor_plans_link . $separator . $parameter );
        }

    }// end verify nonce
}

get_header(); ?>

<?php get_template_part( 'template-parts/dashboard-title'); ?>

<div class="user-dashboard-full">
    <?php get_template_part( 'template-parts/dashboard', 'menu' ); ?>

    <div class="profile-area-content">
    <form id="submit_property_floor_plans" name="new_post" method="post" action="#" enctype="multipart/form-data"
          class="add-frontend-floor_plans">

        <div class="account-block">
            <div class="add-title-tab">
                <h3><?php echo $houzez_local['floor_plan_for']; ?> <?php echo $property_title; ?></h3>
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
                                        <label for="floorPlans"><?php echo $houzez_local['floor_plans']; ?></label>
                                        <select class="selectpicker" name="floorPlans_enable" id="floorPlans_enable" data-live-search="false" data-live-search-style="begins">
                                            <option value="disable" <?php selected( $floor_plans_enable, 'disable' ); ?>><?php echo $houzez_local['disable']; ?></option>
                                            <option value="enable" <?php selected( $floor_plans_enable, 'enable' ); ?>><?php echo $houzez_local['enable']; ?></option>
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
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_title]"><?php echo $houzez_local['plan_title']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_title'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_title]" type="text" id="fave_plan_title_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_rooms]"><?php echo $houzez_local['plan_bedrooms']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_rooms'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_rooms]" type="text" id="fave_plan_rooms_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_bathrooms]"><?php echo $houzez_local['plan_bathrooms']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_bathrooms'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_bathrooms]" type="text" id="fave_plan_bathrooms_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_price]"><?php echo $houzez_local['plan_price']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_price'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_price]" type="text" id="fave_plan_price_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_price_postfix]"><?php echo $houzez_local['plan_postfix']; ?></label>
                                                        <input  value="<?php echo sanitize_text_field( $floorplan['fave_plan_price_postfix'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_price_postfix]" type="text" id="fave_plan_price_postfix_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_size]"><?php echo $houzez_local['plan_size']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_size'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_size]" type="text" id="fave_plan_size_<?php echo intval($count); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="table-list">
                                                        <div class="form-group table-cell full-width" style="padding-right: 8px;">
                                                            <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_image]"><?php echo $houzez_local['plan_image']; ?></label>
                                                            <input value="<?php echo sanitize_text_field( $floorplan['fave_plan_image'] ); ?>" name="floor_plans[<?php echo intval($count); ?>][fave_plan_image]" type="text" id="fave_plan_image_<?php echo intval($count); ?>" class="fave_plan_image form-control">
                                                        </div>
                                                        <div class="table-cell v-align-bottom">
                                                            <button id="<?php echo esc_attr( $count ); ?>" class="floorPlansImg btn btn-primary"><?php echo $houzez_local['upload']; ?></button>
                                                        </div>
                                                        <div id="plupload-container"></div>
                                                        <div id="errors-log"></div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="floor_plans[<?php echo intval($count); ?>][fave_plan_description]"><?php echo $houzez_local['plan_des']; ?></label>
                                                        <textarea name="floor_plans[<?php echo intval($count); ?>][fave_plan_description]" rows="4" id="fave_plan_description_<?php echo intval($count); ?>" class="form-control"><?php echo sanitize_text_field( $floorplan['fave_plan_description'] ); ?></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <?php $count++; ?>
                                        </div>
                                    </td>
                                    <td class="row-remove">
                                        <span data-remove="<?php echo esc_attr( $count-1 ); ?>" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
                                    </td>
                                </tr>

                                <?php $count++; ?>
                            <?php endforeach;

                        } else { ?>

                        <tr>
                            <td class="row-sort">
                                <span class="sort-floorplan-row sort"><i class="fa fa-navicon"></i></span>
                            </td>
                            <td class="sort-middle">
                                <div class="sort-inner-block">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_title]"><?php echo $houzez_local['plan_title']; ?></label>
                                                <input name="floor_plans[0][fave_plan_title]" type="text" id="fave_plan_title_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_rooms]"><?php echo $houzez_local['plan_bedrooms']; ?></label>
                                                <input name="floor_plans[0][fave_plan_rooms]" type="text" id="fave_plan_rooms_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_bathrooms]"><?php echo $houzez_local['plan_bathrooms']; ?></label>
                                                <input name="floor_plans[0][fave_plan_bathrooms]" type="text" id="fave_plan_bathrooms_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_price]"><?php echo $houzez_local['plan_price']; ?></label>
                                                <input name="floor_plans[0][fave_plan_price]" type="text" id="fave_plan_price_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_price_postfix]"><?php echo $houzez_local['plan_postfix']; ?></label>
                                                <input name="floor_plans[0][fave_plan_price_postfix]" type="text" id="fave_plan_price_postfix_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_size]"><?php echo $houzez_local['plan_size']; ?></label>
                                                <input name="floor_plans[0][fave_plan_size]" type="text" id="fave_plan_size_0" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label for="floor_plans[0][fave_plan_image]"><?php echo $houzez_local['plan_image']; ?></label>
                                                <div class="file-upload-block">
                                                    <input name="floor_plans[0][fave_plan_image]" type="text" id="fave_plan_image_0" class="fave_plan_image form-control">
                                                    <button id="0" class="floorPlansImg btn btn-primary"><?php echo $houzez_local['upload']; ?></button>
                                                </div>
                                                <div id="plupload-container"></div>
                                                <div id="errors-log"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xs-12">
                                            <label for="floor_plans[0][fave_plan_description]"><?php echo $houzez_local['plan_des']; ?></label>
                                            <textarea name="floor_plans[0][fave_plan_description]" rows="4" id="fave_plan_description_0" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="row-remove">
                                <span data-remove="0" class="remove-floorplan-row remove"><i class="fa fa-remove"></i></span>
                            </td>
                        </tr>

                        <?php } ?>

                        </tbody>

                        <tfoot>
                        <tr>
                            <td class="row-sort"></td>
                            <td class="sort-middle">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <?php if( !empty($floor_plans) ) { ?>
                                            <button id="add-floorplan-row" data-increment="<?php echo esc_attr( $count-1 ); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $houzez_local['add_more']; ?></button>
                                         <?php } else { ?>
                                        <button id="add-floorplan-row" data-increment="0" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $houzez_local['add_more']; ?></button>
                                        <?php } ?>
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

        <div class="account-block text-right">
            <?php wp_nonce_field('submit_floorplan', 'floorplan_nonce'); ?>
            <input type="hidden" name="action" value="add_floor_plans"/>
            <button type="submit" id="add_new_floor_plans"
                    class="btn btn-primary"><?php echo $houzez_local['submit']; ?></button>
        </div>

    </form>
    </div>
</div>

<?php get_footer();?>