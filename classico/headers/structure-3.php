<?php 
	$ht = $class = ''; 
	$ht = apply_filters('custom_header_filter',$ht);  
	$page_slider = etheme_get_custom_field('page_slider');
	
?>

<div class="header-wrapper header-type-<?php echo $ht.' '.$class; ?> slider-overlap">
		
		
		<?php get_template_part('headers/parts/top-bar'); ?>
	
		<header class="header main-header">
			<div class="container">	
					<div class="navbar" role="navigation">
						<div class="container-fluid">
							<button type="button" class="navbar-toggle">
				              <span class="sr-only">Toggle navigation</span>
				              <span class="icon-bar"></span>
				              <span class="icon-bar"></span>
				              <span class="icon-bar"></span>
				            </button>
							<div class="header-logo">
								<?php etheme_logo(); ?>
							</div>
							<div class="navbar-header navbar-right visible-sm visible-xs">
								<div class="navbar-right">
									<label for="s" class="header-search-trigger hidden-md hidden-lg"><i class="fa fa-search"></i></label>
						            <?php if(etheme_get_option('search_form')): ?>
										<?php etheme_search_form(); ?>
									<?php endif; ?>
									<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
					                    <?php et_top_cart(); ?>
						            <?php endif ;?>
								</div>
							</div>
						</div><!-- /.container-fluid -->
					</div>
			</div>
			<div class="menu-wrapper">
				<div class="container">
					<div class="collapse navbar-collapse text-center">
						<?php et_get_main_menu(); ?>

						<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
		                    <?php et_top_cart(); ?>
			            <?php endif ;?>

						<label for="s" class="header-search-trigger hidden-md hidden-lg"><i class="fa fa-search"></i></label>
			            <?php if(etheme_get_option('search_form')): ?>
							<?php etheme_search_form(); ?>
						<?php endif; ?>
					</div><!-- /.navbar-collapse -->
				</div>
			</div>
			<div class="mobile-menu-wrapper">
				<div class="container">
					<div class=" navbar-collapse">
					<?php et_get_main_menu(); ?>
					</div><!-- /.navbar-collapse -->
				</div>
			</div>
		</header>
</div>