<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php if (!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') flow_elated_wp_title(); ?>
    <?php
    /**
     * @see flow_elated_header_meta() - hooked with 10
     * @see eltd_user_scalable - hooked with 10
     */
    ?>
	<?php if (!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') do_action('flow_elated_header_meta'); ?>

	<?php if (!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') wp_head(); ?>
</head>

<body <?php body_class();?>>


<?php 
if((!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') && flow_elated_options()->getOptionValue('smooth_page_transitions') == "yes") {
    $ajax_class = flow_elated_options()->getOptionValue('smooth_pt_true_ajax') === 'no' ? 'mimic-ajax' : 'ajax';
?>
<div class="eltd-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
    <?php if(flow_elated_options()->getOptionValue('enable_preloader_logo') == "yes") { ?>
        <img class="eltd-normal-logo eltd-preloader-logo" src="<?php echo esc_url(flow_elated_get_preloader_logo()); ?>" alt="<?php esc_html_e('Logo','flow'); ?>"/>
    <?php } ?>
    <div class="eltd-st-loader">
        <div class="eltd-st-loader1">
            <?php flow_elated_loading_spinners(); ?>
        </div>
    </div>
</div>
<?php } ?>

<div class="eltd-wrapper">
    <div class="eltd-wrapper-inner">
        <?php
        if (!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') {
            flow_elated_get_header();
        }
        ?>

        <?php if ((!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') && flow_elated_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='eltd-back-to-top'  href='#'>
                <span class="eltd-icon-stack"></span>
                <span class="eltd-back-to-top-text"><?php esc_html_e('Top', 'flow'); ?></span>
                <span class="arrow_carrot-up eltd-back-to-top-arrow"></span>
            </a>
        <?php } ?>

        <div class="eltd-content" <?php flow_elated_content_elem_style_attr(); ?>>
            <?php if(flow_elated_is_ajax_enabled()) { ?>
            <div class="eltd-meta">
                <?php do_action('flow_elated_ajax_meta'); ?>
                <span id="eltd-page-id"><?php echo esc_html($wp_query->get_queried_object_id()); ?></span>
                <div class="eltd-body-classes"><?php echo esc_html(implode( ',', get_body_class())); ?></div>
            </div>
            <?php } ?>
            <div class="eltd-content-inner">