<?php
/**
 * Add a CSS editor for theme personalisation
 *
 * @since 1.4.3
 * @package WolfFramework
 * @author WolfThemes
 */

wolf_save_theme_css();
wolf_theme_css_init();

function wolf_theme_css_init() {
	register_setting( 'wolf-theme-css', 'wolf_theme_css_settings', 'wolf_theme_css_validate' );
	add_settings_section( 'wolf-theme-css', '',  'wolf_theme_css_intro', 'wolf-theme-css' );
	add_settings_field( 'css', __( 'Custom CSS', 'wolf' ), 'wolf_theme_css_field', 'wolf-theme-css', 'wolf-theme-css' );
}

function wolf_theme_css_intro() {
	?>
	<p>
		<?php if ( is_child_theme() ) {
			_e( 'Want to add any custom CSS code? Put in here, and the rest is taken care of.', 'wolf' );
		} else {
			 printf(
			 	__( 'Want to add any custom CSS code? Put in here, and the rest is taken care of.<br>If you need more advanced style customization, it is strongly recommended to create a <a href="%s" target="_blank">child theme</a>.', 'wolf' ),
				'http://codex.wordpress.org/Child_Themes'
			);
		}
		?>
	</p>
	<?php
}

function wolf_theme_css_field() {
	?>
	<style type="text/css">
		#editor {
			position: absolute;
			width: 500px;
			height: 400px;
		}
		</style>
	<div id="editor"><?php echo get_option( 'wolf_theme_css_' . wolf_get_theme_slug() ); ?></div>
	<textarea name="wolf_theme_css" id="css" style="visibility:hidden;"><?php echo get_option( 'wolf_theme_css_' . wolf_get_theme_slug() ); ?></textarea>
	<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/ace.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/theme-twilight.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/mode-css.js" type="text/javascript" charset="utf-8"></script>
	<script>
		var editor = ace.edit("editor");
		var CssMode = require("ace/mode/css").Mode;
		var textArea = document.getElementById('css');
		document.getElementById('editor').style.fontSize='14px';
		editor.setTheme("ace/theme/twilight");
			editor.getSession().setMode(new CssMode());
			editor.getSession().on('change', function( e ) {
			textArea.innerHTML = editor.getValue();
		});
	</script>
	<?php
}

function wolf_theme_css_validate() {

}

function wolf_save_theme_css() {

	if ( isset( $_POST['wolf-theme-css-save'] ) ) {
		//debug( $_POST );
		update_option( 'wolf_theme_css_' . wolf_get_theme_slug(), $_POST['wolf_theme_css'] );
		wolf_admin_notice( __( 'Your settings have been saved.', 'wolf' ), 'updated' );
	}

	/**
	 * Back from WpAdmin construct in case of WPML
	*/
	if ( isset( $_GET['message'] ) && 'save' == $_GET['message'] && isset( $_GET['page'] ) && $_GET['page'] == 'wolf-theme-css' ) {
		wolf_admin_notice( __( 'Your settings have been saved.', 'wolf' ), 'updated' );
	}
}
?>
<div class="wrap">

	<h2><?php _e( 'Custom CSS', 'wolf' ); ?></h2>

	<p>
		<form action="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-css' ) ); ?>" method="post">
			<?php settings_fields( 'wolf-theme-css' ); ?>
			<?php do_settings_sections( 'wolf-theme-css' ); ?>
			<input id="wolf-theme-css-submit" name="wolf-theme-css-save" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wolf' ); ?>" />
		</form>
	</p>
	<div class="clear"></div>
</div>