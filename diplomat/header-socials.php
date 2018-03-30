<?php
$social_types = unserialize(TMM::get_option('social_types'));
?>

<ul class="social-icons">

	<?php
	foreach ($social_types as $key => $type) {
		$link = TMM::get_option('show_'.$key.'_social_icon');

		if ($link) {

			$target = ' target="_blank"';

			if ($key == 'email') {
				$link = 'mailto:'.$link;
				$target = '';
			}

			if ($key === 'rss') {
				$link = TMM::get_option('feedburner') ? TMM::get_option('feedburner') : get_bloginfo('rss2_url');
			}
			?>

			<li class="<?php echo esc_attr($key); ?>">
				<a<?php echo $target; ?> href="<?php echo esc_url($link); ?>"><?php echo esc_html(ucfirst($type['name'])); ?></a>
			</li>

			<?php
		}
	}
	?>

</ul><!--/ .social-icons-->