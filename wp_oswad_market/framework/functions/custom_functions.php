<?php 

/**
*   Get class page layout
*
**/
if(!function_exists('wd_page_layout_class')){
	function wd_page_layout_class($layout_name='', $echo = true, $extra_class = ''){
		global $page_datas;
		$layout_class = "";
		switch($page_datas['page_layout']){
			case 'box':
				$layout_class = "wd_box";
				break;
			default:
				$layout_class = "wd_wide";
		}
		if( $extra_class != '' ){
			$layout_class .= ' '.$extra_class;
		}
		if($echo){
			echo $layout_class;
		}
		else{
			return $layout_class;
		}
	}
}
/**
*	Combine a input array with defaut array
*
**/
if(!function_exists ('wd_valid_color')){
	function wd_valid_color( $color = '' ) {
		if( strlen(trim($color)) > 0 ) {
			$named = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');
			if (in_array(strtolower($color), $named)) {
				return true;
			}else{
				return preg_match('/^#[a-f0-9]{6}$/i', $color);			
			}
		}
		return false;
	}
}

/**
*	Combine a input array with defaut array
*
**/
if(!function_exists ('wd_array_atts')){
	function wd_array_atts($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
	   foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( is_array($atts[$name]) ){
					$out[$name] = wd_array_atts($default,$atts[$name]);
				}
				else{
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}

if(!function_exists ('wd_array_atts_str')){
	function wd_array_atts_str($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
	   foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( strlen(trim($atts[$name])) > 0 ){
					$out[$name] = $atts[$name];
				}else{
					$out[$name] = $default;
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}	

if(!function_exists ('wd_get_all_post_list')){
	function wd_get_all_post_list( $_post_type = "post" ){
		wp_reset_query();
		$args = array(
			'post_type'=> $_post_type
			,'posts_per_page'  => -1
		);
		$_post_lists = get_posts( $args );
		
		if( $_post_lists ){
			foreach ( $_post_lists as $post ) {
				setup_postdata($post);
				$ret_array[] = array(
					$post->ID
					,get_the_title($post->ID)
				);
			}
		}else{
			$ret_array = array();
		}
		wp_reset_query();	
		return $ret_array ;
		
	}
}	

if(!function_exists ('show_page_slider')){
	function show_page_slider(){
		global $page_datas;
		$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
		$layerslider_exists = class_exists('LS_Sliders');
		switch ($page_datas['page_slider']) {
			case 'revolution':
				if( $revolution_exists )
					RevSliderOutput::putSlider($page_datas['page_revolution'],"");
				break;
			case 'layerslider':
				if($layerslider_exists)
					layerslider($page_datas['page_layerslider']);
				break;	
			case 'product' :
				show_prod_slider($page_datas['product_cat'],$page_datas['product_slider_title'],$page_datas['product_slider_columns']);
				break;							
			case 'none' :
				break;							
			default:
			   break;
		}	
	}
}

/***** Product Search Form by Category - Default search product *****/
if( !function_exists('wd_search_form_by_category') ){
	function wd_search_form_by_category($taxonomy = 'product_cat',$post_type='product'){
		$args = array(
			'number'     => ''
			,'hide_empty'	=> 1
			,'orderby'		=>'name'
			,'order'		=>'desc'
			,'include'    => array()
		);
		
		$categories = get_terms($taxonomy, $args);
		
		$options = '<option value="">'.__('All Categories','wpdance').'</option>';
		$select = '';
		
		if( is_search() &&  isset($_GET['term']) && $_GET['term']!='' ){
			$select = $_GET['term'];
		}
		
		foreach( $categories as $cat ){
			$options .= '<option value="'.$cat->slug.'" '.selected($select,$cat->slug,false).'>'.$cat->name.'</option>';
		}
		
		$form = '<div class="wd_search_form_by_category">
		<form role="search" method="get" id="searchform'.rand(0,1000).'" action="' . esc_url( home_url( '/'  ) ) . '">
		 <select class="select_category" name="term">'.$options.'</select>
		 <div class="search_content">
			 <label class="screen-reader-text" for="s">' . __( 'Search for:', 'wpdance' ) . '</label>
			 <input type="text" value="' . get_search_query() . '" name="s" id="s'.rand(0,1000).'" placeholder="' . __( 'Search', 'wpdance' ) . '" />
			 <input type="submit" title="Search" id="searchsubmit'.rand(0,1000).'" value="'. esc_attr__( 'Search', 'wpdance' ) .'" />
			 <input type="hidden" name="post_type" value="'.$post_type.'" />
			 <input type="hidden" name="taxonomy" value="'.$taxonomy.'" />
		 </div>
		</form></div>';
		
		echo $form;
		
	}
}

/***** Is Active WooCommmerce *****/
if( !function_exists('wd_is_woocommerce') ){
	function wd_is_woocommerce(){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return false;
		}
		return true;
	}
}


if( !function_exists('wd_hex2rgb') ){
	function wd_hex2rgb($Hex){
		if (substr($Hex,0,1) == "#")
			$Hex = substr($Hex,1);
		$R = substr($Hex,0,2);
		$G = substr($Hex,2,2);
		$B = substr($Hex,4,2);

		$R = hexdec($R);
		$G = hexdec($G);
		$B = hexdec($B);

		$RGB['R'] = $R;
		$RGB['G'] = $G;
		$RGB['B'] = $B;

		return $RGB;
	}
}
if( !function_exists('wd_rgb2hex') ){
	function wd_rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb['R']), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['G']), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['B']), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)
	}
}
if( !function_exists('wd_calc_color') ){
	function wd_calc_color($firstColor, $secondColor, $add = true){
		if( strrpos($firstColor,'#') !== false && strrpos($secondColor,'#') !== false ){ // Is Hex
			$rgb_first_color = wd_hex2rgb($firstColor);
			$rgb_second_color = wd_hex2rgb($secondColor);
			if( $add ){
				$rgb_first_color['R'] += $rgb_second_color['R'];
				$rgb_first_color['G'] += $rgb_second_color['G'];
				$rgb_first_color['B'] += $rgb_second_color['B'];
			}
			else{
				$rgb_first_color['R'] -= $rgb_second_color['R'];
				$rgb_first_color['G'] -= $rgb_second_color['G'];
				$rgb_first_color['B'] -= $rgb_second_color['B'];
			}
			return wd_rgb2hex($rgb_first_color);
		}
		else{
			return $firstColor;
		}
		
	}
}

/** Save Of Options - Save Dynamic css **/
add_action('of_save_options_after','wd_update_dynamic_css',10000);
if( !function_exists('wd_update_dynamic_css') ){
	function wd_update_dynamic_css( $data = array() ){
		//wrong input type
		if( !is_array($data) ){
			return -1;
		}
		if(is_array($data['data'])){
			$data = $data['data'];	
		}
		else{
			return -1;
		}
	
		$upload_dir = wp_upload_dir();
		$filename = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';
		ob_start();
		include get_template_directory() . '/framework/functions/custom_style.php';
		$dynamic_css = ob_get_contents();
		ob_get_clean();
		
		$creds = request_filesystem_credentials($filename, '', false, false, array());
		if ( ! WP_Filesystem($creds) ) {
			return false;
		}
		
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename,
				$dynamic_css,
				FS_CHMOD_FILE // predefined mode settings for WP files
			);
		}
	}
}

if( !function_exists('wd_add_dynamic_css_header') ){
	function wd_add_dynamic_css_header($is_iframe = false){
		ob_start();
		include_once get_template_directory() . '/framework/functions/custom_style.php';
		$dynamic_css = ob_get_contents();
		ob_get_clean();
		
		$upload_dir = wp_upload_dir();
		$filename = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';
		
		if( file_exists($filename) ){
			if( $is_iframe ){
				$filename_url = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';
				echo '<link rel="stylesheet" type="text/css" media="all" href="'. $filename_url .'" />';
			}
		}
		else{
			echo '<style type="text/css">';
			echo $dynamic_css;
			echo '</style>';
		}
	}
}

if( !function_exists('wd_myaccount_menu_custom') ){
	function wd_myaccount_menu_custom(){
		$_user_logged = is_user_logged_in();
		ob_start();
		?>
		<div class="wd_myaccount_menu">
			<div class="title"><?php _e('Account','wpdance'); ?></div>
			<div class="content">
				<ul>
					<?php if( $_user_logged ){ ?>
					<li><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php _e('Logout','wpdance') ?></a></li>
					<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('My Account','wpdance'); ?></a></li>
					<li><a href="<?php echo esc_url(wc_customer_edit_account_url()); ?>"><?php _e('Edit account','wpdance') ?></a></li>
					<?php } else { ?>
					<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('Login','wpdance'); ?></a></li>
					<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('Register','wpdance'); ?></a></li>
					<li><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgotten Password','wpdance'); ?></a></li>
					<?php } ?>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>"><?php _e('Wishlist','wpdance'); ?></a></li>
				</ul>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	}
}

/*** bbPress custom function ***/
if( class_exists('bbPress') ){
	function wd_get_forum_categories($args = array()){
		if( taxonomy_exists('forum_cat') ){
			if( empty($args) ){
				$args = array(
							'orderby' 		=> 'name'
							,'order'  		=> 'asc'
							,'hide_empty'  	=> 1
						);
			}
			$forum_cats = get_terms('forum_cat',$args);
			return $forum_cats;
		}
		else{
			return array();
		}
	 }
}



/****** Woo Rating Custom Function *******/
if( !function_exists('wd_get_rating_html') ){
	function wd_get_rating_html( $rating = null ){
		global $product;
		if ( ! is_numeric( $rating ) ) {
			$rating = $product->get_average_rating();
		}

		if ( $rating > 0 ) {

			$rating_html  = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'wpdance' ), $rating ) . '">';

			$rating_html .= '<span style="height:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'wpdance' ) . '</span>';

			$rating_html .= '</div>';

			return $rating_html;
		}

		return '';
	}
}

if( !function_exists('wd_get_min_price_product_category') ){
	function wd_get_min_price_product_category($term_id){
		global $wpdb;
		$min = 0;
		$args = array(
			'post_type'				=> 'product'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page'		=> -1
			,'tax_query'			=> array(
							array(
								'taxonomy'	=> 'product_cat'
								,'terms'	=> $term_id
								,'field'	=> 'term_id'
							)
			)
			,'fields'	=> 'ids'
		);
		
		$product_ids = new WP_Query($args);
		if( isset($product_ids->posts) && is_array($product_ids->posts) && count($product_ids->posts) > 0 ){
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price', '_min_variation_price' ) ) ) . '")
					AND meta_value != ""
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', $product_ids->posts ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', $product_ids->posts ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta
			) ) );
		}
		wp_reset_query();
		
		return wc_price($min);
	}
}

function wd_blog_personal_template_social_sharing(){
	?>
	<ul class="wd-social-share blog-personal">

		<li class="facebook">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		</li>
	
		<li class="twitter">
			<a href="https://twitter.com/home?status=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		</li>
	
		<li class="google-plus">
			<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		</li>
		
		<li class="pinterest">
			<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );?>
			<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link);?>" target="_blank"><i class="fa fa-pinterest"></i></a>
		</li>
	
		<li class="linkedin">
			<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_permalink()); ?>&amp;title=<?php echo esc_attr(sanitize_title(get_the_title())); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		</li>

	</ul>
	<?php
}

	
?>