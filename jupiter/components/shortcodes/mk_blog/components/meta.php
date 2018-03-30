<?php

echo '<div class="mk-blog-meta-wrapper">';
if(!isset($view_params['author'])) {
	ob_start();
	the_author_posts_link();
	$author_link = ob_get_contents();
	ob_get_clean();
	echo '<div class="mk-blog-author blog-meta-item"><span>' . __('By', 'mk_framework') . '</span> ' . $author_link . '</div>';

}
if(!isset($view_params['cats'])) {
	echo '<div class="mk-categories blog-meta-item"><span> ' . __('In', 'mk_framework') . '</span> ' . get_the_category_list(', ') . '</div>';
	
	if(!isset($view_params['time'])) {
		echo '<span>' . __('Posted', 'mk_framework') . '</span> ';
	}
}
if(!isset($view_params['time'])) {
	echo '<time datetime="' . get_the_date('Y-m-d') . '">';
	echo '<a href="' . get_month_link(get_the_time("Y") , get_the_time("m")) . '">' . get_the_date() . '</a>';
	echo '</time>';
}

echo '</div>';

