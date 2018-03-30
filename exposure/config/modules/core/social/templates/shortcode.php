<?php
	$icons_path = thb_get_module_url('core/social') . '/icons';

	$thb_services = array(
		'twitter',
		'facebook',
		'googleplus',
		'flickr',
		'youtube',
		'vimeo',
		'pinterest',
		'dribbble',
		'forrst',
		'linkedin'
	);

	$thb_services_names = array(
		'twitter' => 'Twitter',
		'facebook' => 'Facebook',
		'googleplus' => 'Google+',
		'flickr' => 'Flickr',
		'youtube' => 'YouTube',
		'vimeo' => 'Vimeo',
		'pinterest' => 'Pinterest',
		'dribbble' => 'Dribbble',
		'forrst' => 'Forrst',
		'linkedin' => 'LinkedIn'
	);

	$services = $thb_services;
	if( !empty($show) ) {
		$show = explode(',', $show);
		$services = array();

		foreach( $show as $service_id ) {
			$service_id = trim($service_id);

			if( in_array($service_id, $thb_services) ) {
				$services[] = $service_id;
			}
		}
	}

?>

<div class="thb-shortcode thb-social-container">
	<?php if( $title != '' ) : ?>
		<h1 class="thb-shortcode-title"><?php echo thb_text_format($title); ?></h1>
	<?php endif; ?>

	<?php foreach( $services as $id ) : ?>
		<?php
			$opt = thb_get_option('social_' . $id);
			$img = $icons_path . '/' . $id . '.png';
			$name = $thb_services_names[$id];
		?>

		<?php if( $opt != '' ) : ?>
			<span>
				<a href="<?php echo $opt; ?>" title="<?php echo $name; ?>" class="thb-social-<?php echo $id; ?>">
					<img src="<?php echo $img; ?>" alt="" />
				</a>
			</span>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<style type="text/css">
	.thb-social-container {
		margin-bottom: 1em;
		font-size: 0;
	}
	.thb-social-container span {
		display: inline-block;
		margin: 0 2px 4px;
	}
	.thb-social-container span a {
		text-decoration: none;
		border: none;
	}
	.thb-social-container span a:hover {
		position: relative;
		top: -2px;
	}
	.thb-social-container span a:active {
		position: relative;
		top: 0;
	}
</style>