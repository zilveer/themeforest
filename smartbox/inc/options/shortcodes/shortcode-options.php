<?php
/**
 * Themes shortcode options go here
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

return array(
    /* Columns */
    array(
        'title' => __('Columns', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode' => 'row',
                'insert'    => '[row][/row]',
                'title'     => __('Blank Row', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span1',
                'insert'    => '[span1][/span1]',
                'title'     => __('Span1 (1/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span2',
                'insert'    => '[span2][/span2]',
                'title'     => __('Span2 (1/6th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span3',
                'insert'    => '[span3][/span3]',
                'title'     => __('Span3 (1/4)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span4',
                'insert'    => '[span4][/span4]',
                'title'     => __('Span4 (1/3rd)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span5',
                'insert'    => '[span5][/span5]',
                'title'     => __('Span5 (5/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span6',
                'insert'    => '[span6][/span6]',
                'title'     => __('Span6 (1/2)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span7',
                'insert'    => '[span7][/span7]',
                'title'     => __('Span7 (7/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span8',
                'insert'    => '[span8][/span8]',
                'title'     => __('Span8 (2/3rd)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span9',
                'insert'    => '[span9][/span9]',
                'title'     => __('Span9 (3/4)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span10',
                'insert'    => '[span10][/span10]',
                'title'     => __('Span10 (10/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span11',
                'insert'    => '[span11][/span11]',
                'title'     => __('Span11 (11/12th)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'span12',
                'insert'    => '[span12][/span12]',
                'title'     => __('Span12 (one whole row)', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            )
        )
    ),

    /* Layouts */
    array(
        'title' => __('Layouts', THEME_ADMIN_TD),
        'members' => array(
            array(
                'title' => __('2 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span6]Column1[/span6][span6]Column 2[/span6][/row]',
                        'title'     => __('1/2 - 1/2', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span4]Column1[/span4][span8]Column 2[/span8][/row]',
                        'title'     => __('1/3 - 2/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span8]Column1[/span8][span4]Column 2[/span4][/row]',
                        'title'     => __('2/3 - 1/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span3]Column1[/span3][span9]Column 2[/span9][/row]',
                        'title'     => __('1/4 - 3/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span9]Column1[/span9][span3]Column 2[/span3][/row]',
                        'title'     => __('3/4 - 1/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            ),
            array(
                'title' => __('3 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span4]Column1[/span4][span4]Column 2[/span4][span4]Column 3[/span4][/row]',
                        'title'     => __('1/3 - 1/3 - 1/3', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            ),
            array(
                'title' => __('4 Columns', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode' => 'layout',
                        'insert'    => '[row][span3]Column1[/span3][span3]Column 2[/span3][span3]Column 3[/span3][span3]Column 4[/span3][/row]',
                        'title'     => __('1/4 - 1/4 - 1/4 - 1/4', THEME_ADMIN_TD),
                        'insert_with' => 'insert',
                    ),
                )
            )
        )
    ),

    /* Components */
    array(
        'title' => __('Components', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode'   => 'button',
                'title'       => __('Button', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'General',
                        'fields'  => array(
                            array(
                                'name'    => __('Button type', THEME_ADMIN_TD),
                                'desc'    => __('Type of button to display', THEME_ADMIN_TD),
                                'id'      => 'type',
                                'type'    => 'select',
                                'default' => 'default',
                                'options' => array(
                                        'default' => __('Default', THEME_ADMIN_TD),
                                        'primary' => __('Primary', THEME_ADMIN_TD),
                                        'info'    => __('Info', THEME_ADMIN_TD),
                                        'success' => __('Success', THEME_ADMIN_TD),
                                        'warning' => __('Warning', THEME_ADMIN_TD),
                                        'danger'  => __('Danger', THEME_ADMIN_TD),
                                        'inverse' => __('Inverse', THEME_ADMIN_TD),
                                        'link'    => __('Link', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Button size', THEME_ADMIN_TD),
                                'desc'    => __('Size of button to display', THEME_ADMIN_TD),
                                'id'      => 'size',
                                'type'    => 'select',
                                'default' => '',
                                'options' => array(
                                        ''             => __('Default', THEME_ADMIN_TD),
                                        'btn-large'    => __('Large', THEME_ADMIN_TD),
                                        'btn-small'    => __('Small', THEME_ADMIN_TD),
                                        'btn-mini'     => __('Mini', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Text', THEME_ADMIN_TD),
                                'id'      => 'label',
                                'type'    => 'text',
                                'default' => __('My button', THEME_ADMIN_TD),
                                'desc'    => __('Add a label to the button', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Link', THEME_ADMIN_TD),
                                'id'      => 'link',
                                'type'    => 'text',
                                'default' => '',
                                'desc'    => __('Where the button links to', THEME_ADMIN_TD),
                            ),
                        )
                    ),
                    array(
                        'title'   => 'Advanced',
                        'fields'  => array(
                            array(
                                'name'    => __('Extra classes', THEME_ADMIN_TD),
                                'id'      => 'xclass',
                                'type'    => 'text',
                                'default' => '',
                                'desc'    => __('Add an extra class to the button', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Open Link In', THEME_ADMIN_TD),
                                'id'      => 'link_open',
                                'type'    => 'select',
                                'default' => '_self',
                                'options' => array(
                                    '_self'   => __('Same page as it was clicked ', THEME_ADMIN_TD),
                                    '_blank'  => __('Open in new window/tab', THEME_ADMIN_TD),
                                    '_parent' => __('Open the linked document in the parent frameset', THEME_ADMIN_TD),
                                    '_top'    => __('Open the linked document in the full body of the window', THEME_ADMIN_TD)
                                ),
                                'desc'    => __('Where the button link opens to', THEME_ADMIN_TD),
                            ),
                        )
                    ),
                    array(
                        'title'   => 'Icon',
                        'fields'  => array(
                            array(
                                'name'    => __('Icon', THEME_ADMIN_TD),
                                'desc'    => __('Type of button to display', THEME_ADMIN_TD),
                                'id'      => 'icon',
                                'type'    => 'icons',
                                'default' => ''
                            )
                        ),
                    ),
                ),
            ),
            array(
                'shortcode'   => 'alert',
                'title'       => __('Bootstrap alert', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'general',
                        'fields'  => array(
                            array(
                                'name'    => __('Alert type', THEME_ADMIN_TD),
                                'desc'    => __('Type of alert to display', THEME_ADMIN_TD),
                                'id'      => 'type',
                                'type'    => 'select',
                                'default' => 'default',
                                'options' => array(
                                        ''              => __('default', THEME_ADMIN_TD),
                                        'alert-block'   => __('block', THEME_ADMIN_TD),
                                        'alert-error'   => __('danger', THEME_ADMIN_TD),
                                        'alert-success' => __('success', THEME_ADMIN_TD),
                                        'alert-info'    => __('information', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Label', THEME_ADMIN_TD),
                                'id'      => 'label',
                                'type'    => 'text',
                                'default' => __('warning!', THEME_ADMIN_TD),
                                'desc'    => __('The alert label', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Description', THEME_ADMIN_TD),
                                'id'      => 'Description',
                                'type'    => 'text',
                                'default' => __('something is wrong!', THEME_ADMIN_TD),
                                'desc'    => __('Add a description to your warning', THEME_ADMIN_TD),
                            )
                        )
                    ),
                ),
            ),
            array(
                'shortcode' => 'accordions',
                'insert'    => '[accordions][accordion title="Accordion title"]Accordion content[/accordion][/accordions]',
                'title'     => __('Accordion', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode' => 'tabs',
                'insert'    => '[tabs style="top"][tab title="First title"]First content here[/tab][tab title="Second title"]Second content[/tab][/tabs]',
                'title'     => __('Tabs', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode'   => 'progress',
                'title'       => __('Progress Bar', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'general',
                        'fields'  => array(
                            array(
                                'name'    => __('Percentage', THEME_ADMIN_TD),
                                'desc'    => __('Percentage of the progress bar', THEME_ADMIN_TD),
                                'id'      => 'percentage',
                                'type'    => 'slider',
                                'default' => 50,
                                'attr'    => array(
                                    'max'  => 100,
                                    'min'  => 1,
                                    'step' => 1
                                )
                            ),
                            array(
                                'name'    => __('Bar Type', THEME_ADMIN_TD),
                                'desc'    => __('Type of bar to display', THEME_ADMIN_TD),
                                'id'      => 'type',
                                'type'    => 'radio',
                                'default' => 'progress',
                                'options' => array(
                                    'progress'                        => __('Normal', THEME_ADMIN_TD),
                                    'progress progress-striped'       => __('Striped', THEME_ADMIN_TD),
                                    'progress progress-striped active'=> __('Animated', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Bar Style', THEME_ADMIN_TD),
                                'desc'    => __('Style of bar to display', THEME_ADMIN_TD),
                                'id'      => 'style',
                                'type'    => 'select',
                                'default' => 'progress-info',
                                'options' => array(
                                    'progress-info'     => __('Info', THEME_ADMIN_TD),
                                    'progress-success'  => __('Success', THEME_ADMIN_TD),
                                    'progress-warning'  => __('Warning', THEME_ADMIN_TD),
                                    'progress-danger'   => __('Danger', THEME_ADMIN_TD),
                                ),
                            ),


                        )
                    ),
                ),
            ),
            array(
                'shortcode' => 'pricing',
                'insert'    => '[pricing heading="standard" price="10" currency="dollar" per="month" featured="no"]<ul class="well-package-list"><li>1 project</li><li>5 GB Storage</li></ul>[button icon="" size="btn-large" type="primary" label="Sign Up" link="#"][/pricing]',
                'title'     => __('Pricing Column', THEME_ADMIN_TD),
                'insert_with' => 'insert',
            ),
            array(
                'shortcode'     => 'image',
                'title'         => __('Image', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Image', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Image size', THEME_ADMIN_TD),
                                'desc'    => __('Choose the size that the image will have', THEME_ADMIN_TD),
                                'id'      => 'size',
                                'type'    => 'select',
                                'default' => 'box-medium',
                                'options' => array(
                                        'box-mini'   => __('Mini', THEME_ADMIN_TD),
                                        'box-small'  => __('Small', THEME_ADMIN_TD),
                                        'box-medium' => __('Medium', THEME_ADMIN_TD),
                                        'box-big'    => __('Big', THEME_ADMIN_TD),
                                        'box-huge'   => __('Huge', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Rounded', THEME_ADMIN_TD),
                                'desc'    => __('Choose if the image will be roundrd or not', THEME_ADMIN_TD),
                                'id'      => 'rounded',
                                'type'    => 'radio',
                                'default' => 'yes',
                                'options'    => array(
                                        'yes'   => __('Rounded', THEME_ADMIN_TD),
                                        'no'    => __('Squared', THEME_ADMIN_TD),
                                )
                            ),
                            array(
                                'name'    => __('Polaroid', THEME_ADMIN_TD),
                                'desc'    => __('Display image in polaroid style', THEME_ADMIN_TD),
                                'id'      => 'polaroid',
                                'type'    => 'radio',
                                'default' => 'no',
                                'options'    => array(
                                        'yes'   => __('Yes', THEME_ADMIN_TD),
                                        'no'    => __('No', THEME_ADMIN_TD),
                                )
                            ),
                            array(
                                'name'    => __('Image Source', THEME_ADMIN_TD),
                                'id'      => 'source',
                                'type'    => 'text',
                                'default' => '',
                                'desc'    => __('Place the source path of the image here', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Image Alt', THEME_ADMIN_TD),
                                'id'      => 'alt',
                                'type'    => 'text',
                                'default' => '',
                                'desc'    => __('Place the alternative tag of the image here', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Link', THEME_ADMIN_TD),
                                'id'      => 'link',
                                'type'    => 'text',
                                'default' => '',
                                'desc'    => __('Place a link here', THEME_ADMIN_TD),
                            )
                        )
                    ),
                    array(
                        'title'   => 'Icon',
                        'fields'  => array(
                            array(
                                'name'    => __('Icon', THEME_ADMIN_TD),
                                'desc'    => __('Add an icon to the image', THEME_ADMIN_TD),
                                'id'      => 'icon',
                                'type'    => 'icons'
                            )
                        )
                    )
                )
            ),
            array(
                'shortcode'     => 'flexslider',
                'title'         => __('Slideshow', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Slideshow', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Choose a slideshow', THEME_ADMIN_TD),
                                'desc'    => __('Populate your slider with one of the slideshows you created', THEME_ADMIN_TD),
                                'id'      => 'slideshow',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'slideshow',
                            ),
                            array(
                                'name'      =>  __('Animation style', THEME_ADMIN_TD),
                                'desc'      =>  __('Select how your slider animates', THEME_ADMIN_TD),
                                'id'        => 'animation',
                                'type'      => 'select',
                                'options'   =>  array(
                                    'slide' => __('Slide', THEME_ADMIN_TD),
                                    'fade'  => __('Fade', THEME_ADMIN_TD),
                                ),
                                'attr'      =>  array(
                                    'class'    => 'widefat',
                                ),
                                'default'   => 'slide',
                            ),
                            array(
                                'name'      => __('Speed', THEME_ADMIN_TD),
                                'desc'      => __('Set the speed of the slideshow cycling, in milliseconds', THEME_ADMIN_TD),
                                'id'        => 'speed',
                                'type'      => 'slider',
                                'default'   => 7000,
                                'attr'      => array(
                                    'max'       => 15000,
                                    'min'       => 2000,
                                    'step'      => 1000
                                )
                            ),
                            array(
                                'name'      => __('Duration', THEME_ADMIN_TD),
                                'desc'      => __('Set the speed of animations', THEME_ADMIN_TD),
                                'id'        => 'duration',
                                'type'      => 'slider',
                                'default'   => 600,
                                'attr'      => array(
                                    'max'       => 1500,
                                    'min'       => 200,
                                    'step'      => 100
                                )
                            ),
                            array(
                                'name'      => __('Auto start', THEME_ADMIN_TD),
                                'id'        => 'autostart',
                                'type'      => 'radio',
                                'default'   =>  'true',
                                'desc'    => __('Start slideshow automatically', THEME_ADMIN_TD),
                                'options' => array(
                                    'true'  => __('On', THEME_ADMIN_TD),
                                    'false' => __('Off', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Show navigation arrows', THEME_ADMIN_TD),
                                'id'        => 'directionnav',
                                'type'      => 'radio',
                                'default'   =>  'hide',
                                'options' => array(
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Navigation arrows position', THEME_ADMIN_TD),
                                'id'        => 'directionnavpos',
                                'type'      => 'radio',
                                'default'   =>  'outside',
                                'options' => array(
                                    'outside' => __('Outside', THEME_ADMIN_TD),
                                    'inside'  => __('Inside', THEME_ADMIN_TD),
                                ),
                            ),
                             array(
                                'name'      => __('Item width', THEME_ADMIN_TD),
                                'desc'      => __('Set width of the slider items( leave blank for full )', THEME_ADMIN_TD),
                                'id'        => 'itemwidth',
                                'type'      => 'text',
                                'default'   => '',
                                'attr'      =>  array(
                                    'size'    => 8,
                                ),
                            ),
                            array(
                                'name'      => __('Show controls', THEME_ADMIN_TD),
                                'id'        => 'showcontrols',
                                'type'      => 'radio',
                                'default'   =>  'show',
                                'options' => array(
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Choose the place of the controls', THEME_ADMIN_TD),
                                'id'        => 'controlsposition',
                                'type'      => 'radio',
                                'default'   =>  'inside',
                                'options' => array(
                                    'inside'    => __('Inside', THEME_ADMIN_TD),
                                    'outside'   => __('Outside', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                    array(
                        'title' => __('Captions', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'      => __('Show Captions', THEME_ADMIN_TD),
                                'id'        => 'captions',
                                'type'      => 'radio',
                                'default'   =>  'show',
                                'options' => array(
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Captions Size', THEME_ADMIN_TD),
                                'id'        => 'captionsize',
                                'type'      => 'radio',
                                'default'   =>  'super',
                                'options' => array(
                                    'super' => __('Big', THEME_ADMIN_TD),
                                    'small' => __('Small', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Captions Animation', THEME_ADMIN_TD),
                                'id'        => 'captionanimation',
                                'type'      => 'radio',
                                'default'   =>  'animated',
                                'options' => array(
                                    'animated' => __('Animated', THEME_ADMIN_TD),
                                    'static' => __('Static', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                )
            ),
            array(
                'shortcode'   => 'categories',
                'title'       => __('Categories', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'General',
                        'fields'  => array(
                            array(
                                'name'      => __('Show post counts', THEME_ADMIN_TD),
                                'id'        => 'categoriespostcount',
                                'type'      => 'radio',
                                'default'   =>  'on',
                                'options' => array(
                                    'on'   => __('On', THEME_ADMIN_TD),
                                    'off'  => __('Off', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Show hierarchy', THEME_ADMIN_TD),
                                'id'        => 'categorieshierarchy',
                                'type'      => 'radio',
                                'default'   =>  'on',
                                'options' => array(
                                    'on'   => __('On', THEME_ADMIN_TD),
                                    'off'  => __('Off', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                ),
            ),
        )
    ),
    /* Typography */
    array(
        'title' => __('Typography', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode'   => 'lead',
                'title'       => __('Lead Paragraph', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[lead centered="yes"][/lead]'
            ),
            array(
                'shortcode'   => 'blockquote',
                'title'       => __('Blockquote', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[blockquote who="" cite=""][/blockquote]'
            ),
            array(
                'shortcode'   => 'iconlist',
                'title'       => __('Iconlist', THEME_ADMIN_TD),
                'insert_with' => 'insert',
                'insert'      => '[iconlist][iconitem title="icon title" icon="icon-heart"][/iconitem][iconitem title="another icon title" icon="icon-star"][/iconitem][/iconlist]'
            ),
            array(
                'shortcode'   => 'icon',
                'title'       => __('Icon', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'    => array(
                    array(
                        'title'   => 'General',
                        'fields'  => array(
                            array(
                                'name'    => __('Font Size', THEME_ADMIN_TD),
                                'desc'    => __('Size of font to use for icon ( set to 0 to inhertit font size from container )', THEME_ADMIN_TD),
                                'id'      => 'size',
                                'type'    => 'slider',
                                'default' => 0,
                                'attr'    => array(
                                    'max'  => 48,
                                    'min'  => 0,
                                    'step' => 1
                                )
                            ),
                        )
                    ),
                    array(
                        'title'   => 'Icon',
                        'fields'  => array(
                            array(
                                'name'    => __('Icon', THEME_ADMIN_TD),
                                'desc'    => __('Type of button to display', THEME_ADMIN_TD),
                                'id'      => 'content',
                                'type'    => 'icons',
                                'default' => 'icon-glass'
                            )
                        ),
                    ),
                ),
            ),
        )
    ),

    /* SECTIONS SHORTCODES*/
    array(
        'title' => __('Sections', THEME_ADMIN_TD),
        'members' => array(
            array(
                'shortcode'     => 'section',
                'title'         => __('Simple Section', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                     include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                )
            ),
            array(
                'shortcode'     => 'services',
                'title'         => __('Services', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Services', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Choose a category', THEME_ADMIN_TD),
                                'desc'    => __('Category of services to show', THEME_ADMIN_TD),
                                'id'      => 'category',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'taxonomy',
                                'taxonomy' => 'oxy_service_category',
                                'blank_label' => __('All Categories', THEME_ADMIN_TD)
                            ),
                            array(
                                'name'    => __('Services Count', THEME_ADMIN_TD),
                                'desc'    => __('Number of services to show. Set 0 for all.', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'  => 100,
                                    'min'  => 0,
                                    'step' => 1
                                )
                            ),
                            array(
                                'name'    => __('Columns', THEME_ADMIN_TD),
                                'desc'    => __('Number columns to show the services in', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'options' => array(
                                    3 => __('Three columns', THEME_ADMIN_TD),
                                    4 => __('Four columns', THEME_ADMIN_TD),
                                ),
                                'default' => 3,
                            ),
                             array(
                                'name'      => __('Show Links', THEME_ADMIN_TD),
                                'id'        => 'links',
                                'type'      => 'radio',
                                'default'   =>  'show',
                                'options' => array(
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    ),
                            ),
                            array(
                                'name'    => __('Services style', THEME_ADMIN_TD),
                                'desc'    => __('Choose between round and squared for the service items style', THEME_ADMIN_TD),
                                'id'      => 'image_style',
                                'type'    => 'radio',
                                'default' => '',
                                'options' => array(
                                    ''    => __('Circles', THEME_ADMIN_TD),
                                    'no-rounded' => __('Squares', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'      => __('Lead Text', THEME_ADMIN_TD),
                                'id'        => 'lead',
                                'type'      => 'radio',
                                'default'   =>  'hide',
                                'options' => array(
                                    'show' => __('Show', THEME_ADMIN_TD),
                                    'hide' => __('Hide', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Service title size', THEME_ADMIN_TD),
                                'desc'    => __('set the size of the service title', THEME_ADMIN_TD),
                                'id'      => 'title_size',
                                'type'    => 'radio',
                                'options' => array(
                                    'big'    => __('Big', THEME_ADMIN_TD),
                                    'medium' => __('Medium', THEME_ADMIN_TD),
                                    'small'  => __('Small', THEME_ADMIN_TD),
                                ),
                                'default' => 'medium',
                            ),
                        )
                    ),
                   include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                )
            ),

            // TESTIMONIALS SHORTCODE SECTION
            array(
                'shortcode' => 'testimonials',
                'title'     => __('Testimonials', THEME_ADMIN_TD),
                'insert_with' => 'dialog',
                'sections'   => array(
                    array(
                        'title' => __('Testimonials', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Choose a group', THEME_ADMIN_TD),
                                'desc'    => __('Group of testimonials to show', THEME_ADMIN_TD),
                                'id'      => 'group',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'taxonomy',
                                'taxonomy' => 'oxy_testimonial_group',
                                'blank_label' => __('All Testimonials', THEME_ADMIN_TD)
                            ),
                            array(
                                'name'    => __('Number Of Testimonials', THEME_ADMIN_TD),
                                'desc'    => __('Number of Testimonials to display', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 10,
                                    'min'   => 1,
                                    'step'  => 1
                                )
                            ),
                            array(
                                'name'    => __('Choose layout', THEME_ADMIN_TD),
                                'id'      => 'layout',
                                'type'    => 'radio',
                                'default' => 'big',
                                'options' => array(
                                    'big'    => __('Big', THEME_ADMIN_TD),
                                    'small'  => __('Small', THEME_ADMIN_TD),
                                ),
                                'desc'      => __('Testimonials layout', THEME_ADMIN_TD),
                            ),
                            array(
                                'name'    => __('Small testimonial span', THEME_ADMIN_TD),
                                'desc'    => __('Span of a testimonial in the small layout', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'default' => 3,
                                'options' => array(
                                        3 => __('3 Columns', THEME_ADMIN_TD),
                                        4 => __('4 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                    include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                )
            ),
            /* Staff Shortcodes */
            array(
                'title' => __('Staff', THEME_ADMIN_TD),
                'members' => array(
                    array(
                        'shortcode'     => 'staff_featured',
                        'title'         => __('Featured staff member', THEME_ADMIN_TD),
                        'insert_with'   => 'dialog',
                        'sections'      => array(
                            array(
                                'title' => __('Staff', THEME_ADMIN_TD),
                                'fields' => array(
                                    array(
                                        'name'    => __('Featured member', THEME_ADMIN_TD),
                                        'desc'    => __('select the staff member that will be featured', THEME_ADMIN_TD),
                                        'id'      => 'member',
                                        'default' =>  '',
                                        'type'    => 'select',
                                        'options' => 'staff_featured',
                                    ),
                                )
                            ),
                            include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                        )
                    ),
                    array(
                        'shortcode'     => 'staff_list',
                        'title'         => __('Staff members list', THEME_ADMIN_TD),
                        'insert_with'   => 'dialog',
                        'sections'      => array(
                            array(
                                'title' => __('Staff members list', THEME_ADMIN_TD),
                                'fields' => array(
                                    array(
                                        'name'    => __('Choose a department', THEME_ADMIN_TD),
                                        'desc'    => __('Populate your list from a department', THEME_ADMIN_TD),
                                        'id'      => 'department',
                                        'default' =>  '',
                                        'type'    => 'select',
                                        'options' => 'taxonomy',
                                        'taxonomy' => 'oxy_staff_department',
                                        'blank_label' => __('Select a department', THEME_ADMIN_TD)
                                    ),
                                    array(
                                        'name'    => __('Number Of members', THEME_ADMIN_TD),
                                        'desc'    => __('Number of members to display. Set 0 for all.', THEME_ADMIN_TD),
                                        'id'      => 'count',
                                        'type'    => 'slider',
                                        'default' => 3,
                                        'attr'    => array(
                                            'max'  => 100,
                                            'min'  => 0,
                                            'step' => 1
                                        )
                                    ),
                                    array(
                                        'name'    => __('List Columns', THEME_ADMIN_TD),
                                        'desc'    => __('Number of columns to show staff in', THEME_ADMIN_TD),
                                        'id'      => 'columns',
                                        'type'    => 'radio',
                                        'default' => '3',
                                        'options' => array(
                                            '3' => __('3 Columns', THEME_ADMIN_TD),
                                            '4' => __('4 Columns', THEME_ADMIN_TD),
                                        ),
                                    ),
                                    array(
                                        'name'    => __('Open Link In', THEME_ADMIN_TD),
                                        'id'      => 'link_target',
                                        'type'    => 'select',
                                        'default' => '_self',
                                        'options' => array(
                                            '_self'   => __('Same page as it was clicked ', THEME_ADMIN_TD),
                                            '_blank'  => __('Open in new window/tab', THEME_ADMIN_TD),
                                            '_parent' => __('Open the linked document in the parent frameset', THEME_ADMIN_TD),
                                            '_top'    => __('Open the linked document in the full body of the window', THEME_ADMIN_TD)
                                        ),
                                        'desc'    => __('Where the social links open to', THEME_ADMIN_TD),
                                    ),
                                )
                            ),
                            include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                        )
                    )
                )
            ),
            /* Recent Posts */
            array(
                'shortcode'     => 'recent_posts',
                'title'         => __('Recent Posts', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Recent Posts', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Number of posts', THEME_ADMIN_TD),
                                'desc'    => __('Number of posts to display', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 10,
                                    'min'   => 1,
                                    'step'  => 1
                                )
                            ),
                             array(
                                'name'    => __('Post category', THEME_ADMIN_TD),
                                'desc'    => __('Choose posts from a specific category', THEME_ADMIN_TD),
                                'id'      => 'cat',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'categories',
                            ),
                            array(
                                'name'    => __('Columns', THEME_ADMIN_TD),
                                'desc'    => __('Number of columns to show posts in', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'select',
                                'default' => '3',
                                'options' => array(
                                    '1' => __('1 Column', THEME_ADMIN_TD),
                                    '2' => __('2 Columns', THEME_ADMIN_TD),
                                    '3' => __('3 Columns', THEME_ADMIN_TD),
                                    '4' => __('4 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                    include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                )
            ),
            array(
                'shortcode'     => 'portfolio',
                'title'         => __('Portfolio', THEME_ADMIN_TD),
                'insert_with'   => 'dialog',
                'sections'      => array(
                    array(
                        'title' => __('Portfolio', THEME_ADMIN_TD),
                        'fields' => array(
                            array(
                                'name'    => __('Portfolios', THEME_ADMIN_TD),
                                'desc'    => __('Portfolios to show (leave blank to show all)', THEME_ADMIN_TD),
                                'id'      => 'portfolio',
                                'default' =>  '',
                                'type'    => 'select',
                                'options' => 'taxonomy',
                                'taxonomy' => 'oxy_portfolio_categories',
                                'attr' => array(
                                    'multiple' => '',
                                    'style' => 'height:100px'
                                )
                            ),
                            array(
                                'name'    => __('Portfolio style', THEME_ADMIN_TD),
                                'desc'    => __('Choose between round and squared for the porfolio items style', THEME_ADMIN_TD),
                                'id'      => 'img_style',
                                'type'    => 'radio',
                                'default' => '',
                                'options' => array(
                                    ''           => __('Round', THEME_ADMIN_TD),
                                    'no-rounded' => __('Square', THEME_ADMIN_TD),
                                ),
                            ),
                            array(
                                'name'    => __('Number of portfolio items', THEME_ADMIN_TD),
                                'desc'    => __('Number of portfolio items to display, set to 0 for all.', THEME_ADMIN_TD),
                                'id'      => 'count',
                                'type'    => 'slider',
                                'default' => 3,
                                'attr'    => array(
                                    'max'   => 100,
                                    'min'   => 0,
                                    'step'  => 1
                                )
                            ),
                            array(
                                'name'    => __('Portfolio item span', THEME_ADMIN_TD),
                                'desc'    => __('Span of a portfolio item in the layout', THEME_ADMIN_TD),
                                'id'      => 'columns',
                                'type'    => 'radio',
                                'default' =>  3,
                                'options' => array(
                                    4  => __('4 Columns', THEME_ADMIN_TD),
                                    3  => __('3 Columns', THEME_ADMIN_TD),
                                ),
                            ),
                        )
                    ),
                    include INCLUDES_DIR .'options/shortcodes/shortcode-section-options.php'
                )
            ),
        )
    ),
);
