<?php
/**
 * Draws works slider
 */
class ctWorksSliderShortcode extends ctShortcodeQueryable {

	protected $ok = false;

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Works slider';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'works_slider';
	}

	public function enqueueScripts() {
		wp_register_script('ct-flex-slider', CT_THEME_ASSETS . '/js/jquery.flexslider-min.js');
		wp_enqueue_script('ct-flex-slider');
		wp_register_script('ct-lightbox', CT_THEME_ASSETS . '/js/lightbox-2.6.min.js');
		wp_enqueue_script('ct-lightbox');
	}


	/**
	 * Adds dynamically slider so that ajax call will already have it
	 */
	protected function enqueueAjaxScripts() {
		wp_enqueue_script('ct-bx-slider', CT_THEME_ASSETS . '/js/jquery.bxslider.min.js');
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

		$rows = (is_numeric($rows) && $rows > 0) ? $rows : 2;
		$counter = 1;
		$html = '';
		foreach ($recentposts as $p) {
			$html .= ($counter == 1) ? '<li><ul class="row-fluid">' : '';

			if (!has_post_thumbnail($p->ID) && has_portfolio_second_featured_image($p->ID)){
				$imgsrc =  ct_get_portfolio_featured_image_single($p->ID,  'featured-image-portfolio-single', 'thumb_work_slide');
			}else{
				$imgsrc =  ct_get_feature_image_src($p->ID, 'thumb_work_slide');
			}



			$link = $reload == 'false' ? (add_query_arg('ctWorkAjax', '1', get_permalink($p))) : get_permalink($p);
			$html .= '<li class="span4"><a href="' . $link . '"><img src="' . $imgsrc . '" alt=""></a></li>';

			$indexes = array();
			$max = $rows - 1;
			for ($i = 1; $i <= $max; $i++) {
				$idx = 3 * $i;
				$indexes[$idx] = true;
			}
			$html .= (isset($indexes[$counter])) ? '</ul><ul class="row-fluid">' : '';

			$html .= ($counter == (3 * $rows)) ? '</ul></li>' : '';
			$counter++;
			$counter = ($counter < (3 * $rows + 1)) ? $counter : 1;
		}
		if ($counter != 1) {
			$html .= ($counter < (3 * $rows)) ? '</ul></li>' : '';
		}

		$this->addInlineJS($this->getInlineJS());
		$id = $reload == 'false' ? 'CTWork' : '';

		//load additional different gallery
		if ($reload == 'false') {
			$this->enqueueAjaxScripts();
		}

		$preDiv = $reload == 'false' ? '<div class="container">' : '';
		$postDiv = $reload == 'false' ? '</div>' : '';
		return do_shortcode('<div'.$this->buildContainerAttributes(array('id'=>$id,'class'=>array('work')),$atts).'>
								' . $preDiv . '
								<section class="preview flexslider row-fluid">
					                <ul class="slides span12">'
			. $html .
			'</ul>
		</section>
		 <section class="full-view row-fluid">
			<!-- Work details are loaded here with Ajax from external html files -->
		</section>
		' . $postDiv . '
					        </div>
					        ');
	}

	protected function getInlineJS() {
		return '
		jQuery(window).load(function () {
			jQuery(".work .flexslider").flexslider({slideshow: false, smoothHeight: true});
		    jQuery(".work .flexslider .slides li:first-child").addClass("flex-active-slide").css({"display": "list-item"});
		    });
    ';

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
			'reload' => array('label' => __('reload', 'ct_theme'), 'type' => "checkbox", 'default' => 'false', 'help' => __('Reload page to show work details?', 'ct_theme')),
			'rows' => array('label' => __('rows', 'ct_theme'), 'default' => 2, 'type' => 'input', 'help' => __("Number of rows per slide", 'ct_theme')),
		));

		if (isset($atts['cat'])) {
			unset($atts['cat']);
		}
		return $atts;
	}
}

new ctWorksSliderShortcode();