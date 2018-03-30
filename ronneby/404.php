<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_template_part('templates/header/top', 'page'); ?>

<section id="layout" class="blog-page dfd-equal-height-children">
    <div class="row">

		<?php
		set_layout('404');
		
		get_template_part('templates/notresult','content');

        set_layout('404', false);
		 ?>
		
	</div>	
</section>




