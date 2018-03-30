<?php
/*
Template Name: Gallery page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_ronneby;

$gallery_stun_header = DfdMetaBoxSettings::compared('dfd_gallery_stun_header', false);

$gallery_layout = DfdMetaBoxSettings::compared('dfd_gallery_layout', false);

$gallery_sidebars = DfdMetaBoxSettings::compared('dfd_gallery_sidebars', false);

$dfd_gallery_cat_tag = DfdMetaBoxSettings::compared('dfd_gallery_cat_tag', false);

if($gallery_stun_header != 'off') {
	get_template_part('templates/header/top', 'page');
}

if($dfd_gallery_cat_tag != 'off') {
?>
	<div class="blog-top row <?php echo esc_attr($gallery_layout) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/gallery', 'top'); ?>
		</div>
	</div>
<?php } ?>

<?php get_template_part('templates/portfolio/template', 'top'); ?>

<section id="layout" class="dfd-gallery-loop dfd-equal-height-children">
    <div class="row <?php echo esc_attr($gallery_layout) ?>">

        <?php
		if(!empty($gallery_sidebars) && $gallery_sidebars) {
			switch($gallery_sidebars) {
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

	<?php get_template_part('templates/loop','gallery'); ?>

	<?php
		if(!empty($gallery_sidebars) && $gallery_sidebars) {
			echo ' </section>';

			if (($gallery_sidebars == "2c-l-fixed") || ($gallery_sidebars == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($gallery_sidebars == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($gallery_sidebars == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($gallery_sidebars == "2c-r-fixed") || ($gallery_sidebars == "3c-fixed") || ($gallery_sidebars == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
			//echo '</div>';
        } else {
			set_layout('archive', false);
		}
        ?>

    </div>
</section>