<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$header_sticky_menu = get_data('header_sticky_menu');
$header_type        = get_data('header_type');
$header_type        = $header_type ? $header_type : 1;

$has_secondary_menu = $header_type && has_nav_menu('secondary-menu');

?>
<header class="site-header<?php echo " header-type-{$header_type}"; echo $header_sticky_menu ? " sticky": ''; ?>">

	<?php get_template_part('tpls/header-top-bar'); ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12<?php #echo $header_type == 3 ? ' no-horizontal-padding' : ''; ?>">

				<div class="header-menu<?php echo in_array($header_type, array(3,4)) ? ' logo-is-centered' : ''; echo $header_type == 4 ? ' menu-is-centered-also' : ''; ?>">

					<?php if($header_type == 3) get_template_part('tpls/header-menu'); ?>

					<?php get_template_part('tpls/header-logo'); ?>

					<?php if($header_type == 1) get_template_part('tpls/header-menu'); ?>

					<?php
					if(in_array($header_type, array(1,2,3))):

						if($header_type == 3 && $has_secondary_menu):
							get_template_part('tpls/header-menu-secondary');
						else:
							get_template_part('tpls/header-links');
						endif;

					endif;
					?>

				</div>

			</div>
		</div>
	</div>

	<?php if(in_array($header_type, array(2,4))): ?>
	<div class="full-menu<?php echo $header_type == 4 ? ' menu-centered' : ''; ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="menu-container">
					<?php if($header_sticky_menu): ?>
						<?php get_template_part('tpls/header-logo'); ?>
					<?php endif; ?>

					<?php get_template_part('tpls/header-menu'); ?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

</header>

<?php get_template_part('tpls/header-mobile'); ?>

<?php get_template_part('tpls/header-title'); ?>
