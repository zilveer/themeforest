<?php
$output = $title =  $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $partial_view = '';
$mode = $slides_per_view = $wrap = $autoplay = $hide_pagination_control = $hide_prev_next_buttons = $speed ='';
extract(shortcode_atts(array(
    'title' => '',
    'onclick' => 'link_image',
    'custom_links' => '',
    'custom_links_target' => '',
    'img_size' => 'thumbnail',
    'images' => '',
    'el_class' => '',
    'mode' => 'horizontal',
    'slides_per_view' => '1',
    'wrap' => '',
    'autoplay' => '',
    'hide_pagination_control' => '',
    'hide_prev_next_buttons' => '',
    'speed' => '5000',
    'partial_view' => ''
), $atts));
$gal_images = '';
$link_start = '';
$link_end = '';
$el_start = '';
$el_end = '';
$slides_wrap_start = '';
$slides_wrap_end = '';

wp_enqueue_script('vc_carousel_js');
wp_enqueue_style('vc_carousel_css');
if ( $onclick == 'link_image' ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );
}

$el_class = $this->getExtraClass($el_class);

if ( $images == '' ) $images = '-1,-2,-3';

if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }

$images = explode( ',', $images);
$i = -1;
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element'.$el_class.' clearfix', $this->settings['base']);
$carousel_id = 'vc-images-carousel-'.WPBakeryShortCode_VC_images_carousel::getCarouselIndex();
$slider_width = $this->getSliderWidth($img_size);
?>
<div class="<?php echo apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base']) ?>">
    <div class="image_carousel_wrapper">
        <?php echo  wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_gallery_heading')) ?>
        <div id="<?php echo $carousel_id ?>" data-ride="vc-carousel" data-wrap="<?php echo $wrap==='yes' ? 'true' : 'false' ?>" style="width: <?php echo $slider_width ?>;" data-interval="<?php echo $autoplay == 'yes' ? $speed : 0 ?>" data-auto-height="yes" data-mode="<?php echo $mode ?>" data-partial="<?php echo $partial_view === 'yes' ? 'true' : 'false' ?>" data-per-view="<?php echo $slides_per_view ?>" data-hide-on-end="<?php echo $autoplay == 'yes' ? 'false' : 'true' ?>" class="vc-slide vc-carousel">
            <?php if($hide_pagination_control!=='yes'): ?>
            <!-- Indicators -->
            <ol class="vc-carousel-indicators">
                <?php for($z=0; $z<count($images); $z++): ?>
                <li data-target="#<?php echo $carousel_id ?>" data-slide-to="<?php echo $z ?>"></li>
                <?php endfor; ?>
            </ol>
            <?php endif; ?>
            <!-- Wrapper for slides -->
            <div class="vc-carousel-inner">
                <div class="vc-carousel-slideline"><div class="vc-carousel-slideline-inner">
                    <?php foreach($images as $attach_id): ?>
                    <?php
                    $i++;
                    if ($attach_id > 0) {
                        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
                    }
                    else {
                        $different_kitten = 400 + $i;
                        $post_thumbnail = array();
                        $post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/'.$different_kitten.'/300" />';
                        $post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
                    }
                    $thumbnail = $post_thumbnail['thumbnail'];
                    ?>
                    <div class="vc-item"><div class="vc-inner">
                    <?php if ($onclick == 'link_image'): ?>
                        <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                        <a class="prettyphoto" href="<?php echo $p_img_large[0] ?>" <?php echo ' rel="prettyPhoto[rel-'.rand().']"' ?>>
                            <?php echo $thumbnail ?>
                        </a>
                    <?php elseif($onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != ''): ?>
                        <a href="<?php echo $custom_links[$i] ?>"<?php echo (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') ?>>
                            <?php echo $thumbnail ?>
                        </a>
                    <?php else: ?>
                        <?php echo $thumbnail ?>
                    <?php endif; ?>
                    </div></div>
                    <?php endforeach; ?>
                </div></div>
            </div>
            <?php if($hide_prev_next_buttons !== 'yes'): ?>
            <!-- Controls -->
            <a class="vc-left vc-carousel-control" href="#<?php echo $carousel_id ?>" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="vc-right vc-carousel-control" href="#<?php echo $carousel_id ?>" data-slide="next">
                <span class="icon-next"></span>
            </a>
            <?php endif; ?>
        </div>
    </div><?php echo $this->endBlockComment('.wpb_wrapper') ?>
</div><?php echo $this->endBlockComment('.wpb_images_carousel') ?>

<script>

	jQuery(window).resize(function(){
		var $this = jQuery('.vc-carousel-slideline'),
			w = $this.closest('.image_carousel_wrapper').width() * $this.find('.vc-item').length;

		$this.width(w);
	});
</script>