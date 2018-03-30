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
<?php if(is_header_and_title_show($header_class['is_shortcode'])) : ?>
    <header <?php echo get_header_json_data($header_class['is_shortcode'], 2); ?> <?php echo mk_get_header_class($header_class); ?> <?php echo get_schema_markup('header'); ?>>
        <?php if (is_header_show($header_class['is_shortcode'])): ?>
            <div class="mk-header-holder">
                <?php mk_get_header_view('holders', 'toolbar', ['is_shortcode' => false]); ?>
                <div class="mk-header-inner">
                    
                    <div class="mk-header-bg <?php echo mk_get_bg_cover_class($mk_options['header_size']); ?>"></div>
                    
                    <?php if (is_header_toolbar_show(false) == 'true') { ?>
                        <div class="mk-toolbar-resposnive-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-chevron-down'); ?></div>
                    <?php } ?>

                    <?php if($mk_options['header_grid'] == 'true'){ ?>
                        <div class="mk-grid header-grid">
                    <?php } ?>
                        <div class="add-header-height">
                            <?php
                                mk_get_header_view('global', 'secondary-menu-burger-icon', ['is_shortcode' => false, 'header_style' => 2]);
                                mk_get_header_view('global', 'main-menu-burger-icon', ['header_style' => 2]);                            
                                mk_get_header_view('master', 'logo');
                            ?>
                        </div>

                    <?php if($mk_options['header_grid'] == 'true'){ ?>
                        </div>
                    <?php } ?>

                    <div class="clearboth"></div>

                    <div class="mk-header-nav-container menu-hover-style-<?php echo esc_attr( $mk_options['main_nav_hover'] ); ?>" <?php echo get_schema_markup('nav'); ?>>
                        <div class="mk-classic-nav-bg"></div>
                        <div class="mk-classic-menu-wrapper">
                            <?php
                            mk_get_header_view('master', 'main-nav');
                            mk_get_header_view('global', 'nav-side-search', ['header_style' => 2]);
                            mk_get_header_view('master', 'checkout', ['header_style' => 2]);
                            ?>
                        </div>
                    </div>


                    <div class="mk-header-right">
                        <?php
                        do_action('header_right_before');
                        mk_get_header_view('master', 'start-tour');
                        mk_get_header_view('global', 'search', ['location' => 'header']);
                        mk_get_header_view('global', 'social', ['location' => 'header']);
                        do_action('header_right_after');
                        ?>
                    </div>
                    <?php mk_get_header_view('global', 'responsive-menu', ['is_shortcode' => false]); ?>         
                </div>
            </div>
        <?php endif;// End for option to disable header ?>
        <?php mk_get_header_view('global', 'header-sticky-padding', ['is_shortcode' => false]); ?>
        <?php if(!$is_transparent)  mk_get_view('layout', 'title', false, ['is_shortcode' => false]); ?>
    </header>
<?php endif; // End to disale whole header