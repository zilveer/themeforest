<?php
/**
 *
 * Template Name: Portfolio
 * This is the portfolio template, to use with your portfolio pages. 
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

get_header();

global $mpcth_settings;
global $ID;
global $mpcth_options;

// get custom meta data portfolio item
$page_meta = get_post_custom($ID);

// get query categories
$page_categories = isset($page_meta['portfolio_cat']) ? $page_meta['portfolio_cat'] : array('a:0:{}');

$display_categories = mpcth_get_query_categories($page_categories, 'portfolio');

// get sidebar position
$sidebar_position = 'none';

// get post order
$postOrder = $mpcth_settings['portfolioPostLayoutOrder'];

// prepare category filter
$categories = mpcth_get_filter_categories($page_categories, 'portfolio');

?>
	<?php if($mpcth_settings['portfolioCategoryFilter'] == 'true')
				echo $categories;
	?>

	<!-- Display menu on the side and logo (if set in settings ) -->
	<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

	<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">

		<div id="mpcth_page_content">
			<?php 

			$sticky_posts = get_option("sticky_posts"); ?>
				
			<div id="mpcth_page_articles" class="mpcth-<?php echo $mpcth_settings['portfolioType']; ?>">
				
				<?php
				$paged = mpcth_get_paged();

				$query = new WP_Query();
				$query->query(array(
					'post_type' 				=> 'portfolio',
					'mpcth_portfolio_category' 	=> $display_categories,
					'paged' 					=> $paged,
					'posts_per_page'			=> $page_meta['portfolio_post_display'][0],
					'showposts'					=> '',
					'post__not_in'				=> $sticky_posts
				));

				if ($query->have_posts()) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); 
						
						// get custom post data 
						global $more;
						$more = 0;
						$post_meta = get_post_custom($post->ID);
						$post_format = get_post_format();
						$post_double_width = isset($post_meta['double_width_enabled']) && $post_meta['double_width_enabled'][0] == 'on' ? ' mpcth-double-width-post ' : '';

						$post_size = isset($post_meta['post_size']) ? $post_meta['post_size'][0] : '';
						$post_prop = isset($page_meta['post_prop']) ? ' '.$page_meta['post_prop'][0].' ' : '';


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
							$post_image = 'format-image ';
						else
							$post_image = '';

						// get posts categories
						$portfolio_categories = '';
						$portfolio_categories = get_the_terms($post->ID, 'mpcth_portfolio_category');
						if(isset($portfolio_categories) && $portfolio_categories != ''){
							$category_slug = '';
							foreach($portfolio_categories as $category) {
								$category_slug .= 'category-'.$category->slug.' '; 
							}
						}
					?>	
						<article id="post-<?php the_ID(); ?>" <?php post_class('mpcth-portfolio-item post ' . $post_image . $post_prop . $post_size . $post_double_width . $category_slug . ($mpcth_settings['portfolioRemoveFrame'] == 'true' ? 'mpcth-portfolio-no-frame' : '')); ?> >
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
					<?php endwhile; ?>
				<?php else : ?>
					<article id="post-0" class="post no-results not-found ">
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
				do_action('mpcth_add_load_more', $query, 'portfolio');

				if($query->max_num_pages > 1)
					mpcth_display_loadmore($mpcth_settings['portfolioDisplayLMInfo']);
			?>
		</div><!-- end #mpcth_page_content -->

		<?php if($sidebar_position != "none")
			get_sidebar(); ?>

	</div><!-- #mpcth_page_container -->
	
<?php get_footer(); ?>