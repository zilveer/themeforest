<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$options = array(
	'archive_stun_header' => 'on',
	'archive_layout_width' => '',
	'archive_sidebars' => '',
	'archive_cat_tag' => 'on',
);

foreach($options as $option => $default) {
	if(isset($dfd_ronneby[$option]) && !empty($dfd_ronneby[$option])) {
		$options[$option] = $dfd_ronneby[$option];
	}
}

if($options['archive_stun_header'] != 'off') {
	get_template_part('templates/header/top', 'page');
}

if($options['archive_cat_tag'] != 'off') {
	?>
	<div class="blog-top row <?php echo esc_attr($options['archive_layout_width']) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/blog', 'top'); ?>
		</div>
	</div>
<?php
}
?>

<section id="layout" class="archive dfd-blog-loop dfd-equal-height-children">
    <div class="row <?php echo esc_attr($options['archive_layout_width']) ?>">

        <?php
		if(!empty($options['archive_sidebars']) && $options['archive_sidebars']) {
			switch($options['archive_sidebars']) {
				case '3c-l-fixed':
					$dfd_layout = 'sidebar-left2';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '3c-r-fixed':
					$dfd_layout = 'sidebar-right2';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '2c-l-fixed':
					$dfd_layout = 'sidebar-left';
					$dfd_width = 'nine dfd-eq-height';
					break;
				case '2c-r-fixed':
					$dfd_layout = 'sidebar-right';
					$dfd_width = 'nine dfd-eq-height';
					break;
				case '3c-fixed':
					$dfd_layout = 'sidebar-both';
					$dfd_width = 'six dfd-eq-height';
					break;
				case '1col-fixed':
				default:
					$dfd_layout = '';
					$dfd_width = 'twelve';
			}
			echo '<div class="blog-section ' . esc_attr($dfd_layout) . '">';
			echo '<section id="main-content" role="main" class="' . esc_attr($dfd_width) . ' columns">';
		} else {
			set_layout('archive', true);
		}
		
        get_template_part('templates/content','archive');

		if(!empty($options['archive_sidebars']) && $options['archive_sidebars']) {
			echo ' </section>';

			if (($options['archive_sidebars'] == "2c-l-fixed") || ($options['archive_sidebars'] == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($options['archive_sidebars'] == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($options['archive_sidebars'] == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($options['archive_sidebars'] == "2c-r-fixed") || ($options['archive_sidebars'] == "3c-fixed") || ($options['archive_sidebars'] == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
			echo '</div>';
        } else {
			set_layout('archive', false);
		}

		?>

    </div>
</section>