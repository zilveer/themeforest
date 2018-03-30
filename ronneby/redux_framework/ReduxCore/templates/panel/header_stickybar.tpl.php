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

	<!-- Notification bar -->
	<div id="redux_notification_bar">
		<?php $this->notification_bar(); ?>
	</div>

	<div id="info_bar">
		
		<?php
		/*
		<a href="javascript:void(0);"
		   class="expand_options<?php echo ( $this->parent->args['open_expanded'] ) ? ' expanded' : ''; ?>"<?php echo $this->parent->args['hide_expand'] ? ' style="display: none;"' : '' ?>><?php _e( 'Expand', 'redux-framework' ); ?></a>
		*/
		?>

		<div class="redux-action_bar">
			<?php /* <span class="spinner"></span> */ ?>
			<div class="options-header-buttons-section">
				<div class="dfd-options-button-cover options-button-green">
					<?php submit_button( __( 'Save Changes', 'redux-framework' ), 'primary', 'redux_save', false, array('id' => 'redux_save_top') ); ?>
				</div>
				<?php if(isset($this->parent->options['dev_mode']) && $this->parent->options['dev_mode'] == 'on') : ?>
					<div class="dfd-options-button-cover options-button-green-border">
						<?php submit_button( __( 'Recompile All Styles', 'redux-framework' ), 'secondary', 'recompileStyleButton', false ,array("onclick"=>"return false;")); ?>
					</div>
					<?php if ( false === $this->parent->args['hide_reset'] ) : ?>
					<?php /* ?>
						<div class="dfd-options-button-cover">
							<?php submit_button( __( 'Reset Section', 'redux-framework' ), 'secondary dfd-reset-button', $this->parent->args['opt_name'] . '[defaults-section]', false ); ?>
						</div>
					<?php */ ?>
						<div class="dfd-options-button-cover">
							<?php submit_button( __( 'Reset options', 'redux-framework' ), 'secondary dfd-reset-button', $this->parent->args['opt_name'] . '[defaults]', false ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="redux-ajax-loading" alt="<?php _e( 'Working...', 'redux-framework' ) ?>">&nbsp;</div>
		<?php /*<div class="clear"></div>*/ ?>
	</div>

</div>