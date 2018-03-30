<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_ronneby;

$options = array(
	'archive_folio_stun_header' => false,
	'archive_folio_layout' => false,
	'archive_folio_sidebars' => false,
	'archive_folio_cat_tag' => false,
	'archive_folio_vc_content_position' => false,
);

foreach($options as $option => $default) {
	if(isset($dfd_ronneby[$option]) && !empty($dfd_ronneby[$option])) {
		$options[$option] = $dfd_ronneby[$option];
	}
}

if($options['archive_folio_stun_header'] != 'off') {
	get_template_part('templates/header/top', 'page');
}

if($options['archive_folio_cat_tag'] != 'off') {
?>
	<div class="blog-top row <?php echo esc_attr($options['archive_folio_layout']) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/folio', 'top'); ?>
		</div>
	</div>
<?php } ?>

<section id="layout" class="dfd-portfolio-loop dfd-equal-height-children">
    <div class="row <?php echo esc_attr($options['archive_folio_layout']) ?>">

        <?php
		if(!empty($options['archive_folio_sidebars']) && $options['archive_folio_sidebars']) {
			switch($options['archive_folio_sidebars']) {
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
	?>

	<?php get_template_part('templates/content','folio-archive'); ?>

	<?php
		if(!empty($options['archive_folio_sidebars']) && $options['archive_folio_sidebars']) {
			echo ' </section>';

			if (($options['archive_folio_sidebars'] == "2c-l-fixed") || ($options['archive_folio_sidebars'] == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($options['archive_folio_sidebars'] == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($options['archive_folio_sidebars'] == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($options['archive_folio_sidebars'] == "2c-r-fixed") || ($options['archive_folio_sidebars'] == "3c-fixed") || ($options['archive_folio_sidebars'] == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
			echo '</div>';
        } else {
			set_layout('archive', false);
		}
        ?>

    </div>
</section>