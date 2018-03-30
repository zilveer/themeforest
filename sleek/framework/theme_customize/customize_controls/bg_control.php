<?php
if (class_exists('WP_Customize_Control')) {

	class Bg_Control extends WP_Customize_Control {
		public function render_content() {
		?>
			<label data-el="<?php echo $this->id; ?>">
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<div class="sleek-bg-control-field" style="background:<?php echo $this->value(); ?>;">
					<input type="hidden" class="bg-control" value="<?php echo $this->value(); ?>" <?php $this->link(); ?> />
					<a class="button button-primary js-bg-control-btn" data-id="<?php echo $this->id; ?>">Change Background</a>
				</div>
			</label>
		<?php
		include_once( THEME_BG_CONTROL . '/bg_control_lightbox.php' );

		// Include Icon Picker files here
		include_once( THEME_ICONS . '/icons.php' );
		include_once( THEME_ICON_PICKER . '/icon_picker_lightbox.php' );
		}
	}
}
?>
