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

	<div class="page_caption">
		<h1 class="cufon"><?php
							printf( __( ' %s', '' ), '' . single_cat_title( '', false ) . '' );
						?></h1>
	</div>

	<div id="content_wrapper">
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">

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

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'blog_ft'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_ft', true);
	    
	  	$pp_blog_image_width = 625;
		$pp_blog_image_height = 250;
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
								<div class="post_detail" style="width:400px">
									<img src="<?php echo get_template_directory_uri(); ?>/images/document_edit.gif" alt="" class="middle"/>&nbsp;<?php _e( 'Posted on', THEMEDOMAIN ); ?> <?php the_time('F j, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;
									<img src="<?php echo get_template_directory_uri(); ?>/images/user_edit.gif" alt="" class="middle"/>&nbsp;by&nbsp;<?php the_author(); ?>
								</div>
								<div class="post_detail" style="float:right;width:120px;text-align:right">
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
								<?php
									$pp_blog_full_post = get_option('pp_blog_full_post');
									
									if(!empty($pp_blog_full_post))
									{
										the_content();
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
							
						</div>
						<!-- End each blog post -->
						<br class="clear"/>



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
	</div>

<?php get_footer(); ?>