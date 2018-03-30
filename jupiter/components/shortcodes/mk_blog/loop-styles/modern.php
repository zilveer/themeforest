<?php

    global $post, $mk_options;

    if ($view_params['layout'] == 'full') {
        $image_width = $mk_options['grid_width'] - 40;
    } else {
        $image_width = (($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 40;
    }


$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';
?>

 <article id="<?php the_ID(); ?>" class="mk-blog-modern-item mk-isotop-item <?php echo $post_type; ?>-post-type">
<?php
    $media_atts = array(
        'image_size'    => $view_params['image_size'],
        'image_width'   => $image_width,
        'image_height'  => $view_params['grid_image_height'],
        'post_type'     => $post_type,
        //'image_quality' => $view_params['image_quality']
    );
    echo  mk_get_shortcode_view('mk_blog', 'components/featured-media', true, $media_atts);


    if ($view_params['comments_share'] != 'false') { ?>
        <div class="blog-modern-social-section">
            <?php
            echo mk_get_shortcode_view('mk_blog', 'components/social-share', true);   
            echo mk_get_shortcode_view('mk_blog', 'components/comments', true, ['post_type' => $post_type]);
            echo mk_get_shortcode_view('mk_blog', 'components/love-this', true);
            ?>
        </div>
    <?php } ?>

    <div class="mk-blog-meta">
        <?php
            if ($view_params['disable_meta'] == 'true') {
                echo mk_get_shortcode_view('mk_blog', 'components/meta', true);
            }
            echo mk_get_shortcode_view('mk_blog', 'components/title', true);
            echo mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => $view_params['full_content']]); 
        ?>
        
        <?php
            echo do_shortcode( '[mk_button dimension="flat" corner_style="rounded" bg_color="'.$mk_options['skin_color'].'" btn_hover_bg="'.hexDarker($mk_options['skin_color'], 30).'" text_color="light" btn_hover_txt_color="#ffffff" size="medium" target="_self" align="none" url="' . esc_url( get_permalink() ) . '"]'.__('READ MORE', 'mk_framework').'[/mk_button]' );
        ?>

        <div class="clearboth"></div>
    </div>

    <div class="clearboth"></div>
</article>
