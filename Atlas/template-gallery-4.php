<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery 4 Columns
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		include (TEMPLATEPATH . "/templates/template-password.php");
		exit;
	}
}

$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

get_header(); ?>

		<?php
			if(has_post_thumbnail($current_page_id, 'full'))
			{
			    $image_id = get_post_thumbnail_id($current_page_id); 
			    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
			    $pp_page_bg = $image_thumb[0];
			}
			else
			{
				$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo $pp_page_bg; ?>", {speed: 'slow'} );
		</script>
		
		<?php
			if(!empty($all_photo_arr))
			{
		?>
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<?php
					$pp_gallery_width = 200;
					$pp_gallery_height = 200;
			?>
			
			<div class="inner">
		
				<div class="inner_wrapper">
				
				<div class="sidebar_content full_width">
					<h1 class="cufon"><?php echo $post->post_title; ?></h1><br/>
					
					<?php
						if(!empty($post->post_content))
						{
					?>
						<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?></p>
						<br/>
					<?php
						}
					?>
				
				<?php
					foreach($all_photo_arr as $key => $photo)
					{
						$small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
						$hyperlink_url = get_permalink($photo->ID);
						
						if(!empty($photo->guid))
						{
							$image_url[0] = $photo->guid;
						
							$small_image_url = get_stylesheet_directory_uri().'/timthumb.php?src='.$image_url[0].'&amp;h='.$pp_gallery_height.'&amp;w='.$pp_gallery_width.'&amp;zc=1';
						}
						
						$last_class = '';
						if(($key+1)%4==0)
						{
							$last_class = 'last';
						}
				?>
				
				<div class="one_fourth <?php echo $last_class; ?> gallery4" style="margin-bottom:0;margin-top:3%">
					<?php 
    					if(!empty($small_image_url))
    					{
    						$pp_display_image_title = get_option('pp_display_image_title');
    				?>	
    						<div class="shadow">
    							<div class="zoom">Enlarge</div>
    						</div>	
							<a rel="gallery" href="<?php echo $image_url[0]; ?>" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>>
								<img src="<?php echo $small_image_url; ?>" alt="" class="one_fourth_img"/>
							</a>
					<?php
    					}		
    				?>			
					
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