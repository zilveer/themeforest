<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Single Testimonial Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


get_header();


$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) {
    $cmsms_layout = 'r_sidebar';
}

$cmsms_testimonial_post_share_box = get_post_meta(get_the_ID(), 'cmsms_testimonial_post_share_box', true);

$cmsms_testimonial_more_posts = get_post_meta(get_the_ID(), 'cmsms_testimonial_more_posts', true);


echo '<!--_________________________ Start Content _________________________ -->' . "\n";
if ($cmsms_layout == 'r_sidebar') {
	echo '<section id="content" role="main">' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<section id="content" class="fr" role="main">' . "\n";
} else {
	echo '<section id="middle_content" role="main">' . "\n";
}

if (have_posts()) : the_post();
	echo "\t" . '<div class="entry">' . "\n\t\t" . 
		'<section class="opened-article">' . "\n";
?>
<!--_________________________ Start Aside Article _________________________ -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	$cmsms_testimonial_author = get_post_meta(get_the_ID(), 'cmsms_testimonial_author', true);
	
	$cmsms_testimonial_author_link = get_post_meta(get_the_ID(), 'cmsms_testimonial_author_link', true);
	
	$cmsms_testimonial_company = get_post_meta(get_the_ID(), 'cmsms_testimonial_company', true);
	
	
	echo '<div class="tl-content_wrap">' .  "\n\t\t";
		if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_author_avatar'] && has_post_thumbnail()) {
			echo '<figure class="tl_author_img">' . 
				get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
					'alt' => cmsms_title(get_the_ID(), false), 
					'title' => cmsms_title(get_the_ID(), false), 
					'style' => 'width:125px; height:125px;' 
				)) . 
			'</figure>' . "\n";
		} else {
			echo '';
		}
		
		echo '<div class="tl-content">' . 
			'<blockquote>' . 
				'<p>' . theme_excerpt(60, false) . '</p>' . 
			'</blockquote>' .  "\r\t";
	
	
			if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_page_author_descr'] && ($cmsms_testimonial_author != '' || $cmsms_testimonial_company != '')) {
				echo '<div class="tl_author_info">';
				if ( 
					$cmsms_testimonial_author != '' && 
					$cmsms_testimonial_author_link != '' 
				) {
					echo '<p class="tl_author"><a target="_blank" href="' . $cmsms_testimonial_author_link . '">' . $cmsms_testimonial_author . '</a></p>' . "\n";
				} elseif ($cmsms_testimonial_author != '') {
					echo '<p class="tl_author">' . $cmsms_testimonial_author . '</p>' . "\n";
				}
				
				if ($cmsms_testimonial_company != '') {
					if ($cmsms_testimonial_author != '') {
						echo ' / ';
					}
					echo '<p class="tl_company">' . $cmsms_testimonial_company . '</p>' . "\n";
				}
				echo '</div>';
			}
	
	
		echo '</div>' . 
	'</div>' . "\n";
	if (
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_like'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_date'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_comment'] || 
		$cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_cat']
	) {
		echo '<div class="tl_info">';
		
			cmsms_post_like('testimonial');
			
			cmsms_post_date('testimonial', 'post');
			
			cmsms_comments('post', 'testimonial');
		
			cmsms_tl_cat(get_the_ID(), 'tl-categs', 'post');
		
		echo '</div>';
	}
?>
</article>
<?php
	if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_nav_box']) {
		echo '<aside class="project_navi">' . "\n\t";
		
		next_post_link('%link');
		
		previous_post_link('%link');
		
		echo '</aside>' . "\n";
	}
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_share_box']) { 
		echo '<aside class="share_posts">' . "\n\t" . 
			'<h3>' . __('Like this post?', 'cmsmasters') . '</h3>' . "\n";
?>
	<div class="fl">
		<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"><?php _e('Tweet', 'cmsmasters'); ?></a>
		<script type="text/javascript">
			!function (d, s, id) { 
				var js = undefined, 
					fjs = d.getElementsByTagName(s)[0];
				
				if (d.getElementById(id)) { 
					d.getElementById(id).parentNode.removeChild(d.getElementById(id));
				}
				
				js = d.createElement(s);
				js.id = id;
				js.src = '//platform.twitter.com/widgets.js';
				
				fjs.parentNode.insertBefore(js, fjs);
			} (document, 'script', 'twitter-wjs');
		</script>
	</div>
	<div class="fl">
		<div class="g-plusone" data-size="medium"></div>
		<script type="text/javascript">
			(function () { 
				var po = document.createElement('script'), 
					s = document.getElementsByTagName('script')[0];
				
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				
				s.parentNode.insertBefore(po, s);
			} )();
		</script>
	</div>
	<div class="fl">
		<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink(get_the_ID())); ?>" class="pin-it-button" count-layout="horizontal">
			<img border="0" src="//assets.pinterest.com/images/PinExt.png" title="<?php _e('Pin It', 'cmsmasters'); ?>" />
		</a>
		<script type="text/javascript">
			(function (d, s, id) { 
				var js = undefined, 
					fjs = d.getElementsByTagName(s)[0];
				
				if (d.getElementById(id)) { 
					d.getElementById(id).parentNode.removeChild(d.getElementById(id));
				}
				
				js = d.createElement(s);
				js.id = id;
				js.src = '//assets.pinterest.com/js/pinit.js';
				
				fjs.parentNode.insertBefore(js, fjs);
			} (document, 'script', 'pinterest-wjs'));
		</script>
	</div>
	<div class="fl">
		<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div>
		<script type="text/javascript">
			(function (d, s, id) { 
				var js = undefined, 
					fjs = d.getElementsByTagName(s)[0];
				
				if (d.getElementById(id)) { 
					d.getElementById(id).parentNode.removeChild(d.getElementById(id));
				}
				
				js = d.createElement(s);
				js.id = id;
				js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
				
				fjs.parentNode.insertBefore(js, fjs);
			} (document, 'script', 'facebook-jssdk'));
		</script>
	</div>
	<div class="cl"></div>
	<a class="cmsms_share" href="#"><span><?php _e('Need more sharing options?', 'cmsmasters'); ?></span></a>
	<div class="cmsms_social cl"></div>
<?php 
		echo '</aside>' . "\n";
	}
	
	if (is_array($cmsms_testimonial_more_posts)) {
		cmsms_related( 
			false, 
			null, 
			in_array('popular', $cmsms_testimonial_more_posts), 
			in_array('recent', $cmsms_testimonial_more_posts), 
			$cmsms_option[CMSMS_SHORTNAME . '_testimonial_post_p_l_number'], 
			'testimonial' 
		);
	}
	
	comments_template(); 
	
	echo '</section>' . "\r\t" . 
	'</div>' . "\n";
endif;

echo '</section>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<section id="sidebar" class="fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</section>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

