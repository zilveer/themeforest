<?php
/**
 * The Template for displaying all single posts
 *
 * @package MiEvent
 * @subpackage MiEvent
 * @since MiEvent 1.0
 */

get_header(); 
global $wp_query ;
$layout=MthemeCore::getOption('posts_layout', 'right');
?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post();
$url=''; 
if(has_post_thumbnail()) { 
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
	$url = $thumb['0'];
}
else
{
	$url = CHILD_URI.'site/img/backgrounds/blog.jpg';
}
	
$post_ID=get_the_ID();
$type=MthemeCore::getPostMeta($post_ID,"post_type","type");
$author_id=get_the_author_meta('ID');

echo '<div id="home_slider">';
echo do_shortcode("[post_background post_id='$post_ID' type='$type' author_id='$author_id' background_image='$url']");
echo '</div>';
?>

<div class="main-content content-wrapper">
<div class="container">
	<?php
		if($layout=='left')
		{
	?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="sidebar "><?php get_sidebar(); ?></div>
			</div>
			<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php
		}
		elseif($layout=='right')
		{
	?>
		<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php
		}
		else
		{
	?>
			<div class="posts-listing col-lg-12">
	<?php
		}
	?>
		<div class="post clearfix">			
			<!-- post-content -->
			<div class="post-content clearfix" style="width:100%;">
				<div class="row clearfix">
					<div class="post-detail">	
						<?php the_content(); ?>	
					</div>	
					<?php if(has_tag()) { ?>
					<div class="share-block section-padding clearfix">
						<div class="tagged-with col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<?php the_tags(__('Tagged with: ', 'mtheme')); ?>
						</div>
						<div class="share-this col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<nav class="social-ftp">
								<a class="btn-effect source-font" target="_blank" href="http://www.facebook.com/sharer.php&#63;t=<?php echo esc_url(get_permalink()); ?>&#38;u=<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-facebook"></i></a>
								<a class="btn-effect source-font" target="_blank" href="https://twitter.com/intent/tweet&#63;text=<?php echo esc_url(get_permalink()); ?>&#38;url=<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-twitter"></i></a>
								<a class="btn-effect source-font" target="_blank" href="https://plus.google.com/share&#63;url=<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-google"></i></a>
							</nav>
							<span><?php _e('Share this article:','mtheme'); ?></span>					
						</div>
					</div>
					<?php } ?>
					
					<?php 
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
					<div class="post-pagination clearfix">
						<nav class="pagination">
							<?php previous_post_link('%link', '<div class="prev page-numbers"><i class="fa fa-angle-left icon-list-item"></i></div>' ); ?>
							<?php next_post_link( '%link','<div class="next page-numbers"><i class="fa fa-angle-right icon-list-item"></i></div>' ); ?>
						</nav>
					</div>
				</div>
				
			</div>
			<script type="text/javascript">
				window.header_transparent = "yes";
			</script>
			
		</div>
	</div>
	<?php if($layout=='right') { ?>
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<div class="sidebar "><?php get_sidebar(); ?></div>
	</div>
	<?php } ?>	
</div>	
</div>

<?php endwhile; ?>
<?php endif; ?>	
<?php
get_footer();