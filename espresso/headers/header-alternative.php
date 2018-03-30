<?php global $woocommerce, $hide_wc_cart; ?>

<section id="top">
	<div class="shell"><?php
			
		$location = array();
		if (ot_get_option('address')): $location['address'] = ot_get_option('address'); endif;
		if (ot_get_option('phone')): $location['phone'] = ot_get_option('phone'); endif;
		
		if (!empty($location)):
		
			?><section class="left location"><?php
			
				foreach($location as $type => $text){
					echo '<span class="iconed-'.$type.'">'.$text.'</span>';
				}
			
			?></section><?php
		 
		endif;
		
		es_social_search(); ?>
		
	</div>
</section>

<?php

// Get the logo and dimensions
$logo_id = ot_get_option('logo_image',false);
$logo_rt_id = ot_get_option('logo_image_rt',false);

$hide_wc_cart = ot_get_option('hide_wc_cart',false);
$hide_wc_cart = (is_array($hide_wc_cart) ? true : false);

if (!$logo_id){
	$logo_url = get_template_directory_uri().'/images/logo.png';
	$logo_rt_url = get_template_directory_uri().'/images/logo-rt.png';
	$logo_width = 273;
	$logo_height = 34;
} else {
	$logo_src = wp_get_attachment_image_src( $logo_id,'full' );
	$logo_url = $logo_src[0];
	$logo_rt_src = wp_get_attachment_image_src( $logo_rt_id,'full' );
	$logo_rt_url = $logo_rt_src[0];
	$logo_width = $logo_src[1];
	$logo_height = $logo_src[2];
}

$logo_padding = ot_get_option('logo_padding',0);
$logo_padding_total = $logo_padding * 2;
$header_height = $logo_height + $logo_padding_total;
$logo_neg_margin = ceil($logo_height / 2);
	
?>

<header id="header" class="alt" style="height:<?php echo $header_height.'px'; ?>;">
	<div class="shell" style="height:<?php echo $header_height.'px'; ?>;">
		<section class="left" style="height:<?php echo $header_height.'px'; ?>;">
			<?php
			$final_styles = '';
			foreach(ot_get_option('logo_typography',array()) as $var => $style){
				if($style){ if ($var == 'font-color'){ $var = 'color'; } $final_styles .= $var.': '.$style.'; '; }
			}
			
			// Get the logo
			if (ot_get_option('logo_type','text') == 'text'):
				echo '<h1 id="logo"><a style="'.$final_styles.'" href="'.get_bloginfo('url').'">'.ot_get_option('logo_text','ESPRESSO').'</a></h1>';
			else :
				echo '<a class="logo-image" style="width:'.$logo_width.'px; margin:-'.$logo_neg_margin.'px 0 0 0;" href="'.get_bloginfo('url').'"><img src="'.($logo_rt_url ? $logo_rt_url : $logo_url).'" alt="'.get_bloginfo('name').'" style="height:'.$logo_height.'px;" /></a>';
			endif;
			?>
		</section>
		
		<nav id="main-nav" class="right"<?php if ($woocommerce && !$hide_wc_cart): ?> style="top:67px;"<?php endif; ?>>
			<?php
			$espressoWalker = new ESPRESSOCustomNavigation();
			wp_nav_menu(array('container' => false, 'theme_location' => 'main-menu', 'fallback_cb' => 'boxy_main_menu_message', 'walker' => $espressoWalker));
			?>
		</nav>
		
		<?php if ($woocommerce && !$hide_wc_cart): ?>
			<span class="cart-holder"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a></span>
		<?php endif; ?>
		
	</div>
</header>


<div class="mobile-nav-holder">

	<?php if ($woocommerce && !$hide_wc_cart): ?>
		<div id="mobile-cart">
			<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		</div>
	<?php endif; ?>

	<div id="mobileSlickNav"></div>
	
</div>