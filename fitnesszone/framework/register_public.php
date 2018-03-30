<?php
#TO WORK SHORTCODE USING WIDGET TEXT.
add_filter('widget_text', 'do_shortcode');

#FILTER TO MODIFY THE DEFAULT CATEGORY WIDGET & ARCHIVES WIDGET
add_filter('wp_list_categories', 'dt_theme_wp_list_categories');
function dt_theme_wp_list_categories($output) {
	if (strpos($output, "</span>") <= 0) {
		$output = str_replace('</a> (', '<span> ', $output);
		$output = str_replace(')', '</span></a> ', $output);
	}
	return $output;
}
add_filter('get_archives_link', 'dt_theme_wp_list_archive');
function dt_theme_wp_list_archive($output) {
	$output = str_replace('</a>&nbsp;(','<span> ',$output);
	$output = str_replace(')','</span></a> ',$output);
	return $output;
}

#FILTER TO MODIFY THE DEFAULT PRODUCT CATEGORY WIDGET
add_filter('woocommerce_product_categories_widget_args', 'dt_theme_filter_widget_product_categories');
function dt_theme_filter_widget_product_categories($args) {
	$walker = new DT_Theme_Walker_Category();
   	$args = array_merge($args, array('walker' => $walker));
   	return $args;
}

##WALKER TO MODIFY THE PRODUCT CATEGORY WIDGET
class DT_Theme_Walker_Category extends Walker_Category {
   function start_el(&$output, $category, $depth = 0, $args = array(), $current_category = 0) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
	  
      $link = '<a href="' . get_term_link( $category->name, 'product_cat' ) . '" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all products under %s', 'iamd_text_domain' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      $link .= $cat_name;

      $link .= '</a>';
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= "\t<li";
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}

/** dt_theme_default_navigation()
 * Objective:
 *		To setup default navigation  when no menu is selected
 **/
function dt_theme_default_navigation() {
	echo '<ul id="menu-main-menu" class="menu">';
	$args = array('depth' => 0, 'title_li' => '', 'echo' => 0, 'post_type' => 'page', 'post_status' => 'publish');
	$pages = wp_list_pages($args);
	if ($pages)
		echo $pages;
	echo '</ul>';
}
### --- ****  dt_theme_default_navigation() *** --- ###

/** dt_theme_footer_navigation()
 * Objective:
 *		To setup footer navigation  when no menu is selected
 **/
function dt_theme_footer_navigation() {
	echo '<ul class="footer-links">';
	$args = array('depth' => 1, 'title_li' => '', 'echo' => 0, 'post_type' => 'page', 'post_status' => 'publish');
	$pages = wp_list_pages($args);
	if ($pages)
		echo $pages;
	echo '</ul>';
}
### --- ****  dt_theme_footer_navigation() *** --- ###

add_action('wp_enqueue_scripts', 'dt_theme_enqueue_scripts');
function dt_theme_enqueue_scripts() {
	
	$template_uri = get_template_directory_uri().'/framework';
	
	#IE Scripts...
	wp_register_script('jq-html5', 'http'.dt_theme_ssl().'://html5shim.googlecode.com/svn/trunk/html5.js', array(), '3.7.0', true);
	wp_register_script('jq-canvas', 'http'.dt_theme_ssl().'://explorercanvas.googlecode.com/svn/trunk/excanvas.js', array(), '2.0', true);	
	
	global $is_IE;
	if( $is_IE ):
		wp_enqueue_script('jq-html5');
		wp_enqueue_script('jq-canvas');
	endif;

	#Comment Reply Script...
	if (is_singular() AND comments_open()):
		 wp_enqueue_script( 'comment-reply' );
	endif;

	#Scipts Variable...
	$stickynav = ( dt_theme_option("general","enable-sticky-nav") ) ? "enable" : "disable";
	$loadingbar = ( dt_theme_option("general","loading-bar") ) ? "disable" : "enable";
	$linkedin = ( dt_theme_option("integration","page-linkedin") || dt_theme_option("integration","post-linkedin") ) ? "enable" : "disable";

	if(is_rtl()) $rtl = true; else $rtl = false;

	echo "\n <script type='text/javascript'>\n\t";
	echo "var mytheme_urls = {\n";
	echo "\t\t theme_base_url:'".esc_js(IAMD_BASE_URL)."'";
	echo "\n \t\t,framework_base_url:'".esc_js($template_uri)."/'";
	echo "\n \t\t,ajaxurl:'".admin_url('admin-ajax.php')."'";
	echo "\n \t\t,url:'".get_site_url()."'";
	echo "\n \t\t,stickynav:'".esc_js($stickynav)."'";
	echo "\n \t\t,isRTL:'".esc_js($rtl)."'";
	echo "\n \t\t,loadingbar:'".esc_js($loadingbar)."'";
	echo "\n \t\t,linkedin:'".esc_js($linkedin)."'";
	echo "\n\t};\n";
	echo " </script>\n";

	wp_enqueue_script('jq.retina', $template_uri.'/js/public/retina.js',array(),false,true);
	wp_enqueue_script('jq.nicescroll', $template_uri.'/js/public/jquery.nicescroll.min.js',array(),false,true);
	wp_enqueue_script('jq.easetotop', $template_uri.'/js/public/jquery.ui.totop.min.js', array(), false, true);
	wp_enqueue_script('jq.plugins', $template_uri.'/js/public/jquery.plugins.min.js', array(), false, true);

	wp_enqueue_script('jq.isotope', $template_uri.'/js/public/jquery.isotope.min.js',array(),false,true);
	wp_enqueue_script('jq.validate', $template_uri.'/js/public/jquery.validate.min.js',array(),false,true);	

	wp_enqueue_script('jq.pphoto', $template_uri.'/js/public/jquery.prettyPhoto.js',array(),false,true);
	wp_enqueue_script('jq.bxslider', $template_uri.'/js/public/jquery.bxslider.js',array(),false,true);
	
	wp_enqueue_script('jq.contact', $template_uri.'/js/public/contact.js', array(), false, true);
	wp_enqueue_script('jq.fancybox', $template_uri.'/js/public/jquery.fancybox.pack.js', array(), false, true);

	if(dt_theme_option('general', 'disable-style-picker') != "on") {
		wp_enqueue_script('jq.cookie', $template_uri.'/js/public/jquery.cookie.js',array(),false,true);
		wp_enqueue_script('jq.cpanel', $template_uri.'/js/public/controlpanel.js',array(),false,true);
	}

	wp_enqueue_script('jq-raphael', '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js', array(), '2.1.0', true);
	wp_enqueue_script('jq-morris', '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js', array(), '0.5.1', true);

	wp_enqueue_script('jq.flotmin', $template_uri.'/js/public/jquery.flot.min.js', array(), false, true);
	wp_enqueue_script('jq.flotpie', $template_uri.'/js/public/jquery.flot.pie.min.js', array(), false, true);

	wp_enqueue_script('jq.custom', $template_uri.'/js/public/custom.js', array(), false, true);
}

/** dt_theme_seo_meta()
 * Objective:
 *		To generate meta tags based on the backend options.
 **/
add_action('wp_head', 'dt_theme_seo_meta', 1);
function dt_theme_seo_meta() {
	$status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
	if (!$status) :
		global $post;
		$output = "";
		$meta_description = '';
		$meta_keywords = '';

		if (is_feed())
			return;

		if (is_404() || is_search())
			return;

		# meta robots Noindex ,NoFollow
		if (is_category() && (dt_theme_option('seo', 'use_noindex_in_cats_page'))) :
			$output .= '<meta name="robots" content="noindex,follow" />'."\r";
		elseif (is_archive() && (dt_theme_option('seo', 'use_noindex_in_archives_page'))) :
			$output .= '<meta name="robots" content="noindex,follow" />'."\r";
		elseif (is_tag() && !(dt_theme_option('seo', 'use_noindex_in_tags_archieve_page'))) :
			$output .= '<meta name="robots" content="noindex,follow" />'."\r";
		endif;
		#End

		### Meta Description ###
		if (is_page()) :
			$meta_description = get_post_meta($post->ID, '_seo_description', true);
			if (empty($meta_description) && dt_theme_option('seo', 'auto_generate_desc')) :
				$meta_description = substr(strip_shortcodes(strip_tags($post->post_content )), 0, 155);
			endif;
			#post
		elseif (is_singular() || is_single()) :
			$meta_description = get_post_meta($post->ID, '_seo_description', true);
			if (empty($meta_description) && dt_theme_option('seo', 'auto_generate_desc')) :
				$meta_description = trim(substr(strip_shortcodes(strip_tags($post->post_content )), 0, 155));
			endif;
			#is_category()
		elseif (is_category()) :
			#$categories = get_the_category();
			#$meta_description = $categories[0]->description;
			$meta_description = strip_tags(category_description());
			#is_tag()
		elseif (is_tag()) :
			$meta_description = strip_tags(tag_description());
			#is_author
		elseif (is_author()) :
			$author_id = get_query_var('author');
			if (!empty($author_id)) :
				$meta_description = get_the_author_meta('description', $author_id);
			endif;
		endif;

		if (!empty($meta_description)) {
			$meta_description = trim(substr($meta_description, 0, 155));
			$meta_description = htmlspecialchars($meta_description);
			$output .= "<meta name='description' content='{$meta_description}' />\r";

		}
		### Meta Description End###

		if (is_page()) :
			$meta_keywords = get_post_meta($post->ID, '_seo_keywords', true);
			#post
		elseif (is_singular() || is_single()) :
			$meta_keywords = get_post_meta($post->ID, '_seo_keywords', true);

			#Use Categories in Keyword
			if (dt_theme_option('seo', 'use_cats_in_meta_keword')) :
				$categories = get_the_category();
				$c = '';
				foreach ($categories as $category) :
					$c .= $category->name.',';
				endforeach;
				$c = substr(trim($c), "0", strlen(trim($c)) - 1);
				$meta_keywords = $meta_keywords.','.$c;
			endif;

			#Use Tags in Keyword
			if (dt_theme_option('seo', 'use_tags_in_meta_keword')) :
				$posttags = get_the_tags();
				$ptags = '';
				if ($posttags) :
					foreach ($posttags as $posttag) :
						$ptags .= $posttag->name.',';
					endforeach;
					$ptags = substr(trim($ptags), "0", strlen(trim($ptags)) - 1);
					$meta_keywords = $meta_keywords.','.$ptags;
				endif;
			endif;

			#Archive
		elseif (is_archive()) :

			global $posts;
			$keywords = array();

			foreach ($posts as $post) :
				# If attachment then use parent post id
				$id = (is_attachment() ? $post->post_parent : (!empty($post->ID ) ? $post->ID : ''));

				$keywords_from_posts = get_post_meta($id, '_seo_keywords', true);
				if (!empty($keywords_from_posts)) :
					$traverse = explode(',', $keywords_from_posts);
					foreach ($traverse as $keyword) :
						$keywords[] = $keyword;
					endforeach;
				endif;

				#Use Tags in Keyword
				if (dt_theme_option('seo', 'use_tags_in_meta_keword')) :
					$tags = get_the_tags($id);
					if ($tags && is_array($tags)) :
						foreach ($tags as $tag) :
							$keywords[] = $tag->name;
						endforeach;
					endif;
				endif;

				#Use categories in Keywords
				if (dt_theme_option('seo', 'use_cats_in_meta_keword')) :
					$categories = get_the_category($id);
					foreach ($categories as $category) :
						$keywords[] = $category->cat_name;
					endforeach;
				endif;

			endforeach;

			# Make keywords lowercase
			$keywords = array_unique($keywords);
			$small_keywords = array();
			$final_keywords = array();
			foreach ($keywords as $word) :
				$final_keywords[] = strtolower($word);
			endforeach;

			if (!empty($final_keywords)) :
				$meta_keywords = implode(",", $final_keywords);
			endif;

			#search || 404 page
		elseif (is_404() || is_search()) :
			$meta_keywords = '';
		endif;
		if (!empty($meta_keywords)) {
			$output .= "\t<meta name='keywords' content='{$meta_keywords}'/>\r";
		}

		### Meta Keyword End###

		#Generate canonical_url
		if (dt_theme_option('seo', 'use_canonical_urls')) :
			$url = dt_theme_canonical();
			if ($url) {
				$output .= "<link rel='canonical' href='{$url}'/>\r";
			}
		endif;
		echo $output;
	endif;
}
### --- ****  dt_theme_seo_meta() *** --- ###

add_action('wp_head', 'dt_theme_appearance_load_fonts', 7);
/** dt_theme_appearance_load_fonts()
 * Objective:
 *		To load google fonts based on appearance settings in admin panel.
 **/
function dt_theme_appearance_load_fonts() {
	$custom_fonts = array();
	$output = "";

	$subset = dt_theme_option('general', 'google-font-subset');
	if ($subset) {
		$subset = strtolower(str_replace(' ', '', $subset));
	}

	#Menu Section
	$disable_menu = dt_theme_option("appearance", "disable-menu-settings");
	if (empty($disable_menu)) :
		$font = dt_theme_option("appearance", "menu-font");
		if (!empty($font)) :
			$font = str_replace(" ", "+", $font);
			array_push($custom_fonts, $font);
		endif;
	endif; #Menu Secion End

	#Body Section
	$disable_boddy_settings = dt_theme_option("appearance", "disable-boddy-settings");

	if (empty($disable_boddy_settings)) :
		$font = dt_theme_option("appearance", "body-font");
		$font = str_replace(" ", "+", $font);
		if (!empty($font)) :
			array_push($custom_fonts, $font);
		endif;
	endif;

	#Footer Section
	$disable_footer = dt_theme_option("appearance", "disable-footer-settings");
	if (empty($disable_footer)) :
		$footer_title_font = dt_theme_option("appearance", "footer-title-font");
		$footer_title_font = !empty($footer_title_font) ? str_replace(" ", "+", $footer_title_font) : NULL;
		if (!empty($footer_title_font)) :
			array_push($custom_fonts, $footer_title_font);
		endif;

		$footer_content_font = dt_theme_option("appearance", "footer-content-font");
		$footer_content_font = !empty($footer_content_font) ? str_replace(" ", "+", $footer_content_font) : NULL;
		if (!empty($footer_content_font)) :
			array_push($custom_fonts, $footer_content_font);
		endif;

	endif; #Footer Section End

	#Typography Section
	$disable_typo = dt_theme_option("appearance", "disable-typography-settings");
	if (empty($disable_typo)) :
		for ($i = 1; $i <= 6; $i++) :
			$font = dt_theme_option("appearance", "H{$i}-font");
			if (!empty($font)) :
				$font = str_replace(" ", "+", $font);
				array_push($custom_fonts, $font);
			endif;
		endfor;
	endif; #Typography Section End

	#404 Section
	$disable_404_settings = dt_theme_option("specialty", "disable-404-font-settings");
	if (empty($disable_404_settings)) :
		$font = dt_theme_option("specialty", "message-font");
		if (!empty($font)) :
			$font = str_replace(" ", "+", $font);
			array_push($custom_fonts, $font);
		endif;
	endif;

	if (!empty($custom_fonts)) :
		$custom_fonts = array_unique($custom_fonts);
		$font = implode(":300,400,400italic,700|", $custom_fonts);
		$font .= ":300,400,400italic,700|";
	endif;
	
	$font .= "Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic%7CRoboto:400,300,700%7CRoboto+Condensed:400,700%7CCrete+Round";
	$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array('family' => $font, 'subset' => $subset);
	wp_enqueue_style('mytheme-google-fonts', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css" ), array(), null);
}
### --- ****  dt_theme_appearance_load_fonts() *** --- ###

add_action('wp_head', 'dt_theme_appearance_css', 9);
/** dt_theme_appearance_css()
 * Objective:
 *		To generate inline style based on appearance settings in admin panel.
 **/
function dt_theme_appearance_css() {
	$output = NULL;

	#Layout Section
	if (dt_theme_option("appearance", "layout") == "boxed") :

		if (dt_theme_option("appearance", "bg-type") == "bg-patterns") :
			$pattern = dt_theme_option("appearance", "boxed-layout-pattern");
			$pattern_repeat = dt_theme_option("appearance", "boxed-layout-pattern-repeat");
			$pattern_opacity = dt_theme_option("appearance", "boxed-layout-pattern-opacity");
			$disable_color = dt_theme_option("appearance", "disable-boxed-layout-pattern-color");
			$pattern_color = dt_theme_option("appearance", "boxed-layout-pattern-color");

			$output .= "body { ";

			if (!empty($pattern)) {
				$output .= "background-image:url('".IAMD_FW_URL."theme_options/images/patterns/{$pattern}');";
			}

			$output .= "background-repeat:$pattern_repeat;";
			if (empty($disable_color)) {
				if (!empty($pattern_opacity)) {
					$color = hex2rgb($pattern_color);
					$output .= "background-color:rgba($color[0],$color[1],$color[2],$pattern_opacity); ";
				} else {
					$output .= "background-color:$pattern_color;";
				}
			}
			$output .= "}\r\t";

		elseif (dt_theme_option("appearance", "bg-type") == "bg-custom") :
			$bg = dt_theme_option("appearance", "boxed-layout-bg");
			$bg_repeat = dt_theme_option("appearance", "boxed-layout-bg-repeat");
			$bg_opacity = dt_theme_option("appearance", "boxed-layout-bg-opacity");
			$bg_color = dt_theme_option("appearance", "boxed-layout-bg-color");
			$disable_color = dt_theme_option("appearance", "disable-boxed-layout-bg-color");
			$bg_position = dt_theme_option("appearance", "boxed-layout-bg-position");

			$output .= "body { ";

			if (!empty($bg)) {
				$output .= "background-image:url($bg);";
				$output .= "background-repeat:$bg_repeat;";
				$output .= "background-position:$bg_position;";
			}

			if (empty($disable_color)) {
				if (!empty($bg_opacity)) {
					$color = hex2rgb($bg_color);
					$output .= "background-color:rgba($color[0],$color[1],$color[2],$bg_opacity);";
				} else {
					$output .= "background-color:$bg_color;";
				}
			}
			$output .= "}\r\t";

		endif;
	endif; #Layout Section End

	#Menu Section
	$disable_menu = dt_theme_option("appearance", "disable-menu-settings");
	if (empty($disable_menu)) :

		$font_type = dt_theme_option("appearance", "menu-font-type");
		$style = dt_theme_option("appearance","menu-standard-font-style");
		
		if( !empty($font_type) ){
		#Menu Font: Standard
			$font = dt_theme_option("appearance","menu-standard-font");
		} else {
		#Menu Font: Google
			$font = dt_theme_option("appearance", "menu-font");
		}
		$size = dt_theme_option("appearance", "menu-font-size");
		$primary_color = dt_theme_option("appearance", "menu-primary-color");
		$secondary_color = dt_theme_option("appearance", "menu-secondary-color");

		if (!empty($font) || (!empty($primary_color) and $primary_color != "#") || !empty($size)) :

			$output .= "#main-menu > ul.menu > li > a { ";
			if (!empty($font)) {
				$output .= "font-family:{$font},sans-serif; ";
			}

			if (!empty($primary_color) && ($primary_color != '#')) {
				$output .= "color:{$primary_color}; background: none; ";
			}

			if (!empty($size) and ($size > 0)) {
				$output .= "font-size:{$size}px; ";
			}
			
			if( !empty( $style ) ){
				$output .= "font-style: {$style}";
			}

			$output .= "}\r\t";
		endif;

		if (!empty($secondary_color) and $secondary_color != "#") :
			$output .= "#main-menu > ul.menu > li:hover > a, #main-menu ul ul li.current_page_item a, #main-menu ul ul li.current_page_item ul li.current_page_item a, #main-menu ul ul li.current_page_item ul li a:hover, #main-menu ul li.current_page_item a { ";
			$output .= "color:{$secondary_color}; ";
			$output .= "}\r\t";
		endif;
		
	endif; #Menu Section End

	#Body Section
	$disable_boddy_settings = dt_theme_option("appearance", "disable-boddy-settings");
	if (empty($disable_boddy_settings)) :

		$font_type = dt_theme_option("appearance", "body-font-type");
		$style = dt_theme_option("appearance","body-standard-font-style");

		if( !empty($font_type) ){
		#Body Font: Standard
			$body_font = dt_theme_option("appearance","body-standard-font");
			
		} else {
		#Body Font: Google
			$body_font = dt_theme_option("appearance", "body-font");
		}

		$body_font_size = dt_theme_option("appearance", "body-font-size");
		$body_font_color = dt_theme_option("appearance", "body-font-color");

		$body_primary_color = dt_theme_option("appearance", "body-primary-color");
		$body_secondary_color = dt_theme_option("appearance", "body-secondary-color");

		if (!empty($body_font) || (!empty($body_font_color) and $body_font_color != "#") || !empty($body_font_size)) :
			$output .= "body {";
			if (!empty($body_font)) {
				$output .= "font-family:{$body_font} , sans-serif; ";
			}

			if (!empty($body_font_color) && ($body_font_color != '#')) {
				$output .= "color:{$body_font_color}; ";
			}

			if (!empty($body_font_size)) {
				$output .= "font-size:{$body_font_size}px; ";
			}
			
			if( !empty( $style ) ){
				$output .= "font-style: {$style}";
			}
			$output .= "}\r\t";
		endif;

		if ((!empty($body_primary_color) and $body_primary_color != "#") || (!empty($body_secondary_color) and $body_secondary_color != "#")) :

			if (!empty($body_primary_color) && ($body_primary_color != '#')) {
				$output .= "a { color:{$body_primary_color}; }";
			}

			if (!empty($body_secondary_color) && ($body_secondary_color != '#')) {
				$output .= "a:hover { color:{$body_secondary_color}; }";
			}
		endif;

	endif; #Body Section End

	#Footer Section
	$disable_footer = dt_theme_option("appearance", "disable-footer-settings");
	if (empty($disable_footer)) :
		#Footer Title
		$font_type = dt_theme_option("appearance", "footer-title-font-type");
		$style = dt_theme_option("appearance","footer-title-standard-font-style");
		
		if( !empty($font_type) ){
			#Footer Title Font : Standard Font
			$footer_title_font = dt_theme_option("appearance","footer-title-standard-font");
		} else {
			#Footer Title Font : Google Font	
			$footer_title_font = dt_theme_option("appearance", "footer-title-font");		
		}		
		$footer_title_font_color = dt_theme_option("appearance", "footer-title-font-color");
		$footer_title_font_size = dt_theme_option("appearance", "footer-font-size");
		$footer_primary_color = dt_theme_option("appearance", "footer-primary-color");
		$footer_secondary_color = dt_theme_option("appearance", "footer-secondary-color");
		$footer_bg_color = dt_theme_option("appearance", "footer-bg-color");
		$copyright_bg_color = dt_theme_option("appearance", "copyright-bg-color");

		if (!empty($footer_title_font) || (!empty($footer_title_font_color) and $footer_title_font_color != "#") || !empty($footer_title_font_size)) :
			$output .= "#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer h1 a, #footer h2 a, #footer h3 a, #footer h4 a, #footer h5 a, #footer h6 a {";
			if (!empty($footer_title_font)) {
				$output .= "font-family:{$footer_title_font}; ";
			}

			if (!empty($footer_title_font_color) && ($footer_title_font_color != '#')) {
				$output .= "color:{$footer_title_font_color}; ";
			}

			if (!empty($footer_title_font_size)) {
				$output .= "font-size:{$footer_title_font_size}px; ";
			}
			
			if( !empty( $style ) ){
				$output .= "font-style: {$style}";
			}
			$output .= "}\r\t";
		endif;

		if ((!empty($footer_primary_color) and $footer_primary_color != "#") || (!empty($footer_secondary_color) and $footer_secondary_color != "#")) :
			if (!empty($footer_primary_color) && ($footer_primary_color != '#')) {
				$output .= "#footer ul li a, #footer .widget_categories ul li a, #footer .widget.widget_recent_entries .entry-metadata .tags a, #footer .categories a, .copyright a { color:{$footer_primary_color}; }";
			}

			if (!empty($footer_secondary_color) && ($footer_secondary_color != '#')) {
				$output .= "#footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h4 a:hover, #footer h5 a:hover, #footer h6 a:hover, #footer ul li a:hover, #footer .widget.widget_recent_entries .entry-metadata .tags a:hover, #footer .categories a:hover, .copyright a:hover { color:{$footer_secondary_color}; }";
			}
		endif;

		#Footer Content
		$font_type = dt_theme_option("appearance","footer-content-font-type");
		$style = dt_theme_option("appearance","footer-content-standard-font-style");
		if( !empty($font_type) ){
			#Footer Content Font : Standard Font
			$footer_content_font = dt_theme_option("appearance","footer-content-standard-font");
		} else {
			#Footer Content Font : Google Font	
			$footer_content_font = dt_theme_option("appearance", "footer-content-font");		
		}
		$footer_content_font_color = dt_theme_option("appearance", "footer-content-font-color");
		$footer_content_font_size = dt_theme_option("appearance", "footer-content-font-size");

		if (!empty($footer_content_font) || (!empty($footer_content_font_color) and $footer_content_font_color != "#") || !empty($footer_content_font_size)) :

			$output .= "#footer .widget.widget_recent_entries .entry-metadata .author, #footer .widget.widget_recent_entries .entry-meta .date, #footer label, #footer .widget ul li, #footer .widget ul li:hover, .copyright, #footer .widget.widget_recent_entries .entry-metadata .tags, #footer .categories {";
			if (!empty($footer_content_font)) {
				$output .= "font-family:{$footer_content_font} !important; ";
			}

			if (!empty($footer_content_font_color) && ($footer_content_font_color != '#')) {
				$output .= "color:{$footer_content_font_color} !important; ";
			}

			if (!empty($footer_content_font_size)) {
				$output .= "font-size:{$footer_content_font_size}px !important; ";
			}
			
			if( !empty( $style ) ) {
				$output .= "font-style: {$style}";
			}
			$output .= "}\r\t";
		endif;

		if (!empty($footer_bg_color) and $footer_bg_color != "#") {
			$output .= "#footer .footer-widgets-wrapper { background-color: $footer_bg_color; }";
		}

		if (!empty($copyright_bg_color) and $copyright_bg_color != "#") {
			$output .= "#footer .copyright { background-color: $copyright_bg_color; }";
		}

	endif; #Footer Section End

	#Typography Settings
	$disable_typo = dt_theme_option("appearance", "disable-typography-settings");
	if (empty($disable_typo)) :
		for ($i = 1; $i <= 6; $i++) :
			$font_type = dt_theme_option("appearance", "H{$i}-font-type");
			$style = dt_theme_option("appearance","H{$i}-standard-font-style");
			
			if( !empty($font_type) ){
			#Menu Font: Standard
				$font = dt_theme_option("appearance","H{$i}-standard-font");
			} else {
			#Menu Font: Google
				$font = dt_theme_option("appearance", "H{$i}-font");
			}
			$color = dt_theme_option("appearance", "H{$i}-font-color");
			$size = dt_theme_option("appearance", "H{$i}-size");

			if (!empty($font) || (!empty($color) and $color != "#") || !empty($size)) :
				$output .= "H$i {";
				if (!empty($font)) {
					$output .= "font-family:{$font}; ";
				}
				if (!empty($color) && ($color != '#')) {
					$output .= "color:{$color}; ";
				}
				if (!empty($size)) {
					$output .= "font-size:{$size}px; ";
				}
				if( !empty( $style ) ){
					$output .= "font-style: {$style}";
				}
				$output .= "}\r\t";
			endif;

		endfor;
	endif; #Typography Settings end

	#Styling Settings
	$disable_styling = dt_theme_option("appearance", "disable-styling-settings");
	if (empty($disable_styling)) :
	
		$styling_top_bg_color = dt_theme_option('appearance','styling-topbar-bg-color');
		$styling_top_text_color = dt_theme_option('appearance','styling-topbar-text-color');
		$styling_header_bg_color = dt_theme_option('appearance','styling-header-bg-color');
		$styling_header_active_menubg_color = dt_theme_option('appearance','styling-header-active-menubg-color');
		$styling_bread_bg_color = dt_theme_option('appearance','styling-bread-bg-color');
		$styling_bread_text_color = dt_theme_option('appearance','styling-bread-text-color');
		
		$styling_body_bg_color = dt_theme_option('appearance','styling-body-bg-color');
		
		$styling_footer_bg_color = dt_theme_option('appearance','styling-footer-bg-color');
		$styling_footer_text_color = dt_theme_option('appearance','styling-footer-text-color');
		$styling_sub_footer_bg_color = dt_theme_option('appearance','styling-sub-footer-bg-color');
		$styling_sub_footer_text_color = dt_theme_option('appearance','styling-sub-footer-text-color');
		
		if(!empty($styling_top_bg_color) and $styling_top_bg_color != "#")
			$output .= ".top-bar { background-color: $styling_top_bg_color; }" ;
			
		if(!empty($styling_top_text_color) and $styling_top_text_color != "#")
			$output .= ".top-bar, .top-bar a { color: $styling_top_text_color; }" ;
			
		if(!empty($styling_header_bg_color) and $styling_header_bg_color != "#")
			$output .= "#header .main-menu-container .main-menu, .header3 #logo { background-color: $styling_header_bg_color !important; }" ;
			
		if(!empty($styling_header_active_menubg_color) and $styling_header_active_menubg_color != "#")
			$output .= "#main-menu #menu-main-menu > li.current_page_item > a, #main-menu #menu-main-menu > li.current-menu-ancestor > a, .megamenu-child-container > ul.sub-menu > li > a, .megamenu-child-container > ul.sub-menu > li > .nolink-menu, .mobile-menu { background-color: $styling_header_active_menubg_color !important; }" ;

		if(!empty($styling_bread_bg_color) and $styling_bread_bg_color != "#")
			$output .= ".breadcrumb-wrapper { background-color: $styling_bread_bg_color; }" ;
			
		if(!empty($styling_bread_text_color) and $styling_bread_text_color != "#")
			$output .= ".breadcrumb-wrapper, .breadcrumb-wrapper h1, .breadcrumb-wrapper .breadcrumb h4, .breadcrumb a { color: $styling_bread_text_color; }" ;
			
		if(!empty($styling_body_bg_color) and $styling_body_bg_color != "#")
			$output .= "body { background-color: $styling_body_bg_color; }" ;
			
		if(!empty($styling_footer_bg_color) and $styling_footer_bg_color != "#")
			$output .= "#footer .footer-widgets-wrapper { background-color: $styling_footer_bg_color; }" ;
			
		if(!empty($styling_footer_text_color) and $styling_footer_text_color != "#")
			$output .= "#footer, #footer a, #footer h3, #footer p, #footer span, #footer h4, #footer li:before { color: $styling_footer_text_color; }" ;

		if(!empty($styling_sub_footer_bg_color) and $styling_sub_footer_bg_color != "#")
			$output .= "#footer .copyright { background-color: $styling_sub_footer_bg_color; }" ;
			
		if(!empty($styling_sub_footer_text_color) and $styling_sub_footer_text_color != "#")
			$output .= "#footer .copyright, #footer .copyright a { color: $styling_sub_footer_text_color; }" ;
					
	endif;

	#404 Settings
	$disable_404_settings = dt_theme_option("specialty", "disable-404-font-settings");
	if (empty($disable_404_settings)) :
		$font = dt_theme_option("specialty", "message-font");
		$color = dt_theme_option("specialty", "message-font-color");
		$size = dt_theme_option("specialty", "message-font-size");

		if (!empty($font) || (!empty($color) and $color != "#") || !empty($size)) :
			$output .= "div.error-404 { ";
			if (!empty($font)) {
				$output .= "font-family:{$font}; ";
			}

			if (!empty($color) && ($color != '#')) {
				$output .= "color:{$color}; ";
			}

			if (!empty($size)) {
				$output .= "font-size:{$size}px; ";
			}
			$output .= "}\r\t";

			$output .= "div.error-404 h1, div.error-404 h2, div.error-404 h3,div.error-404 h4,div.error-404 h5,div.error-404 h6 { ";
			if (!empty($font)) {
				$output .= "font-family:{$font}; ";
			}

			if (!empty($color) && ($color != '#')) {
				$output .= "color:{$color}; ";
			}
			$output .= "}\r\t";

		endif;
	endif; #404 Settings end


	#custom CSS
	if (dt_theme_option('integration', 'enable-custom-css')) :
		$css = dt_theme_option('integration', 'custom-css');
		$output .= stripcslashes($css);
	endif; #custom CSS eND

	if (!empty($output)) :
		$output = "\r".'<style type="text/css">'."\r\t".$output."\r".'</style>'."\r";
		echo $output;
	endif;

}

/** dt_theme_slider_section()
 *  Objective:
 *	To produce the slider section for all pages.
 **/
function dt_theme_slider_section($post_id) {
	$tpl_default_settings = get_post_meta($post_id,'_tpl_default_settings',TRUE);
	$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();
	if(array_key_exists('show_slider',$tpl_default_settings) && array_key_exists('slider_type',$tpl_default_settings) ):
    	echo '<div id="slider">';
			if($tpl_default_settings['slider_type'] === "layerslider"):
				$id = $tpl_default_settings['layerslider_id'];
				echo do_shortcode("[layerslider id='{$id}']");
			elseif($tpl_default_settings['slider_type'] === "revolutionslider"):
				$id = $tpl_default_settings['revolutionslider_id'];
				echo do_shortcode("[rev_slider $id]");
			endif;
		echo '</div>';
	endif;
}

/** dt_theme_excerpt()
 * Objective:
 *		To produce the excerpt for the posts.
 **/
function dt_theme_excerpt($limit = NULL) {
	$limit = !empty($limit) ? $limit : 10;

	$excerpt = explode(' ', get_the_excerpt(), $limit);
	$excerpt = array_filter($excerpt);

	if (!empty($excerpt)) {
		if (count($excerpt) >= $limit) {
			array_pop($excerpt);
			$excerpt = implode(" ", $excerpt).'...';
		} else {
			$excerpt = implode(" ", $excerpt);
		}
		$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
		return "<p>{$excerpt}</p>";
	}
}
### --- ****  dt_theme_excerpt() *** --- ###

/** dt_theme_custom_comments()
 * Objective:
 *		To customize the post/page comments view.
 **/
function dt_theme_custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	   case 'pingback' :
  	   case 'trackback' :
			echo '<li class="post pingback">';
			echo "<p>";
			  _e( 'Pingback:','iamd_text_domain');
			  comment_author_link();
			  edit_comment_link( __('Edit','iamd_text_domain'), ' ' ,'');
			echo "</p>";
	   break;

	   default :
	   case '' :
			echo "<li ";
			echo ' id="comment-';
			  comment_ID();
			echo '">';

			echo '<article class="comment">';

				echo '<header class="comment-author">';
				  echo get_avatar( $comment, 85);
				echo '</header>';

				echo '<section class="comment-details">';

					echo '<div class="author-name">';
						echo ucfirst(get_comment_author_link());
					echo '</div>';
					echo '<div class="commentmetadata">';
						printf(__( '%1$s at %2$s', 'iamd_text_domain'), get_comment_date('d M Y'), get_comment_time());	
					echo '</div>';

					if($comment->comment_approved == '0'):
					  echo '<p>'.__( 'Your comment is awaiting moderation.','iamd_text_domain').'</p>';
					endif;

					echo '<div class="comment-body">';
						comment_text();
					echo '</div>';

					echo '<div class="reply">';
						echo comment_reply_link( array_merge( $args, array('reply_text'=>__('Reply','iamd_text_domain'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					echo '</div>';

					edit_comment_link( __('Edit','iamd_text_domain') );

				echo '</section>';

			echo '</article>';
	   break;
	endswitch;
}
### --- ****  dt_theme_custom_comments() *** --- ###

#BREADCRUMB
class dt_theme_breadcrumb {
	var $options;

	function dt_theme_breadcrumb() {
		
		$delimiter = "";
		if(dt_theme_option('general', 'breadcrumb-delimiter') == 'default')
			$delimiter = 'class="'.dt_theme_option('general', 'breadcrumb-delimiter').'"';
		else
			$delimiter = 'class="fa '.dt_theme_option('general', 'breadcrumb-delimiter').'"';
		$this->options = array('before' => "<span $delimiter > ", 'after' => ' </span>');
		$markup = $this->options['before'].$this->options['after'];

		global $post;

		echo '<div class="breadcrumb"><a href="'.home_url().'">'.__('Home', 'iamd_text_domain').'</a>';

		if (!is_front_page() && !is_home()) {
			echo $markup;
		}

		$output = $this->simple_breadcrumb_case($post);

		if (is_page() || ( is_single() && !is_singular('tribe_events'))) {
			echo "<h4>";
			the_title();
			echo "</h4>";
		} else
			if(in_array('events-single', get_body_class())) {
				echo '<h4>'.single_post_title().'</h4>';
			}
		  else	
			if ($output != NULL) {
				echo "<h4>".$output."</h4>";
			} else {
				$title = (get_option('page_for_posts') > 0) ? get_the_title(get_option('page_for_posts')) : NULL;
				echo $markup;
				echo "<h4>".$title."</h4>";
			}
		echo "</div>";
	}

	function simple_breadcrumb_case($der_post) {
		$markup = $this->options['before'].$this->options['after'];
		if (is_page()) {
			if ($der_post->post_parent) {
				$my_query = get_post($der_post->post_parent);
				$this->simple_breadcrumb_case($my_query);
				$link = '<a href="'.get_permalink($my_query->ID).'">';
				$link .= ''.get_the_title($my_query->ID).'</a>'.$markup;
				echo $link;
			}
			return;
		}

		if (is_single()) {
			$category = get_the_category();

			if (is_attachment()) {
				$my_query = get_post($der_post->post_parent);
				$category = get_the_category($my_query->ID);

				if(empty($category)) return;

				$ID = $category[0]->cat_ID;
				echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, $markup, FALSE) ) ? '' : $cat_parents;
				previous_post_link("%link $markup");
			} else {
				$postType = get_post_type();

				if ($postType == 'post') {
					$ID = $category[0]->cat_ID;
					echo get_category_parents($ID, TRUE, $markup, FALSE);

				} else
					if ($postType == 'dt_galleries') {
						global $post;
						$terms = get_the_term_list($post->ID, 'gallery_entries', '', '$$$', '');
						$terms = array_filter(explode('$$$', $terms));
						if (!empty($terms)) :
							echo $terms[0].$markup;
						endif;
					} else
					if ($postType == 'dt_workouts') {
						global $post;
						$terms = get_the_term_list($post->ID, 'workout_entries', '', '$$$', '');
						$terms = array_filter(explode('$$$', $terms));
						if (!empty($terms)) :
							echo $terms[0].$markup;
						endif;
					} else
					if ($postType == 'events') {
						global $post;
						$terms = get_the_term_list($post->ID, 'events_category', '', '$$$', '');
						$terms = array_filter(explode('$$$', $terms));
						if (!empty($terms)) :
							echo $terms[0].$markup;
						endif;
					} else
						if ($postType == 'product') {
							global $post;
							$terms = get_the_term_list($post->ID, 'product_cat', '', '$$$', '');
							$terms = array_filter(explode('$$$', $terms));
							if (!empty($terms)) :
								echo $terms[0].$markup;
							endif;
					} else
						if ($postType == 'forum') {
							global $post;
							echo '<a href="'.home_url().'/forums/">'.__('Forums', 'iamd_text_domain').'</a>'.$markup;
					} else
						if ($postType == 'topic') {
							global $post;
							echo '<a href="'.get_permalink($post->post_parent).'">'.__('Forum','iamd_text_domain').'</a>'.$markup;
					}
			}
			return;
		}

		if (is_tax()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			return $term->name;
		}

		if (is_category()) {
			$category = get_the_category();
			$i = $category[0]->cat_ID;
			$parent = $category[0]->category_parent;
			if ($parent > 0 && $category[0]->cat_name == single_cat_title("", false)) {
				echo get_category_parents($parent, TRUE, $markup, FALSE);
			}
			return __("Archive for Category: ", 'iamd_text_domain').single_cat_title('', FALSE);
		}

		if (is_author()) {
			$curauth = get_user_by('login', get_query_var('author_name'));
			return __("Archive for Author: ", 'iamd_text_domain').$curauth->nickname;
		}

		if (is_tag()) {
			return __("Archive for Tag: ", 'iamd_text_domain').single_tag_title('', FALSE);
		}

		if (is_404()) {
			return __("LOST", 'iamd_text_domain');
		}

		if (is_search()) {
			return __("Search", 'iamd_text_domain');
		}

		if (is_year()) {
			return get_the_time('Y');
		}
		
		if (is_month()) {
			$k_year = get_the_time('Y');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			return get_the_time('F');
		}

		if (is_day() || is_time()) {
			$k_year = get_the_time('Y');
			$k_month = get_the_time('m');
			$k_month_display = get_the_time('F');
			echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
			echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;
			return get_the_time('jS (l)');
		}

		if (is_post_type_archive('product')) {
			return __("Products", 'iamd_text_domain');
		}

		if (is_post_type_archive('forum')) {
			return __("Forums", 'iamd_text_domain');
		}
		
		if(in_array('events-archive', get_body_class())) {
			return __('Events', 'iamd_text_domain');
		}
		
		if (taxonomy_exists('topic-tag')) {
			return get_the_title();
		}
		
		if(in_array('buddypress', get_body_class()))  {
			return get_the_title();
		}
	}
}
#END OF BREADCRUMB
####################################

#MyTheme Color Picker
function dt_theme_color_picker(){

	$patterns_url = IAMD_FW_URL."theme_options/images/pattern/";
	$skins_url = IAMD_BASE_URL."images/style-picker/";
	
	$patterns = "";
	$patterns_array =  dt_theme_listImage(get_template_directory()."/images/style-picker/patterns/");
	
	foreach($patterns_array as $k => $v){
		$img = 	IAMD_BASE_URL."images/style-picker/patterns/".$k;
		$patterns .= '<li>';
		$patterns .= "<a id='{$v}' href='' title=''>";
		$patterns .= "<img src='$img' alt='$v' title='$v' width='30' height='30' />";
		$patterns .= '</a>';
		$patterns .= '</li>'; 
	}
	
	$colors = "";
	foreach(getFolders(get_template_directory()."/skins") as $skin ):
		$img = 	$skins_url.$skin.".jpg";
		$colors .= '<li>';
		$colors .= '<a id="'.$skin.'" href="" title="">';
		$colors .= '<img src="'.$img.'" alt="color-'.$skin.'" title="color-'.$skin.'"/>';
		$colors .= '</a>';
		$colors .= '</li>';
	endforeach;
	
	$str = '<!-- **Theme Style Picker Wrapper** -->';
	$str .= '<div class="dt-style-picker-wrapper">';
	$str .= '	<a href="" title="" class="style-picker-ico"> <img src="'.IAMD_BASE_URL.'images/style-picker/picker-icon.png" alt="" title="" /> </a>';
	$str .= '	<div id="dt-style-picker">';
	$str .= '   	<h2>'.__('Select Your Style','iamd_text_domain').'</h2>';
	
	$str .= '       <h3>'.__('Choose your layout','iamd_text_domain').'</h3>';
	$str .= '		<ul class="layout-picker">';
	$str .= '       	<li> <a id="fullwidth" href="" title="" class="selected"> <img src="'.IAMD_BASE_URL.'images/style-picker/fullwidth.jpg" alt="" title="" /> </a> </li>';
	$str .= '       	<li> <a id="boxed" href="" title=""> <img src="'.IAMD_BASE_URL.'images/style-picker/boxed.jpg" alt="" title="" /> </a> </li>';
	$str .= '		</ul>';
	$str .= '		<div class="hr"> </div>';
	$str .= '		<div id="pattern-holder" style="display:none;">';
	$str .='			<h3>'.__('Patterns for Boxed Layout','iamd_text_domain').'</h3>';
	$str .= '			<ul class="pattern-picker">';
	$str .= 				$patterns;
	$str .= '			</ul>';
	$str .= '			<div class="hr"> </div>';
	$str .= '		</div>';
	
	$str .= '		<h3>'.__('Color scheme','iamd_text_domain').'</h3>';
	$str .= '		<ul class="color-picker">';
	$str .= 		$colors;
	$str .= '		</ul>';	
	
	$str .= '	</div>';
	$str .= '</div><!-- **Theme Style Picker Wrapper - End** -->';
	
echo $str;
}

#Allowed html tags...
global $dt_allowed_html_tags;
$dt_allowed_html_tags = array(
	'a' => array('class' => array(), 'href' => array(), 'title' => array(), 'target' => array()),
	'abbr' => array('title' => array()),
	'address' => array(),
	'area' => array('shape' => array(), 'coords' => array(), 'href' => array(), 'alt' => array()),
	'article' => array(),
	'aside' => array(),
	'audio' => array('autoplay' => array(), 'controls' => array(), 'loop' => array(), 'muted' => array(), 'preload' => array(), 'src' => array()),
	'b' => array(),
	'base' => array('href' => array(), 'target' => array()),
	'bdi' => array(),
	'bdo' => array('dir' => array()), 
	'blockquote' => array('cite' => array()), 
	'br' => array(),
	'button' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'name' => array(), 'type' => array(), 'value' => array()),
	'canvas' => array('height' => array(), 'width' => array()),
	'caption' => array('align' => array()),
	'cite' => array(),
	'code' => array(),
	'col' => array(),
	'colgroup' => array(),
	'datalist' => array('id' => array()),
	'dd' => array(),
	'del' => array('cite' => array(), 'datetime' => array()),
	'details' => array('open' => array()),
	'dfn' => array(),
	'dialog' => array('open' => array()),
	'div' => array('class' => array(), 'id' => array(), 'align' => array()),
	'dl' => array(),
	'dt' => array(),
	'em' => array(),
	'embed' => array('height' => array(), 'src' => array(), 'type' => array(), 'width' => array()),
	'fieldset' => array('disabled' => array(), 'form' => array(), 'name' => array()),
	'figcaption' => array(),
	'figure' => array(),
	'form' => array('accept' => array(), 'accept-charset' => array(), 'action' => array(), 'autocomplete' => array(), 'enctype' => array(), 'method' => array(), 'name' => array(), 'novalidate' => array(), 'target' => array(), 'id' => array(), 'class' => array()),
	'h1' => array('class' => array()), 'h2' => array('class' => array()), 'h3' => array('class' => array()), 'h4' => array('class' => array()), 'h5' => array('class' => array()), 'h6' => array('class' => array()),
	'hr' => array(), 
	'i' => array('class' => array()), 
	'iframe' => array('name' => array(), 'seamless' => array(), 'src' => array(), 'srcdoc' => array(), 'width' => array()),
	'img' => array('alt' => array(), 'crossorigin' => array(), 'height' => array(), 'ismap' => array(), 'src' => array(), 'usemap' => array(), 'width' => array()),
	'input' => array('align' => array(), 'alt' => array(), 'autocomplete' => array(), 'autofocus' => array(), 'checked' => array(), 'disabled' => array(), 'form' => array(), 'formaction' => array(), 'formenctype' => array(), 'formmethod' => array(), 'formnovalidate' => array(), 'formtarget' => array(), 'height' => array(), 'list' => array(), 'max' => array(), 'maxlength' => array(), 'min' => array(), 'multiple' => array(), 'name' => array(), 'pattern' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'size' => array(), 'src' => array(), 'step' => array(), 'type' => array(), 'value' => array(), 'width' => array(), 'id' => array(), 'class' => array()),
	'ins' => array('cite' => array(), 'datetime' => array()),
	'label' => array('for' => array(), 'form' => array()),
	'legend' => array('align' => array()), 
	'li' => array('type' => array(), 'value' => array(), 'class' => array()),
	'link' => array('crossorigin' => array(), 'href' => array(), 'hreflang' => array(), 'media' => array(), 'rel' => array(), 'sizes' => array(), 'type' => array()),
	'main' => array(), 
	'map' => array('name' => array()), 
	'mark' => array(), 
	'menu' => array('label' => array(), 'type' => array()),
	'menuitem' => array('checked' => array(), 'command' => array(), 'default' => array(), 'disabled' => array(), 'icon' => array(), 'label' => array(), 'radiogroup' => array(), 'type' => array()),
	'meta' => array('charset' => array(), 'content' => array(), 'http-equiv' => array(), 'name' => array()),
	'object' => array('form' => array(), 'height' => array(), 'name' => array(), 'type' => array(), 'usemap' => array(), 'width' => array()),
	'ol' => array('class' => array(), 'reversed' => array(), 'start' => array(), 'type' => array()),
	'p' => array('class' => array()), 
	'q' => array('cite' => array()), 
	'section' => array(), 
	'select' => array('autofocus' => array(), 'disabled' => array(), 'form' => array(), 'multiple' => array(), 'name' => array(), 'required' => array(), 'size' => array()),
	'small' => array(), 
	'source' => array('media' => array(), 'src' => array(), 'type' => array()),
	'span' => array('class' => array()), 
	'strong' => array(),
	'style' => array('media' => array(), 'scoped' => array(), 'type' => array()),
	'sub' => array(),
	'sup' => array(),
	'table' => array('sortable' => array()), 
	'tbody' => array(), 
	'td' => array('colspan' => array(), 'headers' => array()),
	'textarea' => array('autofocus' => array(), 'cols' => array(), 'disabled' => array(), 'form' => array(), 'maxlength' => array(), 'name' => array(), 'placeholder' => array(), 'readonly' => array(), 'required' => array(), 'rows' => array(), 'wrap' => array()),
	'tfoot' => array(),
	'th' => array('abbr' => array(), 'colspan' => array(), 'headers' => array(), 'rowspan' => array(), 'scope' => array(), 'sorted' => array()),
	'thead' => array(), 
	'time' => array('datetime' => array()), 
	'title' => array(), 
	'tr' => array(), 
	'track' => array('default' => array(), 'kind' => array(), 'label' => array(), 'src' => array(), 'srclang' => array()), 
	'u' => array(), 
	'ul' => array('class' => array()), 
	'var' => array(), 
	'video' => array('autoplay' => array(), 'controls' => array(), 'height' => array(), 'loop' => array(), 'muted' => array(), 'muted' => array(), 'poster' => array(), 'preload' => array(), 'src' => array(), 'width' => array()), 
	'wbr' => array(), 
);
?>