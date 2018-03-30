<?php
	global $blueprint, $framework, $products, $term_id, $terms;

	$terms_temp = get_terms( 'eb_product_category' );
	$terms = array();
	foreach( $terms_temp as $t ) {
		$terms[$t->term_id] = $t;
	}
?>
	<div class='product-list'>
		<div class="next"><span class='arrow-right'></span></div>
		<div class="prev"><span class='arrow-left'></span></div>

		<div class='product-page-window'>

			<div class="product-pages">
				<?php
					$product_page_content = unserialize( $post->postmeta['product_page_content'] );
					foreach( $product_page_content as $page ) :
				?>
				<div class="product-page">

					<div class="product-page-side sixcol left">
						<?php
						foreach( $page['left'] as $term_id ) {
							$blueprint->layout_template( 'productlist', $post->postmeta['layout'] );
						}
						?>
					</div>

					<div class='product-page-side sixcol last right'>
						<?php
						foreach( $page['right'] as $term_id ) {
							$blueprint->layout_template( 'productlist', $post->postmeta['layout'] );
						}
						?>
					</div>

				</div>
				<?php endforeach ?>

			</div> <!-- product-pages -->
		</div> <!-- product page window -->


	</div>

