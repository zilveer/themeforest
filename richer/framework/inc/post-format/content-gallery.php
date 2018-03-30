<?php 
	global $thumbnail_size;
	global $gal_id;
	++$gal_id;
?>
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery("<?php echo '.gallery-'.$gal_id; ?>").flexslider({
			animation: "fade",
			slideshow: true,
			smoothHeight : true,
			directionNav: true,
			controlNav: true
		});
	});
</script>

<?php 
$images = rwmb_meta( 'richer_screenshot', 'type=image&size='.$thumbnail_size );
if ( has_post_thumbnail() && count($images) < 2) { ?>
<div class="post-image">
	<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" title="<?php the_title(); ?>" rel="prettyPhoto">
		<?php the_post_thumbnail($thumbnail_size); ?>
	</a>
</div>
<?php }

else if ( !empty($images) ){ ?>
<div class="post-gallery <?php echo 'gallery-'.$gal_id; ?> flexslider">
		<ul class="slides">
			<?php foreach( $images as $image ) :  ?>
				<li><a href="<?php echo $image['full_url']; ?>" rel="prettyphoto[<?php echo 'gallery-'.$gal_id; ?>]"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a></li>
			<?php endforeach; ?>
		</ul>
	</div>	
<?php } ?>
		

