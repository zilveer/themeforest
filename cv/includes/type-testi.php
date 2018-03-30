<?php
add_action('init', 'test_register');
function test_register() {
	$labels = array(
		'name' => 'Testimonials',
		'singular_name' => 'Testimonial',
		'add_new' => 'Add Testimonial',
		'add_new_item' => 'Add Testimonial',
		'edit_item' => 'Edit Testimonial',
		'new_item' => 'New Testimonial',
		'view_item' => 'View Testimonial',
		'search_items' => 'Search Testimonials',
		'not_found' =>  'No Testimonials found',
		'not_found_in_trash' => 'No Testimonials found in Trash', 
		'parent_item_colon' => ''
	);

	global $paged;
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'rewrite' => array('slug'=>'testi','with_front'=>false),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'show_in_nav_menus'=> false,
		'query_var' => true,
		'paged' => $paged,			
		'menu_position' => 100,
		'supports' => array('title', 'editor', 'thumbnail')
	);
	
	register_post_type('testi' , $args);
	
	
	register_taxonomy("category_testi", 
		array("testi"), 
		array(	"hierarchical" => true, 
				"label" => "Testimonials Categories", 
				"singular_label" => "Testimonials Categories", 
				'rewrite' => array('slug' => 'category_testi'),
				"query_var" => true,
				'paged' => $paged
				));  
	flush_rewrite_rules( false );	
}

add_action('admin_init', 'add_testi');
flush_rewrite_rules(false);

add_action('save_post', 'update_testi');
function add_testi(){
	add_meta_box("test_details", "Additional info", "testi_options", "testi", "normal", "low");
}
function testi_options(){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	
	$custom = get_post_custom($post->ID);
	$testi_author = isset($custom["author"][0]) ? $custom["author"][0] : '';
	$testi_year = isset($custom["testi_year"][0]) ? $custom["testi_year"][0] : '';
	$testi_month = isset($custom["testi_month"][0]) ? $custom["testi_month"][0] : '';
?>		
<div id="testi-options">
	<div style="margin-bottom:20px;">
		<h4>Author of the Testimonial:</h4>
		<input type="text" name="author" value="<?php echo $testi_author; ?>" size="50" >
	</div>	
	<div style="margin-bottom:20px;">
		<h4><?php echo __('Date of testimonial', 'wpspace'); ?>:</h4>
		<label for="testi_year">Date:</label>
		<select name="testi_year" id="testi_year">
			<option value=""></option>
			<?php 
				$cur_y = (int)date('Y');
				$period_y = array();
				
				for($i = $cur_y; $i >= 1950; $i--) {
					$period_y[] = $i;
				}
				foreach ($period_y as $val) {
					echo '<option value="'.$val.'"'.($val == $testi_year ? ' selected="selected"' : "").'>'.$val.'</option>';
				} 
			?>
		</select>
		<select name="testi_month" id="testi_month">
			<option value=""></option>
			<?php 
				$months_list = range(1, 12);
				
				foreach ($months_list as $val) {
					echo '<option value="'.$val.'"'.($val == $testi_month ? ' selected="selected"' : "").'>'.$val.'</option>';
				} 
			?>
		</select>
	</div>
</div><!--end testi-options-->   
<?php
}
function update_testi(){
	global $post;		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	} else {
		if (isset($_POST["author"]))
			update_post_meta($post->ID, "author", $_POST["author"]);
		if (isset($_POST["testi_year"]))
			update_post_meta($post->ID, "testi_year", $_POST["testi_year"]);
		if (isset($_POST["testi_month"]))
			update_post_meta($post->ID, "testi_month", $_POST["testi_month"]);
	}
}
?>