<?php

/**
 * Scrollable blog
 *
 * @package wpv
 */

$total_items = (have_posts() ? count($wp_query->posts) : 0);

?>
<div class="scrollable-wrapper">
	<div class="woocommerce woocommerce-scrollable scroll-x">
		<ul class="clearfix products" data-columns="<?php echo $columns ?>">
			<?php
				if($products->have_posts()) while($products->have_posts()): $products->the_post();
				?>
					<li class="product">
						<div>
							<?php get_template_part('templates/woocommerce-scrollable/item');	?>
						</div>
					</li>
				<?php
				endwhile;
			?>
		</ul>
	</div>
</div>