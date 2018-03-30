<?php
global $g5plus_options;
$prefix = 'g5plus_';
$layout_style = rwmb_meta($prefix.'page_layout');
if (($layout_style === '') || ($layout_style == '-1')) {
	$layout_style = $g5plus_options['page_layout'];
}

$sidebar = rwmb_meta($prefix.'page_sidebar');
if (($sidebar === '') || ($sidebar == '-1')) {
	$sidebar = $g5plus_options['page_sidebar'];
}

$left_sidebar = rwmb_meta($prefix.'page_left_sidebar');
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
	$left_sidebar = $g5plus_options['page_left_sidebar'];

}

$right_sidebar = rwmb_meta($prefix.'page_right_sidebar');
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
	$right_sidebar = $g5plus_options['page_right_sidebar'];
}

$sidebar_width = rwmb_meta($prefix.'sidebar_width');
if (($sidebar_width === '') || ($sidebar_width == '-1')) {
	$sidebar_width = $g5plus_options['page_sidebar_width'];
}

$page_comment = $g5plus_options['page_comment'];

// Calculate sidebar column & content column
$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
	$sidebar_col = 'col-md-4';
}

$content_col_number = 12;
if (is_active_sidebar($left_sidebar) && (($sidebar == 'both') || ($sidebar == 'left'))) {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	} else {
		$content_col_number -= 3;
	}
}
if (is_active_sidebar($right_sidebar) && (($sidebar == 'both') || ($sidebar == 'right'))) {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	} else {
		$content_col_number -= 3;
	}
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
	$content_col = '';
}

$main_class = array('site-content-page');

if ($content_col_number < 12) {
    $main_class[] = 'has-sidebar';
}
?>
<?php
/**
 * @hooked - g5plus_page_heading - 5
 **/
do_action('g5plus_before_page');
?>
<main  class="<?php echo join(' ',$main_class) ?>">
	<?php if ($layout_style != 'full'): ?>
	<div class="<?php echo esc_attr($layout_style) ?> clearfix">
		<?php endif;?>
		<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
		<div class="row clearfix">
			<?php endif;?>
			<?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
				<div class="sidebar left-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
					<?php dynamic_sidebar( $left_sidebar );?>
				</div>
			<?php endif;?>
			<div class="site-content-page-inner <?php echo esc_attr($content_col) ?>">
				<div class="page-content">
                    <?php
                    // Start the Loop.
                    while (have_posts()) : the_post();
                        // Include the page content template.
                        g5plus_get_template('content', 'page');
                    endwhile;
                    ?>
				</div>
                <?php if ($page_comment == 1) {
                    comments_template();
                } ?>
			</div>
			<?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
				<div class="sidebar right-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs sidebar-<?php echo esc_attr($sidebar_width); ?>">
					<?php dynamic_sidebar( $right_sidebar );?>
				</div>
			<?php endif;?>
			<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
		</div>
	<?php endif;?>
		<?php if ($layout_style != 'full'): ?>
	</div>
<?php endif;?>
</main>