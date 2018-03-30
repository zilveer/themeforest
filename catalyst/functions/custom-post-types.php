<?php
/*
* Register Featured Post Manager
*/
add_action('init', 'mtheme_featured_register');
 
function mtheme_featured_register(){
    $args = array(
        'label' => __('Featured List'),
		'description' => __('Manage your Featured posts to display on the Mainpage'),
        'singular_label' => __('Featured'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'menu_position' => 5,
    	'menu_icon' => get_bloginfo('template_url').'/framework/admin/images/featured.png',
        'rewrite' => array('slug' => 'featured'),//Use a slug like "work" or "project" that shouldnt be same with your page name
        'supports' => array('title', 'editor', 'thumbnail','comments')//Boxes will be shown in the panel
       );
 
    register_post_type( 'mtheme_featured' , $args );
}

/*
* Register Popular Post Manager
*/
add_action('init', 'mtheme_portfolio_register');//Always use a shortname like "mtheme_" not to see any 404 errors
 
function mtheme_portfolio_register(){
    $args = array(
        'label' => __('Portfolio List'),
        'singular_label' => __('Portfolio'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'menu_position' => 6,
    	'menu_icon' => get_bloginfo('template_url').'/framework/admin/images/portfolio.png',
        'rewrite' => array('slug' => 'project'),//Use a slug like "work" or "project" that shouldnt be same with your page name
        'supports' => array('title', 'editor', 'thumbnail','comments')//Boxes will be shown in the panel
       );
 
    register_post_type( 'mtheme_portfolio' , $args );
}
 
/*
* Call Initializer and Save options
*/
add_action("admin_init", "admin_init");
add_action('save_post', 'save_options');

/*
* Call Meta functions
*/
function admin_init(){
    add_meta_box("mtheme_featured-meta", "Featured Options", "featured_options", "mtheme_featured", "normal", "low");
	add_meta_box("mtheme_portfolioInfo-meta", "Portfolio Options", "meta_options", "mtheme_portfolio", "normal", "low");
}


/*
* Featured Meta Options
*/

function featured_options(){
    global $post;
    $featured_description="";
	$featured_link="";
	
	$custom = get_post_custom($post->ID);
    if ( isset($custom["featured_description"][0]) ) { $featured_description = $custom["featured_description"][0]; }
	if ( isset($custom["featured_link"][0]) ) { $featured_link = $custom["featured_link"][0]; }
    ?>
    <p><label><h4><?php _e('Description:','mthemelocal'); ?></h4></label><textarea style="width: 95%;" name="featured_description"><?php if ( isset ($featured_description) ) { echo $featured_description; } ?></textarea></p>
    <p><label><h4><?php _e('Link to ( optional ):','mthemelocal'); ?></h4></label><input style="width: 95%;" name="featured_link" value="<?php if ( isset ($featured_link) ) { echo $featured_link; } ?>" /></p>
<?php
}

/*
* Initialize Admin Featured Viewable columns
*/
add_filter("manage_edit-mtheme_featured_columns", "mtheme_featured_edit_columns");
add_action("manage_posts_custom_column",  "mtheme_featured_custom_columns");

function mtheme_featured_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Featured Title'),
        "featured_description" => __('Description'),
		"featured_link" => __('Linked to'),
		"featured_image" => __('Image')
    );
 
    return $columns;
}


/*
* Display Admin Featured Columns
*/

function mtheme_featured_custom_columns($column){
    global $post;
    $custom = get_post_custom();
	$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) );
	
	$full_image_id = get_post_thumbnail_id(($post->ID), 'full'); 
	$full_image_url = wp_get_attachment_image_src($full_image_id,'full');  
	$full_image_url = $full_image_url[0];
	
    switch ($column)
    {
        case "featured_image":
			if ( isset($image_url) ) {
            echo '<a class="thickbox" href="'.$full_image_url.'"><img src="'.$image_url.'" width="40px" height="40px" alt="featured" /></a>';
			} else {
			echo 'Image not found';
			}
            break;
        case "featured_description":
            if ( isset($custom["featured_description"][0]) ) {echo $custom["featured_description"][0]; }
            break;
        case "featured_link":
            if ( isset($custom["featured_link"][0]) ) { echo $custom["featured_link"][0]; }
            break;
    } 
}

/*
* Meta options for Portfolio post type
*/
 
function meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
	
	$thumbnail = "";
	$video = "";
    $description = "";
	
	if ( isset($custom["thumbnail"][0]) ) { $thumbnail = $custom["thumbnail"][0]; }
	if ( isset($custom["video"][0]) ) { $video = $custom["video"][0]; }
    if ( isset($custom["description"][0]) ) { $description = $custom["description"][0]; }
    ?>
    <p><label><h4><?php _e('Description:','mthemelocal'); ?></h4></label><textarea style="width: 95%;" name="description"><?php echo $description; ?></textarea></p>
	<p><label><h4><?php _e('Optional Thumbnail:','mthemelocal'); ?></h4></label>
	<p class="description"><?php _e('Please provide optional thumbnail image path for your portfolio thumbnails. If empty the featured image attached will be cropped to show the thumbnail. <br/><strong>Small Portfolio thumbnail size</strong> 260px x 150px<br/><strong>Large Portfolio thumbnail size</strong> 410px x 272px<br/><strong>Biggest Portfolio thumbnail size</strong> 560px x 472px','mthemelocal');?></p>
	<input style="width: 95%;" name="thumbnail" value="<?php echo $thumbnail; ?>" />
	</p>
	<p><label><h4><?php _e('Video URL:','mthemelocal'); ?></h4></label>
	<p class="description"><?php _e('Eg.<br/>http://www.youtube.com/watch?v=D78TYCEG4<br/>http://vimeo.com/172881','mthemelocal');?></p>
	<input style="width: 95%;" name="video" value="<?php echo $video; ?>" />
	</p>
<?php
}

/*
* Save the Meta functions - Combined Featured and Portfolio
*/
 
function save_options(){
    global $post;
	
    if ( isset($_POST["featured_description"]) ) { update_post_meta($post->ID, "featured_description", $_POST["featured_description"]); }
	if ( isset($_POST["featured_link"]) ) { update_post_meta($post->ID, "featured_link", $_POST["featured_link"]); }
	
	if ( isset($_POST["thumbnail"]) ) { update_post_meta($post->ID, "thumbnail", $_POST["thumbnail"]); }
	if ( isset($_POST["video"]) ) { update_post_meta($post->ID, "video", $_POST["video"]); }
    if ( isset($_POST["description"]) ) { update_post_meta($post->ID, "description", $_POST["description"]); }
}
 
/*
* Add Taxonomy for Portfolio 'Type'
*/
register_taxonomy("types", array("mtheme_portfolio"), array("hierarchical" => true, "label" => "Work Type", "singular_label" => "Types", "rewrite" => true));
 
/*
* Hooks for the Portfolio and Featured viewables
*/
add_filter("manage_edit-mtheme_portfolio_columns", "mtheme_portfolio_edit_columns");
add_action("manage_posts_custom_column",  "mtheme_portfolio_custom_columns");

function mtheme_portfolio_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Portfolio Title'),
        "description" => __('Description'),
		"video" => __('Video'),
        "types" => __('Types'),
		"portfolio_image" => __('Image')
    );
 
    return $columns;
}

/*
* Portfolio Admin columns
*/
 
function mtheme_portfolio_custom_columns($column){
    global $post;
    $custom = get_post_custom();
	$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) );
	
	$full_image_id = get_post_thumbnail_id(($post->ID), 'full'); 
	$full_image_url = wp_get_attachment_image_src($full_image_id,'full');  
	$full_image_url = $full_image_url[0];

    switch ($column)
    {
        case "portfolio_image":
			if ( isset($image_url) ) {
            echo '<a class="thickbox" href="'.$full_image_url.'"><img src="'.$image_url.'" width="40px" height="40px" alt="featured" /></a>';
			} else {
			echo __('Image not found','mthemelocal');
			}
            break;
        case "description":
            if ( isset($custom["description"][0]) ) { echo $custom["description"][0]; }
            break;
        case "video":
            if ( isset($custom["video"][0]) ) { echo $custom["video"][0]; }
            break;
        case "types":
            echo get_the_term_list($post->ID, 'types', '', ', ','');
            break;
    } 
}
?>