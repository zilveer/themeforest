<?php
	/*
	*
	*	Styleswitcher
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/

	if (!function_exists('sf_styleswitcher')) {
		function sf_styleswitcher() {

			global $sf_options;
			$enable_styleswitcher = false;
			if ( isset($sf_options['enable_styleswitcher']) ) {
			$enable_styleswitcher = $sf_options['enable_styleswitcher'];
			}
			
			if ($enable_styleswitcher) {
				$styleswitcher_path = get_template_directory_uri() . '/includes/sf-styleswitcher/';

			?>
			<div class="style-switcher">
				<h4>Style Switcher<a class="switch-button" href="#"><i class="fa-diamond"></i></a></h4>

				<div class="switch-cont">

					<h5>Layout options</h5>
					<ul class="options layout-select">
						<li class="boxed-layout"><a class="boxed" href="#"><img src="<?php echo esc_url($styleswitcher_path); ?>page-bordered.png" alt="Boxed Layout" /></a></li>
						<li class="fullwidth-layout"><a class="fullwidth" href="#"><img src="<?php echo esc_url($styleswitcher_path); ?>page-fullwidth.png" alt="Full Width Layout" /></a></li>
					</ul>

					<h5>Header options</h5>
					<div class="options">
					<select class="header-select">
						<option value="header-4">Header 1</option>
						<option value="header-6">Header 2</option>
						<option value="header-7">Header 3</option>
						<option value="header-8">Header 4</option>
						<option value="header-vert">Vertical Header</option>
						<option value="header-vert-right">Vertical Header (Right)</option>
					</select>
					<span>NOTE: Naked header pages won't use the vertical header</span>
					</div>

					<!--<h5>Accent Color Examples</h5>
					<ul class="options color-select">
						<li><a href="#" data-color="00bff3" style="background-color: #00bff3;"></a></li>
						<li><a href="#" data-color="ff7534" style="background-color: #ff7534;"></a></li>
						<li><a href="#" data-color="7c4d9f" style="background-color: #7c4d9f;"></a></li>
						<li><a href="#" data-color="37ba85" style="background-color: #37ba85;"></a></li>
						<li><a href="#" data-color="fe504f" style="background-color: #fe504f;"></a></li>
						<li><a href="#" data-color="ffd56c" style="background-color: #ffd56c;"></a></li>
					</ul>-->
				</div>
			</div>

			<script>
				var onLoad = {
				    init: function(){

					    "use strict";

					    if (jQuery('body').hasClass('layout-boxed')) {
					    	jQuery('.boxed-layout').addClass('selected');
					    } else {
					    	jQuery('.fullwidth-layout').addClass('selected');
					    }

					    if (jQuery('#header-section').length > 0) {
					    	var currentHeader = jQuery('#header-section').attr('class').split(' ')[0];
					    	jQuery(".header-select option[value="+currentHeader+"]").prop("selected", "selected")
					    }

						jQuery('.style-switcher').on('click', 'a.switch-button', function(e) {
							e.preventDefault();
							var $style_switcher = jQuery('.style-switcher');
							if ($style_switcher.css('left') === '0px') {
								$style_switcher.animate({
									left: '-240'
								});
							} else {
								$style_switcher.animate({
									left: '0'
								});
							}
						});

						jQuery('.layout-select li').on('click', 'a', function(e) {
							e.preventDefault();
							jQuery('.layout-select li').removeClass('selected');
							jQuery(this).parent().addClass('selected');
							var selectedLayout = jQuery(this).attr('class');

							if (selectedLayout === "boxed") {
								jQuery("body").addClass('layout-boxed');
							} else {
								jQuery("body").removeClass('layout-boxed');
							}

							jQuery('.flexslider').each(function() {
								var slider = jQuery(this).data('flexslider');
								if (slider) {
								slider.resize();
								}
							});
							jQuery(window).resize();
						});

						jQuery('.header-select').change(function() {
							var baseURL = onLoad.getPathFromUrl(location.href),
								newURLParam = "?header=" + jQuery('.header-select').val();

							location.href = baseURL + newURLParam;
						});

						jQuery('.bg-select li').on('click', 'a', function(e) {
							e.preventDefault();
							var newBackground = jQuery(this).attr('data-bgimage'),
								bgType = jQuery(this).attr('class'),
								bgPath = jQuery('.bg-select').attr('data-bgpath');

							if (bgType === "cover") {
								jQuery('body').css('background', 'url('+bgPath+newBackground+') no-repeat center top fixed');
								jQuery('body').css('background-size', 'cover');
							} else {
								jQuery('body').css('background', 'url('+bgPath+newBackground+') repeat center top fixed');
								jQuery('body').css('background-size', 'auto');
							}
						});

						jQuery('.color-select li').on('click', 'a', function(e) {
							e.preventDefault();

							var selectedColor = '#' + jQuery(this).data('color');

							jQuery('.recent-post figure,span.highlighted,span.dropcap4,.flickr-widget li,.portfolio-grid li,.wpcf7 input.wpcf7-submit[type="submit"],.woocommerce nav.woocommerce-pagination ul li span.current,figcaption .product-added,.woocommerce .wc-new-badge,.yith-wcwl-wishlistexistsbrowse a,.yith-wcwl-wishlistaddedbrowse a,.woocommerce .widget_layered_nav ul li.chosen > *,.woocommerce .widget_layered_nav_filters ul li a,.sticky-post-icon,figure.animated-overlay figcaption,.sf-button.accent,.sf-button.sf-icon-reveal.accent,.progress .bar,.sf-icon-box-animated .back,.labelled-pricing-table .column-highlight .lpt-button-wrap a.accent,.progress.standard .bar,.woocommerce .order-info,.woocommerce .order-info mark,.slideout-filter ul li.selected a,.blog-aux-options li.selected a,nav#main-navigation .menu > li > a span.nav-line').css('background-color', selectedColor);
							jQuery('#copyright a,.portfolio-item .portfolio-item-permalink,.read-more-link,.blog-item .read-more,.blog-item-details a,.author-link,.comment-meta .edit-link a,.comment-meta .comment-reply a,#reply-title small a,ul.member-contact,ul.member-contact li a,span.dropcap2,.spb_divider.go_to_top a,.love-it-wrapper .loved,.comments-likes .loved span.love-count,#header-translation p a,.caption-details-inner .details span > a,.caption-details-inner .chart span,.caption-details-inner .chart i,#swift-slider .flex-caption-large .chart i,.woocommerce .star-rating span,.sf-super-search .search-options .ss-dropdown > span,.sf-super-search .search-options input,.sf-super-search .search-options .ss-dropdown ul li .fa-check,#swift-slider .flex-caption-large .loveit-chart span,#swift-slider .flex-caption-large a,.progress-bar-wrap .progress-value,.sf-icon,nav .menu li.current-menu-ancestor > a,nav .menu li.current-menu-item > a,#mobile-menu .menu ul li.current-menu-item > a').css('color', selectedColor);
							jQuery('.bypostauthor .comment-wrap .comment-avatar,a[rel="tooltip"],.sf-icon-box-animated .back').css('border-color', selectedColor);
							jQuery('.spb_impact_text .spb_call_text').css('border-left-color', selectedColor);
							jQuery('.sf-super-search .search-options .ss-dropdown > span,.sf-super-search .search-options input').css('border-bottom-color', selectedColor);

						});

				    },
				    getURLVars: function() {
				    	var vars = [], hash;
				    	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
				    	for(var i = 0; i < hashes.length; i++)
				    	{
				    	    hash = hashes[i].split('=');
				    	    vars.push(hash[0]);
				    	    vars[hash[0]] = hash[1];
				    	}
				    	return vars;
				    },
				   	getPathFromUrl: function(url) {
				      return url.split("?")[0];
				    }
				};

				jQuery(document).ready(onLoad.init);
			</script>

		<?php
			}
		}
		add_action('wp_footer', 'sf_styleswitcher');
	}
?>