<?php 
/**
 * format-standard.php
 *
 * The default template for post contents.
 */

?>


<?php
if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="image-wrapper post-format-standard">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('blog-thumb',array(
					'class' => 'img-fit'
				)); ?>	
			</a>
		</div>
<?php endif;
?>

