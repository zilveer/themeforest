<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see hashmag_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('hashmag_mikado_header_meta'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
<?php hashmag_mikado_get_side_area(); ?>
<div class="mkdf-wrapper">
    <div class="mkdf-wrapper-inner">
        <?php hashmag_mikado_get_header(); ?>

        <?php if(hashmag_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkdf-back-to-top'  href='#'>
                <span class="mkdf-icon-stack">
                     <!-- <span aria-hidden="true" class="mkdf-icon-font-elegant arrow_carrot-2up "></span> -->
                     <span class="mkdf-btt-1"></span>
                     <span class="mkdf-btt-2"></span>
                     <span class="mkdf-btt-3"></span>
                     <span class="mkdf-btt-4"></span>
                </span>
            </a>
        <?php } ?>

        <div class="mkdf-content" <?php hashmag_mikado_content_elem_style_attr(); ?>>
            <div class="mkdf-content-inner">