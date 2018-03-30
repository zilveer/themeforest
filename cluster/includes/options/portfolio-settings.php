<?php
add_action('admin_init', 'stag_portfolio_settings');
function stag_portfolio_settings(){
    $portfolio_settings['description'] = 'Configure portfolio settings of your theme.';

    $portfolio_settings[] = array(
        'title' => __('Portfolio Style', 'stag'),
        'desc'  => __('Select the portfolio filter style for portfolio template. <br><br><strong>Note:</strong> If selecting the Filterable, portfolio expansion will automatically be disabled and will take directly to the single page.', 'stag'),
        'type'  => 'select',
        'id'    => 'portfolio_style',
        'val'   => 'filterable',
        'options' => array(
            'filterable' => __('Filterable', 'stag'),
            'exapandable' => __('Expandable', 'stag'),
        )
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Count', 'stag'),
        'desc'  => __('Enter the number of portfolio items for portfolio page.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_count',
        'val'   => 15,
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Title', 'stag'),
        'desc'  => __('Enter the default title for portfolio header section.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_title',
        'val'   => 'Featured Work / portfolio'
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Subtitle', 'stag'),
        'desc'  => __('Enter the default subtitle for portfolio header section.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_subtitle',
        'val'   => 'A bit of my work.'
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Background Image', 'stag'),
        'desc'  => __('Upload a default background image for the portfolio header section.', 'stag'),
        'type'  => 'files',
        'id'    => 'portfolio_background',
        'val'   => __('Upload Background', 'stag')
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Background Color', 'stag'),
        'desc'  => __('Choose a default background color for the portfolio header section.', 'stag'),
        'type'  => 'color',
        'id'    => 'portfolio_background_color',
        'val'   => ''
    );

    $portfolio_settings[] = array(
        'title' => __('Portfolio Background Opacity', 'stag'),
        'desc'  => __('Choose a default value for background image at the portfolio header section. For no opacity give a value of 100.', 'stag'),
        'type'  => 'text',
        'id'    => 'portfolio_background_opacity',
        'val'   => '50'
    );

    stag_add_framework_page( 'Portfolio Settings', $portfolio_settings, 20);
}
