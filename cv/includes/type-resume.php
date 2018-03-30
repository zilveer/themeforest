<?php
add_action('init', 'resume_register');
function resume_register() {
	  $labels = array(
		'name' => 'Resume',
		'singular_name' => 'Resume item',
		'add_new' => 'Add Resume Item',
		'add_new_item' => 'Add Resume Item',
		'edit_item' => 'Edit Resume Entry',
		'new_item' => 'New Resume Entry',
		'view_item' => 'View Resume Entry',
		'search_items' => 'Search Resume Entries',
		'not_found' =>  'No Resume found',
		'not_found_in_trash' => 'No Resume found in Trash', 
		'parent_item_colon' => ''
	  );

	global $paged;
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'rewrite' => array('slug'=>'resume','with_front'=>false),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'show_in_nav_menus'=> false,
		'query_var' => true,
		'paged' => $paged,			
		'menu_position' => 100,
		'supports' => array('title', 'editor')
	);
	
	register_post_type('resume' , $args);
	
	
	register_taxonomy("category_resume", 
		array("resume"), 
		array(	"hierarchical" => true, 
				"label" => "Resume Categories", 
				"singular_label" => "Resume Categories", 
				'rewrite' => array('slug' => 'category_resume'),
				"query_var" => true,
				'paged' => $paged
				));  
	flush_rewrite_rules( false );	
}

add_action('admin_init', 'add_resume');
flush_rewrite_rules(false);

add_action('save_post', 'update_resume');
function add_resume(){
	add_meta_box("resume_details", "Additional info", "resume_options", "resume", "normal", "low");
}
function resume_options(){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	
	$custom = get_post_custom($post->ID);
	$resume_position = isset($custom["position"][0]) ? $custom["position"][0] : '';
	$resume_from = isset($custom["resume_from"][0]) ? $custom["resume_from"][0] : '';
	$resume_month_from = isset($custom["resume_month_from"][0]) ? $custom["resume_month_from"][0] : '';
	$resume_to = isset($custom["resume_to"][0]) ? $custom["resume_to"][0] : '';
	$resume_month_to = isset($custom["resume_month_to"][0]) ? $custom["resume_month_to"][0] : '';
?>		
<div id="resume-options">
	<div style="margin-bottom:20px;">
		<h4>Position:</h4>
		<input type="text" name="position" value="<?php echo $resume_position; ?>" 	size="50" >
	</div>
	<div style="margin-bottom:20px;">
		<h4>Period:</h4>
		<label for="resume_from">From:</label>
		<select name="resume_from" id="resume_from">
			<option value=""></option>
			<?php 
				$cur_y = (int)date('Y');
				$period_y = array();
				
				for($i = $cur_y; $i >= 1950; $i--) {
					$period_y[] = $i;
				}
				foreach ($period_y as $val) {
					echo '<option value="'.$val.'"'.($val == $resume_from ? ' selected="selected"' : "").'>'.$val.'</option>';
				} 
			?>
		</select>
		<select name="resume_month_from" id="resume_month_from">
			<option value=""></option>
			<?php 
				$months_list = range(1, 12);
				
				foreach ($months_list as $val) {
					echo '<option value="'.$val.'"'.($val == $resume_month_from ? ' selected="selected"' : "").'>'.$val.'</option>';
				} 
			?>
		</select>
		<label for="resume_to">To:</label>
		<select name="resume_to" id="resume_to">
			<option value=""></option>
			<option value="present" <?php if($resume_to == 'present') echo ' selected="selected"' ?>>Present</option>
			<?php
				$cur_y = (int)date('Y');
				$period_y = array();
				
				for($i = $cur_y; $i >= 1950; $i--) {
					$period_y[] = $i;
				}
				foreach ($period_y as $val) {
					echo '<option value="'.$val.'"'.($val == $resume_to ? ' selected="selected"' : "").'>'.$val.'</option>';
				}
			?>
		</select>		
		<select name="resume_month_to" id="resume_month_to">
			<option value=""></option>
			<?php
				foreach ($months_list as $val) {
					echo '<option value="'.$val.'"'.($val == $resume_month_to ? ' selected="selected"' : "").'>'.$val.'</option>';
				}
			?>
		</select>
	</div>
</div><!--end resume-options-->   
<?php
}
function update_resume(){
	global $post;		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	} else {
		if (isset($_POST["resume_month_from"]))
			update_post_meta($post->ID, "resume_month_from", $_POST["resume_month_from"]);
		if (isset($_POST["resume_month_to"]))
			update_post_meta($post->ID, "resume_month_to", $_POST["resume_month_to"]);
		if (isset($_POST["position"]))
			update_post_meta($post->ID, "resume_from", $_POST["resume_from"]);
		if (isset($_POST["resume_to"]))
			update_post_meta($post->ID, "resume_to", $_POST["resume_to"]);
		if (isset($_POST["position"]))
			update_post_meta($post->ID, "position", $_POST["position"]);
	}
}
?>