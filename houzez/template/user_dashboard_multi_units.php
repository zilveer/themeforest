<?php
/**
 * Template Name: User Dashboard Multi-units / Sub Properties
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

$multi_units = get_post_meta( $prop_id, 'fave_multi_units', true );
$multiunit_plans_enable = get_post_meta( $prop_id, 'fave_multiunit_plans_enable', true );

$multiunit_link = houzez_get_template_link_2('template/user_dashboard_multi_units.php');

$multiunit_link = $multiunit_link.'?listing_id='.$prop_id;

if( isset( $_POST['action'] ) ) {

    if (wp_verify_nonce($_POST['multiUnits_nonce'], 'submit_multiUnits')) {

        if( isset( $_POST['multiUnits'] ) ) {
            $multiUnits_enable = $_POST['multiUnits'];
            if( ! empty( $multiUnits_enable ) ) {
                update_post_meta( $prop_id, 'fave_multiunit_plans_enable', $multiUnits_enable );
            }
        }

        if( isset( $_POST['fave_multi_units'] ) ) {
            $fave_multi_units = $_POST['fave_multi_units'];
            if( ! empty( $fave_multi_units ) ) {
                update_post_meta( $prop_id, 'fave_multi_units', $fave_multi_units );
            }
        }

        if ( !empty( $multiunit_link ) ) {
            $separator = ( parse_url( $multiunit_link, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
            $parameter = ( $updated_successfully ) ? 'multiUnits-updated=true' : 'multiUnits-added=true';
            wp_redirect( $multiunit_link . $separator . $parameter );
        }

    }// end verify nonce
}

get_header(); ?>

<?php get_template_part( 'template-parts/dashboard-title'); ?>

<div class="user-dashboard-full">
    <?php get_template_part( 'template-parts/dashboard', 'menu' ); ?>

    <div class="profile-area-content">
    <form id="submit_property_multiunit" name="new_post" method="post" action="#" enctype="multipart/form-data"
          class="add-frontend-multiunit">

        <div class="account-block">
            <div class="add-title-tab">
                <h3><?php echo $houzez_local['mu_for']; ?> <?php echo $property_title; ?></h3>
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
                                        <label for="multuUnits"><?php echo $houzez_local['multi_unit']; ?></label>
                                        <select class="selectpicker" name="multiUnits" id="multiUnits" data-live-search="false" data-live-search-style="begins">
                                            <option value="disable" <?php selected( $multiunit_plans_enable, 'disable' ); ?>><?php echo $houzez_local['disable']; ?></option>
                                            <option value="enable" <?php selected( $multiunit_plans_enable, 'enable' ); ?>><?php echo $houzez_local['enable']; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="row-remove"></td>
                        </tr>
                        </thead>

                        <tbody id="multi_units_main">

                        <?php
                        $count = 0;
                        if( !empty($multi_units) ) {
                            foreach ($multi_units as $multi_unit): ?>

                                <tr>
                                    <td class="row-sort">
                                        <span class="sort-subproperty-row sort"><i class="fa fa-navicon"></i></span>
                                    </td>
                                    <td class="sort-middle">
                                        <div class="sort-inner-block">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_title]"><?php echo $houzez_local['mu_title']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_title'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_title]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_beds]"><?php echo $houzez_local['mu_beds']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_beds'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_beds]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_baths]"><?php echo $houzez_local['mu_baths']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_baths'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_baths]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_size]"><?php echo $houzez_local['mu_prop_size']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_size'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_size]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_size_postfix]"><?php echo $houzez_local['mu_size_postfix']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_size_postfix'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_size_postfix]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_price]"><?php echo $houzez_local['mu_price']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_price'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_price]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_price_postfix]"><?php echo $houzez_local['mu_price_postfix']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_price_postfix'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_price_postfix]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_type]"><?php echo $houzez_local['mu_prop_type']; ?></label>
                                                        <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_type'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_type]" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <label for="fave_multi_units[<?php echo intval($count); ?>][fave_mu_availability_date]"><?php echo $houzez_local['mu_date']; ?></label>
                                                    <input value="<?php echo sanitize_text_field( $multi_unit['fave_mu_availability_date'] ); ?>" name="fave_multi_units[<?php echo intval($count); ?>][fave_mu_availability_date]" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="row-remove">
                                        <span data-remove="<?php echo esc_attr( $count-1 ); ?>" class="remove-subproperty-row remove"><i class="fa fa-remove"></i></span>
                                    </td>
                                </tr>

                                <?php $count++; ?>
                            <?php endforeach;

                        } else { ?>

                            <tr>
                                <td class="row-sort">
                                    <span class="sort-subproperty-row sort"><i class="fa fa-navicon"></i></span>
                                </td>
                                <td class="sort-middle">
                                    <div class="sort-inner-block">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_title]"><?php echo $houzez_local['mu_title']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_title]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_beds]"><?php echo $houzez_local['mu_beds']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_beds]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_baths]"><?php echo $houzez_local['mu_baths']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_baths]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_size]"><?php echo $houzez_local['mu_prop_size']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_size]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_size_postfix]"><?php echo $houzez_local['mu_size_postfix']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_size_postfix]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_price]"><?php echo $houzez_local['mu_price']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_price]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_price_postfix]"><?php echo $houzez_local['mu_price_postfix']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_price_postfix]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="fave_multi_units[0][fave_mu_type]"><?php echo $houzez_local['mu_prop_type']; ?></label>
                                                    <input name="fave_multi_units[0][fave_mu_type]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <label for="fave_multi_units[0][fave_mu_availability_date]"><?php echo $houzez_local['mu_date']; ?></label>
                                                <input name="fave_multi_units[0][fave_mu_availability_date]" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="row-remove">
                                    <span data-remove="0" class="remove-subproperty-row remove"><i class="fa fa-remove"></i></span>
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
                                        <?php if( !empty($multi_units) ) { ?>
                                            <button id="add-subproperty-row" data-increment="<?php echo esc_attr( $count-1 ); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $houzez_local['add_more']; ?></button>
                                        <?php } else { ?>
                                            <button id="add-subproperty-row" data-increment="0" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $houzez_local['add_more']; ?></button>
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
            <?php wp_nonce_field('submit_multiUnits', 'multiUnits_nonce'); ?>
            <input type="hidden" name="action" value="add_multiUnits"/>
            <button type="submit" id="add_new_multiUnits"
                    class="btn btn-primary"><?php echo $houzez_local['submit']; ?></button>
        </div>

    </form>
    </div>
</div>

<?php get_footer();?>