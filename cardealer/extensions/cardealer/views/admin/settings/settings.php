<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_general/tab_general.php';
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_data_constructor/tab_data_constructor.php';
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_front_slider/tab_front_slider.php';
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_messages/tab_messages.php';
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_user_manager/tab_user_manager.php';
include_once TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/tab_watermark/tab_watermark.php';

wp_enqueue_style("thememakers_theme_admin_css", TMM_THEME_URI . '/admin/theme_options/css/options_styles.css');
wp_enqueue_style("thememakers_theme_jquery_ui_css2", TMM_THEME_URI . '/admin/theme_options/css/jquery-ui.css');
//***
wp_enqueue_script('thememakers_theme_options_js', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery', 'jquery-ui-core'));
wp_enqueue_script('thememakers_app_cardealer_data_constructor_js', TMM_Ext_Car_Dealer::get_application_uri() . '/js/admin/data_constructor.js', array('jquery', 'jquery-ui-sortable'));
wp_enqueue_script('thememakers_app_cardealer_user_manager', TMM_Ext_Car_Dealer::get_application_uri() . '/js/admin/user_manager.js', array('jquery', 'jquery-ui-sortable'));

$car_options_range = array();
foreach (range(1, 99) as $key => $value) {
    $car_options_range[$key + 1] = $value;
}
?>

<script type="text/javascript">var tmm_options_reset_array = [];</script>
<form id="theme_options" name="cardealer_form" method="post">
    <div id="tm">

        <section class="admin-container clearfix">

            <header id="title-bar" class="clearfix">

                <a href="#" class="admin-logo"></a>
                <span class="fw-version">Car Dealer v.<?php echo wp_get_theme()->get('Version'); ?></span>

                <div class="clear"></div>

            </header>
            <!--/ #title-bar-->

            <section class="set-holder clearfix">

                <ul class="support-links">
                    <li><a class="support-docs" href="<?php echo THEMEMAKERS_THEME_LINK ?>"
                           target="_blank"><?php _e('View Theme Docs', 'cardealer'); ?></a></li>
                    <li><a class="support-forum" href="<?php echo THEMEMAKERS_THEME_FORUM_LINK ?>"
                           target="_blank"><?php _e('Visit Forum', 'cardealer'); ?></a></li>
                </ul>
                <!--/ .support-links-->

                <div class="button-options">
                    <a href="#"
                       class="admin-button button-small button-yellow button_save_cardealer_options"><?php _e('Save All Changes', 'cardealer'); ?></a>
                </div>
                <!--/ .button-options-->

            </section>
            <!--/ .set-holder-->

            <aside id="admin-aside">

                <ul class="admin-nav">
                    <?php foreach (TMM_CarSettingsHelper::$sections as $section_key => $section) { ?>

                        <?php if (!empty($section['child_sections'])) { ?>

                            <li>
                                <?php if ($section['show_general_page']): ?>
                                    <a class="<?php echo $section['css_class'] ?>" href="#<?php echo $section_key ?>">
                                        <i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
                                        <?php echo $section['name'] ?>
                                    </a>
                                <?php else: ?>

                                    <?php
                                    reset($section['child_sections']);
                                    $first_child_section_key = key($section['child_sections']);
                                    ?>
                                    <a class="<?php echo $section['css_class'] ?>"
                                       href="#<?php echo $first_child_section_key ?>">
                                        <i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
                                        <?php echo $section['name'] ?>
                                    </a>

                                <?php endif; ?>

                                <ul style="display:block">
                                    <?php if ($section['show_general_page']): ?>
                                        <li>
                                            <a href="#<?php echo $section_key ?>"><?php _e('General', 'cardealer'); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php foreach ($section['child_sections'] as $child_section_key => $child_section) : ?>
                                        <li>
                                            <a href="#<?php echo $child_section_key ?>"><?php echo $child_section['name'] ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            </li>

                        <?php }else { ?>

                            <li>
                                <a class="<?php echo $section['css_class'] ?>" href="#<?php echo $section_key ?>">
                                    <i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
                                    <?php echo $section['name'] ?>
                                </a>
                            </li>

                        <?php } ?>    

                    <?php } ?>          
                  
                </ul>
                <!--/ .admin-nav-->

            </aside>
            <!--/ #admin-aside-->

            <section id="options-framework" class="clearfix">

                <?php foreach (TMM_CarSettingsHelper::$sections as $section_key => $section) { ?>
                    <?php if ($section['show_general_page']) { ?>
                        <div id="<?php echo $section_key ?>" class="section-tab">
                            <h1 class="section-tab-title"><?php echo $section['name'] ?></h1>

                            <?php foreach ($section['content'] as $item_key => $item) { ?>

                                <div class="section">

                                    <?php if (isset($item['title']) && $item['type'] != 'checkbox'): ?>
                                        <h2 class="section-title"><?php echo $item['title']; ?></h2>
                                    <?php endif; ?>

                                    <?php
                                    if (($item['type'] == 'items_block')) {
                                        foreach ($item['items'] as $block_item_key => $block_item) {                                                                       
                                             
                                            tmm_print_options_item($block_item_key, $block_item);
                                        }
                                    } else {
                                        tmm_print_options_item($item_key, $item);
                                    }
                                    ?>

                                </div><!--/ .section-->

                                <?php }; ?>

                        </div><!--/ .section-tab-->
                        <?php }; ?>

                            <?php if (!empty($section['child_sections'])) { ?>
                                <?php foreach ($section['child_sections'] as $child_section_key => $child_section) { ?>
                                    <div id="<?php echo $child_section_key ?>" class="section-tab">

                                        <h1 class="section-tab-title"><?php echo $child_section['name'] ?></h1>

                                        <?php foreach ($child_section['sections'] as $item_key => $item) { ?>

                                            <div class="section"<?php echo !empty($item['hide']) ? 'style="display:none"' : ''; ?>>

                                                <?php if ($item['type'] != 'checkbox') { ?>
                                                    <h2 class="section-title"><?php echo $item['title']; ?></h2>
                                                <?php }; ?>

                                                <?php
                                                if (($item['type'] == 'items_block')) {
                                                    foreach ($item['items'] as $block_item_key => $block_item) {                                                      
                                                        tmm_print_options_item($block_item_key, $block_item);
                                                    }
                                                } else {
                                                    tmm_print_options_item($item_key, $item);
                                                }
                                                ?>

                                            </div><!--/ .section-->

                                        <?php } ?>

                                    </div>
                                <?php } ?>
                            <?php } ?>
<?php } ?>            

            </section>
            <!--/ #admin-content-->

        </section>
        <!--/ .admin-container-->


    </div>
    <!--/ #tm-->


</form>

<div style="display: none"></div>

<div class="clear"></div>

<?php

function tmm_print_options_item($item_key, $item) {
    switch ($item['type']) {
        case 'textarea':
        case 'text':
        case 'google_font_select':
        case 'color':
        case 'upload':
        case 'checkbox':
            TMM_CarSettingsHelper::draw_theme_option(array(
                'name' => $item_key,
                'title' => $item['title'],
                'show_title' => $item['show_title'],
                'type' => $item['type'],
                'default_value' => $item['default_value'],
                'description' => $item['description'],
                'name_type' => (isset($item['name_type']) ? $item['name_type'] : ''),
                'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
                'css_class' => (isset($item['css_class']) ? $item['css_class'] : ''),
                'hide' => (isset($item['hide']) ? $item['hide'] : ''),
            ));
            break;
        case 'select':
            TMM_CarSettingsHelper::draw_theme_option(array(
                'name' => $item_key,
                'title' => $item['title'],
				'show_title' => $item['show_title'],
                'type' => 'select',
                'default_value' => $item['default_value'],
                'values' => $item['values'],
                'description' => $item['description'],
                'show_title' => (isset($item['show_title']) ? $item['show_title'] : false),
                'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
                'css_class' => (isset($item['css_class']) ? $item['css_class'] : ''),
                'hide' => (isset($item['hide']) ? $item['hide'] : ''),
            ));
            break;
        case 'slider':
            TMM_CarSettingsHelper::draw_theme_option(array(
                'name' => $item_key,
                'title' => $item['title'],
                'type' => 'slider',
                'default_value' => $item['default_value'],
                'description' => $item['description'],
                'min' => $item['min'],
                'max' => $item['max'],
                'is_reset' => (isset($item['is_reset']) ? $item['is_reset'] : false),
                'show_title' => (isset($item['show_title']) ? $item['show_title'] : false),
                'css_class' => (isset($item['css_class']) ? $item['css_class'] : ''),
                'hide' => (isset($item['hide']) ? $item['hide'] : ''),
            ));
            break;
        case 'tmm_db_migrate':
            // echo $item['html'];
            break;
        default:
            break;
    }

    if(isset($item['custom_html'])){
		echo $item['custom_html'];
	}
}
?>


<?php include_once TMM_THEME_PATH . '/admin/theme_options/html_templates.php'; ?>