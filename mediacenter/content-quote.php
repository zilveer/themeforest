<?php
/**
 * The template for displaying posts in the Quote post format
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
									
	<?php media_center_post_header();?>
	
	<div class="post-content">
		
		<?php media_center_post_meta();?>

		<blockquote>
			<p><?php echo esc_attr( get_post_meta ( get_the_ID() , 'postformat_quote_text' , true ) ); ?></p>
			<footer><cite><?php echo esc_attr( get_post_meta( get_the_ID() , 'postformat_quote_source' , true ) ); ?></cite></footer>
		</blockquote>
	</div><!-- /.post-content --> 
	
</div><!-- /.post -->