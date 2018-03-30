<?php
/***************************************
*
*	Define support
*
***************************************/
add_theme_support( 'woocommerce' );

/***************************************
*
*	Remove default styles and scripts
*
***************************************/
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_action( 'wp_enqueue_scripts', 'pix_remove_woo_scripts', 99 );
function pix_remove_woo_scripts() {
	wp_dequeue_style( 'woocommerce_fancybox_styles' );
	wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	wp_dequeue_script( 'fancybox' ); 
	wp_dequeue_script( 'prettyPhoto' ); 
	wp_dequeue_script( 'prettyPhoto-init' ); 
}

/***************************************
*
*	WooCommerce filter content
*
***************************************/
//remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
//add_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 101 );

if (!function_exists('geode_remove_group_price')) {
	add_action('wp_head', 'geode_remove_group_price');
	function geode_remove_group_price() {
		global $post;
		if (!$post)
			return;
		$product = get_product( $post->ID );
		if ( $product->product_type == 'grouped' )
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	}
}

/***************************************
*
*	WooCommerce content
*
***************************************/
function woocommerce_content() {
	pix_woocommerce_content();
}

if (!function_exists('pix_woocommerce_content')) {
	function pix_woocommerce_content() {

		$align = apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position')) == 'right'  ? 'left' : 'right';

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) : the_post();

				if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<?php get_template_part( 'title', '' ); ?>

				<?php endif;

					if ( !geode_get_page_template( 'templates/front-page.php' ) && !geode_get_page_template( 'templates/wide-page.php' ) ) { 
						$double = geode_get_page_template( 'templates/double-side-page.php' ) ? 'double-' : '';
				?>
					<div class="site-content cf site-main <?php echo $double; ?>side-template">

						<?php if ( apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position'))=='left' || geode_get_page_template( 'templates/double-side-page.php' ) ) geode_sidebar('left'); ?>

						<div id="primary" class="alignleft" data-delay="0">
				<?php } else {
					if ( geode_get_page_template( 'templates/wide-page.php' ) ) { ?>
						<div id="primary" class="site-content">
					<?php } else { ?>
						<div id="primary" class="site-content cf align<?php echo $align; ?>">
					<?php } ?>
				<?php } ?>

						<div class="entry-content">
							<div class="row">
								<div class="row-inside">
									<div class="column <?php echo apply_filters('geode_fx_onscroll',''); ?>">
										<?php
											woocommerce_get_template_part( 'content', 'single-product' );
										?>
									</div><!-- .column -->
								</div><!-- .row-inside -->
							</div><!-- .row -->
						</div><!-- .entry-content -->

					</div><!-- #primary -->
				<?php if ( !geode_get_page_template( 'templates/front-page.php' ) && !geode_get_page_template( 'templates/wide-page.php' ) ) { ?>
					<?php geode_sidebar('right'); ?>
					</div><!-- .site-content -->
				<?php }

			endwhile;

		} else { ?>

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) && !geode_get_page_template( 'templates/front-page.php' ) ) : ?>

				<header class="entry-header row">
					<div class="row-inside">
						<?php do_action('pix_title_bg'); ?>
						<?php if ( !pix_hide_title() ) { ?>
						<?php 
							if ( is_tax() ) {
								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
								$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
								$image = wp_get_attachment_image_src( $thumbnail_id, 'mini_th' );
								$image = $image[0];
							}
						?>
						<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
							<h1 class="entry-title">
								<span class="row-inside">
									<?php if (isset($image) && $image!='') { ?><img src="<?php echo $image; ?>" alt="<?php echo single_term_title( "", false ); ?>" class="wrap_image alignleft pix_tax_image"><?php } ?>
									<?php woocommerce_page_title(); ?>
								</span><!-- .row-inside -->
							</h1>
							<?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
						</div>
						<?php } ?>
					</div><!-- .row-inside -->
				</header>

			<?php endif; ?>

			<?php
				if ( !geode_get_page_template( 'templates/front-page.php' ) && !geode_get_page_template( 'templates/wide-page.php' ) ) { 
					$double = geode_get_page_template( 'templates/double-side-page.php' ) ? 'double-' : '';
			?>

				<div class="site-content cf site-main <?php echo $double; ?>side-template">

					<?php if ( apply_filters('geode_sidebar_position', get_option('pix_style_main_sidebar_position'))=='left' || geode_get_page_template( 'templates/double-side-page.php' ) ) geode_sidebar('left'); ?>
				
					<div id="primary" class="align<?php echo $align; ?>">

			<?php } else { ?>
					<div id="primary" class="site-content">
			<?php } ?>
						<div id="content" role="main">
							<?php do_action( 'woocommerce_archive_description' ); ?>

							<?php if ( have_posts() ) : ?>

								<?php do_action('woocommerce_before_shop_loop'); ?>

								<?php woocommerce_product_loop_start(); ?>

									<?php woocommerce_product_subcategories(); ?>

									<?php while ( have_posts() ) : the_post(); ?>

										<?php woocommerce_get_template_part( 'content', 'product' ); ?>

									<?php endwhile; // end of the loop. ?>

								<?php woocommerce_product_loop_end(); ?>

								<?php do_action('woocommerce_after_shop_loop'); ?>

							<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

								<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
										</div><!-- .row-inside -->
									</div><!-- .row -->
								</div><!-- .entry-content -->
							<?php endif; ?>

						</div><!-- #content -->
					</div><!-- #primary -->

			<?php if ( !geode_get_page_template( 'templates/front-page.php' ) && !geode_get_page_template( 'templates/wide-page.php' )  ) { ?>
					<?php geode_sidebar('right'); ?>
				</div><!-- .site-content -->
			<?php } ?>
		<?php }
	}
}


function woocommerce_get_product_thumbnail() {
	echo geode_woocommerce_get_product_thumbnail();
}

if ( ! function_exists( 'geode_woocommerce_get_product_thumbnail' ) ) :
function geode_woocommerce_get_product_thumbnail( $size = 'geode_large', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $product, $woocommerce, $shortcode_layout;

	if ( is_shop() ) {
		$ratio = get_option('pix_style_shop_list_template');
	} elseif ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$t_slug = $term->slug.'_product_cat';
		$term_meta = get_option( "taxonomy_$t_slug" );
		$ratio = isset($term_meta['layout']) && $term_meta['layout']!='' ? esc_attr( $term_meta['layout'] ) : get_option('pix_style_woo_list_layout');
	} elseif ( !empty($shortcode_layout) ) {
		$ratio = $shortcode_layout;
	} else {
		$ratio = get_option('pix_style_woo_list_layout');
	}

	$page_template = geode_get_page_template();
	$columns = loop_columns();

	switch ($page_template) {
		case 'templates/wide-page.php':
			$width = 1120;
			break;
		case 'templates/double-side-page.php':
			$width = 560;
			break;
		default:
			$width = 840;
			break;
	}

	if ( ($width/$columns)<=560 ) {
		$size = 'geode_medium';
	} else {
		$size = 'geode_large';
	}


	switch ($ratio) {
		case '1:1':
			$ratio = array(1120,1120);
			break;
		case '4:3':
			$ratio = array(1120,840);
			break;
		case '16:9':
			$ratio = array(1120,630);
			break;
		default:
			$ratio = array(1120,0);
			break;
	}

	if ( has_post_thumbnail() )
		return geode_post_thumbnail( null, apply_filters('geode_post_thumbnail',$size), $ratio, array( 'class' => 'attachment-shop_catalog' ) );
		//return get_the_post_thumbnail( $post->ID, $size );
	elseif ( wc_placeholder_img_src() )
		return wc_placeholder_img( $size );
}
endif;

add_filter ('single_product_large_thumbnail_size', 'geode_single_product_large_thumbnail_size');
function geode_single_product_large_thumbnail_size( $size ) {
	$page_template = geode_get_page_template();
	switch ($page_template) {
		case 'templates/wide-page.php':
			$size = 'geode_large';
			break;
		case 'templates/double-side-page.php':
			$size = 'geode_medium';
			break;
		default:
			$size = 'geode_medium';
			break;
	}
	return $size;
}

function woocommerce_subcategory_thumbnail( $category ) {
	echo geode_woocommerce_subcategory_thumbnail( $category );
}

if ( ! function_exists( 'geode_woocommerce_subcategory_thumbnail' ) ) :

	function geode_woocommerce_subcategory_thumbnail( $category ) {
		$page_template = geode_get_page_template();
		switch ($page_template) {
			case 'templates/wide-page.php':
				$size = 'geode_large';
				break;
			case 'templates/double-side-page.php':
				$size = 'geode_medium';
				break;
			default:
				$size = 'geode_medium';
				break;
		}
		$small_thumbnail_size  	= $size;
		$dimensions    			= wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}

		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" />';
		}
	}
endif;

if ( ! function_exists( 'geode_single_product_small_thumbnail_size' ) ) :
	add_filter( 'single_product_small_thumbnail_size', 'geode_single_product_small_thumbnail_size', 25, 1 );
	function geode_single_product_small_thumbnail_size( $size ) {
	    $size = 'geode_small';
	    return $size;
	}
endif;


/***************************************
*
*	Mini cart thumbnail size
*
***************************************/
add_filter( 'woocommerce_cart_item_thumbnail', 'geode_cart_item_thumbnail', 10, 3);
function geode_cart_item_thumbnail( $thumb, $cart_item, $cart_item_key ) { 
	$product = $cart_item['data'];
	return $product->get_image( 'geode_small' ); 
}

/***************************************
*
*	Add wishlist button
*
***************************************/
add_action('woocommerce_after_shop_loop_item_title','pix_addWishListBut',1);
function pix_addWishListBut(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('yith-woocommerce-wishlist/init.php')) {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
}

/***************************************
*
*	Remove image size fields
*
***************************************/
add_filter('woocommerce_catalog_settings','pix_removeWooImageSizes');
add_filter('woocommerce_product_settings','pix_removeWooImageSizes');
function pix_removeWooImageSizes($fields){
	foreach($fields as $field => $val)
	{
	    foreach($val as $key) {
	    	if($val['id'] == 'image_options') {
	    		unset($fields[$field]);
	    	}
	    	if($val['id'] == 'shop_catalog_image_size') {
	    		unset($fields[$field]);
	    	}
	    	if($val['id'] == 'shop_single_image_size') {
	    		unset($fields[$field]);
	    	}
	    	if($val['id'] == 'shop_thumbnail_image_size') {
	    		unset($fields[$field]);
	    	}
	    	if($val['id'] == 'image_options') {
	    		unset($fields[$field]);
	    	}
	    }
	}
	return $fields;
}

/***************************************
*
*	Define WooCommerce image sizes
*
***************************************/
add_action('init','pix_WooImgSizes');
function pix_WooImgSizes() {
	$geode_inter = array(
		'width' 	=> '560',
		'height'	=> '0',
		'crop'		=> true
	);
	$geode_medium = array(
		'width' 	=> '840',
		'height'	=> '0',
		'crop'		=> true
	);
	$geode_small = array(
		'width' 	=> '200',
		'height'	=> '0',
		'crop'		=> true
	);
	update_option( 'shop_catalog_image_size', $geode_inter );
	update_option( 'shop_single_image_size', $geode_medium );
	update_option( 'shop_thumbnail_image_size', $geode_small );
}


add_action('woocommerce_before_single_product_summary','pix_start_of_product');
add_action('woocommerce_after_shop_loop_item','pix_start_of_product', 100);
function pix_start_of_product(){
	echo '<div class="pix-quick-view cf">';
}

add_action('woocommerce_after_single_product_summary','pix_end_of_product', 0);
add_action('woocommerce_after_shop_loop_item','pix_end_of_product', 108);
function pix_end_of_product(){
	echo '</div><!-- .pix-quick-view -->';
}

add_action('woocommerce_archive_description','pix_woocommerce_page_starter');
function pix_woocommerce_page_starter(){ ?>
	<div class="entry-content">
		<div class="row">
			<div class="row-inside">
<?php }

add_action('woocommerce_after_shop_loop','pix_woocommerce_page_end');
function pix_woocommerce_page_end(){ ?>
			</div><!-- .row-inside -->
		</div><!-- .row -->
	</div><!-- .entry-content -->
<?php }

function pix_quick_view(){
	if ( !is_single() && get_option('pix_style_woo_quick_view')!='0' ) {
		//to activate the variations on quick view
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 107 );
	}
}
add_action('wp', 'pix_quick_view');

add_action('woocommerce_after_shop_loop_item_title','pix_woocommerce_quick_view',1);
function pix_woocommerce_quick_view(){
	if ( get_option('pix_style_woo_quick_view')=='0' )
		return;
	global $post;
	echo '<a href="'.get_permalink($post->ID).'" class="pix-woo-quickview-product">'.__('Quick view','geode').'</a>';
}

add_action('woocommerce_before_shop_loop','pix_woocommerce_filter_open', 19);
function pix_woocommerce_filter_open(){
	echo '<div class="woocommerce-filter-open cf ' . apply_filters('geode_fx_title','') . '">';
}
add_action('woocommerce_before_shop_loop','pix_woocommerce_filter_close', 31);
function pix_woocommerce_filter_close(){
	echo '</div>';
}



add_action( 'woocommerce_before_shop_loop_item_title','pix_woocommerce_template_loop_second_product_thumbnail', 11 );
add_filter( 'post_class', 'product_has_gallery' );
add_filter( 'post_class', 'pix_woo_pixgridder' );

function pix_woocommerce_template_loop_second_product_thumbnail() {
	global $product, $woocommerce, $woocommerce_carousel;

	$ratio = get_option('pix_style_woo_list_layout');

	if ( pix_is_woocommerce() && is_shop() && get_option('pix_style_shop_list_template')!='' ) {
		$ratio = get_option('pix_style_shop_list_template');
	}

	$page_template = geode_get_page_template();
	$columns = loop_columns();

	switch ($page_template) {
		case 'templates/wide-page.php':
			$width = 1120;
			break;
		case 'templates/double-side-page.php':
			$width = 560;
			break;
		default:
			$width = 840;
			break;
	}

	if ( ($width/$columns)<=560 ) {
		$size = 'geode_medium';
	} else {
		$size = 'geode_large';
	}

	switch ($ratio) {
		case '1:1':
			$ratio = array(1120,1120);
			$autoheight = '1:1';
			break;
		case '4:3':
			$ratio = array(1120,840);
			$autoheight = '4:3';
			break;
		case '16:9':
			$ratio = array(1120,630);
			$autoheight = '16:9';
			break;
		default:
			$ratio = array(1120,0);
			$autoheight = 'container';
			break;
	}

	if ( $woocommerce_carousel ) {
		$ratio = array(1120,0);
		$autoheight = 'container';
	}

	$images = '';
	$check_images = array();
	if ( $product->is_type( array( 'variable' ) ) ) {

		$loop = 0;
		$available_variations = $product->get_available_variations();
		foreach ( $available_variations as $variation ) {

			$image_link =  $variation['image_link'];

			if ( $image_link && $loop>0 ) {

				$attachment_id = pix_attachment_meta_by_url($image_link);
				$attachment_id = $attachment_id['id'];

				//echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), '', $attr = array( 'class' => 'attachment-shop_catalog secondary-attachment' ) );
				$img = geode_remove_protocol(geode_post_thumbnail( $attachment_id, $size, $ratio, array( 'class' => 'attachment-shop_catalog secondary-attachment' ), true ));
				$img = preg_replace('/\"/', '\'', $img);
				$img = preg_replace('/ \/>/', '>', $img);
				$img = preg_replace('/\/>/', '>', $img);
				$img = preg_replace('/\/>/', '>', $img);
				if ( !in_array($attachment_id, $check_images) ) {
					$check_images[] = $attachment_id;
					$images .= '"'.$img.'",';
				}

			}

			$loop++;

		}
	}

	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$i = 1;
		foreach ($attachment_ids as $key => $value) {
			//echo wp_get_attachment_image( $value, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), '', $attr = array( 'class' => 'attachment-shop_catalog secondary-attachment image-'.$value ) );
			$img = geode_remove_protocol(geode_post_thumbnail( $value, $size, $ratio, array( 'class' => 'attachment-shop_catalog secondary-attachment image-'.$value ), true ));
			$img = preg_replace('/\"/', '\'', $img);
			$img = preg_replace('/ \/>/', '>', $img);
			$img = preg_replace('/\/>/', '>', $img);
			if ( !in_array($value, $check_images) ) {
				$check_images[] = $value;
				$images .= '"'.$img.'",';
			}
			$i++;
		}
	}

	if ( $images && isset($i) ) {

		$images = rtrim($images, ',');
		echo '<script id="cycle-lazy-images-'.get_the_id().'" class="cycle-lazy-images" type="text/cycle" data-autoheight="'.$autoheight.'" data-total-slides="'.$i.'">['.$images.']</script>';

	}
}

function product_has_gallery( $classes ) {
	global $product, $woocommerce;

	if ( is_admin() )
		return $classes;

	$post_type = get_post_type( get_the_ID() );

	if ( $post_type == 'product' ) {

		if ( $product->is_type( array( 'variable' ) ) ) {

			$available_variations = $product->get_available_variations();
			foreach ( $available_variations as $variation ) {

				$image_link =  $variation['image_link'];

				if ( $image_link ) {
					$classes[] = 'pix-woo-gallery';
					break;				
				}

			}
		}

		$attachment_ids = $product->get_gallery_attachment_ids();

		if ( $attachment_ids ) {
			foreach ($attachment_ids as $key => $value) {
				if ( wp_get_attachment_image( $value, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), '') != '' ) {
					$classes[] = 'pix-woo-gallery';
					break;				
				}
			}
		}
	}

	return $classes;
}

function geode_product_span() {
	global $product, $woocommerce;

	echo ' data-id="'.get_the_id().'"';
}
add_action ('geode_product_span','geode_product_span');

function pix_woo_pixgridder( $classes ) {
	global $product;

	if ( is_admin() )
		return $classes;

	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$classes[] = 'column';
		$classes[] = 'pix-leftmebe';
		$classes[] = apply_filters('geode_fx_onscroll','');
	}

	return $classes;
}

function woocommerce_taxonomy_archive_description(){
	pix_woocommerce_taxonomy_archive_description();
}
if ( ! function_exists( 'pix_woocommerce_taxonomy_archive_description' ) ) {
	function pix_woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
			$description = apply_filters( 'the_content', term_description() );
			if ( $description ) {
				echo '<div class="term-description row"><div class="row-inside"><div class="row" data-cols="1"><div class="row-inside">
				<div class="column" data-col="1">'
				. $description .
				'</div>
				</div></div></div></div>';
			}
		}
	}
}

function woocommerce_product_archive_description(){
	pix_woocommerce_product_archive_description();
}
if ( ! function_exists( 'pix_woocommerce_product_archive_description' ) ) {

	function pix_woocommerce_product_archive_description() {
		if ( is_post_type_archive( 'product' ) && get_query_var( 'paged' ) == 0 ) {
			$shop_page   = get_post( woocommerce_get_page_id( 'shop' ) );
			if ( $shop_page ) {
				$description = apply_filters( 'the_content', $shop_page->post_content );
				if ( sanitize_text_field($description)!='' ) {
					echo '<div class="page-description row"><div class="row-inside">' . $description . '</div></div>';
				}
			}
		}
	}
}


if ( !function_exists( 'geode_pixgridder_shop_id' ) && !function_exists( 'geode_pixgridder_shop_posttype' ) ) : 
/**
* Add shop page to PixGridder rules
* @since Geode 1.0
*/
add_filter('pixgridder_filter_content_post_type', 'geode_pixgridder_shop_posttype');
add_filter('pixgridder_filter_content_post_id', 'geode_pixgridder_shop_id');
function geode_pixgridder_shop_id($post_id){
	if ( pix_is_woocommerce() && is_shop() ) {
		$post_id = woocommerce_get_page_id('shop');
	}
	return $post_id;
}
function geode_pixgridder_shop_posttype($typenow){
	if ( pix_is_woocommerce() && is_shop() ) {
		$typenow = 'page';
	}
	return $typenow;
}

endif;


add_action( 'init', 'custom_fix_thumbnail' );
 
function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
	function custom_woocommerce_placeholder_img_src( $src ) {
	$src = get_template_directory_uri() . '/images/placeholder.svg';
	 
	return $src;
	}
}




if (!function_exists('loop_columns')) {
	add_filter('loop_shop_columns', 'loop_columns');
	function loop_columns() {
		$columns = get_option('pix_style_woo_list_columns');
		if ( is_tax() ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$t_slug = $term->slug.'_product_cat';
			$term_meta = get_option( "taxonomy_$t_slug" );
			$columns = get_option( 'pix_style_woo_list_columns' );
			$columns = isset( $term_meta['columns'] ) && $term_meta['columns']!='' ? esc_attr( $term_meta['columns'] ) : $columns;
		} elseif ( pix_is_woocommerce() && is_shop() && get_option('pix_style_shop_list_columns')!='' ) {
			$columns = get_option('pix_style_shop_list_columns');
		}
		return $columns;
	}
}


function filter_compare($options) {
	foreach($options as $option => $val)
	{
		$i = 0;
	    foreach($val as $key) {
	    	if($key['id'] == 'yith_woocompare_is_button') {
	    		unset($options[$option][$i]);
	    	}
	    	if($key['id'] == 'yith_woocompare_image_size') {
	    		unset($options[$option][$i]);
	    	}
	    	if($key['id'] == 'yith_woocompare_button_text') {
	    		unset($options[$option][$i]);
	    	}
	    	if($key['id'] == 'yith_woocompare_table_text') {
	    		unset($options[$option][$i]);
	    	}
	    	$i++;
	    }
	}
	return $options;
}
add_filter('yith_woocompare_tab_options', 'filter_compare');

function geode_woo_comment_form_fields($comment_form){
	$commenter = wp_get_current_commenter();

	$comment_form = array(
		'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'fields'               => array(
			'author' => '<p class="comment-form-author">' . 
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Name', 'woocommerce' ) . '*" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email">' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . __( 'Email', 'woocommerce' ) . '*" aria-required="true" /></p>',
		),
		'label_submit'  => __( 'Submit', 'woocommerce' ),
		'logged_in_as'  => '',
		'comment_field' => ''
	);

	if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
		$comment_form['comment_field'] = '<p class="comment-form-rating"><select name="rating" id="rating">
			<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
			<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
			<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
			<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
			<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
			<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
		</select></p>';
	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . __( 'Your Review', 'woocommerce' ) . '*" aria-required="true"></textarea></p>';

	return $comment_form;
}
add_filter('woocommerce_product_review_comment_form_args', 'geode_woo_comment_form_fields');

if ( !function_exists('geode_cart_is_empty') ) :
add_action('woocommerce_cart_is_empty', 'geode_cart_is_empty');
function geode_cart_is_empty(){
	echo '<p class="geode_cart_is_empty"><i class="scicon-ecommerce-248"></i></p>';
}
endif;

/**
 * WooCommerce Extra Feature
 * --------------------------
 *
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 *
 */ 
function geode_related_products_limit($args) {
  global $product;
	
	$args['posts_per_page'] = geode_woocommerce_cross_sells_columns();

	return $args;
}
add_filter( 'woocommerce_related_products_args', 'geode_related_products_limit' );
add_filter( 'geode_woocommerce_up_sells_args', 'geode_related_products_limit' );

function geode_woo_search_form($form) {
    $form = '<form role="search" method="get" class="search-form cf" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
    <label>
    	<input type="search" class="search-field" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'geode' ) . '">
    </label>
    <button type="submit" id="searchsubmit"><i class="scicon-awesome-search"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>';

	return $form;
}
add_filter( 'get_product_search_form', 'geode_woo_search_form' );

add_filter('woocommerce_cross_sells_columns', 'geode_woocommerce_cross_sells_columns');
add_filter('woocommerce_cross_sells_total', 'geode_woocommerce_cross_sells_columns');
add_filter('geode_woocommerce_related_products_columns', 'geode_woocommerce_cross_sells_columns');
add_filter('geode_woocommerce_up_sells_columns', 'geode_woocommerce_cross_sells_columns');
function geode_woocommerce_cross_sells_columns(){
	$page_template = geode_get_page_template();
	switch ($page_template) {
		case 'default':
			$columns = 3;
			break;
		case 'templates/double-side-page.php':
			$columns = 2;
			break;
		default:
			$columns = 4;
			break;
	}
	return $columns;
}

if (get_option('pix_style_related_products')=='true')
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_template_loop_product_title() {
	echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
}