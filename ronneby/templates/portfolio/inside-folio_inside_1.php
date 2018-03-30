<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	global $dfd_ronneby, $description_position;
?>
<div class="project-wrap clearfix">
	<?php if(strcmp($description_position, 'top') === 0) : ?>
		<div class="folio-info desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'four' : 'twelve'; ?> columns">
			<div class="row">
				<?php get_template_part('templates/portfolio/folio', 'description'); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="folio-entry-media desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'eight' : 'twelve'; ?> columns">
		<?php get_template_part('templates/portfolio/folio', 'media'); ?>
		<?php
		if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
			get_template_part('templates/portfolio/entry', 'meta');
			comments_template();
		}
		?>
	</div>
	<?php if(strcmp($description_position, 'top') !== 0) : ?>
		<div class="folio-info desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'four' : 'twelve'; ?> columns">
			<div class="row">
				<?php get_template_part('templates/portfolio/folio', 'description'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0) : ?>
		<div class="clear"></div>
		<?php get_template_part('templates/portfolio/entry', 'meta'); ?>
		<?php comments_template(); ?>
	<?php endif; ?>
</div>
<?php if(isset($dfd_ronneby['recent_items_disp']) && strcmp($dfd_ronneby['recent_items_disp'], '1') === 0 && isset($dfd_ronneby['block_single_folio_item']) && !empty($dfd_ronneby['block_single_folio_item'])) :  ?>
	<div class="twelve columns">
		<?php do_shortcode($dfd_ronneby['block_single_folio_item']); ?>
	</div>
<?php endif;