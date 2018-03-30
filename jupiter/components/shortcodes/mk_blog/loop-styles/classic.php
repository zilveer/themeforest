<?php
global $post, $mk_options;


// Classic Blog orientation style. 
$orientation = get_post_meta($post->ID, '_classic_orientation', true);
$orientation = $orientation ? $orientation : 'landscape';
switch ($orientation) {
    case 'landscape':
        $orientation_class = 'mk-blog-landscape';
        if ($view_params['layout'] == 'full') {
            $image_width = $mk_options['grid_width'];
        } 
        else {
            $image_width = (($mk_options['content_width'] / 100) * $mk_options['grid_width']);
        }
    break;

    case 'portraite':
        $orientation_class = 'mk-blog-portraite';
        if ($view_params['layout'] == 'full') {
            $image_width = 550;
        } 
        else {
            $image_width = 400;
        }
    break;
}

$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';
$orientation_class = ($post_type != 'instagram' && $post_type != 'twitter') ? $orientation_class : '';
?>

<article id="<?php the_ID(); ?>" class="mk-blog-classic-item mk-isotop-item <?php echo $post_type; ?>-post-type <?php echo $orientation_class; ?>">

    <?php
        $media_atts = array(
            'image_size'    => $view_params['image_size'],
            'image_width'   => $image_width,
            'image_height'  => $view_params['grid_image_height'],
            'post_type'     => $post_type,
        );
        echo mk_get_shortcode_view('mk_blog', 'components/featured-media', true, $media_atts);
    ?>


    <div class="mk-blog-meta">
        
        <?php
            if ($view_params['disable_meta'] == 'true') {
                echo mk_get_shortcode_view('mk_blog', 'components/meta', true);
            }
        ?>
        <?php echo mk_get_shortcode_view('mk_blog', 'components/title', true); ?>
        <?php echo mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => $view_params['full_content']]); ?>

        <?php if ($view_params['comments_share'] != 'false') {
            
            echo mk_get_shortcode_view('mk_blog', 'components/comments', true, ['post_type' => $post_type]);
            echo mk_get_shortcode_view('mk_blog', 'components/social-share', true);
        }

            echo mk_get_shortcode_view('mk_blog', 'components/read-more', true);
        ?>
        <div class="clearboth"></div>
    </div>

</article>
