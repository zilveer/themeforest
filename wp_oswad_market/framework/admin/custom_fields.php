<?php 
class CustomFields extends AdminTheme 
{
	public function __construct(){
		add_action("admin_init", array($this,"generateCustomFields"));
		define('THEME_ADMIN_CUSTMOM_FIELDS_TPL', THEME_ADMIN_TPL . '/custom_fields');
		add_action('save_post', array($this,'saveCustomField'));
		$this->resetArrLayout();
	}
	
	public function generateCustomFields(){
		// Add shortcode Generator
		
		add_meta_box("page_config", "Page Configuration", array($this,"page_configuration"), "page", "normal", "high");
		
		add_meta_box("post_options", "Post Options", array($this,"post_options"), "post", "normal", "high");
		
		add_meta_box("post_gallery", "Gallery", array($this,"post_gallery"), "post", "side", "low");
		
		if(post_type_exists('product')) {
			add_meta_box("wp_cp_custom_product_layout", "Config Product", array($this,"product_layout"), "product", "normal", "high");
		}	
		if(post_type_exists('testimonial')) {		
			add_meta_box("wp_cp_custom_testimonial", "Username", array($this,"custom_field_testimonial"), "testimonial", "normal", "high");
		}
	}
	
	
	public function product_layout(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/custom_layout.php';
	}
	
	/* 
		Save config of custom fields for current post
		Input : int $post_id (the id of current post).
		No output.
	*/
	public function saveCustomField($post_id){
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		if(isset($_POST['_inline_edit'])) 
        return $post_id;
		if( isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'list' )
			return $post_id;	
		if( isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'trash' )
			return $post_id;			
		// Save featured for post
		if(isset($_POST['featured_post']))
			update_post_meta($post_id,THEME_SLUG.'featured_post',$_POST['featured_post']);
			
		// Save video link for post
		if(isset($_POST['video_portfolio']))
			update_post_meta($post_id,THEME_SLUG.'video_portfolio',$_POST['video_portfolio']);
			
		// Save video link for portfolio
		if(isset($_POST['custom_link_portfolio']))
			update_post_meta($post_id,THEME_SLUG.'custom_link_portfolio',$_POST['custom_link_portfolio']);	
			
		// Save layout for custom page
		if(isset($_POST['custom_page_layout']))
			update_post_meta($post_id,THEME_SLUG.'custom_page_layout',$_POST['custom_page_layout']);
			
		// Save product custom layout & sidebar
		if( isset($_POST['custom_product_layout']) && $_POST['custom_product_layout'] == "custom_single_prod_layout" ){
			$_default_prod_config = array(
				'layout' 					=> $_POST['single_layout']
				,'left_sidebar' 			=> $_POST['single_left_sidebar']
				,'right_sidebar' 			=> $_POST['single_right_sidebar']		
			);		
			$ret_str = serialize($_default_prod_config);
			update_post_meta($post_id,THEME_SLUG.'custom_product_config',$ret_str);	
		}
		
		if(isset($_POST['custom_sidebar']))
			update_post_meta($post_id,THEME_SLUG.'custom_sidebar',$_POST['custom_sidebar']);
		
		if(isset($_POST['username_twitter_testimonial']))
			update_post_meta($post_id,THEME_SLUG.'username_twitter_testimonial',$_POST['username_twitter_testimonial']);		
			
		// Save Gallery for slideshow
		if(isset($_POST['gal_slideshow']))
			update_post_meta($post_id,THEME_SLUG.'gal_slideshow',$_POST['gal_slideshow']);
		
		// Save select for ew_slideshow
		if(isset($_POST['slideshow_post']))
			update_post_meta($post_id,THEME_SLUG.'slideshow_post',$_POST['slideshow_post']);		
			
		// Save select for video
		if(isset($_POST['video_portfolio']))
			update_post_meta($post_id,THEME_SLUG.'video_portfolio',$_POST['video_portfolio']);	
		
		// Save select for video
		if(isset($_POST['proj_link']))
			update_post_meta($post_id,THEME_SLUG.'proj_link',$_POST['proj_link']);			
			
		// Save logo icon for service
		if(isset($_POST['ew_service_custom_logo']))
			update_post_meta($post_id,THEME_SLUG.'ew_service_custom_logo',$_POST['ew_service_custom_logo']);		
		if(isset($_POST['ew_service_custom_link']))
			update_post_meta($post_id,THEME_SLUG.'ew_service_custom_link',$_POST['ew_service_custom_link']);	

	
		//do save portfolio slider
		if( isset($_POST['_portfolio_slider']) && $_POST['_portfolio_slider'] == 1 ){
			$ret_str = '';
			$element_count = count($_POST['element_id']);
			$ret_arr = array();
			for( $i = 0 ; $i < $element_count ; $i++ ){	
				$temp_arr = array(
					'id' 				=> $_POST['element_id'][$i]
					,'image_url' 		=> $_POST['element_image_url'][$i]
					,'thumb_id' 		=> $_POST['thumb_id'][$i]
					,'thumb_url' 		=> $_POST['thumb_url'][$i]
					,'url' 				=> $_POST['element_url'][$i]
					,'alt' 				=> $_POST['element_alt'][$i]
					,'title'			=> $_POST['element_title'][$i]
				
				);
				array_push( $ret_arr, $temp_arr );
			}
			
			$ret_str = serialize($ret_arr);
			update_post_meta($post_id,THEME_SLUG.'_portfolio_slider',$ret_str);	
		}
	
		//do save portfolio slider
		if( isset($_POST['_sliders_slider']) && $_POST['_sliders_slider'] == 1 ){
			$ret_str = '';
			$element_count = count($_POST['element_id']);
			$ret_arr = array();
			for( $i = 0 ; $i < $element_count ; $i++ ){	
				$temp_arr = array(
					'id' 				=> $_POST['element_id'][$i]
					//,'image_url' 		=> $_POST['element_image_url'][$i]
					//,'thumb_url' 		=> $_POST['thumb_url'][$i]
					,'thumb_id' 		=> $_POST['thumb_id'][$i]
					,'url' 				=> $_POST['element_url'][$i]
					,'alt' 				=> $_POST['element_alt'][$i]
					,'title' 			=> $_POST['element_title'][$i]
					,'slide_title' 		=> $_POST['slide_title'][$i]
					,'slide_content' 	=> $_POST['slide_content'][$i]					
				
				);
				array_push( $ret_arr, $temp_arr );
			}
			
			$ret_str = serialize($ret_arr);
			update_post_meta($post_id,THEME_SLUG.'_portfolio_slider',$ret_str);	
			
			
			$ret_arr = array(
				'portfolio_slider_config_size' 			=> $_POST['portfolio_slider_config_size']
				,'portfolio_slider_config_autoslide' 	=> $_POST['portfolio_slider_config_autoslide']
				// ,'portfolio_slider_config_width' 		=> $_POST['portfolio_slider_config_width']
				// ,'portfolio_slider_config_height' 		=> $_POST['portfolio_slider_config_height']
			);
			$ret_str = serialize($ret_arr);
			update_post_meta($post_id,THEME_SLUG.'_portfolio_slider_config',$ret_str);				
		}
		
		if ( isset($_POST['_page_config']) && (int)$_POST['_page_config'] == 1 && wp_verify_nonce($_POST['nonce_page_config'],'_update_page_config') ){
			$_post_params = array(
										"page_layout" 				=> $_POST['page_layout']
										,"page_column" 				=> $_POST['page_column']
										,"left_sidebar" 			=> $_POST['left_sidebar']
										,"right_sidebar" 			=> $_POST['right_sidebar']
										,"page_slider" 				=> $_POST['page_slider']
										,"page_revolution" 			=> isset($_POST['page_revolution'])?$_POST['page_revolution']:''
										,"page_layerslider" 		=> isset($_POST['page_layerslider'])?$_POST['page_layerslider']:''
										,"product_cat" 				=> isset($_POST['product_cat'])?$_POST['product_cat']:''
										,"portfolio_columns" 		=> absint($_POST['portfolio_columns'])
										,"portfolio_filter"			=> absint($_POST['portfolio_filter'])
										,"hide_new_product" 		=> absint($_POST['hide_new_product'])
										,"hide_breadcrumb" 			=> absint($_POST['hide_breadcrumb'])
										,"hide_title" 				=> absint($_POST['hide_title'])
										,"hide_header" 				=> isset($_POST['hide_header'])?absint($_POST['hide_header']):0
										,"hide_footer" 				=> isset($_POST['hide_footer'])?absint($_POST['hide_footer']):0
										,"hide_top_content" 		=> absint($_POST['hide_top_content'])
										,"hide_banner_top_content" 	=> absint($_POST['hide_banner_top_content'])
										,"product_slider_columns"	=> $_POST['product_slider_columns']
										,"product_slider_title"		=>  stripslashes($_POST['product_slider_title'])
									);
			//die(print_r($_post_params));						
			$_post_params = wd_array_atts(array(
										"page_layout" 			=> '0'
										,"banner_layout"		=> 'box'
										,"page_column"			=> '0-1-0'
										,"left_sidebar" 		=>'primary-widget-area-left'
										,"right_sidebar" 		=> 'primary-widget-area-right'
										,"page_slider" 			=> 'none'
										,"page_revolution" 		=> ''
										,"page_layerslider" 	=> ''	
										,"product_cat" 			=> ''	
										,"portfolio_columns" 	=> 1
										,"portfolio_filter"		=> 1
										,"hide_new_product"		=> 1
										,"hide_breadcrumb" 		=> 0		
										,"hide_title" 			=> 0											
										,"hide_header" 			=> 0											
										,"hide_footer" 			=> 0											
										,"hide_top_content" 	=> 0
										,"hide_banner_top_content" 	=> 1
										,"product_slider_columns"=> 4
										,"product_slider_title"	=> ''
									),$_post_params	);					
			$ret_str = serialize($_post_params);			
			
			update_post_meta($post_id,THEME_SLUG.'page_configuration',$ret_str);	
		}

		if ( isset($_POST['_post_options']) && (int)$_POST['_post_options'] == 1 && wp_verify_nonce($_POST['nonce_post_options'],'_update_post_options') ){
			$_post_params = array(
								"post_column" 				=> $_POST['post_column']
								,"left_sidebar" 			=> $_POST['left_sidebar']
								,"right_sidebar" 			=> $_POST['right_sidebar']
								);
			$_post_params = wd_array_atts(array(
										"post_column"			=> '0'
										,"left_sidebar" 		=> '0'
										,"right_sidebar" 		=> '0'
										), $_post_params);
			$ret_str = serialize($_post_params);			
			
			update_post_meta($post_id,THEME_SLUG.'post_options',$ret_str);
			
			$video_url = isset($_POST['video_url'])?$_POST['video_url']:'';
			$video_width = isset($_POST['video_width'])?$_POST['video_width']:700;
			$video_height = isset($_POST['video_height'])?$_POST['video_height']:400;
			update_post_meta($post_id, '_video_url', $video_url);
			update_post_meta($post_id, '_video_width', $video_width);
			update_post_meta($post_id, '_video_height', $video_height);
		}
		
		if ( isset($_POST['_post_gallery']) && (int)$_POST['_post_gallery'] == 1 && wp_verify_nonce($_POST['nonce_post_gallery'],'_update_post_gallery') ){
			$attachment_ids = $_POST['attachment_ids'];
			update_post_meta($post_id, THEME_SLUG.'post_gallery', $attachment_ids);
		}
		
	}
	
	/* 
		Load shortcode options for shortcode generator.
		Options.php file is placed in 'includes' folder.
	*/ 
	public function loadShortcodeOptions(){
		global $post;
		if(file_exists(THEME_EXTENDS_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php'))
			require_once THEME_EXTENDS_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php';
		else	
			require_once THEME_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php';
	}
	
	/* Generate shortcode generator */
	public function createShortcodeGenerator(){
		$this->loadShortcodeOptions();
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/shortcode_generator.php';
	}
	
	/* Generate logo image field */
	public function show_custom_logo(){
		global $post;
		$image = get_template_directory_uri().'/framework/admin/images/default_logo.png';	
		$meta = get_post_meta($post->ID, THEME_SLUG.'ew_service_custom_logo', true);
		$metaLink = get_post_meta($post->ID, THEME_SLUG.'ew_service_custom_link', true);
		echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
		if ($meta) {
			$image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; 
		}		

		echo	'<span>Custom link : </span><input name="ew_service_custom_link" type="text" value="'.$metaLink.'" size="50"/><br>';	
		echo	'<input name="'.ew_service_custom_logo.'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
				<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
				<input class="custom_upload_image_button button" type="button" value="Choose Image" />
				<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
				<br clear="all" /><span class="description">Upload your logo here</span>
				<br>';
		
				
				
	}
	
	
	/* Generate 'seo' field */
	public function createSeoMeta(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/seo_meta.php';
	}
	
	/* Generate 'custom layout' panel for chosing layout of post(portfolio) */
	public function createCustomLayout(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/custom_layout.php';
	}
	
	/* Generate 'custom sidebar' panel for chosing sidebar of post(portfolio) */
	
	/* Generate 'video link' field for entering video link of portfolio */
	public function createVideoLink(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/video.php';
	}
	
	/* Generate 'slideshow' checkbox for chosing a portfolio of slideshow */
	public function createSlideshowChoice(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/slideshow_choice.php';
	}
	
	/* Generate 'type portfolio' select for chosing type of portfolio(image or video) */
	public function createTypePortfolio(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/type_portfolio.php';
	}
	public function page_configuration(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/page_configuration.php';
	}
	public function post_options(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/post_options.php';
	}
	public function post_gallery(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/post_gallery.php';
	}
	public function showvideo(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/video.php';
	}	
	public function showimages(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/images.php';
	}		
	public function custom_field_testimonial(){
		require_once THEME_ADMIN_CUSTMOM_FIELDS_TPL.'/testimonial.php';
	}
}
?>