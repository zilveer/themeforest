<?php
/**
 * The main template file for display blog page.
 *
 * @package WordPress
*/

get_header(); 

$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}
$caption_class = "page_caption";

$pp_title = get_option('pp_blog_title');

if(empty($pp_title))
{
	$pp_title = 'Blog';
}

?>

		<div class="border30 top"></div>
		<div class="page_caption">
			<div class="caption_inner">
				<div class="caption_header">
					<h1 class="cufon"><?php echo $pp_title; ?></h1>
				</div>
			</div>
			<div class="caption_desc">
					Category  "<?php
							printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );
						?>"
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
				<div class="inner_wrapper"><div class="standard_wrapper">
					<br class="clear"/><hr/><br/>
				
					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";

$cat_id = get_cat_ID(single_cat_title('', false));
if(!empty($cat_id))
{
	$query_string.= '&cat='.$cat_id;
}

query_posts($query_string);
$num_of_posts = $wp_query->post_count;
$cur_post = 0;

if (have_posts()) : while (have_posts()) : the_post();

	$cur_post++;
	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
	    
	    $pp_blog_image_width = 627;
		$pp_blog_image_height = 214;
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper" <?php if($cur_post==$num_of_posts) { echo 'style="margin-bottom:0"'; }?>>
							
							<div class="post_header">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?>								
									</a>
								</h3>
							</div>
							
							<?php
							    if(isset($image_thumb[0]))
							    {
							?>	
							<br class="clear"/>	
							<div class="post_shadow">
								<a href="<?php the_permalink(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&w=<?php echo $pp_blog_image_width; ?>&h=<?php echo $pp_blog_image_height; ?>&zc=1" alt="" class="post_img"/>
								</a>
							</div>
							<br/><br/>
							
							<?php
								}
							?>
							
							<div class="post_detail">
							<?php
								$pp_blog_meta_sort_data = unserialize(get_option('pp_blog_meta_sort_data'));
						
								if(is_array($pp_blog_meta_sort_data) && !empty($pp_blog_meta_sort_data))
								{
									foreach($pp_blog_meta_sort_data as $meta)
									{
										switch($meta)
										{
											case 1:
												echo the_category(',').'<br/>';
											break;
											case 2:
												echo the_tags('Tags: ',',', '<br/>');
											break;
											case 3:
												echo 'Posted by: '.get_the_author().'<br/>';
											break;
											case 4:
												echo 'Date: '.get_the_time('d M Y').'<br/>';
											break;
											case 5:
												echo comments_number('0 Comment', '1 Comment', '% Comments').'<br/>';
											break;
										}
									}
								}
							?>
							</div>
							
							<div class="post_excerpt">
								<?php echo _substr(strip_tags(strip_shortcodes(get_the_content())), 400); ?>
								<br/><br/>
								<a class="continue" href="<?php the_permalink(); ?>">Continue Reading »</a>
							</div>
							
							<br class="clear"/><br/>
						
						</div>
						<!-- End each blog post -->


<?php endwhile; endif; ?>

						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
						
					</div>
					
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
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
				
			</div>
			
		</div>
		<!-- End content -->
				

<?php get_footer(); ?>