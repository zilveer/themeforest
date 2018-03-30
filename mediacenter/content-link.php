<?php
/**
 * The template for displaying posts in the Link post format
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	
	<?php media_center_post_header();?>
	
	<div class="post-content">
		
		<?php media_center_post_meta();?>

		<h2 class="post-title">
			<a href="<?php echo esc_attr( get_post_meta ( get_the_ID() , 'postformat_link_url' , true ) ); ?>" target="_blank"><?php the_title(); ?></a>
		</h2>
		<a href="<?php echo esc_attr( get_post_meta ( get_the_ID() , 'postformat_link_url' , true ) ); ?>" target="_blank">
			<?php echo esc_attr( get_post_meta ( get_the_ID() , 'postformat_link_url' , true ) ); ?>
		</a>
	</div><!-- /.post-content --> 
	
</div><!-- /.post -->