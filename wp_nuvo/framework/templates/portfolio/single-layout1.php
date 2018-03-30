<?php
global $smof_data;

$gallery = cshero_get_shortcode_from_content('gallery');
$object =new stdClass();
$object->columns = '3';
$object->link = 'post';
$object->ids = array();
if($gallery){
	$object = cshero_extra_shortcode('gallery', $gallery, $object);
}
$gallery_ids = $object->ids;
$gallery_ns = $object->columns;

$gallery_ns = ( 1 / $gallery_ns ) * 100;

wp_enqueue_script( 'masonry-pkgd');
wp_register_script( 'portfolio-details-fixed', get_template_directory_uri().'/js/portfolio.details.fixed.js',array(),'1.0.0');
wp_localize_script( 'portfolio-details-fixed', 'portfolio', array('ns'=>$gallery_ns));
wp_enqueue_script( 'portfolio-details-fixed' );

//option theme
$about_title = $smof_data['portfolio_about_title'];
$show_description = $smof_data['portfolio_show_description'];
$excerpt_length = $smof_data['portfolio_excerpt_length'];
$show_custom_field = $smof_data['portfolio_show_custom_field'];
$icon_custom_field = $smof_data['portfolio_custom_field_icon'];
$text_custom_field = $smof_data['portfolio_custom_field_title'];
$show_date = $smof_data['portfolio_show_date'];
$icon_date = $smof_data['portfolio_date_icon'];
$text_date = $smof_data['portfolio_date_title'];
$show_category = $smof_data['portfolio_show_category'];
$icon_category = $smof_data['portfolio_category_icon'];
$text_category = $smof_data['portfolio_category_title'];
$show_like = $smof_data['portfolio_show_like'];
$icon_like = $smof_data['portfolio_like_icon'];
$text_like = $smof_data['portfolio_like_title'];
$show_share = $smof_data['portfolio_show_share'];
$text_share = $smof_data['portfolio_share_title'];
$crop_image = false;
$width_image = 200;
$height_image = 200;
?>
<article id="cs_post_<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="main" class="cs-portfolio-item">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 cs-portfolio-details cs-scroll-fixed">
				<div id="primary-sidebar" class="cs-portfolio-meta widget-area">
					<?php if(!empty($about_title)) { ?>
						<h3><?php echo $about_title; ?></h3>
					<?php } ?>
					<?php if ($show_description == true || $show_description == 1) { ?>
						<div class="cs-portfolio-description"><?php echo substr(strip_tags(get_the_excerpt()), 0, $excerpt_length); ?></div>
					<?php } ?>
					<?php if ($show_custom_field == true || $show_custom_field == 1) { ?>
					<ul class="cs-portfolio-list-details">
					<?php
					$custom_field = get_post_meta( get_the_ID(), 'cs_custom_field', true );
					if(!empty($custom_field)) {
					?>
						<li>
							<h5><i class="<?php echo $icon_custom_field; ?>"></i> <?php echo $text_custom_field; ?></h5>
							<?php echo $custom_field; ?>
						</li>
						<?php } ?>
					<?php } ?>
					<?php if ($show_date == true || $show_date == 1) { ?>
						<li>
							<h5><i class="<?php echo $icon_date; ?>"></i> <?php echo $text_date; ?></h5>
							<?php the_date('jS F'); ?>
						</li>
					<?php } ?>
					<?php if ($show_category == true || $show_category == 1) { ?>
						<li>
							<h5><i class="<?php echo $icon_category; ?>"></i> <?php echo $text_category; ?></h5>
							<?php the_terms( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
						</li>
					<?php } ?>
					<?php if ($show_like == true || $show_like == 1) { ?>
						<li>
							<h5><i class="<?php echo $icon_like; ?>"></i> <?php echo $text_like; ?></h5>
							<?php
							 	post_favorite('','like',false);
							?>
						</li>
					<?php } ?>
					</ul>
					<?php if ($show_share == true || $show_share == 1) { ?>
						<h5 class="title-pt"></i><?php echo $text_share; ?></h5>
						<ul class="cs-social">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class=""></i></a></li>
						</ul>
					<?php } ?>
				</div>
			</div>
			<div id="cs-portfolio-media" class="col-xs-12 col-sm-9 col-md-9 col-lg-9 cs-portfolio-media">
				<?php
				if (has_post_thumbnail()){
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
					if($crop_image == true || $crop_image == 1){
						$image_resize = matthewruddy_image_resize( $attachment_image[0], $width_image, $height_image, true, false );
						echo '<div class="cs-portfolio-featured-img"><img alt="" class="attachment-featuredImageCropped" src="'. esc_attr($image_resize['url']) .'" /><span class="circle-border"></span></div>';
					}else{
					   echo '<div class="cs-portfolio-featured-img"><img alt="" src="'. esc_attr($attachment_image[0]) .'" /><span class="circle-border"></span></div>';
					}
				}
				?>
				<div class="cs-portfolio-media">
					<!-- gallery -->
					<?php
					if(!empty($gallery_ids)):
					?>
   	                <div class="gallery-portfolio">
   	                <?php foreach ($gallery_ids as $image_id): ?>
    					<?php
   	                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
   	                    if($attachment_image[0] != ''):?>
   	                    <div class="item" <?php if($gallery_ns < 100){ echo 'style="width:'.$gallery_ns.'%;"'; } ?>>
   	                    	<img <?php if($gallery_ns == 100){ echo 'width="'.$gallery_ns.'%";'; } ?> src="<?php echo esc_url($attachment_image[0]);?>"/>
   	                    </div>
   	                    <?php endif; ?>
   	                <?php endforeach; ?>
   	                </div>
					<?php endif; ?>
					<!-- video -->
					<?php
						$shortcode = cshero_get_shortcode_from_content('playlist');
						if(!$shortcode){
							$shortcode = cshero_get_shortcode_from_content('video');
						} else {
							$shortcode = cshero_get_shortcode_from_content('audio');
						}
						if($shortcode):
							echo do_shortcode($shortcode);
						endif;
					?>
				</div>
			</div>
		</div>
	</div>
</article>