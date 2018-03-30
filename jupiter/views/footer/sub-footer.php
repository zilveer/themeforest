<?php
/**
 * template part for sub footer. views/footer
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if ( $mk_options['disable_sub_footer'] == 'true' && !$view_params['footer_status']) { ?>
<div id="sub-footer">
	<div class="<?php echo esc_attr( $view_params['footer_grid_status'] ); ?>">
		<?php if ( !empty( $mk_options['footer_logo'] ) ) {?>
		<div class="mk-footer-logo">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( bloginfo( 'name' ) ); ?>"><img alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" src="<?php echo esc_url( $mk_options['footer_logo'] ); ?>" /></a>
		</div>
		<?php } ?>

    	<span class="mk-footer-copyright"><?php echo stripslashes($mk_options['copyright']); ?></span>
    	<?php mk_get_view('footer', 'sub-footer-nav'); ?>
	</div>
	<div class="clearboth"></div>
</div>
<?php } ?>
