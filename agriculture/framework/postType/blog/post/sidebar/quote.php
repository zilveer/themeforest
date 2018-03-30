<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Post with Sidebar Quote Post Format Template
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
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_cat'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_blog_post_author']
	) {
		echo '<footer class="entry-meta">';
			
			cmsms_post_like('post', 'post');
		
			cmsms_post_date('post', 'post');
			
			if (!post_password_required()) {
				cmsms_comments('post', 'post');
			}
			
			cmsms_meta('post', 'post');
			
		echo '</footer>';
	}
		
	echo '<div class="entry-content">' . "\n";
	
	the_content();
	
	wp_link_pages(array( 
		'before' => '<div class="subpage_nav" role="navigation">' . '<strong>' . __('Pages', 'cmsmasters') . ':</strong>', 
		'after' => '</div>' . "\n", 
		'link_before' => ' [ ', 
		'link_after' => ' ] ' 
	));
	
	cmsms_content_composer(get_the_ID());
	
	echo "\t\t" . '</div>' . "\n" . 
	'<div class="cl"></div>';
	
	cmsms_tags(get_the_ID(), 'post', 'post'); 
	?>
</article>
<!--_________________________ Finish Quote Article _________________________ -->

