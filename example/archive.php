<?php

/**
 *
 * Archive 
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 * Archive.php is a fallback for: tag.php, category.php, 
 * author.php and (month,day,year).php Instead of having 
 * multiple files we handle all of them here.
 *
 */

get_header(); 

global $wp_query;
global $mpcth_options;

$query_vars = $wp_query->query;
$query_vars['post_type'] = array('post', 'portfolio');

$query = new WP_Query();
$query->query($query_vars);

if(isset($mpcth_options) && isset($mpcth_options['mpcth_archive_sidebar']))
	$sidebar_position = $mpcth_options['mpcth_archive_sidebar'];
else
	$sidebar_position = 'none';

$postOrder = $mpcth_settings['archivePostLayoutOrder'];

if(get_query_var('author_name'))
	$author = get_user_by('login', get_query_var('author_name'));
else 
	$author = get_userdata(get_query_var('author'));

?>

<!-- Display menu on the side and logo (if set in settings ) -->
<?php get_template_part('mpc-wp-boilerplate/php/parts/side-menu'); ?>

<div id="mpcth_page_container" class="mpcth-sidebar-<?php echo $sidebar_position ?>">
	
	<div id="mpcth_page_content">
		<div id="mpcth-archive-header-info">
			<!-- post cornsers -->
			<span class="mpcth-corner-tl"></span>
			<span class="mpcth-corner-tr"></span>
			<span class="mpcth-corner-bl"></span>
			<span class="mpcth-corner-br"></span>
			<span>
				<?php if (is_author()) { 
					echo $author->display_name; 		
				} elseif(is_category()) {
					single_cat_title('');
				} elseif(is_tag()) {
					single_tag_title('');
				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
					 _e('Archive', 'mpcth');
				} elseif(is_year() || is_month() || is_day()){ 
					 _e('Archive', 'mpcth');
				} elseif( is_tax() ) {
					$term = $query->get_queried_object();
					$title = $term->name;
					echo $title;
				} ?>
				<?php if (is_author()) { 
					_e('posts by author', 'mpcth'); 		
				} elseif(is_category()) {
					_e('posts displayed by category ', 'mpcth');
				} elseif(is_tag()) {
					_e('posts displayed by tag ', 'mpcth');
				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
					_e('for ', 'mpcth');
					the_time('F, Y'); 
				} elseif(is_year()) { 
					_e('for ', 'mpcth');
					the_time('Y'); 
				} elseif(is_month()) { 
					_e('for ', 'mpcth');
					the_time('F, Y'); 
				} elseif(is_day()) { 
					_e('for ', 'mpcth');
					the_time('F jS, Y'); 
				} elseif( is_tax() ) {
					_e('posts displayed by category', 'mpcth');
				}?>
			</span>
		</div>

		<div id="mpcth_page_articles" class="mpcth-<?php echo $mpcth_settings['archiveType']; ?>">
	
		<?php 
		
		if ($query->have_posts()) :
			while ($query->have_posts()):
				$query->the_post(); 
			
				/* Get custom post data */
				$post_meta = get_post_custom($post->ID);
				$post_format = get_post_format();
				$post_type = $post->post_type;

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
			<?php endwhile; ?>
		<?php endif; ?> 
		</div> <!-- end #mpcth_page_articles -->
		<?php
			do_action('mpcth_add_load_more', $query, 'archive');

			if($query->max_num_pages > 1)
				mpcth_display_loadmore($mpcth_settings['archiveDisplayLMInfo']);
		?>

		</div><!-- end #mpcth_page_content -->

		<?php if($sidebar_position != "none")
			get_sidebar(); ?>

	</div><!-- #mpcth_page_container -->
		
<?php get_footer(); ?>