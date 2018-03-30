<?php
	global $g5plus_options,$g5plus_archive_loop;

    $layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
    if (!in_array($layout_style, array('full','container','container-fluid'))) {
        $layout_style = $g5plus_options['archive_layout'];
    }

    $sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : '';
    if (!in_array($sidebar, array('none','left','right','both'))) {
        $sidebar = $g5plus_options['archive_sidebar'];
    }

    $archive_paging_style = isset($_GET['paging']) ? $_GET['paging'] : '';
    if (!in_array($archive_paging_style, array('default','load-more','infinity-scroll'))) {
        $archive_paging_style = $g5plus_options['archive_paging_style'];
    }

	$archive_paging_align = isset($_GET['paging-align']) ? $_GET['paging-align'] : '';
	if (!in_array($archive_paging_align, array('left','center','right'))) {
		$archive_paging_align = isset($g5plus_options['archive_paging_align']) ? $g5plus_options['archive_paging_align'] : 'right';
	}

    $archive_display_type = isset($_GET['style']) ? $_GET['style'] : '';
    if (!in_array($archive_display_type, array('large-image','medium-image','grid','masonry'))) {
        $archive_display_type = $g5plus_options['archive_display_type'];
    }

    $sidebar_width = isset($_GET['sidebar_width']) ? $_GET['sidebar_width'] : '';
    if (!in_array($sidebar_width, array('small','large'))) {
        $sidebar_width = $g5plus_options['archive_sidebar_width'];
    }

	$left_sidebar = $g5plus_options['archive_left_sidebar'];
	$right_sidebar = $g5plus_options['archive_right_sidebar'];


    $archive_display_columns = isset($_GET['columns']) ? $_GET['columns'] : '';
    if (!in_array($archive_display_columns, array('2','3','4'))) {
        $archive_display_columns = $g5plus_options['archive_display_columns'];
    }



	$sidebar_col = 'col-md-3';
	if ($sidebar_width == 'large') {
		$sidebar_col = 'col-md-4';
	}

	$content_col_number = 12;
	if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'both') || ($sidebar == 'left'))) {
		if ($sidebar_width == 'large') {
			$content_col_number -= 4;
		}
		else {
			$content_col_number -= 3;
		}
	}
	if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'both') || ($sidebar == 'right'))) {
		if ($sidebar_width == 'large') {
			$content_col_number -= 4;
		}
		else {
			$content_col_number -= 3;
		}
	}

	$content_col = 'col-md-' . $content_col_number;
	if (($content_col_number == 12) && ($layout_style == 'full')) {
		$content_col = '';
	}

    $blog_class = array('blog-inner','clearfix');
    $blog_class[] = 'blog-style-' . $archive_display_type;
    $blog_class[] = 'blog-paging-'.$archive_paging_style;

	if (in_array($archive_display_type,array('grid','masonry'))) {
		$blog_class[] = 'blog-col-'.$archive_display_columns;
	}

    $blog_wrap_class= array('blog-wrap');

    $blog_wrap_class[] = 'layout-' . $layout_style;
    $blog_wrap_class[] = $archive_display_type;
	switch ($archive_display_type) {
		case 'large-image':
			$g5plus_archive_loop['image-size'] = 'blog-large-image-full-width';
			if ($content_col_number < 12) {
				$g5plus_archive_loop['image-size'] = 'blog-large-image-sidebar';
			}
			break;
		case 'medium-image':
			$g5plus_archive_loop['image-size'] = 'blog-medium-image';
			break;
		case 'grid':
			$g5plus_archive_loop['image-size'] = 'blog-grid';
			break;
	}

    $g5plus_archive_loop['style'] = $archive_display_type;

	$blog_paging_class = array('blog-paging-wrapper');
	$blog_paging_class[] = 'blog-paging-' . $archive_paging_style;
	$blog_paging_class[] = 'text-' . $archive_paging_align;
?>
<?php
/**
 * @hooked - g5plus_archive_heading - 5
 **/
do_action('g5plus_before_archive');
?>
<main class="site-content-archive">
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
				<div class="site-content-archive-inner <?php echo esc_attr($content_col) ?>">
					<div class="<?php echo join(' ',$blog_wrap_class); ?>">
						<div class="<?php echo join(' ',$blog_class); ?>">
							<?php
								if ( have_posts() ) :
									// Start the Loop.
									while ( have_posts() ) : the_post();
										/*
										 * Include the post format-specific template for the content. If you want to
										 * use this in a child theme, then include a file called called content-___.php
										 * (where ___ is the post format) and that will be used instead.
										 */
										g5plus_get_template( 'archive/content' , get_post_format() );
									endwhile;
                                    g5plus_archive_loop_reset();
								else :
									// If no content, include the "No posts found" template.
									g5plus_get_template( 'archive/content-none');
								endif;
							?>
						</div>
						<?php
						global $wp_query;
						if ( $wp_query->max_num_pages > 1 ) :
						?>
							<div class="<?php echo join(' ',$blog_paging_class); ?>">
								<?php
								switch($archive_paging_style) {
									case 'load-more':
										g5plus_paging_load_more();
										break;
									case 'infinity-scroll':
										g5plus_paging_infinitescroll();
										break;
									default:
										echo g5plus_paging_nav();
										break;
								}
								?>
							</div>
						<?php endif;?>
					</div>
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