<?php get_header();
	
	if (is_cart()):
		$cur_page_id = woocommerce_get_page_id('cart');
	elseif (is_account_page()):
		$cur_page_id = woocommerce_get_page_id('myaccount');
	elseif (is_checkout()):
		$cur_page_id = woocommerce_get_page_id('checkout');
	else:
		$cur_page_id = woocommerce_get_page_id('shop');
	endif;
	
	if ($cur_page_id):
		
		$sections = carbon_get_post_meta($cur_page_id, 'basil_page_sections', 'complex');
		foreach($sections as $key => $s):
		
			if ($s['_type'] == '_page_content'):			
				$bg_color = $s['bg_color'];
				$content_position = $s['page_content_position'];
				$hide_title = $s['page_hide_title'];
				$sidebar = $s['page_sidebar'];
				$sectionAnimation = $s['section_animation'];
			endif;
			
		endforeach;
		
	endif;

	if (empty($sections) || !$cur_page_id):
	
		$bg_color = '';
		$content_position = 'full';
		$hide_title = false;
		$sidebar = false;
		$sectionAnimation = false;
		
	endif;
	
	if ($content_position != 'full'):
	
		add_filter( 'loop_shop_columns', 'basil_wc_loop_shop_columns', 1, 10 );
	
	endif;

	?><!-- PAGE CONTENT -->
	<section class="basilHPBlock <?php echo $bg_color; ?> basil<?php echo ucwords($content_position); ?>Content">
		<div class="basilShell">
		
			<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
		
			<article class="basilPageContent">
				<?php
				woocommerce_content();
				?>
			</article>
			
			<?php
			
			// Sidebar
			if ($content_position != 'full') {
			
				?><aside class="basilSidebar"><?php
				
				if ( !$sidebar) {
					$sidebar = 'default-sidebar';
				}
					
				echo '<div class="sidebar ' . basil_get_sidebar_position() . '">';
					echo '<ul class="widgets">';
						dynamic_sidebar($sidebar);
					echo '</ul>';
				echo '</div>';
				
				?></aside><?php
			
			} ?>
			
			<?php if ($sectionAnimation): ?></div><?php endif; ?>
				
		</div>
	</section>

<?php get_footer(); ?>