<?php
/**
 * Template Name: Intro Page
 */
?>
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

		<?php if ((!isset($_POST["ajaxReq"]) || $_POST["ajaxReq"] != 'yes') && flow_elated_options()->getOptionValue('show_back_button') == "yes") { ?>
			<a id='eltd-back-to-top'  href='#'>
				<span class="eltd-icon-stack"></span>
				<span class="eltd-back-to-top-text"><?php esc_html_e('Top', 'flow'); ?></span>
				<span class="arrow_carrot-up eltd-back-to-top-arrow"></span>
			</a>
		<?php } ?>

		<div class="eltd-content">
			<div class="eltd-content-inner">
				<div class="eltd-full-width">
					<div class="eltd-full-width-inner">

						<div class="eltd-landing-upper-section">
							<div class="eltd-landing-wrapper clearfix">
								<div class="eltd-landing-text-holder">
									<div class="eltd-landing-logo">
										<img src="/landing-files/img/logo.png" alt="Flow Logo">
									</div>
									<p>An innovative blog theme with amazing Ajax functionality, an exciting new way of opening and loading blog posts, a large collection of awesome blog templates, and so much more.</p>
									<?php
									echo flow_elated_get_button_html(array(
										'text' => 'Purchase Now',
										'link' => 'http://themeforest.net/item/flow-a-fresh-creative-blog-theme/14484409'
									));
									?>
								</div>
								<div class="eltd-landing-banner-image">
									<a href="http://flow.elated-themes.com/" target="_blank">
										<img src="/landing-files/img/1.jpg" alt="Original Flow">
									</a>
									<div class="eltd-landing-banner-flash">
										<h5>Perfect Fullscreen Layout</h5>
									</div>
								</div>
							</div>
						</div>

						<div class="eltd-landing-bottom-section">
							<div class="eltd-landing-wrapper">
								<div class="eltd-items-wrapper clearfix">


									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/" target="_blank">
													<img src="/landing-files/img/2.jpg" alt="Flow Demo">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/" target="_blank">Original Flow</a>
											</h3>
										</div>
									</div>


									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow2/" target="_blank">
													<img src="/landing-files/img/5.jpg" alt="Masonry Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow2/" target="_blank">Masonry Flow</a>
											</h3>
										</div>
									</div>

									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow2/creative-flow/" target="_blank">
													<img src="/landing-files/img/4.jpg" alt="Creative Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow2/creative-flow/" target="_blank">Creative Flow</a>
											</h3>
										</div>
									</div>

									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow3/" target="_blank">
													<img src="/landing-files/img/8.jpg" alt="Wide Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow3/" target="_blank">Wide Flow</a>
											</h3>
										</div>
									</div>

									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow1/" target="_blank">
													<img src="/landing-files/img/6.jpg" alt="Waterfall Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow1/" target="_blank">Waterfall Flow</a>
											</h3>
										</div>
									</div>


									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow1/carousel-flow/" target="_blank">
													<img src="/landing-files/img/7.jpg" alt="Carousel Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow1/carousel-flow/" target="_blank">Carousel Flow</a>
											</h3>
										</div>
									</div>


									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow1/inline-flow/" target="_blank">
													<img src="/landing-files/img/3.jpg" alt="Inline Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow1/inline-flow/" target="_blank">Inline Flow</a>
											</h3>
										</div>
									</div>



									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow1/slider-flow/" target="_blank">
													<img src="/landing-files/img/9.jpg" alt="Slider Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow1/slider-flow/" target="_blank">Slider Flow</a>
											</h3>
										</div>
									</div>


									<div class="eltd-landing-item">
										<div class="eltd-landing-item-image">
											<div class="eltd-landing-item-image-inner">
												<a href="http://flow.elated-themes.com/flow1/split-flow/" target="_blank">
													<img src="/landing-files/img/10.jpg" alt="Split Flow">
												</a>
											</div>
										</div>
										<div class="eltd-landing-item-title">
											<h3>
												<a href="http://flow.elated-themes.com/flow1/split-flow/" target="_blank">Split Flow</a>
											</h3>
										</div>
									</div>


								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="eltd-landing-footer">
	<img src="/landing-files/img/logo.png" alt="Flow Logo">
	<p>&copy; Elated Themes, All Rights Reserved.</p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
