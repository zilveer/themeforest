<?php
if (!defined('ABSPATH')) exit();

include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_general/tab_general.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_styling/tab_styling.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_sliders/tab_sliders.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_blog/tab_blog.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_search/tab_search.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_contact_forms/tab_contact_forms.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_custom_sidebars/tab_custom_sidebars.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_seo/tab_seo.php';
include_once TMM_THEME_PATH . '/admin/theme_options/sections/tab_footer/tab_footer.php';

/* modules and plugins can add custom tab to Theme Options */
do_action('tmm_add_theme_options_tab');

wp_enqueue_style("thememakers_theme_admin_css", TMM_THEME_URI . '/admin/theme_options/css/options_styles.css');
wp_enqueue_style("thememakers_theme_jquery_ui_css2", TMM_THEME_URI . '/admin/theme_options/css/jquery-ui.css');

wp_enqueue_script('thememakers_theme_options_js', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery', 'jquery-ui-core'));
wp_enqueue_script('thememakers_theme_custom_sidebars_js', TMM_THEME_URI . '/admin/theme_options/js/custom_sidebars.js');
wp_enqueue_script('thememakers_theme_seo_groups_js', TMM_THEME_URI . '/admin/theme_options/js/seo_groups.js');
wp_enqueue_script('thememakers_theme_form_constructor_js', TMM_THEME_URI . '/admin/theme_options/js/form_constructor.js');

//*********---------------------------------------------------------------------------------------------------------------

$form_constructor = new TMM_Contact_Form('contacts_form');
$form_constructor->options_description = array(
    "form_title" => array(__("Form Title", 'cardealer'), "input"),
    "field_type" => array(__("Field Type", 'cardealer'), "select"),
    "form_label" => array(__("Field Label", 'cardealer'), "input"),
    "enable_captcha" => array(__("Enable Captcha Protection", 'cardealer'), "checkbox")
);
//*****
$google_fonts = TMM_HelperFonts::get_google_fonts();
$content_fonts = TMM_HelperFonts::get_content_fonts();
$fonts = array_merge($content_fonts, $google_fonts);
$fonts = array_merge(array("" => ""), $fonts);
//*****
$sidebars = TMM::get_option('sidebars');
//*****
$contact_forms = TMM::get_option('contact_form');
//*****
$seo_groups = TMM::get_option('seo_groups');
?>

<script type="text/javascript">var tmm_options_reset_array = [];</script>

<form id="theme_options" name="theme_options" method="post" style="display: none;">
    <div id="tm">

        <section class="admin-container clearfix">

            <header id="title-bar" class="clearfix">

                <a href="#" class="admin-logo"></a>
                <span class="fw-version">framework v.<?php echo THEMEMAKERS_FRAMEWORK_VERSION ?></span>

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
                       class="admin-button button-small button-yellow button_reset_options"><?php _e('Reset All Options', 'cardealer'); ?></a>
                    <a href="#"
                       class="admin-button button-small button-yellow button_save_options"><?php _e('Save All Changes', 'cardealer'); ?></a>
                </div>
                <!--/ .button-options-->

            </section>
            <!--/ .set-holder-->

            <aside id="admin-aside">

                <ul class="admin-nav">

                    <?php foreach (TMM_OptionsHelper::$sections as $section_key => $section) { ?>

                        <?php if (!empty($section['child_sections'])): ?>

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

                                <ul>
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

                        <?php else: ?>

                            <li>
                                <a class="<?php echo $section['css_class'] ?>" href="#<?php echo $section_key ?>">
                                    <i class="dashicons <?php echo $section['menu_icon'] ?>"></i>
                                    <?php echo $section['name'] ?>
                                </a>
                            </li>

                        <?php endif; ?>

                    <?php }; ?>

                </ul>
                <!--/ .admin-nav-->

            </aside>
            <!--/ #admin-aside-->

            <section id="options-framework" class="clearfix">


                <?php foreach (TMM_OptionsHelper::$sections as $section_key => $section) { ?>
                    <?php if ($section['show_general_page']) { ?>
                        <div id="<?php echo $section_key ?>" class="section-tab">
                            <h1 class="section-tab-title"><?php echo $section['name'] ?></h1>

                            <?php foreach ($section['content'] as $item_key => $item) { ?>

                                <div class="section">

                                    <?php if ($item['type'] != 'checkbox'): ?>
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

                                    <div class="section">

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



                <div class="admin-group-button clearfix">
                    <a class="admin-button button-yellow button-medium align-left button_reset_options"
                       href="#"><?php _e('Reset All Options', 'cardealer'); ?></a>
                    <a class="admin-button button-yellow button-medium align-right button_save_options"
                       href="#"><?php _e('Save All Changes', 'cardealer'); ?></a>
                </div>

            </section>
            <!--/ #admin-content-->

        </section>
        <!--/ .admin-container-->

    </div>
    <!--/ #tm-->
</form>

<?php

function tmm_print_options_item($item_key, $item) {
    switch ($item['type']) {
        case 'textarea':
        case 'text':
        case 'google_font_select':
        case 'color':
        case 'upload':
        case 'checkbox':
            TMM_OptionsHelper::draw_theme_option(array(
                'name' => $item_key,
                'title' => $item['title'],
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
            TMM_OptionsHelper::draw_theme_option(array(
                'name' => $item_key,
                'title' => $item['title'],
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
            TMM_OptionsHelper::draw_theme_option(array(
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

    echo $item['custom_html'];
}
?>
<!------------------------ html templates for js ------------------------------------------->

<?php include_once 'html_templates.php'; ?>

<div class="clear"></div>
