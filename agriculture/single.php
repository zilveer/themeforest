<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Single Post Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();


get_header();


$cmsms_layout = get_post_meta(get_the_ID(), 'cmsms_layout', true);

if (!$cmsms_layout) {
    $cmsms_layout = 'r_sidebar';
}

$cmsms_post_sharing_box = get_post_meta(get_the_ID(), 'cmsms_post_sharing_box', true);
$cmsms_post_author_box = get_post_meta(get_the_ID(), 'cmsms_post_author_box', true);
$cmsms_post_more_posts = get_post_meta(get_the_ID(), 'cmsms_post_more_posts', true);


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
		'<section class="blog opened-article">' . "\n";
	
	if ($cmsms_layout == 'fullwidth') {
		if (get_post_format() != '') {
			get_template_part('framework/postType/blog/post/fullwidth/' . get_post_format());
		} else {
			get_template_part('framework/postType/blog/post/fullwidth/standard');
		}
	} else {
		if (get_post_format() != ''){
			get_template_part('framework/postType/blog/post/sidebar/' . get_post_format());
		} else {
			get_template_part('framework/postType/blog/post/sidebar/standard');   
		}
	}
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_nav_box']) {
		echo '<aside class="project_navi">' . "\n\t";
		
		next_post_link('%link');
		
		previous_post_link('%link');
		
		echo "\n" . '</aside>' . "\n";
	}
	
	if ($cmsms_post_sharing_box == 'true') {
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
	
	if ($cmsms_post_author_box == 'true') {
		$user_email = get_the_author_meta('user_email') ? get_the_author_meta('user_email') : false;
		$user_nicename = get_the_author_meta('user_nicename') ? get_the_author_meta('user_nicename') : false;
		$user_first_name = get_the_author_meta('first_name') ? get_the_author_meta('first_name') : false;
		$user_last_name = get_the_author_meta('last_name') ? get_the_author_meta('last_name') : false;
		$user_description = get_the_author_meta('description') ? get_the_author_meta('description') : false;
		
		echo '<aside class="about_author">' . "\n\t" . 
			'<h6>' . __('About author', 'cmsmasters') . '</h6>' . "\n\t" .
			'<div class="about_author_inner">' . "\n\t\t";
		
		$out = '';
		
		if ($user_first_name) {
			$out .= $user_first_name;
		}
		
		if ($user_first_name && $user_last_name) {
			$out .= ' ' . $user_last_name;
		} elseif ($user_last_name) {
			$out .= $user_last_name;
		}
		
		if (get_the_author() && ($user_first_name || $user_last_name)) {
			$out .= ' (';
		}
		
		if (get_the_author()) {
			$out .= get_the_author();
		}
		
		if (get_the_author() && ($user_first_name || $user_last_name)) {
			$out .= ')';
		}
		
		echo '<figure class="alignleft">' . "\n\t\t\t" . 
			get_avatar($user_email, 70) . "\r\t\t" . 
		'</figure>' . 
		'<div class="ovh">' . "\n\t\t";
	
		if ($out != '') {
			echo '<h6>' . $out . '</h6>' . "\n\t\t";
		}
		
		if ($user_description) {
			echo '<p>' . str_replace("\n", '<br />', $user_description) . '</p>' . "\r\t";
		}
		
			echo '</div>' . "\r" . 
			'</div>' . "\r" . 
		'</aside>' . "\n";
	}
	
	if (get_the_tags()) {
		$tgsarray = array();
		
		foreach (get_the_tags() as $tagone) {
			$tgsarray[] = $tagone->term_id;
		}  
	} else {
		$tgsarray = null;
	}
	
	if (is_array($cmsms_post_more_posts)) {
		cmsms_related( 
			in_array('related', $cmsms_post_more_posts), 
			$tgsarray, 
			in_array('popular', $cmsms_post_more_posts), 
			in_array('recent', $cmsms_post_more_posts), 
			$cmsms_option[CMSMS_SHORTNAME . '_blog_post_r_p_l_number'] 
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

