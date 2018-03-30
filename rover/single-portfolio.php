<?php
/**
 * Single For Portfolio
 * @package by Theme Record
 * @auther: MattMao
 */
get_header();

global $tr_config;
$enable_comments = $tr_config['enable_portfolio_comments'];
$enable_related_posts = $tr_config['enable_portfolio_related_posts'];
$posts_per_page = $tr_config['portfolio_related_posts_per_page'];

$date = get_meta_option('portfolio_date');
$client = get_meta_option('portfolio_client');
$client_url = get_meta_option('portfolio_client_url');

#
#Get cats
#
$terms = get_the_terms( $post->ID, 'portfolio-category' );
if ($terms && ! is_wp_error($terms)) 
{
	$terms_array = array();
	foreach ( $terms as $term ) 
	{
		$terms_array[] = $term->name;
	}
	$skills = join( ', ', $terms_array );
}

?>

<div id="main" class="fullwidth">

<!--Begin Content-->
<article id="content">
	<?php if (have_posts()) : the_post(); ?>

	<div class="post post-portfolio-single clearfix" id="post-<?php the_ID(); ?>">

	<?php
		$media_type = get_meta_option('portfolio_type');

		switch($media_type)
		{
			case 'image':
			theme_post_image('portfolio');
			break;

			case 'slideshow':
			theme_post_gallery('portfolio');
			break;

			case 'video':
			theme_post_video('portfolio');
			break;
		}
	?>

	<div class="post-entry">
		<h1 class="title"><?php the_title(); ?></h1>
	</div>
	<!--End Post Entry-->

	<div class="post-content clearfix">

		<div class="post-meta clearfix">
			<?php if($skills): ?><p class="skills meta"><b><?php _e('Skills', 'TR'); ?>:</b><?php echo $skills; ?></p><?php endif; ?>
			<?php if($date): ?><p class="date meta"><b><?php _e('Date', 'TR'); ?>:</b><?php echo $date; ?></p><?php endif; ?>
			<?php if($client): ?><p class="client meta"><b><?php _e('Client', 'TR'); ?>:</b><?php echo $client; ?></p><?php endif; ?>
			<?php if($client_url): ?><p class="client-url"><a href="<?php echo $client_url; ?>" rel="nofollow external"><?php _e('Launch Project', 'TR'); ?></a></p><?php endif; ?>
		</div>

		<div class="post-format"><?php the_content(); ?></div>

	</div>
	<!--End Post Content-->

	</div>
	<!--End Portfolio Single-->

	<?php
		if(comments_open() && $enable_comments == true) { comments_template( '', true ); }
	?>

	<?php endif; ?>
</article>
<!--End Content-->

</div>
<!-- #main -->

<?php
	if($enable_related_posts == true) {
		echo '<div class="footer-related-posts">';
		echo '<div class="col-width">';
		theme_related_post('portfolio', 'portfolio-category', true, true, $posts_per_page);
		echo '</div>';
		echo '</div>';
	}
?>

<?php get_footer(); ?>
