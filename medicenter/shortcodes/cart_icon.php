<?php
function theme_mc_cart_icon($atts)
{
	extract(shortcode_atts(array(
		"icon_color" => "blue_light",
		"cart_items_number" => "yes",
		"icon_target" => "",
		"class" => "",
	), $atts));
	
	global $woocommerce;
	$result = "";
	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		ob_start();
		$cart_url = $woocommerce->cart->get_cart_url();
		?>
		<a <?php echo ($icon_target=="new_window" ? " target='_blank'" : ""); ?>href="<?php echo esc_url($cart_url);?>" class="cart_icon <?php echo $class;?>" style="background-image: url('<?php echo esc_url(get_template_directory_uri()) . "/images/social_body/" . $icon_color;?>/cart.png');">&nbsp;<?php if($cart_items_number=="yes"): ?><span class="cart_items_number"<?php echo (!(int)$woocommerce->cart->cart_contents_count ? ' style="display: none;"' : ''); ?>><?php echo $woocommerce->cart->cart_contents_count; ?></span><?php endif;?></a>
		<?php
		$result = ob_get_clean();
	}
	return $result;
}
add_shortcode("mc_cart_icon", "theme_mc_cart_icon");
