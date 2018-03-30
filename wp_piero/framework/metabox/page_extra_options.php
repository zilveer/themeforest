<?php

class CsheroTemplateMetaboxes
{

    public function __construct()
    {
        add_action('add_meta_boxes', array(
            $this,
            'add_meta_boxes'
        ));
        add_action('admin_enqueue_scripts', array(
            $this,
            'admin_script_loader'
        ));
    }

    function admin_script_loader()
    {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {}
    }

    public function add_meta_boxes()
    {
        $this->add_meta_box('template_extra_options', __('Extra Options', THEMENAME), 'page');
    }

    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default')
    {
        add_meta_box('cs_' . $id, $label, array(
            $this,
            $id
        ), $post_type, $context, $priority);
    }

    /* post */
    function template_extra_options()
    {
        ?>
        <div id="cs-blog-metabox" class='cs_metabox'>
            <div id="header_content_setting" class="tab-content">
            <p class="cs_info"><i class="dashicons dashicons-admin-post"></i><?php echo _e(' Header top 2 Setting',THEMENAME);?></p>   
            <?php
            cs_options(array(
                'id' => 'header_top2_widgets',
                'label' => __('Header Top 2',THEMENAME),
                'type' => 'select',
                'options' => array('' => 'Default','1' => 'Show', '0' => 'Hide'),
            ));
            cs_options(array(
                'id' => 'header_top2_widgets_border_color',
                'label' => __('Border Bottom Color',THEMENAME),
                'type' => 'color',
                'rgba' => true,
                'default' => ''
            ));
            ?>
            <p class="cs_info"><i class="dashicons dashicons-admin-post"></i><?php echo _e(' Logo Setting',THEMENAME);?></p>
            <?php
            cs_options(array(
                'label' => 'Logo',
                'description' => 'Select an image file for your logo.',
                'id' => 'logo',
                'type' => 'images',
                'field' => 'single'
            ));
            cs_options(array(
                'id' => 'logo_alignment',
                'label' => 'Logo Alignment',
                'type' => 'select',
                'options' => array(
                    '' =>'Default',
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
                ),
                'default' => 'Left'
            ));
            cs_options(array(
                'id' => 'margin_logo',
                'label' => 'Logo Margin',
                'type' => 'text',
                'default' => '',
                'description' => 'Set margin Top/Right/Bottom/Left for logo',
            ));
            cs_options(array(
                'id' => 'padding_logo',
                'label' => 'Logo Padding',
                'type' => 'text',
                'default' => '',
                'description' => 'Set padding Top/Right/Bottom/Left for logo',
            ));

            ?>
            <p class="cs_info"><i class="dashicons dashicons-admin-post"></i><?php echo _e('Menu Setting',THEMENAME);?></p>
            <?php
            cs_options(array(
                'label' => 'Show/Hide arrow parent menu item',
                'description' => '',
                'id' => 'arrow_parents_item_menu',
                'type' => 'select',
                'options' => array(
                    '' =>'Default',
                    '1' => 'Show',
                    '0' => 'Hide',
                ),
                'default' => ''
            ));
            cs_options(array(
                'label' => 'Menu Left position',
                'description' => 'Position of left menu when you use default header 3',
                'id' => 'header3_menu_left_position',
                'type' => 'select',
                'options' => array(
                    'right' => 'Right',
                    'left' => 'Left'
                ),
                'default' => 'right'
            ));
            cs_options(array(
                'label' => 'Menu Right position',
                'description' => 'Position of Right menu when you use default header 3',
                'id' => 'header3_menu_right_position',
                'type' => 'select',
                'options' => array(
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'default' => 'left'
            ));
            ?>
            <p class="cs_info"><i class="dashicons dashicons-admin-post"></i><?php echo _e(' Header content widgets Setting',THEMENAME);?></p>
            <?php
            cs_options(array(
                'id' => 'header_content_widgets',
                'label' => __('Show/Hide Header Content Widgets',THEMENAME),
                'type' => 'select',
                'options' => array('' => 'Default','1' => 'Show', '0' => 'Hide'),
            ));
            cs_options(array(
                'id' => 'header_content_widgets1',
                'label' => __('Show/Hide Header Content Widgets 1',THEMENAME),
                'type' => 'select',
                'options' => array('1' => 'Show', '0' => 'Hide'),
            ));
            cs_options(array(
                'id' => 'header_content_widgets2',
                'label' => __('Show/Hide Header Content Widgets 2',THEMENAME),
                'type' => 'select',
                'options' => array('1' => 'Show', '0' => 'Hide'),
            ));
            cs_options(array(
                'id' => 'header_fixed_content_widgets',
                'label' => __('Show/Hide Header Fixed Content Widgets',THEMENAME),
                'type' => 'select',
                'options' => array('1' => 'Show', '0' => 'Hide'),
            ));
            ?>
            </div>
        </div>
        <?php
    }
}
new CsheroTemplateMetaboxes();