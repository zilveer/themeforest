<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Posts Slider Chat Post Format Template
 * Created by CMSMasters
 * 
 */


global $cmsms_post_metadata;


$cmsms_metadata = explode(',', $cmsms_post_metadata);

$date = in_array('date', $cmsms_metadata) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsms_metadata))) ? true : false;
$likes = in_array('likes', $cmsms_metadata) ? true : false;

?>

<!--_________________________ Start Chat Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<span class="cmsms_slider_post_format_img cmsms-icon-star-7"></span>
	<div class="cmsms_slider_post_cont">
	<?php
		cmsms_slider_post_format_chat();
		
		
		echo '<h1 class="entry-title dn">' . cmsms_title(get_the_ID(), false) . '</h1>';
		
		
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
<!--_________________________ Finish Standard Article _________________________ -->

