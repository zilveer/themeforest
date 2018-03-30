<!-- Responsive Navigation -->
<label for="toggle-main-nav" class="label-toggle-main-nav">
	<div class="menu-icon-container">
		<div class="menu-icon">
			<div class="menu-global menu-top"></div>
			<div class="menu-global menu-middle"></div>
			<div class="menu-global menu-bottom"></div>
		</div>
	</div>
</label>

<nav id="navigation" class="navigation clearfix">

	<?php wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => '',
			'fallback_cb'     => 'tmm_wp_page_menu',
			'container_class' => false
		)
	); ?>

</nav><!--/ .navigation-->