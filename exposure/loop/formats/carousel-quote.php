<?php
	$post_featured_image = thb_get_post_thumbnail_src(get_the_ID(), 'medium');
	$meta = thb_get_post_meta_all( get_the_ID() );
	extract($meta);
?>

<?php if( !empty($post_featured_image) ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item-thumb">
		<span class="thb-overlay"></span>
		<img src="<?php echo $post_featured_image; ?>" alt="">
	</a>
<?php endif; ?>

<header class="item-header">
	<h1>
		<a href="<?php the_permalink(); ?>" rel="permalink">
			<?php echo $quote; ?>
		</a>
	</h1>
	<?php if( !empty($quote_author) ) : ?>
		<cite>
			<?php if( !empty($quote_url) ) : ?>
				<a href="<?php echo $quote_url; ?>"><?php echo $quote_author; ?></a>
			<?php else : ?>
				<?php echo $quote_author; ?>
			<?php endif; ?>
		</cite>
	<?php endif; ?>
</header>