<?php
add_action('init', 'portfolio_register');
function portfolio_register() {
	  $labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio item',
		'add_new' => 'Add Portfolio Item',
		'add_new_item' => 'Add Portfolio Item',
		'edit_item' => 'Edit Portfolio Entry',
		'new_item' => 'New Portfolio Entry',
		'view_item' => 'View Portfolio Entry',
		'search_items' => 'Search Portfolio Entries',
		'not_found' =>  'No Portfolio found',
		'not_found_in_trash' => 'No Portfolio found in Trash', 
		'parent_item_colon' => ''
	  );

	global $paged;
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'rewrite' => array('slug'=>'portfolio', 'with_front'=>false),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'show_in_nav_menus'=> false,
		'query_var' => true,
		'paged' => $paged,			
		'menu_position' => 100,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
	);
	
	register_post_type('portfolio' , $args);
	
	register_taxonomy("category_portfolio", 
		array("portfolio"), 
		array(	"hierarchical" => true, 
				"label" => "Portfolio Categories", 
				"singular_label" => "Portfolio Categories", 
				'rewrite' => array('slug' => 'category_portfolio'),
				"query_var" => true,
				'paged' => $paged
				));
	flush_rewrite_rules( false );
}

add_action('admin_init', 'add_portfolio');
add_action('save_post', 'update_portfolio_url');
function add_portfolio(){
		add_meta_box("item_details", __("Portfolio Item Link", 'wpspace'), "portfolio_custom", "portfolio", "normal", "low");
	}
function portfolio_custom(){
		global $post, $shortname;
		$custom = get_post_custom($post->ID);
		$link_url = isset($custom["link_url"][0]) ? $custom["link_url"][0] : '';
?>
	<table class="form-table">
		<tr>
			<th><label for="link_url"><?php _e('Portfolio link url', 'wpspace'); ?></label></th>
			<td>
				<input type="text" value="<?php echo $link_url; ?>" name="link_url">
				<small>Add the link to your portfolio item or video url (youtube or vimeo)</small>
			</td>
		</tr>
	</table>
<?php
}
function update_portfolio_url(){
	global $post, $shortname;		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	} else {
		if(isset($_POST["link_url"])) {
			update_post_meta($post->ID, "link_url", $_POST["link_url"]);
		}			
	}
}
flush_rewrite_rules(false);
?>