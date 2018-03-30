<?php 
/**
 * template part for Header. views/header/styles
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */
global $mk_options;

$header_class = array(
        'sh_id' => Mk_Static_Files::shortcode_id(),
        'is_shortcode' => false,
        'el_class' => '',
);

$is_transparent = (isset($view_params['is_transparent'])) ? ($view_params['is_transparent'] == 'false' ? false : is_header_transparent()) : is_header_transparent();

?> 
<?php //if(is_header_and_title_show()) : ?>
    <header <?php echo get_header_json_data($header_class['is_shortcode'], 4); ?> <?php echo mk_get_header_class($header_class); ?> <?php echo get_schema_markup('header'); ?>>
        <?php if (is_header_show()): ?>
            <div class="mk-header-holder">
                <?php mk_get_header_view('holders', 'toolbar'); ?>
                <div class="mk-header-inner">
                    
                    <div class="mk-header-bg <?php echo mk_get_bg_cover_class($mk_options['header_size']); ?>"></div>

                    <?php if (is_header_toolbar_show(false) == 'true') { ?>
                        <div class="mk-toolbar-resposnive-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-chevron-down'); ?></div>
                    <?php } ?>

                    <?php
                        mk_get_header_view('global', 'main-menu-burger-icon', ['header_style' => 4]);                            
                        mk_get_header_view('master', 'logo');
                    ?>

                    <div class="clearboth"></div>

                    <?php 
                        echo wp_nav_menu(array(
                            'theme_location' => mk_main_nav_location() ,
                            'container' => 'nav',
                            'container_id' => 'mk-vm-menu',
                            'container_class' => 'mk-vm-menuwrapper ' . 'menu-hover-style-' . esc_attr( $mk_options['main_nav_hover'] ) . ' js-main-nav',
                            'menu_class' => 'mk-vm-menu',
                            'fallback_cb' => '',
                            'walker' => new header_icon_walker() ,
                        ));

                        mk_get_header_view('master', 'checkout', ['header_style' => 4]);
                     ?>

                    <div class="mk-header-right">
                        <?php
                            do_action('header_right_before');
                            mk_get_header_view('master', 'start-tour');
                            mk_get_header_view('global', 'search', ['location' => 'header']);
                            mk_get_header_view('global', 'social', ['location' => 'header']);
                        ?>
                        
                        <div class="clearboth"></div>
                        <div class="vm-header-copyright"><?php echo stripslashes($mk_options['vertical_menu_copyright']); ?></div>

                        <?php do_action('header_right_after'); ?>
                    </div>
                    <?php mk_get_header_view('global', 'responsive-menu', ['is_shortcode' => false]); ?>        
                </div>
            </div>
        <?php endif; // End for option to disable header ?>

        <?php if(!$is_transparent) mk_get_view('layout', 'title', false, ['is_shortcode' => false]); ?>
    </header>
<?php //endif; // End to disale whole header