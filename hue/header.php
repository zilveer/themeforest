<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * @see hue_mikado_header_meta() - hooked with 10
	 * @see mkd_user_scalable - hooked with 10
	 */
	?>
	<?php if (!hue_mikado_is_ajax_request()) do_action('hue_mikado_header_meta'); ?>

	<?php if (!hue_mikado_is_ajax_request()) wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (!hue_mikado_is_ajax_request()) hue_mikado_get_side_area(); ?>


<?php
if ((!hue_mikado_is_ajax_request()) && hue_mikado_options()->getOptionValue('smooth_page_transitions') == "yes") {
    $ajax_class = hue_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'yes' ? 'mkd-ajax' : 'mkd-mimic-ajax';
	?>
	<div class="mkd-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
		<div class="mkd-st-loader">
			<div class="mkd-st-loader1">
				<?php hue_mikado_loading_spinners(); ?>
			</div>
		</div>
	</div>
<?php } ?>

<div class="mkd-wrapper">
	<div class="mkd-wrapper-inner">
		<?php if (!hue_mikado_is_ajax_request()) hue_mikado_get_header(); ?>

		<?php if ((!hue_mikado_is_ajax_request()) && hue_mikado_options()->getOptionValue('show_back_button') == "yes") { ?>
			<a id='mkd-back-to-top' href='#'>
                <span class="mkd-icon-stack mkd-type1-gradient-left-to-right-text">
                     <?php echo hue_mikado_icon_collections()->renderIcon('lnr-chevron-up', 'linear_icons'); ?>
                </span>
			</a>
		<?php } ?>
        <?php if (!hue_mikado_is_ajax_request()) hue_mikado_get_full_screen_menu(); ?>
		<div class="mkd-content" <?php hue_mikado_content_elem_style_attr(); ?>>
			<?php if (hue_mikado_is_ajax_enabled()) { ?>
				<div class="mkd-meta">
					<?php do_action('hue_mikado_ajax_meta'); ?>
					<span id="mkd-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>

					<div class="mkd-body-classes"><?php echo esc_html(implode(',', get_body_class())); ?></div>
				</div>
			<?php } ?>
			<div class="mkd-content-inner">