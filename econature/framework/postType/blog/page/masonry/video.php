<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Masonry Video Post Format Template
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


$cmsms_post_video_type = get_post_meta(get_the_ID(), 'cmsms_post_video_type', true);

$cmsms_post_video_link = get_post_meta(get_the_ID(), 'cmsms_post_video_link', true);

$cmsms_post_video_links = get_post_meta(get_the_ID(), 'cmsms_post_video_links', true);


$post_sort_categs = get_the_terms(0, 'category');

if ($post_sort_categs != '') {
	$post_categs = '';
	
	foreach ($post_sort_categs as $post_sort_categ) {
		$post_categs .= ' ' . $post_sort_categ->slug;
	}
	
	$post_categs = ltrim($post_categs, ' ');
}

?>

<!--_________________________ Start Video Article _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_masonry_type'); ?> data-category="<?php echo $post_categs; ?>">
	<span class="cmsms_post_format_img <?php 
			if (is_sticky()) {
				echo ' cmsms-icon-attach-6';
			} else {
				echo ' cmsms-icon-videocam-5';
			}
		?>"></span>
	<div class="cmsms_post_cont">
	<?php
		if (!post_password_required()) {
			if ($cmsms_post_video_type == 'selfhosted' && !empty($cmsms_post_video_links) && sizeof($cmsms_post_video_links) > 0) {
				$video_size = cmsms_image_thumbnail_list();
				
				
				$attrs = array( 
					'preload'  => 'none', 
					'height'   => $video_size['blog-masonry-thumb']['height'], 
					'width'    => $video_size['blog-masonry-thumb']['width'] 
				);
				
				
				if (has_post_thumbnail()) {
					$video_poster = wp_get_attachment_image_src((int) get_post_thumbnail_id(get_the_ID()), 'blog-masonry-thumb');
					
					
					$attrs['poster'] = $video_poster[0];
				}
				
				
				foreach ($cmsms_post_video_links as $cmsms_post_video_link_url) {
					$attrs[substr(strrchr($cmsms_post_video_link_url, '.'), 1)] = $cmsms_post_video_link_url;
				}
				
				
				echo '<div class="cmsms_video_wrap">' . 
					wp_video_shortcode($attrs) . 
				'</div>';
			} elseif ($cmsms_post_video_type == 'embedded' && $cmsms_post_video_link != '') {
				global $wp_embed;
				
				
				$video_size = cmsms_image_thumbnail_list();
				
				
				echo '<div class="cmsms_video_wrap">' . 
					do_shortcode($wp_embed->run_shortcode('[embed width="' . $video_size['blog-masonry-thumb']['width'] . '" height="' . $video_size['blog-masonry-thumb']['height'] . '"]' . $cmsms_post_video_link . '[/embed]')) . 
				'</div>';
			} elseif (has_post_thumbnail()) {
				cmsms_thumb(get_the_ID(), 'blog-masonry-thumb', true, false, true, false, true, true, false);
			}
		}
		
		cmsms_post_heading(get_the_ID(), 'h2');
		
		if ($author || $categories || $tags) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
			
				$author ? cmsms_post_author('page') : '';
				
				$categories ? cmsms_post_category('page') : '';
				
				$tags ? cmsms_post_tags('page') : '';
				
			echo '</div>';
		}
		
		cmsms_post_exc_cont();
		
		if ($date || $likes || $comments || $more) {
			echo '<footer class="cmsms_post_footer entry-meta' . (($more) ? ' tar' : ' tac') . '">';
			
				if ($date || $likes || $comments) {
					echo '<div class="cmsms_post_meta_info">';
					
						$date ? cmsms_post_date('page', 'masonry') : '';
					
						$likes ? cmsms_post_like('page') : '';
						
						$comments ? cmsms_post_comments('page') : '';
					
					echo '</div>';
				}
			
				$more ? cmsms_post_more(get_the_ID()) : '';
		
			echo '</footer>';
		}
	?>
	</div>
</article>
<!--_________________________ Finish Video Article _________________________ -->

