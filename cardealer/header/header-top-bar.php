<div class="top-bar">

	<div class="container">
		<div class="row">
			<div class="col-xs-12">

				<?php get_template_part('header/header', 'cart'); ?>

				<?php if ( function_exists( 'dynamic_sidebar' ) AND dynamic_sidebar( 'top_sidebar' ) ); ?>

			</div>
		</div>
	</div>

</div>