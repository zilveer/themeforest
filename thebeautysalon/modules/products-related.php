<?php
	global $blueprint, $framework, $products;
	$indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

	$columns = ( $post->postmeta['related_products_columns']  == 'default' ) ? $framework->options['related_products_columns'] : $post->postmeta['related_products_columns'];

	$show_thumbnail = $blueprint->post_has( 'related_products_thumbnail', $framework->options['related_products_show_thumbnail'] );
	$show_title = $blueprint->post_has( 'related_products_title', $framework->options['related_products_show_title'] );
	$show_price = $blueprint->post_has( 'related_products_price', $framework->options['related_products_show_price'] );
	$show_excerpt = $blueprint->post_has( 'related_products_excerpt', $framework->options['related_products_show_excerpt'] );

	$colclass = array(
		'2' => 'sixcol',
		'3' => 'fourcol',
		'4' => 'threecol'
	);
	$colclass = $colclass[$columns];

	$related_excerpt_length = $post->postmeta['related_products_excerpt_length'];

?>

<div class='related-products indent <?php echo $indent_side ?>'>

<div class='line-title'><div class='inner'>
	<h3>Related Products</h3>
</div></div>

<?php
	$args = array(
		'post_type' => 'eb_product',
		'post_status' => 'publish',
		'orderby' => 'rand',
		'posts_per_page' => $post->postmeta['related_products_count'],
		'post__not_in' => array( get_the_ID() ),
		'tax_query' => array(
			array(
				'taxonomy' => 'eb_product_category',
				'field' => 'id',
				'terms' => wp_get_object_terms( get_the_ID(), 'eb_product_category', array( 'fields' => 'ids' ) ),
				'operator' => 'IN'
			)
		)
	);
	$similar = new WP_Query( $args );

	$remainder = count( $similar->posts ) % $columns;
	$offset = ( $remainder == 0 ) ? ( $columns - 1 ) : ( $remainder - 1 );
	$last_row_start = count( $similar->posts ) - $offset;


	$i = 1;
	if( $similar->have_posts() ) :
		echo '<div class="row">';
		$temp_post = $post;
		while( $similar->have_posts() ) :
			$similar->the_post();
			$last = ( $i%$columns == 0 ) ? 'last' : '';
			$last_row = ( $i >= $last_row_start ) ? 'last-row' : '';

			if( ( $i - 1 ) % $columns == 0 ) {
				echo '</div><div class="row">';
			}
?>
<div class='<?php echo $colclass ?> <?php echo $last ?>'>
	<div class='related_product-layout-columns <?php echo $last_row ?>'>

		<?php if( !empty( $show_thumbnail ) ) : ?>
			<div class='image'>
				<a href='<?php the_permalink() ?>' class='hoverlink'><?php the_post_thumbnail( 'eb_col_' . $columns ) ?></a>
			</div>
		<?php endif ?>

		<?php if( !empty( $show_title ) ) : ?>
		<h2 class='title'><a class='primary' href='<?php the_permalink() ?>'><?php the_title() ?></a></h2>
		<?php endif ?>

		<?php if( !empty( $show_price ) ) : ?>
		<div class='price'><?php $products->display_price( get_post_meta( get_the_ID(), 'price', true ) ) ?></div>
		<?php endif ?>

		<?php if( !empty( $show_excerpt ) ) : ?>
			<?php $framework->the_excerpt( $related_excerpt_length ) ?>
		<?php endif ?>

	</div>
</div>

<?php $i++; endwhile; echo '</div>'; endif ?>
<div class='clear'></div>
</div>