<?php
#-----------------------------------------
#	RT-Theme custom_posts.php
#	version: 1.0
#-----------------------------------------

#
# 	Custom Post Types
#

function rt_theme_custom_posts(){
	
	#
	#	Permalink slugs for the custom post types
	#
	
	$portfolio_slug            = get_option(RT_THEMESLUG."_portfolio_single_slug"); 	// singular portfolio item
	$portfolio_categories_slug = get_option(RT_THEMESLUG."_portfolio_category_slug"); 	// portfolio categories
	$product_slug              = get_option(RT_THEMESLUG."_product_single_slug"); 		// singular product item
	$product_categories_slug   = get_option(RT_THEMESLUG."_product_category_slug");		// product categories 
	$staff_slug                = "team"; // team
	
	#
	#	Portfolio
	#
	
	$labels = array(
		'name'               => __('Portfolio', 'rt_theme_admin'),
		'singular_name'      => __('portfolio', 'rt_theme_admin'),
		'add_new'            => __('Add New', 'rt_theme_admin'),
		'add_new_item'       => __('Add New portfolio item', 'rt_theme_admin'),
		'edit_item'          => __('Edit Portfolio Item', 'rt_theme_admin'),
		'new_item'           => __('New Portfolio Item', 'rt_theme_admin'),
		'view_item'          => __('View Portfolio Item', 'rt_theme_admin'),
		'search_items'       => __('Search Portfolio Item', 'rt_theme_admin'),
		'not_found'          => __('No portfolio item found', 'rt_theme_admin'),
		'not_found_in_trash' => __('No portfolio item found in Trash', 'rt_theme_admin'), 
		'parent_item_colon'  => ''
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true, 
		'query_var'           => true,
		'can_export'          => true,
		'show_in_nav_menus'   => true,		
		'capability_type'     => 'post',
		'hierarchical'        => false, 
		'menu_position'       => null, 
		'rewrite'             => array( 'slug' => _x( $portfolio_slug, 'URL slug', 'rt_theme' ), 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'menu_icon'           => RT_THEMEADMINURI .'/images/portfolio-icon.png', // 16px16
		'supports'            => array('title','editor','author','comments','thumbnail','revisions')
	);
	
	register_post_type('portfolio',$args);
	
	// Portfolio Categories
	$labels = array(
		'name'              => __( 'Portfolio Categories', 'rt_theme_admin'),
		'singular_name'     => __( 'Portfolio Category', 'rt_theme_admin'),
		'search_items'      => __( 'Search Portfolio Category', 'rt_theme_admin'),
		'all_items'         => __( 'All Portfolio Categories', 'rt_theme_admin'),
		'parent_item'       => __( 'Parent Portfolio Category', 'rt_theme_admin'),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'rt_theme_admin'),
		'edit_item'         => __( 'Edit Portfolio Category', 'rt_theme_admin'), 
		'update_item'       => __( 'Update Portfolio Category', 'rt_theme_admin'),
		'add_new_item'      => __( 'Add New Portfolio Category', 'rt_theme_admin'),
		'new_item_name'     => __( 'New Genre Portfolio Category', 'rt_theme_admin'),
	); 	
	
	register_taxonomy('portfolio_categories',array('portfolio'), array(
		'hierarchical' => true,
		'labels'       => $labels,
		'show_ui'      => true,
		'query_var'    => false,
		'_builtin'     => false,
		'paged'        => true,
		'rewrite'      => array('slug'=> _x( $portfolio_categories_slug, 'URL slug', 'rt_theme' ), 'with_front'=>false ),
	));
	
	
	
	
	#
	#	Products
	#
	if ( ! class_exists( 'Woocommerce' ) ) {
		$labels = array(
			'name'               => __('Product', 'rt_theme_admin'),
			'singular_name'      => __('product', 'rt_theme_admin'),
			'add_new'            => __('Add New', 'rt_theme_admin'),
			'add_new_item'       => __('Add New Product Item', 'rt_theme_admin'),
			'edit_item'          => __('Edit Product Item', 'rt_theme_admin'),
			'new_item'           => __('New Product Item', 'rt_theme_admin'),
			'view_item'          => __('View Product Item', 'rt_theme_admin'),
			'search_items'       => __('Search Product Item', 'rt_theme_admin'),
			'not_found'          => __('No Product Item Iound', 'rt_theme_admin'),
			'not_found_in_trash' => __('No product item found in trash', 'rt_theme_admin'), 
			'parent_item_colon'  => ''
		);
	}else{
		$labels = array(
			'name'               => __('Product Showcase', 'rt_theme_admin'),
			'singular_name'      => __('Product', 'rt_theme_admin'),
			'add_new'            => __('Add New',  'rt_theme_admin'),
			'add_new_item'       => __('Add New Product Item', 'rt_theme_admin'),
			'edit_item'          => __('Edit Product Item', 'rt_theme_admin'),
			'new_item'           => __('New Product Item', 'rt_theme_admin'),
			'view_item'          => __('View Product Item', 'rt_theme_admin'),
			'search_items'       => __('Search Product Item', 'rt_theme_admin'),
			'not_found'          => __('No Product Item found', 'rt_theme_admin'),
			'not_found_in_trash' => __('No product item found in trash', 'rt_theme_admin'), 
			'parent_item_colon'  => ''
		);
	}

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true, 
		'query_var'           => true,
		'can_export'          => true,
		'show_in_nav_menus'   => true,		
		'capability_type'     => 'post',
		'menu_position'       => null, 
		'hierarchical'        => false,  
		'rewrite'             => array( 'slug' => _x( $product_slug, 'URL slug', 'rt_theme' ), 'with_front' => true, 'pages' => true, 'feeds'=>false ), 
		'menu_icon'           => RT_THEMEADMINURI .'/images/product-icon.png', // 16px16
		'supports'            => array('title','editor','author','comments','thumbnail','revisions')
	);
	
	register_post_type('products',$args);
	
	// Product Categories
	$labels = array(
		'name'              => __( 'Product Categories', 'rt_theme_admin'),
		'singular_name'     => __( 'Product Category', 'rt_theme_admin'),
		'search_items'      => __( 'Search Product Category' , 'rt_theme_admin'),
		'all_items'         => __( 'All Product Categories' , 'rt_theme_admin'),
		'parent_item'       => __( 'Parent Product Category' , 'rt_theme_admin'),
		'parent_item_colon' => __( 'Parent Product Category:' , 'rt_theme_admin'),
		'edit_item'         => __( 'Edit Product Category' , 'rt_theme_admin'), 
		'update_item'       => __( 'Update Product Category' , 'rt_theme_admin'),
		'add_new_item'      => __( 'Add New Product Category' , 'rt_theme_admin'),
		'new_item_name'     => __( 'New Genre Product Category' , 'rt_theme_admin'),
	); 	
	

	register_taxonomy('product_categories',array('products'), array(
		'hierarchical' => true,
		'labels'       => $labels,
		'show_ui'      => true,
		'query_var'    => false,
		'_builtin'     => false,
		'paged'        => true,
		'rewrite'      => array('slug'=>_x( $product_categories_slug, 'URL slug', 'rt_theme' ),'with_front'=>false),
	));



	#
	#	Employees
	#
	
	$labels = array(
		'menu_name'          => __('Team / Staff', 'rt_theme_admin'),
		'name'               => __('Team / Staff', 'rt_theme_admin'),
		'singular_name'      => __('Team / Staff', 'rt_theme_admin'),
		'add_new'            => __('Add New Member', 'rt_theme_admin'),
		'add_new_item'       => __('Add New Member', 'rt_theme_admin'),
		'edit_item'          => __('Edit Member', 'rt_theme_admin'),
		'new_item'           => __('New Member', 'rt_theme_admin'),
		'view_item'          => __('View Member', 'rt_theme_admin'),
		'search_items'       => __('Search for Member', 'rt_theme_admin'),
		'not_found'          => __('No staff found', 'rt_theme_admin'),
		'not_found_in_trash' => __('No staff found in Trash', 'rt_theme_admin'), 
		'parent_item_colon'  => ''
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_ui'             => true, 
		'query_var'           => false,
		'can_export'          => true,
		'show_in_nav_menus'   => false,		
		'capability_type'     => 'post',
		'menu_position'       => null, 
		'rewrite'             => array( 'slug' => _x( $staff_slug, 'URL slug', 'rt_theme' ), 'with_front' => false, 'pages' => true, 'feeds'=>false ),
		'menu_icon'           => RT_THEMEADMINURI .'/images/user.png', // 16px16
		'supports'            => array('title','editor','thumbnail','revisions')
	);
	
	register_post_type('staff',$args);
 

	#
	#	Testimonials
	#
	
	$labels = array(
		'menu_name'          => __('Testimonials', 'rt_theme_admin'),
		'name'               => __('Testimonials', 'rt_theme_admin'),
		'singular_name'      => __('Testimonial', 'rt_theme_admin'),
		'add_new'            => __('Add New', 'rt_theme_admin'),
		'add_new_item'       => __('Add New Testimonial', 'rt_theme_admin'),
		'edit_item'          => __('Edit Testimonial', 'rt_theme_admin'),
		'new_item'           => __('New Testimonial', 'rt_theme_admin'),
		'view_item'          => __('View Testimonial', 'rt_theme_admin'),
		'search_items'       => __('Search Testimonial', 'rt_theme_admin'),
		'not_found'          => __('No testimonial found', 'rt_theme_admin'),
		'not_found_in_trash' => __('No testimonial found in Trash', 'rt_theme_admin'), 
		'parent_item_colon'  => ''
	);
	
	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true, 
		'query_var'           => false,
		'can_export'          => true,
		'hierarchical'		  => false,
		'show_in_nav_menus'   => false,		
		'capability_type'     => 'post',
		'menu_position'       => null, 
		'rewrite'             => false,
		'menu_icon'           => RT_THEMEADMINURI .'/images/comment_white.png', // 16px16
		'supports'            => array('thumbnail','revisions')
	);


	register_post_type('testimonial',$args);
	 
}

add_action('init','rt_theme_custom_posts',0);


#
# 	add ID column in product post types
#

if(is_admin()){
	// ADD NEW COLUMN
	function rt_ST4_columns_head($defaults) {
		$defaults['product-id'] = 'ID';
		return $defaults;
	}
	
	// SHOW INFO IN THE NEW COLUMN
	function rt_ST4_columns_content($column_name, $post_ID) { 
	   echo $post_ID;
	}


	add_filter('manage_products_posts_columns', 'rt_ST4_columns_head', 10);
	add_action('manage_products_posts_custom_column', 'rt_ST4_columns_content', 10, 2);

	add_filter('manage_portfolio_posts_columns', 'rt_ST4_columns_head', 10);
	add_action('manage_portfolio_posts_custom_column', 'rt_ST4_columns_content', 10, 2);

	add_filter('manage_staff_posts_columns', 'rt_ST4_columns_head', 10);
	add_action('manage_staff_posts_custom_column', 'rt_ST4_columns_content', 10, 2);


	/*
		Testimonial List Views
	*/

	add_filter( 'manage_edit-testimonial_columns', 'rt_testimonials_edit_columns' );

	function rt_testimonials_edit_columns( $columns ) {
	    $columns = array(
	        'cb' => '<input type="checkbox" />',
        	'testimonial-title' => __("Title","rt_theme_admin"),
	       	'id' => __("ID","rt_theme_admin"),
	        'testimonial' => __("Testimonial","rt_theme_admin"),
	        'testimonial-client-name' => __("Client's Name","rt_theme_admin"),
	        'date' => 'Date'
	    );
	 
	    return $columns;
	}
	 
	add_action( 'manage_posts_custom_column', 'rt_testimonials_columns', 10, 2 );

	function rt_testimonials_columns( $column, $post_id ) {
	    $client_name = get_post_meta( $post_id, RT_COMMON_THEMESLUG.'_name', true );
	    $client_title = get_post_meta( $post_id, RT_COMMON_THEMESLUG.'_title', true );
	    $testimonial = get_post_meta( $post_id, RT_COMMON_THEMESLUG.'_testimonial', true );

	    switch ( $column ) {

			case 'testimonial-title':
				echo '<a title="'. __("Edit Testimonial","rt_theme_admin") .' - '.$post_id.'" href="post.php?post='.$post_id.'&action=edit">'. __("Testimonial","rt_theme_admin").' - '.$post_id.'</a>';
				break;			
			case 'id':
				echo $post_id;
				break;
	        case 'testimonial':
	            echo substr($testimonial,0,300)."..";
	            break;
	        case 'testimonial-client-name':
                echo $client_name;
                echo ! empty( $client_title ) ? "<br>". $client_title : "" ;
	            break; 
	    }
	}

}

#
#	Flush rewrite rules
#	flushes the rules only one time if the slug name of the custom post types has been changed
#
function rt_rewrite_rules(){ 
	if( get_option("rt_rewrite_rules") == "" ){
		add_action('init', 'flush_rewrite_rules');		 
		update_option("rt_rewrite_rules","flushed");
	}
}
add_action('init','rt_rewrite_rules', 1 );

/**
 * Add upload image field to product categories
 * @return html
 */
function rt_taxonomy_add_new_meta_field() {
	?>
	<div class="form-field">
		<label for="rt_product_category_image"><?php _e( 'Category Thumbnail','rt_theme_admin'); ?></label>

		<div class="upload">
			<input name="term_meta[product_category_image]" id="rt_product_category_image" class="upload_field" type="hidden" data-customize-setting-link="rt_product_category_image" autocomplete="off">
			<button class="button icon-upload rttheme_image_upload_button" type="button" data-inputid="rt_product_category_image"><?php _e('Upload','rt_theme_admin'); ?></button>
		</div>

		<div class="uploaded_file taxonomy" data-holderid="rt_product_category_image">
			<img class="loadit" data-image="rt_product_category_image" src="">
			<span class="icon-cancel delete_single" data-inputid="rt_product_category_image" title="<?php _e("remove image","rt_theme_admin"); ?>"></span>
		</div>
	</div>
<?php
} 
add_action( 'product_categories_add_form_fields', 'rt_taxonomy_add_new_meta_field', 10, 2 );

/**
 * Edit upload image field to product categories
 * @return html
 */
function rt_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category Thumbnail', 'rt_theme_admin' ); ?></label></th>
		<td>

			<?php 
				//get the attachment image
				$cat_image_id = esc_attr( $term_meta['product_category_image'] ) ? esc_attr( $term_meta['product_category_image'] ) : "";
			?>
			<div class="upload">
				<input name="term_meta[product_category_image]" id="rt_product_category_image" class="upload_field" type="hidden" data-customize-setting-link="rt_product_category_image" autocomplete="off" value="<?php echo $cat_image_id ?>">
				<button class="button icon-upload rttheme_image_upload_button" type="button" data-inputid="rt_product_category_image"><?php _e('Upload','rt_theme_admin'); ?></button>
			</div>

			<?php
				$cat_image_url = "";
				
				if( $cat_image_id ){
					$get_cat_image = wp_get_attachment_image_src( $cat_image_id, "thumbnail" );
					$cat_image_url = is_array( $get_cat_image ) ? $get_cat_image[0] : "";
				}

				echo ! empty( $cat_image_url ) ? '<div class="uploaded_file visible taxonomy" data-holderid="rt_product_category_image">' : '<div class="uploaded_file taxonomy" data-holderid="rt_product_category_image">' ;
				echo '<img class="loadit" data-image="rt_product_category_image" src="'.$cat_image_url.'">';
				echo '<span class="icon-cancel delete_single" data-inputid="rt_product_category_image" title="'. __("remove image","rt_theme_admin") .'"></span>';
				echo '</div>';
			
			?>
		</td>
	</tr>


<?php
}
add_action( 'product_categories_edit_form_fields', 'rt_taxonomy_edit_meta_field', 10, 2 );

/**
 * Save upload image field to product categories
 * @return void
 */
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_product_categories', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_categories', 'save_taxonomy_custom_meta', 10, 2 );

?>