<?php
/**
* 
* The sidebar containing the footer widget area.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
?>
<?php if ( !van_get_option("dsb_ft_widget") ): ?>

	<div id="footer-widget">
		<div class="container clearfix">

			<?php if ( van_is_active_sidebar("first-footer-widget-area") ) : ?>
				<div class="first-column widget-content">
					<?php dynamic_sidebar('first-footer-widget-area'); ?>
				</div><!-- .first-column -->	
			<?php endif;?>

			<?php if ( van_is_active_sidebar("second-footer-widget-area") ) : ?>
				<div class="second-column widget-content">
					<?php dynamic_sidebar('second-footer-widget-area'); ?>
				</div><!-- .second-column -->
			<?php endif;?>	

			<?php if ( van_is_active_sidebar("third-footer-widget-area") ) : ?>
				<div class="thrid-column widget-content">
					<?php dynamic_sidebar('third-footer-widget-area'); ?>
				</div><!-- .thrid-column -->
			<?php endif;?>

		</div><!-- .container -->
	</div><!-- #footer-widget -->
	
<?php endif; ?>