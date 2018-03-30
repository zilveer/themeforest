<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/

get_header(); 

if($post_type == 'gallery')
{
	$pp_portfolio_style = get_option('pp_portfolio_style');
	if(empty($pp_portfolio_style))
	{
		$pp_portfolio_style = 3;
	}

	include (TEMPLATEPATH . "/templates/template-portfolio-".$pp_portfolio_style.".php");
	exit;
}

?>
		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<div class="sidebar_content">
				
				<?php

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
							
							<div class="post_excerpt">
								<?php the_content(); ?>
							</div>
							
						</div>
						<!-- End each blog post -->


						<?php comments_template( '' ); ?>
						

<?php endwhile; endif; ?>
					</div>
					
					<div class="sidebar_wrapper">
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
									<?php dynamic_sidebar('Blog Sidebar'); ?>
								</ul>
								
							</div>
						
						</div>
					</div>
				
				<br class="clear"/>
			</div>
			<br class="clear"/>
			
		</div>
		<!-- End content -->
		
		<br class="clear"/>
	</div>
	<br class="clear"/>	

<?php get_footer(); ?>