<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

?>

<small>
<?php

	/* Date */
	_e('On ', 'mpcth');
	echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">';
		the_time(get_option('date_format'));
	echo '</a>';

	/* Author */
	_e(' by ', 'mpcth');
	echo '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">';
		the_author();
	echo '</a>';

	/* Categories */
	$categories = '';

	if($post->post_type == 'post')
		$categories = get_the_category();
	elseif($post->post_type == 'portfolio')
		$categories = get_the_terms($post->ID, 'mpcth_portfolio_category');

	if($categories != '' && count($categories) > 0) {
		_e(' in ', 'mpcth');
		$last_item = end($categories);
		foreach($categories as $category) {
			if($post->post_type == 'post')
				echo '<a href="'.get_category_link($category->term_id ).'">';
			elseif($post->post_type == 'portfolio')
				echo '<a href="'.get_term_link($category->slug, 'mpcth_portfolio_category' ).'">';

			if($category == $last_item)
				echo $category->name;
			else 
				echo $category->name.', ';

			echo '</a>';
		}
	}

	

	/* Comments */
	if(comments_open()) {
		echo ' | <a href="' . get_comments_link() . '">';
			comments_number(__('0 comments', 'mpcth'), __('1 comment', 'mpcth') , __('% comments','mpcth'));
		echo '</a>';
	}

	/* Zilla Likes*/
	if( function_exists('zilla_likes') ) {
		echo ' | <span>';
			zilla_likes();
		echo '</span>';
	}

	/* Tags */
	if(is_single() && false) { //black belt fix ;]
		$tags = get_the_tags();
		
		if(is_array($tags)) {
			$last_item = end($tags);

			if($tags != '') {
				echo '<span class="mpcth-sc-icon-tag">';
					foreach($tags as $tag) {
						echo '<a href="'.get_tag_link($tag->term_id).'">';
						if($last_item->name == $tag->name) {
							echo $tag->name.'</a>.'; 
						} else {
							echo $tag->name.'</a>, ';
						}
					}
				echo '</span>';
			}
		}
	}

	echo '<div class="mpcth-clear-fix"></div>';
?>
</small>
