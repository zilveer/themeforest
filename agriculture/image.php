<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Images Page Template
 * Created by CMSMasters
 * 
 */


get_header();


echo '<!--_________________________ Start Content _________________________ -->' . "\n" . 
'<section id="middle_content" role="main">' . "\n";


if (have_posts()) : the_post();
	echo '<div class="entry image-attachment">' . "\n";
	
	$metadata = wp_get_attachment_metadata();
	
	echo '<footer class="entry-meta">'; 
		edit_post_link(__('Edit Media', 'cmsmasters'), '<span class="edit-link fr">', '</span>');
		
		echo '<p>' . __('Published', 'cmsmasters') . ' <abbr class="published" title="' . get_the_date() . '">' . get_the_date() . '</abbr> ' . __('at', 'cmsmasters') . ' ' . $metadata['width'] . '&times;' . $metadata['height'] . ' ' . __('in', 'cmsmasters') . ' ' . '<a href="' . esc_url(get_permalink($post->post_parent)) . '" title="' . cmsms_title($post->post_parent, false) . '">' . cmsms_title($post->post_parent, false) . '</a>.</p>' . 
	'</footer>' . 
	'<br />' . 
	'<div class="tac">' . 
		cmsms_thumb(get_the_ID(), 'slider-thumb', false, 'img_' . get_the_ID(), true, true, true, false, get_the_ID()) . 
	'</div>' . 
	'<div class="cl"></div>' . 
	'<br />';
?>
		<div class="navigation" role="navigation">
			<div class="fl"><?php previous_image_link(false, __('&larr; Previous', 'cmsmasters')); ?></div>
			<div class="fr"><?php next_image_link(false, __('Next &rarr;', 'cmsmasters')); ?></div>
			<div class="cl"></div>
			<br />
		</div>
<?php
	
	
	
	echo '</div>' . "\n" . 
	'<div class="divider"></div>';
endif;


comments_template();


echo '</section>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


get_footer();

