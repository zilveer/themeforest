<?php
/**
 * Mental gallery shortcode and loop
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

add_shortcode('su_mental_woo_gallery', 'mental_woo_gallery_shortcode');
function mental_woo_gallery_shortcode($atts, $content = null)
{
	if( ! class_exists('WC_Product') ) return __( 'Please activate WooCommerce', 'mental' );

	$atts = shortcode_atts( array(
		'id'             => 'gallery-' . rand( 1, 999 ),
		'category'       => 0,
		'items_per_page' => get_mental_option( 'woo_gallery_items_per_page' ),
		'columns_count'  => get_mental_option( 'woo_gallery_columns_count' ),
		'show_load_more' => true,
		'show_filter'    => 'yes',
		'filter_align'   => 'left',
		'load_on_scroll' => get_mental_option( 'woo_gallery_load_on_scroll' ) ? 'yes' : 'no',
		'ajax_action'    => 'mental_woo_gallery',
		'item_padding' => '0',
	), $atts, 'su_mental_blog' );

	$filters = get_terms( "product_cat", array( 'parent' => $atts['category'] ) );

	ob_start();
   ?>

	<?php if ( ! empty( $filters ) && $atts['show_filter'] == 'yes' ): ?>

		<ul class="gallery-filters" data-gallery-id="<?php echo esc_attr($atts['id']); ?>" style="text-align: <?php echo esc_attr($atts['filter_align']); ?>">
			<li class="active"><a data-filter="*" href="#"><?php _e( 'All', 'mental' ) ?></a></li>
			<?php foreach ( $filters as $filter ): //if ($category->slug == 'uncategorized') continue; {{?>
				<li><a data-filter="<?php echo esc_attr($filter->slug); ?>" href="#"><?php echo esc_html($filter->name); ?></a></li>
			<?php endforeach ?>
			<li class="gf-underline"></li>
		</ul>

	<?php endif ?>


	<ul id="<?php echo esc_attr($atts['id']) ?>"
	    class="gallery gl-cols-<?php echo esc_attr($atts['columns_count']) ?> woocommerce"
	    data-options="<?php echo esc_attr(azl_serialize_atts($atts)); ?>">

		<?php mental_woo_gallery_loop( 0, $atts ) ?>
	</ul> <!-- gallery -->

	<?php if ( $atts['load_on_scroll'] == 'yes' ): ?>

		<div class="load-more-block dark lmb-on-scroll">
			<span class="loading-spinner"></span>
			<span class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php if ( $atts['show_load_more'] == 'yes' && $atts['load_on_scroll'] == 'no' ): ?>

    <div class="load-more-block dark">
			<a href="#" class="load-more-button" data-gallery-id="<?php echo esc_attr($atts['id']); ?>"><?php _e( 'Load more', 'mental' ) ?></a>
			<span class="loading-spinner"></span>
			<span class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php
	return ob_get_clean();
}


function mental_woo_gallery_loop($offset, $atts)
{
	$paged = ceil( $offset / $atts['items_per_page'] ) + 1;

	// Can work with or ID or Slug
	if ( intval( $atts['category'] ) ) {
		$tax_field = "term_id";
	} else {
		$tax_field = "slug";
	}

	if ( ! empty( $atts['category'] ) ) {
		$tax_query = array(
			array(
				'taxonomy' => 'product_cat',
				'terms'    => $atts['category'],
				'field'    => $tax_field,
			)
		);
	} else {
		$tax_query = '';
	}

	query_posts( array(
		'post_type'      => 'product',
		'tax_query'      => $tax_query,
		'post_status'    => 'publish',
		'posts_per_page' => $atts['items_per_page'],
		'paged'          => $paged
	) );
	?>

   <?php while (have_posts()) : the_post(); ?>

		<?php // Get categories
		$post_filters = wp_get_post_terms( get_the_ID(), 'product_cat' );
		$filt_names   = array();
		$filt_slugs   = array();

		foreach ( $post_filters as $post_filter ) {
			$filt_names[] = $post_filter->name;
			$filt_slugs[] = $post_filter->slug;
		}

		$product = new WC_Product( get_the_ID() );

		?>
		<li class="gl-item gl-loading gl-fixed-ratio-item gl-fri-square products"
			data-category="<?php echo implode( ', ', $filt_slugs ) ?>" style="padding: <?php echo esc_attr($atts['item_padding']) . 'px' ;?>">

			<a href="<?php the_permalink() ?>">
				<figure>
					<?php if ( has_post_thumbnail() ): ?>
						<?php
						if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'additional_thumbnail')) :
							MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'additional_thumbnail');
						else:
							the_post_thumbnail( 'medium', array( 'alt' => '' ) );
						endif;
						?>
					<?php else: ?>
						<img src="<?php echo wc_placeholder_img_src() ?>" alt="Placeholder">
					<?php endif ?>
					<figcaption>
						<div class="middle">
							<div class="middle-inner">

								<p class="gl-item-price"><?php woocommerce_get_template( 'loop/price.php' ); ?></p>

								<p class="gl-item-title"><?php the_title(); ?></p>

								<p class="gl-item-category"><?php echo implode( ', ', $filt_names ) ?></p>

							</div>
						</div>
					</figcaption>
				</figure>
			</a>


			<div class="gl-preview" style="diplay:none;" data-category="people">
				<span class="glp-arrow"></span>
				<a href="#" class="glp-close"></a>

				<div class="row gl-preview-container">
					<div class="col-sm-8 gl-preview-image">

						<?php
						$attachment_ids = $product->get_gallery_attachment_ids();
						foreach ( $attachment_ids as $k => $img_id ) if( ! wp_get_attachment_image_src( $img_id, 'large' ) ) unset($attachment_ids[$k]);

						if( $attachment_ids ):
							if($feat_image_id = $product->get_image_id()) array_unshift($attachment_ids, $feat_image_id);
							?>

							<div id="carousel-<?php echo get_the_ID() ?>" class="carousel slide" data-ride="carousel">

								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									<?php
									//$attachment_ids = explode( ',', $gallery['ids'] );
									$i = 0;
									foreach ( $attachment_ids as $img_id ):
										?>
										<?php $img_src = wp_get_attachment_image_src( $img_id, 'large' ); ?>
										<?php $img_full_src = wp_get_attachment_image_src( $img_id, 'full' ) ?>
										<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?>">
											<img src="<?php echo esc_url($img_src[0]); ?>" alt="slide">
											<a class="glp-zoom" data-image="<?php echo esc_url($img_full_src[0]); ?>"><i></i></a>
										</div>
									<?php $i ++; endforeach ?>
								</div>
								<!-- Indicators -->
								<ol class="carousel-indicators">
									<?php $i = 0; foreach ( $attachment_ids as $img_id ): ?>
										<li data-target="#carousel-<?php echo get_the_ID() ?>" data-slide-to="<?php echo (int) $i ?>" class="<?php echo ( $i == 0 ) ? 'active' : '' ?>"></li>
										<?php $i ++; endforeach ?>
								</ol>

								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-<?php echo get_the_ID() ?>" data-slide="prev">
									<span></span>
								</a>
								<a class="right carousel-control" href="#carousel-<?php echo get_the_ID() ?>" data-slide="next">
									<span></span>
								</a>

							</div> <!-- carousel -->

						<?php elseif ( has_post_thumbnail() ):
							$img_full_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
							<figure>
								<?php the_post_thumbnail( 'medium' ) ?>
								<a class="glp-zoom" data-image="<?php echo esc_url($img_full_src[0]); ?>"><i></i></a>
							</figure>
						<?php else: ?>
							<figure>
								<img src="<?php echo wc_placeholder_img_src() ?>" alt="Placeholder">
							</figure>
						<?php endif ?>

					</div>
					<div class="col-sm-4 gl-preview-descr">

						<h4><?php the_title(); ?></h4>

						<div class="glp-product-rating"><?php woocommerce_get_template( 'loop/rating.php' ); ?></div>

						<h6 class="glp-product-price"><?php woocommerce_get_template( 'loop/price.php' ); ?></h6>

						<?php echo apply_filters( 'woocommerce_short_description', get_the_excerpt() ) ?>

						<p class="glp-product-buttons">
							<?php woocommerce_get_template( 'loop/add-to-cart.php', array('gallery_preview' => true) ); ?>
							<a href="<?php the_permalink() ?>" class="btn btn-primary"><?php _e('View Product', 'mental') ?></a>
						</p>

						<?php if( get_mental_option( 'social_block_show' ) ): ?>
							<div class="mb-social glp-social">
								<span><?php _e('Share', 'mental') ?></span>
								<?php get_template_part('blocks/social-share') ?>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div> <!-- gl-preview -->

		</li>

	<?php
	endwhile;
	wp_reset_query();
	?>
<?php
}
