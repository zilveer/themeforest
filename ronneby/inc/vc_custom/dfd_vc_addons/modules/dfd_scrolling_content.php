<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_Scrolling_Content")){
	class Dfd_Scrolling_Content{
		
		function __construct(){
			add_action('init', array($this, 'dfd_scrolling_content_init'));
			add_shortcode('dfd_scrolling_content', array($this, 'dfd_scrolling_content_shortcode'));
		}
		
		function dfd_scrolling_content_init(){
			if(function_exists("vc_map")){
				new dfd_hide_unsuport_module_frontend("scroll_content_block");
				vc_map(
					array(
						"name" => __('Scrolling content blocks', 'dfd'),
						'base' => "dfd_scrolling_content",
						'icon' => "ultimate_carousel",
						'class' => "ultimate_carousel scroll_content_block",
						'as_parent' => array('except' => 'vc_gmaps'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 2.0','dfd'),
						'description' => '',
						'params' => array(
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Animated background color', 'dfd'),
								'param_name' => 'background_color',
								'value' => '#b09991',
								'description' => __('Give it a nice paint!', 'dfd'),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('','dfd'),
						  	),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
			}
		}
		
		function dfd_scrolling_content_shortcode($atts, $content){
			if(dfd_show_unsuport_nested_module_frontend("Scrolling content blocks")) return false;
			$background_color = $el_class = '';
			
			extract(shortcode_atts(array(
				'background_color' => '',
				'el_class' => ''
			),$atts));
			
			if($background_color == '') {
				$background_color = '#b09991';
			}
			
			$animation_color_styles = '<style type="text/css">'
					. '.dfd-full-screen-scroll-content .dfd-animate-before > div,'
					. '.dfd-full-screen-scroll-content .dfd-animate-after > div {'
					. 'border-color:'.$background_color.''
					. '}'
					. '.dfd-full-screen-scroll-content .dfd-animate-before > div:before,'
					. '.dfd-full-screen-scroll-content .dfd-animate-before > div:after,'
					. '.dfd-full-screen-scroll-content .dfd-animate-after > div:before,'
					. '.dfd-full-screen-scroll-content .dfd-animate-after > div:after {background:'.$background_color.''
					. '}'
					. '</style>';
			
			
			ob_start();
			$uniqid = uniqid(rand());
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-full-screen-scroll-content '.esc_attr($el_class).'">';
				echo do_shortcode($content);
			echo '</div>';
			?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$(window).load(function() {
						if (!Modernizr.touch) {
							var $window = $(window), windowWidth, windowHeight, containerHeight, offsetCoords, topOffset, leftOffset, windowScrollTop, heightOffset, scrollDirection, lastScroll, animationSize = 0;
							var $container = $('#<?php echo esc_js($uniqid); ?>');
							var $bg_element = $container.parents('.vc-row-wrapper').find('> div:not(.row)');
							$container.parents('.vc-row-wrapper').css('overflow', 'hidden');

							$container.prepend('<div class="dfd-animate-before"></div>');
							$container.append('<div class="dfd-animate-after"></div>');
							$container.find('>div').wrapInner('<div class="dfd-vertical-aligned"></div>');

							$('head').append('<?php echo $animation_color_styles; ?>');

							var recalcValues = function() {
								offsetCoords = $container.offset();
								topOffset = offsetCoords.top;
								leftOffset = offsetCoords.left;

								heightOffset = 0;

								if($('body').hasClass('admin-bar')) {
									heightOffset = $('#wpadminbar').outerHeight();
								}

								windowWidth = $window.width();
								windowHeight = $window.height() - heightOffset;
								animationSize = Math.max(windowWidth, windowHeight);

								$container.find('>div').css({
									height: windowHeight,
									minHeight: windowHeight
								});

								if($bg_element.length > 0) {
									$bg_element.addClass('dfd-parallax-bg-container').css({
										height: windowHeight,
										width: windowWidth
									});
								}
								containerHeight = $container.height();
							};
							recalcValues();
							var recalcWindowOffset = function() {
								windowScrollTop = $window.scrollTop();

								if(lastScroll > windowScrollTop) {
									scrollDirection = 'from-bottom';
								} else {
									scrollDirection = 'from-top';
								}

								lastScroll = windowScrollTop;

								$container.find('.dfd-animate-before, .dfd-animate-after').css({
									width: windowWidth,
									marginLeft: -leftOffset
								}).find('>div').attr('class', scrollDirection);

								/* Animation at the top of the module */
								if(
									((windowScrollTop) > (topOffset - windowHeight / 2)) &&
									((windowScrollTop) < (topOffset + windowHeight)) &&
									$container.find('.dfd-animate-before >div').hasClass('from-top')
								) {
									/* scrolling down */
									$container.find('.dfd-animate-before >div').css({
										width: '100px',
										height: '100px'
									}).stop().css({
										width: animationSize * 1.5,
										height: animationSize * 1.5
									});
								}
								if(
									((windowScrollTop) > (topOffset - windowHeight)) &&
									((windowScrollTop) < (topOffset - windowHeight / 2)) &&
									$container.find('.dfd-animate-before >div').hasClass('from-bottom')
								) {
									/* scrolling up */
									$container.find('.dfd-animate-before >div').css({
										width: animationSize * 1.5,
										height: animationSize * 1.5
									}).stop().css({
										width: '100px',
										height: '100px'
									});
								}
								/* Animation at the bottom of the module */
								if(
									((topOffset + containerHeight - windowHeight * 0.75) < windowScrollTop) &&
									((topOffset + containerHeight + windowHeight / 4) > windowScrollTop) &&
									$container.find('.dfd-animate-after >div').hasClass('from-top')
								) {
									/* scrolling down */
									$container.find('.dfd-animate-after >div').css({
										width: animationSize * 1.5,
										height: animationSize * 1.5
									}).stop().css({
										width: '100px',
										height: '100px'
									});
								}
								if(
									((topOffset + containerHeight - windowHeight / 3) > windowScrollTop) &&
									((topOffset + containerHeight - windowHeight) < windowScrollTop) &&
									$container.find('.dfd-animate-after >div').hasClass('from-bottom')
								) {
									/* scrolling up */
									$container.find('.dfd-animate-after >div').css({
										width: '100px',
										height: '100px'
									}).stop().css({
										width: animationSize * 1.5,
										height: animationSize * 1.5
									});
								}

								if (
									((windowScrollTop) > (topOffset)) &&
									((topOffset + containerHeight - windowHeight) > windowScrollTop)
								) {
									$bg_element.addClass('active').css({
										position: 'fixed',
										top: heightOffset
									});
								} else {
									$bg_element.removeClass('active').css('position', 'absolute');
								}

								if((windowScrollTop) < (topOffset + heightOffset)) {
									$bg_element.css({
										top: 0,
										bottom: 'auto'
									});
								}

								if((topOffset + containerHeight - windowHeight) < windowScrollTop) {
									$bg_element.css({
										bottom: 0,
										top: 'auto'
									});
									$container.find('.dfd-animate-after').addClass('in-view');
								} else {
									$container.find('.dfd-animate-after').removeClass('in-view');
								}
							};
							recalcWindowOffset();
							$window.on('scroll resize', recalcWindowOffset);
							$window.on('load resize', recalcValues);
						}
					});
				})(jQuery);
			</script>
            <?php
			return ob_get_clean();
		}
	}
	new Dfd_Scrolling_Content;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_scrolling_content extends WPBakeryShortCodesContainer {
		}
	}
}