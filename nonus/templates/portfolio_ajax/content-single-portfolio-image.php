<?php $imageUrl = '';
$width = 600;
$height = 1000; ?>

<?php if (has_post_thumbnail(get_the_ID()) || has_portfolio_second_featured_image(get_the_ID())): ?>
	<?php $imgClass = has_portfolio_second_featured_image(get_the_ID())? 'ctFeaturedImage2':''?>
	<?php $imageUrl = ct_get_portfolio_featured_image_single(get_the_ID())?>
<?php endif; ?>
<a href="<?php echo $imageUrl; ?>" data-lightbox="image-<?php echo get_the_ID()?>">
    <img src="<?php echo $imageUrl; ?>" alt="preview" class="<?php echo $imgClass?>">
</a>