<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

while (have_posts()) : the_post();

$blog_style = DfdMetaBoxSettings::compared('blog_single_style', false);

if(!$blog_style || empty($blog_style)) {
	$blog_style = 'base';
}

$blog_stun_header = DfdMetaBoxSettings::compared('blog_single_stun_header', false);

$blog_layout = DfdMetaBoxSettings::compared('blog_single_layout', false);

$blog_sidebars = DfdMetaBoxSettings::compared('blog_single_sidebars', false);

$blog_class = $blog_layout;

if($blog_stun_header != 'off') {
	get_template_part('templates/header/top', 'page');
}

if(empty($blog_layout) || $blog_layout == 'boxed') {
	$blog_class .= ' row';
}

$blog_class .= ' dfd-single-style-'.$blog_style;

$blog_single_enable_pagination = DfdMetaBoxSettings::compared('blog_single_enable_pagination', false);

if($blog_single_enable_pagination == 'on') {
	$blog_single_pagination_style = DfdMetaBoxSettings::compared('blog_single_pagination_style', false);

	if($blog_single_pagination_style) { ?>
		<div class="row dfd-pagination-<?php echo esc_attr($blog_layout) ?>">
			<div class="twelve columns">
				<?php get_template_part('templates/pagination', 'links'); ?>
				<?php get_template_part('templates/entry-meta/blog-top-link'); ?>
			</div>
		</div>
	<?php } else {
		get_template_part('templates/inside-pagination');
	}
	
}

?>

<section id="layout" class="single-post dfd-equal-height-children">
	<div class="single-post dfd-single-layout-<?php echo esc_attr($blog_class) ?>">

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
			set_layout('single', true);
		}
		
		if (!post_password_required()) {
			get_template_part('templates/blog/single',$blog_style);
		} else {
			echo get_the_password_form();
		}
		
		comments_template();

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
			echo '</div>';
        } else {
			set_layout('single', false);
		}
        ?>

        <?php endwhile; ?>

    </div>
	<?php
		if (isset($dfd_ronneby['blog_items_disp']) && $dfd_ronneby['blog_items_disp'] && isset($dfd_ronneby['block_single_blog_item']) && $dfd_ronneby['block_single_blog_item'] && $blog_style == 'base') { ?>
			<div class="block-under-single-post">
				<div class="row">
					<?php echo do_shortcode($dfd_ronneby['block_single_blog_item']); ?>
				</div>
			</div>
	<?php } ?>
</section>