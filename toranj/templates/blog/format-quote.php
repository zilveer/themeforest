<?php
/**
 *  quote format - will be used by single.php
 * 
 * @package package name
 * @author owwwlab
 */
?>
<?php if ( is_single() ) :?>
<div class="blog-list">
<?php endif; ?>
<div class="post-format-quote">
	<div class="quote-wrapper set-bg rev-blur">
		<?php if ( has_post_thumbnail() ): ?>
			<?php the_post_thumbnail('blog-thumb',array(
				'class' => 'rev-blur',
				'style' => 'display:none;'
			)); ?>
		<?php else: ?>
		<img src="<?php echo OWLAB_IMAGES.'/default-blog-quote.jpg'; ?>" alt="image" class="rev-blur" style="display: none;">
		<?php endif; ?>
	</div>
	<div class="quote">
		<?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
		<p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
		<div class="author">~ <?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></div>
		<?php endif; ?>	
	</div>
</div>
<?php if ( is_single() ) :?>
</div>
<?php endif; ?>