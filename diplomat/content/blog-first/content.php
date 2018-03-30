<?php
$post_pod_type = get_post_format($post->ID);
$post_type_values = get_post_meta($post->ID, 'post_type_values', true);

$image_size = '750*590';

$post_link = get_permalink($post->ID);

$post_types = array(
    'audio',
    'video',
    'quote',
    'gallery',
);

if (!in_array($post_pod_type, $post_types) || $post_pod_type=='audio' || $post_pod_type=='video') {
    $post_pod_type = 'default';
}

$entry_media_class = (!has_post_thumbnail($post->ID) && $post_pod_type=='default') ? 'entry-media without-post-thumbnail' : 'entry-media';

$post_title = $post->post_title;
$title_symbols_count = $_REQUEST['title_symbols'];
if ($_REQUEST['title_symbols'])
    $post_title = (strlen($post_title)> $title_symbols_count) ? substr($post_title, 0, $title_symbols_count) . " ..." : $post_title;

$excerpt_symbols_count = ($_REQUEST['excerpt_symbols']) ? $_REQUEST['excerpt_symbols'] : '0';

?>
<div class="<?php echo esc_attr($entry_media_class); ?>">

    <?php include(locate_template('article-'.$post_pod_type.'.php')); ?>

    <?php if ($post_pod_type !== 'quote') { ?>
	    <header class="entry-header">
		    <h3 class="entry-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h3>
	    </header>
    <?php } ?>

</div>

<?php if ($post_pod_type !== 'quote' && $_REQUEST['show_excerpt']) { ?>
	<div class="entry-content">
	    <p>
	        <?php
	        if( strpos( $post->post_content, '<!--more-->' ) ){
	            the_content();
	        } else {
	            if (empty($post->post_excerpt)) {
	                $txt = do_shortcode($post->post_content);
	                $txt = strip_tags($txt);
	                echo (strlen($txt)>$excerpt_symbols_count ) ? (substr($txt, 0, $excerpt_symbols_count) . " ...") : $txt;
	            } else {
	                echo (strlen($post->post_excerpt) > $excerpt_symbols_count) ? (substr($post->post_excerpt, 0, $excerpt_symbols_count) . " ...") : $post->post_excerpt;
	            }
	        }
	        ?>
	    </p>
	</div>
<?php } ?>

<footer class="entry-footer">

	<div class="left">

		<span class="cat-links"><?php echo get_the_category_list(', ', '', $post->ID); ?></span>

	</div>

	<div class="right">

		<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y', $post->ID))); ?>"><?php echo get_the_date(TMM::get_option('date_format'), $post->ID) ?></a></span>

		<span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>

		<?php echo TMM_Helper::get_post_like($post->ID); ?>

	</div>

</footer>
