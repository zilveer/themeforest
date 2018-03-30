<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

// Option path
$option_path = 'meta'.(get_post_type() == 'post' ? (is_singular() ? '/single' : '/list') : '');
$theme_option_path = get_post_type().'/'.$option_path;
$post_option_path  = 'options/'.str_replace('/', '_', $option_path);

// Meta visibility
$visible = Website::io($post_option_path, $theme_option_path.'/visible');

// Meta
if ($visible === true || $visible === 'on') {

	$meta_items = Website::to($theme_option_path.'/items');

	if (!empty($meta_items)) {

		echo '<ul class="meta">';

		foreach ($meta_items as $meta_item) {

			switch ($meta_item) {
				case 'comments':
					if (Website::to(get_post_type().'/comments') && (comments_open() || have_comments())) {
						Website::postMetaFormat('<li class="comments"><a href="%comments_link%" title="%comments_number_esc%">%comments_number%</a></li>');
					}
					break;
				case 'author':
					Website::postMetaFormat('<li class="author"><a href="%author_link%" title="%author_name_esc%">%author_name%</a></li>');
					break;
				case 'date':
					Website::postMetaFormat('<li class="date published updated"><a href="%date_month_link%" title="%s">%date%</a></li>', sprintf(__('View all posts from %s', 'website'), get_the_date('F')));
					break;
				case 'date_time':
					Website::postMetaFormat(
						'<li class="date published updated"><a href="%date_month_link%" title="%s">%s</a></li>',
						sprintf(__('View all posts from %s', 'website'), get_the_date('F')),
						sprintf(__('%1$s at %2$s', 'website'), Website::getPostMeta('date'), Website::getPostMeta('time'))
					);
					break;
				case 'time_diff':
					Website::postMetaFormat('<li class="date"><a href="%link%" title="%title_esc%">%time_diff%</a></li>');
					break;
				case 'category':
					Website::postMetaFormat('[%category_list%]<li class="category">%category_list%</li>[/%category_list%]');
					break;
				case 'tags':
					Website::postMetaFormat('[%tags_list%]<li class="tags">%tags_list%</li>[/%tags_list%]');
					break;
				case 'link':
					Website::postMetaFormat('<li class="link"><a href="%link%" title="%title_esc%">%s</a></li>', __('Permalink', 'website'));
					break;
				case 'edit':
					Website::postMetaFormat('[%link_edit%]<li class="edit"><a href="%link_edit%" title="%1$s">%1$s</a></li>[/%link_edit%]', __('Edit', 'website'));
					break;
			}

		}

		echo '</ul>';

	}

}