
<?php
global $venedor_settings, $venedor_design, $woocommerce;

$show_switcher = false;
$show_minicart = false;
$menu_align = $venedor_settings['menu-align'];

// get view switcher html
$switcher_html = venedor_html_switcher();
if ($switcher_html) $show_switcher = $venedor_settings['show-sticky-switcher'];

// get main menu html
$menu_html = venedor_html_menu();

// get mini cart html
$minicart_html = venedor_html_minicart();
if ($minicart_html) $show_minicart = $venedor_settings['show-sticky-minicart'];
?>

<!-- header -->
<div class="header">
    <!-- menu -->
    <div class="menu-wrapper">
        <div class="container">
            <?php if($venedor_settings['show-sticky-logo']) : ?>
            <!-- header left -->
            <div class="left">
                <!-- logo -->
                <h1 class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
                        <?php echo '<img src="'.$venedor_settings['sticky-logo']['url'].'" />'; ?>
                    </a>
                </h1>
                <!-- end logo -->
            </div>
            <!-- end header left -->
            <?php endif; ?>
        
            <?php if ($menu_align == 'left') : ?>
                <?php echo $menu_html; ?>
            <?php endif; ?>
            
            <!-- quick access -->
            <div class="quick-access search-popup">
                <?php if ($venedor_settings['show-searchform'] && $venedor_settings['show-sticky-searchform']) : ?>
                <!-- search form -->
                <div id="search-form">
                    <?php venedor_search_form( ); ?>
                </div>
                <!-- end search form -->
                <?php endif; ?>
                
                <?php if ($show_switcher) echo $switcher_html; ?>
                <?php if ($show_minicart) echo $minicart_html; ?>
            </div>
            <!-- end quick access -->
            
            <?php if ($menu_align == 'right') : ?>
                <?php echo $menu_html; ?>
            <?php endif; ?>
        </div>
        <div class="container-shadow"></div>
    </div>
    <!-- end menu -->
</div>
<!-- end header -->

