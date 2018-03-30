<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Timeline Link Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_metadata;


$cmsms_post_metadata = explode(',', $cmsms_metadata);

$date = (in_array('date', $cmsms_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsms_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsms_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsms_post_metadata) || is_home()) ? true : false;
$tags = (get_the_tags() && (in_array('tags', $cmsms_post_metadata) || is_home())) ? true : false;
$more = (in_array('more', $cmsms_post_metadata) || is_home()) ? true : false;


$cmsms_post_link_text = get_post_meta(get_the_ID(), 'cmsms_post_link_text', true);

$cmsms_post_link_address = get_post_meta(get_the_ID(), 'cmsms_post_link_address', true);


if ($cmsms_post_link_text == '') {
	$cmsms_post_link_text = __('Enter link text', 'cmsmasters');
}


if ($cmsms_post_link_address == '') {
	$cmsms_post_link_address = '#';
}

?>

<!--_________________________ Start Link Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_timeline_type'); ?>>
	<div class="cmsms_post_info entry-meta">
		<span class="cmsms_post_format_img cmsms-icon-globe-6"></span>
		
		<?php $date ? cmsms_post_date('page', 'default') : ''; ?>
	</div>
	<div class="cmsms_post_cont">
		<header class="cmsms_post_header entry-header">
		<?php 
			if (!post_password_required()) {
				echo '<h1 class="cmsms_post_title entry-title">' . 
					'<a href="' . $cmsms_post_link_address . '" target="_blank">' . $cmsms_post_link_text . '</a>' . 
				'</h1>' . 
				'<h5 class="cmsms_post_subtitle">' . $cmsms_post_link_address . '</h5>';
			} else {
				echo '<h1 class="cmsms_post_title entry-title">' . $cmsms_post_link_text . '</h1>';
			}
		?>
		</header>
		
	<?php
		if ($author || $categories || $tags) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
			
				$author ? cmsms_post_author('page') : '';
				
				$categories ? cmsms_post_category('page') : '';
				
				$tags ? cmsms_post_tags('page') : '';
				
			echo '</div>';
		} 
		
		cmsms_post_exc_cont(); 
		
		if ($likes || $comments || $more) {
			echo '<footer class="cmsms_post_footer entry-meta">';
			
				if ($likes || $comments) {
					echo '<div class="cmsms_post_meta_info">';
					
						$likes ? cmsms_post_like('page') : '';
						
						$comments ? cmsms_post_comments('page') : '';
					
					echo '</div>';
				}
			
				$more ? cmsms_post_more(get_the_ID()) : '';
		
			echo '</footer>';
		}
	?>
		<div class="cl"></div>
	</div>
</article>
<!--_________________________ Finish Link Article _________________________ -->

