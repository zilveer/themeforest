	<?php
	global $UserSidebarIDs,$selectedTemplateID, $header_background_image, $header_text,$boxNumber, $is_front_page, $post;  
	
	$cotent_generator = true;	
	
	#
	#	Get all templates
	#
	$savedTemplates = get_option('rt_page_layouts');
		
	#
	#	Template to use 
	#
	if($selectedTemplateID && isset($savedTemplates->templates[$selectedTemplateID])){
		#
		#	Use user selected template 
		# 	
		$selectedTemplate = $savedTemplates->templates[$selectedTemplateID];
	}else{
		#
		#	no template created - we create default one according sidebars
		#
		$selectedTemplate = new stdClass;
		$selectedTemplate->templateID                = 0;
		$selectedTemplate->templateName              = "Default Template";
		$selectedTemplate->sidebar                   = $sidebar;
		$selectedTemplate->lineup                    = "on";
		@$selectedTemplate->contents[0]->group_id     = 1;
		@$selectedTemplate->contents[0]->content_type = "default_content";
		@$selectedTemplate->contents[0]->layout       = "one";
		@$selectedTemplate->contents[0]->heading      = "on";
	}
 
	#
	#	Temaplate Items
	# 								
	$selectedTemplate_contents = $selectedTemplate->contents;
	
	#
	#	Sidebar 
	# 
	$sidebar=$selectedTemplate->sidebar ? $selectedTemplate->sidebar : str_replace("fullwidth","full",get_page_layout());
	
	#
	#	Content Width 
	#
	$content_width = ($sidebar=="full") ? 960 : 606;

	#
	#	give space for front page if sidebar is active
	#			
	if(	 
		$is_front_page
		&& ($sidebar!="full")
		&& (!$header_background_image && !$header_text)
	) 	echo '<div class="content-wrapper box-shadow" style="height:10px;margin-top:-10px;"></div><div class="space margin-b30"></div>';


	#
	#	Call the holder's 1st part
	#
	sub_page_layout("subheader",$sidebar); 

	
	#
	# 	Layout grid values
	#
	$layout_values	= array("four-five"=>48,"three-four"=>45,"two-three"=>40,"five"=>12,"four"=>15,"three"=>20,"two"=>30,"one"=>60);
	
	
	#
	# 	Prepare counting values
	#		
	$boxNumber = 1;
	$box_counter = 1;
	$total_width  = 0;
	$reset_row_count = 0;
	$fixedRows = 0;

	#
	# 	Password protected
	#
	if( isset( $post ) && post_password_required( $post->ID ) ){	
		get_template_part("page_content" );
	}

	#
	# 	Do for each content that has been added for this template
	#
	if($selectedTemplate_contents && ! post_password_required() ){
	foreach($selectedTemplate_contents as $templateID => $template){	
	
	
			#
			#	Box Layout
			#
			if($template->layout){ 
				$this_item_layout=$template->layout; 
			}
			
			#
			#	Next item box width
			#
			if(isset($selectedTemplate_contents[$templateID+1]->layout)){
				$next_item_layout = $selectedTemplate_contents[$templateID+1]->layout;
				
				if(empty($next_item_layout)) {
					$next_item_layout  = $template->layout;  
				} 
			}
				 
				
			#
			#	this column width	- pixel
			#
			$this_column_width_pixel =  intval ($content_width / (60/$layout_values[$this_item_layout]) );
			
			
			#
			#	first and last box of each row
			#
			$next_item_width = (isset($next_item_layout)) ? $layout_values[$next_item_layout] : "";
			$total_width     = ($total_width==0) ? $layout_values[$this_item_layout] + $next_item_width : $total_width + $next_item_width;				
			$firstBox        = ($box_counter ==1) ? "first" : false;			
			$lastBox         = ($total_width > 60) ? "last" : false;
			$box_counter     = ($total_width > 60) ? $box_counter = 1 : $box_counter+1 ;
			$reset_row_count = ($box_counter == 1) ? 0 : $reset_row_count;
			$total_width     = ($total_width>60) ? 0 : $total_width;			
			$fixedRows++; 		

			#
			#	fixed row holder
			#			
			if( 
				$firstBox  
				&& ($template->content_type!="default_content") 
				&& ($template->content_type!="blog_box")  
			
			) 	echo '<div id="row_order_'.$fixedRows.'" class="fixed-row clearfix">';
 
			#
			#	give space if the first item != a slider and header image has not being used
			#			
			if(
				$boxNumber ==1
				&& $is_front_page
				&& ($template->content_type!="slider_box")  
				&& ($template->content_type!="revolution_box")  
				&& ($sidebar=="full")
				&& (!$header_background_image && !$header_text)
			) 	echo '<div class="box-shadow" style="height:10px;margin-top:-10px;"></div><div class="space margin-b30"></div>';
 

			#
			#	reset the row
			#		
			if ($lastBox || $boxNumber == count($selectedTemplate_contents) ) {
				$reset = true;
			}else{
				$reset = false;
			}

					#
					#	Call Slider
					#
					if($template->content_type=="slider_box"){
						
						echo	($template->layout=="one") ? "" :'<div class="template_builder box '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
						
						$slides=array(
							'post_type'           => 'slider',
							'post_status'         => 'publish',
							'ignore_sticky_posts' => 1,
							'showposts'           => 1000,
							'cat'                 => -0,
							'post__in'            => $template->content_id,
							'orderby'             => $template->list_orderby,
							'order'               => $template->list_order							
						);
						
						$slider_script         =  $template->slider_script;
						$rttheme_slider_height =  $template->slider_height;
						$rttheme_slider_width  =  $sidebar=="full" ? 940 : 690;
						$crop_slider_images    = ($template->image_crop) ? true : false;
						$resize_slider_images  =  $template->image_resize;
						$slider_effect         =  isset($template->slider_effect) ? $template->slider_effect : "";
						$slider_timeout        =  $template->slider_timeout;
						$slider_buttons        =  $template->slider_buttons; 
						$thumbs_width          =  isset($template->thumbs_width) ? $template->thumbs_width : "";   
						$thumbs_height         =  isset($template->thumbs_height) ? $template->thumbs_height : "";  

						$group_id              =  $template->group_id;  
						
						if($slider_script=="flex" || $slider_script==""){
							get_template_part( 'flex-slider', 'home_slider' );  
						}else{
							get_template_part( 'nivo-slider', 'home_slider' );  
						}
						
						echo	($template->layout=="one") ? "" : '</div>';
					}

					#
					#	Call Revolution Slider
					#
					if($template->content_type=="revolution_box"){
						$layout        = $template->layout;
						$group_id      =  $template->group_id;  
						$rev_slider_shortcode = ($template->slider_id) ? $rev_slider_shortcode = $template->slider_id : "" ;

						echo	($template->layout=="one") ? "" :'<div class="template_builder box '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
						
						get_template_part( 'rev-slider', 'home_slider' );  

								
						echo	($template->layout=="one") ? "" : '</div>';
					}

					#
					#	Heading Bar
					#
					if($template->content_type=="heading_bar"){
						$layout        = $template->layout;
						$group_id      =  $template->group_id;  

						echo '<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">';  								
						echo '<div class="head_text nomargin"><div class="arrow"></div><h4 class="divider">';
						echo	stripslashes(wpml_t( THEMESLUG , 'Heading '.$selectedTemplate->templateID.$group_id, $template->heading ));
						echo '</h4></div></div>';									
						
					}

					#
					#	Banner Text
					#
					if($template->content_type=="banner_box"){ 
						$group_id              =  $template->group_id;  

						echo'	<div class="content-wrapper box-shadow clearfix banner_holder" id="banner-'.$boxNumber.'">'; 
						echo'	<div class="template_builder banner clearfix">	';
						
						echo 	($template->button_link && $template->button_text) ? '<a href="'.wpml_t( THEMESLUG , 'Button Link for Banner '.$selectedTemplate->templateID.$group_id, $template->button_link ).'" class="banner_button  alignright">'.wpml_t( THEMESLUG , 'Button Text for Banner '.$selectedTemplate->templateID.$group_id, $template->button_text ).'</a>' : '';

						echo 	($template->button_link && $template->button_text) ? '<div class="featured_text withbutton">': '<div class="featured_text">';
						echo 	'<p>';
						echo		stripslashes(wpml_t( THEMESLUG , 'Text for Banner '.$selectedTemplate->templateID.$group_id, $template->text ));
						echo'	</p>	';									
						
						echo'	</div></div></div>	';  
						
					}

					#
					#	Default Content
					#
					if($template->content_type=="default_content"){ 

						$heading	= $template->heading;
						
						if(!$is_front_page || get_option('show_on_front')=="page"){ 
								if(is_page()){
									get_template_part( 'page_content', 'page_content_file' );
								}elseif (is_single()) {
									get_template_part( 'post_content', 'post_content_file' );
								}

						}else{
								$reset="";
						}
						
					}
					
					#
					#	Call Sidebar Box
					#
					if($template->content_type=="sidebar_box"){
						
						$box_width 	= $template->widget_box_width;
						$sidebarID	= $template->sidebar_id;
						$layout        = $template->layout; 
						$home_contents_count=0;//reset widget count
						$widget_num=false;//reset widget count 
						
						echo	($template->layout=="one") ? "" :'<div class="template_builder box-shadow box '.$template->layout.' '.$firstBox.'  '.$lastBox.'">';
	 
						 	add_filter('dynamic_sidebar_params', array("RT_Create_Sidebars",'home_page_layout_class'));					
							dynamic_sidebar($template->sidebar_id);
						 
						echo	($template->layout=="one") ? "" : '</div>';
					}

					#
					#	Call All Content Boxes
					#
					if($template->content_type=="all_content_boxes"){
						$home_page        = array(  'post_type'=> 'home_page', 'post_status'=> 'publish', 'showposts' => -1, 'cat' => -0, 'post__in'  => $template->content_id, 'orderby' => $template->list_orderby, 'order' => $template->list_order);
						$layout           = $template->layout;
						$item_width       = $template->item_width; //item width
				 
						echo	($template->layout=="one") ? "" :'<div id="box_'.$template->group_id.'"  class="template_builder box-shadow box  '.$template->layout.' '.$firstBox.'  '.$lastBox.'">'; 
									
						get_template_part( 'home_content_loop', 'home_page' );
						 
						echo	($template->layout=="one") ? "" : '</div>';		 
					}
					
					#
					#	Call a Content Box
					#
					if($template->content_type=="home_page_box"){ 
						$home_page	= array(  'post_type'=> 'home_page',   'post_status'=> 'publish',   'showposts' => 1,   'cat' => -0,  'p'  => $template->content_id);
						$layout	 	= $template->layout;
						get_template_part( 'home_content_loop', 'home_page' );
					}
		
	
					#
					#	Call Portfolio Box
					#
					if($template->content_type=="portfolio_box"){ 				
						global $selectedPortfolioCatetegories,$filterable;		
						
						$item_width = $template->item_width; //item width
						$layout     = $template->layout; 


						$selectedPortfolioCatetegories  = isset($template->categories) ? wpml_lang_object_ids($template->categories,"portfolio_categories") : "";
 

						$filterable  = isset( $template->filterable ) ? $template->filterable : "";
						
						echo	($layout=="one") ? "" :'<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">'; 
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 
	
								//create a post status array
								$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

								//general query
								$args=array( 
									'post_status'    =>	$post_status,
									'post_type'      => 'portfolio',
									'orderby'        => $template->portf_list_orderby,
									'order'          => $template->portf_list_order,
									'posts_per_page' => $template->item_per_page,
									'paged'          => $paged, 
								);
															 

								if( ! empty ( $selectedPortfolioCatetegories ) ){
									$args = array_merge($args, array( 

										'tax_query' => array(
												array(
													'taxonomy' =>	'portfolio_categories',
													'field'    =>	'id',
													'terms'    =>	$selectedPortfolioCatetegories,
													'operator' => 	"IN"
												)
											),	
									) );
								} 


								get_template_part( 'portfolio_loop', 'portfolio_categories' );
						 
						echo	($layout=="one") ? "" : '</div>';

					}


					#
					#	Call WooCommerce Product Box
					#
					if($template->content_type=="woo_products_box"){
						if ( class_exists( 'Woocommerce' ) ) {		
							global $woo_module_used_in_template, $woocommerce_loop,$woo_layout_names,$height_fix;
				
							$item_width = $template->item_width; //item width
							$layout     = $template->layout; 
							$category_slug = (@$template->categories) ? @$template->categories : "";
							$woo_module_used_in_template = "TRUE";
							$woocommerce_loop['loop'] = 0;
							$woo_column_class_name = $woo_layout_names[$item_width];
							$height_fix =  "FALSE";

								// height fix for this group of boxes if layout is one
								if($layout=="one") {
									echo "\n";
									echo '<script type="text/javascript">'."\n";
									echo '//<![CDATA['."\n";
									echo '
										jQuery(window).load(function() { 
												jQuery(\'#row_order_'.$fixedRows.' ul.products\').rt_fixed_rows_ul({row_size:'.$item_width.', padding:0, classname:""});
										});
									';							
									echo '//]]>'."\n";
									echo '</script>'."\n";
								}

							$woo_product_shortcode = '[product_category category="'.$category_slug.'" per_page="'.$template->item_per_page.'" columns="'.$item_width.'" orderby="'.@$template->list_orderby.'" order="'.@$template->list_order.'"]';
							
							echo	($layout=="one") ? "" :'<div id="woo_products_'.$template->group_id.'" class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">'; 
	
							echo apply_filters('the_content',stripslashes(@$woo_product_shortcode) );
							 
							echo	($layout=="one") ? "" : '</div>';
						}
					}

					#
					#	Call Product Box
					#
					if($template->content_type=="product_box"){ 				
							
						
						$item_width = $template->item_width; //item width
						$layout     = $template->layout; 
						

						echo	($layout=="one") ? "" :'<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">';
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 
						
								//selected categories
								$selectedProductCatetegories  = isset($template->categories) ? wpml_lang_object_ids($template->categories,"product_categories") : "";
	
								//create a post status array
								$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

								//general query
								$args=array( 
									'post_status'    => $post_status,
									'post_type'      => 'products',
									'orderby'        => $template->list_orderby,
									'order'          => $template->list_order,
									'posts_per_page' => $template->item_per_page,
									'paged'          => $paged, 
								);
															 

								if( ! empty ( $selectedProductCatetegories ) ){
									$args = array_merge($args, array( 

										'tax_query' => array(
												array(
													'taxonomy' =>	'product_categories',
													'field'    =>	'id',
													'terms'    =>	$selectedProductCatetegories,
													'operator' => 	"IN"
												)
											),	
									) );
								} 


								//ajax scroller
								$ajaxScroller = @$template->ajax_scroller;	

								if($ajaxScroller=="on"){
									$scollerID = "rt_ajax_scroller".rand(100,100000);
									$AjaxScroller = "\n";
									$AjaxScroller .= '<script type="text/javascript">'."\n";
									$AjaxScroller .= '//<![CDATA['."\n";
									$AjaxScroller .= '
														//ajax product scroller
														jQuery(document).ready(function(){

															jQuery("#'.$scollerID.' ul.paging a").bind("click",function(){ 	

																	//the products holder
																	var theProductBox = jQuery(this).parents("#'.$scollerID.'");
																	var products_holder = theProductBox.find(".product_boxes");
																	var paged = jQuery(this).attr("class");
																	var $this = jQuery(this);

																	var ProductAjaxdata = {
																		action: \'rt_ajax_product_scroller\',
																		layout: \''.$layout.'\',
																		item_width: \''.$item_width.'\',		
																		content_width: \''.$content_width.'\',		
																		this_column_width_pixel: \''.$this_column_width_pixel.'\',		
																		cotent_generator: \''.$cotent_generator.'\',																	
																		orderby: \''.$template->list_orderby.'\',
																		order: \''.$template->list_order.'\',
																		posts_per_page: \''.$template->item_per_page.'\',
																		categories: "'.@implode(wpml_lang_object_ids($template->categories,"product_categories"), ",").'",
																		paged: paged,
																		before: function(){											
																			jQuery(products_holder).animate({opacity:0.2},300);																			
																			jQuery(\'<div class="rt_loader"></div>\').prependTo(theProductBox);
																			 
																		},
																		success: function(){ 
																						jQuery($this).parents("ul").find("li").each(function(){
																							jQuery(this).removeClass("active");																					
																						});
																						jQuery($this).parents("li").addClass("active");
																				}
																	};

																	jQuery.post(ajaxurl, ProductAjaxdata, function(response) {	
																		products_holder.remove();
																		jQuery(".rt_loader").remove();																				
																		jQuery(response).prependTo(theProductBox).animate({opacity:1},600);
																			
																			//loading gif
																			jQuery(theProductBox).find(\'img\').each(function(){																					
																				jQuery(this).parents("a.imgeffect").css({"background-image":"url("+rttheme_template_dir+"/images/loading.gif)","background-position":"center center","background-repeat":"no-repeat","height":"100px"}); 
																				jQuery(this).css({"opacity":"0"}); 
																			});

																			//wait images 
																			jQuery("#'.$scollerID.' img").imgpreload({
 																				each: function()
																			    {
																			    	jQuery(this).parents("a.imgeffect").css({"background-image":"none","height":"auto"}); 
																			    	jQuery(this).css({"opacity":"1"}); 
    																			},
			
		    																	all: function(){ 
																					jQuery(theProductBox).find(\'a.imgeffect\').rt_portfolio_effect();  
																					jQuery(\'html, body\').animate({ scrollTop: theProductBox.offset().top-100}, 600); 
														';				
									$AjaxScroller .= ($item_width!=1)	? ' 	jQuery("#'.$scollerID.' .fixed-row").rt_fixed_rows();' : "";

									$AjaxScroller .= '}
																		});	
																	});  

																}); 
													 	}); 
													 	';	

									$AjaxScroller .= '//]]>'."\n";
									$AjaxScroller .= '</script>'."\n";
									echo  $AjaxScroller;

									echo '<div id="'.$scollerID.'">';	
									get_template_part( 'product_loop', 'product_categories' );
									echo '</div>';
								}else{
									get_template_part( 'product_loop', 'product_categories' );
								}	

						
						echo	($layout=="one") ? "" : '</div>';
					}		


					#
					#	Call Blog Box
					#
					if($template->content_type=="blog_box"){ 				
								
						
						$item_width 	= (isset($template->item_width)) ? $template->item_width : ""; //item width 
						$layout			= (isset($template->layout)) ? $template->layout : ""; //layout; 
						$is_blog_module = "true";
						
						echo	($layout=="one") ? "" :'<div class="template_builder box box-shadow '.$layout.' '.$firstBox.'  '.$lastBox.'">'; 
					
								//page
								if($template->pagination){
									if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
								}else{
									$paged=0;
								} 

								//blog cats
								if($template->categories){
									$blog_cats=implode(($template->categories),",");
								}else{
									$blog_cats="";
								}
			
								//general query
								$args=array( 
									'post_status'    =>	'publish',
									'post_type'      =>	'post',
									'orderby'        =>	$template->list_orderby,
									'order'          =>	(isset($template->list_order)) ?  $template->list_order : "",
									'posts_per_page' =>	$template->item_per_page,
									'paged'          => $paged, 
									'cat'            =>	$blog_cats,
								);
								 
								
								get_template_part( 'loop', 'archive' );
						 
						echo	($layout=="one") ? "" : '</div>';
					}		


					#
					#	Call Google Map
					#
					if($template->content_type=="google_map"){ 			 

						$layout		= $template->layout; 
						$group_id   =  $template->group_id; 

						$mapiframeCode ="";

						echo '<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">';
					 
							//try to find view larger map part
							if(!empty($template->map_url)){								
								$mapiframeCode        = explode('<br /><small>',wpml_t( THEMESLUG , 'Map URL '.$selectedTemplate->templateID.$group_id, stripslashes($template->map_url)));													
								$mapiframeCode        = is_array($mapiframeCode) ? $mapiframeCode[0] : $mapiframeCode ; //cleaned larger map part
								
								//find width value
								$mapiframeCode_Width  = explode('width="', $mapiframeCode);
								$mapiframeCode_Width  = explode('"', $mapiframeCode_Width[1]);
								$mapiframeCode_Width  = $mapiframeCode_Width[0];
								
								//find height value
								$mapiframeCode_Height = explode('height="', $mapiframeCode);
								$mapiframeCode_Height = explode('"', $mapiframeCode_Height[1]);
								$mapiframeCode_Height = $mapiframeCode_Height[0];
							
							//new map width
							$newMapWidth          = $this_column_width_pixel -40;
							
							//final code 
							$mapiframeCode        = str_replace('width="'.$mapiframeCode_Width.'"','width="100%"', $mapiframeCode);
							$mapiframeCode        = str_replace('height="'.$mapiframeCode_Height.'"','height="'.$template->height.'"', $mapiframeCode);
							}

							echo $mapiframeCode; 
						
						echo	'</div>';
					}		
					 

					#
					#	Call Contact Form
					#
					if($template->content_type=="contact_form"){ 			 
 
						$layout			= $template->layout; 
						$group_id  		=  $template->group_id;  
						
						echo '<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">'; 
					 
							echo ($template->title) ? '<h3>'.wpml_t( THEMESLUG , 'Text for Contact Form '.$selectedTemplate->templateID.$group_id, stripslashes($template->title)).'</h3><div class="space margin-b10"></div>' :"";
							echo ($template->description) ? '<p class="decs_text"><i>'.wpml_t( THEMESLUG , 'Description for Contact Form '.$selectedTemplate->templateID.$group_id, stripslashes($template->description)).'</i>' :"";
					
							//Default Contact Form
							if($template->email && !$template->shortcode){			
								echo	do_shortcode('[contact_form email="'.$template->email.'"]');
							}
						
							//3rd Party Contact Form Plugins
							if($template->shortcode){
								echo	do_shortcode(stripslashes($template->shortcode));
							}
						 
						echo	'</div>';
					}		

					#
					#	Call Contact Info Box
					#
					if($template->content_type=="contact_info_box"){ 			 
 
						$layout		= $template->layout; 
						$group_id   =  $template->group_id;  
						
						echo '<div class="template_builder box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">'; 
					 
							echo ($template->contact_title) ? '<h3>'.wpml_t( THEMESLUG , 'Title for Contact Info '.$selectedTemplate->templateID.$group_id, stripslashes($template->contact_title) ).'</h3><div class="space margin-b10"></div>' :"";
							echo ($template->contact_text) ? '<p>'.wpml_t( THEMESLUG , 'Text for Contact Info '.$selectedTemplate->templateID.$group_id, stripslashes($template->contact_text) ).'</p>' :"";
							echo '<ul class="contact_list">'; 
							echo ($template->address) ? '<li class="home">'.wpml_t( THEMESLUG , 'Address for Contact Info '.$selectedTemplate->templateID.$group_id, stripslashes($template->address) ).'</li>' :"";
							echo ($template->phone) ? '<li class="phone">'.wpml_t( THEMESLUG , 'Phone for Contact Info '.$selectedTemplate->templateID.$group_id, $template->phone ).'</li>' :"";
							echo ($template->email) ? '<li class="mail"><a href="mailto:'.wpml_t( THEMESLUG , 'Email for Contact Info '.$selectedTemplate->templateID.$group_id, $template->email ).'">'.wpml_t( THEMESLUG , 'Email for Contact Info '.$selectedTemplate->templateID.$group_id, $template->email ).'</a></li>' :"";
							echo ($template->support_email) ? '<li class="help"><a href="mailto:'.wpml_t( THEMESLUG , 'Support Email for Contact Info '.$selectedTemplate->templateID.$group_id, $template->support_email ).'">'.wpml_t( THEMESLUG , 'Support Email for Contact Info '.$selectedTemplate->templateID.$group_id, $template->support_email ).'</a></li>' :"";
							echo ($template->fax) ? '<li class="fax">'.wpml_t( THEMESLUG , 'Fax for Contact Info '.$selectedTemplate->templateID.$group_id, $template->fax ).'</li>' :"";
							echo '</ul>'; 
							 
						echo	'</div>';
					}	 

					#
					#	Call Code Box
					#
					if($template->content_type=="code_box"){ 			 
						global $woocommerce_loop,$woo_module_used_in_template;
						
						$woo_module_used_in_template = "FALSE";
						$woocommerce_loop['loop'] = 0;
						$woocommerce_loop['columns']= "";

						$layout		= $template->layout;
							 
						$transparent	= $template->transparent;
						$no_padding		= $template->no_padding;
						
						$addCSS1    = $transparent ? "nobackground" : "";
						$addCSS2    = $no_padding ? "nopadding" : ""; 
						$group_id      =  $template->group_id;  

						if($layout!="one"){
							if($transparent)
								echo '<div id="code_box_'.$template->group_id.'" class="template_builder codebox '.$addCSS1.' '.$addCSS2.' box '.$layout.' '.$firstBox.'  '.$lastBox.'">';
							else
								echo '<div id="code_box_'.$template->group_id.'" class="template_builder '.$addCSS2.' codebox box-shadow box '.$layout.' '.$firstBox.'  '.$lastBox.'">';
						}else{
							if($transparent)
								echo '<div id="code_box_'.$template->group_id.'" class="template_builder codebox '.$addCSS1.' '.$addCSS2.' '.$layout.' '.$firstBox.'  '.$lastBox.'">';
							else
								echo '<div id="code_box_'.$template->group_id.'" class="template_builder '.$addCSS2.' box-shadow box codebox '.$layout.' '.$firstBox.'  '.$lastBox.'">';							
						}
								echo ($template->heading) ? '<h3>'.wpml_t( THEMESLUG , 'Title for Code Box '.$selectedTemplate->templateID.$group_id, stripslashes($template->heading) ).'</h3><div class="space margin-b10"></div>' :"";
									
								echo apply_filters('the_content', stripslashes( wpml_t( THEMESLUG , 'Description for Code Box '.$selectedTemplate->templateID.$group_id, $template->code_space ) ) );
							 
						echo	'</div>';
					}	 
								
					if ($reset): 
						
						//end fixed row holder
						if( 
							($template->content_type!="default_content") 
							&& ($template->content_type!="blog_box")  
						) 	echo '</div>';

						//end fix and space					
						if(isset($woo_module_used_in_template) && $woo_module_used_in_template=="TRUE" && $layout == "one"){
							echo '<div class="space margin-b10"></div>';
							$woo_module_used_in_template  ="";
						}else{
							echo '<div class="space margin-b30"></div>';
						}

					endif;


					$emptyContent = false;
					
					@$woocommerce_loop["loop"] = 0;$woocommerce_loop['columns']= ""; //resetting WooCommerce Columns
 					
		$boxNumber++;
	}
	}

	#
	#	Call the holder's 2nd part
	#
	sub_page_layout("subfooter",$sidebar);
	?>