<?php

/*
 * The function within this file are theme specific:
 * they are used only by this theme and not by the Avia Framework in general
 */



/*wordpress 3.4 changed 404 check -  this is the mod for the avia framework to operate*/
function avia_disable_404( $query = false ) {

	global $avia_config, $wp_query;

	if(!isset($avia_config['first_query_run']) && is_front_page() && is_paged())
	{
		$wp_query->is_paged = false;
		$avia_config['first_query_run'] = true;
		add_action( 'wp', 'avia_enable_404' );
	}
}

function avia_enable_404() {

	global $wp_query;
	$wp_query->is_paged = true;

}

add_action( 'pre_get_posts', 'avia_disable_404' ,1 ,10000);





//check if the portfolio item was requested by an ajax call and returns that
if(!function_exists('avia_check_ajax_request')){

	add_action('wp_ajax_avia_check_portfolio', 'avia_check_ajax_request');
	add_action('wp_ajax_nopriv_avia_check_portfolio', 'avia_check_ajax_request');

	function avia_check_ajax_request()
	{
		if(!isset($_POST['avia_ajax_request'])) return false;

		global $avia_config, $more;
		$avia_config['avia_is_overview'] = false;
		$avia_config['is_ajax_request'] = true;

		$id 	= $_POST['avia_ajax_request'];

		global $post;
		$post = get_post( $id );
		setup_postdata($post);

		$more   = 0;
		$slider = new avia_slideshow($id);
		$slider -> setImageSize('fullsize');
		$slider_html = $slider->display();

		echo "<div class='ajax_slide ajax_slide_".$id."' data-slide-id='".$id."' >";

			echo "<div class='inner_slide'>";

				echo "<div class='flex_column two_third first'>";
				echo $slider_html;
				echo "</div>";

				echo "<div class='portfolio-entry one_third'>";
				echo avia_title(array('class'=>'portfolio-title', 'html' => "<div class='{class} title_container'><h1 class='main-title'>{title}</h1></div>"), $id);

				echo "<div class='entry-content'>";
				$meta = avia_portfolio_meta($id);
				if($meta)
				{

					echo $meta;
					echo avia_advanced_hr(false, 'hr_small');
				}

				the_content(__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>');
				echo "</div>";


				echo "</div>";

			echo "</div>";

		echo "</div>";
		unset($avia_config['is_ajax_request']);
		die();
	}
}



//function to retrieve the filtered copy of a wordpress generated thumbnail. For example a greyscale image
if(!function_exists('avia_get_filtered_image_copy'))
{
	function avia_get_filtered_image_copy($image, $filter)
	{
		//$filetype = substr(strrchr($image,'.'),1,3);
		//$image = str_replace(".".$filetype, "-".$filter.".".$filetype, $image);
		
		preg_match( '@src="([^"]+)"@' , $image, $match);

		if(!empty($match[0]))
		{
			$filetype = substr(strrchr($match[0],'.'),1,3);

			if(($pos = strrpos($match[0], ".".$filetype)) !== false) 
			{
				$greyscale_img = substr_replace($match[0], "-".$filter.".".$filetype, $pos, strlen(".".$filetype));
				$image = str_replace($match[0], $greyscale_img, $image);
			}
		}

		if(strpos($image, ' class=') === false)
		{
			$image = str_replace("/>", "class='$filter-image filtered-image' />", $image);
		}
		else
		{
			$image = str_replace("class='", "class='$filter-image filtered-image ", $image);
			$image = str_replace('class="', 'class="'.$filter.'-image filtered-image ', $image);
		}

		return $image;
	}
}


//function to retrieve the additional portfolio options
if(!function_exists('avia_portfolio_meta'))
{
	function avia_portfolio_meta($id = false, $portfolio_keys = false)
	{
		if(!$id) $id = get_the_ID();
		if(!$id) return false;
		if(post_password_required($id)) return;

		$output = "";
		$metas = avia_post_meta($id);


		if(!$portfolio_keys) $portfolio_keys = avia_get_option('portfolio-meta', array(array('meta'=>'Skills Needed'), array('meta'=>'Client'), array('meta'=>'Project URL')));
		if(empty($metas)) return;

		$p_metas = array();
		foreach($metas as $key =>$meta)
		{
			if(strpos($key,'portfolio-meta-') !== false)
			{
				$newkey = str_replace("portfolio-meta-","",$key);
				$p_metas[$newkey-1] = $meta;
			}
		}

		$counter = 0;
		foreach($portfolio_keys as $key)
		{
			if(!empty($p_metas[$counter]))
			{
				//convert urls
				if(avia_portfolio_url($p_metas[$counter]))
				{
					$linktext = $p_metas[$counter];
					if(strlen($linktext) > 50) $linktext = __('Link','avia_framework');
					$p_metas[$counter] = "<a href='".$p_metas[$counter]."'>".$linktext."</a>";
				}

				$output .= "<li><strong class='portfolio-meta-key'>".$key['meta'].":</strong> <div class='portfolio-meta-value'>".$p_metas[$counter]."</div></li>";
			}
			$counter++;
		}

		if($output) $output = "<ul class='portfolio-meta-list'>".$output."</ul>";
		return $output;
	}
}

if(!function_exists('avia_portfolio_url'))
{
	function avia_portfolio_url($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
}



//backend filter that allows iframe use in addition to videos
if(!function_exists('avia_filter_video_insert_label_mod'))
{
	add_filter('avia_filter_video_insert_label', 'avia_filter_video_insert_label_mod');
	function avia_filter_video_insert_label_mod($label)
	{
		$label .= '<p class="help"><br/>Working examples of Iframe content:<br/>
					You can either paste only the URL of the content you want to embed o the whole iframe with "&lt;iframe src="url/to/iframe.html" &gt;&lt;/iframe&gt;" tags.
									</p>';
		return $label;
	}
}




//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');




//allow mp4, webm and ogv file uploads
if(!function_exists('avia_upload_mimes'))
{
	add_filter('upload_mimes','avia_upload_mimes');
	function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }
}




//change default thumbnail size on theme activation
if(!function_exists('avia_set_thumb_size'))
{
	add_action('avia_backend_theme_activation', 'avia_set_thumb_size');
	function avia_set_thumb_size() {update_option( 'thumbnail_size_h', 80 ); update_option( 'thumbnail_size_w', 80 );}
}




//remove post thumbnails from pages, posts and various custom post types
if(!function_exists('avia_remove_post_thumbnails'))
{
	add_theme_support( 'post-thumbnails' );

	add_action('posts_selection', 'avia_remove_post_thumbnails');
	add_action('init', 'avia_remove_post_thumbnails');
	add_filter('post_updated_messages','avia_remove_post_thumbnails');
	function avia_remove_post_thumbnails($msg)
	{
		global $post_type;
		$remove_when = apply_filters('avia_remove_post_thumbnails', array('post','page','portfolio'));

		if(is_admin())
		{
			foreach($remove_when as $remove)
			{
				if($post_type == $remove || (isset($_GET['post_type']) && $_GET['post_type'] == $remove)) { remove_theme_support( 'post-thumbnails' ); };
			}
		}

		return $msg;
	}
}




//advanced horizontal ruler, used in tempalte files and also in shortcodes
if(!function_exists('avia_advanced_hr'))
{
	function avia_advanced_hr($content = "", $classname = "")
	{
		$output = "";

		if($content) $content = "<div class='hr_content'>$content</div>";

		$output .= "<div class='hr $classname'>$content <span class='hr_inner'></span></div>";

		return $output;
	}
}




//advanced title + breadcrumb function
if(!function_exists('avia_title'))
{
	function avia_title($args = false, $id = false)
	{
		global $avia_config;

		if(!$id) $id = avia_get_the_id();

		$defaults 	 = array(

			'title' 		=> get_the_title($id),
			'subtitle' 		=> "", //avia_post_meta($id, 'subtitle'),
			'link'			=> get_permalink($id),
			'html'			=> "<div class='{class} title_container'><div class='container'><h1 class='main-title'>{title}</h1></div>{additions}</div>",
			'class'			=> 'stretch_full container_wrap slideshow_color '.avia_is_dark_bg('slideshow_color', true),
			'breadcrumb'	=> true,
			'additions'		=> ""

		);

		if ( is_tax() || is_category() || is_tag() ) 
		{
			global $wp_query;
		
			$term = $wp_query->get_queried_object();
			$defaults['link'] = get_term_link( $term );
		}
		else if(is_archive())
		{
			$defaults['link'] = "";
		}
		
		
		
		// Parse incomming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters('avf_title_args', $args, $id);

		// OPTIONAL: Declare each item in $args as its own variable i.e. $type, $before.
		extract( $args, EXTR_SKIP );

		if(empty($title)) $class .= " empty_title ";
		if(!empty($link)) $title = "<a href='".$link."' rel='bookmark' title='".__('Permanent Link:','avia_framework')." ".esc_attr( $title )."'>".$title."</a>";
		if(!empty($subtitle)) $additions .= "<div class='title_meta meta-color'>".wpautop($subtitle)."</div>";
		if($breadcrumb) $additions .= "<div class='bc-container-wrap'><div class='container bc-container'>".avia_breadcrumbs()."</div></div>";


		$html = str_replace('{class}', $class, $html);
		$html = str_replace('{title}', $title, $html);
		$html = str_replace('{additions}', $additions, $html);



		if(!empty($avia_config['slide_output']) && !avia_is_dynamic_template($id) && !avia_is_overview())
		{
			$avia_config['small_title'] = $title;
		}
		else
		{
			return $html;
		}
	}
}

function avia_small_title()
{
	global $avia_config;

	$small_title = "";

	if(isset($avia_config['small_title']))
	{
		$small_title = "<h1 class='post-title'>".$avia_config['small_title']."</h1>";
	}

	return $small_title;
}




if(!function_exists('avia_post_nav'))
{
	function avia_post_nav()
	{
		$output = "";
		ob_start();
		?>
		<div class='post_nav_container stretch_full'>
			<div class='post_nav'>
				<div class='previous_post_link_align'>
				<?php previous_post_link('<span class="previous_post_link">&larr; %link </span><span class="post_link_text">'.__('(previous entry)','avia_framework'))."</span>"; ?>
				</div>
				<div class='next_post_link_align'>
				<?php next_post_link('<span class="next_post_link"><span class="post_link_text">'.__('(next entry)','avia_framework').'</span> %link &rarr;</span>'); ?>
				</div>
			</div> <!-- end navigation -->
		</div>
		<?php

		$output = ob_get_clean();
		return $output;
	}
}



if(!function_exists('avia_legacy_websave_fonts'))
{
	add_filter('avia_style_filter', 'avia_legacy_websave_fonts');

	function avia_legacy_websave_fonts($styles)
	{
		global $avia_config;

		$os_info 	= avia_get_browser(false);
		$activate	= false;

		if('windows' == $os_info['platform'] && avia_get_option('websave_windows') == 'active')
		{
			if($os_info['shortname'] == 'MSIE' && $os_info['mainversion'] < 9) $activate = true;
			if($os_info['shortname'] == 'Firefox' && $os_info['mainversion'] < 8) $activate = true;
			if($os_info['shortname'] == 'Opera' && $os_info['mainversion'] < 11) $activate = true;

			if($activate == true)
			{
				foreach ($styles as $key => $style)
				{
					if($style['key'] == 'google_webfont')
					{
						if (strpos($style['value'], '-websave') !== false)
						{
							$websave = explode(',',$style['value']);
							$websave = strtolower(" ".$websave[0]);
							$websave = str_replace('"','',$websave);
							$websave = str_replace("'",'',$websave);
							$websave = str_replace("-websave",'',$websave);

							$avia_config['font_stack'] .= $websave.'-websave';
						}

					unset($styles[$key]);
					}
				}

			if(empty($avia_config['font_stack'])) $avia_config['font_stack'] = 'arial-websave';
			}
		}

		return $styles;
	}
}






//wrap ampersands into special calss to apply special styling

if(!function_exists('avia_ampersand'))
{
	add_filter('avia_ampersand','avia_ampersand');

	function avia_ampersand($content)
	{
		$content = str_replace(" &amp; "," <span class='special_amp'>&amp;</span> ",$content);
		$content = str_replace(" &#038; "," <span class='special_amp'>&amp;</span> ",$content);

		return $content;
	}
}





// slightly modify the widget title
if(!function_exists('avia_widget_title'))
{
	function avia_widget_title($title) {

	 if(strpos($title, "<") === false)
	 {
		 $exploded = explode(" ", $title);
		 $exploded[0] = "<span class='widget_first'>".$exploded[0]."</span>";
		 $title = implode(" ", $exploded);
	 }
	 return $title;
	}

	add_filter('widget_title', 'avia_widget_title');
	add_filter('link_category', 'avia_widget_title');

}





// checks if a background color of a specific region is dark  or light and returns a class name
if(!function_exists('avia_is_dark_bg'))
{
	function avia_is_dark_bg($region, $return_only = false)
	{
		global $avia_config;

		$return = "";
		$color = $avia_config['backend_colors']['color_set'][$region]['bg'];

		$is_dark = avia_backend_calc_preceived_brightness($color, 70);

		$return = $is_dark ? "dark_bg_color" : "light_bg_color";
		if($return_only)
		{
			return $return;
		}
		else
		{
			echo $return;
		}
	}
}








//set post excerpt to be visible on theme acivation in user backend
if(!function_exists('avia_show_menu_description'))
{

	//add_action('avia_backend_theme_activation', 'avia_show_menu_description');
	function avia_show_menu_description()
	{
		global $current_user;
	    get_currentuserinfo();
		$old_meta_data = $meta_data = get_user_meta($current_user->ID, 'metaboxhidden_page', true);

		if(is_array($meta_data) && isset($meta_data[0]))
		{
			$key = array_search('postexcerpt', $meta_data);

			if($key !== false)
			{
				unset($meta_data[$key]);
				update_user_meta( $current_user->ID, 'metaboxhidden_page', $meta_data, $old_meta_data );
			}
		}
		else
		{
				update_user_meta( $current_user->ID, 'metaboxhidden_page', array('postcustom', 'commentstatusdiv', 'commentsdiv', 'slugdiv', 'authordiv', 'revisionsdiv') );
		}
	}
}






//import the dynamic frontpage template on theme installation
if(!function_exists('avia_default_dynamics'))
{
	add_action('avia_backend_theme_activation', 'avia_default_dynamics');
	add_action('avia_ajax_reset_options_page',  'avia_default_dynamics');

	function avia_default_dynamics()
	{
		global $avia;
		$firstInstall = get_option($avia->option_prefix.'_dynamic_elements');

		if(empty($firstInstall))
		{
			$custom_export = "dynamic_elements";
			require_once AVIA_PHP . 'inc-avia-importer.php';

			if(isset($_GET['page']) && $_GET['page'] == 'templates')
			{
				wp_redirect( $_SERVER['REQUEST_URI'] );
				exit();
			}
		}
	}
}



/*
* make google analytics code work, even if the user only enters the UA id. if the new async tracking code is entered add it to the header, else to the footer
*/

if(!function_exists('avia_get_tracking_code'))
{
	add_action('init', 'avia_get_tracking_code');

	function avia_get_tracking_code()
	{
		global $avia_config;

		$avia_config['analytics_code'] = avia_option('analytics', false, false, true);
		if(empty($avia_config['analytics_code'])) return;

		if(strpos($avia_config['analytics_code'],'UA-') === 0) // if we only get passed the UA-id create the script for the user (async tracking code)
		{

			$avia_config['analytics_code'] = "

<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '".$avia_config['analytics_code']."']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

";
		}

		if(strpos($avia_config['analytics_code'],'_gaq.push') !== false) // check for async code (put at top)
		{
			add_action('wp_head', 'avia_print_tracking_code');
		}
		else // else print code in footer
		{
			add_action('wp_footer', 'avia_print_tracking_code');
		}
	}

	function avia_print_tracking_code()
	{
		global $avia_config;

		if(!empty($avia_config['analytics_code']))
		{
			echo $avia_config['analytics_code'];
		}
	}

}


// filter function that allows to create greyscaled, blured or sketched thumbnails of images when a user uplaods a new image.
// If a filtered image should be created set the "copy" value in the image array at the top of functions.php
if(!function_exists('avia_image_upload_filter'))
{
	add_filter('wp_generate_attachment_metadata','avia_image_upload_filter', 10, 2);

	function avia_image_upload_filter($meta, $attachment_id)
	{
		if(! wp_attachment_is_image( $attachment_id ) ) return false;

		global $avia_config;
		$quality = 90; //value between 0 and 100 for image quality
		$blur = 6; // the higher the number the stronger the blur (if blur filter is requested)
		$file = false;
		$time = false;
		$default_size_filtered = false;
		$exploded = explode('/', $meta['file']);
		$default_filename = end($exploded);

		if(function_exists('imagefilter') && function_exists('getimagesize'))
		{

			//backup in case we need a greyscale version of an image but the image is to small
			//in that case generate default size greyscale image
			foreach($avia_config['imgSize'] as $name => $imgSize)
			{
				if(isset($imgSize['copy']) && !isset($meta['sizes'][$name]))
				{
					$default_size_filtered = $name;
				}
			}

			foreach($avia_config['imgSize'] as $name => $imgSize)
			{
				if(isset($imgSize['copy']) && (isset($meta['sizes'][$name])  || $default_size_filtered == $name ))
				{
					if($default_size_filtered == $name)
					{
						$filename = $default_filename;
					}
					else
					{
						$filename = $meta['sizes'][$name]['file'];
					}


					if($file === false)
					{
						$this_attachment 	= get_post($attachment_id);
						$parent 			= $this_attachment->post_parent;
						if($parent) $time 	= get_post($parent)->post_date;
						$file 				= wp_upload_dir($time);
					}

					$filepath = trailingslashit($file['path']).$filename;
					list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
					$image = @wp_load_image($filepath);

					if(!is_resource($image))
					{
						$file 		= wp_upload_dir($this_attachment->post_date);
						$filepath 	= trailingslashit($file['path']).$filename;
						list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
						$image 		= @wp_load_image($filepath);
					}


					$image_blur = $blur;

					if(is_resource($image))
					{
						if(strpos($imgSize['copy'], 'greyscale') !== false)	{ imagefilter($image, IMG_FILTER_GRAYSCALE); }
						if(strpos($imgSize['copy'], 'blur') !== false) 		{ while($image_blur--){imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR); } imagefilter($image, IMG_FILTER_SMOOTH, $blur);  }
						if(strpos($imgSize['copy'], 'sketch') !== false) 	{ imagefilter($image, IMG_FILTER_MEAN_REMOVAL); }



						switch ($orig_type) {
							case IMAGETYPE_GIF:
								$filepath = str_replace(".gif", "-".$imgSize['copy'].".gif", $filepath);
								imagegif( $image, $filepath);
								break;
							case IMAGETYPE_PNG:
								$filepath = str_replace(".png", "-".$imgSize['copy'].".png", $filepath);
								imagepng( $image, $filepath, (100 - $quality) / 10);
								break;
							case IMAGETYPE_JPEG:
								$filepath = str_replace(".jpg", "-".$imgSize['copy'].".jpg", $filepath);
								$filepath = str_replace(".jpeg", "-".$imgSize['copy'].".jpeg", $filepath);
								imagejpeg( $image, $filepath, $quality);
								break;
						}
					}

				}
			}
		}
		else
		{
			// Could not create greyscale image, your server needs to support an Image manupulation library like GD.
			// Please contact your provider and tell them to install the module
		}
		return $meta;
	}
}




//delete greyscale version of the image if attachment is deleted
if(!function_exists('avia_delete_greyscale_image'))
{
	add_action('delete_attachment','avia_delete_greyscale_image', 10, 1);
	function avia_delete_greyscale_image($attachment_id)
	{
		global $avia_config;
		$default_size_filtered = false;
		$meta = wp_get_attachment_metadata($attachment_id);
		$default_filename = end(explode('/', $meta['file']));

		foreach($avia_config['imgSize'] as $name => $imgSize)
		{
			if(isset($imgSize['copy']) && (isset($meta['sizes'][$name])  || $default_size_filtered == $name ))
			{
				if($default_size_filtered == $name)
				{
					$filename = $default_filename;
				}
				else
				{
					$filename = $meta['sizes'][$name]['file'];
				}

				if($file === false)
				{
					$this_attachment 	= get_post($attachment_id);
					$parent 			= $this_attachment->post_parent;
					if($parent) $time 	= get_post($parent)->post_date;
					$file 				= wp_upload_dir($time);
				}

				$filepath = trailingslashit($file['path']).$filename;
				list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
				$image = @wp_load_image($filepath);

				if(!is_resource($image))
				{
					$file 		= wp_upload_dir($this_attachment->post_date);
					$filepath 	= trailingslashit($file['path']).$filename;
					list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
					$image 		= @wp_load_image($filepath);
				}

				if(is_resource($image))
				{
					if(strpos($imgSize['copy'], 'greyscale') !== false){ $filepath = str_replace(".gif", "-".$imgSize['copy'].".gif", $filepath); }
					if(strpos($imgSize['copy'], 'blur') !== false) 		{ while($image_blur--){imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR); } imagefilter($image, IMG_FILTER_SMOOTH, $blur);  }
					if(strpos($imgSize['copy'], 'sketch') !== false) 	{ imagefilter($image, IMG_FILTER_MEAN_REMOVAL); }

					switch ($orig_type) {
						case IMAGETYPE_GIF:
							$filepath = str_replace(".gif", "-".$imgSize['copy'].".gif", $filepath);
							@unlink($filepath);
							break;
						case IMAGETYPE_PNG:
							$filepath = str_replace(".png", "-".$imgSize['copy'].".png", $filepath);
							@unlink($filepath);
							break;
						case IMAGETYPE_JPEG:
							$filepath = str_replace(".jpg", "-".$imgSize['copy'].".jpg", $filepath);
							$filepath = str_replace(".jpeg", "-".$imgSize['copy'].".jpeg", $filepath);
							@unlink($filepath);
							break;
					}
				}

			}
		}
	}
}



/*
function that saves the style options array into an external css file rather than fetching the data from the database
*/

if(!function_exists('avia_generate_stylesheet'))
{
	add_action('avia_ajax_after_save_options_page', 'avia_generate_stylesheet', 30, 1);
	function avia_generate_stylesheet($options)
	{
		global $avia;
        $safe_name = avia_backend_safe_string($avia->base_data['prefix']);

	    if( defined('AVIA_CSSFILE') && AVIA_CSSFILE === FALSE )
	    {
	        $dir_flag           = update_option( 'avia_stylesheet_dir_writable'.$safe_name, 'false' );
	        $stylesheet_flag    = update_option( 'avia_stylesheet_exists'.$safe_name, 'false' );
	        return;
	    }

	    $wp_upload_dir  = wp_upload_dir();
	    $stylesheet_dir = $wp_upload_dir['basedir'].'/dynamic_avia';
	    $stylesheet_dir = str_replace('\\', '/', $stylesheet_dir);
	    $stylesheet_dir = apply_filters('avia_dyn_stylesheet_dir_path',  $stylesheet_dir);
	    $isdir = avia_backend_create_folder($stylesheet_dir);

	    /*
	    * directory could not be created (WP upload folder not write able)
	    * @todo save error in db and output error message for user.
	    * @todo maybe add mkdirfix: http://php.net/manual/de/function.mkdir.php
	    */

	    if($isdir === false)
	    {
	        $dir_flag = update_option( 'avia_stylesheet_dir_writable'.$safe_name, 'false' );
	        $stylesheet_flag = update_option( 'avia_stylesheet_exists'.$safe_name, 'false' );
	        return;
	    }

	    /*
	     *  Go ahead - WP managed to create the folder as expected
	     */
	    $stylesheet = trailingslashit( $stylesheet_dir ) . $safe_name.'.css';
	    $stylesheet = apply_filters('avia_dyn_stylesheet_file_path', $stylesheet);


	    //import avia_superobject and reset the options array
	    $avia_superobject = $GLOBALS['avia'];
		$avia_superobject->reset_options();

		//regenerate style array after saving options page so we can create a new css file that has the actual values and not the ones that were active when the script was called
		avia_prepare_dynamic_styles();

	    //generate stylesheet content
	    $generate_style = new avia_style_generator($avia_superobject,false,false,false);
	    $styles         = $generate_style->create_styles();

	    $created        = avia_backend_create_file($stylesheet, $styles, true);

	    if($created === true)
	    {
	        $dir_flag = update_option( 'avia_stylesheet_dir_writable'.$safe_name, 'true' );
	        $stylesheet_flag = update_option( 'avia_stylesheet_exists'.$safe_name, 'true' );
			$dynamic_id = update_option( 'avia_stylesheet_dynamic_version'.$safe_name, uniqid() );
	    }
	}
}


