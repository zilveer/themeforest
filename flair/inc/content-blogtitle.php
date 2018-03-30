<?php
	$title = get_option('blog_title','Our Blog');
	$subtitle = get_option('blog_subtitle','Success is no accident. It is hard work, <strong>perseverance</strong>, learning, sacrifice and most of all, <span class="colour"><strong>love</strong></span> of what you are doing or <span class="colour">learning</span> to do.')
?>

<?php if( $title ) : ?>
	<h1 class="wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="2s">
		<?php echo $title; ?>
	</h1>
<?php endif; ?>

<?php if( $title ) : ?>
	<div class="lead wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="2s">
		<?php echo htmlspecialchars_decode($subtitle); ?>
	</div>
<?php endif;