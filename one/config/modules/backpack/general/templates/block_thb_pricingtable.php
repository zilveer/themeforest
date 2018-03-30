<?php
$table_class = '';
$table_class = 'thb-pricingtable-grid-' . count( $pricingtable_items ) . 'col';
?>

<div class="thb-pricingtable-table <?php echo $table_class; ?>">

<?php $i=0; foreach( $pricingtable_items as $item ) : ?>

<?php
	$featured = '';

	if ( $item['featured'] != '' ) {
		$featured = 'thb-featured';
	}
?>

	<div class="thb-pricingtable-cell <?php echo $featured; ?>">

		<div class="thb-pricingtable-wrapper">
			<div class="thb-pricingtable-header">
				<?php if ( $item['featured'] != '' ) : ?>
					<p class="thb-pricingtable-featured">
						<?php echo thb_text_format( $item['featured'] ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $item['type'] != '' ) : ?>
					<p class="thb-pricingtable-type">
						<?php echo thb_text_format( $item['type'] ); ?>
					</p>
				<?php endif; ?>

				<p class="thb-pricingtable-price-wrapper">
					<span class="thb-pricingtable-price">

						<?php if ( $item['currency'] != '' ) : ?>
							<span class="thb-pricingtable-currency">
								<?php echo thb_text_format( $item['currency']); ?>
							</span>
						<?php endif; ?>

						<?php echo thb_text_format( $item['price']); ?>

						<?php if ( isset( $item['currency_after'] ) && $item['currency_after'] != '' ) : ?>
							<span class="thb-pricingtable-currency">
								<?php echo thb_text_format( $item['currency_after']); ?>
							</span>
						<?php endif; ?>
					</span>

					<?php if ( $item['validity'] != '' ) : ?>
						<span class="thb-pricingtable-validity">
							<?php echo thb_text_format( $item['validity']); ?>
						</span>
					<?php endif; ?>
				</p>

				<?php if ( $item['description'] != '' ) : ?>
					<p class="thb-pricingtable-description">
						<?php echo thb_text_format( $item['description'] ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php $features_list = explode( "\n", $item['features'] ); ?>

			<?php if ( count( $features_list ) > 0 ) : ?>
				<ul class="thb-pricingtable-features">
					<?php $i=0; foreach( $features_list as $feature_item ) : ?>
						<li class="thb-pricingtable-feature-item">
							<?php echo thb_text_format( $feature_item ); ?>
						</li>
					<?php $i++; endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if ( ! empty( $item['action_url'] ) && ! empty( $item['action_label'] ) ) : ?>
				<p class="thb-pricingtable-action">
					<a class="thb-btn" href="<?php echo $item['action_url']; ?>">
						<?php echo $item['action_label']; ?>
					</a>
				</p>
			<?php endif; ?>
		</div>

	</div>

<?php $i++; endforeach; ?>
</div>