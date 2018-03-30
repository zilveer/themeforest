<?php
global $porto_settings;

$page_header_type = isset($porto_settings['breadcrumbs-type']) ? $porto_settings['breadcrumbs-type'] : '1';
$breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
$page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;

if (( is_front_page() && is_home()) || is_front_page() ) {
    $breadcrumbs = false;
    $page_title = false;
}

$title = porto_page_title();
$hide_title = !$title || !$page_title;
$sub_title = porto_page_sub_title();
?>
<div class="container<?php if ($hide_title) : ?> hide-title<?php endif; ?>">
    <div class="row">
        <div class="col-md-12">
            <?php if ($breadcrumbs) : ?>
                <div class="breadcrumbs-wrap<?php if ($sub_title) : ?> breadcrumbs-with-subtitle<?php endif; ?>">
                    <?php echo porto_breadcrumbs(); ?>
                </div>
            <?php endif; ?>
            <div class="<?php if ($hide_title) : ?> hide<?php endif; ?>">
                <h1 class="page-title<?php echo $sub_title ? ' b-none': '' ?>"><?php echo $title; ?></h1>
                <?php
                if ($sub_title) :
                    ?>
                    <p class="page-sub-title"><?php echo $sub_title ?></p>
                <?php endif;?>
            </div>
            <?php
            porto_woocommerce_product_nav();
            porto_breadcrumbs_filter();
            ?>
        </div>
    </div>
</div>