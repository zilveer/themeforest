<?php
	/**
	 * The template for the header sticky bar.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 		Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.3
	 */
?>
<div id="redux-sticky">
	<div id="info_bar">

		<a href="javascript:void(0);"
		   class="expand_options<?php echo ( $this->parent->args['open_expanded'] ) ? ' expanded' : ''; ?>"<?php echo sprintf('%s', $this->parent->args['hide_expand'] ? ' style="display: none;"' : '') ?>><?php esc_html_e( 'Expand', 'redux-framework' ); ?></a>

		<div class="redux-action_bar">
			<span class="spinner"></span>
			<?php submit_button( esc_html__( 'Save & Generate CSS', 'redux-framework' ), 'primary', $this->parent->args['opt_name'] . '[lesscss]', false ); ?>
			<?php submit_button( esc_html__( 'Save Changes', 'redux-framework' ), 'primary', 'redux_save', false  ); ?>
			<?php if ( false === $this->parent->args['hide_reset'] ) : ?>
				<?php submit_button( esc_html__( 'Reset Section', 'redux-framework' ), 'secondary', $this->parent->args['opt_name'] . '[defaults-section]', false ); ?>
				<?php submit_button( esc_html__( 'Reset All', 'redux-framework' ), 'secondary', $this->parent->args['opt_name'] . '[defaults]', false ); ?>
			<?php endif; ?>
		</div>
		<div class="redux-ajax-loading" alt="<?php esc_html_e( 'Working...', 'redux-framework' ) ?>">&nbsp;</div>
		<div class="clear"></div>
	</div>

	<!-- Notification bar -->
	<div id="redux_notification_bar">
		<?php $this->notification_bar(); ?>
	</div>


</div>