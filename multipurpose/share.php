<?php 
$facebook = get_theme_mod('share_links_facebook');
$twitter = get_theme_mod('share_links_twitter');
$googleplus = get_theme_mod('share_links_googleplus');
$pinterest = get_theme_mod('share_links_pinterest');
?>
<p class="share social">
	<?php esc_attr_e('Share this', 'multipurpose'); ?>: 
	<?php if(!$facebook): ?><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank">Facebook</a><?php endif; ?> 
	<?php if(!$twitter): ?><a href="http://twitter.com/share?text=Check%20this%20out:%20&amp;url=<?php the_permalink(); ?>" class="twitter" target="_blank">Twitter</a><?php endif; ?>  
	<?php if(!$googleplus): ?><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="googleplus" target="_blank">Google+</a><?php endif; ?>  
	<?php if(!$pinterest): ?>
	<?php $pinterest_dsc = urlencode(get_the_title());?>
	<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;description=<?php echo $pinterest_dsc;?>" target="_blank" class="pinterest">Pinterest</a><?php endif; ?> 
</p>