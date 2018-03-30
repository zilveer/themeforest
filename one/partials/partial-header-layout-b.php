<header id="header" class="<?php echo thb_one_get_header_skin(); ?>">

	<div class="thb-header-inner-wrapper">

		<div class="thb-section-container">

			<?php thb_header_start(); ?>

			<div class="thb-header-wrapper">

				<?php if ( thb_get_logo_position() == 'logo-left' ) : ?>

					<?php thb_logo(); ?>

					<?php thb_nav_before(); ?>
					<div class="slide-menu-trigger-wrapper">
						<a href="#" class="slide-menu-trigger">open</a>
					</div>
					<?php thb_nav_after(); ?>

				<?php else : ?>

					<?php thb_nav_before(); ?>
					<div class="slide-menu-trigger-wrapper">
						<a href="#" class="slide-menu-trigger">open</a>
					</div>
					<?php thb_nav_after(); ?>

					<?php thb_logo(); ?>

				<?php endif; ?>

			</div>

			<?php thb_header_end(); ?>

		</div>

	</div>

</header>