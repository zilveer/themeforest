<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $post->ID,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

$pp_display_image_title = get_option('pp_display_image_title');

get_header(); ?>

	<div class="page_caption">
		<h1 class="cufon"><?php echo $post->post_title; ?></h1>
	</div>

	<div id="content_wrapper">
		
		<?php
			if(!empty($all_photo_arr))
			{
		?>
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">
		
				<div class="inner_wrapper">
				
				<div class="one_third">
					
					<div style="width:90%">
					<?php
						if(!empty($post->post_content))
						{
							$baseLinkArr = parse_url(curPageURL());
						
							if(isset($baseLinkArr['query']) && !empty($baseLinkArr['query']))
    						{
    							$start = '&mode=f';
    						}
    						else
    						{
    							$start = '?mode=f';
    						}
					?>
						<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?></p>
						<br/><br/>
					<?php
						}
					?>

					<?php
						$pp_display_slideshow_button = get_option('pp_display_slideshow_button');
						
						if(!empty($pp_display_slideshow_button))
						{
					?>
						<a href="<?php echo curPageURL().$start; ?>" class="button"><?php _e( 'View Fullscreen', THEMEDOMAIN ); ?></a>
					<?php
						}
					?>
					</div>
					
				</div>
				
				<div class="two_third last">
				
				<?php
					foreach($all_photo_arr as $key => $photo)
					{
						$small_image_url = get_template_directory_uri().'/images/000_70.png';
						$hyperlink_url = get_permalink($photo->ID);
						
						if(!empty($photo->guid))
						{
							$image_url[0] = $photo->guid;
							$small_image_url = wp_get_attachment_image_src( $photo->ID, 'gallery_2' );
						}
						
						$last_class = '';
						if(($key+1)%2==0)
						{
							$last_class = 'last';
						}
				?>
				
				<div class="one_half <?php echo $last_class; ?>" style="margin-bottom:2%">
					<?php 
    					if(!empty($small_image_url))
    					{
    				?>		
							<a rel="gallery" href="<?php echo $image_url[0]; ?>" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>>
								<img src="<?php echo $small_image_url[0]; ?>" alt="" class="img_nofade frame"/>
							</a>
					<?php
    					}		
    				?>			
					
				</div>
				
				<?php
					}
				?>
				<br class="clear"/><br/><br/>
				</div>
				
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
		</div>

<?php get_footer(); ?>