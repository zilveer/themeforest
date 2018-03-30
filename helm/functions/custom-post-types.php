<?php
/*
* Register Featured Post Manager
*/
add_action('init', 'mtheme_featured_register');
add_action('init', 'mtheme_portfolio_register');//Always use a shortname like "mtheme_" not to see any 404 errors
/*
* Call Initializer and Save options
*/
add_action("admin_init", "admin_init");
add_action('save_post', 'save_options');
/*
* Register Portfolio Post Manager
*/ 
function mtheme_portfolio_register(){
    $args = array(
        'label' => __('Portfolio List'),
        'singular_label' => __('Portfolio'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'menu_position' => 6,
    	'menu_icon' => get_template_directory_uri().'/framework/admin/images/portfolio.png',
        'rewrite' => array('slug' => 'project'),//Use a slug like "work" or "project" that shouldnt be same with your page name
        'supports' => array('title', 'editor', 'thumbnail','comments')//Boxes will be shown in the panel
       );
 
    register_post_type( 'mtheme_portfolio' , $args );
}
/*
* Register Featured Post Manager
*/ 
function mtheme_featured_register(){
    $args = array(
        'label' => __('Featured List','mthemelocal'),
		'description' => __('Manage your Featured posts to display on the Mainpage','mthemelocal'),
        'singular_label' => __('Featured','mthemelocal'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
		'menu_position' => 5,
    	'menu_icon' => get_template_directory_uri().'/framework/admin/images/featured.png',
        'rewrite' => array('slug' => 'featured'),//Use a slug like "work" or "project" that shouldnt be same with your page name
        'supports' => array('title', 'editor', 'thumbnail','comments')//Boxes will be shown in the panel
       );
 
    register_post_type( 'mtheme_featured' , $args );
}

/*
* Initialize Admin Featured Viewable columns
*/
add_filter("manage_edit-mtheme_featured_columns", "mtheme_featured_edit_columns");
add_action("manage_posts_custom_column",  "mtheme_featured_custom_columns");

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
    $caption_alignment="";
    $featured_embedcode="";
	$custom_bg="";
	$featured_link="";
	
	$custom = get_post_custom($post->ID);
    if ( isset($custom["featured_description"][0]) ) { $featured_description = $custom["featured_description"][0]; }
    if ( isset($custom["featured_bigtitle"][0]) ) { $featured_bigtitle = $custom["featured_bigtitle"][0]; }
    if ( isset($custom["featured_embedcode"][0]) ) { $featured_embedcode = $custom["featured_embedcode"][0]; }
	if ( isset($custom["featured_link"][0]) ) { $featured_link = $custom["featured_link"][0]; }
	if ( isset($custom["custom_bg"][0]) ) { $custom_bg = $custom["custom_bg"][0]; }
	
	$sidebar_options=array('Default Sidebar');
	for ($sidebar_count=1; $sidebar_count <=MAX_SIDEBARS; $sidebar_count++ ) {

		if ( of_get_option('theme_sidebar'.$sidebar_count) <> "" ) {
			$active_sidebar = of_get_option('theme_sidebar'.$sidebar_count);
			array_push($sidebar_options, $active_sidebar);
		}
	}
    ?>

    <p><label><h4><?php _e('Caption:','mthemelocal'); ?></h4></label><textarea style="width: 95%;" name="featured_description"><?php if ( isset ($featured_description) ) { echo $featured_description; } ?></textarea></p>
    
    <p><label><h4><?php _e('Big title:','mthemelocal'); ?></h4></label><p class="description">Appears underneath the title and caption text</p><input style="width: 95%;" name="featured_bigtitle" value="<?php if ( isset ($featured_bigtitle) ) { echo $featured_bigtitle; } ?>" /></p>
	
    <p><label><h4><?php _e('Link to:','mthemelocal'); ?></h4></label><input style="width: 95%;" name="featured_link" value="<?php if ( isset ($featured_link) ) { echo $featured_link; } ?>" /></p>
<?php
}



function mtheme_featured_edit_columns($columns){
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __('Featured Title','mthemelocal'),
        "featured_description" => __('Description','mthemelocal'),
		"featured_link" => __('Linked to','mthemelocal'),
		"featured_image" => __('Image','mthemelocal')
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
	
	$sidebar_choice= get_post_meta($post->ID, MTHEME . '_sidebar_choice', true);
	
	$thumbnail = "";
	$video = "";
    $description = "";
	$custom_link = "";
	$portfolio_videoembed="";
	$portfolio_page_header="";
	$portfolio_slide_height="";
	$portfolio_client="";
	$portfolgio_projectlink="";
	
	if ( isset($custom["thumbnail"][0]) ) { $thumbnail = $custom["thumbnail"][0]; }
	if ( isset($custom["video"][0]) ) { $video = $custom["video"][0]; }
    if ( isset($custom["description"][0]) ) { $description = $custom["description"][0]; }
	if ( isset($custom["custom_link"][0]) ) { $custom_link = $custom["custom_link"][0]; }
	if ( isset($custom["portfolio_videoembed"][0]) ) { $portfolio_videoembed = $custom["portfolio_videoembed"][0]; }
	if ( isset($custom["portfolio_page_header"][0]) ) { $portfolio_page_header = $custom["portfolio_page_header"][0]; }
	if ( isset($custom["portfolio_slide_height"][0]) ) { $portfolio_slide_height = $custom["portfolio_slide_height"][0]; }
	if ( isset($custom["portfolio_client"][0]) ) { $portfolio_client = $custom["portfolio_client"][0]; }
	if ( isset($custom["portfolio_projectlink"][0]) ) { $portfolio_projectlink = $custom["portfolio_projectlink"][0]; }
	
	$sidebar_options=array('Default Sidebar');
	for ($sidebar_count=1; $sidebar_count <=MAX_SIDEBARS; $sidebar_count++ ) {

		if ( of_get_option('theme_sidebar'.$sidebar_count) <> "" ) {
			$active_sidebar = of_get_option('theme_sidebar'.$sidebar_count);
			array_push($sidebar_options, $active_sidebar);
		}
	}
    ?>
	
	<label><h1><?php _e('Thumbnail gallery options','mthemelocal'); ?></h1></label>
	
    <p><label><h4><?php _e('Description:','mthemelocal'); ?></h4></label><textarea style="width: 95%;" name="description"><?php echo $description; ?></textarea></p>
	
	<p>
	<label>
	<h4><?php _e('Client ( optional )','mthemelocal'); ?></h4>
	</label>
	<p class="description">Client Name</p>
	<input style="width: 95%;" name="portfolio_client" value="<?php if ( isset ($portfolio_client) ) { echo $portfolio_client; } ?>" />
	</p>
	
	<p>
	<label>
	<h4><?php _e('Project Link ( optional )','mthemelocal'); ?></h4>
	</label>
	<p class="description">Project Link</p>
	<input style="width: 95%;" name="portfolio_projectlink" value="<?php if ( isset ($portfolio_projectlink) ) { echo $portfolio_projectlink; } ?>" />
	</p>
	
<p><label><h4><?php _e('Optional Thumbnail:','mthemelocal'); ?></h4></label>
<p class="description"><?php _e('Please provide optional thumbnail image path for your portfolio thumbnails. If empty the featured image attached will be used to show the thumbnail. <br/>','mthemelocal');?></p>
<input style="width: 95%;" name="thumbnail" value="<?php echo $thumbnail; ?>" />
</p>
	
	<p><label><h4><?php _e('Video URL:','mthemelocal'); ?></h4></label>
	<p class="description"><?php _e('Eg.<br/>http://www.youtube.com/watch?v=D78TYCEG4<br/>http://vimeo.com/172881<br/>http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&height=294','mthemelocal');?></p>
	<input style="width: 95%;" name="video" value="<?php echo $video; ?>" />
	</p>
	
	<p>
	<label>
	<h4><?php _e('Link to ( optional )','mthemelocal'); ?></h4>
	</label>
	<p class="description">This option will redirect to the given url instead of Portfolio page.</p>
	<input style="width: 95%;" name="custom_link" value="<?php if ( isset ($custom_link) ) { echo $custom_link; } ?>" />
	</p>
	
	<label><h1><?php _e('Portfolio details page options','mthemelocal'); ?></h1></label>

	<?php
	echo '<p>';
	echo '<label><h4>Portfolio Page header displays</h4></label>';
	echo '<p class="description">Portfolio page header. Slideshow is generated from image attachments inside the portfolio page.</p>';
	echo '<select name="portfolio_page_header" id="portfolio_page_header">';
	echo '<option', $portfolio_page_header == "None" ? ' selected="selected"' : '', '>None</option>';
	echo '<option', $portfolio_page_header == "Image" ? ' selected="selected"' : '', '>Image</option>';
	echo '<option', $portfolio_page_header == "Slideshow" ? ' selected="selected"' : '', '>Slideshow</option>';
	echo '<option', $portfolio_page_header == "Video Embed" ? ' selected="selected"' : '', '>Video Embed</option>';
	echo '</select>';
	echo '</p>';
	?>
	
	<p>
	<label>
	<h4><?php _e('Video Embed Code','mthemelocal'); ?></h4>
	</label>
	<p class="description">Video embed code which displays any embed code video in the page header ( ideal width is 650px )</p>
	<textarea style="width: 95%;" name="portfolio_videoembed"><?php echo $portfolio_videoembed; ?></textarea>
	</p>
	
<?php
}

/*
* Save the Meta functions - Combined Featured and Portfolio
*/
 
function save_options(){
    global $post;
    
    
    if ( isset($_POST["featured_description"]) ) { update_post_meta($post->ID, "featured_description", $_POST["featured_description"]); }
    if ( isset($_POST["featured_embedcode"]) ) { update_post_meta($post->ID, "featured_embedcode", $_POST["featured_embedcode"]); }
	if ( isset($_POST["featured_link"]) ) { update_post_meta($post->ID, "featured_link", $_POST["featured_link"]); }
	if ( isset($_POST["featured_bigtitle"]) ) { update_post_meta($post->ID, "featured_bigtitle", $_POST["featured_bigtitle"]); }
	
	//Portfolio Data	
	if ( isset($_POST["thumbnail"]) ) { update_post_meta($post->ID, "thumbnail", $_POST["thumbnail"]); }
	if ( isset($_POST["video"]) ) { update_post_meta($post->ID, "video", $_POST["video"]); }
	if ( isset($_POST["portfolio_videoembed"]) ) { update_post_meta($post->ID, "portfolio_videoembed", $_POST["portfolio_videoembed"]); }
    if ( isset($_POST["description"]) ) { update_post_meta($post->ID, "description", $_POST["description"]); }
	if ( isset($_POST["custom_link"]) ) { update_post_meta($post->ID, "custom_link", $_POST["custom_link"]); }
	if ( isset($_POST["portfolio_page_header"]) ) { update_post_meta($post->ID, "portfolio_page_header", $_POST["portfolio_page_header"]); }
	if ( isset($_POST["portfolio_slide_height"]) ) { update_post_meta($post->ID, "portfolio_slide_height", $_POST["portfolio_slide_height"]); }
	if ( isset($_POST["portfolio_client"]) ) { update_post_meta($post->ID, "portfolio_client", $_POST["portfolio_client"]); }
	if ( isset($_POST["portfolio_projectlink"]) ) { update_post_meta($post->ID, "portfolio_projectlink", $_POST["portfolio_projectlink"]); }
	if ( isset($_POST[MTHEME . '_sidebar_choice']) ) { update_post_meta($post->ID, MTHEME . '_sidebar_choice', $_POST[MTHEME . '_sidebar_choice']); }
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