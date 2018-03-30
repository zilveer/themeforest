<?php get_header(); ?>

<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>

<?php
$thumbnail_id 		= get_post_thumbnail_id();
$image_url 			= wp_get_attachment_url( $thumbnail_id,'full');
$thumbnail_url		= aq_resize($image_url, 1170, 400, true);
if( empty($thumbnail_url) ) $thumbnail_url = $image_url;

$portfolio_option['portfolio_header_text'] 	= rwmb_meta( 'met_portfolio_header_text', array(), get_the_ID() );
$portfolio_option['show_categories'] 		= rwmb_meta( 'met_show_categories', array(), get_the_ID() );
$portfolio_option['category_list_title'] 	= rwmb_meta( 'met_category_list_title', array(), get_the_ID() );
$portfolio_option['show_tags'] 				= rwmb_meta( 'met_show_tags', array(), get_the_ID() );
$portfolio_option['tag_list_title'] 		= rwmb_meta( 'met_tag_list_title', array(), get_the_ID() );
$portfolio_option['show_socials'] 			= rwmb_meta( 'met_show_socials', array(), get_the_ID() );
$portfolio_option['socials_title'] 			= rwmb_meta( 'met_socials_title', array(), get_the_ID() );

$ga = $vi = $fi = false;
$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );

if($content_media_option == 'gallery'){
	$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'thumbnail'), get_the_ID() );
	if(count($gallery_images) > 0){
		$ga = true;

		$gallery_first = array_shift(array_values($gallery_images));
		$gallery_keys = array_keys($gallery_images);

		wp_enqueue_style('metcreative-caroufredsel');
		wp_enqueue_script('metcreative-caroufredsel');

		wp_enqueue_style('metcreative-magnific-popup');
		wp_enqueue_script('metcreative-magnific-popup');

		$slider_option['auto_play'] = rwmb_meta( 'met_slider_auto_play', array(), get_the_ID() );
		$slider_option['duration'] = rwmb_meta( 'met_slider_auto_play_duration', array(), get_the_ID() );
		$slider_option['circular'] = rwmb_meta( 'met_slider_circular', array(), get_the_ID() );
		$slider_option['infinite'] = rwmb_meta( 'met_slider_infinite', array(), get_the_ID() );
	}
}

if($content_media_option == 'video'){
	$vi = true;
	$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );
}

if( !$vi AND !$ga AND !empty($image_url) ){
	$fi = true;

	wp_enqueue_style('metcreative-magnific-popup');
	wp_enqueue_script('metcreative-magnific-popup');
}

if(!$fi){
	$thumbnail_url 	= 'http://placehold.it/570x300';
	$image_url 		= 'http://placehold.it/800x600';
}
?>

		<div class="met_content">
			<div class="row-fluid">
				<div class="span12">
					<div class="met_page_header met_bgcolor5 clearfix">
						<h1 class="met_bgcolor met_color2"><?php echo $portfolio_option['portfolio_header_text'] ?>&nbsp;</h1>
						<h2 class="met_color2"><?php the_title() ?></h2>
					</div>
				</div>
			</div>

			<div class="row-fluid portfolio_detail_preview_row">
				<div class="span12">
					<?php if($fi): ?>
						<div class="met_portfolio_item_preview_wrap clearfix">
							<a href="<?php the_permalink() ?>" class="met_portfolio_item_preview"><img src="<?php echo $thumbnail_url ?>" alt=""/></a>
							<a href="<?php echo $image_url ?>" rel="lb_<?php the_ID() ?>"  class="met_portfolio_item_preview_overlay met_bgcolor6_trans">
								<span class="met_bgcolor met_color2 met_bgcolor_transition2"><i class="icon-camera"></i></span>
							</a>
						</div>
					<?php endif; ?>

					<?php if($vi): ?>
						<iframe src="<?php echo video_url_to_embed($video_url) ?>" style="width: 100%;height: 400px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					<?php endif; ?>

					<?php if($ga): ?>
						<div class="met_portfolio_item_preview">
							<div class="met_portfolio_item_slider_wrap clearfix">
								<div id="met_portfolio_item_slider_<?php the_ID() ?>" class="met_portfolio_item_slider">
									<?php foreach($gallery_images as $gallery_image): ?>
										<?php
											$galley_image_url = aq_resize($gallery_image['full_url'], 1170, 400, true);
											if( !$galley_image_url || empty($galley_image_url) ){
												$galley_image_url = $gallery_image['full_url'];
											}
										?>
										<a href="<?php echo $gallery_image['full_url'] ?>" rel="lb_<?php the_ID() ?>"><img src="<?php echo $galley_image_url ?>" alt="<?php echo esc_attr(get_the_title()) ?>"/></a>
									<?php endforeach; ?>
								</div>
								<a href="#" class="met_portfolio_item_slider_nav_prev"><i class="icon-chevron-left"></i></a>
								<a href="#" class="met_portfolio_item_slider_nav_next"><i class="icon-chevron-right"></i></a>
							</div>
						</div>
						<script>
							jQuery(window).load(function(){
								jQuery("#met_portfolio_item_slider_<?php the_ID() ?>").carouFredSel({
									responsive: true,
									prev: { button : function(){ return jQuery(this).parents('.met_portfolio_item_slider_wrap').find('.met_portfolio_item_slider_nav_prev') } },
									next:{ button : function(){ return jQuery(this).parents('.met_portfolio_item_slider_wrap').find('.met_portfolio_item_slider_nav_next') } },
									circular: <?php echo $slider_option['circular'] ?>,
									infinite: <?php echo $slider_option['infinite'] ?>,
									auto: { play : <?php echo $slider_option['auto_play'] ?>, pauseDuration: 0, duration: <?php echo $slider_option['duration'] ?> },
									scroll: { items: 1, duration: 400, wipe: true },
									items: { visible: { min: 1, max: 1 }, width: 691 },
									width: 691
								});
							});
						</script>
					<?php endif; ?>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span3">

					<?php if($portfolio_option['show_categories'] == 'true'): ?>
					<div class="met_portfolio_service_box">
						<h3 class="met_bold_one"><?php echo $portfolio_option['category_list_title'] ?></h3>
						<?php
							$categories = wp_get_object_terms(get_the_ID(), 'portfolio_category');
							if($categories){
								foreach($categories as $category) {
									echo '<span class="met_portfolio_service">'.$category->name.'</span>';
								}
							}

						?>
					</div>
					<?php endif; ?>

					<?php if($portfolio_option['show_tags'] == 'true'): ?>
					<div class="met_portfolio_tag_box">
						<h3 class="met_bold_one"><?php echo $portfolio_option['tag_list_title'] ?></h3>
						<?php
							$tags = wp_get_object_terms(get_the_ID(), 'portfolio_tag');
							if($tags){
								foreach($tags as $tag) {
									echo '<a href="'.get_term_link($tag->slug, 'portfolio_tag').'">'.$tag->name.'</a> ';
								}
							}
						?>
					</div>
					<?php endif; ?>

					<?php if($portfolio_option['show_socials'] == 'true'): ?>
					<div class="met_portfolio_share_box">
						<h3 class="met_bold_one"><?php echo $portfolio_option['socials_title'] ?></h3>
						<a class="met_color_transition" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>"><i class="icon-facebook"></i></a>
						<a class="met_color_transition" target="_blank" href="http://twitter.com/home?status=<?php echo esc_attr(get_the_title()) ?> - <?php the_permalink() ?>"><i class="icon-twitter"></i></a>
						<a class="met_color_transition" href="javascript:void((function(){var e=document.createElement('script'); e.setAttribute('type','text/javascript'); e.setAttribute('charset','UTF-8'); e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());"><i class="icon-pinterest"></i></a>
						<a class="met_color_transition" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="icon-google-plus"></i></a>
					</div>
					<?php endif; ?>
				</div>
				<div class="span9 met_portfolio_detail_box"> <?php the_content() ?> </div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
					?>
				</div>
			</div><!-- Post Comments Ends -->
		</div>
<?php endwhile; else: ?>
<?php endif; ?>


<?php get_footer(); ?>
