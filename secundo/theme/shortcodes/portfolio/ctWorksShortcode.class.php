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
		wp_register_script('ct-easing', CT_THEME_ASSETS . '/js/jquery.easing.js');
		wp_enqueue_script('ct-easing');
		wp_register_script('ct-quicksand', CT_THEME_ASSETS . '/js/jquery.quicksand.js');
		wp_enqueue_script('ct-quicksand');
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

		//filters
		$filtersOn = $filters == "on" || $filters == "true";
		$filtersHtml = '';
		if ($filtersOn) {
			$catsListHtml = $allfilterheader ? '<li class="active"><a href="#" >' . $allfilterheader . '</a></li>' : '';

			$terms = get_terms('portfolio_category', 'hide_empty=1');
			foreach ($terms as $term) {
				$catsListHtml .= '<li data-filter="filter-' . $term->term_id . '"><a href="#">' . strtoupper($term->name) . '</a></li>';
			}

			if ($catsListHtml) {
				$filtersHtml = '<ul class="filterPortfolio"><li class="first">' . __('VIEW', 'ct_theme') . ':</li>' . $catsListHtml . '</ul><div class="clearfix"></div>';
			}
		}

		//elements
		$elements = '';
		$counter = 0;
		foreach ($recentposts as $p) {
			$counter++;
			$title = $titles == "yes" ? $p->post_title : '';
			$summary = $summaries == "yes" ? $p->post_excerpt : '';
			$imgsrc = $images == "yes" ? ct_get_feature_image_src($p->ID, 'thumbnail') : '';
			$link = get_permalink($p);

			$cats = '';
			$catsFilters = "";
			$terms = get_the_terms($p->ID, 'portfolio_category');
			if ($terms) {
				foreach ($terms as $term) {
					$catsFilters .= ("filter-" . $term->term_id . " ");
					$cats .= ($term->name . ",");
				}
				$catsFilters = substr($catsFilters, 0, -1);
				$cats = substr($cats, 0, -1);
			}
			$cats = $categories == "yes" ? $cats : '';

			$elements .= '<li class="span3" data-id="' . $counter . '" data-filter="' . $catsFilters . '">
							' . $this->embedShortcode('work', array(
				'title' => $title,
				'summary' => $summary,
				'link' => $link,
				'imgsrc' => $imgsrc,
				'categories' => $cats,
			)) . '</li>';
		}

		$html = $filtersHtml . '<div class="galleryContainer"><ul class="thumbnails galleryPortfolio clearfix" id="portfolios' . $id . '">' . $elements . '</ul></div>';
		$this->addInlineJS($this->getInlineJS($id));
		return do_shortcode($html);

	}

	/**
	 * returns JS
	 * @param $id
	 * @return string
	 */
	protected function getInlineJS($id) {
		return 'jQuery(window).load(function() {
				     	/*** Quicksand ***/
		                var p = jQuery("#portfolios' . $id . '");
		                var f = jQuery(".filterPortfolio");
		                var data = p.clone();
		                f.find("a").click(function () {
		                    var link = jQuery(this);
		                    var li = link.parents("li");
		                    if (li.hasClass("active")) {
		                        return false;
		                    }

		                    f.find("li").removeClass("active");
		                    li.addClass("active");

		                    //quicksand
		                    var filtered = li.data("filter") ? data.find("li[data-filter~=' . "'" . '" + li.data("filter") + "' . "'" . ']") : data.find("li");

		                    p.quicksand(filtered, {duration:800,
		                        easing:"easeInOutQuad"}, function () { // callback function

		                    });
		                    return false;
		                });
					});';
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
			'allfilterheader' => array('label' => __('"all filter" header', 'ct_theme'), 'default' => __('ALL', 'ct_theme'), 'type' => 'input', 'help' => __("Header for the 'show all' filter", 'ct_theme')),
			'titles' => array('label' => __('titles', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show titles?", 'ct_theme')),
			'summaries' => array('label' => __('summaries', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show excerpts?", 'ct_theme')),
			'categories' => array('label' => __('categories', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show categories?", 'ct_theme')),
			'images' => array('label' => __('images', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'choices' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme')), 'help' => __("Show images?", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorksShortcode();