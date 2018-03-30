<?php
global $mk_options;

$style = get_post_meta($post->ID, '_news_post_style', true);

switch ($style) {
    case 'full-with-image':
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width'] - 55);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 66);
        }
        break;
    case 'full-without-image':
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width'] - 66);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) - 66);
        }
        break;

    case 'half-with-image':
        $image_width = 537;
        break;

    case 'half-without-image':
        $image_width = 537;
        break;

    case 'fourth-with-image':
        $image_width = 262;
        break;

    case 'fourth-without-image':
        $image_width = 262;
    default:
}
?>

<article id="<?php the_ID(); ?>" class="mk-news-item news-<?php echo $style; ?>"><div class="item-holder" style="height:<?php echo ($view_params['image_height'] + 2); ?>px">

<?php
switch ($style) {
    case 'full-with-image':
        echo mk_get_shortcode_view('mk_news', 'components/item-with-image', true, ['image_width' => $image_width, 'image_height' => $view_params['image_height']]);     
        break;

    case 'full-without-image':
       echo mk_get_shortcode_view('mk_news', 'components/item-without-image', true); 
        break;

    case 'half-with-image':
       echo mk_get_shortcode_view('mk_news', 'components/item-with-image', true, ['image_width' => $image_width, 'image_height' => $view_params['image_height']]); 
        break;

    case 'half-without-image':
        echo mk_get_shortcode_view('mk_news', 'components/item-without-image', true); 
        break;

    case 'fourth-with-image':
        echo mk_get_shortcode_view('mk_news', 'components/item-with-image', true, ['image_width' => $image_width, 'image_height' => $view_params['image_height']]); 
        break;

    case 'fourth-without-image':
       echo mk_get_shortcode_view('mk_news', 'components/item-without-image', true); 
    default:
}
?>
</div></article>

