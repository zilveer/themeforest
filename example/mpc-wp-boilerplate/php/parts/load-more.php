<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

if(file_exists('../../../../../../wp-load.php')) :
	include '../../../../../../wp-load.php';
else:
	include '../../../../../../../wp-load.php';
endif;

ob_start();



$offset = (int)$_POST['offset'];
$post_type = $_POST['post_type'];
$posts_per_page = (int)$_POST['posts_per_page'];
$mpcth_settings = $_POST['mpcth_settings'];
$query_vars = $_POST['query_vars'];

$query_conf = $query_vars;
$query_conf['posts_per_page'] = $posts_per_page;
$query_conf['offset'] = $offset;
$query_conf['post__not_in'] = get_option("sticky_posts");

$query = new WP_Query();
$query->query($query_conf);

if ($query->have_posts()) :
	while ( $query->have_posts() ) : $query->the_post();
		// get custom post data
		global $more;
		$more = 0;
		$post_meta = get_post_custom($post->ID);
		$the_post_type = $post->post_type;
		$post_format = get_post_format();
		$post_double_width = isset($post_meta['double_width_enabled']) && $post_meta['double_width_enabled'][0] == 'on' ? ' mpcth-double-width-post ' : '';


		$post_size = isset($post_meta['post_size']) ? $post_meta['post_size'][0] : '';
		//$post_prop = 'rectangle';

		//echo "PAGE META = ".$post_prop;


		switch($post_size) {
			case '1:1' :
						$post_size = ' mpcth-post-size-1-1 ';
						break;
			case '2:1' :
						$post_size = ' mpcth-post-size-2-1 ';
						break;
			case '1:2' :
						$post_size = ' mpcth-post-size-1-2 ';
						break;
			case '2:2' :
						$post_size = ' mpcth-post-size-2-2 ';
						break;
		}

		if($post_format == '')
			$post_format = 'standard';

		if($post_format == 'standard' && has_post_thumbnail())
			$post_image = ' format-image ';
		else
			$post_image = '';

		if($post_type == 'portfolio' || $post_type == 'gallery') {
			$categories = get_the_terms($post->ID, 'mpcth_' . $post_type . '_category');
			if(isset($categories) && $categories != ''){
				$category_slug = '';
				foreach($categories as $category) {
					$category_slug .= ' category-'.$category->slug.' ';
				}
			}
			$categories = get_the_terms($post->ID, 'mpcth_' . $post_type . '_category');
		}

		if($the_post_type == 'post')
			$post_type_info = __('Post', 'mpcth');
		elseif($the_post_type == 'portfolio')
			$post_type_info = __('Portfolio', 'mpcth');
		elseif($the_post_type == 'gallery')
			$post_type_info = __('Gallery', 'mpcth');
		elseif($the_post_type == 'page')
			$post_type_info = __('Page', 'mpcth');
		else
			$post_type_info = '';

		if($post_type == 'search' || $post_type == 'archive') :
			$postOrder = $mpcth_settings['blogPostLayoutOrder']; ?>
			<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post post' . $post_image); ?> >
				<!-- post cornsers -->
				<span class="mpcth-corner-tl"></span>
				<span class="mpcth-corner-tr"></span>
				<span class="mpcth-corner-bl"></span>
				<span class="mpcth-corner-br"></span>

				<?php foreach($postOrder as $value) {
					switch($value) {
						case 'thumbnailaa':?>
							<div class="mpcth-post-thumbnail">
								<?php get_template_part('mpc-wp-boilerplate/php/parts/post-formats'); ?>
								<?php mpcth_add_fancybox($post_meta); ?>
							</div>
						<?php break;
						case 'title':?>
							<div class="mpcth-post-content">
							<?php if($post_format != 'aside' && $post_format != 'link' && $post_format != 'quote') { ?>
								<header>
									<h3 class="mpcth-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a></h3>
								</header>
							<?php } ?>
						<?php break;
						case 'meta':?>
							<?php get_template_part('mpc-wp-boilerplate/php/parts/post-meta'); ?>
						<?php break;
						case 'content':?>
							<?php the_excerpt(); ?>
						<?php break;
						case 'readmore':?>
							<a class="mpcth-blog-read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'mpcth'); ?></a>
							<small><?php echo $post_type_info; ?></small>
							</div>
						<?php break; ?>
				<?php } //end switch
				} // end foreach ?>
			</article>
		<?php elseif($post_type != 'portfolio' && $post_type != 'gallery') :
			$postOrder = $mpcth_settings['blogPostLayoutOrder']; ?>
			<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post post' . $post_image); ?> >
				<!-- post cornsers -->
				<span class="mpcth-corner-tl"></span>
				<span class="mpcth-corner-tr"></span>
				<span class="mpcth-corner-bl"></span>
				<span class="mpcth-corner-br"></span>

				<?php foreach($postOrder as $value) {
					switch($value) {
						case 'thumbnail':?>
							<div class="mpcth-post-thumbnail">
								<?php get_template_part('mpc-wp-boilerplate/php/parts/post-formats'); ?>
								<?php mpcth_add_fancybox($post_meta); ?>
							</div>
							<div class="mpcth-post-content">
						<?php break;
						case 'title':?>
							<?php if($post_format != 'aside' && $post_format != 'link' && $post_format != 'quote') { ?>
								<header>
									<h3 class="mpcth-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a></h3>
								</header>
							<?php } ?>
						<?php break;
						case 'meta':?>
							<?php get_template_part('mpc-wp-boilerplate/php/parts/post-meta'); ?>

						<?php break;
						case 'content':?>
							<?php the_content('', true, ''); ?>
						<?php break;
						case 'readmore':?>
							<a class="mpcth-blog-read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'mpcth'); ?></a>
							</div>
						<?php break; ?>
				<?php } //end switch
				} // end foreach ?>
			</article>
		<?php elseif($post_type == 'portfolio') :
			// get post order
			$postOrder = $mpcth_settings['portfolioPostLayoutOrder']; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-portfolio-item post ' . $post_image . $post_size . $post_double_width . $category_slug . ($mpcth_settings['portfolioRemoveFrame'] == 'true' ? 'mpcth-portfolio-no-frame' : '')); ?> >
				<?php foreach($postOrder as $value) {
					switch($value) {
						case 'thumbnail':?>
							<div class="mpcth-post-thumbnail">
								<?php if(has_post_thumbnail()) {
									$meta = wp_get_attachment_metadata(get_post_thumbnail_id());
									echo '<div class="mpcth-hidden-thumb-meta" data-width="' . $meta['width'] . '" data-height="' . $meta['height'] . '" data-ratio="' . ($meta['height'] / $meta['width']) . '"></div>';

									the_post_thumbnail();
								} ?>
							</div>
							<div class="mpcth-post-content">
								<div class="mpcth-portfolio-top-post-divider"></div>
						<?php break;
						case 'title':?>
							<?php if($mpcth_settings['portfolioDisplayTitle'] == 'true') { ?>
								<?php if($post_format != 'aside' && $post_format != 'link' && $post_format != 'quote') { ?>
									<header>
										<h3 class="mpcth-post-title">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
										</h3>
									</header>
								<?php } ?>
							<?php } ?>
						<?php break;
						case 'meta':?>
							<?php if($mpcth_settings['portfolioDisplayMeta'] == 'true') {
								?>
								<div class="mpcth-folio-cat">
								<?php
								//get_template_part('mpc-wp-boilerplate/php/parts/post-meta');
								$categories = '';
								if($post->post_type == 'post')
									$categories = get_the_category();
								elseif($post->post_type == 'portfolio')
									$categories = get_the_terms($post->ID, 'mpcth_portfolio_category');

								if($categories != '' && count($categories) > 0) {
									$last_item = end($categories);
									foreach($categories as $category) {
										if($post->post_type == 'post')
											echo '<a href="'.get_category_link($category->term_id ).'">';
										elseif($post->post_type == 'portfolio')
											echo '<a href="'.get_term_link($category->slug, 'mpcth_portfolio_category' ).'">';

										echo $category->name;
										echo '</a>';

										if($category != $last_item)
											echo '  //  ';
									} ?>
									</div>
									<?php if( function_exists('zilla_likes') ) {
										zilla_likes();
									} ?>
								<?php }
							} ?>
						<?php break;
						case 'content':?>
							<?php if($mpcth_settings['portfolioDisplayContent'] == 'true') { ?>
								<?php //the_content('', true, ''); ?>
							<?php } ?>
						<?php break;
						case 'readmore':?>
							<!-- <a class="mpcth-portfolio-read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'mpcth'); ?></a> -->
							<?php mpcth_add_fancybox($post_meta, 'portfolio'); ?>
							</div>
						<?php break; ?>

				<?php } //end switch
				} // end foreach ?>
			</article>
		<?php elseif($post_type == 'gallery') :
			// get post order
			$postOrder = $mpcth_settings['galleryPostLayoutOrder']; ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-gallery-item post' . $post_image . $post_double_width . $category_slug); ?> >
				<div class="mpcth-post-thumbnail">
					<?php if($post_format == 'audio') echo '<div class="mpcth-post-audio-note"><span class="mpcth-post-audio-icon mpcth-sc-icon-note-beamed"></span></div>' ?>
					<?php get_template_part('mpc-wp-boilerplate/php/parts/post-formats'); ?>
					<?php mpcth_add_fancybox($post_meta); ?>
				</div>
			</article>
	<?php endif; endwhile; endif; ?>
<?php ob_end_flush(); ?>