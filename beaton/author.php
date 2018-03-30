<?php

get_header();

$aut = get_the_author_meta('ID');
$query = array(
    'post_type' => 'post',
	'author' => $aut,
    'paged' => $paged
);

echo '	
	<div id="wrap" class="fixed">
	
	<div id="blog-right">';

$curauth       = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$post_count    = $wpdb->get_var( $wpdb->prepare(
					   "SELECT COUNT(*) 
						FROM $wpdb->posts 
						WHERE post_author = '" . $curauth->ID . "' 
						AND post_type = 'post' 
						AND post_status = 'publish'",
						$post_author,
						$post_type,
						$post_status
						) );
$userID 	   = get_the_author_meta('ID');
$where 		   = 'WHERE comment_approved = 1 AND user_id = ' . $userID ;
$comment_count = $wpdb->get_var( $wpdb->prepare(
						"SELECT COUNT( * ) 
						AS total FROM {$wpdb->comments}
						WHERE comment_approved = '1'
						AND user_id = '" . $userID . "' ",
						$comment_approved,
						$user_id
						) );								 
$wp_query      = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'Bl2Sng');
        $no_cover = get_template_directory_uri();
        $category = get_the_category();
		
       	/* display */
		
        echo '
		<div class="bl2 fixed">
			<div class="bl2-cover">';
        if ($image_id) {
            echo '
				<img src="' . esc_url($cover[0]) . '" alt="' . esc_attr(get_the_title()) . '" />';
        } else {
            echo '
				<img src="' . esc_url($no_cover) . '/images/no-cover/bl2.png" alt="no-cover" />';
        }
        echo '
				<div class="bl2-cat">' . $category[0]->cat_name . '</div>		
			</div><!-- end .bl2-cover -->
			<div class="bl2-text">
				<div class="bl2-title">
					<h2><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>
				</div><!-- end .bl2-title -->
				<p>' . wize_excerpt(550) . '</p>
				<div class="bl2-lvc">
					' . wize_like_info($post->ID) . '
					<div class="info-view">' . wize_get_views(get_the_ID()) . '</div>
					<div class="info-com">' . get_comments_number() . '</div>
				</div><!-- end .bl2-lvc -->
				<div class="bl2-date">' . get_the_date('l, d F Y') . '</div>
			</div><!-- end .bl2-text -->';
        if (is_sticky()) {
            echo '
			<div class="sticky">' . esc_html__("Featured", "wizedesign") . '</div>';
        }
        echo '
		</div><!-- end .bl2 fixed -->';
		
    endwhile;

if (function_exists("wize_pagination")) {
    wize_pagination();
}

echo '
	</div><!-- end #blog-right -->

	<div id="sidebar-left">
		<div id="author-info">
	' . wp_link_pages() . '
			<div class="author-avatar">
				' . get_avatar(get_the_author_meta('ID')) . '
				<p class="aut">' . $curauth->display_name . '</p>
				<p class="nr">	' . $post_count . ' posts</p>
				<p class="com">' . $comment_count . ' comments</p>
			</div><!-- end .author-avatar -->
			<div class="author-description">
				<p>' . $curauth->description . '</p>
				<p class="url"><a href="' . esc_url($curauth->user_url) . '" target="_blank">' . $curauth->user_url . '</a></p>
			</div><!-- end .author-description -->
		</div><!-- end .author-info -->
	</div><!-- end #sidebar-left -->';

get_footer();
?>

<div id="display-none">
	<?php posts_nav_link(); ?>
	<?php the_post_thumbnail(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>></div>
</div><!-- end #display-none -->