<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
class crum_widget_facebook extends WP_Widget {

	public function __construct() {

		parent::__construct(
				'facebook_widget', // Base ID
				'Widget: Facebook widget', // Name
				array('description' => __('Facebook Social Network widget', 'dfd'),) // Args
		);
		add_action('admin_enqueue_scripts', array($this, 'dfd_reqister_scripts'));
	}

	public function dfd_reqister_scripts() {
		wp_register_script('dfd-facebook-admin-js', get_template_directory_uri().'/assets/js/widget-facebook-backkend.js', array('jquery'));
	}

	public function form($instance) {

		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Facebook widget', 'dfd');
		}

		if (isset($instance['width'])) {
			$width = $instance['width'];
		} else {
			$width = 300;
		}

		if (isset($instance['color'])) {
			$color = $instance['color'];
		} else {
			$color = 'dark';
		}

		if (isset($instance['stream'])) {
			$stream = $instance['stream'];
		} else {
			$stream = 'false';
		}

		if (isset($instance['faces'])) {
			$faces = $instance['faces'];
		} else {
			$faces = 'true';
		}

		if (isset($instance['url'])) {
			$url = $instance['url'];
		} else {
			$url = 'platform';
		}

		if (isset($instance['header'])) {
			$header = $instance['header'];
		} else {
			$header = 'false';
		}
		
		if (isset($instance['mask'])) {
			$mask = $instance['mask'];
		} else {
			$mask = 'true';
		}
		
		if (isset($instance['titleMask'])) {
			$titleMask = $instance['titleMask'];
		} else {
			$titleMask = '';
		}
		
		if (isset($instance['subtitleMask'])) {
			$subtitleMask = $instance['subtitleMask'];
		} else {
			$subtitleMask = '';
		}
		
		if (isset($instance['imageUpload'])) {
			$imageUpload = $instance['imageUpload'];
		} else {
			$imageUpload = '';
		}
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php _e('Facebook Name: ( facebook.com/ * Type into field * )', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php _e('Width(px):', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('color')); ?>"><?php _e('Color scheme:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('color')); ?>" name="<?php echo esc_attr($this->get_field_name('color')); ?>  value="<?php echo esc_attr($color); ?>" >
				<option value ='light' <?php if (esc_attr($color) == 'light') echo 'selected'; ?>>Light</option>
				<option value = 'dark' <?php if (esc_attr($color) == 'dark') echo 'selected'; ?>>Dark</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('stream')); ?>"><?php _e('Show stream:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('stream')); ?>" name="<?php echo esc_attr($this->get_field_name('stream')); ?>  value="<?php echo esc_attr($stream); ?>" >
				<option value ='true' <?php if (esc_attr($stream) == 'true') echo 'selected'; ?>>Yes</option>
				<option value = 'false' <?php if (esc_attr($stream) == 'false') echo 'selected'; ?>>No</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('faces')); ?>"><?php _e('Show faces:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('faces')); ?>" name="<?php echo esc_attr($this->get_field_name('faces')); ?>  value="<?php echo esc_attr($faces); ?>" >
				<option value ='true' <?php if (esc_attr($faces) == 'true') echo 'selected'; ?>>Yes</option>
				<option value = 'false' <?php if (esc_attr($faces) == 'false') echo 'selected'; ?>>No</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('header')); ?>"><?php _e('Show header:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('header')); ?>" name="<?php echo esc_attr($this->get_field_name('header')); ?>"  value="<?php echo esc_attr($header); ?>" >
				<option value ='true' <?php if (esc_attr($header) == 'true') echo 'selected'; ?>>Yes</option>
				<option value = 'false' <?php if (esc_attr($header) == 'false') echo 'selected'; ?>>No</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('mask')); ?>"><?php _e('Show mask:', 'dfd'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('mask')); ?>" name="<?php echo esc_attr($this->get_field_name('mask')); ?>"  value="<?php echo esc_attr($mask); ?>" >
				<option value ='true' <?php if (esc_attr($mask) == 'true') echo 'selected'; ?>>Yes</option>
				<option value = 'false' <?php if (esc_attr($mask) == 'false') echo 'selected'; ?>>No</option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('titleMask')); ?>"><?php _e('Title on the mask:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('titleMask')); ?>" name="<?php echo esc_attr($this->get_field_name('titleMask')); ?>" type="titleMask" value="<?php echo esc_attr($titleMask); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('subtitleMask')); ?>"><?php _e('Subtitle on the mask:', 'dfd'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitleMask')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitleMask')); ?>" type="subtitleMask" value="<?php echo esc_attr($subtitleMask); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('imageUpload')); ?>"><?php _e('Mask image:', 'dfd'); ?></label>
			<img src="<?php echo (substr_count(esc_attr( $imageUpload ), 'http://') > 0) ? esc_url( $imageUpload ) : ''; ?>" alt="" class="image_uploaded" style="<?php echo (substr_count(esc_attr( $imageUpload ), 'http://') > 0) ? '' : 'display: none;'; ?> padding: 20px 0; max-width: 100%;" />
			<input id="<?php echo esc_attr($this->get_field_id('imageUpload')); ?>" class="upload_image" type="hidden" name="<?php echo esc_attr($this->get_field_name('imageUpload')); ?>" value="<?php echo esc_url($imageUpload); ?>" /> 
			<input class="upload_image_button button" type="button" value="<?php _e('Upload Image','dfd'); ?>" />
			<?php if(substr_count(esc_attr( $imageUpload ), 'http://') > 0) : ?>
				<input class="remove_image_button button" type="button" value="<?php _e('Remove Image','dfd'); ?>" />
			<?php endif; ?>
		</p>

		<?php
	}

	public function update($new_instance, $old_instance) {

		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['stream'] = strip_tags($new_instance['stream']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['faces'] = strip_tags($new_instance['faces']);
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['header'] = strip_tags($new_instance['header']);
		$instance['mask'] = strip_tags($new_instance['mask']);
		$instance['titleMask'] = strip_tags($new_instance['titleMask']);
		$instance['subtitleMask'] = strip_tags($new_instance['subtitleMask']);
		$instance['imageUpload'] = esc_url($new_instance['imageUpload']);
		return $instance;
	}

	public function widget($args, $instance) {
		wp_enqueue_script('dfd_facebook_widget_script');
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$width = isset($instance['width']) && !empty($instance['width']) ? $instance['width'] : '';
		$color = isset($instance['color']) && !empty($instance['color']) ? $instance['color'] : '';
		$stream = isset($instance['stream']) && !empty($instance['stream']) ? $instance['stream'] : '';
		$faces = isset($instance['faces']) && !empty($instance['faces']) ? $instance['faces'] : '';
		$url = isset($instance['url']) && !empty($instance['url']) ? $instance['url'] : '';
		$header = isset($instance['header']) && !empty($instance['header']) ? $instance['header'] : '';
		$mask = isset($instance['mask']) && !empty($instance['mask']) ? $instance['mask'] : '';
		$titleMask = isset($instance['titleMask']) && !empty($instance['titleMask']) ? $instance['titleMask'] : '';
		$subtitleMask = isset($instance['subtitleMask']) && !empty($instance['subtitleMask']) ? $instance['subtitleMask'] : '';
		$imageUpload = isset($instance['imageUpload']) && !empty($instance['imageUpload']) ? $instance['imageUpload'] : '';
		echo $before_widget;
		if ($title) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}
		?>
		
		<div class="facebookOuter">
			<?php if (esc_attr($mask) == 'true') : ?>
				<div class="widget-mask text-center background--dark" <?php if(!empty($imageUpload)) : ?> style="background-image: url(<?php echo esc_url($imageUpload) ?>);" <?php endif; ?>>
					<h3 class="title-mask widget-title"><?php echo $titleMask; ?></h3>
					<div class="subtitle-mask subtitle"><?php echo $subtitleMask; ?></div>
				</div>
			<?php endif; ?>
			<div class="facebookInner">
				<div class="fb-like-box"
					 data-width="<?php echo $width; ?>" data-height="450"
					 data-href="http://www.facebook.com/<?php echo $url; ?>"
					 data-colorscheme="<?php echo $color; ?>"
					 data-show-border="false"
					 data-show-faces="<?php echo $faces; ?>"
					 data-stream="<?php echo $stream; ?>" data-header="<?php echo $header; ?>">
				</div>
			</div>
		</div>
		<div id="fb-root"></div>

		<?php
		echo $after_widget;
	}
}
