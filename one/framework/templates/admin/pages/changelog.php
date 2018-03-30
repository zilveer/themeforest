<?php
	if ( empty( $changelog ) ) {
		return;
	}

	$changelog = json_decode( $changelog );
	$releases = $changelog->changelog;
?>

<div class="thb-legend">
	<ul>
		<li class="newer">
			<span>Updates</span>
		</li>
		<li class="current">
			<span>Your current theme version</span>
		</li>
		<li class="older">
			<span>Older releases</span>
		</li>
	</ul>
</div>

<div class="thb-release-container">
	<?php foreach ( $releases as $version => $details ) : ?>
		<?php
			$release_class = '';

			if ( THB_MASTER_THEME_VERSION === $version ) {
				$release_class = 'current';
			}
			elseif ( version_compare( $version , THB_MASTER_THEME_VERSION, '>' ) ) {
				$release_class = 'new';
			}
		?>

		<div class="thb-release">
			<h3 class="<?php echo $release_class; ?>">
				<span class="thb-release-version"><?php echo $version; ?></span>
				<span class="thb-release-date">Released on <strong><?php echo $details->date; ?></strong></span>
			</h3>

			<div class="thb-release-desc">
				<?php echo $details->desc; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>