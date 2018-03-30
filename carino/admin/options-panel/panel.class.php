<?php
/**
* VanThemes Panel Setup Class
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

class VanOptionsPanel{

	public $panel     = array("slug" => "vanpanel");
	public $default_options = array();

	public function __construct(){
		
		add_action( 'after_setup_theme', array(&$this,"van_register_default_options") );
		add_action('admin_head', array(&$this,"van_activate_theme_msg") );
		add_action('wp_ajax_save_theme_data', array(&$this,"van_save_ajax") );
		add_action('admin_menu',   array(&$this,"van_reset_settings") );
		add_action('admin_menu',   array(&$this,"van_panel_menu") );
		add_action( 'wp_before_admin_bar_render', array(&$this,"van_admin_bar_menu") );
		add_action( 'admin_enqueue_scripts', array(&$this,"van_register_scripts") );  

	}
	public function van_default_options(){
		 $default_options = array("van_options" => $this->default_options);
		 return $default_options;
	}

	public function van_register_scripts(){
			global $pagenow;

			// admin scripts & css
			wp_register_style("panel-css" ,  ADMIN_ASSETS . "/admin.css"  ,  array(), false, 'all' );
			wp_register_script( "panel-js",  ADMIN_JS  . "/admin.js",  array( 'jquery' ) , false , false  );
			wp_register_script( "post-options-js",  ADMIN_JS  . "/post-options.js",  array( 'jquery' ) , false , false  );
			// Color Picker
			wp_register_script( 'van-colorpicker',  ADMIN_JS  . '/colorpicker.js',  array( 'jquery' ) , false , false  );  
	    		wp_register_script( 'van-eye',  ADMIN_JS  . '/eye.js',  array( 'jquery' ) , false , false  );  
	    		wp_register_script( 'van-utils',  ADMIN_JS  . '/utils.js',  array( 'jquery' ) , false , false  );  
	    		wp_register_script( 'van-layout',  ADMIN_JS  . '/layout.js',  array( 'jquery' ) , false , false  );  

			if ( is_admin() ) {

				wp_enqueue_style('panel-fonts');
				wp_enqueue_script('panel-js');
    				wp_enqueue_style('panel-css'); 

				if (  $pagenow == "post.php" ||  $pagenow == "post-new.php" ) {
					wp_enqueue_script('post-options-js');
				}
				if(isset($_GET['page']) && $_GET['page'] == $this->panel['slug']){ 
					 wp_enqueue_script('van-colorpicker');
					 wp_enqueue_script('van-eye');
					 wp_enqueue_script('van-utils');
					 wp_enqueue_script('van-layout');
					 wp_enqueue_media();
				}
			}
	}

	public function van_activate_theme_msg() {
		?>
			<script type="text/javascript">
				jQuery(function(){
				var message = '<p><strong><?php echo THEME_NAME; ?> Theme Activation Successful</strong>. This theme comes with an  <a href="<?php echo admin_url( "themes.php?page=" . $this->panel["slug"] ); ?>">options panel</a>. This theme also supports <a href="<?php echo admin_url( "widgets.php" ); ?>">Widgets</a> and <a href="<?php echo admin_url( "nav-menus.php" ); ?>">Menus</a>.</p>';
				jQuery('.themes-php #message2').html(message);
				});
			</script>
		<?php
	}

	private function van_clean_array($array){
		foreach($array as &$val){
			if(is_array($val)){
				$val = $this->van_clean_array($val);
			}else{
				$val = htmlspecialchars( stripslashes($val) ) ;
			}
		}
		return $array;
	}

	private function van_save_settings($data,$die=null){
		if( isset( $data['van_options'] ) ){
			$option = $this->van_clean_array($data['van_options']) ;
			update_option("van_options",$option);
		}
		if( $die == 2 ){ die("2"); }elseif($die == 1){ die("1"); }
	}

	public function van_save_ajax() {
		check_ajax_referer('test-theme-data', 'vannoncename');
		$data   = $_POST;
		if($_POST["van_import"]){
			$data = array();
			$van_import = unserialize(base64_decode(  $_POST["van_import"] ) );
			$data["van_options"] = $van_import; 
			$die  = 2; 
		}else{
			$data  = $_POST;
			$die   = 1; 
		}
		$this->van_save_settings($data,$die);
	}

	public function van_reset_settings(){
		if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ){
		        $this->van_save_settings($this->van_default_options());
		        header("Location: themes.php?page=".$this->panel['slug']."&reset=true");
		        die;
	    	}
	}

	public function van_register_default_options(){
		if( is_admin() && !get_option('van_options') ){
		        $this->van_save_settings($this->van_default_options());
	    	}
	}

	public function van_panel_menu(){

		if ( function_exists("van_option_panel") ) {
			add_theme_page(THEME_NAME .' Settings', THEME_NAME .' Settings','install_themes', $this->panel['slug'] , "van_option_panel");
		}

		if( isset( $this->panel['admin_menu'] ) ){
			$admin_menu = $this->panel['admin_menu'];
			foreach ($admin_menu as $args) {
				$subslug = ( $args['slug'] ) ? $args['slug'] : $this->panel['slug'];
				add_theme_page($subslug, $args['name'],  $args['name'],'install_themes', $this->panel['slug'] , $args['function']);
			}
		}
		
	}

	public function van_admin_bar_menu(){
		global $wp_admin_bar;

		if ( !is_super_admin() || !is_admin_bar_showing() )
      	  		return;
		
		$wp_admin_bar->add_menu( array(
			'id' => strtolower(THEME_NAME) . '-settings',
			'title' => THEME_NAME .' Settings' ,
			'href' => admin_url( "themes.php?page=" . $this->panel["slug"] )
		) );
	}

	public function van_save_button(){
		echo '<input type="submit" class="vanSave" value="Save Changes">';
	}
	public function van_reset_button(){
		$onclick = "var con = confirm('Are you sure you want to reset settings?');if(con==true){return true}else{return false}";
		echo '<form method="post" enctype="multipart/form-data"><input type="hidden" name="action" value="reset"> <input type="submit" onclick="'.$onclick.'" class="vanReset" value="Reset Settings"></form>';
	}
}