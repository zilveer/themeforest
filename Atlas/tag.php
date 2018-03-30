<?php
/**
 * The main template file for display tag page.
 *
 * @package WordPress
 */

$add_sidebar = TRUE;
$page_sidebar = 'Blog Sidebar';
$page_style = 'Right Sidebar';

get_header(); ?>

		
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
					
						<h1 class="cufon"> Tag /  
						<?php
							printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );
						?></h1><br/><hr/>
					
<?php

global $more; $more = false; # some wordpress wtf logic

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
				
				<br class="clear"/>
				
			</div>
			<br class="clear"/>
		</div>
		<!-- End content -->

<?php get_footer(); ?>