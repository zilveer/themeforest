<?php 
/**
 * template part for Header. views/header/styles
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */
global $mk_options;

    /*
    * These options comes from header shortcode and will only be used to override the header options through shortcode.
    */
    $header_class = array(
        'sh_id' => isset($view_params['id']) ? esc_attr( $view_params['id'] ) : Mk_Static_Files::shortcode_id(),
        'is_shortcode' => isset($view_params['is_shortcode']) ? esc_attr( $view_params['is_shortcode'] ) : false,
        'sh_toolbar' => isset($view_params['toolbar']) ? esc_attr( $view_params['toolbar'] ) : '',
        'sh_is_transparent' => isset($view_params['is_transparent']) ? esc_attr( $view_params['is_transparent'] ) : '',
        'sh_header_style' => isset($view_params['header_styles']) ? esc_attr( $view_params['header_styles'] ) : '',
        'sh_header_align' => isset($view_params['header_align']) ? esc_attr( $view_params['header_align'] ) : '',
        'sh_hover_styles' => isset($view_params['hover_styles']) ? esc_attr( $view_params['hover_styles'] ) : esc_attr( $mk_options['main_nav_hover'] ),
        'el_class' => isset($view_params['el_class']) ? esc_attr( $view_params['el_class'] ) : '',
    );

    $is_shortcode = $header_class['is_shortcode'];
    $is_transparent = (isset($view_params['is_transparent'])) ? ($view_params['is_transparent'] == 'false' ? false : is_header_transparent()) : is_header_transparent();

    $show_logo = isset($view_params['logo']) ? esc_attr( $view_params['logo'] ) : false;
    $seconday_show_logo = isset($view_params['burger_icon']) ? esc_attr( $view_params['burger_icon'] ) : false;
    $show_cart = isset($view_params['woo_cart']) ? esc_attr( $view_params['woo_cart'] ) : false;
    $search_icon = isset($view_params['search_icon']) ? esc_attr( $view_params['search_icon'] ) : false;

?> 
<?php if(is_header_and_title_show($is_shortcode)) : ?>
    <header <?php echo get_header_json_data($is_shortcode, $header_class['sh_header_style']); ?> <?php echo mk_get_header_class($header_class); ?> <?php echo get_schema_markup('header'); ?>>
        <?php if (is_header_show($is_shortcode)): ?>
            <div class="mk-header-holder">
                <?php mk_get_header_view('holders', 'toolbar', ['is_shortcode' => $is_shortcode]); ?>
                <div class="mk-header-inner add-header-height">

                    <div class="mk-header-bg <?php echo mk_get_bg_cover_class($mk_options['header_size']); ?>"></div>
                    
                    <?php if (is_header_toolbar_show($is_shortcode) == 'true') { ?>
                        <div class="mk-toolbar-resposnive-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-chevron-down'); ?></div>
                    <?php } ?>

                    <?php if($mk_options['header_grid'] == 'true'){ ?>
                        <div class="mk-grid header-grid">
                    <?php } ?>

                            <div class="add-header-height">
                                <?php
                                    if($seconday_show_logo != 'false') {
                                        mk_get_header_view('global', 'secondary-menu-burger-icon', ['is_shortcode' => $is_shortcode, 'header_style' => 3]);
                                    }
                                    
                                    if($show_cart != 'false') { 
                                        mk_get_header_view('master', 'checkout', ['header_style' => 3]);
                                    }

                                    mk_get_header_view('global', 'main-menu-burger-icon', ['header_style' => 3]);
                                    
                                    if($show_logo != 'false') {                             
                                        mk_get_header_view('master', 'logo');
                                    }
                                ?>
                            </div>

                    <?php if($mk_options['header_grid'] == 'true'){ ?>
                        </div>
                    <?php } ?>

                    <div class="mk-header-right">
                        <?php
                        do_action('header_right_before');
                        mk_get_header_view('master', 'start-tour');
                        mk_get_header_view('global', 'search', ['location' => 'header']);
                        mk_get_header_view('global', 'social', ['location' => 'header']);
                        do_action('header_right_after');
                        ?>
                    </div>

                </div>
            </div>
        <?php endif; // End for option to disable header ?>

        <?php mk_get_header_view('global', 'header-sticky-padding' , ['is_shortcode' => $is_shortcode]); ?>
        <?php if(!$is_transparent) mk_get_view('layout', 'title', false, ['is_shortcode' => $is_shortcode]); ?>
    </header>
<?php endif; // End to disale whole header