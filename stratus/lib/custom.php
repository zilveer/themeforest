<?php
/**
 * General Custom Functions
 *
 * @author     Themovation <themovation@gmail.com>
 * @copyright  2014 Themovation
 * @license    http://themeforest.net/licenses/regular
 * @version    1.0.5
 */

# Helper Functions
# WordPress - Actions & Filters
# Plugins - Actions & Filters
# Option Tree Functions
# Core / Special Functions
# Development Functions - to be removed.


//======================================================================
// Helper Functions
//======================================================================

if ( ! function_exists( 'bittersweet_pagination' ) ) {
	function bittersweet_pagination()
	{
		global $wp_query;
		$total = $wp_query->max_num_pages;

		if (get_option('permalink_structure')) {
			$format = '?paged=%#%';
		}

		$pages = paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => $format,
			'current' => max(1, get_query_var('paged')),
			'total' => $total,
			'type' => 'array',
			'prev_text' => esc_html__('Newer posts &rarr;', 'stratus'),
			'next_text' => esc_html__('&larr; Older posts', 'stratus'),
		));
		if (is_array($pages)) {
			$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
			//echo '<div class="row"><nav class="post-nav"><ul class="pager">';
			foreach ($pages as $page) {
				if (strpos($page, 'Newer posts') !== false) {
					echo "<li class='next'>$page</li>";
				} elseif (strpos($page, 'Older posts') !== false) {
					echo "<li class='previous'>$page</li>";
				}
			}
			//echo '</ul></nav></div>';
		}
	}
}


/*
 * backward compatible with pre-4.1
 * */

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function theme_slug_render_title() {
		?>
		<title><?php wp_title('|', true, 'right'); ?></title>
	<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
endif;


/*
 * If WooCommerce isn’t activated, return false.
 */

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

//-----------------------------------------------------
// return woo page IDs
//-----------------------------------------------------
function themo_return_woo_page_ID(){
    if(is_woocommerce_activated() && is_woocommerce()){
        // Get the shop page ID, so we can get the custom header and sidebar options for Categories, archieve etc.
        if(get_option( 'woocommerce_shop_page_id' )){
            $woo_shop_page_id = get_option( 'woocommerce_shop_page_id' );
        }
        if(is_product()){
            return false;
        }elseif ((is_product_tag() || is_product_category() || is_shop()) && isset($woo_shop_page_id) && $woo_shop_page_id > ""){
            return $woo_shop_page_id;
        }
    }
    return false;
}

//-----------------------------------------------------
// return custom post type args for WP Query
//-----------------------------------------------------
function themo_return_cpt_args($postid='',$key='',$post_type='',$taxonomy=''){

	if($postid=='') {
		$postid=get_the_ID();
	}

	// Meta box option define how data is output
	$posts = get_post_meta($postid, $key . '_posts'); // List of post ID's
	$groups = get_post_meta($postid, $key . '_groups'); // List of Terms
	$order = get_post_meta($postid, $key . '_orderby'); // Order by


	// WP Query args
	$args = array(
		'post_type' => $post_type,
		'post_status' => 'publish',
	);

	// If Posts ID's are specified
	if (isset($posts) && is_array($posts) && !empty($posts)) {
		$args = array_merge($args, array('post__in' => $posts));
	}

	// If Term ID's are specified
	if (isset($groups) && is_array($groups) && !empty($groups)) {

		$termIDs = explode(',', $groups[0]);

		$args = array_merge($args, array('tax_query' => array(

			array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $termIDs,
				'include_children' => true,
				'operator' => 'IN',
			))));
	}

	// If Order By is specified
	if (isset($order) && is_array($order) && !empty($order)) {
		if ($order[0] == 'menu_order') {

			$args = array_merge($args, array('orderby' => 'menu_order'));
			//$args = array_merge($args, array('order' => 'DESC'));
			$args = array_merge($args, array('order' => 'ASC'));
		}
	}

    // No post limit per page, except for themo portfolio which will use the default.
    if (isset($post_type) && $post_type == 'themo_portfolio') {
    }else{
        $args = array_merge($args, array('posts_per_page' => -1));
    }

	return $args;
}

//-----------------------------------------------------
// Check if retina version of an image exists
// Takes attachecment ID
//-----------------------------------------------------
function themo_retina_version_exists($id){
	$post_id = (int) $id;

	if ( !$post = get_post( $post_id ) )
		return false;

	if ( !is_array( $imagedata = wp_get_attachment_metadata( $post->ID ) ) )
		return false;
	$file = get_attached_file( $post->ID );

	if ( !empty($imagedata['sizes']['themo-logo']['file']) && ($thumbfile = str_replace(basename($file), $imagedata['sizes']['themo-logo']['file'], $file)) && file_exists($thumbfile) ) {

		$path_parts = pathinfo($thumbfile);
		$image_find = $path_parts['dirname'].'/'.$path_parts['filename'].'@2x.'.$path_parts['extension'];

		if (file_exists ( $image_find )){
			return true;
		}
	}
	return false;
}

//-----------------------------------------------------
// Return Retina Logo src, heigh, width
// Takes attachecment ID
//-----------------------------------------------------

function themo_return_retina_logo($id){
	if(themo_retina_version_exists($id)){ // If we have a valid retina version, continue.

		$image_attributes  = wp_get_attachment_image_src( $id, 'themo-logo' );

		if(isset($image_attributes) && !empty( $image_attributes ) )
		{
			$logo_src = $image_attributes[0];
			$logo_height = $image_attributes[2];
			$logo_width = $image_attributes[1];;

			// Split up the URL so we can create the retina version.
			$logo_src_scheme = parse_url($logo_src,PHP_URL_SCHEME);
			$logo_src_host = parse_url($logo_src,PHP_URL_HOST);
			$logo_src_path = pathinfo(parse_url($logo_src,PHP_URL_PATH),PATHINFO_DIRNAME);
			$logo_src_filename = pathinfo(parse_url($logo_src,PHP_URL_PATH),PATHINFO_FILENAME);
			$logo_src_extension = pathinfo(parse_url($logo_src,PHP_URL_PATH),PATHINFO_EXTENSION);


			$retina_file_part = '@2x';
			$logo_retina_src = $logo_src_scheme . '://' . $logo_src_host . $logo_src_path . '/' . $logo_src_filename . $retina_file_part . '.' . $logo_src_extension;
			$logo_retina_height = $logo_height * 2;
			$logo_retina_width = $logo_width * 2;

			return array($logo_retina_src, $logo_retina_height, $logo_retina_width);

		}
	}
	return false;
}

//-----------------------------------------------------
// themo_content
//-----------------------------------------------------
function themo_content($content,$return_content=false){
	$content = wp_kses_post($content);
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	if($return_content){
		return $content;
	}else{
		echo $content;
	}
}

//-----------------------------------------------------
// Service Blocks
//-----------------------------------------------------
function themo_print_service_block($show,$postID,$key,$bootstrap_tier,$bootstrap_tier_push)
{
	if ($show == 1) {

		// return custom post type args for WP Query
		$args = themo_return_cpt_args($postID, $key, 'themo_service_block', 'themo_cpt_group');

		// WP Query
		$loop = new WP_Query($args);

		// Open The Loop
		if ($loop->have_posts()) {

			$i = 0;

			// Animation
			$themo_enable_animate = get_post_meta($postID, $key . '_animate', true);
			$themo_animation_style = get_post_meta($postID, $key . '_animate_style', true);

			echo '<section class="split-blocks ' . $bootstrap_tier . $bootstrap_tier_push . '">';
			echo '<div class="service-block">';
			while ($loop->have_posts()) {
				$loop->the_post();

				$metadata = get_post_meta(get_the_ID());

				/* Get Formatted Link */
				list($a_href, $a_href_text, $a_href_close) = themo_return_formatted_link(get_the_ID(), '_');

				// ICONS
				$glyphicon = false;
				$glyphicon_class = "";
				if (isset($metadata['__glyphicons_icon_set'][0])) {
					if ($metadata['__glyphicons_icon_set'][0] > "" && $metadata['__glyphicons_icon_set'][0] != 'none') {
						$glyphicon_class = $metadata['__glyphicons_icon_set'][0] . " " . $metadata['__glyphicons-icon'][0];
						$glyphicon = true;
					}
				}

				echo '<div class="service-block service-block-', $i, themo_return_entrance_animation_class($themo_enable_animate, $themo_animation_style, '#' . $key . ' .service-block-' . $i), '">';

				if ($glyphicon) {
					echo '<div class="med-icon">';
					echo wp_kses_post($a_href) . '<i class="accent ' . sanitize_text_field($glyphicon_class) . '"></i>' . wp_kses_post($a_href_close);
					echo '</div>';
				}
				echo '<div class="service-block-text">';
				if (get_the_title() > '') {
					echo '<h3>', wp_kses_post($a_href) . get_the_title(), wp_kses_post($a_href_close) . '</h3>';
				}
				if (get_the_content() != "") {
					echo themo_content(get_the_content());
				}
				echo '</div>';

				echo '</div>';
				$i++;
			}
			echo '</div>';
			echo '</section><!-- /.contact-blocks -->';

		}
		wp_reset_postdata();
	}
}


//-----------------------------------------------------
// HTML
//-----------------------------------------------------
function themo_print_service_block_HTML($html_show,$postID,$key,$bootstrap_tier,$bootstrap_tier_pull){
	if ($html_show == 1){
		$contact_content = get_post_meta($postID, $key.'_content', true );
		if ( $contact_content > ""){ ?>
			<section class="contact-form <?php echo esc_attr($bootstrap_tier) . esc_attr($bootstrap_tier_pull); ?>">
				<?php themo_content($contact_content)?>
			</section>
		<?php } ?>
	<?php } // end HTML test
}

//-----------------------------------------------------
// do_metabox_shortocdd
// Prints or returns shortcode output from metabox
// @postid - the ID of the post or can be an array
// @key - meta part key
// @return_shortocde = return or print
//-----------------------------------------------------
function themo_do_metabox_shortcode($shortcode='',$return_shortcode=false,$themo_enable_animate=false,$themo_animation_style=false,$show_tooltip=false,$tooltip=false){

	$shortcode = sanitize_text_field($shortcode);
	$brackets = array("[","]");
	$shortcode_text = str_replace($brackets,"", $shortcode);
	$shortcode_name = strtok($shortcode_text,  ' ');
	$output = "";

	switch ($shortcode_name) {
		case 'formidable':
			$output .= '<div class="simple-conversion' . themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#main-flex-slider .simple-conversion') . '">';
			$output .= do_shortcode( $shortcode );
			$output .= '</div>';
			break;
		case 'booked-calendar':


			$output .= '<div class="booked-cal-sm' . themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'.booked-cal-sm') . '">';
			if($show_tooltip){
				$output .= '<div class="cal-tooltip">';
				$output .= '<h3>'.esc_attr($tooltip).'</h3>';
				$output .= '</div>';
			}
			$output .= do_shortcode( $shortcode );
			$output .= '</div>';
			break;
		default:
			$output .= '<div>';
			$output .= do_shortcode( $shortcode );
			$output .= '</div>';
	}


	if($return_shortcode){
		return $output;
	}else{
		echo $output;
	}

}

//-----------------------------------------------------
// themo_do_glyphicons_markup
// Prints or returns a glyphicons markup
// @postid - the ID of the post or can be an array
// @key - meta part key
// @return_shortocde = return or print
//-----------------------------------------------------

function themo_do_glyphicons_markup($metadata='',$postid='',$key='',$return_shortcode=false,$extra_classes=''){

	$glyphicons_icon_set = "";
	$glyphicons_icon = "";
	$glyphicon_class = "";
	$glyphicon_markup = "";


	if($postid=='') {
		$postid=get_the_ID();
	}

	if(!empty($metadata)){
		if (isset($metadata['__glyphicons_icon_set'][0])) {
			if ($metadata['__glyphicons_icon_set'][0] > "" && $metadata['__glyphicons_icon_set'][0] != 'none') {
				$glyphicon_class = $metadata['__glyphicons_icon_set'][0] . " " . $metadata['__glyphicons-icon'][0];
				$glyphicon_markup = '<i class="' . sanitize_text_field($glyphicon_class) . '"></i>';
			}
		}
	}else{
        if (isset($postid) && isset($key)) {
            $glyphicon_set = get_post_meta($postid, $key . '_glyphicons_icon_set', true);
            $glyphicon_icon = get_post_meta($postid, $key . '_glyphicons-icon', true);
            if (isset($glyphicon_set) && isset($glyphicon_icon) && $glyphicon_set > "" && $glyphicon_set != 'none' && $glyphicon_icon > "") {
                $glyphicon_class = $glyphicon_set . " " .$glyphicon_icon;
                $glyphicon_markup = '<i class="header-icon ' . sanitize_text_field($glyphicon_class) . '"></i>';
            }
        }
    }



	if($glyphicon_markup > ""){
		if($return_shortcode){
			return wp_kses_post($glyphicon_markup);
		}else{
			echo wp_kses_post($glyphicon_markup);
		}
	}else{
		return false;
	}
}


//-----------------------------------------------------
// themo_do_shortocde_button
// Prints or returns a button shortcode
// @postid - the ID of the post or can be an array
// @key - meta part key
// @return_shortocde = return or print
//-----------------------------------------------------
function themo_do_shortocde_button($postid='',$key='',$return_shortcode=false, $extra_classes='',$serial=false){

    if(isset($serial) && $serial > ""){
        $serial = '_'.$serial;
    }else{
        $serial = false;
    }

	$show_button = "";
	$button_text = "";
	$button_link = "";
	$button_style = "";
	$button_link_target = "";
    $button_img_ID = "";
    $productID = "";
    $product_sku = "";

	if($postid=='') {
		$postid=get_the_ID();
	}

	if(is_array($postid)){
		if(isset($postid[$key.'_show_button'.$serial])){$show_button = $postid[$key.'_show_button'.$serial];}
		if(isset($postid[$key.'_button_text'.$serial])){$button_text = $postid[$key.'_button_text'.$serial];}
		if(isset($postid[$key.'_button_link'.$serial])){$button_link = $postid[$key.'_button_link'.$serial];}
		if(isset($postid[$key.'_button_style'.$serial])){$button_style = $postid[$key.'_button_style'.$serial];}
		if(isset($postid[$key.'_button_link_target'.$serial])){$button_link_target = $postid[$key.'_button_link_target'.$serial];}
        if(isset($postid[$key.'_button_img_ID'.$serial])){$button_img_ID = $postid[$key.'_button_img_ID'.$serial];}
        if(isset($postid[$key.'_productID'.$serial])){$productID = $postid[$key.'_productID'.$serial];}
        if(isset($postid[$key.'_product_sku'.$serial])){$product_sku = $postid[$key.'_product_sku'.$serial];}
	}else{
		$show_button = get_post_meta($postid, $key.'_show_button'.$serial, true );
		$button_text = get_post_meta($postid, $key.'_button_text'.$serial, true );
		$button_link = get_post_meta($postid, $key.'_button_link'.$serial, true );
		$button_style = get_post_meta($postid, $key.'_button_style'.$serial, true );
		$button_link_target = get_post_meta($postid, $key.'_button_link_target'.$serial, true );
        $button_img_ID = get_post_meta($postid, $key.'_button_img_ID'.$serial, true );
        $productID = get_post_meta($postid, $key.'_productID'.$serial, true );
        $product_sku = get_post_meta($postid, $key.'_product_sku'.$serial, true );
	}

	if(isset($button_link_target) && is_array($button_link_target)){
		if($button_link_target[0] > ""){
			$button_link_target = $button_link_target[0];
		}
	}
	if($show_button == 1){
        if(isset($product_sku) && $product_sku > '') { // If using product Sku
            $output = "[add_to_cart sku='" . $product_sku . "' class='th-btn a2c-btn a2c-".$button_style."' show_price='false' style='']";
        }elseif(isset($productID) && $productID != 0){ // if using product ID
            $output = "[add_to_cart id=".$productID." class='th-btn a2c-btn a2c-".$button_style."' show_price='false' style='']";
        }elseif(isset($button_img_ID) && $button_img_ID != 0){ // if using product image.
            $img_src = themo_return_metabox_image($button_img_ID, null, "themo_brands", true, $alt);
            $output = '<a href='.esc_url($button_link).' target="'.$button_link_target.'" title="'.$button_text.'" class="th-btn btn-image">';
            $output .= '<img src="'. esc_url($img_src). '" alt="'. esc_attr($alt).'">';
            $output .= '</a>';
        }else{
            $output = '[button text="'.$button_text.'" url="'.$button_link.'"  type="'.$button_style.'" target="'.$button_link_target.'" extra_classes="th-btn '.$extra_classes.'"]';
        }

        // Return or run shortcode.
        if($return_shortcode){
            return $output;
        }else{
            echo do_shortcode($output);
        }

	}else{
		return false;
	}
}

//-----------------------------------------------------
// themo_return_formatted_link (open and close tags in array)
// returns a formatted link
// @postid - the ID of the post or can be an array
// @key - meta part key
// @return_shortocde = return or print
// @extra_classes = extra classes
//-----------------------------------------------------
function themo_return_formatted_link($postid='',$key=''){

	$show_link = "";
	$link = "";
	$link_target = "";
	$link_text = "";

	if(is_array($postid)){
		if(isset($postid[$key.'_show_link'])){$show_link = $postid[$key.'_show_link'];}
		if(isset($postid[$key.'_link'])){$link = $postid[$key.'_link'];}
		if(isset($postid[$key.'_link_target'])){$link_target = $postid[$key.'_link_target'];}
		if(isset($postid[$key.'_link_text'])){$link_text = $postid[$key.'_link_text'];}
	}else{
		$show_link = get_post_meta($postid, $key.'_show_link', true );
		$link = esc_url(get_post_meta($postid, $key.'_link', true ));
		$link_target = get_post_meta($postid, $key.'_link_target', true );
		$link_text = get_post_meta($postid, $key.'_link_text', true );
	}

	if(isset($link_target) && is_array($link_target)){
		if($link_target[0] > ""){
			$link_target = $link_target[0];
		}
	}

	$target_attr = "";
	if ($link_target > ""){
		$target_attr = "target='".$link_target."'";
	}

	$title_attr = "";
	if ($link_text > ""){
		$title_attr = "title='".$link_text."'";
	}

	if($show_link == 1){
		$a_href = "<a href='$link' $target_attr $title_attr>";
		$a_href_text = $link_text;
		$a_href_close = "</a>";
		return array($a_href,$a_href_text,$a_href_close);
	}else{
		return array("","","");
	}
}

//-----------------------------------------------------
// themo_return_attachment_id_from_url
// returns an image via attachmentID
// @attachment_id - WordPress Media Library POST ID
// @classes - any classes to be inserted into tag if using tag mode
// @image_size - specify image size already created by add_image_size()
// @return_src - if you want to return the src only vs the img tag.
//-----------------------------------------------------

function themo_return_attachment_id_from_url( $attachment_url = '' ) {

	// Sanitization
	$attachment_url = esc_url($attachment_url);

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

//-----------------------------------------------------
// returns an image via attachmentID
// @attachment_id - WordPress Media Library POST ID
// @classes - any classes to be inserted into tag if using tag mode
// @image_size - specify image size already created by add_image_size()
// @return_src - if you want to return the src only vs the img tag.
//-----------------------------------------------------
function themo_return_metabox_image($attachment_id = 0, $classes = null, $image_size = 'themo_full_width', $return_src = false, &$alt=""){
	if(!$attachment_id > "" ){
		return false;
	}

	if(!is_numeric($attachment_id)){ // We might be dealing with an URL vs ID, look up URL and get ID.
		$attachment_url = $attachment_id; // put URL in a local var
		$attachment_id = themo_return_attachment_id_from_url($attachment_url); // Search DB for URL and return ID.
	}

	if(!$attachment_id > "" ){
		return false;
	}

	$attachment_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

	if( ! empty( $attachment_alt ) && is_array($attachment_alt)) {
		$alt = trim(strip_tags($attachment_alt[0]));
	}else{
        $alt = $attachment_alt;
    }

	$image_attr = array(
		'class'	=> $classes,
		'alt'   => $alt
	);
	if ($return_src){
		$image_attributes = wp_get_attachment_image_src( $attachment_id, $image_size) ;
		if( $image_attributes ) {
			return $image_attributes[0];
		}else{
			return false;
		}

	}else{
		return wp_get_attachment_image( $attachment_id, $image_size, 0, $image_attr ) ;
	}

}

//-----------------------------------------------------
// themo_return_sorted_array_by_array
// Takes two arrays, sorts second by first
// ignoring any additional keys in array1
// @sort_order = the desired sort order
// @needs_sort_order = the desired sort order
//-----------------------------------------------------
function themo_return_sorted_array_by_array($sort_order,$needs_sort_order) {

	// Remove any extra keys in $sort_order
	$sort_order_match = array_intersect($sort_order, $needs_sort_order);

	// Merge both arrays, keeping order of $sort_order
	$sort_order_merged = array_merge($sort_order_match, $needs_sort_order);

	// Remove Duplicates
	$sort_order_final = array_unique($sort_order_merged);

	return $sort_order_final;
}


//-----------------------------------------------------
// themo_return_meta_box_number
// Returns a meta box number if greater than 2
// @quantity = the current quantity
//-----------------------------------------------------
function themo_return_meta_box_number($quantity) {

	// There can be multiple meta boxes of the same type. Number them if there are more than one.
	if($quantity>1){
		$title_count = ' '.$quantity;
	}else{
		$title_count = '';
	}

	return $title_count;
}


//-----------------------------------------------------
// themo_metabox_not_sortable
// Disable meta box sorting for specific meta boxes
//-----------------------------------------------------

function themo_metabox_not_sortable($classes) {
	$classes[] = 'not-sortable';
	return $classes;
}

add_action('admin_print_footer_scripts','themo_admin_print_footer_scripts',99);
function themo_admin_print_footer_scripts()
{
	?><script type="text/javascript">/* <![CDATA[ */
	jQuery(function($)
	{
		"use strict";
		if($(".meta-box-sortables").length){
			$(".meta-box-sortables")
				// define the cancel option of sortable to ignore sortable element
				// for boxes with '.not-sortable' css class
				.sortable('option', 'cancel', '.not-sortable .hndle, :input, button')
				// and then refresh the instance
				.sortable('refresh');
		}
	});
	/* ]]> */</script><?php
}

//-----------------------------------------------------
// themo_return_header_sidebar_settings
// Gets header and sidebar settings based on type page
//-----------------------------------------------------

function themo_return_header_sidebar_settings($post_type = false) {
    if (is_woocommerce_activated() && is_woocommerce()) { // Handle all Woo stuff...
        $key = 'themo_woo';
        $show_header = ot_get_option( $key.'_show_header', "on" );
        $page_header_float = ot_get_option( $key.'_header_float', "centered" );
        return array ($key, $show_header, $page_header_float,false);
	}elseif($post_type > ""){
        $key = $post_type."_layout";
        $show_header = ot_get_option( $key.'_show_header', "on" );
        $page_header_float = ot_get_option( $key.'_header_float', "centered" );
        $masonry = ot_get_option( $key.'_masonry', "off" );
        return array ($key, $show_header, $page_header_float,$masonry);
    }elseif (is_home()) {
		$key = 'themo_blog_index_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		$masonry = ot_get_option( $key.'_masonry', "off" );
		return array ($key, $show_header, $page_header_float,$masonry);
	}elseif (is_single()) {
		$key = 'themo_single_post_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		return array ($key, $show_header, $page_header_float,false);
	} elseif (is_archive()) {
		$key = 'themo_default_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		return array ($key, $show_header, $page_header_float,false);
	} elseif (is_search()) {
		$key = 'themo_default_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		return array ($key, $show_header, $page_header_float,false);
	} elseif (is_404()) {
		$key = 'themo_default_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		return array ($key, $show_header, $page_header_float,false);
	} else {
		$key = 'themo_default_layout';
		$show_header = ot_get_option( $key.'_show_header', "on" );
		$page_header_float = ot_get_option( $key.'_header_float', "centered" );
		return array ($key, $show_header, $page_header_float,false);
	}
}

//-----------------------------------------------------
// themo_in_array_r
// Since in_array() does not work on multidimensional arrays,
// we need a recursive function to do that
//-----------------------------------------------------
function themo_in_array_r($needle, $haystack, $strict = false) {
	foreach ($haystack as $item) {
		if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && themo_in_array_r($needle, $item, $strict))) {
			return true;
		}
	}

	return false;
}

//-----------------------------------------------------
// themo_return_animation_class
// builds global array for jquery animation output
// @themo_enable_animate = on / off
// @themo_animation_style = slideUp, slideDown etc..
// @target_element = any css element, id or class or both.
// Returns 'hide-animation' class
// Also, builds $themo_animation array, to be output before body tag
//-----------------------------------------------------
function themo_return_animation_class($themo_enable_animate = 0,$themo_animation_style){
	if($themo_enable_animate == 1){
		return $themo_animation_style;
	}else{
		return false;
	}
}


//-----------------------------------------------------
// themo_return_entrance_animation_class
// builds global array for jquery animation output
// @themo_enable_animate = on / off
// @themo_animation_style = slideUp, slideDown etc..
// @target_element = any css element, id or class or both.
// Returns 'hide-animation' class
// Also, builds $themo_animation array, to be output before body tag
//-----------------------------------------------------
function themo_return_entrance_animation_class($themo_enable_animate = 0,$themo_animation_style,$target_element,$delay=100){
	if($themo_enable_animate == 1){

		global $themo_animation, $themo_animation_count;

		if (!is_array($themo_animation)){
			$themo_animation = array();
		}

		if (!themo_in_array_r($target_element, $themo_animation)) {
			$themo_animation[$themo_animation_count]['target_element'] = $target_element;
			$themo_animation[$themo_animation_count]['animation_style'] = $themo_animation_style;
			$themo_animation[$themo_animation_count]['delay'] = $delay;
			$themo_animation_count++;
		}

		return ' hide-animation';
	}else{
		return false;
	}
}

//-----------------------------------------------------
// themo_build_animation_array
// builds jquery animation for output
//-----------------------------------------------------
function themo_print_animation_js(){
	global $themo_animation;

// Output Animation jquery
	if (isset($themo_animation) && !empty($themo_animation)){

		$i = 1;
		$delay_default_setting = 100; // Increment in milliseconds
		$time_to_delay = 0; // The amount to delay in milliseconds
		$last_loop_target_element = "";
		$animate_scrolled_into_view = "";
		$last_target_ID = "";
		foreach( $themo_animation as $animation ) {

			// Get the target ID
			$target_arr = explode(' ',trim($animation['target_element']));
			$delay = $animation['delay'];
			if($delay > ""){
				$delay_setting = $delay;
			}else{
				$delay_setting = $delay_default_setting;
			}
			$current_target_ID = $target_arr[0];

			// Do we want a delay? If the last item had the same ID, then yes!
			if($current_target_ID === $last_target_ID){
				$time_to_delay = $time_to_delay + $delay_setting;
			}else{
				$time_to_delay = 0;
			}
			// Save current ID for next loop
			$last_target_ID = $target_arr[0];

			$animate_scrolled_into_view .= "themo_animate_scrolled_into_view(jQuery('".sanitize_text_field($animation['target_element'])."'),'".sanitize_text_field($animation['animation_style'])."','".sanitize_text_field($time_to_delay)."'); \n";

			$i++;
		} // end loop
		?>
		<script>

			jQuery(window).load(function() {

				var isTouchAnimation = themo_is_touch_device(false);

				if(!isTouchAnimation){

					<?php echo $animate_scrolled_into_view ; ?>

					var scrollTimeout;  // global for any pending scrollTimeout

					jQuery(window).scroll(function() {
						if (scrollTimeout) {
							// clear the timeout, if one is pending
							clearTimeout(scrollTimeout);
							scrollTimeout = null;
						}
						scrollTimeout = setTimeout(scrollHandler, 0);
					});

					scrollHandler = function () {
						if(!themo_is_touch_device(false)){ // Disable for Mobile
							<?php echo $animate_scrolled_into_view ; ?>
						}
					};
				};

			});
		</script>
	<?php } // END IF THEN
}

//-----------------------------------------------------
// themo_is_element_empty
// returns true / falase
//-----------------------------------------------------
function themo_is_element_empty($element) {
	$element = trim($element);
	return empty($element) ? false : true;
}

//-----------------------------------------------------
// themo_string_contains
// IF String contains any items in an array (case insensitive).
//-----------------------------------------------------
function themo_string_contains($str, array $arr)
{
	foreach($arr as $a) {
		if (stripos($str,$a) !== false) return true;
	}
	return false;
}

//-----------------------------------------------------
// themo_RandNumber
// Return a random number
//-----------------------------------------------------
function themo_RandNumber($e){
	$rand = 0;
	for($i=0;$i<$e;$i++){
		$rand =  $rand .  rand(0, 9);
	}
	return $rand;
}

//-----------------------------------------------------
// Generate random string
// @return string
//-----------------------------------------------------
function themo_randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;

	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}

	return $str;
}

//-----------------------------------------------------
// Get Attachment ID from URL
// Use the following code to get the image you want, Please note that your image
// will have to be uploaded through WordPress in order for this to work.
// Adapt code as needed:
//-----------------------------------------------------

function themo_custom_get_attachment_id( $guid ) {
	// Prepare & Sanitization
	$guid = esc_url($guid);

	global $wpdb;

	/* nothing to find return false */
	if ( ! $guid )
		return false;

	/* get the ID */
	$id = $wpdb->get_var( $wpdb->prepare("SELECT p.ID FROM $wpdb->posts p WHERE p.guid = %s AND p.post_type = %s", $guid, 'attachment'));

	/* the ID was not found, try getting it the expensive WordPress way */
	if ( $id == 0 )
		$id = url_to_postid( $guid );

	return $id;
}


//-----------------------------------------------------
// Create retina-ready images
// Referenced via retina_support_attachment_meta().
//-----------------------------------------------------

function themo_retina_support_create_images( $file, $width, $height, $crop = false ) {
	if ( $width || $height ) {
		$resized_file = wp_get_image_editor( $file );
		if ( ! is_wp_error( $resized_file ) ) {
			$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

			$resized_file->resize( $width * 2, $height * 2, $crop );
			$resized_file->save( $filename );

			$info = $resized_file->get_size();

			return array(
				'file' => wp_basename( $filename ),
				'width' => $info['width'],
				'height' => $info['height'],
			);
		}
	}
	return false;
}

//-----------------------------------------------------
// themo_sort_meta_array
// Accepts an array, filters for the _order string,
// sorts ascending and returns it.
//-----------------------------------------------------

function themo_sort_meta_array($meta_array,$check_show_toggle = true) {

    if (!is_array($meta_array)){
        $meta_array = array();
    }

    $meta_key_array = array(); // Create Array for Sorting
	$content_order_key = 'themo_content_editor_1_order'; // Define Meta Key for content editor
	$content_order_show = 'themo_content_editor_1_sortorder_show'; // Define Meta Show Key for content editor

	$themo_page_layout_content_order = 0; // Default to 0 for first place

	if (array_key_exists($content_order_show, $meta_array)) { // Search array and find value of Content Editor Show Key
		if (array_key_exists($content_order_key, $meta_array) && $meta_array[$content_order_show][0] == 1) { // Search array and find value of Content Editor Order Key
			if($meta_array[$content_order_key][0] > ""){
				$themo_page_layout_content_order = $meta_array[$content_order_key][0];
			}
		}
	}
	$meta_key_array['themo_content_editor_1'] =  $themo_page_layout_content_order; // Add the order value to the sort order array.

	foreach ( $meta_array as $key => $value ) { // Loop through custom_field_keys

		$valuet = array_map('trim',$value);
		if ( '_' == $valuet{0} )
			continue;


		$pos_show = strpos($key, '_sortorder_show'); // Get position of '_order' in each key.

		if($check_show_toggle && $value[0] != 1){

			$show_toggle_pass = false;
		}else{

			$show_toggle_pass = true;
		}


		if($pos_show > 0 && $show_toggle_pass){ // The Meta Box Show Switch is in an ON state, so continue.

			$meta_key = substr($key, 0, $pos_show);    // Return the Meta Key without '_sortorder_show'.
			$sort_order_key = $meta_key . '_order'; // Lets see if there is a sort order value.

			if (array_key_exists($sort_order_key, $meta_array)) { // If a sort order value is set, use it.
				$sort_order = $meta_array[$sort_order_key][0];
			}else{
				$sort_order = 1; // else default to 1.
			}

			if ($meta_key > ""){ // only store keys that exist.
				$meta_key_array[$meta_key] =  $sort_order; // Put Meta Key and Order value in an array so we can sort ascending.
			}

		}

	}
	asort($meta_key_array); // sorted ascending array

	return $meta_key_array; // return the sorted array
}


//-----------------------------------------------------
// themo_is_last
// Return true if last in array
//-----------------------------------------------------
function themo_is_last($array, $key) {
	end($array);
	return $key === key($array);
}

//-----------------------------------------------------
// themo_is_first
// Return true if first in array
//-----------------------------------------------------
function themo_is_first($array, $key) {
	reset($array);
	return $key === key($array);
}

//-----------------------------------------------------
// themo_return_on_off_boolean
// return false if OFF, else true. Used for Flex Slider Settings
//-----------------------------------------------------
function themo_return_on_off_boolean($ot_setting){
	if ($ot_setting === 'off'){
		return 'false';
	}elseif($ot_setting === 'on'){
		return 'true';
	}
	return $ot_setting;
}

//-----------------------------------------------------
// themo_getArrCount
// Return Number of Item in Array (multidimensional)
//-----------------------------------------------------
function themo_getArrCount ($array, $limit) {
	$count = 0;
	foreach ($array as $id => $_array) {
		if (is_array ($_array) && $limit > 0) {
			$count += themo_getArrCount($_array, $limit - 1);
		} else {
			$count += 1;
		}
	}
	return $count;
}

//-----------------------------------------------------
// themo_return_outer_tag
// Returns output if $bool is true
//-----------------------------------------------------
function themo_return_outer_tag($output,$bool){
	if($bool){
		return $output;
	}
}

//-----------------------------------------------------
// themo_return_inner_tag
// Returns output if $bool is false
//-----------------------------------------------------
function themo_return_inner_tag($output,$bool){
	if(!$bool){
		return $output;
	}
}

//-----------------------------------------------------
// themo_has_sidebar
// Returns a boolean value if the page has a sidebar
// Takes pagelayout (full, right, left)
// Returns true there is a sidebar (left or right), false if anything else.
//-----------------------------------------------------
function themo_has_sidebar($pagelayout){
	if($pagelayout == 'right' ||  $pagelayout == 'left'){
		return true;
	}else{
		return false;
	}
}

//-----------------------------------------------------
// themo_themo_get_meta_box_background
// Return background styling
// @$background_show = on / off
// @background_image = image URL
// @background_color = hex value
//-----------------------------------------------------
function themo_get_meta_box_background($background_show=0,$background_image=false,$background_color=false){
	if($background_show == 1){
		return "striped-light";
	}else{
		return "";
	}
}

//-----------------------------------------------------
// themo_convertNumber
// English Number Converter - Collection of PHP functions
// to convert a number into English text.
//-----------------------------------------------------

function themo_convertNumber($number)
{
	$integer = $number;
	$fraction = '';

	$output = "";

	if ($integer{0} == "-")
	{
		$output = "negative ";
		$integer    = ltrim($integer, "-");
	}
	else if ($integer{0} == "+")
	{
		$output = "positive ";
		$integer    = ltrim($integer, "+");
	}

	if ($integer{0} == "0")
	{
		$output .= "zero";
	}
	else
	{
		$integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
		$group   = rtrim(chunk_split($integer, 3, " "), " ");
		$groups  = explode(" ", $group);

		$groups2 = array();
		foreach ($groups as $g)
		{
			$groups2[] = themo_convertThreeDigit($g{0}, $g{1}, $g{2});
		}

		for ($z = 0; $z < count($groups2); $z++)
		{
			if ($groups2[$z] != "")
			{
				$output .= $groups2[$z] . themo_convertGroup(11 - $z) . (
					$z < 11
					&& !array_search('', array_slice($groups2, $z + 1, -1))
					&& $groups2[11] != ''
					&& $groups[11]{0} == '0'
						? " and "
						: ", "
					);
			}
		}

		$output = rtrim($output, ", ");
	}

	if ($fraction > 0)
	{
		$output .= " point";
		for ($i = 0; $i < strlen($fraction); $i++)
		{
			$output .= " " . themo_convertDigit($fraction{$i});
		}
	}

	return $output;
}

function themo_convertGroup($index)
{
	switch ($index)
	{
		case 11:
			return "decillion";
		case 10:
			return "nonillion";
		case 9:
			return "octillion";
		case 8:
			return "septillion";
		case 7:
			return "sextillion";
		case 6:
			return "quintrillion";
		case 5:
			return "quadrillion";
		case 4:
			return "trillion";
		case 3:
			return "billion";
		case 2:
			return "million";
		case 1:
			return "thousand";
		case 0:
			return "";
	}
}

function themo_convertThreeDigit($digit1, $digit2, $digit3)
{
	$buffer = "";

	if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
	{
		return "";
	}

	if ($digit1 != "0")
	{
		$buffer .= themo_convertDigit($digit1) . "hundred";
		if ($digit2 != "0" || $digit3 != "0")
		{
			$buffer .= "and";
		}
	}

	if ($digit2 != "0")
	{
		$buffer .= themo_convertTwoDigit($digit2, $digit3);
	}
	else if ($digit3 != "0")
	{
		$buffer .= themo_convertDigit($digit3);
	}

	return $buffer;
}

function themo_convertTwoDigit($digit1, $digit2)
{
	if ($digit2 == "0")
	{
		switch ($digit1)
		{
			case "1":
				return "ten";
			case "2":
				return "twenty";
			case "3":
				return "thirty";
			case "4":
				return "forty";
			case "5":
				return "fifty";
			case "6":
				return "sixty";
			case "7":
				return "seventy";
			case "8":
				return "eighty";
			case "9":
				return "ninety";
		}
	} else if ($digit1 == "1")
	{
		switch ($digit2)
		{
			case "1":
				return "eleven";
			case "2":
				return "twelve";
			case "3":
				return "thirteen";
			case "4":
				return "fourteen";
			case "5":
				return "fifteen";
			case "6":
				return "sixteen";
			case "7":
				return "seventeen";
			case "8":
				return "eighteen";
			case "9":
				return "nineteen";
		}
	} else
	{
		$temp = themo_convertDigit($digit2);
		switch ($digit1)
		{
			case "2":
				return "twenty-$temp";
			case "3":
				return "thirty-$temp";
			case "4":
				return "forty-$temp";
			case "5":
				return "fifty-$temp";
			case "6":
				return "sixty-$temp";
			case "7":
				return "seventy-$temp";
			case "8":
				return "eighty-$temp";
			case "9":
				return "ninety-$temp";
		}
	}
}

function themo_convertDigit($digit)
{
	switch ($digit)
	{
		case "0":
			return "zero";
		case "1":
			return "one";
		case "2":
			return "two";
		case "3":
			return "three";
		case "4":
			return "four";
		case "5":
			return "five";
		case "6":
			return "six";
		case "7":
			return "seven";
		case "8":
			return "eight";
		case "9":
			return "nine";
	}
}


//-----------------------------------------------------
// themo_nl2li
// A handy function to convert new line \n seprated text into ordered or unordered list.
// Second optional parameter sets the list as ordered (1) or unordered (0 = default).
// Third parameter can be used to specify type of ordered list, valid inputs are "1" = default ,"a","A","i","I".
//-----------------------------------------------------
function themo_nl2li($str,$ordered = 0, $type = "1", $class = 'features') {
	//check if its ordered or unordered list, set tag accordingly
	if ($ordered)
	{
		$tag="ol";
		//specify the type
		$tag_type="type=$type";
	}
	else
	{
		$tag="ul";
		//set $type as NULL
		$tag_type=NULL;
	}

	// add ul / ol tag
	// add tag type
	// add first list item starting tag
	// add last list item ending tag
	$str = "<$tag $tag_type class='$class'><li>" . $str ."</li></$tag>";

	//replace /n with adding two tags
	// add previous list item ending tag
	// add next list item starting tag
	//$order   = array("\r\n", "\n", "\r");
	$str = str_replace("\n","</li>\n<li>",$str);

	//spit back the modified string
	return $str;
}

//-----------------------------------------------------
// themo_return_meta_box_borders
// @border_show = on / off
// @border_display = both, top, bottom - Meta Box Option
// @template_position = top, bottom
//-----------------------------------------------------

function themo_return_meta_box_borders($border_show=0,$border_display=false,$template_position=false,$border_full_width=0){

	if($border_full_width==1){
		$border_class = 'meta-border';
	}else{
		$border_class = 'meta-border content-width';
	}
	$markup = '<div class="'.$border_class.'"></div>';
	$output = false;

	if($border_show == 1){
		if($border_display == 'both'){
			$output = $markup;
		}elseif($border_display == $template_position){
			$output = $markup;
		}
	}
	return $output;
}

//-----------------------------------------------------
// themo_return_meta_box_background_markup
// Return background styling and html markup for
// backround effects, includes parallax
// @$background_show = on / off
// @background_settings_array = array of settings
// @return (by reference) - $background_css, $parallax_tag_open, $parallax_tag_close
// @key - section ID
//-----------------------------------------------------

function themo_return_meta_box_background_markup($background_show=0,$background=false,$background_parallax_show=0,
												 &$parallax_classes="",&$parallax_data="", &$background_css="", &$background_js="",
												 $key,$text_contrast=false){

	// If light BG / .light-text
	if($background_show == 1){ // Is background enabled?

		if(is_array($background) ){ // Are settings in an array?

			if($text_contrast == 'light'){ // Add Text White Class
				$parallax_classes .= " light-text";
			}

			// PARALLAX
			if($background_parallax_show == 1 && isset($background['background-image']) && $background['background-image'] > ""){ // Is Parallax on and is there an image saved?
				//Parallax Class to output inside <section>
				$parallax_data = 'data-stellar-background-ratio="0.15" data-stellar-vertical-offset="145"';

				// Preloading scripts
				$parallax_classes .= " parallax-preload parallax-bg";
			}
			// Return b/g image. If it's full width use backstretch for mobile / touch screens.
			list($background_settings, $is_full_width,$background_image_filtered) = themo_custom_background($background,'',false);

			if ($is_full_width && $background_image_filtered > ""){
				$background_js = '$("section#'.$key.'").backstretch("'.$background_image_filtered.'");';
				$background_css = "section#". $key . "{".$background_settings."} ";
				if ($background_parallax_show !== 1){
					// Default full width / stretch background, only if parallax is not enabled.
					$parallax_classes .= " full-header-img";
				}
			}else{
				$background_css = "section#". $key . "{".$background_settings."} ";
			}

		}
	}
	return false;
}

//-----------------------------------------------------
// themo_return_meta_box_padding_markup
// Return padding styling and html markup
// @padding_show = on / off
// @top_padding & @bottom_padding
// @return (by reference) - $padding_css
// @key - section ID
//-----------------------------------------------------

function themo_return_meta_box_padding_markup($padding_show=0,$top_padding,$bottom_padding,
											  &$padding_css="",$key){

	if($padding_show == 1){ // Is padding enabled?
		$padding_css = "section#". $key . "{padding-top:".$top_padding."px; padding-bottom:".$bottom_padding."px} ";

	}
	return false;
}

//-----------------------------------------------------
// themo_return_social_icons
// Return background styling and html markup for
// Social Media Icons
//-----------------------------------------------------

function themo_return_social_icons() {
	$output = "";
	if ( function_exists( 'ot_get_option' ) ) {
		/* get the slider array */
		$social_icons = ot_get_option( 'themo_social_media_accounts', array() );
		//print_r($social_icons);
		if ( ! empty( $social_icons ) ) {
			foreach( $social_icons as $social_icon ) {
				if (isset($social_icon["themo_social_url"]) && $social_icon["themo_social_url"] >""){
				$output .= "<a target='_blank' href='".$social_icon["themo_social_url"]."'><i class='soc-icon social ".$social_icon["themo_social_font_icon"]."'></i></a>";
                }else{
                    $output .= "<i class='soc-icon social ".$social_icon["themo_social_font_icon"]."'></i>";
                }

			}
		}
	}
	return $output;
}

//-----------------------------------------------------
// themo_return_payments_accepted
// Return background styling and html markup for
// Payments Accepted
//-----------------------------------------------------

function themo_return_payments_accepted() {
	$output = "";
	if ( function_exists( 'ot_get_option' ) ) {
		/* get the slider array */
		$payments_accepted = ot_get_option( 'themo_payments_accepted', array() );
		//print_r($social_icons);
		if ( ! empty( $payments_accepted ) ) {
			foreach( $payments_accepted as $payment_info ) {

				// Image
				$payment_logo_src = false;
				$payment_logo_width = false;
				$payment_logo_height = false;
				$payment_logo = $payment_info["themo_payments_accepted_logo"];
				if(isset($payment_logo) && $payment_logo > ""){
					$img_id = themo_custom_get_attachment_id( $payment_logo );
					if($img_id > ""){
						$image_attributes = wp_get_attachment_image_src( $img_id, 'themo_mini_brands');
						if( $image_attributes ) {
							$payment_logo_src = $image_attributes[0];
							$payment_logo_width = $image_attributes[1];
							$payment_logo_height = $image_attributes[2];
							if(isset($payment_logo_width) && $payment_logo_width > ""){
								$payment_logo_width = "width='".esc_attr($payment_logo_width)."'";
							}
							if(isset($payment_logo_height) && $payment_logo_height > ""){
								$payment_logo_height = "height='".esc_attr($payment_logo_height)."'";
							}
						}
					}
				}

				// Link Target
                if (isset($payment_info["themo_payment_url_target"])) {
                    $link_target = $payment_info["themo_payment_url_target"];
                }

				$link_target_att = false;
				if (isset($link_target) && is_array($link_target)  && !empty($link_target)) {
					$link_target = $link_target[0];
					if($link_target == '_blank'){
						$link_target_att = "target='_blank'";
					}
				}

				// Link
				$href_open = false;
				$href_close = false;
				$payment_link = $payment_info["themo_payment_url"];
				if(isset($payment_link) && $payment_link > ""){
					$href_open = "<a ".$link_target_att." href='".esc_url($payment_link)."'>";
					$href_close = '</a>';
				}
				if(isset($payment_logo_src) && $payment_logo_src > ""){
					$output .= $href_open . "<img src='".esc_url($payment_logo_src)."' alt='".esc_attr($payment_info["title"])."' " .$payment_logo_width ." ". $payment_logo_height. ">" . $href_close;
				}
			}
		}
	}
	return $output;
}



//-----------------------------------------------------
// themo_return_contact_info
// Return background styling and html markup for
// Contact Info Widget
//-----------------------------------------------------
function themo_return_contact_info(){
	$output = "";

		if ( function_exists( 'ot_get_option' ) ) {
			// Get icon block array from OT
			$icon_block = ot_get_option( 'themo_contact_icons', array() );

			if (isset($icon_block) && is_array($icon_block)  && !empty($icon_block)) {

				$output .= "<div class='icon-blocks'>";

				foreach( $icon_block as $icon ) {
					$glyphicon_type = $substring = substr($icon["themo_contact_icon"], 0, strpos($icon["themo_contact_icon"], '-'));
                    if (isset($icon["themo_contact_icon_url_target"])) {
                        $link_target = $icon["themo_contact_icon_url_target"];
                    }

					$link_target_att = false;
					if (isset($link_target) && is_array($link_target)  && !empty($link_target)) {
						$link_target = $icon["themo_contact_icon_url_target"][0];
						if($link_target == '_blank'){
							$link_target_att = "target='_blank'";
						}
						}
                    // Link
                    $href_open = false;
                    $href_close = false;
                    $contact_url = $icon["themo_contact_icon_url"];
                    if(isset($contact_url) && $contact_url > ""){
                        $href_open = "<a ".$link_target_att." href='".esc_url($contact_url)."'>";
                        $href_close = '</a>';
					}
					switch ($glyphicon_type){
						case 'social':
							$glyphicon_class = 'social';
							break;
						case 'halflings':
							$glyphicon_class = 'halflings';
							break;
						case 'filetypes':
							$glyphicon_class = 'filetypes';
							break;
						default:
							$glyphicon_class = 'glyphicons';
					}
					$output .= '<div class="icon-block">';
					$output .= "<p>".$href_open."<i class='".esc_attr($glyphicon_class)." ".esc_attr($icon["themo_contact_icon"])."'></i><span>".wp_kses_post($icon["title"])."</span>".$href_close."</p>";
					$output .= '</div>';
				}
				$output .= "</div>";
			}
		}
	return $output;
}


//-----------------------------------------------------
// themo_return_footer_logo
// Return background styling and html markup for
// Footer Logo
//-----------------------------------------------------

function themo_return_footer_logo() {
    $output = "";
    if ( function_exists( 'ot_get_option' ) ) {
        /* get the slider array */

        // Image
        $payment_logo_src = false;
        $payment_logo_width = false;
        $payment_logo_height = false;
        $footer_logo = ot_get_option( 'themo_footer_logo', false );

        if(isset($footer_logo) && $footer_logo > ""){
            $img_id = themo_custom_get_attachment_id( $footer_logo );
            if($img_id > ""){
                $image_attributes = wp_get_attachment_image_src( $img_id, 'themo_featured');
                if( $image_attributes ) {
                    $footer_logo_src = $image_attributes[0];
                    $footer_logo_width = $image_attributes[1];
                    $footer_logo_height = $image_attributes[2];
                    if(isset($footer_logo_width) && $footer_logo_width > ""){
                        $footer_logo_width = "width='".esc_attr($footer_logo_width)."'";
                    }
                    if(isset($footer_logo_height) && $footer_logo_height > ""){
                        $footer_logo_height = "height='".esc_attr($footer_logo_height)."'";
                    }
                }
            }
        }


        // Link Target
        $link_target = ot_get_option( 'themo_footer_logo_url_target', false );
        $link_target_att = false;
        if (isset($link_target) && is_array($link_target)  && !empty($link_target)) {
            $link_target = $link_target[0];
            if($link_target == '_blank'){
                $link_target_att = "'target=_blank'";
            }
        }

        // Link
        $href_open = false;
        $href_close = false;
        $logo_link = ot_get_option( 'themo_footer_logo_url', false );
        if(isset($logo_link) && $logo_link > ""){
            $href_open = "<a ".$link_target_att." href='".esc_url($logo_link)."'>";
            $href_close = '</a>';
        }

        if(isset($footer_logo_src) && $footer_logo_src > ""){
            $output .= $href_open . "<img src='".esc_url($footer_logo_src)."' " .$footer_logo_width ." ". $footer_logo_height. ">" . $href_close;
        }

    }
    return $output;
}

//-----------------------------------------------------
// themo_print_project_icon
// Print mar-up for project icons
//-----------------------------------------------------

function themo_print_project_icon($id = false, $custom_glyphicon = false, $glyphicon_set = false) {


	if(!$glyphicon_set){
		$glyphicon_set = 'glyphicons';
	}
	if(!$id){
		$id = get_the_ID();
	}
	if(!$custom_glyphicon){
		$format = get_post_format( $id );
		switch ($format) {
			case 'gallery':
				$custom_glyphicon = 'glyphicons-sort';
				break;
			case 'link':
				$custom_glyphicon = 'glyphicons-link';
				break;
			case 'image':
				$custom_glyphicon = 'glyphicons-picture';
				break;
			case 'video':
				$custom_glyphicon = 'glyphicons-facetime-video';
				break;
			case 'audio':
				$custom_glyphicon = 'glyphicons-music';
				break;
			default:
				$custom_glyphicon = 'glyphicons-paperclip';
		}
	}

	$project_icon_support = 'on'; //
	if ( function_exists( 'ot_get_option' ) ) {
		$project_icon_support = ot_get_option( 'themo_project_icons', 'on' );
	}

	$project_icon_display = get_post_meta($id, 'themo_project_show_icon');
	if(isset($project_icon_display[0]) && $project_icon_display[0] == 1 && $project_icon_support == 'on') {
		$project_icon = '<i class="port-icon '.$glyphicon_set.' '.$custom_glyphicon.'"></i>';
	}else {
		$project_icon = "";
	}
	echo wp_kses_post($project_icon);
}

//======================================================================
// WordPress Actions & Filters
//======================================================================

# Actions
# Filters
# Plugins Actiosn and Filters


/**
 * Customize Adjacent Post Link Order
 */

function themo_adjacent_post_where($sql) {

	if ( !is_main_query() || !is_singular() )
		return $sql;

	$the_post = get_post( get_the_ID() );
	$patterns = array();
	$patterns[] = '/post_date/';
	$patterns[] = '/\'[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}\'/';
	$replacements = array();
	$replacements[] = 'menu_order';
	$replacements[] = $the_post->menu_order;
	return preg_replace( $patterns, $replacements, $sql );
}


function themo_adjacent_post_sort($sql) {
	if ( !is_main_query() || !is_singular() )
		return $sql;

	$pattern = '/post_date/';
	$replacement = 'menu_order';
	return preg_replace( $pattern, $replacement, $sql );
}

if ( isset($_GET['portorder']) && $_GET['portorder'] == 'menu' ) {

	add_filter( 'get_next_post_where', 'themo_adjacent_post_where' );
	add_filter( 'get_previous_post_where', 'themo_adjacent_post_where' );
	add_filter( 'get_next_post_sort', 'themo_adjacent_post_sort' );
	add_filter( 'get_previous_post_sort', 'themo_adjacent_post_sort' );
}

function themo_add_query_vars_filter( $vars ){
	$vars[] = "portorder";
	return $vars;
}
add_filter( 'query_vars', 'themo_add_query_vars_filter' );

/**
 * Adds a pretty "Continue Reading" link to post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function themo_custom_excerpt_more( $output ) {
	if ( (has_excerpt() || themo_has_more()) && ! is_attachment() && get_post_type() != 'themo_portfolio') {
		$output .= ' &hellip; <a href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More', 'stratus') . '</a>';
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'themo_custom_excerpt_more' );



function themo_read_more_link() {
	if (get_post_type() != 'themo_portfolio') {
		return ' &hellip; <a href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More', 'stratus') . '</a>';
	}

}

add_filter( 'the_content_more_link', 'themo_read_more_link' );



function themo_has_more()
{
	global $post;
	if ( empty( $post ) ) return;

	if ($pos=strpos($post->post_content, '<!--more-->')) {
		return true;
	} else {
		return false;
	}
}

/********************************
Set Status for End of Form Import
 ********************************/
function themo_import_demo_forms_complete($imported) {

	if(is_array($imported)){
		if($imported['imported']['forms'] > 1){
			update_option( 'themo_demo_form_import_completed', 1 );
		}
	}

	return $imported;
}

add_filter( 'frm_importing_xml', 'themo_import_demo_forms_complete' );


function themo_head_print_theme_options(){

	/* Themovation Theme Options */
	if ( function_exists( 'ot_get_option' ) ) {

		/* CUSTOM CSS Support */
		$custom_css_outfall = "";

		/* CUSTOM Typography Support */
		$themo_body_font = ot_get_option( 'themo_body_font' ); // Get Body Typography Settings
		$themo_menu_font = ot_get_option( 'themo_menu_font' ); // Get Menu Typography Settings
		$themo_headings_font = ot_get_option( 'themo_headings_font' ); // Get Headings Typography Settings

		if (!empty($themo_body_font)){
			$custom_css_outfall .= themo_return_typography_styles(array_filter($themo_body_font),"body,p");
		}
		if (!empty($themo_menu_font)){
			$custom_css_outfall .= themo_return_typography_styles(array_filter($themo_menu_font),".navbar .navbar-nav > li > a");
		}
		if (!empty($themo_headings_font)){
			$custom_css_outfall .= themo_return_typography_styles(array_filter($themo_headings_font),"h1, h2, h3, h4, h5, h6");
		}

		/* Custom Background Support */
		$full_width = ot_get_option( 'themo_wide_layout' );
		$backstretch = ot_get_option( 'themo_backstretch' );

		if ($full_width == 'off'){
			// We have a boxed layout, check for BG styling.
			// Return b/g image. If it's full width use backstretch js
			$boxed_layout_background = ot_get_option( 'themo_boxed_layout_background' );
			list($background_settings, $is_full_width, $background_image_filtered) = themo_custom_background($boxed_layout_background,'',false);

			if($background_settings > "" && $is_full_width && $backstretch == 'on'){
				$background_js = "$.backstretch('".$background_image_filtered."');";

				global $body_backstretch_js;
				$body_backstretch_js .= $background_js."\n";

			}elseif($background_settings > ""){
				// Are we opting to use JS vs CSS? Commented out for now
				$background_css = 'body{'.$background_settings.'}';
				$custom_css_outfall .= $background_css;
			}

		}

		/* Custom Color */
		$custom_color_primary = ot_get_option( 'themo_color_primary', THEMO_COLOR_PRIMARY ); // Get favicon option
		$custom_color_accent = ot_get_option( 'themo_color_accent', THEMO_COLOR_ACCENT ); // Get favicon option
		$custom_color_css = "\n/* Custom Color CSS $custom_color_primary */\n";
		$custom_color_css .= "#main-flex-slider .slides h1,.accent,.light-text .btn-ghost:hover,.light-text .googlemap a,.light-text .pricing-column.highlight .btn-ghost:hover,.light-text .pricing-column.highlight .btn-standard,.navbar .navbar-nav .dropdown-menu li a:hover,.navbar .navbar-nav .dropdown-menu li.active a,.navbar .navbar-nav .dropdown-menu li.active a:hover,.page-title h1,.panel-title i,.pricing-column.highlight .btn-ghost:hover,.pricing-column.highlight .btn-standard,.pricing-cost,.simple-cta span,.team-member-social a .soc-icon:hover,a,.light-text .panel-body p a{color:$custom_color_primary}.footer .widget-title:after,.navbar .navbar-nav>li.active>a:after,.navbar .navbar-nav>li.active>a:focus:after,.navbar .navbar-nav>li.active>a:hover:after,.navbar .navbar-nav>li>a:hover:after,.port-overlay,.section-header h2:after{background-color:$custom_color_primary}.accordion .accordion-btn .btn-ghost:hover,.btn-ghost:hover,.btn-standard,.circle-lrg-icon i,.circle-lrg-icon span,.light-text .pricing-table .btn-ghost:hover,.pager li>a:hover,.pager li>span:hover,.pricing-column.highlight{background-color:$custom_color_primary;border-color:$custom_color_primary}.accordion .accordion-btn .btn-ghost,.btn-ghost,.circle-lrg-icon i:hover,.circle-lrg-icon span:hover,.light-text .pricing-table .btn-ghost,.portfolio-filters a.current{color:$custom_color_primary;border-color:$custom_color_primary}.search-form input:focus,.widget select:focus,form input:focus,form select:focus,form textarea:focus{border-color:$custom_color_primary!important}.circle-med-icon i,.circle-med-icon span,.frm_form_submit_style,.frm_form_submit_style:hover,.with_frm_style .frm_submit input[type=button],.with_frm_style .frm_submit input[type=button]:hover,.with_frm_style .frm_submit input[type=submit],.with_frm_style .frm_submit input[type=submit]:hover,.with_frm_style.frm_login_form input[type=submit],.with_frm_style.frm_login_form input[type=submit]:hover,form input[type=submit],form input[type=submit]:hover{background:$custom_color_primary}.footer .tagcloud a:hover,.headhesive--clone .navbar-nav>li.active>a:after,.headhesive--clone .navbar-nav>li.active>a:focus:after,.headhesive--clone .navbar-nav>li.active>a:hover:after,.headhesive--clone .navbar-nav>li>a:hover:after,.search-submit,.search-submit:hover,.simple-conversion .with_frm_style input[type=submit],.simple-conversion .with_frm_style input[type=submit]:focus,.simple-conversion form input[type=submit],.simple-conversion form input[type=submit]:focus,.widget .tagcloud a:hover, .wpbs-form .wpbs-form-form .wpbs-form-submit, .wpbs-form .wpbs-form-form .wpbs-form-submit:hover, .wpbs-form .wpbs-form-form .wpbs-form-submit:active, .wpbs-form .wpbs-form-form .wpbs-form-submit:focus{background-color:$custom_color_primary!important}.btn-cta{background-color:$custom_color_accent}body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button,body #booked-profile-page .booked-profile-appt-list .appt-block.approved .status-block{background:$custom_color_accent !important}body #booked-profile-page input[type=submit].button-primary,body table.booked-calendar input[type=submit].button-primary,body .booked-modal input[type=submit].button-primary,body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button{border-color:$custom_color_accent !important}";
        $custom_color_css .= "html .woocommerce button.button.alt,html .woocommerce input.button.alt,html .woocommerce #respond input#submit.alt,html .woocommerce #content input.button.alt,html .woocommerce-page button.button.alt,html .woocommerce-page input.button.alt,html .woocommerce-page #respond input#submit.alt,html .woocommerce-page #content input.button.althtml .woocommerce button.button,html .woocommerce input.button,html .woocommerce #respond input#submit,html .woocommerce #content input.button,html .woocommerce-page button.button,html .woocommerce-page input.button,html .woocommerce-page #respond input#submit,html .woocommerce-page #content input.button {background-color: $custom_color_primary; color: #fff;}";
        $custom_color_css .= "html .woocommerce a.button.alt, html .woocommerce-page a.button.alt, html .woocommerce a.button, html .woocommerce-page a.button{background-color: $custom_color_primary; color: #fff;}";
        $custom_color_css .= "html .woocommerce button.button:hover,html .woocommerce input.button:hover,html .woocommerce #respond input#submit:hover,html .woocommerce #content input.button:hover,html .woocommerce-page button.button:hover,html .woocommerce-page input.button:hover,html .woocommerce-page #respond input#submit:hover,html .woocommerce-page #content input.button:hover {background-color: $custom_color_primary; color: #fff;}";
        $custom_color_css .= "html .woocommerce a.button:hover,html .woocommerce-page a.button:hover{background-color: $custom_color_primary; color: #fff;}";
		$custom_css_outfall .= "$custom_color_css\n";

		/* Custom CSS */
		$custom_css = ot_get_option( 'themo_custom_css' ); // Get favicon option
		if ($custom_css > ""){
			$custom_css_outfall .= "$custom_css\n";
		}
	}
	/* END Theme Options */

	/* Theme options output */

	themo_print_google_font_link();
	if (isset($custom_css_outfall) && $custom_css_outfall > "") {
		echo "\n<!-- Theme Custom CSS outfall -->\n<style>\n";
		echo sanitize_text_field($custom_css_outfall); // custom css sanitized just above
		echo "</style>\n";
	}
}
/* END options output */

add_action('wp_head', 'themo_head_print_theme_options', 999999);


add_action('wp_head', 'themo_load_html5shiv_respond');
function themo_load_html5shiv_respond(){
    echo '<!--[if lt IE 9]>'."\n".'<script src="'.get_template_directory_uri() .'/assets/js/vendor/html5shiv.min.js"></script>'."\n".'<script src="'.get_template_directory_uri().'/assets/js/vendor/respond.min.js"></script>'."\n".'<![endif]-->'."\n";
}


/********************************
Set Status for End of Demo Content Import
 ********************************/
function themo_import_demo_content_complete( )
{
	update_option( 'themo_demo_content_import_completed', 1 );
}

add_action( 'import_end', 'themo_import_demo_content_complete', 10, 2 );

/********************************
Set Status for End of Widget Import.
 ********************************/
function themo_import_demo_widget_complete( )
{
	update_option( 'themo_demo_widget_import_completed', 1 );
}

add_action( 'wie_after_import', 'themo_import_demo_widget_complete', 10, 2 );

/* Declare WooCommerce Support */

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/********************************
Custom Inline Styling
 ********************************/
function themo_inline_styles() {
	if ( function_exists( 'ot_get_option' ) ) {
		$nav_margin_top = ot_get_option( 'themo_nav_top_margin');

		if ($nav_margin_top > ""){
			$nav_margin_top_toggle = $nav_margin_top;
			$custom_css = "/* Navigation Padding */\n.navbar .navbar-nav {margin-top:".intval($nav_margin_top)."px} \n.navbar .navbar-toggle {top:".intval($nav_margin_top_toggle)."px} \n.themo_cart_icon {margin-top:".intval($nav_margin_top+12)."px}";
			wp_add_inline_style( 'roots_app', $custom_css );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'themo_inline_styles', 101 );


//-----------------------------------------------------
// themo_set_user_metaboxes
// Forces user metaboxes order via sort order inside meta box
//-----------------------------------------------------

add_action('edit_form_after_editor', 'themo_set_user_metaboxes'); //I want it to fire every time edit post screen comes up

function themo_set_user_metaboxes($user_id=NULL) {
	global $post;

    // Find out which post type we are editing, default to page.
    $post_type = get_post_type($post);

    if(isset($post_type) && $post_type > "") {

    }else{
        $post_type = 'page';
    }

	// Set the key that we will need to update
	$meta_key['order'] = 'meta-box-order_'.$post_type;

	// Get Current User ID
	$user_id = get_current_user_id();

	if ( $user_id > 0){



		// Get all meta boxes for current POST ID
		// Get all sort orders, put those without numbers first, and then order via sort order after
		$custom_field_keys = get_post_custom($post->ID); // GET META DATA
		//print_r($custom_field_keys);

		$meta_key_array = themo_sort_meta_array($custom_field_keys,false); // Filter an Sort ASC
		//print_r($meta_key_array);

		// remove these two specific keys from array, because we always want them at the top.
		//unset($meta_key_array['themo_content_editor_1']);
		unset($meta_key_array['themo_slider']);
		unset($meta_key_array['themo_slider_master']);


		// Prepare to add them back in, and in order slider, then page header
		// Set the values to remove and also the order we want to add them back in at.
		$forced_sort_order = array('themo_meta_box_builder_meta_box','themo_slider_meta_box','themo_slider_master_meta_box','themo_page_header_1_meta_box');

		// Disable drag / drop
		add_filter('postbox_classes_page_themo_meta_box_builder_meta_box', 'themo_metabox_not_sortable');
		add_filter('postbox_classes_page_themo_slider_meta_box', 'themo_metabox_not_sortable');
		add_filter('postbox_classes_page_themo_slider_master_meta_box', 'themo_metabox_not_sortable');
		add_filter('postbox_classes_page_themo_page_header_1_meta_box', 'themo_metabox_not_sortable');

		// Loop through each key, add '_meta_box' and then push
		// on the end of $forced_sort_order
		$meta_count = 0;
		foreach ($meta_key_array as $key => $value){
			$meta_count++;
			array_push($forced_sort_order, $key."_meta_box");
			add_filter('postbox_classes_page_'.$key.'_meta_box', 'themo_metabox_not_sortable');
		}

		// If this is a new page, load defaults.
		if($meta_count <= 1 && $post->ID > 0){

			// Set Default Sort Order for all our templates
			$demo_meta_box_sort_order = $forced_sort_order;
			$test = array();
			foreach ($test as $key => $value){
				array_push($demo_meta_box_sort_order, $value);
			}

			// Get the current template for this post ID
			$template_slug = get_post_meta($post->ID, 'themo_template_selection', true);
			$template_slug  = str_replace("-","_",$template_slug );

			// Get the default meta boxes for this specific template.
			if ( function_exists( 'ot_get_option' ) ) {
				/* get an array of templates */
				$templates = ot_get_option( 'themo_custom_template', array() );
				if ( ! empty( $templates ) ){
					$i = 1;
					foreach( $templates as $template ) {

						$title_slug =  sanitize_title($template['title']); // Match meta box title slug
						$title_slug = str_replace("-","_",$title_slug);

						// Run a match on the current template for this Post ID, if a match is found continue.
						if ($template_slug == $title_slug){

							foreach($template['meta_boxes'] as $value => $meta_box_name){ // loop through each metabox and output metabox

								// How many meta boxes do we need to print?
								$meta_box_multiply = 1;
								if(isset($template["themo_meta_box_quantity_".$meta_box_name]) && $template["themo_meta_box_quantity_".$meta_box_name] > 1){
									$meta_box_multiply = $template["themo_meta_box_quantity_".$meta_box_name];
								}
								// For each meta_box_multiply
								// Add to end of forced_sort_order
								for ($count_meta = 1 ; $count_meta <= $meta_box_multiply; $count_meta++){
									array_push($forced_sort_order, "themo_".$meta_box_name."_".$count_meta."_meta_box");
								}

							}
						}
						$i++;
					}
					$forced_sort_order = themo_return_sorted_array_by_array($demo_meta_box_sort_order,$forced_sort_order);
				}
			}
		}


		// Get the meta keys / values we want to reorder
		$current_meta_value = get_user_meta( $user_id, $meta_key['order'], true);


		// If $current_meta_value array has values and is an array, continue...
		if (is_array($current_meta_value) and !empty($current_meta_value)) {




            // If $current_meta_value array has a key called 'normal', continue...
			if (array_key_exists('normal', $current_meta_value)) {

				// Get position of first instance of a themo_ meta box
				$first_themo_meta_pos = strpos($current_meta_value['normal'], 'themo_');

				$messed_up_sort_order = explode(",",$current_meta_value['normal']);

				// Remove the forced sort order items from the messed up sort order array - start to clean it up.
				$cleaned_sort_order = array_diff($messed_up_sort_order, $forced_sort_order);

				// Convert to both to string
				$cleaned_sort_order_string = implode(",", $cleaned_sort_order);
				$forced_sort_order_string = implode(",", $forced_sort_order);

				// Put our force sort order items back into the cleaned sort order items, just at the right spot.
				$completed_sort_order = substr_replace($cleaned_sort_order_string, $forced_sort_order_string.',', $first_themo_meta_pos, 0);

				$completed_sort_order = rtrim($completed_sort_order, ',');
			}else{
				// normal key is empty, so default to $forced_sort_order
				// Convert to both to string before using
				$completed_sort_order = implode(",", $forced_sort_order);
				$completed_sort_order = rtrim($completed_sort_order, ',');
			}

			$updated_meta_value = array(
				'side' => $current_meta_value['side'],
				'normal' => $completed_sort_order,
				'advanced' => $current_meta_value['advanced'],
			);

			// Update meta values
			update_user_meta( $user_id, $meta_key['order'], $updated_meta_value );


		}else{

			// Set the values to remove and also the order we want to add them back in at.
			// default to $forced_sort_order
			// Convert to both to string before using
			$completed_sort_order = implode(",", $forced_sort_order);
			$completed_sort_order = rtrim($completed_sort_order, ',');

			$updated_meta_value = array(
				'side' => '',
				'normal' => $completed_sort_order,
				'advanced' => '',
			);

			// Update meta values
			update_user_meta( $user_id, $meta_key['order'], $updated_meta_value );

		}// end get_user_meta

	} // end if user id > 0

}//#end


//-----------------------------------------------------
// admin_enqueue_scripts - action
// Support for Meta Boxes (show / hide)
// Whenever a page template selected value changes,
// instantly hide/show the related metaboxs.
//-----------------------------------------------------
add_action('admin_enqueue_scripts', 'themo_admin_meta_show');

function themo_admin_meta_show()
{


	// Admin Styles
	wp_register_style( 'themo_admin_css', get_template_directory_uri() . '/assets/css/admin-styles.css', false, '1' );
	wp_enqueue_style( 'themo_admin_css' );

	// Admin JS
	wp_register_script('themo_admin_tools', get_template_directory_uri() . '/assets/js/admin_tools.js', array(), '1', true);
	wp_enqueue_script('themo_admin_tools');

}

//-----------------------------------------------------
// clean_url - Filter
// Defer JS
// Adapted from https://gist.github.com/toscho/1584783
//-----------------------------------------------------
if ( ! function_exists( 'themo_add_defer_to_js' ) )
{
	function themo_add_defer_to_js( $url )
	{
		if (strpos($url, '#deferload')===false)
			return $url;
		else if (is_admin())
			return str_replace('#deferload', '', $url);
		else
			return str_replace('#deferload', '', $url)."' defer='defer";
	}
	add_filter( 'clean_url', 'themo_add_defer_to_js', 11, 1 );
}


//-----------------------------------------------------
// prepend_attachment - filter
// Set default image size on the attachment pages
//-----------------------------------------------------
add_filter('prepend_attachment', 'themo_prepend_attachment');
function themo_prepend_attachment($p) {
	return wp_get_attachment_link(0, 'themo_full_width', false);
}

//-----------------------------------------------------
// delete_attachment - filter
// Delete retina-ready images
// This function is attached to the 'delete_attachment' filter hook.
//-----------------------------------------------------
add_filter( 'delete_attachment', 'themo_delete_retina_support_images' );

function themo_delete_retina_support_images( $attachment_id ) {
	$meta = wp_get_attachment_metadata( $attachment_id );
	$upload_dir = wp_upload_dir();
	if (isset($meta['file']) && $meta['file'] > ""){
		$path = pathinfo( $meta['file'] );
		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
}

//-----------------------------------------------------
// wp_generate_attachment_metadata - filter
// Retina Support for Logo
// This function is attached to the 'wp_generate_attachment_metadata' filter hook.
//-----------------------------------------------------

// We can only add retina support after_setup_theme, when ot_get_option is available.
// We want to check if the user has disabled retina support before adding it automatically.
function themo_add_retina_support() {

	add_filter( 'wp_generate_attachment_metadata', 'themo_retina_support_attachment_meta', 10, 2 );

}
add_action( 'after_setup_theme', 'themo_add_retina_support' );

function themo_retina_support_attachment_meta( $metadata, $attachment_id ) {

	$retina_support = 'off'; // Default to no retina support.
	if ( function_exists( 'ot_get_option' ) ) {
		$retina_support = ot_get_option( 'themo_retina_support', 'off' );
	}
	foreach ( $metadata as $key => $value ) {
		if ( is_array( $value ) ) {
			foreach ( $value as $image => $attr ) {
				if(is_array( $attr )){
					if ($retina_support == 'on' || $image == 'themo-logo'){ // Always use retina for logo.
						themo_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
					}
				}
			}
		}
	}
	return $metadata;
}

//-----------------------------------------------------
// wp_get_attachment_link - filter
// Lightbox Support
//-----------------------------------------------------
add_filter( 'wp_get_attachment_link' , 'themo_add_lighbox_data' );

function themo_add_lighbox_data ($content) {

	$postid = get_the_ID();
	$content = str_replace('<a', '<a class="thumbnail img-thumbnail"', $content);

	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    //$doc->loadHTML($content);
    $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

	$tags = $doc->getElementsByTagName('img');

	foreach ($tags as $tag) {
		$alt = $tag->getAttribute('alt');
	}

	$a_tag = $doc->getElementsByTagName('a');

	foreach ($a_tag as $tag) {
		$href = $tag->getAttribute('href');
		$image_large_src = "";
		// We need to get the ID by href
		// Check if this ID has a themo_full_width size, if so replace href.


		if ($href > ""){ // If href is captured
			$image_ID = themo_return_attachment_id_from_url($href); // Get the attachment ID
			if ($image_ID > 0){ // If id has been captured, check for image size.
				$image_large_attributes = wp_get_attachment_image_src( $image_ID, "themo_full_width") ;

				if( $image_large_attributes ) { //  If there is themo_full_width size, use it.
					$image_large_src = $image_large_attributes[0];
				}else{
					$image_large_src = wp_get_attachment_url( $image_ID );
				}
			}
		}

		// If a large size has been found, replace the original size.
		if ($image_large_src > ""){
			$content = str_replace($href, $image_large_src, $content);
		}
	}

	if (false !== strpos($href,'.jpg') || false !== strpos($href,'.jpeg') || false !== strpos($href,'.png') || false !== strpos($href,'.gif')) {
		// data-footer=\"future title / caption \"
		$content = preg_replace("/<a/","<a data-toggle=\"lightbox\" data-gallery=\"multiimages\" data-title=\"$alt\" ",$content,1);
	}

	return $content;
}


function themo_portfolio_template_options( $query ) {

	if ( is_admin() || ! $query->is_main_query() )
		return;

	//http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts

}
//add_action( 'pre_get_posts', 'themo_portfolio_template_options', 1 );


//======================================================================
// Plugins - Actions and Filters
//======================================================================


// WooCommerce Actions
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );

// Hide Shop Title
function filter_woocommerce_show_page_title( $bool )
{
    // make filter magic happen here...
    return false;
};

// add the filter
add_filter( 'woocommerce_show_page_title', 'filter_woocommerce_show_page_title', 10, 1 );

//Exclude AddThis widgets from anything other than posts
add_filter('addthis_post_exclude', 'themo_addthis_post_exclude');
function themo_addthis_post_exclude($display) {
	return false;
	echo 'HELLO';
	if ( !is_singular( 'post' ) )
		$display = false;
	return $display;
}



//-----------------------------------------------------
// themo_addthis_post_metabox_screens - filter
//Include the AddThis meta box to portfolio.
//-----------------------------------------------------

function themo_addthis_post_metabox_screens($array){
	$array[] = 'portfolio';
	return $array;
}
add_filter('addthis_post_metabox_screens', 'themo_addthis_post_metabox_screens');

//-----------------------------------------------------
// themo_search_meta - filter
// Enhance Search to include Meta Boxes
//-----------------------------------------------------
add_filter('posts_search', 'themo_search_function', 10, 2);
function themo_search_function($search, $query) {
    global $wpdb, $pagenow;
    if(!$query->is_main_query() || !$query->is_search || $pagenow=='post.php'){
        return($search); //determine if we are modifying the right query
    }


	$search_term = $query->get('s'); // Get Search Terms
	$search = ' AND (';

	// Query Content
	$search .=  $wpdb->prepare("($wpdb->posts.post_content LIKE '%%%s%%')",$wpdb->esc_like( $search_term ));

	// add an OR between search conditions
	$search .= " OR ";

	// Query Title
	$search .=  $wpdb->prepare("($wpdb->posts.post_title LIKE '%%%s%%')",$wpdb->esc_like( $search_term ));

	// add an OR between search conditions
	$search .= " OR ";

	// Sub Query Custom Meta Boxes
	$search .=  $wpdb->prepare("( $wpdb->posts.ID IN (SELECT DISTINCT $wpdb->postmeta.post_id FROM $wpdb->postmeta WHERE $wpdb->postmeta.meta_key like 'themo_%%' AND $wpdb->postmeta.meta_value LIKE '%%%s%%'))",$wpdb->esc_like( $search_term ));

	// add the filter to join tables if needed.
	// add_filter('posts_join', 'join_tables');
	return $search . ') ';
}

//-----------------------------------------------------
// themo_ajax_loader - filter
// Replace the Contact Form 7 Ajax Loading Image with our Own
//-----------------------------------------------------
if ( function_exists( 'wpcf7_ajax_loader' ) ) {
	add_filter( 'wpcf7_ajax_loader', 'themo_wap8_wpcf7_ajax_loader' );

	function themo_wap8_wpcf7_ajax_loader() {
		$url = "asdfa"; //get_template_directory_uri() . '/images/ajax-loader.gif';
		return $url;
	}
}

//-----------------------------------------------------
// activate_formidable/formidable.php - Filter
// When the formidable plugin is active set an option to
// print an admin message
//-----------------------------------------------------

add_action('activate_formidable/formidable.php', 'themo_formidable_set_notice');
function themo_formidable_set_notice() {
	add_option('formidable_do_activation_message', true);
}


/*
 * Change Meta Box visibility according to Page Template
 *
 * Observation: this example swaps the Featured Image meta box visibility
 *
 * Usage:
 * - adjust $('#postimagediv') to your meta box
 * - change 'page-portfolio.php' to your template's filename
 * - remove the console.log outputs
 */

add_action('admin_head', 'themo_wpse_50092_script_enqueuer');

function themo_wpse_50092_script_enqueuer() {
	global $current_screen;
	if(isset($current_screen->id) && 'page' != $current_screen->id) return;

    $iswooshoppage = 0;
    // Find out the shop page id for woo and hide the meta box builder.
    if(is_woocommerce_activated()){
        $post_ID = get_the_ID();
        $shop_page_id = wc_get_page_id( 'shop' );


        if(isset($post_ID) && isset($shop_page_id) && $post_ID == $shop_page_id){
			$iswooshoppage = 1;
        }
    }

	echo <<<HTML
        <script type="text/javascript">
        jQuery(document).ready( function($) {
		"use strict";
        var excludeTemplates = [ "templates/portfolio-standard.php","templates/blog-masonry.php","templates/blog-standard.php","templates/blog-category-masonry.php"];
        var currentTemplate = $('#page_template').val();
        var excludeFound = $.inArray(currentTemplate, excludeTemplates);
            /**
             * Adjust visibility of the meta box at startup
            */
            if($iswooshoppage) {
                $('#themo_meta_box_builder_meta_box').hide();
            }
            if( excludeFound !== -1 && !excludeFound > -1) {
                // hide your meta box
                $('#themo_meta_box_builder_meta_box').hide();
                $('#themo_blog_category_meta_box').show();
            } else {
                // show the meta box
                $('#themo_meta_box_builder_meta_box').show();
                $('#themo_portfolio_options_meta_box').hide();
                $('#themo_blog_category_meta_box').hide();
            }
            if( currentTemplate ==  "templates/portfolio-standard.php") {
            	$('#themo_portfolio_options_meta_box').show();
            }else{
            	$('#themo_portfolio_options_meta_box').hide();
            }



            // Debug only
            // - outputs the template filename
            // - checking for console existance to avoid js errors in non-compliant browsers
            /*
            if (typeof console == "object")
                console.log ('default value = ' + $('#page_template').val());
                */

            /**
             * Live adjustment of the meta box visibility
            */
            $('#page_template').live('change', function(){
                var currentTemplate = $(this).val();
                var excludeFound = $.inArray(currentTemplate, excludeTemplates);

                if( excludeFound !== -1 && !excludeFound > -1) {
                     // hide your meta box
                    $('#themo_meta_box_builder_meta_box').hide();
					$('#themo_blog_category_meta_box').show();                   
					//$('#themo_portfolio_options_meta_box').show();
                } else {
                    // show the meta box
                    $('#themo_meta_box_builder_meta_box').show();
                    //$('#themo_portfolio_options_meta_box').hide();
					$('#themo_blog_category_meta_box').hide();
                }

                if( currentTemplate ==  "templates/portfolio-standard.php") {
					$('#themo_portfolio_options_meta_box').show();
					$('#themo_blog_category_meta_box').hide();
				}else{
					$('#themo_portfolio_options_meta_box').hide();
				}

                // Debug only
               /* if (typeof console == "object")
                    console.log ('live change value = ' + $(this).val()); */
            });
        });
        </script>
HTML;
}




/**
 * Add custom fields to Yoast SEO analysis
 */

add_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast');

function add_custom_to_yoast( $content ) {
    global $post;
    $pid = $post->ID;
    $custom_content = false;

    $custom = get_post_custom($pid);
    unset($custom['_yoast_wpseo_focuskw']); // Don't count the keyword in the Yoast field!

    foreach( $custom as $key => $value ) {
        if( substr( $key, 0, 1 ) != '_' && !empty($value[0]) && substr( $key, 0, 5 ) == 'themo' && substr( $value[0], -1) != '}') { // Only analyze themovation custom fields.
            if(is_array($value[0])){
                //do nothing.
            }else{
                // Images
                if((substr( $key, -6) == '_photo' || substr( $key, -17) == '_background_image')  && $value[0] > ""){
                   $custom_content .= '<img src="'.$value[0].'"> ';
                }
                // Text
                if((substr( $key, -7) == '_header' && substr( $key, -12) != '_show_header') ||
                    (substr( $key, -8) == '_subtext' || substr( $key, -10) == '_shortcode' || substr( $key, -8) == '_content' ||
                        substr( $key, -13) == '_tooltip_text' || substr( $key, -5) == '_text') && $value[0] > ""){
                    // If it's one of the text fields we want to capture (and not empty), put in into a content variable that we will pass back to yoast.
                    $custom_content .= $value[0] . ' ';
                }
            }
        }
    }
    $content = $content . ' ' . $custom_content;
    return $content;
    remove_filter('wpseo_pre_analysis_post_content', 'add_custom_to_yoast'); // don't let WP execute this twice
}


//======================================================================
// Metabox Plugin Functions
//======================================================================
// Remove BR tag from checkbox list output.
add_filter('rwmb_themo_meta_box_builder_meta_boxes_html','themo_test');
function themo_test($html){
	return strip_tags($html,'<label><input>');
}

//======================================================================
// Option-Tree Functions
//======================================================================

//-----------------------------------------------------
// ot_override_forced_textarea_simple - filter
// Allows TinyMCE or Textarea metaboxes
//-----------------------------------------------------
add_filter( 'ot_override_forced_textarea_simple', '__return_true' );

//-----------------------------------------------------
// themo_ot_meta_box_post_format_quote - filter
// Slight Changes to the quote meta box
//-----------------------------------------------------
add_filter( 'ot_meta_box_post_format_quote', 'themo_ot_meta_box_post_format_quote',10,2 );

function themo_ot_meta_box_post_format_quote($array,$pages) {
	//$pages[] = 'themo_portfolio';
	//$array['pages'] = $pages;
	$array['fields'] = array(
		array(
			'id'      => '_format_quote_copy',
			'label'   => '',
			'desc'    => esc_html__( 'Quote', 'option-tree' ),
			'std'     => '',
			'type'        => 'text',
			'rows'        => '4',
		),
		array(
			'id'      => '_format_quote_source_name',
			'label'   => '',
			'desc'    => esc_html__( 'Source Name (ex. author, singer, actor)', 'stratus' ),
			'std'     => '',
			'type'    => 'text'
		),
		array(
			'id'      => '_format_quote_source_title',
			'label'   => '',
			'desc'    => esc_html__( 'Source Title (ex. book, song, movie)', 'stratus' ),
			'std'     => '',
			'type'    => 'text'
		));
	return $array;
}

//-----------------------------------------------------
// themo_ot_meta_box_post_format_audio - filter
// Slight Changes to the audio meta box
//-----------------------------------------------------
add_filter( 'ot_meta_box_post_format_audio', 'themo_ot_meta_box_post_format_audio',10,2 );

function themo_ot_meta_box_post_format_audio($array,$pages) {

	$pages[] = 'themo_portfolio';
	$array['pages'] = $pages;

	$array['fields'] = array(
		array(
			'id'      => '_format_audio_shortcode',
			'label'   => 'Upload and Embed Audio to your website',
			'desc'    => esc_html__( 'Use the built-in <code>[audio]</code> shortcode here.', 'stratus' ),
			'std'     => '',
			'type'    => 'textarea'
		)
	);
	return $array;
}

//-----------------------------------------------------
// themo_ot_meta_box_post_format_link - filter
// Slight Changes to the audio meta box
//-----------------------------------------------------
add_filter( 'ot_meta_box_post_format_link', 'themo_ot_meta_box_post_format_link',10,2 );

function themo_ot_meta_box_post_format_link($array,$pages) {

	$pages[] = 'themo_portfolio';
	$array['pages'] = $pages;

	$array['fields'] = array(

		array(
			'id'      => '_format_link_url',
			'label'   => '',
			'desc'    => esc_html__( 'Link URL (ex. http://google.com)', 'stratus' ),
			'std'     => '',
			'type'    => 'text'
		),
		array(
			'id'      => '_format_link_title',
			'label'   => '',
			'desc'    => esc_html__( 'Link Title (ex. Check out Google)', 'stratus' ),
			'std'     => '',
			'type'    => 'text'
		),

		array(
			'id'          => '_format_link_target',
			'label'       => esc_html__( 'Link Target', 'stratus' ),
			'type'        => 'checkbox',
			'choices'     => array(
				array(
					'value'       => '_blank',
					'label'       => 'Open link in a new window / tab',
				)
			)
		),
		array(
			'id'          => '_format_skip_single_link',
			'label'       => esc_html__( 'Link behaviour on the portfolio homepage', 'stratus' ),
			'desc' => 'By default the portfolio homepage thumbnail goes to the project single page. You can make this link go directly to your the URL above by using this checkbox.',
			'type'        => 'checkbox',
			'choices'     => array(
				array(
					'value'       => true,
					'label'       => 'Take user directly to URL above &amp; skip project single.',
				)
			)
		)
	);
	return $array;
}

//-----------------------------------------------------
// themo_ot_meta_box_post_format_video - filter
// Slight Changes to the video meta box
//-----------------------------------------------------
add_filter( 'ot_meta_box_post_format_video', 'themo_ot_meta_box_post_format_video',10,2 );

function themo_ot_meta_box_post_format_video($array,$pages) {

	$pages[] = 'themo_portfolio';
	$array['pages'] = $pages;

	$array['fields'] = array(
		array(
			'id'      => '_format_video_embed',
			'label'   => 'Insert from URL (Vimeo and Youtube)',
			'desc'    => sprintf( wp_kses_post( __( '(ex. http://vimeo.com/link-to-video). You can find a list of supported oEmbed sites in the %1$s.', 'stratus' )), '<a href="http://codex.wordpress.org/Embeds" target="_blank">' . esc_html__( 'Wordpress Codex', 'stratus' ) .'</a>' ),
			'std'     => '',
			'type'    => 'text'
		),
		array(
			'id'      => '_format_video_shortcode',
			'label'   => 'Upload your own self hosted video',
			'desc'    => wp_kses_post(__( 'Use the built-in <code>[video]</code> shortcode here.', 'stratus' )),
			'std'     => '',
			'type'    => 'textarea'
		)
	);
	return $array;
}

//-----------------------------------------------------
// themo_ot_meta_box_post_format_gallery - filter
// Enable Post Format gallery to on custom post type
//-----------------------------------------------------
add_filter('ot_meta_box_post_format_gallery', 'themo_ot_meta_box_post_format_gallery',10,2);

function themo_ot_meta_box_post_format_gallery($array,$pages) {

	$pages[] = 'themo_portfolio';
	$array['pages'] = $pages;
	return $array;
}

//-----------------------------------------------------
// themo_ot_post_formats - filter
// Enable Post Format Types via OT
//-----------------------------------------------------
add_filter( 'ot_post_formats', 'themo_ot_post_formats');

function themo_ot_post_formats( ) {
	return true;
}

//-----------------------------------------------------
// Custom Font Families Filter
// Add manual list of font families
//-----------------------------------------------------
add_filter( 'ot_recognized_font_families', 'themo_filter_ot_recognized_font_families', 10, 2 );

function themo_filter_ot_recognized_font_families( $array, $field_id ) {
	$array = array(
		//'"Droid Sans", sans-serif' => 'Droid Sans',
	);

	// check for custom google fonts, add them.
	if ( function_exists( 'ot_get_option' ) ) {

		/* get the slider array */
		$google_fonts = ot_get_option( 'themo_google_fonts', array() );

		if ( ! empty( $google_fonts ) ) {
			foreach( $google_fonts as $google_font ) {
				$google_font_family = $google_font["themo_google_font_family"];
				$google_font_url = $google_font["themo_google_font_url"];
				$google_font_title = $google_font["title"];

				if (($pos = strrpos($google_font_url, ":")) !== FALSE && $pos > 6) {
					$whatIWant = " | ".substr($google_font_url, $pos+1)."";
				}else{
					$whatIWant = " | normal";
				}

				$array[$google_font_family] = $google_font_title." ".$whatIWant; // add font to array so we can display as a select list font.
			}
		}
	}
	return $array;
}


//-----------------------------------------------------
// Custom Font styles Filter
// Add manual list of font families
//-----------------------------------------------------
add_filter( 'ot_recognized_font_styles', 'themo_filter_ot_recognized_font_styles', 10, 2 );

function themo_filter_ot_recognized_font_styles( $array, $field_id ) {
	$array = array(
		'normal'  => 'Normal',
		'italic'  => 'Italic',);

	return $array;
}

//-----------------------------------------------------
// Custom Font weights Filter
// Add manual list of font families
//-----------------------------------------------------
add_filter( 'ot_recognized_font_weights', 'themo_filter_ot_recognized_font_weights', 10, 2 );

function themo_filter_ot_recognized_font_weights( $array, $field_id ) {
	$array = array(
		'normal'    => 'Normal',
		'bold'      => 'Bold',
		'100'       => '100',
		'200'       => '200',
		'300'       => '300',
		'400'       => '400',
		'500'       => '500',
		'600'       => '600',
		'700'       => '700',
		'800'       => '800',
		'900'       => '900',
		'inherit'   => 'Inherit',

	);

	return $array;
}


//-----------------------------------------------------
// Custom Font Options Filter
// Add manual options for fonts, color, size.
//-----------------------------------------------------
add_filter( 'ot_recognized_typography_fields', 'themo_filter_ot_typo_fields', 10, 2 );

function themo_filter_ot_typo_fields( $array, $field_id ) {
	if ( $field_id == 'themo_headings_font' ) {
		$array = array(
			'font-color',
			'font-family',
			'font-weight',
			'font-style',
		);
	}else{
		$array = array(
			'font-color',
			'font-family',
			'font-size',
			'font-weight',
			'font-style',
			//'font-variant',
			//'letter-spacing',
			//'line-height',
			//'text-decoration',
			//'text-transform'
		);
	}
	return $array;
}


//-----------------------------------------------------
// Custom Background Fields Filter
//-----------------------------------------------------
add_filter( 'ot_recognized_background_fields', 'themo_filter_ot_recognized_background_fields', 10, 2 );

function themo_filter_ot_recognized_background_fields( $array, $field_id ) {
	if (strpos($field_id,'themo_slider_flex_themo_slider__background') !== false) {  // Custom List for Home page slider
		$array = array(
			'background-color',
			'background-repeat',
			'background-position',
			'background-size',
			'background-image'
		);
	}else{
		$array = array(
			'background-color',
			'background-repeat',
			'background-attachment',
			'background-position',
			'background-size',
			'background-image'
		);
	}
	return $array;
}

//-----------------------------------------------------
// Custom Background Repeat Options Filter
//-----------------------------------------------------
add_filter( 'ot_recognized_background_repeat', 'themo_filter_ot_recognized_background_repeat', 10, 2 );

function themo_filter_ot_recognized_background_repeat( $array, $field_id ) {
	$array = array(
		'no-repeat' => esc_html__( 'No Repeat', 'stratus' ),
		'repeat'    => esc_html__( 'Repeat All', 'stratus' ),
		'repeat-x'  => esc_html__( 'Repeat Horizontally', 'stratus' ),
		'repeat-y'  => esc_html__( 'Repeat Vertically', 'stratus' ),
	);

	return $array;
}


//-----------------------------------------------------
// Custom Background Attachment Options Filter
//-----------------------------------------------------
add_filter( 'ot_recognized_background_attachment', 'themo_filter_ot_recognized_background_attachment', 10, 2 );

function themo_filter_ot_recognized_background_attachment( $array, $field_id ) {
	$array = array(
		'fixed' => esc_html__( 'Fixed', 'stratus' ),
		'scroll'    => esc_html__( 'Scroll', 'stratus' ),
	);

	return $array;
}

//-----------------------------------------------------
// ot_media_buttons - Enable Media, Add Form, shortcodes
// to meta boxes listed inside of $force_editor_list
// By Default media button is disabled.
//-----------------------------------------------------
//add_filter( 'ot_media_buttons', 'themo_filter_textarea_media_buttons', 10, 2 );

function themo_filter_textarea_media_buttons( $content, $field_id ) {

	$field_id_match = trim(str_replace(range(0,9),'',$field_id));
	$force_editor_list = array('themo_service_block_split__content','themo_html__content');

	if (in_array($field_id_match, $force_editor_list)) {
		return true;
	}else{
		return $content;
	}

}


//-----------------------------------------------------
// ot_teeny - Disable the teeny setting for those listed
// inside of $force_editor_list
// By Default, teeny is set to true, which removes TinyMCE
// options such as typography etc..
//-----------------------------------------------------
//add_filter( 'ot_teeny', 'themo_filter_textarea_teeny', 10, 2 );

function themo_filter_textarea_teeny( $content, $field_id ) {

	$field_id_match = trim(str_replace(range(0,9),'',$field_id));
	$force_editor_list = array('themo_html__content','themo_service_block_split__content','themo_tour__themo_tour__text_');

	if (in_array($field_id_match, $force_editor_list)) {
		return false;
	}else{
		return true;
	}

}


//-----------------------------------------------------
// FILTER - Our list of meta boxes that need TinyMCE, we've
// striped out any numbers to match all dynamically created
// meta fields created by OT.
//-----------------------------------------------------
add_filter( 'ot_force_editor_list', 'themo_filter_force_editor_list', 10, 1 );

function themo_filter_force_editor_list( $content) {
	return array('');
}

//-----------------------------------------------------
// FILTER for modifying field id passed in from OT.
// Need to make a wildcard match on the field ids.
//-----------------------------------------------------
add_filter( 'ot_field_ID_match', 'themo_filter_field_ID_match', 10, 1 );

function themo_filter_field_ID_match( $content) {
	echo "ID: " . $content;
	return trim(str_replace(range(0,9),'',$content)); // Strip out numbers and pass it back.
}


//-----------------------------------------------------
// Custom Background Settings for Option Tree
// Return values for Option Tree Backgrkound.
// @background = option tree background array
// @css_identifier = any ID or Class
// Outputs CSS inside of an Internal Style Sheet
//-----------------------------------------------------

function themo_custom_background($background,$css_identifier,$inline_style=true) {

	$color = "";
	$image = "";
	$repeat = "";
	$position = "";
	$attachment = "";
	$size = "";
	$is_full_width = false;

	if (isset($background['background-color']) && $background['background-color'] > ""){
		$color = "background-color:".$background['background-color'].";";
	}

	if (isset($background['background-image']) && $background['background-image'] > ""){
		// Get Custom Image Size, 'themo_page_header'.

		$image_resized = themo_return_metabox_image($background['background-image'], null, 'themo_page_header', true);
		$image = "background-image:url('".$image_resized."');";
	}

	if (isset($background['background-repeat']) && $background['background-repeat'] > ""){
		$repeat = "background-repeat:".$background['background-repeat'].";";
	}

	if (isset($background['background-position']) && $background['background-position'] > ""){
		$position = "background-position:".$background['background-position'].";";
	}

	if (isset($background['background-attachment']) && $background['background-attachment'] > ""){
		$attachment = "background-attachment:".$background['background-attachment'].";";
	}

	if (isset($background['background-size']) && $background['background-size'] > ""){
		$size = "background-size:".$background['background-size'].";";
	}

	$output = '';
	$background_image_filtered = '';

	if ($image > "") {

		// If we are using repeat do not invoke backstretch library fix for mobile.
		// Else make sure mobile background image are stretched full width.

		if($repeat > "" && $repeat != 'background-repeat:no-repeat;'){
			$output .= "$color $image $attachment $position $repeat $size";
		}else{
			$output .= "$color $image $attachment $position $repeat $size";
			$is_full_width = true;
			$background_image_filtered = $image_resized;
		}
	} elseif ($color > ""){
		$output .= $color;
	} else {
		return;
	}


	// Output styles
	if ($output <> '') {

		if($inline_style){ // If inline sytle, wrap in style=
			$output = "style=\"" . $output . "\"";
		}
		return array(trim($output),$is_full_width,$background_image_filtered);

	}
}

//-----------------------------------------------------
// return_typography_styles
// Returns OT font settings into an inline css style
//-----------------------------------------------------
function themo_return_typography_styles($font_settings,$selector,$important=false){
	$body_class = "";
		if($important){
			$important = '!important';
		}
	foreach ($font_settings as $key => $value)
	{
		if (themo_is_first($font_settings, $key)){
			$body_class = "$selector"."{";
		}
		switch ($key) {
			case 'font-color':
				$body_class .= "color:$value $important;";
				break;
			case 'font-family':
				$body_class .= "$key:$value $important;";
				break;
			case 'font-size':
				$body_class .= "$key:$value $important;";
				break;
			case 'font-weight':
				$body_class .= "$key:$value $important;";
				break;
		}
		if (themo_is_last($font_settings, $key)){
			$body_class .= "}\n";
		}
	}
	return $body_class;
}

//-----------------------------------------------------
// print_google_font_link from OT settings.
// Print Google Font link tag for inline styling.
//-----------------------------------------------------
function themo_print_google_font_link(){

	// check for custom google fonts, add them.
	if ( function_exists( 'ot_get_option' ) ) {

		/* get the slider array */
		$google_fonts = ot_get_option( 'themo_google_fonts', array() );

		if ( ! empty( $google_fonts ) ) {
			foreach( $google_fonts as $google_font ) {
				//$google_font_family = $google_font["themo_google_font_family"];
				if($google_font["themo_google_font_url"] > ""){
					?>
					<!-- GOOGLE FONTS -->
					<link href='<?php echo esc_url($google_font["themo_google_font_url"]); ?>' rel='stylesheet' type='text/css'>
				<?php
				}
			}
		}
	}
}


//======================================================================
// Core Functions
//======================================================================

//-----------------------------------------------------
// print_template_part
// Includes template part based on meta box values
// @key = Meta Key
// @page_template = Page Template File Name
// @inner_container_open = bootstrap grid class
// @inner_container_close = bootstrap grid class close
//-----------------------------------------------------
function themo_print_template_part($key,$page_template,$inner_container_open,$inner_container_close,$page_layout){
	global $post;
	$remove_strings = array("_1" => "", "_2" => "", "_3" => "", "_4" => "", "_5" => "",
		"_6" => "", "_7" => "", "_8" => "", "_9" => "", "_10" => "",
		"_11" => "", "_12" => "", "_13" => "", "_14" => "", "_15" => "",
		"_16" => "", "_17" => "", "_18" => "", "_19" => "", "_20" => ""); // Clean up Meta Keys
	$clean_key = strtr($key, $remove_strings); // Clean up key

	$remove_strings = array("themo_" => "", "_1" => "", "_2" => "", "_3" => "", "_4" => "", "_5" => "",
		"_6" => "", "_7" => "", "_8" => "", "_9" => "", "_10" => "",
		"_11" => "", "_12" => "", "_13" => "", "_14" => "", "_15" => "",
		"_16" => "", "_17" => "", "_18" => "", "_19" => "", "_20" => ""); // Clean up Meta Keys
	$key_template_name = strtr($key, $remove_strings); // Clean up key for template name.


	switch ($clean_key) {
		case 'themo_slider_master';
			break;
		case 'themo_content_editor';
			//-----------------------------------------------------
			// CONTENT EDITOR (Default page content)
			//-----------------------------------------------------
			include( locate_template( 'templates/meta-'.$key_template_name.'.php' ) );
			break;

		case 'themo_service_block':
                //-----------------------------------------------------
                // Service Blocks
                //-----------------------------------------------------
            if ( ! post_password_required() ) {
                $show_header = get_post_meta($post->ID, $key . '_show_header', true);
                $show = get_post_meta($post->ID, $key . '_show', true);
                $style = get_post_meta($post->ID, $key . '_style', true); // horizontal or vertical
                $columns = get_post_meta($post->ID, $key . '_layout_columns', true); // 1 or 2


                if ($show == 1 || $show_header == 1) {
                    if ($style === "horizontal") {
                        if ($columns == 1) { // 1 Column
                            include(locate_template('templates/meta-service_block_horizontal_1_col.php'));
                        } elseif ($columns == 2) { // 2 columns
                            include(locate_template('templates/meta-service_block_horizontal_2_col.php'));
                        } else { // 3 columns
                            include(locate_template('templates/meta-service_block_horizontal_3_col.php'));
                        }
                    } else { // Vertical
                        include(locate_template('templates/meta-service_block_vertical.php'));
                    }
                }
            }

			break;

		default:
            if ( ! post_password_required() ) {
                //-----------------------------------------------------
                // Default
                //-----------------------------------------------------
                $show_header = get_post_meta($post->ID, $key . '_show_header', true);
                $show = get_post_meta($post->ID, $key . '_show', true);


                /* If any of the following Meta Values are turned 'On', get template part */
                $show_something = array();
                array_push($show_something, $show);
                array_push($show_something, $show_header);
                array_push($show_something, get_post_meta($post->ID, $key . '_show_floating_block', true));
                array_push($show_something, get_post_meta($post->ID, $key . '_show_content', true));

                if (in_array(1, $show_something)) {
                    include(locate_template('templates/meta-' . $key_template_name . '.php'));
                }
            }
			break;
	}
}

//======================================================================
// PLUGINS
//======================================================================


add_action( 'tgmpa_register', 'themo_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function themo_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme.
		array(
			'name'               => 'Themovation Shortcodes', // The plugin name.
			'slug'               => 'themovation-shortcodes', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/plugins/themovation-shortcodes.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),
		array(
			'name'               => 'Themovation Custom Post Types', // The plugin name.
			'slug'               => 'themovation-custom-post-types', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/plugins/themovation-custom-post-types.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),
        array(
            'name'               => 'Meta Box', // The plugin name.
            'slug'               => 'meta-box', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
		array(
			'name'               => 'Meta Box Tabs', // The plugin name.
			'slug'               => 'meta-box-tabs', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/plugins/meta-box-tabs.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '0.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),

        array(
            'name'               => 'Master Slider Pro', // The plugin name.
            'slug'               => 'masterslider', // The plugin slug (typically the folder name).
            'source'             => get_stylesheet_directory() . '/plugins/masterslider.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '3.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
        array(
			'name'      => 'WordPress Importer',
			'slug'      => 'wordpress-importer',
			'required'  => false,
		),
		array(
			'name'      => 'Widget Importer & Exporter',
			'slug'      => 'widget-importer-exporter',
			'required'  => false,
		),
		array(
			'name'      => 'Formidable Forms',
			'slug'      => 'formidable',
			'required'  => false,
		),
		array(
			'name'      => 'Widget Logic',
			'slug'      => 'widget-logic',
			'required'  => false,
		),
		array(
			'name'      => 'Simple Page Ordering',
			'slug'      => 'simple-page-ordering',
			'required'  => false,
		),

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
        //'parent_slug'  => 'themes.php',            // Parent menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'stratus' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'stratus' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'stratus' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'stratus' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'stratus' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'stratus' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'stratus' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'stratus' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'stratus' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'stratus' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'stratus' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'stratus' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'stratus' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'stratus' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'stratus' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'stratus' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'stratus' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );
}


/*
 * Run after Import
 */

add_action('import_end','themo_import_end');
function themo_import_end(){
    $pages = get_pages();
    foreach ( $pages as $page ) {
        //$page->ID;
            switch ($page->post_title) {
                case 'Home Product':
                    update_post_meta($page->ID, 'themo_showcase_2', term_exists('home-product'));
                    break;
                case 'Home Product 2':
                    update_post_meta($page->ID, 'themo_showcase_2_groups', term_exists('home-product-2'));
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('home-product-2'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('home-product-2'));
                    break;
                case 'Home App':
                    update_post_meta($page->ID, 'themo_slider_flex_groups', term_exists('home-app'));
                    update_post_meta($page->ID, 'themo_tour_1_groups', term_exists('home-app'));
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('home-app'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('home-app'));
                    update_post_meta($page->ID, 'themo_thumb_slider_1_groups', term_exists('home-app'));
                    break;
                case 'Home Cloud':
                    update_post_meta($page->ID, 'themo_slider_flex_groups', term_exists('home-cloud'));
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('home-cloud'));
                    update_post_meta($page->ID, 'themo_service_block_split_2_groups', term_exists('home-cloud-2'));
                    update_post_meta($page->ID, 'themo_brands_1_groups', term_exists('home-cloud'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('home-cloud'));
                    break;
                case 'Home Startup':
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('home-1'));
                    update_post_meta($page->ID, 'themo_thumb_slider_1_groups', term_exists('home-1'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('home-1'));
                    update_post_meta($page->ID, 'themo_featured_1_groups', term_exists('home-1'));
                    break;
                case 'Tour':
                    update_post_meta($page->ID, 'themo_tour_1_groups', term_exists('tour-1-group-1'));
                    break;
                case 'Tour 2':
                    update_post_meta($page->ID, 'themo_tour_1_groups', term_exists('tour-2-group-1'));
                    update_post_meta($page->ID, 'themo_tour_2_groups', term_exists('tour-2-group-2'));
                    break;
                case 'Showcase':
                    update_post_meta($page->ID, 'themo_showcase_1_groups', term_exists('showcase'));
                    update_post_meta($page->ID, 'themo_showcase_2_groups', term_exists('showcase'));
                    update_post_meta($page->ID, 'themo_showcase_3_groups', term_exists('showcase'));
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('showcase'));

                    break;
                case 'Portfolio':
                    update_post_meta($page->ID, 'themo_project_1_groups', term_exists('collaboration').','.term_exists('development').','.term_exists('integration'));
                    break;
                case 'Portfolio 4 Column':
                    update_post_meta($page->ID, 'themo_project_1_groups', term_exists('collaboration').','.term_exists('development').','.term_exists('innovate').','.term_exists('integration'));
                    break;
                case 'Portfolio 5 Column':
                    update_post_meta($page->ID, 'themo_project_1_groups', term_exists('collaboration').','.term_exists('development').','.term_exists('empower').','.term_exists('integration'));
                    break;
                case 'About':
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('stratus'));
                    update_post_meta($page->ID, 'themo_brands_1_groups', term_exists('about'));
                    update_post_meta($page->ID, 'themo_team_1_groups', term_exists('about'));
                    break;
                case 'Careers':
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('careers'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('careers'));
                    update_post_meta($page->ID, 'themo_accordion_1_groups', term_exists('careers'));
                    break;
                case 'Pricing':
                    update_post_meta($page->ID, 'themo_pricing_plans_1_groups', term_exists('stratus'));
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('stratus'));
                    break;
                case 'Pricing Plan Options':
                    update_post_meta($page->ID, 'themo_pricing_plans_1_groups', term_exists('4-col-pricing'));
                    update_post_meta($page->ID, 'themo_pricing_plans_2_groups', term_exists('4-col-pricing'));
                    update_post_meta($page->ID, 'themo_pricing_plans_3_groups', term_exists('euro'));
                    update_post_meta($page->ID, 'themo_pricing_plans_4_groups', term_exists('5-col-pricing'));
                    break;
                case 'Home - Master Slider':
                    update_post_meta($page->ID, 'themo_service_block_1_groups', term_exists('stratus'));
                    update_post_meta($page->ID, 'themo_team_1_groups', term_exists('about'));
                    update_post_meta($page->ID, 'themo_testimonials_1_groups', term_exists('stratus'));
                    update_post_meta($page->ID, 'themo_featured_1_groups', term_exists('stratus'));
                    break;
                case 'Locations':
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('locations'));
                    update_post_meta($page->ID, 'themo_service_block_split_2_groups', term_exists('locations'));
                    update_post_meta($page->ID, 'themo_service_block_split_3_groups', term_exists('locations'));
                    break;
                case 'Contact':
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('stratus'));
                    break;
                case 'Contact 2':
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('stratus'));
                    break;
                case 'Contact 3':
                    update_post_meta($page->ID, 'themo_service_block_split_1_groups', term_exists('stratus'));
                    break;
		}
	}
}


//======================================================================
// CATEGORY LARGE FONT
//======================================================================

//-----------------------------------------------------
// Sub-Category Smaller Font
//-----------------------------------------------------

/* Title Here Notice the First Letters are Capitalized note from from WIN */

# Option 1
# Option 2
# Option 3

/*
 * This is a detailed explanation
 * of something that should require
 * several paragraphs of information.
 */

// This is a single line quote.