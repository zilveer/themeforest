<?php
global $ft_option, $fave_container;
$sticky_nav = isset( $ft_option['desktop_sticky_nav'] ) ? $ft_option['desktop_sticky_nav'] : 0;
?>

<div class="<?php echo esc_attr( $fave_container ); ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <nav class="magazilla-main-nav navbar yamm navbar-header-1" data-sticky="<?php echo $sticky_nav; ?>" >
                <div class="sticky_inner">
                    <?php
                    // Pages Menu
                    if ( has_nav_menu( 'main-menu' ) ) :
                        wp_nav_menu( array (
                            'theme_location' => 'main-menu',
                            'container' => '',
                            'container_class' => '',
                            'menu_class' => 'nav navbar-nav',
                            'menu_id' => 'main-nav',
                            'depth' => 4,
                            'walker' => new favethemes_Walker()
                            ));
                    endif;
                    ?>

                    <?php if( $ft_option['header_search'] != 0 ){ ?>
                    <?php get_template_part('inc/header/search', 'form' ); ?>
                    <?php } ?>
                </div>
            </nav><!-- navbar -->
        </div>
    </div>
</div>