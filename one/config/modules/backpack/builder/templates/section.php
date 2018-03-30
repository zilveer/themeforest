<?php
	$section_tag = 'div';
	$section_id = "thb-section-$section_index";

	if ( thb_builder_section_has_title( $section ) ) {
		$section_tag = 'section';
	}

	do_action( 'thb_section_pre', $section );
?>
<<?php echo $section_tag; ?> id="<?php echo $section_id; ?>" class="thb-section <?php echo $class; ?>">

	<div class="thb-section-extra" <?php echo $section_attrs; ?>>

		<?php do_action( 'thb_section_pre_wrapper', $section ); ?>

		<div class="thb-section-inner-wrapper">
			<?php
				foreach ( $section['rows'] as $index => $row ) {
					thb_get_module_template_part( 'backpack/builder', 'row', array(
						'row'           => $row,
						'index'         => $index,
						'section_index' => $section_index
					) );
				}
			?>
		</div>
	</div>
</<?php echo $section_tag; ?>>