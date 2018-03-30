<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Portfolio Page Full Width Album Project Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


global $cmsms_page_full_columns;


if (!$cmsms_page_full_columns) {
    $cmsms_page_full_columns = 'four_columns';
}

if ($cmsms_page_full_columns == 'four_columns' || $cmsms_page_full_columns == 'three_columns') {
    $pj_img_size = 'project-thumb';
} elseif ($cmsms_page_full_columns == 'two_columns') {
    $pj_img_size = 'project-thumb-half';
} elseif ($cmsms_page_full_columns == 'one_column') {
    $pj_img_size = 'project-thumb-full';
}


$cmsms_project_featured_image_show = get_post_meta(get_the_ID(), 'cmsms_project_featured_image_show', true);
 
$cmsms_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsms_project_images', true))));

$pj_sort_categs = get_the_terms(0, 'pj-sort-categs');

if ($pj_sort_categs != '') {
	$pj_categs = '';
	
	foreach ($pj_sort_categs as $pj_sort_categ) {
		$pj_categs .= ' ' . $pj_sort_categ->slug;
	}
	
	$pj_categs = ltrim($pj_categs, ' ');
}

?>

<!--_________________________ Start Album Project _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class('format-album'); ?> data-category="<?php echo $pj_categs; ?>">
<?php 
	if (has_post_thumbnail() && $cmsms_project_featured_image_show == 'true') {
		echo '<div class="media_box">' . 
			cmsms_thumb(get_the_ID(), $pj_img_size, true, false, true, false, true, false, false) . 
		'</div>';
	} else if (sizeof($cmsms_project_images) > 0) {
		echo '<div class="media_box">' . 
			cmsms_thumb(get_the_ID(), $pj_img_size, false, 'img_' . get_the_ID(), true, false, true, false, $cmsms_project_images[0]) . 
		'</div>';
	}
	
	if (sizeof($cmsms_project_images) > 1 && $cmsms_project_featured_image_show != 'true') {
		unset($cmsms_project_images[0]);
		
		echo '<div class="dn">';
		
		foreach ($cmsms_project_images as $cmsms_project_image) {
			$link_href = wp_get_attachment_image_src($cmsms_project_image, 'full');
			
			echo '<figure>' . 
				'<a href="' . $link_href[0] . '" data-group="img_' . get_the_ID() . '" title="' . cmsms_title(get_the_ID(), false) . '" class="preloader highImg jackbox">' . 
					wp_get_attachment_image($cmsms_project_image, $pj_img_size, false, array( 
						'class' => 'fullwidth', 
						'alt' => cmsms_title(get_the_ID(), false), 
						'title' => cmsms_title(get_the_ID(), false) 
					)) . 
				'</a>' . 
			'</figure>';
		}
		
		echo '</div>';
	}
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_portfolio_full_title']) {
		cmsms_heading(get_the_ID(), 'project', true, 'h4');
	}
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_portfolio_full_content'] && theme_excerpt(1, false)) {
		echo '<div class="entry-content">' . 
			'<p>' . theme_excerpt(20, false) . '</p>' . 
		'</div>';
	}
	
	cmsms_meta('project', 'page', get_the_ID(), 'pj-sort-categs', 'fullwidth');
?>
</article>
<!--_________________________ Finish Album Project _________________________ -->

