<?php
/**
 * Template Name: Packages
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/09/16
 * Time: 1:33 PM
 */
global $houzez_local, $current_user;

wp_get_current_user();
$user_id           = $current_user->ID;
$package_listings  = get_the_author_meta( 'package_listings' , $user_id );

$paid_submission_type = esc_html ( houzez_option('enable_paid_submission','') );
if( $paid_submission_type != 'membership' ) {
    wp_redirect( home_url() );
}
if ( !is_user_logged_in() ) {
    wp_redirect( home_url() );
}
/*if( houzez_user_has_membership($user_id) && $package_listings > 0 ) {
    wp_redirect( home_url() );
}
set_time_limit (600);*/

get_header();

$user_pack_id            = get_the_author_meta( 'package_id' , $user_id );
$user_package_activation = get_the_author_meta( 'package_activation' , $user_id );
$user_registered         = get_the_author_meta( 'user_registered' , $user_id );

$is_membership = 0;
$membership_currency = houzez_option( 'currency_paid_submission' );
$currency_symbol = houzez_option( 'currency_symbol' );
$where_currency = houzez_option( 'currency_position' );
$enable_wireTransfer = houzez_option('enable_wireTransfer');
$enable_paypal = houzez_option('enable_paypal');
$enable_stripe = houzez_option('enable_stripe');

$payment_page_link = houzez_get_template_link('template/template-payment.php');
?>
<div class="membership-page-top">
    <?php get_template_part('template-parts/create-listing-top'); ?>
</div>

<div class="membership-content-area">
    <div class="houzez-module package-table-module">
        <div class="container">
            <div class="row">
                <?php
                $args = array(
                    'post_type'       => 'houzez_packages',
                    'posts_per_page'  => -1,
                    'meta_query'      =>  array(
                        array(
                            'key' => 'fave_package_visible',
                            'value' => 'yes',
                            'compare' => '=',
                        )
                    )
                );
                $fave_qry = new WP_Query($args);

                $total_packages = $first_pkg_column = '';
                $total_packages = $fave_qry->found_posts;

                if( $total_packages == 3 ) {
                    $pkg_classes = 'col-md-4 col-sm-4 col-xs-12';
                } else if( $total_packages == 4 ) {
                    $pkg_classes = 'col-md-3 col-sm-6';
                } else if( $total_packages == 2 ) {
                    $pkg_classes = 'col-md-4 col-sm-6';
                } else if( $total_packages == 1 ) {
                    $pkg_classes = 'col-md-4 col-sm-12';
                } else {
                    $pkg_classes = 'col-md-3 col-sm-6';
                }

                $i = 0;
                while( $fave_qry->have_posts() ): $fave_qry->the_post(); $i++;

                $pack_price              = get_post_meta( get_the_ID(), 'fave_package_price', true );
                $pack_listings           = get_post_meta( get_the_ID(), 'fave_package_listings', true );
                $pack_featured_listings  = get_post_meta( get_the_ID(), 'fave_package_featured_listings', true );
                $pack_unlimited_listings = get_post_meta( get_the_ID(), 'fave_unlimited_listings', true );
                $pack_billing_period     = get_post_meta( get_the_ID(), 'fave_billing_time_unit', true );
                $pack_billing_frquency   = get_post_meta( get_the_ID(), 'fave_billing_unit', true );
                $fave_package_popular    = get_post_meta( get_the_ID(), 'fave_package_popular', true );

                if( $pack_billing_frquency > 1 ) {
                    $pack_billing_period .='s';
                }
                if ( $where_currency == 'before' ) {
                    $package_price = '<span class="price-before">'.$currency_symbol.'</span><span class="price-number">'.$pack_price.'</span>';
                } else {
                    $package_price = '<span class="price-number">'.$pack_price.'</span><span class="price-before">'.$currency_symbol.'</span>';
                }

                if( $fave_package_popular == "yes" ) {
                    $is_popular = 'active';
                } else {
                    $is_popular = '';
                }

                $payment_process_link = add_query_arg( 'selected_package', get_the_ID(), $payment_page_link );

                if( $i == 1 && $total_packages == 2 ) {
                    $first_pkg_column = 'col-md-offset-2 col-sm-offset-0';
                } else if (  $i == 1 && $total_packages == 1  ) {
                    $first_pkg_column = 'col-md-offset-4 col-sm-offset-0';
                } else {
                    $first_pkg_column = '';
                }

                ?>

                <div class="<?php echo esc_attr( $pkg_classes.' '.$first_pkg_column ); ?>">
                    <div class="package-block <?php esc_attr_e( $is_popular ); ?>">
                        <h3 class="package-title"><?php the_title(); ?></h3>
                        <h1 class="package-price">
                            <?php echo $package_price; ?>
                        </h1>
                        <ul class="package-list">
                            <li><i class="fa fa-check"></i> <?php echo $houzez_local['time_period'].':'; ?> <strong><?php echo esc_attr( $pack_billing_frquency ).' '.HOUZEZ_billing_period( $pack_billing_period ); ?></strong></li>
                            <li><i class="fa fa-check"></i> <?php echo $houzez_local['properties'].':'; ?>
                                <?php if( $pack_unlimited_listings == 1 ) { ?>
                                    <strong><?php echo $houzez_local['unlimited_listings'].':'; ?></strong>
                                <?php } else { ?>
                                    <strong><?php echo esc_attr( $pack_listings ); ?></strong>
                                <?php } ?>
                            </li>
                            <li><i class="fa fa-check"></i> <?php echo $houzez_local['featured_listings'].':'; ?> <strong><?php echo esc_attr( $pack_featured_listings ); ?></strong></li>
                        </ul>
                        <div class="package-link">
                            <a href="<?php echo esc_url($payment_process_link); ?>" class="btn btn-primary btn-lg"><?php echo $houzez_local['get_started']; ?></a>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
