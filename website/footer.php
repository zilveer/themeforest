<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

			</div>
		</div>
		<!-- // Main section -->

		<?php if (count($footer_visible = Website::to('footer/visible')) > 0): ?>
			<!-- Bottom section -->
			<?php
				$bottom_class = '';
				if (Website::to('footer/fixed')) {
					$bottom_class .= 'fixed ';
				}
				if (count($footer_visible) == 1) {
					$bottom_class .= sprintf('%slte-mobile ', $footer_visible[0] == 'desktop' ? 'hide-' : '');
				}
			?>
			<footer id="bottom" class="<?php echo trim($bottom_class); ?>">
				<div class="container">

					<?php get_sidebar('bottom'); ?>

					<!-- Footer -->
					<section id="footer" class="clear">
						<p class="alpha"><?php echo nl2br(Website::to('footer/text/left')); ?></p>
						<p class="beta"><?php echo nl2br(Website::to('footer/text/right')); ?></p>
					</section>
					<!-- // Footer -->

				</div>
			</footer>
			<!-- // Bottom section -->
		<?php endif; ?>

		<?php wp_footer(); ?>

	</body>
</html>