<?php get_header(); ?>
<?php
$content_width = jwLayout::content_width();
echo '<div id="content" class="' . implode(' ', $content_width) . ' ' . jwLayout::content_layout() . ' page">';
get_template_part('loop', 'page');

echo '</div>';
get_sidebar();
?>
<?php get_footer(); ?>