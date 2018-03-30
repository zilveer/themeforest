<?php
/**
 * Template Name: Gallery Thumbnails
 * The main template file for display contact page.
 *
 * @package WordPress
 */

session_start();

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

/**
* 	Check password protected
**/

$page_gallery_password = get_post_meta($current_page_id, 'page_gallery_password', true);

if(!empty($page_gallery_password))
{
    if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
    {		
    	include (TEMPLATEPATH . "/templates/template-password.php");
    	exit;
    }
}

/**
*	Get all photos
**/ 

$page_gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $page_gallery_id,
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
						<?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?>
						<br/>
					<?php
						}
					?>
					
					<?php
    				$pp_blog_display_social = get_option('pp_blog_display_social');
    				
    				if(!empty($pp_blog_display_social)):
    				?>
    				<div class="post_social">
    					<!-- Place this tag where you want the +1 button to render -->
						<g:plusone size="medium" href="<?php echo $page->guid; ?>"></g:plusone>
						
						<!-- Place this render call where appropriate -->
						<script type="text/javascript">
						  (function() {
						    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						    po.src = 'https://apis.google.com/js/plusone.js';
						    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>
    				
    					<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode($page->guid); ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:21px;" allowTransparency="true" class="facebook_button"></iframe>
    					
    					<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title(); ?>" data-url="<?php echo $page->guid; ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    				</div>
    				<br class="clear"/><br/>
    				<?php
    				endif; ?>
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
						
							$small_image_url = wp_get_attachment_image_src( $photo->ID, 'thumbnail' );
						}
						
						$last_class = '';
						if(($key+1)%2==0)
						{
							$last_class = 'last';
						}
				?>
				
				<?php 
    			    if(!empty($small_image_url))
    			    {
    			?>		
				    	<a rel="gallery" href="<?php echo $image_url[0]; ?>" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>>
				    		<img src="<?php echo $small_image_url[0]; ?>" alt="" class="img_nofade small_thumb frame"/>
				    	</a>
				<?php
    			    }		
    			?>			
				
				<?php
					}
				?>
				
					</div>
				</div>
				</div>
			
			</div>
			<br class="clear"/><br/><br/>
			
		</div>
		<!-- End content -->
		
		<?php
			}
		?>
		
		</div>
		
		</div>

<?php get_footer(); ?>