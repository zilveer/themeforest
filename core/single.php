<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/
 
session_start();
//session_destroy();

if($post_type == 'gallery')
{
	/**
	*	Get Current page object
	**/
	$page = get_page($post->ID);
	$current_page_id = '';
	
	if(isset($page->ID))
	{
	    $current_page_id = $page->ID;
	}

	if(!empty($post->post_password))
	{
		if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
		{		
			include (TEMPLATEPATH . "/templates/template-password.php");
			exit;
		}
		else
		{
			get_header();
		}
	}
	else
	{
		get_header();
	}
	
	if(isset($_GET['mode']) && $_GET['mode']=='f')
	{
		include (TEMPLATEPATH . "/templates/template-portfolio-f.php");
		exit;
	}
	else
	{
		if(isset($_SESSION['pp_portfolio_style']))
		{
			$pp_portfolio_style = $_SESSION['pp_portfolio_style'];
		}
		else
		{
			$pp_portfolio_style = get_option('pp_portfolio_style');
		}
		
		if(empty($pp_portfolio_style))
		{
			$pp_portfolio_style = 3;
		}
		
		include (TEMPLATEPATH . "/templates/template-portfolio-".$pp_portfolio_style.".php");
		
		exit;
	}
}
else
{
	get_header();
}

?>

	<br class="clear"/><br/>
	<div id="content_wrapper">

		<!-- Begin content -->
		<div id="page_content_wrapper">
		
			<div class="inner">
			
				<div class="sidebar_content">
				
				<?php

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'blog_ft'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_ft', true);
	}
?>

						<!-- Begin each blog post -->
						<div class="post_wrapper">
						
							<div class="post_header">
								<h3 class="cufon">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>								
									</a>
								</h3>
								<div class="post_detail" style="width:360px">
									<img src="<?php echo get_template_directory_uri(); ?>/images/clock.gif" alt="" class="middle"/>&nbsp;<?php _e( 'Posted on', THEMEDOMAIN ); ?> <?php the_time('F j, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="<?php echo get_template_directory_uri(); ?>/images/user_edit.gif" alt="" class="middle"/>&nbsp;by&nbsp;<?php the_author(); ?>
								</div>
								<div class="post_detail" style="float:right;width:100px;text-align:right">
									<img src="<?php echo get_template_directory_uri(); ?>/images/comment.gif" alt="" class="middle"/>&nbsp;<?php comments_number('0', '1', '%'); ?>
								</div>
							</div>
						
							<?php
								if(!empty($image_thumb))
								{
							?>
							
							<br class="clear"/>
							<div class="post_img">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<img src="<?php echo $image_thumb[0]; ?>" alt="" class="img_nofade frame"/>
								</a>
							</div>
							
							<?php
								}
							?>
							
							<div class="post_detail" style="margin-left:5px">
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
		</div>
	</div>

<?php get_footer(); ?>