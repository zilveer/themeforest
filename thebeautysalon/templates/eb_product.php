<?php
/** Single Post
  *
  * This file is used to display the contents of
  * single posts
  *
  * @package Elderberry
  *
  */

  global $blueprint, $framework, $products;
  $indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';
  $has_image = ( has_post_thumbnail() AND $blueprint->has_thumbnail() ) ? 'has-thumbnail' : 'no-thumbnail';
?>

<div class='post-content product-layout-single <?php echo $has_image ?>'>

	<div class='indent <?php echo $indent_side ?>'>
		<div class="row">
		<?php if( has_post_thumbnail() AND $blueprint->has_thumbnail() ) : ?>
			<div class='fivecol post-image-container'>
				<div class='post-image'>
					<div class='image'><?php the_post_thumbnail( 'rf_col_2' ) ?></div>
				</div>
			</div>
		<?php endif ?>
		<div class='sevencol last post-text-container'>
			<div class='post-text'>
				<div class='priced-title'>
					<h1 class='title post-title primary'><?php the_title() ?></h1>
					<div class='price'><?php $products->display_price( $post->postmeta['price'] ) ?></div>
				</div>
				<div class='content'>
					<?php the_content() ?>
				</div>

				<?php
					$custom_data = @unserialize( $post->postmeta['custom_data'] );
					if( is_array( $custom_data ) AND !empty( $custom_data ) AND !empty( $custom_data['name'][0] ) AND $blueprint->post_has( 'custom_data' ) ):

				?>
				<div class='product-details'>
					<div class='line-title'><div class='inner'>
						<h3>Details</h3>
					</div></div>
					<dl>
						<?php foreach( $custom_data['name'] as $key => $name ) : ?>
							<dt><?php echo $name ?>:</dt>
							<dd><?php echo $custom_data['value'][$key] ?></dd>
							<br>
						<?php endforeach ?>
					</dl>

				</div>
				<?php endif ?>

			</div>

		</div>
		</div>
	</div>

</div>

<?php if( $blueprint->post_has( 'related_products', $framework->options['related_products_show_related_products'] ) ) : ?>
<?php get_template_part( 'modules/products', 'related' ) ?>
<?php endif ?>


