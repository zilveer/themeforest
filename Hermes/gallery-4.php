<?php
/**
 * The main template file for display gallery page.
 *
 * @package WordPress
*/

$pp_gallery_style = get_option('pp_gallery_style');
if($pp_gallery_style == 'f')
{
	include_once(TEMPLATEPATH.'/gallery-f.php');
	exit;
}

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$caption_class = "page_caption";
$portfolio_sets_query = '';
$custom_title = '';

if(!empty($term))
{
	$portfolio_sets_query.= $term;
	
	$obj_term = get_term_by('slug', $term, 'photos_galleries');
	$custom_title = $obj_term->name;
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

if(!isset($hide_header) OR !$hide_header)
{
?>				
		<div class="border30 top"></div>
		<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon"><?php the_title(); ?></h1>
				</div>
			</div>
			<div class="caption_desc">
					<?php
						if(!empty($page->post_content))
						{
							echo $page->post_content;
						}
					?>
				</div>
			<br class="clear"/>
		</div>
		
		</div>
		
		<div id="header_pattern"></div>
		<br class="clear"/>
		<div class="curve"></div>
		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div id="gallery_wrapper" class="inner_wrapper">
				
				<div class="standard_wrapper">
					<br class="clear"/><hr/><br/>
				
<?php
}
else
{
	echo '<br class="clear"/>';
}
?>	
						
						<!-- Begin portfolio content -->
						
						<?php
							$menu_sets_query = '';

							$portfolio_items = -1;
							
							$portfolio_sort = get_option('pp_gallery_sort'); 
							if(empty($portfolio_sort))
							{
								$portfolio_sort = 'DESC';
							}
							
							$args = array( 
								'post_type' => 'attachment', 
								'numberposts' => $portfolio_items, 
								'post_status' => null, 
								'post_parent' => $post->ID,
								'order' => $portfolio_sort,
								'orderby' => 'date',
							); 								
							$all_photo_arr = get_posts( $args );
		
							if(isset($all_photo_arr) && !empty($all_photo_arr))
							{

						?>
						
						<div class="custom_gallery" style="width:100%;margin:auto;margin-top:20px">
											<?php

												foreach($all_photo_arr as $key => $portfolio_item)
												{
													
													$image_url = '';
								
													if(!empty($portfolio_item->guid))
													{
														$image_id = $portfolio_item->ID;
														$image_url[0] = $portfolio_item->guid;
													}
													
													$last_class = '';
													$line_break = '';
													if(($key+1) % 4 == 0)
													{	
														$last_class = ' last';
														
														if(isset($page_photo_arr[$key+1]))
														{
															$line_break = '<br class="clear"/><br/>';
														}
														else
														{
															$line_break = '<br class="clear"/>';
														}
													}
													
											?>
															<div class="one_fourth<?php echo $last_class?>">
															<div class="portfolio4_shadow">
																<a title="<?php echo $portfolio_item->post_title?>" href="<?php echo $image_url[0]?>" rel="gallery" href="<?php echo $image_url[0]?>">
																<span class="overlay_detail">
																	<div>
																		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_zoom.png" alt=""/><br/>
																	</div>
																</span>
																	<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_url[0]?>&h=118&w=197&zc=1" alt="" class="" width="197" height="118"/>
																</a>
															</div>
															</div>
										    
										    <?php
												
													echo $line_break;
												}
												//End foreach loop
												
										    ?>
								
								</div>
							<?php
								
							}
							//End if have portfolio items
							?>
						
						    
						</div>
						<!-- End main content -->
					
						<br class="clear"/>
				</div>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>				
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>
<?php
}
?>