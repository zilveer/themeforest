<footer id="footerContainer">
    <div class="patDark">
        <div class="container">
            <div class="row-fluid">
                <div class="<?php echo roots_footer_column_class(); ?> doCenter">
					<?php dynamic_sidebar('sidebar-footer1'); ?>
                </div>
                <div class="<?php echo roots_footer_column_class(); ?> doCenter">
					<?php dynamic_sidebar('sidebar-footer2'); ?>
                </div>
                <div class="<?php echo roots_footer_column_class(); ?> doCenter">
					<?php dynamic_sidebar('sidebar-footer3'); ?>
                </div>
                <div class="<?php echo roots_footer_column_class(); ?> doCenter">
					<?php dynamic_sidebar('sidebar-footer4'); ?>
	                <p><em><?php echo strtr(ct_get_option('general_footer_text', ''), array('%year%' => date('Y'), '%name%' => get_bloginfo('name', 'display')))?></em></p>
                </div>
            </div>
        </div>
    </div>
</footer>