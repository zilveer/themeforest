<?php
/**
 * Mtheme Core
 *
 * Inits modules and components
 *
 * @class MthemeCore
 * @author Mtheme
 */

class MthemeCore {
	
	/** @var array Contains an array of modules. */
	public static $modules;

	/** @var array Contains an array of components. */
	public static $components;
	
	/** @var array Contains an array of options. */
	public static $options;
	
	/** @var array Contains module data. */
	public static $data;
	
	/**
	 * Inits modules and components, adds edit actions
     *
     * @access public
	 * @param array $config
     * @return void
     */
	public function __construct($config) {

		//set modules
		self::$modules=$config['modules'];
		
		//set components
		self::$components=$config['components'];

		//set options
		self::$options=$config['options'];		

		//init modules
		$this->initModules();

		//init components
		$this->initComponents();

		//save options action
		add_action('wp_ajax_mtheme_save_options', array(__CLASS__, 'saveOptions'));
		
		//reset options action
		add_action('wp_ajax_mtheme_reset_options', array(__CLASS__, 'resetOptions'));

		//save post action
		add_action('save_post', array(__CLASS__, 'savePost'));
		
		//add editor styles
		add_filter('tiny_mce_before_init', array($this, 'addEditorStyles'));
		
		//filter user relations
		add_filter('comments_clauses', array($this, 'filterUserRelations'));
		
		//activation hook
		add_action('init', array(__CLASS__, 'activate'));
	}
	
	/**
	 * Checks PHP version and redirects to the options page
     *
     * @access public
     * @return void
     */
	public static function activate() {
		global $pagenow;		

		if ($pagenow=='themes.php' && isset($_GET['activated'])) {
			if(version_compare(PHP_VERSION, '5', '<')) {
				switch_theme('twentyten', 'twentyten');
				die();
			}
			
			flush_rewrite_rules();
			
			if(self::getOption('header_color')) {
				add_action('admin_notices', array(__CLASS__, 'upgrade'));
			} else {
				wp_redirect(admin_url('admin.php?page=theme-options'));
				exit;
			}
		}
	}
	
	/**
	 * Upgrades content and theme options
     *
     * @access public
     * @return void
     */
	public static function upgrade() {
		global $pagenow, $wpdb;
		$out='<div class="error"><p>';
		
		$out.='Database is updated! Now you can edit content and change theme options.';
		/*if(isset($_GET['upgraded'])) {
		
			$options=array(
				'logo_image' => 'site_logo',
			);
			
			foreach($options as $old => $new) {
				$wpdb->query("UPDATE $wpdb->options SET option_name='mtheme_$new' WHERE option_name='mtheme_$old'");
			}			
			
			$out.='Database is updated! Now you can edit content and change theme options.';
		} else {
			$out.='Update the database to use Mtheme 2.0. Please make a backup before updating. <a href="'.admin_url('themes.php?activated=true&upgraded=true').'">Update Now</a>';
		}*/
		
		$out.='</p></div>';
		echo mtheme_html($out);
	}
	
	/**
	 * Requires and inits modules
     *
     * @access public
     * @return void
     */
	public function initModules() {
		
		foreach(self::$modules as $module) {
		
			//require class
			$file=substr(strtolower(implode('.', preg_split('/(?=[A-Z])/', $module))), 1);
			require_once(MTHEME_PATH.'classes/'.$file.'.php');
			
			//init module
			if(method_exists($module, 'init')) {
				call_user_func(array($module, 'init'));
			}
		}
	}
	
	/**
	 * Adds actions to init components
     *
     * @access public
     * @return void
     */
	public function initComponents() {
		
		//add supports
		add_action('after_setup_theme', array($this, 'supports'));
		
		//add rewrite rules
		add_action('after_setup_theme', array($this, 'rewrite_rules'));
		
		//add user roles
		add_action('init', array($this, 'user_roles'));
		
		//register custom menus
		add_action('init', array($this, 'custom_menus'));
		
		//add image sizes
		add_action('init', array($this, 'image_sizes'));
		
		//enqueue admin scripts and styles
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'admin_styles'), 99);
		
		//enqueue user scripts and styles
		add_action('wp_enqueue_scripts', array($this, 'user_header_scripts'));
		add_action('wp_enqueue_scripts', array($this, 'user_footer_scripts'));	
		add_action('wp_enqueue_scripts', array($this, 'user_styles'), 99);	
		
		//register sidebars and widgets
		add_action('widgets_init', array($this, 'widget_areas'));
		add_action('widgets_init', array($this, 'widgets'));
		
		//register custom post types
		add_action('init', array($this, 'post_types'));
		
		//register taxonomies
		add_action('init', array($this, 'taxonomies'));

		//add meta boxes
		add_action('admin_menu', array($this, 'meta_boxes'));
		
		//add meta boxes
		add_action('admin_menu', array($this, 'texa_meta'));
		add_action('wp_ajax_mtheme_texta_delete_mupload', array(__CLASS__,'wp_ajax_delete_texta_image'));
	}
	
	
	/**
	* Ajax callback for deleting files.
	* Modified from a function used by "Verve Meta Boxes" plugin (http://goo.gl/LzYSq)
	* @since 1.0
	* @access public
	*/
	public static function wp_ajax_delete_texta_image() {
		$config = array(
			
			'pages' => '',
			'context' => '',
			'fields' => array(),
			'local_images' => false
			
		 );
	   
		/*var_dump($config);die();*/

		$my_meta =  new MthemeTexameta($config); 
		
		$term_id = isset( $_GET['post_id'] ) ? intval( $_GET['post_id'] ) : 0;
		$field_id = isset( $_GET['field_id'] ) ? $_GET['field_id'] : 0;
		$attachment_id = isset( $_GET['attachment_id'] ) ? intval( $_GET['attachment_id'] ) : 0;
		$ok = false;
		$remove_meta_only = apply_filters("tax_meta_class_delete_image",true);
		if (strpos($field_id, '[') === false){
		  check_admin_referer( "at-delete-mupload_".urldecode($field_id));
		  if ($term_id > 0)
			$my_meta->delete_tax_meta( $term_id, $field_id );
		  if (!$remove_meta_only)
			$ok = wp_delete_attachment( $attachment_id );
		  else
			$ok = true;
		}else{
		  $f = explode('[',urldecode($field_id));
		  $f_fiexed = array();
		  foreach ($f as $k => $v){
			$f[$k] = str_replace(']','',$v);
		  }
		  $saved = $my_meta->get_tax_meta($term_id,$f[0],true);
		  if (isset($saved[$f[1]][$f[2]])){
			unset($saved[$f[1]][$f[2]]);
			if ($term_id > 0)
			  update_post_meta($term_id,$f[0],$saved);
			if (!$remove_meta_only)
			  $ok = wp_delete_attachment( $attachment_id );
			else
			  $ok = true;
		  }
		}



		if ( $ok ){
		  echo json_encode( array('status' => 'success' ));
		  die();
		}else{
		  echo json_encode(array('message' => __( 'Cannot delete file. Something\'s wrong.','mtheme')));
		  die();
		}
	}
	
	/**
	 * Inits component on action
     *
     * @access public
     * @return void
     */
	public function __call($component, $args)	{
			
		if(isset(self::$components[$component])) {
			foreach(self::$components[$component] as $item) {
			
				switch($component) {
				
					case 'supports':
						add_theme_support($item);
					break;
					
					case 'rewrite_rules':
						self::rewriteRule($item);
					break;
				
					case 'user_roles':
						add_role($item['role'], $item['name'], $item['capabilities']);
					break;
					
					case 'custom_menus':
						register_nav_menu( $item['slug'], $item['name'] );
					break;
					
					case 'image_sizes':
						add_image_size($item['name'], $item['width'], $item['height'], $item['crop']);
					break;					
					
					case 'admin_scripts':					
						self::enqueueScript($item);
					break;					
					
					case 'admin_styles':
						self::enqueueStyle($item);
					break;
					
					case 'user_header_scripts':					
						self::enqueueScript($item);
					break;
					case 'user_footer_scripts':					
						self::enqueueScript($item,true);
					break;
					
					case 'user_styles':
						self::enqueueStyle($item);
					break;
					
					
					case 'widget_areas':
						register_sidebar($item);
					break;
					
					case 'post_types':
						register_post_type($item['id'], $item);
					break;
					
					case 'taxonomies':
						register_taxonomy($item['taxonomy'], $item['object_type'], $item['settings']);
					break;
					
					case 'meta_boxes':
						if(isset($item['template']) && $item['page']=='page')
						{
							$template_file='';
							if(isset($_GET['post']))
							{
								$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
								$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
							}
							if ($template_file == $item['template']) {
								add_meta_box($item['id'], $item['title'], array('MthemeInterface', 'renderMetabox'), $item['page'], $item['context'], $item['priority'], array('ID' => $item['id']));
							}
						}
						else{
							add_meta_box($item['id'], $item['title'], array('MthemeInterface', 'renderMetabox'), $item['page'], $item['context'], $item['priority'], array('ID' => $item['id']));
						}
						
					break;					
					
					case 'texa_meta':
						MthemeInterface::renderTaxmeta($item['cat_type']);
					break;
					
				}
			}
		}
	}
	
	/**
	 * Saves theme options
     *
     * @access public
     * @return void
     */
	public static function saveOptions() {
		
		parse_str($_POST['options'], $options);
		
		//save options
		if(current_user_can('manage_options')) {
			mtheme_remove_strings();
			
			foreach(self::$options as $option) {		
				if(isset($option['id'])) {
				
					$option['index']=$option['id'];
					if($option['type']!='module') {
						$option['index']=MTHEME_PREFIX.$option['id'];
					}
			
					if(!isset($options[$option['index']])) {
						$options[$option['index']]='false';
					}
					$options[$option['index']]=str_replace('"', "'",$options[$option['index']]);
					
					self::updateOption($option['id'], mtheme_stripslashes($options[$option['index']]));
					
					if($option['type']=='module' && method_exists($option['id'], 'saveOptions')) {
						call_user_func(array($option['id'], 'saveOptions'), $options[$option['index']]);
					}
				}
			}
		}
		
		_e('All changes have been saved','mtheme');
		die();		
	}
	
	/**
	 * Resets theme options
     *
     * @access public
     * @return void
     */
	public static function resetOptions() {	
	
		if(current_user_can('manage_options')) {		
			//delete options
			foreach(self::$options as $option) {
				if(isset($option['id'])) {
					self::deleteOption($option['id']);
				}
			}
			
			//delete modules
			foreach(self::$modules as $module) {
				self::deleteOption($module);
			}
			
			//delete strings
			mtheme_remove_strings();
		}
		
		_e('All options have been reset','mtheme');
		die();
	}
	
	/**
	 * Filter User Relation
     *
     * @access public
	 * @param int $options
     * @return $options
     */
	public static function filterUserRelations($options){
		return $options;      
	}
	/**
	 * Saves post meta
     *
     * @access public
	 * @param int $ID
     * @return void
     */
	public static function savePost($ID) {
		
		global $post;

		//check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $ID;
		}

		//verify nonce
		if (isset($_POST['mtheme_nonce']) && !wp_verify_nonce($_POST['mtheme_nonce'], $ID)) {
			return $ID;
		}
		
		//check permissions
		if (isset($_POST['post_type']) && $_POST['post_type']=='page') {
			if (!current_user_can('edit_page', $ID)) {
				return $ID;
			}
		} else if (!current_user_can('edit_post', $ID)) {
			return $ID;
		}
		
		//save post meta
		if(isset(self::$components['meta_boxes']) && isset($post)) {
			foreach(self::$components['meta_boxes'] as $meta_box) {
				if($meta_box['page']==$post->post_type) {
					foreach ($meta_box['options'] as $option) {
						if($option['type']=='module') {
							if(isset($option['slug'])) {
								call_user_func(array(str_replace(MTHEME_PREFIX, '', $option['id']), 'saveData'), $option['slug']);
							} else {
								call_user_func(array(str_replace(MTHEME_PREFIX, '', $option['id']), 'saveData'));
							}
						}
						if($option['type']=='checkbox' && !isset($_POST['_'.$post->post_type.'_'.$option['id']])) {				
							self::updatePostMeta($ID, $post->post_type.'_'.$option['id'], 'false');
						}else if(isset($_POST['_'.$post->post_type.'_'.$option['id']])) {
							$_POST['_'.$post->post_type.'_'.$option['id']]=str_replace('"', "'",$_POST['_'.$post->post_type.'_'.$option['id']]);
							self::updatePostMeta($ID, $post->post_type.'_'.$option['id'], mtheme_stripslashes($_POST['_'.$post->post_type.'_'.$option['id']]));								
						}
					}
				}
			}
		}

	}
	
	/**
	 * Enqueues script
     *
     * @access public
	 * @param array $args
     * @return void
     */
	public static function enqueueScript($args,$inFooter=false) {

		if(isset($args['uri'])) {
		
			if(isset($args['deps'])) {
				wp_enqueue_script($args['name'], $args['uri'], $args['deps'],array(),$inFooter);	
			} else {
				wp_enqueue_script($args['name'], $args['uri'],array(),array(),$inFooter);
			}
			
		} else {
			wp_enqueue_script($args['name'],'',array(),array(),$inFooter);
		}
		
		if(isset($args['options'])) {
			wp_localize_script($args['name'], 'options', $args['options']);
		}
	}
	
	/**
	 * Enqueues style
     *
     * @access public
	 * @param array $args
     * @return void
     */
	public static function enqueueStyle($args) {
	
		if(isset($args['uri'])) {
			wp_enqueue_style($args['name'], $args['uri']);
		} else {
			wp_enqueue_style($args['name']);
		}
	}
	
	/**
	 * Adds editor styles
     *
     * @access public
	 * @param array $options
     * @return array
     */
	public static function addEditorStyles($options) {
		$styles='';
		foreach(self::$components['editor_styles'] as $class=>$name) {
			$styles.=$name.'='.$class.';';
		}
	
		$options['theme_advanced_styles']=substr($styles, 0, -1);
		$options['theme_advanced_buttons2_add_before']='styleselect';
		
		return $options;
	}
	
	/**
	 * Uploads image
     *
     * @access public
	 * @param array $file
     * @return int
     */
	public static function uploadImage($file) {
		require_once(ABSPATH.'wp-admin/includes/image.php');
		$attachment=array('ID' => 0);

		if(!empty($file['name'])) {
			$uploads=wp_upload_dir();
			$filetype=wp_check_filetype($file['name'], null);
			$filename=wp_unique_filename($uploads['path'], 'image-1.'.$filetype['ext']);
			$filepath=$uploads['path'].'/'.$filename;			
			
			//validate file
			if (!in_array($filetype['ext'], array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG'))) {
				MthemeInterface::$messages[]=__('Only JPG and PNG images are allowed.', 'mtheme');
			} else if(move_uploaded_file($file['tmp_name'], $filepath)) {
				
					//upload image
					$attachment=array(
						'guid' => $uploads['url'].'/'.$filename,
						'post_mime_type' => $filetype['type'],
						'post_title' => sanitize_title(current(explode('.', $filename))),
						'post_content' => '',
						'post_status' => 'inherit',
						'post_author' => get_current_user_id(),
					);
					
					//add image
					$attachment['ID']=wp_insert_attachment($attachment, $attachment['guid'], 0);
					update_post_meta($attachment['ID'], '_wp_attached_file', substr($uploads['subdir'], 1).'/'.$filename);
					
					//add thumbnails
					$metadata=wp_generate_attachment_metadata($attachment['ID'], $filepath);
					wp_update_attachment_metadata($attachment['ID'], $metadata);
			
			} else {
				MthemeInterface::$messages[]=__('This image is too large for uploading.','mtheme');
			}
		}
		
		return $attachment;
	}
	
	
	/**
	 * Rewrites URL rule
     *
     * @access public
	 * @param array $rule
     * @return void
     */
	public static function rewriteRule($rule) {
		global $wp_rewrite;
		global $wp;
		
		$wp->add_query_var($rule['name']);
		
		if(isset($rule['replace']) && $rule['replace']) {
			$wp_rewrite->$rule['rule']=$rule['rewrite'];
		} else {			
			add_rewrite_rule($rule['rule'], $rule['rewrite'], $rule['position']);
		}		
	}
	
	/**
	 * Gets rewrite rule
     *
     * @access public
	 * @param string $rule
     * @return bool
     */
	public static function getRewriteRule($rule) {
		$rule=self::$components['rewrite_rules'][$rule]['name'];
		$value=get_query_var($rule);
		
		return $value;
	}
	
	/**
	 * Gets page URL
     *
     * @access public
	 * @param string $name
	 * @param int $value
     * @return string
     */
	public static function getURL($name, $value=1) {
		global $wp_rewrite;	
		
		$url=$wp_rewrite->get_page_permastruct();
		$rule=self::$components['rewrite_rules'][$name];
		
		$slug='';
		if(isset($rule['name'])) {
			$slug=$rule['name'];
		}
		
		if(!empty($url)) {
			$url=site_url(str_replace('%pagename%', $slug, $url));			
			if(isset($rule['dynamic']) && $rule['dynamic']) {
				$url.='/'.$value;
			}
		} else {
			$url=site_url('?'.$slug.'='.$value);
		}
		
		return $url;
	}
	
	/**
	 * Gets prefixed option
     *
     * @access public
	 * @param string $ID
	 * @param mixed $default
     * @return mixed
     */
	public static function getOption($ID, $default='') {
		$option=get_option(MTHEME_PREFIX.$ID);		
		if(($option===false || $option=='') && $default!='') {
			return $default;
		}
		return $option;
	}
	
	/**
	 * Gets option value
     *
     * @access public
	 * @param string $ID
	 * @param mixed $default
     * @return mixed
     */
	public static function getOptionValue($ID, $default='') {
		$option=get_option($ID);		
		if(($option===false || $option=='') && $default!='') {
			return $default;
		}
		return $option;
	}
	/**
	 * Gets prefixed option is empty or not
     *
     * @access public
	 * @param string $ID
	 * @param mixed $default
     * @return mixed
     */
	public static function isOptionEmpty($ID) {
		$option=get_option(MTHEME_PREFIX.$ID);
		if($option===false || $option=='') {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Updates prefixed option
     *
     * @access public
	 * @param string $ID
	 * @param string $value
     * @return bool
     */
	public static function updateOption($ID, $value) {
		return update_option(MTHEME_PREFIX.$ID, $value);
	}
	
	/**
	 * Deletes prefixed option
     *
     * @access public
	 * @param string $ID
     * @return bool
     */
	public static function deleteOption($ID) {
		return delete_option(MTHEME_PREFIX.$ID);
	}
	
	/**
	 * Checks prefixed option
     *
     * @access public
	 * @param string $ID
     * @return bool
     */
	public static function checkOption($ID) {
		$option=self::getOption($ID);		
		if($option=='true') {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Gets prefixed post meta
     *
     * @access public
	 * @param string $ID
	 * @param string $key
	 * @param string $default
     * @return mixed
     */
	public static function getPostMeta($ID, $key, $default='') {
		$meta=get_post_meta($ID, '_'.$key, true);
		
		if($meta=='' && ($default!='' || is_array($default))) {
			return $default;
		}
		
		return $meta;
	}
	
	/**
	 * Gets has post_id by meta_key and meta_value
     *
     * @access public
	 * @param string $ID
	 * @param string $key
     * @return true/false
     */
	public static function hasPostIdByMetaKeyAndMetaValue($key, $value) {
		global $wpdb;
		$key='_'.$key;
		
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".esc_sql($key)."' AND meta_value='".esc_sql($value)."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}		
		if (is_object($meta)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Gets post_id by meta_key and meta_value
     *
     * @access public
	 * @param string $ID
	 * @param string $key
     * @return mixed
     */
	function getPostIdByMetaKeyAndMetaValue($key, $value) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".esc_sql($key)."' AND meta_value='".esc_sql($value)."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}		
		if (is_object($meta)) {
			return $meta->post_id;
		}
		else {
			return false;
		}
	}
	
	/**
	 * Gets is post meta empty
     *
     * @access public
	 * @param string $ID
	 * @param string $key
	 * @param string $default
     * @return mixed
     */
	public static function isPostMetaEmpty($ID, $key) {
		$meta=get_post_meta($ID, '_'.$key, true);
		if(empty($meta)) {
			return true;
		}
		return false;
	}
	/**
	 * Updates prefixed post meta
     *
     * @access public
	 * @param string $ID
	 * @param string $key
	 * @param string $value
     * @return mixed
     */
	public static function updatePostMeta($ID, $key, $value) {
		return update_post_meta($ID, '_'.$key, $value);
	}
	
	/**
	 * Gets prefixed user meta
     *
     * @access public
	 * @param string $ID
	 * @param string $key
	 * @param string $default
     * @return mixed
     */
	public static function getUserMeta($ID, $key, $default='') {
		$meta=get_user_meta($ID, '_'.MTHEME_PREFIX.$key, true);
		if(empty($meta) && (!empty($default) || is_array($default))) {
			return $default;
		}
		
		return $meta;
	}
	
	
	/**
	 * Updates prefixed user meta
     *
     * @access public
	 * @param string $ID
	 * @param string $key
	 * @param string $value
     * @return mixed
     */
	public static function updateUserMeta($ID, $key, $value) {
		$result=false;
		
		if($value=='') {
			$result=delete_user_meta($ID, '_'.MTHEME_PREFIX.$key);
		} else {
			$result=update_user_meta($ID, '_'.MTHEME_PREFIX.$key, $value);
		}
		
		return $result;
	}
	
	
}