<?php
/*---------------------------------------------------------------------------------*/
/* Portfolio Custom Post Type */
/*---------------------------------------------------------------------------------*/
add_action('init', 'portfolio_register');
 
function portfolio_register() {
 
	$labels = array(
		'name' => _x('My Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio Item', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio item'),
		'add_new_item' => __('Add New Portfolio Item'),
		'edit_item' => __('Edit Portfolio Item'),
		'new_item' => __('New Portfolio Item'),
		'view_item' => __('View Portfolio Item'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_bloginfo('template_directory') . '/images/tt_logo.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'portfolio' , $args );
}
//register a custom taxonomy for portfolio
register_taxonomy("skills", array("portfolio"), array("hierarchical" => true, "label" => "Skills", "singular_label" => "Skill", "rewrite" => true));

add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("credits_meta", "Theme Team Custom Portfolio Options", "credits_meta", "portfolio", "normal", "low");
}
 
function credits_meta() {
  global $post;
  $custom = get_post_custom($post->ID);
  //$year_completed = $custom["year_completed"][0];
  //$website_url = $custom["website_url"][0];
  $themeteam_image_upload = $custom["themeteam_image_upload"][0];
  $themeteam_video_embed = $custom["themeteam_video_embed"][0];
  
  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'themeteam_portfolio' );
  
  ?>
  <style type="text/css">
	.input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
	.input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
	.input_checkbox { margin:0 10px 0 0; }
	.spacer { display: block; height:5px}
	.metabox_desc { font-size:10px; color:#aaa; display:block}
	.metaboxes{ border-collapse:collapse; width:100%}
	.metaboxes tr:hover th,
	.metaboxes tr:hover td { background:#f8f8f8}
	.metaboxes th,
	.metaboxes td{ border-bottom:1px solid #ddd; padding:10px 10px;text-align: left; vertical-align:top}
	.metabox_th { width:20%}
	.input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}
  </style>
  <table class="metaboxes">
  	<!--<tr>
  		<th class="metabox_th"><label for="year_completed">Year Completed:</label></th>
  		<td><input class="input_text" type="text" name="year_completed" id="year_completed" value="<-?php echo $year_completed; ?>"/>
  		<span class="metabox_desc">Enter the Year it was completed</span></td>
  		<td></td>
  	</tr>
	<tr>
  		<th class="metabox_th"><label for="website_url">Website URL:</label></th>
  		<td><input class="input_text" type="text" name="website_url" id="website_url" value="<-?php echo $website_url; ?>"/>
  		<span class="metabox_desc">Enter the url of the portfolio piece.</span></td>
  		<td></td>
  	</tr>-->
    <tr>
    	<th class="metabox_th"><label for="themeteam_video_embed">Video URL</label></th>
    	<td>
		<input class="input_text" type="text" name="themeteam_video_embed" id="themeteam_video_embed" value="<?php echo $themeteam_video_embed; ?>"/>
    	<span class="metabox_desc">Place the url for your video.</span></td>
    	<td></td>
    </tr>
  </table>
  <?php
}

add_action('save_post', 'save_details');

function save_details(){
  global $post;
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['themeteam_portfolio'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
 
  //update_post_meta($post->ID, "year_completed", $_POST["year_completed"]);
  //update_post_meta($post->ID, "website_url", $_POST["website_url"]);
  update_post_meta($post->ID, "themeteam_video_embed" , $_POST["themeteam_video_embed"]);
}

add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-portfolio_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Portfolio Title",
    "description" => "Description",
    "year" => "Year Completed",
    "skills" => "Skills",
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "year":
      $custom = get_post_custom();
      echo $custom["year_completed"][0];
      break;
    case "skills":
      echo get_the_term_list($post->ID, 'skills', '', ', ','');
      break;
  }
}

/*---------------------------------------------------------------------------------*/
/* Testimonials Custom Post Type */
/*---------------------------------------------------------------------------------*/
add_action('init', 'testimonial_register');
 
function testimonial_register() {
 
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'testimonial item'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonial'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_bloginfo('template_directory') . '/images/tt_logo.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'testimonial' , $args );
}

add_action("admin_init", "admin_init_testimonial");
 
function admin_init_testimonial(){
  add_meta_box("credits_meta_testimonial", "Theme Team Custom Testimonial Options", "credits_meta_testimonial", "testimonial", "normal", "low");
}
 
function credits_meta_testimonial() {
  global $post;
  $custom = get_post_custom($post->ID);
  $testimonial_name = $custom["testimonial_name"][0];
  $testimonial_url = $custom["testimonial_url"][0];
  $testimonial_header = $custom["testimonial_header"][0];
  $testimonial_excerpt = $custom["testimonial_excerpt"][0];
  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'themeteam_testimonial' );
  
  ?>
  <style type="text/css">
	.input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
	.input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
	.input_checkbox { margin:0 10px 0 0; }
	.spacer { display: block; height:5px}
	.metabox_desc { font-size:10px; color:#aaa; display:block}
	.metaboxes{ border-collapse:collapse; width:100%}
	.metaboxes tr:hover th,
	.metaboxes tr:hover td { background:#f8f8f8}
	.metaboxes th,
	.metaboxes td{ border-bottom:1px solid #ddd; padding:10px 10px;text-align: left; vertical-align:top}
	.metabox_th { width:20%}
	.input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}
  </style>
  <table class="metaboxes">
  	<tr>
  		<th class="metabox_th"><label for="testimonial_header">Testimonial Header Text:</label></th>
  		<td><input class="input_text" type="text" name="testimonial_header" id="testimonial_header" value="<?php echo $testimonial_header; ?>"/>
  		<span class="metabox_desc">Enter the text for the custom header</span></td>
  		<td></td>
  	</tr>
  	<tr>
  		<th class="metabox_th"><label for="testimonial_name">Testimonial Name:</label></th>
  		<td><input class="input_text" type="text" name="testimonial_name" id="testimonial_name" value="<?php echo $testimonial_name; ?>"/>
  		<span class="metabox_desc">Enter the Name of the person giving the testimonial</span></td>
  		<td></td>
  	</tr>
  	<tr>
  		<th class="metabox_th"><label for="testimonial_url">Testimonial URL:</label></th>
  		<td><input class="input_text" type="text" name="testimonial_url" id="testimonial_url" value="<?php echo $testimonial_url; ?>"/>
  		<span class="metabox_desc">Enter the URL of the person giving the testimonial</span></td>
  		<td></td>
  	</tr>
  	<tr>
  		<th class="metabox_th"><label for="testimonial_excerpt">Testimonial excerpt Text:</label></th>
  		<td><textarea class="input_textarea" name="testimonial_excerpt" id="testimonial_excerpt"><?php echo $testimonial_excerpt;?></textarea>
  		<span class="metabox_desc">Enter the text for the exceprt</span></td>
  		<td></td>
  	</tr>
  </table>
  <?php
}

add_action('save_post', 'save_details_testimonial');

function save_details_testimonial(){
  global $post;
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['themeteam_testimonial'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;
  
  update_post_meta($post->ID, "testimonial_name", $_POST["testimonial_name"]);
  update_post_meta($post->ID, "testimonial_url", $_POST["testimonial_url"]);
  update_post_meta($post->ID, "testimonial_header", $_POST["testimonial_header"]);
  update_post_meta($post->ID, "testimonial_excerpt", $_POST["testimonial_excerpt"]);
}

add_action("manage_testimonial_custom_column",  "testimonial_custom_columns");
add_filter("manage_edit-testimonial_columns", "testimonial_edit_columns");
 
function testimonial_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Testimonial Title",
    "description" => "Description",
    "name" => "Name",
  );
 
  return $columns;
}
function testimonial_custom_columns($column){
  global $post;
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "name":
      $custom = get_post_custom();
      echo $custom["testimonial_name"][0];
      break;
   }
}
?>