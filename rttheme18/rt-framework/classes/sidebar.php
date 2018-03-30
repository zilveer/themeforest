<?php
#-----------------------------------------
#	RT-Theme sidebar.php
#	version: 1.0
#-----------------------------------------

#
#	Sidebar Class
#

class RTThemeSidebar extends RTTheme{
 	
	public $rt_sidebars           = array();
	private $rt_user_created_sidebars = array();
	private $rt_disabled_sidebars     = array();
	public $rt_sidebar_descriptions  = array();
	private $rt_all_sidebars              = array(); 
	public $rt_active_sidebars       = array(); 

	#
	# Construct
	#	 
	function __construct() {

		//sidebar descriptions	
		$this->rt_sidebar_descriptions = array( 
			"sidebar-for-footer-column-1"    => __("Widget Area : Sidebar for Footer (column 1). Go to the Theme Footer Options and make sure this column is visible.", 'rt_theme_admin'),
			"sidebar-for-footer-column-2"    => __("Widget Area : Sidebar for Footer (column 2). Go to the Theme Footer Options and make sure this column is visible.", 'rt_theme_admin'),
			"sidebar-for-footer-column-3"    => __("Widget Area : Sidebar for Footer (column 3). Go to the Theme Footer Options and make sure this column is visible.", 'rt_theme_admin'),
			"sidebar-for-footer-column-4"    => __("Widget Area : Sidebar for Footer (column 4). Go to the Theme Footer Options and make sure this column is visible.", 'rt_theme_admin'),
			"sidebar-for-footer-column-5"    => __("Widget Area : Sidebar for Footer (column 5). Go to the Theme Footer Options and make sure this column is visible.", 'rt_theme_admin'),
			"common-sidebar"                 => __("Widget Area : Common Sidebar Widget area. Widgets dropped in the Common Sidebar container will show in every sidebar when a sidebar layout is selected.", 'rt_theme_admin'),	
			"sidebar-for-pages"              => __("Widget Area : Sidebar for Pages. Widgets dropped in the Sidebar for Pages container will show in every page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),			
			"sidebar-for-portfolio"          => __('Widget Area : Sidebar for Portfolio. Widgets will be displayed in pages or posts which use the "Default Portfolio Template", all portfolio categories and single portfolio item pages.' , 'rt_theme_admin'),
			"sidebar-for-portfolios"         => __("Widget Area : Sidebar for Single Portfolio Item. Widgets dropped in this Sidebar container will show in every single portfolio page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),			
			"sidebar-all-products"           => __('Widget Area : Sidebar for Products. Widgets will be displayed in pages or posts which use the "Default Product Template", all product categories and product detail pages.', 'rt_theme_admin'),
			"sidebar-for-product"            => __("Widget Area : Sidebar for Single Product Item. Widgets dropped in this Sidebar container will show in every single product page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),			
			"sidebar-for-product-categories" => __("Widget Area : Sidebar for Product Categories. Widgets dropped in this Sidebar container will show in every product category page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),
			"sidebar-for-blog"               => __('Widget Area : Sidebar for Blog. Widgets will be displayed in pages or posts which use the "Default Blog Template", all blog categories and single post pages.', 'rt_theme_admin'),			
			"sidebar-for-blog-categories"    => __("Widget Area : Sidebar for Blog Categories. Widgets dropped in this Sidebar container will show in every single portfolio page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),
			"sidebar-for-single"             => __("Widget Area : Sidebar for Single Post. Widgets dropped in this Sidebar container will show in every single blogpost page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),
			"woo-commerce-contents"          => __('Widget Area : Sidebar for WooCommerce. Widgets dropped in this Sidebar container will show in WooCommerce related pages when the page-layout is set to a sidebar layout.', 'rt_theme_admin'),
			"sidebar-for-search"             => __('Widget Area : Sidebar for Search Results. Widgets dropped in this Sidebar container will show in the Search result when the global theme page-layout is set to a sidebar layout.', 'rt_theme_admin'),
			"sidebar-for-archive"         	 => __('Widget Area : Sidebar for Archives. Widgets dropped in this Sidebar container will show in the archive pages when the global theme page-layout is set to a sidebar layout.', 'rt_theme_admin'),
			"sidebar-for-tags"            	 => __('Widget Area : Sidebar for Tags. Widgets dropped in this Sidebar container will show in the Tags listing pages when the global theme page-layout is set to a sidebar layout.', 'rt_theme_admin'),			
			"sidebar-for-top-first"          => __('Widget Area : First Top Widget Area (header). The widgets dropped into this Sidebar container will be displayed next, below or before the logo depending on the settings chozen in the theme header options.', 'rt_theme_admin'),
			"sidebar-for-top-second"         => __('Widget Area : Second Top Widget Area (header). The widgets dropped into this Sidebar container will be displayed next, below or before the logo depending on the settings chozen in the theme header options.', 'rt_theme_admin'), 
		);

		//default sidebars	
		$this->rt_sidebars = array( 
			"sidebar-for-footer-column-1"    => __("Sidebar For Footer (Column 1)", 'rt_theme_admin'),
			"sidebar-for-footer-column-2"    => __("Sidebar For Footer (Column 2)", 'rt_theme_admin'),
			"sidebar-for-footer-column-3"    => __("Sidebar For Footer (Column 3)", 'rt_theme_admin'),
			"sidebar-for-footer-column-4"    => __("Sidebar For Footer (Column 4)", 'rt_theme_admin'),
			"sidebar-for-footer-column-5"    => __("Sidebar For Footer (Column 5)", 'rt_theme_admin'),
			"common-sidebar"                 => __("Common Sidebar", 'rt_theme_admin'),	
			"sidebar-for-pages"              => __("Sidebar For Pages", 'rt_theme_admin'),			
			"sidebar-for-portfolio"          => __("Sidebar For Portfolio", 'rt_theme_admin'),
			"sidebar-for-portfolios"         => __("Sidebar For Single Portfolio Item", 'rt_theme_admin'),	
			"sidebar-all-products"           => __("Sidebar For Products", 'rt_theme_admin'),
			"sidebar-for-product"            => __("Sidebar For Single Product Item", 'rt_theme_admin'),			
			"sidebar-for-product-categories" => __("Sidebar For Product Categories", 'rt_theme_admin'),
			"sidebar-for-blog"               => __("Sidebar For Blog", 'rt_theme_admin'),			
			"sidebar-for-blog-categories"    => __("Sidebar For Blog Categories", 'rt_theme_admin'),
			"sidebar-for-single"             => __("Sidebar For Blog Single Post", 'rt_theme_admin'),
			"sidebar-for-search"             => __("Sidebar For Search Results", 'rt_theme_admin'),
			"woo-commerce-contents"     	 => __("Sidebar For WooCommerce", 'rt_theme_admin'),
			"sidebar-for-archive"            => __("Sidebar For Archives", 'rt_theme_admin'),
			"sidebar-for-tags"            	 => __("Sidebar For Tags", 'rt_theme_admin'),
			"sidebar-for-top-first"          => __('First Top Widget Area', 'rt_theme_admin'),
			"sidebar-for-top-second"         => __('Second Top Widget Area', 'rt_theme_admin'), 
		);

  	
  		$this->rt_all_sidebars = $this->rt_sidebars;

		//user created sidebars
		if ( is_array( get_option(RT_THEMESLUG.'_rt_user_created_sidebars') ) ){
			$this->rt_user_created_sidebars  = get_option( RT_THEMESLUG.'_rt_user_created_sidebars');
			$this->rt_all_sidebars = array_merge_recursive( $this->rt_sidebars, $this->rt_user_created_sidebars );
		}
 
		//disabled sidebars
		if ( is_array( get_option(RT_THEMESLUG.'_rt_disabled_sidebars') ) ){
			$this->rt_disabled_sidebars  = get_option(RT_THEMESLUG.'_rt_disabled_sidebars'); 
		}

 		//active sidebars
		$this->rt_active_sidebars = $this->rt_all_sidebars; 

  		foreach ($this->rt_active_sidebars as $rt_sidebarID => $sidebarName ) { 
  			if( ! $this->is_enabled_sidebar($rt_sidebarID) ){  
  				unset($this->rt_active_sidebars[$rt_sidebarID]);
  			}
  		}
 

 		//register sidebars
		add_action('widgets_init',array(&$this,'register_sidebars'));

 		//show widgetes
		add_action('widgets_init',array(&$this,'call_display_sidebars'));
 	}


	#
	# Register Sidebars
	#
	function register_sidebars(){
		foreach ($this->rt_active_sidebars as $rt_sidebarID => $sidebarName) {  
			$this->register_sidebar($rt_sidebarID,$sidebarName); 
		} 
	}

	#
	# Register Sidebar
	#
	function register_sidebar($rt_sidebarID,$sidebarName){ 
		
			$description = ( isset( $this->rt_sidebar_descriptions[$rt_sidebarID] ) ) ? $this->rt_sidebar_descriptions[$rt_sidebarID] : __('User created sidebar', 'rt_theme_admin'); 
		 
			if(
				$rt_sidebarID=="sidebar-for-footer-column-1" ||
				$rt_sidebarID=="sidebar-for-footer-column-2" ||
				$rt_sidebarID=="sidebar-for-footer-column-3" ||
				$rt_sidebarID=="sidebar-for-footer-column-4" ||
				$rt_sidebarID=="sidebar-for-footer-column-5" 
			){
				
				//get footer page layout
				register_sidebar(array(
					'id'            => $rt_sidebarID,
					'name'          => $sidebarName,
					'before_widget' => '<div class="box one footer clearfix widget %2$s">',
					'description'   => $description,
					'after_widget'  => '</div>',
					'before_title'  => '<div class="caption"><h3 class="featured_article_title">',
					'after_title'   => '</h3></div><div class="space margin-b20"></div>',
				));							
				
			}else{
				register_sidebar(array(
					'id'            => $rt_sidebarID,
					'name'          => $sidebarName,
					'before_widget' => '<div class="box box_layout clearfix column_class widget %2$s">',
					'description'   => $description,
					'after_widget'  => '</div>',
					'before_title'  => '<div class="caption"><h3 class="featured_article_title">',
					'after_title'   => '</h3></div><div class="space margin-b20"></div>',
				));					
			} 
	} 

	#
	# Display Sidebars
	#
 	
 	function call_display_sidebars(){
 		add_filter('rt_load_widgets',array(&$this,'display_sidebars'));
 	}

	function display_sidebars(){
		global $post;

		$post_id = isset( $post ) && isset( $post->ID ) ? $post->ID : "" ;
		$post_type = isset( $post->post_type ) ? $post->post_type : "" ; 

		// WooCommerce
		if ( class_exists( 'Woocommerce' ) ) {		
			if(is_woocommerce() || is_cart() || is_account_page() || is_checkout() ){ 
				dynamic_sidebar('woo-commerce-contents');
				$WooCommercePage = "TRUE";
			}
		}		 
 
 		// Call Search Sidebar
		if( is_search() && $this->is_enabled_sidebar('sidebar-for-search') ){  
			dynamic_sidebar('sidebar-for-search');  
			dynamic_sidebar('common-sidebar');
			return false;
		}   
		
		// Page Sidebar
		if( ! rt_is_theme_page() && is_page() && $this->is_enabled_sidebar('sidebar-for-pages') ){ dynamic_sidebar('sidebar-for-pages'); } 

		// Portfolio Sidebar - all portfolio contents
		if( rt_is_portfolio_page() && $this->is_enabled_sidebar('sidebar-for-portfolio') ) { dynamic_sidebar('sidebar-for-portfolio'); }

		// Portfolio Sidebar - single portfolio item
		if( is_single() && $post_type=='portfolio' && $this->is_enabled_sidebar('sidebar-for-portfolio') ) { dynamic_sidebar('sidebar-for-portfolios'); }

		// Product Sidebar - all product contents 
		if( rt_is_product_page() && $this->is_enabled_sidebar('sidebar-all-products') ) { dynamic_sidebar('sidebar-all-products'); }
		
		// Product Sidebar - single products 
		if(is_single() && $post_type=='products' && $this->is_enabled_sidebar('sidebar-for-products') ){ dynamic_sidebar('sidebar-for-product'); }

		// Product Sidebar Listings
		if( $post_id == RT_PRODUCTPAGE || get_query_var('taxonomy')=="product_categories" && $this->is_enabled_sidebar('sidebar-for-product-categories') ){ dynamic_sidebar('sidebar-for-product-categories'); }

		// Blog All
		if( rt_is_blog_page() && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-blog') ){ dynamic_sidebar('sidebar-for-blog'); }

		// Blog Single
		if(is_single() && $post->post_type=='post' && $this->is_enabled_sidebar('sidebar-for-single') ){ dynamic_sidebar('sidebar-for-single'); }

		// Blog Categories
		if(is_category()  && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-blog-categories') ){ dynamic_sidebar('sidebar-for-blog-categories'); }

		// Archives 
		if(is_archive() && get_query_var('taxonomy')=="" && !isset($WooCommercePage) && ! is_category() && $this->is_enabled_sidebar('sidebar-for-archive')){ dynamic_sidebar('sidebar-for-archive'); } 

		// Tags archives
		if(is_tag() && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-tags')){ dynamic_sidebar('sidebar-for-tags'); }

		// Common Sidebar - For all site
		if( $this->is_enabled_sidebar('common-sidebar') ){ dynamic_sidebar('common-sidebar'); }
	}

	#
	# count sidebar items
	#
	function count_sidebar_items($id){		
		$get_sidebar_items   = wp_get_sidebars_widgets();		
		$count_sidebar_items = count($get_sidebar_items[$id]);		
		return $count_sidebar_items;
	}

	#
	# widgetized home page layout class
	#
	public function home_page_layout_class($params) {
		 
		global $rt_widget_num,$rt_home_contents_count,$rt_box_width,$rt_sidebarID,$rt_tempID;  

		$fixed_row = $fixed_row_end = $column_class = ""; 
		$layout_names =  array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");

		if($params[0]['id'] == $rt_sidebarID){			

			//which one
			$id=$params[0]['id'];
	
			//item count in the sidebar
	 		$widget_item_count = $this->count_sidebar_items($id);
			
			if($rt_tempID!=$params[0]['id']) {
				//temp sidebar id
				$rt_tempID = $id;
				$rt_home_contents_count=0;
			}

			// Widget class
			$class = array();
			
			// Home page class 
			if($id==$rt_sidebarID):
			    $rt_home_contents_count++;
			    $rt_widget_num=$rt_home_contents_count; 
			endif;

			//first and last classes
			if( $rt_widget_num==1 || fmod( $rt_widget_num, $rt_box_width )==1 || $rt_box_width==1 ):
				$column_class = 'first'; 
			elseif(fmod($rt_widget_num,$rt_box_width) == 0):
				$column_class = 'last'; 
			endif;


			//fixed rows			
			if($column_class == 'first') $fixed_row = '<div class="row clearfix">';
			if($column_class == 'last' || $rt_box_width==1 || $widget_item_count==$rt_widget_num)  $fixed_row_end = '</div>';


			$box_layout = isset( $layout_names[$rt_box_width] ) ? $layout_names[$rt_box_width] : "one";
 
			$params[0]['before_widget'] = $fixed_row .''.  $params[0]['before_widget'];
			$params[0]['before_widget'] = str_replace('box_layout', $box_layout, $params[0]['before_widget']);
			$params[0]['before_widget'] = str_replace('column_class', $column_class, $params[0]['before_widget']);
			$params[0]['after_widget']  = $params[0]['after_widget'] .''. $fixed_row_end .'';
		}
		
	
		return $params;
	}


	#
	# Fix class name of footer widgets that added via template builder
	#
	public function fix_footer_widgets_class($params) {
		  
		$params[0]['before_widget'] =  str_replace('clearfix', 'footer clearfix', $params[0]['before_widget']);
		$params[0]['before_title']  =  str_replace('<span class="icon-right-open title_icon"></span>', '', $params[0]['before_title']);
		return $params;
	}

	#
	# Create sidebar list for admin
	#	
	public function create_sidebar_list(){ 
 

	 	//info text
		echo '
			<div class="info">
				'.__('The sidebar creator can be used : <br /><br />1) to create a new sidebar to use within the template builder\'s sidebar "Widget Area - Sidebar" module,<br />2) to manage the (default/custom) sidebar\'s visibility. Both sidebars (default or custom) can be turned off so that the sidebar widgets container is no longer visibility in the wordpress appearance widget section.<br />3) deleting custom sidebars. <br /><br />Note : only custom created sidebars can be deleted, theme default sidebars can only be turned off.<br /><br />Note : A single sidebar can be selected and set in the template builder by the use of the sidebar module. When a page or (custom) post is set to a sidebar layout the default sidebar as designed by the theme will show in that page or post sidebar area (left or right) in the front of your website. Be aware that also widgets from the common sidebar will then show in that same sidebar.','rt_theme_admin').'
			</div>
		';
	 
		 
		//list sidebars
		echo '<ul class="list_sidebars rt_admin_lists">';
		 

		if( is_array( $this->rt_all_sidebars ) ){
			foreach( $this->rt_all_sidebars as $rt_sidebarID => $sidebarName ){

				$icon = $this->is_default_sidebar( $rt_sidebarID ) ? "icon-lock" : "icon-cog-alt" ;
				
				$delete_button = ! $this->is_default_sidebar( $rt_sidebarID ) ? '<li class="delete_sidebar list_delete_button" data-scope="delete-sidebar" data-sidebarid="'.$rt_sidebarID.'"><span class="icon-cancel"></span> '. __("Delete",'rt_theme_admin') .'</li>' : '<li class="delete_sidebar list_delete_button locked" data-scope="none" data-templateid="'.$rt_sidebarID.'"><span class="icon-lock"></span> '. __("Delete",'rt_theme_admin') .'</li>';
				$enable_button = $this->is_enabled_sidebar( $rt_sidebarID ) ? '<li class="enable_sidebar sidebar_visibility" data-scope="enable"  data-visibility="enabled" data-sidebarid="'.$rt_sidebarID.'"><span class="icon-thumbs-up-1"></span> '. __("Visibility",'rt_theme_admin') .'</li>' : '<li class="sidebar_visibility" data-scope="disable" data-visibility="disabled" data-sidebarid="'.$rt_sidebarID.'"><span class="icon-thumbs-down-1"></span> '. __("Visibility",'rt_theme_admin') .'</li>';

				$sidebar_details = isset( $this->rt_sidebar_descriptions[$rt_sidebarID] ) && $this->is_default_sidebar( $rt_sidebarID ) ?
				'	
					<p> 
						'. $this->rt_sidebar_descriptions[$rt_sidebarID]  .'
						<b class="sidebar-slug">sidebar slug: <span>'.$rt_sidebarID.'</span></b> 
					</p> 
				'
				:
				'	
					<p> 
						'. __("Custom Sidebar",'rt_theme_admin') .' 
						<b class="sidebar-slug">sidebar slug: <span>'.$rt_sidebarID.'</span></b> 
					</p>

					<input type="text" value="'. $sidebarName .'" autocomplete="off" name="sidebar" id="'.$rt_sidebarID.'"><button data-sidebarid="'.$rt_sidebarID.'" class="template_button update_sidebar light icon-floppy">'.__('Update','rt_theme_admin').'</button>
				'; 

				echo '
					<li class="'.$rt_sidebarID.'">

						<span class="'.$icon.'"></span>'.$sidebarName.' 

						<ul class="sidebar_controls rt_admin_list_controls">  
						'. $delete_button .' '. $enable_button .' 													
						</ul>
						<div class="sidebar_details">'.$sidebar_details.'</div>

					</li>
				';
			}

  
			$new_sidebarID   = 'sidebar-'.rand(1000, 1000000);  

			echo '
				<li class="'.$new_sidebarID.'">

					<span class="icon-magic"></span>

					'.__('Create New Sidebar','rt_theme_admin').' 
 
					<div class="sidebar_details">
					<p>'.__('Choose a sidebar name and click save to create a new widget area.','rt_theme_admin').'</p>
					<input type="text" autocomplete="off" value="'.__('new sidebar name','rt_theme_admin').' " name="sidebar" id="new_sidebar_name">


					<button id="create_new_sidebar" data-sidebarid="'.$new_sidebarID.'" class="template_button green icon-plus-squared-1">'.__('Create','rt_theme_admin').'</button>
					</div>
				</li>
			'; 
		}			 

		echo '
		</ul>
 
		';		

	}
 

	#
	# checks if given sidebar is a default sidebar
	#	 
	private function is_default_sidebar( $rt_sidebarID ){  
		return array_key_exists( $rt_sidebarID, $this->rt_sidebars );
	}


	#
	# checks if the sidebar is enabled
	#	  
	private function is_enabled_sidebar( $rt_sidebarID ){  
		
		if ( array_key_exists( $rt_sidebarID, $this->rt_disabled_sidebars ) ){
			return false;
		}else{
			return true;
		}
	}

	#
	# create a sidebar location in db
	#	 
	public function create_sidebar( $rt_sidebarID, $sidebarName ){  
		
		if ( ! current_user_can( 'manage_options' ) ) {
			return ;
		}

 		//user created sidebars
 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

 		//sidebar name
 		$sidebarName = ! empty( $sidebarName ) ? $sidebarName : "New Sidebar";

 		//new sidebar
		$new_sidebar = array( $rt_sidebarID => $sidebarName );

		if ( is_array( $rt_user_created_sidebars ) ){			 
			$new_list = array_merge( $rt_user_created_sidebars, $new_sidebar );
		}else{
			$new_list = $new_sidebar;
		}

		update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $new_list);
	}	


	#
	# update sidebar
	#
	public function update_sidebar( $rt_sidebarID, $sidebarName ){  
		
 		//user created sidebars
 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

 		//sidebar name
 		$sidebarName = ! empty( $sidebarName ) ? $sidebarName : "Sidebar".$rt_sidebarID ;

 		//new sidebar
		$new_sidebar = array( $rt_sidebarID => $sidebarName );

		$rt_user_created_sidebars[ $rt_sidebarID ] = $sidebarName;
  
		update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $rt_user_created_sidebars);
 
	}		

	#
	# disable / enable sidebar
	#
	public function enable_sidebar( $rt_sidebarID, $visibility = "enable" ){  
 
 		//disabled sidebars
 		$rt_disabled_sidebars = is_array( get_option( RT_THEMESLUG.'_rt_disabled_sidebars' ) ) ? get_option( RT_THEMESLUG.'_rt_disabled_sidebars' ) : array() ;

		if( $visibility == "enable" ){
			unset($rt_disabled_sidebars[$rt_sidebarID]);
			echo __('Sidebar enabled successfully', 'rt_theme_admin');	  
		}else{
		 	$rt_disabled_sidebars[ $rt_sidebarID ] = 1;
			echo __('Sidebar disabled successfully', 'rt_theme_admin');	   
		} 
    
		update_option(RT_THEMESLUG.'_rt_disabled_sidebars', $rt_disabled_sidebars);
 
	}

	#
	# delete sidebar
	#
	public function delete_sidebar( $rt_sidebarID ){  
 
 		//user created sidebars
 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

		unset($rt_user_created_sidebars[$rt_sidebarID]);
		
		update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $rt_user_created_sidebars);
 
 		echo __('Sidebar deleted successfully', 'rt_theme_admin');	  
	}	
}
?>