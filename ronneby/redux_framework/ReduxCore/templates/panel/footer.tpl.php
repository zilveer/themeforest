<?php
    /**
     * The template for the panel footer area.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author        Redux Framework
     * @package       ReduxFramework/Templates
     * @version       3.5.0.6
     */
?>
<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
<div id="redux-footer-sticky">
    <div id="redux-footer">

        <?php /*if ( isset( $this->parent->args['share_icons'] ) ) : ?>
            <div id="redux-share">
                <?php foreach ( $this->parent->args['share_icons'] as $link ) : ?>
                    <?php
                    // SHIM, use URL now
                    if ( isset( $link['link'] ) && ! empty( $link['link'] ) ) {
                        $link['url'] = $link['link'];
                        unset( $link['link'] );
                    }
                    ?>

                    <a href="<?php echo $link['url'] ?>" title="<?php echo $link['title']; ?>" target="_blank">

                        <?php if ( isset( $link['icon'] ) && ! empty( $link['icon'] ) ) : ?>
                            <i class="<?php
                                if ( strpos( $link['icon'], 'el-icon' ) !== false && strpos( $link['icon'], 'el ' ) === false ) {
                                    $link['icon'] = 'el ' . $link['icon'];
                                }
                                echo $link['icon'];
                            ?>"></i>
                        <?php else : ?>
                            <img src="<?php echo $link['img'] ?>"/>
                        <?php endif; ?>

                    </a>
                <?php endforeach; ?>

            </div>
        <?php endif;*/ ?>

		<?php /* <span class="spinner"></span> */ ?>
        <div class="redux-action_bar">
			<div class="options-header-buttons-section">
				<div class="dfd-options-button-cover options-button-green">
					<?php submit_button( __( 'Save Changes', 'redux-framework' ), 'primary', 'redux_save', false, array('id' => 'redux_save_bottom') ); ?>
				</div>
				<?php
				/*
				<div class="dfd-options-button-cover options-button-green-border">
						<?php submit_button( __( 'Recompile All Styles', 'redux-framework' ), 'secondary', 'recompileStyleButton', false ,array("onclick"=>"return false;")); ?>
				</div>
				*/
				?>
				<?php if(isset($this->parent->options['dev_mode']) && $this->parent->options['dev_mode'] == 'on') : ?>
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
        <div class="clear"></div>

    </div>
</div>
