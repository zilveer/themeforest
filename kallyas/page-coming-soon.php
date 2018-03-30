<?php if(! defined('ABSPATH')){ return; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

<?php

	wp_enqueue_script( 'zn_event_countdown', THEME_BASE_URI . '/addons/countdown/jquery.countdown.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );

	wp_enqueue_style( 'offline-css', THEME_BASE_URI . '/css/pages/offline.css', array('kallyas-styles'), ZN_FW_VERSION );

	wp_dequeue_style('css3_panels');
	wp_dequeue_style('icarousel_demo');
	wp_dequeue_style('icarousel');
	wp_dequeue_style('flex_slider');
	wp_dequeue_style('slider_fancy');
	wp_dequeue_style('lslider');
	wp_dequeue_style('cuteslider');
	wp_dequeue_style('rs-plugin-settings');
	wp_dequeue_style('rs-plugin-settings-inline');
	wp_dequeue_style('woocommerce-layout');
	wp_dequeue_style('woocommerce-smallscreen');
	wp_dequeue_style('woocommerce-general');
	wp_dequeue_style('zn-superfish');
	wp_dequeue_style('pretty_photo');
	wp_head();
?>
</head>
<?php
	$style = '';
	if( $zn_body_def_color = zget_option( 'zn_body_def_color', 'color_options', false, '#f5f5f5' ) ){
		$style = 'background: '.$zn_body_def_color;
	}
?>
<body class="offline-page" style="<?php echo $style;?>">

	<div class="containerbox offline-page-container">

		<div class="containerbox__logo offline-page-logo">
			<?php echo zn_kl_logo(); ?>
		</div>

		<div class="content offline-page-content">
			<p><?php echo stripslashes( zget_option( 'cs_desc', 'coming_soon_options' ) ); ?></p>
			<?php
				$cs_date = zget_option( 'cs_date', 'coming_soon_options' );
				if ( ! empty ( $cs_date ) && ! empty ( $cs_date['time'] ) ) {

					echo '<div class="ud_counter kl-counter offline-page-counter kl-font-alt">';
					?>
		            <ul id="jq-counter" class="kl-counter-list">
		                <li class="kl-counter-li"><?php _e( '0', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'day', 'zn_framework' );?></span></li>
		                <li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'hours', 'zn_framework' );?></span></li>
		                <li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'min', 'zn_framework' );?></span></li>
		                <li class="kl-counter-li"><?php _e( '00', 'zn_framework' );?><span class="kl-counter-unit"><?php _e( 'sec', 'zn_framework' );?></span></li>
		            </ul>
		            <?php
					echo '<span class="till_lauch kl-counter-launch"><img class="kl-counter-launch-img" src="' . THEME_BASE_URI . '/images/rocket.png" alt="'.__( 'Launch Date', 'zn_framework' ).'"></span>';
					echo '</div><!-- end counter -->';
				}

				$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );
				$cs_lsit_id = zget_option( 'cs_lsit_id', 'coming_soon_options' );
				if ( ! empty ( $cs_lsit_id ) && ! empty ( $mailchimp_api ) ) {

					echo '<div class="mail_when_ready kl-newsletter-wrapper offline-page-newsletter">';
					echo '		<form method="post" class="newsletter_subscribe newsletter-signup kl-newsletter" data-url="' .
						 trailingslashit( home_url() ) . '" name="newsletter_form">';
					echo '			<input type="text" name="zn_mc_email" class="nl-email form-control kl-newsletter-field" value="" placeholder="your.address@email.com" />';
					echo '			<input type="hidden" name="zn_list_class" class="nl-lid" value="' . $cs_lsit_id . '" />';
					echo '			<input type="submit" name="submit" class="nl-submit kl-newsletter-submit kl-font-alt  btn btn-fullcolor" value="JOIN US" />';
					echo '		</form>';
					echo '<span class="zn_mailchimp_result kl-newsletter-result"></span>';
					echo '</div>';
				}

				if ( $cs_social_icons = zget_option( 'cs_social_icons_enable', 'coming_soon_options' ) ) {
					$social_icons = zget_option('cs_social_icons', 'coming_soon_options');
					if( !empty( $social_icons ) && is_array( $social_icons ) ){
						$icon_class = zget_option( 'cs_which_icons_set', 'coming_soon_options', false, 'normal' );

						echo '<ul class="social-icons sc--' . $icon_class . ' offline-page-sc clearfix">';

						foreach ( $social_icons as $key => $icon )
						{
							$link   = '';
							$target = '';

							if ( isset ( $icon['cs_social_link'] ) && is_array( $icon['cs_social_link'] ) ) {
								$link   = $icon['cs_social_link']['url'];
								$target = 'target="' . $icon['cs_social_link']['target'] . '"';
							}
							$icon_color = '';
							if($icon_class != 'normal' && $icon_class != 'clean'){
								$icon_color = isset($icon['cs_social_color']) && !empty($icon['cs_social_color']) ? $icon['cs_social_icon']['unicode'] : 'nocolor';
							}
						    $social_icon = !empty( $icon['cs_social_icon'] )  ? '<a '.zn_generate_icon( $icon['cs_social_icon'] ).' href="' . $link . '" ' . $target . ' title="' . $icon['cs_social_title'] . '" class="social-icons-item sccsoon-icon-'.$icon_color.'"></a>' : '';
							echo '<li class="social-icons-li">'.$social_icon.'</li>';
						}
						echo '</ul>';
					}


				}
			?>
			<div class="clearfix"></div>
		</div>
		<!-- end content -->
	<div class="clearfix"></div>
</div>
<?php wp_footer(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        "use strict";

        //#! Start countdown
        var years  = "<?php _e('years', 'zn_framework');?>",
            months = "<?php _e('months', 'zn_framework');?>",
            weeks  = "<?php _e('weeks', 'zn_framework');?>",
            days   = "<?php _e('days', 'zn_framework');?>",
            hours  = "<?php _e('hours', 'zn_framework');?>",
            min    = "<?php _e('min', 'zn_framework');?>",
            sec    = "<?php _e('sec', 'zn_framework');?>";

        var counterOptions = {
            layout: function ()
            {
                return '<li class="kl-counter-li">{dn}<span class="kl-counter-unit">{dl}</span></li>' +
                    '<li class="kl-counter-li">{hn}<span class="kl-counter-unit">{hl}</span></li>' +
                    '<li class="kl-counter-li">{mn}<span class="kl-counter-unit">{ml}</span></li>' +
                    '<li class="kl-counter-li">{sn}<span class="kl-counter-unit">{sl}</span></li>';
            }
        };
        <?php
            // General Options
            $y = $mo = $d = $h = $mi = '';

            if( !empty( $cs_date ) && !empty( $cs_date['date'] ) && !empty($cs_date['time'] ) ){
                $str_date = strtotime(trim( $cs_date['date']));
                $y = date('Y', $str_date);
                $mo = date('m', $str_date);
                $d = date('d', $str_date);
                $time = explode(':', $cs_date['time']);
                $h = $time[0];
                $mi = $time[1];
            }
        ?>
        var y = <?php echo intval($y);?>,
            mo = <?php echo intval($mo)-1;?>,
            d = <?php echo intval($d);?>,
            h = <?php echo intval($h);?>,
            mi = <?php echo intval($mi);?>,
            t = new Date(y, mo, d, h, mi, 0);
        jQuery('#jq-counter').countdown({
            until: t,
            layout: counterOptions.layout(),
            labels: [years, months, weeks, days, hours, min, sec],
            labels1: [years, months, weeks, days, hours, min, sec],
            format: 'DHMS'
        });
        //#!-- End countdown
    });
</script>
</body>
</html>
