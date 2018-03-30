<?php

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

add_shortcode( 'vcm_mental_woo_gallery', 'vcm_mental_woo_gallery_shortcode' );
function vcm_mental_woo_gallery_shortcode( $atts, $content = null ) {
	if ( ! class_exists( 'WC_Product' ) )
		return __( 'Please activate WooCommerce', 'mental' );

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
		'item_padding'   => '0',
	), $atts, 'vcm_mental_blog' );

	$filters = get_terms( "product_cat", array( 'parent' => $atts['category'] ) );

	ob_start();
	?>

	<?php if ( ! empty( $filters ) && $atts['show_filter'] == 'yes' ): ?>

		<ul class="gallery-filters" data-gallery-id="<?php echo esc_attr( $atts['id'] ); ?>" style="text-align: <?php echo esc_attr( $atts['filter_align'] ); ?>">
			<li class="active all-filterp" ><a data-filter="*" href="#"><?php _e( 'All', 'mental' ) ?></a></li>
						<?php
					$i = 0;		
			?>
			<?php foreach ( $filters as $filter ): //if ($category->slug == 'uncategorized') continue; {{?>
				<li class="item-filterp"  data-fl="filter<?php echo $i++; ?>p" ><a data-filter="<?php echo esc_attr( $filter->slug ); ?>" href="#"><?php echo esc_html( $filter->name ); ?></a></li>
			<?php endforeach ?>
			<li class="gf-underline"></li>
		</ul>

	<?php endif ?>

 <div class="gallery-home_p active" data-amount="<?php echo esc_attr( $atts['items_per_page'] ); ?>">
	<ul id="<?php echo esc_attr( $atts['id'] ) ?>"
	    class="gallery galleryp gallery-home-innerp gl-cols-<?php echo esc_attr( $atts['columns_count'] ) ?> woocommerce"
	    data-options="<?php echo esc_attr( azl_serialize_atts( $atts ) ); ?>">
		<?php vcm_mental_woo_gallery_loop( 0, $atts ) ?>
	</ul> <!-- gallery -->
 </div>
	<?php if ( $atts['load_on_scroll'] == 'yes' ): ?>

		<div id="scloadp" class="load-more-block  load-more-blockp dark lmb-on-scroll">
			<span class="loading-spinner"></span>
			<span class="no-more-items-sign no-more-items-signp"><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php if ( $atts['show_load_more'] == 'yes' && $atts['load_on_scroll'] == 'no' ): ?>
		<div  id="load-more-blockp" class="load-more-block loadmore dark">
			<a href="#" class="load-more-button load-more-buttonp" data-gallery-id="<?php echo esc_attr( $atts['id'] ); ?>"><?php _e( 'Load more', 'mental' ) ?></a>
			<span class="loading-spinner"></span>
			<span id="item-more" class="no-more-items-sign"><?php _e( 'No more items', 'mental' ) ?></span>
		</div>
	<?php endif ?>

	<?php
	return ob_get_clean();
}


function vcm_mental_woo_gallery_loop( $offset, $atts ) {
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
		'posts_per_page' => -1,
		'paged'          => $paged
	) );
	?>

	<?php while ( have_posts() ) : the_post(); ?>

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
		<li class="gl-item gallery-item_p  gallery-item-animep gl-loading gl-fixed-ratio-item gl-fri-square products"
		    data-category="<?php echo implode( ', ', $filt_slugs ) ?>"
		    style="padding: <?php echo esc_attr( $atts['item_padding'] ) . 'px'; ?>">

			<a href="<?php the_permalink() ?>">
				<figure>
					<?php if ( has_post_thumbnail() ): ?>
						<?php
						if ( class_exists( 'MultiPostThumbnails' ) && MultiPostThumbnails::has_post_thumbnail( get_post_type(), 'additional_thumbnail' ) ) :
							MultiPostThumbnails::the_post_thumbnail( get_post_type(), 'additional_thumbnail' );
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
						foreach ( $attachment_ids as $k => $img_id ) {
							if ( ! wp_get_attachment_image_src( $img_id, 'large' ) )
								unset( $attachment_ids[ $k ] );
						}

						if ( $attachment_ids ):
							if ( $feat_image_id = $product->get_image_id() )
								array_unshift( $attachment_ids, $feat_image_id );
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
											<img src="<?php echo esc_url( $img_src[0] ); ?>" alt="slide">
											<a class="glp-zoom" data-image="<?php echo esc_url( $img_full_src[0] ); ?>"><i></i></a>
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
								<a class="glp-zoom" data-image="<?php echo esc_url( $img_full_src[0] ); ?>"><i></i></a>
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
							<?php woocommerce_get_template( 'loop/add-to-cart.php', array( 'gallery_preview' => true ) ); ?>
							<a href="<?php the_permalink() ?>" class="btn btn-primary"><?php _e( 'View Product', 'mental' ) ?></a>
						</p>

						<?php if ( get_mental_option( 'social_block_show' ) ): ?>
							<div class="mb-social glp-social">
								<span><?php _e( 'Share', 'mental' ) ?></span>
								<?php get_template_part( 'blocks/social-share' ) ?>
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

add_action( 'vc_before_init', 'mental_product_gallery_integrateWithVC' );
function mental_product_gallery_integrateWithVC() {
	if( ! class_exists('WC_Product') ) return false;

	$products_categories_raw = get_terms( 'product_cat', 'orderby=name&hide_empty=0' );
	$products_categories     = array( '' => '' );
	foreach ( $products_categories_raw as $products_category ) {
		$products_categories[ $products_category->name ] = $products_category->term_id;
	}

	vc_map( array(
		'icon'            => 'vcm-mental-woo-gallery',
		'name'            => __( 'Mentas Products Gallery', 'mental' ),
		"base"            => "vcm_mental_woo_gallery", // bind with our shortcode
		"content_element" => true, // set this parameter when element will has a content
		//"is_container" => true, // set this param when you need to add a content element in this element
		"category"        => __( 'Mentas Elements' ),
		// Here starts the definition of array with parameters of our compnent
		"params"          => array(
			array(
				'type'       => 'dropdown',
				'param_name' => 'category',
				'heading'    => __( 'Product category', 'mental' ),
				'value'      => $products_categories
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'load_on_scroll',
				'heading'    => __( 'Load new items on scroll (infinite scroll)', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'show_filter',
				'heading'    => __( 'Show filters panel', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'filter_align',
				'heading'    => __( 'Filter align', 'mental' ),
				'value'      => array(
					'Left'   => 'left',
					'Center' => 'center',
					'Right'  => 'right',
				)
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'fixed_items',
				'heading'     => __( 'Fixed images ratio', 'mental' ),
				'description' => __( 'Works only with gallery type Normal', 'mental' ),
				'value'       => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'items_per_page',
				'heading'    => __( 'Items per page', 'mental' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'columns_count',
				'heading'    => __( 'Columns count', 'mental' ),
				'value'      => array(
					'3' => '3',
					'4' => '4',
					'5' => '5'
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'item_padding',
				'heading'    => __( 'Item padding', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'id',
				'heading'    => __( 'Gallery ID', 'mental' )
			),
		)
	) );
}

