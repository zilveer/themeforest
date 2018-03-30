<?php
global $zorka_data;
$header_class = array();
$header_class[] = 'main-header';
$header_class[] = 'left-header';
$header_class[] = 'header-11';
$header_class[] = 'sticky-disable';
?>

<header class="<?php g5plus_the_attr_value($header_class) ?>">
	<?php get_template_part('templates/header/header','mobile' ); ?>
	<div class="header">
		<div class="container">
			<nav class="zorka-navbar" role="navigation">
				<?php get_template_part('templates/header/header','logo' ); ?>
				<div class="zorka-navbar-header">
					<?php get_template_part('templates/header/mini','cart' ); ?>
					<div class="search-button-wrapper">
						<a class="icon-search-menu" href="#"><span class="pe-7s-search"></span></a>
					</div>
				</div>
				<div class="menu-wrapper">
					<?php if (has_nav_menu('left')) : ?>
						<?php
						wp_nav_menu( array(
							'theme_location' => 'left',
							'menu_class' => 'left-menu'
						) );
						?>
					<?php endif; ?>
				</div>
				<?php get_template_part('templates/header/social','link' ); ?>
			</nav>
		</div>
	</div>
</header>