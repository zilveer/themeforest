<?php

/**
 * Custom types name
 */
//define('TYPE_PORTFOLIO', 'yiw_portfolio');       
define('TYPE_GALLERY', 'yiw_gallery');
//define('TYPE_SERVICES', 'bl_services');
define('TYPE_TESTIMONIALS', 'bl_testimonials');
define('TYPE_FAQ', 'bl_faq');

add_action( 'init', 'yiw_register_post_types', 0  );
add_action( 'init', 'yiw_register_taxonomies', 0  );
//add_action( 'admin_init', 'flush_rewrite_rules' );

if( isset( $_GET['post_type'] ) )
{
    switch( $_GET['post_type'] )
    {
        case TYPE_TESTIMONIALS :
                add_action( 'manage_posts_custom_column',  'yiw_bl_testimonials_custom_columns');
                add_filter( 'manage_edit-'.TYPE_TESTIMONIALS.'_columns', 'yiw_bl_testimonials_edit_columns');
        break;           

        case TYPE_FAQ :
                add_action( 'manage_posts_custom_column',  'yiw_bl_faq_custom_columns');
                add_filter( 'manage_edit-'.TYPE_FAQ.'_columns', 'yiw_bl_faq_edit_columns'); 
        break;    
        
// 	case TYPE_TEAM :
// 		add_action( 'manage_posts_custom_column',  'yiw_'.TYPE_TEAM.'_custom_columns');
// 		add_filter( 'manage_edit-'.TYPE_TEAM.'_columns', 'yiw_'.TYPE_TEAM.'_edit_columns');
// 	break;

// 	case TYPE_PORTFOLIO :
// 		add_action( 'manage_posts_custom_column',  'yiw_'.TYPE_PORTFOLIO.'_custom_columns');
// 		add_filter( 'manage_edit-'.TYPE_PORTFOLIO.'_columns', 'yiw_'.TYPE_PORTFOLIO.'_edit_columns'); 
// 	break;          
// 			
	case TYPE_GALLERY :
		add_action( 'manage_posts_custom_column',  'yiw_gallery_custom_columns');
		add_filter( 'manage_edit-'.TYPE_GALLERY.'_columns', 'yiw_gallery_edit_columns'); 
	break;  
 
    }
}

/**
 * Register post types for the theme
 *
 * @return void
 */
function yiw_register_post_types(){
  
    register_post_type(         
        TYPE_TESTIMONIALS,
        array(
          'description' => __('Testimonals', 'yiw'),
          'exclude_from_search' => false,
          'show_ui' => true,
          'labels' => yiw_label( apply_filters( 'yiw_testimonials_label_singular', __('Testimonial', 'yiw') ), apply_filters( 'yiw_testimonials_label_plural', __('Testimonials', 'yiw') ) ),
          'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
          'public' => true,     
		  'show_in_nav_menus' => false,
          'capability_type' => 'post',
          'publicly_queryable' => true,
          'rewrite' => array( 'slug' => apply_filters( 'yiw_testimonial_rewrite', 'post/testimonials' ), 'with_front' => true )
        )
    ); 
    
    register_post_type(         
        TYPE_FAQ,
        array(
            'description' => __('Faq', 'yiw'),
            'exclude_from_search' => false,
            'show_ui' => true,
            'labels' => yiw_label(__('Faq', 'yiw'), __('Faqs', 'yiw')),
            'supports' => array( 'title', 'editor', 'revisions' ),
            'public' => true,             
			'show_in_nav_menus' => false,
            'capability_type' => 'page',
            'publicly_queryable' => true,
            'rewrite' => array( 'slug' => apply_filters( 'yiw_faq_rewrite', TYPE_FAQ ), 'with_front' => true )
        )
    );
                
   register_post_type(         
       TYPE_GALLERY,
       array(
         'description' => __('Gallery', 'yiw'),
         'exclude_from_search' => false,
         'show_ui' => true,
         'labels' => yiw_label( apply_filters( 'yiw_gallery_label_singular', __('Photo', 'yiw') ), apply_filters( 'yiw_gallery_label_plural', __('Photos', 'yiw') ), __('Gallery', 'yiw') ),
         'supports' => array( 'title', 'editor', 'thumbnail' ),
         'public' => true,
         'capability_type' => 'post',
         'publicly_queryable' => true,
         'rewrite' => array( 'slug' => apply_filters( 'yiw_gallery_rewrite', 'post/gallery' ), 'with_front' => true )
       )
   ); 
//  
//    register_post_type(         
//        TYPE_SERVICES,
//        array(
//          'description' => __('Services', 'yiw'),
//          'exclude_from_search' => false,
//          'show_ui' => true,
//          'labels' => yiw_label( apply_filters( 'yiw_services_label_singular', __('Service', 'yiw') ), apply_filters( 'yiw_services_label_plural', __('Services', 'yiw')), __('Services', 'yiw')),
//          'supports' => array( 'title', 'editor', 'thumbnail' ),
//          'public' => true,
//          'capability_type' => 'post',
//          'publicly_queryable' => true,
//          'rewrite' => array( 'slug' => apply_filters( 'yiw_service_rewrite', 'post/services' ), 'with_front' => true )
//        )
//    ); 
            
    //flush_rewrite_rules();
    
    yiw_register_dymanics_types();
    
}        


/**
 * Registers dynamic custom types and taxonomies
 */
function yiw_register_dymanics_types()
{
    $features_tabs = yiw_get_list_features_tabs();

    if ( ! is_array( $features_tabs ) || empty( $features_tabs ) )
        return;
    
	foreach( $features_tabs as $post_type => $name )
	{
		register_post_type(         
	        str_replace( ' ', '_', $post_type ),
	        array(
                          'description' => __('The post type for the content of accordion sliders', 'yiw'),
			  'exclude_from_search' => false,
			  'show_ui' => true,
			  'label' => $name,
			  'supports' => array( 'title', 'editor', 'thumbnail' ),
			  'public' => true,
			  'show_in_nav_menus' => false,
			  'capability_type' => 'post',
                          'publicly_queryable' => true,
			  'rewrite' => array( 'slug' => str_replace( ' ', '_', $post_type ), 'with_front' => true )
	        )
	    );    
		
		//add_filter( 'manage_edit-'.$name_post_type.'_columns', 'yiw_yiw_team_edit_columns');
	}                             
                                        
	//flush_rewrite_rules();
}  

/**
 * Registers taxonomies
 * 
 */
function yiw_register_taxonomies()
{   
    register_taxonomy('category-faq', array( TYPE_FAQ ), array(
        'hierarchical' => true,
        'labels' => yiw_label_tax(__('Faq Category', 'yiw'), __('Faq Categories', 'yiw')),
        'show_ui' => true, 
		'show_in_nav_menus' => false,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'faq/category', 'with_front' => false )
    ));
    
    
    /*
    register_taxonomy('category-project', array( TYPE_PORTFOLIO ), array(
        'hierarchical' => true,
        'labels' => yiw_label_tax(__('Category', 'yiw'), __('Categories', 'yiw')),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'project/category', 'with_front' => false )
    ));
    register_taxonomy('team-profile', array( TYPE_TEAM ), array(
        'hierarchical' => true,
        'labels' => yiw_label_tax(__('Profile', 'yiw'), __('Profiles', 'yiw')),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'team/profile', 'with_front' => false )
    ));
    */
    register_taxonomy('category-photo', array( TYPE_GALLERY ), array(
        'hierarchical' => true,
        'labels' => yiw_label_tax(__('Category', 'yiw'), __('Categories', 'yiw')),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => apply_filters( 'yiw_category_photo_rewrite', 'photo/category' ), 'with_front' => false )
    ));
   register_taxonomy('category-testimonial', array( TYPE_TESTIMONIALS ), array(
        'hierarchical' => true,
        'labels' => yiw_label_tax(__('Category', 'yiw'), __('Categories', 'yiw')),
        'show_ui' => true,
        'query_var' => true,
    'rewrite' => array( 'slug' => apply_filters( 'yiw_category_testimonial_rewrite', 'testimonial/category' ), 'with_front' => false )

    ));
}    


         

/**
 * Create a custom fields for custom types
 */           
 
 
/**
 * testimonials
 */
function yiw_bl_testimonials_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __( "Name", 'yiw' ),
        "image" => __( "Image", 'yiw' ),
        "story" => __( "Story", 'yiw' ),
        "website" => __( "Web Site", 'yiw' ),
        "link" => __("Allow Link", 'yiw'),
  "category-testimonial" => __( 'Category testimonial', 'yiw' )
    );
    
    return $columns;
}

function yiw_bl_testimonials_custom_columns($column){
    global $post;
                                          
    switch ($column) {
        case "story":                      
            add_filter('excerpt_length', 'yiw_new_excerpt_length_testimonial');
            add_filter('excerpt_more', 'yiw_new_excerpt_more_testimonial');
            the_excerpt();     
            break;
        case "image":
            the_post_thumbnail( 'thumb_testimonial' );
            break;
        case "website":
            $url = get_post_meta( $post->ID, '_testimonial_website', true );
            echo "<a href=\"" . esc_url( $url ) . "\">$url</a>";
            break;
        case "link":
            $allow_link = get_post_meta( $post->ID, '_testimonial_link', true );
            echo ($allow_link == 1) ? "yes" : "no"; 
            break;
        case "category-testimonial":
            $allow_link = get_post_meta( $post->ID, '_testimonial_link', true );
            echo get_the_term_list($post->ID, 'category-testimonial', '', ', ','');
            break;
    }                                  

}                     
    
function yiw_new_excerpt_length_testimonial($length) {
    return 20;
}                                
    
function yiw_new_excerpt_more_testimonial($more) {
    return '[...]';
} 
 
 
/**
 * yiw_team
 */
function yiw_yiw_team_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __( "Name", 'yiw' ),
        "photo" => __( "Photo", 'yiw' ),
        "description" => __( "Description", 'yiw' ),
        "profile" => __( "Profile", 'yiw' )
    );
    
    return $columns;
}

function yiw_yiw_team_custom_columns($column){
    global $post;
    
    switch ($column) {
        case "description":
          the_excerpt();
          break;
        case "photo":
          the_post_thumbnail('team-thumb');
          break;
        case "profile": 
          echo get_the_term_list($post->ID, 'team-profile', '', ', ','');     
          break;
    }
}
 
 
/**
 * yiw_portfolio
 */
function yiw_yiw_portfolio_edit_columns($columns){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Portfolio Title', 'yiw' ),
        'description-portfolio' => __( 'Description', 'yiw' ),
        //'year' => __( 'Year Completed', 'yiw' ),
        'category-project' => __( 'Category Project', 'yiw' ),
    );

    
    return $columns;
}

function yiw_yiw_portfolio_custom_columns($column){
    global $post;
                                          
    switch ($column) {
        case "description-portfolio":
          the_excerpt();
          break;
        case "year":
          $custom = get_post_custom();
          echo $custom["year_completed"][0];
          break;
        case "category-project":
          echo get_the_term_list($post->ID, 'category-project', '', ', ','');
          break;
    }                            

}   

/**
 * faq
 */
function yiw_bl_faq_edit_columns($columns){
	$columns = array(
	    'cb' => '<input type="checkbox" />',
	    'title' => __( 'Question', 'yiw' ),
	    'description' => __( 'Answer', 'yiw' ),
            'category-faq' => __( 'FAQ Category', 'yiw' ),
	);

	
	return $columns;
}

function yiw_bl_faq_custom_columns($column){
	global $post;
	                                      
	switch ($column) {
	    case "description":
	      	add_filter('excerpt_length', 'yiw_new_excerpt_length_bl_faq');
                add_filter('excerpt_more', 'yiw_new_excerpt_more_bl_faq');
		the_excerpt();
                break;
            case "category-faq":
                echo get_the_term_list($post->ID, 'category-faq', '', ', ','');
                break;
	}                            
}	      	                  
	
function yiw_new_excerpt_length_bl_faq($length) {
	return 20;
}                                
	
function yiw_new_excerpt_more_bl_faq($more) {
	return '[...]';
}     
 
 
/**
 * yiw_gallery
 */
function yiw_gallery_edit_columns($columns){
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __( 'Photo Title', 'yiw' ),
        'photo' => __( 'Photo', 'yiw' ),
        'category-photo' => __( 'Category Photo', 'yiw' ),
    );

    
    return $columns;
}

function yiw_gallery_custom_columns($column){
    global $post;
                                          
    switch ($column) {
        case "photo":
          the_post_thumbnail( array( 70, 70 ) );
          break;
        case "category-photo":
          echo get_the_term_list($post->ID, 'category-photo', '', ', ','');
          break;
    }                            

}   

function yiw_yiw_services_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __( "Name", 'yiw' ),
    );
    return $columns;
}


function yiw_yiw_news_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __( "Name", 'yiw' ),
    );
    return $columns;
}

function yiw_yiw_services_custom_columns($column){
    global $post;                            
}

function yiw_yiw_news_custom_columns($column){
    global $post;                            
}


add_action( 'admin_head', 'yiw_admin_style' );
function yiw_admin_style() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-team .wp-menu-image {
            background:transparent url('<?php echo home_url();?>/wp-admin/images/menu.png') no-repeat scroll -301px -33px !important;
        }
        #menu-posts-team:hover .wp-menu-image, #menu-posts-team.wp-has-current-submenu .wp-menu-image {
            background-position:-301px -1px!important;
        }
        #menu-posts-yiwportfolio .wp-menu-image, #menu-posts-yiwgallery .wp-menu-image {
            background:transparent url('<?php echo home_url();?>/wp-admin/images/menu.png') no-repeat scroll -1px -33px !important;
        }
        #menu-posts-yiwportfolio:hover .wp-menu-image, #menu-posts-yiwportfolio.wp-has-current-submenu .wp-menu-image,
        #menu-posts-yiwgallery:hover .wp-menu-image, #menu-posts-yiwgallery.wp-has-current-submenu .wp-menu-image {
            background-position:-1px -1px!important;
        }
    </style>
<?php } 



/**
 * Return Labels Post
 *
 * @return array
 */
function yiw_label($singular_name, $name, $title = FALSE)
{
    if( !$title )
        $title = $name;
        
    return array(
      "name" => $title,
      "singular_name" => $singular_name,
      "add_new" => __("Add New", 'yiw'),
      "add_new_item" => sprintf( __( "Add New %s", 'yiw' ), $singular_name),
      "edit_item" => sprintf( __( "Edit %s", 'yiw' ), $singular_name),
      "new_item" => sprintf( __( "New %s", 'yiw'), $singular_name),
      "view_item" => sprintf( __( "View %s", 'yiw'), $name),
      "search_items" => sprintf( __( "Search %s", 'yiw'), $name),
      "not_found" => sprintf( __( "No %s found", 'yiw'), $name),
      "not_found_in_trash" => sprintf( __( "No %s found in Trash", 'yiw'), $name),
      "parent_item_colon" => ""
  );
}            

/**
 * Return Labels Post
 *
 * @return array
 */
function yiw_label_tax($singular_name, $name)
{
    return array(
        'name' => $name,
        'singular_name' => $singular_name,
        'search_items' => sprintf( __( 'Search %s', 'yiw' ), $name),
        'all_items' => sprintf( __( 'All %s', 'yiw' ), $name),
        'parent_item' => sprintf( __( 'Parent %s', 'yiw' ), $singular_name),
        'parent_item_colon' => sprintf( __( 'Parent %s:', 'yiw' ), $singular_name),
        'edit_item' => sprintf( __( 'Edit %', 'yiw' ), $singular_name), 
        'update_item' => sprintf( __( 'Update %s', 'yiw' ), $singular_name),
        'add_new_item' => sprintf( __( 'Add New %s', 'yiw' ), $singular_name),
        'new_item_name' => sprintf( __( 'New %s Name', 'yiw' ), $singular_name),
        'menu_name' => $name,
  );
}