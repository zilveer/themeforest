<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
$config = array(
      'title' => sprintf('%s Page Options', THEME_NAME) ,
      'id' => 'mk-metaboxes-general',
      'pages' => array(
            'page',
            'news'
      ) ,
      'callback' => '',
      'context' => 'normal',
      'priority' => 'core'
);
$options = array(
      array(
            "name" => __("Layout", "mk_framework") ,
            "desc" => __("Please choose this page's layout.", "mk_framework") ,
            "id" => "_layout",
            "default" => 'full',
            "options" => array(
                  "left" => __("Left Sidebar", "mk_framework") ,
                  "right" => __("Right Sidebar", "mk_framework") ,
                  "full" => __("Full Layout", "mk_framework")
            ) ,
            "type" => "select"
      ) ,
      array(
            "name" => __("Manage Page Elements", "mk_framework") ,
            "desc" => __("Depending on your need you can change this page's general layout by making structural changes.", "mk_framework") ,
            "id" => "_template",
            "default" => '',
            "options" => array(
                  "no-header" => __('Remove Header', "mk_framework") ,
                  "no-title" => __('Remove Page Title', "mk_framework") ,
                  "no-header-title" => __('Remove Header & Page Title', "mk_framework") ,
                  "no-footer" => __('Remove Footer', "mk_framework") ,
                  "no-header-footer" => __('Remove Header & Footer', "mk_framework") ,
                  "no-footer-title" => __('Remove Footer & Page Title', "mk_framework") ,
                  "no-header-title-footer" => __('Remove Header & Page Title & Footer', "mk_framework")
            ) ,
            "type" => "select"
      ) ,
      array(
            "name" => __("Stick Template?", "mk_framework") ,
            "desc" => __("Enabling this option will remove padding after header and before footer.", "mk_framework") ,
            "id" => "_padding",
            "default" => 'false',
            "type" => "toggle"
      ) ,
      array(
            "name" => __("Page Preloader?", "mk_framework") ,
            "desc" => __("This option will enable preloader for this post only. if you would like to enable it throughout the site consider option in General => Site Preloader => Preloader.", "mk_framework") ,
            "id" => "page_preloader",
            "default" => 'false',
            "type" => "toggle"
      ) ,
      array(
            "name" => __("Page Title Align", "mk_framework") ,
            "desc" => __("You can change title and subtitle text align.", "mk_framework") ,
            "id" => "_introduce_align",
            "default" => 'left',
            "options" => array(
                  "left" => 'Left',
                  "right" => 'Right',
                  "center" => 'Center'
            ) ,
            "type" => "select"
      ) ,
      
      array(
            "name" => __("Custom Page Title", "mk_framework") ,
            "desc" => __("You can add a custom title for this page. (This option have NOTHING to do with title  &lt;title&gt; tag inside HTML.)", "mk_framework") ,
            "id" => "_custom_page_title",
            "rows" => "1",
            "default" => "",
            "type" => "text"
      ) ,
      array(
            "name" => __("Page Heading Subtitle", "mk_framework") ,
            "desc" => __("You can add a subtitle to header section of this page using this option.", "mk_framework") ,
            "id" => "_page_introduce_subtitle",
            "rows" => "3",
            "default" => "",
            "type" => "textarea"
      ) ,
      array(
            "name" => __("Breadcrumb", "mk_framework") ,
            "desc" => __("You can disable Breadcrumb for this page using this option", "mk_framework") ,
            "id" => "_disable_breadcrumb",
            "default" => 'true',
            "type" => "toggle"
      ) ,
      
      array(
            "name" => __("Main Navigation Location", "mk_framework") ,
            "desc" => __("Choose which menu location to be used in this page. If left blank, Primary Menu will be used. You should first <a target='_blank' href='" . admin_url('nav-menus.php') . "'>create menu</a> and then <a target='_blank' href='" . admin_url('nav-menus.php') . "?action=locations'>assign to menu locations</a>", "mk_framework") ,
            "id" => "_menu_location",
            "default" => '',
            "placeholder" => 'true',
            "width" => 400,
            "options" => array(
                  "primary-menu" => __('Primary Navigation', "mk_framework") ,
                  "second-menu" => __('Second Navigation', "mk_framework") ,
                  "third-menu" => __('Third Navigation', "mk_framework") ,
                  "fourth-menu" => __('Fourth Navigation', "mk_framework"),
                  "fifth-menu" => __('Fifth Navigation', "mk_framework"),
                  "sixth-menu" => __('Sixth Navigation', "mk_framework"),
                  "seventh-menu" => __('Seventh Navigation', "mk_framework"),
                  "eighth-menu" => __('Eighth Navigation', "mk_framework"),
                  "ninth-menu" => __('Ninth Navigation', "mk_framework"),
                  "tenth-menu" => __('tenth Navigation', "mk_framework"),
            ) ,
            "type" => "select"
      ) ,
      array(
            "name" => __("Custom Sidebar", "mk_framework") ,
            "desc" => __("You can create a custom sidebar, under Sidebar option and then assign the custom sidebar here to this post. later on you can customize which widgets to show up.", "mk_framework") ,
            "id" => "_sidebar",
            "default" => '',
            "options" => mk_get_sidebar_options() ,
            "dependency" => array(
                   'element' => "_layout",
                   'value' => array(
                        'left',
                        'right'
                   )
            ),
            "type" => "select"
      )
);
new mkMetaboxesGenerator($config, $options);
