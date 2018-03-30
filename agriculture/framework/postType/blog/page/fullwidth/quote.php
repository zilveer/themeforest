<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page Full Width Quote Post Format Template
 * Created by CMSMasters
 * 
 */

 
$cmsms_option = cmsms_get_global_options(); 


$cmsms_post_quote_text = get_post_meta(get_the_ID(), 'cmsms_post_quote_text', true);

$cmsms_post_quote_author = get_post_meta(get_the_ID(), 'cmsms_post_quote_author', true);

?>

<!--_________________________ Start Quote Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<span class="cmsms_post_format_img"></span>
	<?php if (!post_password_required()) { ?>
		<blockquote>
		<?php 
			if ($cmsms_post_quote_text != '') {
				echo "\t" . '<p>' . str_replace("\n", '<br />', $cmsms_post_quote_text) . '</p>' . "\n";
			} else {
				echo "\t" . '<p>' . theme_excerpt(55, false) . '</p>' . "\n";
			}
		?>
		</blockquote>
	<?php 
			if ($cmsms_post_quote_author != '') {
				echo '<p class="quote-author">' . $cmsms_post_quote_author . '</p>' . "\n";
			}
		} else {
			echo '<p>' . __('There is no excerpt because this is a protected post.', 'cmsmasters') . '</p>';
		}
	?>
	</header>
	<?php 
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_cat'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_page_author']
	) {
		echo '<footer class="entry-meta">';
			
			cmsms_post_like('post', 'page');
		
			cmsms_post_date('post', 'page');
			
			if (!post_password_required()) {
				cmsms_comments('page', 'post');
			}
			
			cmsms_meta('post', 'page');
			
		echo '</footer>';
	}
	
	cmsms_tags(get_the_ID(), 'post', 'page'); 
	?>
</article>
<!--_________________________ Finish Quote Article _________________________ -->

