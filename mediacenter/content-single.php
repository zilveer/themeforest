<!-- ============================================================= SECTION - BLOG POST ============================================================= -->
<?php $post_format = get_post_format(); ?>

<?php
$show_author_info = true;
switch( $post_format ) {
	case 'aside'  :
	case 'link'   : 
	case 'status' :
	case 'quote'  :
		get_template_part( 'content', $post_format );
		$show_author_info = false;
	break;
	default       :
?>
<div class="post-entry">

	<div class="clearfix">
		<?php
			if( $post_format == 'gallery' ){
				media_center_gallery_slideshow( get_the_ID() );	
			}else if ( $post_format == 'video' ){
				media_center_video_player( get_the_ID() );
			}else if ( $post_format == 'audio' ){
				media_center_audio_player( get_the_ID() );
			}else if ( $post_format == 'image' || has_post_thumbnail() ){
				media_center_post_thumbnail();
			}
		?>
	</div><!-- /.clearfix -->

	<div class="post-content">
		<h2 class="post-title"><?php the_title(); ?></h2>
		<?php media_center_post_meta(); ?>
		<?php the_content(); ?>
		<?php mc_init_structured_data(); ?>
	</div><!-- /.post-content -->

</div><!-- /.post-entry -->
<?php
}
the_tags( '<div class="meta-row"><div class="inline"><strong>' . __('Tags : ', 'mediacenter' ) . '</strong>' , ', ', '</div></div>'); 
?>

<?php if( $show_author_info ) : ?>
<div class="blog-post-author">

	<div class="media">
		<a class="pull-left flip" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo get_avatar( get_the_author_meta( 'ID' ) , 160 ); ?> 
		</a>
		<div class="media-body">
			<h4 class="media-heading"><?php echo media_center_post_author(); ?></h4>
			<p><?php echo get_the_author_meta( 'description' );?></p>
		</div><!-- /.media-body -->
	</div><!-- /.media -->
	
</div><!-- /.blog-post-author -->
<?php endif; ?>

<?php media_center_content_nav( 'content-nav-bottom' ); ?>

<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
?>
<!-- ============================================================= SECTION - BLOG POST : END ============================================================= -->