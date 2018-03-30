<?php

	$post_id = get_the_ID();
	
	if(is_home() && get_option('page_for_posts') != '') {

		$post_id = get_option('page_for_posts');

	}else if(is_front_page() && get_option('page_on_front') != '') {
	
		$post_id = get_option('page_on_front');
		
	}else if(function_exists('is_shop') && is_shop() && get_option('woocommerce_shop_page_id') != '') {
	
		$post_id = get_option('woocommerce_shop_page_id');
	
	}elseif($wp_query && !empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID)) {
	
		$post_id = $wp_query->queried_object->ID;
	}
	
	
	$menu_width = get_iron_option('classic_menu_width');
	$menu_align = get_iron_option('classic_menu_align');
	$menu_position = get_iron_option('classic_menu_position');
	$menu_effect = get_iron_option('classic_menu_effect');
	$menu_logo_align = get_iron_option('classic_menu_logo_align');

	$menu_is_over = get_field('classic_menu_over_content', $post_id);
	if(!empty($menu_is_over)) {
		if($menu_position == 'absolute absolute_before') {
			$menu_position = 'absolute';
		}else{
			$menu_position = 'fixed';
		}	
	}
		
	$container_classes = array();
	$container_classes[] = 'classic-menu';
	$container_classes[] = $menu_effect;
	$container_classes[] = $menu_position;

	
	$menu_classes = array();
	$menu_classes[] = 'menu-level-0';
	$menu_classes[] = $menu_align;
	$menu_classes[] = $menu_width;
	
	if($menu_logo_align == 'pull-top')
		$menu_classes[] = 'logo-pull-top';
		
	$hotlinks_align = 'pull-right';	
	
			
?>

<div class="<?php echo implode(" ", $container_classes); ?>" 
	data-site_url="<?php echo esc_attr( get_bloginfo('url') ); ?>"
	data-site_name="<?php echo esc_attr( get_bloginfo('name') ); ?>"
	data-logo="<?php echo esc_url( get_iron_option('header_logo') ); ?>" 
	data-logo_page="<?php echo esc_url( get_field('classic_menu_logo', $post_id) ); ?>" 	
	data-retina_logo="<?php echo esc_url( get_iron_option('retina_header_logo') ); ?>"
	data-logo_mini="<?php echo esc_url( get_iron_option('header_logo_mini') ); ?>"  
	data-logo_align="<?php echo esc_attr($menu_logo_align); ?>">
	<?php	
	echo wp_nav_menu( array( 
		'container' => false,
		'theme_location' => 'main-menu', 
		'menu_class' => implode(" ", $menu_classes), 
		'echo' => false, 
		'walker' => new iron_nav_walker() 
	)); 
	?>
	
	<?php 
	$top_menu_enabled = (bool)get_iron_option('header_top_menu_enabled');
	$menu_items = get_iron_option('header_top_menu');
	$menu_icon_toggle = (int)get_iron_option('header_menu_toggle_enabled');
	?>
	<?php if($top_menu_enabled && !empty($menu_items)): ?>

	<!-- social-networks -->
	<ul class="classic-menu-hot-links <?php echo (!empty($_GET["mpos"]) ? esc_attr($_GET["mpos"]) : get_iron_option('menu_position')); ?>">
		<?php foreach($menu_items as $item): ?>
		<?php
		if(!empty($item["menu_page_external_url"])) {
			$url = $item["menu_page_external_url"];
		}else{
			$url = get_permalink($item["menu_page_url"]);
		}
		$target = $item["menu_page_url_target"];
		$hide_page_name = !empty($item["menu_hide_page_title"]) ? (bool)$item["menu_hide_page_title"] : false;
		?>
		<li class="hotlink <?php echo $hotlinks_align;?>">
			<a target="<?php echo esc_attr($target);?>" href="<?php echo esc_url($url); ?>">
				
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

	</ul>
	
	<?php endif; ?>	
			
</div>	
