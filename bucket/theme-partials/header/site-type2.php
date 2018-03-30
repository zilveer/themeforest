<header class="header header--type2">

    <nav class="navigation  navigation--top">

        <div class="container">
            <h2 class="accessibility"><?php _e('Secondary Navigation', 'bucket') ?></h2>
			
            <div class="grid">
                <div class="grid__item one-half">
                    <?php wpgrade_top_nav_left(); ?>
                </div><!--
             --><div class="grid__item one-half text--right">
                    <ul class="header-bar header-bar--top nav flush--bottom"><!--
				     --><li><?php wpgrade_top_nav_right(); ?></li><!--
                     --><li><?php get_template_part('theme-partials/wpgrade-partials/social-icons-list'); ?></li><!--
                        <?php
                        if (wpgrade::option('nav_show_header_search')): ?>
                     --><li><?php get_search_form(); ?></li><!--
                        <?php endif; ?>
                 --></ul>
                </div>
            </div>
        </div>

    </nav>

    <div class="container">

        <div class="site-header flexbox">
            <div class="site-header__branding  flexbox__item  one-whole  lap-and-up-three-tenths">
                <?php get_template_part('theme-partials/header/site-header__branding'); ?>
            </div><!--
            --><?php if (wpgrade::option('header_728_90_ad')): ?>
			<div class="header-ad  flexbox__item  one-whole  lap-and-up-seven-tenths">
                <?php echo do_shortcode(wpgrade::option('header_728_90_ad')); ?>
            </div>
			<?php endif; ?>
        </div>

        <div class="site-navigation__trigger js-nav-trigger"><span class="nav-icon"></span></div>                
        
		<hr class="nav-top-separator separator separator--subsection flush--bottom" />
		
        <nav class="navigation  navigation--main  js-navigation--main">
            <h2 class="accessibility"><?php _e('Primary Navigation', 'bucket') ?></h2>
            <div class="nav--main__wrapper  js-sticky">
                <?php wpgrade_main_nav(); ?>
            </div>
        </nav>

    </div>

</header><!-- .header -->