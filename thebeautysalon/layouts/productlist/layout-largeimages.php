<?php
/** Large Images
  *
  *
  *
  */
  global $term_id, $terms, $post, $framework, $products, $blueprint, $parent;
  $term = $terms[$term_id];

  $parent = $post;

  $has_thumbnail = $blueprint->item_has( 'thumbnail' );
  $thumbnail_class = ( empty( $has_thumbnail ) ) ? 'no-thumbnail' : 'has-thumbnail';

  $temp_post = $post;
	$args = array(
		'post_type' => 'eb_product',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'eb_product_category',
				'field' => 'id',
				'terms' => $term->term_id
			)
		)
	);

  $product_posts = new WP_Query( $args );
?>

<div class='category productlist-layout-largeimages'>
	<div class='line-title'><div class='inner'>
		<h3><?php echo $term->name ?></h3>
	</div></div>
	<div class='products'>
		<?php while( $product_posts->have_posts() ) : $product_posts->the_post() ?>
		<div class='product <?php echo $thumbnail_class ?>'>

			<?php if( !empty( $has_thumbnail ) ) : ?>
				<div class='image'>
					<a href='<?php the_permalink() ?>' class='hoverlink'><?php the_post_thumbnail( 'eb_col_3' ) ?></a>
				</div>
			<?php endif ?>
			<div class='product-content'>
				<div class='priced-title'>
					<?php if( $blueprint->item_has( 'title' ) ) : ?>
					<h1 class='title post-title primary'><a href='<?php the_permalink() ?>' class='primary'><?php the_title() ?></a></h1>
					<?php endif ?>

					<?php
						$price = get_post_meta( get_the_ID(), 'price', true );
						if( $blueprint->item_has( 'price' ) AND !empty( $price ) ) : ?>
					<div class='price'><?php $products->display_price( $price) ?></div>
					<?php endif ?>
				</div>

				<?php if( $blueprint->item_has( 'excerpt' ) ) : ?>
					<div class='excerpt'><?php $framework->the_excerpt( 120 ) ?></div>
				<?php endif ?>

			</div>
		</div>
		<?php endwhile ?>
	</div>
</div>


<?php $post = $temp_post; ?>