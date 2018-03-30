<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Blog Page Masonry Quote Post Format Template
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


$cmsms_post_quote_text = get_post_meta(get_the_ID(), 'cmsms_post_quote_text', true);

$cmsms_post_quote_author = get_post_meta(get_the_ID(), 'cmsms_post_quote_author', true);


$post_sort_categs = get_the_terms(0, 'category');

if ($post_sort_categs != '') {
	$post_categs = '';
	
	foreach ($post_sort_categs as $post_sort_categ) {
		$post_categs .= ' ' . $post_sort_categ->slug;
	}
	
	$post_categs = ltrim($post_categs, ' ');
}

?>

<!--_________________________ Start Quote Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_masonry_type'); ?> data-category="<?php echo $post_categs; ?>">
	<span class="cmsms_post_format_img <?php 
			if (is_sticky()) {
				echo ' cmsms-icon-attach-6';
			} else {
				echo ' cmsms-icon-comment-6';
			}
		?>"></span>
	<div class="cmsms_post_cont">
	<?php 
		if (!post_password_required()) {
			echo '<blockquote class="entry-content cmsms_quote_content">';
			
				if ($cmsms_post_quote_text != '') {
					echo '<p>' . str_replace("\n", '<br />', $cmsms_post_quote_text) . '</p>';
				} else {
					echo '<p>' . theme_excerpt(55, false) . '</p>';
				}
				
			echo '</blockquote>';
		} else {
			echo '<p>' . __('There is no excerpt because this is a protected post.', 'cmsmasters') . '</p>';
		}
		
		
		echo '<h1 class="entry-title dn">' . cmsms_title(get_the_ID(), false) . '</h1>';
		
		
		if ($cmsms_post_quote_author != '' && !post_password_required()) {
			echo '<p class="cmsms_quote_author">' . $cmsms_post_quote_author . '</p>' . "\n";
		}
		
		
		if ($author || $categories || $tags) {
			echo '<div class="cmsms_post_cont_info entry-meta">';
			
				$author ? cmsms_post_author('page') : '';
				
				$categories ? cmsms_post_category('page') : '';
				
				$tags ? cmsms_post_tags('page') : '';
				
			echo '</div>';
		}
		
		
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
<!--_________________________ Finish Quote Article _________________________ -->

