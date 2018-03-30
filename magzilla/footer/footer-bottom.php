<?php global $ft_option, $fave_container, $magzilla_allowedtags; ?>

<div class="bottom-footer">
	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<p><?php if( !empty($ft_option['copyright_text']) ) { echo wp_kses( $ft_option['copyright_text'], $magzilla_allowedtags ); } ?></p>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				
				<?php
                // Pages Menu
                if ( has_nav_menu( 'footer-menu' ) ) :
                    wp_nav_menu( array (
                        'theme_location' => 'footer-menu',
                        'container' => '',
                        'container_class' => '',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'menu_id' => 'footer-nav',
                        
                     ));
                 endif;
                ?>

			</div>
		</div>
	</div>
</div><!-- bottom-footer -->