<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}
$template_directory = get_template_directory_uri();

if( fw_ext( 'page-builder' ) )
{
    $button = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'button' );
    $button = $button->get_options();
}
else
    $button = '';

$options = array(
    'general' => array(
        'title'   => __( 'General', 'fw' ),
        'type'    => 'tab',
        'options' => array(

            'general-box' => array(
                'title'   => __( 'General Settings', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'logo' => array(
                        'label' => __( 'Logo', 'fw' ),
                        'desc'  => __( 'Upload logo image', 'fw' ),
                        'type'  => 'upload'
                    ),

                    'favicon' => array(
                        'label' => __( 'Favicon', 'fw' ),
                        'desc'  => __( 'Upload favicon image', 'fw' ),
                        'type'  => 'upload',
                        'images_only' => false
                    )
                )
            ),

        )
    ),

    'header' => array(
        'title'   => __( 'Header', 'fw' ),
        'type'    => 'tab',
        'options' => array(

            'topbar-box' => array(
                'title'   => __( 'Topbar Settings', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'topbar' => array(
                        'type'  => 'multi-picker',
                        'label' => false,
                        'desc'  => false,
                        'picker' => array(
                            'enable-topbar' => array(
                                'type'  => 'switch',
                                'value' => 'yes',
                                'label' => __('Enable Topbar', 'fw'),
                                'desc'  => __('Enable theme topbar', 'fw'),
                                'left-choice' => array(
                                    'value' => 'no',
                                    'label' => __('No', 'fw'),
                                ),
                                'right-choice' => array(
                                    'value' => 'yes',
                                    'label' => __('Yes', 'fw'),
                                ),
                            )
                        ),
                        'choices' => array(
                            'yes' => array(
                                'phone' => array(
                                    'type'  => 'text',
                                    'value' => '',
                                    'label' => __('Phone', 'fw'),
                                    'desc'  => __('Add phone number', 'fw'),
                                ),
                                'email' => array(
                                    'type'  => 'text',
                                    'value' => '',
                                    'label' => __('Email', 'fw'),
                                    'desc'  => __('Add email', 'fw'),
                                ),
                                'header-socials' => array(
                                    'type'  => 'addable-box',
                                    'value' => array(),
                                    'label' => __('Socials', 'fw'),
                                    'desc'  => __('Add socials', 'fw'),
                                    'template' => '{{=name}}',
                                    'box-options' => array(
                                        'name' => array( 'label' => __('Name','fw'),'desc'  => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'fw' ), 'type' => 'text'),
                                        'icon' => array( 'label' => __('Choose Icon','fw'), 'type' => 'icon', 'value' => 'fa fa-facebook'),
                                        'url' => array( 'label' => __('Link', 'fw'), 'type' => 'text', 'desc' => __('Enter social link','fw') ),
                                    ),
                                )
                            )
                        )
                    ),


                )
            ),

            'menubar-box' => array(
                'title'   => __( 'Menu Bar Settings', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'menubar' => array(
                        'type'  => 'multi-picker',
                        'label' => false,
                        'desc'  => false,
                        'picker' => array(
                            'enable-menubar' => array(
                                'type'  => 'switch',
                                'value' => 'search',
                                'label' => __('Menu Bar', 'fw'),
                                'desc'  => __('Choose what to display in menu bar', 'fw'),
                                'left-choice' => array(
                                    'value' => 'socials',
                                    'label' => __('Socials', 'fw'),
                                ),
                                'right-choice' => array(
                                    'value' => 'search',
                                    'label' => __('Search', 'fw'),
                                ),
                            )
                        ),
                        'choices' => array(
                            'socials' => array(
                                'header-socials' => array(
                                    'type'  => 'addable-box',
                                    'value' => array(),
                                    'label' => __('Socials', 'fw'),
                                    'desc'  => __('Add socials', 'fw'),
                                    'template' => '{{=name}}',
                                    'box-options' => array(
                                        'name' => array( 'label' => __('Name','fw'),'desc'  => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'fw' ), 'type' => 'text'),
                                        'icon' => array( 'label' => __('Choose Icon','fw'), 'type' => 'icon', 'value' => 'fa fa-facebook'),
                                        'url' => array( 'label' => __('Link', 'fw'), 'type' => 'text', 'desc' => __('Enter social link','fw') ),
                                    ),
                                )
                            )
                        )
                    ),


                )
            ),
        )
    ),

    'settings' => array(
        'title'   => __( 'Posts Settings', 'fw' ),
        'type'    => 'tab',
        'options' => array(

            'blog' => array(
                'title'   => __( 'Blog', 'fw' ),
                'type'    => 'tab',
                'options' => array(
                    'blog_settings' => array(
                        'title'   => __( 'Blog Categories Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(

                            'blog_view'  => array(
                                'label'   => __( 'Blog View', 'fw' ),
                                'desc'    => __( 'Select the blog view', 'fw' ),
                                'type'  => 'select',
                                'value' => '',
                                'choices' => array(
                                    'normal' => __('Normal','fw'),
                                    'medium' => __('Medium','fw')
                                ),
                            ),

                            'blog_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-blog-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable blog inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'blog-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for categories. You can rewrite it in each', 'fw' ) . ' <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=category">category</a> ' .__( 'individually', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-blog-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable blog breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'blog_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-blog-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable blog categories call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),
                )
            ),

            'posts' => array(
                'title'   => __( 'Posts', 'fw' ),
                'type'    => 'tab',
                'options' => array(
                    'post_settings' => array(
                        'title'   => __( 'Blog Posts Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(

                            'post_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-post-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable blog posts inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'post-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for blog posts.  You can rewrite it in each', 'fw' ) . ' <a target="_new" href="' . get_admin_url() . 'edit.php">post</a> ' .__( 'individually', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-post-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable blog posts breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'post_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-post-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable blog posts call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),
                )
            ),

            'portfolio' => array(
                'title'   => __( 'Portfolio Categories', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    'portfolio-box' => array(
                        'title'   => __( 'Portfolio Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'portf_view'  => array(
                                'label'   => __( 'Portfolio View', 'fw' ),
                                'desc'    => __( 'Select the portfolio categories view', 'fw' ),
                                'type'  => 'select',
                                'value' => '',
                                'choices' => array(
                                    'view1' => __('Default','fw'),
                                    'view2' => __('Alternative', 'fw')
                                ),
                            ),

                            'portf_columns'  => array(
                                'type'  => 'select',
                                'value' => '',
                                'label' => __('Columns', 'fw'),
                                'desc'  => __('Select portfolio categories columns', 'fw'),
                                'choices' => array(
                                    '2' => __('2 Columns', 'fw'),
                                    '3' => __('3 Columns', 'fw'),
                                    '4' => __('4 Columns', 'fw')
                                ),
                            ),

                            'portf_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-portf-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable portfolio categories inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'portf-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for portfolio categories. You can rewrite it in each', 'fw' ) . ' <a target="_new" href="' . get_admin_url() . 'edit-tags.php?taxonomy=fw-portfolio-category">portfolio category</a> ' .__( 'individually', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-portf-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable portfolio categories breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'portf_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-portf-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable portfolio categories call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),


                )
            ),

            'portf_posts' => array(
                'title'   => __( 'Portfolio Posts', 'fw' ),
                'type'    => 'tab',
                'options' => array(
                    'portf_post_settings' => array(
                        'title'   => __( 'Portfolio Posts Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(

                            'portf_post_view'  => array(
                                'type'  => 'select',
                                'value' => '',
                                'label' => __('View Type', 'fw'),
                                'desc'  => __('Select portfolio posts view type', 'fw'),
                                'choices' => array(
                                    'half' => __('Project Half', 'fw'),
                                    'wide' => __('Project Wide', 'fw')
                                ),
                            ),

                            'portf_post_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-portf_post-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable portfolio posts inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'portf_post-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for portfolio posts. You can rewrite it in each', 'fw' ) . ' <a target="_new" href="' . get_admin_url() . 'edit.php?post_type=fw-portfolio">portfolio post</a> ' .__( 'individually', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-portf_post-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable portfolio posts breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'portf_post_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-portf_post-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable portfolio posts call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            ),

                            'enable-portf_post-projects' => array(
                                'type'  => 'switch',
                                'value' => 'yes',
                                'label' => __('Enable Related Projects', 'fw'),
                                'desc'  => __('Enable portfolio posts related projects.', 'fw'),
                                'left-choice' => array(
                                    'value' => 'no',
                                    'label' => __('No', 'fw'),
                                ),
                                'right-choice' => array(
                                    'value' => 'yes',
                                    'label' => __('Yes', 'fw'),
                                ),
                            ),
                        )
                    ),
                )
            ),

            'members' => array(
                'title'   => __( 'Members Categories', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    'portfolio-box' => array(
                        'title'   => __( 'Members Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'members_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-members-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable members categories inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'members-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for members categories.', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-members-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable members categories breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'members_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-members-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable members categories call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),


                )
            ),

            'member' => array(
                'title'   => __( 'Member Posts', 'fw' ),
                'type'    => 'tab',
                'options' => array(
                    'portf_post_settings' => array(
                        'title'   => __( 'Member Posts Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'member_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-member-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable member posts inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'member_post-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for member posts.', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-member-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable member posts breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'member_post_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-member-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable member posts call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            ),
                        )
                    ),
                )
            ),

        )
    ),

    'page-settings' => array(
        'title'   => __( 'Pages Settings', 'fw' ),
        'type'    => 'tab',
        'options' => array(

            'homepage' => array(
                'title'   => __( 'Home Page', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    'home_settings' => array(
                        'title'   => __( 'HomePage Settings for Your latest posts', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'home_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-home-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable homepage inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'home-subtitle' => array(
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Add title for homepage', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-home-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable homepage breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'home_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-home-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable homepage call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),

                )
            ),

            'blogpage' => array(
                'title'   => __( 'Posts Page', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    'blogpage_settings' => array(
                        'title'   => __( 'Posts Page Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'blogpage_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-blogpage-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable posts page inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'blogpage-subtitle' => array(
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Add title for posts page', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-blogpage-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable posts page breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'blogpage_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-blogpage-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable posts page call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),

                )
            ),

            'search-settings' => array(
                'title'   => __( 'Search Page', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    'search-box' => array(
                        'title'   => __( 'Search Page Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            'search_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-search-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable search page inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'search-title' => array(
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Type title for search page', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'search-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for search page', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-search-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable search page breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            'search_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-search-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable search page call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    ),

                )
            ),

            '404-settings' => array(
                'title'   => __( '404 Page', 'fw' ),
                'type'    => 'tab',
                'options' => array(

                    '404-box' => array(
                        'title'   => __( '404 Page Settings', 'fw' ),
                        'type'    => 'box',
                        'options' => array(
                            '404_banner' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-404-banner' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Inner Banner', 'fw'),
                                        'desc'  => __('Enable 404 page inner banner', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        '404-title' => array(
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Type title for 404 page', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        '404-subtitle' => array(
                                            'label' => __( 'Subtitle', 'fw' ),
                                            'desc'  => __( 'Type subtitle for 404 page', 'fw' ),
                                            'type'  => 'text'
                                        ),

                                        'enable-404-breadcrumbs' => array(
                                            'type'  => 'switch',
                                            'value' => 'yes',
                                            'label' => __('Enable Breadcrumbs', 'fw'),
                                            'desc'  => __('Enable 404 page breadcrumbs.', 'fw'),
                                            'left-choice' => array(
                                                'value' => 'no',
                                                'label' => __('No', 'fw'),
                                            ),
                                            'right-choice' => array(
                                                'value' => 'yes',
                                                'label' => __('Yes', 'fw'),
                                            ),
                                        ),
                                    )
                                )
                            ),

                            '404_action' => array(
                                'type'  => 'multi-picker',
                                'label' => false,
                                'desc'  => false,
                                'picker' => array(
                                    'enable-404-action' => array(
                                        'type'  => 'switch',
                                        'value' => 'yes',
                                        'label' => __('Enable Call To Action', 'fw'),
                                        'desc'  => __('Enable 404 page call to action.', 'fw'),
                                        'left-choice' => array(
                                            'value' => 'no',
                                            'label' => __('No', 'fw'),
                                        ),
                                        'right-choice' => array(
                                            'value' => 'yes',
                                            'label' => __('Yes', 'fw'),
                                        ),
                                    )
                                ),
                                'choices' => array(
                                    'yes' => array(
                                        'call_type' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'message_type'  => array(
                                                    'type'  => 'select',
                                                    'value' => '',
                                                    'label' => __('Type', 'fw'),
                                                    'desc'  => __('Select call to action type', 'fw'),
                                                    'choices' => array(
                                                        'cta-default' => __('Type 1', 'fw'),
                                                        'cta-v4' => __('Type 2', 'fw'),
                                                        'cta-v3' => __('Type 3', 'fw'),
                                                        'cta-v2' => __('Type 4', 'fw'),
                                                        'custom' => __('Custom Type', 'fw'),
                                                    ),
                                                ),
                                            ),
                                            'choices' => array(
                                                'custom' => array(
                                                    'bg_color' => array(
                                                        'type'  => 'rgba-color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Bg Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action bg color', 'fw' ),
                                                    ),
                                                    'text_color' => array(
                                                        'type'  => 'color-picker',
                                                        'value' => '',
                                                        'label' => __( 'Text Color', 'fw' ),
                                                        'desc'  => __( 'Choose call to action text color', 'fw' ),
                                                    ),
                                                )
                                            )
                                        ),

                                        'text' => array(
                                            'type'   => 'text',
                                            'label' => __( 'Title', 'fw' ),
                                            'desc'  => __( 'Call to action short title', 'fw' ),
                                            'value' => ''
                                        ),

                                        'button' => array(
                                            'type'  => 'multi-picker',
                                            'label' => false,
                                            'desc'  => false,
                                            'picker' => array(
                                                'enable-btn' => array(
                                                    'type'  => 'switch',
                                                    'value' => 'no',
                                                    'label' => __('Button', 'fw'),
                                                    'desc'  => __('Enable title button', 'fw'),
                                                    'left-choice' => array(
                                                        'value' => 'no',
                                                        'label' => __('No', 'fw'),
                                                    ),
                                                    'right-choice' => array(
                                                        'value' => 'yes',
                                                        'label' => __('Yes', 'fw'),
                                                    ),
                                                )
                                            ),
                                            'choices' => array(
                                                'yes' => array(
                                                    'btn_link_group' => array(
                                                        'type'    => 'group',
                                                        'options' => array(
                                                            $button
                                                        )
                                                    )
                                                )
                                            )
                                        ),
                                        'class'          => array(
                                            'type'  => 'text',
                                            'label' => __( 'Custom Class', 'fw' ),
                                            'desc'  => __( 'Enter a custom CSS class', 'fw' ),
                                            'help'  => __( 'You can use this class to further style it by adding your custom CSS', 'fw' ),
                                        ),
                                    )
                                )
                            )
                        )
                    )

                )
            )

        )
    ),

    'footer' => array(
        'title'   => __( 'Footer', 'fw' ),
        'type'    => 'tab',
        'options' => array(
            'footer-widgets' => array(
                'title'   => __( 'Footer Widgets', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'enable-footer-widgets' => array(
                        'type'  => 'switch',
                        'value' => 'yes',
                        'label' => __('Enable Widgets', 'fw'),
                        'desc'  => __('Enable footer widgets', 'fw'),
                        'left-choice' => array(
                            'value' => 'no',
                            'label' => __('No', 'fw'),
                        ),
                        'right-choice' => array(
                            'value' => 'yes',
                            'label' => __('Yes', 'fw'),
                        ),
                    ),
                )
            ),
            'copyright' => array(
                'title'   => __( 'Footer Copyright', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'copyright' => array(
                        'label' => __( 'Copyright', 'fw' ),
                        'desc'  => __( 'Footer Copyright', 'fw' ),
                        'type'  => 'text',
                        'value' => ''
                    )
                )
            ),
            'socials-box' => array(
                'title'   => __( 'Footer Socials', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'footer-socials' => array(
                        'type'  => 'addable-box',
                        'value' => array(),
                        'label' => __('Socials', 'fw'),
                        'desc'  => __('Add socials', 'fw'),
                        'template' => '{{=name}}',
                        'box-options' => array(
                            'name' => array( 'label' => __('Name','fw'),'desc'  => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'fw' ), 'type' => 'text'),
                            'icon' => array( 'label' => __('Choose Icon','fw'), 'type' => 'icon'),
                            'url' => array( 'label' => __('Link', 'fw'), 'type' => 'text', 'desc' => __('Enter social link','fw') ),
                        ),
                    )
                )
            )
        )
    ),

    'styling-options' => array(
        'title'   => __( 'Styling', 'fw' ),
        'type'    => 'tab',
        'options' => array(

            'styling-box' => array(
                'title'   => __( 'Styling Options', 'fw' ),
                'type'    => 'box',
                'options' => array(
                    'layout' => array(
                        'type'    => 'multi-picker',
                        'label'   => false,
                        'desc'    => false,
                        'picker'  => array(
                            'layout-type' => array(
                                'type'  => 'switch',
                                'value' => 'wide',
                                'label' => __('Layout Style', 'fw'),
                                'desc'  => __('Choose theme layout style', 'fw'),
                                'left-choice' => array(
                                    'value' => 'wide',
                                    'label' => __('Wide', 'fw'),
                                ),
                                'right-choice' => array(
                                    'value' => 'boxed',
                                    'label' => __('Boxed', 'fw'),
                                ),
                            )
                        ),
                        'choices' => array(
                            'boxed' => array(
                                'bg-type-bg' => array(
                                    'type'    => 'multi-picker',
                                    'label'   => false,
                                    'desc'    => false,
                                    'picker'  => array(
                                        'bg_type'  => array(
                                            'label'   => __( '', 'fw' ),
                                            'desc'    => __( 'Select background type', 'fw' ),
                                            'type'  => 'select',
                                            'value' => '',
                                            'choices' => array(
                                                'predefined' => __('Predefined','fw'),
                                                'custom' => __('Custom','fw')
                                            ),
                                        ),
                                    ),
                                    'choices' => array(
                                        'predefined' => array(
                                            'bg' => array(
                                                'label'   => __( '', 'fw' ),
                                                'type'    => 'image-picker',
                                                'value'   => '',
                                                'desc'    => __( 'Choose theme background pattern', 'fw' ),
                                                'choices' => array(
                                                    'china' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/china.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/china.png'
                                                        ),
                                                    ),
                                                    'concrete' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/concrete.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/concrete.png'
                                                        ),
                                                    ),
                                                    'eight' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/eight.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/eight.png'
                                                        ),
                                                    ),
                                                    'green_cup' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/green_cup.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/green_cup.png'
                                                        ),
                                                    ),
                                                    'lodyas' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/lodyas.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/lodyas.png'
                                                        ),
                                                    ),
                                                    'stardust' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/stardust.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/stardust.png'
                                                        ),
                                                    ),
                                                    'struckaxiom' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/struckaxiom.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/struckaxiom.png'
                                                        ),
                                                    ),
                                                    'stwirl' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/swirl.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/swirl.png'
                                                        ),
                                                    ),
                                                    'wood' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/wood.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/wood.png'
                                                        ),
                                                    ),
                                                    'wood-dark' => array(
                                                        'small' => array(
                                                            'height' => 50,
                                                            'src'    => $template_directory . '/images/patterns/wood-dark.png',
                                                        ),
                                                        'large' => array(
                                                            'height' => 150,
                                                            'src'    => $template_directory . '/images/patterns/wood-dark.png'
                                                        ),
                                                    ),
                                                ),
                                                'blank' => true,
                                            ),
                                        ),
                                        'custom' => array(
                                            'custom_bg' => array(
                                                'label' => __( '', 'fw' ),
                                                'desc'  => __( 'Upload custom background image', 'fw' ),
                                                'type'  => 'upload'
                                            ),
                                        )
                                    )
                                ),

                                'bg-color' => array(
                                    'label' => __( 'Background Color', 'fw' ),
                                    'desc'  => __( 'Choose theme background color', 'fw' ),
                                    'type'  => 'color-picker'
                                ),
                            )
                        )
                    ),

                    'skin' => array(
                        'type'  => 'switch',
                        'value' => 'wide',
                        'label' => __('Skin Color', 'fw'),
                        'desc'  => __('Choose theme skin color', 'fw'),
                        'left-choice' => array(
                            'value' => 'light',
                            'label' => __('Light', 'fw'),
                        ),
                        'right-choice' => array(
                            'value' => 'dark',
                            'label' => __('Dark', 'fw'),
                        ),
                    ),

                    'color-scheme' => array(
                        'type'    => 'multi-picker',
                        'label'   => false,
                        'desc'    => false,
                        'picker'  => array(
                            'scheme'  => array(
                                'label'   => __( 'Color Scheme', 'fw' ),
                                'desc'    => __( 'Select theme color scheme', 'fw' ),
                                'type'  => 'select',
                                'value' => '',
                                'choices' => array(
                                    'blue' => __('Blue','fw'),
                                    'royal' => __('Royal','fw'),
                                    'salmon' => __('Salmon','fw'),
                                    'red' => __('Red','fw'),
                                    'green' => __('Green','fw'),
                                    'turquoise' => __('Turquoise','fw'),
                                    'violet' => __('Violet','fw'),
                                    'yellow' => __('Yellow','fw'),
                                    'olive' => __('Olive','fw'),
                                    'gray' => __('Gray','fw'),
                                    'custom' => __('Custom','fw')
                                ),
                            ),
                        ),
                        'choices' => array(
                            'custom' => array(
                                'styling' => array(
                                    'label' => __( '', 'fw' ),
                                    'desc'  => __( 'Choose theme custom color scheme', 'fw' ),
                                    'type'  => 'color-picker'
                                ),
                            )
                        )
                    ),

                )
            ),
        )
    ),

);