<?php

/**
 * The main template file.
 *
 * Required to display Blog page.
 *
 * @package WordPress
 * @subpackage Agera
 */

get_header();
global $more;

$mp_option = agera_get_global_options();
$page_id = $wp_query->get_queried_object_id();

$postNumber = 0;

$post_values = get_post_custom($page_id);
if( isset($post_values['page_background'][0]) )
	$page_data['background'] = $post_values['page_background'][0];
else
	$page_data['background'] = '';

?>

<style>
	#content {
		background: url(<?php echo $page_data['background']; ?>) no-repeat;
	}
</style>

<div id="content" role="main">
<?php if(!is_front_page()) {  ?> <!-- Not front page -->
	<!-- Display posts -->
	<div class="posts-container blog">
	<?php
		$blog_category = get_option('agera_blog_category');
		if(get_query_var('page') != '')
			$paged = get_query_var('page');
		else
			$paged = get_query_var('paged');

		$paged = $paged > 1 ? $paged : 1;

		$wp_query = new WP_Query('post_type=post&posts_per_page=&category_name='.$blog_category.'&paged=' . $paged);
		if ( $wp_query->have_posts()) {
			 while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$post_meta = '';
				$page_data = '';

				$post_meta = get_post_custom($post->ID);
				if(isset($post_meta['full_width_asset'][0]))
					$page_data['asset'] = $post_meta['full_width_asset'][0];

				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> >
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
									<div class="iframe-wrap">
										<iframe src="<?php echo $asset ?>?color=F9625B" width="100%" height="100%"></iframe>
									</div>
								<?php } elseif ($type == 'youtube-video') { ?>
									<div class="iframe-wrap">
										<iframe width="100%" height="100%" src="<?php echo $asset ?>?rel=0" frameborder="0" allowfullscreen></iframe>
									</div>
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
						<div class="mpc-post-content">
							<?php the_content('', TRUE, ''); ?>
						</div>
						<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>

						<a href="<?php the_permalink();?>" class="mpc-read-more" title="Read More">
							<span class="plus">
								<span class="plus-white"></span>
								<span class="plus-hover"></span>
							</span>
						</a>

						<?php } ?>
					</div><!-- end post-content-wrap -->
				</article><!-- end blog-post -->
			<?php } ?>

		 <?php } else { ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header search-result">
					<h3 class="entry-title"><?php _e( 'Nothing Found', 'agera' ); ?></h3>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'agera' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		<?php } ?>
		<a href="#" id="mpc_load_more" data-loading="<?php _e('loading...', 'agera'); ?>"><?php _e('load more', 'agera'); ?></a>
	</div>
	<?php
		$load_more_url = explode('"', get_next_posts_link());
		$load_more_url = $load_more_url[1];
	?>
	<div id="mpcth_load_info" data-all-posts="<?php echo $wp_query->found_posts; ?>" data-max-pages="<?php echo $wp_query->max_num_pages; ?>" data-next-url="<?php echo $load_more_url; ?>"></div>
<?php } ?><!-- end if -->
</div><!-- end content -->
<?php get_footer(); ?>
</body>
</html>