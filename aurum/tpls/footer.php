<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$footer_style               = get_data('footer_style');
$footer_widgets             = get_data('footer_widgets');
$footer_widgets_collapsed   = get_data( 'footer_collapse_mobile' );
$footer_text                = get_data('footer_text');
$footer_text_right          = get_data('footer_text_right');
$footer_menu                = ltrim(get_data('footer_menu'), '_');

?>
<footer class="site-footer<?php echo $footer_style ? " {$footer_style}" : ''; echo ! $footer_widgets ? ' no-footer-widgets' : ''; ?>">

	<div class="container">

		<?php if ( $footer_widgets ) : ?>
		
		<?php if ( $footer_widgets_collapsed ) : ?>
		<div class="row visible-xs">
			<div class="col-lg-12">
				<a href="#" class="expand-footer"></a>
			</div>
		</div>
		<?php endif; ?>

		<div class="row <?php echo $footer_widgets_collapsed ? 'hidden-xs' : ''; ?> footer-widgets">

			<?php dynamic_sidebar('footer_sidebar'); ?>

		</div>
		<?php endif; ?>

		<div class="footer-bottom">

			<div class="row">
				<?php if($footer_text || $footer_menu): ?>
				<div class="col-md-<?php echo $footer_text_right ? 6 : 12; ?>">
					<?php echo do_shortcode($footer_text); ?>
					<?php echo $footer_text && $footer_menu ? '<br />' : ''; ?>

					<?php if($footer_menu): ?>
					<?php
						wp_nav_menu(
							array(
								'menu'           	=> $footer_menu,
								'container'         => 'div',
								'container_class'   => 'footer-menu',
								'menu_class'        => '',
								'items_wrap'        => '<ul>%3$s</ul>',
								'depth'             => 1
							)
						);
					?>
					<?php endif; ?>

				</div>
				<?php endif; ?>

				<?php if($footer_text_right): ?>
				<div class="col-md-<?php echo $footer_text || $footer_menu ? 6 : 12; ?>">

					<?php echo do_shortcode($footer_text_right); ?>

				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>

</footer>
