<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<?php if ($sidebar = Website::getSidebarName()): ?>
	<aside id="aside" class="<?php
		echo Website::to('appearance/sidebar/position') == 'right' ? 'beta' : 'alpha';
		if (Website::to('appearance/sidebar/hide_mobile')) {
			echo ' hide-lte-mobile';
		}
	?>">
		<ul>
			<?php dynamic_sidebar('sidebar-'.$sidebar); ?>
		</ul>
	</aside>
<?php endif; ?>