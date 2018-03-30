<?php
#-----------------------------------------
#	RT-Theme sidebar_creator.php
#	version: 1.0
#-----------------------------------------

#
#	Create sidebars
# 

class RT_Create_Sidebars{

	var $rt_sidebars          =array();
	var $savedSidebars        =array();
	var $sidebar_classes      =array();
	var $sidebar_descriptions =array();
	
	#
	# Construct
	#	 
	function __construct(){
		
		//user sidebars
		$sidebarOptions      = get_option('rt_sidebar_options');
		$this->savedSidebars = empty($sidebarOptions) ? array() : $sidebarOptions;

		//sidebar descriptions	
		array_push($this->sidebar_descriptions,array( 
			"home-page-contents"             => __('Drop widgets here to display them in home page. Widgets will also be displayed in; page or post which use the "Default Home Page Template"', 'rt_theme_admin'),
			"sidebar-for-homepage"           => __("Drop widgets here to display them in the sidebar of the home page.", 'rt_theme_admin'),
			"sidebar-for-footer"             => __("Drop widgets here to display them in the footer of the page.", 'rt_theme_admin'),
			"common-sidebar"                 => __("Drop widgets here to display them with all contents throughout the web site.", 'rt_theme_admin'),	
			"sidebar-for-pages"              => __("Drop widgets here to display them with pages only.", 'rt_theme_admin'),			
			"sidebar-for-portfolio"          => __('Drop widgets here to display them with portfolio related contents only. Widgets will be displayed in; page or post which use the "Default Portfolio Template", all portfolio categories and single portfolio item pages.' , 'rt_theme_admin'),
			"sidebar-for-portfolios"         => __("Drop widgets here to display them with single portfolio item pages only.", 'rt_theme_admin'),			
			"sidebar-all-products"           => __('Drop widgets here to display them with product showcase related contents only. Widgets will be displayed in; page or post which use the "Default Product Template", all product categories and product detail pages.', 'rt_theme_admin'),
			"sidebar-for-product"            => __("Drop widgets here to display them with product detail pages only.", 'rt_theme_admin'),			
			"sidebar-for-product-categories" => __("Drop widgets here to display them with product categories only.", 'rt_theme_admin'),
			"sidebar-for-blog"               => __('Drop widgets here to display them with blog related contents only. Widgets will be displayed in; page or post which use the "Default Blog Template", all blog categories and single post pages.', 'rt_theme_admin'),			
			"sidebar-for-archive"            => __("Drop widgets here to display them with post categories only.", 'rt_theme_admin'),
			"sidebar-for-single"             => __("Drop widgets here to display them with single post pages only.", 'rt_theme_admin'),
			"woo-commerce-contents"          => __('Drop widgets here to display them in WooCommerce related pages.', 'rt_theme_admin'),
			"sidebar-for-search"             => __('Drop widgets here to display them in search results page.', 'rt_theme_admin'),
			"sidebar-for-tags"            	 => __('Drop widgets here to display them in archives and tag lists.', 'rt_theme_admin'),
		));


		//default sidebars	
		array_push($this->rt_sidebars,array( 
			"home-page-contents"             => __("Widgetized Home Page Area", 'rt_theme_admin'),
			"sidebar-for-homepage"           => __("Sidebar For Home Page", 'rt_theme_admin'),
			"sidebar-for-footer"             => __("Sidebar For Footer", 'rt_theme_admin'),
			"common-sidebar"                 => __("Common Sidebar", 'rt_theme_admin'),	
			"sidebar-for-pages"              => __("Sidebar For Pages", 'rt_theme_admin'),			
			"sidebar-for-portfolio"          => __("Sidebar For Portfolio", 'rt_theme_admin'),
			"sidebar-for-portfolios"         => __("Sidebar For Single Portfolio Item", 'rt_theme_admin'),	
			"sidebar-all-products"           => __("Sidebar For Products", 'rt_theme_admin'),
			"sidebar-for-product"            => __("Sidebar For Single Product Item", 'rt_theme_admin'),			
			"sidebar-for-product-categories" => __("Sidebar For Product Categories", 'rt_theme_admin'),
			"sidebar-for-blog"               => __("Sidebar For Blog", 'rt_theme_admin'),			
			"sidebar-for-archive"            => __("Sidebar For Blog Categories", 'rt_theme_admin'),
			"sidebar-for-single"             => __("Sidebar For Blog Single Post", 'rt_theme_admin'),
			"sidebar-for-search"             => __("Sidebar For Search Results", 'rt_theme_admin'),
			"woo-commerce-contents"     	 => __("Sidebar For WooCommerce", 'rt_theme_admin'),
			"sidebar-for-tags"            	 => __("Sidebar For Archives/Tags", 'rt_theme_admin'),
		));

		//remove sidebar if woocommerce not installed 
		if ( ! class_exists( 'Woocommerce' ) ) {
			unset($this->rt_sidebars[0]["woo-commerce-contents"]);
		} 
			
		add_action('init',array(&$this,'create_sidebar'));
		add_action('init',array(&$this,'create_user_sidebars'));  
		add_action('init',array(&$this,'rt_get_all_sidebars'));  
		
		//sidebar classes
		array_push($this->sidebar_classes,array( 
			5 => 'five',
			4 => 'four',
			3 => 'three',
			2 => 'two',
			1 => 'one'
		));		
	}
	
	#
	# Create Sidebars
	#
	function create_sidebar(){
		foreach ($this->rt_sidebars[0] as $k => $v) {
			$this->rt_sidebar($k,$v);
		} 
	}
	
	#
	# Register Sidebars
	#
	function rt_sidebar($sidebar_id,$sidebar_name){ 
		
			$sidebar_descriptions = (isset($this->sidebar_descriptions[0][$sidebar_id])) ? $this->sidebar_descriptions[0][$sidebar_id] : ""; 
		 
			if($sidebar_id=="sidebar-for-footer"){
				
				//get footer page layout
				$footer_page_layout= isset($this->sidebar_classes[0][get_option(THEMESLUG."_footer_box_width")]) ? $this->sidebar_classes[0][get_option(THEMESLUG."_footer_box_width")] : 4;  
				register_sidebar(array(
					'id'            => $sidebar_id,
					'name'          => $sidebar_name,
					'before_widget' => '<div class="box box-shadow '.$footer_page_layout.' column_class footer widget %2$s"><div class="featured">',
					'description'   => $sidebar_descriptions,
					'after_widget'  => '</div></div>  reset ',
					'before_title'  => '<div class="title"><h3>',
					'after_title'   => '</h3><div class="space margin-b10"></div></div>',
				));
				
				add_filter('dynamic_sidebar_params', array(&$this,'footer_layout_class'));
				
			}else{
				
				register_sidebar(array(
					'id'            => $sidebar_id,
					'name'          => $sidebar_name,
					'before_widget' => '<div class="box box-shadow box_layout column_class widget %2$s"><div class="featured">',
					'description'   => $sidebar_descriptions,
					'after_widget'  => '</div></div>',
					'before_title'  => '<div class="title"><h3>',
					'after_title'   => '</h3><div class="space margin-b10"></div></div>',
				));					
			}
	 

	}

	#
	# count sidebar items
	#
	static public function count_sidebar_items($id = ""){		
		$get_sidebar_items   =wp_get_sidebars_widgets();		
		$count_sidebar_items =count($get_sidebar_items[$id]);		
		return $count_sidebar_items;
	}

	#
	# widgetized home page layout class
	#
	static public function home_page_layout_class($params = "") {
		global $widget_num,$home_contents_count,$box_width,$sidebarID,$widget_border,$tempID,$layout; 
		$fixed_row="";$fixed_row_end="";$column_class="";
		$layout_names	=  array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");
				
		if($params[0]['id'] == $sidebarID){			

			//which one
			$id=$params[0]['id'];
	
			//item count in the sidebar
			$widget_item_count = RT_Create_Sidebars::count_sidebar_items($id);
			
			if($tempID!=$params[0]['id']) {
				//temp sidebar id
				$tempID = $id;
				$home_contents_count=0;
			}
		
			// Widget class
			$class = array();
			
			// Home page class 
			if($id==$sidebarID):
			    $home_contents_count++;
			    $widget_num=$home_contents_count; 
			endif;
		
			
			// clear
			if(fmod($widget_num,$box_width) == 0  && $widget_item_count!=$widget_num ):
			    $reset = '<div class="space margin-b30"></div>';
			else:
				$reset= '';
			endif;
	
			//first and last classes
			if($widget_num==1 || fmod($widget_num,$box_width)==1 || $box_width==1):
				$column_class = 'first'; 
			elseif(fmod($widget_num,$box_width) == 0):
				$column_class = 'last'; 
			endif;


			//fixed rows			
			if($column_class == 'first') $fixed_row = '<div class="fixed-row">';
			if($column_class == 'last' || $box_width==1 || $widget_item_count==$widget_num)  $fixed_row_end = '</div>';
		  
			 
			$box_layout =  $layout_names[$box_width];
			 
			// replace content with placeholder 
			if($layout!="one")  {$params[0]['before_widget'] = str_replace('class="padding-div"', "", $params[0]['before_widget']) ;}
			
			$params[0]['before_widget'] = $fixed_row .''.  $params[0]['before_widget'];
			$params[0]['before_widget'] = str_replace('box_layout', @$box_layout, $params[0]['before_widget']);
			$params[0]['before_widget'] = str_replace('column_class', @$column_class, $params[0]['before_widget']);
			$params[0]['after_widget']  = $params[0]['after_widget'] .''. $fixed_row_end .''. $reset;
		}
		
	
		return $params;
	}


	#
	#  footer layout class
	#
	function footer_layout_class($params) {
		global $widget_num,$footer_contents_count;

		$reset = "";
		$column_class = "";

		if($params[0]['id'] == "sidebar-for-footer"){
			 
			//which one
			$id=$params[0]['id'];  
			
			//box width
			$box_width=get_option("rttheme_footer_box_width");
		
			// Widget class
			$class = array();
			
			// Home page class 
			if($id=="sidebar-for-footer"):
			    $footer_contents_count++;
			    $widget_num=$footer_contents_count;        
			endif;
		
			// clear
			if(fmod($widget_num,$box_width) == 0 || $box_width==1 || $this->count_sidebar_items($id)==$widget_num):
			    $reset = (get_option(THEMESLUG."_footer_widget_styles")) ? '<div class="space margin-b30"></div>' : '<div class="space margin-b30"></div>';
			endif;
	
			//first and last classes
			if($widget_num==1 || fmod($widget_num,$box_width)==1 || $box_width==1):
			    $column_class = 'first';
			elseif(fmod($widget_num,$box_width) == 0):
			    $column_class = 'last'; 
			endif;
			
			// replace content with placeholder
			$params[0]['before_widget'] = str_replace('column_class', @$column_class, $params[0]['before_widget']);
			$params[0]['after_widget']  = str_replace('reset', $reset, $params[0]['after_widget']);
		}
		
		return $params;
	}	

	#
	# Get All Sidebars
	#
	function rt_get_sidebar(){
		global $post;

		$post_id = isset( $post ) && isset( $post->ID ) ? $post->ID : "";
		$post_type = isset( $post->post_type ) ? $post->post_type : "" ; 

		// WooCommerce
		if ( class_exists( 'Woocommerce' ) ) {	
			if(is_woocommerce() || is_cart() || is_account_page() || is_checkout() ){ 	
				dynamic_sidebar('woo-commerce-contents');
				$WooCommercePage = "TRUE";
			}
		}

		// Call Page User Sidebars
		if(is_page()) $this->rt_get_ud_sidebars('pages',$post_id);
		
		// Call Post User Sidebar
		if(is_single()) $this->rt_get_ud_sidebars('posts',$post_id);
		
		// Call Category User Sidebar
		if(is_category()) $this->rt_get_ud_sidebars('categories',get_query_var('cat'));
		

		// Call Search Sidebar
		if(is_search())  dynamic_sidebar('sidebar-for-search');


		// Find product category id		
		$this->term = get_query_var('term'); 
		$prod_term  = get_terms('product_categories', 'slug='.$this->term.'');
		
		if(is_array($prod_term)){
			foreach ($prod_term as $k){
				$term_id=$k->term_id;
			}
		}

		// Call Product Category User Sidebar	
		if( is_tax() && get_query_var('taxonomy')=="product_categories" && isset( $term_id ) ) $this->rt_get_ud_sidebars('productcategories',$term_id);
 

		// Find portfolio category id		
		$this->term = get_query_var('term'); 
		$portfolio_term  = get_terms('portfolio_categories', 'slug='.$this->term.'');
		
		if(is_array($portfolio_term)){
			foreach ($portfolio_term as $k){
				$portf_term_id=$k->term_id;
			}
		} 
		// Call Portfolio Category User Sidebar	
		if( is_tax() && get_query_var('taxonomy')=="portfolio_categories" ) $this->rt_get_ud_sidebars('portfoliocategories',$portf_term_id);


		// Left Sidebar For Home Page
		if( is_front_page() ) { 
			dynamic_sidebar('sidebar-for-home-page');
		}
		
		// Page Sidebar
		if( is_theme_page() ) dynamic_sidebar('sidebar-for-pages');

		// Portfolio Sidebar - all portfolio contents
		if( is_portfolio_page() ) dynamic_sidebar('sidebar-for-portfolio');
		
		// Portfolio Sidebar - single portfolio item
		if( is_single() && $post_type=='portfolio' ) dynamic_sidebar('sidebar-for-portfolios');

		// Product Sidebar - all product contents 
		if( is_product_page() ) dynamic_sidebar('sidebar-all-products');
		
		// Product Sidebar - single products 
		if( is_single() && $post_type=='products' ) dynamic_sidebar('sidebar-for-product');

		// Product Sidebar Listings
		if( $post_id == PRODUCTPAGE || get_query_var('taxonomy')=="product_categories" ) dynamic_sidebar('sidebar-for-product-categories');		
		
		// Blog Categories
		if( is_category() || $post_id == BLOGPAGE ) dynamic_sidebar('sidebar-for-archive');

		// Blog All
		if( is_blog_page() && !isset($WooCommercePage) ) dynamic_sidebar('sidebar-for-blog');

		// Blog Single
		if( is_single() && $post_type=='post' ) dynamic_sidebar('sidebar-for-single');

		// Archive & Tags
		if( is_archive() || is_tag() ) dynamic_sidebar('sidebar-for-tags');

		// Common Sidebar - For all site
		dynamic_sidebar('common-sidebar');

	}

	#
	# Get User Sidebars
	#
	function rt_get_ud_sidebars($postType,$postID){
		
		// Count Sidebars
		$savedSidebars_IDs = array ();
		$sidebar_count     = 0 ;
		
		if($this->savedSidebars){
			foreach($this->savedSidebars as $key => $value){
				if(!is_array($value)){  
					if(stristr($key, '_sidebar_name') == TRUE) {
						array_push($savedSidebars_IDs,$key);
						$sidebar_count++;
					} 
				}
			}
		}
		 
		// create new sidebar array 		
		$savedSidebars_array = array ();

		// find and call the sidebar 		
		foreach($savedSidebars_IDs as $id){ 
			
			//sidebar values
			$sidebar_name               = isset($this->savedSidebars[$id]) ? $this->savedSidebars[$id]: "";	
			$sidebar_id                 = str_replace("_sidebar_name", "", $id);
			$sidebar_pages              = isset($this->savedSidebars[$sidebar_id.'_pages']) ? $this->savedSidebars[$sidebar_id.'_pages']: "";	
			$sidebar_posts              = isset($this->savedSidebars[$sidebar_id.'_posts']) ? $this->savedSidebars[$sidebar_id.'_posts']: "";	
			$sidebar_categories         = isset($this->savedSidebars[$sidebar_id.'_categories']) ? $this->savedSidebars[$sidebar_id.'_categories']: "";	
			$sidebar_product_categories = isset($this->savedSidebars[$sidebar_id.'_productcategories']) ? $this->savedSidebars[$sidebar_id.'_productcategories'] : "";
			$sidebar_portfolio_categories = isset($this->savedSidebars[$sidebar_id.'_portfoliocategories']) ? $this->savedSidebars[$sidebar_id.'_portfoliocategories'] : "";		
		
		
			//pages
			if($postType == "pages"){
				if( $sidebar_pages){				  
					foreach($sidebar_pages as $k=>$v){
						if($v==wpml_page_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//posts
			if($postType == "posts"){
				if($sidebar_posts){
					foreach($sidebar_posts as $k=>$v){
						if($v==wpml_post_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//categories
			if($postType == "categories"){
				if($sidebar_categories){
					foreach($sidebar_categories as $k=>$v){
						if($v==wpml_category_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//product categories
			if($postType == "productcategories"){
				if($sidebar_product_categories){ 
					foreach($sidebar_product_categories as $k=>$v){
						if($v==wpml_product_category_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

			//portfolio categories
			if($postType == "portfoliocategories"){
				if($sidebar_portfolio_categories){ 
					foreach($sidebar_portfolio_categories as $k=>$v){
						if($v==wpml_portfolio_category_id($postID)){
							dynamic_sidebar($sidebar_id);
						}
					}
				}
			}

		}
	}


	#
	# Create user sidebars
	#
	function create_user_sidebars(){
		foreach($this->savedSidebars as $key => $value){
			if(!is_array($value)){  
				if(stristr($key, '_sidebar_name') == TRUE) {
					$this->rt_sidebar(str_replace("_sidebar_name", "", $key),$value);
				} 
			}
		}
	}	


	#
	# All Sidebars as array
	#
	function rt_get_all_sidebars(){
		global $UserSidebarIDs;
		
		// Count Sidebars
		$savedSidebars_IDs = array ();
		$sidebar_count = 0 ;
		
		if($this->savedSidebars){
			foreach($this->savedSidebars as $key => $value){
				if(!is_array($value)){  
					if(stristr($key, '_sidebar_name') == TRUE) {
						array_push($savedSidebars_IDs,$key);
						$sidebar_count++;
					} 
				}
			}
		}
		 
		// User sidebars as id and name 
		$UserSidebarIDs  =  new stdClass;

		foreach($this->rt_sidebars[0] as $key=>$value){ 
			
			//sidebar values
			$sidebar_name 	= $value;
			$sidebar_id 	= $key;
			
			//add to class
			$UserSidebarIDs->sidebars[$sidebar_id] = $sidebar_name; 
		}

 
		// find and call the sidebar 		
		foreach($savedSidebars_IDs as $id){ 
			
			//sidebar values
			$sidebar_name 	= @$this->savedSidebars[$id];
			$sidebar_id 	= str_replace("_sidebar_name", "", $id);
			
			//add to class
			$UserSidebarIDs->sidebars[$sidebar_id] = $sidebar_name; 
		}
		
	}
	

}


?>