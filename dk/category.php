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
				
					<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
						<div style="float:left">
							<h1 class="cufon"><?php
								printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );
							?></h1>
						</div>
						<div class="page_control">
							<a id="page_minimize" href="#">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
							</a>
							<a id="page_maximize" href="#">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
							</a>
						</div>
					</div>

					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";

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
    								<div class="zoom"><?php _e( 'Enlarge Image', THEMEDOMAIN ); ?></div>
    							</div>
								<a href="<?php echo $image_thumb[0]; ?>" class="img_frame">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/timthumb.php?src=<?php echo $image_thumb[0]; ?>&amp;h=<?php echo $pp_blog_image_height; ?>&amp;w=<?php echo $pp_blog_image_width; ?>&amp;zc=1" alt="" class=""/>
								</a>
							</div>
							
							<?php
								}
							?>
							
							<br/>
							
							<?php
								$post_header_style = 'style="width:100%;"';
								$pp_blog_display_social = get_option('pp_blog_display_social');
								
								if(!empty($pp_blog_display_social))
								{
									$post_header_style = '';
							?>
							<div class="post_social">
								<iframe class="facebook_button" src="//www.facebook.com/plugins/like.php?app_id=262802827073639&amp;href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:90px;" allowTransparency="true"></iframe>
								
								<a href="https://twitter.com/share" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
							</div>
							<?php
								}
							?>
							
							<div class="post_header" <?php echo $post_header_style; ?>>
								<h3 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div class="post_detail">
								<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
									<a href="<?php the_permalink(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
								</div>
							</div>
							
							<br class="clear"/>
							
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
							
									<br/><br/>
									<a href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
							
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
			<?php get_footer(); ?>
		</div>
		<!-- End content -->

		<br class="clear"/>