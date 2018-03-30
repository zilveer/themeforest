<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($comments) {
	echo '<div class="post-comments-wrap">';
		get_template_part('templates/entry-meta/mini', 'comments-number');
	echo '</div>';
}
if($likes) {
	echo '<div class="post-like-wrap">';
		get_template_part('templates/entry-meta/mini', 'like');
	echo '</div>';
}