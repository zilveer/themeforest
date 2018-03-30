<?php

$blocks = thb_get_builder_blocks();

?>

<table class="thb-builder-blocks-list">
	<tbody>
		<?php foreach ( $blocks as $slug => $label ) : ?>
			<?php
				$block = thb_builder_instance()->getBlock( $slug );
			?>
			<tr data-type="<?php echo $slug; ?>">
				<td class="thb-builder-block-label"><?php echo $label; ?></td>
				<td class="thb-builder-block-description"><?php echo $block->getDescription(); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<input type="hidden" name="<?php echo $field_name; ?>" value="<?php echo $field_value; ?>">