<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php get_template_part('templates/header/top','forum'); ?>

<section id="layout" class="blog-page dfd-equal-height-children">
    <div class="row">
		<div class="nine columns dfd-equ-height">
        <?php
        set_layout('pages');

        get_template_part('templates/content', 'page');

        set_layout('pages', false);

        ?>
		</div>
		<?php //</div> @TODO: непонятный баг с лишним открытым дивом !!! ?>
		<div class="three columns dfd-eq-height">
			<?php dynamic_sidebar('sidebar-bbres-right');?>
		</div>
    </div>
</section>