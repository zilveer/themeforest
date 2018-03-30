<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/09/16
 * Time: 12:31 PM
 */
global $post, $current_user;
wp_get_current_user();
$userID = $current_user->ID;
$enable_paid_submission = houzez_option('enable_paid_submission');

$ac_payment = $ac_thankyou = $ac_packages = $ac_submit = '';
if( is_page_template( 'template/template-payment.php' ) ) {
    $ac_payment = 'active';
} elseif ( is_page_template( 'template/template-thankyou.php' ) ) {
    $ac_thankyou = 'active';
} elseif ( is_page_template( 'template/template-packages.php' ) ) {
    $ac_packages = 'active';
} elseif ( is_page_template( 'template/submit_property.php' ) ) {
    $ac_submit = 'active';
}

?>
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="membership-page-title">
            <h1 class="page-title"> <?php the_title(); ?> </h1>
            <!--<p class="page-subtitle">  </p>-->
        </div>
        <ol class="pay-step-bar">
            <li class="pay-step-block <?php echo esc_attr( $ac_submit ); ?>"><span><?php esc_html_e( 'Create Listing', 'houzez' ); ?></span></li>
            <?php
            if ( !is_user_logged_in() ) {
                if ($enable_paid_submission == 'membership') { ?>
                    <li class="pay-step-block <?php echo esc_attr( $ac_packages ); ?>"><span><?php esc_html_e( 'Select a Package', 'houzez' ); ?></span></li>
                    <li class="pay-step-block <?php echo esc_attr( $ac_payment ); ?>"><span><?php esc_html_e( "Payment", "houzez" ); ?></span></li>
                <?php } else if ($enable_paid_submission == 'per_listing') {
                        echo '<li class="pay-step-block '.$ac_payment.'"><span>'.esc_html__( "Payment", "houzez" ).'</span></li>';
                    }
            } else {
                if ($enable_paid_submission == 'membership') {
                    if (!houzez_user_has_membership($userID)) {?>
                        <li class="pay-step-block <?php echo esc_attr( $ac_packages ); ?>"><span><?php esc_html_e( 'Select a Package', 'houzez' ); ?></span></li>

                    <li class="pay-step-block <?php echo esc_attr( $ac_payment ); ?>"><span><?php esc_html_e( 'Payment', 'houzez' ); ?></span></li>

                <?php }
                } else if ($enable_paid_submission == 'per_listing') {
                    echo '<li class="pay-step-block '.$ac_payment.'"><span>'.esc_html__( "Payment", "houzez" ).'</span></li>';
                }
            }?>

            <li class="pay-step-block <?php echo esc_attr( $ac_thankyou ); ?>"><span><?php esc_html_e( 'Done', 'houzez' ); ?></span></li>
        </ol>
    </div>
</div>
