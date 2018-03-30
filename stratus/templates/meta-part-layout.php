<?php
//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------

/* PAGE LAYOUT */
$page_layout = get_post_meta($post->ID, 'themo_page_layout', true ); // Returns Page layout Meta Option. Gonna be left, right or full.
$has_sidebar = themo_has_sidebar($page_layout); // true if sidebar active

/* 
Full width / Sidebar Markup
If sidebar is active, add container and row classes just below .inner-content only.
For full width add container and row to templates parts only.
*/
// Outer Tags output just after "inner-container" class (includes open and close tags)
$outer_container_open = themo_return_outer_tag("<div class='container'>",$has_sidebar);
$outer_row_open = themo_return_outer_tag("<div class='row'>",$has_sidebar);

$outer_container_close = themo_return_outer_tag("</div><!-- /.container -->",$has_sidebar);
$outer_row_close = themo_return_outer_tag("</div><!-- /.row -->",$has_sidebar);

// Inner tags output inside template parts (includes open and close tags)
$inner_container_open = themo_return_inner_tag("<div class='container'>",$has_sidebar);
$inner_row_open = themo_return_inner_tag("<div class='row'>",$has_sidebar);

$inner_container_close = themo_return_inner_tag("</div><!-- /.container -->",$has_sidebar);
$inner_row_close = themo_return_inner_tag("</div><!-- /.row -->",$has_sidebar);

// Main Class for sidebar support.
$main_class_open = themo_return_outer_tag('<div class="main col-sm-8" role="main">',$has_sidebar);
$main_class_close = themo_return_outer_tag('</div><!-- /.main -->',$has_sidebar);