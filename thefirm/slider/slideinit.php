<?php

define('MANAGER_URI', get_template_directory_uri() . '/slider');

add_action('admin_menu', 'manager_admin_menu');
add_action('admin_init', 'manager_init');

global $slides;

if(get_option('slides')) {
	$slides = get_option('slides');
} else {
	$slides = false;	
}


//function that will output the actual code

function firm_slider() {
	
  	$slides = get_option('slides'); 
	?>
	
	<?php if ($slides) { ?>	
		<?php foreach($slides as $num => $slide) : ?>
		<img src="<?php echo $slide['src']; ?>" class="backgroundimg" />
		<?php endforeach; ?>
	<?php }; ?>
<?php

}

// admin menu
function manager_admin_menu() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
		
		if(isset($_POST['action']) && $_POST['action'] == 'save') {
			
			$slides = array();
			
			foreach($_POST['src'] as $k => $v) {
				$slides[] = array(
					'src' => $v,
					'link' => $_POST['link'][$k],
					'caption' => stripslashes($_POST['caption'][$k]),
					'title' => stripslashes($_POST['title'][$k])
				);
			}
			
			update_option('slides', $slides);
			
		}
		
	}
	
		add_submenu_page('themes.php', __('The Firm Background Images', 'eet_textdomain'), __('The Firm Background Images', 'eet_textdomain'), 'edit_themes', 'slidermanager', 'manager_wrap');	
}


// slider manager wrapper
function manager_wrap() {
	global $slides;
?>

	<div class="wrap" id="manager_wrap">
	
		<h2>Slider Manager</h2>
		
		<form action="" id="manager_form" method="post">
		
			<ul id="manager_form_wrap">
			
			<?php if(get_option('slides')) : ?>
				<?php $slides = get_option('slides'); ?>
				<?php foreach($slides as $k => $slide) : ?>
			
				
				<li class="slide">
					
					<label><?php _e('Image source', 'eet_textdomain'); ?> <span><?php _e('required', 'eet_textdomain'); ?></span></label>
					<input type="text" name="src[]" class="slide_src" value="<?php echo $slide['src'] ?>">
					
					<button class="remove_slide button-secondary"><?php _e('Remove This Image', 'eet_textdomain'); ?></button>
					
				</li>
				
				<?php endforeach; ?>
				
			<?php else : ?>
			
				<li class="slide">
					
					<label>Image Source <span>(required)</span></label>
					<input type="text" name="src[]" class="slide_src">
					
					
					<button class="remove_slide button-secondary"><?php _e('Remove This Image', 'eet_textdomain'); ?></button>
					
				</li>
				
			<?php endif; ?>
			
			</ul>
			<button class="upload_image_button button-primary" ><?php _e('Upload Images', 'eet_textdomain'); ?></button>
			<input type="submit" value="<?php _e('Save Changes', 'eet_textdomain'); ?>" id="manager_submit" class="button-primary">
			<input type="hidden" name="action" value="save">
			
		</form>
		
	</div>

<?php
	
}



function firma_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', WP_PLUGIN_URL.'/my-script.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
 
function firma_admin_styles() {
wp_enqueue_style('thickbox');
}

function manager_init() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('firma-upload', MANAGER_URI . '/js/firma-script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('firma-upload');
		
		wp_enqueue_style('thickbox');

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-appendo', MANAGER_URI . '/js/jquery.appendo.js', false, '1.0', false);
		wp_enqueue_script('slider-manager', MANAGER_URI . '/js/manager.js', false, '1.0', false);
		wp_enqueue_style('slider-manager', MANAGER_URI . '/css/manager.css', false, '1.0', 'all');
		
	}
}



?>