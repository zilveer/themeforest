<?php
#-----------------------------------------
#	RT-Theme theme.php
#	version: 1.2
#-----------------------------------------

#
#	Site Class
#
 
class RTThemeSite extends RTTheme {
 
	function theme_init(){ 

		//Loading Theme Scripts
		add_action('init', array(&$this,'load_scripts'));

		//Loading Theme Styles
		add_action('init', array(&$this,'load_styles'));

		//Fix Content
		add_action('the_content', array(&$this,'fix_content'));		
		
		//Paging fix for custom post archives 
		add_action('init', array(&$this,'rt_modify_posts_per_page'));
		
		//Load Cufon Fonts
		add_filter('wp_head', array(&$this,'cufon_fonts'));

		//Load Google Fonts
		add_filter('wp_head', array(&$this,'google_fonts'));

		//ajax url
		add_filter('wp_head', array(&$this,'frontend_ajaxurl'));
	}  


	#
	# Loading Theme Scripts
	#
	
	function load_scripts(){ 
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-easing', THEMEURI  . '/js/jquery.easing.1.3.js', array('jquery') );

		
		wp_enqueue_script('jquery-prettyphoto', THEMEURI  . '/js/jquery.prettyPhoto.js', array('jquery') );
		
		if(get_option( 'rttheme_cufon_fonts')){
			wp_enqueue_script('jquery-cufon-yui', THEMEURI  . '/js/cufon-yui.js', array('jquery') );
			
			foreach($this->fonts as $font_file => $font_name){
				if(get_option('rttheme_cufon_font_file_heading')==$font_file || get_option('rttheme_cufon_font_file_menu')==$font_file ){ 
					wp_enqueue_script($font_file, THEMEURI  . '/js/fonts/'.$font_file.'.js', array('jquery') );
				}
			
			}	
		}
		
		wp_enqueue_script('jquery-colortip', THEMEURI  . '/js/colortip-1.0-jquery.js', array('jquery') );
		wp_enqueue_script('jquery-validate', THEMEURI  . '/js/jquery.validate.js', array('jquery') );
		wp_enqueue_script('jqueryform', THEMEURI  . '/js/jquery.form.js', array('jquery') );
		wp_enqueue_script('jquery-flickr', THEMEURI  . '/js/jflickrfeed.min.js', array('jquery') ); 
		wp_enqueue_script('flex-slider', THEMEURI  . '/js/jquery.flexslider.js', array('jquery') );
		wp_enqueue_script('jquery-img-prelood', THEMEURI  . '/js/jquery.imgpreload.min.js', array('jquery') ); 
		wp_enqueue_script('jquery-fullbg', THEMEURI  . '/js/jquery.fullbg.min.js', array('jquery') );	
		wp_enqueue_script('jquery-carousel', THEMEURI  . '/js/jquery.jcarousel.min.js', array('jquery') );
		wp_enqueue_script('jquery-nivoslider', THEMEURI  . '/js/jquery.nivo.slider.pack.js', array('jquery') );

		wp_enqueue_script('jplayer', THEMEURI  . '/js/jquery.jplayer.min.js', array('jquery') );

		wp_enqueue_script('rt-theme-scripts', THEMEURI  . '/js/script.js', array('jquery'), "", "true" ); 
		wp_enqueue_script('jquery-tools', THEMEURI  . '/js/jquery.tools.min.js', array('jquery'), "", "true" ); 
		wp_enqueue_script('jquery');
	}
	
	#
	# Loading Theme Styles
	#
	
	function load_styles(){
 
		
		wp_register_style('theme-reset', THEMEURI . '/css/rt-css-framework.css', 1 , false, 'all');
		wp_register_style('theme-style-all',THEMEURI . '/css/style.css', 2 , false, 'all');
		
		if(get_option(THEMESLUG."_17_style")){			
			wp_register_style('theme-skin',THEMEURI . '/css/'.get_option( THEMESLUG."_17_style").'-style.css', 3 , false, 'all'); //dark skin				
		}

		wp_register_style('prettyPhoto',THEMEURI . '/css/prettyPhoto.css', 5 , false, 'screen');

		if(get_option(THEMESLUG."_font_face")){
			wp_register_style('rtfontface',THEMEURI . '/css/fontface.css', 100 , false, 'all');
		}		

		
		wp_enqueue_style('theme-reset');
		wp_enqueue_style('theme-style-all');  
		wp_enqueue_style('rtfontface');	
		wp_enqueue_style('prettyPhoto');		 
		wp_enqueue_style('jquery-colortip', THEMEURI . '/css/colortip-1.0-jquery.css');		 
		wp_enqueue_style('jquery-jcarousel', THEMEURI . '/css/jcarousel.css');  
		wp_enqueue_style('jquery-flexslider', THEMEURI . '/css/flexslider.css');
		wp_enqueue_style('jquery-nivoslider', THEMEURI . '/css/nivo-slider.css');
		wp_enqueue_style('jquery-nivoslider-theme', THEMEURI . '/css/nivo-default/default.css'); 
		wp_enqueue_style('theme-skin');

		wp_register_style('theme-ie7',THEMEURI . '/css/ie7.css', 6 , false, 'screen');
		$GLOBALS['wp_styles']->add_data( 'theme-ie7', 'conditional', 'IE 7' );
		wp_enqueue_style('theme-ie7');

		wp_register_style('theme-ie8',THEMEURI . '/css/ie8.css', 6 , false, 'screen');
		$GLOBALS['wp_styles']->add_data( 'theme-ie8', 'conditional', 'IE 8' );
		wp_enqueue_style('theme-ie8');


		wp_register_style('theme-style',get_bloginfo( 'stylesheet_url' ), 4 , false, 'all'); //WP default stylesheet 
		wp_enqueue_style('theme-style');

		if (class_exists( 'Woocommerce' ) ) { //woocommerce style for rt-theme
			global $woocommerce, $suffix;

			wp_enqueue_style( 'rt-woocommerce-styles', THEMEURI.'/rt-woocommerce/woocommerce.css');

		}
	}


	#
	#   Cufon Fonts
	#
	
	function cufon_fonts(){ 
	global $fonts;

		$rttheme_cufon_font_file_menu=get_option('rttheme_cufon_font_file_menu');
		$rttheme_cufon_font_file_heading=get_option('rttheme_cufon_font_file_heading');
		
		if(get_option( 'rttheme_cufon_fonts' )):
		?>
		
		<script type="text/javascript">
		//cufon fonts 
		jQuery(document).ready(function(){		

			   Cufon.replace('h1.logo a', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: false,		  
				textShadow: 'none' 
			   });

			   Cufon.replace('h1,h2,h4,h5,h6,h3:not(.nocufon) ', {
				fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_heading][0];?>',
				hover: true 
			   });
  
			   Cufon.replace('#navigation_bar > ul > li', {
				
				<?php if(trim($fonts[$rttheme_cufon_font_file_menu][0])=="Aller Light"):?>
					fontFamily: 'Aller',
				<?php else:?>
					fontFamily: '<?php echo $fonts[$rttheme_cufon_font_file_menu][0];?>',
				<?php endif;?>
			 
				hover: true,
				hoverables: { li: true },
				ignore: { ul: true },
				textless: { li: true }
			   });	   
		});  
		</script>
		
		<!--[if gte IE 9]>
		<script type="text/javascript">
		Cufon.set('engine', 'canvas');
		</script>
		<![endif]-->

		<?php endif;
		
		return $rttheme_cufon_font_file_menu=get_option('rttheme_cufon_font_file_menu');
	}	 
	
	#
	#   Google Fonts
	#
	
	function google_fonts(){ 
	global $google_fonts,$google_font_replace;
	
	$google_font_replace = "";

		if(get_option( 'rttheme_google_fonts' )){
	 
			$rttheme_google_fonts_body=get_option('rttheme_google_fonts_body'); 
			$rttheme_google_fonts_heading=get_option('rttheme_google_fonts_heading');
			$rttheme_google_fonts_menu=get_option('rttheme_google_fonts_menu');
			$rttheme_google_fonts_banner=get_option('rttheme_google_fonts_banner');
			$rttheme_google_serif_font=get_option('rttheme_google_serif_font');
			
			$google_fonts_array=array($rttheme_google_fonts_body,$rttheme_google_fonts_heading,$rttheme_google_fonts_menu,$rttheme_google_serif_font,$rttheme_google_fonts_banner);			
			
			foreach(array_unique($google_fonts_array) as $font_file){
				if($font_file){
					$font_file=str_replace("&","&amp;",$font_file);
					$google_font_replace .= "\n".'<link href="https://fonts.googleapis.com/css?family='.$font_file.'" rel="stylesheet" type="text/css" />';
				}
			}

			
			//droid serif font manual
			if($rttheme_google_serif_font){
				$google_font_replace .= '<style type="text/css">
					.tweet_time a,
					dd,
					.frame, .wp-caption,
					.blog_list .comment_quote p,
					.tags,
					.tags  a,
					.author_info strong a,
					i.decs_text,
					blockquote,
					#comments ol.commentlist li .comment-body .comment-author, #cancel-comment-reply-link,
					.rss-date,
					a.read_more,
					a.more-link,
					span.price,
					.client_logos_text,
					.recent_posts .date,
					.template_builder .sub_title{
						font-family:"'.$google_fonts[$rttheme_google_serif_font][0].'";			
					}
				</style>';	
			}

			if($rttheme_google_fonts_body){
				$google_font_replace .= '<style type="text/css">
					body,
					.flex-caption p,
					.paging .arrowleft a,.paging .arrowright a
					{
						font-family:"'.$google_fonts[$rttheme_google_fonts_body][0].'";			
					}
				</style>';	
			}
			 
			if($rttheme_google_fonts_heading){
				$google_font_replace .= '<style type="text/css">
					.paging li a,
					.banner .featured_text,
					a.banner_button,
					h1,h2,h3,h4,h5,h6,
					.tp-caption.r-theme-black,
					.tp-caption.r-theme-blue,
					.tp-caption.rt-theme-bigger-dark-text,
					.icon-holder.number
					{
						font-family:"'.$google_fonts[$rttheme_google_fonts_heading][0].'";			
					}
				</style>';
			}
			 
			if($rttheme_google_fonts_menu){
				$google_font_replace .= '<style type="text/css">	#navigation_bar > ul > li > a {font-family:"'.$google_fonts[$rttheme_google_fonts_menu][0].'";}</style>';	
			}


			if($rttheme_google_fonts_banner){
				$google_font_replace .= '<style type="text/css"> .banner p {font-family:"'.$google_fonts[$rttheme_google_fonts_banner][0].'";}</style>';	
			}	
		}
	}

	#
	# Paging fix for custom post archives 
	#
	
	function rt_custom_post_limits( $value )
	{

		if(is_tax()){

			$post_per_page = 0;

			if(get_query_var('product_categories') || get_query_var('taxonomy')=="product_categories"){
				$post_per_page=get_option('rttheme_product_list_pager');
			}elseif(get_query_var('portfolio_categories') || get_query_var('taxonomy')=="portfolio_categories"){
				$post_per_page=get_option('rttheme_portf_pager');
			} 
			
			if($post_per_page>0){	
				return $post_per_page;
			}else{
				return $value;
			}
		
		}elseif(get_query_var('s')!=""){
			$post_per_page=20;
			return $post_per_page;
		}else{
			return $value;
		}
	}
	
	function rt_modify_posts_per_page() {
			add_filter( 'option_posts_per_page', array(&$this,'rt_custom_post_limits'));
	}
	
	

}


?>