<?php
$post_meta = get_post_custom();
$post_id = get_the_ID();
$link = get_post_meta( $post_id, 'link', true );
if( !empty( $link ) ){
	?>
	<div class="embed-responsive embed-responsive-16by9">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'embed-responsive-item' ) ) ?>
		<div class="link-overlay"></div>
		<div class="media-text-overlay">
			<a href="<?php echo esc_url( $link ); ?>">
				<h1 class="break-word"><?php echo $link ?></h1>
			</a>
		</div>
	</div>
	<?php
}
?>