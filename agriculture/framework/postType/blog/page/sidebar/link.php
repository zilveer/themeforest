<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Page with Sidebar Link Post Format Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();
 
 
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
	<header class="entry-header">
		<span class="cmsms_post_format_img"></span>
	<?php 
		if (!post_password_required()) {
			echo '<h1 class="entry-title">' . 
				'<a href="' . $cmsms_post_link_address . '" target="_blank">' . $cmsms_post_link_text . '</a>' . 
			'</h1>' . "\n" . 
			'<h5>- ' . $cmsms_post_link_address . ' -</h5>';
		} else {
			echo '<h1 class="entry-title">' . $cmsms_post_link_text . '</h1>';
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
	
	cmsms_exc_cont();
	
	echo '<div class="cl"></div>';
	
	cmsms_more(get_the_ID(), 'post');
	
	cmsms_tags(get_the_ID(), 'post', 'page'); 
	?>
</article>
<!--_________________________ Finish Link Article _________________________ -->

