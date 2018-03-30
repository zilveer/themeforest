<?php
	/** 
     * @Author: NasirHayat
	   @Url: http://nasirhayat.com
     * @Version 2013 (crunchpress)
	   @Rights Reserved 2013
     */
			
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			
			require_once ABSPATH . 'wp-admin/includes/import.php';
			
			/*$import_filepath = get_template_directory()."/extensions/importer/dummy_data";*/
			$import_filepath = TH_FW_BE_SER."/extensions/importer/dummy_data";
			$errors = false;
			if ( !class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) )
				{
					require_once $class_wp_importer;
				}
				else
				{
					$errors = true;
				}
			}
			if ( !class_exists( 'WP_Import' ) ) {
				$wp_importer = TH_FW_BE_SER. '/extensions/importer/wordpress-importer.php';
				if ( file_exists( $wp_importer ) )
				{
					require_once $wp_importer ;
				}
				else
				{
					$errors = true;
				}
			}
			
			if($errors){
			   echo "Errors while loading classes. Please use the standart wordpress importer."; 
			}else{
    
			
			include_once 'default_dummy_data.inc.php';
			if(!is_file($import_filepath.'_1.xml'))
			{
				echo "Problem with dummy data file. Please check the permisions of the xml file";
			}
			else
			{  
			   if(class_exists( 'WP_Import' )){
			wp_delete_post(1);		
			$menuname = $lblg_themename . 'Main Menu'; 
			$bpmenulocation = 'main_menu';
			$menu_exists = wp_get_nav_menu_object( $menuname );
			if( !$menu_exists){ $menu_id = wp_create_nav_menu($menuname);
			if( !has_nav_menu( $bpmenulocation ) ){ $locations = get_theme_mod('nav_menu_locations');	
			  $locations[$bpmenulocation] = $menu_id;	set_theme_mod( 'nav_menu_locations', $locations ); }
			} 
			$menuname = $lblg_themename . 'Menu footer'; 
			$bpmenulocation = 'footer_menu';
			$menu_exists = wp_get_nav_menu_object( $menuname );
			if( !$menu_exists){ $menu_id = wp_create_nav_menu($menuname);
			if( !has_nav_menu( $bpmenulocation ) ){ $locations = get_theme_mod('nav_menu_locations');	
			  $locations[$bpmenulocation] = $menu_id;	set_theme_mod( 'nav_menu_locations', $locations ); }
			} 
			
          /* $menuname3 = $lblg_themename3 . 'Menu footer'; $bpmenulocation3 = 'footer_menu'; $menu_exists3 = wp_get_nav_menu_object( $menuname3 ); if( !$menu_exists){	$menu_id = wp_create_nav_menu($menuname3); if( !has_nav_menu( $bpmenulocation3 ) ){	$locations3 = get_theme_mod('nav_menu_locations'); $locations3[$bpmenulocation3] = $menu_id; set_theme_mod( 'nav_menu_locations', $locations3 ); }
			} 	*/
		  
	
			$our_class = new themeple_dummy_data();
			$our_class->fetch_attachments = true;
			
			/* $our_class->import($import_filepath.'megamenu.xml');*/
			$our_class->import($import_filepath.'_1.xml');
			//Default Settings Saved End
			$sidebars_widgets = array ( 'wp_inactive_widgets' => array ( ), 
			'sidebar-footer-1' => array ( 0 => 'text-7'),
			'sidebar-footer-2' => array ( 0 => 'cp_recentpost-widget-2'),
			'sidebar-footer-3' => array ( 0 => 'text-4'),
			'sidebar-footer-4' => array ( 0 => 'tag_cloud-2'), 
			/*'custom-sidebar0' => array ( 0 => 'search-3', 'cp_recent_blog_post-widget-2', 'cp_recent_blog_post-widget-2', 'cp_recentprojectslider-widget-2', 'twitter-widget-2','testimonial-widget-2','tag_cloud-2'), */
			'array_version' => 3, )  ;
		
			$cp_recentpost = array ( 'title' => 'Recent Projects', 'show_num' => '9', 'post_cat' => 'All' ) ;
			$widget_contactwidget = array ('title' => 'Tags', 'taxonomy' => 'tags') ;
			
			save_option('sidebars_widgets','', $sidebars_widgets);
			/*save_option('widget_cp_subscribe-multi-2',get_option('widget_cp_subscribe-multi-2'), $widget_cp_widget_cp_subscribe);*/
		    save_option('widget_tag_cloud',get_option('widget_tag_cloud'), $widget_contactwidget);	
			save_option('widget_cp_recentpost-widget', get_option('widget_cp_recentpost-widget'), $cp_recentpost);	
			save_option('widget_cp_popularpost-widget',get_option('widget_cp_popularpost-widget'), $cp_popularpost);
			/*save_option('widget_onsale',get_option('widget_onsale'), $widget_on_sale);*/
			
			
			
			
			//Home Page Settings
			$text7 = array();
			$text7 = get_option('widget_text');
			$text7[7] = array(
								"title"			=>	'',
								"text"			=>	'<div class="widget-aboutus">
<header class="header-style">
<h2 class="h-style"><img src="http://demo.crunchpress.com/viduze/wp-content/uploads/2014/06/footer-logo.png" alt=""></h2>
 </header>
 <p>Viduze is a clean and responsive video theme. It has very rich contents in homepage. They can be grouped under category or post type. Every video item has representative image thumbnail. </p>
<p>Most amazing video magazine ever. [+]</p>
</div>',
								);						
			$text7['_multiwidget'] = '1';
			update_option('widget_text',$text7);
			$text7 = get_option('widget_text');
			krsort($text7);
			foreach($text7 as $key1=>$val1)
			{
				$text7_key = $key1;
				if(is_int($text7_key))
				{
					break;
				}
			}
			
				//Home Page Settings
			$text4 = array();
			$text4 = get_option('widget_text');
			$text4[4] = array(
								"title"			=>	'Categories',
								"text"			=>	'<div class="textwidget"><ul>
	<li class="cat-item cat-item-8"><a href="http://demo.crunchpress.com/viduze/category/artists/" title="View all posts filed under Artists">Artists</a>
</li>
	<li class="cat-item cat-item-6"><a href="http://demo.crunchpress.com/viduze/category/blog/" title="View all posts filed under Blog">Blog</a>
</li>
	<li class="cat-item cat-item-24"><a href="http://demo.crunchpress.com/viduze/category/business-2/" title="View all posts filed under Business">Business</a>
</li>
	<li class="cat-item cat-item-4"><a href="http://demo.crunchpress.com/viduze/category/category-videos/" title="View all posts filed under Category Videos">Category Videos</a>
</li>
	<li class="cat-item cat-item-27"><a href="http://demo.crunchpress.com/viduze/category/features/" title="View all posts filed under Features">Features</a>
</li>
	<li class="cat-item cat-item-1"><a href="http://demo.crunchpress.com/viduze/category/latest-videos/" title="View all posts filed under Latest Videos">Latest Videos</a>
</li>
		</ul></div>',
								);						
			$text4['_multiwidget'] = '1';
			update_option('widget_text',$text4);
			$text4 = get_option('widget_text');
			krsort($text4);
			foreach($text4 as $key1=>$val1)
			{
				$text4_key = $key1;
				if(is_int($text4_key))
				{
					break;
				}
			}
			
			$sidebars_widgets["Footer 1"] = array("text-$text7_key");
			
			$sidebars_widgets["Footer 3"] = array("text-$text4_key");
		
			 
			$front_page = get_page_by_title ('Frontpage'); update_option('page_on_front',$front_page->ID); update_option('show_on_front','page');
			
			/*$blog_page = get_page_by_title ('Blog');
			update_option('page_for_posts',$blog_page->ID);*/
		
			
			update_option(THEME_NAME_S.'_header_text', '<ul>
                  <li> <i class="icon-envelope"></i> <a href="mailto:projects@company.com">projects@company.com</a> </li>
                  <li> <i class="icon-time"></i> Monday - Friday 10:00 - 18:00 </li>
                </ul>');
				
			update_option(THEME_NAME_S.'show_social_icons', 'enable');
			update_option(THEME_NAME_S.'_facebook', 'facebook');
			update_option(THEME_NAME_S.'_linkedin', 'linkedin');
			update_option(THEME_NAME_S.'_tumblr', 'tumblr');
			update_option(THEME_NAME_S.'_twitter', 'twitter');
			update_option(THEME_NAME_S.'_vimeo', 'vimeo');
			update_option(THEME_NAME_S.'_youtube', 'youtube');
			update_option(THEME_NAME_S.'_footer_style', 'footer-style1');
			update_option(THEME_NAME_S.'_create_sidebar', '<sidebar><name>Blog</name></sidebar>');
			update_option(THEME_NAME_S.'_background_style', 'Pattern');

        }
	}    
}


?>