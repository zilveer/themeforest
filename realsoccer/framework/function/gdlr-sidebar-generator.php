<?php
	/*	
	*	Goodlayers Sidebar Generator
	*	---------------------------------------------------------------------
	*	This file create the class that help you to controls the sidebar 
	*	at the appearance > widget area
	*	---------------------------------------------------------------------
	*/
	
	if( !class_exists('gdlr_sidebar_generator') ){
		
		class gdlr_sidebar_generator{
			
			var $option_name = 'gdlr_sidebar_name';
			
			var $sidebars = array();
			var $footer_widgets = array();
			
			function __construct(){
				global $pagenow;
				if( is_admin() && $pagenow == 'customize.php' ) return;			
			
				$this->footer_widgets = array(
					array( 'name'=>'Footer 1', 'description'=>__('Footer Column 1', 'gdlr_translate') ), 
					array( 'name'=>'Footer 2', 'description'=>__('Footer Column 2', 'gdlr_translate') ), 
					array( 'name'=>'Footer 3', 'description'=>__('Footer Column 3', 'gdlr_translate') ), 
					array( 'name'=>'Footer 4', 'description'=>__('Footer Column 4', 'gdlr_translate') )
				);
				
				$this->sidebars = get_option($this->option_name, array());
				if( !is_array($this->sidebars) ){ $this->sidebars = array(); }
				
				$this->register_sidebar();
				
				// add the script when opening the admin widget section
				add_action('load-widgets.php', array(&$this, 'load_admin_script') );
				add_action('load-widgets.php', array(&$this, 'load_admin_script') );
				
				// set the hook for adding/removing sidebar
				add_action('wp_ajax_gdlr_add_sidebar', array(&$this, 'gdlr_add_sidebar'));	
				add_action('wp_ajax_gdlr_remove_sidebar', array(&$this, 'gdlr_remove_sidebar'));	
								
			}
			
			// register sidebar to use in widget area
			function register_sidebar(){
				$sidebar_id = 1;
				
				$args = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s gdlr-item gdlr-widget">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="gdlr-widget-title">',
					'after_title'   => '</h3><div class="clear"></div>' );		

				// sidebar for footer section
				$footer_args = apply_filters('gdlr_footer_widget_args', array());
				$footer_args = wp_parse_args($footer_args, $args);
				foreach ( $this->footer_widgets as $widget ){
					if( !is_array($widget) ){
						$footer_args['name'] = $widget;
						$footer_args['description'] = __('Custom widget area', 'gdlr_translate');
					}else{
						$footer_args['name'] = $widget['name'];
						$footer_args['description'] = $widget['description'];
					}
					
					$footer_args['id'] = 'sidebar-' . $sidebar_id;
					$sidebar_id++;
					register_sidebar($footer_args);
				}
				
				// sidebar for content section
				$sidebar_args = apply_filters('gdlr_sidebar_widget_args', array());
				$sidebar_args = wp_parse_args($sidebar_args, $args);				
				$sidebar_args['class'] = 'gdlr-dynamic';
				foreach ( $this->sidebars as $sidebar ){
					$sidebar_args['name'] = $sidebar;
					$sidebar_args['description'] = __('Custom widget area', 'gdlr_translate');
					
					$sidebar_args['id'] = 'sidebar-' . $sidebar_id;
					$sidebar_id++;
					register_sidebar($sidebar_args);
				}
				
			}
			
			// load the necessary script for the sidebar creator item
			function load_admin_script(){
				
				// include the sidebar generator style
				wp_enqueue_style('gdlr-alert-box', GDLR_PATH . '/framework/stylesheet/gdlr-alert-box.css');
				wp_enqueue_style('gdlr-sidebar-generator', GDLR_PATH . '/framework/stylesheet/gdlr-sidebar-generator.css');
			
				// include the sidebar generator script
				wp_enqueue_script('gdlr-alert-box', GDLR_PATH . '/framework/javascript/gdlr-alert-box.js');
				wp_enqueue_script('gdlr-sidebar-generator', GDLR_PATH . '/framework/javascript/gdlr-sidebar-generator.js');
				
				// execute the sidebar generator script
				add_action('admin_print_scripts', array(&$this, 'gdlr_create_sidebar_script') );
				
			}
			
			// add the necessary variable for ajax purpose
			function gdlr_create_sidebar_script(){
?>
<script type="text/javascript"> 
var gdlr_nonce = "<?php echo wp_create_nonce(THEME_SHORT_NAME . '-create-nonce'); ?>";
var gdlr_title = "<?php _e('Create New Sidebar' ,'gdlr_translate'); ?>";
var gdlr_ajax = "<?php echo AJAX_URL; ?>";
</script>		
<?php
			}
			
			// add new sidebar ajax module
			function gdlr_add_sidebar(){
				if( !check_ajax_referer(THEME_SHORT_NAME . '-create-nonce', 'security', false) ){
					die(json_encode(array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Invalid Nonce', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
					)));
				}
				
				if( isset($_POST['sidebar_name']) ){		
					
					if( !in_array(trim($_POST['sidebar_name']), $this->sidebars) ){
						
						array_push($this->sidebars, gdlr_stripslashes(trim($_POST['sidebar_name'])));
						
						if( update_option($this->option_name, $this->sidebars) ){
							$ret = array(
								'status'=> 'success'
							);		
						}else{
							$ret = array(
								'status'=> 'failed', 
								'message'=> '<span class="head">' . __('Save Sidebar Failed', 'gdlr_translate') . '</span> ' .
								__('Please try creating the sidebar again with different name.' ,'gdlr_translate')
							);						
						}
	
					}else{
						$ret = array(
							'status'=> 'failed', 
							'message'=> '<span class="head">' . __('Duplicated Sidebar Name', 'gdlr_translate') . '</span> ' .
							__('Please try creating the sidebar again with different name.' ,'gdlr_translate')
						);					
					}
				}else{
					$ret = array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Cannot Retrieve Sidebar Name', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
					);	
				}
				
				die(json_encode($ret));
			}	

			// add new sidebar ajax module
			function gdlr_remove_sidebar(){
				if( !check_ajax_referer(THEME_SHORT_NAME . '-create-nonce', 'security', false) ){
					die(json_encode(array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Invalid Nonce', 'gdlr_translate') . '</span> ' .
							__('Please refresh the page and try this again.' ,'gdlr_translate')
					)));
				}
				
				if( isset($_POST['sidebar_name']) ){		
				
					$current_sidebar = gdlr_stripslashes(trim(strip_tags($_POST['sidebar_name'])));
					
					$key = array_search($current_sidebar, $this->sidebars);
					unset($this->sidebars[$key]);
					
					if( update_option($this->option_name, $this->sidebars) ){
						$ret = array(
							'status'=> 'success'
						);		
					}else{
						$ret = array(
							'status'=> 'failed', 
							'message'=> '<span class="head">' . __('Save Failed', 'gdlr_translate') . '</span> ' .
							__('Please try again.' ,'gdlr_translate')
						);						
					}
				}else{
					$ret = array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . __('Cannot Retrieve Sidebar Name', 'gdlr_translate') . '</span> ' .
							__('Please try again.' ,'gdlr_translate')
					);	
				}
				
				die(json_encode($ret));
			}

			// get all sidebar array
			function get_sidebar_array(){
				$ret = array();

				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					if( !in_array( $sidebar['name'], $this->footer_widgets ) ){
						$ret[$sidebar['name']] = $sidebar['name'];
					}
				}
				return $ret;
			}

		}
		
	}
	

?>