<?php
$demo_site = array(
	'main' => array(
		'name' => esc_html__('Main','zorka'),
		'path'  => 'zorka',
	)
);
foreach ($demo_site as $key => $value) {
	$demo_site[$key]['image'] = THEME_URL . 'assets/data-demo/' . $key . '/preview.png';
}

$hide_fix_class = 'hide';
if (isset($_REQUEST['fix-demo-data']) && ($_REQUEST['fix-demo-data'] == '1')) {
$hide_fix_class = '';
}
?>
<div class="g5plus-demo-data-wrapper">
	<h1><?php esc_html_e('G5PLUS - Install Demo Data','zorka') ?></h1>
	<p><?php esc_html_e('Please choose demo to install (take about 3-35 mins)','zorka') ?></p>
	<div class="install-message" data-success="<?php esc_html_e('Install Done','zorka') ?>"></div>

	<div class="g5plus-demo-site-wrapper">
		<?php foreach ($demo_site as $key => $value): ?>
			<div class="g5plus-demo-site">
				<div class="g5plus-demo-site-inner">
					<div class="demo-site-thumbnail">
						<div class="centered">
							<img src="<?php echo esc_url($value['image'])?>" alt="<?php echo esc_attr($value['name'])?>"/>
						</div>
					</div>
				</div>
				<h3><span><?php echo esc_html($value['name'])?></span><span class="install-button" data-demo="<?php echo esc_attr($key) ?>" data-path="<?php echo esc_attr($value['path']) ?>"><?php esc_html_e('Install','zorka'); ?></span></h3>
				<button class="fix_install_demo_error <?php echo esc_attr($hide_fix_class) ?>" data-demo="<?php echo esc_attr($key) ?>" data-path="<?php echo esc_attr($value['path']) ?>"><?php esc_html_e('Fix Setting','zorka') ?></button>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
	<div class="install-progress-wrapper">
		<div class="title"><?php esc_html_e('Reset theme options','zorka') ?></div>
		<div id="g5plus_reset_option" class="meter"><span style="width: 0%"></span></div>

		<div class="title"><?php esc_html_e('Install Demo Data','zorka') ?></div>
		<div id="g5plus_install_demo" class="meter orange"><span style="width: 0%"></span></div>

		<div class="title"><?php esc_html_e('Import slider','zorka') ?></div>
		<div id="g5plus_import_slider" class="meter red"><span style="width: 0%"></span></div>
	</div>
</div>