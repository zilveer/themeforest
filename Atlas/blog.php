<?php
/**
 * Template Name: Blog
 * The main template file for display blog page.
 *
 * @package WordPress
*/

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
	get_header(); 
}

$page_style = 'Right Sidebar';
$caption_style = get_post_meta($current_page_id, 'caption_style', true);

if(empty($caption_style))
{
	$caption_style = 'Title & Description';
}

if(!isset($sidebar_home))
{
	$sidebar_home = '';
}

if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}
$caption_class = "page_caption";

if(!isset($add_sidebar))
{
	$add_sidebar = FALSE;
}

$sidebar_class = '';

if($page_style == 'Right Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
}
elseif($page_style == 'Left Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
	$sidebar_class = 'left_sidebar';
}
else
{
	$page_class = 'inner_wrapper';
}

?>		

		<?php
			$pp_blog_bg = get_option('pp_blog_bg'); 
			
			if(empty($pp_blog_bg))
			{
				$pp_blog_bg = '/example/bg.jpg';
			}
			else
			{
				$pp_blog_bg = '/data/'.$pp_blog_bg;
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo get_stylesheet_directory_uri().$pp_blog_bg; ?>", {speed: 'slow'} );
		</script>
	
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">

					<div class="sidebar_content">
					
						<h1 class="cufon"><?php the_title(); ?></h1><br/><hr/>
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";

$cat_id = get_cat_ID(single_cat_title('', false));
if(!empty($cat_id))
{
	$query_string.= '&cat='.$cat_id;
}

query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	    
	    
	  	$pp_blog_image_width = 600;
		$pp_blog_image_height = 260;
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper">
						
							<?php
								if(!empty($image_thumb))
								{
							?>
							
							<br class="clear"/>
							<div class="post_img">
								<div class="shadow">
    								<div class="zoom">Enlarge Image</div>
    							</div>
								<a href="<?php echo $image_thumb[0]; ?>" class="img_frame">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&amp;h=<?php echo $pp_blog_image_height; ?>&amp;w=<?php echo $pp_blog_image_width; ?>&amp;zc=1" alt="" class=""/>
								</a>
							</div>
							
							<?php
								}
							?>
							
							<br/>
							
							<div class="post_date">
								<div class="month"><?php the_time('M'); ?></div>
								<div class="date"><?php the_time('j'); ?></div>
								<div class="year"><?php the_time('Y'); ?></div>
								<div class="comments"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/comment.png" alt="" class="middle"/>&nbsp;<?php comments_number('0', '1', '%'); ?></div>
							</div>
							<div class="post_header">
								<h3 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</div>
							
							<br class="clear"/>
							
							<?php
							    $pp_blog_full_post = get_option('pp_blog_full_post');
							    
							    if(!empty($pp_blog_full_post))
							    {
							?>
								<div class="post_excerpt">
							<?php
							    	the_content();
							?>
								</div>
							<?php
							    }
							    else
							    {
							?>
							
							    	<?php echo get_the_content_with_formatting(); ?>
							    	<br/><br/><br/>
							    	<a href="<?php the_permalink(); ?>"><?php _e( 'Continue Reading', THEMEDOMAIN ); ?> »</a>
							    
							<?php
							    }
							?>
							
						</div>
						<!-- End each blog post -->



<?php endwhile; endif; ?>

						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
						
					</div>
					
					<?php
						if($add_sidebar && $page_style == 'Right Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
					
				</div>
				<!-- End main content -->
				
			</div>
			<br class="clear"/>
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>
			
		</div>
		<!-- End content -->
		<br class="clear"/><br/>
				

<?php get_footer(); ?>

<?php
}
?>