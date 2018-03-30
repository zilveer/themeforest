<?php 

header('Content-type: text/javascript');

/**
 * The theme instance.
 */
$thb_theme = thb_theme();

/**
 * The theme shortcodes.
 */
$thb_shortcodes = $thb_theme->getShortcodes();

/**
 * Icon URL
 */
$thb_icon_url = THB_ADMIN_CSS_URL . '/i/shortcode-icon.png';

?>

var shortcodesEd;
var shortcodesUrl;

(function() {
	tinymce.create('tinymce.plugins.shortcodes', {
		init : function(ed, url) {
			shortcodesEd = ed;
			shortcodesUrl = url;
		},
		createControl: function(n, cm) {
			
			switch (n) {
				case 'shortcodes':
					var c = cm.createMenuButton('shortcodes', {
						title : 'shortcodes',
						image : '<?php echo $thb_icon_url; ?>',
						icons:false
				});

				c.onRenderMenu.add(function(c, m) {
					<?php foreach( $thb_shortcodes as $type => $shortcodes ) : ?>

						sub = m.addMenu({title : '<?php echo $type; ?>'});

						<?php foreach( $shortcodes as $shortcode ) : ?>
							<?php
								if( !$shortcode->isPublic() ) {
									continue;
								}

								$shortcode_label = $shortcode->getLabel();
								$label = !empty($shortcode_label) ? $shortcode_label : $shortcode->getName();
							?>
							sub.add({title : '<?php echo $label; ?>', onclick : function() {
								var str = '<?php echo $shortcode->getExample(); ?>';
								window.tinyMCE.activeEditor.selection.setContent(str);
							}});
						<?php endforeach; ?>

					<?php endforeach; ?>
				});

				// Return the new splitbutton instance
				return c;
			}
			return null;
		}
	});
	tinymce.PluginManager.add('shortcodes', tinymce.plugins.shortcodes);

})();