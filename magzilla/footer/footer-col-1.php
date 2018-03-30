<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 30/11/15
 * Time: 1:16 PM
 */
if (   ! is_active_sidebar( 'footer-col-1'  ) )
	return;

global $ft_option, $fave_container;
?>
<div class="top-footer">
	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">

			<?php if ( is_active_sidebar( 'footer-col-1' ) ) : ?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php dynamic_sidebar( 'footer-col-1' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div><!-- top-footer -->