<?php
/*
	* The template used for displaying single standart content
*/
?>

<div class="category-post-list post-list single-list">
	<article id="attachment-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-header">
				<h2><?php the_title(); ?></h2>
			</div>
			<div class="post-image">
				<?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?>
			</div>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php
				$attachment_social_share = ot_get_option( 'attachment_social_share' );
				if( $attachment_social_share == "on" or !$attachment_social_share == "off" ) {
			?>
				<div class="post-bottom">-
						<?php eventstation_post_content_social_share(); ?>
				</div>
			<?php } ?>
		</div>
	</article>
</div>