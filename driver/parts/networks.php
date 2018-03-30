<?php 
$social_icons = get_iron_option('social_icons');
?>
<?php if(!empty($social_icons)): ?>

	<!-- social-networks -->
	<ul class="social-networks">
	
		<?php foreach($social_icons as $icon): ?>

		<li>
			<a target="_blank" href="<?php echo esc_url($icon["social_media_url"]); ?>">
				<?php if(!empty($icon["social_media_icon_url"])): ?>
				<img src="<?php echo esc_url($icon["social_media_icon_url"]); ?>" style="max-height:50px;">
				<?php else: ?>
				<i class="fa fa-<?php echo esc_attr($icon["social_media_icon_class"]); ?>" title="<?php echo esc_attr($icon["social_media_name"]); ?>"></i>
				<?php endif; ?>
			</a>
		</li>

		<?php endforeach; ?>	
		
	</ul>
	
<?php endif; ?>				
