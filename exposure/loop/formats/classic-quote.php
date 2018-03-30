<?php
	$meta = thb_get_post_meta_all( get_the_ID() );
	extract($meta);
?>

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