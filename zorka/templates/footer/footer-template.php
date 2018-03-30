<?php

global $zorka_data;
$footer_class='light';

$footer_layout = get_post_meta(get_the_ID(),'footer-layout',true);
if (!isset($footer_layout) || $footer_layout == 'none' || empty($footer_layout)) {
    $footer_layout = $zorka_data['footer-layout'];
}

if ($footer_layout == 2) {
    $footer_class = 'dark';
}

$col_footer = 0;
for ($i=1; $i<=4; $i++) {
    if(is_active_sidebar('footer-'. $i)) {
        $col_footer +=1;
    }
}
$col_footer_class = '';
if ($col_footer > 0){
    switch ($col_footer){
        case 1 :
            $col_footer_class = 'col-sm-12';
            break;
        case 2 :
            $col_footer_class = 'col-sm-6';
            break;
        case 3 :
            $col_footer_class = 'col-sm-4';
            break;
        case 4 :
            $col_footer_class = 'col-md-3 col-sm-6';
            break;
    }
}else
{
    $col_bottom_footer = 'col-md-6';
}
$payment_urls =array(
    array('image' => '/assets/images/payments/visa.png','key' => 'visa_url', 'title' => 'VISA'),
    array('image' => '/assets/images/payments/mastercard.png','key' => 'mastercard_url', 'title' => 'MASTER CARD'),
    array('image' => '/assets/images/payments/paypal.png','key' => 'paypal_url', 'title' => 'Paypal'),
    array('image' => '/assets/images/payments/twoCO.png','key' => 'twoCO_url', 'title' => '2CO'),
    array('image' => '/assets/images/payments/american_express.png','key' => 'american_express_url', 'title' => 'American Express'),
    array('image' => '/assets/images/payments/skrill.png','key' => 'skrill_url', 'title' => 'Skrill'),
    array('image' => '/assets/images/payments/google_wallet.png','key' => 'google_wallet_url', 'title' => 'Google Wallet'),
    array('image' => '/assets/images/payments/western_union.png','key' => 'western_union_url', 'title' => 'Western Union')
);

$enable_parallax = isset($zorka_data['enable-parallax-footer']) ? $zorka_data['enable-parallax-footer'] : 0;
if ($enable_parallax == 1) {
    $footer_class .= ' enable-parallax-footer';
}
?>
<footer class="main-footer <?php echo esc_attr($footer_class) ?>">
    <div class="footer_inner clearfix">

            <?php if ($col_footer > 0):?>
            <div class="footer_top_holder col-<?php echo esc_attr($col_footer); ?>">
                <div class="container">
                    <div class="row footer-top-col-<?php echo esc_attr($col_footer); ?>">
                        <?php
                        for ($j=1; $j<=4; $j++) {
                            if(is_active_sidebar('footer-'. $j)) {
                                echo '<div class="'. esc_attr($col_footer_class).'">';
                                dynamic_sidebar('footer-'. $j);
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div class="footer_bottom_holder col-<?php echo esc_attr($col_footer); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 copyright-text">
                            <?php echo wp_kses_post(apply_filters('copyright_text_filter', $zorka_data['copyright-text'])) ; ?>
                        </div>

                        <div class="col-md-6 payment">
                            <?php foreach($payment_urls as $payment_url) : ?>
                                <?php if ( isset( $zorka_data[$payment_url['key']] ) && ! empty( $zorka_data[$payment_url['key']] ) ) : ?>
                                    <a class="payment-logo-wapper" href="<?php echo esc_url($zorka_data[$payment_url['key']]); ?>">
                                        <img width="51" height="32" alt="<?php echo esc_attr($payment_url['title']) ?>" src="<?php echo esc_url(get_template_directory_uri().$payment_url['image']) ?>" />
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</footer>