<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/09/16
 * Time: 12:49 PM
 */
?>
<h3 class="side-block-title"> <?php esc_attr_e( 'Membership Package', 'houzez' ); ?> </h3>

<?php
$currency_symbol = houzez_option( 'currency_symbol' );
$where_currency = houzez_option( 'currency_position' );
$select_packages_link = houzez_get_template_link('template/template-packages.php');

if( isset( $_GET['selected_package'] ) ) {
    $selected_package_id     = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';
    $pack_price              = get_post_meta( $selected_package_id, 'fave_package_price', true );
    $pack_listings           = get_post_meta( $selected_package_id, 'fave_package_listings', true );
    $pack_featured_listings  = get_post_meta( $selected_package_id, 'fave_package_featured_listings', true );
    $pack_unlimited_listings = get_post_meta( $selected_package_id, 'fave_unlimited_listings', true );
    $pack_billing_period     = get_post_meta( $selected_package_id, 'fave_billing_time_unit', true );
    $pack_billing_frquency   = get_post_meta( $selected_package_id, 'fave_billing_unit', true );
    $fave_package_popular    = get_post_meta( $selected_package_id, 'fave_package_popular', true );

    if( $pack_billing_frquency > 1 ) {
        $pack_billing_period .='s';
    }
    if ( $where_currency == 'before' ) {
        $package_price = $currency_symbol.' '.$pack_price;
    } else {
        $package_price = $pack_price.' '.$currency_symbol;
    }

    ?>
    <ul class="pkg-total-list">
        <li>
            <span id="houzez_package_name" class="pull-left"><?php echo get_the_title( $selected_package_id ); ?></span>
            <span class="pull-right"><a href="<?php echo esc_url( $select_packages_link ); ?>"><?php esc_attr_e( 'Change Packages', 'houzez' ); ?></a></span>
        </li>
        <li>
            <span class="pull-left"><?php esc_html_e( 'Package Time:', 'houzez' ); ?></span>
            <span class="pull-right"><strong><?php echo esc_attr( $pack_billing_frquency ).' '.HOUZEZ_billing_period( $pack_billing_period ); ?></strong></span>
        </li>
        <li>
            <span class="pull-left"><?php esc_html_e( 'Listing Included:', 'houzez' ); ?></span>
                                <span class="pull-right">
                                    <?php if( $pack_unlimited_listings == 1 ) { ?>
                                        <strong><?php esc_html_e( 'Unlimited Listings', 'houzez' ); ?></strong>
                                    <?php } else { ?>
                                        <strong><?php echo esc_attr( $pack_listings ); ?></strong>
                                    <?php } ?>
                                </span>
        </li>
        <li>
            <span class="pull-left"><?php esc_html_e( 'Featured Listing Included:', 'houzez' ); ?></span>
            <span class="pull-right"><strong><?php echo esc_attr( $pack_featured_listings ); ?></strong></span>
        </li>
        <li>
            <span class="pull-left"><?php esc_html_e( 'Total Price:', 'houzez' ); ?></span>
            <span class="pull-right"><?php echo esc_attr( $package_price ); ?></span>
        </li>
    </ul>
<?php } ?>
