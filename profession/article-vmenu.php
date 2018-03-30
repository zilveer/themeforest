<?php
function px_register_menus() {
    register_nav_menu( 'primary-nav', __( 'Primary Navigation', TEXTDOMAIN ) );
    register_nav_menu( 'mobile-nav', __( 'Mobile Navigation', TEXTDOMAIN ) );
}

add_action( 'init', 'px_register_menus' );
?>
<!-- Header -->
<header class="wrap">
	<div class="vertical-header container">
	
		<div class="mobile-menu visible-tablet">
			<a href=""></a>
			<ul class="mobile-ul clearfix">

                <?php if(function_exists('wp_nav_menu') && has_nav_menu('primary-nav')) {
                    wp_nav_menu(array(
                        'container' =>'',
                        'menu_class' => 'mobile-ul clearfix',
                        'theme_location' => 'primary-nav',
                        'items_wrap'      => '%3$s',
                        'walker' => new Custom_Nav_Walker()
                    ));
                }
                ?>
            </ul>
		</div>

		<div class="menu-area hidden-tablet">
			<div class="menu" <?php if ( opt('menu_toggle') == 1 ) { ?> style="margin-left: 0px;" <?php } ?> >
				<ul class="clearfix">

                    <?php if(function_exists('wp_nav_menu') && has_nav_menu('primary-nav')) {
                        wp_nav_menu(array(
                            'container' =>'',
                            'menu_class' => 'mobile-ul clearfix',
                            'theme_location' => 'primary-nav',
                            'items_wrap'      => '%3$s',
                            'walker' => new Custom_Nav_Walker()
                        ));
                    }
                    ?>
                </ul>
			</div>
			<div class="menu-button-minus <?php if ( opt('menu_toggle') == 1 ) { ?> menu-button-plus <?php } ?>"></div>
		</div>
		
		<div class="header-titles hidden-tablet" <?php if ( opt('menu_toggle') == 1 ) { ?> style="display: none;" <?php } ?>>
			
			<?php if ( opt('title_name') ) { ?>
			
				<div class="name-title">
					<?php  eopt('title_name'); ?>
				</div>
				
			<?php }  if ( opt('title_posotion') ) { ?>
				<span id="title-seperator">|</span>
				
				<div class="job-title hidden-vertical-mobile">
					<?php  eopt('title_posotion'); ?>
				</div>
				
			<?php } ?>
			
		</div>
		
		<div class="header-titles visible-tablet">
			
			<?php if ( opt('title_name') ) { ?>
			
				<div class="name-title">
					<?php  eopt('title_name'); ?>
				</div>
				
			<?php }  if ( opt('title_posotion') ) { ?>
				<span id="title-seperator">|</span>
				
				<div class="job-title hidden-vertical-mobile">
					<?php  eopt('title_posotion'); ?>
				</div>
				
			<?php } ?>
		</div>
	</div>
</header>