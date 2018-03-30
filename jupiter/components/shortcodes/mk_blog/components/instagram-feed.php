<?php
if (empty($view_params['url'])) return false;

//delete_post_meta(get_the_ID() , '_blog_instagram_feed');

if (!$view_params['url']) return false;

if (!get_post_meta(get_the_ID() , '_blog_instagram_feed')) {
    
    $args = array(
        'httpversion' => '1.1',
        'blocking' => true,
    );

    $api_url = "https://api.instagram.com/oembed?url=".$view_params['url'];
    $response = wp_remote_get($api_url, $args);
    
    $response = json_decode(wp_remote_retrieve_body($response) , true);

    
    update_post_meta(get_the_ID() , '_blog_instagram_feed', $response);
}

$feed =  get_post_meta(get_the_ID() , '_blog_instagram_feed', true);
$title = isset($feed['title']) ? esc_attr($feed['title']) : the_title_attribute(array('echo' => false));
?>
<div class="mk-blog--instagram-wrapper">
    <div class="mk-blog--instagram-container">
        <a class="instagram-image" href="<?php echo $view_params['url']; ?>" target="_blank">
            <img alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo $feed['thumbnail_url']; ?>" width="<?php echo $feed['thumbnail_width']; ?>" width="<?php echo $feed['thumbnail_height']; ?>">
        </a>
        <?php //mk_get_shortcode_view('mk_blog', 'components/meta', false); ?>
        <h1 class="instagram-title">
            <i class="mk-icon-instagram"></i>
            <span> 
                <?php echo $title; ?>
                <a href="<?php echo $feed['author_url'];?>" target="_blank">@<?php echo $feed['author_name'];?></a>
            </span>
        </h1>
    </div>
</div>