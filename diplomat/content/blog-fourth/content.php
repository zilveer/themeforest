<?php
$image_size = '745*450';

$post_link = get_permalink($post->ID);
$post_pod_type = get_post_format($post->ID);

$post_types = array(
    'audio',
    'video',
    'quote',
    'gallery',
);
if (!in_array($post_pod_type, $post_types)) {
    $post_pod_type = 'default';
}

$post_title = $post->post_title;
$title_symbols_count = $_REQUEST['title_symbols'];
if ($_REQUEST['title_symbols'])
    $post_title = (strlen($post_title)> $title_symbols_count) ? substr($post_title, 0, $title_symbols_count) . " ..." : $post_title;
?>

<?php include(locate_template('article-'.$post_pod_type.'.php')); ?>

<header class="entry-header">

	<h4 class="entry-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h4>

</header>