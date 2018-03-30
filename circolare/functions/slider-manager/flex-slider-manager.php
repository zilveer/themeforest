<?php

define('MANAGER_URI', THEME_DIR . '/functions/slider-manager/');

if( current_user_can('administrator') ) {
add_action('admin_menu', 'manager_admin_menu');
add_action('admin_init', 'manager_init');
}

global $slides;

if(get_option('slides')) {
	$slides = get_option('slides');
} else {
	$slides = false;	
}

// admin menu
function manager_admin_menu() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'flexslidermanager') {
		
		if(isset($_POST['action']) && $_POST['action'] == 'save') {
			
			$slides = array();
			
			foreach($_POST['src'] as $k => $v) {
				$slides[] = array(
					'src' => $v,
					'title' => $_POST['title'][$k],
					'subtitle' => $_POST['subtitle'][$k],
					'link' => $_POST['link'][$k],
					'linktext' => $_POST['linktext'][$k],
					'caption' => $_POST['caption'][$k]
				);
			}
			update_option('slides', $slides);			
		}		
	}
	
	/* if(function_exists('add_object_page')) {
		add_object_page('Slider Manager', 'Slider Manager', 'edit_themes', 'slidermanager', 'manager_wrap');		
	}
	else {
		add_menu_page('Slider Manager', 'Slider Manager', 'edit_themes', 'slidermanager', 'manager_wrap');
	} */
	
	add_theme_page(__('FlexSlider Manager', 'circolare'), __('FlexSlider Manager', 'circolare'), 'read', 'flexslidermanager', 'manager_wrap');
	
}


// slider manager wrapper
function manager_wrap() {
	global $slides;
	
?>

	<div class="wrap" id="manager_wrap">
		<div id="flexmanager">
		<h2><?php _e('FlexSlider Manager', 'circolare'); ?></h2>
		
		<form action="" id="manager_form" method="post" enctype="multipart/form-data">
		
			<ul id="manager_form_wrap">
			
			<?php $slide_count = 0; if(get_option('slides')) : $slides = get_option('slides'); ?>
				
				<?php foreach($slides as $k => $slide) : $slide_count++ ?>
				
				<li class="slide" id="slide<?php echo $slide_count ?>">
				
					<div class="colfirst">
						<h3><?php _e('Slide', 'circolare'); ?> <?php echo $slide_count ?></h3>
						<?php $image_aq = aq_resize($slide['src'], 90, 90, true); ?>
						<?php if ($image_aq != "") { ?><img src="<?php echo $image_aq ?>" alt="" /><?php } else { ?><img src="<?php echo $slide['src'] ?>" width="90" height="90" alt="" /><?php } ?>
					</div>
					
					<div class="col2">
						<label><?php _e('Image Source', 'circolare'); ?> <span><?php _e('(350*350 px only)', 'circolare'); ?></span></label>
						<input type="text" name="src[]" class="slide_src" value="<?php echo $slide['src'] ?>">
						<button class="upload_image_button button-secondary"><?php _e('Upload Image', 'circolare'); ?></button>
						
						<div class="clear"></div>
						
						<label><?php _e('Slide Title', 'circolare'); ?></label>
						<input type="text" name="title[]" id="slide_title" value="<?php echo $slide['title'] ?>">
						
						<div class="clear"></div>
						
						<label><?php _e('Slide Subtitle', 'circolare'); ?></label>
						<input type="text" name="subtitle[]" id="slide_subtitle" value="<?php echo $slide['subtitle'] ?>">
					</div>
						
					<div class="col2 last">
						<label><?php _e('Slide Content', 'circolare'); ?></label>
						<textarea name="caption[]" cols="20" rows="2" class="slide_caption"><?php echo stripslashes($slide['caption']) ?></textarea>
						
						<label><?php _e('Slide Link', 'circolare'); ?></label>
						<input type="text" name="link[]" id="slide_link" value="<?php echo $slide['link'] ?>">
						
						<label><?php _e('Link Text', 'circolare'); ?></label>
						<input type="text" name="linktext[]" id="slide_linktext" value="<?php echo $slide['linktext'] ?>">
					</div>
					
					<div class="clear"></div>

					<button class="remove_slide button-secondary"><?php _e('Remove This Slide', 'circolare'); ?></button>
				</li>
				
				<?php endforeach; ?>
				
			<?php else : ?>
			
				<li class="slide">
				
					<div class="colfirst">
						<h3><?php _e('Slide', 'circolare'); ?> 1</h3>						
					</div>
				
					<div class="col2">
						<label><?php _e('Image Source', 'circolare'); ?> <span><?php _e('(350*350 px only)', 'circolare'); ?></span></label>
						<input type="text" name="src[]" class="slide_src">
						<button class="upload_image_button button-secondary"><?php _e('Upload Image', 'circolare'); ?></button>
						
						<div class="clear"></div>
						
						<label><?php _e('Slide Title', 'circolare'); ?></label>
						<input type="text" name="title[]" id="slide_title">
						
						<div class="clear"></div>
						
						<label><?php _e('Slide Subtitle', 'circolare'); ?></label>
						<input type="text" name="subtitle[]" id="slide_subtitle">
					</div>
						
					<div class="col2 last">
						<label><?php _e('Slide Content', 'circolare'); ?></label>
						<textarea name="caption[]" cols="20" rows="2" class="slide_caption"></textarea>
						
						<label><?php _e('Slide Link', 'circolare'); ?></label>
						<input type="text" name="link[]" id="slide_link">
						
						<label><?php _e('Link Text', 'circolare'); ?></label>
						<input type="text" name="linktext[]" id="slide_linktext">
					</div>
					
					<div class="clear"></div>
					
					<button class="remove_slide button-secondary"><?php _e('Remove This Slide', 'circolare'); ?></button>
				</li>
				
			<?php endif; ?>
			
			</ul>
			
			<input type="submit" value="<?php _e('Save Changes', 'circolare'); ?>" id="manager_submit" class="button-primary">
			<input type="hidden" name="action" value="save">
			
		</form>
		</div>
	</div>

<?php
	
}


// slider manager init
function manager_init() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'flexslidermanager') {
	
		// scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-appendo', MANAGER_URI . '/js/jquery.appendo.js', false, '1.0', false);
		wp_enqueue_script('slider-manager', MANAGER_URI . '/js/manager.js', false, '1.0', false);
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', MANAGER_URI .'/js/my-script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');

		
		// styles
		wp_enqueue_style('slider-manager', MANAGER_URI . '/css/manager.css', false, '1.0', 'all');
		wp_enqueue_style('thickbox');
		
	}

}

?>