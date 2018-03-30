
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="row">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu-top-wrapper">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php $logo = get_theme_mod('logo'); if($logo) { ?>
                <img src="<?php echo $logo; ?>" alt="Logo"/>
                <?php } else { ?>
                <h2><?php bloginfo('name'); ?></h2>
                <?php } ?>
            </a>
          </div>

            <?php wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container_class' => 'collapse navbar-collapse navbar-responsive-collapse',
                    'menu_class' => 'nav navbar-nav',
                    'fallback_cb' => '',
                    'container_id'    => 'main-menu-top-wrapper',
                    'menu_id' => 'main-menu-top',
                    'walker' => new wp_bootstrap_navwalker()
                )
            ); ?>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
