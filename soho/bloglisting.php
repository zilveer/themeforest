<?php
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
if (strlen($featured_image[0])>0) {
	$pf_url = $featured_image[0];
} else {
	$pf_url = gt3_get_theme_option("logo");
}

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());

if(get_the_category()) $categories = get_the_category();
$post_categ = '';
$separator = ', ';
if ($categories) {
    foreach($categories as $category) {
        $post_categ = $post_categ .'<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
    }
}

if(get_the_tags() !== '') {
    $posttags = get_the_tags();

}
if ($posttags) {
    $post_tags = '';
    $post_tags_compile = '<span class="preview_meta_tags">tags:';
    foreach($posttags as $tag) {
        $post_tags = $post_tags . '<a href="?tag='.$tag->slug.'">'.$tag->name .'</a>'. ', ';
    }
    $post_tags_compile .= ' '.trim($post_tags, ', ').'</span>';
} else {
    $post_tags_compile = '';
}
	if (!isset($pf)) {
		$compile = '';
	}
	$featured_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);

	if (strlen($featured_image[0]) > 0) {
		$hasImage = 'hasImage';
		$featured_img = '<div class="preview_image"><img src="'. aq_resize($featured_image[0], "570", "490", true, true, true) .'" alt="'.$featured_alt.'" /></div>';
	} else {
		$hasImage = 'noImage';
		$featured_img = '';
	}

	$compile .= '<div class="preview_type1 blog_post_preview '. $hasImage .'">';
	$compile .= $featured_img .'
			<div class="preview_content">
				<div class="preview_top_wrapper">
					<h4 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
					<div class="listing_meta">
						'. __('by', 'theme_localization') .' <a href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author_meta('display_name').'</a><span class="middot">&middot;</span>
						<span>'. get_the_time("F d, Y") .'</span><span class="middot">&middot;</span>
						<span>'. __('in', 'theme_localization') .' '.trim($post_categ, ', ').'</span><span class="middot">&middot;</span>
						<span><a href="' . get_comments_link() . '">'. get_comments_number(get_the_ID()) .' '. __('comments', 'theme_localization') .'</a></span>
						'.$post_tags_compile.'
					</div>
				</div>';		
	$compile .= '<article class="contentarea">
					' . ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content())   . '
					<br class="clear">
					<a href="'. get_permalink() .'" class="preview_read_more">'. __('Read More', 'theme_localization') .'</a>
				</article>
			</div>
	</div><!--.blog_post_preview -->';
	
	echo $compile;

	$GLOBALS['showOnlyOneTimeJS']['BlogListing'] = "
		<script>
			jQuery(document).ready(function($) {				
				jQuery('.pf_output_container').each(function(){
					if (jQuery(this).html() == '') {
						jQuery(this).parents('.post_preview_wrapper').addClass('no_pf');
					} else {
						jQuery(this).parents('.post_preview_wrapper').addClass('has_pf');
					}
				});
				iframe16x9(jQuery('.blog_post_preview'));
			});
			jQuery(window).resize(function(){
				iframe16x9(jQuery('.blog_post_preview'));
			});
			jQuery(window).load(function(){
				iframe16x9(jQuery('.blog_post_preview'));
			});
		</script>
	";
			$GLOBALS['showOnlyOneTimeJS']['gallery_likes'] = "
			<script>
				jQuery(document).ready(function($) {
					jQuery('.gallery_likes_add').click(function(){
					var gallery_likes_this = jQuery(this);
					if (!jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'))) {
						jQuery.post(gt3_ajaxurl, {
							action:'add_like_attachment',
							attach_id:jQuery(this).attr('data-attachid')
						}, function (response) {
							jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'), 'true', { expires: 7, path: '/' });
							gallery_likes_this.addClass('already_liked');
							gallery_likes_this.find('i').removeClass('icon-heart-o').addClass('icon-heart');
							gallery_likes_this.find('span').text(response);
						});
					}
					});
				});
			</script>
			";	
?>
