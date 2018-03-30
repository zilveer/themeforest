<?php
class Mk_Image_Sizes
{
    
    function __construct() {
        
        $this->options = get_option(IMAGE_SIZE_OPTION);
        
        if (empty($this->options)) {
            $this->options = array(
                array(
                    'size_w' => 500,
                    'size_h' => 500,
                    'size_n' => 'Image Size 500x500',
                    'size_c' => 'on',
                )
            );
        }
        
        $this->build_holder();
        
        $this->enqueue();
    }
    
    function enqueue() {
        wp_enqueue_script('admin-scripts', THEME_ADMIN_ASSETS_URI . '/js/progress-circle.js', array(
            'jquery'
        ) , false, true);
        
        wp_enqueue_script('image-size-js', THEME_CONTROL_PANEL_ASSETS . '/js/image-sizes.js', array(
            'jquery'
        ) , false, true);
    }
    
    function build_holder() { 

	?>
	 <div class="control-panel-holder">

		<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-image-size')); ?>
		<div class="mk-image-size-holder cp-pane">

			<h3><?php _e('Image Size Settings', 'mk_framework'); ?></h3>
			<p><?php _e('In this page you can add custom image sizes to be used in various locations such as shortcodes as well as theme options.', 'mk_framework'); ?></p>
			<p><?php _e('The tool below helps you to set your own image sizes using WordPress image resizer instead of third party libraries. One benefits of using WP Image Resizer is that you will be able to optimise images and get higher scores in google. Other solutions like BFI_Thumb (Which we use for hard corping images) generate only temporary images and tools like WP Smush will not optimize.', 'mk_framework'); ?></p>
			<form action="mk_image_sizes" id="mk_image_sizes" name="mk_image_sizes">
					
			<?php 
			if(!empty($this->options)) {
				foreach ($this->options as $option) {
					$this->size_single_unit($option);
				}
			}
			 ?>
			 <?php wp_nonce_field('ajax-image-sizes-options', 'security'); ?>
        	<a class="cp-button large blue add-size"><?php _e('Add New Size', 'mk_framework'); ?></a>


	          <figure class="progress-circle">
	            <div class="progress-msg"></div>
	            <svg width="46" height="46">
	              <circle class="progress-circle__line inner" cx="23" cy="23" r="20" />
	              <circle class="progress-circle__line outer" cx="23" cy="23" r="20" />
	            </svg>
	            <svg class="success-icon" width="30" height="30">
	                <path d="M13.786,19.144l5.464-8.286"/>
	                <path d="M13.786,19.144l-4.313-3.812"/>
	            </svg>
	            <svg class="error-icon" width="30" height="30">
	                <path d="M15,15L9.433,9.434"/>
	                <path d="M15,15l5.567,5.566"/>
	                <path d="M15,15l-5.566,5.566"/>
	                <path d="M15,15l5.567-5.566"/>
	            </svg>
	          </figure>

			<button type="submit" class="cp-button large green alignright"><?php _e('Save Settings', 'mk_framework'); ?></button>
			</form>

		
		</div>
	</div>	

	<?php
	}


	function size_single_unit($value = false){
	?>	

	<div class="sizes-single-unit">
		
		<h3 class="size-name"><?php echo $value['size_n']; ?></h3>

		<div class="option-holder">
			<label><?php _e('Image Width', 'mk_framework'); ?></label>
			<input name="size_w" type="number" step="1" min="0" value="<?php echo $value['size_w']; ?>">
		</div>

		<div class="option-holder">
			<label><?php _e('Image Height', 'mk_framework'); ?></label>
			<input name="size_h" type="number" step="1" min="0" value="<?php echo $value['size_h']; ?>">
		</div>

		<div class="option-holder">
			<label><?php _e('Size Name', 'mk_framework'); ?></label>
			<input name="size_n" type="text" value="<?php echo $value['size_n']; ?>" size="50">
		</div>
		<div class="option-holder">
			<label><?php _e('Hard Crop ?', 'mk_framework'); ?></label>
			<input name="size_c" type="checkbox" <?php if(isset($value['size_c']) && $value['size_c'] == 'on') { echo 'checked="checked"'; } ?> />
		</div>
		<a class="cp-button red small alignright delete-size"><?php _e('Delete', 'mk_framework'); ?></a>
	</div>
	<?php
	}
}

new Mk_Image_Sizes();

