<?php
/**
 * Single Staff member template file.
 */
get_header();
?>
<div class="white-bg">
	<div class="clearfix"></div>
		<div class="">
			<?php
			echo '
			<div class="page-title">';
			if ( !is_front_page() && !is_home() ) {
				echo ch_breadcrumbs();
			}
			echo '
				' . the_title( '<h1>', '</h1>' ) . '
			</div>
			<div class="clearfix"></div>';

			if ( have_posts() ) {

				// Member position
				$member_position = get_post_custom_values('member_position');

				// Member image
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'staff-image');
			?>
				<div class="member-container entry-content row-fluid">
					<div class="member-image span10">
						<?php if ( !empty($img) ) echo '<img src="' . $img[0] . '" alt="" />'; ?>
					</div>
					<?php if ( !empty($member_position) ) { ?>
					<div class="member_position span13 pull-right">
						<?php echo $member_position[0]; ?>
					</div>
					<?php 
					}
					?>
					<div class="member-text span13 pull-right">
						<?php the_content(); ?>
					</div>
				</div>
			<?php
			} else {
				echo '
					<h2>Nothing Found</h2>
					<p>Sorry, it appears there is no content in this section.</p>';
			}
			?>
		</div>
	<div class="clearfix"></div>
</div>
<?php $ch_is_in_sidebar = false; ?>
<?php get_footer();