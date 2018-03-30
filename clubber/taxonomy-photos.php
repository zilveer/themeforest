<?php
/*
Template Name: Photo
*/
?>

<?php
get_header();
?>


<div id="content">

<div class="title-head"><h1><?php
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
?>
</h1></div>

<?php
$term      = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$photos_nr = of_get_option('nr_photos');
$query     = array(
    'post_type' => 'photo',
    'posts_per_page' => $photos_nr,
    'paged' => $paged,
    'taxonomy' => 'photos',
	'term' => $term->slug
);
$wp_query  = new WP_Query($query);
echo '
<div class="fixed">';
echo '
  <div class="col-post-media">
    <div class="post-media">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    global $post;
    $results = $wp_query->post_count;
    $items_count = 0;
    $items_count++;
    $image_id = get_post_thumbnail_id();
    $cover    = wp_get_attachment_image_src($image_id, 'photo-archive');
    echo '                                       
        <div class="media-arc last-p">
          <div class="photo-arc-cover bar-arc-photo">
            <a href="' . get_permalink() . '">';
    if ($image_id) {
        echo '
              <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
    } else {
        echo '
              <img src="' . get_template_directory_uri() . '/images/no-featured/photo-video.png" alt="no image" />';
    }
    echo '
              <div class="media-title mosaic-overlay">';
if (strlen($post->post_title) > 32) {
echo substr(the_title($before = '', $after = '', FALSE), 0, 33) . '...'; } else {
the_title();
}
    echo '</div>
            </a>
          </div><!-- end .photo-arc-cover -->
          </div><!-- end .media-arc last-p -->';
endwhile;
echo '
    </div><!-- end .post-media -->
  </div><!-- end .col-post-media -->';
?>

  <div class="pagination-pos">
        <?php
if (function_exists("pagination")) {
    pagination();
}
?>
  </div><!-- end .pagination-pos -->
    
</div><!-- end .fixed -->
</div><!-- end #content -->

	
<?php
get_footer();
?>