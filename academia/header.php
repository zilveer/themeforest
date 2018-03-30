<?php
	$g5plus_options = &G5Plus_Global::get_options();
	$prefix = 'g5plus_';
	$header_responsive = isset($g5plus_options['mobile_header_responsive_breakpoint']) && !empty($g5plus_options['mobile_header_responsive_breakpoint'])
						 ? $g5plus_options['mobile_header_responsive_breakpoint'] : '991';

	$header_layout = rwmb_meta($prefix . 'header_layout');
	if (($header_layout === '') || ($header_layout == '-1')) {
		$header_layout = $g5plus_options['header_layout'];
	}
?>
<!DOCTYPE html>
<!-- Open Html -->
<html <?php language_attributes(); ?>>
	<!-- Open Head -->
	<head>
		<?php wp_head(); ?>
	</head>
	<!-- Close Head -->
	<body <?php body_class(); ?> data-responsive="<?php echo esc_attr($header_responsive)?>" data-header="<?php echo esc_attr($header_layout) ?>">

		<?php
			/**
			 * @hooked - g5plus_site_loading - 5
			 **/
			do_action('g5plus_before_page_wrapper');
		?>
		<!-- Open Wrapper -->
		<div id="wrapper">

		<?php
		/**
		 * @hooked - g5plus_before_page_wrapper_content - 10
		 * @hooked - g5plus_page_header - 15
		 **/
		do_action('g5plus_before_page_wrapper_content');
		?>

			<!-- Open Wrapper Content -->
			<div id="wrapper-content" class="clearfix">

			<?php
			/**
			 **/
			do_action('g5plus_main_wrapper_content_start');
			?>
