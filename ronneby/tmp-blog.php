<?php
/*
Template Name: Blog page template
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

$blog_stun_header = DfdMetaBoxSettings::compared('blog_stun_header', false);

$blog_layout = DfdMetaBoxSettings::compared('blog_layout', false);

$blog_sidebars = DfdMetaBoxSettings::compared('blog_sidebars', false);

$blog_cat_tag = DfdMetaBoxSettings::compared('blog_cat_tag', false);

$vc_content_position = DfdMetaBoxSettings::compared('blog_vc_content_position', false);

if($blog_stun_header != 'off') {
	get_template_part('templates/header/top', 'page');
}

if($blog_cat_tag != 'off') {
	?>
	<div class="blog-top row <?php echo esc_attr($blog_layout) ?>">
		<div class="twelve columns">
			<?php get_template_part('templates/blog', 'top'); ?>
		</div>
	</div>
<?php } ?>

<?php
if(empty($vc_content_position) || $vc_content_position == 'top') {
	get_template_part('templates/portfolio/template', 'top');
}
?>

<section id="layout" class="dfd-blog-loop dfd-equal-height-children">
    <div class="row <?php echo esc_attr($blog_layout) ?>">

        <?php
		if(!empty($blog_sidebars) && $blog_sidebars) {
			switch($blog_sidebars) {
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
	
	<?php get_template_part('templates/loop','blog'); ?>

	<?php
		if(!empty($blog_sidebars) && $blog_sidebars) {
			echo ' </section>';

			if (($blog_sidebars == "2c-l-fixed") || ($blog_sidebars == "3c-fixed")) {
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($blog_sidebars == "3c-l-fixed")){
				get_template_part('templates/sidebar', 'right');
				echo ' </div>';
				get_template_part('templates/sidebar', 'left');
			}
			if ($blog_sidebars == "3c-r-fixed"){
				get_template_part('templates/sidebar', 'left');
				echo ' </div>';
			}
			if (($blog_sidebars == "2c-r-fixed") || ($blog_sidebars == "3c-fixed") || ($blog_sidebars == "3c-r-fixed") ) {
				get_template_part('templates/sidebar', 'right');
			}
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