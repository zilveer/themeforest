<?php
/**
 *
 * This is the blog template, to use with your blogs. 
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

get_header();

global $mpcth_settings;
global $ID;
global $mpcth_options;

// get custom meta data
$page_meta = get_post_custom($ID);

// get query categories (which categories to display)
$page_categories = isset($page_meta['blog_cat']) ? $page_meta['blog_cat'] : array('a:0:{}');

$display_categories = mpcth_get_query_categories($page_categories);

// get sidebar position
if(isset($page_meta['custom_sidebar_position']) && $page_meta['custom_sidebar_position'][0] == 'on' && isset($page_meta['sidebar_position']))
	$sidebar_position = $page_meta['sidebar_position'][0]; /* right, left or none */
elseif(isset($mpcth_options) && isset($mpcth_options['mpcth_blog_post_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_blog_post_sidebar'];
else
	$sidebar_position = 'none';

// get post elements display order
$postOrder = $mpcth_settings['blogPostLayoutOrder'];

// prepare category filter
$categories = mpcth_get_filter_categories($page_categories, 'blog');

?>
	<!-- Display menu on the side and logo (if set in settings ) -->
	<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

	<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">
		
		<div id="mpcth_page_content">
			<?php 
			if($mpcth_settings['blogCategoryFilter'] == 'true')
				echo $categories;

			$sticky_posts = get_option("sticky_posts"); ?>

			<div id="mpcth_page_articles" class="mpcth-<?php echo $mpcth_settings['blogType']; ?>">
				
				<?php 
				$paged = mpcth_get_paged();
				
				$query = new WP_Query();

				$query->query(array(
					'post_type' 	=> 'post',
					'category_name' => $display_categories,
					'paged' 		=> $paged,
					'post__not_in'	=> $sticky_posts
				));

				if ($query->have_posts()) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post();
						/* Get custom post data */
						global $more;
						$more = 0;
						$post_meta = get_post_custom($post->ID);
						$post_format = get_post_format();
						$post_double_width = isset($post_meta['double_width_enabled']) && $post_meta['double_width_enabled'][0] == 'on' ? ' mpcth-double-width-post' : '';

						if($post_format == '')
							$post_format = 'standard';

						if($post_format == 'standard' && has_post_thumbnail())
							$post_image = ' format-image';
						else
							$post_image = '';
					?>	
						<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post' . $post_image . $post_double_width); ?> >

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
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="post no-results not-found">
						<div class="mpcth-post-content">
							<header>
								<h3 class="mpcth-post-title"><?php _e('Nothing Found', 'mpcth'); ?></h3>
							</header><!-- end .entry-header -->
							<p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mpcth'); ?></p>
						</div><!-- end .entry-content -->
					</article><!-- end #post-0 -->
				<?php endif; ?> 
			</div> <!-- end #mpcth_page_articles -->

			<?php
				do_action('mpcth_add_load_more', $query);
				
				if($query->max_num_pages > 1)
					mpcth_display_loadmore($mpcth_settings['blogDisplayLMInfo']);
			?>
		</div><!-- end #mpcth_page_content -->

		<?php if($sidebar_position != "none")
			get_sidebar(); ?>

	</div><!-- #mpcth_page_container -->
	
<?php get_footer(); ?>