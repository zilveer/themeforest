<?php
/**
 * @package WordPress
 * @subpackage ShortcodelicAddons
 * @since 1.0
 */
?>

<?php global $wp_query, $shortcodelic_loop, $singlefx; $gridder = geode_check_gridder(get_the_id()); ?>

<?php 

	$archive = false;

	$thumb_id = get_post_thumbnail_id(get_the_id());
	$postTh = wp_get_attachment_image_src( $thumb_id, 'full' );

	$classes[] = 'pix-letmebe';

	$link = geode_portfolio_linkto();

	if ( get_post_format() == 'gallery' ) {
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id(get_the_id());
			$postTh = wp_get_attachment_image_src( $thumb_id, 'full' );
			$thumb = get_the_post_thumbnail(get_the_id(),'full');
			$thumb = apply_filters( 'geode_print_thumb' , $thumb);
		} else {
			$postTh[0] = '#';
			$the_content = get_the_content();
			preg_match('/\[gallery(.+?)\]/', $the_content, $gallery_match);
			preg_match('/ids=[\'|\"](.+?)[\'|\"]/', $gallery_match[0], $gallery_ids);
			$thumb = do_shortcode($gallery_match[0]);
		}
	} elseif ( get_post_format() == 'video' ) {
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id(get_the_id());
			$postTh = wp_get_attachment_image_src( $thumb_id, 'full' );
			$thumb = get_the_post_thumbnail(get_the_id(),'full');
			$thumb = apply_filters( 'geode_print_thumb' , $thumb );
		} else {
			$postTh[0] = geode_display_post_format_on_top( $lb=true );
			if (strpos($postTh[0],'<video') !== false) {
				echo '<div class="hidden"><div id="video_'.get_the_id().'">'.$postTh[0].'</div></div>';
				$postTh[0] = '#video_'.get_the_id();
			}
			$thumb = geode_display_post_format_on_top();
		}
	} else {
		if ( has_post_thumbnail() ) {
			$thumb = get_the_post_thumbnail(get_the_id(),'full');
			$thumb = apply_filters( 'geode_print_thumb' , $thumb);
		} else {
			$thumb = '';
		}
	}

	switch ($link) {
		case 'none':
			$thumbnail = $thumb;
			break;
		case 'image':
			$thumbnail = '<a href="'.$postTh[0].'" '.apply_filters( 'data_rel' , 'data-rel="gal"').' '.apply_filters( 'data_title' , 'data-title="'.get_the_title().'"').'>'.$thumb.'</a>';
			break;
		default:
			$thumbnail = '<a href="'.get_permalink().'">'.$thumb.'</a>';
			break;
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
        <?php echo $thumbnail; ?>	
	</article>