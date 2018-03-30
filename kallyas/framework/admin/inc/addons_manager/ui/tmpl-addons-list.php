<ul class="zn-extensions-list cf">
<?php

foreach ( ZnAddonsManager()->plugins as $plugin ) : ?>

	<?php
		$plugin_status = ZnAddonsManager()->get_plugin_status( $plugin['slug'] );
		$button = '<a class="zn-extension-button " data-action="'.$plugin_status['action'].'" data-status="'.$plugin_status['status'].'" data-nonce="'.wp_create_nonce( 'zn_plugins_nonce' ).'" href="'.$url.'" data-slug="'.$plugin['slug'].'">' . $plugin_status['action_text'] . '</a>';
	?>
	<li class="zn-extension <?php echo $plugin_status['status']; ?>" id="<?php echo $plugin['slug']; ?>">
		<div class="zn-extension-inner" data-type="<?php echo isset($plugin['addon_type']) ? $plugin['addon_type'] : ''; ?>">
			<img src="<?php echo $plugin['z_plugin_icon']; ?>" class="img">
			<div class="zn-extension-info">
				<h4 class="zn-extension-title"><?php echo $plugin['name']; ?></h4>
				<span class="zn-extension-status "><?php echo $plugin_status['status_text']; ?></span>
				<?php
					if( ! empty( $plugin['deprecated'] ) ) {
						echo '<p class="zn-extension-deprecatetd">'.$plugin['deprecated']['message'].'</p>';
					}
				?>
				<p class="zn-extension-desc"><?php echo $plugin['z_plugin_description']; ?></p>
				<p class="zn-extension-author"><cite>By <?php echo $plugin['z_plugin_author']; ?></cite></p>
				<p class="zn-extension-ajax-text"></p>
			</div>
			<div class="zn-extension-actions"><?php echo $button; ?></div>
		</div>
	</li>

<?php endforeach; ?>
</ul>