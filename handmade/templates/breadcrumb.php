<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/3/2015
 * Time: 10:20 AM
 */
?>
<?php if (!is_front_page()) : ?>
	<?php g5plus_get_breadcrumb(); ?>
<?php else: ?>
	<ul class="breadcrumbs">
		<li><a rel="v:url" href="<?php echo home_url('/') ?>" class="home"><?php esc_html_e('Home','g5plus-handmade');?> </a></li>
		<li><span><?php esc_html_e('Blog', 'g5plus-handmade'); ?></span></li>
	</ul>
<?php endif; ?>