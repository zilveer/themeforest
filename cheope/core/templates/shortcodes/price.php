<?php
	$last = (isset($last) && strcmp($last, 'yes') == 0) ? ' last' : '';
    
    $content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
?>
<div class="one-third<?php echo $last; ?>">
	<div class="price-table">
		<div class="head" style="background-color:<?php echo $color; ?>;">
			<p style="color:<?php echo $textcolor; ?>;"><?php echo $title; ?></p>
			<h2 class="price" style="color:<?php echo $textcolor; ?>;"><?php echo $price; ?></h2>
		</div>
		<div class="body">
			<ul>
				<?php echo do_shortcode($content); ?>
			</ul>
			<?php if ( isset($href) && $href != '' && isset($buttontext) && $buttontext ) : ?>
				<p class="more"><a href="<?php echo esc_url($href); ?>"><?php echo $buttontext; ?></a></p>
			<?php endif; ?>
		</div>
	</div>
</div>