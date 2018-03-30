<?php
global $houzez_local;
$copy_rights = houzez_option('copy_rights'); ?>

<?php get_template_part('template-parts/scroll-to-top'); ?>

<!--start footer section-->
<footer id="footer-section">
    
    <?php get_template_part('template-parts/footer'); ?>

    <div class="footer-bottom">

    	<div class="container">
            <div class="row">
                <?php if( !empty($copy_rights) ) { ?>
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col">
                        <p><?php echo ( $copy_rights ); ?></p>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-col">
                        <div class="navi">
	                        <?php
							// Pages Menu
							if ( has_nav_menu( 'footer-menu' ) ) :
								wp_nav_menu( array (
									'theme_location' => 'footer-menu',
									'container' => '',
									'container_class' => '',
									'menu_class' => '',
									'menu_id' => 'footer-menu',
									'depth' => 1
								));
							endif;
							?>
						</div>

                    </div>
                </div>
                <?php if( houzez_option('social-footer') != '0' ): ?>
                <div class="col-md-3 col-sm-3">
                    <div class="footer-col foot-social">
                        <p>
                            <?php echo $houzez_local['follow_us']; ?>
                           
                            <?php if( houzez_option('fs-facebook') != '' ){ ?>
					        	<a target="_blank" href="<?php echo esc_url(houzez_option('fs-facebook')); ?>"><i class="fa fa-facebook-square"></i></a>
					        <?php } ?>

					        <?php if( houzez_option('fs-twitter') != '' ){ ?>
					            <a target="_blank" href="<?php echo esc_url(houzez_option('fs-twitter')); ?>"><i class="fa fa-twitter-square"></i></a>
					        <?php } ?>

					        <?php if( houzez_option('fs-linkedin') != '' ){ ?>
					            <a target="_blank" href="<?php echo esc_url(houzez_option('fs-linkedin')); ?>"><i class="fa fa-linkedin-square"></i></a>
					        <?php } ?>

					        <?php if( houzez_option('fs-googleplus') != '' ){ ?>
					            <a target="_blank" href="<?php echo esc_url(houzez_option('fs-googleplus')); ?>"><i class="fa fa-google-plus-square"></i></a>
					        <?php } ?>

					        <?php if( houzez_option('fs-instagram') != '' ){ ?>
					            <a target="_blank" href="<?php echo esc_url(houzez_option('fs-instagram')); ?>"><i class="fa fa-instagram"></i></a>
					        <?php } ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>

    </div><!-- End footer bottom -->

</footer>
<!--end footer section-->

<?php wp_footer(); ?>

</body>
</html>