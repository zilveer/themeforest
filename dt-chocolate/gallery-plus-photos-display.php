<div class="hidden post_<?php echo $post->ID; ?>">
<div class="big_gallery_bg hidden">
<div class="big_gallery">

  <a href="#" class="go_back"><?php _e('Back', LANGUAGE_ZONE); ?></a>
  <h1><?php the_title(); ?></h1>

  <div class="multipics">
    <?php    
	$box_name = 'gallery_ct';
	$data = get_post_meta( $post->ID, 'dt_'.$box_name.'_options', true );
	$data = wp_parse_args($data, array('dt_exclude_from' =>false, 'orderby' => 'menu_order', 'order' => 'ASC'));

	$args = array(
		'post_type'		=>'attachment',
		'numberposts' 	=>-1,
		'post_status' 	=>'inherit',
		'orderby'		=>$data['orderby'],
		'order'			=>$data['order'],
		'post_parent' 	=>$post->ID
	);
	
	if( $data['dt_exclude_from'] ) {
		$args['post__not_in'] = array( get_post_thumbnail_id($post->ID) );
	}
	$attachments = get_posts( $args );
	if($attachments):
		foreach ($attachments as $attachment):
		   //global $postoptions_photos;
		   $image = wp_get_attachment_image_src($attachment->ID, 'large');
		   $k = $image[1]/$image[2];
		   $w = 220;
		   $h = ceil($w / $k);

			$tmp_src = dt_clean_thumb_url($image[0]);

		   $small_image = get_template_directory_uri()."/thumb.php?src={$tmp_src}&w={$w}&h={$h}&zc=1";
		   $big_image = $image[0];
	?>
		<a href="<?php echo esc_url($big_image); ?>" data-src="<?php echo esc_attr($small_image); ?>" data-width="<?php echo esc_attr($w); ?>" data-height="<?php echo esc_attr($h); ?>"></a>
		<div class="highslide-caption">
		<?php
		echo $attachment->post_excerpt;
		if( is_lb_enabled() && dt_get_theme_options('enable_in_album') ):
			$q_args = array( 'img' => urlencode(current(wp_get_attachment_image_src($attachment->ID, 'thumbnail'))), 'src' => urlencode(get_permalink($attachment->ID)) );
			
			dt_get_like_window( $q_args );	

		endif;
		?>
		</div>
	<?php
		endforeach;
	endif;
	?>
  </div>

  <a href="#" class="go_back"><?php _e('Back', LANGUAGE_ZONE); ?></a>
</div>
</div>
</div>
