<?php
if (   ! is_active_sidebar( 'footer-col-1'  )
	&& ! is_active_sidebar( 'footer-col-2' )
)
	return;

global $ft_option, $fave_container;
?>
<div class="top-footer">
	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">

			<?php if ( is_active_sidebar( 'footer-col-1' ) ) : ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <?php dynamic_sidebar( 'footer-col-1' ); ?>
                </div>
            <?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-col-2' ) ) : ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <?php dynamic_sidebar( 'footer-col-2' ); ?>
                </div>
            <?php endif; ?>

		</div>
	</div>
</div><!-- top-footer -->