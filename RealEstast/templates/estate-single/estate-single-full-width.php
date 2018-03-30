<?php global $post;
global $pgl_options;
$isShowCase = false;
if($pgl_options->option('estate_system_type')=='showcase'){
	$isShowCase = true;
}
?>
<div class="col-md-12 col-sm-12">
	<div class="property_detail">
		<?php
		if (have_posts()) : while (have_posts()) : the_post();
			?>
            <section class="slider-detail">
                <?php
                $main_image_html = '';
                $small_thumbnail_html = '';
                $thumbnail_id = get_post_thumbnail_id();
                $gallery = get_post_meta($post->ID, '_estate_image_gallery', TRUE);
                $gallery = json_decode($gallery);
                if ( is_null( $gallery ) ) {
                    $gallery = array();
                }
                if ($thumbnail_id) {
                    $item          = new stdClass();
                    $item->item_id = $thumbnail_id;
                    $item->type    = 'image';
                    array_unshift($gallery, $item);
                } else {
                    $featured_video_url = get_post_meta($post->ID, 'estate_featured_video', TRUE);
                    if ($featured_video_url) {
                        $type            = PGL_Utilities::__video_url_type($featured_video_url);
                        $item            = new stdClass();
                        $item->item_id   = PGL_Utilities::video_id($type['type'], $featured_video_url);
                        $item->type      = $type['type'];
                        $item->thumbnail = get_post_meta( $post->ID, 'estate_featured_video_thumbnail_url', TRUE);
                        array_unshift($gallery, $item);
                    }
                }

                //todo add video to slider
                if (!empty($gallery)) {
                    $i = 0;
                    $size = PGL_Image::size('estate-detail-thumbnail');

                    foreach ($gallery as $item) {
                        $i++;
                        switch ($item->type) {
                            case 'image':
                            {
                                list($thumbnail_url) = wp_get_attachment_image_src($item->item_id, PGL_Image::_size('estate-respond-thumbnail'));
                                list($big_thumbnail) = wp_get_attachment_image_src($item->item_id, 'full');
                                list($small_thumb_url) = wp_get_attachment_image_src($item->item_id, PGL_Image::_size('estate-detail-small-thumbnail'));
                                $main_image_html .= '<a class="estate-single-gallery" href="'.$big_thumbnail.'" data-lightbox-gallery="estate-gallery" data-lightbox-type="ajax"><img class="lazyOwl" data-src="' . $thumbnail_url . '" /></a>';
                                //$main_image_html .= $link;
                                $small_thumbnail_html .= '<a href="javascript:void(0)"><img class="img-responsive" src="' . $small_thumb_url . '" /></a>';
                                break;
                            }

                            case 'youtube':
                            {
                                $main_image_html .= '<iframe class="youtube-player" id="player_'.$i.'" src="http://www.youtube.com/embed/'.$item->item_id.'" width="'.$size['width'].'" height="'.$size['height'].'" webkitAllowFullscreen mozallowfullscreen allowFullScreen></iframe>';
                                $small_thumbnail_html .= '<a href="javascript:void(0)"><img src="'.$item->thumbnail.'" /></a>';
                                break;
                            }

                            case 'vimeo':
                            {
                                $main_image_html .= '<iframe class="vimeo-player" id="player_'.$i.'" src="http://player.vimeo.com/video/'.$item->item_id.'?color=ffffff" width="'.$size['width'].'" height="'.$size['height'].'" webkitAllowFullscreen mozallowfullscreen allowFullScreen></iframe>';
                                $small_thumbnail_html .= '<a href="javascript:void(0)"><img src="'.$item->thumbnail.'" /></a>';
                                break;
                            }
                        }
                    }

                    if ( count($gallery) == 1 ) {
                        $small_thumbnail_html = '';
                    }

                    ?>
                    <div id="pic-detail" class="owl-carousel">
                        <?php echo $main_image_html; ?>
                    </div>
                    <div id="pic-control" class="owl-carousel">
                        <?php echo $small_thumbnail_html; ?>
                    </div>
                <?php
                }
                ?>
            </section>
			<div class="infotext-detail">
				<h3><?php the_title(); ?></h3>
				<span class="price">
					<?php
					echo PGL_Addon_Estate::format_price(get_post_meta($post->ID, 'estate_price', TRUE));
					?>
				</span>
				<div class="row title-info">
					<?php if(!$isShowCase):?>
						<div class="col-sm-6 col-md-6">
	                            <span class="line-top">
                                <?php _e('Purpose', PGL) ?>
		                            <span><?php echo get_post_meta( $post->ID, 'estate_purpose', TRUE )=="sale"?__('Sale', PGL):__('Rent', PGL); ?></span>
								</span>
						</div>
					<?php endif;?>
					<div class="col-sm-6 col-md-6">
	                            <span class="line-top">
                                <?php _e('Type', PGL); ?>:
								<span><?php echo get_the_term_list($post->ID, 'estate-type', '', ', '); ?></span>
	                            </span>
					</div>
					<div class="col-sm-6 col-md-6">
	                            <span class="line-top">
                                <?php _e('Location', PGL) ?>
		                            <span>
									<?php echo get_the_term_list($post->ID, 'estate-location', '', ' ') ?>
								</span>
								</span>
					</div>
					<?php
					$agent_id = get_post_meta($post->ID,'agent_id', true);
					if ( $agent_id ) :?>
						<div class="col-sm-6 col-md-6">
	                            <span class="line-top">
		                        <?php _e('Agent', PGL);?>
		                            <span>
                                    <?php echo '<a href="'.get_permalink($agent_id).'">'.get_the_title($agent_id).'</a>';?>
		                        </span>
		                        </span>
						</div>
					<?php endif;?>
					<?php
					$fields_html = PGL_Addon_Estate::display_default_fields();
					echo apply_filters('estate/single/fields', $fields_html);
					?>
				</div>
				<div class="excerpt">
					<?php the_content() ?>
				</div>
                <?php
                if(get_post_meta($post->ID, 'estate_map_pos', TRUE) == 'main'):
                    $coordinates = get_post_meta($post->ID, 'estate_coordinates', TRUE);
                    if ($coordinates) : ?>
                        <div id="estate_map" style="width: 100%;height: 300px;">
                            <?php PGL_Addon_Estate::estate_map($coordinates) ?>
                        </div>
                    <?php
                    endif;
                endif;
                ?>
			</div>
		<?php endwhile;endif; ?>
	</div>
</div>
<script type="text/javascript">
    jQuery(function($){
        $('.has-tooltip').tooltip();
        $('a.estate-single-gallery').nivoLightbox();
    });
</script>