<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( Zauan )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/zauan
 */
class ZnPageBuilderEditor  {

	function __construct() {

		// Disable caching
		$this->disable_caching();

		add_action( 'zn_footer', array(&$this, 'zn_add_front_editor') );
		add_action( 'zn_footer', array(&$this, 'zn_add_factory') );
		add_action( 'zn_footer', array(&$this, 'znpb_add_templates' ) );

		add_action( 'wp_enqueue_scripts', array(&$this, 'load_scripts') );
		add_filter( 'body_class',array(&$this, 'zn_add_body_class'));

		// LOAD ALL THE ELEMENTS SCRIPTS AND INLINE JS
		add_action( 'wp_footer' , array(&$this, 'zn_add_inline_js') );
		add_action( 'zn_pb_content', array(&$this, 'zn_dummy_content') );

		// Fix post_type not added for ajax calls
		// See wp-includes/post-template.php -- ! is_admin
		add_filter( 'post_class', array( &$this, 'fix_post_classes' ) );
		add_filter( 'zn_pb_options', array( &$this, 'default_options' ), 10 );
	}

	function fix_post_classes( $classes, $class = '', $post_id = '' ){
		$post = get_post( $post_id );

		$classes[] = $post->post_type;

		return $classes;
	}

	function disable_caching(){

		// Disable W3 Total cache/WP Super Cache, for editing page
		if (!defined('DONOTCACHEPAGE'))
			define( 'DONOTCACHEPAGE', true );

		// Disable W3TC
		if ( class_exists('W3_Root') ) {

			if ( !defined( 'DONOTMINIFY') )
				define( 'DONOTMINIFY', true );

			if ( !defined( 'DONOTCDN') )
				define( 'DONOTCDN', true );
		}
	}

	function zn_add_body_class($classes) {
		$classes[] = 'zn_pb_editor_enabled';

		return $classes;
	}

	function zn_add_factory(){

		$elements_data = $page_options_data = array();
		$categories = $this->zn_categories();
		$widgets = array();
		foreach ( ZNPB()->all_available_elements as $class => $values) {

			if( $class === 'ZnWidgetElement' ){
				$widgets = ZNPB()->get_all_widgets();
				continue;
			}

			$elements_data[] = $values;

		}

		// Add all WordPress Widgets to editor
		foreach ($widgets as $key => $widget) {
			$widget_module = ZNPB()->all_available_elements['ZnWidgetElement'];
			$widget_module['name'] = 'Widget - '.$widget->name;
			$widget_module['widget_id'] = $widget->class;
			$elements_data[] = $widget_module;
		}

		// Get the page options
		include_once( THEME_BASE.'/template_helpers/pagebuilder/page_options.php');
		unset( $options['has_tabs'] );

		// Loop trough all the options tabs
		foreach ( $options as $key => $tab ) {
			foreach ( $tab['options'] as $key => $option ) {
				$page_options_data[$option['id']] = get_post_meta( ZNPB()->get_post_id(), $option['id'], true );
			}
		}
		?>
		<!-- PAGEBUILDER FACTORY -->
		<script>

			!function ($) {
				$.ZnPbFactory = {
					current_layout : <?php echo json_encode( ZNPB()->current_modules ); ?>,
					elements_data : <?php echo json_encode( $elements_data ); ?>,
					pb_menu :<?php echo json_encode( $categories ); ?>,
					page_options :<?php echo json_encode( $page_options_data ); ?>,
					fonts_list : <?php echo json_encode( ZN()->fonts->get_fonts_array() ); ?>,
				};
			}(jQuery)

		</script><?php
	}

	function znpb_add_templates(){
		?>
		<script type="text/html" id="tmpl-znfb-pbelement-content">
			<div class="zn_pb_element ui-draggable ui-draggable-handle" data-keywords="{{{ data.name }}}, {{{ data.keywords }}}" data-object="{{data.class}}" data-level="{{data.level}}" data-widget="{{data.widget_id}}">
				<img class="zn_pb_el_icon" src="{{data.icon}}">
				<div class="zn_pb_el_title">
					{{{ data.name }}}
				</div>
				<div class="zn_pb_el_category">{{{data.category}}}</div>
			</div>
		</script>

		<script type="text/html" id="tmpl-znfb-pbsidebar-content">
			<a href="#" class="{{data.css_class}}" data-filter="{{data.filter}}"><span class="zn_pb_circle"></span>{{{data.name}}}</a>
		</script>

		<script type="text/html" id="tmpl-znfb-editorpbtab-content">
			<div class="zn_pb_sidebar zn-sidebar-scroll">
				<ul class="zn_pb_groups"></ul>
			</div>
			<div class="zn_pb_elements zn_pb_tab_content clearfix" id="znpb_editor_elements"></div>
		</script>


		<?php
	}

	function build_options_array( $layout_data, $single = false ) {

		if( empty( $layout_data ) ) { return array(); }

		$data = array();

		foreach ( $layout_data as $key => $module ) {

			$data[ $module['uid'] ] = $module;
			$data[ $module['uid'] ]['content'] = array();

			if( !empty( $module['content'] ) ) {

				if ( !empty( $module['content']['has_multiple'] ) ) {

					unset( $module['content']['has_multiple'] );

					foreach ( $module['content'] as $actual_content ) {
						$data = array_merge( $data, $this->build_options_array( (array)$actual_content ) );
					}

				}
				else {
					$data = array_merge( $data, $this->build_options_array( $module['content'] ) );
				}
			}
		}

		return $data;
	}

	static public function enable_editor(){
		$post_id = zn_get_the_id();
		$post = get_post( $post_id );

		// Save the post as draft if this is an auto-draft
		if ( $post->post_status === 'auto-draft' ) {
			$post_data = array( 'ID' => $post_id, 'post_status' => 'draft' );
			wp_update_post( $post_data );
		}

		update_post_meta( $post_id, 'zn_page_builder_status', 'enabled');

	}

	static public function disable_editor(){
		$post_id = zn_get_the_id();
		update_post_meta( $post_id, 'zn_page_builder_status', 'disabled' );
	}

	function zn_dummy_content(){

		$args = array(
			'editor_class' => 'zn_tinymce',
			'default_editor' => 'tmce',
			'textarea_name' => 'zn_dummy_editor_id',
			'textarea_rows' => 5,
			'tinymce' => array(
				'setup' => 'function(editor) {
					editor.on( "change SetContent" , function( e ){
						editor.save();
					});
				}'
			)
		);

		echo '<div class="zn_hidden">';
			wp_editor( 'dummy_text', 'zn_dummy_editor_id', $args );
		echo '</div>';
	}

	function load_scripts(){

		wp_enqueue_style( 'zn_pb_style', FW_URL .'/pagebuilder/assets/css/zn_front_pb.css');

		wp_register_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext');
		wp_enqueue_style( 'open-sans');

		// PB SPECIFIC PLUGINS
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'jquery-ui-sortable' ); // HTML + PB
		wp_enqueue_script( 'jquery-ui-draggable' ); // PB

		// IRIS IS NOT AVAILABLE IN FRONTEND SO WE NEED TO MANUALLY LOAD IT
		wp_enqueue_script('iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_enqueue_script('wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );
		$colorpicker_l10n = array(
			'clear' => __( 'Clear', 'zn_framework' ),
			'defaultString' => __( 'Default', 'zn_framework' ),
			'pick' => __( 'Select Color', 'zn_framework' )
		);
		wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );

		// Include alloy editor
		// wp_enqueue_script( 'alloy-editor-min', FW_URL .'/assets/plugins/alloy-editor/alloy-editor-all.js', array(), ZN_FW_VERSION,true );
		wp_enqueue_style( 'alloy-editor-min', FW_URL .'/pagebuilder/assets/js/alloy-editor/assets/alloy-editor-ocean.css', array(), ZN_FW_VERSION );


		// PAGE BUILDER CUSTOM SCRIPTS
		wp_enqueue_script( 'zn_front_pb', FW_URL .'/pagebuilder/assets/js/frontend_pagebuilder.bundle.js',array('jquery','zn_html_script', 'backbone', 'underscore', 'wp-util' ), ZN_FW_VERSION, true );
		wp_localize_script( 'zn_front_pb', 'ZnKlPb', array(
			'ALLOYEDITOR_BASEPATH' => FW_URL .'/pagebuilder/assets/js/alloy-editor/',
			'CKEDITOR_BASEPATH' => FW_URL .'/pagebuilder/assets/js/alloy-editor/',
		));

		ZN()->load_html_scripts();

		// Load all JS files that are required by the elements
		foreach( ZN()->pagebuilder->all_available_elements as $class => $element ){
			if ( $element['scripts'] ) {
				include_once( $element['file'] );
				$element = new $element['class'];
				$element->scripts();
			}
		}

	}

	function zn_add_inline_js() {
		do_action( 'zn_pb_inline_js' );
	}

	function zn_add_front_editor() {
		require( PB_PATH .'/templates/editor.tpl.php' );
	}

	function zn_categories(){

		$categories = array(
			array( 'filter' => '*', 'name' => 'All elements', 'css_class' => 'zn_pb_selected zn_pb_all' ),
			array( 'filter' => '.fullwidth', 'name' => 'Full width' ),
			array( 'filter' => '.layout', 'name' => 'Layouts' ),
			array( 'filter' => '.content', 'name' => 'Content' ),
			array( 'filter' => '.post', 'name' => 'Single elements' ),
			array( 'filter' => '.media', 'name' => 'Media' ),
			array( 'filter' => '.headers', 'name' => 'Headers' ),
			array( 'filter' => '.widgets', 'name' => 'Widgets' ),
		);

		return apply_filters( 'zn_pb_categories', $categories );
	}

	/* EDITOR RENDER ELEMENTS METHOD */
	function default_options( $options ) {

		if( empty( $options ) ) { return $options; }

		$default_options = array();

		$default_options[] = array (
			"name"        => __( "Element display?", 'zn_framework' ),
			"description" => __( "Using this option you can show/hide the element for different type of visitors.", 'zn_framework' ),
			"id"          => "znpb_hide_visitors",
			"std"         => "all",
			"type"        => "select",
			"options"     => array (
				"all" => __( "Show for all", 'zn_framework' ),
				"loggedin"  => __( "Show only for logged in users", 'zn_framework' ),
				"visitor"  => __( "Show only for visitors ( not logged in )", 'zn_framework' )
			)
		);

		$default_options[] = array(
			'id'          => 'css_class',
			'name'        => 'CSS class',
			'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
			'type'        => 'text',
			'std'         => '',
		);

		if( isset($options['znpb_misc']['disable']) && in_array('znpb_hide_breakpoint', $options['znpb_misc']['disable']) ) {
			// nothing
		}
		else {
			$default_options[] = array (
				"name"        => __( "Hide element on breakpoints", 'zn_framework' ),
				"description" => __( "Choose to hide the element on either desktop, mobile or tablets. Please know that elements will not be hidden in Page builder edit mode, only normal View mode.", 'zn_framework' ),
				"id"          => "znpb_hide_breakpoint",
				"std"         => "",
				"type"        => "checkbox",
				"supports"	  => array( 'zn_radio' ),
				"options"     => array (
					"lg" => __( "Large", 'zn_framework' ),
					"md"  => __( "Medium", 'zn_framework' ),
					"sm"  => __( "Small", 'zn_framework' ),
					"xs"  => __( "Extra Small", 'zn_framework' )
				),
				'class' => 'zn_breakpoints_classic'
			);
		}


		if( isset( $options['has_tabs'] ) ){

			// Re-order tabs
			if( ! empty( $options['help'] ) ){
				$help = $options['help'];
				unset( $options['help'] );
			}

			$options['znpb_misc'] = array(
				'title' => 'Misc. Options',
				'options' => $default_options,
			);

			// Re-order tabs
			if( ! empty( $help ) ){
				$options['help'] = $help;
			}
		}
		else{
			$options = array_merge( $options, $default_options );
		}

		return $options;
	}

	function before_element( $element ) {

		$size = '';
		$css_class = '';
		if ( $element->info['flexible'] ) {

			$size = ( !empty( $element->data['width'] ) ) ? $element->data['width'] : 'col-md-12';
			if ( strpos( $size, 'col-md-') === false ) { $size = str_replace('col-sm-', 'col-md-', $size); }
			$actual_size = $size;

			// RESPONSIVE FIXES
			$size_small = ( !empty( $element->data['options']['size_small'] ) ) ? $element->data['options']['size_small'] : str_replace('col-md-', 'col-sm-', $size);
			$size_xsmall = ( !empty( $element->data['options']['size_xsmall'] ) ) ? $element->data['options']['size_xsmall'] : '';
			$size_large = ( !empty( $element->data['options']['size_large'] ) ) ? $element->data['options']['size_large'] : str_replace('col-md-', 'col-lg-', $size);
			//
			// if ( !empty( $element->data['options']['size_large'] ) ){
			// 	$actual_size = str_replace('col-lg-', 'col-md-', $size_large);
			// 	$size .= ' ' . $size_large;
			// }

			// Set the proper responsive classes
			$size = $size .' '. $size_small .' '. $size_xsmall;


			$css_class = 'sortable_column';
			$element->data['width'] = 'zn_edit_mode';
			$element->data['options']['size_small'] = 'zn_edit_mode';
			$element->data['options']['size_xsmall'] = 'zn_edit_mode';
			$element->data['options']['size_large'] = 'zn_edit_mode';

		}

		// Check for LG Offset, if not, use SM's
		if( isset($element->data['options']['column_offset_lg']) && !empty($element->data['options']['column_offset_lg']) ) {
			$size .= ' '.$element->data['options']['column_offset_lg'].' ';
		} else {
			if ( !empty( $element->data['options']['column_offset'] ) ){
				$size .= ' '.str_replace('sm', 'lg', $element->data['options']['column_offset']).' ';
			}
		}

		// Check for MD Offset, if not, use SM's
		if( isset($element->data['options']['column_offset_md']) && !empty($element->data['options']['column_offset_md']) ) {
			$size .= ' '.$element->data['options']['column_offset_md'].' ';
		} else {
			if ( !empty( $element->data['options']['column_offset'] ) ){
				$size .= ' '.str_replace('sm', 'md', $element->data['options']['column_offset']).' ';
			}
		}

		if ( !empty( $element->data['options']['column_offset'] ) ){
			$size .= ' '.$element->data['options']['column_offset'].' ';
		}


		$uid = zn_uid();

		echo '<div class="zn_pb_el_container zn_pb_section '.$size.' zn_element_'.strtolower($element->info['class']).'" data-form-uid="'.$uid.'" data-el-name="'.$element->info['name'].' options" data-uid="'.$element->data['uid'].'" data-level="'.$element->info['level'].'" data-object="'.$element->info['class'].'" data-has_multiple="'.$element->info['has_multiple'].'">';
			echo '<div class="zn_el_options_bar zn_pb_animate">';

				// SHOW THE WIDTH SELECTOR BUTTON
				if ( $element->info['flexible'] ) {

					$sizes = array(
						'col-md-12' => '12/12' ,
						'col-md-11' => '11/12' ,
						'col-md-10' => '10/12' ,
						'col-md-9'  => '9/12' ,
						'col-md-8'  => '8/12' ,
						'col-md-7'  => '7/12' ,
						'col-md-6'  => '6/12' ,
						'col-md-5'  => '5/12' ,
						'col-md-4'  => '4/12' ,
						'col-md-3'  => '3/12' ,
						'col-md-2'  => '2/12',
						'col-md-1-5'  => '1/5',
					);

					echo '<span class="zn_pb_select_width znpb_icon-resize-full zn_pb_icon">';
						echo '<span class="znpb_sizes_container">';

							foreach ( $sizes as $key => $value ) {
								$selected_width = '';
								if ( $key == $actual_size ) { $selected_width = ' class="selected_width" '; }
								echo '<span '.$selected_width.' data-width="'.$key.'">'.$value.'</span>';
							}

						echo '</span>';
					echo '</span>';
					//echo '<span class="zn_pb_increase zn_icon">&#xe2d3;</span>';
				}

				echo '<span class="znpb-element-title">'.$element->info['name'].'</span>';
				echo '<a class="zn_pb_remove znpb_icon-cancel zn_pb_icon"></a>';

				echo '<a class="zn_pb_group_handle znpb_icon-move zn_pb_icon" data-level="'.$element->info['level'].'"></a>';
				echo '<a class="zn_pb_clone_button znpb_icon-docs zn_pb_icon" data-clone="clone"></a>';

				// Element options
				if( $element->options() ) {
					echo '<a data-uid="'.$element->data['uid'].'" class="znpb-element-options-trigger zn_pb_edit_el znpb_icon-cog-alt zn_pb_icon"></a>';
				}

				// Element save
				echo '<a data-uid="'.$element->data['uid'].'" class="znpb-element-save-trigger znpb_icon-save zn_pb_icon"></a>';

				echo '</div>'; // END OPTIONS BAR


	}

	function after_element( $element ){
		echo '</div>'; // END ELEMENT
	}

}
?>
