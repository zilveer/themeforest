<?php if(! defined('ABSPATH')){ return; }
/**
 * Details author
 */
?>
<span class="itemAuthor kl-blog-post-details-author vcard author"  <?php echo WpkPageHelper::zn_schema_markup('author'); ?>>
	<?php echo __( "by", 'zn_framework' ); ?>
	<span class="fn">
		<a class=" kl-blog-post-author-link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
			<?php echo get_the_author_meta( 'display_name' );?>
		</a>
	</span>
</span>
