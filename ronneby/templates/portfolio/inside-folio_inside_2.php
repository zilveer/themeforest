<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby, $description_position;

$options = array(
	'folio_single_show_title' => false,
	'folio_single_show_subtitle' => false,
	'folio_single_show_meta' => false,
);

foreach($options as $k => $v) {
	$options[$k] = DfdMetaBoxSettings::compared($k, $v);
}
?>
<div class="project-wrap clearfix">
	<?php if(strcmp($description_position, 'top') === 0) : ?>
		<div class="folio-info desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'four' : 'twelve'; ?> columns">
			<div class="row">
				<?php get_template_part('templates/portfolio/folio-desc', 'new'); ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="folio-entry-media desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'eight' : 'twelve'; ?> columns">
		<?php if($options['folio_single_show_title'] == 'on') : ?>
			<div class="dfd-folio-categories">
				<?php get_template_part('templates/folio', 'term'); ?>
			</div>
			<div class="dfd-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<?php endif; ?>
			
		<?php if($options['folio_single_show_subtitle'] == 'on') :
			$subtitle_text = get_post_meta(get_the_id(), 'stunnig_headers_subtitle', true);
			if(!empty($subtitle_text)) {
			?>
				<div class="subtitle"><?php echo $subtitle_text ?></div>
			<?php
			}
		endif; ?>

		<?php
		/*
		if($options['folio_single_show_meta'] == 'on') { ?>
			<div class="dfd-meta-wrap">
				<div class="entry-meta meta-top">
					<?php get_template_part('templates/entry-meta/mini', 'date'); ?>
					<span><?php _e('by', 'dfd'); ?></span>
					<?php get_template_part('templates/entry-meta/mini', 'author'); ?>
				</div>
			</div>
		<?php }
		*/
		?>
		<?php get_template_part('templates/portfolio/folio', 'media'); ?>
		<?php
		if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
			get_template_part('templates/portfolio/entry', 'meta-folio');
			comments_template();
		}
		?>
	</div>
	<?php if(strcmp($description_position, 'top') !== 0) : ?>
		<div class="folio-info desc-<?php echo esc_attr($description_position); ?> <?php echo (strcmp($description_position, 'left') === 0) || (strcmp($description_position, 'right') === 0) ? 'four' : 'twelve'; ?> columns">
			<div class="row">
				<?php get_template_part('templates/portfolio/folio-desc', 'new'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if(strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0) : ?>
		<div class="clear"></div>
		<?php get_template_part('templates/portfolio/entry', 'meta-folio'); ?>
		<?php comments_template(); ?>
	<?php endif; ?>
</div>
<?php if(isset($dfd_ronneby['recent_items_disp']) && strcmp($dfd_ronneby['recent_items_disp'], '1') === 0 && isset($dfd_ronneby['block_single_folio_item']) && !empty($dfd_ronneby['block_single_folio_item'])) :  ?>
	<div class="twelve columns">
		<?php do_shortcode($dfd_ronneby['block_single_folio_item']); ?>
	</div>
<?php endif;