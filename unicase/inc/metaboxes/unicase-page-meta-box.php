<?php

/**
 * Calls the class on the post edit screen.
 */
if ( ! function_exists( 'unicase_page_metabox' ) ) {
	function unicase_page_metabox() {
		new Unicase_Page_Metabox();
	}
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'unicase_page_metabox' );
	add_action( 'load-post-new.php', 'unicase_page_metabox' );
}

if ( ! class_exists( 'Unicase_Page_Metabox' ) ) {
	/** 
	 * Unicase_Page_Metabox
	 */
	class Unicase_Page_Metabox {

		/**
		 * The metabox array.
		 * @var     array
		 * @access  private
		 * @since   1.0.0
		 */
		private $unicase_page_metabox = array();

		/**
		 * Hook into the appropriate actions when the class is constructed.
		 */
		public function __construct() {
			$this->set_meta_box();
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}

		/**
		 * Adds the meta box container.
		 */
		public function add_meta_box( $post_type ) {
			$unicase_page_metabox = $this->unicase_page_metabox;

			if ( in_array( $post_type, $unicase_page_metabox['page'] )) {
				add_meta_box( $unicase_page_metabox['id'], $unicase_page_metabox['title'], array( $this, 'render_meta_box_content' ), $post_type, $unicase_page_metabox['context'], $unicase_page_metabox['priority'] );
			}
		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @param int $post_id The ID of the post being saved.
		 */
		public function save( $post_id ) {
			$unicase_page_metabox = $this->unicase_page_metabox;
	 
			// verify nonce
			if ( ! isset( $_POST['unicase_page_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['unicase_page_meta_box_nonce'], 'unicase_save_page_meta_box_nonce' ) ) {
				return $post_id;
			}
		 
			// check permissions
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}

			$meta_box_id = $unicase_page_metabox['id'];
			$meta_data = get_post_meta( $post_id, $meta_box_id, true );
		 
			foreach ( $unicase_page_metabox['fields'] as $field ) {
				$old = isset( $meta_data[$field['id']] ) ? $meta_data[$field['id']] : '';
				$new = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '';
		 
				if ( ! empty( $new ) ) {
					$meta_data[$field['id']] = $new;
				} elseif( isset( $meta_data[$field['id']] ) && '' == $new ) {
					unset( $meta_data[$field['id']] );
				}
			}

			if( ! empty( $meta_data ) ) {
				update_post_meta( $post_id, $meta_box_id, $meta_data );
			} else {
				delete_post_meta( $post_id, $meta_box_id );
			}
		}


		/**
		 * Render Meta Box content.
		 *
		 * @param WP_Post $post The post object.
		 */
		public function render_meta_box_content( $post ) {
			$unicase_page_metabox = $this->unicase_page_metabox;

			$meta_array = array();
			$meta_box_id = $unicase_page_metabox['id'];
			$meta_array = get_post_meta( $post->ID, $meta_box_id, true );
			
			// Use nonce for verification
			echo '<input type="hidden" name="unicase_page_meta_box_nonce" value="', wp_create_nonce( 'unicase_save_page_meta_box_nonce' ), '" />';
		  
		  	$increment = 0;
			foreach ( $unicase_page_metabox['fields'] as $field ) {
				// get current post meta data
				$meta = '';
				if( isset( $meta_array[$field['id']] ) ) {
					$meta = $meta_array[$field['id']];
				}

				switch ($field['type']) {

					//If radio array
					case 'radio':

						echo '<div class="metaField_field_wrapper metaField_field_' . esc_attr( $field['id'] ) . '">';
						echo '<p><label for="' . esc_attr( $field['id'] ) . '"><strong>' . $field['name'] . '</strong></label></p>';

						$count = 0;
						foreach ( $field['options'] as $key => $label ) {
							$checked = ( $meta == $key || (!$meta && !$count) ) ? 'checked="checked"' : '';
							echo '<label class="metaField_radio" style="display: block; padding: 2px 0;"><input class="metaField_radio" type="radio" name="' . esc_attr( $field['id'] ) . '" value="' .esc_attr( $key ) . '" ' . $checked . '> ' . $label . '</label>';
							$count++;
						}
						
						echo '<p class="metaField_caption" style="color:#999">' . $field['desc'] . '</p>';
						echo '</div>';

					break;

					//If select array
					case 'select':

						echo '<div class="metaField_field_wrapper metaField_field_' . esc_attr( $field['id'] ) . '">';
						echo '<p><label for="' . esc_attr( $field['id'] ) . '"><strong>' . $field['name'] . '</strong></label></p>';

						echo '<select class="metaField_select" name="'. esc_attr( $field['id'] ) .'">';
						foreach ($field['options'] as $key => $label) {
							$selected = $meta == $key ? 'selected' : '';
							echo '<option value="' . esc_attr( $key ) . '" ' . $selected . '>' . $label . '</option>';
						}
						echo '</select>';
						
						echo '<p class="metaField_caption" style="color:#999">' . $field['desc'] . '</p>';
						echo '</div>';

					break;

					//If checkbox array
					case 'checkbox':

						echo '<div class="metaField_field_wrapper metaField_field_' . esc_attr( $field['id'] ) . '">';

						$checked = $meta ? 'checked="checked"' : '';
						echo '<label class="metaField_checkbox" style="display: block; padding: 2px 0;"><input class="metaField_checkbox" type="checkbox" name="'.esc_attr( $field['id'] ).'" value="1" ' . $checked . '> ' . $field['name'] . '</label>';
						
						echo '<p class="metaField_caption" style="color:#999">' . $field['desc'] . '</p>';
						echo '</div>';
					
					break;

					//If text array
					case 'text':

						echo '<div class="metaField_field_wrapper metaField_field_' . esc_attr( $field['id'] ) . '">';
						echo '<p><label for="' . esc_attr( $field['id'] ) . '"><strong>' . $field['name'] . '</strong></label></p>';

						echo '<input class="metaField_text" type="text" name="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $meta ) . '" style="width:100%;">';
						
						echo '<p class="metaField_caption" style="color:#999">' . $field['desc'] . '</p>';
						echo '</div>';
					
					break;
					
				}

				$increment++;
			}
		}

		/**
		 * Set metabox configurations.
		 *
		 */
		public function set_meta_box() {
			$this->unicase_page_metabox = array(
				'id' 		=> '_unicase_page_metabox',
				'title' 	=>  esc_html__('Unicase Page Attributes', 'unicase'),
				'page' 		=> array( 'page' ),
				'context' 	=> 'normal',
				'priority' 	=> 'low',
				'fields' 	=> array(
			    	array(
			    	   'name' 		=> esc_html__('Hide Page Title', 'unicase'),
			    	   'desc' 		=> esc_html__('Check this if you want to hide page title.', 'unicase'),
			    	   'id' 		=> 'hide_page_title',
			    	   'type' 		=> 'checkbox',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Hide Breadcrumb', 'unicase'),
			    	   'desc' 		=> esc_html__('Check this if you want to hide breadcrumb.', 'unicase'),
			    	   'id' 		=> 'hide_breadcrumb',
			    	   'type' 		=> 'checkbox',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Do not wrap the page in a container', 'unicase'),
			    	   'desc' 		=> esc_html__('Check this box if you do not want your content to be contained.', 'unicase'),
			    	   'id' 		=> 'do_not_wrap_page',
			    	   'type' 		=> 'checkbox',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Enable Sidebar', 'unicase'),
			    	   'desc' 		=> esc_html__('Check this if you want to show sidebar on this page.', 'unicase'),
			    	   'id' 		=> 'enable_sidebar',
			    	   'type' 		=> 'checkbox',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Page Sidebar', 'unicase'),
			    	   'desc' 		=> esc_html__('Check this if you want to show page sidebar instead of default sidebar.', 'unicase'),
			    	   'id' 		=> 'page_sidebar',
			    	   'type' 		=> 'checkbox',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Page Site Content Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your additional classes to the Site Content div', 'unicase'),
			    	   'id' 		=> 'site_content_classes',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Container Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your additional classes to the Container div', 'unicase'),
			    	   'id' 		=> 'container_classses',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Content Area Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your additional classes to the Content Area div', 'unicase'),
			    	   'id' 		=> 'content_area_classes',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Sidebar Area Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('If your layout has a sidebar, you can type your additional classes to the Sidebar div', 'unicase'),
			    	   'id' 		=> 'sidebar_area_classes',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Header Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your additional classes to the Header element', 'unicase'),
			    	   'id' 		=> 'header_classes',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Body Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your additional classes to the Body element', 'unicase'),
			    	   'id' 		=> 'body_classes',
			    	   'type' 		=> 'text',
			    	),
			    	array(
			    	   'name' 		=> esc_html__('Additional Page Footer Classes', 'unicase'),
			    	   'desc' 		=> esc_html__('You can type your classes to the Footer element', 'unicase'),
			    	   'id' 		=> 'footer_classes',
			    	   'type' 		=> 'text',
			    	)
			   	)
			);

			if( post_type_exists( 'static_block' ) ) {
					
				$args = apply_filters( 'unicase_static_block_get_posts_args', array(
					'posts_per_page'	=> -1,
					'orderby'			=> 'title',
					'post_type'			=> 'static_block',
				) );
				
				$static_blocks = get_posts( $args );

				if( ! empty( $static_blocks ) ) {
					$static_block_options_array = array( '' => esc_html__('Choose Static Content', 'unicase') );
					foreach( $static_blocks as $static_block ) {
						$static_block_options_array[$static_block->ID] = get_the_title( $static_block->ID );
					}
					$this->unicase_page_metabox['fields'][] = array(
						'name' 		=> esc_html__('Before Breadcrumb Content', 'unicase'),
						'desc' 		=> esc_html__('Choose one static block content', 'unicase'),
						'id' 		=> 'header_content_static_block_ID',
						'type' 		=> 'select',
						'options' 	=> $static_block_options_array
					);
				}
			}
		}
	}
}
