<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>

	<section id="promo">
		<div class="container">
			<div class="padding">
				<?php if ( is_active_sidebar( 'promobar' ) ) : ?>
				<div class="sixteen columns">
					<?php dynamic_sidebar( 'promobar' ); ?>
				</div>
				<?php else : ?>
				<div class="twelve columns">
					<div class="gutter alpha">
						<div class="text"><?php echo of_get_option('promo_content'); ?></div>
					</div>
				</div>
				<div class="four columns float-right">
					<div class="gutter alpha omega">
						<div class="bigbutton">
							<a href="<?php echo of_get_option('promo_link'); ?>" >
								<?php echo of_get_option('promo_button'); ?>
							</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
		</div>
	</section>