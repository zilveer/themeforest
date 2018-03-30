<?php
get_header();
global $unf_options; ?>

<div id="content-wrapper" class="row clearfix">

	<div id="content" class="<?php

	if (is_shop()) {
		if ( $unf_options['unf_shopsiderbar_home'] == "1") { echo 'col-md-8'; } else { echo 'col-md-12'; }
	}
	if (is_product_category() || is_product_tag()) {
		if ( $unf_options['unf_shopsiderbar_archive'] == "1") { echo 'col-md-8'; } else { echo 'col-md-12'; }
	}
	if (is_product()) {
		if ( $unf_options['unf_shopsiderbar_productpage'] == "1") { echo 'col-md-8'; } else { echo 'col-md-12'; }
	} ?> column">
		<div class="article clearfix">

			<div class="woo-cols-<?php
			if (isset($unf_options['unf_woo_products_per_row'])) {
			$unf_woo_per_row = $unf_options['unf_woo_products_per_row'];
			} else {
			$unf_woo_per_row = 3;
			}
			echo (int)$unf_woo_per_row;?>">

			<?php if (is_shop()) { ?>
				<div class="unfshophome">
				<?php if (!empty($unf_options['unf_shophometitle'])) {?>
					<div class="shop-home-title">
						<h1 class="page-title entry-title" itemprop="headline">
						<?php echo wp_kses_post($unf_options['unf_shophometitle']); ?>
						</h1>
					</div>
				<?php } // end if have shop home title ?>

				<?php if (!empty($unf_options['unf_shophomepagecontent'])) {?>
					<div class="shoptopcontent">
					<?php echo wp_kses_post($unf_options['unf_shophomepagecontent']); ?>
					</div>
				<?php } // end if have top content ?>
			<?php } //endif is shop homepage ?>
			<?php woocommerce_content(); ?>
			<?php if (is_shop()) { ?>
				</div>
			<?php } // closes if is shop home div. ?>
			<?php wp_reset_query(); ?>

			</div>
		</div>
	</div>
	<?php
		if (is_shop()) {
			if ( $unf_options['unf_shopsiderbar_home'] == "1") { get_sidebar('shopsidebar'); }
		}
		if (is_product_category() || is_product_tag()) {
			if ( $unf_options['unf_shopsiderbar_archive'] == "1") { get_sidebar('shopsidebar');}
		}
		if (is_product()) {
			if ( $unf_options['unf_shopsiderbar_productpage'] == "1") { get_sidebar('shopsidebar'); }
		}
	?>
	</div>
</div>

<?php get_footer(); ?>