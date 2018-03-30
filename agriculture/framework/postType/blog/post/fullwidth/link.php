<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Blog Post Full Width Link Post Format Template
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
<!--_________________________ Finish Link Article _________________________ -->

