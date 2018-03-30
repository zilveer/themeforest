<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Masonry Chat Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_metadata;


$cmsms_post_metadata = explode(',', $cmsms_metadata);

$date = (in_array('date', $cmsms_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsms_post_metadata) || is_home()) ? true : false;


$post_sort_categs = get_the_terms(0, 'category');

if ($post_sort_categs != '') {
	$post_categs = '';
	
	foreach ($post_sort_categs as $post_sort_categ) {
		$post_categs .= ' ' . $post_sort_categ->slug;
	}
	
	$post_categs = ltrim($post_categs, ' ');
}

?>

<!--_________________________ Start Chat Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_masonry_type'); ?> data-category="<?php echo $post_categs; ?>">
	<span class="cmsms_post_format_img <?php 
			if (is_sticky()) {
				echo ' cmsms-icon-attach-6';
			} else {
				echo ' cmsms-icon-star-7';
			}
		?>"></span>
	<div class="cmsms_post_cont">
	<?php
		cmsms_post_format_chat();
		
		
		echo '<h1 class="entry-title dn">' . cmsms_title(get_the_ID(), false) . '</h1>';
		
		
		if ($date || $likes || $comments) {
			echo '<footer class="cmsms_post_footer entry-meta tac">';
				
				if ($date || $likes || $comments) {
					echo '<div class="cmsms_post_meta_info">';
					
						$date ? cmsms_post_date('page', 'masonry') : '';
						
						$likes ? cmsms_post_like('page') : '';
						
						$comments ? cmsms_post_comments('page') : '';
						
					echo '</div>';
				}
				
			echo '</footer>';
		}
	?>
	</div>
</article>
<!--_________________________ Finish Standard Article _________________________ -->

