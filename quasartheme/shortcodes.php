<?php
/*
**	Rock Builder Shortcodes File
**  ##################################
**	All of the shortcodes of the Rock Builder system will be here
*/


/*
**	Portfolio Showcase (a.k.a. Ajax Filtered Gallery)
*/
$rockthemes_wordpress_url = home_url();
if(!function_exists('rockthemes_shortcode_make_portfolio_showcase')){
	function rockthemes_shortcode_make_portfolio_showcase($atts) {  
	
		wp_reset_query();
		wp_reset_postdata();
		
		extract( shortcode_atts( array(
				'post_type'					=>	'post',
				'category'					=>	'all',
				'block_grid_large'			=>	'3',
				'block_grid_medium'			=>	'3',
				'block_grid_small'			=>	'3',
				'total'						=>	'9',
				'activate_hover_box'		=>	'true',
				'activate_hover'			=>	'false',
				'disable_hover_link'		=>	'false',
				'use_shadow'				=>	'false',
				'excerpt_length'			=>	'18',
				'small_thumb_hover'			=>	'false',
				'boxed_layout'				=>	'false',
				'image_size'				=>	'medium',
				'activate_category_link'	=>	'deactive',
				'use_border_on_categories'	=>	'activate',
				'header_title'				=>	''
		), $atts ) );	
		
		if($post_type === 'no-selected') return;
		
		//Ajax hover obj
		$hover_obj = array('activate_hover_box' => $activate_hover_box,
						   'activate_hover'=>$activate_hover,
						   'disable_hover_link'=>$disable_hover_link,
						   'small_thumb_hover'=>$small_thumb_hover,
						   'use_shadow'=>$use_shadow);
		
		$small_medium_class = rock_builder_get_small_medium_block_grid_class();
		$block_class = ' large-block-grid-'.esc_attr($block_grid_large).' medium-block-grid-'.esc_attr($block_grid_medium).' small-block-grid-'.esc_attr($block_grid_small).' ';

		//Only one hover effect can be used
		if($activate_hover_box === 'true') $activate_hover = 'false';

		if(isset($GLOBALS['rockthemes_portfolio_showcase'])){
			$GLOBALS['rockthemes_portfolio_showcase']++;
		}else{
			$GLOBALS['rockthemes_portfolio_showcase'] = 1;	
		}
		
		
		$id = "quasar-ajaxfiltered-".$GLOBALS['rockthemes_portfolio_showcase'];
		
		$return = '';
		
		if($boxed_layout == "true") $return .= '<div class="boxed-layout boxed-colors ajax-filtered padding-2x">';

			$return .= '<div id="'.$id.'" class="ajax-filtered-gallery-holder '.($use_border_on_categories === 'active' ? 'category-names-in-border' : '').'">';
		
		
			//Header
			//$return .= '<h3>Ajax Filtered Gallery</h3>';
			
			//Navigation
			$return .= '<div class="ajax-navigation" post_type="'.$post_type.'" image_size="'.$image_size.'">';
			
				$cat_list = explode(',', $category);
				
				//Header
				if($header_title !== '') $return .= '<strong>'.$header_title.'</strong>';
								
				$return .= '<ul>';
									
					$totalCat = sizeof($cat_list);
					$i = 0;
					$elements_list = '';
					$taxonomy_attr = ' taxonomy="category"';
					
					foreach($cat_list as $cat){
						
						$data = get_category_by_slug( $cat );
						$link_html = get_permalink($cat);
						
						if($data){
							//$return .= '<li class="category-name" slug-holder="'.$data->slug.'"><a href="#">'.$data->name.'</a></li>';
						}else{

							$tax_list = get_object_taxonomies($post_type);//get_object_taxonomies
							
							$post_tax = '';
							foreach($tax_list as $tax){
					
								if(strpos($tax,'cat') > -1){
									$post_tax = $tax;
									break;
								}
							}
							
							//Return if a custom product type added and removed and forgetten to remove from page.
							if(empty($tax_list)) return;
							
							
							$taxonomy_attr = ' taxonomy="'.$post_tax.'"';
							$data = get_term_by('slug',$cat,$post_tax);
							if(!$data) continue;
							
								$tax = get_category_by_slug($cat);
								if(!$tax){
									$tax = get_term_link($cat,$post_tax);	
								}else{
									$tax = get_category_link($post_tax);
								}
								$link_html = $tax;
						}

						$elements_list .= '<li class="category-name" cat-link="'.$link_html.'" slug-holder="'.$data->slug.'" '.$taxonomy_attr.'><a href="#">'.$data->name.'</a></li>';
						if($i + 1 < $totalCat){
							$elements_list .= '<li slug-holder="no-value" class="no-value"> | </li>';
						}
						
						$i++;
					}
					
					$return .= '<li class="category-name active" slug-holder="'.$category.'" '.$taxonomy_attr.'><a href="#">'.__('Latest','quasar').'</a></li>';
					$return .= '<li value="no-value" class="no-value"> | </li>';
					
					$return .= $elements_list;
				
				$return .= '</ul>';
				
				$return .= '<div class="clear"></div>';
			
				$return .= '<div class="hr-shadow-mask"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
			
			$return .= '</div>';//End of Ajax Navigation
			
			$post_is_tax = false;
			//Body
			$return .= '<div class="ajax-body">';
			
				$return .= '<ul class="'.$block_class.'">';
				
					$posts = array();
					if($post_type === 'post'){
						$posts = get_posts(array('category_name'=> $category, 'posts_per_page'=>$total));
					}
										
					if(!count($posts)){
					
						$args = array(
									'post_type'=>$post_type,
									$post_tax=>$category,
									'posts_per_page' =>$total
						);
						
						$posts = get_posts($args);

						$post_is_tax = true;
					}
										
					if(sizeof($posts)>0){
			
						//Foundation last columns aligns to right. Thus we use this workaround to add an empty columns at the end
						$lastColumn = 12 - ((intval(sizeof($posts)) * intval($block_grid_large))%12);
						foreach($posts as $post){
							$rockthemes_advanced_details = get_post_meta($post->ID, 'advanced_post_details', true);
							if(!isset($rockthemes_advanced_details['ajax_filtered_thumbnail']) || empty($rockthemes_advanced_details['ajax_filtered_thumbnail'])):
							
								//has_post_thumbnail($post->ID);
								$featuredBig = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'ajax-filtered-hover');
								if($featuredBig){ 
									$featuredBig = $featuredBig[0];
								}else{
									$featuredBig = (wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) && !$featuredBig) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID) ): 'no-image';
								}
	
								$thumbnail = wp_get_attachment_image( get_post_thumbnail_id($post->ID),$image_size );
							else:
							
								$featuredBig = $rockthemes_advanced_details['ajax_filtered_hover_box_image'];
								$thumbnail = '<img src="'.$rockthemes_advanced_details['ajax_filtered_thumbnail'].'" />';
							
							endif;
							
							$title = $thumbnail ? $thumbnail : $post->post_title;
							$link = get_post_permalink($post->ID);

							$excerpt = rock_check_p((rockthemes_excerpt($post->post_excerpt,$excerpt_length)));

							if(get_post_meta( $post->ID, '_sale_price',true) != '' && rockthemes_woocommerce_active()){
								$excerpt = '<div class="remove-foundation-padding"><div class="large-9 columns">'.rock_check_p((rockthemes_excerpt($post->post_excerpt,$excerpt_length))).'</div><div class="price-holder large-3 columns right-text">'.woocommerce_price(get_post_meta( $post->ID, '_sale_price',true)).'</div></div>';
							}
							
							if($link != '' && $activate_hover != 'true'){
								$title = '<a href="'.$link.'">'.$title.'</a>';
							}
							
							if($activate_hover == 'true'){
								/*
								$hover_effect = '
									<div class="regular-hover-container"><div class="hover-bg"><div class="hover-icon-container"><i class="fa fa-link"></i><i class="icon-zoom-in"></i></div></div></div>
								';
								
								$full_image= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' );
								$hover_effect = '
									<div class="regular-hover-container '.(($small_thumb_hover == 'true') ? 'small-thumb' : '').'"><div class="hover-bg"><div class="hover-icon-container"><a href="'.$link.'" class="iconeffect"><img src="'.F_WAY.'/images/icomoon/link.svg" class="use_svg" /></a><a href="'.$full_image[0].'" rel="prettyPhoto" class="iconeffect"><img src="'.F_WAY.'/images/icomoon/search.svg" class="use_svg" width="32" height="32" /></a></div></div></div>
								';
								*/
								$hover_effect = quasar_hover_effect($post->ID, ($use_shadow === 'true' ? true : false), ($disable_hover_link !== 'false' ? false : true));
								
								$title = '<div class="relative-container rockthemes-hover">'.$title.$hover_effect.'</div>';
							}
							
														
							$return .= '<li class="ajax-filtered-element" featured-big="'.$featuredBig.'">'.$title.'<div class="hide"><div class="header-title">'.$post->post_title.'</div>'.$excerpt.'</div></li>';
						}
						//if($lastColumn > 0) $return .= '<div class="large-'.$lastColumn.' columns"></div>';
					}else{
						$return .= '<li class="large-12 columns">'.__("No data found!","quasar").'</li>';
					}
				
				$return .= '</ul>';

			$return .= '</div>';//End of Body
			
			$return .= '<div class="clear"></div>';
			
			if($activate_category_link == 'active'){
				//Footer navigation
				$return .= '
					<div class="ajax-filtered-footer">
						<div class="right">
							<p>
								<br/>
							</p>
						</div>
						<div class="clear"></div>
					</div>';
			}
			
								
			$return .= '</div>';//End of HTML field
		
		if($boxed_layout == "true") $return .= '</div>';
		
		
		
		$script = '<script type="text/javascript">';
		
			$script .= 'jQuery(document).ready(function(){';
			
				//Plain text loading string
				$loadingScript = "<div class='row loading'><div class='large-12 columns'>".__("Loading...","quasar")."</div></div>";
				
				//Animated loading screen
				$loadingScript = "<div class='row loading rock-loader-container'><div class='loader-gif'><img src='".F_WAY.'/images/gif-loader.gif'."'  /></div><div class='loader'></div></div>";
				
				//General Loader
				$loadingScript = "<div class='row loading rock-loader-container loader-not-supported'><div class='loader-gif'><img src='".F_WAY."/images/loader.gif\' /></div><div class='loader'></div></div>";
				
				$errorDataScript = "<div class='row'><div class='large-12 columns'>".__("Loading Error. Try Again","quasar")."</div></div>";
				
				$script .= '
				
				jQuery.fn.rockthemes_svg_control();
				
				var contentPadding = '.rockthemes_fn_px_em_return_num(xr_get_option('content_padding','10px')).';
				var _onChange = false;
				var staticHeightTimeout;
				jQuery(document).on("click", "#'.$id.' .category-name", function(e){
					e.preventDefault();
					if(_onChange) return;
					_onChange = true;
					
					jQuery("#'.$id.' .category-name.active").removeClass("active");
					jQuery(this).addClass("active");
					
					jQuery("#'.$id.' .ajax-body").stop(true,true);
					
					if(typeof staticHeightTimeout != "undefined"){
						clearTimeout(staticHeightTimeout);
					}
					
					if(jQuery("#'.$id.' .ajax-filtered-footer").length){
						jQuery("#'.$id.' .ajax-filtered-footer p").remove();
						var catURL = jQuery(this).attr("cat-link");
						var catName = jQuery(this).find("a").html();

						if(typeof catURL != "undefined"){
							jQuery("#'.$id.' .ajax-filtered-footer .right").append("<p><a href=\'"+catURL+"\'>"+catName+" <i class=\'fa-angle-double-right\'></i></a></p>");	
						}else{
							jQuery("#'.$id.' .ajax-filtered-footer .right").append("<p><br/></p>");	
						}
					}
					
					var staticHeight = (parseInt(jQuery("#'.$id.' .ajax-body").height().toString().replace("px",""))+30)+"px";
					staticHeight = jQuery("#'.$id.' .ajax-body").height();

					if(staticHeight < 150) staticHeight = 150;
					jQuery("#'.$id.' .ajax-body").css("min-height",staticHeight);
					
					jQuery("#'.$id.' .ajax-body > ul").remove();
					jQuery("#'.$id.' .ajax-body").append(jQuery("'.($loadingScript).'"));
					
					//Check if loader css3 transition supported
					if(!Modernizr.csstransitions){
						jQuery(".rock-loader-container").addClass("loader-not-supported");
					}
									
					var slug = jQuery(this).attr("slug-holder");
					var taxonomyVar = jQuery(this).attr("taxonomy");
					var postType = "";
					var imageSize = jQuery(this).parent().parent().attr("image_size");
					if(jQuery(this).parent().parent().attr("post_type")){
						postType = jQuery(this).parent().parent().attr("post_type");
					}
					
					var rockthemes_ajax_filter_nonce = "'.(esc_js(wp_create_nonce('rockthemes_ajax_filter_nonce'))).'";
					
					jQuery.post("'.admin_url('admin-ajax.php').'", {image_size:imageSize, _ajax_nonce:rockthemes_ajax_filter_nonce, categorySlug:slug, taxonomy:taxonomyVar, post_type:postType, total:"'.(int) $total.'", block_class:"'.$block_class.'", excerpt_length:"'.(int) $excerpt_length.'", hover_obj:'.json_encode($hover_obj).', action:"get_ajaxfiltered_elems"}, function(data){
						_onChange = false;

						if(data != null){
							//Start loading images
							jQuery("#'.$id.' .ajax-body").append("<div class=\"hide wrap-temp\">"+data.body+"</div>");

							jQuery("#'.$id.' .ajax-body").find(".wrap-temp ul > li").css("display","none");
							jQuery("#'.$id.' .ajax-body").find(".wrap-temp ul").unwrap();

							var totalImages = jQuery("#'.$id.' .ajax-body ul li .relative-container > img, #'.$id.' .ajax-body ul li > a > img").length;
							
							if(totalImages > 0){

								var currentLoadedImage = 0;
								jQuery("#'.$id.' .ajax-body ul li .relative-container > img, #'.$id.' .ajax-body ul li > a > img").load(function(){
									currentLoadedImage++;
									
									if(currentLoadedImage >= totalImages){
										//All Images are loaded. Fade them in slowly
										jQuery("#'.$id.' .ajax-body > .row.loading").remove();

										jQuery("#'.$id.' .ajax-body ul > li").each(function(i){
											jQuery(this).delay(100*i).fadeIn();
										});
									}
								});
							}else{
								jQuery("#'.$id.' .ajax-body > .row.loading").remove();
								jQuery("#'.$id.' .ajax-body .row > .columns").each(function(i){
									jQuery(this).delay(100*i).fadeIn();
								});
							}
							
							jQuery("a[rel^=\"prettyPhoto\"]").prettyPhoto();

						}else{
							jQuery("#'.$id.' .ajax-body > .row").remove();
							jQuery("#'.$id.' .ajax-body").append("'.$errorDataScript.'");
						}
						
						
						staticHeightTimeout = setTimeout(function(){
							jQuery("#'.$id.' .ajax-body").stop(true,true).animate({"min-height":"0" },800,"linear");
						},800);
					});
					
				});';
				
				if($activate_hover_box == "true"){
					
					$script .= '
					
					jQuery(document).on("mouseover", "#'.$id.' .ajax-body .ajax-filtered-element", function(e){
						if(jQuery(this).children().length <= 0) return;
						if(!jQuery(this).attr("featured-big") || jQuery(this).attr("featured-big") == "no-image") return;
						if(jQuery(window).width() < 900) return;
						
						
						if(jQuery(".ajax-filtered-hover-box").length >0){
							jQuery(".ajax-filtered-hover-box").remove();
						}
						
						var imageLink = jQuery(this).attr("featured-big");
						var coords = jQuery(this).offset();
						coords.width = jQuery(this).width();
						coords.height = jQuery(this).height();

						var desc = jQuery(this).find(".hide").html();
						
						var elem = ajaxFilteredHoverBox(coords,imageLink,desc);
						
						jQuery("body").append(elem);
					});
					
					jQuery(document).on("mouseout", "#'.$id.' .ajax-body .ajax-filtered-element", function(){
						
						if(jQuery(".ajax-filtered-hover-box").length >0){
							jQuery(".ajax-filtered-hover-box").remove();
						}
					});
					/*
					jQuery(document).on("mousemove", function(e){
						if(jQuery(".ajax-filtered-hover-box").length >0){
							jQuery(".ajax-filtered-hover-box").css({"left":e.pageX +30, "top":e.pageY - 200});
						}
					});
					*/
					function ajaxFilteredHoverBox(coords,image,desc){
						var boxWidth = "'.xr_get_option('ajax_filtered_hover_width','590px').'";
						var boxHeight = "'.xr_get_option('ajax_filtered_hover_height','300px').'";
						
						var widthNum = boxWidth.replace("px","");
						widthNum = widthNum.replace("em","");
						widthNum = parseInt(widthNum);
						
						var heightNum = boxHeight.replace("px","");
						heightNum = heightNum.replace("em","");
						heightNum = parseInt(heightNum);

						var leftVal = coords.left + coords.width + (contentPadding / 2) - 2;
						if((leftVal + widthNum + 20) > jQuery(document).width()){
							leftVal = leftVal - coords.width - widthNum - contentPadding;
						}

						var topVal = coords.top + coords.height - heightNum - 80 - 7 - 2;
						


						if(topVal < jQuery(window).scrollTop()){
							topVal = coords.top + 6 - 1;	
						}
												
						var box = "<div class=\"ajax-filtered-hover-box shadow-box-class fadeIn animated\" style=\"position:absolute; left:"+leftVal+"px; top:"+topVal+"px; \">";
						box += "<div class=\"ajax-filtered-image\"><img src="+image+" /></div>"
						if(typeof desc != "undefined" && desc != "") box += "<div class=\"desc\"><p>"+desc+"</p></div>";
						box += "</div>";
						return box;
					}
					
					';	
				}
			
			$script .= '});';
		
		$script .= '</script>';//End of Script
		
		
		return $return.$script;
	}  
}

add_shortcode('rockthemes_portfolio_showcase', 'rockthemes_shortcode_make_portfolio_showcase');



if(!function_exists('rockthemes_shortcode_get_portfolioshowcase_elems_function')){
function rockthemes_shortcode_get_portfolioshowcase_elems_function(){

	if(!isset($_REQUEST['categorySlug']) || !isset($_REQUEST['total']) || !isset($_REQUEST['block_class']) ||
	   !isset($_REQUEST['taxonomy']) || !isset($_REQUEST['post_type']) || !isset($_REQUEST['image_size']) ||
	   !isset($_REQUEST['hover_obj'])){exit;}
	global $post;
	
	if(!isset($_REQUEST['_ajax_nonce']) ||
		empty($_REQUEST['_ajax_nonce']) || 
		!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rockthemes_ajax_filter_nonce') ||
		!check_ajax_referer('rockthemes_ajax_filter_nonce')) {
			
		//Die
		die();
	}
	
	
	$slug = sanitize_text_field($_REQUEST['categorySlug']);
	$post_type = sanitize_text_field($_REQUEST['post_type']);
	$taxonomy = sanitize_text_field($_REQUEST['taxonomy']);
	$total = (int) $_REQUEST['total'];
	$block_class = sanitize_text_field($_REQUEST['block_class']);
	$image_size = sanitize_text_field($_REQUEST['image_size']);
	$hover_obj = $_REQUEST['hover_obj'];
	$activate_hover = sanitize_text_field($hover_obj['activate_hover']);
	$activate_hover_box = sanitize_text_field($hover_obj['activate_hover_box']);
	$disable_hover_link = sanitize_text_field($hover_obj['disable_hover_link']);
	$small_thumb_hover = sanitize_text_field($hover_obj['small_thumb_hover']);
	$use_shadow = sanitize_text_field($hover_obj['use_shadow']);
	$excerpt_length = isset($_REQUEST['excerpt_length']) ? (int) $_REQUEST['excerpt_length'] : 18;
	
		wp_reset_query();
		wp_reset_postdata();

	$posts = array();
	if($post_type === 'post'){
		$posts = get_posts(array('category_name'=> $slug, 'posts_per_page'=>$total));
	}

	if(!count($posts)){
		$args = array(
				'post_type'=>$post_type,
				$taxonomy => $slug,
				'posts_per_page'=>$total,
		);
		
		$posts = get_posts($args);
	}
	
		

	$return = '<ul class="'.$block_class.'">';
	
		if(sizeof($posts)>0){
									
			foreach($posts as $post){
				
							$rockthemes_advanced_details = get_post_meta($post->ID, 'advanced_post_details', true);
							if(!isset($rockthemes_advanced_details['ajax_filtered_thumbnail']) || empty($rockthemes_advanced_details['ajax_filtered_thumbnail'])):
							
								//has_post_thumbnail($post->ID);
								$featuredBig = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'ajax-filtered-hover');
								if($featuredBig){ $featuredBig = $featuredBig[0];}else{
									$featuredBig = (wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) && !$featuredBig) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID) ): 'no-image';
								}
	
								$thumbnail = wp_get_attachment_image( get_post_thumbnail_id($post->ID),$image_size );
							
							else:
							
								$featuredBig = $rockthemes_advanced_details['ajax_filtered_hover_box_image'];
								$thumbnail = '<img src="'.$rockthemes_advanced_details['ajax_filtered_thumbnail'].'" />';
							
							endif;
				
				
				

							$title = $thumbnail ? $thumbnail : $post->post_title;
							$link = get_post_permalink($post->ID);
							
							$excerpt = rock_check_p(rockthemes_excerpt($post->post_excerpt,$excerpt_length));

							if(get_post_meta( $post->ID, '_sale_price',true) != '' && rockthemes_woocommerce_active()){
								$excerpt = '<div class="remove-foundation-padding"><div class="large-9 columns">'.rock_check_p(rockthemes_excerpt($post->post_excerpt,$excerpt_length)).'</div><div class="price-holder large-3 columns right-text">'.woocommerce_price(get_post_meta( $post->ID, '_sale_price',true)).'</div></div>';
							}
							
							if($link != '' && $activate_hover != 'true'){
								$title = '<a href="'.$link.'">'.$title.'</a>';
							}
							
							if($activate_hover == 'true'){
								/*
								Deprecated
								$hover_effect = '
									<div class="regular-hover-container"><div class="hover-bg"><div class="hover-icon-container"><i class="fa fa-link"></i><i class="icon-zoom-in"></i></div></div></div>
								';
								*/
								
								$hover_effect = quasar_hover_effect($post->ID, ($use_shadow === 'true' ? true : false), ($disable_hover_link !== 'false' ? false : true));
								
								//$title = '<div class="relative-container rockthemes-hover">'.$title.$hover_effect.'</div>';
								
								/*
								$full_image= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' );
								$hover_effect = '
									<div class="regular-hover-container '.(($small_thumb_hover == 'true') ? 'small-thumb' : '').'"><div class="hover-bg"><div class="hover-icon-container"><a href="'.$link.'" class="iconeffect"><img src="'.F_WAY.'/images/icomoon/link.svg" class="use_svg" /></a><a href="'.$full_image[0].'" rel="prettyPhoto" class="iconeffect"><img src="'.F_WAY.'/images/icomoon/search.svg" class="use_svg" width="32" height="32" /></a></div></div></div>
								';
								*/
								
								$title = '<div class="relative-container rockthemes-hover">'.$title.$hover_effect.'</div>';
							}
							
														
							$return .= '<li class="ajax-filtered-element hide" featured-big="'.$featuredBig.'">'.$title.'<div class="hide"><div class="header-title">'.$post->post_title.'</div>'.$excerpt.'</div></li>';
			
			
			
			
			
			}
					
		}else{
			$return .= '<div class="large-12 columns">'.__("No data found!","quasar").'</div>';
		}
		
	$return .= '</ul>';
		
	echo wp_send_json(array('body'=>$return));
	
	exit;
}
}//end if function exists
add_action('wp_ajax_nopriv_get_ajaxfiltered_elems', 'rockthemes_shortcode_get_portfolioshowcase_elems_function');
add_action('wp_ajax_get_ajaxfiltered_elems', 'rockthemes_shortcode_get_portfolioshowcase_elems_function');

/*
**	End of Ajax Filtered Gallery
*/





/*
**	Regular Featured Image Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_featuredimage')){
	function rockthemes_shortcode_make_featuredimage($atts){
		extract( shortcode_atts( array(
				'size' => 'large',
		), $atts ) );	

		global $post;

		if(empty($post)) return;
		
		$thumbnail = quasar_get_featured_image(false, $size, false);

		$return = $thumbnail;//'<img src="'.$thumbnail[0].'" />';
		return $return;
	}
}

add_shortcode('rockthemes_featuredimage','rockthemes_shortcode_make_featuredimage');

/*
**	End of Regular Featured Image Shortcode
*/



/*
**	Swiper Slider Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_swiperslider')){
	function rockthemes_shortcode_make_swiperslider($atts){
		
		extract( shortcode_atts( array(
				'images' => '',
				'size' => 'thumbnail',
				'max_width' => '480px',
		), $atts ) );	
		
		global $rockthemes_wordpress_url;

		if(empty($images) || strpos($images,',') < -1) return;
		
		wp_enqueue_script('jquery');
		//wp_enqueue_style( 'swiper-css', F_WAY.'/css/idangerous.swiper.css', '', '', 'all' );
		//wp_enqueue_script('swiper-js', F_WAY.'/js/idangerous.swiper-1.9.4.js','jquery', array('jquery'));
		
		wp_enqueue_style( 'swiper-css', F_WAY.'/css/idangerous.swiper-2.css', '', '', 'all' );
		//wp_enqueue_script('swiper-js', F_WAY.'/js/idangerous.swiper-2.js', array('jquery'), '');
		//wp_enqueue_script('swiper-js', F_WAY.'/js/idangerous.swiper-2.3.min.js', array('jquery'), '');
		wp_enqueue_script('swiper-js', F_WAY.'/js/idangerous.swiper-2.7.js', array('jquery'), '');
		
		
		if(isset($GLOBALS['rockthemes_swiperslider'])){
			$GLOBALS['rockthemes_swiperslider']++;
		}else{
			$GLOBALS['rockthemes_swiperslider'] = 1;
		}
		
		$id = 'swiper'.$GLOBALS['rockthemes_swiperslider'];
		$pagination = 'pagination'.$GLOBALS['rockthemes_swiperslider'];
		$sliderClassName = 'quasar-swiperslider-main-'.$GLOBALS['rockthemes_swiperslider'];
				
		$imagesArray = explode(',',$images);
		
		$return = '';
				
		$max_width = $max_width != "" ? $max_width : '480px';
		
		$return .= '<div class="quasar-swiperslider '.$sliderClassName.'" style="max-width:'.$max_width.';">';
		$return .= '<div class="" style="height:100%;">';
		$return .= '<div class="swiper-container '.$id.'" style=" opacity:0;">';
		$return .= '<div class="swiper-wrapper">';
		
		$width = 0;
		$height = 5000;
		foreach($imagesArray as $image){
			//TODO : Default wordpress image sizes breaking the swiper slider image size.
			//$src = wp_get_attachment_image_src(rockthemes_get_image_id_from_url($rockthemes_wordpress_url.$image), $size);
			//$image_html = wp_get_attachment_image(rockthemes_get_image_id_from_url($image), $size,false);
			//$return .= '<div class="swiper-slide">'.$image_html.'</div>';		
			
			$src = wp_get_attachment_image_src(rockthemes_get_image_id_from_url($image), $size);
			$return .= '<div class="swiper-slide"><img src="'.$src[0].'" /></div>';		
			if($src[1] > $width) $width = $src[1];
			if($src[2] < $height) $height = $src[2];
		}
		
		$return .= '</div>';
		$return .= '</div>';
		$return .= '</div>';
		$return .= '<div class="pagination '.$pagination.'"></div>';
		$return .= '</div>';
		
		$use_shadow = 'false';
		if($use_shadow === 'true'){
			$return .= '<div class="hr-shadow-mask shadow-dark"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
		}
		
		//End of HTML
		
		$script = '
		<script type="text/javascript">
			jQuery(window).load(function(){
				
				var swiper_parent = jQuery(".'.$sliderClassName.'").parents(".relative-container");
				if(swiper_parent.length){
					if(swiper_parent.hasClass("rockthemes-hover")){
						swiper_parent.removeClass("rockthemes-hover");	
					}
				}
				

				jQuery(".'.$id.'").css({"width":Math.round(jQuery(".'.$id.' .swiper-slide").css("width").replace("px",""))+"px"});
				
				jQuery(window).on("resize", function(){
					jQuery(".'.$id.'").css({"width":"100%"});
					setTimeout(function(){
						newHeight = jQuery(".'.$sliderClassName.' .swiper-slide > img").height();
						jQuery(".'.$sliderClassName.'").css({"height":newHeight});
						jQuery(".'.$id.'").css({"width":Math.round(jQuery(".'.$id.' .swiper-slide").css("width").replace("px",""))+"px"});
						swiper.resizeFix();
					},300);
					
				});
				
				jQuery(document).on("rockthemes:portfolio_resize", function(){
					jQuery(".'.$id.'").css({"width":"100%"});
					jQuery(".'.$sliderClassName.'").css({"height":""});

					swiper.resizeFix();
					
					setTimeout(function(){
						jQuery(".'.$sliderClassName.' .swiper-wrapper").css({"height":""});
						jQuery(".'.$sliderClassName.' .swiper-slide").css({"height":""});
						newHeight = jQuery(".'.$sliderClassName.' .swiper-slide > img").height();
						jQuery(".'.$sliderClassName.'").css({"height":newHeight});
						jQuery(".'.$id.'").css({"width":Math.round(jQuery(".'.$id.' .swiper-slide").css("width").replace("px",""))+"px"});
						//swiper.resizeFix();
					},300);
					
				})

				
				var swiper = new Swiper(".'.$id.'", {
					pagination : ".'.$pagination.'",
					loop:true,
					grabCursor: true,
					mode:"horizontal",
					calculateHeight:true,
					roundLengths:true,
					grabCursor:true,
					autoResize:true,
					onFirstInit:function(){
						jQuery(".'.$id.'").animate({"opacity":1},10);
					}
				});
				

				/*
				var newHeight;
				newHeight = jQuery(".'.$sliderClassName.' .swiper-slide > img").height();
				jQuery(".'.$sliderClassName.'").css("height",newHeight);
				*/

		//jQuery(".swiper-wrapper").css({height : "auto"});
		//jQuery(".swiper-slide").css({height : "auto"});
				
		
				//Clickable pagination
				jQuery(document).on("click", ".'.$pagination.' .swiper-pagination-switch", function(){
					swiper.swipeTo(jQuery(this).index());
				});
				
				
				jQuery(document).trigger("rockthemes:portfolio_resize");
				
				/*
					jQuery(".'.$id.'").css({"width":"100%"});
					setTimeout(function(){
						newHeight = jQuery(".'.$sliderClassName.' .swiper-slide > img").height();
						jQuery(".'.$sliderClassName.'").css({"height":newHeight});
						jQuery(".'.$id.'").css({"width":Math.round(jQuery(".'.$id.' .swiper-slide").css("width").replace("px",""))+"px"});
						swiper.resizeFix();
					},300);
				*/
				
			});
		</script>';
		
		$style = '
		<style type="text/css">
			.swiper-container.'.$id.', .'.$id.' .swiper-slide {
				width: 100%; 
				/*'.$width.'px;*/
				/*height:100%;*/
				/*width:200px;*/
			}
			
			.pagination.'.$pagination.'{
				text-align:center;
				margin-top:-25px;	
				z-index:20;
			}
		</style>';
		
		
		//$return = '<img src="'.$thumbnail[0].'" />';
		return $return.$script.$style;
	}
}

add_shortcode('rockthemes_swiperslider','rockthemes_shortcode_make_swiperslider');

/*
**	End of Swiper Slider Shortcode
*/





/*
**	Pricing Table Shortcode
*/
//Pricing table inside table
if(!function_exists('rockthemes_shortcode_make_pricingtable_table')){
function rockthemes_shortcode_make_pricingtable_table($atts, $content=null){
	extract( shortcode_atts( array(
			'package_name' => 'Standard',
			'package_detail' => 'Classic Plan',
			'package_featured' => 'false',
			'package_time' => '',
			'package_price' => '',
			'button_type' => 'green',
			'button_name' => 'Buy Now!',
			'button_link' => '',
			'featured_text' => 'Featured',
			'max_width' => '480px',
			'show_details' => 'true'
	), $atts ) );	
	
	$table_columns = $GLOBALS['rockthemes_pt_table_columns'];
	
	switch($table_columns){
		case 12:
		$button_width = 30;
		break;
		
		case 6:
		$button_width = 50;
		break;
		
		case 4:
		$button_width = 60;
		break;
		
		case 3:
		$button_width = 80;
		break;
		
		default;
		$button_width = 100;
		break;
	}
	
	$link = $button_link != '' ? true : false;

	$options = '';
	
	$i=0;
	while(!empty($atts['option_name'.$i])){
		$icon_html = '';
		
		if(isset($atts['icon_class'.$i]) && !empty($atts['icon_class'.$i])){
			$icon_html = '<i class="'.$atts['icon_class'.$i].'"></i>';
		}
		
		if(isset($atts['icon_url'.$i]) && !empty($atts['icon_url'.$i])){
			$icon_html = '<img src="'.$atts['icon_url'.$i].'" />';
		}
		
		$options .= '<div class="quasar-pt-option">'.$icon_html.''.$atts['option_value'.$i].' '.($show_details === 'true' ? '<span class="quasar-pt-option-desc">'.$atts['option_name'.$i].'</span>' : '').'</div>';
		$i++;	
	}
	
	//Start columns div regular columns for tables
	$return = '<li>';//'<div class="large-'.$table_columns.' columns">';
	
	if($package_featured != "true") $return .= '<br />';
	
	//Start quasar columns
	$return .= '<div class="quasar-pt-columns border-with-radius  center-element full-element" style="max-width:'.$max_width.'">';
	
	$return .= '<div class="quasar-pt-header">';
	
	//Check if featured
	if($package_featured === "true"){
		$return .= '<div class="quasar-pt-featured"><i class="fa-star"></i> '.$featured_text.'</div>';
	}
	
	$return .= '<div class="quasar-pt-package-name"><h2>'.$package_name.'<div>'.$package_detail.'</div></h2></div>';
	
	$return .= '</div>'; //Close header div
	
	$return .= $options;
	
	$return .= '
		<div class="quasar-pt-footer">
			<div class="quasar-pt-price">'.$package_price.'</div>
			<div style="height:5px;"></div>
			<div class="quasar-pt-time">'.$package_time.'</div>
			<div style="height:10px;"></div>';
			
			$return .= do_shortcode($content);
			
			/*
			Deprecated. Use new button modal
			if($button_type != 'no-button'){
				$return .= quasar_make_button($button_type,$button_name, ($link ? $button_link : ''),'width:'.$button_width.'%; margin:10px auto;');
			}
			*/
	$return .= '</div>';
	
	$return .= '</div>'; //Close quasar columns div
	
	$return .= '<br/></li>'; //Close columns div
		
	return $return;
}
}//end of if function exists
add_shortcode('rockthemes_pricingtable_table','rockthemes_shortcode_make_pricingtable_table');

if(!function_exists('rockthemes_shortcode_make_pricingtable')){
function rockthemes_shortcode_make_pricingtable($atts, $content=null){	
	extract( shortcode_atts( array(
			'total_tables' => 3,
			'max_width' => '480px',
	), $atts ) );	
	
	//Find columns of each table element
	$table_columns = rockthemes_shortcode_find_total_columns_for_pricingtable(intval($total_tables));
	$GLOBALS['rockthemes_pt_table_columns'] = $table_columns;
		
	
	$tables = do_shortcode($content);
	
	$return = '<div class="quasar-pt">';
	
	
	$return .= '<ul class="large-block-grid-'.$total_tables.' medium-block-grid-2 small-block-grid-1">'.$tables.'</ul>';
	
	
	$return .= '</div>';
	
	return $return;
}
}//end of if function exists
add_shortcode('rockthemes_pricingtable','rockthemes_shortcode_make_pricingtable');

if(!function_exists('rockthemes_shortcode_find_total_columns_for_pricingtable')){
function rockthemes_shortcode_find_total_columns_for_pricingtable($tables){
	switch($tables){
		case 1:
		return 12;
		break;
		
		case 2:
		return 6;
		break;
		
		case 3:
		return 4;
		break;
		
		case 4:
		return 3;
		break;
		
		case 5:
		return 2;
		break;	
	}
	
	return 0;
}
}
/*
**	End of Pricing Table Shortcode
*/




/*
**	Toggles Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_toggles')){
	function rockthemes_shortcode_make_toggles($atts, $content = null){
		//toggle_type refers to "single-mode" or "multiple-mode"
		extract( shortcode_atts( array(
				'toggle_type' => 'single-mode',
				'open_toggle_index' => '0',
				'boxed_layout' => 'false'
		), $atts ) );	
				
		if(isset($GLOBALS['rockthemes_toggles'])){
			$GLOBALS['rockthemes_toggles']++;
		}else{
			$GLOBALS['rockthemes_toggles'] = 1;
		}
		
		$GLOBALS['rockthemes_toggles_open_counter'] = 0;
		$GLOBALS['rockthemes_open_toggle_index'] = intval(is_int(intval($open_toggle_index)) ? $open_toggle_index : 0);

		$id = 'rock-toggles-'.$GLOBALS['rockthemes_toggles'];
		
		$toggles_single_data = do_shortcode($content);
		
		$return = '';
		
		if($boxed_layout == "true") $return .= '<div class="boxed-layout padding">';
		
		$return .= '<div id="rock-toggles-'.$GLOBALS['rockthemes_toggles'].'" class="row rock-toggles-container">';
				
		$return .= $toggles_single_data;
		
		$return .= '</div>';
		
		if($boxed_layout == "true") $return .= '</div>';
		
		$script = '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(document).on("click", "#'.$id.' .rock-toggle-header", function(e){
		';
		
		if($toggle_type == 'multiple-mode'){
			$script .= '
				if(jQuery(this).parent().hasClass("active") && jQuery(this).parent().find(".rock-toggle-content").css("display") != "none") return;
				jQuery("#'.$id.' .active .rock-toggle-content").slideToggle(280);
				jQuery("#'.$id.' .active .rock-toggle-header .main-toggle-icon").removeClass("fa fa-chevron-up");
				jQuery("#'.$id.' .active .rock-toggle-header .main-toggle-icon").addClass("fa fa-chevron-down");
				jQuery("#'.$id. ' .active").removeClass("active");
				
				jQuery(this).parent().addClass("active");
				jQuery(this).parent().find(".rock-toggle-content").slideToggle(280);
				jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").removeClass("fa fa-chevron-down");
				jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").addClass("fa fa-chevron-up");
			';	
		}else{
			$script .= '
				if(jQuery(this).parent().hasClass("active")){
					jQuery(this).parent().removeClass("active");
					jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").removeClass("fa fa-chevron-up");
					jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").addClass("fa fa-chevron-down");
				}else{
					jQuery(this).parent().addClass("active");
					jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").removeClass("fa fa-chevron-down");
					jQuery(this).parent().find(".rock-toggle-header .main-toggle-icon").addClass("fa fa-chevron-up");
				}
				jQuery(this).parent().find(".rock-toggle-content").slideToggle(280);
			';	
		}
				
				
		$script .='
				});
			});
		</script>
		';
		
		return $return.$script;		
	}
	
}

add_shortcode("rockthemes_toggles", "rockthemes_shortcode_make_toggles");


if(!function_exists('rockthemes_shortcode_make_toggles_single')){
	function rockthemes_shortcode_make_toggles_single($atts, $content = null){	
		extract( shortcode_atts( array(
				'title' => 'Toggle New',
				'use_shadow' => 'false',
				'icon_class' => '',
				'icon_url' => ''
		), $atts ) );
		
		$use_icon = false;
		$use_url = false;
		$icon_html = '';
		$icon_url_html = '';
		
		if($icon_class != ""){
			$icon_html = '<i class="'.$icon_class.' rock-toggle-header-icon"></i>';
			$use_icon = true;
		}
		
		if($icon_url != ""){
			$icon_html = '<img src="'.$icon_url.'" class="rock-toggle-header-icon" />';
			$use_icon = true;	
		}

		
		$ref_id = 'toggles-'.$GLOBALS['rockthemes_toggles'];
				
		if($use_shadow == 'true'){
			$shadow_code = '<div class="hr-shadow-mask"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
		}else{
			$shadow_code = '';
		}
		
		
		$return = '';
		if($GLOBALS['rockthemes_toggles_open_counter'] === $GLOBALS['rockthemes_open_toggle_index']){
			$return .= '<div class="large-12 columns active">';
			$return .= '<div class="rock-toggle-header padding" >'.($use_icon ? $icon_html : '').''.$title.'<i class="fa fa-chevron-up right main-toggle-icon"></i></div>';
			$return .= '<div class="clear"></div>';
			$return .= $shadow_code;
			$return .= '<div class="rock-toggle-content padding">'.rock_check_p($content).'</div>';
		}else{
			$return .= '<div class="large-12 columns">';
			$return .= '<div class="rock-toggle-header padding" >'.($use_icon ? $icon_html : '').''.$title.'<i class="fa fa-chevron-down right main-toggle-icon"></i></div>';
			$return .= '<div class="clear"></div>';
			$return .= $shadow_code;
			$return .= '<div class="rock-toggle-content padding" style="display:none;">'.rock_check_p($content).'</div>';
		}
				
		$return .= '</div>';
		
		$GLOBALS['rockthemes_toggles_open_counter']++;
		
		return $return;
	}
}

add_shortcode("rockthemes_toggles_single","rockthemes_shortcode_make_toggles_single");

/*
**	End of Toggles Shortcode
*/





/*
**	Tabs Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_tabs')){
	function rockthemes_shortcode_make_tabs($atts, $content = null){
		//tab_type refers to "tab-top" , "tab-left" , "tab-right"
		extract( shortcode_atts( array(
				'tab_type' => 'tab-left',
				'open_tab_index' => '0',
				'boxed_layout' => 'false',
				'use_shadow' => 'false'
		), $atts ) );	
				
		$shadow = '';
		if($use_shadow !== "false"){$shadow .= 'tab-shadow';}
		
		if(isset($GLOBALS['rockthemes_tabs'])){
			$GLOBALS['rockthemes_tabs']++;
		}else{
			$GLOBALS['rockthemes_tabs'] = 1;
		}
		
		$GLOBALS['rockthemes_tabs_open_counter'] = 0;
		$GLOBALS['rockthemes_open_tab_index'] = intval(is_int(intval($open_tab_index)) ? $open_tab_index : 0);
		$GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-headers'] = '';
		$GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-contents'] = '';
		
		$tab_left_header_column = '';
		$tab_left_content_column = '';
		if($tab_type == "tab-left" || $tab_type == "tab-right"){
			$tab_left_header_column = 'large-3 columns';
			$tab_left_content_column = 'large-9 columns';
		}
		
		$id = 'rock-tabs-'.$GLOBALS['rockthemes_tabs'];
		
		$tabs_single_data = do_shortcode($content);
		
		$return = '';
		
		
		if($boxed_layout == "true"){ $return .= '<div class="boxed-layout padding">';}
		
		$return .= '<div id="rock-tabs-'.$GLOBALS['rockthemes_tabs'].'" class="row rock-tabs-container row '.$tab_type.' '.$shadow.'">';
		
		if($tab_type == "tab-top"){
		
			$return .= '<div class="rock-tabs-header-container large-12 columns">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-headers'];
			
			$return .= '</div>';//Close rock-tabs-header-container div
		
		}else if($tab_type == "tab-left"){
			
			$return .= '<div class="rock-tabs-header-container '.$tab_left_header_column.'">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-headers'];
			
			$return .= '</div>';//Close rock-tabs-header-container div

		}else if($tab_type == "tab-right"){
			$return .= '<div class="rock-tabs-content-container '.$tab_left_content_column.'">';
			
			$return .= '<div class="tabs-motion-container">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-contents'];
			
			$return .= '</div>';//Close tabs-motion-container div
			
			$return .= '</div>';//Close rock-tabs-content-container div
			
			$return .= '<div class="rock-tabs-header-container '.$tab_left_header_column.'">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-headers'];
			
			$return .= '</div>';//Close rock-tabs-header-container div
		}
		
		
		if($tab_type == "tab-top"){
			
			$return .= '<div class="rock-tabs-content-container large-12 columns">';
			
			$return .= '<div class="tabs-motion-container">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-contents'];
			
			$return .= '</div>';//Close tabs-motion-container div
			
			$return .= '</div>';//Close rock-tabs-content-container div
			
		}else if($tab_type == "tab-left"){
			
			$return .= '<div class="rock-tabs-content-container '.$tab_left_content_column.'">';
			
			$return .= '<div class="tabs-motion-container">';
			
			$return .= $GLOBALS['rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'].'-contents'];
			
			$return .= '</div>';//Close tabs-motion-container div
			
			$return .= '</div>';//Close rock-tabs-content-container div
			
		}
				
		//$return .= $tabs_single_data;
		
		$return .= '</div>';
		
		if($boxed_layout == "true"){ $return .= '</div>';}
		
		$script = '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(document).on("click", "#'.$id.' .rock-tab-header", function(e){
					var ref = "#"+jQuery(this).attr("tab-ref")+" ."+jQuery(this).attr("content-ref");
					var tabRef = jQuery(this).attr("tab-ref");
					
					//Remove old active element\'s active class and hide it\'s content
					jQuery("#"+tabRef+" .tabs-motion-content.active").css("display","none").removeClass("active");
					jQuery("#"+tabRef+" .rock-tab-header.active").removeClass("active");
					
					//Add new 
					jQuery(this).addClass("active");
					jQuery(ref).css({"opacity":"0.1", "display":"block"}).addClass("active");
					jQuery(ref).stop(true,true).animate({"opacity":"1"},280);
					
		';
		
				
		$script .='
				});
			});
		</script>
		';
		
		return $return.$script;		
	}
	
}

add_shortcode("rockthemes_tabs", "rockthemes_shortcode_make_tabs");


if(!function_exists('rockthemes_shortcode_make_tabs_single')){
	function rockthemes_shortcode_make_tabs_single($atts, $content = null){	
		extract( shortcode_atts( array(
				'title' => 'Tab New',
				'use_shadow' => 'false',
				'icon_class' => '',
				'icon_url' => ''
		), $atts ) );
		
		$use_icon = false;
		$use_url = false;
		$icon_html = '';
		$icon_url_html = '';
		
		if($icon_class != ""){
			$icon_html = '<i class="'.$icon_class.' rock-tab-header-icon"></i>';
			$use_icon = true;
		}
		
		if($icon_url != ""){
			$icon_html = '<img src="'.$icon_url.'" class="rock-tab-header-icon" />';
			$use_icon = true;	
		}
		
		
		$ref_id = 'rockthemes_tabs-'.$GLOBALS['rockthemes_tabs'];
				
		if($use_shadow == 'true'){
			$shadow_code = '<div class="hr-shadow-mask"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
		}else{
			$shadow_code = '';
		}
		
		if($GLOBALS['rockthemes_tabs_open_counter'] === $GLOBALS['rockthemes_open_tab_index']){
			$GLOBALS[$ref_id.'-headers'] .= '
				<li class="rock-tab-header active" tab-ref="rock-tabs-'.$GLOBALS['rockthemes_tabs'].'" content-ref="content-'.$GLOBALS['rockthemes_tabs_open_counter'].'">'.($use_icon ? $icon_html : "")." ".$title.'</li>
			';
			$GLOBALS[$ref_id.'-contents'] .= '
				<div class="content-'.$GLOBALS['rockthemes_tabs_open_counter'].' tabs-motion-content padding active">'.do_shortcode($content).'</div>
			';
		}else{
			$GLOBALS[$ref_id.'-headers'] .= '
				<li class="rock-tab-header" tab-ref="rock-tabs-'.$GLOBALS['rockthemes_tabs'].'" content-ref="content-'.$GLOBALS['rockthemes_tabs_open_counter'].'">'.($use_icon ? $icon_html : "")." ".$title.'</li>
			';
			$GLOBALS[$ref_id.'-contents'] .= '
				<div class="content-'.$GLOBALS['rockthemes_tabs_open_counter'].' tabs-motion-content padding hide">'.do_shortcode($content).'</div>
			';
		}

		$GLOBALS['rockthemes_tabs_open_counter']++;
		return ;
	}
}

add_shortcode("rockthemes_tabs_single","rockthemes_shortcode_make_tabs_single");

/*
**	End of Tabs Shortcode
*/


/*
**	Iconic Text Shortcode
*/
if(!function_exists('rockthemes_shortcode_make_iconictext')){
	function rockthemes_shortcode_make_iconictext($atts, $content=null){
		extract( shortcode_atts( array(
				'icon_align' => 'left',
				'icon_size' => '',
				'icon_title' => '',
				'avoid_sidebar' => 'false',
				'boxed_layout' => 'false',
				'icon_class' => '',
				'icon_url' => '',
				'icon_box_model' => '',
				'link_url' => 'false',
				'link_id' => 'false',
				'link_is_tax' => 'false',
				'tax_name' => 'false',
				'use_shadow' => 'false'
		), $atts ) );
		
		if($icon_box_model == 'no-box') $icon_box_model = '';
				
		$a_link_color = xr_get_option('a_link_color','#eeeeee');
		$site_general_color = xr_get_option('site_general_color','#81c2f0');
		$bg_color = xr_get_option('iconic_text_icon_box_default_color', '#f0f0f0');
		$boxed_regular_color = '#dedeed';//xr_get_option('boxed_layout_text_color','#101010');
		
		if($icon_box_model == ''){
			$boxed_regular_color = xr_get_option('boxed_layout_text_color','#101010');
		}
		
		$final_icon_color = $boxed_regular_color;
		if($boxed_layout === 'true' ){
			$final_icon_color = xr_get_option('default_text_color','#101010');
		}
		
		
		$icon_html = '';
		$icon_used = false;
		
		if($icon_class != ''){
			$icon_html = '<i class="'.$icon_class.' '.$icon_size.'"></i>';
			$icon_used = true;
		}elseif($icon_url != ''){
			$icon_html = '<img src="'.$icon_url.'" />';	
			$icon_used = true;
		}
				
		//$icon_html = $icon_html;
		
		$link_active = false;
		$link_html = '';
		$link_icon_html = '';
		
		if($link_url !== 'false'){
			$link_html = '<a href="'.$link_url.'">';
			$link_icon_html = '<a href="'.$link_url.'" class="escapea">';
			$link_active = true;
		}elseif($link_id !== 'false'){
			if($link_is_tax !== 'false'){
				$tax = get_category_by_slug($link_id);
				if(!$tax){
					$tax = get_term_link($link_id,$tax_name);	
				}else{
					$tax = get_category_link($tax);
				}
				$link_html = '<a href="'.$tax.'">';
				$link_icon_html = '<a href="'.$tax.'" class="escapea">';
			}else{
				$link_html = '<a href="'.get_permalink($link_id).'">';
				$link_icon_html = '<a href="'.get_permalink($link_id).'" class="escapea">';
			}
			$link_active = true;
		}
		
		
		$return = '';
		
		if($boxed_layout == "true") $return .= '<div class="boxed-layout boxed-colors padding">';
		
		$return .= '<div class="rock-iconictext-container row '.($icon_used ? 'rock-icon-'.$icon_align : '').'">';
		
		$quasar_box_radius = '';
		
		$icon_box_size = '';
		if($icon_box_model !== ''){
			switch($icon_size){
				case 'icon-2':
				$icon_box_size = ' width:64px; height:64px; line-height:28px; ';
				$quasar_box_radius = ' border-radius:15px 0px 30px ';
				$icon_margin_left = '80px';
				break;
				
				case 'icon-3':
				$icon_box_size = ' width:80px; height:80px; line-height:36px; ';
				$icon_margin_left = '100px';
				break;
				
				case 'icon-4':
				$icon_box_size = ' width:106px; height:106px; line-height:102px; ';
				$icon_margin_left = '130px';
				break;
				
				default:
				$icon_box_size = ' width:48px; height:48px; line-height:20px; ';
				$icon_margin_left = '68px';
				break;
			}
		}
		
		if($icon_box_model !== 'quasar-box'){
			$quasar_box_radius = '';
		}
		
		if($icon_used){ 
			//if($link_active) $return .= $link_icon_html;
			
			if($icon_align == 'left'){
				$return .= '<div class="large-12 columns">';
				$return .= '<div class="rockicon-container-column left">';
				$return .= '<div class="rockicon-container'.($icon_box_model === '' ? '" style="background:none; padding:0px;" bg-disabled="true"' : '  rockicon-'.$icon_box_model.'" style="background:'.$bg_color.'; color:'.$final_icon_color.'; '.$icon_box_size.$quasar_box_radius.'"').' icon-color="'.$final_icon_color.'" icon-hover-color="#ffffff" bg-color="'.$bg_color.'" bg-hover-color="'.$site_general_color.'">';	
				
				if($icon_box_model === 'quasar-box')	$return .= '<div class="quasar-style-dot"></div>';
				
				$return .= $icon_html;
				$return .= '</div>';
			}elseif($icon_align == 'top'){
				$return .= '<div class="large-12 columns rockicon-container-column padding">';
				$return .= '<div class="rockicon-container'.($icon_box_model === '' ? '" style="background:none; padding:0px;" bg-disabled="true"' : '  rockicon-'.$icon_box_model.'" style="background:'.$bg_color.'; color:'.$final_icon_color.';'.$icon_box_size.$quasar_box_radius.'"').' icon-color="'.$final_icon_color.'" icon-hover-color="#ffffff" bg-color="'.$bg_color.'" bg-hover-color="'.$site_general_color.'">';
				
				if($icon_box_model === 'quasar-box')	$return .= '<div class="quasar-style-dot"></div>';
				
				$return .= $icon_html;
				$return .= '</div>';
			}
			$return .= '</div>';//Close icon container class
			
			//if($link_active) $return .= '</a>';
		}
		
		$icon_font_size = ' font-size:inherit;';
				
		if($icon_title != ''){
			if($link_active) $return .= $link_html;
			
			if($icon_used && $icon_align == 'left'){
				
				if($icon_box_model === ""){
					$icon_margin_left = '15px';
	
					switch($icon_size){
						case 'icon-2':
						$icon_margin_left = '50px';
						break;
						
						case 'icon-3':
						$icon_margin_left = '60px';
						$icon_font_size = ' font-size:20px;';
						break;
						
						case 'icon-4':
						$icon_margin_left = '85px';
						$icon_font_size = ' font-size:20px;';
						break;
						
						default:
						$icon_margin_left = '30px';
						break;
							
					}
				}
				
				//a new div width margin
				$return .= '<div style="margin-left:'.$icon_margin_left.';"><div class="rock-iconictext-header-title"><strong style="'.$icon_font_size.'">'.$icon_title.'</strong></div><br/>';
			}else{
				$return .= '<div class="large-12 columns"><div class="rock-iconictext-header-title"><strong>'.$icon_title.'</strong></div><br/></div>';
				if($use_shadow !== 'false'){
					$return .= '<div class="clear"></div><div class="hr-shadow-mask" style="width:75%; margin:0px auto;"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div>';
				}
			}
			
			if($link_active) $return .= '</a>';
		}
		
		if($content != null){
			if($icon_used && $icon_align == 'left'){
				$return .= '<div class="rock-iconictext-content">'.rock_check_p($content).'</div></div>';//a closing div for new div
			}else{
			$return .= '<div class="large-12 columns"><div class="rock-iconictext-content">'.rock_check_p($content).'</div></div>';
			}
		}
		
		if($icon_used && $icon_align == 'left'){
			$return .= '</div>';//Close the large-12 columns div for the left align	
		}
		
		$return .= '</div>';//End of rock-iconictext-container
		
		$return .= '<div class="clear"></div>';//Clear any unwanted floats
		
		if($boxed_layout == "true") $return .= '</div>';
		
		
		return $return;
	}
}
add_shortcode('rockthemes_iconictext','rockthemes_shortcode_make_iconictext');

/*
**	End of Iconic Text Shortcode
*/



/*
**	Button Shortcode
*/
if(!function_exists('rockthemes_shortcode_make_button')){
	function rockthemes_shortcode_make_button($atts, $content=null){
		extract( shortcode_atts( array(
			"icon_align"=>"left", 
			"icon_size"=>"", 
			"icon_title"=>"", 
			"button_align"=>"",
			"button_size"=>"", 
			"button_color"=>"", 
			"button_flat"=>"no", 
			"button_shape"=>"", 
			"button_wrap"=>"", 
			"button_link_target"=>"",
			"link_url"=>"", 
			"link_id"=>"", 
			"link_is_tax"=>"", 
			"tax_name"=>"", 
			"icon_class"=>"", 
			"icon_url"=>""
		), $atts ) );
		
		wp_enqueue_style('quasar-buttons',  F_WAY.'/css/buttons.css', '','', 'all');
		//wp_enqueue_script('quasar-buttons', F_WAY.'/js/buttons.js', array('jquery'));
		
		$link_active = false;
		$link_html = '';
		$link_icon_html = '';
		
		if($link_url !== 'false'){
			$link_html = $link_url;
			$link_active = true;
		}elseif($link_id !== 'false'){
			if($link_is_tax !== 'false'){
				$tax = get_category_by_slug($link_id);
				if(!$tax){
					$tax = get_term_link($link_id,$tax_name);	
				}else{
					$tax = get_category_link($tax);
				}
				$link_html = $tax;
			}else{
				$link_html = get_permalink($link_id);
			}
			$link_active = true;
		}
		
		$button_is_else_flat = 'button';
		if($button_flat == 'yes') $button_is_else_flat = 'button-flat';
		if($button_color !== '') $button_is_else_flat .= '-'.$button_color;
		
		$icon_html = '';
		$icon_used = false;
		
		if($icon_class != ''){
			$icon_html = ' <i class="'.$icon_class.' '.$icon_size.'"></i> ';
			$icon_used = true;
		}elseif($icon_url != ''){
			$icon_html = ' <img src="'.$icon_url.'" /> ';	
			$icon_used = true;
		}
		
		$return = '';
		
		$button_align_html = '';
				
		if($button_align === 'left' || $button_align === 'right'){
			$button_align_html  = ' float:'.$button_align.';';	
		}elseif($button_align === 'block'){
			$button_align_html  = ' display:'.$button_align.';';	
		}elseif($button_align == 'center'){
			$return = '<div class="text-center">';	
		}
		
		if($button_wrap == 'yes'){
			if($button_align === 'block'){
				$return .= '<span class="button-wrap" style="display:block;">';	
			}else{
				$return .= '<span class="button-wrap">';	
			}
		}
		
		$button_large_style = '';
		
		if($button_size === 'button-large'){
			$button_large_style = ' padding:15px;';
		}
		
		$return .= '
		<a href="'.$link_html.'" 
		'.($button_link_target == "_blank" ? 'target="_blank"' : '').'
		style="'.$button_align_html.$button_large_style.'" 
		class="escapea button '.($button_shape != "" ? $button_shape." " : ""). ' '.$button_is_else_flat. '	'.$button_size. '">'.($icon_align == "left" ? $icon_html : '').''.$content.''.($icon_align == "right" ? $icon_html : '').'</a>';
		
		if($button_wrap == 'yes') $return .= '</span>'; //Close button wrap span
		
		if($button_align == 'center'){
			$return .= '</div>';//Close the div for align	
		}
		
		return $return;
	}
}
add_shortcode('rockthemes_button','rockthemes_shortcode_make_button');


/*
**	End of Button Shortcode
*/


/*
**	Skill Shortcode
*/
if(!function_exists('rockthemes_shortcode_make_skill')){
	function rockthemes_shortcode_make_skill($atts,$content=null){
		extract( shortcode_atts( array(
			'skill_title'=>'',
			'skill_color'=>'',
			'skill_min_value'=>'',
			'skill_max_value'=>'',
			'skill_current_value'=>'',
			'skill_size'=>''
		), $atts ) );
		
		if(isset($GLOBALS['rockthemes_skill'])){
			$GLOBALS['rockthemes_skill']++;
		}else{
			$GLOBALS['rockthemes_skill'] = 1;
		}
		
		$font_color = xr_get_option('default_text_color', '#666666');
		
		wp_enqueue_script('raphael-js', F_WAY.'/js/raphael-min.js', array('jquery'));
		wp_enqueue_script('justgage-js', F_WAY.'/js/justgage.1.0.1.min.js', array('jquery','raphael-js'));

		$id = 'rock_skill_'.$GLOBALS['rockthemes_skill'];
		
		$size_html = 'style="';
		/*
		TODO : Removed sizes for IE8 problems
		switch($skill_size){
			case "":
			$size_html .= 'max-width:200px; height:160px; max-height:160px;';
			break;
			
			case "small":
			$size_html .= ' max-width:100px; height:80px; max-height:80px;';
			break;
			
			case "large":
			$size_html .= 'width:400px; max-width:400px; height:320px; max-height:320px;';
			break;
		}
		*/
		$size_html .= 'max-width:200px; height:160px; max-height:160px;';
		
		$size_html .= '"';
		
		$return = '<div id="'.$id.'" class="rock-skill" '.$size_html.'></div>';
		
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var g = new JustGage({
						id: "'.$id.'", 
						value: "'.$skill_current_value.'", 
						min: "'.$skill_min_value.'",
						max: "'.$skill_max_value.'",
						title: "'.$skill_title.'",
						titleFontColor: "'.$font_color.'",
						valueFontColor: "'.$font_color.'",
						relativeGaugeSize: true,
						levelColors: ["'.(($skill_color) ? $skill_color : '#666666').'"]
					  }); 
					  
					  if(typeof jQuery.rockthemes_skills == "undefined"){
						  jQuery.rockthemes_skills = new Array();
					  }
					  
					  jQuery.rockthemes_skills.push({id:"'.$id.'", obj:g, value:"'.$skill_current_value.'"});
					  
					  
					var chart'.$id.' = jQuery("#'.$id.'").children(),
					aspect'.$id.' = chart'.$id.'.width() / chart'.$id.'.height(),
					container'.$id.' = jQuery("#'.$id.'"),
					max_width'.$id.' = parseInt(jQuery("#'.$id.'").css("max-width").toString().replace("px",""));

					jQuery(window).on("resize", function() {
						var targetWidth = container'.$id.'.width();
						chart'.$id.'.attr("width", targetWidth);
						var newWidth = Math.round(targetWidth / aspect'.$id.');
						if(newWidth > max_width'.$id.') newWidth = max_width'.$id.';
						chart'.$id.'.attr("height",newWidth);
						chart'.$id.'.parent().css("height", Math.round(targetWidth / aspect'.$id.'));
					}).trigger("resize");
				});
			</script>
		';
		
		return $return.$script;
	}
}
add_shortcode('rockthemes_skill','rockthemes_shortcode_make_skill');




/*
**	Horizontal Rule Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_hr')){
	function rockthemes_shortcode_make_hr($atts){
		extract( shortcode_atts( array(
			'hr_is_image'=>'',
			'image_url'=>'',
			'tile_image'=>'',
			'hr_html_model'=>'',
			'hr_height'=>'10px',
		), $atts ) );
		
		$return = '';
		
		if($hr_is_image == 'use_html'){
			$return = '<hr style="margin:15px 0px; width:100%; height:0px; border-bottom:none; border-top:1px '.$hr_html_model.' #999999;" />';
		}
		
		if($hr_is_image == 'use_image'){
			$image_css_atts = ' no-repeat';
			if($tile_image == 'yes'){
				$image_css_atts = ' repeat';	
			}
			$return = '
				<div style="background:url(\''.$image_url.'\') '.$image_css_atts.'; width:100%; margin:15px 0; height:'.$hr_height.';">
				</div>
				';
		}
		
		return $return;
	}
}

add_shortcode('rockthemes_hr','rockthemes_shortcode_make_hr');

/*
**	End of Horizontal Rule Shortcode
*/



/*
**	Portfolio Shortcode
*/
if(!function_exists('rockthemes_shortcode_make_portfolio')){
	function rockthemes_shortcode_make_portfolio($atts,$content=null){
		global $paged;
		//wp_reset_query();
		//wp_reset_postdata();
		
		extract( shortcode_atts( array(
				'post_type'					=>	'post',
				'category'					=>	'all',
				'excerpt_title_option'		=>	'no_description',
				'excerpt_length'			=>	18,
				'block_grid_large'			=>	'3',
				'block_grid_medium'			=>	'3',
				'block_grid_small'			=>	'3',
				'total'						=>	'9',
				'activate_hover_box'		=>	'true',
				'activate_hover'			=>	'false',
				'disable_hover_link'		=>	'false',
				'small_thumb_hover'			=>	'false',
				'boxed_layout'				=>	'false',
				'image_size'				=>	'medium',
				'pagination'				=>	'true',
				'portfolio_model'			=>	'grid',
				'portfolio_model_switch'	=>	'true',
				'activate_category_link'	=>	'true',
				'header_title'				=>	'',
				'activate_header_link'		=>	'true',
				'use_shadow'				=>	'true',
				'use_swiper_for_thumbnails'	=>	'true'
		), $atts ) );	
		
		
		if($post_type === 'no-selected') return;
		
		//Hover Details for the image
		$hover_obj = array(
				'activate_hover_box'	=>	$activate_hover_box,
				'activate_hover'		=>	$activate_hover,
				'disable_hover_link'	=>	$disable_hover_link,
				'small_thumb_hover'		=>	$small_thumb_hover,
		);

		//Columns Class		
		$block_class = ' large-block-grid-'.$block_grid_large.' medium-block-grid-'.$block_grid_medium.' small-block-grid-'.$block_grid_small.' ';

		//Only one hover effect can be used
		if($activate_hover_box === 'true') $activate_hover = 'false';

		if(isset($GLOBALS['rockthemes_portfolio'])){
			$GLOBALS['rockthemes_portfolio']++;
		}else{
			$GLOBALS['rockthemes_portfolio'] = 1;	
		}
		
		
		$id = "quasar-portfolio-".$GLOBALS['rockthemes_portfolio'];
		$post_is_tax = false;

		$tax_list = get_object_taxonomies($post_type);//get_object_taxonomies
		$post_tax;
		foreach($tax_list as $tax){
			if(strpos($tax,'cat') > -1){
				$post_tax = $tax;
				break;
			}
		}

		
		if(get_query_var('paged')){
			//Works for the pages called from index.php
			$paged = get_query_var('paged');	
		}elseif(get_query_var('page')){
			//Works for the shortcodes
			$paged = get_query_var('page');	
		}else{
			$paged = 1;	
		}
		//$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$posts = array();
		if($post_type === 'post'){
			$posts = query_posts(array('category_name'=> $category, 'posts_per_page'=>$total, 'paged'=>$paged));
		}
									
		if(!count($posts)){
			$args = array(
				'post_type'			=>	$post_type,
				$post_tax			=>	$category,
				'posts_per_page'	=>	$total,
				'paged'				=>	$paged
			);
					
			$posts = query_posts($args);
			$post_is_tax = true;
		}
		
		$return = '';
		
		//if($boxed_layout == "true") $return .= '<div class="boxed-layout boxed-colors quasar-portfolio padding-2x">';
		
		$return .= '<div id="'.$id.'" class="quasar-portfolio-container '.$portfolio_model.' '.($use_shadow === 'true' ? 'use-shadow' : '').' '.($boxed_layout === 'true' ? 'boxed_layout_holder' : '').'">';
			
			if($portfolio_model_switch === 'true' || $header_title != ''){
				//Header for hybrid layout - Grid and List
				$return .= '<div class="quasar-portfolio-header">';
				
				if($header_title != ''){
					$return .= '<div class="quasar-portfolio-main-title">'.$header_title.'</div>';
				}
				
				if($portfolio_model_switch === 'true'){
					$return .= '
						<div class="quasar-portfolio-mode-switch">
							<div class="button button_non_responsive button-small main-gradient button-radius quasar_portfolio_grid '.($portfolio_model === 'grid' ? 'active' : '').'" ref="'.$id.'"><i class="fa fa-th " ></i></div>
							<div class="button button_non_responsive button-small main-gradient button-radius quasar_portfolio_list '.($portfolio_model === 'list' ? 'active' : '').'" ref="'.$id.'"><i class="fa fa-th-list"></i></div>
						</div>
					';
				}
				
				$return .= '<div class="clear"></div>
					</div>
					<br/>
				';
			}
			
			//Body
			$return .= '<ul class="quasar-portfolio-body '.($portfolio_model === 'grid' ? $block_class : '').'" class-ref="'.$block_class.'">';
		
				
			if(sizeof($posts)>0){

				$count_columns = 1;
				
				foreach($posts as $post_object){
					global $post, $rockthemes_advanced_details;
					$post = $post_object;
					setup_postdata($post);

					$rockthemes_advanced_details = get_post_meta($post->ID,'advanced_post_details',true);

					$cat_list = wp_get_post_terms($post->ID,$post_tax);
					//var_dump($cat_list);

					$link_html = '';
					$total_cat = count($cat_list);
					$c = 0;
					foreach($cat_list as $cat){
						$tax = get_category_by_slug($cat->slug);
						if(!$tax){
							$tax = get_term_link($cat->slug,$post_tax);	
						}else{
							$tax = get_category_link($post_tax);
							if(empty($tax)){
								
								$category_id = get_cat_ID( $cat->slug );
								
								if(empty($category_id)){
									$category_id = get_cat_ID( $cat->name);	
								}

								// Get the URL of this category
								$tax = get_category_link( $category_id );	
							}
						}
						$link_html .= '<a href="'.$tax.'">'.$cat->name.'</a>';
						$c++;
						if($c < $total_cat) $link_html .= ', ';
					}
					
					$featuredBig = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'ajax-filtered-hover');
					if($featuredBig){ $featuredBig = $featuredBig[0];}else{
						$featuredBig = (wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) && !$featuredBig) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID) ): 'no-image';
					}
					
					$thumbnail = wp_get_attachment_image( get_post_thumbnail_id($post->ID),$image_size );
					
					$title = $thumbnail ? $thumbnail : $post->post_title;
					
					if($use_swiper_for_thumbnails === 'true'){
						$title = (rockthemes_make_swiperslider_shortcode($post->ID,$image_size));
					}
						
					$link = get_post_permalink($post->ID);
					
					$excerpt = rock_check_p($post->post_excerpt);
					$product_price= '';
					if(get_post_meta( $post->ID, '_sale_price',true) != '' && rockthemes_woocommerce_active()){
						$product_price = woocommerce_price(get_post_meta( $post->ID, '_sale_price',true));
						$excerpt = '<div class="remove-foundation-padding"><div class="large-9 columns">'.rock_check_p($post->post_excerpt).'</div><div class="price-holder large-3 columns right-text">'.$product_price.'</div></div>';
					}
						
					if($link != '' && $activate_hover != 'true'){
						$title = '<div class="relative-container rockthemes-hover"><a href="'.$link.'">'.$title.'</a></div>';
					}
						
					if($activate_hover == 'true'){
						$hover_effect = quasar_hover_effect($post->ID,($use_shadow === 'true' ? true : false), ($disable_hover_link !== 'false' ? false : true), 'portfolio_gallery_'.$GLOBALS['rockthemes_portfolio']);
							
						$title = '<div class="relative-container rockthemes-hover">'.$title.$hover_effect.'</div>';
					}else if($use_shadow === 'true'){
						$title = '<div class="relative-container">'.$title.'<div class="hr-shadow-mask shadow-absolute"><hr class="hr-shadow active shadow-effect curve curve-hz-1"></div></div>';
					}
					
						
					$description = '';
					$list_description = '';
					
					$desc_details = explode('_',$excerpt_title_option);
					
					$desc_details_price_active = false;
					if(strpos($excerpt_title_option,'price') > -1) $desc_details_price_active = true;
						
					$desc_details_excerpt_active = false;
					if(strpos($excerpt_title_option,'price') > -1) $desc_details_excerpt_active = true;
					
					if($excerpt_title_option != "no_description"){
												
						
						foreach($desc_details as $detail){
							switch($detail){
								case 'title':
								if($activate_header_link === 'false'){
									$description .= '<p class="quasar-portfolio-title">'.get_the_title().'</p>';
								}else{
									$description .= '<p class="quasar-portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
								}
								
								if($activate_category_link === 'true'){
									//Check if user activates the category link
									$description .= '<p class="quasar-portfolio-category-link">'.$link_html.'</p>';	
								}
								
								
								break;
								
								case 'excerpt' :
								/*
								**	WooCommerce
								**	if($desc_details_price_active) $description .= '<div class="row"><div class="large-9 columns">';
								*/
								if($desc_details_price_active) $description .= '<div>';
								$description .= '<p class="quasar-portfolio-excerpt">'.(rockthemes_excerpt($post->post_excerpt,$excerpt_length)).'</p>';
								if($desc_details_price_active) $description .= '</div>';
								
								
							
								/*
								Read More for products. Currently stopped for using buttons. Works without a problem
								
								if($desc_details_price_active) $list_description .= '<div class="row"><div class="large-9 columns">';
								$list_description .= '<p class="quasar-portfolio-excerpt">'.rock_check_p(($post->post_excerpt).quasar_read_more()).'</p>';
								if($desc_details_price_active) $list_description .= '</div>';
								*/
								break;
								
								case 'price' :
								/*
								TO DO	:	WooCommerce Price Field. Works but needs visual improvments.
								if($desc_details_excerpt_active) $description .= '<div class="large-3 columns">';
								$description .= '<p class="quasar-price">'.$product_price.'</p>';
								if($desc_details_excerpt_active) $description .= '</div></div>';
								
								if($desc_details_excerpt_active) $list_description .= '<div class="large-3 columns">';
								$list_description .= '<p class="quasar-price">'.$product_price.'</p>';
								if($desc_details_excerpt_active) $list_description .= '</div></div>';
								*/
								break;
							}
							
						}
						
					}
					
					
					
					if($portfolio_model === 'list' || $portfolio_model_switch === 'true'){
						//List Description will always display
						if($activate_header_link === 'false'){
							$list_description .= '<p class="quasar-portfolio-title">'.get_the_title().'</p>';
						}else{
							$list_description .= '<p class="quasar-portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
						}
								
						if($activate_category_link === 'true'){
							//Check if user activates the category link
							$list_description .= '<p class="quasar-portfolio-category-link">'.$link_html.'</p>';	
						}
						
						if($portfolio_model === 'list' || $portfolio_model_switch === 'true'){
							//Moved here from the switch. Now list view will always display the excerpt
							/*
							**	WooCommerce
							**	if($desc_details_price_active) $list_description .= '<div class="row"><div class="large-9 columns">';
							*/
							if($desc_details_price_active) $list_description .= '<div>';
							$list_description .= '<p class="quasar-portfolio-excerpt">'.(($post->post_excerpt)).'</p>';
							if($desc_details_price_active) $list_description .= '</div>';
						}
						
						$button_html = '';
						
						if(isset($rockthemes_advanced_details['extra_buttons']) && $rockthemes_advanced_details['extra_buttons'][0] != ''){
							foreach($rockthemes_advanced_details['extra_buttons'] as $extra_button){
								$button_html .= do_shortcode($extra_button);	
							}
						}
							
						$primary_button = '[rockthemes_button icon_align="left" icon_title="" button_size="" button_color="primary" button_flat="no" button_shape="button-rounded" button_wrap="no" button_link_target="" link_url="'.get_permalink().'" link_id="1631" link_is_tax="false" tax_name="" icon_class="" icon_url=""]'.__('Details','quasar').'[/rockthemes_button]';
							
						$list_description .= '
							<div class="quasar-portfolio-buttons">
								'.do_shortcode($primary_button).'
								'.$button_html.'
							</div>
						';
						
						//End of list description
					}
						
						
					
					$boxed_cover_html_pre = '';
					$boxed_cover_html_after = '';
					$boxed_cover_html_class = '';
					$boxed_cover_list_before = '';
					$boxed_cover_list_after = '';
					
					if($boxed_layout == "true")	{
						$boxed_cover_html_pre = '<div class="boxed_layout_holder '.($portfolio_model ==='grid' ? 'boxed-layout boxed-colors columns' : '').'" ref="boxed-layout boxed-colors">';	
						$boxed_cover_html_after = '</div>';
						$boxed_cover_html_class = 'boxed-layout boxed-colors quasar-portfolio';
						
						if($portfolio_model === 'list'){
							$boxed_cover_list_before = '<div class="boxed-layout boxed-colors padding columns margin-bottom">';
							$boxed_cover_list_after = '</div>';
						}
					}
					
					if($portfolio_model === 'list'){
						$title = '<div class="relative-container-holder large-5 medium-5 columns" style="margin-right:15px;">'.$title.'</div>';	
					}
										
					$return .= $boxed_cover_list_before.'<li featured-big="'.$featuredBig.'" '.(($portfolio_model === 'list' )  ? 'class="row"' : '').'>'.$title.$boxed_cover_html_pre.'<div class="grid-description">'.$description.'</div><div class="list-description '.(($portfolio_model === 'grid' && $boxed_layout === 'true') ? 'large-7 medium-7 columns' : '').'" class-ref="7">'.$list_description.'</div>'.$boxed_cover_html_after.'</li>'.$boxed_cover_list_after;
					
					if($portfolio_model === 'list'){// && $boxed_layout !== 'true'){
						//$return = '<div class="boxed-layout boxed-colors padding columns margin-bottom">'.$return.'</div>';	
					}
				}
						
			}else{
				$return .= '<div class="large-12 columns">'.__("No data found!","quasar").'</div>';
			}
				
		$return .= '</ul>';//End of Body
					
		$return .= '<div class="clear"></div>';
			
		
		if($pagination === 'true'){
			//Footer navigation
			$return .= quasar_paging_nav();
		}
			
								
		$return .= '</div>';//End of HTML field
		
		//if($boxed_layout == "true") $return .= '</div>';

		wp_reset_query();
		wp_reset_postdata();
		
		
		//Script
		
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(document).on("click",".quasar-portfolio-header .quasar_portfolio_grid", function(){
						if(jQuery(this).attr("class").toString().indexOf("active") > -1) return;
						
						var id = jQuery(this).attr("ref");
						jQuery("#"+id+" .quasar-portfolio-body").css({"opacity":"0"});
						jQuery("#"+id+" .quasar-portfolio-header .active").removeClass("active");
						jQuery(this).addClass("active");
						
						//Add Grid class
						var ul_class = jQuery("#"+id+" .quasar-portfolio-body").attr("class-ref");
						jQuery("#"+id+" .quasar-portfolio-body").addClass(ul_class);
						
						//Add main list class to container
						if(jQuery("#"+id).hasClass("list")) jQuery("#"+id).removeClass("list");
						jQuery("#"+id).addClass("grid");
						
						jQuery("#"+id+" .quasar-portfolio-body .relative-container").unwrap();
					
						if(jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").length){
							/*
							Deprecated cause of not being compatible with responsive layout
							jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").removeClass("large-7 medium-7")
							.addClass(jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").attr("ref"));
							jQuery("#"+id+" .quasar-portfolio-body li").removeClass("row boxed-layout boxed-colors").unwrap();
							*/
							
							jQuery("#"+id+" .quasar-portfolio-body li").removeClass("row").unwrap();
							jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").removeClass("large-7 medium-7")
								.addClass("boxed-layout boxed-colors columns");
							
						}else{
							jQuery("#"+id+" .quasar-portfolio-body li").unwrap();
						}
						
						//Dispatch resize event for swiper slider
						jQuery(document).trigger("rockthemes:portfolio_resize");
						
						jQuery("#"+id+" .quasar-portfolio-body").delay(250).animate({"opacity":"1"},180);
					});
					
					jQuery(document).on("click",".quasar-portfolio-header .quasar_portfolio_list", function(){
						if(jQuery(this).attr("class").toString().indexOf("active") > -1) return;
						
						var id = jQuery(this).attr("ref");
						
						jQuery("#"+id+" .quasar-portfolio-body").css({"opacity":"0"});
						
						jQuery("#"+id+" .quasar-portfolio-header .active").removeClass("active");
						jQuery(this).addClass("active");
						
						//Remove Grid class
						var ul_class = jQuery("#"+id+" .quasar-portfolio-body").attr("class-ref");
						jQuery("#"+id+" .quasar-portfolio-body").removeClass(ul_class);
						
						//Add main list class to container
						if(jQuery("#"+id).hasClass("grid")) jQuery("#"+id).removeClass("grid");
						jQuery("#"+id).addClass("list");
						
						var img_col = 12 - parseInt(jQuery("#"+id+" .quasar-portfolio-body li:first-child").find(".list-description").attr("class-ref"))
						var boxed_extra_style = jQuery("#"+id+" .boxed_layout_holder").length > 0 ? "style=\"margin-right: 15px;\"" : "";
						boxed_extra_style = "style=\"margin-right: 15px;\"";
						jQuery("#"+id+" .quasar-portfolio-body .relative-container").wrap("<div class=\"relative-container-holder large-"+img_col+" medium-"+img_col+" columns\" "+boxed_extra_style+"></div>");
						
						if(jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").length){
							/*
							Deprecated cause of not being compatible with responsive layout
							jQuery("#"+id+" .quasar-portfolio-body li").removeClass("columns").addClass("row boxed-layout boxed-colors").wrap("<div class=\"columns margin-bottom\"></div>");
							jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").removeClass(jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").attr("ref"))
							.addClass("large-7 medium-7 columns");
							jQuery("#"+id+" .quasar-portfolio-body .list-description").removeClass("large-7 medium-7 columns").css({"padding-top":"15px"});
							*/
							
							jQuery("#"+id+" .quasar-portfolio-body li").removeClass("columns").addClass("row").wrap("<div class=\"boxed-layout boxed-colors padding columns margin-bottom\"></div>");
							jQuery("#"+id+" .quasar-portfolio-body .boxed_layout_holder").removeClass("boxed-layout boxed-colors columns");//.addClass("large-7 medium-7 columns");
							jQuery("#"+id+" .quasar-portfolio-body .list-description").removeClass("large-7 medium-7 columns");//.css({"padding-top":"15px"});
						}else{
							jQuery("#"+id+" .quasar-portfolio-body li").wrap("<div class=\"row\"></div>");
						}
						//Dispatch resize event for swiper slider
						jQuery(document).trigger("rockthemes:portfolio_resize");
						
						jQuery("#"+id+" .quasar-portfolio-body").delay(150).animate({"opacity":"1"},180);
					});
				});
			</script>
		';
		
		return $return.$script;
	}
}
add_shortcode('rockthemes_portfolio','rockthemes_shortcode_make_portfolio');
/*
**	End of Portfolio Shortcode
*/








/*
**	Generates Swiper Slider Shortcode
**	@param $postID		:	ID of the post
**	@param $image_size	:	Wordpress image size
**	@return				:	Shortcode of the swiper slider with do_shortcode function
*/
if(!function_exists('rockthemes_make_swiperslider_shortcode')){
function rockthemes_make_swiperslider_shortcode($postID,$image_size='rockthemes_thumbnail'){
	global $rockthemes_advanced_details,$not_mean;
	if(!$postID) return '';

	//Do not make a query if we have declared the advanced_details before. Performance improvement
	$rockthemes_advanced_details = $rockthemes_advanced_details ? $rockthemes_advanced_details : get_post_meta($postID,'advanced_post_details',true);
	
	$images_string = '';
	
	$featured_regular = wp_get_attachment_image_src(get_post_thumbnail_id($postID),'full');
	
	$images_string .= $featured_regular[0];
	
	if(isset($rockthemes_advanced_details['extra_featured_images']) && 
		is_array($rockthemes_advanced_details['extra_featured_images']) && 
		count($rockthemes_advanced_details['extra_featured_images']) &&
		$rockthemes_advanced_details['extra_featured_images'][0] != ''){
		$length = count($rockthemes_advanced_details['extra_featured_images']);
		$i = 0;
		//$images_string .= ',';
		$loop_images_string = '';
		foreach($rockthemes_advanced_details['extra_featured_images'] as $extra_image){
			if($extra_image == '') continue;
			$loop_images_string .= $extra_image;
			$i++;

			if($i<$length) $loop_images_string .= ',';
		}
		if($i >= 1) $images_string .= ','.$loop_images_string;// >= lately added.
	}else{
		$thumbnail = wp_get_attachment_image( get_post_thumbnail_id($postID),$image_size );
		return $thumbnail;
	}
	
	$shortcode = '[rockthemes_swiperslider images="'.$images_string.'" size="'.$image_size.'" max_width="1140px"]';

	return do_shortcode($shortcode);
}
}










//Remove the Wordpress Default Gallery Shortcode
remove_shortcode('gallery');
if(!function_exists('rockthemes_shortcode_make_wp_gallery')){
	function rockthemes_shortcode_make_wp_gallery($atts){
		global $post;
		
		extract(shortcode_atts(array(
			'orderby' 		=>	'menu_order ASC, ID ASC',
			'id'			=>	$post->ID,
			'ids'			=>	'',
			'itemtag'		=>	'dl',
			'icontag'		=>	'dt',
			'captiontag'	=>	'dd',
			'columns'		=>	3,
			'size'			=>	'medium',
			'link'			=>	'file'
		), $atts));

		$args = array(
			'post_type' => 'attachment',
			'post_parent' => $id,
			'numberposts' => -1,
			'orderby' => $orderby
			); 
		$images = get_posts($args);
		
		if(isset($GLOBALS['quasar_wp_gallery'])){
			$GLOBALS['quasar_wp_gallery']++;
		}else{
			$GLOBALS['quasar_wp_gallery'] = 1;	
		}
	 
	 	$return = '<ul class="large-block-grid-'.$columns.' rockthemes-wp-gallery">';
		
		if(!empty($ids)){
			$ids_array = explode(',',$ids);
			
			if(!xr_get_option('attach_images_in_wp_gallery', true)){
				if(count($ids_array)){
					$images = array();
				}
			}
			foreach($ids_array as $a_id){
				$images[] = get_post($a_id);
			}
		}
	 
	 	$activate_linking = xr_get_option('activate_linking_in_wp_gallery',false);
	 
		foreach ( $images as $image ) {     
			$caption = $image->post_excerpt;
	 
			$description = $image->post_content;
			$title = $image->post_title;
			if($description == '') $description = $title;
	 
			$image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
	 
			$img = wp_get_attachment_image_src($image->ID, $size);
	 
			// render your gallery here
			$return .= '
				<li><div class="relative-container rockthemes-hover"><img src="'.$img[0].'" alt="'.$image_alt.'" />'.quasar_hover_effect($image->ID,true, $activate_linking,'qwp_gallery_'.$GLOBALS['quasar_wp_gallery']).'</div>'.$caption.'</li>
			';
		}
		
		$return .= '</ul>';//Close the main ul
		
		return $return;
	}
};
add_shortcode('gallery', 'rockthemes_shortcode_make_wp_gallery');




/*
**	Google Map Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_google_map')){
	function rockthemes_shortcode_make_google_map($atts, $content=null){
		extract(shortcode_atts(array(
			'api_key'		=>	'',
			'marker_title'	=>	'',
			'lat' 			=>	'-34.397',
			'lng'			=>	'150.644',
			'zoom_level'	=>	8,
			'map_type'		=>	'ROADMAP',
			'sensor'		=>	'false',
			'height'		=>	400,
			'resize_height'	=>	'false',
		), $atts));
		
		if(isset($GLOBALS['rockthemes_googlemap'])){
			$GLOBALS['rockthemes_googlemap']++;	
		}else{
			$GLOBALS['rockthemes_googlemap'] = 0;	
		}
		$id = 'google-map-'.$GLOBALS['rockthemes_googlemap'];
				
		$content = '<p>'.$content.'</p>';
		
		$library_url = 'https://maps.googleapis.com/maps/api/js?key='.$api_key.'&sensor='.$sensor;
		//Enqueue Google Map Library with API KEY
		wp_enqueue_script('google-map', $library_url);
		
		$script = '
			<script type="text/javascript">
				var map_ratio = 1;
				function initialize_google_map() {
					var latLng = new google.maps.LatLng('.$lat.', '.$lng.');
					
					var mapOptions = {
						center: latLng,
						zoom: '.(int) $zoom_level.',
						mapTypeId: google.maps.MapTypeId.'.$map_type.',
						zoomControlOptions: {
						  style: google.maps.ZoomControlStyle.LARGE
						},
						mapTypeControl: true
					};
					
					var map = new google.maps.Map(document.getElementById("'.$id.'"), mapOptions);
					
					var contentString = "Awesome Content";
					
					var infowindow = new google.maps.InfoWindow({
						content: '.json_encode($content).'
					});					
					
					var marker = new google.maps.Marker({
						position: latLng,
						map: map,
						title:"'.$marker_title.'"
					});			
					
					google.maps.event.addListener(marker, "click", function() {
						infowindow.open(map,marker);
					});			
								
					map_ratio = jQuery("#'.$id.'").width() / '.(int) $height.';
					
				}
				
		';
		
		if($resize_height === 'true'){
			$script .= '
				jQuery(window).resize(function(){
					var that = jQuery("#'.$id.'");
					var new_height = that.width() / map_ratio;
					
					if(new_height <= '.(int) $height.'){
						that.css("height", new_height);
					}
				});
			';
		}
		
		$script .= '
				jQuery(window).load(initialize_google_map);

			</script>
		';
		
		$html = '
			<div class="rockthemes-googlemap-container">
				<div id="'.$id.'" class="rockthemes-googlemap" style="height:'.$height.'px;"></div>
			</div>	
		';
		
		return $html.$script;
	}
}


add_shortcode('rockthemes_google_map', 'rockthemes_shortcode_make_google_map');
/*
**	End of Google Map Shortcode
*/





/*
**	Promotion Box Shortcode
*/
if(!function_exists('rockthemes_shortcode_make_promotion_box')){
	function rockthemes_shortcode_make_promotion_box($atts, $content=null){		

		extract(shortcode_atts(array(
			'background_color'		=>	'#333333',
			'font_color' 			=>	'#FFFFFF',
		), $atts));
		
		$button_shortcode = '';

		if(strpos($content,'&rss;') > -1 || strpos($content,'&amp;rss;')){

			preg_match_all('/\&rss;(.*?)\&rse/',$content, $button_shortcode_array);
			if(!empty($button_shortcode_array) && !empty($button_shortcode_array[1]) && !empty($button_shortcode_array[1][0])){
				$button_shortcode = str_replace(array("&rss;","&rse;"),array("",""),$button_shortcode_array[1][0]);
				$content = substr($content,0,strpos($content,'&rss;'));
			}else{
				/*
				**	Allows direct shortcode usage from default Text Editor of Wordpress
				**	Improved for RPB (Rock Page Builder) Send Content To Text Editor button
				**
				**	Default text editor turns &rss; to &amp;rss;
				**
				**	@since	:	1.3
				*/
				$button_shortcode_array = array();
				preg_match_all('/\&amp;rss;(.*?)\&amp;rse/',$content, $button_shortcode_array);
				$button_shortcode = str_replace(array("&amp;rss;","&amp;rse;"),array("",""),$button_shortcode_array[1][0]);
				$content = substr($content,0,strpos($content,'&amp;rss;'));
			}
			
			
		}
		
		
		$return = '';
		
		$return .= '<div class="boxed-layout padding" style="background-color:'.$background_color.';">';
		
			$return .= '<div class="rock-promotion-box">';
			
				if($button_shortcode !== ''){
					$return .= '<div class="promotion-box-content" style="color:'.$font_color.';">';	
				}else{
					$return .= '<div class="promotion-box-content" style="color:'.$font_color.';">';	
				}

				
				$return .= $content;
				
				$return .= '</div>';//Content columns
				
				if($button_shortcode !== ''){
					$return .= '
						<div class="promotion-box-button">
							<div class="promotion-box-button-container">
								'.do_shortcode($button_shortcode).'
							</div>
						</div>
					';	
				}
				
			
			$return .= '</div>';//row
		
		$return .= '</div>';//boxed-layout
		
		return $return;
	}
}

add_shortcode('rockthemes_promotion_box','rockthemes_shortcode_make_promotion_box');
/*
**	End of Promotion Box Shortcode
*/








/*
**	Alert Box Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_alert_box')){
	function rockthemes_shortcode_make_alert_box($atts, $content=null){
		extract(shortcode_atts(array(
			'background_color'		=>	'',
			'font_color' 			=>	'',
			'border_color'			=>	'',
			'alertbox_style'		=>	'info',
			'icon_class'			=>	'',
			'icon_url'				=>	'',
			'use_close_button'		=>	'true',
		), $atts));
		
		$use_icon = false;
		$use_url = false;
		$icon_html = '';
		
		if($alertbox_style !== 'custom'){
			$background_color = '';
			$border_color = '';
			$font_color = '';	
		}
		
		
		if($icon_class !== ''){
			$icon_html = '<i class="'.$icon_class.' alertbox-icon padding" style="color:'.$font_color.';"></i>';
			$use_icon = true;
		}
		
		if($icon_url !== ''){
			$icon_html = '<img src="'.$icon_url.'" class="alertbox-icon-image alertbox-icon padding" />';
			$use_icon = true;	
		}
				
		$return = '';
		
		$return .= '<div class="boxed-layout padding alert-box '.$alertbox_style.'" style="background-color:'.$background_color.'; border-color:'.$border_color.';">';
		
			$return .= '<div class="rock-alert-box row">';
			
				if($use_icon){
					$return .= $icon_html;	
				}
			
			
				if($use_icon !== ''){
					$return .= '<div class="alert-box-content" style="color:'.$font_color.'">'.$content.'</div>';	
				}else{
					$return .= '<div class="alert-box-content" style="color:'.$font_color.'">'.$content.'</div>';	
				}
				
				if($use_close_button === 'true'){
					$return .= '<div class="close alert-box-close" style="color:'.$font_color.';">&times;</div>';
				}
			
			$return .= '</div>';//row
		
		$return .= '</div>';//boxed-layout
		
		$script = '';
		
		if($use_close_button === 'true'){
			if(!isset($GLOBALS['rockthemes_alertboxscriptactivated'])){
				$GLOBALS['rockthemes_portfolio_showcase'] = true;
				
				$script = '
					<script type="text/javascript">
						jQuery(document).on("click", ".alert-box-close", function(){
							jQuery(this).parent().parent().slideUp();
						});
					</script>
				';
			}
		}
		
		return $return.$script;
			
	}
}
add_shortcode('rockthemes_alert_box', 'rockthemes_shortcode_make_alert_box');

/*
**	End of Alert Box Shortcode
*/




/*
**	References Builder Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_references_builder')){
	function rockthemes_shortcode_make_references_builder($atts, $content = null){
		extract(shortcode_atts(array(
			'image_size'			=>	'medium',
			'references'			=>	'',
			'duration_time' 		=>	5000,
			'references_title'		=>	'',
			'activate_navigation'	=>	'true',
			'auto_slide'			=>	'true',
			'block_grid_large'		=>	'3',
			'block_grid_medium'		=>	'3',
			'block_grid_small'		=>	'3',
		), $atts));
		
		$block_class = ' large-block-grid-'.$block_grid_large.' medium-block-grid-'.$block_grid_medium.' small-block-grid-'.$block_grid_small.' ';
		
		$references_html = '';
		
		if($references !== ''){
			if(strpos($references,'&next;')){
				$references = explode('&next;',$references);
				
				$i = 0;
				$hide = false;
				$closed = false;
				$total_ref = count($references);
				
				$references_html .= '<div class="absolute-class" style="z-index:1;"><div class="relative-class"><ul class="'.$block_class.'">';
				foreach($references as $ref){
					$ref = explode('&,;', $ref);
					
					$html = '';
					if($ref[0] !== ''){
						
						$src = wp_get_attachment_image_src(rockthemes_get_image_id_from_url($ref[0]), $image_size);
						//$return .= '<div class="swiper-slide"><img src="'.$src[0].'" /></div>';		
						
						$html .= '<img src="'.$src[0].'" />';
					}
					
					if($ref[1] !== ''){
						$html = '<a href="'.$ref[1].'" target="_blank">'.$html.'</a>';	
					}
										
					if($html !== ''){
						$references_html .= '<li '.($hide ? 'style="margin-top:60px; opacity:0; filter: alpha(opacity=0);"' : 'style="z-index:1;"').'>'.$html.'</li>';
					}
					
					$i++;
					
					if(($i % (int) $block_grid_large) === 0){
						$references_html .= '</ul></div></div>';
						if($i < $total_ref){
							$references_html .= '<div class="absolute-class" style="display:hidden; z-index:0;"><div class="relative-class"><ul class="'.$block_class.'">';
						}else{
							$closed = true;	
						}
						$hide = true;
					}
				}
				
				if(!$closed){
					$references_html .= '</ul></div></div>';
				}
			}
				
					
		}
		
		if(isset($GLOBALS['rockthemes_referencesbuilder'])){
			$GLOBALS['rockthemes_referencesbuilder']++;
		}else{
			$GLOBALS['rockthemes_referencesbuilder'] = 0;	
		}
		
		$id_num = $GLOBALS['rockthemes_referencesbuilder'];
		
		$id = 'rock-references-builder-'.$GLOBALS['rockthemes_referencesbuilder'];
		
		$return = '';
		
		$return .= '<div id="'.$id.'" class="rock-references-builder">';
		
			$header_title = '<div class="quasar-element-responsive-header">';
		
			if($references_title !== ''){
				$header_title .= '
					<div class="quasar-element-responsive-title">
						'.$references_title.'
					</div>
				';
			}
			
			if($activate_navigation === 'true'){
				$header_title = '
					'.$header_title.'
						<div class="quasar-element-responsive-buttons">
							<div class="responsive-button references_next_button" ref="'.$id_num.'"><i class="arrow-right"></i></div>
							<div class="responsive-button references_previous_button" ref="'.$id_num.'"><i class="arrow-left "></i></div>
						</div>
				';
			}
			
			$header_title .= '
					<div class="clear"></div>
				</div>
				<br/>
			';
			
			
			$return .= $header_title;
					
							
			$return .= '<div class="rock-references-content">';
					
				$return .= $references_html;
				
			$return .= '</div>';//rock-references-content
		
		$return .= '</div>';//rock-references-builder
		
		
		
		$script = '
			<script type="text/javascript">
				jQuery(window).load(function(){
					var time = '.(int) $duration_time.', id = "'.$id.'",  timer, current_row = 0, total_in_row = '.$block_grid_large.', auto_slide = "'.($auto_slide === 'true' ? 'true' : 'false').'";
					
					var total_rows = jQuery("#"+id+" ul").length;
					if(auto_slide == "true"){
						timer = setInterval(change_references, time);
					}
											
					jQuery("#"+id+" ul").each(function(i){
						jQuery(this).css({"margin-top":"-"+jQuery(this).position().top+"px"});
					});
					
					jQuery(document).on("click", "#'.$id.' .references_previous_button", function(){
						if(auto_slide == "true"){
							clearInterval(timer);
						}
						
												
						change_references(true);
						if(auto_slide == "true"){
							timer = setInterval(change_references, time);
						}
					});
										
					jQuery(document).on("click", "#'.$id.' .references_next_button", function(){
						if(auto_slide == "true"){
							clearInterval(timer);
						}
												
						change_references();
						
						if(auto_slide == "true"){
							timer = setInterval(change_references, time);
						}
					});
										
					var first_time = false;
					function resize_references'.$id_num.'(){
						jQuery("#"+id+" .absolute-class").first().find("li").css("margin-top","0");
						var height = jQuery("#"+id+" .absolute-class").first().height();
						
						jQuery("#"+id+" .rock-references-content").css("height",height);
						if(!first_time){
							height = jQuery("#"+id+" .absolute-class").first().find("li").first().height();
							jQuery("#"+id+" .quasar-element-responsive-header").css({top: height/ 2 - 13});
							first_time = true;
						}
					}
					
					resize_references'.$id_num.'();
					
					jQuery(window).resize(resize_references'.$id_num.');
					
					function change_references(previous){
						//Hide current references
						jQuery("#"+id+" .absolute-class").eq(current_row).find("li").each(function(i){
								var that = jQuery(this);
								jQuery(this).stop(true,true).animate({"margin-top":"-30px", "opacity":"0"}, (i * 200) + 100);
						});
						
						jQuery("#"+id+" .absolute-class").eq(current_row).css({"zIndex":"0"});
						
						if(typeof previous !== "undefined" && previous === true){
							current_row--;
							
							if(current_row < 0){
								current_row = total_rows - 1;	
							}
						}else{
							current_row++;
							
							if(current_row >= total_rows){
								current_row = 0;	
							}
						}

						jQuery("#"+id+" .absolute-class").eq(current_row).css({"zIndex":"1"});
						
						
						jQuery("#"+id+" .absolute-class").eq(current_row).find("li").each(function(i){
								jQuery(this).css({"margin-top":"60px"});
								jQuery(this).stop(true,true).animate({"margin-top":"0px", "opacity":"1"}, (i * 150) + 250);
						});
					}
				});
			</script>
		';
		
		
		return $return.$script;
	}
}

add_shortcode('rockthemes_references_builder', 'rockthemes_shortcode_make_references_builder');

/*
**	End of References Builder Shortcode
*/





/*
**	Testimonials Builder Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_testimonials_builder')){
	function rockthemes_shortcode_make_testimonials_builder($atts, $content = null){
		extract( shortcode_atts( array(
			'boxed_layout'			=>	'false',
			'duration_time' 		=>	5000,
			'testimonials_title'	=>	'',
			'activate_navigation'	=>	'true',
			'auto_slide'			=>	'true',
				
		), $atts ) );	
		
		
		
		if(isset($GLOBALS['rockthemes_testimonialsbuilder'])){
			$GLOBALS['rockthemes_testimonialsbuilder']++;
		}else{
			$GLOBALS['rockthemes_testimonialsbuilder'] = 1;
		}
		
		$id_num = $GLOBALS['rockthemes_testimonialsbuilder'];
				
		$id = 'rock-testimonialsbuilder-'.$GLOBALS['rockthemes_testimonialsbuilder'];
				
		$testimonialsbuilder_single_data = do_shortcode($content);
				
		$GLOBALS['rockthemes_testimonialsbuilder_first_single'] = false;
		
		$return = '';
		
		
		$return .= '<div id="'.$id.'" class="testimonials-builder-container">';
		
		if($boxed_layout == "true"){ $return .= '<div class="boxed-layout padding">';}
		
			$header_title = '<div class="quasar-element-responsive-header">';
		
			if($testimonials_title !== ''){
				$header_title .= '
					<div class="quasar-element-responsive-title">
						'.$testimonials_title.'
					</div>
				';
			}
			
			if($activate_navigation === 'true'){
				$header_title = '
					'.$header_title.'
						<div class="quasar-element-responsive-buttons">
							<div class="responsive-button testimonials_next_button" ref="'.$id_num.'"><i class="arrow-right"></i></div>
							<div class="responsive-button testimonials_previous_button" ref="'.$id_num.'"><i class="arrow-left "></i></div>
						</div>
				';
			}
			
			$header_title .= '
					<div class="clear"></div>
				</div>
			';
			
			
			$return .= $header_title;
					
							
			$return .= '<div class="rock-testimonials-content">';
					
				$return .= $testimonialsbuilder_single_data;
				
			$return .= '</div>';//rock-references-content
			
		if($boxed_layout == "true"){ $return .= '</div>';}
		
		$return .= '</div>';//rock-references-builder


		
		
		$script = '
		<script type="text/javascript">
			jQuery(document).ready(function(){
					var time = '.(int) $duration_time.', id = "'.$id.'",  timer, current_row = 0, auto_slide = "'.($auto_slide === 'true' ? 'true' : 'false').'";
					
					var total_rows = jQuery("#"+id+" .absolute-class").length;
					if(auto_slide == "true"){
						timer = setInterval(change_testimonials, time);
					}
											
					jQuery("#"+id+" ul").each(function(i){
						jQuery(this).css({"margin-top":"-"+jQuery(this).position().top+"px"});
					});
					
					jQuery(document).on("click", "#'.$id.' .testimonials_previous_button", function(){
						if(auto_slide == "true"){
							clearInterval(timer);
						}
						
												
						change_testimonials(true);
						if(auto_slide == "true"){
							timer = setInterval(change_testimonials, time);
						}
					});
										
					jQuery(document).on("click", "#'.$id.' .testimonials_next_button", function(){
						
						if(auto_slide == "true"){
							clearInterval(timer);
						}
												
						change_testimonials();
						
						if(auto_slide == "true"){
							timer = setInterval(change_testimonials, time);
						}
					});
										
					var first_time = false;
					function resize_testimonials'.$id_num.'(){
						jQuery("#"+id+" .absolute-class").first().css("margin-top","0");
						var height = 0;
						jQuery("#"+id+" .absolute-class").each(function(){
							if(height < jQuery(this).height()){
								height = jQuery(this).height();	
							}
						});
						
						jQuery("#"+id+" .rock-testimonials-content").css("height",height);
						if(!first_time){
							height = jQuery("#"+id+" .absolute-class").first().height();
							jQuery("#"+id+" .quasar-element-responsive-header").css({top: height/ 2 - 23});
							first_time = true;
						}
						
					}
					
					resize_testimonials'.$id_num.'();
					
					jQuery(window).resize(resize_testimonials'.$id_num.');
					
					function change_testimonials(previous){
						//Hide current references
						jQuery("#"+id+" .absolute-class").eq(current_row).stop(true,true).animate({"margin-top":"-30px", "opacity":"0"}, 400);
						
						jQuery("#"+id+" .absolute-class").eq(current_row).css({"zIndex":"0"});
						
						if(typeof previous !== "undefined" && previous === true){
							current_row--;
							
							if(current_row < 0){
								current_row = total_rows - 1;	
							}
						}else{
							current_row++;
							
							if(current_row >= total_rows){
								current_row = 0;	
							}
						}

						jQuery("#"+id+" .absolute-class").eq(current_row).css({"zIndex":"1", "margin-top":"60px"});
						
						
						jQuery("#"+id+" .absolute-class").eq(current_row).stop(true,true).animate({"margin-top":"0px", "opacity":"1"}, 400);
					}
		';
		
				
		$script .='
			});
		</script>
		';
		
		return $return.$script;		
	}
	
}

add_shortcode("rockthemes_testimonials_builder", "rockthemes_shortcode_make_testimonials_builder");


if(!function_exists('rockthemes_shortcode_make_testimonials_builder_single')){
	function rockthemes_shortcode_make_testimonials_builder_single($atts, $content = null){	
		extract( shortcode_atts( array(
				'name'			=>	'',
				'company'		=>	'',
		), $atts ) );
		
		
		$ref_id = 'testimonialsbuilder-'.$GLOBALS['rockthemes_testimonialsbuilder'];
		
		$return = '';
		
		
		if(!isset($GLOBALS['rockthemes_testimonialsbuilder_first_single']) || !$GLOBALS['rockthemes_testimonialsbuilder_first_single']){
			$return .= '<div class="absolute-class" style="z-index:1; display:block;"><div class="relative-class">';
			$GLOBALS['rockthemes_testimonialsbuilder_first_single'] = true;
		}else{
			$return .= '<div class="absolute-class" style="opacity:0; filter:alpha(opacity=0); z-index:0; display:block;"><div class="relative-class">';
		}
		
		
		$return .= '<div class="rock-testimonials-single testimonials-quotes">';
		
			$return .= '<div class="testimonials-content">';
						
				$return .= $content;
			
			$return .= '</div>';
			
			$return .= '<div class="testimonials-details">';
			
				if($name !== ''){
					$return .= '<strong> '.$name.'</strong> ';	
				}
				
				if($company !== ''){
					$return .= '<span class="testimonials-soft-color">'.$company.'</span>';	
				}
			
			$return .= '</div>';
		
		$return .= '</div>';
		
		$return .= '</div></div>';

		return $return;
	}
}

add_shortcode("rockthemes_testimonials_builder_single", "rockthemes_shortcode_make_testimonials_builder_single");

/*
**	End of Testimonials Builder Shortcode
*/






/*
**	Social Icons Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_social_icons')){
	function rockthemes_shortcode_make_social_icons($atts, $content = null){
		extract( shortcode_atts( array(
			'boxed_layout'			=>	'false',
			'duration_time' 		=>	5000,
			'testimonials_title'	=>	'',
			'activate_navigation'	=>	'true',
			'auto_slide'			=>	'true',
				
		), $atts ) );	
		
		
		if(isset($GLOBALS['rockthemes_socialicons'])){
			$GLOBALS['rockthemes_socialicons']++;
		}else{
			$GLOBALS['rockthemes_socialicons'] = 1;
			
			
		}
		
		$id_num = $GLOBALS['rockthemes_socialicons'];
				
		$id = 'rock-social-icons-'.$GLOBALS['rockthemes_socialicons'];
				
		$socialicons_single_data = do_shortcode($content);
				
		
		$return = '';
		
		
		$return .= '<div id="'.$id.'" class="social-icon icon-group-container">';
											
				$return .= $socialicons_single_data;
				
				$return .= '<div class="clear"></div>';
									
		$return .= '</div>';//rock-references-builder
		
				
		return $return;
	}
	
}

add_shortcode("rockthemes_social_icons", "rockthemes_shortcode_make_social_icons");


if(!function_exists('rockthemes_shortcode_make_social_icons_single')){
	function rockthemes_shortcode_make_social_icons_single($atts, $content = null){	
		extract( shortcode_atts( array(
			'url'				=>	'',
			'icon_class'		=>	'',
			'icon_url'			=>	'',				
		), $atts ) );
		
		
		$use_icon = false;
		$use_url = false;
		$icon_html = '';
		$icon_hover_html = '';
		
		if($icon_class !== ''){
			$icon_html = '<i class="'.$icon_class.' social-icon-regular"></i>';
			$icon_hover_html = '<i class="'.$icon_class.' social-icon-hover"></i>';
			$use_icon = true;
		}
		
		if($icon_url !== ''){
			$icon_html = '<img src="'.$icon_url.'"  />';
			$use_icon = true;	
		}
		
		
		$ref_id = 'social-icon-'.$GLOBALS['rockthemes_socialicons'];
		
		$return = '';
		
		$return .= '<div class="rock-social-icon">';
		
			$return .= '<a href="'.$url.'" target="_blank">';
		
				$return .= '<div class="social-icon-container">';
			
					$return .= $icon_html.$icon_hover_html;
			
				$return .= '</div>';
			
			$return .= '</a>';
		
		$return .= '</div>';

		return $return;
	}
}

add_shortcode("rockthemes_social_icons_single", "rockthemes_shortcode_make_social_icons_single");

/*
**	End of Social Icons
*/





/*
**	Team Members Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_team_members')){
	function rockthemes_shortcode_make_team_members($atts, $content = null){
		extract( shortcode_atts( array(
			'teammembers_title'	=>	'',
			'selected_columns'		=>	4,
		), $atts ) );	

		
		if(isset($GLOBALS['rockthemes_teammembers'])){
			$GLOBALS['rockthemes_teammembers']++;
		}else{
			$GLOBALS['rockthemes_teammembers'] = 1;
			
			
		}
		
		$id_num = $GLOBALS['rockthemes_teammembers'];
				
		$id = 'team-members-icons-'.$GLOBALS['rockthemes_teammembers'];
		
		$GLOBALS['rockthemes_teammembers_group'] = array();
				
		do_shortcode($content);
		
		$team_members_data = '<div class="row">';
		$total_cols = 0;
		foreach($GLOBALS['rockthemes_teammembers_group'] as $member){
			$team_members_data .= '<div class="large-'.$selected_columns.' columns">'.$member.'</div>';
			
			$total_cols += (int) $selected_columns;
			
			if($total_cols >= 12){
				$total_cols = 0;
				$team_members_data .= '</div><div class="row">';	
			}
		}
		
		if($total_cols < 12){
			$team_members_data .= '<div class="large-'.(12 - $total_cols).' columns"></div>';
		}
		
		$team_members_data .= '</div>';
		
		$return = '';
		
		
		$return .= '<div id="'.$id.'">';
		
			if($teammembers_title !== ''){
				$return .= '<h3>'.$teammembers_title.'</h3>';	
			}
		
											
				$return .= $team_members_data;
								
			
			$return .= '<div class="row team-member-content-row">';
			
				$return .= '<div class="large-12 columns"><div class="team-member-content boxed-layout boxed-colors"></div></div>';
		
			$return .= '</div>';
				
				$return .= '<div class="clear"></div>';
									
		$return .= '</div>';//rock-references-builder
		
		
		return $return;
	}
	
}

add_shortcode("rockthemes_team_members", "rockthemes_shortcode_make_team_members");


if(!function_exists('rockthemes_shortcode_make_team_members_single')){
	function rockthemes_shortcode_make_team_members_single($atts, $content = null){	
		extract( shortcode_atts( array(
			'name'					=>	'',
			'company'				=>	'',
			'external_url'			=>	'',
			'member_image_url'		=>	'',
			'social_icons_title'	=>	'',
		), $atts ) );
		
				
		
		$social_shortcode = '';
		
		if(strpos($content,'&rss;') > -1 || strpos($content,'&amp;rss;') > -1){

			preg_match_all('/\&rss;(.*?)\&rse/',$content, $social_shortcode_array);
			if(!empty($social_shortcode_array) || !empty($social_shortcode_array[1]) || !empty($social_shortcode_array[1][0])){
				$social_shortcode = str_replace(array("&rss;","&rse;"),array("",""),$social_shortcode_array[1][0]);
				$content = substr($content,0,strpos($content,'&rss;'));
			}else{
				/*
				**	Allows direct shortcode usage from default Text Editor of Wordpress
				**	Improved for RPB (Rock Page Builder) Send Content To Text Editor button
				**
				**	Default text editor turns &rss; to &amp;rss;
				**
				**	@since	:	1.3
				*/
				$social_shortcode_array = array();
				preg_match_all('/\&amp;rss;(.*?)\&amp;rse/',$content, $social_shortcode_array);
				$social_shortcode = str_replace(array("&amp;rss;","&amp;rse;"),array("",""),$social_shortcode_array[1][0]);
				$content = substr($content,0,strpos($content,'&amp;rss;'));
			}
			
			
		}
		
		
		$ref_id = 'social-icon-'.$GLOBALS['rockthemes_teammembers'];
		
		$return = '<div class="team-member-article article-margin-bottom boxed-layout boxed-colors">';
		
			$return .= '	
				<a  class="escapea" href="#" data-cat="news" data-state="vic">  
					<img src="'.$member_image_url.'"> 
					<div class="padding">
						<span class="team-member-i main-color">'.$company.'</span>
						<div class="member-b main-boxed-text-color">'.$name.'</div>
					</div>
				</a>
			';
			
			$return .= '<div class="member-details">';
			
				$return .= '
					<img src="'.$member_image_url.'"></img>
					<a class="member-url" href="'.$external_url.'" target="_blank">'.$external_url.'</a>
					<div class="member-b main-boxed-text-color">'.$name.'</div>
					<span class="team-member-i">'.$company.'</span>
				';
				
				$return .= '<div class="details">';
				
					$return .= '<div class="bio main-boxed-text-color">';
					
						$return .= $content;
	
					$return .= '</div>';
					
					
					$return .= '<div class="team-member-social">';
					
					if($social_shortcode !== ''){
						$return .= '<div class="member-b main-boxed-text-color">'.$social_icons_title.'</div>';
					
						$return .= do_shortcode($social_shortcode);
					}
					
					$return .= '</div>';
					
				$return .= '</div>';
					
			$return .= '</div>';
			
		$return .= '</div>';


		$GLOBALS['rockthemes_teammembers_group'][] = $return;
		
		return;
	}
}

add_shortcode("rockthemes_team_members_single", "rockthemes_shortcode_make_team_members_single");

/*
**	End of Team Members
*/





/*
**	Before After Slider
*/

if(!function_exists('rockthemes_shortcode_make_before_after_slider')){
	function rockthemes_shortcode_make_before_after_slider($atts, $content=null){
		extract(shortcode_atts(array(
			'image_size'			=>	'large',
			'before_image_url' 		=>	'',
			'after_image_url'		=>	'',
			'height'				=>	'info',
			'min_width'				=>	'',
			'activate_navigation'	=>	''
		), $atts));
		

		wp_enqueue_style( 'zurb-twenty-twenty-style', F_WAY.'/css/twentytwenty.css', '', '', 'all' );

		wp_enqueue_script('jquery-event-move', F_WAY.'/js/jquery.event.move.min.js', array('jquery'), '');
		wp_enqueue_script('zurb-twenty-twenty', F_WAY.'/js/jquery.twentytwenty.min.js', array('jquery'), '');
		
		if(isset($GLOBALS['rockthemes_beforeafterslider'])){
			$GLOBALS['rockthemes_beforeafterslider']++;
		}else{
			$GLOBALS['rockthemes_beforeafterslider'] = 0;	
		}

		$id = 'rockthemes-before-after-slider-'.$GLOBALS['rockthemes_beforeafterslider'];
				
		$return = '';
		
		$return .= '<div id="'.$id.'" class="rockthemes-before-after-slider twentytwenty-container">';

			$before_image = wp_get_attachment_image_src(rockthemes_get_image_id_from_url($before_image_url), $image_size);
			
			$after_image = wp_get_attachment_image_src(rockthemes_get_image_id_from_url($after_image_url), $image_size);
			
			$return .= '<img src="'.$before_image[0].'" />';
		
			$return .= '<img src="'.$after_image[0].'" />';

		$return .= '</div>';//boxed-layout
		
		$script = '';
						
		$script = '
			<script type="text/javascript">
				jQuery(window).load(function(){
					jQuery("#'.$id.'").twentytwenty({default_offset_pct: 0.60});
				});
			</script>
		';
						
		return $return.$script;
			
	}
}
add_shortcode('rockthemes_before_after_slider', 'rockthemes_shortcode_make_before_after_slider');

/*
**	End of Alert Box Shortcode
*/





/*
**	Rockthemes Default Blog Shortcode on TinyMCE
**	
**	Displays blogroll just like regular blog. Sticky posts will be displayed as first
**	
*/

if(!function_exists('rockthemes_shortcode_make_regular_blog')){
	function rockthemes_shortcode_make_regular_blog($atts, $content = null){
		/*
		$atts['regular_content'] = 'false';
		$atts['image_size'] = 'thumbnail';
		$atts['hover_active'] = 'false';
		$atts['image_col'] = '3';
		$atts['excerpt_length'] = 30;
		$atts['header_link'] = 'true';
		$atts['show_categories'] = 'true';
		$atts['show_tags'] = 'true';
		$atts['show_date'] = 'true';
		$atts['space_height'] = '15px';
		*/
		extract( shortcode_atts( array(
			'pagination'		=>	'true',
			'total'				=>	5,
			'sticky_first'		=>	'false',
			'regular_content'	=>	'true',
			'image_size'		=>	'thumbnail',
			'hover_active'		=>	'true',
			'image_col'			=>	4,
			'excerpt_length'	=>	30,
			'header_link'		=>	'true',
			'show_categories'	=>	'true',
			'show_tags'			=>	'true',
			'show_date'			=>	'true',
			'space_height'		=>	'45px',
		), $atts ) );
		
		
		global $more;		
				
		$total = (int) $total;
				
		$return = '';
		
		if($sticky_first === 'true'){
			
		
			$sticky = get_option('sticky_posts');
			
			if(count($sticky)) :
			$sticky_query = new WP_Query( 'p=' . $sticky[0].'&posts_per_page='.$total);	
			
			while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); 
				$more = 0;
				
				if($regular_content === 'true'){
					ob_start();
					get_template_part( 'content', get_post_format() );
					$return .= ob_get_clean();
					
					$return .= '
					<div class="clear"></div>
					<div class="vertical-space"></div>
					<hr />
					<div class="vertical-space"></div>
					';
				}else{
					$return .= rockthemes_display_posts_basic($atts, false);	
				}
				
				$total = $total - 1;
				
			endwhile; 
			endif; //Count Sticky
			
			wp_reset_postdata();
		}
		
		wp_reset_query();
		
		if(get_query_var('paged')){
			//Works for the pages called from index.php
			$paged = get_query_var('paged');	
		}elseif(get_query_var('page')){
			//Works for the shortcodes
			$paged = get_query_var('page');	
		}else{
			$paged = 1;	
		}
		
		
		$args = array(
			'posts_per_page' => $total,
			'ignore_sticky_posts' => 1,
			'paged' => $paged,
		);
		
		if($sticky_first === 'true'){
			$args['post__not_in'] = array($sticky);
		}
		
		$normal_query = query_posts($args);

		if(count($normal_query)){
			foreach($normal_query as $single_query):
				global $post;
				$post = $single_query;
				setup_postdata($post);
				$more = 0;
				
				if($regular_content === 'true'){
					ob_start();
					get_template_part( 'content', get_post_format() );
					$return .= ob_get_clean();
					
					$return .= '
					<div class="clear"></div>
					<div class="vertical-space"></div>
					<hr />
					<div class="vertical-space"></div>
					';
				}else{
					$return .= rockthemes_display_posts_basic($atts, false);	
				}
				
			endforeach;	
			
		}
		/*
		while ( $super_query->have_posts() ) : $super_query->the_post();

		endwhile; 
		*/
		
		if($pagination === 'true'){
			$return .= quasar_paging_nav(false);
		}
		
		wp_reset_postdata();
        wp_reset_query();
        
		return $return;
		
	}
}

add_shortcode("rockthemes_regular_blog", "rockthemes_shortcode_make_regular_blog");


if(!function_exists('rockthemes_display_posts_basic')):
/*
**	Displays the posts with the given details. This will not make any difference for
**	different post types. 
**
**	@global	:	$post	Object	Default post object
**	@param	:	$attr	[Array]	An array of displaying details
**	@param	:	$echo	Boolean	Echo the output or not
**
**	@return	:	Returns an HTML element of the current post
*/
function rockthemes_display_posts_basic($atts, $echo = false){
	global $post;
	if(!isset($post) || !$post)	return; //Return if no $post defined
	
	extract($atts);
	
	$image_col = (int) $image_col;
	$excerpt_length = (int) $excerpt_length;
	
	$return = '';
	
	$image = quasar_get_featured_image(false, $image_size, $hover_active === 'true' ? true : false);
	
	$content_col = 12 - $image_col;
	
	if($content_col === 0 ) $content_col = 12;
	
	
	$title = '<strong>'.get_the_title().'</strong>';
	
	if($header_link === 'true'){
		$title = '<a href="'.get_permalink().'"	>'.$title.'</a>';
	}
	
	$sticky_html = '';
	if ( is_sticky() && ! is_paged() ){
		//$sticky_html .= '<span class="featured-post">' . __( 'Sticky', 'quasar' ) . '</span>';
		//Temporarily disabled for design
	}
	
	$category_html = '';
	if($show_categories === 'true'){
		$categories_list = get_the_category_list( __( ', ', 'quasar' ) );
		if ( $categories_list ) {
			$category_html .= '<span class="categories-links">' . $categories_list . '</span>';
		}
	}

	$tags_html = '';
	if($show_tags === 'true'){
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'quasar' ) );
		if ( $tag_list ) {
			$tags_html .= '<span class="tags-links">' . $tag_list . '</span>';
		}
	}
	
	$date_html = '';
	if($show_date === 'true'){
		$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' ): '%2$s';
	
		$date_html = sprintf( '<small class="date"><time class="entry-date" datetime="%1$s">%2$s</time></small>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);		
		
		$date_html .= '<br/><br/>';
	}

	
	if($category_html !== '' || $tags_html !== '' || $sticky_html !== '') $tags_html .= '<br/><br/>';
	
	$return .= '
	
		<div class="rockthemes-blog-basic">
			<div class="row">
	';
	
	if($image){
				$return .= '
				<div class="large-'.$image_col.' columns">
					'.$image.'
				</div>
				<div class="large-'.$content_col.' columns">
				';
	}else{
				$return .= '
				<div class="large-'.$content_col.' columns">
				';
	}
	
	$return .= '
					<h4>'.$title.'</h4>
					'.$date_html.'
					'.$sticky_html.'
					'.$category_html.'
					'.$tags_html.'
					<div>
						'.rock_check_p((rockthemes_excerpt(get_the_excerpt(),$excerpt_length))).'
					</div>
				</div>
			</div>
			<div style="position:relative; display:block; width:100%; height:'.$space_height.'"></div>
		</div>
	';
	
	if(!$echo) return $return;
	echo $return;
}
endif;


/*
**	End of Rockthemes Default Blog Shortcode
*/







/*
**	Gallery Shortcode
*/

if(!function_exists('rockthemes_shortcode_make_gallery')){
	function rockthemes_shortcode_make_gallery($atts,$content=null){
		global $paged;
		//wp_reset_query();
		//wp_reset_postdata();
		/*
		$atts['masonry'] = 'true';
		*/
		$atts['use_swiper_for_thumbnails'] = 'false';
		$atts['offset']	= 0;
		
		extract( shortcode_atts( array(
				'post_type'					=>	'post',
				'category'					=>	'all',
				'masonry'					=>	'false',
				'load_more'					=>	'false',
				'lightbox_gallery'			=>	'false',
				'excerpt_title_option'		=>	'no_description',
				'excerpt_length'			=>	18,
				'block_grid_large'			=>	'3',
				'block_grid_medium'			=>	'3',
				'block_grid_small'			=>	'3',
				'total'						=>	'9',
				'activate_hover_box'		=>	'true',
				'activate_hover'			=>	'false',
				'disable_hover_link'		=>	'false',
				'small_thumb_hover'			=>	'false',
				'boxed_layout'				=>	'false',
				'image_size'				=>	'medium',
				'pagination'				=>	'true',
				'portfolio_model'			=>	'grid',
				'portfolio_model_switch'	=>	'true',
				'activate_category_link'	=>	'true',
				'header_title'				=>	'',
				'activate_header_link'		=>	'true',
				'use_shadow'				=>	'true',
				'use_swiper_for_thumbnails'	=>	'true'
		), $atts ) );	
		
		if($post_type === 'no-selected') return;
		
		if($masonry === 'true'){
			wp_enqueue_script('images-loaded', F_WAY.'/js/imagesloaded.pkgd.min.js', array('jquery'));
			wp_enqueue_script( 'jquery-masonry' );
		}
		
		if(isset($GLOBALS['rockthemes_gallery'])){
			$GLOBALS['rockthemes_gallery']++;
		}else{
			$GLOBALS['rockthemes_gallery'] = 1;	
		}
		
		$id = "quasar-portfolio-".$GLOBALS['rockthemes_gallery'];
		$atts['id'] = $id;
		
		$return = '';
		
		
		$return .= rockthemes_gallery_load_more($atts);
		
		//if($boxed_layout == "true") $return .= '</div>';

		wp_reset_query();
		wp_reset_postdata();
		
		
		$script = '';
		if($masonry === 'true'):
		$script = '
			<script type="text/javascript">
				jQuery(window).load(function(){

					function resize_portfolio_masonry'.$GLOBALS['rockthemes_gallery'].'(){
						var blocks_large_medium_small = parseInt('.$block_grid_large.');
						if(jQuery(window).width() < 768){
							blocks_large_medium_small = parseInt('.$block_grid_medium.');
						}
						if(jQuery(window).width() <= 540){
							blocks_large_medium_small = parseInt('.$block_grid_small.');
						}
						
						
						jQuery("#'.$id.' .quasar-portfolio-body").css("width","100%").css({width:parseInt(jQuery("#'.$id.' .quasar-portfolio-body").width().toString().replace("px",""))+"px"});
						var elem_width = parseInt(parseInt(jQuery("#'.$id.' .quasar-portfolio-body").width()) / blocks_large_medium_small);
						jQuery("#'.$id.' .quasar-portfolio-body > li").css({width:elem_width+"px"});
						jQuery("#'.$id.' .quasar-portfolio-body").masonry({columnWidth: elem_width, isAnimated:false});
						jQuery("#'.$id.' .quasar-portfolio-body > li").each(function(t){
							var that = jQuery(this);
							setTimeout(function(){
								that.addClass("animated fadeIn");
							}, (t * 180));
						});
						
						'.(($lightbox_gallery === 'true') ?	'jQuery("#'.$id.' a[rel^=\"prettyPhoto\"]").attr("rel", "prettyPhoto[\"'.$id.'\"]");' : '').'
					}
					
					resize_portfolio_masonry'.$GLOBALS['rockthemes_gallery'].'();
					
					jQuery(window).resize(resize_portfolio_masonry'.$GLOBALS['rockthemes_gallery'].');
		';
		
				
		$total = (int) $total - 1;
		
		if($total <= 0) $total = 0;
		
		if($load_more === 'true'){
			$load_more_html = '
				<div class="vertical-space-half"></div>
				<div class="large-3 large-centered columns">
				<div class="load_more_button" data-current-total="'.$total.'" data-bind="'.$id.'">'.__('Load More', 'quasar').'</div>
				</div>
			';	
			
			$script .= '
				jQuery(document).on("click", ".load_more_button", function(){
					if(jQuery(this).parent().find(".loader-row").length) return;
					
					var total_post_query = jQuery("#"+jQuery(this).attr("data-bind")).find(".total-posts-number-holder").attr("data-query-total");
					
					var data = '.json_encode($atts).';

					
					var this_button = jQuery(this);
					
					this_button.before("<div class=\"row loader-row animated fadeInDown\"><span class=\"text-center\"><div class=\"loader-gif\"><img src=\"'.F_WAY.'/images/loader.gif'.'\"  /></div></span></div>");
					this_button.addClass("animated fadeOutDown");
					data.offset = parseInt(this_button.attr("data-current-total")) + 1;
					data.id = "'.$id.'";
					
				  	var rockthemes_gallery_lm_nonce = "'.(esc_js(wp_create_nonce('rockthemes_gallery_lm_nonce'))).'";

					jQuery.post(rockthemes.ajaxurl, {action:"rockthemes_gallery_load_more", _ajax_nonce:rockthemes_gallery_lm_nonce, data:data, ajaxnonce:rockthemes.ajax_nonce}, function(data){

						if(data && data.toString().indexOf("No data") < 0){
							var j_data = jQuery(data);
							
							var old_last = jQuery("#'.$id.' .quasar-portfolio-body > li").length;
							var current_width = jQuery("#'.$id.' .quasar-portfolio-body > li").first().css("width");
							
							
							jQuery("#'.$id.' .quasar-portfolio-body").append(j_data);
							
							jQuery("#'.$id.' .quasar-portfolio-body").imagesLoaded(function(){
							
							jQuery("#'.$id.' .quasar-portfolio-body > li").each(function(i){
								if(i < old_last) return;
								
								var time = parseInt(i - old_last -1) * 180 + 300;
								var anim_elem = jQuery(this);
								anim_elem.css("width", current_width);
								
								setTimeout(function(){
									anim_elem.addClass("animated fadeIn");
								}, time);

							});
							
							
							
							jQuery("#'.$id.' .quasar-portfolio-body").masonry("appended", j_data);
							this_button.attr("data-current-total", parseInt(jQuery("#'.$id.' .quasar-portfolio-body > li").length) - 1);
							this_button.parent().find(".loader-row").remove();
							
							if(parseInt(jQuery("#'.$id.' .quasar-portfolio-body > li").length) < total_post_query){
								this_button.removeClass("fadeOutDown").addClass("fadeInDown");
							}else{
								this_button.remove();
							}
							'.(($lightbox_gallery === 'true') ?	'jQuery("#'.$id.' a[rel^=\"prettyPhoto\"]").attr("rel", "prettyPhoto[\"'.$id.'\"]");' : '').'
							jQuery("a[rel^=\"prettyPhoto\"]").prettyPhoto();
							
							});

						}else if(data && data.toString().indexOf("No data") > -1){
							this_button.parent().find(".loader-row").remove();
						}
					});
				});
			';
			
			$return .= $load_more_html;
		}
		
		$script .= '
						});
			</script>
		';
		
		endif;//Check if masonry active
		
		return $return.$script;
	}
}
add_shortcode('rockthemes_gallery','rockthemes_shortcode_make_gallery');


/*
**	Load More ajax function of gallery
**
*/
if(!function_exists('rockthemes_gallery_load_more')):
	function rockthemes_gallery_load_more($atts){
		if(!isset($atts)) return;
		
		global $paged;
		
		extract($atts);
	
		//Hover Details for the image
		$hover_obj = array(
				'activate_hover_box'	=>	sanitize_text_field($activate_hover_box),
				'activate_hover'		=>	sanitize_text_field($activate_hover),
				'disable_hover_link'	=>	sanitize_text_field($disable_hover_link),
				'small_thumb_hover'		=>	sanitize_text_field($small_thumb_hover),
		);

		//Columns Class		
		$block_class = ' large-block-grid-'.esc_attr($block_grid_large).' medium-block-grid-'.esc_attr($block_grid_medium).' small-block-grid-'.esc_attr($block_grid_small).' ';
		if($masonry === 'true') $block_class .= ' rockthemes-masonry ';
		
		//Only one hover effect can be used
		if($activate_hover_box === 'true') $activate_hover = 'false';

		
		
		//$id = "quasar-portfolio-".$GLOBALS['rockthemes_gallery'];
		$post_is_tax = false;

		$tax_list = get_object_taxonomies(sanitize_text_field($post_type));//get_object_taxonomies
		$post_tax;
		foreach($tax_list as $tax){
			if(strpos($tax,'cat') > -1){
				$post_tax = $tax;
				break;
			}
		}

		
		if(get_query_var('paged')){
			//Works for the pages called from index.php
			$paged = get_query_var('paged');	
		}elseif(get_query_var('page')){
			//Works for the shortcodes
			$paged = get_query_var('page');	
		}else{
			$paged = 1;	
		}
		//$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$posts = array();
		if($post_type === 'post'){
			$posts = query_posts(array('category_name'=> esc_attr($category), 'posts_per_page'=> (int) $total, 'offset'=> (int) $offset, 'paged'=>$paged));
		}
									
		if(!count($posts)){
			$args = array(
				'post_type'			=>	sanitize_text_field($post_type),
				esc_attr($post_tax)	=>	esc_attr($category),
				'posts_per_page'	=>	(int)$total,
				'offset'			=>	(int) $offset,
				'paged'				=>	$paged
			);
					
			$posts = query_posts($args);
			$post_is_tax = true;
		}
		
		$return = '';
				
		//if($boxed_layout == "true") $return .= '<div class="boxed-layout boxed-colors quasar-portfolio padding-2x">';
		
		$return .= '<div id="'.$id.'" class="quasar-portfolio-container grid '.($use_shadow === 'true' ? 'use-shadow' : '').' '.($boxed_layout === 'true' ? 'boxed_layout_holder' : '').'">';
			
			if($header_title != ''){
				//Header for hybrid layout - Grid and List
				$return .= '<div class="quasar-portfolio-header">';
				
				if($header_title != ''){
					$return .= '<div class="quasar-portfolio-main-title">'.sanitize_text_field($header_title).'</div>';
				}
				
				
				$return .= '<div class="clear"></div>
					</div>
					<br/>
				';
			}
			
			//Body
			$return .= '<ul class="quasar-portfolio-body '.$block_class.'" class-ref="'.$block_class.'">';
			
			if(isset($is_ajax) && $is_ajax === 'true') $return = '';
				
			if(sizeof($posts)>0){

				$count_columns = 1;
				
				foreach($posts as $post_object){
					global $post, $rockthemes_advanced_details;
					$post = $post_object;
					setup_postdata($post);

					$rockthemes_advanced_details = get_post_meta($post->ID,'advanced_post_details',true);

					$cat_list = wp_get_post_terms($post->ID,$post_tax);

					$link_html = '';
					$total_cat = count($cat_list);
					$c = 0;
					foreach($cat_list as $cat){
						$tax = get_category_by_slug($cat->slug);
						if(!$tax){
							$tax = get_term_link($cat->slug,$post_tax);	
						}else{
							$tax = get_category_link($post_tax);
						}
						$link_html .= '<a href="'.$tax.'">'.$cat->name.'</a>';
						$c++;
						if($c < $total_cat) $link_html .= ', ';
					}
					
					$featuredBig = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'ajax-filtered-hover');
					if($featuredBig){ $featuredBig = $featuredBig[0];}else{
						$featuredBig = (wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) && !$featuredBig) ? wp_get_attachment_url( get_post_thumbnail_id($post->ID) ): 'no-image';
					}
					
					$thumbnail = wp_get_attachment_image( get_post_thumbnail_id($post->ID),$image_size );
					
					$title = $thumbnail ? $thumbnail : $post->post_title;
					
					if($use_swiper_for_thumbnails === 'true'){
						$title = (rockthemes_make_swiperslider_shortcode($post->ID,$image_size));
					}
						
					$link = get_post_permalink($post->ID);
					
					$excerpt = rock_check_p($post->post_excerpt);
					$product_price= '';
					if(get_post_meta( $post->ID, '_sale_price',true) != '' && rockthemes_woocommerce_active()){
						$product_price = woocommerce_price(get_post_meta( $post->ID, '_sale_price',true));
						$excerpt = '<div class="remove-foundation-padding"><div class="large-9 columns">'.rock_check_p($post->post_excerpt).'</div><div class="price-holder large-3 columns right-text">'.$product_price.'</div></div>';
					}
						
					if($link != '' && $activate_hover != 'true'){
						$title = '<div class="relative-container rockthemes-hover"><a href="'.esc_url($link).'">'.$title.'</a></div>';
					}
						
					if($activate_hover == 'true'){
						$hover_effect = quasar_hover_effect($post->ID,($use_shadow === 'true' ? true : false), ($disable_hover_link !== 'false' ? false : true), 'gallery_'.$GLOBALS['rockthemes_gallery']);
							
						$title = '<div class="relative-container rockthemes-hover">'.$title.$hover_effect.'</div>';
					}
					
						
					$description = '';
					$list_description = '';
					
					$desc_details = explode('_',$excerpt_title_option);
					
					$desc_details_price_active = false;
					if(strpos($excerpt_title_option,'price') > -1) $desc_details_price_active = true;
						
					$desc_details_excerpt_active = false;
					if(strpos($excerpt_title_option,'price') > -1) $desc_details_excerpt_active = true;
					
					if($excerpt_title_option != "no_description"){
												
						
						foreach($desc_details as $detail){
							switch($detail){
								case 'title':
								if($activate_header_link === 'false'){
									$description .= '<p class="quasar-portfolio-title">'.get_the_title().'</p>';
								}else{
									$description .= '<p class="quasar-portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
								}
								
								if($activate_category_link === 'true'){
									//Check if user activates the category link
									$description .= '<p class="quasar-portfolio-category-link">'.$link_html.'</p>';	
								}
								
								
								break;
								
								case 'excerpt' :
								/*
								**	WooCommerce
								**	if($desc_details_price_active) $description .= '<div class="row"><div class="large-9 columns">';
								*/
								if($desc_details_price_active) $description .= '<div>';
								$description .= '<p class="quasar-portfolio-excerpt">'.(rockthemes_excerpt($post->post_excerpt,$excerpt_length)).'</p>';
								if($desc_details_price_active) $description .= '</div>';
								
								
							
								/*
								Read More for products. Currently stopped for using buttons. Works without a problem
								
								if($desc_details_price_active) $list_description .= '<div class="row"><div class="large-9 columns">';
								$list_description .= '<p class="quasar-portfolio-excerpt">'.rock_check_p(($post->post_excerpt).quasar_read_more()).'</p>';
								if($desc_details_price_active) $list_description .= '</div>';
								*/
								break;
								
								case 'price' :
								/*
								TO DO	:	WooCommerce Price Field. Works but needs visual improvments.
								if($desc_details_excerpt_active) $description .= '<div class="large-3 columns">';
								$description .= '<p class="quasar-price">'.$product_price.'</p>';
								if($desc_details_excerpt_active) $description .= '</div></div>';
								
								if($desc_details_excerpt_active) $list_description .= '<div class="large-3 columns">';
								$list_description .= '<p class="quasar-price">'.$product_price.'</p>';
								if($desc_details_excerpt_active) $list_description .= '</div></div>';
								*/
								break;
							}
							
						}
						
					}
					
					
											
					
					$boxed_cover_html_pre = '';
					$boxed_cover_html_after = '';
					$boxed_cover_html_class = '';
					$boxed_cover_list_before = '';
					$boxed_cover_list_after = '';
					
					if($boxed_layout == "true")	{
						$boxed_cover_html_pre = '<div class="boxed_layout_holder boxed-layout boxed-colors columns" ref="boxed-layout boxed-colors">';	
						$boxed_cover_html_after = '</div>';
						$boxed_cover_html_class = 'boxed-layout boxed-colors quasar-portfolio';
					}
					
										
					$return .= $boxed_cover_list_before.'<li featured-big="'.$featuredBig.'">'.$title.$boxed_cover_html_pre.'<div class="grid-description">'.$description.'</div><div class="list-description '.(($boxed_layout === 'true') ? 'large-7 medium-7 columns' : '').'" class-ref="7">'.$list_description.'</div>'.$boxed_cover_html_after.'</li>'.$boxed_cover_list_after;
					
				}
						
			}else{
				$return .= '<div class="large-12 columns">'.__("No data found!","quasar").'</div>';
			}
				
		if(!isset($is_ajax) || (isset($is_ajax) && $is_ajax === 'false')){
		
			$return .= '</ul>';//End of Body
						
			$return .= '<div class="clear"></div>';
				
			
			if($pagination === 'true'){
				//Footer navigation
				$return .= quasar_paging_nav();
			}
			
			wp_reset_query();
			wp_reset_postdata();
			
			$args['posts_per_page'] = -1;
			$args['paged'] = 0;
			$args['nopaging'] = true;
			$total_query = new WP_Query($args);
			
			$return .= '<div class="total-posts-number-holder hide" data-query-total="'.$total_query->found_posts.'"></div>';	
									
			$return .= '</div>';//End of HTML field
		}
		
		//var_dump(wp_count_posts());
		
		return $return;
	}
	
	function rockthemes_gallery_load_more_ajax(){
		if(!isset($_REQUEST['data'])) return;
		
		if(!isset($_REQUEST['_ajax_nonce']) ||
			empty($_REQUEST['_ajax_nonce']) || 
			!wp_verify_nonce($_REQUEST['_ajax_nonce'], 'rockthemes_gallery_lm_nonce') ||
			!check_ajax_referer('rockthemes_gallery_lm_nonce')) {
				
			//Die
			die();
		}
		
		$_REQUEST['data']['is_ajax'] = 'true';
		echo rockthemes_gallery_load_more($_REQUEST['data']);
		exit;
	}
endif;
add_action('wp_ajax_nopriv_rockthemes_gallery_load_more', 'rockthemes_gallery_load_more_ajax');
add_action('wp_ajax_rockthemes_gallery_load_more', 'rockthemes_gallery_load_more_ajax');


/*
**	End of Portfolio Shortcode
*/









/*
**	Rockthemes List Quick Shortcode on TinyMCE
**
**	
*/

if(!function_exists('rockthemes_shortcode_make_list')){
	function rockthemes_shortcode_make_list($atts, $content = null){	
		extract( shortcode_atts( array(
			'font_awesome_icon_class'	=>	'',
			'icon_color'				=>	'',
		), $atts ) );
		
		$icon = '';
		$color = '';
		
		if($font_awesome_icon_class !== ''){
			if($icon_color !== ''){
				$color = ' style="color:'.$icon_color.';"';
			}
			
			$icon = '<i class="fa '.$font_awesome_icon_class.'" '.$color.'></i>';
		}
		
		$return = str_replace('<li>', '<li>'.$icon.' <div>', $content);
		$return = str_replace('</li>', '</div></li>', $return);
		
		$return = '<div class="rockthemes-list">'.$return.'<div class="clear"></div></div>';
		
		return $return;
		
	}
}

add_shortcode("rockthemes_list", "rockthemes_shortcode_make_list");


/*
**	End of Rockthemes TinyMCE List Shortcode
*/






/*
**	Rockthemes Advanced Text Quick Shortcode on TinyMCE
**
**	
*/

if(!function_exists('rockthemes_shortcode_make_advanced_text')){
	function rockthemes_shortcode_make_advanced_text($atts, $content = null){	
		extract( shortcode_atts( array(
			'font_family'	=>	'',
			'font_size'		=>	'',
			'font_weight'	=>	'',
			'font_color'	=>	'',
			'extra_style'	=>	'',
		), $atts ) );
		
		$return = '<span style="font-family:'.str_replace(';','',$font_family).'; 
								font-size:'.str_replace('px','', $font_size).'px; 
								font-weight:'.str_replace('px', '', $font_weight).'; 
								color:#'.str_replace('#','', $font_color).';
								 '.$extra_style.'">'.$content.'</span>';		
		
		
		//$return = '<div class="rockthemes-advanced-text">'.$return.'</div>';
		
		return $return;
		
	}
}

add_shortcode("rockthemes_advanced_text", "rockthemes_shortcode_make_advanced_text");


/*
**	End of Rockthemes TinyMCE Advanced Text Shortcode
*/





/*
**	Rockthemes Divider Quick Shortcode on TinyMCE
**
**	
*/

if(!function_exists('rockthemes_shortcode_make_divider')){
	function rockthemes_shortcode_make_divider($atts, $content = null){	
		extract( shortcode_atts( array(
			'type'	=>	'center',
		), $atts ) );
		
		$return = '';
		
		if($type === 'center'){
			$return = '
				<div class="rockthemes-divider">
					<span class="divider-line">
						<span class="divider-symbol"></span>
					</span>
				</div>
			';		
		}elseif($type === 'left'){
			$return = '
				<div class="rockthemes-divider">
					<span class="divider-line-left">
						<span class="divider-symbol-left"></span>
					</span>
				</div>
			';		
		}
		
		
		//$return = '<div class="rockthemes-advanced-text">'.$return.'</div>';
		
		return $return;
		
	}
}

add_shortcode("rockthemes_divider", "rockthemes_shortcode_make_divider");


/*
**	End of Rockthemes Divider on TinyMCE
*/





/*
**	Rockthemes iFrame Video Quick Shortcode on TinyMCE
**
**	
*/

if(!function_exists('rockthemes_shortcode_make_youtube_video')){
	function rockthemes_shortcode_make_youtube_video($atts, $content = null){	
		extract( shortcode_atts( array(
			'resize_height'	=>	'true',
		), $atts ) );
		
		$return = '';
		
		if($content === '') return;
		
		$video_id = explode("?v=", $content); // For videos like http://www.youtube.com/watch?v=...
		if (empty($video_id[1]))
			$video_id = explode("/v/", $content); // For videos like http://www.youtube.com/watch/v/..
		
		$video_id = explode("&", $video_id[1]); // Deleting any other params
		$video_id = $video_id[0];
		$video_id .= '?wmode=transparent';

		$return = '
			<div class="quasar-iframe-container">
				<iframe src="//www.youtube.com/embed/' . $video_id . '" height="240" width="320" allowfullscreen="" frameborder="0"></iframe>
			</div>
		';
		
		
		return $return;
		
	}
}

add_shortcode("rockthemes_youtube_video", "rockthemes_shortcode_make_youtube_video");


/*
**	End of Rockthemes iFrame Video Shortcode
*/


















/*
**	Sidebar Shortcode
*/










?>