<?php

function bdt_headerStyle ($this) {
?>
<div class="header-wrapper">

	<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
		<div class="toolbar-wrapper uk-hidden-small">
			<div class="uk-container uk-container-center">
				<div class="tm-toolbar uk-clearfix uk-hidden-small">
					<?php if ($this['widgets']->count('toolbar-l')) : ?>
					<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('toolbar-r')) : ?>
					<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="uk-container uk-container-center">

		<!-- Start default header style -->
		<?php if ($this['config']->get('header') == 'default') : ?>
			<?php if ($this['widgets']->count('logo + search + headerbar')) : ?>
				<div class="tm-headerbar uk-clearfix">
					<?php if ($this['widgets']->count('logo')) : ?>
						<div class="tm-logo-wrapper uk-align-left uk-hidden-small">
							<?php echo $this['widgets']->render('logo'); ?>
						</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('menu')) : ?>
						<div class="navigation-wrapper <?php echo ($this['widgets']->count('logo')) ? 'uk-align-right' : ''; ?>">
							<nav class="tm-navbar uk-navbar" data-uk-sticky id="tmMainMenu">

								<?php if ($this['widgets']->count('menu')) : ?>
								<?php echo $this['widgets']->render('menu'); ?>
								<?php endif; ?>

								<?php if ($this['widgets']->count('offcanvas')) : ?>
								<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
								<?php endif; ?>

								<?php if ($this['widgets']->count('search')) : ?>
								<div class="uk-navbar-flip">
									<div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
								</div>
								<?php endif; ?>

								<?php if ($this['widgets']->count('logo-small')) : ?>
								<div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
								<?php endif; ?>

							</nav>
						</div>
					<?php endif; ?>

					<?php echo $this['widgets']->render('headerbar'); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<!-- // End default header style -->

		<!-- Start style2 header style -->
		<?php if ($this['config']->get('header') == 'style2') : ?>
			<?php if ($this['widgets']->count('logo + search + headerbar')) : ?>
				<div class="tm-headerbar uk-clearfix">
					
					<div class="tm-logo-headerbar uk-clearfix uk-hidden-small">
						<?php if ($this['widgets']->count('logo')) : ?>
							<div class="tm-logo-wrapper uk-align-left">
								<?php echo $this['widgets']->render('logo'); ?>
							</div>
						<?php else : ?>
							<div class="tm-logo-wrapper uk-align-left">
								<a class="tm-logo tm-logo-text" href="<?php echo $this['config']->get('site_url'); ?>"><h1><?php echo bloginfo('name'); ?></h1></a>
							</div>
						<?php endif; ?>
						
						<?php if ($this['widgets']->count('headerbar')) : ?>
							<div class="headerbar-wrapper uk-align-right">
								<?php echo $this['widgets']->render('headerbar'); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ($this['widgets']->count('menu')) : ?>
						<div class="navigation-wrapper">
							<nav class="tm-navbar uk-navbar" data-uk-sticky id="tmMainMenu">

								<?php if ($this['widgets']->count('menu')) : ?>
								<?php echo $this['widgets']->render('menu'); ?>
								<?php endif; ?>

								<?php if ($this['widgets']->count('offcanvas')) : ?>
								<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
								<?php endif; ?>

								<?php if ($this['widgets']->count('search')) : ?>
								<div class="uk-navbar-flip">
									<div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
								</div>
								<?php endif; ?>

								<?php if ($this['widgets']->count('logo-small')) : ?>
								<div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
								<?php endif; ?>

							</nav>
						</div>
					<?php endif; ?>

				</div>
			<?php endif; ?>
		<?php endif; ?>
		<!-- // End style2 header style -->

		<!-- Start style3 header style -->
		<?php if ($this['config']->get('header') == 'style3') : ?>
			<?php if ($this['widgets']->count('logo + search + headerbar')) : ?>
				<div class="tm-headerbar uk-clearfix">
					
					<div class="tm-logo-headerbar uk-clearfix uk-hidden-small">
						<?php if ($this['widgets']->count('logo')) : ?>
							<div class="tm-logo-wrapper uk-align-center">
								<?php echo $this['widgets']->render('logo'); ?>
							</div>
						<?php else : ?>
							<div class="tm-logo-wrapper uk-align-center">
								<a class="tm-logo tm-logo-text" href="<?php echo $this['config']->get('site_url'); ?>"><h1><?php echo bloginfo('name'); ?></h1></a>
							</div>
						<?php endif; ?>
					</div>

					<?php if ($this['widgets']->count('menu')) : ?>
						<div class="navigation-wrapper">
							<nav class="tm-navbar uk-navbar" data-uk-sticky id="tmMainMenu">

								<?php if ($this['widgets']->count('menu')) : ?>
								<?php echo $this['widgets']->render('menu'); ?>
								<?php endif; ?>

								<?php if ($this['widgets']->count('offcanvas')) : ?>
								<a href="#offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
								<?php endif; ?>

								<?php if ($this['widgets']->count('search')) : ?>
								<div class="uk-navbar-flip">
									<div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
								</div>
								<?php endif; ?>

								<?php if ($this['widgets']->count('logo-small')) : ?>
								<div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
								<?php endif; ?>

							</nav>
						</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('headerbar')) : ?>
						<div class="headerbar-wrapper">
							<?php echo $this['widgets']->render('headerbar'); ?>
						</div>
					<?php endif; ?>

				</div>
			<?php endif; ?>
		<?php endif; ?>
		<!-- // End style3 header style -->
	</div>
</div>


<?php
}


?>



