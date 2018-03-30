<?php
/**
 * Draws works
 */
class ctWorksShortcode extends ctShortcodeQueryable {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Works';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'works';
	}

	public function enqueueScripts() {
		wp_register_script('ct-isotope', CT_THEME_ASSETS . '/js/jquery.isotope.min.js');
		wp_enqueue_script('ct-isotope');
		wp_register_script('ct-ba-bbq', CT_THEME_ASSETS . '/js/jquery.ba-bbq.min.js');
		wp_enqueue_script('ct-ba-bbq');
		wp_register_script('ct-colorbox', CT_THEME_ASSETS . '/js/jquery.colorbox-min.js');
		wp_enqueue_script('ct-colorbox');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		$attributes = shortcode_atts($this->extractShortcodeAttributes($atts), $atts);
		extract($attributes);

		$recentposts = $this->getCollection($attributes, array('post_type' => 'portfolio'));

		$id = rand(100, 1000);
		$this->addInlineJS($this->getInlineJS($id));

		//filters
		$filtersOn = $filters == "on" || $filters == "true";
		$filtersHtml = '';
		if ($filtersOn) {
			$catsListHtml = $allfilterheader ? '<li><a href="#filter=*" class="selected btn btn-primary btn-small">' . $allfilterheader . '</a></li>' : '';

			$terms = get_terms('portfolio_category', 'hide_empty=1');
			foreach ($terms as $term) {
				$catsListHtml .= '<li><a href="#filter=.' . $this->getCatFilterClass($term) . '" class="btn btn-primary btn-small">' . $term->name . '</a></li>';
			}

			if ($catsListHtml) {
				$filtersHtml = '<div class="row-fluid">
							        <nav class="span12">
							            <div id="IsotopeOptions" class="portfolio-filters">
							                <span>' . __('View', 'ct_theme') . ':</span>
							                <ul class="isotope-options">
							                    ' . $catsListHtml . '
							                </ul>
							            </div>
							        </nav>
							    </div>';
			}
		}

		switch ($columns) {
			case 2:
				$size = 'thumb_2_cols';
				$class = ' col2';
				break;
			case 3:
				$size = 'thumb_3_cols';
				$class = ' col3';
				break;
			default:
				$size = 'thumb_4_cols';
				$class = ' col4';
		}

		//elements
		$elements = '';
		$counter = 0;
		foreach ($recentposts as $p) {
			$counter++;
			$link = get_permalink($p);
			$title = $titles == "yes" ? '<span class="cTitle">' . $p->post_title . '</span>' : '';
			$summary = $summaries == "yes" && $p->post_excerpt ? '<p>' . $p->post_excerpt . '</p>' : '';

			$cats = '';
			$catsFilters = "";
			$terms = get_the_terms($p->ID, 'portfolio_category');
			if ($terms) {
				foreach ($terms as $term) {
					$catsFilters .= (" " . $this->getCatFilterClass($term));
					$cats .= ($term->name . ", ");
				}
				$cats = substr($cats, 0, -2);
			}
			$cats = $categories == "yes" ? '<span class="cTag">' .$cats . '</span>' : '';

			if (!has_post_thumbnail($p->ID) && has_portfolio_second_featured_image($p->ID)){
				$imgsrc = $images == "yes" ? ct_get_portfolio_featured_image_single($p->ID, $name = 'featured-image-portfolio-single', $size) : '';
			}else{
				$imgsrc = $images == "yes" ? ct_get_feature_image_src($p->ID, $size) : '';
			}



			$overlayHtml = '';

			if(($title != false)||($summary != false)||($cats != false)) {
			$overlayHtml = '<div class="cOverlay"><div class="inner">
	                            ' . $title . '
	                            ' . $cats . '
	                            ' . $summary . '
	                        </div></div>';
			}


			$elements .= '<div class="isotope-item' . $catsFilters . '">
			                    <a href="' . $link . '">
			                        <img src="' . $imgsrc . '" alt="">
			                        ' . $overlayHtml . '
			                    </a>
			                </div>';
		}

		$headerHtml = $header ? ('<h4 class="text-center">' . $header . '</h4><div class="spacer" style="height: 20px;"></div>') : '';


		$html = $headerHtml . $filtersHtml . '<div class="row-fluid">
							        <div class="span12">
							            <!-- ISOTOPE GALLERY -->
							            <div id="IsotopeContainer" class="isotope' . $class . '">
							                ' . $elements . '
							            </div>
							        </div>
							    </div>';

		return do_shortcode($html);

	}

	/**
	 * returns JS
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($id) {
		return '/* ISOTOPE */

		    jQuery(window).load(function () {
		        var $container = jQuery("#IsotopeContainer"), // object that will keep track of options
		            isotopeOptions = {}, // defaults, used if not explicitly set in hash
		            defaultOptions = {
		                filter: "*",
		                sortBy: "original-order",
		                sortAscending: true,
		                layoutMode: "masonry"
		            };


		        var setupOptions = jQuery.extend({}, defaultOptions, {
		            itemSelector: ".isotope-item",
		            masonry: {
		                // columnWidth: $container.width() / 4
		            }
		        });

		        // set up Isotope
		        $container.isotope(setupOptions);

		        var $optionSets = jQuery("#IsotopeOptions").find(".isotope-options"), isOptionLinkClicked = false;

		        // switches selected class on buttons
		        function changeSelectedLink($elem) {
		          if (!($elem === undefined)) {
		            // remove selected class on previous item
		            $elem.closest(".isotope-options").find(".selected").removeClass("selected");
		            // set selected class on new item
		            $elem.addClass("selected");
		            }

		        }


		        $optionSets.find("a").click(function () {
		            var $this = jQuery(this);
		            // dont proceed if already selected
		            if ($this.hasClass("selected")) {
		                return;
		            }
		            changeSelectedLink($this);
		            // get href attr, remove leading #
		            var href = $this.attr("href").replace(/^#/, ""), // convert href into object
		                option = jQuery.deparam(href, true);
		            // apply new option to previous
		            jQuery.extend(isotopeOptions, option);
		            // set hash, triggers hashchange on window
		            jQuery.bbq.pushState(isotopeOptions);
		            isOptionLinkClicked = true;
		            return false;
		        });


		        var hashChanged = false;

		        jQuery(window).bind("hashchange", function (event) {
		            // get options object from hash
		            var hashOptions = window.location.hash ? jQuery.deparam.fragment(window.location.hash, true) : {}, // do not animate first call
		                aniEngine = hashChanged ? "best-available" : "none", // apply defaults where no option was specified
		                options = jQuery.extend({}, defaultOptions, hashOptions, { animationEngine: aniEngine });
		            // apply options from hash
		            $container.isotope(options);
		            // save options
		            isotopeOptions = hashOptions;

		            // if option link was not clicked
		            // then well need to update selected links
		            if (!isOptionLinkClicked) {
		                // iterate over options
		                var hrefObj, hrefValue, $selectedLink;
		                for (var key in options) {
		                    hrefObj = {};
		                    hrefObj[ key ] = options[ key ];
		                    // convert object into parameter string
		                    hrefValue = jQuery.param(hrefObj);
		                    // get matching link
		                    $selectedLink = $optionSets.find("a[href=' . "'" . '#" + hrefValue + "' . "'" . ']");
		                    changeSelectedLink($selectedLink);
		                }
		            }

		            isOptionLinkClicked = false;
		            hashChanged = true;
		        })// trigger hashchange to capture any hash data on init
		            .trigger("hashchange");
		    });
		    /* ISOTOPE */';
	}


	/**
	 * creates class name for the category
	 * @param $cat
	 * @return string
	 */
	protected function getCatFilterClass($cat){
		return strtolower(str_replace(' ', '-', $cat->slug));
	}


	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_SELF_CLOSING;
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		$atts = $this->getAttributesWithQuery(array(
			'limit' => array('label' => __('limit', 'ct_theme'), 'default' => 4, 'type' => 'input', 'help' => __("Number of portfolio elements", 'ct_theme')),
			'filters' => array('label' => __('filters', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox', 'help' => __("Show filters?", 'ct_theme')),
			'allfilterheader' => array('label' => __('"all filter" header', 'ct_theme'), 'default' => __('All', 'ct_theme'), 'type' => 'input', 'help' => __("Header for the 'show all' filter", 'ct_theme')),
			'columns' => array('label' => __('columns', 'ct_theme'), 'default' => '4', 'type' => 'select', 'choices' => array('4' => '4', '3' => '3', '2' => '2'), 'help' => __("Number of columns", 'ct_theme')),
			'titles' => array('label' => __('titles', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show titles?", 'ct_theme')),
			'summaries' => array('label' => __('summaries', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show excerpts?", 'ct_theme')),
			'categories' => array('label' => __('categories', 'ct_theme'), 'default' => 'no', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show categories?", 'ct_theme')),
			'header' => array('label' => __("header text", 'ct_theme'), 'default' => '', 'type' => 'input'),
			'images' => array('label' => __('images', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show images?", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorksShortcode();