<?php
/*
Template Name: Porfolio page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$folio_stun_header = DfdMetaBoxSettings::compared('folio_stun_header', false);

$folio_layout = DfdMetaBoxSettings::compared('folio_layout', false);

$folio_sidebars = DfdMetaBoxSettings::compared('folio_sidebars', false);

$folio_cat_tag = DfdMetaBoxSettings::compared('folio_cat_tag', false);

$vc_content_position = DfdMetaBoxSettings::compared('folio_vc_content_position', false);

if($folio_stun_header != 'off') {
	get_template_part('templates/header/top', 'page');
}

if($folio_cat_tag != 'off') {
?>
	<div class="blog-top row <?php echo esc_attr($folio_layout) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/folio', 'top'); ?>
		</div>
	</div>
<?php } ?>

<?php
if(empty($vc_content_position) || $vc_content_position == 'top') {
	get_template_part('templates/portfolio/template', 'top');
}
?>

<section id="layout" class="dfd-portfolio-loop dfd-equal-height-children">
    <div class="row <?php echo esc_attr($folio_layout) ?>">

        <?php
		if(!empty($folio_sidebars) && $folio_sidebars) {
			switch($folio_sidebars) {
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

	<?php get_template_part('templates/loop','folio'); ?>

	<?php
		if(!empty($folio_sidebars) && $folio_sidebars) {
			echo ' </section>';

			if (($folio_sidebars == "2c-l-fixed") || ($folio_sidebars == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($folio_sidebars == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($folio_sidebars == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($folio_sidebars == "2c-r-fixed") || ($folio_sidebars == "3c-fixed") || ($folio_sidebars == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
			//echo '</div>';
        } else {
			set_layout('archive', false);
		}
        ?>

    </div>
</section>

<?php
if($vc_content_position == 'bottom') {
	get_template_part('templates/portfolio/template', 'top');
}
?>