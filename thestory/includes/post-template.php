<?php
/**
 * Single blog post template.
 */

global $pexeto_page;
$format = get_post_format();
$add_post_class = is_single() ? 'blog-single-post' : 'blog-non-single-post';
$add_post_class.=' theme-post-entry';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $add_post_class ); ?>>

<?php

if ( $format == 'quote' ) {
	//QUOTE POST FORMAT
?>
	<span class="post-type-icon-wrap"><span class="post-type-icon"></span></span>
	<blockquote><?php the_content(); ?></blockquote>
	<?php
}elseif ( $format == 'aside' ) {
	//ASIDE POST FORMAT
?>
	<span class="post-type-icon-wrap"><span class="post-type-icon"></span></span>
	<aside><?php the_content(); ?></aside>
	<?php
}else {
	//ALL OTHER POST FORMATS
	$hide_thumbnail=( isset( $pexeto_page["hide_thumbnail"] )&&$pexeto_page["hide_thumbnail"] )?true:false;
	$thumb_class='';
	if ( (!$format && !has_post_thumbnail()) || $hide_thumbnail ) {
		$thumb_class=' no-thumbnail';
	}
?>

<?php
	//PRINT HEADER OF POST DEPENDING ON ITS FORMAT

if(!$format || $format=='video'){
	$columns = isset($pexeto_page['columns']) ? $pexeto_page['columns'] : 1;
	$img_size = pexeto_get_image_size_options($columns, 'blog');
}

	if ( $format == 'gallery' ) {
		//PRINT A GALLERY
		locate_template( array( 'includes/slider-nivo-post-gallery.php' ), true, false );
	}elseif ( $format == 'video'  ) {
?>
			<div class="post-video-wrapper">
				<div class="post-video">
					<?php
						$video_url = pexeto_get_single_meta( $post->ID, 'video' );
						if ( $video_url ) {
							pexeto_print_video( $video_url, $img_size['width'] );
						}
					?>
				</div>
			</div>
			<?php
	}else {
		//PRINT AN IMAGE
		if ( has_post_thumbnail() && !$hide_thumbnail ) { ?>
				<div class="blog-post-img img-loading" style="min-width:<?php echo $img_size['width']; ?>px; min-height:<?php echo $img_size['height'] ?>px;">
					<?php if ( !is_single() ) {?><a href="<?php the_permalink(); ?>"><?php }

					$thumb_id = get_post_thumbnail_id( $post->ID );
					$thumb = wp_get_attachment_image_src( $thumb_id, 'full' ); 
					$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
					?>
					
					<img src="<?php echo pexeto_get_resized_image( $thumb[0], $img_size['width'], $img_size['height'], $img_size['crop'], true ); ?>" alt="<?php echo esc_attr($alt); ?>"/>
					<?php
					if ( !is_single() ) { ?></a><?php } ?>
				</div>
				<?php
		}
	}
?>
<div class="post-content<?php echo $thumb_class; ?>">

<?php

//PRINT POST INFO
$hide_sections=pexeto_option( 'exclude_post_sections' );
$hide_date = in_array( 'date', $hide_sections );
$hide_author = in_array( 'author', $hide_sections );

if ( !$hide_date || !$hide_author ) {
?>

	<div class="post-info top">
		<span class="post-type-icon-wrap"><span class="post-type-icon"></span></span>
		<?php

		if ( !$hide_date ) { ?>
			<span class="post-date">
				<?php echo pexeto_get_post_date_html(); ?>
				
			</span>	
		<?php }

		if ( !$hide_author ) {?>
			<span class="no-caps post-autor vcard author">
				&nbsp;<?php _e( 'by', 'pexeto' ); ?>  
				<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php the_author(); ?>
				</a>
			</span>
		
		<?php } ?>
	</div>
<?php } 

	$hide_title = isset($pexeto_page['hide_title']) && $pexeto_page['hide_title'] === true ? true : false;

	if(!$hide_title){
	?>
		<div class="post-title-wrapper">
			<?php $htag = is_single()?'h1':'h2'; ?>

			<<?php echo $htag; ?> class="post-title entry-title">
			<?php if ( !is_single() ) { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php }else {
		the_title();
				} ?>
			</<?php echo $htag; ?>>

		</div>
	<?php } ?>
	<div class="clear"></div>




	<div class="post-content-content">

	<?php
	//PRINT THE CONTENT
	$excerpt=( isset( $pexeto_page['excerpt'] ) && $pexeto_page['excerpt'] ) ? true : false;
	if ( !$excerpt && pexeto_option( 'post_summary' )!='excerpt' || is_single() ) {
		?><div class="entry-content"><?php
		if($format!=='gallery'){
			the_content( '' );
		}else{
			//it is a gallery post format, strip the first gallery from the content
			if(!is_single()){
				global $more;
				$more = 0;
			}
			$content = pexeto_remove_gallery_from_content(get_the_content(''));
			echo apply_filters('the_content', $content );
		}
		 ?>
		</div>
		<div class="clear"></div>
		<?php
		if ( !is_single() ) {
			$ismore = @strpos( $post->post_content, '<!--more-->' );
			if ( $ismore ) {?> <a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'Read More', 'pexeto' ); ?><span class="more-arrow">&rsaquo;</span></a>
			<?php
			}
		} else {
			wp_link_pages();
		}
	}else {
		?><div class="entry-summary"><?php
		the_excerpt(); ?>
		</div>

		<a href="<?php the_permalink(); ?>" class="read-more">
			<?php _e( 'Read More', 'pexeto' ); ?>
			<span class="more-arrow">&rsaquo;</span>
		</a>
		<?php
	}?>
		

<?php

//PRINT BOTTOM POST INFO
$hide_category = in_array( 'category', $hide_sections );
$hide_comments = in_array( 'comments', $hide_sections );

if ( !$hide_category || !$hide_comments ) {
?>

	<div class="post-info bottom">
		<span class="post-type-icon-wrap"><span class="post-type-icon"></span></span>
		<?php
		//PRINT THE POST INFO (CATEGORY AND COMMENTS)
		if (!$hide_category && get_the_category( $post->ID ) ) {?>
			<span class="no-caps"> 
				<?php _e( 'in', 'pexeto' ); ?>
			</span><?php the_category( ' / ' );?>
	
		<?php }

		if ( !$hide_comments ) {?>
			<span class="comments-number">
				<a href="<?php the_permalink();?>#comments">
					<?php comments_number( '0', '1', '%' ); ?>
				<span class="no-caps"><?php _e( 'comments', 'pexeto' ); ?></span></a>
			</span>
		<?php } ?>
	</div>
<?php } ?>
<div class="clear"></div>
</div>
</div>


	<?php
	//PRINT SHARING
	if ( is_single() ) {
		echo pexeto_get_share_btns_html( $post->ID, 'post' );

		the_tags( '<span class="post-tags"><span class="post-tag-title">'.__( 'Post tags', 'pexeto' ).'</span>', '', '</span>' );

		if(pexeto_option('show_related_posts')===true){
			?><div class="clear"></div><?php
			echo pexeto_get_related_posts_html($post);
		}
	} ?>

<?php
} ?>
<div class="clear"></div>
</article>
