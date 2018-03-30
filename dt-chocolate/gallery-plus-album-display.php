<?php
if( has_post_thumbnail() ) {
	$img_id = get_post_thumbnail_id($post->ID);
}else {
	$img_id = get_posts(
		array(
			'post_type'		=>'attachment',
			'posts_per_page'=>1,
			'post_status' 	=>'inherit',
			'orderby'		=>'menu_order',
			'order'	=>'ASC',
			'post_parent' 	=>$post->ID,
			'paged'			=>1
		)
	);
	if($img_id) {
		$img_id = $img_id[0]->ID;
	}
}
$image = wp_get_attachment_image_src($img_id, 'large');

$k = $image[1]/$image[2];
$size =  get_post_meta($post->ID, '_option_post_size', true);
switch($size) {
	case 's':
		$w = 220;
		break;
	case 'm':
		$w = 460;
		break;
	case 'l':
		$w = 700;
		break;
}
      
$h = ceil($w / $k);

$tmp_src = dt_clean_thumb_url($image[0]);

$url = get_template_directory_uri()."/thumb.php?src={$tmp_src}&w={$w}&h={$h}&zc=1";
?>
      <div class="folio_box col_<?php echo $size; ?> for_post_<?php echo $post->ID; ?>">
        <div class="folio" style="background: url(<?php echo esc_attr($url); ?>) 0 0; height: <?php echo $h; ?>px;">
  
          <div class="folio_mask">

            <div class="folio_caption">
              <div>
                <div>
                  <a href="#"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                </div>
              </div>
            </div>
            <div class="folio_desc">
				
				<?php if(! post_password_required()): ?>

              <div class="desc_body">
                <?php global $more; $more = 0; ?>
                <?php the_excerpt(); ?>
              </div>
				<div class="goto_post">
					<a href="#" class="go_more">
						<span><i></i><?php _e( "View pictures", LANGUAGE_ZONE); ?></span>
					</a>
				</div>
	
				<?php else: ?>

					<?php echo get_the_password_form(); ?>

				<?php endif; // password protection. ?>

            </div>
          </div>
  
          <div class="folio_just_caption">
            <div>

              <div>
                <a href="#"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
              </div>
            </div>
          </div>
  
        </div>
      </div>
