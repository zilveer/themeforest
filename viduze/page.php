<?php
/*
 * This file is used to generate different page layouts set from backend.
 */
get_header ();
?>

		<?php
		      
			    $sidebar = get_post_meta (get_the_id(), 'page-option-sidebar-template', true );
				$sidebar_class = '';
				if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
					$sidebar_class = "sidebar-included " . $sidebar;
					$container_class = "span8";
				} else if ($sidebar == "both-sidebar") {
					$sidebar_class = "both-sidebar-included";
					 $bcontainer_class ="span8";
					 $container_class = "span8";
				} else {
					$container_class = "span12";	
					$sidebar_class = "no-sidebar";
				}
					 $left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
					 $right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		             
				// Top Slider Part
				global $cp_top_slider_type, $cp_top_slider_xml, $item_xml;
				 if ($cp_top_slider_type == "Video Slider") { 
				      $video_slider_category = get_post_meta ( $post->ID, "page-option-item-video-slider-category", true );
					  $video_slider_fetch = get_post_meta ( $post->ID, "page-option-video-slider-fetch", true );
					  $video_slider_type = get_post_meta ( $post->ID, "page-option-video-slider-type", true );
					  print_video_slider($item_xml, $video_slider_category, $video_slider_fetch, $video_slider_type);
				    }
				else if( $cp_top_slider_type == 'Layer Slider' ){
					echo '<section class="slider-wrapper top-slider top-layerslider">';
					$layer_slider_id = get_post_meta( $post->ID, 'page-option-layer-slider-id', true);
						echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');	
						  echo '<section class="layerslider-caption"></section>';
					echo '</section>';
				}else if ($cp_top_slider_type != "No Slider" && $cp_top_slider_type != '') {
					echo '<section class="slider-wrapper top-slider">';
					$slider_xml = "<Slider>" . create_xml_tag ( 'size', 'full-width' );
					$slider_xml = $slider_xml . create_xml_tag ( 'height', get_post_meta ( $post->ID, 'page-option-top-slider-height', true ) );
					$slider_xml = $slider_xml . create_xml_tag ( 'width', '100%' );
					$slider_xml = $slider_xml . create_xml_tag ( 'slider-type', $cp_top_slider_type );
					$slider_xml = $slider_xml . $cp_top_slider_xml;
					$slider_xml = $slider_xml . "</Slider>";
					$slider_xml_dom = new DOMDocument ();
					$slider_xml_dom->loadXML ( $slider_xml );
					print_slider_item ( $slider_xml_dom->documentElement );
					echo '</section>';
				  } 
				  
				  // Quote banner Start
		if ($cp_top_slider_type == "No Slider" || $cp_top_slider_type == '')  { $content_holder = 'id="content-holder"';  }else { $content_holder = ''; };  
  echo '<section '.$content_holder.' class="container-fluid">';
      echo '<div class="row-fluid '.$sidebar_class.'">';
	    echo '<section class="container">';
			global $bcontainer_class;
     			echo "<div class='".$bcontainer_class." cp-page-float-left'>";
		     			echo "<div class='".$container_class. " row-fluid page-item'>";
								// Page title and content
								$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
							    $cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
								
								if ($cp_show_title !== "No") {
									while ( have_posts () ) {
										the_post ();
											if (! empty ( $cp_page_xml )) {	
													$page_xml_val = new DOMDocument ();
													$page_xml_val->loadXML ( $cp_page_xml );
													
											foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
													$page_title = ($item_xml->nodeName);
													}
											}
										/*    if ($page_title !== 'Portfolio' && $page_title !== 'Products' ){*/
											   		
											$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
											$cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
											if ($cp_show_title !== "No") {
												echo '<section class="span12 wrapper column page-heading">';
												echo'<header class="header-style page-title">';
												echo '<h2 class="h-style">';
												the_title ();
												echo '</h2>';
												echo '</header>';
												echo '<div class="clearfix"></div>';
												echo '</section>';	
											}
										
											/*}*/
										$content = get_the_content ();
										if ($cp_show_content !== 'No' && !empty ( $content )) {  
										
										
											echo '<div class="cp-page-wrapper widget-bg">';
											echo '<div class="cp-page-content">';
											the_content ();
													wp_link_pages ( array ('before' => '<div class="page-link"><span>' . __ ( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
											echo '</div>';
											echo '</div>';
											echo '<div class="clearfix"></div>';
											
										}
										
									}
								} else {
									while ( have_posts () ) {
										the_post ();
										$content = get_the_content ();
										if ($cp_show_content !== 'No' && ! empty ( $content )) {
											echo '<section class="span12">';
											echo '<div class="cp-page-content">';
											the_content ();
											echo '</div>';
											echo '</section>';
										}
									}
								}
							 ?>
							 
							
        <?php 
		
								global $cp_item_row_size, $cp_page_xml;
								$cp_item_row_size = 0;
							
								// Page Item Part
								if (! empty ( $cp_page_xml )) { 
									$page_xml_val = new DOMDocument ();
									$page_xml_val->loadXML ( $cp_page_xml );
									foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
										 $row_fluid = find_xml_value ( $item_xml, 'size' );
										switch ($item_xml->nodeName) {
											case 'Accordion' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns' ) ;
												print_accordion_item ( $item_xml );
												break;
											case 'Blog' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns blog-wrapper pd0');
												print_blog_item ( $item_xml );
												break;
											case 'Latest-Videos' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns latet-videos-wrapper pd0');
												print_latest_videos ( $item_xml );
												break;
											case 'Category-Videos' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns category-videos-wrapper pd0');
												print_category_videos ( $item_xml );
												break;
											case 'Featured-Videos' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns featured-videos-wrapper pd0');
												print_featured_videos ( $item_xml );
												break;		
											case 'Top-Video' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns top-videos-wrapper pd0');
												print_top_videos ( $item_xml );
												break;	
	                                        case 'Search-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns search-widget-wrapper pd0');
												print_search_widget ( $item_xml );
												break;
											case 'Social-Media-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns social-media-widget-wrapper pd0');
												print_social_media_widget ( $item_xml );
												break;		
		                                    case 'Videos-Tab-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns vidoes-tab-widget-wrapper pd0');
												print_videos_tab_widget ( $item_xml );
												break;	
		                                    case 'Twitter-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns twitter-widget-wrapper pd0');
												print_twitter_widget ( $item_xml );
												break;	
											case 'Contact-Form' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns contact-form' );
												print_contact_form ( $item_xml );
												break;
											case 'Column' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),  ' wrapper columns' );
												print_column_item ( $item_xml );
												break;
											case 'Content' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) , ' wrapper columns' );
												print_content_item ( $item_xml );
												break;
											case 'Divider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns');
												print_divider ( $item_xml );
												break;
											case 'Row-Start' :
											    echo '<section class="row-fluid">';
												break;
											case 'Row-End' :
											    echo '</section>';
												break;
											case 'Message-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns' );
												print_message_box ( $item_xml );
												break;
											case 'Page' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns' );
												print_page_item ( $item_xml );
												break;
										  
											case 'Price-Item' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' cp-price-item wrapper columns' );
												print_price_item ( $item_xml );
												break;
											case 'Portfolio' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' columns portfolio-project mbtm' );
												if(defined('IS_CP_POSTS')){ 
													print_portfolio2 ( $item_xml ); // print_portfolio_style1
												}else{
													miss_plugin_msg();	
												}
												break;
											case 'Gallery' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper columns gallery-wrapper mbtm');
												if(defined('IS_CP_POSTS')){ 
													print_gallery_item ( $item_xml );
												}else{
													miss_plugin_msg();	
												}
												break;
											case 'Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns ' );
												print_slider_item ( $item_xml );
												break;
											case 'Text-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns wellcome-msg m-bottom first' );
												print_text_widget ( $item_xml );
												break;
											case 'Tab' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) , ' wrapper columns');
												print_tab_item ( $item_xml );
												break;
											case 'Testimonial' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),' wrapper columns testimonials');
												if(defined('IS_CP_POSTS')){ 
													print_testimonial ( $item_xml );
												}else{
													miss_plugin_msg();	
												}
												break;
											case 'Toggle-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), ' wrapper columns' );
												print_toggle_box_item ( $item_xml );
												break;
											default :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												break;
										}
										echo '</article>';
									}
								}
						echo "</div>"; // end of cp-page-item
		            	    get_sidebar ( 'left' );
					echo "</div>"; // cp-page-float-left
		                	get_sidebar ( 'right' );
								
			
				
			?>
       
          </div>
        </section>
      </section>
<?php get_footer(); ?>