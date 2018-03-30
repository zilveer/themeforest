<?php
	$currentVersion = is_child_theme() ? THB_PARENT_THEME_VERSION : THB_THEME_VERSION;
?>

<div class="thb-legend">
	<ul>
		<li class="newer">
			<span><?php _e('Updates', 'thb_text_domain'); ?></span>
		</li>
		<li class="current">
			<span><?php _e('Your current theme version', 'thb_text_domain'); ?></span>
		</li>
		<li class="older">
			<span><?php _e('Older releases', 'thb_text_domain'); ?></span>
		</li>
	</ul>
</div>

<?php if( is_object($changelog) ) : ?>
	<?php foreach( $changelog as $version => $release ) : ?>
		<div class="thb-release">
			<?php
				$release_class = '';
				if( $version == $currentVersion ) { $release_class = 'current'; }
				elseif( version_compare($currentVersion, $version) < 0 ) { $release_class = 'new'; }
			?>
			<h3 class="<?php echo $release_class; ?>">
				<span class="thb-release-version"><?php echo $version; ?></span>
				<span class="thb-release-date"><?php _e('Released on', 'thb_text_domain'); ?> <i><?php echo date( 'd M Y', strtotime($release->date) ); ?></i></span>
			</h3>

			<div class="thb-release-desc">
				<?php echo $release->desc; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>