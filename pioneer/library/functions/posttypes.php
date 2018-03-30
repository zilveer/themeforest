<?php
/**
 *  SETUP CUSTOM POST TYPES
 *
 * These functions create the post-types and taxonomies needed in the theme
 *
 * @ Since ver 1.0
 */


// Add to our admin_init function
add_action('admin_footer', 'epic_quick_edit_javascript');
 
function epic_quick_edit_javascript() {
	global $current_screen;
	if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post')) return; 
 
	?>
	<script type="text/javascript">
	<!--
	function set_inline_sidebar_set(sidebarSet, nonce) {
		// revert Quick Edit menu so that it refreshes properly
		inlineEditPost.revert();
		var sidebarInput = document.getElementById('post_sidebar_set');
		var nonceInput = document.getElementById('epic_sidebar_set_noncename');
		nonceInput.value = nonce;
		// check option manually
		for (i = 0; i < sidebarInput.options.length; i++) {
			if (sidebarInput.options[i].value == sidebarSet) { 
				sidebarInput.options[i].setAttribute("selected", "selected"); 
			} else { sidebarInput.options[i].removeAttribute("selected"); }
		}
	}
	//-->
	</script>
	<?php
}
 
add_filter('post_row_actions', 'epic_expand_quick_edit_link', 10, 2);
 
function epic_expand_quick_edit_link($actions, $post) {
	global $current_screen;
	if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post')) return $actions; 
 
	$nonce = wp_create_nonce( 'post_sidebar_set'.$post->ID);
	$sidebar_id = get_post_meta( $post->ID, 'epic_sidebar', TRUE);	
	$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="';
	$actions['inline hide-if-no-js'] .= esc_attr( __( 'Edit this item inline' ) ) . '" ';
	$actions['inline hide-if-no-js'] .= " onclick=\"set_inline_sidebar_set('{$sidebar_id}', '{$nonce}')\">"; 
	$actions['inline hide-if-no-js'] .= __( 'Quick&nbsp;Edit' );
	$actions['inline hide-if-no-js'] .= '</a>';
	return $actions;	
}
 
// Add to our admin_init function
add_action('quick_edit_custom_box',  'epic_add_quick_edit', 10, 2);
 
function epic_add_quick_edit($column_name, $post_type) {
	global $post;
	if ($column_name != 'sidebar') return;
	?>
    <fieldset class="inline-edit-col-left">
	<div class="inline-edit-col">
		<span class="title">Sidebar</span>
		<input type="hidden" name="epic_sidebar_set_noncename" id="epic_sidebar_set_noncename" value="" />
		<?php 
			
				$generatedSidebars = get_option('sbg_sidebars');
	
				$autoSidebars = array(
							"default_sidebar"  => "Default Sidebar",
							"no_sidebar"  => "No Sidebar",
							);
				$sidebars = array_merge((array)$autoSidebars,(array)$generatedSidebars);

		?>
		<select name="post_sidebar_set" id="post_sidebar_set">
			
			<?php 
				
				
				 $setvalue = get_post_meta($post->ID,'epic_sidebar',true);
				
				 foreach ($sidebars as $sidebarvalue => $sidebarname ) {
				  	
		  
				  echo '<option class="sidebar-option"';
					if($setvalue == $sidebarname){
					  echo 'selected="selected" '; 
					}
				  echo 'value="'.$sidebarname.'" id="'.$sidebarvalue.'">'.$sidebarname.'</option>';
				  
		}
		        ?>
		</select>
	</div>
    </fieldset>
	<?php
} 
 

// Add to our admin_init function
add_action('save_post', 'epic_save_quick_edit_data');
 
function epic_save_quick_edit_data($post_id) {
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	// to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;	
	// Check permissions
	if ( 'page' == isset($_POST['post_type']) ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	}
	
	$post = get_post($post_id);
	if (isset($_POST['post_sidebar_set']) && ($post->post_type != 'revision')) {
		$sidebar = esc_attr(isset($_POST['post_sidebar_set']));
		if ($sidebar)
			update_post_meta( $post_id, 'epic_sidebar', $sidebar);		
		else
			delete_post_meta( $post_id, 'epic_sidebar');		
	}	
	
	//return $sidebar;
		
}


// for post

function epic_AddColumnValue($column_name, $post_id) {
 			
 			if ( 'thumbnail' == $column_name ) {
 				global $post;
				if(has_post_thumbnail($post_id)){
					
					the_post_thumbnail('Admin-thumbnail');
					
				}
			}
			
			if( 'sidebar' == $column_name){
				$sidebar_id = get_post_meta( $post_id, 'epic_sidebar', TRUE);
				
			}
		
			if ( 'exc' == $column_name ) {
			echo get_the_excerpt();
			}	
			
			if ( 'slideshow' == $column_name ) {
			echo get_the_term_list($post_id,'slideshow','',', ','');
			}	
			
			if ( 'showcase' == $column_name ) {
			echo get_the_term_list($post_id,'portfoliocategory','',', ','');
			}	
			
			if ( 'type' == $column_name ) {
			echo get_the_term_list($post_id,'featurescategory','',', ','');
			}	
			
			
			
			if ( 'id' == $column_name ) {
			echo $post_id;
			}	
			
			if ( 'sidebar' == $column_name ) {
			echo $sidebar_id;
			}	
			
}
	
add_action( 'manage_posts_custom_column', 'epic_AddColumnValue', 10, 2 );
add_action( 'manage_pages_custom_column', 'epic_AddColumnValue', 10, 2 );


	
function epic_post_columns($columns){

	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"id" => "Post ID",
		"title" => "Post Title",
		"exc" => "Excerpt",
		"thumbnail" => "Featured image",
		"categories" => "Categories",
		"tags" => "Tags",
		"date" => "Date",
		"author" => "Author",
		"sidebar" => "Sidebar"	
	);
	
return $columns;

}
	
add_filter("manage_edit-post_columns", "epic_post_columns");



function epic_page_columns($columns){

	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Page Title",
		"thumbnail" => "Featured image",
		"exc" => "Excerpt",
		"date" => "Date",
		"author" => "Author",
		"sidebar" => "Sidebar"		
	);
	
return $columns;

}

add_filter("manage_edit-page_columns", "epic_page_columns");



/**
 * PORTFOLIO POST TYPE 
 *
 * @ Since ver. 1.0
 */

// Add post type if not disabled in theme options
if(current_theme_supports('epic_posttype_portfolio')){

function epic_post_type_portfolio() {

	$labels = array(
        'name' => __( 'Cases', 'epic' ), // Tip: _x('') is used for localization
        'singular_name' => __( 'Case', 'epic' ),
        'add_new' => __( 'Add New Case', 'epic' ),
        'add_new_item' => __( 'Add New Case','epic' ),
        'edit_item' => __( 'Edit Case', 'epic' ),
        'all_items' => __( 'All Cases','epic' ),
        'new_item' => __( 'New Case','epic' ),
        'view_item' => __( 'View Cases','epic' ),
        'search_items' => __( 'Search Cases','epic' ),
        'not_found' =>  __( 'No Cases','epic' ),
        'not_found_in_trash' => __( 'No Cases found in Trash','epic' ),
        'parent_item_colon' => ''	
    );
    
	register_post_type('portfolio', 
				array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "project"), // Permalinks
				//'query_var' => "case", // This goes to the WP_Query schema
				'supports' => array('title','author','thumbnail', 'editor' ,'comments','excerpt','custom-fields'),
				'menu_position' => 5,
				'menu_icon' => get_template_directory_uri() .'/library/admin/images/briefcase.png',
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				));
	}	

	$portfoliolabels = array(
        'name' => __( 'Showcases', 'epic' ), // Tip: _x('') is used for localization
        'singular_label' => __( 'Showcase', 'epic' ),
        'add_new' => __( 'Add New Showcase', 'epic' ),
        'add_new_item' => __( 'Add New Showcase','epic' ),
        'edit_item' => __( 'Edit Showcase', 'epic' ),
        'all_items' => __( 'All Showcases','epic' ),
        'new_item' => __( 'New Showcase','epic' ),
        'view_item' => __( 'View Showcase','epic' ),
        'search_items' => __( 'Search Showcases','epic' ),
        'not_found' =>  __( 'No Showcases found','epic' ),
        'parent_item_colon' => ''
    );
	
register_taxonomy("portfoliocategory", 
		array("portfolio"), 
		array("hierarchical" => true, 
			"labels" => $portfoliolabels, 
			"rewrite" => true,
			"show_ui" => true
			)
		);
				
				



	
	
function my_portfolio_columns($columns){
$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Case Title",
		"thumbnail" => "Featured image",
		"exc" => "Excerpt",
		"showcase" => "Showcase"
);
return $columns;
}
	
add_filter("manage_edit-portfolio_columns", "my_portfolio_columns");


add_action('init', 'epic_post_type_portfolio');
}





/* SLIDESHOW POST TYPE */

if(current_theme_supports('epic_posttype_slide')){

function epic_post_type_slide() {


	$labels = array(
        'name' => __( 'Slides', 'epic' ), // Tip: _x('') is used for localization
        'singular_name' => __( 'Slide', 'epic' ),
        'add_new' => __( 'Add New Slide', 'epic' ),
        'add_new_item' => __( 'Add New Slide','epic' ),
        'edit_item' => __( 'Edit Slides', 'epic' ),
        'all_items' => __( 'All Slides','epic' ),
        'new_item' => __( 'New Slide','epic' ),
        'view_item' => __( 'View Slides','epic' ),
        'search_items' => __( 'Search Slides','epic' ),
        'not_found' =>  __( 'No Slides found','epic' ),
        'not_found_in_trash' => __( 'No Slides found in Trash','epic' ),
        'parent_item_colon' => ''
    );



	register_post_type('slide', 
				array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "slide"), // Permalinks
				'query_var' => "slide", // This goes to the WP_Query schema
				'supports' => array('title','author','thumbnail','excerpt'),
				'menu_position' => 5,
				'menu_icon' => get_template_directory_uri() .'/library/admin/images/slide--arrow.png',
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				));
	
	
}

$slideshowlabels = array(
        'name' => __( 'Slideshows', 'epic' ), // Tip: _x('') is used for localization
        'singular_label' => __( 'Slideshow', 'epic' ),
        'add_new' => __( 'Add New Slideshow', 'epic' ),
        'add_new_item' => __( 'Add New Slideshow','epic' ),
        'edit_item' => __( 'Edit Slideshow', 'epic' ),
        'all_items' => __( 'All Slideshows','epic' ),
        'new_item' => __( 'New Slideshow','epic' ),
        'view_item' => __( 'View Slide	show','epic' ),
        'search_items' => __( 'Search Slideshows','epic' ),
        'not_found' =>  __( 'No Slideshows found','epic' ),
        'parent_item_colon' => ''
    );
    
register_taxonomy("slideshow", 
				array("slide"), 
				array("hierarchical" => true, 
						"labels" => $slideshowlabels, 
						"rewrite" => true,
						"show_ui" => true
						)
				);


function my_slides_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Slide Title",
		"thumbnail" => "Featured image",
		"exc" => "Excerpt",
		"slideshow" => "Slideshow"
	);
	return $columns;
}

add_filter("manage_edit-slide_columns", "my_slides_columns");
	

add_action('init', 'epic_post_type_slide');

}







/** 
 * News post type
 *
 * @ Since ver 1.0
 */
 
function epic_post_type_news() {

	$labels = array(
        'name' => __( 'News-articles', 'epic' ), // Tip: _x('') is used for localization
        'singular_name' => __( 'Article', 'epic' ),
        'add_new' => __( 'Add New Article', 'epic' ),
        'add_new_item' => __( 'Add New Article','epic' ),
        'edit_item' => __( 'Edit Article', 'epic' ),
        'all_items' => __( 'All Articles','epic' ),
        'new_item' => __( 'New Article','epic' ),
        'view_item' => __( 'View Article','epic' ),
        'search_items' => __( 'Search Articles','epic' ),
        'not_found' =>  __( 'No Articles','epic' ),
        'not_found_in_trash' => __( 'No Articles found in Trash','epic' ),
        'parent_item_colon' => ''	
    );
    
	register_post_type('news', 
				array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "news-post"), // Permalinks
				'query_var' => "news", // This goes to the WP_Query schema
				'supports' => array('title','author','thumbnail', 'editor', 'excerpt' ,'custom-fields','comments'),
				'menu_position' => 6,
				'menu_icon' => get_template_directory_uri() .'/library/admin/images/blue-document-list.png',
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				)
		);
}

$newslabels = array(
        'name' => __( 'Categories', 'epic' ), // Tip: _x('') is used for localization
        'singular_label' => __( 'Category', 'epic' ),
        'add_new' => __( 'Add New Category', 'epic' ),
        'add_new_item' => __( 'Add New Category','epic' ),
        'edit_item' => __( 'Edit Category', 'epic' ),
        'all_items' => __( 'All Categories','epic' ),
        'new_item' => __( 'New Category','epic' ),
        'view_item' => __( 'View Category','epic' ),
        'search_items' => __( 'Search Categories','epic' ),
        'not_found' =>  __( 'No Categories found','epic' ),
        'parent_item_colon' => ''
    );

register_taxonomy("newscategory", 
				array("news"), 
				array("hierarchical" => true, 
						"labels" => $newslabels, 
						"rewrite" => true,
						"show_ui" => true
				)
		);
		

if(current_theme_supports('epic_posttype_news')){
	add_action('init', 'epic_post_type_news');
}



/* TEASER POST TYPE */
function epic_post_type_teaser() {

	$labels = array(
        'name' => __( 'Teasers', 'epic' ), // Tip: _x('') is used for localization
        'singular_name' => __( 'Teaser', 'epic' ),
        'add_new' => __( 'Add New Teaser', 'epic' ),
        'add_new_item' => __( 'Add New Teaser','epic' ),
        'edit_item' => __( 'Edit Teaser', 'epic' ),
        'all_items' => __( 'All Teasers','epic' ),
        'new_item' => __( 'New Teaser','epic' ),
        'view_item' => __( 'View Teaser','epic' ),
        'search_items' => __( 'Search Teasers','epic' ),
        'not_found' =>  __( 'No Teasers','epic' ),
        'not_found_in_trash' => __( 'No Teasers found in Trash','epic' ),
        'parent_item_colon' => ''	
    );
    
	register_post_type('teaser', 
				array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "teaser"), // Permalinks
				'query_var' => "teaser", // This goes to the WP_Query schema
				'supports' => array('title','author', 'editor'/*,'custom-fields'*/),
				'menu_position' => 4,
				'publicly_queryable' => false,
				'exclude_from_search' => true
				));


}
// Add post type if not disabled in theme options


if(current_theme_supports('epic_posttype_teaser')){
add_action('init', 'epic_post_type_teaser');
}


/* TEASER POST TYPE */
function epic_posttype_testimonial() {

	$labels = array(
        'name' => __( 'Testimonial', 'epic' ), // Tip: _x('') is used for localization
        'singular_name' => __( 'Testimonial', 'epic' ),
        'add_new' => __( 'Add New Testimonial', 'epic' ),
        'add_new_item' => __( 'Add New Testimonial','epic' ),
        'edit_item' => __( 'Edit Testimonial', 'epic' ),
        'all_items' => __( 'All Testimonials','epic' ),
        'new_item' => __( 'New Testimonial','epic' ),
        'view_item' => __( 'View Testimonials','epic' ),
        'search_items' => __( 'Search Testimonials','epic' ),
        'not_found' =>  __( 'No Testimonials','epic' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash','epic' ),
        'parent_item_colon' => ''	
    );
    
	register_post_type('testimonial', 
				array(
				'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array("slug" => "teaser"), // Permalinks
				'query_var' => "teaser", // This goes to the WP_Query schema
				'supports' => array('title','author', 'excerpt'/*,'custom-fields'*/),
				'menu_position' => 6,
				'publicly_queryable' => false,
				'exclude_from_search' => true
				));


}

add_action('init', 'epic_posttype_testimonial');




?>