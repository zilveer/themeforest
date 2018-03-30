<div class="logo-bar">

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-9">

				<?php get_template_part('header/header', 'logo'); ?>

			</div>
			<div class="col-md-8 col-xs-12">

				<?php if ( function_exists( 'dynamic_sidebar' ) AND dynamic_sidebar( 'header_sidebar' ) ); ?>

			</div>
		</div><!--/ .row-->
	</div><!--/ .container-->

</div><!--/ .logo-bar-->

<?php if (TMM::get_option('sticky_nav')) { ?>
<div id="navHolder">
<?php } ?>

	<div class="nav-bar sticky-bar">

		<div class="container">
			<div class="row">
				<div class="col-xs-12">

					<?php get_template_part('header/header', 'nav'); ?>

				</div>
			</div><!--/ .row-->
		</div><!--/ .container-->

	</div><!--/ .nav-bar-->

<?php if (TMM::get_option('sticky_nav')) { ?>
</div><!--/ #navHolder-->
<?php } ?>
