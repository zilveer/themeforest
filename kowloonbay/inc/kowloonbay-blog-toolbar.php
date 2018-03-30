<?php 
global $kowloonbay_redux_opts;
$blog_toolbar_items = $kowloonbay_redux_opts['blog_toolbar_items'];
$blog_toolbar_icons = array(
	'a' => $kowloonbay_redux_opts['blog_toolbar_fa_icon_archive'],
	'c' => $kowloonbay_redux_opts['blog_toolbar_fa_icon_cats'],
	't' => $kowloonbay_redux_opts['blog_toolbar_fa_icon_tags'],
	's' => $kowloonbay_redux_opts['blog_toolbar_fa_icon_search']
);
?>

<ul class="list-reset list-inline pull-right-sm margin-t-1x margin-t-none-sm wow-array">
	<?php if ($blog_toolbar_items['a'] === '1'): ?>
	<li>
		<a
		href="#stackbox-archives"
		class="fa-custom-hover-effect"
		data-stackbox="true"
		data-stackbox-auto-scroll="false"
		data-stackbox-content="#stackbox-archives"
		data-stackbox-close-button="true"
		data-stackbox-position="bottom"
		data-stackbox-anim-open="fadeIn normal"
		data-stackbox-backdrop="false"
		data-stackbox-close-on-backdrop="false"
		data-stackbox-margin-y="15"
		><i class="fa <?php echo esc_attr( $blog_toolbar_icons['a'] ); ?> fa-custom-sm fa-custom-no-margin-right"></i></a>
	</li>
	<?php endif; ?>

	<?php if ($blog_toolbar_items['c'] === '1'): ?>
	<li>
		<a
		href="#stackbox-categories"
		class="fa-custom-hover-effect"
		data-stackbox="true"
		data-stackbox-auto-scroll="false"
		data-stackbox-content="#stackbox-categories"
		data-stackbox-close-button="true"
		data-stackbox-position="bottom"
		data-stackbox-anim-open="fadeIn normal"
		data-stackbox-backdrop="false"
		data-stackbox-close-on-backdrop="false"
		data-stackbox-margin-y="15"
		><i class="fa <?php echo esc_attr( $blog_toolbar_icons['c'] ); ?> fa-custom-sm fa-custom-no-margin-right"></i></a>
	</li>
	<?php endif; ?>

	<?php if ($blog_toolbar_items['t'] === '1'): ?>
	<li><a
		href="#stackbox-tags"
		class="fa-custom-hover-effect"
		data-stackbox="true"
		data-stackbox-auto-scroll="false"
		data-stackbox-content="#stackbox-tags"
		data-stackbox-close-button="true"
		data-stackbox-position="bottom"
		data-stackbox-anim-open="fadeIn normal"
		data-stackbox-backdrop="false"
		data-stackbox-close-on-backdrop="false"
		data-stackbox-margin-y="15"
		><i class="fa <?php echo esc_attr( $blog_toolbar_icons['t'] ); ?> fa-custom-sm fa-custom-no-margin-right"></i></a>
	</li>
	<?php endif; ?>

	<?php if ($blog_toolbar_items['s'] === '1'): ?>
	<li><a
		href="#stackbox-search"
		class="fa-custom-hover-effect"
		data-stackbox="true"
		data-stackbox-auto-scroll="false"
		data-stackbox-content="#stackbox-search"
		data-stackbox-close-button="true"
		data-stackbox-position="bottom"
		data-stackbox-anim-open="fadeIn normal"
		data-stackbox-backdrop="false"
		data-stackbox-close-on-backdrop="false"
		data-stackbox-margin-y="15"
		><i class="fa <?php echo esc_attr( $blog_toolbar_icons['s'] ); ?> fa-custom-sm fa-custom-no-margin-right"></i></a>
	</li>
	<?php endif; ?>
</ul>