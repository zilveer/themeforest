<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( ThemeFuzz )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/zauan
 */

class ZnTemplateSystem {

	function __construct() {

		add_action( 'zn_framework_init', array(&$this, 'zn_register_template_system') );
		add_action( 'znpb_editor_tabs_content', array(&$this, 'zn_templates_tab') );
		add_action( 'znpb_editor_tabs_menu', array(&$this, 'zn_templates_tab_menu') );

		// SINGLE ELEMENT SAVING
		add_action( 'znpb_editor_tabs_content', array(&$this, 'zn_el_templates_tab') );
		add_action( 'znpb_editor_tabs_menu', array(&$this, 'zn_el_templates_tab_menu') );

	}

	function zn_register_template_system() {
		$args = array(
			'labels' => array('name' => 'Zn Framework' ),
			'show_ui' => false,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array( 'title' ),
			'can_export' => true,
			'public' => false,
			'show_in_nav_menus' => false
		);
		register_post_type( 'zn_pb_templates' , $args);
	}

	/**
	 *
	 *	GENERATE A TEMPLATE KEY FOR USE IN UPDATE POST META
	 *
	 */
	function zn_generate_key( $name ) {
		return "_zn_pb_template".str_replace(" ", "_", strtolower($name));
	}

	/**
	 *
	 *	GET POST ID IF EXISTS OR CREATE A NEW POST USING THE NAME PROVIDED
	 *
	 */
	function zn_get_post_id( $post_title = 'zn_pb_templates' ) {
		// GET THE POST THAT CONTAINS ALL THE TEMPLATES
		$zn_pb_template_post = get_page_by_title( $post_title , 'ARRAY_A' , 'zn_pb_templates' );

		if(!isset($zn_pb_template_post['ID']) )
		{

			$post = array(
				'post_type' => 'zn_pb_templates',
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_content' => '',
				'post_title' => $post_title
				);

			$post_id = wp_insert_post( $post );
		}
		else
		{
			$post_id = $zn_pb_template_post['ID'];
		}

		return $post_id;
	}

	/**
	 *
	 *	HOOK INTO PAGEBUILDER TAB NAMES LIST
	 *
	 */
	function zn_templates_tab_menu(){
		echo '<a href="#" data-zn-tab="zn_pb_templates" class="zn_pb_tab_handler">TEMPLATES</a>';
	}

	/**
	 *
	 *	HOOK INTO PAGEBUILDER TABS CONTENT
	 *
	 */
	function zn_templates_tab() {
		?>
		<div id="zn_pb_templates" class="zn_pb_templates zn_pb_tab zn_hide">
			<div class="zn_pb_sidebar">

				<div class="zn_pb_sidebar_more">
					<input type="checkbox" class="zn_pb_sidebar_more-chb" id="zn_pb_sidebar_more">
					<label class="zn_pb_sidebar_more-trig" for="zn_pb_sidebar_more">&#183;&#183;&#183;</label>
					<div class="zn_pb_sidebar_more-panel zn_pb_animate">
						<a href="#" class="zn_pb_clear_page"><span class="dashicons dashicons-trash"></span> CLEAR PAGE ELEMENTS</a>
					</div>
				</div>

				<div class="zn_pb_sidebar_btn-wrapper">
					<span class="zn_pb_sidebar_btn zn_pb_save_template zn_pb_animate">SAVE</span>
					<span class="zn_pb_sidebar_btn zn_pb_export_template zn_pb_animate">EXPORT</span>
				</div>

				<div class="zn_pb_sidebar-inner zn-sidebar-scroll">
					<div class="zn_pb_sidebar-content">
						<h4 class="zn_pb_sidebar-content-title">Save / Export<br>Template</h4>
						<input type="text" placeholder="Template name" class="znpb-template-name-input zn_pb_sidebar-content-input"/>
					</div>
				</div>

			</div>

			<div class="zn_pb_templates_container zn_pb_tab_content zn_has_isotope clearfix">

				<!-- Import Button -->
				<div class="zn_pb_template_container">
					<div class="zn_pb_template zn_pb_uploadtpl">
						<label class="zn_pb_el_icon zn_pb_el_uploadicon js-znpb_upload_template" for="znpb_upload_input" id="znpb_upload_input_label">
							<svg width="100px" height="100px" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<path d="M61.6702128,62.6293333 L39.3297872,62.6293333 C38.6691489,62.6293333 38.1329787,62.0917333 38.1329787,61.4293333 L38.1329787,46.5189333 C38.1329787,45.856 38.6691489,45.3189333 39.3297872,45.3189333 L44.3164894,45.3189333 C44.9771277,45.3189333 45.5132979,45.856 45.5132979,46.5189333 C45.5132979,47.1813333 44.9771277,47.7189333 44.3164894,47.7189333 L40.5265957,47.7189333 L40.5265957,60.2293333 L60.4734043,60.2293333 L60.4734043,47.7189333 L56.6835106,47.7189333 C56.0228723,47.7189333 55.4867021,47.1813333 55.4867021,46.5189333 C55.4867021,45.856 56.0228723,45.3189333 56.6835106,45.3189333 L61.6702128,45.3189333 C62.3308511,45.3189333 62.8670213,45.856 62.8670213,46.5189333 L62.8670213,61.4293333 C62.8670213,62.0917333 62.3308511,62.6293333 61.6702128,62.6293333 Z M55.3851064,53.5018667 L51.3478723,57.5498667 C51.2914894,57.6064 51.2271277,57.6581333 51.1606383,57.7018667 C51.1005319,57.7418667 51.0361702,57.7770667 50.9696809,57.8064 C50.9260638,57.8250667 50.8867021,57.8373333 50.8430851,57.8501333 C50.8074468,57.8624 50.7680851,57.8752 50.7308511,57.8773333 C50.7180851,57.8810667 50.7058511,57.8853333 50.6909574,57.8853333 C50.6308511,57.8981333 50.5664894,57.9018667 50.5042553,57.9018667 C50.4441489,57.9018667 50.3835106,57.8981333 50.3255319,57.8853333 C50.3090426,57.8853333 50.2941489,57.8810667 50.2776596,57.8773333 C50.2425532,57.8730667 50.2090426,57.8645333 50.1739362,57.8522667 C50.0904255,57.8272 50.0095745,57.7957333 49.9351064,57.7562667 C49.8702128,57.7210667 49.8079787,57.6773333 49.7521277,57.6293333 C49.7207447,57.6064 49.687766,57.5770667 49.6606383,57.5498667 L45.6234043,53.5018667 C45.1558511,53.0330667 45.1558511,52.2752 45.6234043,51.8064 C46.0909574,51.3376 46.8473404,51.3376 47.3148936,51.8064 L49.3095745,53.8021333 L49.3095745,40.5706667 C49.3095745,39.9104 49.843617,39.3706667 50.506383,39.3706667 C51.1648936,39.3706667 51.7031915,39.9104 51.7031915,40.5706667 L51.7031915,53.8021333 L53.693617,51.8064 C54.1611702,51.3376 54.9212766,51.3376 55.3888298,51.8064 C55.8505319,52.2752 55.8505319,53.0352 55.3851064,53.5018667 Z" fill="#757780"></path>
								<rect stroke="#979797" stroke-width="3" x="3" y="3" width="94" height="94" rx="8"></rect>
							</svg>
							<span class="zn_pb_el_uploadicon-progress" id="zn_pb_el_uploadicon-progress"></span>
						</label>
						<input id="znpb_upload_input" class="znpb_upload_input" type="file" name="znpb_template_upload_input" />
						<div class="zn_pb_el_title">IMPORT TEMPLATE</div>
					</div>
				</div>

				<?php

					$templates = $this->zn_pb_get_templates();

					if ( is_array( $templates ) ) {
						foreach ( $templates as $template ) {
							$name = explode("}}}", $template);
							$name = explode("{{{", $name[0]);

							echo $this->template_render( $name[1] );

						}
					}
				?>

			</div>

		</div>
		<?php
	}

	/**
	 *
	 *	HOOK INTO PAGEBUILDER TAB NAMES LIST
	 *
	 */
	function zn_el_templates_tab_menu(){
		echo '<a href="#" data-zn-tab="zn_pb_el_templates" class="zn_pb_tab_handler znpb_saved_elements">SAVED ELEMENTS</a>';
	}

	/**
	 *
	 *	HOOK INTO PAGEBUILDER TABS CONTENT
	 *
	 */
	function zn_el_templates_tab() {
		?>
		<div id="zn_pb_el_templates" class="zn_pb_el_templates zn_pb_tab zn_hide">
			<div class="zn_pb_sidebar">

				<div class="zn_pb_sidebar-inner zn-sidebar-scroll">

					<div class="zn_pb_sidebar-content">
						<h4 class="zn_pb_sidebar-content-title">Saved elements</h4>
						<div class="zn_pb_sidebar-content-desc">
							<p>Here you will find all your saved elements. If you want to add a saved element to your page, just dragg it into your desired location.</p>
						</div>
					</div>

				</div>

			</div>

			<div class="zn_pb_saved_elements_container zn_pb_tab_content zn_has_isotope clearfix">

				<!-- Import Button -->
				<div class="zn_pb_template_container">
					<div class="zn_pb_template zn_pb_uploadtpl">
						<label class="zn_pb_el_icon zn_pb_el_uploadicon js-znpb_upload_template" for="znpb_upload_input" id="znpb_upload_input_label">
							<svg width="100px" height="100px" viewBox="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<path d="M61.6702128,62.6293333 L39.3297872,62.6293333 C38.6691489,62.6293333 38.1329787,62.0917333 38.1329787,61.4293333 L38.1329787,46.5189333 C38.1329787,45.856 38.6691489,45.3189333 39.3297872,45.3189333 L44.3164894,45.3189333 C44.9771277,45.3189333 45.5132979,45.856 45.5132979,46.5189333 C45.5132979,47.1813333 44.9771277,47.7189333 44.3164894,47.7189333 L40.5265957,47.7189333 L40.5265957,60.2293333 L60.4734043,60.2293333 L60.4734043,47.7189333 L56.6835106,47.7189333 C56.0228723,47.7189333 55.4867021,47.1813333 55.4867021,46.5189333 C55.4867021,45.856 56.0228723,45.3189333 56.6835106,45.3189333 L61.6702128,45.3189333 C62.3308511,45.3189333 62.8670213,45.856 62.8670213,46.5189333 L62.8670213,61.4293333 C62.8670213,62.0917333 62.3308511,62.6293333 61.6702128,62.6293333 Z M55.3851064,53.5018667 L51.3478723,57.5498667 C51.2914894,57.6064 51.2271277,57.6581333 51.1606383,57.7018667 C51.1005319,57.7418667 51.0361702,57.7770667 50.9696809,57.8064 C50.9260638,57.8250667 50.8867021,57.8373333 50.8430851,57.8501333 C50.8074468,57.8624 50.7680851,57.8752 50.7308511,57.8773333 C50.7180851,57.8810667 50.7058511,57.8853333 50.6909574,57.8853333 C50.6308511,57.8981333 50.5664894,57.9018667 50.5042553,57.9018667 C50.4441489,57.9018667 50.3835106,57.8981333 50.3255319,57.8853333 C50.3090426,57.8853333 50.2941489,57.8810667 50.2776596,57.8773333 C50.2425532,57.8730667 50.2090426,57.8645333 50.1739362,57.8522667 C50.0904255,57.8272 50.0095745,57.7957333 49.9351064,57.7562667 C49.8702128,57.7210667 49.8079787,57.6773333 49.7521277,57.6293333 C49.7207447,57.6064 49.687766,57.5770667 49.6606383,57.5498667 L45.6234043,53.5018667 C45.1558511,53.0330667 45.1558511,52.2752 45.6234043,51.8064 C46.0909574,51.3376 46.8473404,51.3376 47.3148936,51.8064 L49.3095745,53.8021333 L49.3095745,40.5706667 C49.3095745,39.9104 49.843617,39.3706667 50.506383,39.3706667 C51.1648936,39.3706667 51.7031915,39.9104 51.7031915,40.5706667 L51.7031915,53.8021333 L53.693617,51.8064 C54.1611702,51.3376 54.9212766,51.3376 55.3888298,51.8064 C55.8505319,52.2752 55.8505319,53.0352 55.3851064,53.5018667 Z" fill="#757780"></path>
								<rect stroke="#979797" stroke-width="3" x="3" y="3" width="94" height="94" rx="8"></rect>
							</svg>
							<span class="zn_pb_el_uploadicon-progress" id="zn_pb_el_uploadicon-progress"></span>
						</label>
						<input id="znpb_upload_input" class="znpb_upload_input" type="file" name="znpb_template_upload_input" />
						<div class="zn_pb_el_title">IMPORT ELEMENT</div>
					</div>
				</div>

				<?php

					$templates = $this->zn_pb_get_templates( 'zn_pb_el_templates' );

					if ( is_array( $templates ) ) {
						foreach ( $templates as $template ) {

							$template_data = maybe_unserialize( $template );
							$name = explode("}}}", $template_data['name']);
							$name = explode("{{{", $name[0]);

							echo $this->saved_element_render( $name[1], $template_data );

						}
					}
				?>

			</div>

		</div>
		<?php
	}


		/**
		 *
		 *	Retrieves all saved templates
		 *
		 */
		function zn_pb_get_templates( $post_name = 'zn_pb_templates', $template_name = '_zn_pb_template%' , $compare = 'LIKE' ) {

			global $wpdb;

			$post_id = $this->zn_get_post_id( $post_name );

			$r = $wpdb->get_col( $wpdb->prepare( "
				SELECT meta_value FROM {$wpdb->postmeta}
				WHERE  meta_key {$compare} '%s'
				AND post_id = '%s'
			",  $template_name , $post_id) );

			return $r;
		}

		function template_render( $name ){

			$key = $this->zn_generate_key($name);

			$template = '<div class="zn_pb_template_container" data-template="'.$key.'" data-level="1">';
				$template .= '<div class="zn_pb_template">';
					$template .=  '<img class="zn_pb_el_icon" src="'. FW_URL .'/pagebuilder/assets/img/default_icon.png'.'"/>';
					$template .=  '<div class="zn_pb_el_title">'.$name.'</div>';

					// TEMPLATE ACTIONS
					$template .=  '
					<div class="zn_pb_tpl_actions zn_pb_animate">
						<input type="checkbox" class="zn_pb_tpl_subactions-chb" id="'.$key.'">
						<label for="'.$key.'" class="zn_pb_tpl_subactions-trig">&#183;&#183;&#183;</label>
						<div class="zn_pb_tpl_subactions-panel">
							<a href="#" class="zn_pb_export_indv_template zn_pb_tpl_actions-btn zn_pb_animate tooltip-bottom" data-tooltip="EXPORT"><span class="dashicons dashicons-upload"></span></a>
							<a href="#" class="zn_pb_delete_template zn_pb_tpl_actions-btn zn_pb_animate tooltip-bottom" data-tooltip="DELETE"><span class="dashicons dashicons-trash"></span></a>
						</div>
						<a href="#" class="zn_pb_load_template zn_pb_tpl_actions-text-btn">LOAD TEMPLATE</a>
					</div>
					';

				$template .=  '</div>';
			$template .=  '</div>';

			return $template;
		}

		function saved_element_render( $name, $template_data ){

			if( empty( $template_data['template'] ) || empty( $template_data['level'] ) ){
				return;
			}


			$template_key = $this->zn_generate_key($name);
			$first_object = '';

			// error_log( var_export( $template_data['template'], 1 ) );

			// Get the first object
			if( is_array( $template_data['template'] ) ){
				foreach ($template_data['template'] as $key => $value) {
					if( isset( $value['object'] ) ){
						$first_object = $value['object'];
						break;
					}
				}
			}

			$template = '<div class="zn_pb_template_container zn_pb_element" data-object="'.$first_object.'" data-template="'.$template_key.'" data-level="'.$template_data['level'].'" data-issingle="true">';
				$template .= '<div class="zn_pb_template">';
					$template .=  '<img class="zn_pb_el_icon" src="'. FW_URL .'/pagebuilder/assets/img/default_icon.png'.'"/>';
					$template .=  '<div class="zn_pb_el_title">'.$name.'</div>';

					// TEMPLATE ACTIONS
					$template .=  '
					<div class="zn_pb_tpl_actions zn_pb_animate">
						<input type="checkbox" class="zn_pb_tpl_subactions-chb" id="'.$template_key.'">
						<label for="'.$template_key.'" class="zn_pb_tpl_subactions-trig">&#183;&#183;&#183;</label>
						<div class="zn_pb_tpl_subactions-panel">
							<a href="#" class="zn_pb_export_indv_template zn_pb_tpl_actions-btn zn_pb_animate tooltip-bottom" data-tooltip="EXPORT"><span class="dashicons dashicons-upload"></span></a>
							<a href="#" class="zn_pb_delete_saved_el zn_pb_tpl_actions-btn zn_pb_animate tooltip-bottom" data-tooltip="DELETE"><span class="dashicons dashicons-trash"></span></a>
						</div>
						<a href="#" class="zn_pb_tpl_actions-text-btn">DRAG TO PAGE</a>
					</div>
					';

				$template .=  '</div>';
			$template .=  '</div>';

			return $template;

		}

}