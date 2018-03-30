<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $description_position;

if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
	$add_info_columns = $desc_columns = 'twelve';
} else {
	$add_info_columns = 'four';
	$desc_columns = 'eight';
}

$additional_fields_opts = array(
	'folio_single_short_desc_title',
	'folio_single_short_desc_text',
	'folio_single_add_link_title',
	'folio_single_add_link_text',
	'folio_single_add_link_url',
);

foreach($additional_fields_opts as $k) {
	$additional_fields_opts[$k] = get_post_meta(get_the_ID(), $k, true);
}
?>


<?php if(!empty($additional_fields_opts['folio_single_short_desc_title']) || !empty($additional_fields_opts['folio_single_short_desc_text'])) : ?>
	<div class="columns <?php echo esc_attr($desc_columns) ?> dfd-folio-add-fields">
		<div class="folio-info-field">
			<?php if(!empty($additional_fields_opts['folio_single_short_desc_title'])) : ?>
				<span><?php echo $additional_fields_opts['folio_single_short_desc_title'] ?></span>
			<?php endif ?>
			<?php if(!empty($additional_fields_opts['folio_single_short_desc_text'])) : ?>
				<span><?php echo $additional_fields_opts['folio_single_short_desc_text'] ?></span>
			<?php endif ?>
		</div>
	</div>
<?php endif; ?>
<?php if(!empty($additional_fields_opts['folio_single_add_link_title']) || (!empty($additional_fields_opts['folio_single_add_link_text']) && !empty($additional_fields_opts['folio_single_add_link_url']))) : ?>
	<div class="columns <?php echo esc_attr($add_info_columns) ?> dfd-folio-add-fields">
		<div class="folio-info-field">
			<?php if(!empty($additional_fields_opts['folio_single_add_link_title'])) : ?>
				<span><?php echo $additional_fields_opts['folio_single_add_link_title'] ?></span>
			<?php endif ?>
			<?php if(!empty($additional_fields_opts['folio_single_add_link_text']) && !empty($additional_fields_opts['folio_single_add_link_url'])) : ?>
				<p><a href="<?php echo esc_url($additional_fields_opts['folio_single_add_link_url']) ?>" title="<?php echo esc_attr($additional_fields_opts['folio_single_add_link_text']) ?>"><?php echo $additional_fields_opts['folio_single_add_link_text'] ?></a></p>
			<?php endif ?>
		</div>
	</div>
<?php endif;