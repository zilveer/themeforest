<?php

get_header();

wize_set_views(get_the_ID());

$page_layout = wize_post_sidebar_layout();
$image_id    = get_post_thumbnail_id($post->ID);
$category    = get_the_category();
$aut         = of_get_option('active_author', '1') == '1';

echo '
	<div id="wrap" class="fixed">';
	
switch ($page_layout) {
    case "sidebar-left":
        echo '
	<div id="sng-right">';
    break;
		
    case "sidebar-full":
        echo '
	<div id="blog-full">';
    break;
		
    case "sidebar-right":
        echo '
	<div id="sng-left">';
    break;
}

if (have_posts())
    while (have_posts()):
        the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
        $link     = of_get_option('active_link', '1') == '1';
        $social   = of_get_option('social_sng', '1') == '1';
        
        /* display */
        
        echo '
		<div class="sng-cover">
			<div class="sng-bg"></div>';
            if ($image_id) {
                echo '
			<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
            } else {
                echo '
			<img src="' . esc_url($no_cover) . '/images/no-cover/sng.png" alt="no-cover" />';
            }
            echo '
			<div class="sng-title">	
				<h1>' . get_the_title() . '</h1>	
			</div><!-- end .sng-title -->
			<div class="sng-lvc">
				' . wize_like_info($post->ID) . '
				<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
				<div class="info-com">' . get_comments_number() . '</div>
			</div><!-- end .sng-lvc -->
			<div class="sng-date">' . get_the_time('l, d F Y') . '</div>
			<div class="sng-cat">' . esc_html($category[0]->cat_name, "wizedesign") . '</div>
		</div><!-- end .sng-cover -->
	<div id="sng">';
        echo "<p>" . the_content() . "</p>";  
        echo '
		<div class="sng-bottom fixed">
		' . get_the_tag_list('<div class="sng-tag"><span>' . esc_html__("tags", "wizedesign") . '</span>', ' ', '</div><!-- end .sng-tag -->') . '';
        if ($social) {
            echo '
			<div class="sng-social">
					<span>' . esc_html__("share", "wizedesign") . '</span>
					<a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url(get_permalink()) . '" target="_blank"><div class="sng-facebook"></div></a>
					<a href="https://twitter.com/home?status=' . esc_url(get_permalink()) . '" target="_blank"><div class="sng-twitter"></div></a>
					<a href="https://plus.google.com/share?url=' . esc_url(get_permalink()) . '" target="_blank"><div class="sng-google"></div></a>
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=' . esc_url(get_permalink()) . '" target="_blank"><div class="sng-linkedin"></div></a>
			</div><!-- end .sng-social -->';
        }
		
		wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		
        if ($link) {
            echo '
			<div class="sng-links">
				<div class="sng-links-prev">' . get_previous_post_link() . '</div>
				<div class="sng-links-next">' . get_next_post_link() . '</div>
			</div><!-- end .sng-links -->';
        }
        echo '
		</div><!-- end .sng-bottom fixed -->
	</div><!-- end #sng -->
	';
	
    endwhile;

if ($aut) {
	$author   	   = get_the_author_meta('ID');
    $curauth       = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    $post_count    = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) 
						FROM $wpdb->posts 
						WHERE post_author = '" . $curauth->ID . "' 
						AND post_type = 'post' 
						AND post_status = 'publish'", $post_author, $post_type, $post_status));
    $userID        = get_the_author_meta('ID');
    $comment_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT( * ) 
						AS total FROM {$wpdb->comments}
						WHERE comment_approved = '1'
						AND user_id = '" . $userID . "' ", $comment_approved, $user_id));
    echo '
	<div class="sng-aut">
		<div class="sng-aut-avatar">';
    echo get_avatar(get_the_author_meta('ID'));
    echo '
		</div><!-- end .sng-aut-avatar -->
		<div class="sng-aut-info">
			<p class="user"><a href="' . esc_url(get_author_posts_url($author)) . '">' . $curauth->display_name . '</a></p>
			<p>' . $curauth->description . '</p>
			<p class="info">	' . $post_count . ' ' . esc_html__("posts", "wizedesign") . ' | ' . $comment_count . ' ' . esc_html__("comments", "wizedesign") . '</p> <span class="url"><a href="' . esc_url($curauth->user_url) . '" target="_blank">' . $curauth->user_url . '</a></span>
		</div><!-- end .sng-aut-info -->
	</div><!-- end .sng-aut -->';
}
echo '
	' . comments_template('', true) . '
	</div><!-- end #sng(left&full&right) -->';

switch ($page_layout) {
    case "sidebar-left":
		if ( is_active_sidebar( 'single-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'single-page' );
			echo '
	</div><!-- end .sidebar-left -->';
		}
    break;
	
    case "sidebar-right":
		if ( is_active_sidebar( 'single-page' ) ) {
			echo '
	<div id="sidebar-right">';
		dynamic_sidebar( 'single-page' );
			echo '
	</div><!-- end .sidebar-right -->';
		}
    break;
}

get_footer();