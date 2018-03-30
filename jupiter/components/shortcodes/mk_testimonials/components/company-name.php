<?php 
$url = get_post_meta( get_the_ID(), '_url', true );
$company = get_post_meta( get_the_ID(), '_company', true );

if(!empty( $company )) { ?>
	<?php if(!empty($url)) { ?>
		<a href="<?php echo $url; ?>" target="_blank">
	<?php } ?>
			<span class="mk-testimonial-company"><?php echo strip_tags( $company ); ?></span>
	<?php if(!empty($url)) { ?>
		</a>
	<?php } ?>
<?php } ?>