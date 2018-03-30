<?php
#-----------------------------------------
#	RT-Theme woo-integration.php
#-----------------------------------------

#-----------------------------------------
#	remove woo actions
#-----------------------------------------

global $woocommerce, $suffix;
//remove woo styles
if(!is_admin()){
	//define('WOOCOMMERCE_USE_CSS', false);
	add_action("wp_enqueue_scripts", "rt_remove_woo_stlyes");
}



//wrapper removes
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); // remove woo main content
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); // remove woo main content end


//breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );	// remove breadcrumb

//pagination
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 ); // remove woo pagination

//remove woo sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); // remove woo sidebar

//catalog ordering
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 ); // remove catalog ordering 

//remove woo thumbs
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// remove single product title
remove_action( "woocommerce_single_product_summary","woocommerce_template_single_title",5);	

//remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//remove upsell products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15); 

//remove single product imgages
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

//remove single product thumbnails 
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

//remove before shop hooks
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
 
//remove after shop hooks
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

//category thumbnails
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );

#-----------------------------------------
#	add woo actions
#-----------------------------------------

//wrapper adds
add_action( 'woocommerce_before_main_content', 'rt_woocommerce_output_content_wrapper', 10); 	// add new wrapper sub_page_header
add_action( 'woocommerce_after_main_content', 'rt_woocommerce_output_content_wrapper_end', 10); // add new wrapper sub_page_footer

//paginatin
add_action( 'woocommerce_pagination', 'rt_woocommerce_pagination', 10 ); // add new rt-pagination

//add custom thumbs
add_action( 'woocommerce_before_shop_loop_item_title', 'rt_woocommerce_template_loop_product_thumbnail', 10);
 
//add related products
add_action( 'woocommerce_after_single_product_summary', 'rt_woocommerce_output_related_products', 20);

// add title for single product title
add_action( "woocommerce_before_single_product","rt_woocommerce_single_product_summary",5);

//add upsell products
add_action( 'woocommerce_after_single_product_summary', 'rt_woocommerce_upsell_display', 15);

//remove single product imgages
add_action( 'woocommerce_before_single_product_summary', 'rt_woocommerce_show_product_images', 20 );

//remove product thumbnails 
add_action( 'woocommerce_product_thumbnails', 'rt_woocommerce_show_product_thumbnails', 20 );

//category thumbnails
add_action( 'woocommerce_before_subcategory_title', 'rt_woocommerce_subcategory_thumbnail', 10 );

#-----------------------------------------
#	functions
#-----------------------------------------

//removes woo style file
function rt_remove_woo_stlyes(){
 	wp_deregister_style("woocommerce-general" );
 	 
}


//wrapper sub page header
function rt_woocommerce_output_content_wrapper(){
	global $sidebar;

	//call sub page header
	get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

	//call the sub content holder 1st part
	sub_page_layout("subheader",@$sidebar);
	
	echo '<div class="woocommerce">';
}

//wrapper sub page header - end
function rt_woocommerce_output_content_wrapper_end(){
	global $sidebar;

	echo '</div><div class="space margin-b20"></div>'; 

	//call the sub content holder 2nd part
	sub_page_layout("subfooter",@$sidebar); 
} 


//pagination
function rt_woocommerce_pagination(){
	echo ' 
		<!-- paging-->
		<div class="paging_wrapper clearfix">
			<ul class="paging">
		';
		get_pagination();

	echo ' 
			</ul>
		</div>
	'; 
}

//thumbnail
function rt_woocommerce_template_loop_product_thumbnail() {
	global $post, $woocommerce, $placeholder_width, $placeholder_height, $title;
	
	$placeholder_width  = ! isset( $placeholder_width ) || empty( $placeholder_width ) ? $placeholder_width = wc_get_image_size( 'shop_catalog_image_width' ) : 1;
	$placeholder_width  = is_array( $placeholder_width ) ? $placeholder_width["width"] : 1;
	
	$placeholder_height  = ! isset( $placeholder_height ) || empty( $placeholder_height ) ? $placeholder_height = wc_get_image_size( 'shop_catalog_image_height' ) : 1;
	$placeholder_height  = is_array( $placeholder_height ) ? $placeholder_height["height"] : 1;

	$image = (has_post_thumbnail( $post->ID )) ? get_post_thumbnail_id($post->ID) : "";

	//Thumbnail dimensions
	$w = ($placeholder_width > 640) ? 940 : (($placeholder_width > 400) ? 440 : 420);	
	$h = get_option(THEMESLUG."_woo_product_image_height"); 

	// Crop
	$crop = get_option(THEMESLUG."_woo_product_image_crop"); 
	if($crop) $crop="true"; else $h=10000;	

	// Resize Image
	if($image) $image_thumb = @vt_resize( $image, '',  $w, $h, ''.$crop.'' );


	if ( has_post_thumbnail() )
		echo	'<a href="'.get_permalink().'" class="imgeffect link"><img src="'.$image_thumb['url'].'"  alt="'. $title .'" /></a>'; 
	else
		echo '<a href="'.get_permalink().'" class="imgeffect link"><img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" /></a>';

	echo '<div class="image-border-bottom"></div>';
}

//Single Page Titles
function rt_woocommerce_single_product_summary(){

echo '
		<div class="box one box-shadow margin-b30">
		<div class="head_text nomargin">
			<div class="arrow"></div><!-- arrow -->
		<h2>
';
		if(is_page() || is_single()) the_title();

		if(is_tax())  echo single_term_title( "", false );


	echo '
		</h2>
		</div>
		</div> 
		<div class="clear"></div>
	';
}

add_action( 'woocommerce_before_single_product_summary', 'rt_woocommerce_before_single_product_summary', 5);
add_action( 'woocommerce_after_single_product_summary', 'rt_woocommerce_after_single_product_summary', 10);


function rt_woocommerce_before_single_product_summary() {
	echo '<div class="box one box-shadow margin-b30">';
}

function rt_woocommerce_after_single_product_summary() {
	echo "</div>";
}

//Related Products
function rt_woocommerce_output_related_products() {
		
		global $product, $woocommerce_loop,$related,$posts_per_page,$orderby,$columns;

		$woo_related_product_layout = get_option(THEMESLUG."_woo_related_product_list_pager");
		$woo_related_product_layout = $woo_related_product_layout ? $woo_related_product_layout : 3; //default 3

		$related = $product->get_related(); 
		
		if ( sizeof($related) == 0 ) return;
		
		$args = apply_filters('woocommerce_related_products_args', array(
			'post_type'			=> 'product',
			'ignore_sticky_posts'	=> 1,
			'no_found_rows' 		=> 1,
			'posts_per_page' 		=> $woo_related_product_layout,
			'orderby' 			=> $orderby,
			'post__in' 			=> $related
		));
		
		$products = new WP_Query( $args );
		
		$woocommerce_loop['columns'] 	= $columns;
		
		if ( $products->have_posts() ) : ?>
	 
		<div class="related products">
			<div class="box one box-shadow margin-b30">
				<div class="head_text nomargin">
					<div class="arrow"></div><!-- arrow -->
					<h4><?php _e('Related Products', 'rt_theme'); ?></h4>
				</div>
			</div> 
			<div class="clear"></div> 
				
			<ul class="products">
				
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
		
				<?php endwhile; // end of the loop. ?>
					
			</ul>
			
		</div>
		 	
		<?php endif; 

}

//Up-Sells Products
function rt_woocommerce_upsell_display() {
		
		global $product, $woocommerce_loop,$related,$posts_per_page,$orderby;
		
		$upsells = $product->get_upsells();
		
		if ( sizeof( $upsells ) == 0 ) return;
		
		$args = array(
			'post_type'				=> 'product',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> 4,
			'no_found_rows' 		=> 1,
			'orderby' 				=> 'rand',
			'post__in' 				=> $upsells
		);
		
		$products = new WP_Query( $args );
		 
		$woocommerce_loop['loop'] = 0;

		if ( $products->have_posts() ) : ?>
	 
		<div class="related products">
			<div class="box one box-shadow margin-b30">
				<div class="head_text nomargin">
					<div class="arrow"></div><!-- arrow -->
					<h4><?php _e('You may also like&hellip;', 'rt_theme'); ?></h4>
				</div>
			</div> 
			<div class="clear"></div> 
				
			<ul class="products">
				
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
			
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
		
				<?php endwhile; // end of the loop. ?>
					
			</ul>
			
		</div>
		 	
		<?php endif; 

}


// Single Product Thumbnails
function rt_woocommerce_show_product_images() {
global $post, $woocommerce;
?>

<div class="single-product-images images">

<div class="product_single_featured_image box-shadow frame">
	<?php if ( has_post_thumbnail() ) : ?>

		<a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>"  class="imgeffect magnifier woocommerce-main-image zoom" data-gal="prettyPhoto[rt_theme_products]"  title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array("alt"=>esc_attr( $post->post_title)) ) ?></a>

	<?php else : ?>
	
		<img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
	
	<?php endif; ?>
</div>
	<?php do_action('woocommerce_product_thumbnails'); // call the thumbnails ?>

</div>
<?php
}

// Single Product Thumbnails
function rt_woocommerce_show_product_thumbnails() {
 
global $post, $product, $woocommerce;

	
	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		$imagesHTML = "";
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;
 
			$image_title = esc_attr( get_the_title( $attachment_id ) ); 

			//resize the photo
			$w = 110;
			$h = 90;
			$crop = "true";
			$image_thumb = @vt_resize('' , $image_link, $w, $h, $crop );	 

			$imagesHTML .=  '<li><a class="imgeffect magnifier" href="'.wp_get_attachment_url( $attachment_id ).'" data-gal="prettyPhoto[rt_theme_products]" title="'. $image_title .'"><img src="'.$image_thumb['url'].'" width="'.$image_thumb['width'].'" alt="'. $image_title .'" /></a></li>';

		}
	}
  
	if(trim(isset($imagesHTML))){
		echo '<div class="carousel box-shadow margin-t20 woo-product-thumbs">';
		echo '<ul id="product_thumbnails" class="jcarousel-skin-rt">';
		echo $imagesHTML;
		echo '</ul></div>';
	} 

}

//category thumbnails
function rt_woocommerce_subcategory_thumbnail( $category ) {
	global $woocommerce;

	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image = $image[0];
	} else {
		$image = woocommerce_placeholder_img_src();
	}

	if ( $image )
		echo '<a href="'.get_term_link( $category->slug, 'product_cat' ).'">';
		echo '<img src="' . $image . '" alt="' . $category->name . '" width="' . $dimensions['width'] . '" height="' . $dimensions['height'] . '" />';
		echo "</a>";
}


#-----------------------------------------
#	RT - WOOCOMMERCE Options
#-----------------------------------------
global $woo_product_layout, $woo_layout_names, $woo_column_class_name;


#
# COLUMN LAYOUT
#

$woo_product_layout = get_option(THEMESLUG."_woo_product_layout");
$woo_product_layout = $woo_product_layout ? $woo_product_layout : 3; //default 3 

// woo layouts
$woo_layout_names = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");
$woo_column_class_name = $woo_layout_names[$woo_product_layout];
 
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		global $woo_product_layout;
		return $woo_product_layout;
	}
}
 
// add column value as javascript value to header
add_filter('wp_head', 'rt_woo_column_jquery_var');
if (!function_exists('rt_woo_column_jquery_var')) {
	function rt_woo_column_jquery_var() {
	global $woo_product_layout;
			$output = "\n";
			$output .= '<script type="text/javascript">'."\n";
			$output .= '//<![CDATA['."\n";		 
			$output .= 'var woo_product_layout=\''.$woo_product_layout.'\';'."\n";			 
			$output .= '//]]>'."\n";
			$output .= '</script>'."\n";
			
		echo $output;
	}
}
;

#
# Number of products displayed per page
#
$woo_product_list_pager = get_option(THEMESLUG."_woo_product_list_pager");
if($woo_product_list_pager!="" && is_numeric($woo_product_list_pager) ) add_filter('loop_shop_per_page', create_function('$cols', 'return '.$woo_product_list_pager.';'));


#
# Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
#
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'rt_theme'); ?>">

		<?php
		if($woocommerce->cart->cart_contents_count > 1 )
			echo sprintf(__('%d items', 'rt_theme'), $woocommerce->cart->cart_contents_count);
		else
			echo sprintf(__('%d item', 'rt_theme'), $woocommerce->cart->cart_contents_count);
		?>
		- <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
} 

?>
