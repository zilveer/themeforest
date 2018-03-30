<?php if ( !defined( 'ABSPATH' ) ) exit; ?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<title><?php wp_title( '-', true, 'right' ); bloginfo( 'name' ); ?></title>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	
		<div id="layout">
		
			<div id="header">

				<div id="header-layout-2">

					<div id="header-holder-2">

						<?php
							// Menu Secondary
							st_menu_secondary();
						?>

						<div class="clear"><!-- --></div>

					</div><!-- #header-holder-2 -->

				</div><!-- #header-layout-2 -->

				<div id="header-layout">

					<div id="header-holder">

						<div id="logo" class="div-as-table">
							<div>
								<div>
									<?php
										// Logo
										st_logo();
									?>
								</div>
							</div>
						</div><!-- #logo -->

						<div id="menu" class="div-as-table">
							<div>
								<div>
									<?php
										// Menu Primary
										st_menu_primary();

										// Menu Drop-down
										st_the_menu_drop_down();
									?>
								</div>
							</div>
						</div><!-- #menu -->

						<div id="hcustom" class="div-as-table">
							<div>
								<div>
									<?php
										// Icons the Social
										if ( function_exists( 'st_icons_social' ) ) {
											st_icons_social(); }
									?>
								</div>
							</div>
						</div><!-- #hcustom -->

						<div class="clear"><!-- --></div>

					</div><!-- #header-holder -->

				</div><!-- #header-layout -->

			</div><!-- #header -->