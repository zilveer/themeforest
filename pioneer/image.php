<?php get_header();?>	

	
	
<div id="content">
<?php if (have_posts()) : the_post(); ?>
	<div id="article" <?php post_class();?>>
	<h1 class="post-title"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php _e('Images from the post ','epic'); echo get_the_title($post->post_parent); ?> </a></h1>
	<p class="aligncenter" style="text-align: center;"><?php if ( !empty($post->post_excerpt) ) echo get_the_excerpt(); ?></p><br />
	<div style="text-align: center;">
		<a href="<?php echo wp_get_attachment_url($post->ID); ?>">
			<?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?>
		</a>
	</div>
	<hr />
	<div style="float:right;"><?php next_image_link('','Next image >') ?></div><?php previous_image_link('','< Previous image') ?>
      
      	
		
	
	
	
	</div>


<?php endif;?>
<?php get_sidebar();?>
</div>

<?php get_footer();?>


