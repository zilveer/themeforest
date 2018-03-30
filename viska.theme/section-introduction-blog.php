<!-- Preloader -->
<?php displayPreloadLogo(); ?>
    <!-- End Preloader -->

    <!-- End Navigation -->
<?php if(has_nav_menu( 'main_menu' )) : ?>
    <nav id="nav-menu">
        <span id="close-menu"></span>
        <?php
        awe_main_nav();
        ?>
    </nav>
<?php endif; ?>
    <!-- HOME -->
    <div id="blog-banner" class="blog-home video-place parallax" <?php display_blog_background(); ?>>
        <div class="head-ct">
            <div class="home-content" id="home-content">
                <!-- Slider content -->
                <?php display_intro_content('blog_data','blog_bg'); ?>
            </div>
        <!-- Home media Image, Video, Slide -->
        </div>  
        <?php display_overlay('blog_bg'); ?>
    </div>
    <!-- End Header -->
    <header id="header">
        <div class="container">
            <!-- Logo -->
            <?php displayLogo(); ?>

            
            <!-- Button Menu -->
            <?php if(has_nav_menu( 'main_menu' )) : ?>
                <span id="button-menu">
                    <i class="icon"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                </span>
                
            <?php endif; ?>
            <?php do_action('awe_lang_bar'); ?>
            <?php awe_top_nav(); ?>

        </div>
    </header>