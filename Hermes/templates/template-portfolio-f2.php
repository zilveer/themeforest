<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$caption_class = "page_caption";
$portfolio_sets_query = '';

if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'portfoliosets');
	$custom_title = 'Sets / '.$obj_term->name;
}
else
{
	$custom_title = get_the_title();
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

$caption_style = get_post_meta($current_page_id, 'caption_style', true);

if(empty($caption_style))
{
	$caption_style = 'Title & Description';
}

if(!isset($hide_header) OR !$hide_header)
{
?>				
		<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon"><?php echo $custom_title; ?></h1>
				</div>
				<div class="caption_desc">
					<?php
						$page_desc = get_post_meta($current_page_id, 'page_desc', true);
						
						if(!empty($page_desc))
						{
							echo $page_desc;
						}
					?>
				</div>
			</div>
			<br class="clear"/>
		</div>
		
		</div>
		
		<div id="header_pattern"></div>
		<br class="clear"/>
		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
				<div class="standard_wrapper">
					<br class="clear"/><hr/><br/>
<?php
}
?>	
								
									<?php 
										if(!isset($hide_header) OR !$hide_header && !empty($page->post_content))
										{
									?>
										<div style="width:100%;margin-bottom:40px">
											<?php echo $page->post_content; ?>
										</div>
									<?php
										}
										elseif(!empty($pp_homepage))
										{
											$page_obj = get_page($pp_homepage);
									?>
										<div style="width:100%;margin-bottom:40px">
											<?php echo $page_obj->post_content; ?>
										</div>
									<?php	
										}
									?>
								
									<?php  
									$pp_portfolio_display_set = get_option('pp_portfolio_display_set');
																		
									if(!empty($pp_portfolio_display_set))
									{
										$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0');
										
										if(!empty($sets_arr))
										{
									?>
										<h2 class="widgettitle" style="width:100%">Filter by Set</h2>
										<ul class="portfolio-main filter full"> 
											<li class="all-projects active"><a href="javascript:;">All</a></li>
											<?php
												foreach($sets_arr as $key => $set_item)
												{
											?>
											<li class="cat-item <?php echo $set_item->slug; ?>" data-type="<?php echo $set_item->slug; ?>" style="clear:none">
												<a href="javascript:;" title="<?php echo $set_item->name; ?>"><?php echo $set_item->name; ?></a> 
											</li> 
											<?php
												}
											?>
										</ul>
										
									<?php
										}
									?>
									<br class="clear"/><br/>
									<?php
									}
									?>
								

						
						<br class="clear"/>
						
						<!-- Begin portfolio content -->
						
						<?php
							$menu_sets_query = '';

							$portfolio_items = -1;
							
							$portfolio_sort = get_option('pp_portfolio_sort'); 
							if(empty($portfolio_sort))
							{
								$portfolio_sort = 'DESC';
							}
							
							//prepare data for pagintion
							$offset_query = '';
							if(!isset($_GET['page']) OR empty($_GET['page']) OR $_GET['page'] == 1)
							{
							    $current_page = 1;
							}
							else
							{ 
							    $current_page = $_GET['page'];
							    $offset = (($current_page-1) * $portfolio_items);
							}
							
							$args = array(
								'numberposts' => $portfolio_items,
								'order' => $portfolio_sort,
								'orderby' => 'date',
								'post_type' => array('portfolios'),
								'offset' => $offset,
							);
							if(!empty($term))
							{
								$args['portfoliosets'].= $term;
							}
							
							$page_photo_arr = get_posts($args);
							
							
							//Get all portfolio items for paging
							
							$args = array(
								'numberposts' => -1,
								'order' => $portfolio_sort,
								'orderby' => 'date',
								'post_type' => array('portfolios'),
							);
							if(!empty($term))
							{
								$args['portfoliosets'].= $term;
							}
							
							$all_photo_arr = get_posts($args);
							$total = count($all_photo_arr);
							$cur_post = 0;
		
							if(isset($page_photo_arr) && !empty($page_photo_arr))
							{
								
						?>
								<div class="portfolio-content section content clearfix" style="920px"> 
											<?php

												foreach($page_photo_arr as $key => $portfolio_item)
												{
													$image_url = '';
								
													if(has_post_thumbnail($portfolio_item->ID, 'large'))
													{
														$image_id = get_post_thumbnail_id($portfolio_item->ID);
														$image_url = wp_get_attachment_image_src($image_id, 'full', true);
													}
													
													$last_class = ' last';
													$line_break = '<br class="clear"/>';
													
													$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
													
													if(empty($portfolio_link_url))
													{
														$permalink_url = get_permalink($portfolio_item->ID);
													}
													else
													{
														$permalink_url = $portfolio_link_url;
													}
													
													$portfolio_item_set = '';
													$portfolio_item_sets = wp_get_object_terms($portfolio_item->ID, 'portfoliosets');
													//pp_debug($portfolio_item_sets);
													
													$portfolio_item_set = '';
													if(is_array($portfolio_item_sets))
													{
														foreach($portfolio_item_sets as $set)
														{
															$portfolio_item_set.= $set->slug.' ';
														}
													}
													
													$pp_portfolio_image_height = 227;
											?>
															<div data-id="post-<?php echo $key+1; ?>" class="<?php echo $portfolio_item_set; ?> project" data-type="<?php echo $portfolio_item_set; ?>" style="width:920px;margin-bottom:50px;height:<?php echo $pp_portfolio_image_height+10; ?>px">
															<div style="float:left;width:640px">
															<?php
																$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
																$portfolio_video_id = get_post_meta($portfolio_item->ID, 'portfolio_video_id', true);
																switch($portfolio_type)
																{
																case 'External Link':
																default:
															?>
															<div class="portfolio642_shadow">
																<a title="<?php echo $portfolio_item->post_title; ?>" href="<?php echo $permalink_url; ?>">
																	<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=<?php echo $pp_portfolio_image_height; ?>&amp;w=640&amp;zc=1" alt="" class="img_nofade frame" width="640" height="<?php echo $pp_portfolio_image_height; ?>"/>
																</a>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_zoom.png" style="margin-top:-30px;margin-left:300px;z-index:9999"/>
															</div>
															
															<?php
																break;
																//end external link
																
																case 'Image':
															?>
															<div class="portfolio642_shadow">
																<a title="<?php echo $portfolio_item->post_title; ?>" href="<?php echo $image_url[0]; ?>" class="img_frame">
																	<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=<?php echo $pp_portfolio_image_height; ?>&amp;w=640&amp;zc=1" alt="" class="img_nofade frame" width="640" height="<?php echo $pp_portfolio_image_height; ?>"/>
																</a>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_zoom.png" style="margin-top:-30px;margin-left:300px;z-index:9999"/>
															</div>
															
															<?php
																break;
																//end image
																
																case 'Youtube Video':
															?>
															<div class="portfolio642_shadow">
																<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
																	<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=<?php echo $pp_portfolio_image_height; ?>&amp;w=640&amp;zc=1" alt="" class="img_nofade frame" width="640" height="<?php echo $pp_portfolio_image_height; ?>"/>
																</a>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_play.png" style="margin-top:-30px;margin-left:300px;z-index:9999"/>
															</div>
																
							<div style="display:none;">
							    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:640px;height:385px">
							        
							        <object type="application/x-shockwave-flash" data="http://www.youtube.com/v/<?php echo $portfolio_video_id; ?>" style="width:640px;height:385px">
			        		    		<param name="movie" value="http://www.youtube.com/v/<?php echo $portfolio_video_id; ?>" />
			    			    	</object>
							        
							    </div>	
							</div>
															
															<?php
																break;
																//end image
															
															case 'Vimeo Video':
															?>
															<div class="portfolio642_shadow">
																<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
																	<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]?>&amp;h=<?php echo $pp_portfolio_image_height; ?>&amp;w=640&amp;zc=1" alt="" class="img_nofade frame" width="640" height="<?php echo $pp_portfolio_image_height; ?>"/>
																</a>
																<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_play.png" style="margin-top:-30px;margin-left:300px;z-index:9999"/>
															</div>
																
							<div style="display:none;">
							    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:601px;height:338px">
							    
							        <object width="601" height="338" data="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $portfolio_video_id; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" type="application/x-shockwave-flash">
			  				    		<param name="allowfullscreen" value="true" />
			  				    		<param name="allowscriptaccess" value="always" />
			  				    		<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $portfolio_video_id; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" />
							    	</object>
							        
							    </div>	
							</div>
															
															<?php
																break;
																//end image
															?>
															
															<?php
																}
															?>
															</div>
																
																<div class="portfolio_desc" style="width:240px;float:right;">
																	<strong><?php echo $portfolio_item->post_title?></strong>
																	<?php
																		$pp_portfolio_display_desc = get_option('pp_portfolio_display_desc');
																		
																		if(!empty($pp_portfolio_display_desc))
																		{
																	?>										
																	<br/>
																	<span>
																	<?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)), 140); ?>																	
																	</span>
																	<?php
																		}
																	?>
																</div>
															</div>
										    
										    <?php

												}
												//End foreach loop
												
										    ?>
										    
							<?php
								
							}
							//End if have portfolio items
							?>
							
							</div>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>				
			</div>
			<!-- End main content -->
				
			</div>
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>
<?php
}
?>