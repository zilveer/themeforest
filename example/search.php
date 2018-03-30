<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 * 
 */
 
get_header();

global $mpcth_settings;
global $mpcth_options;

if(isset($mpcth_options) && isset($mpcth_options['mpcth_search_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_search_sidebar'];
else
	$sidebar_position = 'none';

$postOrder = $mpcth_settings['searchPostLayoutOrder'];
?>

<!-- Display menu on the side and logo (if set in settings ) -->
<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">

	<div id="mpcth_page_content">
		<div id="mpcth-search-header-info">
			<!-- post cornsers -->
			<span class="mpcth-corner-tl"></span>
			<span class="mpcth-corner-tr"></span>
			<span class="mpcth-corner-bl"></span>
			<span class="mpcth-corner-br"></span>

			<span><?php _e('Search Results', 'mpcth'); ?> <?php printf( __('for: %s', 'mpcth'), '"'.get_search_query().'"' ); ?></span>
		</div>
		<div id="mpcth_page_articles" class="mpcth-<?php echo $mpcth_settings['searchType']; ?>">
	<?php 

	$query = new WP_Query(array('s' => get_search_query()));

	if ($query->have_posts()) :
		while ($query->have_posts()):
			$query->the_post();

			/* Get custom post data */
			$post_meta = get_post_custom($post->ID);
			$post_type = $post->post_type;
			$post_format = get_post_format();
			
			if($post_format == '')
				$post_format = 'standard'; 

			if($post_type == 'portfolio' || $post_type == 'gallery') {
				$categories = get_the_terms($post->ID, 'mpcth_' . $post_type . '_category');
				if(isset($categories) && $categories != ''){
					$category_slug = '';
					foreach($categories as $category) {
						$category_slug .= 'category-'.$category->slug.' '; 
					}
				}
				$categories = get_the_terms($post->ID, 'mpcth_' . $post_type . '_category');
			}

			if($post_type == 'post')
				$post_type_info = __('Post', 'mpcth');
			elseif($post_type == 'portfolio')
				$post_type_info = __('Portfolio', 'mpcth');
			elseif($post_type == 'gallery')
				$post_type_info = __('Gallery', 'mpcth');
			elseif($post_type == 'page')
				$post_type_info = __('Page', 'mpcth');
			else
				$post_type_info = '';

			?>
			<article id="post-<?php the_ID(); ?>"  <?php post_class('blog-post post'); ?> >
				<!-- post cornsers -->
				<span class="mpcth-corner-tl"></span>
				<span class="mpcth-corner-tr"></span>
				<span class="mpcth-corner-bl"></span>
				<span class="mpcth-corner-br"></span>

				<?php foreach($postOrder as $value) { 
					switch($value) {
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
							<?php the_excerpt(); // the_content('', true, ''); ?>
						<?php break;
						case 'readmore':?>
							<a class="mpcth-blog-read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'mpcth'); ?></a>
							<small><?php echo $post_type_info; ?></small>
							</div>
						<?php break; ?>
				<?php } //end switch 
				} // end foreach ?>
			</article>
		<?php endwhile; ?>
	<?php endif; ?> 
		</div> <!-- end #mpcth_page_articles -->
		<?php 
			do_action('mpcth_add_load_more', $query, 'search'); 

			if($query->max_num_pages > 1)
				mpcth_display_loadmore($mpcth_settings['searchDisplayLMInfo']);
		?>

	</div><!-- end #mpcth_page_content -->

	<?php if($sidebar_position != "none")
		get_sidebar(); ?>

</div><!-- #mpcth_page_container -->
	
<?php get_footer(); ?>