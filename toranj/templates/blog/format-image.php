<?php 
/**
 * format-image.php
 *
 * The default template for post contents.
 */

?>

<div class="image-wrapper post-format-image">
<?php
if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('blog-thumb',array(
				'class' => 'img-fit'
			)); ?>	
		</a>
<?php endif;
?>
</div>



