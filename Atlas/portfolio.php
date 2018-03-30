<?php
/**
 * Template Name: Portfolio
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

session_start();

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
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
    'order' => 'ASC',
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

get_header(); ?>

		<?php
			$pp_portfolio_bg = get_option('pp_portfolio_bg'); 
			
			if(empty($pp_portfolio_bg))
			{
				$pp_portfolio_bg = '/example/bg.jpg';
			}
			else
			{
				$pp_portfolio_bg = '/data/'.$pp_portfolio_bg;
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo get_stylesheet_directory_uri().$pp_portfolio_bg; ?>", {speed: 'slow'} );
		</script>
		
		<?php
			if(!empty($all_photo_arr))
			{
		?>
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<?php
					$pp_gallery_width = 420;
					$pp_gallery_height = 340;
			?>
			
			<div class="inner">
		
				<div class="inner_wrapper">
				
				<div class="sidebar_content full_width">
					<?php
						if(!empty($term))
						{
							$portfolio_sets_query.= $term;
							
							$obj_term = get_term_by('slug', $term, 'portfoliosets');
							$custom_title = $obj_term->name;
						}
						else
						{
							$custom_title = get_the_title();
						}
					?>				
					<h1 class="cufon"><?php echo $custom_title; ?></h1><br/>
					
					<?php
						if(!empty($post->post_content) && empty($term))
						{
					?>
						<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?></p>
						<br/>
					<?php
						}
					?>
				
				<?php
					foreach($all_photo_arr as $key => $portfolio_item)
					{
						$image_url = '';
								
						if(has_post_thumbnail($portfolio_item->ID, 'large'))
						{
						    $image_id = get_post_thumbnail_id($portfolio_item->ID);
						    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
						    
						    $small_image_url = get_stylesheet_directory_uri().'/timthumb.php?src='.$image_url[0].'&amp;h='.$pp_gallery_height.'&amp;w='.$pp_gallery_width.'&amp;zc=1';
						}
						
						$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
						
						if(empty($portfolio_link_url))
						{
						    $permalink_url = get_permalink($portfolio_item->ID);
						}
						else
						{
						    $permalink_url = $portfolio_link_url;
						}
						
						$last_class = '';
						if(($key+1)%2==0)
						{
							$last_class = 'last';
						}
				?>
				
				<div class="one_half <?php echo $last_class; ?>" style="margin-top:3%">
				<div class="one_half gallery2" style="width:100%">
					<?php 
    					if(!empty($image_url[0]))
    					{
    				?>		
							
							<?php
    								$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
    								$portfolio_video_id = get_post_meta($portfolio_item->ID, 'portfolio_video_id', true);
    								switch($portfolio_type)
    								{
    								case 'External Link':
    								default:
    							?>
    							<div class="shadow">
    								<div class="zoom">View</div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="<?php echo $permalink_url; ?>" onclick="location.href='<?php echo $permalink_url; ?>'">
									<img src="<?php echo $image_url[0]; ?>" alt="" class="one_half_img"/>
								</a>
    							
    							<?php
    								break;
    								//end external link
    								
    								case 'Image':
    							?>
    							<div class="shadow">
    								<div class="zoom">Enlarge</div>
    							</div>
								<a rel="gallery" href="<?php echo $image_url[0]; ?>">
									<img src="<?php echo $small_image_url; ?>" alt="" class="one_half_img"/>
								</a>
    							
    							<?php
    								break;
    								//end image
    								
    								case 'Youtube Video':
    							?>
    							<div class="shadow">
    								<div class="zoom">Play</div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
									<img src="<?php echo $small_image_url; ?>" alt="" class="one_half_img"/>
								</a>
    								
<div style="display:none;">
    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:640px;height:385px">
        
        <object type="application/x-shockwave-flash" data="http://www.youtube.com/v/<?php echo $portfolio_video_id; ?>" style="width:640px;height:385px" wmode="transparent">
    		<param name="movie" value="http://www.youtube.com/v/<?php echo $portfolio_video_id; ?>" />
    	</object>
        
    </div>	
</div>
    							
    							<?php
    								break;
    								//end image
    							
    							case 'Vimeo Video':
    							?>
    							<div class="shadow">
    								<div class="zoom">Play</div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
									<img src="<?php echo $small_image_url; ?>" alt="" class="one_half_img"/>
								</a>
    								
<div style="display:none;">
    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:601px;height:338px">
    
        <object width="601" height="338" data="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $portfolio_video_id; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" type="application/x-shockwave-flash">
        	<param name="wmode" value="transparent">
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
    								//end switch
    							?>
					<?php
    					}		
    				?>			
					
				</div>
				
				<br class="clear"/>
				<div class="portfolio_desc" style="width:400px;padding-top:10px">
				    <h3 class="cufon"><?php echo $portfolio_item->post_title?></h3><br/>
				    <span>
				    <?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)),160); ?>																	
				    </span>
				</div>
				
				</div>
				
				<?php
					}
				?>
				</div>
				</div>
			
			</div>
			<br class="clear"/>
			
		</div>
		<!-- End content -->
		
		<?php
			}
		?>
		
		</div>

<?php get_footer(); ?>