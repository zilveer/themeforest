<?php 
class AdminTheme extends Theme
{
	protected $tabs = array();
	
	protected $arrLayout = array();
		
	public function __construct(){
		$this->constants();
		$this->resetArrLayout();
		$this->initTabs();
		add_action( 'admin_menu', array($this,'generatePanelHtml'));
		//add_action('admin_init',array($this,'loadJSCSS'));
		add_action('admin_enqueue_scripts',array($this,'loadJSCSS'));
		////// load custom field ///////
		require_once THEME_ADMIN.'/custom_fields.php';
		if(file_exists(THEME_EXTENDS_ADMIN.'/custom_fields.php')){
			require_once THEME_EXTENDS_ADMIN.'/custom_fields.php';
			$classCustomFields = 'CustomFields'.strtoupper(substr(THEME_SLUG,0,strlen(THEME_SLUG)-1));
		}
		else{
			$classCustomFields = 'CustomFields';
		}
		$customFields = new $classCustomFields();
		
		////// hook action ajax save config of epanel ///////
		require_once THEME_ADMIN_AJAX.'/epanel.php';
		if(file_exists(THEME_EXTENDS_ADMIN_AJAX.'/epanel.php')){
			require_once THEME_EXTENDS_ADMIN_AJAX.'/epanel.php';
			$epanel = 'AjaxEpanel'.strtoupper(substr(THEME_SLUG,0,strlen(THEME_SLUG)-1));
		}
		else{
			$epanel = 'AjaxEpanel';
		}
		$epanel = new $epanel();
		
		if( class_exists('bbPress') ){
			add_action( 'admin_menu', array($this, 'hide_category_from_forum_post'));
			add_action( 'admin_menu', array($this, 'add_forum_meta_box'));
			add_action( 'save_post', array($this, 'forum_save_meta_post'), 1, 2);
		}
		//$this->AddCustomSidebarLayoutTagCat();
		/* Include inport file */
		if( is_admin() ){
			include_once get_template_directory() . '/framework/admin/importer/importer.php';
		}
	}
	
	public function constants(){
		define('THEME_ADMIN_JS', THEME_ADMIN_URI . '/js');
		define('THEME_ADMIN_CSS', THEME_ADMIN_URI . '/css');
		define('THEME_ADMIN_IMAGES', THEME_ADMIN_URI . '/images');
		define('THEME_ADMIN_AJAX', THEME_ADMIN . '/ajax');
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
		define('THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define('THEME_ADMIN_METABOXES', THEME_ADMIN . '/metaboxes');
		define('THEME_ADMIN_DOCS', THEME_ADMIN . '/docs');
		define('THEME_ADMIN_TPL', THEME_ADMIN . '/template');
		
		if( function_exists('vc_set_shortcodes_templates_dir') ){
			vc_set_shortcodes_templates_dir(THEME_ADMIN_TPL ."/vc_template");
		}
		
		
		// the option name custom sidebar(layout) for category and tag
 		define('MY_CATEGORY_SIDEBAR', THEME_SLUG.'my_category_sidebar_option');
		define('MY_TAG_SIDEBAR', THEME_SLUG.'my_tag_sidebar_option');
	}
	
	protected function setArrLayout($array = array()){
		$this->arrLayout = $array;
	}
	
	/* Set defaulr value for array layout */
	protected function resetArrLayout(){
		$this->setArrLayout(array(
			'1column'		=>	array(	'image'	=>	'i_1column.png', 		'title'	=>	__('Content - No Sidebar','wpdance')	),
			'2columns-left'	=>	array(	'image'	=>	'i_3columns_right.png', 	'title'	=>	__('Content - Left Sidebar','wpdance')),
			'2columns-right'=>	array(	'image'	=>	'i_3columns_left.png', 'title'	=>	__('Content - Right Sidebar','wpdance')),
		));
		
	}
	
	protected function getArrLayout(){
		return $this->arrLayout;
	}
	
	public function inline_js(){
	?>
	    <script type="text/javascript">
		//<![CDATA[
			template_path = '<?php echo get_template_directory_uri(); ?>';
		//]]>
		</script>
	<?php
	}
	
	public function hide_category_from_forum_post(){
		remove_meta_box( 'forum_catdiv' , 'forum' , 'normal' ); 
		remove_meta_box( 'tagsdiv-forum_cat' , 'forum' , 'normal' ); 
	}
	public function add_forum_meta_box(){
		if(post_type_exists('forum')) {
			add_meta_box("wd_forum_metabox", "Forum Options", array($this,"forum_meta_box_html"), "forum", "normal", "high");
		}
	}
	public function forum_meta_box_html(){
		global $post;
		$args = array(
					'orderby'		=> 'name'
					,'order'		=> 'asc'
					,'hide_empty'	=> 0
					);
		$forum_cats = wd_get_forum_categories($args);
		$current_cats = wp_get_object_terms($post->ID,'forum_cat');
		if( is_array($current_cats) && !empty($current_cats) )
			$current_cat_id = $current_cats[0]->term_id;
		else
			$current_cat_id = '';
		?>
		<div class="forum_cat_box_meta">
			<label for="forum_category"><?php _e('Select Category','wpdance'); ?></label>
			<select name="forum_category" id="forum_category">
				<option value=""></option>
				<?php foreach($forum_cats as $forum_cat): ?>
				<option value="<?php echo $forum_cat->term_id ?>" <?php selected($forum_cat->term_id,$current_cat_id,true); ?>><?php echo $forum_cat->name; ?></option>
				<?php endforeach; ?>
			</select>
			<input type="hidden" name="_wd_bbpress_forum_meta" value="1"/>
		</div>
		<?php
	}
	public function forum_save_meta_post($post_id, $post){
		if ($post->post_type == 'revision')
			return;
		if (!current_user_can('edit_post', $post->ID))
			return $post->ID;
			
		if( isset($_POST['_wd_bbpress_forum_meta']) ){
			$cat_id = $_POST['forum_category'];
			if( !is_int($cat_id) ) 
				$cat_id = (int)$cat_id;
			wp_set_object_terms($post_id, $cat_id, 'forum_cat');
		}
	}
	
	public function initTabs(){
		add_action('admin_head', array($this,'inline_js'));
		
		$this->tabs = array(
			array(
				'slug'	=>	'general',
				'name'	=>	'General'
			)
			,array(
				'slug'	=>	'custom-interface',
				'name'	=>	'Custom interface'
			)
			/*,array(
				'slug'	=>	'advertisement',
				'name'	=>	'Advertisement'
			)*/
			,array(
				'slug'	=>	'custom-code-area',
				'name'	=>	'Custom Code Area'
			)
			,array(
				'slug'	=>	'mega-menu',
				'name'	=>	'Mega Menu'
			)			
			,array(
				'slug'	=>	'sidebar-manager',
				'name'	=>	'Custom Sidebar'
			)							
			,array(
				'slug'	=>	'product-category',
				'name'	=>	'Product Category Page'
			)			
			,array(
				'slug'	=>	'product-details',
				'name'	=>	'Product Details Page'
			)
			,array(
				'slug'	=>	'listing-page',
				'name'	=>	'Archive Page'
			)			
			,array(
				'slug'	=>	'customforpostsingle',
				'name'	=>	'Single Post Page'
			)			
		);
	}
	
	public function loadPanelContainer(){
		if(file_exists(THEME_EXTENDS_ADMIN_TPL.'/epanel/panel_container.php'))
			require_once THEME_EXTENDS_ADMIN_TPL.'/epanel/panel_container.php';
		else	
			require_once THEME_ADMIN_TPL.'/epanel/panel_container.php';
	}
	
	public function loadPanel(){
		$this->loadPanelContainer();
	}
	
	public function generatePanelHtml(){
		//add_theme_page(THEME_NAME.' Config', "Theme Options", 'switch_themes', 'wp_admin', array($this,'loadPanel'));
		//add_menu_page(THEME_NAME.' Config'," WPDance", 'switch_themes', 'wp_admin', array($this,'loadPanel'),get_bloginfo('template_directory').'/images/wpdance.png',63);
	}
	
	protected function loadSidebarLeftPanel(){
		if(file_exists(THEME_EXTENDS_ADMIN_TPL.'/epanel/sidebar_left.php'))
			require_once THEME_EXTENDS_ADMIN_TPL.'/epanel/sidebar_left.php';
		else
			require_once THEME_ADMIN_TPL.'/epanel/sidebar_left.php';
	}
	
	protected function loadContentPanel(){
		foreach($this->tabs as $index => $tab){
			if(file_exists(THEME_EXTENDS_ADMIN_TPL.'/epanel/'.$tab['slug'].'.php'))
				require_once THEME_EXTENDS_ADMIN_TPL.'/epanel/'.$tab['slug'].'.php';
			else	
				require_once THEME_ADMIN_TPL.'/epanel/'.$tab['slug'].'.php';
		}
	}
	
	/* Add custom sidebar and layout for tag and category */
	protected function AddCustomSidebarLayoutTagCat(){
		add_filter('edit_category_form', array($this,'generateCategoryFields'),0);
		add_action('edit_tag_form_fields',array($this,'generateTagFields'),0);
		add_filter('edited_terms', array($this,'updateCategoryTagFields'));
		add_filter('deleted_term_taxonomy', array($this,'removeCategoryTagFields'));
	}
	
	/* Generate Custom Sidebar and Layout for category */
	public function generateCategoryFields($tag) {
		require_once THEME_ADMIN_TPL.'/custom_sidebar_layout/category.php';
	}
	
	/* Generate Custom Sidebar and Layout for tag */
	public function generateTagFields($tag) {
		require_once THEME_ADMIN_TPL.'/custom_sidebar_layout/tag.php';
	}
	
	/* Save custom sidebar and layout for category and tag */
	function updateCategoryTagFields($term_id) {
			$tag_extra_fields = get_option(MY_CATEGORY_SIDEBAR);
			$tag_extra_fields[$term_id]['cat_post_sidebar'] = strip_tags($_POST['cat_post_sidebar']);
			$tag_extra_fields[$term_id]['cat_post_layout'] = strip_tags($_POST['cat_post_layout']);
			update_option(MY_CATEGORY_SIDEBAR, $tag_extra_fields);
	}
	
	/* Remove custom sidebar and layout of a tag(category) when it is removed */
	public function removeCategoryTagFields($term_id) {
			$tag_extra_fields = get_option(MY_CATEGORY_SIDEBAR);
			unset($tag_extra_fields[$term_id]);
			update_option(MY_CATEGORY_SIDEBAR, $tag_extra_fields);
	}
	
	protected function showTooltip($title,$content){	
		include THEME_ADMIN_TPL.'/epanel/tooltip.php';
	}
	
	public function loadJSCSS(){
		wp_enqueue_script('jquery');
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-mouse");
		wp_enqueue_script("jquery-ui-sortable");
		wp_enqueue_script("jquery-ui-slider");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-effects-core");
		wp_enqueue_script("jquery-effects-slide");
		wp_enqueue_script("jquery-effects-blind");	
		wp_register_script( 'jqueryform', THEME_FRAMEWORK_JS_URI.'/jquery.form.js');
		wp_enqueue_script('jqueryform');
		if(file_exists(THEME_EXTENDS_ADMIN.'/js/tab.js'))
			wp_register_script( 'tab', THEME_EXTENDS_ADMIN_JS.'/tab.js');
		else	
			wp_register_script( 'tab', THEME_ADMIN_JS.'/tab.js');
		wp_enqueue_script('tab');
		
		if(file_exists(THEME_EXTENDS_ADMIN.'/js/shortcode.js'))
			wp_register_script( 'shortcode_js', THEME_EXTENDS_ADMIN_JS.'/shortcode.js');
		else	
			wp_register_script( 'shortcode_js', THEME_ADMIN_JS.'/shortcode.js');
		wp_enqueue_script('shortcode_js');
		
		if(file_exists(THEME_EXTENDS_ADMIN.'/js/page_config.js'))
			wp_register_script( 'page_config_js', THEME_EXTENDS_ADMIN_JS.'/page_config.js');
		else	
			wp_register_script( 'page_config_js', THEME_ADMIN_JS.'/page_config.js');
		wp_enqueue_script('page_config_js');
		
		if(file_exists(THEME_EXTENDS_ADMIN.'/css/style.css'))
			wp_register_style( 'config_css', THEME_EXTENDS_ADMIN_CSS.'/style.css');
		else	
			wp_register_style( 'config_css', THEME_ADMIN_CSS.'/style.css');
		wp_enqueue_style('config_css');		
		
		wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');		
		wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js');
		wp_enqueue_script('bootstrap-colorpicker');	
		
		global $is_admin_menu;
		
		wp_register_style( 'font-awesome', THEME_FRAMEWORK_CSS_URI.'/font-awesome.css');
		wp_enqueue_style('font-awesome');	

	wp_enqueue_script('plupload-all');
	
	wp_enqueue_script('utils');
	wp_enqueue_script('plupload');
	wp_enqueue_script('plupload-html5');
	wp_enqueue_script('plupload-flash');
	wp_enqueue_script('plupload-silverlight');
	wp_enqueue_script('plupload-html4');
	wp_enqueue_script('media-views');
	wp_enqueue_script('wp-plupload');
	
	
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	
		
		wp_register_script( 'logo_upload', THEME_ADMIN_JS.'/logo-upload.js');
		//if( !$is_admin_menu )
			wp_enqueue_script('logo_upload');
		
		
	}
}
?>