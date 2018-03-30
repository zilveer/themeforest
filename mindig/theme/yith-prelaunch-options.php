<?php
/**
 * Main admin class
 *
 * @author  Your Inspiration Themes
 * @package YITH Pre-Launch
 * @version 1.0.2
 */

if ( ! defined( 'YITH_PRELAUNCH' ) ) {
    exit;
} // Exit if accessed directly

global $yith_prelaunch_options;
$yith_prelaunch_options = array(
    //tab general
    'general'    => array(
        'label'    => __( 'General', 'yit' ),
        'sections' => array(
            'general'    => array(
                'title'       => __( 'General Settings', 'yit' ),
                'description' => '',
                'fields'      => array(
                    'yith_prelaunch_enable'       => array(
                        'title'       => __( 'Enable Pre-Launch', 'yit' ),
                        'description' => __( 'Enable the splash page to lets users to know the blog is down for prelaunch. (Default: Off) ', 'yit' ),
                        'type'        => 'checkbox',
                        'std'         => false
                    ),

                    'yith_prelaunch_roles'        => array(
                        'title'       => __( 'Roles', 'yit' ),
                        'description' => __( 'The user roles enabled to see the frontend. Check a role to enable it to show the website with prelaunch mode active.', 'yit' ),
                        'type'        => 'checkboxes',
                        'options'     => yit_wp_roles(),
                        'std'         => array( 'administrator' )
                    ),

                    'yith_prelaunch_message'      => array(
                        'title'       => __( 'Message', 'yit' ),
                        'description' => __( 'The message displayed. You can also use HTML code.', 'yit' ),
                        'type'        => 'textarea',
                        'std'         => '<p>' . __( "Hi all! We are a fresh & clean shop and you will love us, but currently our site is under construction.", 'yit' ) . '</p>'
                    ),

                    'yith_prelaunch_custom_style' => array(
                        'title'       => 'Custom style',
                        'description' => __( 'Insert here your custom CSS style.', 'yit' ),
                        'type'        => 'textarea',
                        'std'         => ''
                    ),
                )
            ),
            'typography' => array(
                'title'       => __( 'Typography', 'yit' ),
                'description' => '',
                'fields'      => array(
                    'yith_prelaunch_title_font'     => array(
                        'title'       => __( 'Title font of message', 'yit' ),
                        'description' => __( 'Choose the font type, size and color for the titles inside the message text.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 36,
                            'unit'   => 'px',
                            'family' => 'Oswald',
                            'style'  => 'bold',
                            'color'  => '#ffffff',
                        ),
                    ),
                    'yith_prelaunch_paragraph_font' => array(
                        'title'       => __( 'Paragraph font of message', 'yit' ),
                        'description' => __( 'Choose the font type, size and color for the paragraphs inside the message text.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 30,
                            'unit'   => 'px',
                            'family' => 'Source Sans Pro',
                            'style'  => 'regular',
                            'color'  => '#ffffff',
                        ),
                    )
                )
            ),
        )
    ),

    //tab background
    'background' => array(
        'label'    => __( 'Background', 'yit' ),
        'sections' => array(
            'background' => array(
                'title'       => __( 'Background Settings', 'yit' ),
                'description' => __( 'Customize the background of the page', 'yit' ),
                'fields'      => array(
                    'yith_prelaunch_background_image'      => array(
                        'title'       => __( 'Background image', 'yit' ),
                        'description' => __( 'Upload or choose from your media library the background image', 'yit' ),
                        'type'        => 'upload',
                        'std'         => get_template_directory_uri() . '/theme/assets/images/backgrounds/prelaunch.jpg',
                    ),
                    'yith_prelaunch_background_color'      => array(
                        'title'       => __( 'Background Color', 'yit' ),
                        'description' => __( 'Choose a background color', 'yit' ),
                        'type'        => 'colorpicker',
                        'std'         => '#0c0c08',
                    ),
                    'yith_prelaunch_background_repeat'     => array(
                        'title'       => __( 'Background Repeat', 'yit' ),
                        'description' => __( 'Select the repeat mode for the background image.', 'yit' ),
                        'type'        => 'select',
                        'std'         => apply_filters( 'yith_prelaunch_background_repeat_std', 'no-repeat' ),
                        'options'     => array(
                            'repeat'    => __( 'Repeat', 'yit' ),
                            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
                            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
                            'no-repeat' => __( 'No Repeat', 'yit' ),
                        )
                    ),
                    'yith_prelaunch_background_position'   => array(
                        'title'       => __( 'Background Position', 'yit' ),
                        'description' => __( 'Select the position for the background image.', 'yit' ),
                        'type'        => 'select',
                        'options'     => array(
                            'center'        => __( 'Center', 'yit' ),
                            'top left'      => __( 'Top left', 'yit' ),
                            'top center'    => __( 'Top center', 'yit' ),
                            'top right'     => __( 'Top right', 'yit' ),
                            'bottom left'   => __( 'Bottom left', 'yit' ),
                            'bottom center' => __( 'Bottom center', 'yit' ),
                            'bottom right'  => __( 'Bottom right', 'yit' ),
                        ),
                        'std'         => apply_filters( 'yith_prelaunch_background_position_std', 'top left' )
                    ),
                    'yith_prelaunch_background_attachment' => array(
                        'title'       => __( 'Background Attachment', 'yit' ),
                        'description' => __( 'Select the attachment for the background image.', 'yit' ),
                        'type'        => 'select',
                        'options'     => array(
                            'scroll' => __( 'Scroll', 'yit' ),
                            'fixed'  => __( 'Fixed', 'yit' ),
                        ),
                        'std'         => apply_filters( 'yith_prelaunch_background_attachment_std', 'fixed' )
                    )
                )
            )
        )
    ),

    //tab logo
    'logo'       => array(
        'label'    => __( 'Logo', 'yit' ),
        'sections' => array(
            'logo' => array(
                'title'       => __( 'Logo Settings', 'yit' ),
                'description' => __( 'Customize the logo', 'yit' ),
                'fields'      => array(
                    'yith_prelaunch_logo_image'        => array(
                        'title'       => __( 'Logo image', 'yit' ),
                        'description' => __( 'Upload or choose from your media library the logo image', 'yit' ),
                        'type'        => 'upload',
                        'std'         => get_template_directory_uri() . '/theme/assets/images/logo_white.png',
                    ),
                    'yith_prelaunch_logo_tagline'      => array(
                        'title'       => __( 'Logo tagline', 'yit' ),
                        'description' => __( 'Set the tagline to show below the logo image', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_logo_tagline_font' => array(
                        'title'       => __( 'Logo tagline font', 'yit' ),
                        'description' => __( 'Choose the font type, size and color for the tagline text.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 15,
                            'unit'   => 'px',
                            'family' => 'Oswald',
                            'style'  => 'regular',
                            'color'  => '#ffffff',
                        ),
                    )
                )
            )
        )
    ),

    //tab countodn
    'countdown'  => array(
        'label'    => __( 'Countdown', 'yit' ),
        'sections' => array(
            'settings'   => array(
                'title'  => __( 'Settings', 'yit' ),
                'fields' => array(
                    'yith_prelaunch_countdown_enable' => array(
                        'title'       => __( 'Enable countdown', 'yit' ),
                        'description' => __( 'Tick if you want to show the countdown.', 'yit' ),
                        'type'        => 'checkbox',
                        'std'         => 1,
                    ),
                    'yith_prelaunch_to_date'          => array(
                        'title'       => __( 'Countdown to', 'yit' ),
                        'description' => __( 'The date when the countdown will stop.', 'yit' ),
                        'type'        => 'datepicker',
                        'std'         => array( 'date' => '', 'hh' => 0, 'mm' => 0, 'ss' => 0 ),
                    ),
                )
            ),
            'typography' => array(
                'title'  => __( 'Typography', 'yit' ),
                'fields' => array(
                    'yith_prelaunch_numbers_font' => array(
                        'title'       => __( 'Font numbers', 'yit' ),
                        'description' => __( 'The font for the numbers.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 90,
                            'unit'   => 'px',
                            'family' => 'Oswald',
                            'style'  => 'bold',
                            'color'  => '#ffffff',
                        ),
                    ),
                    'yith_prelaunch_labels_font'  => array(
                        'title'       => __( 'Font labels', 'yit' ),
                        'description' => __( 'The font for the labels.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 24,
                            'unit'   => 'px',
                            'family' => 'Source Sans Pro',
                            'style'  => 'regular',
                            'color'  => '#ffffff',
                        ),
                    ),
                    'yith_prelaunch_countdown_message'      => array(
                        'title'       => __( 'Countdown Message', 'yit' ),
                        'description' => __( 'The message displayed before countdown. You can also use HTML code.', 'yit' ),
                        'type'        => 'textarea',
                        'std'         => __( "TIME LEFT UNTIL LAUNCHNG:", 'yit' )
                    ),
                    'yith_prelaunch_countdown_message_font'  => array(
                        'title'       => __( 'Coundown font', 'yit' ),
                        'description' => __( 'The font for the countdown message.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 36,
                            'unit'   => 'px',
                            'family' => 'Oswald',
                            'style'  => 'bold',
                            'color'  => '#ffffff',
                        ),
                    ),
                )
            )
        )
    ),

    //tab container
    'newsletter' => array(
        'label'    => __( 'Newsletter', 'yit' ),
        'sections' => array(
            'newsletter'               => array(
                'title'       => __( 'Newsletter', 'yit' ),
                'description' => __( 'Add a newsletter form in your prelaunch mode page.', 'yit' ),
                'fields'      => array(
                    'yith_prelaunch_enable_newsletter_form'             => array(
                        'title'       => __( 'Enable Newsletter form', 'yit' ),
                        'description' => __( 'Choose if you want to enable the newsletter form in the prelaunch mode page.', 'yit' ),
                        'type'        => 'checkbox',
                        'std'         => true
                    ),
                    'yith_prelaunch_newsletter_email_font'              => array(
                        'title'       => __( 'Newsletter Email Font', 'yit' ),
                        'description' => __( 'Choose the font type, size and color for the email input field.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 16,
                            'unit'   => 'px',
                            'family' => 'Source Sans Pro',
                            'style'  => 'regular',
                            'color'  => '#a19b9b',
                        ),
                    ),
                    'yith_prelaunch_newsletter_submit_font'             => array(
                        'title'       => __( 'Newsletter Submit Font', 'yit' ),
                        'description' => __( 'Choose the font type, size and color for the email submit.', 'yit' ),
                        'type'        => 'typography',
                        'std'         => array(
                            'size'   => 18,
                            'unit'   => 'px',
                            'family' => 'Source Sans Pro',
                            'style'  => 'regular',
                            'color'  => '#ffffff',
                        ),
                    ),
                    'yith_prelaunch_newsletter_submit_background'       => array(
                        'title'       => __( 'Newsletter submit background', 'yit' ),
                        'description' => __( 'The submit button background.', 'yit' ),
                        'type'        => 'colorpicker',
                        'std'         => '#e9a400',
                    ),
                    'yith_prelaunch_newsletter_submit_background_hover' => array(
                        'title'       => __( 'Newsletter submit hover background', 'yit' ),
                        'description' => __( 'The submit button hover background.', 'yit' ),
                        'type'        => 'colorpicker',
                        'std'         => '#747474',
                    ),
                    'yith_prelaunch_newsletter_title'                   => array(
                        'title'       => __( 'Title', 'yit' ),
                        'description' => __( 'The title displayed above the newsletter form.', 'yit' ),
                        'type'        => 'text',
                        'std'         => __( 'STAY UPDATED', 'yit' ),
                    )
                )
            ),
            'newsletter_configuration' => array(
                'title'       => __( 'Form configuration', 'yit' ),
                'description' => __( 'Configure the form and each field, to integrate the newsletter features of an external service.', 'yit' ),
                'fields'      => array(
                    'yith_prelaunch_newsletter_action'        => array(
                        'title'       => __( 'Action URL', 'yit' ),
                        'description' => __( 'Set the action url of the form.', 'yit' ),
                        'type'        => 'text',
                        'std'         => ''
                    ),
                    'yith_prelaunch_newsletter_method'        => array(
                        'title'       => __( 'Form method', 'yit' ),
                        'description' => __( 'Set the method for the form request.', 'yit' ),
                        'type'        => 'select',
                        'options'     => array(
                            'POST' => 'POST',
                            'GET'  => 'GET',
                        ),
                        'std'         => 'POST'
                    ),
                    'yith_prelaunch_newsletter_email_label'   => array(
                        'title'       => __( '"Email" field label', 'yit' ),
                        'description' => __( 'The label for the email field', 'yit' ),
                        'type'        => 'text',
                        'std'         => __( 'ENTER YOUR EMAIL ADDRESS', 'yit' ),
                    ),
                    'yith_prelaunch_newsletter_email_name'    => array(
                        'title'       => __( '"Email" field name', 'yit' ),
                        'description' => __( 'The "name" attribute for the email field', 'yit' ),
                        'type'        => 'text',
                        'std'         => 'email',
                    ),
                    'yith_prelaunch_newsletter_submit_label'  => array(
                        'title'       => __( 'Submit button label', 'yit' ),
                        'description' => __( 'The label for the submit button', 'yit' ),
                        'type'        => 'text',
                        'std'         => __( 'GET NOTIFIED', 'yit' ),
                    ),
                    'yith_prelaunch_newsletter_hidden_fields' => array(
                        'title'       => __( 'Newsletter Hidden fields', 'yit' ),
                        'description' => __( 'Set the hidden fields to include in the form. Use the form: field1=value1&field2=value2&field3=value3', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    )
                )
            )
        )
    ),

    //tab socials
    'socials'    => array(
        'label'    => __( 'Socials', 'yit' ),
        'sections' => array(
            'logo' => array(
                'title'       => __( 'Set the socials', 'yit' ),
                'description' => __( "You can set here the url of your social accounts (you can leave empty if you don't want to show the social icon)", 'yit' ),
                'fields'      => array(
                    'yith_prelaunch_socials_facebook'  => array(
                        'title'       => __( 'Facebook', 'yit' ),
                        'description' => __( 'Set the URL of your facebook profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_twitter'   => array(
                        'title'       => __( 'Twitter', 'yit' ),
                        'description' => __( 'Set the URL of your twitter profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_gplus'     => array(
                        'title'       => __( 'Google+', 'yit' ),
                        'description' => __( 'Set the URL of your Google+ profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_youtube'   => array(
                        'title'       => __( 'Youtube', 'yit' ),
                        'description' => __( 'Set the URL of your youtube profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_rss'       => array(
                        'title'       => __( 'RSS', 'yit' ),
                        'description' => __( 'Set the URL of your RSS feed', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_skype'     => array(
                        'title'       => __( 'Skype', 'yit' ),
                        'description' => __( 'Set the username of your skype account', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_email'     => array(
                        'title'       => __( 'Email', 'yit' ),
                        'description' => __( 'Write here your email address', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_behance'   => array(
                        'title'       => __( 'Behance', 'yit' ),
                        'description' => __( 'Set the URL of your Behance profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_dribble'   => array(
                        'title'       => __( 'Dribble', 'yit' ),
                        'description' => __( 'Set the URL of your dribble profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_flickr'    => array(
                        'title'       => __( 'FlickR', 'yit' ),
                        'description' => __( 'Set the URL of your Flickr profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_instagram' => array(
                        'title'       => __( 'Instagram', 'yit' ),
                        'description' => __( 'Set the URL of your instagram profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_pinterest' => array(
                        'title'       => __( 'Pinterest', 'yit' ),
                        'description' => __( 'Set the URL of your Pinterest profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_tumblr'    => array(
                        'title'       => __( 'Tumblr', 'yit' ),
                        'description' => __( 'Set the URL of your Tumblr profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_linkedin'  => array(
                        'title'       => __( 'LinkedIn', 'yit' ),
                        'description' => __( 'Set the URL of your LinkedIn profile', 'yit' ),
                        'type'        => 'text',
                        'std'         => '',
                    ),
                    'yith_prelaunch_socials_icon_color' => array(
                        'title'       => __( 'Icon Color', 'yit' ),
                        'description' => __( 'Select the social icons color ', 'yit' ),
                        'type'        => 'colorpicker',
                        'std'         => '#adadad',
                    ),
                    'yith_prelaunch_socials_icon_color_hover' => array(
                        'title'       => __( 'Icon Color Hover', 'yit' ),
                        'description' => __( 'Select the social icons color in hover', 'yit' ),
                        'type'        => 'colorpicker',
                        'std'         => '#e9a400',
                    ),
                )
            )
        )
    ),
);
