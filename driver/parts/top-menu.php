<?php 
$top_menu_enabled = (bool)get_iron_option('header_top_menu_enabled');
$menu_items = get_iron_option('header_top_menu');
$menu_icon_toggle = (int)get_iron_option('header_menu_toggle_enabled');
?>
<?php if($top_menu_enabled && !empty($menu_items)): ?>

	<!-- social-networks -->
	<ul class="header-top-menu <?php echo (!empty($_GET["mpos"]) ? esc_attr($_GET["mpos"]) : get_iron_option('menu_position')); ?>">
		<?php foreach($menu_items as $item): ?>
		<?php
		if(!empty($item["menu_page_external_url"])) {
			$url = $item["menu_page_external_url"];
		}else{
			$url = get_permalink($item["menu_page_url"]);
		}
		$target = $item["menu_page_url_target"];
		$is_menu = !empty($item["menu_page_is_menu"]) ? (bool)$item["menu_page_is_menu"] : false;
		$hide_page_name = !empty($item["menu_hide_page_title"]) ? (bool)$item["menu_hide_page_title"] : false;
		?>
		<li>
			<a target="<?php echo esc_attr($target);?>" href="<?php echo esc_url($url); ?>" <?php echo (!empty($is_menu) ? 'class="alt-menu-toggle"' : '')?>>
				
				<?php if(!empty($item["menu_page_icon"])): ?>
				<i class="fa fa-<?php echo esc_attr($item["menu_page_icon"]); ?>" title="<?php echo esc_attr($item["menu_page_name"]); ?>"></i> 
				<?php endif;?>
				
				<?php if(!$hide_page_name): ?>
					<?php echo esc_html($item["menu_page_name"]); ?>
				<?php endif; ?>
				
				<?php if(function_exists('is_shop')): ?>
				
					<?php global $woocommerce; ?>
			
					<?php if (!empty($item["menu_page_url"]) && (get_option('woocommerce_cart_page_id') == $item["menu_page_url"]) && $woocommerce->cart->cart_contents_count > 0): ?>
						
						<span>( <?php echo esc_html($woocommerce->cart->cart_contents_count);?> )</span>
						
					<?php endif; ?>
					
				<?php endif; ?>
			</a>
		</li>

		<?php endforeach; ?>
		
		<?php 
		icl_post_languages();
		?>
	</ul>
	
<?php endif; ?>	
			
<?php 
if($menu_icon_toggle == 0 || $menu_icon_toggle == 2){
?>
<script>
jQuery(document).ready(function() {
	jQuery('.header-top-menu').css('padding-right','10px');
	jQuery('.header-top-menu').css('padding-left','10px');
	
	<?php if($menu_icon_toggle == 2): ?>
	
	jQuery('.menu-toggle').addClass('hidden-on-desktop');
	
	<?php else: ?>
	
	jQuery('.menu-toggle').remove();
	
	<?php endif ?>
});
</script>
<?php
}
?>