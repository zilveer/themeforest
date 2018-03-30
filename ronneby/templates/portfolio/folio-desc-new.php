<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby, $description_position;
$custom_fields = $acf_columns = $columns = '';

if (function_exists('get_field_objects')) {
	$fields = get_field_objects();
} else {
	$fields = false;
}
?>

<?php if((!isset($dfd_ronneby['entry_meta_display']) || $dfd_ronneby['entry_meta_display']) && (strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0)) : ?>
	<div class="dfd-folio-add-fields-wrap">
		<?php get_template_part('templates/portfolio/additional','fields'); ?>
	</div>
<?php endif; ?>

<div class="columns twelve">
	<div class="folio-info-field folio-info-field-inner">
		<?php if(isset($dfd_ronneby['portfolio_inner_description_title']) && !empty($dfd_ronneby['portfolio_inner_description_title'])) : ?>
			<div class="folio-field-name box-name"><?php echo $dfd_ronneby['portfolio_inner_description_title']; ?></div>
		<?php endif; ?>
		<?php 
			while (have_posts()) {
				the_post();
				echo get_the_content();
			}
		?>
	</div>
</div>

<?php
if(!empty($fields)) {
	foreach ($fields as $field_name => $field) {
		if (!empty($field['label']) && !empty($field['value'])) { ?>
			<div class="twelve columns">
				<div class="<?php echo strtolower($field['label']) ?> folio-info-field">
					<div class="folio-field-name box-name"><?php echo $field['label'] ?></div>
					<?php echo do_shortcode($field['value']) ?>
				</div>
			</div>
		<?php }
	}
}
?>

<?php if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) : ?>
	<?php get_template_part('templates/portfolio/additional','fields'); ?>
	<div class="columns twelve">
		<div class="folio-info-field folio-add-info">
			<?php get_template_part('templates/entry-meta/mini', 'add-info'); ?>
		</div>
	</div>
<?php endif;