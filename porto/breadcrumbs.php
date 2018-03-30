<?php
global $porto_settings;

$page_header_type = $porto_settings['breadcrumbs-type'] ? $porto_settings['breadcrumbs-type'] : '1';
$breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
$page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;

if (( is_front_page() && is_home()) || is_front_page() ) {
    $breadcrumbs = false;
    $page_title = false;
}
?>
<?php if ($breadcrumbs || $page_title) : ?>
    <?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['breadcrumbs-wrapper'] == 'boxed') : ?>
        <div id="breadcrumbs-boxed">
    <?php endif; ?>
    <section class="page-top<?php if ($porto_settings['breadcrumbs-wrapper'] == 'wide') echo ' wide' ?> page-header-<?php echo $page_header_type ?>"<?php if ($porto_settings['breadcrumbs-parallax']) echo ' data-plugin-parallax data-plugin-options="{&quot;speed&quot;: ' . esc_attr($porto_settings['breadcrumbs-parallax-speed']) . '}" style="background-image: none !important;"' ?>>
        <?php get_template_part('page_header/page_header_' . $page_header_type) ?>
    </section>
    <?php if (porto_get_wrapper_type() != 'boxed' && $porto_settings['breadcrumbs-wrapper'] == 'boxed') : ?>
        </div>
    <?php endif; ?>
<?php endif; ?>