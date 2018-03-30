<?php
	$quote_cite = get_post_meta( $post->ID, 'quote-cite', true );
?>

<div class="item-heading clearfix">
    <div class="date"><?php the_time('d F Y'); ?></div>
    <h1><a class="item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
</div>


<div class="item-details">
	<div class="body-content quote six columns alpha">
		<?php the_content(); ?>
		<cite>— <?php echo $quote_cite; ?></cite>
	</div>
	<div class="clearfix"></div>
	<a class="read-more" href="<?php the_permalink(); ?>"><?php _e("Keep Reading", "swiftframework"); ?><i class="icon-chevron-right"></i></a>
</div>