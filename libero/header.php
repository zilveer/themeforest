<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php libero_mikado_wp_title(); ?>
    <?php
    /**
     * @see libero_mikado_header_meta() - hooked with 10
     * @see mkd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('libero_mikado_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php libero_mikado_get_side_area(); ?>

<div class="mkd-wrapper">
    <div class="mkd-wrapper-inner">
        <?php libero_mikado_get_header(); ?>

        <?php if(libero_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='mkd-back-to-top'  href='#'>
                <span class="mkd-icon-stack">
                     <?php
                        libero_mikado_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>

        <div class="mkd-content" <?php libero_mikado_content_elem_style_attr(); ?>>
            <div class="mkd-content-inner">