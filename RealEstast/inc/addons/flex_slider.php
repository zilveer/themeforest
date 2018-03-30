<?php

class PGL_Addon_Flex_Slider {
	static function init() {
//		self::register_post_type();
//		self::add_action();
	}

	static function register_post_type() {
		register_post_type( 'flex_slider',
			array(
				'labels'              => array(
					'name'          => 'Flex Sliders',
					'singular_name' => 'Flex slider',
					'add_new'       => __( 'Add new slider', PGL ),
					'add_new_item'  => __( 'Add new slider', PGL ),
					'edit_item'     => __( 'Edit slider', PGL ),
					'new_item'      => __( 'Add slider', PGL ),
				),
				'public'              => TRUE,
				'exclude_from_search' => TRUE,
				'publicly_queryable'  => FALSE,
				'menu_icon'           => PGL_URI_IMG . 'icon/hp_photos.png',
				'supports'            => array( 'title' )
			)
		);
	}

	static function add_action() {
		add_action( 'admin_init', array('PGL_Addon_Flex_Slider', 'add_meta_box') );
	}

	static function add_meta_box() {
		add_meta_box( 'slider-item', 'Images', array('PGL_Addon_Flex_Slider', 'metabox_slider_images'), 'flex_slider', $context = 'advanced', $priority = 'default', $callback_args = null );
	}

	static function metabox_slider_images(){
		wp_enqueue_script( 'img-manager', PGL_URI_JS . 'img-manage.js', array('jquery'), '1.0.1', false );
		wp_enqueue_style( 'img-manager', PGL_URI_CSS . 'img-manage.css' );
		?>
		<div id="pgl_image_container">
			<div style="display:none">
				<input type="hidden" name="gallery_data" id="" class="gallery_data">
			</div>
			<div class="btn-bar">
				<input type="button" value="Add item" class="addBtn"/>
			</div>
			<ul class="img-list">
				
			</ul>
		</div>
		<?php
	}
}