<?php
/**
 * The template for displaying posts in the Status post format
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<?php media_center_post_header();?>

	<div class="post-content">
		<div class="media">
			
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="pull-left">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'media_center_status_avatar', '100' ) ); ?>
			</a>
			
			<div class="media-body">
				<h4 class="media-heading"><?php the_author(); ?></h4>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mediacenter' ) ); ?>
				<ul class="meta">
					<?php if ( comments_open() ) : ?>
					<li><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'mediacenter' ) . '</span>', __( '1 Reply', 'mediacenter' ), __( '% Replies', 'mediacenter' ) ); ?></li>
					<?php endif; // comments_open() ?>	
					<?php edit_post_link( __( 'Edit', 'mediacenter' ), '<li><span class="edit-link">', '</span></li>' ); ?>	
				</ul>
				
			</div><!-- /.media-body -->

		</div><!-- /.media -->
	</div><!-- /.post-content -->
</div><!-- /#post-<?php the_ID(); ?> -->