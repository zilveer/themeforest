<?php
/**
 * The main template file for display category page.
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
				$pp_blog_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
			}
			else
			{
				$pp_blog_bg = THEMEUPLOADURL.$pp_blog_bg;
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo $pp_blog_bg; ?>", {speed: 'slow'} );
		</script>
		
		<?php
			if(isset($_SESSION['pp_skin']))
			{
			    $pp_skin = $_SESSION['pp_skin'];
			}
			else
			{
			    $pp_skin = get_option('pp_skin');
			}		
			
			$icon_prefix = '';			
			if($pp_skin == 'light')
			{
			    $icon_prefix = '_black';
			}
		?>
		
		<a id="page_maximize" href="#">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus<?php echo $icon_prefix; ?>.png" alt=""/>
		</a>
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">
				
					<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
						<div style="float:left">
							<h1 class="cufon"><?php
								printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );
							?></h1><br/>
						</div>
						<div class="page_control">
							<a id="page_minimize" href="#">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus<?php echo $icon_prefix; ?>.png" alt=""/>
							</a>
						</div>
					</div>

					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'blog'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'blog', true);
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper">
							
							<div class="post_img_date"><div class="day"><?php echo get_the_time('d'); ?></div><div class="month"><?php echo get_the_time('M'); ?></div></div>
							
							<div class="post_header">
								<h5 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
							</div>
						
							<?php
								if(!empty($image_thumb))
								{
							?>
							
							<br class="clear"/>
							<div class="post_img">
								<a href="<?php echo $image_thumb[0]; ?>" class="img_frame">
									<img src="<?php echo $image_thumb[0]; ?>" alt="" class=""/>
								</a>
							</div>
							
							<div class="post_detail">
								<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
									<a href=""><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
								</div>
							
							<?php
								}
							?>
							
							<br/>
							
							<?php
								$pp_blog_display_full = get_option('pp_blog_display_full');
								
								if(!empty($pp_blog_display_full))
								{
									the_content();
								}
								else
								{
									the_excerpt();
							?>
							
									<br/>
									<a href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
							
							<?php
								}
							?>
							
							<br/><br/><br/><hr/>
							
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
		<br class="clear"/>