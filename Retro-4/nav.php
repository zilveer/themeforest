<header role="banner">

    <div class="header-inner <?php if ( op_theme_opt( 'light-menu' ) ) echo 'light-text' ?>" style="background-color: <?php esc_attr_e( op_theme_opt('header-bg-color') ); ?>">

        <div class="container">

            <div class="row clear">

                <?php get_template_part( 'logo' ); ?>

                <nav role="navigation">

                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'clear', 'menu_id' => 'main-nav', 'depth' => 1, 'fallback_cb' => '', 'walker' => new retro_nav_walker() ) ); ?>

                </nav>

            </div><!-- row -->

        </div><!-- container -->

        <hr class="bottom-dashed">  

    </div><!-- header-inner -->   

</header>