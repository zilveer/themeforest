<?php
global $post, $mk_options;



switch ($view_params['column']) {
    case 1:
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width'] - 66);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 66);
        }
        $mk_column_css = 'one-column';
        break;

    case 2:
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width'] / 2 - 46);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2 - 46);
        }
        $mk_column_css = 'two-column';
        break;

    case 3:
        $image_width = $mk_options['grid_width'] / 3 - 42;
        $mk_column_css = 'three-column';
        break;

    case 4:
        $image_width = $mk_options['grid_width'] / 4 - 28;
        $mk_column_css = 'four-column';
        break;

    default:
        $image_width = $mk_options['grid_width'] / 3 - 42;
        $mk_column_css = 'three-column';
        break;
}

$post_type = get_post_meta($post->ID, '_single_post_type', true);
$post_type = !empty($post_type) ? $post_type : 'image';

?>

<article id="entry-<?php the_ID(); ?>" class="mk-blog-grid-item mk-isotop-item <?php echo $post_type; ?>-post-type <?php echo $mk_column_css; ?>">
    <div class="blog-grid-holder">
        <?php
            $media_atts = array(
                'image_size' => $view_params['image_size'],
                'image_width' => $image_width,
                'image_height' => $view_params['grid_image_height'],
                'post_type' => $post_type,
                //'image_quality' => $view_params['image_quality']
            );
            echo mk_get_shortcode_view('mk_blog', 'components/featured-media', true, $media_atts);
        ?>

        <div class="mk-blog-meta">
            <?php
                echo mk_get_shortcode_view('mk_blog', 'components/title', true);
                if($view_params['disable_meta'] == 'true') {
                    echo mk_get_shortcode_view('mk_blog', 'components/meta', true, ['author' => 'false', 'cats' => 'false']);
                }
                echo mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => $view_params['full_content']]);
            ?>
        </div>


        <div class="blog-grid-footer">
            <?php
                echo mk_get_shortcode_view('mk_blog', 'components/read-more', true);
                echo mk_get_shortcode_view('mk_blog', 'components/love-this', true);
            ?>
        </div>
        
    </div>
</article>
