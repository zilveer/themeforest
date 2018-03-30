<?php
/**
 * The Standard post header base for MPC Themes
 *
 * Displays the thumbnail for posts in the Standard post format.
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

$images = get_field('mpc_gallery_images');

if (!empty($images)) { ?>
	<div <?php echo is_single() ? 'id="main_slider"' : ''; ?> class="flexslider">
		<ul class="slides">
	<?php foreach ($images as $image) { ?>
		<li>
			<?php
				if (is_single())
					echo '<a class="mpcth-lightbox mpcth-lightbox-type-image" href="' . $image['url'] . '" title="' . $image['title'] . '"><img width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $image['alt'] . '" title="' . $image['title'] . '" src="' . $image['url'] . '" /><i class="fa fa-fw fa-expand"></i></a>';
				else
					echo '<img width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $image['alt'] . '" title="' . $image['title'] . '" src="' . $image['url'] . '" />';
			?>
		</li>
	<?php } ?>
		</ul>
	</div>

	<?php if (is_single()) { ?>
		<div id="main_thumbs" class="flexslider">
			<ul class="slides">
		<?php foreach ($images as $image) { ?>
			<li>
				<?php echo '<img width="' . $image['width'] . '" height="' . $image['height'] . '" alt="' . $image['alt'] . '" title="' . $image['title'] . '" src="' . $image['url'] . '" />'; ?>
			</li>
		<?php } ?>
			</ul>
		</div>
	<?php } ?>
<?php }