<?php
/**
 * The default template for displaying staff content
 *
 * @package WordPress
 * @subpackage Believe
 */

$m = 0; ?>
<div class="staff-wrapper">
	<?php
	/* Start the Loop */
	while ( have_posts() ) { the_post();
		global $ch_from_search;
		$show_sep = false;
		$style    = '';
		$clear    = '';

		// Determine staff image size
		if ($ch_from_search) {
			if (LAYOUT == 'sidebar-no' || $ch_from_search) {
				$img_width  = '326';
				$img_height = '245';
			}
			$clear = ' style="float: none;"';
			$style = ' style="width: ' . $img_width . 'px; height: ' . $img_height . 'px;"';
		} else {
			$img_width  = '326';
			$img_height = '245';
			$top_left   = 'style="top: 37%; left: 41%;"';
		}
		?>
		<div class="staff span7_5"<?php if ( $m == 0 || ( ( $m != 0 ) && $m % 3 == 0 && LAYOUT == 'sidebar-no' ) || ( ( $m != 0 ) && $m % 2 == 0 && LAYOUT != 'sidebar-no' ) ) echo ' style="margin-left: 0;"'; ?>>
			<?php
			// Member position
			$member_position = get_post_custom_values('member_position');

			// Member image
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'staff-image');
			if (isset($img[0])) {
			?>
			<div class="staff-image">
				<a class="size-thumbnail no_thickbox" href="<?php echo get_permalink(); ?>">
					<img src="<?php echo $img[0]; ?> "<?php echo $style; ?> class="image-with-border" alt="" />
					<div class="border" style="width: <?php echo $img_width; ?>px; height: <?php echo $img_height + 4;?>px;">
						<div class="open"></div>
					</div>
				</a>
			</div>
			<?php
			}
			?>
			<div class="staff-content">
				<div class="item-title-bg">
					<h2 class="entry-title span4"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="position span3 pull-right"><?php echo $member_position[0]; ?></div>
					<div class="clearfix"></div>
				</div>
				<div class="staff-text">
					<?php
						the_content();
					?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!--end of staff-->
		<?php
		$m++;

		if ( ( $m != 1 ) && $m % 3 == 0 && LAYOUT == 'sidebar-no' ) {
			echo '
			<div class="clearfix"></div>';
		} elseif ( ( $m != 1 ) && $m % 2 == 0 && LAYOUT != 'sidebar-no' ) {
			echo '
			<div class="clearfix"></div>';
		}
	} ?>
	<div class="clearfix"></div>
</div>