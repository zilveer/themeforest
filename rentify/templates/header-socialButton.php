<?php $rentify_option_data = rentify_option_data(); ?>

<!-- Start Social -->
<?php if(isset($rentify_option_data['sb-share-button']) && $rentify_option_data['sb-share-button'] == 1) : ?>
<ul class="buttons">
	<?php if(isset($rentify_option_data['sb-share-button-facebook']) && $rentify_option_data['sb-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="http://www.facebook.com/sharer.php?u=<?php home_url('/');?> "></a></li>
	<?php endif; ?>
	<?php if(isset($rentify_option_data['sb-share-button-twitter']) && $rentify_option_data['sb-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="http://twitthis.com/twit?url=<?php home_url('/'); ?>"></a></li>
	<?php endif; ?>
	<?php if(isset($rentify_option_data['sb-share-button-linkedin']) && $rentify_option_data['sb-share-button-linkedin'] == 1) : ?>
	<li><a class="fa fa-google-plus" href="http://plus.google.com/share?url=<?php home_url('/');?>"></a></li>
	<?php endif; ?>
</ul> 
<?php endif; ?>
<!-- End Social -->