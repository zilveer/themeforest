<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
	        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	        <a class="brand" href="<?php echo ct_get_option('test_title',home_url()); ?>"><img src="<?php echo esc_url(ct_get_option('general_logo'))?>" alt="logo"/></a>
	        <div class="nav-collapse" id="nav-main">
		        <?php if (has_nav_menu('primary_navigation')) {
                        wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav pull-right'));
                    }?>
	        </div>
        </div>
    </div>
</div>
