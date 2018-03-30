<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Posts Slider Link Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_post_metadata;


$cmsms_metadata = explode(',', $cmsms_post_metadata);

$excerpt = in_array('excerpt', $cmsms_metadata) ? true : false;
$date = in_array('date', $cmsms_metadata) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsms_metadata))) ? true : false;
$author = in_array('author', $cmsms_metadata) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_metadata))) ? true : false;
$likes = in_array('likes', $cmsms_metadata) ? true : false;


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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<span class="cmsms_slider_post_format_img cmsms-icon-globe-6"></span>
	<div class="cmsms_slider_post_cont">
		<header class="cmsms_slider_post_header entry-header">
		<?php 
			if (!post_password_required()) {
				echo '<h3 class="cmsms_slider_post_title entry-title">' . 
					'<a href="' . $cmsms_post_link_address . '" target="_blank">' . $cmsms_post_link_text . '</a>' . 
				'</h3>' . 
				'<h5 class="cmsms_slider_post_subtitle">' . $cmsms_post_link_address . '</h5>';
			} else {
				echo '<h1 class="cmsms_slider_post_title entry-title">' . $cmsms_post_link_text . '</h1>';
			}
		?>
		</header>
	<?php
		if ($author || $categories) {
			echo '<div class="cmsms_slider_post_cont_info entry-meta">';
			
				$author ? cmsms_slider_post_author('post') : '';
				
				$categories ? cmsms_slider_post_category('post') : '';
				
			echo '</div>';
		}
		
		
		$excerpt ? cmsms_slider_post_exc_cont('post') : '';
		
		
		if ($date || $likes || $comments) {
			echo '<footer class="cmsms_slider_post_footer entry-meta">' . 
				'<div class="cmsms_slider_post_meta_info">';
				
					$comments ? cmsms_slider_post_comments('post') : '';
					
					$likes ? cmsms_slider_post_like('post') : '';
				
					$date ? cmsms_slider_post_date('post') : '';
				
				echo '</div>' . 
			'</footer>';
		}
	?>
	</div>
</article>
<!--_________________________ Finish Link Article _________________________ -->

