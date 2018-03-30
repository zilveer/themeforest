<?php

/**
 *
 * Archive
 *
 * @package WordPress
 * @subpackage Agera
 *
 * Archive.php is a fallback for: tag.php, category.php,
 * author.php and (month,day,year).php Instead of having
 * multiple files we handle all of them here.
 *
 */

global $page_id;
global $post;
global $mp_option;

$page_id = $post->ID;

get_header();

$mp_option = agera_get_global_options();
$page_id = $wp_query->get_queried_object_id();

if(get_query_var('author_name'))
	$author = get_user_by('login', get_query_var('author_name'));
else
	$author = get_userdata(get_query_var('author'));
?>

<style>
	#content {
		background: url(<?php echo $mp_option['agera_archive']; ?>) no-repeat;
	}
</style>

<div id="content" role="main">
	<!-- Display posts -->
	<div class="posts-container blog">
	<?php while (have_posts()) {
		the_post();
		$post_meta = '';
		$page_data = '';

		$post_meta = get_post_custom($post->ID);
		if(isset($post_meta['full_width_asset'][0]))
			$page_data['asset'] = $post_meta['full_width_asset'][0];
		 ?>

		<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post'); ?> >
			<div class="post-content-wrap">
				<span class="post-thumbnail" >
					<?php if (has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('blog_post_thumb'); ?>
					<?php } elseif( isset($page_data['asset']) && $page_data['asset'] != '') {
						$asset = $page_data['asset'];
						$search = preg_match('/.(jpg|JPG|gif|GIF|png)/', $asset);
						if($search == 1) {
							$type = 'image';
							$search = 0;
						}
						$search = preg_match('/.(vimeo)./', $asset);

						if($search == 1) {
							$type = 'vimeo-video';
							$search = 0;
						}

						$search = preg_match('/.(youtu)/', $asset);

						if($search == 1) {
							$type = 'youtube-video';
							$search = 0;
						}

						$search = substr($asset, 0, 1);

						if($search == '[') {
							$type = 'shortcode';
							$search = 0;
						}

						if($type == 'image') { ?>
							<img src="<?php echo $asset ?>" class="post-asset"/>
						<?php } elseif ($type == 'vimeo-video') { ?>
							<iframe src="<?php echo $asset ?>?color=F9625B" width="100%" height="100%"></iframe>
						<?php } elseif ($type == 'youtube-video') { ?>
							<iframe width="100%" height="100%" src="<?php echo $asset ?>?rel=0" frameborder="0" allowfullscreen></iframe>
						<?php } elseif ($type == "shortcode") {
							echo do_shortcode($asset);
						} ?>
					<?php } ?>
				</span>

				<small>
					<?php the_time('M d Y');?>
				&middot;
				<?php comments_number('0 comments','1 comment','% comments'); ?>
				&middot;
				<?php the_category(', '); ?>
				&middot;
				<?php  if( function_exists('zilla_likes') ) zilla_likes(); ?>
				</small>
				<h2 class="mpc-page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
				</a></h2>
				<?php the_content('', TRUE, ''); ?>
				<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>

				<a href="<?php the_permalink();?>" class="mpc-read-more" title="Read More">
					<span class="plus">
						<span class="plus-white"></span>
						<span class="plus-hover"></span>
					</span>
				</a>
				<?php } ?>
			</div>
		</article><!-- end blog-post -->
	 <?php } ?>
		 <div class="mpc-fix"></div>
	</div>
</div> <!-- end content -->

<?php get_footer(); ?>

</body>
</html>