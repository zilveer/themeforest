<?php if (!defined('TFUSE')) die('Direct access forbidden.');

$tab_options = array(
    'name'     => __('Email settings', 'tfuse'),
    'id'       => TF_THEME_PREFIX .'_email_settings',
    'headings' => array(
        array(
            'name'    => __('Outgoing Mail', 'tfuse'),
            'options' => array(
                array(
                    'name'      => __('Type', 'tfuse'),
                    'desc'      => __('', 'tfuse'),
                    'type'      => 'select',
                    'id'        => TF_THEME_PREFIX .'_mail__general__method',
                    'value'     => 'wpmail',
                    'options'   => array(
                        'wpmail' => 'wp-mail',
                        'smtp'   => 'SMTP',
                    ),
                    'divider'   => true
                ),
                array(
                    'name'      => __('Server address', 'tfuse'),
                    'desc'      => __('', 'tfuse'),
                    'type'      => 'text',
                    'id'        => TF_THEME_PREFIX .'_mail__smtp__host',
                    'value'     => '',
                ),
                array(
                    'name'      => __('Username', 'tfuse'),
                    'desc'      => __('', 'tfuse'),
                    'type'      => 'text',
                    'id'        => TF_THEME_PREFIX .'_mail__smtp__username',
                    'value'     => '',
                ),
                array(
                    'name'      => __('Password', 'tfuse'),
                    'desc'      => __('', 'tfuse'),
                    'type'      => 'password',
                    'id'        => TF_THEME_PREFIX .'_mail__smtp__password',
                    'value'     => '',
                ),
                array(
                    'name'      => __('Secure connection', 'tfuse'),
                    'desc'      => __('', 'tfuse'),
                    'type'      => 'radio',
                    'id'        => TF_THEME_PREFIX .'_mail__smtp__secure',
                    'value'     => 'no',
                    'options'   => array(
                        'no'  => 'No',
                        'ssl' => 'SSL',
                        'tls' => 'TLS'
                    )
                ),
                array(
                    'name'      => __('Custom Port', 'tfuse'),
                    'desc'      => __('Optional - SMTP port number to use. Leave blank for default (SMTP - 25, SMTPS - 465).', 'tfuse'),
                    'type'      => 'text',
                    'id'        => TF_THEME_PREFIX .'_mail__smtp__port',
                    'value'     => '',
                    'divider'   => true
                ),
                array(
                    'name'      => __('From name', 'tfuse'),
                    'desc'      => __('The form will look like was sent from this name.', 'tfuse'),
                    'type'      => 'text',
                    'id'        => TF_THEME_PREFIX . '_mail__general__from_name',
                    'value'     => '',
                ),
                array(
                    'name'      => __('From address', 'tfuse'),
                    'desc'      => __('The form will look like was sent from this address.', 'tfuse'),
                    'type'      => 'text',
                    'id'        => TF_THEME_PREFIX . '_mail__general__from_address',
                    'value'     => '',
                )
            )
        )
    )
);