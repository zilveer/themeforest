<div class="thb-section-block-header">
	<?php if ( $title != '' ) : ?>
		<h1 class="thb-section-block-title"><?php echo thb_text_format( $title ); ?></h1>
	<?php endif; ?>
</div>

<?php
	$bar_width = '';
	$bar_label = '';

	$progress_data = $progress_data;
	$data = explode("\n", $progress_data);
?>

<?php foreach ( $data as $d ) : ?>
	<?php
		$d = explode('|', $d);
		$bar_width = $d[0];
		$bar_label = $d[1];
	?>
<div class="thb-meter-bar-wrapper">
	<?php if ( $progress_styles == 'progress-style-a' ) : ?>
		<span class="thb-meter-bar-label">
			<?php echo $bar_label; ?>

			<?php if ( $progress_value == 1 && $progress_styles == 'progress-style-a' ) : ?>
				<span class="thb-meter-bar-value">
					<?php echo $bar_width; ?>
				</span>
			<?php endif; ?>
		</span>
	<?php endif; ?>

	<div class="thb-meter">
		<?php if ( $progress_value == 1 && $progress_styles == 'progress-style-b' ) : ?>
			<span class="thb-meter-bar-value">
				<?php echo $bar_width; ?>
			</span>
		<?php endif; ?>
		<span class="thb-meter-bar" style="width: <?php echo $bar_width; ?>%">

			<?php if ( $progress_styles == 'progress-style-b' ) : ?>
				<span class="thb-meter-bar-label">
					<?php echo $bar_label; ?>
				</span>
			<?php endif; ?>

			<span class="thb-meter-bar-progress"></span>
		</span>
	</div>
</div>
<?php endforeach; ?>
