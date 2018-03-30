<?php
/**
 * Native WP Gallery shortcode
 */
class ctGalleryShortcode extends ctShortcode {

	/**
	 * Returns name
	 * @return string|void
	 */
	public function getName() {
		return 'Gallery';
	}

	/**
	 * Shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'gallery';
	}

	/**
	 * Shortcode type
	 * @return string
	 */
	public function getShortcodeType() {
		return self::TYPE_SHORTCODE_ENCLOSING;
	}

	/**
	 * Add styles
	 */

	public function enqueueHeadScripts() {
		wp_register_style('ct-pretty-photo-css', CT_THEME_ASSETS . '/css/prettyPhoto.css');
		wp_enqueue_style('ct-pretty-photo-css');
	}

	public function enqueueScripts() {
		wp_register_script('ct-pretty-photo', CT_THEME_ASSETS . '/js/jquery.prettyPhoto.js');
		wp_enqueue_script('ct-pretty-photo');
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return string
	 */

	public function handle($atts, $content = null) {
		extract(shortcode_atts($this->extractShortcodeAttributes($atts), $atts));

		global $post;

		 $imageArgs = array(
		  'post_type' => 'attachment',
		  'post_mime_type' => 'image',
		  'numberposts' => -1,
		  'orderby' => 'menu_order',
		  'order' => 'ASC',
		  'post_status' => null,
		  'post_parent' => $postid ? $postid : $post->ID
		 );

		$idsOrder = array();
		 if ($ids) {
		    unset($imageArgs['post_parent']);
			$ids = str_replace(' ', '', $ids);
		    $imageArgs['include'] = $ids;
			$idsOrder = explode(',', $ids);
		 }

		 $attachments = get_posts($imageArgs);

		//make the order
		$indexed = array();
		foreach ($attachments as $attachment) {
			$indexed[$attachment->ID] = $attachment;
		}

		if($idsOrder){
			$final = array();
			foreach($idsOrder as $id){
				if(isset($indexed[$id])){
					$final[] = $indexed[$id];
				}
			}
		}else{
			$final = $indexed;
		}

		$galleryThumbName = 'gallery_thumb_3';
		switch($columns){
			case 2:
				$spanClass = 'span6';
				$galleryThumbName = 'gallery_thumb_2';
				break;
			case 3:
				$spanClass = 'span4';
				$galleryThumbName = 'gallery_thumb_3';
				break;
			case 4:
				$spanClass = 'span3';
				$galleryThumbName = 'gallery_thumb_4';
				break;
			case 6:
				$spanClass = 'span2';
				$galleryThumbName = 'gallery_thumb_6';
				break;
			default:
				$spanClass = 'span4';
				$columns = 3;
		}

		//1,53333

		$counter = 1;
		$html = '';
		$id = rand(100, 1000);
		foreach ($final as $attachment) {
			$html .= $counter == 1 ? '<div class="row-fluid">' : '';
			$galleryThumb = wp_get_attachment_image_src($attachment->ID, $galleryThumbName);
			$caption = $attachment->post_excerpt ? '<div class="caption">' . $attachment->post_excerpt . '</div>' : '';

			//colorbox
			$preLink = $colorbox == 'yes' ? '<a href="' . $attachment->guid . '" rel="prettyPhoto[gallery' . $id . ']" title="' . $attachment->post_excerpt . '">' : '';
			$postLink = $colorbox == 'yes' ? '</a>' : '';

			$html .= '<div class="' . $spanClass . '">
                            ' . $preLink . '
                            <img src="' . $galleryThumb[0] . '" alt="' . $attachment->post_excerpt . '">
                            ' . $postLink . '
                            ' . $caption . '
                    </div>';

			$html .= $counter == $columns ? '</div>' : '';
			$counter = $counter == $columns ? 1 : $counter + 1;
		}
		$html .= $counter == 1 ? '' : '</div>';

		$this->addInlineJS($this->getInlineJS());
		return $html;
	}

	protected function getInlineJS(){
		return 'jQuery(document).ready(function(){
		        jQuery("a[rel^=' . "'prettyPhoto'" . ']").prettyPhoto({
		            markup: ' . "'" . '<div class="pp_pic_holder"> \
								<div class="ppt">&nbsp;</div> \
								<div class="pp_content_container"> \
									<div class="pp_content"> \
										<div class="pp_loaderIcon"></div> \
										<div class="pp_fade"> \
											<a href="#" class="pp_expand" title="Expand the image">Expand</a> \
											<div class="pp_hoverContainer"> \
												<a class="pp_next" href="#">next</a> \
												<a class="pp_previous" href="#">previous</a> \
											</div> \
											<div id="pp_full_res"></div> \
											<div class="pp_details"> \
												<div class="pp_nav"> \
													<a href="#" class="pp_arrow_previous">Previous</a> \
													<a href="#" class="pp_arrow_next">Next</a> \
													<p class="currentTextHolder">0/0</p> \
													<a href="#" class="pp_expand">Expand</a>\
												</div> \
												<p class="pp_description"></p> \
												{pp_social} \
												<a class="pp_close" href="#">Close</a> \
											</div> \
										</div> \
									</div> \
								</div> \
							</div> \
							<div class="pp_overlay"></div>' . "'" . ',
		            social_tools: false
		        });
		    });';
	}

	/**
	 * Returns config
	 * @return null
	 */
	public function getAttributes() {
		return array(
			'postid' => array('label' => __('post id', 'ct_theme'), 'default' => '', 'type' => "input"),
			'ids' => array('label' => __('ids', 'ct_theme'), 'default' => '', 'type' => "input"),
			'columns' => array('label' => __('columns', 'ct_theme'), 'default' => '3', 'type' => 'select', 'choices' => array(3 => 3, 4 => 4, 6 => 6),),
			'colorbox' => array('label' => __('use colorbox?', 'ct_theme'), 'default' => 'yes', 'type' => 'select', 'options' => array('yes' => __('yes', 'ct_theme'), 'no' => __('no', 'ct_theme'))),
		);
	}
}

new ctGalleryShortcode();