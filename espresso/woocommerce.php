<?php get_header();

?><div class="bottom-spacer"></div>
<div id="page-post" class="shell clearfix">

	<?php

	if (is_shop()):
		$cur_page_id = woocommerce_get_page_id('shop');
	elseif (is_cart()):
		$cur_page_id = woocommerce_get_page_id('cart');
	elseif (is_account_page()):
		$cur_page_id = woocommerce_get_page_id('myaccount');
	elseif (is_checkout()):
		$cur_page_id = woocommerce_get_page_id('checkout');
	else:
		$cur_page_id = woocommerce_get_page_id('shop');
	endif;
	
	$page_options = get_post_meta($cur_page_id,'_page_options',true);
	$sidebar_choice = get_post_meta($cur_page_id, '_sidebar_choice', true);
	$sidebar_type = get_post_meta($cur_page_id,'_sidebar_layout',true);
	$sidebar_type = (!empty($sidebar_type) ? $sidebar_type = $sidebar_type[0] : $sidebar_type = false);
	
	if (!$sidebar_choice){ $sidebar_choice = 'default-sidebar'; }
	
	if ($sidebar_type == 'left'){
		$page_type = 'right';
	} else if ($sidebar_type == 'right'){
		$page_type = 'left';
	} else if ($sidebar_type == 'no-sidebar'){
		$page_type = 'full';
	} else {
		$page_type = ot_get_option('default_page_type','full');
		switch ($page_type){
			case 'full':
				$sidebar_type = 'no-sidebar';
				break;
			case 'left':
				$sidebar_type = 'right';
				break;
			case 'right':
				$sidebar_type = 'left';
				break;
		}
	}

	?><article <?php post_class($page_type.' page-content'); ?>><?php
	
		woocommerce_content();
		
	?></article><?php
	
	if (isset($sidebar_type) && $sidebar_type != '' && $sidebar_type != 'no-sidebar'){ ?>
		<aside class="<?php echo $sidebar_type; ?>">
			<?php dynamic_sidebar($sidebar_choice); ?>
		</aside>
	<?php }
	
?></div>
<div class="bottom-spacer"></div><?php	

get_footer();