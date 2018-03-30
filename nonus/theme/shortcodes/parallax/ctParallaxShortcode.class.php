<?php
/**
 * Parallax shortcode
 */
class ctParallaxShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Parallax';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'parallax';
	}

	/**
	 * Returns shortcode type
	 * @return mixed|string
	 */

	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}

	public function enqueueScripts() {
		wp_register_script('ct-parallax', CT_THEME_ASSETS . '/js/jquery.parallax-1.1.3.js');
		wp_enqueue_script('ct-parallax');
		wp_register_script('ct-viewport', CT_THEME_ASSETS . '/js/jquery.viewport.min.js');
		wp_enqueue_script('ct-viewport');
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

		$id = $id ? $id : ('section' . rand(100, 1000));
		$id = $type == 'main' ? 'MainHeader' : $id;
		$this->addInlineJS($this->getInlineJS($id, $attributes));

		$darktextHtml = $darktext == "true" ? 'darkText' : '';


		if($type == 'main'){
			$cParams = array(
				'id'=>"MainHeader",
				'class'=>array('main-header','parallax',$class,$darktextHtml),
				'style'=>'background-image: url(' . $imgsrc . ')'
			);
			return do_shortcode('<header'.$this->buildContainerAttributes($cParams,$atts).'>
							            ' . $content .'
								</header>');
		}else{
			$cParams = array(
				'id'=>$id,
				'class'=>array('parallax',$class,$darktextHtml),
				'style'=>'background-image: url(' . $imgsrc . ')'
			);
			return do_shortcode('<section'.$this->buildContainerAttributes($cParams,$atts).'>
							            ' . $content .'
								</section>');
		}


	}

	/**
	 * zwraca js
	 * @return string
	 */
	protected function getInlineJS($idraw, $attributes){
		extract($attributes);

        if($type == 'main'){
            return 'jQuery(window).load(function () {
                    /* parallax effect */
		            jQuery("#MainHeader").parallax("' . $xposition . '", ' . $speed . ', ' . $outerheight . ');
				});
				jQuery(window).resize(function () {
				    setTimeout(function () {
				        jQuery("#MainHeader").parallax("' . $xposition . '", ' . $speed . ', ' . $outerheight . ');
				    }, 500);
				});
				';
        }else{
            return 'jQuery(window).load(function () {
                    /* parallax effect */
		            jQuery("#' . $idraw . '").parallax("' . $xposition . '", ' . $speed . ', ' . $outerheight . ');
				});
				jQuery(window).resize(function () {
				    setTimeout(function () {
				        jQuery("#' . $idraw . '").parallax("' . $xposition . '", ' . $speed . ', ' . $outerheight . ');
				    }, 500);
				});
				';
        }
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'type' => array('label' => __('type', 'ct_theme'), 'default' => 'simple', 'type' => 'select', 'choices' => array("simple" => __("simple", "ct_theme"), "main" => __("main", "ct_theme")), 'help' => __('Type of the parallax. You can use only one "main" parallax on single page.', 'ct_theme')),
			'id' => array('label' => __('header id', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("html id attribute (used only for simple type parallax)", 'ct_theme')),
			'class' => array('label' => __('class', 'ct_theme'), 'default' => '', 'type' => 'input', 'help' => __("Parallax container additional class", 'ct_theme')),
			'xposition' => array('label' => __('x position', 'ct_theme'), 'default' => '20%', 'type' => 'input', 'help' => __('Horizontal position of the element', 'ct_theme')),
			'speed' => array('label' => __('speed', 'ct_theme'), 'default' => '0.2', 'type' => 'input', 'help' => __('speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling', 'ct_theme')),
			'outerheight' => array('label' => __('outer height', 'ct_theme'), 'default' => 'true', 'type' => 'select', 'choices' => array("true" => __("true", "ct_theme"), "false" => __("false", "ct_theme")), 'help' => __('Whether or not jQuery should use its outerHeight option to determine when a section is in the viewport', 'ct_theme')),
			'imgsrc' => array('label' => __("source", 'ct_theme'), 'default' => '', 'type' => 'image', 'help' => __("Image", 'ct_theme')),
			'darktext' => array('label' => __('dark text', 'ct_theme'), 'default' => 'false', 'type' => 'checkbox', 'help' => __("Use dark font?", 'ct_theme')),
			'content' => array('label' => __('content', 'ct_theme'), 'default' => '', 'type' => "textarea"),
		);
	}
}

new ctParallaxShortcode();